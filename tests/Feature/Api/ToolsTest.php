<?php

use App\Models\Tool;
use App\Models\Version;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

test('it returns a list of tools with default settings', function () {
    $tool = Tool::factory()
        ->has(Version::factory()->count(3))
        ->create(['name' => 'Test Tool']);

    $response = $this->getJson('/api/tools');

    $response->assertSuccessful()
        ->assertJsonCount(1, 'data')
        ->assertJsonStructure([
            'data' => [
                '*' => [
                    'name',
                    'slug',
                    'category',
                    'website_url',
                    'short_description',
                    'vendor' => ['name'],
                    'versions',
                ],
            ],
        ]);
});

test('it includes versions by default limited to 5 ordered by release date desc', function () {
    $tool = Tool::factory()->create();

    // Create 7 versions with specific dates
    Version::factory()->create(['tool_id' => $tool->id, 'release_date' => '2024-01-01']);
    Version::factory()->create(['tool_id' => $tool->id, 'release_date' => '2024-02-01']);
    Version::factory()->create(['tool_id' => $tool->id, 'release_date' => '2024-03-01']);
    Version::factory()->create(['tool_id' => $tool->id, 'release_date' => '2024-04-01']);
    Version::factory()->create(['tool_id' => $tool->id, 'release_date' => '2024-05-01']);
    Version::factory()->create(['tool_id' => $tool->id, 'release_date' => '2024-06-01']);
    Version::factory()->create(['tool_id' => $tool->id, 'release_date' => '2024-07-01']);

    $response = $this->getJson('/api/tools');

    $response->assertSuccessful();

    $versions = $response->json('data.0.versions');
    expect($versions)->toHaveCount(5);
    expect($versions[0]['release_date'])->toBe('2024-07-01');
    expect($versions[4]['release_date'])->toBe('2024-03-01');
});

test('it excludes versions when include_versions is false', function () {
    $tool = Tool::factory()
        ->has(Version::factory()->count(3))
        ->create();

    $response = $this->getJson('/api/tools?include_versions=false');

    $response->assertSuccessful();
    expect($response->json('data.0.versions'))->toBeEmpty();
});

test('it orders tools by name ascending by default', function () {
    Tool::factory()->create(['name' => 'Zebra Tool']);
    Tool::factory()->create(['name' => 'Alpha Tool']);
    Tool::factory()->create(['name' => 'Beta Tool']);

    $response = $this->getJson('/api/tools');

    $response->assertSuccessful();
    $names = collect($response->json('data'))->pluck('name')->toArray();
    expect($names)->toBe(['Alpha Tool', 'Beta Tool', 'Zebra Tool']);
});

test('it orders tools by name descending', function () {
    Tool::factory()->create(['name' => 'Zebra Tool']);
    Tool::factory()->create(['name' => 'Alpha Tool']);
    Tool::factory()->create(['name' => 'Beta Tool']);

    $response = $this->getJson('/api/tools?order_by=name&order_direction=desc');

    $response->assertSuccessful();
    $names = collect($response->json('data'))->pluck('name')->toArray();
    expect($names)->toBe(['Zebra Tool', 'Beta Tool', 'Alpha Tool']);
});

test('it orders tools by latest version release date', function () {
    $tool1 = Tool::factory()->create(['name' => 'Old Tool']);
    Version::factory()->create(['tool_id' => $tool1->id, 'release_date' => '2023-01-01']);

    $tool2 = Tool::factory()->create(['name' => 'New Tool']);
    Version::factory()->create(['tool_id' => $tool2->id, 'release_date' => '2024-01-01']);

    $tool3 = Tool::factory()->create(['name' => 'Mid Tool']);
    Version::factory()->create(['tool_id' => $tool3->id, 'release_date' => '2023-06-01']);

    $response = $this->getJson('/api/tools?order_by=latest_version');

    $response->assertSuccessful();
    $names = collect($response->json('data'))->pluck('name')->toArray();
    expect($names)->toBe(['New Tool', 'Mid Tool', 'Old Tool']);
});

test('show endpoint returns a single tool by slug', function () {
    $tool = Tool::factory()->create([
        'name' => 'Test Tool',
        'slug' => 'test-tool',
    ]);

    $response = $this->getJson('/api/tools/test-tool');

    $response->assertSuccessful()
        ->assertJsonStructure([
            'data' => [
                'name',
                'slug',
                'category',
                'website_url',
                'short_description',
                'vendor' => ['name'],
            ],
        ])
        ->assertJsonPath('data.name', 'Test Tool')
        ->assertJsonPath('data.slug', 'test-tool');
});

test('show endpoint returns 404 for non-existent tool', function () {
    $response = $this->getJson('/api/tools/non-existent-tool');

    $response->assertNotFound();
});

test('show endpoint does not include versions without include parameter', function () {
    $tool = Tool::factory()
        ->has(Version::factory()->count(3))
        ->create(['slug' => 'test-tool']);

    $response = $this->getJson('/api/tools/test-tool');

    $response->assertSuccessful();
    expect($response->json('data.versions'))->toBeEmpty();
});

test('show endpoint includes versions when requested', function () {
    $tool = Tool::factory()->create(['slug' => 'test-tool']);

    Version::factory()->create(['tool_id' => $tool->id, 'release_date' => '2024-01-01']);
    Version::factory()->create(['tool_id' => $tool->id, 'release_date' => '2024-02-01']);
    Version::factory()->create(['tool_id' => $tool->id, 'release_date' => '2024-03-01']);

    $response = $this->getJson('/api/tools/test-tool?include=versions');

    $response->assertSuccessful();
    $versions = $response->json('data.versions');
    expect($versions)->toHaveCount(3);
    expect($versions[0]['release_date'])->toBe('2024-03-01');
    expect($versions[2]['release_date'])->toBe('2024-01-01');
});

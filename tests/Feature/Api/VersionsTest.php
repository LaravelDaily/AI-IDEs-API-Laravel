<?php

use App\Models\Tool;
use App\Models\Version;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

test('index endpoint returns all versions for a tool ordered by release date desc', function () {
    $tool = Tool::factory()->create(['slug' => 'test-tool']);

    Version::factory()->create([
        'tool_id' => $tool->id,
        'version' => '1.0.0',
        'release_date' => '2024-01-01',
    ]);
    Version::factory()->create([
        'tool_id' => $tool->id,
        'version' => '2.0.0',
        'release_date' => '2024-02-01',
    ]);
    Version::factory()->create([
        'tool_id' => $tool->id,
        'version' => '3.0.0',
        'release_date' => '2024-03-01',
    ]);

    $response = $this->getJson('/api/tools/test-tool/versions');

    $response->assertSuccessful()
        ->assertJsonCount(3, 'data')
        ->assertJsonStructure([
            'data' => [
                '*' => [
                    'version',
                    'release_date',
                    'description',
                    'changelog_url',
                ],
            ],
        ]);

    $versions = $response->json('data');
    expect($versions[0]['version'])->toBe('3.0.0');
    expect($versions[1]['version'])->toBe('2.0.0');
    expect($versions[2]['version'])->toBe('1.0.0');
});

test('index endpoint returns 404 if tool does not exist', function () {
    $response = $this->getJson('/api/tools/non-existent-tool/versions');

    $response->assertNotFound();
});

test('index endpoint returns empty array if tool has no versions', function () {
    $tool = Tool::factory()->create(['slug' => 'test-tool']);

    $response = $this->getJson('/api/tools/test-tool/versions');

    $response->assertSuccessful()
        ->assertJsonCount(0, 'data');
});

test('index endpoint does not include versions from other tools', function () {
    $tool1 = Tool::factory()->create(['slug' => 'tool-1']);
    $tool2 = Tool::factory()->create(['slug' => 'tool-2']);

    Version::factory()->count(3)->create(['tool_id' => $tool1->id]);
    Version::factory()->count(2)->create(['tool_id' => $tool2->id]);

    $response = $this->getJson('/api/tools/tool-1/versions');

    $response->assertSuccessful()
        ->assertJsonCount(3, 'data');
});

test('show endpoint returns a specific version for a tool', function () {
    $tool = Tool::factory()->create(['slug' => 'test-tool']);

    Version::factory()->create([
        'tool_id' => $tool->id,
        'version' => '1.0.0',
        'release_date' => '2024-01-01',
        'description' => 'Initial release',
        'changelog_url' => 'https://example.com/changelog',
    ]);

    $response = $this->getJson('/api/tools/test-tool/versions/1.0.0');

    $response->assertSuccessful()
        ->assertJsonStructure([
            'data' => [
                'version',
                'release_date',
                'description',
                'changelog_url',
            ],
        ])
        ->assertJsonPath('data.version', '1.0.0')
        ->assertJsonPath('data.release_date', '2024-01-01')
        ->assertJsonPath('data.description', 'Initial release')
        ->assertJsonPath('data.changelog_url', 'https://example.com/changelog');
});

test('show endpoint returns 404 if tool does not exist', function () {
    $response = $this->getJson('/api/tools/non-existent-tool/versions/1.0.0');

    $response->assertNotFound();
});

test('show endpoint returns 404 if version does not exist for tool', function () {
    $tool = Tool::factory()->create(['slug' => 'test-tool']);

    Version::factory()->create([
        'tool_id' => $tool->id,
        'version' => '1.0.0',
    ]);

    $response = $this->getJson('/api/tools/test-tool/versions/2.0.0');

    $response->assertNotFound();
});

test('show endpoint does not return version from different tool', function () {
    $tool1 = Tool::factory()->create(['slug' => 'tool-1']);
    $tool2 = Tool::factory()->create(['slug' => 'tool-2']);

    Version::factory()->create([
        'tool_id' => $tool1->id,
        'version' => '1.0.0',
    ]);
    Version::factory()->create([
        'tool_id' => $tool2->id,
        'version' => '1.0.0',
    ]);

    $response = $this->getJson('/api/tools/tool-1/versions/1.0.0');

    $response->assertSuccessful();
    expect($response->json('data.version'))->toBe('1.0.0');

    // Verify that requesting the same version for tool-2 also works
    $response2 = $this->getJson('/api/tools/tool-2/versions/1.0.0');
    $response2->assertSuccessful();
});

test('latest endpoint returns the latest version for each tool', function () {
    $tool1 = Tool::factory()->create(['slug' => 'tool-1']);
    $tool2 = Tool::factory()->create(['slug' => 'tool-2']);
    $tool3 = Tool::factory()->create(['slug' => 'tool-3']);

    // Tool 1 versions
    Version::factory()->create(['tool_id' => $tool1->id, 'version' => '1.0.0', 'release_date' => '2024-01-01']);
    Version::factory()->create(['tool_id' => $tool1->id, 'version' => '2.0.0', 'release_date' => '2024-02-01']);

    // Tool 2 versions
    Version::factory()->create(['tool_id' => $tool2->id, 'version' => '1.0.0', 'release_date' => '2024-03-01']);
    Version::factory()->create(['tool_id' => $tool2->id, 'version' => '1.5.0', 'release_date' => '2024-04-01']);

    // Tool 3 versions
    Version::factory()->create(['tool_id' => $tool3->id, 'version' => '3.0.0', 'release_date' => '2024-05-01']);

    $response = $this->getJson('/api/versions');

    $response->assertSuccessful()
        ->assertJsonCount(3, 'data')
        ->assertJsonStructure([
            'data' => [
                '*' => [
                    'version',
                    'release_date',
                    'description',
                    'changelog_url',
                ],
            ],
        ]);

    $versions = $response->json('data');

    // Should return latest version for each tool, ordered by release date desc
    expect($versions[0]['version'])->toBe('3.0.0');
    expect($versions[0]['release_date'])->toBe('2024-05-01');

    expect($versions[1]['version'])->toBe('1.5.0');
    expect($versions[1]['release_date'])->toBe('2024-04-01');

    expect($versions[2]['version'])->toBe('2.0.0');
    expect($versions[2]['release_date'])->toBe('2024-02-01');
});

test('latest endpoint returns empty array if no tools have versions', function () {
    Tool::factory()->count(3)->create();

    $response = $this->getJson('/api/versions');

    $response->assertSuccessful()
        ->assertJsonCount(0, 'data');
});

test('latest endpoint only returns one version per tool', function () {
    $tool = Tool::factory()->create();

    Version::factory()->create(['tool_id' => $tool->id, 'version' => '1.0.0', 'release_date' => '2024-01-01']);
    Version::factory()->create(['tool_id' => $tool->id, 'version' => '2.0.0', 'release_date' => '2024-02-01']);
    Version::factory()->create(['tool_id' => $tool->id, 'version' => '3.0.0', 'release_date' => '2024-03-01']);

    $response = $this->getJson('/api/versions');

    $response->assertSuccessful()
        ->assertJsonCount(1, 'data');

    expect($response->json('data.0.version'))->toBe('3.0.0');
});

test('latest endpoint excludes tools without versions', function () {
    $tool1 = Tool::factory()->create(['slug' => 'with-versions']);
    $tool2 = Tool::factory()->create(['slug' => 'without-versions']);

    Version::factory()->create(['tool_id' => $tool1->id, 'version' => '1.0.0', 'release_date' => '2024-01-01']);

    $response = $this->getJson('/api/versions');

    $response->assertSuccessful()
        ->assertJsonCount(1, 'data');

    expect($response->json('data.0.version'))->toBe('1.0.0');
});

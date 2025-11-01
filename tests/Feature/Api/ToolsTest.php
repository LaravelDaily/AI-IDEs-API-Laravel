<?php

use App\Models\PricingPlan;
use App\Models\Tool;
use App\Models\Version;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

test('it returns a list of tools with default settings', function () {
    $tool = Tool::factory()
        ->has(PricingPlan::factory()->count(2))
        ->has(Version::factory()->count(3))
        ->create(['name' => 'Test Tool']);

    $response = $this->getJson('/api/tools');

    $response->assertSuccessful()
        ->assertJsonCount(1, 'data')
        ->assertJsonStructure([
            'data' => [
                '*' => [
                    'id',
                    'name',
                    'slug',
                    'category',
                    'website_url',
                    'short_description',
                    'vendor' => ['id', 'name'],
                    'pricing_plans',
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

test('it always includes pricing plans', function () {
    $tool = Tool::factory()
        ->has(PricingPlan::factory()->count(3))
        ->create();

    $response = $this->getJson('/api/tools');

    $response->assertSuccessful();
    expect($response->json('data.0.pricing_plans'))->toHaveCount(3);
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

test('it orders tools by cheapest monthly plan', function () {
    $tool1 = Tool::factory()->create(['name' => 'Expensive Tool']);
    PricingPlan::factory()->create(['tool_id' => $tool1->id, 'billing_period' => 'monthly', 'price' => 50.00]);

    $tool2 = Tool::factory()->create(['name' => 'Cheap Tool']);
    PricingPlan::factory()->create(['tool_id' => $tool2->id, 'billing_period' => 'monthly', 'price' => 10.00]);

    $tool3 = Tool::factory()->create(['name' => 'Mid Tool']);
    PricingPlan::factory()->create(['tool_id' => $tool3->id, 'billing_period' => 'monthly', 'price' => 30.00]);

    $response = $this->getJson('/api/tools?order_by=cheapest_plan');

    $response->assertSuccessful();
    $names = collect($response->json('data'))->pluck('name')->toArray();
    expect($names)->toBe(['Cheap Tool', 'Mid Tool', 'Expensive Tool']);
});

test('it orders tools by most expensive monthly plan', function () {
    $tool1 = Tool::factory()->create(['name' => 'Expensive Tool']);
    PricingPlan::factory()->create(['tool_id' => $tool1->id, 'billing_period' => 'monthly', 'price' => 50.00]);

    $tool2 = Tool::factory()->create(['name' => 'Cheap Tool']);
    PricingPlan::factory()->create(['tool_id' => $tool2->id, 'billing_period' => 'monthly', 'price' => 10.00]);

    $tool3 = Tool::factory()->create(['name' => 'Mid Tool']);
    PricingPlan::factory()->create(['tool_id' => $tool3->id, 'billing_period' => 'monthly', 'price' => 30.00]);

    $response = $this->getJson('/api/tools?order_by=most_expensive_plan');

    $response->assertSuccessful();
    $names = collect($response->json('data'))->pluck('name')->toArray();
    expect($names)->toBe(['Expensive Tool', 'Mid Tool', 'Cheap Tool']);
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

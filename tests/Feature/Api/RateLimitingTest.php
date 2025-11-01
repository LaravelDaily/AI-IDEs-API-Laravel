<?php

use App\Models\Tool;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

test('it includes rate limit headers in api responses', function () {
    Tool::factory()->create();

    $response = $this->getJson('/api/tools');

    $response->assertSuccessful();
    $response->assertHeader('X-RateLimit-Limit', '60');
    expect($response->headers->has('X-RateLimit-Remaining'))->toBeTrue();
});

test('it enforces rate limit of 60 requests per hour on tools endpoint', function () {
    Tool::factory()->create();

    // Make 60 successful requests
    for ($i = 0; $i < 60; $i++) {
        $response = $this->getJson('/api/tools');
        $response->assertSuccessful();
    }

    // 61st request should be rate limited
    $response = $this->getJson('/api/tools');
    $response->assertStatus(429);
});

test('it enforces rate limit on versions endpoint', function () {
    // Make 60 successful requests
    for ($i = 0; $i < 60; $i++) {
        $response = $this->getJson('/api/versions');
        $response->assertSuccessful();
    }

    // 61st request should be rate limited
    $response = $this->getJson('/api/versions');
    $response->assertStatus(429);
});

test('it enforces rate limit on tool show endpoint', function () {
    $tool = Tool::factory()->create(['slug' => 'test-tool']);

    // Make 60 successful requests
    for ($i = 0; $i < 60; $i++) {
        $response = $this->getJson('/api/tools/test-tool');
        $response->assertSuccessful();
    }

    // 61st request should be rate limited
    $response = $this->getJson('/api/tools/test-tool');
    $response->assertStatus(429);
});

test('it shares rate limit across all api endpoints', function () {
    $tool = Tool::factory()->create(['slug' => 'test-tool']);

    // Make 30 requests to /api/tools
    for ($i = 0; $i < 30; $i++) {
        $response = $this->getJson('/api/tools');
        $response->assertSuccessful();
    }

    // Make 30 requests to /api/versions
    for ($i = 0; $i < 30; $i++) {
        $response = $this->getJson('/api/versions');
        $response->assertSuccessful();
    }

    // 61st request (to any endpoint) should be rate limited
    $response = $this->getJson('/api/tools/test-tool');
    $response->assertStatus(429);
});

<?php

use App\Mail\NewCodexVersionNotification;
use App\Models\Tool;
use App\Models\Version;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;

uses(RefreshDatabase::class);

it('fails when codex tool does not exist in database', function () {
    $this->artisan('codex:check-releases')
        ->expectsOutput('Checking for new Codex releases...')
        ->expectsOutput('Codex tool not found in database. Please ensure it exists in the tools table.')
        ->assertFailed();
});

it('fails when github api request fails', function () {
    Tool::factory()->create(['slug' => 'codex-cli', 'name' => 'Codex']);

    Http::fake([
        'github.com/*' => Http::response('', 500),
    ]);

    $this->artisan('codex:check-releases')
        ->expectsOutput('Checking for new Codex releases...')
        ->expectsOutput('Could not fetch the latest release from GitHub.')
        ->assertFailed();
});

it('does nothing when version already exists', function () {
    $tool = Tool::factory()->create(['slug' => 'codex-cli', 'name' => 'Codex']);
    Version::factory()->create([
        'tool_id' => $tool->id,
        'version' => '0.53.0',
    ]);

    Http::fake([
        'github.com/*' => Http::response(file_get_contents(__DIR__.'/../fixtures/github-releases.html')),
    ]);

    $this->artisan('codex:check-releases')
        ->expectsOutput('Checking for new Codex releases...')
        ->expectsOutput('Latest release found: 0.53.0 (Released: 2025-11-01)')
        ->expectsOutput('This version already exists in the database. No action needed.')
        ->assertSuccessful();
});

it('sends email when new release is found', function () {
    Mail::fake();
    Config::set('app.admin_email', 'admin@example.com');

    $tool = Tool::factory()->create(['slug' => 'codex-cli', 'name' => 'Codex']);

    Http::fake([
        'github.com/*' => Http::response(file_get_contents(__DIR__.'/../fixtures/github-releases.html')),
    ]);

    expect(Version::query()->where('tool_id', $tool->id)->count())->toBe(0);

    $this->artisan('codex:check-releases')
        ->expectsOutput('Checking for new Codex releases...')
        ->expectsOutput('Latest release found: 0.53.0 (Released: 2025-11-01)')
        ->expectsOutput('New version detected!')
        ->expectsOutput('Email notification sent to admin@example.com')
        ->assertSuccessful();

    // Verify version was NOT saved to database
    expect(Version::query()->where('tool_id', $tool->id)->count())->toBe(0);

    Mail::assertSent(NewCodexVersionNotification::class, function ($mail) use ($tool) {
        return $mail->versionData['version'] === '0.53.0'
            && $mail->versionData['release_date'] === '2025-11-01'
            && $mail->versionData['changelog_url'] === 'https://github.com/openai/codex/releases/tag/rust-v0.53.0'
            && $mail->versionData['download_url'] === 'https://github.com/openai/codex/archive/refs/tags/rust-v0.53.0.zip'
            && $mail->tool->id === $tool->id
            && $mail->hasTo('admin@example.com');
    });
});

it('skips email when admin email is not configured', function () {
    Mail::fake();
    Config::set('app.admin_email', null);

    $tool = Tool::factory()->create(['slug' => 'codex-cli', 'name' => 'Codex']);

    Http::fake([
        'github.com/*' => Http::response(file_get_contents(__DIR__.'/../fixtures/github-releases.html')),
    ]);

    $this->artisan('codex:check-releases')
        ->expectsOutput('Checking for new Codex releases...')
        ->expectsOutput('Latest release found: 0.53.0 (Released: 2025-11-01)')
        ->expectsOutput('New version detected!')
        ->expectsOutput('Admin email not configured. Skipping email notification.')
        ->assertSuccessful();

    Mail::assertNothingSent();
});

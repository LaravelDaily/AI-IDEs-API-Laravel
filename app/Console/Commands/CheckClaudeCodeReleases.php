<?php

namespace App\Console\Commands;

use App\Mail\NewCodexVersionNotification;
use App\Models\Tool;
use App\Models\Version;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;

class CheckClaudeCodeReleases extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'claude-code:check-releases';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check for new Claude Code releases on GitHub and notify administrator';

    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        $this->info('Checking for new Claude Code releases...');

        // Get the Claude Code tool from the database
        $tool = Tool::query()->where('slug', 'claude-code')->first();

        if (! $tool) {
            $this->error('Claude Code tool not found in database. Please ensure it exists in the tools table.');

            return self::FAILURE;
        }

        // Fetch the latest release from GitHub
        try {
            $latestRelease = $this->fetchLatestRelease();

            if (! $latestRelease) {
                $this->error('Could not fetch the latest release from GitHub.');

                return self::FAILURE;
            }

            $this->info("Latest release found: {$latestRelease['version']} (Released: {$latestRelease['release_date']})");

            // Check if this version already exists in the database
            $existingVersion = Version::query()
                ->where('tool_id', $tool->id)
                ->where('version', $latestRelease['version'])
                ->first();

            if ($existingVersion) {
                $this->info('This version already exists in the database. No action needed.');

                return self::SUCCESS;
            }

            // New version found - send email notification
            $this->info('New version detected!');

            $adminEmail = config('app.admin_email');

            if (! $adminEmail) {
                $this->warn('Admin email not configured. Skipping email notification.');

                return self::SUCCESS;
            }

            Mail::to($adminEmail)->send(new NewCodexVersionNotification($latestRelease, $tool));

            $this->info("Email notification sent to {$adminEmail}");

            return self::SUCCESS;
        } catch (\Exception $e) {
            $this->error("Error: {$e->getMessage()}");

            return self::FAILURE;
        }
    }

    /**
     * Fetch the latest release from GitHub changelog.
     */
    protected function fetchLatestRelease(): ?array
    {
        $response = Http::get('https://raw.githubusercontent.com/anthropics/claude-code/main/CHANGELOG.md');

        if (! $response->successful()) {
            return null;
        }

        $markdown = $response->body();

        // Parse the markdown to extract the latest version
        // Looking for the first version heading (e.g., "## 2.0.31")
        if (preg_match('/^##\s+([\d.]+)/m', $markdown, $matches)) {
            $version = $matches[1]; // e.g., "2.0.31"

            // Since there are no release dates in the changelog, use today's date
            $releaseDate = now()->format('Y-m-d');

            return [
                'version' => $version,
                'release_date' => $releaseDate,
                'changelog_url' => "https://github.com/anthropics/claude-code/blob/main/CHANGELOG.md#{$version}",
                'download_url' => 'https://github.com/anthropics/claude-code/archive/refs/heads/main.zip',
                'description' => "New release of Claude Code version {$version}",
            ];
        }

        return null;
    }
}

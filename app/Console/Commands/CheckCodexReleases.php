<?php

namespace App\Console\Commands;

use App\Mail\NewCodexVersionNotification;
use App\Models\Tool;
use App\Models\Version;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;

class CheckCodexReleases extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'codex:check-releases';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check for new Codex releases on GitHub and notify administrator';

    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        $this->info('Checking for new Codex releases...');

        // Get the Codex tool from the database
        $tool = Tool::query()->where('slug', 'codex-cli')->first();

        if (! $tool) {
            $this->error('Codex tool not found in database. Please ensure it exists in the tools table.');

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
     * Fetch the latest release from GitHub releases page.
     */
    protected function fetchLatestRelease(): ?array
    {
        $response = Http::get('https://github.com/openai/codex/releases');

        if (! $response->successful()) {
            return null;
        }

        $html = $response->body();

        // Parse the HTML to extract the latest release information
        // Looking for the release link with the version in the text
        if (preg_match('/<a[^>]*href="\/openai\/codex\/releases\/tag\/([^"]+)"[^>]*>([^<]+)<\/a>/', $html, $matches)) {
            $tagName = $matches[1]; // e.g., "rust-v0.53.0"
            $version = trim($matches[2]); // e.g., "0.53.0"

            // Extract release date - look for datetime attribute
            $releaseDatePattern = '/<relative-time[^>]*datetime="([^"]+)"[^>]*>/';
            preg_match($releaseDatePattern, $html, $dateMatches);
            $releaseDate = isset($dateMatches[1]) ? date('Y-m-d', strtotime($dateMatches[1])) : now()->format('Y-m-d');

            return [
                'version' => $version,
                'release_date' => $releaseDate,
                'changelog_url' => "https://github.com/openai/codex/releases/tag/{$tagName}",
                'download_url' => "https://github.com/openai/codex/archive/refs/tags/{$tagName}.zip",
                'description' => "New release of Codex version {$version}",
            ];
        }

        return null;
    }
}

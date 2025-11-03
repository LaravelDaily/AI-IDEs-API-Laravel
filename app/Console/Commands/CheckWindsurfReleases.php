<?php

namespace App\Console\Commands;

use App\Mail\NewCodexVersionNotification;
use App\Models\Tool;
use App\Models\Version;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;

class CheckWindsurfReleases extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'windsurf:check-releases';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check for new Windsurf releases on their website and notify administrator';

    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        $this->info('Checking for new Windsurf releases...');

        // Get the Windsurf tool from the database
        $tool = Tool::query()->where('slug', 'windsurf')->first();

        if (! $tool) {
            $this->error('Windsurf tool not found in database. Please ensure it exists in the tools table.');

            return self::FAILURE;
        }

        // Fetch the latest release from the website
        try {
            $latestRelease = $this->fetchLatestRelease();

            if (! $latestRelease) {
                $this->error('Could not fetch the latest release from Windsurf website.');

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
     * Fetch the latest release from Windsurf changelog website.
     */
    protected function fetchLatestRelease(): ?array
    {
        $response = Http::get('https://windsurf.com/changelog');

        if (! $response->successful()) {
            return null;
        }

        $html = $response->body();

        // Parse the HTML to extract the latest version and date
        // Try the specific div pattern first
        $divPattern = '/<div[^>]*class="[^"]*font-dmMono[^"]*"[^>]*>([^<]+)<\/div>\s*<div[^>]*class="[^"]*caption1[^"]*"[^>]*>([^<]+)<\/div>/s';

        if (preg_match($divPattern, $html, $matches)) {
            $version = trim($matches[1]); // e.g., "1.12.27"
            $dateString = trim($matches[2]); // e.g., "October 26, 2025"

            // Convert date string to Y-m-d format
            $releaseDate = date('Y-m-d', strtotime($dateString));

            return [
                'version' => $version,
                'release_date' => $releaseDate,
                'changelog_url' => 'https://windsurf.com/changelog',
                'download_url' => 'https://windsurf.com/download',
                'description' => "New release of Windsurf version {$version}",
            ];
        }

        // Fallback: Try simpler h2 pattern
        $h2Pattern = '/<h2[^>]*>([0-9.]+)<\/h2>\s*<p[^>]*>([^<]+)<\/p>/s';

        if (preg_match($h2Pattern, $html, $matches)) {
            $version = trim($matches[1]); // e.g., "1.12.27"
            $dateString = trim($matches[2]); // e.g., "October 26, 2025"

            // Convert date string to Y-m-d format
            $releaseDate = date('Y-m-d', strtotime($dateString));

            return [
                'version' => $version,
                'release_date' => $releaseDate,
                'changelog_url' => 'https://windsurf.com/changelog',
                'download_url' => 'https://windsurf.com/download',
                'description' => "New release of Windsurf version {$version}",
            ];
        }

        return null;
    }
}

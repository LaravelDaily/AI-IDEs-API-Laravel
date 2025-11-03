<?php

namespace App\Console\Commands;

use App\Mail\NewCodexVersionNotification;
use App\Models\Tool;
use App\Models\Version;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;

class CheckCursorReleases extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'cursor:check-releases';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check for new Cursor releases on their website and notify administrator';

    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        $this->info('Checking for new Cursor releases...');

        // Get the Cursor tool from the database
        $tool = Tool::query()->where('slug', 'cursor')->first();

        if (! $tool) {
            $this->error('Cursor tool not found in database. Please ensure it exists in the tools table.');

            return self::FAILURE;
        }

        // Fetch the latest release from the website
        try {
            $latestRelease = $this->fetchLatestRelease();

            if (! $latestRelease) {
                $this->error('Could not fetch the latest release from Cursor website.');

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
     * Fetch the latest release from Cursor changelog website.
     */
    protected function fetchLatestRelease(): ?array
    {
        $response = Http::get('https://cursor.com/changelog');

        if (! $response->successful()) {
            return null;
        }

        $html = $response->body();

        // Parse the HTML to extract the latest version and date
        // Looking for: <span class="label">VERSION</span> ... <time dateTime="DATE">
        $pattern = '/<a[^>]*href="\/changelog\/([^"]+)"[^>]*>.*?<span class="label">([^<]+)<\/span>.*?<time[^>]*dateTime="([^"]+)"[^>]*>/s';

        if (preg_match($pattern, $html, $matches)) {
            $changelogSlug = $matches[1]; // e.g., "2-0"
            $version = $matches[2]; // e.g., "2.0"
            $dateTime = $matches[3]; // e.g., "2025-10-29T05:08:00.000Z"

            // Convert ISO 8601 date to Y-m-d format
            $releaseDate = date('Y-m-d', strtotime($dateTime));

            return [
                'version' => $version,
                'release_date' => $releaseDate,
                'changelog_url' => "https://cursor.com/changelog/{$changelogSlug}",
                'download_url' => 'https://cursor.com/download',
                'description' => "New release of Cursor version {$version}",
            ];
        }

        return null;
    }
}

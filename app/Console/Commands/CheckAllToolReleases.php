<?php

namespace App\Console\Commands;

use App\Mail\NewToolVersionsNotification;
use App\Models\Tool;
use App\Models\Version;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;

class CheckAllToolReleases extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'tools:check-releases';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check for new releases across all tools and notify administrator';

    /**
     * The tools to check for new releases.
     *
     * @var array<string>
     */
    protected array $toolSlugs = [
        'codex-cli',
        'claude-code',
        'cursor',
        'windsurf',
    ];

    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        $this->info('Checking for new releases across all tools...');

        $newReleases = [];

        foreach ($this->toolSlugs as $slug) {
            $this->info("Checking {$slug}...");

            try {
                $tool = Tool::query()->where('slug', $slug)->first();

                if (! $tool) {
                    $this->warn("Tool '{$slug}' not found in database. Skipping.");

                    continue;
                }

                $latestRelease = $this->fetchLatestReleaseForTool($slug);

                if (! $latestRelease) {
                    $this->warn("Could not fetch the latest release for {$slug}.");

                    continue;
                }

                $this->info("  Latest version: {$latestRelease['version']} (Released: {$latestRelease['release_date']})");

                // Check if this version already exists in the database
                $existingVersion = Version::query()
                    ->where('tool_id', $tool->id)
                    ->where('version', $latestRelease['version'])
                    ->first();

                if ($existingVersion) {
                    $this->info('  Version already exists in database.');

                    continue;
                }

                // New version found - add to the list
                $this->info('  ✓ New version detected!');
                $newReleases[] = [
                    'tool' => $tool,
                    'release' => $latestRelease,
                ];
            } catch (\Exception $e) {
                $this->error("Error checking {$slug}: {$e->getMessage()}");
            }
        }

        // Send email notification if new releases were found
        if (empty($newReleases)) {
            $this->info('No new releases found.');

            return self::SUCCESS;
        }

        $this->info('Sending email notification for '.count($newReleases).' new release(s)...');

        $adminEmail = config('app.admin_email');

        if (! $adminEmail) {
            $this->warn('Admin email not configured. Skipping email notification.');

            return self::SUCCESS;
        }

        Mail::to($adminEmail)->send(new NewToolVersionsNotification($newReleases));

        $this->info("Email notification sent to {$adminEmail}");

        return self::SUCCESS;
    }

    /**
     * Fetch the latest release for a specific tool.
     */
    protected function fetchLatestReleaseForTool(string $slug): ?array
    {
        return match ($slug) {
            'codex-cli' => $this->fetchCodexRelease(),
            'claude-code' => $this->fetchClaudeCodeRelease(),
            'cursor' => $this->fetchCursorRelease(),
            'windsurf' => $this->fetchWindsurfRelease(),
            default => null,
        };
    }

    /**
     * Fetch the latest Codex release from GitHub.
     */
    protected function fetchCodexRelease(): ?array
    {
        $response = Http::get('https://github.com/openai/codex/releases');

        if (! $response->successful()) {
            return null;
        }

        $html = $response->body();

        // Parse the HTML to extract the latest release information
        if (preg_match('/<a[^>]*href="\/openai\/codex\/releases\/tag\/([^"]+)"[^>]*>([^<]+)<\/a>/', $html, $matches)) {
            $tagName = $matches[1]; // e.g., "rust-v0.53.0"
            $version = trim($matches[2]); // e.g., "0.53.0"

            // Extract release date
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

    /**
     * Fetch the latest Claude Code release from GitHub changelog.
     */
    protected function fetchClaudeCodeRelease(): ?array
    {
        $response = Http::get('https://raw.githubusercontent.com/anthropics/claude-code/main/CHANGELOG.md');

        if (! $response->successful()) {
            return null;
        }

        $markdown = $response->body();

        // Parse the markdown to extract the latest version
        if (preg_match('/^##\s+([\d.]+)/m', $markdown, $matches)) {
            $version = $matches[1]; // e.g., "2.0.31"
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

    /**
     * Fetch the latest Cursor release from their changelog.
     */
    protected function fetchCursorRelease(): ?array
    {
        $response = Http::get('https://cursor.com/changelog');

        if (! $response->successful()) {
            return null;
        }

        $html = $response->body();

        // Parse the HTML to extract the latest version and date
        $pattern = '/<a[^>]*href="\/changelog\/([^"]+)"[^>]*>.*?<span class="label">([^<]+)<\/span>.*?<time[^>]*dateTime="([^"]+)"[^>]*>/s';

        if (preg_match($pattern, $html, $matches)) {
            $changelogSlug = $matches[1]; // e.g., "2-0"
            $version = $matches[2]; // e.g., "2.0"
            $dateTime = $matches[3]; // e.g., "2025-10-29T05:08:00.000Z"

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

    /**
     * Fetch the latest Windsurf release from their changelog.
     */
    protected function fetchWindsurfRelease(): ?array
    {
        $response = Http::get('https://windsurf.com/changelog');

        if (! $response->successful()) {
            return null;
        }

        $html = $response->body();

        // Try the specific div pattern first
        $divPattern = '/<div[^>]*class="[^"]*font-dmMono[^"]*"[^>]*>([^<]+)<\/div>\s*<div[^>]*class="[^"]*caption1[^"]*"[^>]*>([^<]+)<\/div>/s';

        if (preg_match($divPattern, $html, $matches)) {
            $version = trim($matches[1]); // e.g., "1.12.27"
            $dateString = trim($matches[2]); // e.g., "October 26, 2025"
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

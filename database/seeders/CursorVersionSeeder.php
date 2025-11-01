<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class CursorVersionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tool = \App\Models\Tool::where('slug', 'cursor')->first();

        if (! $tool) {
            $this->command->error('Cursor tool not found. Please run ToolSeeder first.');

            return;
        }

        $versions = [
            [
                'version' => '2.0',
                'description' => 'New Coding Model and Agent Interface',
                'release_date' => '2025-10-29',
                'changelog_url' => 'https://cursor.com/changelog/2-0',
            ],
            [
                'version' => '1.7',
                'description' => 'Browser Controls, Plan Mode, and Hooks',
                'release_date' => '2025-09-29',
                'changelog_url' => 'https://cursor.com/changelog/1-7',
            ],
            [
                'version' => '1.6',
                'description' => 'Slash commands, summarization, and improved Agent terminal',
                'release_date' => '2025-09-12',
                'changelog_url' => 'https://cursor.com/changelog/1-6',
            ],
            [
                'version' => '1.5',
                'description' => 'Linear integration, improved Agent terminal, and OS notifications',
                'release_date' => '2025-08-21',
                'changelog_url' => 'https://cursor.com/changelog/1-5',
            ],
        ];

        foreach ($versions as $versionData) {
            \App\Models\Version::create([
                'tool_id' => $tool->id,
                'version' => $versionData['version'],
                'description' => $versionData['description'],
                'release_date' => $versionData['release_date'],
                'changelog_url' => $versionData['changelog_url'],
                'download_url' => null,
            ]);
        }
    }
}

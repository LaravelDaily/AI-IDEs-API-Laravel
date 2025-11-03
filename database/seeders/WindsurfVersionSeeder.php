<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class WindsurfVersionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tool = \App\Models\Tool::where('slug', 'windsurf')->first();

        if (! $tool) {
            $this->command->error('Windsurf tool not found. Please run ToolSeeder first.');

            return;
        }

        $versions = [
            [
                'version' => '1.12.27',
                'description' => '- You can now try a new stealth model in Windsurf: Falcon Alpha. Falcon Alpha is a powerful agentic model designed for speed.
- We\'re excited to hear what you build with it!
- Various performance improvements and bug fixes.',
                'release_date' => '2025-10-26',
            ],
            [
                'version' => '1.12.25',
                'description' => '- Support and fixes for AGENTS.md.
- Improvements and bug fixes for Codemaps.
- Improvements to Fast Context. Enterprises can opt in using the Windsurf Team Settings.
- Users can toggle Fast Context automatically using "CMD/Ctrl + Enter" on the first message in a chat.
- New auto-linting behavior that speeds up Cascade.
- Fix for MCP Marketplace not respecting team whitelist options.
- Fixes for Jupyter Notebook tool.
- Fixes for Memories, Rules, and Workflows.
- General bug fixes and improvements.',
                'release_date' => '2025-10-22',
            ],
            [
                'version' => '1.12.21',
                'description' => '- Updated Code OSS to version 1.105.0 (Electron: 37.6.0, Chromium: 138.0.7204.251).
- Resolved issues affecting SSH remote connections with high resource usage.
- Fix certain models seeing increased error rates on editing files.
- Improved diagnostics for third party extensions.',
                'release_date' => '2025-10-17',
            ],
            [
                'version' => '1.12.20',
                'description' => '- Fast Context: Introduced Fast Context subagent powered by SWE-grep, enabling agents to find relevant code context up to 20x faster with >2,800 tokens per second throughput. Learn more on our blog.
- Fixed issues with WSL compatibility.
- Fixed bugs in Workflows and Rules UI.
- Various stability improvements and minor bug fixes.',
                'release_date' => '2025-10-16',
            ],
            [
                'version' => '1.12.18',
                'description' => '- Fixes issue with custom MCP servers not being displayed correctly in the new MCP panel.
- Improvements and bug fixes for the beta Codemaps feature.
- Fixes issue where some bash commands would get stuck.
- Fixes issue where certain models couldn\'t create or edit Jupyter notebooks.',
                'release_date' => '2025-10-14',
            ],
            [
                'version' => '1.12.16',
                'description' => '- Grok Code Fast 1 is now available in Windsurf for Pro and Teams users!
- We\'re excited to enable it for free (0x credits) for a limited time.',
                'release_date' => '2025-10-10',
            ],
            [
                'version' => '1.12.12',
                'description' => 'Claude Sonnet 4.5 is now available',
                'release_date' => '2025-09-29',
            ],
            [
                'version' => '1.12.11',
                'description' => '- Fix using MCP tools with certain models.
- Fixes to terminal issues on Windows.',
                'release_date' => '2025-09-26',
            ],
            [
                'version' => '1.12.9',
                'description' => '- Fix to Cascade slowness issues',
                'release_date' => '2025-09-24',
            ],
            [
                'version' => '1.12.8',
                'description' => 'GPT-5-Codex is now available for free (0x credits) for a limited time for paid users!',
                'release_date' => '2025-09-23',
            ],
            [
                'version' => '1.12.6',
                'description' => '- Cascade Improvements. Queued messages: Users can now add follow-up messages to Cascade while it is working, and Cascade will process them in order after the current task is complete.
- Cascade now renders mermaid diagrams in the conversation.
- Windsurf Browser is now deprecated.',
                'release_date' => '2025-09-16',
            ],
            [
                'version' => '1.12.2',
                'description' => '- Grok Code Fast 1 is now available in Windsurf for Pro and Teams users! We\'re excited to enable it for free (0x credits) for a limited time.
- Starting on Tuesday, August 26, our GPT-5 promotion will end for all users.',
                'release_date' => '2025-08-25',
            ],
            [
                'version' => '1.12.1',
                'description' => '- Stability & Performance: Over 100 bug fixes and reliability improvements.
- DeepWiki in Windsurf: Hover over code symbols for intelligent DeepWiki-powered documentation.
- Vibe and Replace: AI-powered find and replace functionality. Apply intelligent transformations to multiple code matches.
- Cascade Agent Improvements: Automatic planning mode with no manual toggles required. Revamped tools with more accurate edits. Enhanced code exploration leveraging long context models.
- Tab Autocomplete: New system with more frequent and smarter suggestions.
- UI Redesign: All-new Chat, Cascade, and home screen panels.
- Dev Containers: Support for development containers via remote SSH access.',
                'release_date' => '2025-08-14',
            ],
        ];

        foreach ($versions as $versionData) {
            \App\Models\Version::create([
                'tool_id' => $tool->id,
                'version' => $versionData['version'],
                'description' => $versionData['description'],
                'release_date' => $versionData['release_date'],
                'changelog_url' => 'https://www.windsurf.com/changelog/',
                'download_url' => null,
            ]);
        }
    }
}

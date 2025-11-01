<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class CodexCLIVersionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tool = \App\Models\Tool::where('slug', 'codex-cli')->first();

        if (! $tool) {
            $this->command->error('Codex CLI tool not found. Please run ToolSeeder first.');

            return;
        }

        $versions = [
            [
                'version' => '0.53.0',
                'description' => '- Fixing error 400 issues
- Improved Java sandboxing',
                'release_date' => '2025-10-31',
            ],
            [
                'version' => '0.52.0',
                'description' => '- TUI polish with queued messages, Windows guidance, undo operations
- Client-side image resizing
- Execute commands with `!<cmd>`',
                'release_date' => '2025-10-30',
            ],
            [
                'version' => '0.50.0',
                'description' => '- Improved `/feedback` command for better diagnostics and issue reporting',
                'release_date' => '2025-10-25',
            ],
            [
                'version' => '0.49.0',
                'description' => '- No major changes
- Used for homebrew upgrade script testing',
                'release_date' => '2025-10-24',
            ],
            [
                'version' => '0.48.0',
                'description' => '- Added `--add-dir` flag
- MCP improvements with stdio servers using official SDK
- Configurable enabled/disabled tools',
                'release_date' => '2025-10-23',
            ],
            [
                'version' => '0.47.0',
                'description' => '- TUI enhancements
- macOS code signing
- Auto-update banner
- Warning for "full access" mode',
                'release_date' => '2025-10-17',
            ],
            [
                'version' => '0.46.0',
                'description' => '- Enhanced MCP support
- Improved TUI rendering
- `list_dir` tool added
- Experimental RMCP client improvements',
                'release_date' => '2025-10-09',
            ],
            [
                'version' => '0.45.0',
                'description' => '- **Breaking change**: Replaced `--api-key` with `--with-api-key` for improved security
- OAuth MCP server support',
                'release_date' => '2025-10-06',
            ],
            [
                'version' => '0.44.0',
                'description' => '- UI refresh
- Custom prompts with named arguments
- Streamable HTTP MCP servers
- Cloud tasks management',
                'release_date' => '2025-10-03',
            ],
            [
                'version' => '0.42.0',
                'description' => '- Experimental Rust SDK-based MCP client
- Responses-api-proxy component
- Secure mode support',
                'release_date' => '2025-09-26',
            ],
            [
                'version' => '0.41.0',
                'description' => '- Rate limits visibility
- Output schema specification in exec mode
- Ripgrep vendoring',
                'release_date' => '2025-09-24',
            ],
            [
                'version' => '0.40.0',
                'description' => '- Default model changed to `gpt-5-codex`
- Auto-compaction at 220k tokens
- New `/review` commands',
                'release_date' => '2025-09-23',
            ],
            [
                'version' => '0.39.0',
                'description' => '- Introduced new `/review` command for code reviews',
                'release_date' => '2025-09-18',
            ],
            [
                'version' => '0.38.0',
                'description' => '- Fixed npm publish step
- Implemented "trusted publishing"',
                'release_date' => '2025-09-17',
            ],
            [
                'version' => '0.37.0',
                'description' => '- Quality-of-life fixes
- Notifications on approvals and turn completion',
                'release_date' => '2025-09-17',
            ],
        ];

        foreach ($versions as $versionData) {
            \App\Models\Version::create([
                'tool_id' => $tool->id,
                'version' => $versionData['version'],
                'description' => $versionData['description'],
                'release_date' => $versionData['release_date'],
                'changelog_url' => 'https://developers.openai.com/codex/changelog/',
                'download_url' => null,
            ]);
        }
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ClaudeCodeVersionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tool = \App\Models\Tool::where('slug', 'claude-code')->first();

        if (! $tool) {
            $this->command->error('Claude Code tool not found. Please run ToolSeeder first.');

            return;
        }

        $versions = [
            [
                'version' => '2.0.30',
                'description' => "- Added helpful hint to run `security unlock-keychain` when encountering API key errors on macOS with locked keychain\n- Added `allowUnsandboxedCommands` sandbox setting to disable the dangerouslyDisableSandbox escape hatch at policy level\n- Added `disallowedTools` field to custom agent definitions for explicit tool blocking\n- Added prompt-based stop hooks\n- VSCode: Added respectGitIgnore configuration to include .gitignored files in file searches (defaults to true)\n- Enabled SSE MCP servers on native build\n- Deprecated output styles. Review options in `/output-style` and use --system-prompt, --append-system-prompt, CLAUDE.md, or plugins instead\n- Removed support for custom ripgrep configuration, resolving an issue where Search returns no results and config discovery fails\n- Fixed Explore agent creating unwanted .md investigation files during codebase exploration\n- Fixed a bug where `/context` would sometimes fail with \"max_tokens must be greater than thinking.budget_tokens\" error message\n- Fixed `--mcp-config` flag to correctly override file-based MCP configurations\n- Fixed bug that saved session permissions to local settings\n- Fixed MCP tools not being available to sub-agents\n- Fixed hooks and plugins not executing when using --dangerously-skip-permissions flag\n- Fixed delay when navigating through typeahead suggestions with arrow keys\n- VSCode: Restored selection indicator in input footer showing current file or code selection status",
                'release_date' => '2025-10-31',
            ],
            [
                'version' => '2.0.28',
                'description' => "- Plan mode: introduced new Plan subagent\n- Subagents: claude can now choose to resume subagents\n- Subagents: claude can dynamically choose the model used by its subagents\n- SDK: added --max-budget-usd flag\n- Discovery of custom slash commands, subagents, and output styles no longer respects .gitignore\n- Stop `/terminal-setup` from adding backslash to `Shift + Enter` in VS Code\n- Add branch and tag support for git-based plugins and marketplaces using fragment syntax (e.g., `owner/repo#branch`)\n- Fixed a bug where macOS permission prompts would show up upon initial launch when launching from home directory\n- Various other bug fixes",
                'release_date' => '2025-10-27',
            ],
            [
                'version' => '2.0.27',
                'description' => "- New UI for permission prompts\n- Added current branch filtering and search to session resume screen for easier navigation\n- Fixed directory @-mention causing \"No assistant message found\" error\n- VSCode Extension: Add config setting to include .gitignored files in file searches\n- VSCode Extension: Bug fixes for unrelated 'Warmup' conversations, and configuration/settings occasionally being reset to defaults",
                'release_date' => '2025-10-24',
            ],
            [
                'version' => '2.0.25',
                'description' => '- Removed legacy SDK entrypoint. Please migrate to @anthropic-ai/claude-agent-sdk for future SDK updates: https://docs.claude.com/en/docs/claude-code/sdk/migration-guide',
                'release_date' => '2025-10-22',
            ],
            [
                'version' => '2.0.24',
                'description' => "- Fixed a bug where project-level skills were not loading when --setting-sources 'project' was specified\n- Claude Code Web: Support for Web -> CLI teleport\n- Sandbox: Releasing a sandbox mode for the BashTool on Linux & Mac\n- Bedrock: Display awsAuthRefresh output when auth is required",
                'release_date' => '2025-10-21',
            ],
            [
                'version' => '2.0.22',
                'description' => "- Fixed content layout shift when scrolling through slash commands\n- IDE: Add toggle to enable/disable thinking.\n- Fix bug causing duplicate permission prompts with parallel tool calls\n- Add support for enterprise managed MCP allowlist and denylist",
                'release_date' => '2025-10-18',
            ],
            [
                'version' => '2.0.21',
                'description' => "- Support MCP `structuredContent` field in tool responses\n- Added an interactive question tool\n- Claude will now ask you questions more often in plan mode\n- Added Haiku 4.5 as a model option for Pro users\n- Fixed an issue where queued commands don't have access to previous messages' output",
                'release_date' => '2025-10-18',
            ],
            [
                'version' => '2.0.20',
                'description' => '- Added support for Claude Skills',
                'release_date' => '2025-10-17',
            ],
            [
                'version' => '2.0.19',
                'description' => "- Auto-background long-running bash commands instead of killing them. Customize with BASH_DEFAULT_TIMEOUT_MS\n- Fixed a bug where Haiku was unnecessarily called in print mode",
                'release_date' => '2025-10-16',
            ],
            [
                'version' => '2.0.17',
                'description' => "- Added Haiku 4.5 to model selector!\n- Haiku 4.5 automatically uses Sonnet in plan mode, and Haiku for execution (i.e. SonnetPlan by default)\n- 3P (Bedrock and Vertex) are not automatically upgraded yet. Manual upgrading can be done through setting `ANTHROPIC_DEFAULT_HAIKU_MODEL`\n- Introducing the Explore subagent. Powered by Haiku it'll search through your codebase efficiently to save context!\n- OTEL: support HTTP_PROXY and HTTPS_PROXY\n- `CLAUDE_CODE_DISABLE_NONESSENTIAL_TRAFFIC` now disables release notes fetching",
                'release_date' => '2025-10-15',
            ],
            [
                'version' => '2.0.15',
                'description' => "- Fixed bug with resuming where previously created files needed to be read again before writing\n- Fixed bug with `-p` mode where @-mentioned files needed to be read again before writing",
                'release_date' => '2025-10-14',
            ],
            [
                'version' => '2.0.14',
                'description' => "- Fix @-mentioning MCP servers to toggle them on/off\n- Improve permission checks for bash with inline env vars\n- Fix ultrathink + thinking toggle\n- Reduce unnecessary logins\n- Document --system-prompt\n- Several improvements to rendering\n- Plugins UI polish",
                'release_date' => '2025-10-11',
            ],
            [
                'version' => '2.0.13',
                'description' => '- Fixed `/plugin` not working on native build',
                'release_date' => '2025-10-09',
            ],
            [
                'version' => '2.0.12',
                'description' => "- **Plugin System Released**: Extend Claude Code with custom commands, agents, hooks, and MCP servers from marketplaces\n- `/plugin install`, `/plugin enable/disable`, `/plugin marketplace` commands for plugin management\n- Repository-level plugin configuration via `extraKnownMarketplaces` for team collaboration\n- `/plugin validate` command for validating plugin structure and configuration\n- Plugin announcement blog post at https://www.anthropic.com/news/claude-code-plugins\n- Plugin documentation available at https://docs.claude.com/en/docs/claude-code/plugins\n- Comprehensive error messages and diagnostics via `/doctor` command\n- Avoid flickering in `/model` selector\n- Improvements to `/help`\n- Avoid mentioning hooks in `/resume` summaries\n- Changes to the \"verbose\" setting in `/config` now persist across sessions",
                'release_date' => '2025-10-09',
            ],
            [
                'version' => '2.0.11',
                'description' => "- Reduced system prompt size by 1.4k tokens\n- IDE: Fixed keyboard shortcuts and focus issues for smoother interaction\n- Fixed Opus fallback rate limit errors appearing incorrectly\n- Fixed /add-dir command selecting wrong default tab",
                'release_date' => '2025-10-08',
            ],
            [
                'version' => '2.0.10',
                'description' => "- Rewrote terminal renderer for buttery smooth UI\n- Enable/disable MCP servers by @mentioning, or in /mcp\n- Added tab completion for shell commands in bash mode\n- PreToolUse hooks can now modify tool inputs\n- Press Ctrl-G to edit your prompt in your system's configured text editor\n- Fixes for bash permission checks with environment variables in the command",
                'release_date' => '2025-10-08',
            ],
            [
                'version' => '2.0.9',
                'description' => '- Fix regression where bash backgrounding stopped working',
                'release_date' => '2025-10-06',
            ],
            [
                'version' => '2.0.8',
                'description' => "- Update Bedrock default Sonnet model to `global.anthropic.claude-sonnet-4-5-20250929-v1:0`\n- IDE: Add drag-and-drop support for files and folders in chat\n- /context: Fix counting for thinking blocks\n- Improve message rendering for users with light themes on dark terminals\n- Remove deprecated .claude.json allowedTools, ignorePatterns, env, and todoFeatureEnabled config options (instead, configure these in your settings.json)",
                'release_date' => '2025-10-05',
            ],
            [
                'version' => '2.0.5',
                'description' => "- IDE: Fix IME unintended message submission with Enter and Tab\n- IDE: Add \"Open in Terminal\" link in login screen\n- Fix unhandled OAuth expiration 401 API errors\n- SDK: Added SDKUserMessageReplay.isReplay to prevent duplicate messages",
                'release_date' => '2025-10-04',
            ],
            [
                'version' => '2.0.1',
                'description' => "- Skip Sonnet 4.5 default model setting change for Bedrock and Vertex\n- Various bug fixes and presentation improvements",
                'release_date' => '2025-09-30',
            ],
            [
                'version' => '2.0.0',
                'description' => "- New native VS Code extension\n- Fresh coat of paint throughout the whole app\n- /rewind a conversation to undo code changes\n- /usage command to see plan limits\n- Tab to toggle thinking (sticky across sessions)\n- Ctrl-R to search history\n- Unshipped claude config command\n- Hooks: Reduced PostToolUse 'tool_use' ids were found without 'tool_result' blocks errors\n- SDK: The Claude Code SDK is now the Claude Agent SDK\n- Add subagents dynamically with `--agents` flag",
                'release_date' => '2025-09-29',
            ],
        ];

        foreach ($versions as $versionData) {
            \App\Models\Version::create([
                'tool_id' => $tool->id,
                'version' => $versionData['version'],
                'description' => $versionData['description'],
                'release_date' => $versionData['release_date'],
                'changelog_url' => 'https://github.com/anthropics/claude-code/blob/main/CHANGELOG.md#'.str_replace('.', '', $versionData['version']),
                'download_url' => null,
            ]);
        }
    }
}

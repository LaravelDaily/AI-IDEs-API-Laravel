<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta content="IE=edge,chrome=1" http-equiv="X-UA-Compatible">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>AI IDEs API Documentation</title>

    <link href="https://fonts.googleapis.com/css?family=Open+Sans&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset("/vendor/scribe/css/theme-default.style.css") }}" media="screen">
    <link rel="stylesheet" href="{{ asset("/vendor/scribe/css/theme-default.print.css") }}" media="print">

    <script src="https://cdn.jsdelivr.net/npm/lodash@4.17.10/lodash.min.js"></script>

    <link rel="stylesheet"
          href="https://unpkg.com/@highlightjs/cdn-assets@11.6.0/styles/obsidian.min.css">
    <script src="https://unpkg.com/@highlightjs/cdn-assets@11.6.0/highlight.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jets/0.14.1/jets.min.js"></script>

    <style id="language-style">
        /* starts out as display none and is replaced with js later  */
                    body .content .bash-example code { display: none; }
                    body .content .javascript-example code { display: none; }
            </style>

    <script>
        var tryItOutBaseUrl = "https://ai-ide-api.on-forge.com/";
        var useCsrf = Boolean();
        var csrfUrl = "/sanctum/csrf-cookie";
    </script>
    <script src="{{ asset("/vendor/scribe/js/tryitout-5.5.0.js") }}"></script>

    <script src="{{ asset("/vendor/scribe/js/theme-default-5.5.0.js") }}"></script>

</head>

<body data-languages="[&quot;bash&quot;,&quot;javascript&quot;]">

<a href="#" id="nav-button">
    <span>
        MENU
        <img src="{{ asset("/vendor/scribe/images/navbar.png") }}" alt="navbar-image"/>
    </span>
</a>
<div class="tocify-wrapper">
    
            <div class="lang-selector">
                                            <button type="button" class="lang-button" data-language-name="bash">bash</button>
                                            <button type="button" class="lang-button" data-language-name="javascript">javascript</button>
                    </div>
    
    <div class="search">
        <input type="text" class="search" id="input-search" placeholder="Search">
    </div>

    <div id="toc">
                    <ul id="tocify-header-introduction" class="tocify-header">
                <li class="tocify-item level-1" data-unique="introduction">
                    <a href="#introduction">Introduction</a>
                </li>
                            </ul>
                    <ul id="tocify-header-authenticating-requests" class="tocify-header">
                <li class="tocify-item level-1" data-unique="authenticating-requests">
                    <a href="#authenticating-requests">Authenticating requests</a>
                </li>
                            </ul>
                    <ul id="tocify-header-endpoints" class="tocify-header">
                <li class="tocify-item level-1" data-unique="endpoints">
                    <a href="#endpoints">Endpoints</a>
                </li>
                                    <ul id="tocify-subheader-endpoints" class="tocify-subheader">
                                                    <li class="tocify-item level-2" data-unique="endpoints-GETapi-versions">
                                <a href="#endpoints-GETapi-versions">GET api/versions</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-GETapi-tools">
                                <a href="#endpoints-GETapi-tools">GET api/tools</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-GETapi-tools--slug-">
                                <a href="#endpoints-GETapi-tools--slug-">GET api/tools/{slug}</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-GETapi-tools--slug--versions">
                                <a href="#endpoints-GETapi-tools--slug--versions">GET api/tools/{slug}/versions</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-GETapi-tools--slug--versions--version-">
                                <a href="#endpoints-GETapi-tools--slug--versions--version-">GET api/tools/{slug}/versions/{version}</a>
                            </li>
                                                                        </ul>
                            </ul>
            </div>

    <ul class="toc-footer" id="toc-footer">
                    <li style="padding-bottom: 5px;"><a href="{{ route("scribe.postman") }}">View Postman collection</a></li>
                            <li style="padding-bottom: 5px;"><a href="{{ route("scribe.openapi") }}">View OpenAPI spec</a></li>
                <li><a href="http://github.com/knuckleswtf/scribe">Documentation powered by Scribe ✍</a></li>
    </ul>

    <ul class="toc-footer" id="last-updated">
        <li>Last updated: November 2, 2025</li>
    </ul>
</div>

<div class="page-wrapper">
    <div class="dark-box"></div>
    <div class="content">
        <h1 id="introduction">Introduction</h1>
<p>Documentation for the public API of AI IDEs and their versions</p>
<aside>
    <strong>Base URL</strong>: <code>https://ai-ide-api.on-forge.com/</code>
</aside>
<pre><code>This documentation aims to provide all the information you need to work with our API.

&lt;aside&gt;As you scroll, you'll see code examples for working with the API in different programming languages in the dark area to the right (or as part of the content on mobile).
You can switch the language used with the tabs at the top right (or from the nav menu at the top left on mobile).&lt;/aside&gt;</code></pre>

        <h1 id="authenticating-requests">Authenticating requests</h1>
<p>This API is not authenticated.</p>

        <h1 id="endpoints">Endpoints</h1>

    

                                <h2 id="endpoints-GETapi-versions">GET api/versions</h2>

<p>
</p>



<span id="example-requests-GETapi-versions">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "https://ai-ide-api.on-forge.com/api/versions" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "https://ai-ide-api.on-forge.com/api/versions"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-versions">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
x-ratelimit-limit: 60
x-ratelimit-remaining: 59
access-control-allow-origin: *
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;data&quot;: [
        {
            &quot;version&quot;: &quot;2.0.30&quot;,
            &quot;tool&quot;: &quot;Claude Code&quot;,
            &quot;release_date&quot;: &quot;2025-10-31&quot;,
            &quot;description&quot;: &quot;- Added helpful hint to run `security unlock-keychain` when encountering API key errors on macOS with locked keychain\n- Added `allowUnsandboxedCommands` sandbox setting to disable the dangerouslyDisableSandbox escape hatch at policy level\n- Added `disallowedTools` field to custom agent definitions for explicit tool blocking\n- Added prompt-based stop hooks\n- VSCode: Added respectGitIgnore configuration to include .gitignored files in file searches (defaults to true)\n- Enabled SSE MCP servers on native build\n- Deprecated output styles. Review options in `/output-style` and use --system-prompt, --append-system-prompt, CLAUDE.md, or plugins instead\n- Removed support for custom ripgrep configuration, resolving an issue where Search returns no results and config discovery fails\n- Fixed Explore agent creating unwanted .md investigation files during codebase exploration\n- Fixed a bug where `/context` would sometimes fail with \&quot;max_tokens must be greater than thinking.budget_tokens\&quot; error message\n- Fixed `--mcp-config` flag to correctly override file-based MCP configurations\n- Fixed bug that saved session permissions to local settings\n- Fixed MCP tools not being available to sub-agents\n- Fixed hooks and plugins not executing when using --dangerously-skip-permissions flag\n- Fixed delay when navigating through typeahead suggestions with arrow keys\n- VSCode: Restored selection indicator in input footer showing current file or code selection status&quot;,
            &quot;changelog_url&quot;: &quot;https://github.com/anthropics/claude-code/blob/main/CHANGELOG.md#2030&quot;
        },
        {
            &quot;version&quot;: &quot;0.53.0&quot;,
            &quot;tool&quot;: &quot;Codex CLI&quot;,
            &quot;release_date&quot;: &quot;2025-10-31&quot;,
            &quot;description&quot;: &quot;- Fixing error 400 issues\n- Improved Java sandboxing&quot;,
            &quot;changelog_url&quot;: &quot;https://developers.openai.com/codex/changelog/&quot;
        },
        {
            &quot;version&quot;: &quot;0.52.0&quot;,
            &quot;tool&quot;: &quot;Codex CLI&quot;,
            &quot;release_date&quot;: &quot;2025-10-30&quot;,
            &quot;description&quot;: &quot;- TUI polish with queued messages, Windows guidance, undo operations\n- Client-side image resizing\n- Execute commands with `!&lt;cmd&gt;`&quot;,
            &quot;changelog_url&quot;: &quot;https://developers.openai.com/codex/changelog/&quot;
        },
        {
            &quot;version&quot;: &quot;2.0&quot;,
            &quot;tool&quot;: &quot;Cursor&quot;,
            &quot;release_date&quot;: &quot;2025-10-29&quot;,
            &quot;description&quot;: &quot;New Coding Model and Agent Interface&quot;,
            &quot;changelog_url&quot;: &quot;https://cursor.com/changelog/2-0&quot;
        },
        {
            &quot;version&quot;: &quot;2.0.28&quot;,
            &quot;tool&quot;: &quot;Claude Code&quot;,
            &quot;release_date&quot;: &quot;2025-10-27&quot;,
            &quot;description&quot;: &quot;- Plan mode: introduced new Plan subagent\n- Subagents: claude can now choose to resume subagents\n- Subagents: claude can dynamically choose the model used by its subagents\n- SDK: added --max-budget-usd flag\n- Discovery of custom slash commands, subagents, and output styles no longer respects .gitignore\n- Stop `/terminal-setup` from adding backslash to `Shift + Enter` in VS Code\n- Add branch and tag support for git-based plugins and marketplaces using fragment syntax (e.g., `owner/repo#branch`)\n- Fixed a bug where macOS permission prompts would show up upon initial launch when launching from home directory\n- Various other bug fixes&quot;,
            &quot;changelog_url&quot;: &quot;https://github.com/anthropics/claude-code/blob/main/CHANGELOG.md#2028&quot;
        },
        {
            &quot;version&quot;: &quot;0.50.0&quot;,
            &quot;tool&quot;: &quot;Codex CLI&quot;,
            &quot;release_date&quot;: &quot;2025-10-25&quot;,
            &quot;description&quot;: &quot;- Improved `/feedback` command for better diagnostics and issue reporting&quot;,
            &quot;changelog_url&quot;: &quot;https://developers.openai.com/codex/changelog/&quot;
        },
        {
            &quot;version&quot;: &quot;0.49.0&quot;,
            &quot;tool&quot;: &quot;Codex CLI&quot;,
            &quot;release_date&quot;: &quot;2025-10-24&quot;,
            &quot;description&quot;: &quot;- No major changes\n- Used for homebrew upgrade script testing&quot;,
            &quot;changelog_url&quot;: &quot;https://developers.openai.com/codex/changelog/&quot;
        },
        {
            &quot;version&quot;: &quot;2.0.27&quot;,
            &quot;tool&quot;: &quot;Claude Code&quot;,
            &quot;release_date&quot;: &quot;2025-10-24&quot;,
            &quot;description&quot;: &quot;- New UI for permission prompts\n- Added current branch filtering and search to session resume screen for easier navigation\n- Fixed directory @-mention causing \&quot;No assistant message found\&quot; error\n- VSCode Extension: Add config setting to include .gitignored files in file searches\n- VSCode Extension: Bug fixes for unrelated &#039;Warmup&#039; conversations, and configuration/settings occasionally being reset to defaults&quot;,
            &quot;changelog_url&quot;: &quot;https://github.com/anthropics/claude-code/blob/main/CHANGELOG.md#2027&quot;
        },
        {
            &quot;version&quot;: &quot;0.48.0&quot;,
            &quot;tool&quot;: &quot;Codex CLI&quot;,
            &quot;release_date&quot;: &quot;2025-10-23&quot;,
            &quot;description&quot;: &quot;- Added `--add-dir` flag\n- MCP improvements with stdio servers using official SDK\n- Configurable enabled/disabled tools&quot;,
            &quot;changelog_url&quot;: &quot;https://developers.openai.com/codex/changelog/&quot;
        },
        {
            &quot;version&quot;: &quot;2.0.25&quot;,
            &quot;tool&quot;: &quot;Claude Code&quot;,
            &quot;release_date&quot;: &quot;2025-10-22&quot;,
            &quot;description&quot;: &quot;- Removed legacy SDK entrypoint. Please migrate to @anthropic-ai/claude-agent-sdk for future SDK updates: https://docs.claude.com/en/docs/claude-code/sdk/migration-guide&quot;,
            &quot;changelog_url&quot;: &quot;https://github.com/anthropics/claude-code/blob/main/CHANGELOG.md#2025&quot;
        }
    ]
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-versions" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-versions"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-versions"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-versions" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-versions">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-versions" data-method="GET"
      data-path="api/versions"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-versions', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-versions"
                    onclick="tryItOut('GETapi-versions');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-versions"
                    onclick="cancelTryOut('GETapi-versions');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-versions"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/versions</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-versions"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-versions"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>slug</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="slug"                data-endpoint="GETapi-versions"
               value="cursor"
               data-component="url">
    <br>
<p>optional Slug of the tool. Example: <code>cursor</code></p>
            </div>
                    </form>

                    <h2 id="endpoints-GETapi-tools">GET api/tools</h2>

<p>
</p>



<span id="example-requests-GETapi-tools">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "https://ai-ide-api.on-forge.com/api/tools" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "https://ai-ide-api.on-forge.com/api/tools"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-tools">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
x-ratelimit-limit: 60
x-ratelimit-remaining: 59
access-control-allow-origin: *
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;data&quot;: [
        {
            &quot;name&quot;: &quot;Claude Code&quot;,
            &quot;slug&quot;: &quot;claude-code&quot;,
            &quot;category&quot;: &quot;CLI&quot;,
            &quot;website_url&quot;: &quot;https://www.claude.com/product/claude-code&quot;,
            &quot;short_description&quot;: &quot;&quot;,
            &quot;vendor&quot;: {
                &quot;name&quot;: &quot;Anthropic&quot;
            },
            &quot;versions&quot;: [
                {
                    &quot;version&quot;: &quot;2.0.30&quot;,
                    &quot;tool&quot;: &quot;Claude Code&quot;,
                    &quot;release_date&quot;: &quot;2025-10-31&quot;,
                    &quot;description&quot;: &quot;- Added helpful hint to run `security unlock-keychain` when encountering API key errors on macOS with locked keychain\n- Added `allowUnsandboxedCommands` sandbox setting to disable the dangerouslyDisableSandbox escape hatch at policy level\n- Added `disallowedTools` field to custom agent definitions for explicit tool blocking\n- Added prompt-based stop hooks\n- VSCode: Added respectGitIgnore configuration to include .gitignored files in file searches (defaults to true)\n- Enabled SSE MCP servers on native build\n- Deprecated output styles. Review options in `/output-style` and use --system-prompt, --append-system-prompt, CLAUDE.md, or plugins instead\n- Removed support for custom ripgrep configuration, resolving an issue where Search returns no results and config discovery fails\n- Fixed Explore agent creating unwanted .md investigation files during codebase exploration\n- Fixed a bug where `/context` would sometimes fail with \&quot;max_tokens must be greater than thinking.budget_tokens\&quot; error message\n- Fixed `--mcp-config` flag to correctly override file-based MCP configurations\n- Fixed bug that saved session permissions to local settings\n- Fixed MCP tools not being available to sub-agents\n- Fixed hooks and plugins not executing when using --dangerously-skip-permissions flag\n- Fixed delay when navigating through typeahead suggestions with arrow keys\n- VSCode: Restored selection indicator in input footer showing current file or code selection status&quot;,
                    &quot;changelog_url&quot;: &quot;https://github.com/anthropics/claude-code/blob/main/CHANGELOG.md#2030&quot;
                },
                {
                    &quot;version&quot;: &quot;2.0.28&quot;,
                    &quot;tool&quot;: &quot;Claude Code&quot;,
                    &quot;release_date&quot;: &quot;2025-10-27&quot;,
                    &quot;description&quot;: &quot;- Plan mode: introduced new Plan subagent\n- Subagents: claude can now choose to resume subagents\n- Subagents: claude can dynamically choose the model used by its subagents\n- SDK: added --max-budget-usd flag\n- Discovery of custom slash commands, subagents, and output styles no longer respects .gitignore\n- Stop `/terminal-setup` from adding backslash to `Shift + Enter` in VS Code\n- Add branch and tag support for git-based plugins and marketplaces using fragment syntax (e.g., `owner/repo#branch`)\n- Fixed a bug where macOS permission prompts would show up upon initial launch when launching from home directory\n- Various other bug fixes&quot;,
                    &quot;changelog_url&quot;: &quot;https://github.com/anthropics/claude-code/blob/main/CHANGELOG.md#2028&quot;
                },
                {
                    &quot;version&quot;: &quot;2.0.27&quot;,
                    &quot;tool&quot;: &quot;Claude Code&quot;,
                    &quot;release_date&quot;: &quot;2025-10-24&quot;,
                    &quot;description&quot;: &quot;- New UI for permission prompts\n- Added current branch filtering and search to session resume screen for easier navigation\n- Fixed directory @-mention causing \&quot;No assistant message found\&quot; error\n- VSCode Extension: Add config setting to include .gitignored files in file searches\n- VSCode Extension: Bug fixes for unrelated &#039;Warmup&#039; conversations, and configuration/settings occasionally being reset to defaults&quot;,
                    &quot;changelog_url&quot;: &quot;https://github.com/anthropics/claude-code/blob/main/CHANGELOG.md#2027&quot;
                },
                {
                    &quot;version&quot;: &quot;2.0.25&quot;,
                    &quot;tool&quot;: &quot;Claude Code&quot;,
                    &quot;release_date&quot;: &quot;2025-10-22&quot;,
                    &quot;description&quot;: &quot;- Removed legacy SDK entrypoint. Please migrate to @anthropic-ai/claude-agent-sdk for future SDK updates: https://docs.claude.com/en/docs/claude-code/sdk/migration-guide&quot;,
                    &quot;changelog_url&quot;: &quot;https://github.com/anthropics/claude-code/blob/main/CHANGELOG.md#2025&quot;
                },
                {
                    &quot;version&quot;: &quot;2.0.24&quot;,
                    &quot;tool&quot;: &quot;Claude Code&quot;,
                    &quot;release_date&quot;: &quot;2025-10-21&quot;,
                    &quot;description&quot;: &quot;- Fixed a bug where project-level skills were not loading when --setting-sources &#039;project&#039; was specified\n- Claude Code Web: Support for Web -&gt; CLI teleport\n- Sandbox: Releasing a sandbox mode for the BashTool on Linux &amp; Mac\n- Bedrock: Display awsAuthRefresh output when auth is required&quot;,
                    &quot;changelog_url&quot;: &quot;https://github.com/anthropics/claude-code/blob/main/CHANGELOG.md#2024&quot;
                }
            ]
        },
        {
            &quot;name&quot;: &quot;Codex CLI&quot;,
            &quot;slug&quot;: &quot;codex-cli&quot;,
            &quot;category&quot;: &quot;CLI&quot;,
            &quot;website_url&quot;: &quot;https://developers.openai.com/codex/cli/&quot;,
            &quot;short_description&quot;: &quot;&quot;,
            &quot;vendor&quot;: {
                &quot;name&quot;: &quot;OpenAI&quot;
            },
            &quot;versions&quot;: [
                {
                    &quot;version&quot;: &quot;0.53.0&quot;,
                    &quot;tool&quot;: &quot;Codex CLI&quot;,
                    &quot;release_date&quot;: &quot;2025-10-31&quot;,
                    &quot;description&quot;: &quot;- Fixing error 400 issues\n- Improved Java sandboxing&quot;,
                    &quot;changelog_url&quot;: &quot;https://developers.openai.com/codex/changelog/&quot;
                },
                {
                    &quot;version&quot;: &quot;0.52.0&quot;,
                    &quot;tool&quot;: &quot;Codex CLI&quot;,
                    &quot;release_date&quot;: &quot;2025-10-30&quot;,
                    &quot;description&quot;: &quot;- TUI polish with queued messages, Windows guidance, undo operations\n- Client-side image resizing\n- Execute commands with `!&lt;cmd&gt;`&quot;,
                    &quot;changelog_url&quot;: &quot;https://developers.openai.com/codex/changelog/&quot;
                },
                {
                    &quot;version&quot;: &quot;0.50.0&quot;,
                    &quot;tool&quot;: &quot;Codex CLI&quot;,
                    &quot;release_date&quot;: &quot;2025-10-25&quot;,
                    &quot;description&quot;: &quot;- Improved `/feedback` command for better diagnostics and issue reporting&quot;,
                    &quot;changelog_url&quot;: &quot;https://developers.openai.com/codex/changelog/&quot;
                },
                {
                    &quot;version&quot;: &quot;0.49.0&quot;,
                    &quot;tool&quot;: &quot;Codex CLI&quot;,
                    &quot;release_date&quot;: &quot;2025-10-24&quot;,
                    &quot;description&quot;: &quot;- No major changes\n- Used for homebrew upgrade script testing&quot;,
                    &quot;changelog_url&quot;: &quot;https://developers.openai.com/codex/changelog/&quot;
                },
                {
                    &quot;version&quot;: &quot;0.48.0&quot;,
                    &quot;tool&quot;: &quot;Codex CLI&quot;,
                    &quot;release_date&quot;: &quot;2025-10-23&quot;,
                    &quot;description&quot;: &quot;- Added `--add-dir` flag\n- MCP improvements with stdio servers using official SDK\n- Configurable enabled/disabled tools&quot;,
                    &quot;changelog_url&quot;: &quot;https://developers.openai.com/codex/changelog/&quot;
                }
            ]
        },
        {
            &quot;name&quot;: &quot;Cursor&quot;,
            &quot;slug&quot;: &quot;cursor&quot;,
            &quot;category&quot;: &quot;IDE&quot;,
            &quot;website_url&quot;: &quot;https://cursor.com&quot;,
            &quot;short_description&quot;: &quot;&quot;,
            &quot;vendor&quot;: {
                &quot;name&quot;: &quot;Cursor&quot;
            },
            &quot;versions&quot;: [
                {
                    &quot;version&quot;: &quot;2.0&quot;,
                    &quot;tool&quot;: &quot;Cursor&quot;,
                    &quot;release_date&quot;: &quot;2025-10-29&quot;,
                    &quot;description&quot;: &quot;New Coding Model and Agent Interface&quot;,
                    &quot;changelog_url&quot;: &quot;https://cursor.com/changelog/2-0&quot;
                },
                {
                    &quot;version&quot;: &quot;1.7&quot;,
                    &quot;tool&quot;: &quot;Cursor&quot;,
                    &quot;release_date&quot;: &quot;2025-09-29&quot;,
                    &quot;description&quot;: &quot;Browser Controls, Plan Mode, and Hooks&quot;,
                    &quot;changelog_url&quot;: &quot;https://cursor.com/changelog/1-7&quot;
                },
                {
                    &quot;version&quot;: &quot;1.6&quot;,
                    &quot;tool&quot;: &quot;Cursor&quot;,
                    &quot;release_date&quot;: &quot;2025-09-12&quot;,
                    &quot;description&quot;: &quot;Slash commands, summarization, and improved Agent terminal&quot;,
                    &quot;changelog_url&quot;: &quot;https://cursor.com/changelog/1-6&quot;
                },
                {
                    &quot;version&quot;: &quot;1.5&quot;,
                    &quot;tool&quot;: &quot;Cursor&quot;,
                    &quot;release_date&quot;: &quot;2025-08-21&quot;,
                    &quot;description&quot;: &quot;Linear integration, improved Agent terminal, and OS notifications&quot;,
                    &quot;changelog_url&quot;: &quot;https://cursor.com/changelog/1-5&quot;
                }
            ]
        }
    ]
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-tools" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-tools"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-tools"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-tools" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-tools">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-tools" data-method="GET"
      data-path="api/tools"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-tools', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-tools"
                    onclick="tryItOut('GETapi-tools');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-tools"
                    onclick="cancelTryOut('GETapi-tools');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-tools"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/tools</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-tools"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-tools"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        </form>

                    <h2 id="endpoints-GETapi-tools--slug-">GET api/tools/{slug}</h2>

<p>
</p>



<span id="example-requests-GETapi-tools--slug-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "https://ai-ide-api.on-forge.com/api/tools/cursor" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "https://ai-ide-api.on-forge.com/api/tools/cursor"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-tools--slug-">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
x-ratelimit-limit: 60
x-ratelimit-remaining: 59
access-control-allow-origin: *
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;data&quot;: {
        &quot;name&quot;: &quot;Cursor&quot;,
        &quot;slug&quot;: &quot;cursor&quot;,
        &quot;category&quot;: &quot;IDE&quot;,
        &quot;website_url&quot;: &quot;https://cursor.com&quot;,
        &quot;short_description&quot;: &quot;&quot;,
        &quot;vendor&quot;: {
            &quot;name&quot;: &quot;Cursor&quot;
        }
    }
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-tools--slug-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-tools--slug-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-tools--slug-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-tools--slug-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-tools--slug-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-tools--slug-" data-method="GET"
      data-path="api/tools/{slug}"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-tools--slug-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-tools--slug-"
                    onclick="tryItOut('GETapi-tools--slug-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-tools--slug-"
                    onclick="cancelTryOut('GETapi-tools--slug-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-tools--slug-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/tools/{slug}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-tools--slug-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-tools--slug-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>slug</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="slug"                data-endpoint="GETapi-tools--slug-"
               value="cursor"
               data-component="url">
    <br>
<p>Slug of the tool. Example: <code>cursor</code></p>
            </div>
                    </form>

                    <h2 id="endpoints-GETapi-tools--slug--versions">GET api/tools/{slug}/versions</h2>

<p>
</p>



<span id="example-requests-GETapi-tools--slug--versions">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "https://ai-ide-api.on-forge.com/api/tools/cursor/versions" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "https://ai-ide-api.on-forge.com/api/tools/cursor/versions"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-tools--slug--versions">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
x-ratelimit-limit: 60
x-ratelimit-remaining: 59
access-control-allow-origin: *
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;data&quot;: [
        {
            &quot;version&quot;: &quot;2.0&quot;,
            &quot;tool&quot;: &quot;Cursor&quot;,
            &quot;release_date&quot;: &quot;2025-10-29&quot;,
            &quot;description&quot;: &quot;New Coding Model and Agent Interface&quot;,
            &quot;changelog_url&quot;: &quot;https://cursor.com/changelog/2-0&quot;
        },
        {
            &quot;version&quot;: &quot;1.7&quot;,
            &quot;tool&quot;: &quot;Cursor&quot;,
            &quot;release_date&quot;: &quot;2025-09-29&quot;,
            &quot;description&quot;: &quot;Browser Controls, Plan Mode, and Hooks&quot;,
            &quot;changelog_url&quot;: &quot;https://cursor.com/changelog/1-7&quot;
        },
        {
            &quot;version&quot;: &quot;1.6&quot;,
            &quot;tool&quot;: &quot;Cursor&quot;,
            &quot;release_date&quot;: &quot;2025-09-12&quot;,
            &quot;description&quot;: &quot;Slash commands, summarization, and improved Agent terminal&quot;,
            &quot;changelog_url&quot;: &quot;https://cursor.com/changelog/1-6&quot;
        },
        {
            &quot;version&quot;: &quot;1.5&quot;,
            &quot;tool&quot;: &quot;Cursor&quot;,
            &quot;release_date&quot;: &quot;2025-08-21&quot;,
            &quot;description&quot;: &quot;Linear integration, improved Agent terminal, and OS notifications&quot;,
            &quot;changelog_url&quot;: &quot;https://cursor.com/changelog/1-5&quot;
        }
    ]
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-tools--slug--versions" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-tools--slug--versions"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-tools--slug--versions"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-tools--slug--versions" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-tools--slug--versions">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-tools--slug--versions" data-method="GET"
      data-path="api/tools/{slug}/versions"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-tools--slug--versions', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-tools--slug--versions"
                    onclick="tryItOut('GETapi-tools--slug--versions');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-tools--slug--versions"
                    onclick="cancelTryOut('GETapi-tools--slug--versions');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-tools--slug--versions"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/tools/{slug}/versions</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-tools--slug--versions"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-tools--slug--versions"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>slug</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="slug"                data-endpoint="GETapi-tools--slug--versions"
               value="cursor"
               data-component="url">
    <br>
<p>optional Slug of the tool. Example: <code>cursor</code></p>
            </div>
                    </form>

                    <h2 id="endpoints-GETapi-tools--slug--versions--version-">GET api/tools/{slug}/versions/{version}</h2>

<p>
</p>



<span id="example-requests-GETapi-tools--slug--versions--version-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "https://ai-ide-api.on-forge.com/api/tools/cursor/versions/2.0" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "https://ai-ide-api.on-forge.com/api/tools/cursor/versions/2.0"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-tools--slug--versions--version-">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
x-ratelimit-limit: 60
x-ratelimit-remaining: 59
access-control-allow-origin: *
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;data&quot;: {
        &quot;version&quot;: &quot;2.0&quot;,
        &quot;tool&quot;: &quot;Cursor&quot;,
        &quot;release_date&quot;: &quot;2025-10-29&quot;,
        &quot;description&quot;: &quot;New Coding Model and Agent Interface&quot;,
        &quot;changelog_url&quot;: &quot;https://cursor.com/changelog/2-0&quot;
    }
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-tools--slug--versions--version-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-tools--slug--versions--version-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-tools--slug--versions--version-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-tools--slug--versions--version-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-tools--slug--versions--version-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-tools--slug--versions--version-" data-method="GET"
      data-path="api/tools/{slug}/versions/{version}"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-tools--slug--versions--version-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-tools--slug--versions--version-"
                    onclick="tryItOut('GETapi-tools--slug--versions--version-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-tools--slug--versions--version-"
                    onclick="cancelTryOut('GETapi-tools--slug--versions--version-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-tools--slug--versions--version-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/tools/{slug}/versions/{version}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-tools--slug--versions--version-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-tools--slug--versions--version-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>slug</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="slug"                data-endpoint="GETapi-tools--slug--versions--version-"
               value="cursor"
               data-component="url">
    <br>
<p>Slug of the tool. Example: <code>cursor</code></p>
            </div>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>version</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="version"                data-endpoint="GETapi-tools--slug--versions--version-"
               value="2.0"
               data-component="url">
    <br>
<p>Version number. Example: <code>2.0</code></p>
            </div>
                    </form>

            

        
    </div>
    <div class="dark-box">
                    <div class="lang-selector">
                                                        <button type="button" class="lang-button" data-language-name="bash">bash</button>
                                                        <button type="button" class="lang-button" data-language-name="javascript">javascript</button>
                            </div>
            </div>
</div>
</body>
</html>

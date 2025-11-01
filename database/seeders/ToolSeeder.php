<?php

namespace Database\Seeders;

use App\Models\Tool;
use App\Models\Vendor;
use App\Models\Version;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ToolSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $vendorCursor = Vendor::create(['name' => 'Cursor']);
        $vendorAnthropic = Vendor::create(['name' => 'Anthropic']);
        $vendorOpenAI = Vendor::create(['name' => 'OpenAI']);

        $toolCursor = Tool::create([
            'vendor_id' => $vendorCursor->id,
            'name' => 'Cursor',
            'slug' => 'cursor',
            'category' => 'IDE',
            'website_url' => 'https://cursor.com',
            'short_description' => '',
        ]);

        $toolClaudeCode = Tool::create([
            'vendor_id' => $vendorAnthropic->id,
            'name' => 'Claude Code',
            'slug' => 'claude-code',
            'category' => 'CLI',
            'website_url' => 'https://www.claude.com/product/claude-code',
            'short_description' => '',
        ]);

        $toolCodexCLI = Tool::create([
            'vendor_id' => $vendorOpenAI->id,
            'name' => 'Codex CLI',
            'slug' => 'codex-cli',
            'category' => 'CLI',
            'website_url' => 'https://developers.openai.com/codex/cli/',
            'short_description' => '',
        ]);
    }
}

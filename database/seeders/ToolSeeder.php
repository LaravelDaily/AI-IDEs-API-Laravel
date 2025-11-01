<?php

namespace Database\Seeders;

use App\Models\PricingPlan;
use App\Models\Tool;
use App\Models\Vendor;
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
        PricingPlan::create([
            'tool_id' => $toolCursor->id,
            'name' => 'Pro',
            'billing_period' => 'monthly',
            'currency' => 'USD',
            'price' => 20,
            'last_updated_date' => '2025-11-01',
            'features' => 'Extended limits on Agent
Unlimited Tab completions
Background Agents
Maximum context windows',
        ]);

        $toolClaudeCode = Tool::create([
            'vendor_id' => $vendorAnthropic->id,
            'name' => 'Claude Code',
            'slug' => 'claude-code',
            'category' => 'CLI',
            'website_url' => 'https://www.claude.com/product/claude-code',
            'short_description' => '',
        ]);
        PricingPlan::create([
            'tool_id' => $toolClaudeCode->id,
            'name' => 'Anthropic Pro',
            'billing_period' => 'monthly',
            'currency' => 'USD',
            'price' => 20,
            'last_updated_date' => '2025-11-01',
            'features' => 'Access Claude Code on the web and in your terminal',
        ]);

        $toolCodexCLI = Tool::create([
            'vendor_id' => $vendorOpenAI->id,
            'name' => 'Codex CLI',
            'slug' => 'codex-cli',
            'category' => 'CLI',
            'website_url' => 'https://developers.openai.com/codex/cli/',
            'short_description' => '',
        ]);
        PricingPlan::create([
            'tool_id' => $toolCodexCLI->id,
            'name' => 'ChatGPT Plus',
            'billing_period' => 'monthly',
            'currency' => 'USD',
            'price' => 25,
            'last_updated_date' => '2025-11-01',
            'features' => 'Access Codex CLI on the web and in your terminal',
        ]);
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(ToolSeeder::class);
        $this->call(ClaudeCodeVersionSeeder::class);
        $this->call(CodexCLIVersionSeeder::class);
        $this->call(CursorVersionSeeder::class);
    }
}

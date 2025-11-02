<?php

namespace App\Filament\Resources\Versions\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class VersionForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('tool_id')
                    ->relationship('tool', 'name')
                    ->required(),
                TextInput::make('version')
                    ->required(),
                DatePicker::make('release_date')
                    ->required(),
                Textarea::make('description')
                    ->columnSpanFull(),
                TextInput::make('changelog_url')
                    ->url(),
                TextInput::make('download_url')
                    ->url(),
            ]);
    }
}

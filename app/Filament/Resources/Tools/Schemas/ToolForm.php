<?php

namespace App\Filament\Resources\Tools\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class ToolForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('vendor_id')
                    ->relationship('vendor', 'name'),
                TextInput::make('name')
                    ->required(),
                TextInput::make('slug')
                    ->required(),
                Select::make('category')
                    ->options(['IDE' => 'I d e', 'Editor' => 'Editor', 'CLI' => 'C l i', 'Plugin' => 'Plugin'])
                    ->required(),
                TextInput::make('website_url')
                    ->url(),
                TextInput::make('short_description'),
            ]);
    }
}

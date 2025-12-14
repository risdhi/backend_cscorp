<?php

namespace App\Filament\Resources\Structurals\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class StructuralForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('nama')
                    ->required(),
                TextInput::make('jabatan')
                    ->required(),
                TextInput::make('caption')
                    ->required()
                    ->columnSpan('2'),
                FileUpload::make('image')
                    ->image()
                    ->required()
                    ->columnSpan('2')
                    ->imageEditor()
                    ->downloadable(),
            ]);
    }
}

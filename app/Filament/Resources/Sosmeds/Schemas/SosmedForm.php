<?php

namespace App\Filament\Resources\Sosmeds\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\FileUpload;

use Filament\Schemas\Schema;

class SosmedForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('nama_sosmed')
                    ->required()
                    ->maxLength(255)
                    ->columnSpan(1),
                TextInput::make('username')
                    ->required()
                    ->maxLength(255)
                    ->columnSpan(1),
                FileUpload::make('icon')
                    ->required()
                    ->columnSpanFull()
                    ->imageEditor()
                    ->downloadable(),
            ]);
    }
}

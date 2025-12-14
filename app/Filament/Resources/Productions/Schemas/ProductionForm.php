<?php

namespace App\Filament\Resources\Productions\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\FileUpload;

class ProductionForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('judul')
                    ->required(),
                TextInput::make('deskripsi')
                    ->required(),
                DatePicker::make('tanggal')
                    ->required(),
                TextInput::make('client')
                    ->required(),
                Repeater::make('images')
                    ->relationship()
                    ->schema([
                        FileUpload::make('image')
                            ->required()
                            ->image()
                            ->directory('productions')
                            ->imageEditor()
                            ->downloadable(),
                    ])
                    ->columns(1)
                    ->columnSpanFull()
                    ->grid(2),
            ]);
    }
}

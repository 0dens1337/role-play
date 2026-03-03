<?php

namespace App\Filament\Resources\Npcs\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class NpcForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Основная информация')
                    ->columns(2)
                    ->components([
                        TextInput::make('name')
                            ->label('Имя')
                            ->required(),

                        TextInput::make('title')
                            ->label('Название')
                            ->required(),

                        RichEditor::make('description')
                            ->label('Описание')
                            ->required()
                            ->columnSpanFull(),

                        FileUpload::make('image')
                            ->label('Изображение')
                            ->image()
                            ->directory('npc')
                            ->imageEditor()
                            ->nullable()
                            ->disk('public'),
                    ])

            ]);
    }
}

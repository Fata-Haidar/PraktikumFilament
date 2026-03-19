<?php

namespace App\Filament\Resources\Users\Schemas;

use Filament\Schemas\Schema;
use Filament\Forms\Components\TextInput;

class UserForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->required()
                    ->maxLength(55),
                TextInput::make('email')
                    ->email()
                    ->required()
                    ->unique()
                    ->maxLength(55),
                TextInput::make('password')
                    ->password()
                    ->required()
                    ->minLength(6),
            ]);
    }
}

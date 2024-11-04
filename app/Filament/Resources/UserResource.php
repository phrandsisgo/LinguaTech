<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Filament\Resources\UserResource\RelationManagers;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Hash;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
        ->schema([
            Forms\Components\TextInput::make('name')
                ->required()
                ->maxLength(255),
            Forms\Components\TextInput::make('email')
                ->email()
                ->required()
                ->maxLength(255),
            Forms\Components\TextInput::make('password')
                ->password()
                ->maxLength(255)
                ->dehydrateStateUsing(fn ($state) => !empty($state) ? Hash::make($state) : null)
                ->required(fn ($livewire) => $livewire instanceof Pages\CreateUser) // Passwort nur beim Erstellen erforderlich
                ->dehydrated(fn ($state) => !empty($state)), // Nur speichern, wenn ein Wert eingegeben wurde
            Forms\Components\DateTimePicker::make('email_verified_at')
                ->required()
                ->format('Y-m-d H:i:s')
                ->nullable(),
            Forms\Components\DateTimePicker::make('subscribed_until')
                ->required()
                ->format('Y-m-d H:i:s')
                ->nullable(),
            // Weitere Felder nach Bedarf...
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')->sortable(),
                Tables\Columns\TextColumn::make('name')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('email')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('created_at')->dateTime()->sortable(),
                Tables\Columns\TextColumn::make('updated_at')->dateTime()->sortable(),
                Tables\Columns\TextColumn::make('email_verified_at')->dateTime()->sortable(),
                Tables\Columns\TextColumn::make('subscribed_until')->dateTime()->sortable(),    
                // Weitere Spalten nach Bedarf...
            ])
            ->filters([
                // Filter nach Bedarf...
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }
}

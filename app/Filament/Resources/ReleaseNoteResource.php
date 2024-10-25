<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ReleaseNoteResource\Pages;
use App\Filament\Resources\ReleaseNoteResource\RelationManagers;
use App\Models\ReleaseNote;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ReleaseNoteResource extends Resource
{
    protected static ?string $model = ReleaseNote::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('title')
                    ->required()
                    ->maxLength(255),
                Forms\Components\Select::make('lang_option_id')
                    ->relationship('langOption', 'language_name')
                    ->required(),
                Forms\Components\Textarea::make('content')
                    ->required(),
                Forms\Components\Textarea::make('planned_features'),
                Forms\Components\TextInput::make('version')
                    ->maxLength(255),
                // Weitere Felder nach Bedarf...
            ]);
    
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')->sortable(),
                Tables\Columns\TextColumn::make('title')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('langOption.language_name')->label('Language')->sortable(),
                Tables\Columns\TextColumn::make('version')->sortable(),
                Tables\Columns\TextColumn::make('created_at')->dateTime()->sortable(),
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
            'index' => Pages\ListReleaseNotes::route('/'),
            'create' => Pages\CreateReleaseNote::route('/create'),
            'edit' => Pages\EditReleaseNote::route('/{record}/edit'),
        ];
    }
}

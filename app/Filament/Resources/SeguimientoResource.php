<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SeguimientoResource\Pages;
use App\Filament\Resources\SeguimientoResource\RelationManagers;
use App\Models\Seguimiento;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\RichEditor;
use Filament\Tables\Columns\ImageColumn;

class SeguimientoResource extends Resource
{
    protected static ?string $model = Seguimiento::class;

    protected static ?string $navigationIcon = 'heroicon-o-arrow-top-right-on-square';
    protected static ?int $navigationSort = 101;
    protected static ?string $navigationGroup = 'Proyectos';

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\RichEditor::make('observations')
                    ->required()
                    ->label('Observaciones')
                    ->maxLength(255),
                Forms\Components\TextInput::make('responsable')
                    ->required()
                    ->label('Responsable')
                    ->maxLength(255),
                Forms\Components\FileUpload::make('images')
                    ->columns(1)
                    ->multiple()
                    ->label('Imágenes')
                    ->directory('seguimientos')
                    ->preserveFilenames(),
                Forms\Components\Select::make('proyecto_id')
                    ->label('Nombre Proyecto')
                    ->relationship('proyecto', 'name')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('observations')
                    ->label('Observaciones')
                    ->searchable(),
                Tables\Columns\TextColumn::make('responsable')
                    ->label('Responsables')
                    ->searchable(),
                Tables\Columns\ImageColumn::make('images')
                    ->circular()
                    ->label('Imágenes')
                    ->searchable(),
                Tables\Columns\TextColumn::make('proyecto.name')
                    ->label('Nombre Proyectos')
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageSeguimientos::route('/'),
        ];
    }
}

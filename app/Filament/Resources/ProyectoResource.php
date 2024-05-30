<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProyectoResource\Pages;
use App\Filament\Resources\ProyectoResource\RelationManagers;
use App\Models\Proyecto;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;

class ProyectoResource extends Resource
{
    protected static ?string $model = Proyecto::class;

    protected static ?string $navigationIcon = 'heroicon-o-cog-8-tooth';
    protected static ?int $navigationSort = 100;
    protected static ?string $navigationGroup = 'Proyectos';

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->label('Nombre')
                    ->maxLength(255),
                Forms\Components\TextInput::make('motivo')
                    ->required()
                    ->label('Motivo')
                    ->maxLength(255),
                Forms\Components\RichEditor::make('observations')
                    ->required()
                    ->label('Observaciones')
                    ->columnSpanFull(),
                Forms\Components\TextInput::make('plandetrabajo')
                    ->required()
                    ->label('Plan de Trabajo')
                    ->maxLength(255),
                Forms\Components\Select::make('beneficiario_id')
                    ->multiple()
                    ->label('Beneficiarios')
                    ->relationship('beneficiario', 'name'),
                Forms\Components\Select::make('profesionales')
                    ->multiple()
                    ->label('Profesionales')
                    ->relationship('profesionales', 'name'),
                Forms\Components\Select::make('estado_proyecto_id')
                    ->label('Estado Proyectos')
                    ->relationship('estadoProyecto', 'name')
                    ->required(),
                Forms\Components\Select::make('producto_id')
                    ->label('Producto')
                    ->relationship('producto', 'name')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('Nombre')
                    ->searchable(),
                Tables\Columns\TextColumn::make('motivo')
                    ->label('Motivo')
                    ->searchable(),
                Tables\Columns\TextColumn::make('plandetrabajo')
                    ->label('Plan de Trabajo')
                    ->searchable(),
                Tables\Columns\TextColumn::make('beneficiario.name')
                    ->numeric()
                    ->label('Beneficiario')
                    ->sortable(),
                Tables\Columns\TextColumn::make('profesionales.name')
                    ->numeric()
                    ->label('Profesionales')
                    ->sortable(),
                Tables\Columns\TextColumn::make('estadoProyecto.name')
                    ->numeric()
                    ->label('Estado')
                    ->sortable(),
                Tables\Columns\TextColumn::make('producto.name')
                    ->numeric()
                    ->label('Producto')
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
            'index' => Pages\ManageProyectos::route('/'),
        ];
    }
}

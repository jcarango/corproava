<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CountryResource\Pages;
use App\Filament\Resources\CountryResource\RelationManagers;
use App\Models\Country;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class CountryResource extends Resource
{
    protected static ?string $model = Country::class;
    protected static ?int $navigationSort = 150;
    protected static ?string $navigationIcon = 'heroicon-o-globe-americas';
    protected static ?string $navigationGroup = 'System Manager';
    protected static ?string $label ='Países';
    
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
                    ->label('País')
                    ->maxLength(100),
                Forms\Components\TextInput::make('iso2')
                    ->required()
                    ->maxLength(2),
                Forms\Components\TextInput::make('iso3')
                    ->required()
                    ->maxLength(3),
                Forms\Components\TextInput::make('numeric_code')
                    ->label('Código Numérico')
                    ->maxLength(3),
                Forms\Components\TextInput::make('phonecode')
                    ->tel()
                    ->label('Código Telefónico')
                    ->maxLength(255),
                Forms\Components\TextInput::make('capital')
                    ->label('Capital')
                    ->maxLength(255),
                Forms\Components\TextInput::make('currency')
                    ->label('Divisa')
                    ->maxLength(255),
                Forms\Components\TextInput::make('currency_name')
                    ->label('Nombre Divisa')
                    ->maxLength(255),
                Forms\Components\TextInput::make('currency_symbol')
                    ->label('Simbolo Divisa')
                    ->maxLength(255),
                Forms\Components\TextInput::make('tld')
                    ->maxLength(255),
                Forms\Components\TextInput::make('native')
                    ->label('Nativo')
                    ->maxLength(255),
                Forms\Components\TextInput::make('region')
                    ->label('Región')
                    ->maxLength(255),
                Forms\Components\TextInput::make('subregion')
                    ->label('Sub-Región')
                    ->maxLength(255),
                Forms\Components\Textarea::make('timezones')
                    ->label('Zona')
                    ->columnSpanFull(),
                Forms\Components\Textarea::make('translations')
                    ->label('Traducción')
                    ->columnSpanFull(),
                Forms\Components\TextInput::make('latitude')
                    ->label('Latitude')
                    ->numeric(),
                Forms\Components\TextInput::make('longitude')
                    ->label('Longitude')
                    ->numeric(),
                Forms\Components\TextInput::make('emoji')
                    ->maxLength(191),
                Forms\Components\TextInput::make('emojiU')
                    ->maxLength(191),
                Forms\Components\Toggle::make('flag')
                    ->label('Bandera')
                    ->required(),
                Forms\Components\Toggle::make('is_active')
                    ->label('¿Es Activa?')
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
                Tables\Columns\TextColumn::make('iso2')
                    ->searchable(),
                Tables\Columns\TextColumn::make('iso3')
                    ->searchable(),
                Tables\Columns\TextColumn::make('numeric_code')
                    ->label('Código Numérico')
                    ->searchable(),
                Tables\Columns\TextColumn::make('phonecode')
                    ->label('Código Numérico')
                    ->searchable(),
                Tables\Columns\TextColumn::make('capital')
                    ->label('Capital')
                    ->searchable(),
                Tables\Columns\TextColumn::make('currency')
                    ->label('Divisa')
                    ->searchable(),
                Tables\Columns\TextColumn::make('currency_name')
                    ->label('Nombre Divisa')
                    ->searchable(),
                Tables\Columns\TextColumn::make('currency_symbol')
                    ->label('Simbolo Divisa')
                    ->searchable(),
                Tables\Columns\TextColumn::make('tld')
                    ->searchable(),
                Tables\Columns\TextColumn::make('native')
                    ->label('Nativa')
                    ->searchable(),
                Tables\Columns\TextColumn::make('region')
                    ->label('Región')
                    ->searchable(),
                Tables\Columns\TextColumn::make('subregion')
                    ->label('Sub-Región')
                    ->searchable(),
                Tables\Columns\TextColumn::make('latitude')
                    ->numeric()
                    ->label('Latitud')
                    ->sortable(),
                Tables\Columns\TextColumn::make('longitude')
                    ->numeric()
                    ->label('Longitud')
                    ->sortable(),
                Tables\Columns\TextColumn::make('emoji')
                    ->searchable(),
                Tables\Columns\TextColumn::make('emojiU')
                    ->searchable(),
                Tables\Columns\IconColumn::make('flag')
                    ->label('Bandera')
                    ->boolean(),
                Tables\Columns\IconColumn::make('is_active')
                    ->label('Activa')
                    ->boolean(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('deleted_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
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
            'index' => Pages\ListCountries::route('/'),
            'create' => Pages\CreateCountry::route('/create'),
            'edit' => Pages\EditCountry::route('/{record}/edit'),
        ];
    }
}

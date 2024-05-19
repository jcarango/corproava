<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AsociacionResource\Pages;
use App\Filament\Resources\AsociacionResource\RelationManagers;
use App\Models\Asociacion;  
use App\Models\City;
use App\Models\Country;
use App\Models\State;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\Section;
use Illuminate\Support\Collection;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Filament\Tables\Columns\ImageColumn;

class AsociacionResource extends Resource
{
    protected static ?string $model = Asociacion::class;

    protected static ?int $navigationSort = 121;
    protected static ?string $navigationIcon = 'heroicon-o-users';
    protected static ?string $navigationGroup = 'System Manager';

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Datos Asociación')
                    ->columns(4)
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->required()
                            ->label('Nombre')
                            ->maxLength(255),
                        Forms\Components\TextInput::make('contactname')
                            ->required()
                            ->label('Nombre del Contácto')
                            ->maxLength(255),
                        Forms\Components\TextInput::make('email')
                            ->email()
                            ->required()
                            ->label('Correo')
                            ->maxLength(255),
                        Forms\Components\TextInput::make('phone')
                            ->tel()
                            ->required()
                            ->label('Teléfono')
                            ->maxLength(255),
                    ]),
                Section::make('Address Info')
                    ->columns(3)
                    ->schema([
                        Forms\Components\Select::make('country_id')
                            ->relationship(name : 'country', titleAttribute:'name')
                            ->searchable()
                            ->preload()
                            ->label('País')
                            ->live()
                            ->afterStateUpdated(function (Set $set) {
                                $set('state_id',null);
                                $set('city_id',null);
                        } )
                        ->required(),
                        Forms\Components\Select::make('state_id')
                            ->options(fn (Get $get): Collection => State::query()
                                ->where('country_id', $get('country_id'))
                                ->pluck('name','id'))
                            ->searchable()
                            ->preload()
                            ->label('Departamento')
                            ->live()
                            ->afterStateUpdated(fn (Set $set) =>$set('city_id',null))
                            ->required(),
                        Forms\Components\Select::make('city_id')
                            ->options(fn (Get $get): Collection => City::query()
                                ->where('state_id', $get('state_id'))
                                ->pluck('name','id'))
                            ->searchable()
                            ->preload()
                            ->label('Ciudad')
                            ->required(),
                        Forms\Components\TextInput::make('address')
                            ->label('Dirección')
                            ->required(),
                        Forms\Components\TextInput::make('postal_code')
                            ->label('Código Postal')
                            ->maxLength(255),
                        Forms\Components\TextInput::make('vereda')
                            ->maxLength(255),
                        Forms\Components\FileUpload::make('documents')
                            ->columns(1)
                            ->multiple()
                            ->label('Documentos')
                            ->directory('asociaciones')
                            ->preserveFilenames(),
                    ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('Nombre')
                    ->searchable(),
                Tables\Columns\TextColumn::make('contactname')
                    ->label('Nombre del Contácto')
                    ->searchable(),
                Tables\Columns\TextColumn::make('email')
                    ->label('Correo')
                    ->searchable(),
                Tables\Columns\TextColumn::make('phone')
                    ->label('Teléfono')
                    ->searchable(),
                Tables\Columns\TextColumn::make('country.name')
                    ->label('País')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('state.name')
                    ->numeric()
                    ->label('Departamento')
                    ->sortable(),
                Tables\Columns\TextColumn::make('city.name')
                    ->numeric()
                    ->label('Ciudad')
                    ->sortable(),
                Tables\Columns\TextColumn::make('address')
                    ->label('Dirección')
                    ->searchable(),
                Tables\Columns\TextColumn::make('postal_code')
                    ->label('Código Postal')
                    ->searchable(),
                Tables\Columns\TextColumn::make('vereda')
                    ->searchable(),
                Tables\Columns\ImageColumn::make('documents')
                    ->circular()
                    ->label('Documentos')
                    ->searchable(),
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
            'index' => Pages\ManageAsociacions::route('/'),
        ];
    }
}

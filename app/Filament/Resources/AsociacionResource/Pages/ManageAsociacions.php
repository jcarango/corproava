<?php

namespace App\Filament\Resources\AsociacionResource\Pages;

use App\Filament\Resources\AsociacionResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageAsociacions extends ManageRecords
{
    protected static string $resource = AsociacionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}

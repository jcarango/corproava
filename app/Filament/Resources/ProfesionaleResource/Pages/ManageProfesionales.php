<?php

namespace App\Filament\Resources\ProfesionaleResource\Pages;

use App\Filament\Resources\ProfesionaleResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageProfesionales extends ManageRecords
{
    protected static string $resource = ProfesionaleResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}

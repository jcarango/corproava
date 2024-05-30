<?php

namespace App\Filament\Resources\EstadoProyectoResource\Pages;

use App\Filament\Resources\EstadoProyectoResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditEstadoProyecto extends EditRecord
{
    protected static string $resource = EstadoProyectoResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}

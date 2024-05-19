<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class EstadoProyecto extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];

    public function proyecto(): BelongsTo
    {
        return $this->belongsTo(Proyecto::class);
    }

    public function getEstadoProyectoBadgeAttribute()
    {
        // Lógica para determinar la insignia según el estado del proyecto
        // Puedes personalizar esto según tus necesidades
        switch ($this->estadoProyecto->name) {
            case 'creado':
                return 'primary';
            case '2':
                return 'success';
            default:
                return 'default';
        }
    }
}

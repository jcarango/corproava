<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Proyecto extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'motivo',
        'observations',
        'plandetrabajo',
        'beneficiario_id',
        'profesionale_id',
        'estado_proyecto_id',
        'producto_id',
    ];

    public function beneficiario(): BelongsTo
    {
        return $this->belongsTo(Beneficiario::class);
    }

    public function profesionale(): BelongsTo
    {
        return $this->belongsTo(Profesionale::class);
    }

    public function EstadoProyecto(): BelongsTo
    {
        return $this->belongsTo(EstadoProyecto::class);
    }

    public function producto(): BelongsTo
    {
        return $this->belongsTo(Producto::class);
    }
}

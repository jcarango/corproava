<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\belongsToMany;

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

    public function beneficiario()
    {
        return $this->belongsToMany(Beneficiario::class);
    }

    public function profesionales()
    {
        return $this->belongsToMany(Profesionale::class, 'profesional_proyecto', 'proyecto_id', 'profesionale_id');
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

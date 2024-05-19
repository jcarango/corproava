<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Profesionale extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'name',
        'lastname',
        'profesion',
        'email',
        'phone',
        'address',
        'city_id',
        'state_id',
        'country_id',
        'documents'
    ];

    protected $casts = [
        'documents' => 'array',
    ];

    public function proyectos()
    {
        return $this->belongsToMany(Proyecto::class);
    }

    public function country(): BelongsTo
    {
        return $this->belongsTo(Country::class);
    }

    public function state(): BelongsTo
    {
        return $this->belongsTo(State::class);
    }

    public function city(): BelongsTo
    {
        return $this->belongsTo(City::class);
    }
}

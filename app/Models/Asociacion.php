<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use BezhanSalleh\FilamentShield\Traits\HasPanelShield;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Asociacion extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'contactname',
        'email',
        'phone',
        'country_id',
        'state_id',
        'city_id',
        'address',
        'postal_code',
        'vereda',
        'documents'
    ];

    protected $casts = [
        'documents' => 'array',
    ];

    public function country()
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

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Property extends Model
{
    /*
    |--------------------------------------------------------------------------
    | Fillable
    |--------------------------------------------------------------------------
    */

    protected $fillable = [

        'codigo',
        'title',
        'type',

        'zip_code',
        'address',
        'number',
        'district',
        'city',
        'state',

        'area',
        'bedrooms',
        'bathrooms',
        'parking_spaces',

        'rent_value',

        'active',

        'notes',

    ];


    /*
    |--------------------------------------------------------------------------
    | Casts
    |--------------------------------------------------------------------------
    */

    protected $casts = [

        'active' => 'boolean',

        'rent_value' => 'decimal:2',

        'area' => 'decimal:2',

    ];


    /*
    |--------------------------------------------------------------------------
    | Boot / Events
    |--------------------------------------------------------------------------
    */

    protected static function booted(): void
    {

        static::created(function (Property $property) {


            $property->update([

                'codigo' => 'IMV-' . str_pad(

                    $property->id,

                    6,

                    '0',

                    STR_PAD_LEFT

                ),

            ]);


        });

    }



    /*
    |--------------------------------------------------------------------------
    | Relationships
    |--------------------------------------------------------------------------
    */


    /**
     * Pessoas vinculadas ao imóvel
     */
    public function propertyPeople(): HasMany
    {

        return $this->hasMany(PropertyPerson::class);

    }



    /**
     * Contratos do imóvel
     */
    public function contracts(): HasMany
    {

        return $this->hasMany(Contract::class);

    }



    /*
    |--------------------------------------------------------------------------
    | Scopes
    |--------------------------------------------------------------------------
    */


    public function scopeActive($query)
    {

        return $query->where('active', true);

    }



    /*
    |--------------------------------------------------------------------------
    | Accessors
    |--------------------------------------------------------------------------
    */


    public function getTypeLabelAttribute(): string
    {

        return match ($this->type) {


            'house' => 'Casa',

            'apartment' => 'Apartamento',

            'commercial' => 'Sala Comercial',

            'land' => 'Terreno',


            default => ucfirst($this->type),

        };

    }



    public function getStatusLabelAttribute(): string
    {

        return $this->active

            ? 'Disponível'

            : 'Indisponível';

    }



    /*
    |--------------------------------------------------------------------------
    | Helpers
    |--------------------------------------------------------------------------
    */


    public function hasContracts(): bool
    {

        return $this->contracts()->exists();

    }


}

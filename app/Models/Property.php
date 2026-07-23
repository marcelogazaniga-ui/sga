<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Property extends Model
{
    /*
    |--------------------------------------------------------------------------
    | Fillable
    |--------------------------------------------------------------------------
    */

    protected $fillable = [

        'company_id',

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
        'status',

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

            if (!$property->codigo) {

                $property->update([

                    'codigo' => 'IMV-' . str_pad(

                        $property->id,

                        6,

                        '0',

                        STR_PAD_LEFT

                    ),

                ]);

            }


        });


    }



    /*
    |--------------------------------------------------------------------------
    | Relationships
    |--------------------------------------------------------------------------
    */


    /**
     * Empresa responsável pelo imóvel
     */
    public function company(): BelongsTo
    {

        return $this->belongsTo(Company::class);

    }



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



    public function scopeAvailable($query)
    {

        return $query->where('status', 'available');

    }



    /*
    |--------------------------------------------------------------------------
    | Accessors
    |--------------------------------------------------------------------------
    */


    public function getTypeLabelAttribute(): string
    {

        return match ($this->type) {


            'house' =>
                'Casa',


            'apartment' =>
                'Apartamento',


            'commercial' =>
                'Sala Comercial',


            'land' =>
                'Terreno',


            default =>
                ucfirst($this->type),

        };

    }



    public function getStatusLabelAttribute(): string
    {

        return match ($this->status) {


            'available' =>
                'Disponível',


            'rented' =>
                'Alugado',


            'reserved' =>
                'Reservado',


            'maintenance' =>
                'Manutenção',


            'inactive' =>
                'Inativo',


            default =>
                'Não definido',

        };

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

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;


class Person extends Model
{
    protected $fillable = [

        'name',
        'document',
        'email',
        'phone',
        'birth_date',
        'zip_code',
        'address',
        'number',
        'district',
        'city',
        'state',
        'notes',
        'active',

    ];



    protected $casts = [

        'birth_date' => 'date',

        'active' => 'boolean',

    ];



    /**
     * Perfis / funções da pessoa
     */
    public function roles(): HasMany
    {
        return $this->hasMany(
            PersonRole::class
        );
    }



    /**
     * Imóveis relacionados
     */
    public function propertyPeople(): HasMany
    {
        return $this->hasMany(
            PropertyPerson::class
        );
    }



    /**
     * Contratos onde participa
     */
    public function contractPeople(): HasMany
    {
        return $this->hasMany(
            ContractPerson::class
        );
    }


}

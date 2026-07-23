<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PersonRole extends Model
{
    /*
    |--------------------------------------------------------------------------
    | Fillable
    |--------------------------------------------------------------------------
    */

    protected $fillable = [

        'person_id',

        'role',

    ];


    /*
    |--------------------------------------------------------------------------
    | Relationships
    |--------------------------------------------------------------------------
    */


    public function person(): BelongsTo
    {

        return $this->belongsTo(Person::class);

    }


    /*
    |--------------------------------------------------------------------------
    | Accessors
    |--------------------------------------------------------------------------
    */


    public function getLabelAttribute(): string
    {

        return match ($this->role) {

            'owner' =>
                'Proprietário',

            'tenant' =>
                'Locatário',

            'guarantor' =>
                'Fiador',

            'administrator' =>
                'Administrador',

            default =>
                ucfirst($this->role),

        };

    }
}

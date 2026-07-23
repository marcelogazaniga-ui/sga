<?php

namespace App\Models;

use App\Enums\PropertyPersonRole;
use Illuminate\Database\Eloquent\Model;

class PropertyPerson extends Model
{
    protected $fillable = [
        'property_id',
        'person_id',
        'role',
    ];


    protected $casts = [
        'role' => PropertyPersonRole::class,
    ];


    public function property()
    {
        return $this->belongsTo(Property::class);
    }


    public function person()
    {
        return $this->belongsTo(Person::class);
    }
}

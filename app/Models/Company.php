<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $fillable = [
        'name',
        'trade_name',
        'document',
        'email',
        'phone',
        'zip_code',
        'address',
        'number',
        'district',
        'city',
        'state',
        'logo',
    ];
}

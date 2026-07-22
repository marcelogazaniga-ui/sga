<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Person extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'company_id',
        'person_type',
        'person_kind',
        'name',
        'trade_name',
        'document',
        'email',
        'phone',
        'mobile',
        'zip_code',
        'address',
        'number',
        'complement',
        'district',
        'city',
        'state',
        'country',
        'pix_key',
        'pix_type',
        'bank',
        'agency',
        'account',
        'notes',
        'active',
    ];


    public function company()
    {
        return $this->belongsTo(Company::class);
    }
}

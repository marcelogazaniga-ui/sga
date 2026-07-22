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
        'birth_date',
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
        'metadata',
        'notes',
        'active',
    ];


    protected function casts(): array
    {
        return [
            'birth_date' => 'date',
            'metadata' => 'array',
            'active' => 'boolean',
        ];
    }


    public function company()
    {
        return $this->belongsTo(
            Company::class
        );
    }


    public function scopeOwners($query)
    {
        return $query->where(
            'person_type',
            'owner'
        );
    }


    public function scopeTenants($query)
    {
        return $query->where(
            'person_type',
            'tenant'
        );
    }
}

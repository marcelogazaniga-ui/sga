<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;


class BillingCycle extends Model
{

    protected $fillable = [

        'contract_id',
        'month',
        'year',
        'total_value',
        'status',
        'paid_at',

    ];



    protected $casts = [

        'total_value' => 'decimal:2',

        'paid_at' => 'date',

    ];



    public function contract(): BelongsTo
    {
        return $this->belongsTo(Contract::class);
    }



    public function transactions(): HasMany
    {
        return $this->hasMany(ContractTransaction::class);
    }


}

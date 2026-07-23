<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ContractPerson extends Model
{

    protected $fillable = [

        'contract_id',
        'person_id',
        'role',

    ];


    public function contract(): BelongsTo
    {
        return $this->belongsTo(Contract::class);
    }


    public function person(): BelongsTo
    {
        return $this->belongsTo(Person::class);
    }

}

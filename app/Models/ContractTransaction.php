<?php

namespace App\Models;

use App\Enums\TransactionType;
use App\Enums\TransactionStatus;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Validation\ValidationException;


class ContractTransaction extends Model
{

    protected $fillable = [

        'contract_id',
        'billing_cycle_id',
        'type',
        'description',
        'due_date',
        'payment_date',
        'value',
        'status',
        'notes',

    ];



    protected $casts = [

        'due_date' => 'date',

        'payment_date' => 'date',

        'value' => 'decimal:2',

        'type' => TransactionType::class,

        'status' => TransactionStatus::class,

    ];



    protected static function booted(): void
    {

        static::creating(function ($transaction) {


            $restrictedTypes = [

                TransactionType::RENT->value,

                TransactionType::CONDOMINIUM->value,

                TransactionType::IPTU->value,

            ];



            if (
                in_array(
                    $transaction->type instanceof TransactionType
                        ? $transaction->type->value
                        : $transaction->type,

                    $restrictedTypes
                )
                &&
                self::where('contract_id', $transaction->contract_id)

                    ->where(
                        'billing_cycle_id',
                        $transaction->billing_cycle_id
                    )

                    ->where(
                        'type',
                        $transaction->type
                    )

                    ->exists()
            ) {


                throw ValidationException::withMessages([

                    'type' =>
                        'Já existe este lançamento para este contrato neste ciclo financeiro.',

                ]);

            }


        });

    }



    public function contract(): BelongsTo
    {

        return $this->belongsTo(Contract::class);

    }



    public function billingCycle(): BelongsTo
    {

        return $this->belongsTo(BillingCycle::class);

    }



    public function markAsPaid(): void
    {

        $this->update([

            'status' => TransactionStatus::PAID,

            'payment_date' => now(),

        ]);

    }

}

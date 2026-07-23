<?php

namespace App\Models;

use App\Enums\ContractStatus;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Contract extends Model
{
    protected $fillable = [

        'codigo',
        'property_id',
        'start_date',
        'end_date',
        'rent_value',
        'condominium_value',
        'iptu_value',
        'deposit_value',
        'due_day',
        'payment_method',
        'status',
        'notes',

    ];


    protected $casts = [

        'start_date' => 'date',
        'end_date' => 'date',

        'rent_value' => 'decimal:2',
        'condominium_value' => 'decimal:2',
        'iptu_value' => 'decimal:2',
        'deposit_value' => 'decimal:2',

        'status' => ContractStatus::class,

    ];



    protected static function booted(): void
    {
        static::created(function ($contract) {

            $contract->updateQuietly([

                'codigo' => 'CTR-' . str_pad(
                    $contract->id,
                    6,
                    '0',
                    STR_PAD_LEFT
                ),

            ]);

        });
    }



    public function property(): BelongsTo
    {
        return $this->belongsTo(Property::class);
    }



    public function people(): HasMany
    {
        return $this->hasMany(ContractPerson::class);
    }



    public function transactions(): HasMany
    {
        return $this->hasMany(ContractTransaction::class);
    }



    public function billingCycles(): HasMany
    {
        return $this->hasMany(BillingCycle::class);
    }





    public function generateBillingCycles(): void
    {

        $start = $this->start_date->copy();


        $end = $this->end_date
            ? $this->end_date->copy()
            : $start->copy()->addYear();



        while ($start <= $end) {


            $exists = $this->billingCycles()

                ->where('month', $start->month)

                ->where('year', $start->year)

                ->exists();



            if ($exists) {

                $start->addMonth();

                continue;

            }



            $total =

                $this->rent_value +

                $this->condominium_value +

                $this->iptu_value;



            $cycle = $this->billingCycles()->create([

                'month' => $start->month,

                'year' => $start->year,

                'total_value' => $total,

                'status' => 'pending',

            ]);





            $dueDate = $start
                ->copy()
                ->day($this->due_day);





            if ($this->rent_value > 0) {

                ContractTransaction::create([

                    'contract_id' => $this->id,

                    'billing_cycle_id' => $cycle->id,

                    'type' => 'rent',

                    'description' => 'Aluguel',

                    'due_date' => $dueDate,

                    'value' => $this->rent_value,

                    'status' => 'pending',

                ]);

            }





            if ($this->condominium_value > 0) {

                ContractTransaction::create([

                    'contract_id' => $this->id,

                    'billing_cycle_id' => $cycle->id,

                    'type' => 'condominium',

                    'description' => 'Condomínio',

                    'due_date' => $dueDate,

                    'value' => $this->condominium_value,

                    'status' => 'pending',

                ]);

            }





            if ($this->iptu_value > 0) {

                ContractTransaction::create([

                    'contract_id' => $this->id,

                    'billing_cycle_id' => $cycle->id,

                    'type' => 'iptu',

                    'description' => 'IPTU',

                    'due_date' => $dueDate,

                    'value' => $this->iptu_value,

                    'status' => 'pending',

                ]);

            }



            $start->addMonth();

        }

    }

}

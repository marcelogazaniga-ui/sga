<?php

namespace App\Services;

use App\Enums\TransactionStatus;
use App\Enums\TransactionType;
use App\Models\Contract;
use App\Models\ContractTransaction;
use Carbon\Carbon;

class FinancialService
{
    public function generateTransactions(Contract $contract): void
    {
        $start = $contract->start_date->copy()->startOfMonth();

        $end = $contract->end_date
            ? $contract->end_date->copy()->startOfMonth()
            : $start->copy()->addMonths(11);

        while ($start->lte($end)) {

            $dueDate = Carbon::create(
                $start->year,
                $start->month,
                min(
                    $contract->due_day,
                    $start->daysInMonth
                )
            );

            $this->generateRent($contract, $dueDate);

            $this->generateCondominium($contract, $dueDate);

            $this->generateIPTU($contract, $dueDate);

            $start->addMonth();
        }
    }

    protected function generateRent(
        Contract $contract,
        Carbon $dueDate
    ): void {

        if ($contract->rent_value <= 0) {
            return;
        }

        $this->createTransaction(
            $contract,
            TransactionType::RENT,
            'Aluguel',
            $dueDate,
            $contract->rent_value
        );
    }

    protected function generateCondominium(
        Contract $contract,
        Carbon $dueDate
    ): void {

        if ($contract->condominium_value <= 0) {
            return;
        }

        $this->createTransaction(
            $contract,
            TransactionType::CONDOMINIUM,
            'Condomínio',
            $dueDate,
            $contract->condominium_value
        );
    }

    protected function generateIPTU(
        Contract $contract,
        Carbon $dueDate
    ): void {

        if ($contract->iptu_value <= 0) {
            return;
        }

        $this->createTransaction(
            $contract,
            TransactionType::IPTU,
            'IPTU',
            $dueDate,
            $contract->iptu_value
        );
    }

    protected function createTransaction(
        Contract $contract,
        TransactionType $type,
        string $description,
        Carbon $dueDate,
        float $value
    ): void {

        if ($this->transactionExists($contract, $type, $dueDate)) {
            return;
        }

        ContractTransaction::create([

            'contract_id' => $contract->id,

            'type' => $type,

            'description' => $description,

            'due_date' => $dueDate,

            'value' => $value,

            'status' => TransactionStatus::PENDING,

        ]);
    }

    protected function transactionExists(
        Contract $contract,
        TransactionType $type,
        Carbon $dueDate
    ): bool {

        return ContractTransaction::query()

            ->where('contract_id', $contract->id)

            ->where('type', $type)

            ->whereDate('due_date', $dueDate)

            ->exists();
    }
}

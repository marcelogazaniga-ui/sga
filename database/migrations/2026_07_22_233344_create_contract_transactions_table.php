<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('contract_transactions', function (Blueprint $table) {

            $table->id();


            $table->foreignId('contract_id')
                ->constrained()
                ->cascadeOnDelete();


            $table->string('type');


            $table->string('description')
                ->nullable();


            $table->date('due_date');


            $table->date('payment_date')
                ->nullable();


            $table->decimal('value',10,2);


            $table->string('status')
                ->default('pending');


            $table->text('notes')
                ->nullable();


            $table->timestamps();

        });
    }


    public function down(): void
    {
        Schema::dropIfExists('contract_transactions');
    }
};

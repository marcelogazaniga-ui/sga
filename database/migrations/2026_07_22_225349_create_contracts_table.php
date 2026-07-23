<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('contracts', function (Blueprint $table) {

            $table->id();

            $table->string('codigo')
                ->unique()
                ->nullable();

            $table->foreignId('property_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->date('start_date');

            $table->date('end_date')
                ->nullable();

            $table->decimal('rent_value', 10, 2);

            $table->decimal('condominium_value', 10, 2)
                ->default(0);

            $table->decimal('iptu_value', 10, 2)
                ->default(0);

            $table->decimal('deposit_value', 10, 2)
                ->default(0);

            $table->integer('due_day')
                ->default(10);

            $table->string('payment_method')
                ->nullable();

            $table->string('status')
                ->default('active');

            $table->text('notes')
                ->nullable();

            $table->timestamps();

        });
    }


    public function down(): void
    {
        Schema::dropIfExists('contracts');
    }
};

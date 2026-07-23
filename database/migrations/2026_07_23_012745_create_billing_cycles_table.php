<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
public function up(): void
{
    Schema::create('billing_cycles', function (Blueprint $table) {

        $table->id();

        $table->foreignId('contract_id')
            ->constrained()
            ->cascadeOnDelete();

        $table->integer('month');

        $table->integer('year');

        $table->decimal('total_value', 10, 2)
            ->default(0);

        $table->string('status')
            ->default('pending');

        $table->date('paid_at')
            ->nullable();

        $table->timestamps();


        $table->unique([
            'contract_id',
            'month',
            'year'
        ]);

    });
}
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('billing_cycles');
    }
};

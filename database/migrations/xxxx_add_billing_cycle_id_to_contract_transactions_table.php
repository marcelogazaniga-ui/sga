<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;


return new class extends Migration
{

    public function up(): void
    {

        Schema::table('contract_transactions', function (Blueprint $table) {


            $table->foreignId('billing_cycle_id')

                ->nullable()

                ->after('contract_id')

                ->constrained('billing_cycles')

                ->cascadeOnDelete();


        });

    }



    public function down(): void
    {

        Schema::table('contract_transactions', function (Blueprint $table) {


            $table->dropForeign([
                'billing_cycle_id'
            ]);


            $table->dropColumn('billing_cycle_id');


        });

    }

};

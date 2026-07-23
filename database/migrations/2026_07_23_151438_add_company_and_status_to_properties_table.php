<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::table('properties', function (Blueprint $table) {

            $table->foreignId('company_id')
                ->nullable()
                ->after('id')
                ->constrained()
                ->nullOnDelete();


            $table->string('status')
                ->default('available')
                ->after('active');

        });
    }


    public function down(): void
    {
        Schema::table('properties', function (Blueprint $table) {

            $table->dropForeign([
                'company_id'
            ]);

            $table->dropColumn([
                'company_id',
                'status'
            ]);

        });
    }

};

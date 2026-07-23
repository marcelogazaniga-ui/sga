<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('properties', function (Blueprint $table) {

            $table->string('codigo')
                ->unique()
                ->nullable()
                ->after('id');

            $table->string('title')
                ->nullable();

            $table->string('type')
                ->nullable();

            $table->string('zip_code')
                ->nullable();

            $table->string('address')
                ->nullable();

            $table->string('number')
                ->nullable();

            $table->string('district')
                ->nullable();

            $table->string('city')
                ->nullable();

            $table->string('state', 2)
                ->nullable();

            $table->decimal('area', 10, 2)
                ->nullable();

            $table->integer('bedrooms')
                ->nullable();

            $table->integer('bathrooms')
                ->nullable();

            $table->integer('parking_spaces')
                ->nullable();

            $table->decimal('rent_value', 10, 2)
                ->nullable();

            $table->boolean('active')
                ->default(true);

            $table->text('notes')
                ->nullable();

        });
    }

    public function down(): void
    {
        Schema::table('properties', function (Blueprint $table) {

            $table->dropColumn([
                'codigo',
                'title',
                'type',
                'zip_code',
                'address',
                'number',
                'district',
                'city',
                'state',
                'area',
                'bedrooms',
                'bathrooms',
                'parking_spaces',
                'rent_value',
                'active',
                'notes',
            ]);

        });
    }
};

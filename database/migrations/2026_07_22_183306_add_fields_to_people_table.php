<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('people', function (Blueprint $table) {

            $table->string('person_type')->nullable();

            $table->string('person_kind')->nullable();

            $table->string('name');

            $table->string('document')
                ->nullable();

            $table->date('birth_date')
                ->nullable();

            $table->string('email')
                ->nullable();

            $table->string('phone')
                ->nullable();

            $table->string('mobile')
                ->nullable();

            $table->string('zip_code')
                ->nullable();

            $table->string('address')
                ->nullable();

            $table->string('number')
                ->nullable();

            $table->string('complement')
                ->nullable();

            $table->string('district')
                ->nullable();

            $table->string('city')
                ->nullable();

            $table->string('state', 2)
                ->nullable();

            $table->string('pix_key')
                ->nullable();

            $table->string('pix_type')
                ->nullable();

            $table->string('bank')
                ->nullable();

            $table->string('agency')
                ->nullable();

            $table->string('account')
                ->nullable();

            $table->text('notes')
                ->nullable();

            $table->boolean('active')
                ->default(true);

        });
    }

    public function down(): void
    {
        Schema::table('people', function (Blueprint $table) {

            $table->dropColumn([
                'person_type',
                'person_kind',
                'name',
                'document',
                'birth_date',
                'email',
                'phone',
                'mobile',
                'zip_code',
                'address',
                'number',
                'complement',
                'district',
                'city',
                'state',
                'pix_key',
                'pix_type',
                'bank',
                'agency',
                'account',
                'notes',
                'active',
            ]);

        });
    }
};

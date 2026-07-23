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
Schema::table('companies', function (Blueprint $table) {

    if (!Schema::hasColumn('companies', 'razao_social')) {
        $table->string('razao_social')->nullable();
    }

    if (!Schema::hasColumn('companies', 'nome_fantasia')) {
        $table->string('nome_fantasia')->nullable();
    }

    if (!Schema::hasColumn('companies', 'cnpj')) {
        $table->string('cnpj',20)->nullable()->unique();
    }

    if (!Schema::hasColumn('companies', 'telefone')) {
        $table->string('telefone')->nullable();
    }

    if (!Schema::hasColumn('companies', 'endereco')) {
        $table->string('endereco')->nullable();
    }

    if (!Schema::hasColumn('companies', 'cidade')) {
        $table->string('cidade')->nullable();
    }

    if (!Schema::hasColumn('companies', 'estado')) {
        $table->string('estado',2)->nullable();
    }

    if (!Schema::hasColumn('companies', 'observacao')) {
        $table->text('observacao')->nullable();
    }

});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('companies', function (Blueprint $table) {
            //
        });
    }
};

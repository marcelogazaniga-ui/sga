<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('companies', function (Blueprint $table) {
            $table->dropColumn([
                'razao_social',
                'nome_fantasia',
                'cnpj',
                'telefone',
                'endereco',
                'cidade',
                'estado',
                'observacao',
            ]);
        });
    }

    public function down(): void
    {
        Schema::table('companies', function (Blueprint $table) {

            $table->string('razao_social')->nullable();
            $table->string('nome_fantasia')->nullable();
            $table->string('cnpj')->nullable();
            $table->string('telefone')->nullable();
            $table->string('endereco')->nullable();
            $table->string('cidade')->nullable();
            $table->string('estado')->nullable();
            $table->text('observacao')->nullable();

        });
    }
};

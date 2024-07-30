<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('eventos', function (Blueprint $table) {
            $table->id();
            $table->string('nome_evento');
            $table->dateTime('data_inicio');
            $table->dateTime('data_fim');
            $table->dateTime('data_prazo_inscricao');
            $table->string('responsavel', 150);
            $table->string('telefone_responsavel', 50);
            $table->string('email_responsavel', 200);
            $table->string('uf', 2)->nullable();
            $table->string('cidade', 100)->nullable();
            $table->string('local', 100)->nullable();
            $table->string('descricao', 500)->nullable();
            $table->string('logo_evento', 300)->nullable();
            $table->integer('limite_nscritos');
            $table->string('url_inscricao', 300)->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('eventos');
    }
};

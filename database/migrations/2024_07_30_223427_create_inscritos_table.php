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
        Schema::create('inscritos', function (Blueprint $table) {
            $table->id();
            $table->string('nome', 200);
            $table->string('cpf', 11);
            $table->string('rg', 20)->nullable();
            $table->date('data_nascimento');
            $table->string('telefone', 20);
            $table->string('email', 100);
            $table->string('cidade', 100)->nullable();
            $table->string('endereco', 200)->nullable();
            $table->string('cep', 9)->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inscritos');
    }
};

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
   public function up()
{
    Schema::create('laudos', function (Blueprint $table) {
        $table->id();
        $table->string('nome');
        $table->date('data_nascimento');
        $table->string('rg');
        $table->string('cpf');
        $table->string('medico');
        $table->string('crm');
        $table->string('especialidade');
        $table->string('contato_medico');
        $table->text('detalhes');
        $table->string('diagnostico');
        $table->string('arquivo_pdf')->nullable();
        $table->timestamps();
    });
}

};

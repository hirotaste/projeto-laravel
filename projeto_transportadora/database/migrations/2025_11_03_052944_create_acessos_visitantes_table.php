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
        Schema::create('acessos_visitantes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('visitante_id');
            $table->string('motivo_visita')->nullable();
            $table->string('responsavel_interno')->nullable();
            $table->dateTime('data_hora_entrada');
            $table->dateTime('data_hora_saida')->nullable();
            $table->timestamps();

            $table->foreign('visitante_id')->references('id')->on('visitantes')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('acessos_visitantes');
    }
};

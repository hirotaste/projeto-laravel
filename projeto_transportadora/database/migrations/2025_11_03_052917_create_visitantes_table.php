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
        Schema::create('visitantes', function (Blueprint $table) {
            $table->id();
            $table->string('nome');
            $table->string('documento', 50);
            $table->string('empresa')->nullable();
            $table->unsignedBigInteger('funcao_id')->nullable();
            $table->timestamps();

            $table->foreign('funcao_id')->references('id')->on('funcoes_visitantes')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('visitantes');
    }
};

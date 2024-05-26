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
        Schema::create('rifa', function (Blueprint $table) {
            $table->id();
            $table->date('fecha_inicio')
            ->nullable();
            $table->date('fecha_fin')
            ->nullable();
            $table->boolean('estado');
            $table->string('nombre')
            ->nullable();
            $table->integer('numeros')
            ->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rifa');
    }
};

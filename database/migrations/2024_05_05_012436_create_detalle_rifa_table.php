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
        Schema::create('detalle_rifa', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_rifa')
            ->nullable()
            ->constrained('rifa')
            ->nullOnDelete();
            $table->foreignId('id_producto')
            ->nullable()
            ->constrained('productos')
            ->nullOnDelete();
            $table->integer('puesto')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detalle_rifa');
    }
};

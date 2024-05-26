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
        Schema::create('detalle_ventas', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignId('id_venta')
            ->nullable()
            ->constrained('ventas')
            ->nullOnDelete();
            $table->integer('costo_unitario')->nullable();
            $table->integer('cantidad')->nullable();
            $table->foreignId('id_producto')
            ->nullable()
            ->constrained('productos')
            ->nullOnDelete();
        
            
        });
       
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detalle_ventas');
    }
};

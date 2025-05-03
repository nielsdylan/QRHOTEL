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
        Schema::create('ventas_detalles', function (Blueprint $table) {
            $table->id();
            $table->integer('producto_servicio_id')->nullable();
            $table->float('precio',53);
            $table->float('cantidad',53);
            $table->float('total',53);
            $table->integer('pagado')->default(1);
            $table->integer('hotel_id');
            $table->integer('venta_id');
            $table->integer('usuario_id');
            $table->integer('estado')->default(1);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ventas_detalles');
    }
};

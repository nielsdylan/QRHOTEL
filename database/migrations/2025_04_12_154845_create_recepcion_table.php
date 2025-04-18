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
        Schema::create('recepcion', function (Blueprint $table) {
            $table->id();
            $table->date('fecha_entrada');
            $table->date('fecha_salida');
            $table->time('hora_entrada');
            $table->time('hora_salida');
            $table->float('adelanto', 12, 3)->default(0)->nullable();
            $table->float('total', 12, 3)->default(0);
            $table->float('descuento', 12, 3)->default(0)->nullable();
            $table->float('cobrar_extra', 12, 3)->default(0)->nullable();
            $table->string('detalle')->nullable();
            $table->string('email')->nullable();
            $table->boolean('enviar_correo')->default(0)->nullable();
            $table->integer('habitacion_id');
            $table->integer('usuario_id');
            $table->integer('cliente_id');
            $table->integer('medio_pago_id');
            $table->integer('estado_habitacion_id');
            $table->integer('hotel_id');
            $table->string('estado')->default(1);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('recepcion');
    }
};

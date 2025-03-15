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
        Schema::create('hoteles', function (Blueprint $table) {
            $table->id();
            $table->string('razon_social');
            $table->string('ruc');
            $table->string('direccion');
            $table->string('telefono');
            $table->string('whatsapp');
            $table->string('logo');
            $table->string('instagram');
            $table->string('facebook');
            $table->integer('propietario_id');
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
        Schema::dropIfExists('hoteles');
    }
};

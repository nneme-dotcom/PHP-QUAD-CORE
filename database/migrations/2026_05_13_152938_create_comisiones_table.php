<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('comisiones', function (Blueprint $table) {
            $table->id();
            $table->foreignId('gestora_id')->constrained('empresas_gestoras');
            $table->foreignId('incidencia_id')->constrained('incidencias');
            $table->decimal('importe_base', 8, 2);
            $table->decimal('porcentaje', 5, 2);
            $table->decimal('importe_comision', 8, 2);
            $table->integer('mes');
            $table->integer('anio');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('comisiones');
    }
};
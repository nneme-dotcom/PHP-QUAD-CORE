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
        Schema::create('gestoras', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');          // Añadimos el nombre
            $table->string('email')->unique(); // Añadimos el email (único)
            $table->string('telefono');        // Añadimos el teléfono
            
            // Este campo es para el Punto B (Comisión del 5%)
            $table->decimal('comision_acumulada', 10, 2)->default(0.00); 
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('gestoras');
    }
};

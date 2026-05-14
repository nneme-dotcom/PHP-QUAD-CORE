<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('incidencias', function (Blueprint $table) {
            $table->id();
            $table->string('localizador', 16)->unique();
            $table->foreignId('cliente_id')->constrained('usuarios');
            $table->foreignId('tecnico_id')->nullable()->constrained('tecnicos')->nullOnDelete();
            $table->foreignId('especialidad_id')->constrained('especialidades');
            $table->text('descripcion');
            $table->string('direccion', 255);
            $table->string('telefono_contacto', 20);
            $table->dateTime('fecha_servicio');
            $table->enum('franja_horaria', ['manana', 'tarde']);
            $table->enum('tipo_urgencia', ['Estandar', 'Urgente'])->default('Estandar');
            $table->enum('estado', ['Pendiente', 'Asignada', 'Finalizada', 'Cancelada'])->default('Pendiente');
            
            // Línea modificada para evitar el error de orden de tablas
            $table->unsignedBigInteger('gestora_id')->nullable(); 
            
            $table->timestamp('created_at')->nullable()->useCurrent();
            $table->timestamp('updated_at')->nullable()->useCurrent();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('incidencias');
    }
};
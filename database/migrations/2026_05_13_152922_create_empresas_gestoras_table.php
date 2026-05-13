<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('empresas_gestoras', function (Blueprint $table) {
            $table->id();
            $table->string('nombre', 100);
            $table->string('cif', 20)->unique();
            $table->string('email', 100)->unique();
            $table->string('telefono', 20)->nullable();
            $table->decimal('porcentaje_comision', 5, 2)->default(5.00);
            $table->foreignId('usuario_id')->constrained('usuarios');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('empresas_gestoras');
    }
};
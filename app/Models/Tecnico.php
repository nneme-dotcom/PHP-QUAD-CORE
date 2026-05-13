<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tecnico extends Model
{
    protected $table = 'tecnicos';

    protected $fillable = [
        'usuario_id',
        'nombre_completo',
        'especialidad_id',
        'disponible',
    ];

    public $timestamps = false;

    // Relaciones
    public function usuario()
    {
        return $this->belongsTo(User::class, 'usuario_id');
    }

    public function especialidad()
    {
        return $this->belongsTo(Especialidad::class, 'especialidad_id');
    }

    public function incidencias()
    {
        return $this->hasMany(Incidencia::class, 'tecnico_id');
    }
}

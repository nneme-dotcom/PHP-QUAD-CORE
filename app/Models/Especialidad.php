<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Especialidad extends Model
{
    protected $table = 'especialidades';

    protected $fillable = ['nombre_especialidad'];

    public $timestamps = false;

    public function tecnicos()
    {
        return $this->hasMany(Tecnico::class, 'especialidad_id');
    }

    public function incidencias()
    {
        return $this->hasMany(Incidencia::class, 'especialidad_id');
    }
}

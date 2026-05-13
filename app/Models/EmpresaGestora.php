<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EmpresaGestora extends Model
{
    protected $table = 'empresas_gestoras';

    protected $fillable = [
        'nombre',
        'cif',
        'email',
        'telefono',
        'porcentaje_comision',
        'usuario_id',
    ];

    // Relaciones
    public function usuario()
    {
        return $this->belongsTo(User::class, 'usuario_id');
    }

    public function incidencias()
    {
        return $this->hasMany(Incidencia::class, 'gestora_id');
    }

    public function comisiones()
    {
        return $this->hasMany(Comision::class, 'gestora_id');
    }
}

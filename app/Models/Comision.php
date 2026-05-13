<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comision extends Model
{
    protected $table = 'comisiones';

    protected $fillable = [
        'gestora_id',
        'incidencia_id',
        'importe_base',
        'porcentaje',
        'importe_comision',
        'mes',
        'anio',
    ];

    // Relaciones
    public function gestora()
    {
        return $this->belongsTo(EmpresaGestora::class, 'gestora_id');
    }

    public function incidencia()
    {
        return $this->belongsTo(Incidencia::class, 'incidencia_id');
    }
}

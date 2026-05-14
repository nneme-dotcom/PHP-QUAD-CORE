<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Incidencia extends Model
{
    protected $table = 'incidencias';

    protected $fillable = [
        'localizador',
        'cliente_id',
        'tecnico_id',
        'especialidad_id',
        'descripcion',
        'direccion',
        'telefono_contacto',
        'fecha_servicio',
        'franja_horaria',
        'tipo_urgencia',
        'estado',
        'gestora_id',
        'zona_id',
    ];

    protected $casts = [
        'fecha_servicio' => 'datetime',
    ];

    public function cliente()
    {
        return $this->belongsTo(User::class, 'cliente_id');
    }

    public function tecnico()
    {
        return $this->belongsTo(Tecnico::class, 'tecnico_id');
    }

    public function especialidad()
    {
        return $this->belongsTo(Especialidad::class, 'especialidad_id');
    }

    public function gestora()
    {
        return $this->belongsTo(EmpresaGestora::class, 'gestora_id');
    }

    public function comision()
    {
        return $this->hasOne(Comision::class, 'incidencia_id');
    }

    public function zona()
    {
        return $this->belongsTo(Zona::class, 'zona_id');
    }

    public static function generarLocalizador(): string
    {
        do {
            $cod = 'REP-' . date('Y') . '-' . str_pad((string)random_int(1, 9999), 4, '0', STR_PAD_LEFT);
        } while (self::where('localizador', $cod)->exists());
        return $cod;
    }
}

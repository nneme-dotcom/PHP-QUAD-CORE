<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $table = 'usuarios';

    protected $fillable = [
        'nombre',
        'apellidos',
        'email',
        'password',
        'rol',
        'telefono',
    ];

    protected $hidden = [
        'password',
    ];

    public $timestamps = false;

    public function tecnico()
    {
        return $this->hasOne(Tecnico::class, 'usuario_id');
    }

    public function incidencias()
    {
        return $this->hasMany(Incidencia::class, 'cliente_id');
    }

    public function empresaGestora()
    {
        return $this->hasOne(EmpresaGestora::class, 'usuario_id');
    }
}

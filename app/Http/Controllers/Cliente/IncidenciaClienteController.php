<?php

namespace App\Http\Controllers\Cliente;

use App\Http\Controllers\Controller;
use App\Models\Incidencia;
use App\Models\Especialidad;
use Illuminate\Http\Request;

class IncidenciaClienteController extends Controller
{
    public function index()
    {
        $incidencias = Incidencia::with(['especialidad', 'tecnico'])
            ->where('cliente_id', session('user_id'))
            ->orderBy('created_at', 'desc')
            ->get();
        return view('cliente.incidencias.index', compact('incidencias'));
    }

    public function create()
    {
        $especialidades = Especialidad::orderBy('nombre_especialidad')->get();
        return view('cliente.incidencias.create', compact('especialidades'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'especialidad_id'   => 'required|exists:especialidades,id',
            'descripcion'       => 'required|string|max:1000',
            'direccion'         => 'required|string|max:255',
            'telefono_contacto' => 'required|string|max:20',
            'fecha_servicio'    => 'required|date|after:today',
            'franja_horaria'    => 'required|in:manana,tarde',
            'tipo_urgencia'     => 'required|in:Estandar,Urgente',
        ]);

        Incidencia::create([
            'localizador'       => Incidencia::generarLocalizador(),
            'cliente_id'        => session('user_id'),
            'especialidad_id'   => $request->especialidad_id,
            'descripcion'       => $request->descripcion,
            'direccion'         => $request->direccion,
            'telefono_contacto' => $request->telefono_contacto,
            'fecha_servicio'    => $request->fecha_servicio,
            'franja_horaria'    => $request->franja_horaria,
            'tipo_urgencia'     => $request->tipo_urgencia,
            'estado'            => 'Pendiente',
        ]);

        return redirect()->route('cliente.incidencias.index')
                         ->with('success', 'Incidencia creada. Localizador generado.');
    }

    public function show(Incidencia $incidencia)
    {
        // Verificar que la incidencia pertenece al cliente
        if ($incidencia->cliente_id !== session('user_id')) {
            abort(403);
        }
        $incidencia->load(['especialidad', 'tecnico.especialidad']);
        return view('cliente.incidencias.show', compact('incidencia'));
    }
}

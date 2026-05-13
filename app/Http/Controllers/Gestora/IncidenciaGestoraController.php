<?php

namespace App\Http\Controllers\Gestora;

use App\Http\Controllers\Controller;
use App\Models\Incidencia;
use App\Models\EmpresaGestora;
use App\Models\Especialidad;
use App\Models\Comision;
use Illuminate\Http\Request;

class IncidenciaGestoraController extends Controller
{
    private function getGestora(): EmpresaGestora
    {
        return EmpresaGestora::where('usuario_id', session('user_id'))->firstOrFail();
    }

    public function index()
    {
        $gestora = $this->getGestora();
        $incidencias = Incidencia::with(['especialidad', 'tecnico'])
            ->where('gestora_id', $gestora->id)
            ->orderBy('created_at', 'desc')
            ->get();
        return view('gestora.incidencias.index', compact('incidencias', 'gestora'));
    }

    public function create()
    {
        $especialidades = Especialidad::orderBy('nombre_especialidad')->get();
        return view('gestora.incidencias.create', compact('especialidades'));
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
            'importe_base'      => 'required|numeric|min:0',
        ]);

        $gestora = $this->getGestora();

        $incidencia = Incidencia::create([
            'localizador'       => Incidencia::generarLocalizador(),
            'cliente_id'        => session('user_id'),
            'gestora_id'        => $gestora->id,
            'especialidad_id'   => $request->especialidad_id,
            'descripcion'       => $request->descripcion,
            'direccion'         => $request->direccion,
            'telefono_contacto' => $request->telefono_contacto,
            'fecha_servicio'    => $request->fecha_servicio,
            'franja_horaria'    => $request->franja_horaria,
            'tipo_urgencia'     => $request->tipo_urgencia,
            'estado'            => 'Pendiente',
        ]);

        // Calcular comisión automáticamente
        $importeBase = (float) $request->importe_base;
        $porcentaje  = (float) $gestora->porcentaje_comision;
        $importeComision = round($importeBase * $porcentaje / 100, 2);

        Comision::create([
            'gestora_id'      => $gestora->id,
            'incidencia_id'   => $incidencia->id,
            'importe_base'    => $importeBase,
            'porcentaje'      => $porcentaje,
            'importe_comision'=> $importeComision,
            'mes'             => now()->month,
            'anio'            => now()->year,
        ]);

        return redirect()->route('gestora.incidencias.index')
                         ->with('success', 'Aviso creado. Comisión calculada: ' . number_format($importeComision, 2) . '€');
    }

    public function show(Incidencia $incidencia)
    {
        $gestora = $this->getGestora();
        if ($incidencia->gestora_id !== $gestora->id) {
            abort(403);
        }
        $incidencia->load(['especialidad', 'tecnico', 'comision']);
        return view('gestora.incidencias.show', compact('incidencia'));
    }
}

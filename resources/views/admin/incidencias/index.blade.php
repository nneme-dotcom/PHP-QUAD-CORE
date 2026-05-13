@extends('layouts.app')
@section('title', 'Incidencias')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h4><i class="bi bi-clipboard-check"></i> Incidencias</h4>
</div>
<div class="card border-0 shadow-sm">
    <table class="table table-hover mb-0 small">
        <thead class="table-light">
            <tr><th>Localizador</th><th>Cliente</th><th>Especialidad</th><th>Fecha</th><th>Estado</th><th>Acciones</th></tr>
        </thead>
        <tbody>
        @forelse($incidencias as $i)
            <tr>
                <td><code>{{ $i->localizador }}</code></td>
                <td>{{ $i->cliente->nombre ?? '—' }}</td>
                <td>{{ $i->especialidad->nombre_especialidad ?? '—' }}</td>
                <td>{{ \Carbon\Carbon::parse($i->fecha_servicio)->format('d/m/Y') }}</td>
                <td>
                    <span class="badge bg-{{
                        $i->estado === 'Pendiente'  ? 'warning text-dark' :
                        ($i->estado === 'Asignada'  ? 'primary' :
                        ($i->estado === 'Finalizada'? 'success' : 'secondary'))
                    }}">{{ $i->estado }}</span>
                </td>
                <td>
                    <a href="{{ route('admin.incidencias.show', $i) }}" class="btn btn-sm btn-outline-secondary">
                        <i class="bi bi-eye"></i>
                    </a>
                    <form method="POST" action="{{ route('admin.incidencias.destroy', $i) }}" class="d-inline"
                          onsubmit="return confirm('¿Eliminar incidencia?')">
                        @csrf @method('DELETE')
                        <button class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i></button>
                    </form>
                </td>
            </tr>
        @empty
            <tr><td colspan="6" class="text-center text-muted">Sin incidencias.</td></tr>
        @endforelse
        </tbody>
    </table>
</div>
@endsection

@extends('layouts.app')
@section('title', 'Gestoras')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h4><i class="bi bi-building"></i> Empresas Gestoras</h4>
    <a href="{{ route('admin.gestoras.create') }}" class="btn btn-danger btn-sm">
        <i class="bi bi-plus-lg"></i> Nueva Gestora
    </a>
</div>
<div class="card border-0 shadow-sm">
    <table class="table table-hover mb-0">
        <thead class="table-light">
            <tr><th>#</th><th>Nombre</th><th>CIF</th><th>Email</th><th>Comisión</th><th>Acciones</th></tr>
        </thead>
        <tbody>
        @forelse($gestoras as $g)
            <tr>
                <td>{{ $g->id }}</td>
                <td>{{ $g->nombre }}</td>
                <td>{{ $g->cif }}</td>
                <td>{{ $g->email }}</td>
                <td>{{ $g->porcentaje_comision }}%</td>
                <td>
                    <a href="{{ route('admin.gestoras.show', $g) }}" class="btn btn-sm btn-outline-secondary">
                        <i class="bi bi-eye"></i>
                    </a>
                    <a href="{{ route('admin.gestoras.edit', $g) }}" class="btn btn-sm btn-outline-primary">
                        <i class="bi bi-pencil"></i>
                    </a>
                    <form method="POST" action="{{ route('admin.gestoras.destroy', $g) }}" class="d-inline"
                          onsubmit="return confirm('¿Eliminar gestora?')">
                        @csrf @method('DELETE')
                        <button class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i></button>
                    </form>
                </td>
            </tr>
        @empty
            <tr><td colspan="6" class="text-center text-muted">Sin gestoras registradas.</td></tr>
        @endforelse
        </tbody>
    </table>
</div>
@endsection

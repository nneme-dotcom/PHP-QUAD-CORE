@extends('layouts.app')
@section('title', 'Editar Gestora')
@section('content')
<h4 class="mb-4"><i class="bi bi-building"></i> Editar Gestora</h4>
<div class="card border-0 shadow-sm p-4" style="max-width:500px">
    @if($errors->any())
        <div class="alert alert-danger">{{ $errors->first() }}</div>
    @endif
    <form method="POST" action="{{ route('admin.gestoras.update', $gestora) }}">
        @csrf @method('PUT')
        <div class="mb-3">
            <label class="form-label">Nombre *</label>
            <input type="text" name="nombre" class="form-control" value="{{ old('nombre', $gestora->nombre) }}" required>
        </div>
        <div class="mb-3">
            <label class="form-label">CIF *</label>
            <input type="text" name="cif" class="form-control" value="{{ old('cif', $gestora->cif) }}" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Teléfono</label>
            <input type="text" name="telefono" class="form-control" value="{{ old('telefono', $gestora->telefono) }}">
        </div>
        <div class="mb-3">
            <label class="form-label">% Comisión *</label>
            <div class="input-group">
                <input type="number" name="porcentaje_comision" class="form-control"
                       value="{{ old('porcentaje_comision', $gestora->porcentaje_comision) }}"
                       step="0.01" min="0" max="100" required>
                <span class="input-group-text">%</span>
            </div>
        </div>
        <div class="d-flex gap-2">
            <button type="submit" class="btn btn-danger">Actualizar</button>
            <a href="{{ route('admin.gestoras.index') }}" class="btn btn-outline-secondary">Cancelar</a>
        </div>
    </form>
</div>
@endsection

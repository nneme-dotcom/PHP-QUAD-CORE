@extends('layouts.app')
@section('title', 'Nueva Gestora')
@section('content')
<h4 class="mb-4"><i class="bi bi-building-add"></i> Nueva Empresa Gestora</h4>
<div class="card border-0 shadow-sm p-4" style="max-width:600px">
    @if($errors->any())
        <div class="alert alert-danger">{{ $errors->first() }}</div>
    @endif
    <p class="text-muted small">Se creará automáticamente un usuario con rol <strong>gestora</strong> vinculado a esta empresa.</p>
    <form method="POST" action="{{ route('admin.gestoras.store') }}">
        @csrf
        <div class="row g-3">
            <div class="col-md-6">
                <label class="form-label">Nombre empresa *</label>
                <input type="text" name="nombre" class="form-control" value="{{ old('nombre') }}" required>
            </div>
            <div class="col-md-6">
                <label class="form-label">CIF *</label>
                <input type="text" name="cif" class="form-control" value="{{ old('cif') }}" required>
            </div>
            <div class="col-md-6">
                <label class="form-label">Email (acceso) *</label>
                <input type="email" name="email" class="form-control" value="{{ old('email') }}" required>
            </div>
            <div class="col-md-6">
                <label class="form-label">Teléfono</label>
                <input type="text" name="telefono" class="form-control" value="{{ old('telefono') }}">
            </div>
            <div class="col-md-6">
                <label class="form-label">% Comisión *</label>
                <div class="input-group">
                    <input type="number" name="porcentaje_comision" class="form-control"
                           value="{{ old('porcentaje_comision', 5) }}" step="0.01" min="0" max="100" required>
                    <span class="input-group-text">%</span>
                </div>
            </div>
            <div class="col-md-6">
                <label class="form-label">Contraseña acceso *</label>
                <input type="password" name="password" class="form-control" required>
            </div>
        </div>
        <div class="d-flex gap-2 mt-4">
            <button type="submit" class="btn btn-danger">Crear Gestora</button>
            <a href="{{ route('admin.gestoras.index') }}" class="btn btn-outline-secondary">Cancelar</a>
        </div>
    </form>
</div>
@endsection

@extends('layouts.app')
@section('title', 'Nuevo Usuario')
@section('content')
<h4 class="mb-4"><i class="bi bi-person-plus"></i> Nuevo Usuario</h4>
<div class="card border-0 shadow-sm p-4" style="max-width:600px">
    @if($errors->any())
        <div class="alert alert-danger">{{ $errors->first() }}</div>
    @endif
    <form method="POST" action="{{ route('admin.usuarios.store') }}">
        @csrf
        <div class="row g-3">
            <div class="col-md-6">
                <label class="form-label">Nombre *</label>
                <input type="text" name="nombre" class="form-control" value="{{ old('nombre') }}" required>
            </div>
            <div class="col-md-6">
                <label class="form-label">Apellidos</label>
                <input type="text" name="apellidos" class="form-control" value="{{ old('apellidos') }}">
            </div>
            <div class="col-md-6">
                <label class="form-label">Email *</label>
                <input type="email" name="email" class="form-control" value="{{ old('email') }}" required>
            </div>
            <div class="col-md-6">
                <label class="form-label">Teléfono</label>
                <input type="text" name="telefono" class="form-control" value="{{ old('telefono') }}">
            </div>
            <div class="col-md-6">
                <label class="form-label">Rol *</label>
                <select name="rol" class="form-select" required>
                    @foreach(['admin','tecnico','particular','gestora'] as $rol)
                        <option value="{{ $rol }}" {{ old('rol') === $rol ? 'selected' : '' }}>{{ ucfirst($rol) }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-6">
                <label class="form-label">Contraseña *</label>
                <input type="password" name="password" class="form-control" required>
            </div>
        </div>
        <div class="d-flex gap-2 mt-4">
            <button type="submit" class="btn btn-danger">Guardar</button>
            <a href="{{ route('admin.usuarios.index') }}" class="btn btn-outline-secondary">Cancelar</a>
        </div>
    </form>
</div>
@endsection

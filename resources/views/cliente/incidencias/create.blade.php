@extends('layouts.app')
@section('title', 'Nueva Incidencia')
@section('content')
<h4 class="mb-4"><i class="bi bi-clipboard-plus"></i> Nueva Incidencia</h4>
<div class="card border-0 shadow-sm p-4" style="max-width:650px">
    <form method="POST" action="{{ route('cliente.incidencias.store') }}">
        @csrf
        <div class="row g-3">
            <div class="col-md-6">
                <label class="form-label">Especialidad *</label>
                <select name="especialidad_id" class="form-select @error('especialidad_id') is-invalid @enderror" required>
                    <option value="">— Selecciona —</option>
                    @foreach($especialidades as $e)
                        <option value="{{ $e->id }}" {{ old('especialidad_id') == $e->id ? 'selected' : '' }}>
                            {{ $e->nombre_especialidad }}
                        </option>
                    @endforeach
                </select>
                @error('especialidad_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="col-md-6">
                <label class="form-label">Teléfono de contacto *</label>
                <input type="text" name="telefono_contacto"
                       class="form-control @error('telefono_contacto') is-invalid @enderror"
                       value="{{ old('telefono_contacto') }}"
                       placeholder="Ej: 612 345 678" required>
                @error('telefono_contacto')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="col-12">
                <label class="form-label">Dirección del servicio *</label>
                <input type="text" name="direccion"
                       class="form-control @error('direccion') is-invalid @enderror"
                       value="{{ old('direccion') }}"
                       placeholder="Ej: C/ Mayor 12, 2ºB, Madrid" required>
                @error('direccion')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="col-12">
                <label class="form-label">Descripción del problema *</label>
                <textarea name="descripcion" rows="3"
                          class="form-control @error('descripcion') is-invalid @enderror"
                          placeholder="Describe brevemente el problema..." required>{{ old('descripcion') }}</textarea>
                @error('descripcion')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="col-md-4">
                <label class="form-label">Fecha *</label>
                <input type="date" name="fecha_servicio"
                       class="form-control @error('fecha_servicio') is-invalid @enderror"
                       value="{{ old('fecha_servicio') }}" required>
                @error('fecha_servicio')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="col-md-4">
                <label class="form-label">Franja horaria *</label>
                <select name="franja_horaria" class="form-select @error('franja_horaria') is-invalid @enderror" required>
                    <option value="manana" {{ old('franja_horaria') === 'manana' ? 'selected' : '' }}>Mañana</option>
                    <option value="tarde"  {{ old('franja_horaria') === 'tarde'  ? 'selected' : '' }}>Tarde</option>
                </select>
                @error('franja_horaria')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="col-md-4">
                <label class="form-label">Urgencia *</label>
                <select name="tipo_urgencia" class="form-select @error('tipo_urgencia') is-invalid @enderror" required>
                    <option value="Estandar" {{ old('tipo_urgencia') === 'Estandar' ? 'selected' : '' }}>Estándar</option>
                    <option value="Urgente"  {{ old('tipo_urgencia') === 'Urgente'  ? 'selected' : '' }}>Urgente</option>
                </select>
                @error('tipo_urgencia')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
        </div>
        <div class="d-flex gap-2 mt-4">
            <button type="submit" class="btn btn-danger">Enviar aviso</button>
            <a href="{{ route('cliente.incidencias.index') }}" class="btn btn-outline-secondary">Cancelar</a>
        </div>
    </form>
</div>
@endsection

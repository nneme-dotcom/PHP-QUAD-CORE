<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Gestión de Gestoras - Producto 3</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container mt-5">
        <div class="card shadow">
            <div class="card-header bg-primary text-white">
                <h2 class="mb-0">Gestoras de Fincas - Reparaya</h2>
            </div>
            <div class="card-body">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>Email</th>
                            <th>Teléfono</th>
                            <th>Comisión (5%)</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($gestoras as $gestora)
                        <tr>
                            <td>{{ $gestora->id }}</td>
                            <td>{{ $gestora->nombre }}</td>
                            <td>{{ $gestora->email }}</td>
                            <td>{{ $gestora->telefono }}</td>
                            <td class="fw-bold text-success">{{ number_format($gestora->comision_acumulada, 2) }} €</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

                @if($gestoras->isEmpty())
                    <p class="text-center">No hay gestoras registradas todavía.</p>
                @endif
            </div>
        </div>
    </div>
</body>
</html>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ReparaYa – Iniciar sesión</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
        body { background: #f1f3f5; }
        .login-card { max-width: 420px; margin: 80px auto; }
        .brand { color: #e74c3c; font-size: 2rem; font-weight: 700; }
    </style>
</head>
<body>
<div class="login-card card shadow-sm border-0 p-4">
    <div class="text-center mb-4">
        <div class="brand"><i class="bi bi-tools"></i> ReparaYa</div>
        <p class="text-muted">Accede a tu panel</p>
    </div>

    @if($errors->any())
        <div class="alert alert-danger">{{ $errors->first() }}</div>
    @endif

    <form method="POST" action="{{ route('login.post') }}">
        @csrf
        <div class="mb-3">
            <label class="form-label">Email</label>
            <input type="email" name="email" class="form-control"
                   value="{{ old('email') }}" required autofocus>
        </div>
        <div class="mb-4">
            <label class="form-label">Contraseña</label>
            <input type="password" name="password" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-danger w-100">
            <i class="bi bi-box-arrow-in-right"></i> Entrar
        </button>
    </form>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

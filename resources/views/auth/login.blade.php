<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ReparaYa – Iniciar sesión</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'DM Sans', sans-serif;
            background: #f4f5f7;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .login-wrap { width: 100%; max-width: 400px; padding: 1rem; }
        .brand-icon {
            width: 52px; height: 52px;
            background: #e74c3c;
            border-radius: 14px;
            display: flex; align-items: center; justify-content: center;
            margin: 0 auto 1rem;
        }
        .brand-icon i { color: #fff; font-size: 1.4rem; }
        .form-control, .form-select {
            border-color: #e2e5e9;
            border-radius: 8px;
            font-size: .9rem;
            padding: .55rem .85rem;
        }
        .form-control:focus { border-color: #e74c3c; box-shadow: 0 0 0 3px rgba(231,76,60,.12); }
        .btn-login {
            background: #e74c3c; border: none; border-radius: 8px;
            color: #fff; font-weight: 600; font-size: .9rem;
            padding: .6rem; width: 100%;
            transition: background .15s, transform .1s;
        }
        .btn-login:hover { background: #c0392b; }
        .btn-login:active { transform: scale(.98); }
        .card { border-radius: 14px; border: 1px solid #e9ecef; }
    </style>
</head>
<body>
<div class="login-wrap">
    <div class="card shadow-sm p-4">
        <div class="text-center mb-4">
            <div class="brand-icon"><i class="bi bi-tools"></i></div>
            <h5 class="fw-600 mb-0" style="color:#1a1d23">ReparaYa</h5>
            <small class="text-muted">Accede a tu panel de gestión</small>
        </div>

        @if($errors->any())
            <div class="alert alert-danger py-2 px-3" style="font-size:.85rem;border-radius:8px">
                <i class="bi bi-exclamation-circle me-1"></i>{{ $errors->first() }}
            </div>
        @endif

        <form method="POST" action="{{ route('login.post') }}">
            @csrf
            <div class="mb-3">
                <label class="form-label fw-500" style="font-size:.85rem">Email</label>
                <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                       value="{{ old('email') }}" placeholder="tu@email.com" required autofocus>
            </div>
            <div class="mb-4">
                <label class="form-label fw-500" style="font-size:.85rem">Contraseña</label>
                <input type="password" name="password" class="form-control" placeholder="••••••••" required>
            </div>
            <button type="submit" class="btn-login">
                Entrar <i class="bi bi-arrow-right ms-1"></i>
            </button>
        </form>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php use App\Core\Auth; $u = Auth::user(); ?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width,initial-scale=1">
<title><?= htmlspecialchars($title ?? 'ReparaYa') ?></title>
<style>
:root{
  --bg:#0b0f14; --panel:#121821; --panel2:#0f141c;
  --border:#1f2a37; --text:#e5e7eb; --muted:#94a3b8;
  --accent:#84cc16; --accent2:#a3e635; --danger:#ef4444;
  --warn:#f59e0b; --info:#38bdf8;
}
*{box-sizing:border-box} html,body{margin:0;padding:0}
body{font-family:-apple-system,BlinkMacSystemFont,"Segoe UI",Inter,Roboto,sans-serif;
     background:var(--bg);color:var(--text);font-size:15px;line-height:1.55}
a{color:var(--accent2);text-decoration:none} a:hover{text-decoration:underline}
.container{max-width:1180px;margin:0 auto;padding:0 22px}
.navbar{position:sticky;top:0;background:rgba(11,15,20,.85);backdrop-filter:blur(10px);
  border-bottom:1px solid var(--border);z-index:50}
.navbar-inner{display:flex;align-items:center;gap:24px;height:64px}
.brand{font-weight:800;font-size:18px;letter-spacing:.3px;color:#fff;display:flex;align-items:center;gap:10px}
.brand-dot{width:10px;height:10px;border-radius:50%;background:var(--accent);box-shadow:0 0 18px var(--accent)}
.nav-links{display:flex;gap:6px;flex:1;flex-wrap:wrap}
.nav-links a{padding:8px 14px;border-radius:8px;color:var(--muted);font-weight:500}
.nav-links a:hover{background:var(--panel);color:#fff;text-decoration:none}
.nav-user{display:flex;gap:8px;align-items:center}
.btn{display:inline-flex;align-items:center;gap:8px;padding:9px 16px;border-radius:9px;
  border:1px solid var(--border);background:var(--panel);color:#fff;cursor:pointer;
  font-size:14px;font-weight:600;text-decoration:none;transition:.15s}
.btn:hover{border-color:var(--accent);text-decoration:none}
.btn-primary{background:var(--accent);color:#0b0f14;border-color:var(--accent)}
.btn-primary:hover{background:var(--accent2);border-color:var(--accent2)}
.btn-danger{background:transparent;color:var(--danger);border-color:#3b1f24}
.btn-danger:hover{background:#1f1316;border-color:var(--danger)}
.btn-sm{padding:6px 12px;font-size:13px}
main{padding:28px 0 60px}
.card{background:var(--panel);border:1px solid var(--border);border-radius:14px;padding:24px;margin-bottom:18px}
.card h2{margin:0 0 16px;font-size:20px}
.grid{display:grid;gap:18px}
.grid-2{grid-template-columns:repeat(auto-fit,minmax(280px,1fr))}
.grid-3{grid-template-columns:repeat(auto-fit,minmax(220px,1fr))}
.grid-4{grid-template-columns:repeat(auto-fit,minmax(180px,1fr))}
.stat{background:var(--panel2);border:1px solid var(--border);border-radius:12px;padding:18px}
.stat .label{color:var(--muted);font-size:12px;text-transform:uppercase;letter-spacing:.5px}
.stat .value{font-size:32px;font-weight:800;margin-top:4px;color:#fff}
table{width:100%;border-collapse:collapse}
th,td{padding:12px 14px;border-bottom:1px solid var(--border);text-align:left;font-size:14px}
th{color:var(--muted);font-weight:600;text-transform:uppercase;font-size:11px;letter-spacing:.5px}
tr:hover td{background:var(--panel2)}
.badge{display:inline-block;padding:4px 10px;border-radius:999px;font-size:11px;font-weight:700;text-transform:uppercase;letter-spacing:.4px}
.badge-pendiente{background:#1e293b;color:#94a3b8}
.badge-asignada{background:#0c2742;color:#38bdf8}
.badge-finalizada{background:#1a2e1a;color:#84cc16}
.badge-cancelada{background:#2c1a1a;color:#ef4444}
.badge-urgente{background:#3b1f1f;color:#ef4444}
.badge-estandar{background:#1f2e1a;color:#84cc16}
.badge-admin{background:#3b2c1f;color:#f59e0b}
.badge-tecnico{background:#0c2742;color:#38bdf8}
.badge-particular{background:#1e293b;color:#94a3b8}
form .field{margin-bottom:14px;display:flex;flex-direction:column;gap:6px}
form label{font-size:13px;color:var(--muted);font-weight:600}
form input,form select,form textarea{
  background:var(--panel2);border:1px solid var(--border);color:var(--text);
  padding:10px 12px;border-radius:9px;font:inherit;width:100%}
form input:focus,form select:focus,form textarea:focus{outline:none;border-color:var(--accent)}
.alert{padding:12px 16px;border-radius:9px;margin-bottom:18px;font-size:14px}
.alert-error{background:#2c1a1a;border:1px solid #5c2222;color:#fca5a5}
.alert-success{background:#1a2e1a;border:1px solid #2f5c2f;color:#bef264}
.alert-info{background:#0c2742;border:1px solid #1e4d6b;color:#7dd3fc}
.actions{display:flex;gap:8px;flex-wrap:wrap}
hr{border:none;border-top:1px solid var(--border);margin:24px 0}
.hero{padding:80px 0;text-align:center;background:radial-gradient(ellipse at top,#1a2e1a 0%,var(--bg) 70%)}
.hero h1{font-size:56px;margin:0 0 16px;font-weight:800;color:#fff;letter-spacing:-1px}
.hero h1 span{background:linear-gradient(135deg,var(--accent),var(--accent2));
  -webkit-background-clip:text;background-clip:text;color:transparent}
.hero p{font-size:19px;color:var(--muted);max-width:620px;margin:0 auto 28px}
.muted{color:var(--muted)}
.spacer{height:18px}
@media(max-width:720px){
  .hero h1{font-size:40px}
  .nav-links a{padding:6px 10px;font-size:13px}
}
</style>
</head>
<body>

<header class="navbar">
  <div class="container navbar-inner">
    <a href="<?= BASE_URL ?>/" class="brand"><span class="brand-dot"></span> ReparaYa</a>
    <nav class="nav-links">
      <a href="<?= BASE_URL ?>/">Inicio</a>
      <a href="<?= BASE_URL ?>/caracteristicas">Caracteristicas</a>
      <a href="<?= BASE_URL ?>/como-funciona">Como funciona</a>
      <a href="<?= BASE_URL ?>/contacto">Contacto</a>
      <?php if ($u && $u['rol']==='admin'): ?>
        <a href="<?= BASE_URL ?>/admin">Panel</a>
        <a href="<?= BASE_URL ?>/admin/incidencias">Incidencias</a>
        <a href="<?= BASE_URL ?>/admin/calendario">Calendario</a>
        <a href="<?= BASE_URL ?>/admin/tecnicos">Tecnicos</a>
        <a href="<?= BASE_URL ?>/admin/especialidades">Especialidades</a>
        <a href="<?= BASE_URL ?>/admin/usuarios">Usuarios</a>
      <?php elseif ($u && $u['rol']==='tecnico'): ?>
        <a href="<?= BASE_URL ?>/tecnico">Mi panel</a>
        <a href="<?= BASE_URL ?>/tecnico/agenda">Mi agenda</a>
      <?php elseif ($u && $u['rol']==='particular'): ?>
        <a href="<?= BASE_URL ?>/cliente">Mi panel</a>
        <a href="<?= BASE_URL ?>/cliente/avisos">Mis avisos</a>
        <a href="<?= BASE_URL ?>/cliente/avisos/nuevo">Nueva solicitud</a>
      <?php endif; ?>
    </nav>
    <div class="nav-user">
      <?php if ($u): ?>
        <a href="<?= BASE_URL ?>/perfil" class="btn btn-sm">Hola, <?= htmlspecialchars($u['nombre']) ?></a>
        <a href="<?= BASE_URL ?>/logout" class="btn btn-sm">Salir</a>
      <?php else: ?>
        <a href="<?= BASE_URL ?>/login" class="btn btn-sm">Acceder</a>
        <a href="<?= BASE_URL ?>/registro" class="btn btn-sm btn-primary">Registro</a>
      <?php endif; ?>
    </div>
  </div>
</header>

<main class="container">
<?= $content ?>
</main>

<footer style="border-top:1px solid var(--border);padding:24px 0;color:var(--muted);font-size:13px">
  <div class="container" style="display:flex;justify-content:space-between;flex-wrap:wrap;gap:10px">
    <span>&copy; <?= date('Y') ?> ReparaYa - PHP QUAD-CORE - FP.448</span>
    <span>PHP nativo MVC + MySQL + Docker</span>
  </div>
</footer>
</body>
</html>

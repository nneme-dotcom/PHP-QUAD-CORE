<?php use App\Core\Auth; $u = Auth::user(); ?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width,initial-scale=1">
<title><?= htmlspecialchars($title ?? 'ReparaYa') ?></title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:ital,wght@0,600;0,700;0,800;1,700&family=DM+Sans:ital,wght@0,300;0,400;0,500;0,600;1,400&display=swap" rel="stylesheet">
<style>
/* ─── TOKENS ───────────────────────────────────────────────────── */
:root {
  --blue:      #3C91E6;
  --blue-dark: #2a7bd4;
  --blue-dim:  #dbeeff;
  --orange:    #FFA10A;
  --orange-dk: #e08900;
  --cream:     #E9F7CA;
  --cream-dk:  #d4efaa;
  --white:     #ffffff;
  --bg:        #F4F8FF;
  --surface:   #ffffff;
  --surface2:  #f0f5fd;
  --border:    #dde8f5;
  --text:      #1a2540;
  --muted:     #6b7fa3;
  --danger:    #e03c3c;
  --warn:      #f59e0b;
  --success:   #22c55e;
  --info:      #3C91E6;
  --radius:    14px;
  --radius-sm: 8px;
  --shadow:    0 2px 12px rgba(60,145,230,.10);
  --shadow-md: 0 6px 28px rgba(60,145,230,.15);
}
/* ─── RESET ────────────────────────────────────────────────────── */
*{box-sizing:border-box}
html,body{margin:0;padding:0}
body{
  font-family:'DM Sans',system-ui,sans-serif;
  background:var(--bg);
  color:var(--text);
  font-size:15px;
  line-height:1.6;
  -webkit-font-smoothing:antialiased;
}
a{color:var(--blue);text-decoration:none}
a:hover{text-decoration:underline}
/* ─── LAYOUT ───────────────────────────────────────────────────── */
.container{max-width:1180px;margin:0 auto;padding:0 24px}
/* ─── NAVBAR ───────────────────────────────────────────────────── */
.navbar{
  position:sticky;top:0;
  background:rgba(255,255,255,.92);
  backdrop-filter:blur(14px);
  border-bottom:1px solid var(--border);
  z-index:100;
  box-shadow:0 1px 8px rgba(60,145,230,.08);
}
.navbar-inner{display:flex;align-items:center;gap:20px;height:66px}
.brand{
  font-family:'Plus Jakarta Sans',sans-serif;
  font-weight:800;font-size:20px;
  display:flex;align-items:center;gap:10px;
  color:var(--text);letter-spacing:-.3px;
  flex-shrink:0;
}
.brand span.r{color:var(--blue)}
.brand span.ya{color:var(--orange)}
.brand-icon{
  width:34px;height:34px;border-radius:10px;
  background:linear-gradient(135deg,var(--blue),var(--blue-dark));
  display:flex;align-items:center;justify-content:center;
  box-shadow:0 4px 12px rgba(60,145,230,.35);
  flex-shrink:0;
}
.brand-icon svg{width:18px;height:18px;fill:#fff}
.nav-links{display:flex;gap:2px;flex:1;flex-wrap:wrap}
.nav-links a{
  padding:7px 13px;border-radius:9px;
  color:var(--muted);font-weight:500;font-size:14px;
  transition:background .15s,color .15s;
}
.nav-links a:hover{background:var(--surface2);color:var(--blue);text-decoration:none}
.nav-links a.active{background:var(--blue-dim);color:var(--blue);font-weight:600}
.nav-user{display:flex;gap:8px;align-items:center;flex-shrink:0}
/* ─── BUTTONS ──────────────────────────────────────────────────── */
.btn{
  display:inline-flex;align-items:center;gap:7px;
  padding:9px 18px;border-radius:var(--radius-sm);
  border:1.5px solid var(--border);
  background:var(--surface);color:var(--text);
  cursor:pointer;font-size:14px;font-weight:600;
  font-family:'DM Sans',sans-serif;
  text-decoration:none;
  transition:all .18s;
  line-height:1;
}
.btn:hover{border-color:var(--blue);color:var(--blue);text-decoration:none;transform:translateY(-1px);box-shadow:var(--shadow)}
.btn-primary{
  background:var(--blue);color:#fff;
  border-color:var(--blue);
  box-shadow:0 3px 14px rgba(60,145,230,.35);
}
.btn-primary:hover{background:var(--blue-dark);border-color:var(--blue-dark);color:#fff;box-shadow:0 6px 20px rgba(60,145,230,.40)}
.btn-orange{
  background:var(--orange);color:#fff;
  border-color:var(--orange);
  box-shadow:0 3px 14px rgba(255,161,10,.30);
}
.btn-orange:hover{background:var(--orange-dk);border-color:var(--orange-dk);color:#fff;box-shadow:0 6px 20px rgba(255,161,10,.35)}
.btn-ghost{background:transparent;border-color:transparent;color:var(--muted)}
.btn-ghost:hover{background:var(--surface2);border-color:var(--border);color:var(--text)}
.btn-danger{background:transparent;color:var(--danger);border-color:#f8d7d7}
.btn-danger:hover{background:#fff0f0;border-color:var(--danger)}
.btn-sm{padding:6px 13px;font-size:13px;border-radius:7px}
.btn-lg{padding:13px 28px;font-size:16px;border-radius:11px}
/* ─── MAIN ─────────────────────────────────────────────────────── */
main{padding:32px 0 72px}
/* ─── CARDS ────────────────────────────────────────────────────── */
.card{
  background:var(--surface);
  border:1px solid var(--border);
  border-radius:var(--radius);
  padding:26px;margin-bottom:20px;
  box-shadow:var(--shadow);
  transition:box-shadow .2s;
}
.card:hover{box-shadow:var(--shadow-md)}
.card h2{margin:0 0 16px;font-size:19px;font-family:'Plus Jakarta Sans',sans-serif;font-weight:700;color:var(--text)}
/* ─── GRIDS ────────────────────────────────────────────────────── */
.grid{display:grid;gap:18px}
.grid-2{grid-template-columns:repeat(auto-fit,minmax(290px,1fr))}
.grid-3{grid-template-columns:repeat(auto-fit,minmax(230px,1fr))}
.grid-4{grid-template-columns:repeat(auto-fit,minmax(190px,1fr))}
/* ─── STAT CARDS ───────────────────────────────────────────────── */
.stat{
  background:var(--surface);
  border:1px solid var(--border);
  border-radius:var(--radius);
  padding:20px 22px;
  box-shadow:var(--shadow);
  position:relative;overflow:hidden;
}
.stat::before{
  content:'';position:absolute;top:0;left:0;right:0;height:3px;
  background:linear-gradient(90deg,var(--blue),var(--orange));
}
.stat .label{color:var(--muted);font-size:11px;text-transform:uppercase;letter-spacing:.6px;font-weight:600}
.stat .value{font-size:34px;font-weight:800;margin-top:6px;color:var(--text);font-family:'Plus Jakarta Sans',sans-serif;line-height:1}
/* ─── TABLES ───────────────────────────────────────────────────── */
.table-wrap{overflow-x:auto;border-radius:var(--radius-sm)}
table{width:100%;border-collapse:collapse}
th,td{padding:11px 14px;border-bottom:1px solid var(--border);text-align:left;font-size:14px}
th{color:var(--muted);font-weight:600;text-transform:uppercase;font-size:11px;letter-spacing:.5px;background:var(--surface2)}
th:first-child{border-top-left-radius:var(--radius-sm)}
th:last-child{border-top-right-radius:var(--radius-sm)}
tr:hover td{background:#f7fbff}
tr:last-child td{border-bottom:none}
/* ─── BADGES ───────────────────────────────────────────────────── */
.badge{
  display:inline-block;padding:4px 10px;
  border-radius:999px;font-size:11px;font-weight:700;
  text-transform:uppercase;letter-spacing:.4px;
}
.badge-pendiente{background:#f0f4ff;color:#6b7fa3;border:1px solid #dde8f5}
.badge-asignada{background:#dbeeff;color:#2a6db8;border:1px solid #b3d4f7}
.badge-finalizada{background:#dcfce7;color:#166534;border:1px solid #bbf7d0}
.badge-cancelada{background:#fff0f0;color:var(--danger);border:1px solid #fecaca}
.badge-urgente{background:#fff3e0;color:#c45f00;border:1px solid #fed7aa}
.badge-estandar{background:var(--cream);color:#4a6928;border:1px solid var(--cream-dk)}
.badge-admin{background:#fff8e1;color:#b45309;border:1px solid #fde68a}
.badge-tecnico{background:#dbeeff;color:var(--blue-dark);border:1px solid #b3d4f7}
.badge-particular{background:#f0f4ff;color:#4b6cb7;border:1px solid #dde8f5}
/* ─── FORMS ────────────────────────────────────────────────────── */
form .field{margin-bottom:16px;display:flex;flex-direction:column;gap:6px}
form label{font-size:13px;color:var(--muted);font-weight:600;letter-spacing:.02em}
form input,form select,form textarea{
  background:var(--bg);border:1.5px solid var(--border);
  color:var(--text);padding:10px 14px;
  border-radius:var(--radius-sm);
  font:inherit;width:100%;
  transition:border-color .18s,box-shadow .18s;
}
form input:focus,form select:focus,form textarea:focus{
  outline:none;
  border-color:var(--blue);
  box-shadow:0 0 0 3px rgba(60,145,230,.15);
}
/* ─── ALERTS ───────────────────────────────────────────────────── */
.alert{padding:12px 16px;border-radius:var(--radius-sm);margin-bottom:18px;font-size:14px;font-weight:500}
.alert-error{background:#fff0f0;border:1px solid #fecaca;color:#b91c1c}
.alert-success{background:#f0fdf4;border:1px solid #bbf7d0;color:#166534}
.alert-info{background:var(--blue-dim);border:1px solid #b3d4f7;color:#1e4d7b}
/* ─── MISC ─────────────────────────────────────────────────────── */
.actions{display:flex;gap:10px;flex-wrap:wrap}
hr{border:none;border-top:1px solid var(--border);margin:24px 0}
.muted{color:var(--muted)}
.spacer{height:16px}
/* ─── HERO (public) ────────────────────────────────────────────── */
.hero{
  padding:90px 0 80px;
  text-align:center;
  position:relative;overflow:hidden;
}
.hero-bg{
  position:absolute;inset:0;z-index:0;
  background:
    radial-gradient(ellipse 80% 60% at 50% -10%,rgba(60,145,230,.12) 0%,transparent 70%),
    radial-gradient(ellipse 50% 40% at 80% 110%,rgba(255,161,10,.10) 0%,transparent 60%),
    var(--bg);
}
.hero-bg::after{
  content:'';position:absolute;inset:0;
  background-image:radial-gradient(rgba(60,145,230,.07) 1.5px,transparent 1.5px);
  background-size:32px 32px;
}
.hero-content{position:relative;z-index:1}
.hero h1{
  font-family:'Plus Jakarta Sans',sans-serif;
  font-size:58px;font-weight:800;
  margin:0 0 18px;color:var(--text);
  letter-spacing:-1.5px;line-height:1.08;
}
.hero h1 .highlight{
  color:var(--blue);
  position:relative;display:inline-block;
}
.hero h1 .highlight::after{
  content:'';position:absolute;
  bottom:-4px;left:0;right:0;height:4px;
  background:linear-gradient(90deg,var(--blue),var(--orange));
  border-radius:2px;opacity:.6;
}
.hero p{font-size:19px;color:var(--muted);max-width:580px;margin:0 auto 32px;line-height:1.55}
/* ─── FOOTER ───────────────────────────────────────────────────── */
.site-footer{
  border-top:1px solid var(--border);
  padding:24px 0;
  background:var(--surface);
}
.site-footer .footer-inner{
  display:flex;justify-content:space-between;align-items:center;
  flex-wrap:wrap;gap:10px;
}
.site-footer span{font-size:13px;color:var(--muted)}
.site-footer .footer-brand{
  font-family:'Plus Jakarta Sans',sans-serif;font-weight:700;font-size:14px;
  color:var(--text);
}
.site-footer .footer-brand .r{color:var(--blue)}
.site-footer .footer-brand .ya{color:var(--orange)}
/* ─── RESPONSIVE ───────────────────────────────────────────────── */
@media(max-width:768px){
  .hero h1{font-size:38px;letter-spacing:-1px}
  .hero p{font-size:16px}
  .nav-links{display:none}
  .navbar-inner{gap:12px}
}
@media(max-width:480px){
  .hero{padding:60px 0 52px}
  .hero h1{font-size:30px}
}
/* ─── PAGE TRANSITIONS ─────────────────────────────────────────── */
@keyframes fadeUp{from{opacity:0;transform:translateY(16px)}to{opacity:1;transform:translateY(0)}}
main{animation:fadeUp .35s ease both}
/* ─── SECTION TITLES ───────────────────────────────────────────── */
.section-title{
  font-family:'Plus Jakarta Sans',sans-serif;font-weight:700;font-size:22px;
  color:var(--text);margin:0 0 20px;
}
.section-subtitle{color:var(--muted);margin-top:-14px;margin-bottom:22px;font-size:15px}
/* ─── FEATURE CARDS ────────────────────────────────────────────── */
.feature-card{
  background:var(--surface);border:1px solid var(--border);
  border-radius:var(--radius);padding:26px;
  box-shadow:var(--shadow);
  transition:transform .2s,box-shadow .2s;
  position:relative;overflow:hidden;
}
.feature-card::before{
  content:'';position:absolute;top:0;left:0;width:4px;height:100%;
  background:linear-gradient(180deg,var(--blue),var(--orange));
}
.feature-card:hover{transform:translateY(-3px);box-shadow:var(--shadow-md)}
.feature-card h2{font-family:'Plus Jakarta Sans',sans-serif;font-weight:700;font-size:17px;margin:0 0 12px}
.feature-card ul{list-style:none;margin:0;padding:0}
.feature-card li{
  padding:5px 0 5px 22px;position:relative;
  font-size:14px;color:var(--muted);border-bottom:1px solid var(--border);
}
.feature-card li:last-child{border-bottom:none}
.feature-card li::before{
  content:'✓';position:absolute;left:0;color:var(--blue);font-weight:700;font-size:13px;
}
/* ─── ICON BADGE ───────────────────────────────────────────────── */
.icon-badge{
  width:44px;height:44px;border-radius:12px;
  background:var(--blue-dim);
  display:flex;align-items:center;justify-content:center;
  margin-bottom:14px;font-size:22px;
}
/* ─── ORANGE ACCENT CHIP ───────────────────────────────────────── */
.chip{
  display:inline-flex;align-items:center;gap:6px;
  background:var(--cream);color:#4a6928;
  border:1px solid var(--cream-dk);
  padding:4px 12px;border-radius:999px;
  font-size:12px;font-weight:600;letter-spacing:.03em;
}
.chip-orange{background:#fff3e0;color:#c45f00;border-color:#fed7aa}
.chip-blue{background:var(--blue-dim);color:var(--blue-dark);border-color:#b3d4f7}
/* ─── FORM CARD CENTERED ───────────────────────────────────────── */
.form-card{max-width:460px;margin:48px auto}
.form-card .card-header{
  text-align:center;padding-bottom:20px;border-bottom:1px solid var(--border);margin-bottom:22px;
}
.form-card .card-header h2{margin:0;font-size:24px}
.form-card .card-header p{color:var(--muted);font-size:14px;margin:6px 0 0}
</style>
</head>
<body>

<header class="navbar">
  <div class="container navbar-inner">
    <a href="/" class="brand">
      <img src="/logo.png" alt="ReparaYa" style="height:44px;width:auto;display:block">
    </a>
    <nav class="nav-links">
      <a href="/">Inicio</a>
      <?php if ($u && $u['rol']==='admin'): ?>
        <a href="/admin">Panel</a>
        <a href="/admin/incidencias">Incidencias</a>
        <a href="/admin/calendario">Calendario</a>
        <a href="/admin/tecnicos">Técnicos</a>
        <a href="/admin/especialidades">Especialidades</a>
        <a href="/admin/usuarios">Usuarios</a>
      <?php elseif ($u && $u['rol']==='tecnico'): ?>
        <a href="/tecnico">Mi panel</a>
        <a href="/tecnico/agenda">Mi agenda</a>
      <?php elseif ($u && $u['rol']==='particular'): ?>
        <a href="/cliente">Mi panel</a>
        <a href="/cliente/avisos">Mis avisos</a>
        <a href="/cliente/avisos/nuevo">Nueva solicitud</a>
      <?php endif; ?>
    </nav>
    <div class="nav-user">
      <?php if ($u): ?>
        <a href="/perfil" class="btn btn-sm btn-ghost">👤 <?= htmlspecialchars($u['nombre']) ?></a>
        <a href="/logout" class="btn btn-sm">Salir</a>
      <?php else: ?>
        <a href="/login" class="btn btn-sm">Acceder</a>
        <a href="/registro" class="btn btn-sm btn-primary">Registro</a>
      <?php endif; ?>
    </div>
  </div>
</header>

<main class="container">
<?= $content ?>
</main>

<footer class="site-footer">
  <div class="container footer-inner">
    <div style="display:flex;align-items:center;gap:10px">
      <img src="/logo.png" alt="ReparaYa" style="height:36px;width:auto;opacity:.85">
      <span style="font-size:12px;color:var(--muted)">Servicio Técnico del Hogar</span>
    </div>
    <span>&copy; <?= date('Y') ?> PHP QUAD-CORE · FP.448</span>
    <span>PHP MVC + MySQL + Docker</span>
  </div>
</footer>
</body>
</html>

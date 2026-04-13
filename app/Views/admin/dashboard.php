<!-- Page header -->
<div style="display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:16px;margin-bottom:24px">
  <div>
    <span class="chip chip-orange">Administración</span>
    <h1 class="section-title" style="margin-top:10px;margin-bottom:4px">Panel de control</h1>
    <p class="muted" style="margin:0;font-size:14px">Resumen general del sistema ReparaYa</p>
  </div>
  <div class="actions">
    <a href="/admin/incidencias" class="btn btn-primary">Gestionar incidencias</a>
    <a href="/admin/calendario" class="btn">📅 Calendario</a>
  </div>
</div>

<!-- KPI Stats -->
<div class="grid grid-4" style="margin-bottom:24px">
  <div class="stat">
    <div class="label">Total avisos</div>
    <div class="value"><?= $stats['total'] ?></div>
  </div>
  <div class="stat" style="--accent-color:#6b7fa3">
    <div class="label">Pendientes</div>
    <div class="value" style="color:var(--muted)"><?= $stats['pendientes'] ?></div>
  </div>
  <div class="stat">
    <div class="label">Asignadas</div>
    <div class="value" style="color:var(--blue)"><?= $stats['asignadas'] ?></div>
  </div>
  <div class="stat">
    <div class="label">Urgentes</div>
    <div class="value" style="color:var(--danger)"><?= $stats['urgentes'] ?></div>
  </div>
</div>

<!-- Recent incidents table -->
<div class="card">
  <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:18px">
    <h2 style="margin:0">Avisos recientes</h2>
    <a href="/admin/incidencias" class="btn btn-sm">Ver todos →</a>
  </div>
  <div class="table-wrap">
    <table>
      <thead>
        <tr>
          <th>Localizador</th>
          <th>Cliente</th>
          <th>Servicio</th>
          <th>Fecha</th>
          <th>Estado</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($recientes as $i): ?>
        <tr>
          <td><code style="font-size:13px;background:var(--surface2);padding:2px 7px;border-radius:5px;color:var(--blue)"><?= htmlspecialchars($i['localizador']) ?></code></td>
          <td style="font-weight:500"><?= htmlspecialchars($i['cliente_nombre']) ?></td>
          <td><?= htmlspecialchars($i['nombre_especialidad']) ?></td>
          <td style="color:var(--muted);font-size:13px"><?= htmlspecialchars($i['fecha_servicio']) ?></td>
          <td><span class="badge badge-<?= strtolower($i['estado']) ?>"><?= $i['estado'] ?></span></td>
        </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>
</div>

<!-- Quick access -->
<div class="grid grid-3">
  <a href="/admin/tecnicos" class="card" style="text-decoration:none;display:flex;align-items:center;gap:14px;padding:20px 22px;transition:all .18s" onmouseover="this.style.borderColor='var(--blue)'" onmouseout="this.style.borderColor='var(--border)'">
    <div class="icon-badge" style="flex-shrink:0">🔧</div>
    <div>
      <div style="font-weight:700;font-size:15px">Técnicos</div>
      <div class="muted" style="font-size:13px">Gestionar profesionales</div>
    </div>
  </a>
  <a href="/admin/especialidades" class="card" style="text-decoration:none;display:flex;align-items:center;gap:14px;padding:20px 22px;transition:all .18s" onmouseover="this.style.borderColor='var(--orange)'" onmouseout="this.style.borderColor='var(--border)'">
    <div class="icon-badge" style="background:#fff3e0;flex-shrink:0">📋</div>
    <div>
      <div style="font-weight:700;font-size:15px">Especialidades</div>
      <div class="muted" style="font-size:13px">Tipos de servicio</div>
    </div>
  </a>
  <a href="/admin/usuarios" class="card" style="text-decoration:none;display:flex;align-items:center;gap:14px;padding:20px 22px;transition:all .18s" onmouseover="this.style.borderColor='var(--blue)'" onmouseout="this.style.borderColor='var(--border)'">
    <div class="icon-badge" style="background:var(--cream);flex-shrink:0">👥</div>
    <div>
      <div style="font-weight:700;font-size:15px">Usuarios</div>
      <div class="muted" style="font-size:13px">Gestionar cuentas</div>
    </div>
  </a>
</div>

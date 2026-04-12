<div class="card"><h2>Panel administrador</h2><p class="muted">Resumen general del sistema ReparaYa.</p></div>

<div class="grid grid-4">
  <div class="stat"><div class="label">Total avisos</div><div class="value"><?= $stats['total'] ?></div></div>
  <div class="stat"><div class="label">Pendientes</div><div class="value" style="color:#94a3b8"><?= $stats['pendientes'] ?></div></div>
  <div class="stat"><div class="label">Asignadas</div><div class="value" style="color:#38bdf8"><?= $stats['asignadas'] ?></div></div>
  <div class="stat"><div class="label">Urgentes</div><div class="value" style="color:#ef4444"><?= $stats['urgentes'] ?></div></div>
</div>

<div class="card">
  <h2>Avisos recientes</h2>
  <table>
    <tr><th>Localizador</th><th>Cliente</th><th>Servicio</th><th>Fecha</th><th>Estado</th></tr>
    <?php foreach ($recientes as $i): ?>
    <tr>
      <td><?= htmlspecialchars($i['localizador']) ?></td>
      <td><?= htmlspecialchars($i['cliente_nombre']) ?></td>
      <td><?= htmlspecialchars($i['nombre_especialidad']) ?></td>
      <td><?= htmlspecialchars($i['fecha_servicio']) ?></td>
      <td><span class="badge badge-<?= strtolower($i['estado']) ?>"><?= $i['estado'] ?></span></td>
    </tr>
    <?php endforeach; ?>
  </table>
  <div class="spacer"></div>
  <a href="/admin/incidencias" class="btn btn-primary">Gestionar incidencias</a>
  <a href="/admin/calendario" class="btn">Ver calendario</a>
</div>

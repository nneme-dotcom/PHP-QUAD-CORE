<div style="display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:16px;margin-bottom:24px">
  <div>
    <span class="chip chip-blue">Técnico</span>
    <h1 class="section-title" style="margin-top:10px;margin-bottom:4px">Mi panel</h1>
    <p class="muted" style="margin:0;font-size:14px">Aquí tienes los avisos asignados a ti.</p>
  </div>
  <a href="/tecnico/agenda" class="btn btn-primary">📅 Ver agenda completa</a>
</div>

<div class="card">
  <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:18px">
    <h2 style="margin:0">Próximos servicios</h2>
    <?php if (!empty($incs)): ?>
      <span class="chip chip-blue"><?= count($incs) ?> asignado<?= count($incs) !== 1 ? 's' : '' ?></span>
    <?php endif; ?>
  </div>

  <?php if (empty($incs)): ?>
    <div style="text-align:center;padding:40px 20px">
      <div style="font-size:40px;margin-bottom:12px">✅</div>
      <div style="font-weight:600;font-size:16px;margin-bottom:6px">Sin avisos pendientes</div>
      <p class="muted" style="font-size:14px;margin:0">No tienes avisos asignados por el momento.</p>
    </div>
  <?php else: ?>
    <div class="table-wrap">
      <table>
        <thead>
          <tr>
            <th>Localizador</th>
            <th>Cliente</th>
            <th>Servicio</th>
            <th>Fecha</th>
            <th>Dirección</th>
            <th>Estado</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($incs as $i): ?>
          <tr>
            <td><code style="font-size:13px;background:var(--surface2);padding:2px 7px;border-radius:5px;color:var(--blue)"><?= htmlspecialchars($i['localizador']) ?></code></td>
            <td style="font-weight:500"><?= htmlspecialchars($i['cliente_nombre']) ?></td>
            <td><?= htmlspecialchars($i['nombre_especialidad']) ?></td>
            <td style="color:var(--muted);font-size:13px"><?= htmlspecialchars($i['fecha_servicio']) ?></td>
            <td style="font-size:13px;max-width:180px;overflow:hidden;text-overflow:ellipsis;white-space:nowrap"><?= htmlspecialchars($i['direccion']) ?></td>
            <td><span class="badge badge-<?= strtolower($i['estado']) ?>"><?= $i['estado'] ?></span></td>
          </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  <?php endif; ?>
</div>

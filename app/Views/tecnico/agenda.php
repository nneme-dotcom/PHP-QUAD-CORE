<div style="display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:16px;margin-bottom:24px">
  <div>
    <span class="chip chip-blue">Técnico</span>
    <h1 class="section-title" style="margin-top:10px;margin-bottom:4px">Mi agenda</h1>
    <p class="muted" style="margin:0;font-size:14px">Todos tus servicios programados.</p>
  </div>
  <?php if (!empty($incs)): ?>
    <span class="chip chip-orange"><?= count($incs) ?> servicio<?= count($incs) !== 1 ? 's' : '' ?> programado<?= count($incs) !== 1 ? 's' : '' ?></span>
  <?php endif; ?>
</div>

<div class="card">
  <?php if (empty($incs)): ?>
    <div style="text-align:center;padding:48px 20px">
      <div style="font-size:44px;margin-bottom:14px">📅</div>
      <div style="font-weight:700;font-size:17px;margin-bottom:6px">Sin servicios programados</div>
      <p class="muted" style="font-size:14px;margin:0">Tu agenda está libre. El administrador te asignará nuevos servicios pronto.</p>
    </div>
  <?php else: ?>
    <div class="table-wrap">
      <table>
        <thead>
          <tr>
            <th>Fecha y franja</th>
            <th>Localizador</th>
            <th>Servicio</th>
            <th>Cliente</th>
            <th>Dirección</th>
            <th>Teléfono</th>
            <th>Estado</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($incs as $i): ?>
          <tr>
            <td>
              <div style="font-weight:600;font-size:13px"><?= htmlspecialchars(substr($i['fecha_servicio'],0,16)) ?></div>
              <div style="font-size:11px;color:var(--muted);text-transform:capitalize;margin-top:2px"><?= htmlspecialchars($i['franja_horaria']) ?></div>
            </td>
            <td><code style="font-size:12px;background:var(--surface2);padding:2px 7px;border-radius:5px;color:var(--blue)"><?= htmlspecialchars($i['localizador']) ?></code></td>
            <td style="font-size:14px"><?= htmlspecialchars($i['nombre_especialidad']) ?></td>
            <td style="font-weight:500;font-size:14px"><?= htmlspecialchars($i['cliente_nombre']) ?></td>
            <td style="font-size:13px;max-width:170px;overflow:hidden;text-overflow:ellipsis;white-space:nowrap"><?= htmlspecialchars($i['direccion']) ?></td>
            <td style="font-size:13px;color:var(--muted)"><?= htmlspecialchars($i['telefono_contacto']) ?></td>
            <td><span class="badge badge-<?= strtolower($i['estado']) ?>"><?= $i['estado'] ?></span></td>
          </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  <?php endif; ?>
</div>

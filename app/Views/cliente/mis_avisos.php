<?php use App\Core\Auth; ?>
<div style="display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:16px;margin-bottom:24px">
  <div>
    <span class="chip chip-blue">Mis solicitudes</span>
    <h1 class="section-title" style="margin-top:10px;margin-bottom:4px">Mis avisos</h1>
    <p class="muted" style="margin:0;font-size:14px">Historial de todas tus solicitudes de servicio.</p>
  </div>
  <a href="/cliente/avisos/nuevo" class="btn btn-primary btn-orange">🚨 Nueva solicitud</a>
</div>

<?php if (!empty($_GET['error'])): ?>
  <div class="alert alert-error"><?= htmlspecialchars($_GET['error']) ?></div>
<?php endif; ?>

<div class="card">
  <?php if (empty($incs)): ?>
    <div style="text-align:center;padding:48px 20px">
      <div style="font-size:44px;margin-bottom:14px">🔧</div>
      <div style="font-weight:700;font-size:17px;margin-bottom:6px">Aún no has creado ninguna solicitud</div>
      <p class="muted" style="font-size:14px;margin:0 0 20px;max-width:380px;margin-left:auto;margin-right:auto">¿Tienes una avería en casa? Solicita un técnico certificado en minutos.</p>
      <a href="/cliente/avisos/nuevo" class="btn btn-primary">Crear mi primera solicitud →</a>
    </div>
  <?php else: ?>
    <div class="table-wrap">
      <table>
        <thead>
          <tr>
            <th>Localizador</th>
            <th>Servicio</th>
            <th>Fecha</th>
            <th>Franja</th>
            <th>Urgencia</th>
            <th>Estado</th>
            <th>Técnico</th>
            <th></th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($incs as $i): ?>
          <tr>
            <td><a href="/cliente/avisos/ver?id=<?= $i['id'] ?>" style="font-weight:700;font-family:monospace;font-size:13px;color:var(--blue)"><?= htmlspecialchars($i['localizador']) ?></a></td>
            <td><?= htmlspecialchars($i['nombre_especialidad']) ?></td>
            <td style="font-size:13px;color:var(--muted)"><?= htmlspecialchars($i['fecha_servicio']) ?></td>
            <td style="font-size:13px;text-transform:capitalize"><?= htmlspecialchars($i['franja_horaria']) ?></td>
            <td><span class="badge badge-<?= strtolower($i['tipo_urgencia']) ?>"><?= $i['tipo_urgencia'] ?></span></td>
            <td><span class="badge badge-<?= strtolower($i['estado']) ?>"><?= $i['estado'] ?></span></td>
            <td style="font-size:13px;color:var(--muted)"><?= htmlspecialchars($i['tecnico_nombre'] ?? '—') ?></td>
            <td>
              <?php if ($i['estado'] !== 'Cancelada' && $i['estado'] !== 'Finalizada'): ?>
              <form method="post" action="/cliente/avisos/cancelar" style="display:inline">
                <input type="hidden" name="_csrf" value="<?= Auth::csrf() ?>">
                <input type="hidden" name="id" value="<?= $i['id'] ?>">
                <button class="btn btn-sm btn-danger" onclick="return confirm('¿Cancelar este aviso?')">Cancelar</button>
              </form>
              <?php endif; ?>
            </td>
          </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  <?php endif; ?>
</div>

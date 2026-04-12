<?php use App\Core\Auth; ?>
<div class="card">
  <h2>Mis avisos</h2>
  <?php if (!empty($_GET['error'])): ?><div class="alert alert-error"><?= htmlspecialchars($_GET['error']) ?></div><?php endif; ?>
  <a href="/cliente/avisos/nuevo" class="btn btn-primary">Nueva solicitud</a>
  <div class="spacer"></div>
  <?php if (empty($incs)): ?>
    <p class="muted">Aun no has creado ninguna solicitud.</p>
  <?php else: ?>
  <table>
    <tr><th>Localizador</th><th>Servicio</th><th>Fecha</th><th>Franja</th><th>Urgencia</th><th>Estado</th><th>Tecnico</th><th></th></tr>
    <?php foreach ($incs as $i): ?>
    <tr>
      <td><strong><?= htmlspecialchars($i['localizador']) ?></strong></td>
      <td><?= htmlspecialchars($i['nombre_especialidad']) ?></td>
      <td><?= htmlspecialchars($i['fecha_servicio']) ?></td>
      <td><?= htmlspecialchars($i['franja_horaria']) ?></td>
      <td><span class="badge badge-<?= strtolower($i['tipo_urgencia']) ?>"><?= $i['tipo_urgencia'] ?></span></td>
      <td><span class="badge badge-<?= strtolower($i['estado']) ?>"><?= $i['estado'] ?></span></td>
      <td><?= htmlspecialchars($i['tecnico_nombre'] ?? '-') ?></td>
      <td>
        <?php if ($i['estado'] !== 'Cancelada' && $i['estado'] !== 'Finalizada'): ?>
        <form method="post" action="/cliente/avisos/cancelar" style="display:inline">
          <input type="hidden" name="_csrf" value="<?= Auth::csrf() ?>">
          <input type="hidden" name="id" value="<?= $i['id'] ?>">
          <button class="btn btn-sm btn-danger" onclick="return confirm('Cancelar este aviso?')">Cancelar</button>
        </form>
        <?php endif; ?>
      </td>
    </tr>
    <?php endforeach; ?>
  </table>
  <?php endif; ?>
</div>

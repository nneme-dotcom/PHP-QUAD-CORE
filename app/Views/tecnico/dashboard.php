<div class="card">
  <h2>Mi panel</h2>
  <p class="muted">Aqui tienes los avisos asignados a ti.</p>
  <a href="/tecnico/agenda" class="btn btn-primary">Ver agenda completa</a>
</div>
<div class="card">
  <h2>Proximos servicios</h2>
  <?php if (empty($incs)): ?>
    <p class="muted">No tienes avisos asignados.</p>
  <?php else: ?>
  <table>
    <tr><th>Localizador</th><th>Cliente</th><th>Servicio</th><th>Fecha</th><th>Direccion</th><th>Estado</th></tr>
    <?php foreach ($incs as $i): ?>
    <tr>
      <td><?= htmlspecialchars($i['localizador']) ?></td>
      <td><?= htmlspecialchars($i['cliente_nombre']) ?></td>
      <td><?= htmlspecialchars($i['nombre_especialidad']) ?></td>
      <td><?= htmlspecialchars($i['fecha_servicio']) ?></td>
      <td><?= htmlspecialchars($i['direccion']) ?></td>
      <td><span class="badge badge-<?= strtolower($i['estado']) ?>"><?= $i['estado'] ?></span></td>
    </tr>
    <?php endforeach; ?>
  </table>
  <?php endif; ?>
</div>

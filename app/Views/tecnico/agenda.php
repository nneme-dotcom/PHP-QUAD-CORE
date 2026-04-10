<div class="card">
  <h2>Mi agenda</h2>
  <?php if (empty($incs)): ?>
    <p class="muted">No tienes servicios programados.</p>
  <?php else: ?>
  <table>
    <tr><th>Fecha</th><th>Localizador</th><th>Servicio</th><th>Cliente</th><th>Direccion</th><th>Telefono</th><th>Estado</th></tr>
    <?php foreach ($incs as $i): ?>
    <tr>
      <td><?= htmlspecialchars($i['fecha_servicio']) ?> (<?= $i['franja_horaria'] ?>)</td>
      <td><?= htmlspecialchars($i['localizador']) ?></td>
      <td><?= htmlspecialchars($i['nombre_especialidad']) ?></td>
      <td><?= htmlspecialchars($i['cliente_nombre']) ?></td>
      <td><?= htmlspecialchars($i['direccion']) ?></td>
      <td><?= htmlspecialchars($i['telefono_contacto']) ?></td>
      <td><span class="badge badge-<?= strtolower($i['estado']) ?>"><?= $i['estado'] ?></span></td>
    </tr>
    <?php endforeach; ?>
  </table>
  <?php endif; ?>
</div>

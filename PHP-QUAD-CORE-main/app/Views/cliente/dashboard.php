<div class="card">
  <h2>Bienvenido</h2>
  <p class="muted">Aqui puedes ver tus avisos y crear nuevas solicitudes.</p>
  <div class="actions">
    <a href="<?= BASE_URL ?>/cliente/avisos/nuevo" class="btn btn-primary">Nueva solicitud</a>
    <a href="<?= BASE_URL ?>/cliente/avisos" class="btn">Mis avisos</a>
  </div>
</div>

<div class="card">
  <h2>Ultimos avisos</h2>
  <?php if (empty($incs)): ?>
    <p class="muted">Aun no tienes avisos.</p>
  <?php else: ?>
  <table>
    <tr><th>Localizador</th><th>Servicio</th><th>Fecha</th><th>Urgencia</th><th>Estado</th></tr>
    <?php foreach (array_slice($incs,0,5) as $i): ?>
    <tr>
      <td><a href="<?= BASE_URL ?>/cliente/avisos/ver?id=<?= $i['id'] ?>"><?= htmlspecialchars($i['localizador']) ?></a></td>
      <td><?= htmlspecialchars($i['nombre_especialidad']) ?></td>
      <td><?= htmlspecialchars($i['fecha_servicio']) ?></td>
      <td><span class="badge badge-<?= strtolower($i['tipo_urgencia']) ?>"><?= $i['tipo_urgencia'] ?></span></td>
      <td><span class="badge badge-<?= strtolower($i['estado']) ?>"><?= $i['estado'] ?></span></td>
    </tr>
    <?php endforeach; ?>
  </table>
  <?php endif; ?>
</div>

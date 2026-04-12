<div class="card" style="max-width:680px;margin:20px auto">
  <h2>Aviso <?= htmlspecialchars($inc['localizador']) ?></h2>
  <p>
    <span class="badge badge-<?= strtolower($inc['estado']) ?>"><?= $inc['estado'] ?></span>
    <span class="badge badge-<?= strtolower($inc['tipo_urgencia']) ?>"><?= $inc['tipo_urgencia'] ?></span>
  </p>
  <p><strong>Servicio:</strong> <?= htmlspecialchars($inc['nombre_especialidad']) ?></p>
  <p><strong>Fecha:</strong> <?= htmlspecialchars($inc['fecha_servicio']) ?> (<?= $inc['franja_horaria'] ?>)</p>
  <p><strong>Direccion:</strong> <?= htmlspecialchars($inc['direccion']) ?></p>
  <p><strong>Telefono:</strong> <?= htmlspecialchars($inc['telefono_contacto']) ?></p>
  <p><strong>Tecnico asignado:</strong> <?= htmlspecialchars($inc['tecnico_nombre'] ?? 'Sin asignar') ?></p>
  <p><strong>Descripcion:</strong></p>
  <p class="muted"><?= nl2br(htmlspecialchars($inc['descripcion'])) ?></p>
  <a href="/cliente/avisos" class="btn">Volver</a>
</div>

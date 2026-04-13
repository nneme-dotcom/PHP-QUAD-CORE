<?php use App\Core\Auth; ?>
<div class="card">
  <h2>Gestion de incidencias</h2>
  <a href="<?= BASE_URL ?>/admin/incidencias/nueva" class="btn btn-primary">Nueva incidencia</a>
  <a href="<?= BASE_URL ?>/admin/calendario" class="btn">Calendario</a>
  <div class="spacer"></div>
  <table>
    <tr><th>Localizador</th><th>Cliente</th><th>Servicio</th><th>Fecha</th><th>Urgencia</th><th>Estado</th><th>Tecnico</th><th>Acciones</th></tr>
    <?php foreach ($incs as $i): ?>
    <tr>
      <td><strong><?= htmlspecialchars($i['localizador']) ?></strong></td>
      <td><?= htmlspecialchars($i['cliente_nombre']) ?></td>
      <td><?= htmlspecialchars($i['nombre_especialidad']) ?></td>
      <td><?= htmlspecialchars($i['fecha_servicio']) ?></td>
      <td><span class="badge badge-<?= strtolower($i['tipo_urgencia']) ?>"><?= $i['tipo_urgencia'] ?></span></td>
      <td><span class="badge badge-<?= strtolower($i['estado']) ?>"><?= $i['estado'] ?></span></td>
      <td>
        <form method="post" action="<?= BASE_URL ?>/admin/incidencias/asignar" style="display:inline-flex;gap:6px">
          <input type="hidden" name="_csrf" value="<?= Auth::csrf() ?>">
          <input type="hidden" name="id" value="<?= $i['id'] ?>">
          <select name="tecnico_id" onchange="this.form.submit()" style="font-size:12px;padding:4px">
            <option value="">-- Sin asignar --</option>
            <?php foreach ($tecs as $t): ?>
              <option value="<?= $t['id'] ?>" <?= $i['tecnico_id']==$t['id']?'selected':'' ?>>
                <?= htmlspecialchars($t['nombre_completo']) ?> (<?= $t['nombre_especialidad'] ?>)
              </option>
            <?php endforeach; ?>
          </select>
        </form>
      </td>
      <td class="actions">
        <a href="<?= BASE_URL ?>/admin/incidencias/editar?id=<?= $i['id'] ?>" class="btn btn-sm">Editar</a>
        <form method="post" action="<?= BASE_URL ?>/admin/incidencias/cancelar" style="display:inline">
          <input type="hidden" name="_csrf" value="<?= Auth::csrf() ?>">
          <input type="hidden" name="id" value="<?= $i['id'] ?>">
          <button class="btn btn-sm btn-danger" onclick="return confirm('Cancelar?')">Cancelar</button>
        </form>
      </td>
    </tr>
    <?php endforeach; ?>
  </table>
</div>

<?php use App\Core\Auth; ?>
<div class="card">
  <h2>Maestro de tecnicos</h2>
  <a href="<?= BASE_URL ?>/admin/tecnicos/nuevo" class="btn btn-primary">Nuevo tecnico</a>
  <div class="spacer"></div>
  <table>
    <tr><th>Nombre</th><th>Especialidad</th><th>Email login</th><th>Disponible</th><th>Acciones</th></tr>
    <?php foreach ($tecs as $t): ?>
    <tr>
      <td><?= htmlspecialchars($t['nombre_completo']) ?></td>
      <td><?= htmlspecialchars($t['nombre_especialidad'] ?? '-') ?></td>
      <td><?= htmlspecialchars($t['email'] ?? '-') ?></td>
      <td><?= $t['disponible'] ? 'Si' : 'No' ?></td>
      <td class="actions">
        <a href="<?= BASE_URL ?>/admin/tecnicos/editar?id=<?= $t['id'] ?>" class="btn btn-sm">Editar</a>
        <form method="post" action="<?= BASE_URL ?>/admin/tecnicos/borrar" style="display:inline">
          <input type="hidden" name="_csrf" value="<?= Auth::csrf() ?>">
          <input type="hidden" name="id" value="<?= $t['id'] ?>">
          <button class="btn btn-sm btn-danger" onclick="return confirm('Borrar?')">Borrar</button>
        </form>
      </td>
    </tr>
    <?php endforeach; ?>
  </table>
</div>

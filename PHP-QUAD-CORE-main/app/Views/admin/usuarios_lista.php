<?php use App\Core\Auth; ?>
<div class="card">
  <h2>Usuarios del sistema</h2>
  <table>
    <tr><th>ID</th><th>Nombre</th><th>Email</th><th>Telefono</th><th>Rol</th><th>Alta</th><th>Acciones</th></tr>
    <?php foreach ($users as $u): ?>
    <tr>
      <td>#<?= $u['id'] ?></td>
      <td><?= htmlspecialchars($u['nombre'] . ' ' . ($u['apellidos'] ?? '')) ?></td>
      <td><?= htmlspecialchars($u['email']) ?></td>
      <td><?= htmlspecialchars($u['telefono'] ?? '-') ?></td>
      <td><span class="badge badge-<?= $u['rol'] ?>"><?= $u['rol'] ?></span></td>
      <td><?= htmlspecialchars($u['created_at']) ?></td>
      <td class="actions">
        <a href="<?= BASE_URL ?>/admin/usuarios/editar?id=<?= $u['id'] ?>" class="btn btn-sm">Editar</a>
        <form method="post" action="<?= BASE_URL ?>/admin/usuarios/borrar" style="display:inline">
          <input type="hidden" name="_csrf" value="<?= Auth::csrf() ?>">
          <input type="hidden" name="id" value="<?= $u['id'] ?>">
          <button class="btn btn-sm btn-danger" onclick="return confirm('Borrar usuario?')">Borrar</button>
        </form>
      </td>
    </tr>
    <?php endforeach; ?>
  </table>
</div>

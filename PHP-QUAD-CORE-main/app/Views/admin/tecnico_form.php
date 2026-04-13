<?php use App\Core\Auth; $editing = !empty($tec); ?>
<div class="card" style="max-width:620px;margin:20px auto">
  <h2><?= $editing ? 'Editar tecnico' : 'Nuevo tecnico' ?></h2>
  <form method="post" action="<?= BASE_URL . ($editing ? '/admin/tecnicos/editar' : '/admin/tecnicos/nuevo') ?>">
    <input type="hidden" name="_csrf" value="<?= Auth::csrf() ?>">
    <?php if ($editing): ?><input type="hidden" name="id" value="<?= $tec['id'] ?>"><?php endif; ?>

    <div class="field"><label>Nombre completo</label>
      <input name="nombre_completo" required value="<?= $editing ? htmlspecialchars($tec['nombre_completo']) : '' ?>">
    </div>

    <div class="field"><label>Especialidad</label>
      <select name="especialidad_id" required>
        <?php foreach ($especialidades as $e): ?>
          <option value="<?= $e['id'] ?>" <?= ($editing && $tec['especialidad_id']==$e['id'])?'selected':'' ?>>
            <?= htmlspecialchars($e['nombre_especialidad']) ?>
          </option>
        <?php endforeach; ?>
      </select>
    </div>

    <div class="field"><label>Usuario de login (opcional)</label>
      <select name="usuario_id">
        <option value="">-- Sin login asociado --</option>
        <?php foreach ($usuarios as $u): ?>
          <option value="<?= $u['id'] ?>" <?= ($editing && $tec['usuario_id']==$u['id'])?'selected':'' ?>>
            <?= htmlspecialchars($u['nombre'] . ' (' . $u['email'] . ')') ?>
          </option>
        <?php endforeach; ?>
      </select>
    </div>

    <div class="field">
      <label><input type="checkbox" name="disponible" value="1"
        <?= (!$editing || !empty($tec['disponible'])) ? 'checked' : '' ?>> Disponible</label>
    </div>

    <button class="btn btn-primary"><?= $editing ? 'Guardar' : 'Crear tecnico' ?></button>
    <a href="<?= BASE_URL ?>/admin/tecnicos" class="btn">Cancelar</a>
  </form>
</div>

<?php use App\Core\Auth; $editing = !empty($inc); ?>
<div class="card" style="max-width:760px;margin:20px auto">
  <h2><?= $editing ? 'Editar incidencia ' . htmlspecialchars($inc['localizador']) : 'Nueva incidencia' ?></h2>
  <form method="post" action="<?= BASE_URL . ($editing ? '/admin/incidencias/editar' : '/admin/incidencias/nueva') ?>">
    <input type="hidden" name="_csrf" value="<?= Auth::csrf() ?>">
    <?php if ($editing): ?><input type="hidden" name="id" value="<?= $inc['id'] ?>"><?php endif; ?>

    <?php if (!$editing): ?>
    <div class="field"><label>Cliente</label>
      <select name="cliente_id" required>
        <?php foreach ($clientes as $c): ?>
          <option value="<?= $c['id'] ?>"><?= htmlspecialchars($c['nombre'] . ' ' . $c['apellidos']) ?> (<?= $c['email'] ?>)</option>
        <?php endforeach; ?>
      </select>
    </div>
    <?php endif; ?>

    <div class="grid grid-2">
      <div class="field"><label>Especialidad</label>
        <select name="especialidad_id" required>
          <?php foreach ($especialidades as $e): ?>
            <option value="<?= $e['id'] ?>" <?= ($editing && $inc['especialidad_id']==$e['id'])?'selected':'' ?>>
              <?= htmlspecialchars($e['nombre_especialidad']) ?>
            </option>
          <?php endforeach; ?>
        </select>
      </div>
      <div class="field"><label>Tipo</label>
        <select name="tipo_urgencia">
          <option value="Estandar" <?= ($editing && $inc['tipo_urgencia']=='Estandar')?'selected':'' ?>>Estandar</option>
          <option value="Urgente"  <?= ($editing && $inc['tipo_urgencia']=='Urgente')?'selected':'' ?>>Urgente</option>
        </select>
      </div>
    </div>

    <div class="grid grid-2">
      <div class="field"><label>Fecha y hora</label>
        <input type="datetime-local" name="fecha_servicio" required
               value="<?= $editing ? str_replace(' ','T',substr($inc['fecha_servicio'],0,16)) : '' ?>">
      </div>
      <div class="field"><label>Franja</label>
        <select name="franja_horaria">
          <option value="manana" <?= ($editing && $inc['franja_horaria']=='manana')?'selected':'' ?>>Manana</option>
          <option value="tarde"  <?= ($editing && $inc['franja_horaria']=='tarde')?'selected':'' ?>>Tarde</option>
        </select>
      </div>
    </div>

    <div class="field"><label>Direccion</label>
      <input name="direccion" required value="<?= $editing ? htmlspecialchars($inc['direccion']) : '' ?>">
    </div>
    <div class="field"><label>Telefono de contacto</label>
      <input name="telefono_contacto" required value="<?= $editing ? htmlspecialchars($inc['telefono_contacto']) : '' ?>">
    </div>
    <div class="field"><label>Descripcion</label>
      <textarea name="descripcion" rows="4" required><?= $editing ? htmlspecialchars($inc['descripcion']) : '' ?></textarea>
    </div>

    <button class="btn btn-primary"><?= $editing ? 'Guardar cambios' : 'Crear incidencia' ?></button>
    <a href="<?= BASE_URL ?>/admin/incidencias" class="btn">Cancelar</a>
  </form>
</div>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <title>Moderación de Usuarios • Greenloop</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <link rel="stylesheet" href="/greenloopv2/public/css/greenloop.css">
</head>
<body>

<main>
  <div class="logo-login" style="text-align: center; margin-top: 2rem;">
    <a href="<?php
  if (isset($_SESSION['usuario_tipo']) && $_SESSION['usuario_tipo'] === 'admin') {
    echo URL_ROOT . '/dashboardAdmin/index';
  } elseif (isset($_SESSION['usuario_id'])) {
    echo URL_ROOT . '/userDashboard/index';
  } elseif (isset($_SESSION['personal_id'])) {
    echo URL_ROOT . '/dashboardAdmin/index';
  } else {
    echo URL_ROOT . '/login/index';
  }
?>">
  <img src="<?= URL_ROOT ?>/img/logo.png" alt="Logo Greenloop" />
</a>
  </div>

  <div class="moderacion-usuarios-wrapper">
    <div class="moderacion-usuarios-container">
      <h2>Solicitudes de Registro Pendientes</h2>

      <?php if (isset($data['mensaje'])): ?>
        <div class="mensaje" style="margin-bottom: 1rem; color: var(--green-400); font-weight: bold;">
          <?= htmlspecialchars($data['mensaje']) ?>
        </div>
      <?php endif; ?>

      <div class="moderacion-grid">
        <?php if (!empty($data['usuarios'])): ?>
          <?php foreach ($data['usuarios'] as $usuario): ?>
            <div class="card" style="margin-bottom: 2rem; text-align: left;">
              <h3><?= htmlspecialchars($usuario['nombre']) ?></h3>
              <p><strong>Email:</strong> <?= htmlspecialchars($usuario['correo']) ?></p>
              <p><strong>Tipo de persona:</strong> <?= htmlspecialchars($usuario['tipo_persona']) ?></p>
              <p><strong>Rol:</strong> <?= htmlspecialchars($usuario['rol']) ?></p>

              <?php if ($usuario['tipo_persona'] === 'natural'): ?>
                <p><strong>Cédula (cara):</strong><br>
                  <img src="/greenloopv2/public/uploads/<?= htmlspecialchars($usuario['cedula_cara']) ?>" style="max-width: 120px; border-radius: 6px;">
                </p>
                <p><strong>Cédula (reverso):</strong><br>
                  <img src="/greenloopv2/public/uploads/<?= htmlspecialchars($usuario['cedula_reverso']) ?>" style="max-width: 120px; border-radius: 6px;">
                </p>
              <?php elseif ($usuario['tipo_persona'] === 'juridica'): ?>
                <p><strong>NIT:</strong> <?= htmlspecialchars($usuario['nit']) ?></p>
              <?php endif; ?>

              <div class="card-actions" style="margin-top: 1rem;">
                <a href="<?= URL_ROOT ?>/aceptarUsuarios/aprobar/<?= $usuario['id'] ?>" class="btn-responder">✅ Aprobar</a>
                <a href="<?= URL_ROOT ?>/aceptarUsuarios/rechazar/<?= $usuario['id'] ?>" class="btn-eliminar">❌ Rechazar</a>
              </div>
            </div>
          <?php endforeach; ?>
        <?php else: ?>
          <p>No hay usuarios pendientes por aprobar.</p>
        <?php endif; ?>
      </div>

    </div>
  </div>
</main>

</body>
</html>


<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <link rel="stylesheet" href="/greenloopv2/public/css/greenloop.css">
  <title>Mensajes de Negociaciones • Greenloop</title>
</head>
<body>
  <div class="negociaciones-wrapper">

    <div class="logo-login" style="text-align:center; margin: 1rem 0;">
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

    <h2 style="text-align:center;">Mis Negociaciones</h2>

    <?php if (!empty($data['negociaciones'])): ?>
      <?php foreach ($data['negociaciones'] as $negociacion): ?>
        <div class="negociacion-card">
          <h3>Publicación: <?= htmlspecialchars($negociacion['titulo_publicacion']) ?></h3>
          <p><strong>Fecha de inicio:</strong> <?php echo htmlspecialchars($negociacion['fecha_inicio']); ?></p>
          <p><strong>Estado:</strong> <?php echo htmlspecialchars($negociacion['estado']); ?></p>
          <div class="card-actions">
            <a href="<?= URL_ROOT ?>/chatNegociaciones/ver/<?= $negociacion['id']; ?>" class="btn-responder">Ver Chat</a>
          </div>
        </div>
      <?php endforeach; ?>
    <?php else: ?>
      <p style="text-align:center;">No tienes negociaciones activas.</p>
    <?php endif; ?>

  </div>
</body>
</html>

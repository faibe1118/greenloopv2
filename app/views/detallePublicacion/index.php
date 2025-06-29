<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Detalle Publicación • Greenloop</title>
  <link rel="stylesheet" href="/greenloopv2/public/css/greenloop.css">
</head>
<body>

  <!-- Logo arriba centrado -->
  <div class="vista-detalle-logo">
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

  <!-- Contenedor principal -->
  <div class="vista-detalle-publicacion-wrapper">
    <?php if (!empty($data['mensaje'])): ?>
      <div class="vista-detalle-mensaje"><?= htmlspecialchars($data['mensaje']) ?></div>
    <?php else: ?>
      <?php $publicacion = $data['publicacion']; ?>
      <div class="vista-detalle-publicacion-card">
        <h2><?= htmlspecialchars($publicacion["titulo"]) ?></h2>

        <?php if (!empty($publicacion["imagen"])): ?>
          <img src="/greenloopv2/public/uploads/<?= htmlspecialchars($publicacion["imagen"]) ?>" alt="Imagen de publicación">
        <?php endif; ?>

        <p><strong>Descripción:</strong> <?= htmlspecialchars($publicacion["descripcion"]) ?></p>
        <p><strong>Tipo de material:</strong> <?= htmlspecialchars($publicacion["tipo_material"]) ?></p>
        <p><strong>Ubicación:</strong> <?= htmlspecialchars($publicacion["ubicacion"]) ?></p>
        <p><strong>Precio:</strong> <?= number_format($publicacion["precio"], 0, ',', '.') ?> COP</p>
        <small><strong>Publicado el:</strong> <?= htmlspecialchars($publicacion["fecha_publicacion"]) ?></small>

        <a href="/greenloopv2/chatNegociaciones/index/<?= $publicacion["id"] ?>" class="vista-detalle-boton">Iniciar negociación</a>
      </div>
    <?php endif; ?>
  </div>

</body>
</html>

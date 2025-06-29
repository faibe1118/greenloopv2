<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <title>Aceptar Publicaciones - Greenloop</title>
  <link rel="stylesheet" href="<?= URL_ROOT ?>/css/greenloop.css" />
</head>
<body>
  <div class="logo-login" style="text-align:center;">
    <a href="<?= URL_ROOT ?>/dashboardAdmin/index">
      <img src="<?= URL_ROOT ?>/img/logo.png" alt="Logo Greenloop" />
    </a>
  </div>

  <main class="moderacion-usuarios-wrapper">
  <h2 style="text-align: center; margin-bottom: 2rem;">Publicaciones Pendientes</h2>

  <?php if (!empty($_GET['success'])): ?>
    <div class="mensaje-exito">✅ Publicación aprobada correctamente.</div>
  <?php elseif (!empty($_GET['rejected'])): ?>
    <div class="mensaje-error">❌ Publicación rechazada.</div>
  <?php endif; ?>

  <div class="moderacion-grid moderacion-publicaciones-grid">
    <?php if (!empty($data['publicaciones'])): ?>
      <?php foreach ($data['publicaciones'] as $pub): ?>
        <div class="card card-publicacion">
          <h3><?= htmlspecialchars($pub['titulo']) ?></h3>
          <p><strong>Ubicación:</strong> <?= htmlspecialchars($pub['ubicacion']) ?></p>
          <p><strong>Fecha:</strong> <?= date('Y-m-d', strtotime($pub['fecha_publicacion'])) ?></p>
          <p><strong>Precio:</strong> $<?= number_format($pub['precio'], 0, ',', '.') ?> COP</p>
          <p><strong>Tipo:</strong> <?= ucfirst($pub['tipo_material']) ?></p>

          <div class="card-actions">
            <a href="<?= URL_ROOT ?>/detallePublicacion/ver/<?= $pub['id'] ?>" class="btn-ver">🔍 Ver detalles</a>
            <a href="<?= URL_ROOT ?>/aceptarPublicaciones/aprobar/<?= $pub['id'] ?>" class="btn-responder">✅ Aprobar</a>
            <a href="<?= URL_ROOT ?>/aceptarPublicaciones/rechazar/<?= $pub['id'] ?>" class="btn-eliminar">❌ Rechazar</a>
          </div>
        </div>
      <?php endforeach; ?>
    <?php else: ?>
      <p style="text-align: center;">No hay publicaciones pendientes por aprobar.</p>
    <?php endif; ?>
  </div>
</main>

</body>
</html>

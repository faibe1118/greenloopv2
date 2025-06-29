<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <title>Detalle de Publicación</title>
  <link rel="stylesheet" href="<?= URL_ROOT ?>/css/greenloop.css" />
</head>
<body>
  <div class="logo-login" style="text-align:center; margin-top: 2rem;">
    <a href="<?= URL_ROOT ?>/dashboardAdmin/index">
      <img src="<?= URL_ROOT ?>/img/logo.png" alt="Logo Greenloop">
    </a>
  </div>

  <main class="detalle-publicacion-container">
    <h2 style="text-align: center; margin-bottom: 1.5rem; color: var(--green-500);">Detalle de la Publicación</h2>


    <?php if (!empty($data['publicacion'])): ?>
      <div class="card" style="max-width: 600px; margin: auto;">
        <h3><?= htmlspecialchars($data['publicacion']['titulo']) ?></h3>
        <img src="<?= URL_ROOT ?>/uploads/<?= htmlspecialchars($data['publicacion']['imagen']) ?>" alt="Imagen" style="width:100%; border-radius:1rem;">
        <p><strong>Descripción:</strong> <?= nl2br(htmlspecialchars($data['publicacion']['descripcion'])) ?></p>
        <p><strong>Tipo de material:</strong> <?= htmlspecialchars($data['publicacion']['tipo_material']) ?></p>
        <p><strong>Cantidad:</strong> <?= htmlspecialchars($data['publicacion']['cantidad']) ?></p>
        <p><strong>Ubicación:</strong> <?= htmlspecialchars($data['publicacion']['ubicacion']) ?></p>
        <p><strong>Precio:</strong> $<?= number_format($data['publicacion']['precio'], 0, ',', '.') ?> COP</p>
        <p><strong>Fecha:</strong> <?= htmlspecialchars($data['publicacion']['fecha_publicacion']) ?></p>
      </div>
    <?php else: ?>
      <p style="text-align:center; color:red;">No se encontró la publicación.</p>
    <?php endif; ?>

    <div style="text-align:center; margin-top: 2rem;">
      <a href="<?= URL_ROOT ?>/aceptarPublicaciones" class="btn-responder">← Volver</a>
    </div>
  </main>
</body>
</html>

<?php
$dashboardUrl = '/greenloopv2/login/index'; // Por defecto

if (isset($_SESSION['usuario_id'])) {
    $dashboardUrl = '/greenloopv2/public/userDashboard/index';
} elseif (isset($_SESSION['personal_id'])) {
    $dashboardUrl = '/greenloopv2/public/dashboardAdmin/index';
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <link rel="stylesheet" href="/greenloopv2/public/css/greenloop.css">
  <title>Mis Publicaciones • Greenloop</title>
</head>
<body>

<!-- Logo -->
<div class="vista-detalle-logo">
  <a href="<?= $dashboardUrl ?>">
    <img src="/greenloopv2/public/img/logo.png" alt="Greenloop Logo" />
  </a>
</div>


    <h1 class="titulo-mis-publicaciones">Mis Publicaciones</h1>



<!-- Contenido centrado -->
<div class="vista-detalle-publicacion-wrapper">

  <?php if (empty($data['publicaciones'])): ?>
    <p>No tienes publicaciones registradas.</p>
  <?php else: ?>
    <?php foreach ($data['publicaciones'] as $publicacion): ?>
  <div class="vista-detalle-publicacion-card">
    <h2><?= htmlspecialchars($publicacion['titulo']) ?></h2>
    <img src="/greenloopv2/public/uploads/<?= htmlspecialchars($publicacion['imagen']) ?>" alt="Producto">
    <p><strong>Descripción:</strong> <?= htmlspecialchars($publicacion['descripcion']) ?></p>
    <p><strong>Tipo de material:</strong> <?= htmlspecialchars($publicacion['tipo_material']) ?></p>
    <p><strong>Ubicación:</strong> <?= htmlspecialchars($publicacion['ubicacion']) ?></p>
    <p><strong>Precio:</strong> <?= number_format($publicacion['precio'], 0, ',', '.') ?> COP</p>
    <p><strong>Estado:</strong> <?= htmlspecialchars($publicacion['estado_publicacion']) ?></p>
    <small><strong>Publicado el:</strong> <?= htmlspecialchars($publicacion['fecha_publicacion']) ?></small>

    <!-- Botones de acción -->
<div class="vista-detalle-botones">
  <a href="/greenloopv2/public/eliminarPublicacion/<?= $publicacion['id'] ?>" class="vista-detalle-boton-eliminar" onclick="return confirm('¿Estás seguro de que quieres eliminar esta publicación?');">🗑️ Eliminar</a>
</div>

  </div>
<?php endforeach; ?>

  <?php endif; ?>

</div>

</body>
</html>

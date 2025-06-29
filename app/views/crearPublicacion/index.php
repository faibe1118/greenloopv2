<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <link rel="stylesheet" href="/greenloopv2/public/css/greenloop.css">
  <title>Subir Producto • Greenloop</title>
</head>
<body>
  <div class="subir-producto-wrapper">
    <div class="subir-producto-container">
      
      <div class="logo-subir">
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

      <h2>Subir Producto</h2>

      <form action="<?= URL_ROOT ?>/crearPublicacion/guardar" method="POST" enctype="multipart/form-data">
        <!-- Imagen -->
        <input type="file" name="imagen" accept="image/*" required />

        <!-- Título -->
        <input type="text" name="titulo" placeholder="Título del producto" required />

        <!-- Descripción -->
        <textarea name="descripcion" placeholder="Descripción del producto" rows="3" required></textarea>

        <!-- Tipo de material -->
        <select name="tipo_material" required>
          <option value="">Selecciona tipo de material</option>
          <option value="cartones">Cartones y papeles</option>
          <option value="metales">Metales</option>
          <option value="plasticos">Plásticos</option>
        </select>

        <!-- Cantidad -->
        <input type="number" name="cantidad" placeholder="Cantidad disponible" min="1" required />

        <!-- Ubicación -->
        <input type="text" name="ubicacion" placeholder="Ubicación" required />

        <!-- Precio -->
        <input type="number" name="precio" placeholder="Precio en COP" step="0.01" required />

        <!-- Botón de publicación -->
        <button type="submit">Publicar Producto</button>
      </form>

    </div>
  </div>
</body>
</html>

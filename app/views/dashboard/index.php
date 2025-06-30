<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <title>Greenloop • Dashboard de Residuos</title>

  <!-- META SEO -->
  <meta name="description" content="Explora materiales reciclables publicados por vendedores en Greenloop. Encuentra recursos útiles, negocia y contribuye a la economía circular.">
  <meta name="keywords" content="Greenloop, reciclaje, economía circular, sostenibilidad, materiales reutilizables, publicaciones">
  <meta name="author" content="Greenloop Team">

  <!-- SOCIAL MEDIA PREVIEW -->
  <meta property="og:title" content="Greenloop - Plataforma de Economía Circular">
  <meta property="og:description" content="Conecta con compradores y vendedores de materiales reutilizables en tu región. Únete al movimiento verde.">
  <meta property="og:image" content="https://tusitio.com/greenloopv2/public/img/logo.png"> <!-- Usa ruta absoluta real -->
  <meta property="og:url" content="https://tusitio.com/greenloopv2/public/dashboard/index">
  <meta property="og:type" content="website">

  <!-- FAVICON -->
  <link rel="icon" href="/greenloopv2/public/img/favicon.ico" type="image/x-icon">

  <!-- CSS -->
  <link rel="stylesheet" href="/greenloopv2/public/css/greenloop.css">
</head>

<body>
  <header class="dashboard-header">
    <div class="logo-container">
      <a href="">
        <img src="/greenloopv2/public/img/logo.png" alt="Logo Greenloop" />
      </a>
    </div>

    <div class="right-section">
      <div class="search-bar">
        <input type="text" placeholder="Buscar..." id="searchInput" />
      </div>

      <div class="nav-buttons">
        <button>Busqueda avanzada</button>
        <button onclick="window.location.href='/greenloopv2/public/registro/index/';" class="btn-crear-cuenta">Crear cuenta</button>
        <button onclick="window.location.href='/greenloopv2/public/login/index/';" class="btn-crear-cuenta">Ingresar</button>
      </div>
    </div>
  </header>

  <main>
    <!-- Grid de tarjetas justo debajo de la barra de búsqueda -->
    <section class="cards publis" id="cardsContainer">
      <!-- Las tarjetas se generarán dinámicamente aquí con PHP -->
      <?php if (!empty($data['publicaciones'])): ?>
        <?php foreach ($data['publicaciones'] as $publicacion): ?>
          <article class="card publi">
  <img src="/greenloopv2/public/uploads/<?php echo $publicacion['imagen']; ?>" alt="Imagen de <?php echo $publicacion['titulo']; ?>" class="card-image">

  <div class="card-content">
    <h3 class="card-title"><?php echo htmlspecialchars($publicacion['titulo']); ?></h3>

    <p class="card-description">
      <?php echo substr(htmlspecialchars($publicacion['descripcion']), 0, 100); ?>...
    </p>

    <p class="card-info">
      <strong>Tipo:</strong> <?= isset($publicacion['tipo_material']) ? ucfirst(htmlspecialchars($publicacion['tipo_material'])) : 'No especificado' ?><br>
      <strong>Ubicación:</strong> <?= htmlspecialchars($publicacion['ubicacion']) ?? 'No disponible' ?><br>
      <strong>Precio:</strong> $<?= number_format($publicacion['precio'], 0, ',', '.') ?> COP<br>
      <strong>Publicado el:</strong> <?= isset($publicacion['fecha_publicacion']) ? date('Y-m-d', strtotime($publicacion['fecha_publicacion'])) : 'Fecha no disponible' ?>
    </p>
  </div>
</article>

        <?php endforeach; ?>
      <?php else: ?>
        <p>No hay publicaciones para mostrar.</p>
      <?php endif; ?>
    </section>
  </main>

  <footer>
  © 2025 Greenloop. Todos los derechos reservados.
  <br>
  <a href="/greenloopv2/public/legal/index/" style="color: var(--green-400); font-size: 0.9rem;">Política de Protección de Datos</a>
</footer>
  <script src="/greenloopv2/public/js/dashboard.js" defer></script>
</body>
</html>





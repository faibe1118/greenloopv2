<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="/greenloopv2/public/css/greenloop.css">

  <title>Greenloop • Dashboard Usuario</title>
</head>
<body data-role="<?php echo $_SESSION['usuario_rol']; ?>">
  <header class="dashboard-header">
    <div class="logo-container">
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

    <div class="right-section">
      <div class="search-bar">
        <input type="text" placeholder="Buscar..." id="searchInput" />
      </div>

      <div class="user-menu">
        <img src="/greenloopv2/public/img/User_Icon.webp" alt="Usuario" class="user-img" />
        <div class="dropdown">
          <a href="/greenloopv2/public/bandejaMensajes" data-show="comprador vendedor ambos">📩 <span>Mensajes</span></a>
          <a href="/greenloopv2/public/crearPublicacion" data-show="vendedor ambos">➕ <span>Crear Publicación</span></a>
          <a href="/greenloopv2/public/mispublicaciones" data-show="vendedor ambos">📦 <span>Mis Publicaciones</span></a>
          <a href="/greenloop/public/compras" data-show="">🛒 <span>Mis compras</span></a>
          <a href="/greenloopv2/public/pqrs" data-show="comprador vendedor ambos">📬 <span> crear PQRS</span></a>
          <a href="/greenloopv2/public/logout.php" class="logout">🔒 <span>Cerrar sesión</span></a>

        </div>
      </div>
    </div>
  </header>

  <main>
    <section class="cards publis" id="cardsContainer">
      <?php if (!empty($data['publicaciones'])): ?>
        <?php foreach ($data['publicaciones'] as $publicacion): ?>

          <?php
            $fecha = strtotime($publicacion['fecha_publicacion']);
            $esNuevo = (time() - $fecha) < 7 * 24 * 60 * 60;
          ?>




  <article class="card publi"
  data-keywords="<?= strtolower($publicacion['titulo'] . ' ' . $publicacion['descripcion'] . ' ' . $publicacion['tipo_material'] . ' ' . $publicacion['ubicacion']) ?>">

  <?php if ($esNuevo): ?>
    <span class="badge-nuevo">🔥 Nuevo</span>
  <?php endif; ?>

  <img src="/greenloopv2/public/uploads/<?php echo $publicacion['imagen']; ?>" alt="Imagen de <?php echo $publicacion['titulo']; ?>" class="card-image">

  <div class="card-content">
    <?php
      $tipo = strtolower(trim($publicacion['tipo_material']));
      $claseTipo = match($tipo) {
        'plásticos', 'plasticos' => 'badge-plastico',
        'metales' => 'badge-metales',
        'cartones y papeles' => 'badge-papel',
        default => 'badge-otros'
      };
    ?>

    <span class="badge-material <?= $claseTipo ?>">
      <?= ucfirst($tipo) ?>
    </span>

    <h3 class="card-title"><?php echo $publicacion['titulo']; ?></h3>
    <p class="card-description">
      <?php echo substr($publicacion['descripcion'], 0, 100); ?>...
    </p>
    <p class="card-info">
      <strong>Tipo:</strong>
      <?= isset($publicacion['tipo_material']) ? ucfirst($publicacion['tipo_material']) : 'No especificado' ?><br>

      <strong>Cantidad:</strong>
      <?= isset($publicacion['cantidad']) ? htmlspecialchars($publicacion['cantidad']) : 'N/A' ?><br>

      <strong>Ubicación:</strong>
      <?= isset($publicacion['ubicacion']) ? htmlspecialchars($publicacion['ubicacion']) : 'No definida' ?><br>

      <strong>Precio:</strong>
      $<?= number_format($publicacion['precio'], 0, ',', '.') ?> COP<br>

      <strong>Publicado el:</strong>
      <?= isset($publicacion['fecha_publicacion']) ? date('Y-m-d', strtotime($publicacion['fecha_publicacion'])) : 'Fecha no disponible' ?>
    </p>

    <?php if ($publicacion['id_vendedor'] == $data['usuario_id']): ?>
      <button class="btn-propia" disabled style="margin-top: auto;
        align-self: flex-start;
        background: none;
        border: 2px solid var(--green-400);
        color: var(--green-400);
        padding: 0.5rem 1.2rem;
        border-radius: 25px;
        font-size: 0.9rem;
        text-decoration: none;
        transition: all 0.3s ease;">Mi publicación</button>
    <?php elseif ($_SESSION['usuario_rol'] !== 'vendedor'): ?>
      <a href="<?= URL_ROOT ?>/negociacion/iniciar/<?= $publicacion['id']; ?>" class="btn-negociar">Iniciar negociación</a>
    <?php endif; ?>
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
  </footer>

  <script src="/greenloopv2/public/js/dashboard.js" defer></script>

  <script>
    document.addEventListener("DOMContentLoaded", function () {
      const role = document.body.getAttribute('data-role'); // comprador | vendedor | ambos
      const menuItems = document.querySelectorAll('.user-menu .dropdown a');

      menuItems.forEach(item => {
        const showFor = item.getAttribute('data-show');
        if (!showFor.includes(role)) {
          item.style.display = 'none';
        }
      });
    });

    document.addEventListener("DOMContentLoaded", () => {
      document.querySelectorAll(".btn-propia").forEach(btn => {
        btn.addEventListener("click", e => {
          e.preventDefault(); // evita que haga algo si lo llegan a forzar
          alert("No puedes negociar tu propia publicación");
        });
      });
    });

  </script>
  <script src="/greenloopv2/public/js/dashboard.js" defer></script>
</body>
</html>
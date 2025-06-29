<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Dashboard Administrador • Greenloop</title>
  <link rel="stylesheet" href="/greenloopv2/public/css/greenloop.css">

</head>
<body>

  <!-- Encabezado tipo dashboard -->
  <header class="admin-header">
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

    <div class="user-menu">
      <img src="/greenloopv2/public/img/User_Icon.webp" alt="Usuario" class="user-img" />
      <div class="dropdown">
        <a href="<?= URL_ROOT ?>/login/cerrarSesion" class="logout">🔒 Cerrar sesión</a>
      </div>
    </div>
  </header>

  <!-- Cuerpo del panel -->
  <div class="admin-dashboard-wrapper">
    <h2>Panel de Administración</h2>

    <div class="admin-cards-grid">
      <a href="/greenloopv2/public/pqrsAdmin" class="admin-card-btn">
        <h3>📩 Responder PQRS</h3>
        <p>Gestiona las solicitudes PQRS enviadas por los usuarios.</p>
    </a>


      <a href="<?= URL_ROOT ?>/aceptarUsuarios" class="admin-card-btn">
          <h3>👥 Revisar Usuarios</h3>
          <p>Aprueba o rechaza registros de nuevos usuarios.</p>
        </a>


      <a href="<?= URL_ROOT ?>/aceptarPublicaciones" class="admin-card-btn">
            <h3>📝 Revisar Publicaciones</h3>
            <p>Modera el contenido subido al sistema.</p>
        </a>


      <a href="/greenloopv2/public/acuerdos/mensajes" class="admin-card-btn" style="display: none;">
        <h3>🤝 Responder Acuerdos</h3>
        <p>Gestiona acuerdos entre usuarios.</p>
      </a>
    </div>
  </div>

</body>
</html>
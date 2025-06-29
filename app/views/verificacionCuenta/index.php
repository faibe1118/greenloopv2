<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Verificación en Proceso - Greenloop</title>
  <link rel="stylesheet" href="/greenloopv2/public/css/greenloop.css">
</head>
<body>

  <!-- Logo reducido y a la izquierda -->
  <div class="logo-container" style="margin: 1rem 2rem;">
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

  <!-- Contenido central -->
  <div class="login-wrapper">
    <div class="login-container usuario-suspendido-card">
      <h1>Verificando tu cuenta...</h1>
      <p>Gracias por registrarte en Greenloop. Tu información está siendo revisada.</p>
      <p>Vuelve más tarde.</p>
      <div class="loader" style="margin: 1.5rem auto;"></div>
      <a class="btn-volver" href="/greenloopv2/public/dashboard/index">Volver al inicio</a>
    </div>
  </div>

</body>
</html>




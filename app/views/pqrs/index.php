<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Greenloop • PQRS</title>
  <link rel="stylesheet" href="/greenloopv2/public/css/greenloop.css">

</head>
<body>
  <header class="dashboard-header">
    <div class="logo-login">
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
  </header>

  <main>
  <div class="pqrs-form-wrapper">
    <div class="pqrs-form">
      <h2>Enviar PQRS</h2>
      <form action="<?= URL_ROOT ?>/pqrs/enviar" method="POST">
        <label for="tipo">Tipo de solicitud:</label>
        <select id="tipo" name="tipo" required>
          <option value="">Seleccione una opción</option>
          <option value="peticion">Petición</option>
          <option value="queja">Queja</option>
          <option value="reclamo">Reclamo</option>
          <option value="sugerencia">Sugerencia</option>
        </select>

        <label for="asunto">Asunto:</label>
        <input type="text" id="asunto" name="asunto" placeholder="Título breve" required />

        <label for="mensaje">Descripción:</label>
        <textarea id="mensaje" name="mensaje" rows="5" placeholder="Describe tu solicitud..." required></textarea>

        <button type="submit">Enviar PQRS</button>
      </form>
    </div>
  </div>
</main>


  <footer>
    © 2025 Greenloop. Todos los derechos reservados.
  </footer>
</body>
</html>

<!DOCTYPE html>
    <html lang="es">
    <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <link rel="stylesheet" href="/greenloopv2/public/css/greenloop.css">
    <title>Bandeja de Mensajes • Greenloop</title>
    </head>
    <body>
        <div class="bandeja-mensajes-wrapper">
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

            <div class="bandeja-mensajes-container">
                <h2>Bandeja de Mensajes</h2>

                <!-- Tarjetas para los botones de acceso -->
                <section class="cards">
                    <a href="/greenloopv2/public/mensajesPqrs/index" class="card btn-card">
                        <h3>📩 Mensajes PQRS</h3>
                        <p>Accede a los mensajes relacionados con tus solicitudes de PQRS.</p>
                    </a>

                    <a href="/greenloopv2/public/mensajesNegociaciones/index" class="card btn-card">
                        <h3>📦 Mensajes de Negociaciones</h3>
                        <p>Accede a los mensajes relacionados con las negociaciones de productos.</p>
                    </a>

                    <?php if (false): ?>
                        <a href="/greenloopv2/public/acuerdos/mensajes" class="card btn-card">
                            <h3>📬 Coordinación de Acuerdos</h3>
                            <p>Accede a la bandeja de coordinación de acuerdos.</p>
                        </a>
                    <?php endif; ?>

                </section>
            </div>
          </div>
    </body>
</html>
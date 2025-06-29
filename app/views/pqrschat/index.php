<?php if (!empty($_GET['error'])): ?>
  <p style="color: red;">Error: <?= htmlspecialchars($_GET['error']) ?></p>
<?php endif; ?>



<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Responder PQRS • Greenloop</title>
  <link rel="stylesheet" href="/greenloopv2/public/css/greenloop.css">
</head>
<body>

  <!-- Logo -->
  <div class="logo-pqrs-chat">
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
  <h2 class="titulo-pqrs-chat">PQRS Chat</h2>

  <!-- Contenedor general -->
  <div class="chatpqrs-wrapper">

    <!-- Card izquierda con la PQRS -->
    <article class="chatpqrs-pqrs-card">
      <h3><?= htmlspecialchars($data['pqrs']['asunto']) ?></h3>
        <p><strong>Fecha:</strong> <?= htmlspecialchars($data['pqrs']['fecha_creacion']) ?></p>
    <p><?= htmlspecialchars($data['pqrs']['descripcion']) ?></p>

    </article>

    <!-- Card derecha con el chat -->
    <div class="chatpqrs-chat-card">
      <h3>Chat con Moderador</h3>

      <div class="chatpqrs-mensajes">
        <?php $mensajes = $data['mensajes'] ?? []; ?>
<?php foreach ($mensajes as $mensaje): ?>
  <div class="chatpqrs-mensaje <?= $mensaje['tipo_emisor'] === 'usuario' ? 'chatpqrs-cliente' : 'chatpqrs-admin' ?>">
    <?= htmlspecialchars($mensaje['mensaje']) ?>
  </div>
<?php endforeach; ?>

      </div>

                <form class="chatpqrs-input" method="POST" action="<?= URL_ROOT ?>/pqrschat/enviarMensaje/<?= $data['pqrs']['id'] ?>">
                <input type="text" name="mensaje" placeholder="Escribe una respuesta..." required />
                <button type="submit">Enviar</button>
</form>

<script src="/greenloopv2/public/js/chatpqrs.js"></script>



    </div>

  </div>
</body>
</html>

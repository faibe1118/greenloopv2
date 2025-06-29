<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <link rel="stylesheet" href="/greenloopv2/public/css/greenloop.css">
  <title>Chat de Negociación • Greenloop</title>
</head>
<body>

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
  </div>
<h1 class="titulo-negociaciones">Negociaciones</h1>
  <div class="chat-negociacion-wrapper">

    <!-- Publicación -->
    <article class="card publicacion-card">
      <h3><?php echo htmlspecialchars($data['publicacion']['titulo']); ?></h3>
      <img src="/greenloopv2/public/uploads/<?php echo htmlspecialchars($data['publicacion']['imagen']); ?>" alt="<?php echo htmlspecialchars($data['publicacion']['titulo']); ?>" />
      <p><strong>Descripción:</strong> <?php echo htmlspecialchars($data['publicacion']['descripcion']); ?></p>
      <p><strong>Tipo de material:</strong> <?php echo htmlspecialchars($data['publicacion']['tipo_material']); ?></p>
      <p><strong>Ubicación:</strong> <?php echo htmlspecialchars($data['publicacion']['ubicacion']); ?></p>
      <p><strong>Precio:</strong> <?php echo number_format($data['publicacion']['precio']); ?> COP</p>
      <p><small><strong>Publicado el:</strong> <?php echo htmlspecialchars($data['publicacion']['fecha_publicacion']); ?></small></p>
    </article>

    <?php
    $esVendedor = ($_SESSION['usuario_id'] == $data['publicacion']['id_vendedor']);
    ?>

    <!-- ✅ FORMULARIO PARA PROPONER PRECIO (solo COMPRADOR y si está en proceso) -->
    <?php if (!$esVendedor && $data['negociacion']['estado'] === 'en_proceso'): ?>
      <form action="<?= URL_ROOT ?>/chatNegociaciones/enviarPropuesta/<?= $data['negociacion']['id'] ?>" method="POST" class="form-propuesta">
        <label for="precioPropuesta">Proponer un precio (COP):</label>
        <input type="number" name="precioPropuesto" id="precioPropuesta" required>
        <button type="submit">Enviar propuesta</button>
      </form>
    <?php endif; ?>

    <!-- ✅ MOSTRAR PROPUESTA PENDIENTE AL VENDEDOR -->
    <?php if ($_SESSION['usuario_id'] == $data['publicacion']['id_vendedor'] && $data['negociacion']['estado'] === 'en_proceso' && $data['negociacion']['propuesta_precio']): ?>
      <div class="propuesta-pendiente card">
        <h4>Propuesta pendiente:</h4>
        <p>Valor propuesto: <strong>$<?= number_format($data['negociacion']['propuesta_precio'], 0, ',', '.') ?> COP</strong></p>
        <form action="<?= URL_ROOT ?>/chatNegociaciones/responderPropuesta/<?= $data['negociacion']['id'] ?>" method="POST" class="form-respuesta-propuesta">
          <button type="submit" name="accion" value="aceptar" class="btn-aceptar">Aceptar propuesta</button>
          <button type="submit" name="accion" value="rechazar" class="btn-rechazar">Rechazar propuesta</button>
        </form>
      </div>
    <?php endif; ?>

    <!-- ✅ FORMULARIO DEL CHAT SOLO SI LA NEGOCIACIÓN ESTÁ EN PROCESO -->
    <div class="card chat-card">
      <h3>Chat de Negociación</h3>
      <div class="chat-mensajes" data-negociacion="<?= $data['negociacion']['id'] ?>" data-usuario="<?= $_SESSION['usuario_id'] ?>">

        <?php foreach ($data['mensajes'] as $mensaje): ?>
          <div class="mensaje <?= $mensaje['id_emisor'] == $_SESSION['usuario_id'] ? 'mensaje-cliente' : 'mensaje-vendedor' ?>">
            <?= htmlspecialchars($mensaje['mensaje']) ?><br>
            <small><?= htmlspecialchars($mensaje['fecha_envio']) ?></small>
          </div>
        <?php endforeach; ?>

      </div>

      <?php if ($data['negociacion']['estado'] === 'en_proceso'): ?>
        <form action="<?= URL_ROOT ?>/chatNegociaciones/enviarMensaje/<?= $data['negociacion']['id'] ?>" method="POST" class="form-chat">
          <input type="text" name="mensaje" placeholder="Escribe un mensaje..." required>
          <button type="submit">Enviar</button>
        </form>
      <?php else: ?>
        <div class="mensaje-sistema">
          <p>Esta negociación ha sido <strong><?= htmlspecialchars($data['negociacion']['estado']) ?></strong> y no admite más mensajes.</p>
        </div>
      <?php endif; ?>
    </div>

    </div>
</div>

<script src="/greenloopv2/public/js/chatNegociacion.js" defer></script>

</body>
</html>


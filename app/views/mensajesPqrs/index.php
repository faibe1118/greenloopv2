<!--
<!DOCTYPE html>
    <html lang="es">
    <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <link rel="stylesheet" href="/greenloopv2/public/css/greenloop.css">
    <title>Mensajes PQRS • Greenloop</title>
    </head>
    <body>

    <div class="pqrsmensajes-wrapper">
    <div class="logo-login" style="text-align: center; margin-top: 2rem;">
        <a href="/greenloopv2/public/dashboard/index.html">
        <img src="/greenloopv2/public/img/logo.png" alt="Logo Greenloop" class="logo-pqrs" />
        </a>
    </div>

    <main>
        <div class="pqrs-form-wrapper">
        <div class="pqrs-form">
            <h2 style="text-align: center;">Mensajes PQRS</h2>

            <div class="mensaje-texto">
            <h3>Asunto: Retraso en la recogida</h3>
            <p><strong>Fecha:</strong> 2025-06-20</p>
            <p>Buenas tardes, quisiera reportar que el camión no ha pasado por mi dirección a pesar de haber sido agendado.</p>
            <div class="btns-mensaje">
                <a href="#" class="btn-responder">Responder</a>
                <a href="#" class="btn-eliminar">Eliminar</a>
            </div>
            </div>

    <div class="mensaje-texto">
        <h3>Asunto: Retraso en la recogida</h3>
        <p><strong>Fecha:</strong> 2025-06-20</p>
        <p>Buenas tardes, quisiera reportar que el camión no ha pasado por mi dirección a pesar de haber sido agendado.</p>
    </div>

    <div class="btns-mensaje">
        <a href="#" class="btn-responder">Responder</a>
        <a href="#" class="btn-eliminar">Eliminar</a>
    </div>
    </div>

            </div>
            </div>

        </div>
        </div>
    </main>
    </div>

    </body>
</html>
-->

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <link rel="stylesheet" href="/greenloopv2/public/css/greenloop.css">
  <title>Mensajes PQRS • Greenloop</title>
</head>
<body>

  <div class="bandeja-pqrs">
    <h2 style="text-align:center; margin-bottom: 1.5rem;">Mis Solicitudes PQRS</h2>

    <?php if (!empty($data['pqrs'])): ?>
      <?php foreach ($data['pqrs'] as $pqrs): ?>
        <div class="pqrs-item">
          <div><strong>Asunto:</strong> <?= htmlspecialchars($pqrs['asunto']) ?></div>
          <div><strong>Tipo:</strong> <?= htmlspecialchars($pqrs['tipo']) ?></div>
          <div><strong>Estado:</strong> <?= htmlspecialchars($pqrs['estado']) ?></div>
          <div><strong>Fecha:</strong> <?= htmlspecialchars($pqrs['fecha_creacion']) ?></div>

          <div class="acciones">
            <a href="<?= URL_ROOT ?>/mensajesPqrs/ver/<?= $pqrs['id'] ?>">Ver conversación</a>
            <a href="<?= URL_ROOT ?>/mensajesPqrs/cerrar/<?= $pqrs['id'] ?>">Cerrar PQRS</a>
          </div>
        </div>
      <?php endforeach; ?>
    <?php else: ?>
      <p>No tienes solicitudes PQRS.</p>
    <?php endif; ?>
  </div>

</body>
</html>


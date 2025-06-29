<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Detalle PQRS</title>
  <link rel="stylesheet" href="/greenloopv2/public/css/greenloop.css">

</head>
<body>
  <div class="pqrs-detalle-container">
    <div class="logo">
      <a href="<?= URL_ROOT ?>/pqrsAdmin">
        <img src="<?= URL_ROOT ?>/img/logo.png" alt="Logo Greenloop">
      </a>
    </div>

    <h2>Detalle de PQRS</h2>

    <?php if (!empty($data['pqrs'])): ?>
      <p><strong>ID:</strong> <?= htmlspecialchars($data['pqrs']['id']) ?></p>
      <p><strong>Usuario:</strong> <?= htmlspecialchars($data['pqrs']['nombre_usuario']) ?></p>
      <p><strong>Tipo:</strong> <?= htmlspecialchars($data['pqrs']['tipo']) ?></p>
      <p><strong>Asunto:</strong> <?= htmlspecialchars($data['pqrs']['asunto']) ?></p>
      <p><strong>Descripción:</strong> <?= nl2br(htmlspecialchars($data['pqrs']['descripcion'])) ?></p>
      <p><strong>Estado:</strong> <?= htmlspecialchars($data['pqrs']['estado']) ?></p>
      <p><strong>Fecha de creación:</strong> <?= htmlspecialchars($data['pqrs']['fecha_creacion']) ?></p>
      <p><strong>Fecha de cierre:</strong> <?= htmlspecialchars($data['pqrs']['fecha_cierre'] ?? 'No cerrada') ?></p>
    <?php else: ?>
      <p>PQRS no encontrada.</p>
    <?php endif; ?>

    <a href="<?= URL_ROOT ?>/pqrsAdmin" class="btn">← Volver</a>
  </div>
</body>
</html>

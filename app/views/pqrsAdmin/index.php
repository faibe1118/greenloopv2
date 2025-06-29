<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="/greenloopv2/public/css/greenloop.css" />
  <title>Panel de PQRS • Administrador</title>
</head>
<body>
  <div class="pqrs-admin-wrapper">
    <div class="pqrs-admin-container">

      <div class="logo-pqrs-admin">
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

      <h2>PQRS Recibidas</h2>

      <div class="pqrs-table">
        <table>
          <thead>
            <tr>
              <th>Usuario</th>
              <th>Tipo</th>
              <th>Mensaje</th>
              <th>Fecha</th>
              <th>Estado</th>
              <th>Acciones</th>
            </tr>
          </thead>
          <tbody>
            <?php if (!empty($data['pqrs'])): ?>
              <?php foreach ($data['pqrs'] as $pqrs): ?>
                <tr>
                  <td><?php echo htmlspecialchars($pqrs['id_usuario']); ?></td> <!-- Opcional: cambiar por nombre o email si tienes -->
                  <td><?php echo htmlspecialchars($pqrs['tipo']); ?></td>
                  <td><?php echo htmlspecialchars($pqrs['asunto']); ?></td>
                  <td><?php echo date('Y-m-d', strtotime($pqrs['fecha_creacion'])); ?></td>
                  <td><?php echo htmlspecialchars($pqrs['estado']); ?></td>
                  <td>
                    <a href="<?= URL_ROOT ?>/pqrsAdmin/ver/<?php echo $pqrs['id']; ?>" class="btn-ver">Ver</a>
                    <a href="<?= URL_ROOT ?>/pqrschat/index/<?= $pqrs['id'] ?>" class="btn-resolver">Resolver</a>

                  </td>
                </tr>
              <?php endforeach; ?>
            <?php else: ?>
              <tr>
                <td colspan="6">No hay PQRS pendientes.</td>
              </tr>
            <?php endif; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</body>
</html>

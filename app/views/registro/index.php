<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="/greenloopv2/public/css/greenloop.css">
  <title>Greenloop • Registro</title>
</head>
<body>
  <div class="registro-wrapper">
    <div class="register-container">
      <div class="register-header">
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
      </div>

      <div class="text-intro">
        <h1>Registrar Usuario</h1>
      </div>

      <form id="register-form" action="<?= URL_ROOT ?>/registro/guardar" method="POST" enctype="multipart/form-data">
        <!-- Paso 1 -->
        <div class="form-step active">
          <label for="tipo_persona">Tipo de Persona:</label>
          <select id="tipo_persona" name="tipo_persona" required>
            <option value="">Seleccione una opción</option>
            <option value="natural">Natural</option>
            <option value="juridica">Jurídica</option>
            <option value="admin">Admin</option>
          </select>
        </div>

        <!-- Datos generales -->
        <div class="form-step active">
          <input type="text" class="inp" name="nombre" placeholder="Nombre completo" required />
          <input type="email" class="inp" name="correo" placeholder="Correo electrónico" required />
          <input type="password" class="inp" name="contrasena" placeholder="Contraseña" required />
        </div>

        <!-- Datos específicos -->
        <div class="form-step active">
          <label for="select-rol">Rol:</label>
          <select name="rol" id="select-rol" required>
            <option value="">Seleccione un rol</option>
            <option value="vendedor">Vendedor</option>
            <option value="comprador">Comprador</option>
            <option value="ambos">Ambos</option>
          </select>

          <div class="banner">Tipo de documento:</div>
          <select name="tipo_documento" id="tipo_documento" required>
            <option value="">Seleccione tipo de documento</option>
            <option value="cc">Cédula</option>
            <option value="nit">NIT</option>
          </select>

          <label for="numero_cedula">Número de documento:</label>
          <input type="text" class="inp" name="numero_cedula" required />

          <!-- Contenedor de fotos (solo para natural) -->
          <div id="fotos-documento" style="display: none;">
            <label for="cara-cedula">Foto de la cara del documento:</label>
            <input type="file" name="cedula_cara" id="cara-cedula" accept="image/*" />

            <label for="reverso-cedula">Foto del reverso del documento:</label>
            <input type="file" name="cedula_reverso" id="reverso-cedula" accept="image/*" />
          </div>
        </div>

        <button type="submit" class="next-btn">Registrar</button>
        <p class="text-link">¿Ya tienes cuenta? <a href="#" class="login-link">Haz clic aquí</a>.</p>
      </form>

      <p class="error-text" id="mensaje-error"></p>
    </div>
  </div>

  <script src="/greenloopv2/public/js/registro.js"></script>

</body>
</html>
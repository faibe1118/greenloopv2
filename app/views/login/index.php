<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <link rel="stylesheet" href="/greenloopv2/public/css/greenloop.css">

    <title>Iniciar Sesión - Greenloop</title>
</head>
<body>
    <div class="login-wrapper">
        <div class="login-container">
            <div class="logo-login">
                <a href="/greenloopv2/public/dashboard/index.html">
                    <img src="/greenloopv2/public/img/logo.png" alt="Logo Greenloop" />
                </a>
            </div>

            <h2>Iniciar Sesión</h2>
            <form action="<?= URL_ROOT ?>/login/autenticar" method="POST">
                <div class="form-group">
                    <input type="email" name="correo" placeholder="Correo electrónico" required />
                </div>

                <div class="form-group">
                    <input type="password" name="contrasena" placeholder="Contraseña" required />
                </div>

                <button class="btn" type="submit">Ingresar</button>
            </form>
            
            <?php if (!empty($error)): ?>
                <p class="error"><?= htmlspecialchars($error) ?></p>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>

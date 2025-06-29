<?php
session_start();
session_unset(); // Elimina todas las variables de sesión
session_destroy(); // Destruye la sesión actual

// Redirige al login o página principal
header("Location: /greenloopv2/public/dashboard/index.php");
exit;

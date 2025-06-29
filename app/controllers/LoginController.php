<?php

require_once APP_ROOT . '/app/models/services/UsuarioService.php';
require_once APP_ROOT . '/app/models/services/PersonalService.php'; // ← AÑADE ESTO


class LoginController extends Controller {
    private $usuarioService;
    private $personalService;

    public function __construct() {
        $this->usuarioService = new UsuarioService();
        $this->personalService = new PersonalService();
    }

    // Muestra el formulario de login
    public function index($data = []) {
        $this->view('login/index', $data);
    }

    // Procesa la autenticación
    public function autenticar() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $correo = $_POST['correo'] ?? '';
            $contrasena = $_POST['contrasena'] ?? '';

            // 1. Intentar autenticación como usuario
            $usuario = $this->usuarioService->obtenerUsuarioPorCorreo($correo);

            if ($usuario && password_verify($contrasena, $usuario['contrasena'])) {
                // Validar si la cuenta está activa
                if ($usuario['estado'] !== 'activo') {
                    header('Location: ' . URL_ROOT . '/verificacionCuenta/index');
                    exit;
                }

                // Guardar sesión para usuarios normales
                $_SESSION['usuario_id'] = $usuario['id'];
                $_SESSION['usuario_nombre'] = $usuario['nombre'];
                $_SESSION['usuario_rol'] = $usuario['rol'];
                $_SESSION['usuario_tipo'] = $usuario['tipo_persona'];

                // Redirección según tipo_persona
                if ($usuario['tipo_persona'] === 'admin') {
                    header('Location: ' . URL_ROOT . '/dashboardAdmin/index');
                } else {
                    header('Location: ' . URL_ROOT . '/userDashboard/index');
                }
                exit;
            }

            // 2. Si no fue usuario, intentar como personal
            $personal = $this->personalService->obtenerPersonalPorCorreo($correo); // ✅ correcto

            if ($personal && password_verify($contrasena, $personal['contrasenia'])) {
    $_SESSION['personal_id'] = $personal['id'];
    $_SESSION['usuario_nombre'] = $personal['nombre'];
    $_SESSION['rol'] = $personal['tipo_personal']; // admin o soporte
    header('Location: ' . URL_ROOT . '/dashboardAdmin/index');
    exit;
}


            // 3. Si no se encontró en ninguna tabla
            return $this->index(['error' => 'Correo o contraseña incorrectos.']);
        } else {
            $this->index(); // Si no es POST, muestra el formulario
        }
    }

    // Cerrar sesión
    public function cerrarSesion() {
        session_destroy();
header('Location: ' . URL_ROOT . '/login/index');
exit;

    }
}

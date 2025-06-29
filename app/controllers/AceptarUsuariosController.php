<?php

require_once APP_ROOT . '/app/models/services/UsuarioService.php';

class AceptarUsuariosController extends Controller {
    private $usuarioService;

    public function __construct() {
        $this->usuarioService = new UsuarioService();
    }

    public function index() {
        // Solo personal autorizado debería entrar aquí, puedes agregar validación de rol si quieres.
        $usuariosPendientes = $this->usuarioService->obtenerUsuariosPendientesConDetalles();
        $this->view('aceptarUsuarios/index', ['usuarios' => $usuariosPendientes]);
    }

    public function aprobar($idUsuario) {
        $resultado = $this->usuarioService->cambiarEstadoUsuario($idUsuario, 'activo');
        if ($resultado > 0) {
            header('Location: ' . URL_ROOT . '/aceptarUsuarios/index?success=aprobado');
        } else {
            header('Location: ' . URL_ROOT . '/aceptarUsuarios/index?error=nochange');
        }
        exit;
    }

    public function rechazar($idUsuario) {
        $resultado = $this->usuarioService->cambiarEstadoUsuario($idUsuario, 'suspendido');
        if ($resultado > 0) {
            header('Location: ' . URL_ROOT . '/aceptarUsuarios/index?success=rechazado');
        } else {
            header('Location: ' . URL_ROOT . '/aceptarUsuarios/index?error=nochange');
        }
        exit;
    }

}

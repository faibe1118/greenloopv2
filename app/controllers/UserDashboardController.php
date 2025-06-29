<?php

require_once APP_ROOT . '/app/models/services/PublicacionesService.php';

class UserDashboardController extends Controller {
    private $publicacionesService;

    public function __construct() {
        $this->publicacionesService = new PublicacionesService();

        if (!isset($_SESSION['usuario_id'])) {
            header('Location: ' . URL_ROOT . '/login/index');
            exit;
        }
    }

    public function index() {

        $usuarioId = $_SESSION['usuario_id'];
        $usuarioNombre = $_SESSION['usuario_nombre'];
        $usuarioRol = $_SESSION['usuario_rol'];

        // Obtener publicaciones aprobadas
        $publicaciones = $this->publicacionesService->obtenerPublicacionesAprobadas();

        // Pasar datos a la vista
        $this->view('userDashboard/index', [
            'publicaciones' => $publicaciones,
            'usuario_id' => $usuarioId,
            'usuario_nombre' => $usuarioNombre,
            'usuario_rol' => $usuarioRol
        ]);
        
    }
}

<?php

require_once APP_ROOT . '/app/models/services/PublicacionesService.php';

class AceptarPublicacionesController extends Controller {
    private $publicacionesService;

    public function __construct() {
        $this->publicacionesService = new PublicacionesService();
    }

    public function index() {
    // 🔒 Verificación de sesión y rol
    if (!isset($_SESSION['usuario_tipo']) || $_SESSION['usuario_tipo'] !== 'admin') {
        header('Location: ' . URL_ROOT . '/login/index');
        exit;
    }

    // ✅ Continuar si es admin
    $publicacionesPendientes = $this->publicacionesService->obtenerPublicacionesPendientes();
    $this->view('aceptarPublicaciones/index', ['publicaciones' => $publicacionesPendientes]);
}


    public function aprobar($id) {

        if (!isset($_SESSION['usuario_tipo']) || $_SESSION['usuario_tipo'] !== 'admin') {
        header('Location: ' . URL_ROOT . '/login/index');
        exit;
            }
        $this->publicacionesService->cambiarEstado($id, 'aprobada');
        header('Location: ' . URL_ROOT . '/aceptarPublicaciones/index?success=1');
        exit;
    }

    public function rechazar($id) {

        if (!isset($_SESSION['usuario_tipo']) || $_SESSION['usuario_tipo'] !== 'admin') {
        header('Location: ' . URL_ROOT . '/login/index');
        exit;
            }

        $this->publicacionesService->cambiarEstado($id, 'rechazada');
        header('Location: ' . URL_ROOT . '/aceptarPublicaciones/index?rejected=1');
        exit;
    }
}

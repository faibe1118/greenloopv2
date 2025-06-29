<?php

require_once APP_ROOT . '/app/models/services/PublicacionesService.php';

class DashboardController extends Controller {
    private $publicacionesService;

    public function __construct() {
        $this->publicacionesService = new PublicacionesService();
    }

    // Método para mostrar el Dashboard
    public function index() {
        // Obtener las publicaciones para mostrar
        $publicaciones = $this->publicacionesService->obtenerPublicacionesAprobadas();

        // Pasar los datos de las publicaciones a la vista del dashboard
        $this->view('dashboard/index', [
            'publicaciones' => $publicaciones
        ]);
    }
}

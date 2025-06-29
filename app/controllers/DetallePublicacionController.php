<?php

require_once APP_ROOT . '/app/models/services/PublicacionesService.php';

class DetallePublicacionController extends Controller {
    private $publicacionesService;

    public function __construct() {
        $this->publicacionesService = new PublicacionesService();
    }

    public function index($idPublicacion = null) {
        if (!$idPublicacion) {
            $this->view('detallePublicacion/index', ['mensaje' => 'No se especificó ninguna publicación.']);
            return;
        }

        $publicacion = $this->publicacionesService->obtenerPublicacionPorId($idPublicacion);

        if (!$publicacion) {
            $this->view('detallePublicacion/index', ['mensaje' => 'Publicación no encontrada.']);
            return;
        }

        $this->view('detallePublicacion/index', ['publicacion' => $publicacion]);
    }

    public function ver($id) {
  $publicacion = $this->publicacionesService->obtenerPublicacionPorId($id);
  $this->view('detallePublicacion/ver', ['publicacion' => $publicacion]);
}

}

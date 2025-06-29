<?php
require_once APP_ROOT . '/app/models/services/PublicacionesService.php';

class mispublicacionesController extends Controller {
    private $publicacionesService;

    public function __construct() {
        $this->publicacionesService = new PublicacionesService();
    }

    public function misPublicaciones() {
        // Verifica sesión activa
        if (!isset($_SESSION['usuario_id'])) {
            header('Location: ' . URL_ROOT . '/login/index');
            exit;
        }

        $idUsuario = $_SESSION['usuario_id'];
        $publicaciones = $this->publicacionesService->obtenerPublicacionesPorUsuario($idUsuario);

        $this->view('mispublicaciones/index', [
            'publicaciones' => $publicaciones
        ]);

    }

    public function index() {
        $this->misPublicaciones();
    }

    public function eliminarPublicacion($id) {
    session_start();

    if (!isset($_SESSION['usuario_id'])) {
        header('Location: ' . URL_ROOT . '/login/index');
        exit;
    }

    // Verifica que la publicación sea del usuario
    $publicacion = $this->publicacionesService->obtenerPublicacionPorId($id);

    if (!$publicacion || $publicacion['id_vendedor'] != $_SESSION['usuario_id']) {
        echo "No tienes permiso para eliminar esta publicación.";
        exit;
    }

    $this->publicacionesService->eliminarPublicacion($id);
    header('Location: ' . URL_ROOT . '/mispublicaciones');
    exit;
}



}

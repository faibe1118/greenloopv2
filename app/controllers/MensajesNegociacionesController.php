<?php

require_once APP_ROOT . '/app/models/services/NegociacionesService.php';

class MensajesNegociacionesController extends Controller {
    private $negociacionesService;

    public function __construct() {
        $this->negociacionesService = new NegociacionesService();
    }

    public function index() {
        if (!isset($_SESSION['usuario_id'])) {
            header('Location: ' . URL_ROOT . '/login/index');
            exit;
        }

        $idUsuario = $_SESSION['usuario_id'];

        $negociaciones = $this->negociacionesService->obtenerNegociacionesPorUsuario($idUsuario);

        $this->view('mensajesNegociaciones/index', ['negociaciones' => $negociaciones]);
    }
}

<?php

require_once APP_ROOT . '/app/models/services/NegociacionesService.php';

class NegociacionController extends Controller {
    private $negociacionesService;

    public function __construct() {
        $this->negociacionesService = new NegociacionesService();
    }

    public function iniciar($idPublicacion) {


        if (!isset($_SESSION['usuario_id'])) {
            header('Location: ' . URL_ROOT . '/login/index');
            exit;
        }

        $idUsuario = $_SESSION['usuario_id'];

        // Verificar si ya existe negociación
        $negociacion = $this->negociacionesService->obtenerPorUsuarioYPublicacion($idUsuario, $idPublicacion);

        if (!$negociacion) {
            // Crear nueva negociación
            $negociacionId = $this->negociacionesService->crearNegociacion([
                'id_comprador' => $idUsuario,
                'id_publicacion' => $idPublicacion,
                'fecha_inicio' => date('Y-m-d H:i:s'),
                'estado' => 'en_proceso'
            ]);
        } else {
            $negociacionId = $negociacion['id'];
        }

        // Redirigir al chat
        header('Location: ' . URL_ROOT . '/chatNegociaciones/ver/' . $negociacionId);
        exit;
    }
}

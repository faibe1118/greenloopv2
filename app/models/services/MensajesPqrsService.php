<?php

require_once APP_ROOT . '/app/models/repositories/MensajesPqrsRepository.php';

class MensajesPqrsService {
    private $mensajesPqrsRepository;

    public function __construct() {
        $this->mensajesPqrsRepository = new MensajesPqrsRepository();
    }

    public function guardarMensaje($data) {
        // Validaciones o lógica de negocio si es necesario
        return $this->mensajesPqrsRepository->guardarMensaje($data);
    }

    public function obtenerMensajesPorPqrs($idPqrs) {
        return $this->mensajesPqrsRepository->obtenerMensajesPorPqrs($idPqrs);
    }

    public function obtenerMensajesPorEmisor($idEmisor) {
        return $this->mensajesPqrsRepository->obtenerMensajesPorEmisor($idEmisor);
    }

    public function obtenerMensajeMasReciente($idPqrs) {
        return $this->mensajesPqrsRepository->obtenerMensajeMasReciente($idPqrs);
    }
}

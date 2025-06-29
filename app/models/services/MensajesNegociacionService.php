<?php

require_once APP_ROOT . '/app/models/repositories/MensajesNegociacionRepository.php';

class MensajesNegociacionService {
    private $mensajesNegociacionRepository;

    public function __construct() {
        $this->mensajesNegociacionRepository = new MensajesNegociacionRepository();
    }

    // Guardar un mensaje en una negociación
    public function guardarMensaje($data) {
        return $this->mensajesNegociacionRepository->guardarMensaje($data);
    }

    // Obtener todos los mensajes de una negociación
    public function obtenerMensajesPorNegociacion($idNegociacion) {
        return $this->mensajesNegociacionRepository->obtenerMensajesPorNegociacion($idNegociacion);
    }

    // Obtener un mensaje por su ID
    public function obtenerMensajePorId($idMensaje) {
        return $this->mensajesNegociacionRepository->obtenerMensajePorId($idMensaje);
    }

    // Obtener el último mensaje de una negociación
    public function obtenerUltimoMensajePorNegociacion($idNegociacion) {
        return $this->mensajesNegociacionRepository->obtenerUltimoMensajePorNegociacion($idNegociacion);
    }
}

<?php

require_once APP_ROOT . '/app/models/repositories/MensajesLogisticaRepository.php';

class MensajesLogisticaService {
    private $mensajesLogisticaRepository;

    public function __construct() {
        $this->mensajesLogisticaRepository = new MensajesLogisticaRepository();
    }

    // Guardar un mensaje de logística
    public function guardarMensajeLogistica($data) {
        return $this->mensajesLogisticaRepository->guardarMensajeLogistica($data);
    }

    // Obtener todos los mensajes de una negociación logística
    public function obtenerMensajesLogisticaPorNegociacion($idNegociacionLogistica) {
        return $this->mensajesLogisticaRepository->obtenerMensajesLogisticaPorNegociacion($idNegociacionLogistica);
    }

    // Obtener el último mensaje de una negociación logística
    public function obtenerUltimoMensajePorNegociacion($idNegociacionLogistica) {
        return $this->mensajesLogisticaRepository->obtenerUltimoMensajePorNegociacion($idNegociacionLogistica);
    }

    // Eliminar un mensaje de logística
    public function eliminarMensajeLogistica($id) {
        return $this->mensajesLogisticaRepository->eliminarMensajeLogistica($id);
    }
}

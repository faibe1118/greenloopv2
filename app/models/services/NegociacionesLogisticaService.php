<?php

require_once APP_ROOT . '/app/models/repositories/NegociacionesLogisticaRepository.php';

class NegociacionesLogisticaService {
    private $negociacionesLogisticaRepository;

    public function __construct() {
        $this->negociacionesLogisticaRepository = new NegociacionesLogisticaRepository();
    }

    // Guardar una negociación logística
    public function guardarNegociacionLogistica($data) {
        return $this->negociacionesLogisticaRepository->guardarNegociacionLogistica($data);
    }

    // Obtener negociaciones logísticas por usuario
    public function obtenerNegociacionesLogisticaPorUsuario($idUsuario) {
        return $this->negociacionesLogisticaRepository->obtenerNegociacionesLogisticaPorUsuario($idUsuario);
    }

    // Obtener una negociación logística por ID
    public function obtenerNegociacionesLogisticaPorId($id) {
        return $this->negociacionesLogisticaRepository->obtenerNegociacionesLogisticaPorId($id);
    }

    // Eliminar una negociación logística
    public function eliminarNegociacionLogistica($id) {
        return $this->negociacionesLogisticaRepository->eliminarNegociacionLogistica($id);
    }
}

<?php

require_once APP_ROOT . '/app/models/repositories/LogisticaRepository.php';

class LogisticaService {
    private $logisticaRepository;

    public function __construct() {
        $this->logisticaRepository = new LogisticaRepository();
    }

    // Guardar una nueva logística
    public function guardarLogistica($data) {
        return $this->logisticaRepository->guardarLogistica($data);
    }

    // Obtener logística por acuerdo
    public function obtenerLogisticaPorAcuerdo($idAcuerdo) {
        return $this->logisticaRepository->obtenerLogisticaPorAcuerdo($idAcuerdo);
    }

    // Obtener logísticas pendientes
    public function obtenerLogisticasPendientes() {
        return $this->logisticaRepository->obtenerLogisticasPendientes();
    }

    // Actualizar estado de la logística
    public function actualizarEstadoLogistica($idLogistica, $estado) {
        return $this->logisticaRepository->actualizarEstadoLogistica($idLogistica, $estado);
    }
}

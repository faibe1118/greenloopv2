<?php

require_once APP_ROOT . '/app/models/repositories/AcuerdosRepository.php';

class AcuerdosService {
    private $acuerdosRepository;

    public function __construct() {
        $this->acuerdosRepository = new AcuerdosRepository();
    }

    // Guardar un acuerdo
    public function guardarAcuerdo($data) {
        return $this->acuerdosRepository->guardarAcuerdo($data);
    }

    // Obtener un acuerdo por ID
    public function obtenerAcuerdoPorId($idAcuerdo) {
        return $this->acuerdosRepository->obtenerAcuerdoPorId($idAcuerdo);
    }

    // Obtener acuerdos por negociación
    public function obtenerAcuerdosPorNegociacion($idNegociacion) {
        return $this->acuerdosRepository->obtenerAcuerdosPorNegociacion($idNegociacion);
    }

    // Obtener acuerdos activos
    public function obtenerAcuerdosActivos() {
        return $this->acuerdosRepository->obtenerAcuerdosActivos();
    }

    // Actualizar acuerdo
    public function actualizarAcuerdo($data) {
        return $this->acuerdosRepository->actualizarAcuerdo($data);
    }
}

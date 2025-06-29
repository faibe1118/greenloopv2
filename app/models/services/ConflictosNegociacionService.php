<?php

require_once APP_ROOT . '/app/models/repositories/ConflictosNegociacionRepository.php';

class ConflictosNegociacionService {
    private $conflictosNegociacionRepository;

    public function __construct() {
        $this->conflictosNegociacionRepository = new ConflictosNegociacionRepository();
    }

    // Guardar un conflicto
    public function guardarConflicto($data) {
        return $this->conflictosNegociacionRepository->guardarConflicto($data);
    }

    // Obtener un conflicto por ID
    public function obtenerConflictoPorId($idConflicto) {
        return $this->conflictosNegociacionRepository->obtenerConflictoPorId($idConflicto);
    }

    // Obtener todos los conflictos de una negociación
    public function obtenerConflictosPorNegociacion($idNegociacion) {
        return $this->conflictosNegociacionRepository->obtenerConflictosPorNegociacion($idNegociacion);
    }

    // Obtener todos los conflictos pendientes
    public function obtenerConflictosPendientes() {
        return $this->conflictosNegociacionRepository->obtenerConflictosPendientes();
    }

    // Obtener todos los conflictos cerrados
    public function obtenerConflictosCerrados() {
        return $this->conflictosNegociacionRepository->obtenerConflictosCerrados();
    }

    // Actualizar el estado de un conflicto
    public function actualizarEstadoConflicto($idConflicto, $estado) {
        return $this->conflictosNegociacionRepository->actualizarEstadoConflicto($idConflicto, $estado);
    }
}

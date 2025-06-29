<?php

require_once APP_ROOT . '/app/models/repositories/RevisionesRepository.php';

class RevisionesService {
    private $revisionesRepository;

    public function __construct() {
        $this->revisionesRepository = new RevisionesRepository();
    }

    public function guardarRevision($data) {
        // Validaciones u otras lógicas de negocio si es necesario
        return $this->revisionesRepository->guardarRevision($data);
    }

    public function obtenerRevisionPorId($idRevision) {
        return $this->revisionesRepository->obtenerRevisionPorId($idRevision);
    }

    public function obtenerRevisionesPorPublicacion($idPublicacion) {
        return $this->revisionesRepository->obtenerRevisionesPorPublicacion($idPublicacion);
    }

    public function obtenerRevisionesPorModerador($idModerador) {
        return $this->revisionesRepository->obtenerRevisionesPorModerador($idModerador);
    }

    public function obtenerRevisionesPendientes() {
        return $this->revisionesRepository->obtenerRevisionesPendientes();
    }

    public function obtenerRevisionesAprobadas() {
        return $this->revisionesRepository->obtenerRevisionesAprobadas();
    }

    public function actualizarRevision($idRevision, $estado, $motivoRechazo = null) {
        // Validaciones o lógicas de negocio adicionales si son necesarias
        return $this->revisionesRepository->actualizarRevision($idRevision, $estado, $motivoRechazo);
    }
}

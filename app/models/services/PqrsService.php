<?php

require_once APP_ROOT . '/app/models/repositories/PqrsRepository.php';

class PqrsService {
    private $pqrsRepository;

    public function __construct() {
        $this->pqrsRepository = new PqrsRepository();
    }

    public function guardarPqrs($data) {
        // Validaciones adicionales o lógicas de negocio si es necesario
        return $this->pqrsRepository->guardarPqrs($data);
    }

    public function obtenerPqrsPorId($idPqrs) {
        return $this->pqrsRepository->obtenerPqrsPorId($idPqrs);
    }

    public function obtenerPqrsPorUsuario($idUsuario) {
        return $this->pqrsRepository->obtenerPqrsPorUsuario($idUsuario);
    }

    public function obtenerPqrsPendientes() {
        return $this->pqrsRepository->obtenerPqrsPendientes();
    }

    public function obtenerPqrsResueltos() {
        return $this->pqrsRepository->obtenerPqrsResueltos();
    }

    public function actualizarPqrs($idPqrs, $estado, $fechaCierre = null) {
        // Validaciones o lógicas de negocio adicionales si son necesarias
        return $this->pqrsRepository->actualizarPqrs($idPqrs, $estado, $fechaCierre);
    }

    public function obtenerPqrsAbiertosPorUsuario($idUsuario) {
        return $this->pqrsRepository->obtenerPqrsAbiertosPorUsuario($idUsuario);
    }

    public function obtenerPqrsPorIdYUsuario($idPqrs, $idUsuario) {
        return $this->pqrsRepository->obtenerPqrsPorIdYUsuario($idPqrs, $idUsuario);
    }

    public function obtenerMensajesPorPqrs($idPqrs) {
        return $this->pqrsRepository->obtenerMensajesPorPqrs($idPqrs);
    }

    public function obtenerTodas() {
    return $this->pqrsRepository->obtenerTodas();
}

}

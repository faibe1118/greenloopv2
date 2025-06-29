<?php

require_once APP_ROOT . '/app/models/repositories/NotificacionesRepository.php';

class NotificacionesService {
    private $notificacionesRepository;

    public function __construct() {
        $this->notificacionesRepository = new NotificacionesRepository();
    }

    // Crear una nueva notificación
    public function crearNotificacion($data) {
        return $this->notificacionesRepository->crearNotificacion($data);
    }

    // Obtener todas las notificaciones de un usuario
    public function obtenerNotificacionesPorUsuario($idUsuario) {
        return $this->notificacionesRepository->obtenerNotificacionesPorUsuario($idUsuario);
    }

    // Obtener notificaciones pendientes de un usuario
    public function obtenerNotificacionesPendientes($idUsuario) {
        return $this->notificacionesRepository->obtenerNotificacionesPendientes($idUsuario);
    }

    // Marcar una notificación como leída
    public function marcarNotificacionLeida($idNotificacion) {
        return $this->notificacionesRepository->marcarNotificacionLeida($idNotificacion);
    }

    // Eliminar una notificación
    public function eliminarNotificacion($idNotificacion) {
        return $this->notificacionesRepository->eliminarNotificacion($idNotificacion);
    }
}

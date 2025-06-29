<?php

require_once APP_ROOT . '/core/Database.php';

class NotificacionesRepository {
    private $db;

    public function __construct() {
        $this->db = new Database();
    }

    // Crear una nueva notificación
    public function crearNotificacion($data) {
        $sql = "INSERT INTO notificaciones (id_usuario, tipo, mensaje, estado, fecha_envio) 
                VALUES (?, ?, ?, ?, ?)";
        $this->db->query($sql, [
            $data['id_usuario'],
            $data['tipo'],
            $data['mensaje'],
            $data['estado'],
            $data['fecha_envio']
        ]);
        return $this->db->lastInsertId();
    }

    // Obtener todas las notificaciones de un usuario
    public function obtenerNotificacionesPorUsuario($idUsuario) {
        $sql = "SELECT * FROM notificaciones WHERE id_usuario = ? ORDER BY fecha_envio DESC";
        $this->db->query($sql, [$idUsuario]);
        return $this->db->fetchAll();
    }

    // Obtener notificaciones pendientes de un usuario
    public function obtenerNotificacionesPendientes($idUsuario) {
        $sql = "SELECT * FROM notificaciones WHERE id_usuario = ? AND estado = 'pendiente' ORDER BY fecha_envio DESC";
        $this->db->query($sql, [$idUsuario]);
        return $this->db->fetchAll();
    }

    // Marcar una notificación como leída
    public function marcarNotificacionLeida($idNotificacion) {
        $sql = "UPDATE notificaciones SET estado = 'leida', fecha_lectura = ? WHERE id = ?";
        return $this->db->query($sql, [date('Y-m-d H:i:s'), $idNotificacion]);
    }

    // Eliminar una notificación
    public function eliminarNotificacion($idNotificacion) {
        $sql = "DELETE FROM notificaciones WHERE id = ?";
        return $this->db->query($sql, [$idNotificacion]);
    }
}

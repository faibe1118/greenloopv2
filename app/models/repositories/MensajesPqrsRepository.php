<?php

require_once APP_ROOT . '/app/models/interfaces/MensajesPqrsRepositoryInterface.php';
require_once APP_ROOT . '/core/Database.php';

class MensajesPqrsRepository implements MensajesPqrsRepositoryInterface {
    private $db;

    public function __construct() {
        $this->db = new Database();
    }

    public function guardarMensaje($data) {
    try {
        // 1. Verifica que la PQRS exista y esté activa
        $this->db->query(
            "SELECT id FROM pqrs WHERE id = ? AND estado NOT IN ('cerrado', 'resuelto')",
            [$data['id_pqrs']]
        );
        
        if ($this->db->rowCount() === 0) {
            throw new Exception(
                "La PQRS no existe o está cerrada. ID: " . $data['id_pqrs']
            );
        }

        // 2. Inserta el mensaje
        $this->db->query(
            "INSERT INTO mensajes_pqrs 
            (id_pqrs, tipo_emisor, id_emisor, mensaje, fecha_envio) 
            VALUES (?, ?, ?, ?, NOW())",
            [
                $data['id_pqrs'],
                $data['tipo_emisor'],
                $data['id_emisor'],
                $data['mensaje']
            ]
        );

        return $this->db->lastInsertId();

    } catch (Exception $e) {
        error_log("Error en guardarMensaje: " . $e->getMessage());
        return false;
    }
}

    public function obtenerMensajesPorPqrs($idPqrs) {
        $sql = "SELECT * FROM mensajes_pqrs WHERE id_pqrs = ? ORDER BY fecha_envio ASC";
        $this->db->query($sql, [$idPqrs]);
        return $this->db->fetchAll();
    }

    public function obtenerMensajesPorEmisor($idEmisor) {
        $this->db->query("SELECT * FROM mensajes_pqrs WHERE id_emisor = ?", [$idEmisor]);
        return $this->db->fetchAll();
    }

    public function obtenerMensajeMasReciente($idPqrs) {
        $this->db->query("SELECT * FROM mensajes_pqrs WHERE id_pqrs = ? ORDER BY fecha_envio DESC LIMIT 1", [$idPqrs]);
        return $this->db->fetch();  // Devuelve solo el mensaje más reciente
    }
}

<?php

require_once APP_ROOT . '/core/Database.php';

class MensajesNegociacionRepository implements MensajesNegociacionRepositoryInterface {
    private $db;

    public function __construct() {
        $this->db = new Database();
    }

    // Guardar un nuevo mensaje en una negociación
    public function guardarMensaje($data) {
        $sql = "INSERT INTO mensajes_negociacion (id_negociacion, id_emisor, mensaje, fecha_envio) 
                VALUES (?, ?, ?, ?)";
        $this->db->query($sql, [
            $data['id_negociacion'],
            $data['id_emisor'],
            $data['mensaje'],
            $data['fecha_envio']
        ]);
        return $this->db->lastInsertId();  // Retorna el ID del mensaje insertado
    }

    // Obtener los mensajes de una negociación
    public function obtenerMensajesPorNegociacion($idNegociacion) {
        $this->db->query("SELECT * FROM mensajes_negociacion WHERE id_negociacion = ?", [$idNegociacion]);
        return $this->db->fetchAll();
    }

    // Obtener un mensaje por su ID
    public function obtenerMensajePorId($idMensaje) {
        $this->db->query("SELECT * FROM mensajes_negociacion WHERE id = ?", [$idMensaje]);
        return $this->db->fetch();
    }

    // Obtener el último mensaje de una negociación
    public function obtenerUltimoMensajePorNegociacion($idNegociacion) {
        $this->db->query("SELECT * FROM mensajes_negociacion WHERE id_negociacion = ? ORDER BY fecha_envio DESC LIMIT 1", [$idNegociacion]);
        return $this->db->fetch();
    }

}

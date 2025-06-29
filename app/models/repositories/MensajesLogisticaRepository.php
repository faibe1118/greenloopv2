<?php

require_once APP_ROOT . '/core/Database.php';

class MensajesLogisticaRepository implements MensajesLogisticaRepositoryInterface {
    private $db;

    public function __construct() {
        $this->db = new Database();
    }

    // Guardar un mensaje de logística
    public function guardarMensajeLogistica($data) {
        $sql = "INSERT INTO mensajes_logistica (id_negociacion_logistica, tipo_emisor, id_emisor, mensaje, fecha_envio) 
                VALUES (?, ?, ?, ?, ?)";
        $this->db->query($sql, [
            $data['id_negociacion_logistica'],
            $data['tipo_emisor'],
            $data['id_emisor'],
            $data['mensaje'],
            $data['fecha_envio']
        ]);
        return $this->db->lastInsertId();  // Retorna el ID del mensaje insertado
    }

    // Obtener todos los mensajes de una negociación logística
    public function obtenerMensajesLogisticaPorNegociacion($idNegociacionLogistica) {
        $this->db->query("SELECT * FROM mensajes_logistica WHERE id_negociacion_logistica = ?", [$idNegociacionLogistica]);
        return $this->db->fetchAll();
    }

    // Obtener el último mensaje de una negociación logística
    public function obtenerUltimoMensajePorNegociacion($idNegociacionLogistica) {
        $this->db->query("SELECT * FROM mensajes_logistica WHERE id_negociacion_logistica = ? ORDER BY fecha_envio DESC LIMIT 1", [$idNegociacionLogistica]);
        return $this->db->fetch();
    }

    // Eliminar un mensaje de logística
    public function eliminarMensajeLogistica($id) {
        $this->db->query("DELETE FROM mensajes_logistica WHERE id = ?", [$id]);
    }
}

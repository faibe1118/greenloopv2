<?php

require_once APP_ROOT . '/core/Database.php';

class NegociacionesLogisticaRepository implements NegociacionesLogisticaRepositoryInterface {
    private $db;

    public function __construct() {
        $this->db = new Database();
    }

    // Guardar una nueva negociación logística
    public function guardarNegociacionLogistica($data) {
        $sql = "INSERT INTO negociaciones_logistica (id_logistica, id_usuario, fecha_envio) VALUES (?, ?, ?)";
        $this->db->query($sql, [
            $data['id_logistica'],
            $data['id_usuario'],
            $data['fecha_envio']
        ]);
        return $this->db->lastInsertId();  // Retorna el ID del registro insertado
    }

    // Obtener todas las negociaciones logísticas de un usuario
    public function obtenerNegociacionesLogisticaPorUsuario($idUsuario) {
        $this->db->query("SELECT * FROM negociaciones_logistica WHERE id_usuario = ?", [$idUsuario]);
        return $this->db->fetchAll();
    }

    // Obtener una negociación logística por su ID
    public function obtenerNegociacionesLogisticaPorId($id) {
        $this->db->query("SELECT * FROM negociaciones_logistica WHERE id = ?", [$id]);
        return $this->db->fetch();
    }

    // Eliminar una negociación logística
    public function eliminarNegociacionLogistica($id) {
        $this->db->query("DELETE FROM negociaciones_logistica WHERE id = ?", [$id]);
    }
}

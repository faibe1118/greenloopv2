<?php

require_once APP_ROOT . '/core/Database.php';

class LogisticaRepository implements LogisticaRepositoryInterface {
    private $db;

    public function __construct() {
        $this->db = new Database();
    }

    // Guardar una nueva logística
    public function guardarLogistica($data) {
        $sql = "INSERT INTO logistica (id_acuerdo, modalidad, id_operador_logistico, detalles, estado, fecha_creacion)
                VALUES (?, ?, ?, ?, ?, ?)";
        $this->db->query($sql, [
            $data['id_acuerdo'],
            $data['modalidad'],
            $data['id_operador_logistico'],
            $data['detalles'],
            $data['estado'],
            $data['fecha_creacion']
        ]);
        return $this->db->lastInsertId();
    }

    // Obtener logística por acuerdo
    public function obtenerLogisticaPorAcuerdo($idAcuerdo) {
        $this->db->query("SELECT * FROM logistica WHERE id_acuerdo = ?", [$idAcuerdo]);
        return $this->db->fetch();
    }

    // Obtener logísticas pendientes
    public function obtenerLogisticasPendientes() {
        $this->db->query("SELECT * FROM logistica WHERE estado = 'pendiente'");
        return $this->db->fetchAll();
    }

    // Actualizar estado de la logística
    public function actualizarEstadoLogistica($idLogistica, $estado) {
        $sql = "UPDATE logistica SET estado = ? WHERE id = ?";
        return $this->db->query($sql, [$estado, $idLogistica]);
    }
}

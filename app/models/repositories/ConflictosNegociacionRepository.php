<?php

require_once APP_ROOT . '/core/Database.php';

class ConflictosNegociacionRepository implements ConflictosNegociacionRepositoryInterface {
    private $db;

    public function __construct() {
        $this->db = new Database();
    }

    // Guardar un conflicto
    public function guardarConflicto($data) {
        $sql = "INSERT INTO conflictos_negociacion (id_negociacion, estado, fecha_creacion) 
                VALUES (?, ?, ?)";
        $this->db->query($sql, [
            $data['id_negociacion'],
            $data['estado'],
            $data['fecha_creacion']
        ]);
        return $this->db->lastInsertId();  // Retorna el ID del conflicto insertado
    }

    // Obtener un conflicto por ID
    public function obtenerConflictoPorId($idConflicto) {
        $this->db->query("SELECT * FROM conflictos_negociacion WHERE id = ?", [$idConflicto]);
        return $this->db->fetch();
    }

    // Obtener conflictos por negociación
    public function obtenerConflictosPorNegociacion($idNegociacion) {
        $this->db->query("SELECT * FROM conflictos_negociacion WHERE id_negociacion = ?", [$idNegociacion]);
        return $this->db->fetchAll();
    }

    // Obtener conflictos pendientes
    public function obtenerConflictosPendientes() {
        $this->db->query("SELECT * FROM conflictos_negociacion WHERE estado = 'pendiente'");
        return $this->db->fetchAll();
    }

    // Obtener conflictos cerrados
    public function obtenerConflictosCerrados() {
        $this->db->query("SELECT * FROM conflictos_negociacion WHERE estado = 'cerrado'");
        return $this->db->fetchAll();
    }

    // Actualizar el estado de un conflicto
    public function actualizarEstadoConflicto($idConflicto, $estado) {
        $sql = "UPDATE conflictos_negociacion SET estado = ? WHERE id = ?";
        $this->db->query($sql, [$estado, $idConflicto]);
        return $this->db->affectedRows();  // Retorna el número de filas afectadas
    }
}

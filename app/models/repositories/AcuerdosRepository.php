<?php

require_once APP_ROOT . '/core/Database.php';

class AcuerdosRepository implements AcuerdosRepositoryInterface {
    private $db;

    public function __construct() {
        $this->db = new Database();
    }

    // Guardar un nuevo acuerdo
    public function guardarAcuerdo($data) {
        $sql = "INSERT INTO acuerdos (id_negociacion, resumen, logistica, estado, fecha_acuerdo) 
                VALUES (?, ?, ?, ?, ?)";
        $this->db->query($sql, [
            $data['id_negociacion'],
            $data['resumen'],
            $data['logistica'],
            $data['estado'],
            $data['fecha_acuerdo']
        ]);
        return $this->db->lastInsertId();  // Retorna el ID del acuerdo insertado
    }

    // Obtener acuerdo por ID
    public function obtenerAcuerdoPorId($idAcuerdo) {
        $this->db->query("SELECT * FROM acuerdos WHERE id = ?", [$idAcuerdo]);
        return $this->db->fetch();
    }

    // Obtener acuerdos por negociación
    public function obtenerAcuerdosPorNegociacion($idNegociacion) {
        $this->db->query("SELECT * FROM acuerdos WHERE id_negociacion = ?", [$idNegociacion]);
        return $this->db->fetchAll();
    }

    // Obtener acuerdos activos
    public function obtenerAcuerdosActivos() {
        $this->db->query("SELECT * FROM acuerdos WHERE estado = 'activo'");
        return $this->db->fetchAll();
    }

    // Actualizar acuerdo
    public function actualizarAcuerdo($data) {
        $sql = "UPDATE acuerdos SET resumen = ?, logistica = ?, estado = ?, fecha_acuerdo = ? 
                WHERE id = ?";
        $this->db->query($sql, [
            $data['resumen'],
            $data['logistica'],
            $data['estado'],
            $data['fecha_acuerdo'],
            $data['id']
        ]);
        return $this->db->affectedRows();  // Retorna el número de filas afectadas
    }
}

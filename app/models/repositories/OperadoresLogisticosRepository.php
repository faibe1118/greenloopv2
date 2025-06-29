<?php

require_once APP_ROOT . '/core/Database.php';

class OperadoresLogisticosRepository implements OperadoresLogisticosRepositoryInterface {
    private $db;

    public function __construct() {
        $this->db = new Database();
    }

    // Guardar operador logístico
    public function guardarOperadorLogistico($data) {
        $sql = "INSERT INTO operadores_logisticos (nombre, contacto, descripcion, estado) VALUES (?, ?, ?, ?)";
        $this->db->query($sql, [
            $data['nombre'],
            $data['contacto'],
            $data['descripcion'],
            $data['estado']
        ]);
        return $this->db->lastInsertId();
    }

    // Obtener todos los operadores logísticos
    public function obtenerOperadoresLogisticos() {
        $this->db->query("SELECT * FROM operadores_logisticos");
        return $this->db->fetchAll();
    }

    // Obtener un operador logístico por su id
    public function obtenerOperadorLogisticoPorId($id) {
        $this->db->query("SELECT * FROM operadores_logisticos WHERE id = ?", [$id]);
        return $this->db->fetch();
    }

    // Actualizar un operador logístico
    public function actualizarOperadorLogistico($id, $data) {
        $sql = "UPDATE operadores_logisticos SET nombre = ?, contacto = ?, descripcion = ?, estado = ? WHERE id = ?";
        $this->db->query($sql, [
            $data['nombre'],
            $data['contacto'],
            $data['descripcion'],
            $data['estado'],
            $id
        ]);
    }

    // Eliminar un operador logístico
    public function eliminarOperadorLogistico($id) {
        $this->db->query("DELETE FROM operadores_logisticos WHERE id = ?", [$id]);
    }
}

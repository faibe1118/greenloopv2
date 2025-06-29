<?php

require_once APP_ROOT . '/core/Database.php';
require_once APP_ROOT . '/app/models/interfaces/PersonalRepositoryInterface.php';

class PersonalRepository implements PersonalRepositoryInterface {
    private $db;

    public function __construct() {
        $this->db = new Database();
    }

    // Guardar un personal
    public function guardarPersonal($data) {
        $this->db->query("INSERT INTO personal (nombre, correo, contrasenia, tipo_personal) VALUES (?, ?, ?, ?)", [
            $data['nombre'],
            $data['correo'],
            password_hash($data['contrasenia'], PASSWORD_DEFAULT),
            $data['tipo_personal']
        ]);
        return $this->db->lastInsertId();
    }

    // Obtener personal por id
    public function obtenerPersonalPorId($id) {
        $this->db->query("SELECT * FROM personal WHERE id = ?", [$id]);
        return $this->db->fetch();
    }

    // Obtener todos los personales
    public function obtenerTodosLosPersonales() {
        $this->db->query("SELECT * FROM personal");
        return $this->db->fetchAll();
    }

    // Obtener personal por correo
    public function obtenerPersonalPorCorreo($correo) {
        $this->db->query("SELECT * FROM personal WHERE correo = ?", [$correo]);
        return $this->db->fetch();
    }

    // Obtener personal por tipo
    public function obtenerPersonalPorTipo($tipo) {
        $this->db->query("SELECT * FROM personal WHERE tipo_personal = ?", [$tipo]);
        return $this->db->fetchAll();
    }
}

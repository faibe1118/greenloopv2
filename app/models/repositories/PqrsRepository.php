<?php

require_once APP_ROOT . '/core/Database.php';
require_once APP_ROOT . '/app/models/interfaces/PqrsRepositoryInterface.php';

class PqrsRepository implements PqrsRepositoryInterface {
    private $db;

    public function __construct() {
        $this->db = new Database();
    }

    public function guardarPqrs($data) {
        $sql = "INSERT INTO pqrs (id_usuario, tipo, asunto, descripcion) VALUES (?, ?, ?, ?)";
        $this->db->query($sql, [
            $data['id_usuario'],
            $data['tipo'],
            $data['asunto'],
            $data['descripcion']
        ]);
        return $this->db->lastInsertId();
    }

    public function obtenerPqrsPorId($idPqrs) {
        $this->db->query("SELECT * FROM pqrs WHERE id = ?", [$idPqrs]);
        $result = $this->db->fetch();
        if (!$result) {
            error_log("No se encontró PQRS con id: $idPqrs");
        }
        return $result;
    }


    public function obtenerPqrsPorUsuario($idUsuario) {
        $this->db->query("SELECT * FROM pqrs WHERE id_usuario = ?", [$idUsuario]);
        return $this->db->fetchAll();
    }

    public function obtenerPqrsPendientes() {
        $this->db->query("SELECT * FROM pqrs WHERE estado = 'pendiente'");
        return $this->db->fetchAll();
    }

    public function obtenerPqrsResueltos() {
        $this->db->query("SELECT * FROM pqrs WHERE estado = 'resuelto'");
        return $this->db->fetchAll();
    }

    public function actualizarPqrs($idPqrs, $estado, $fechaCierre = null) {
        if ($fechaCierre !== null) {
            $this->db->query("UPDATE pqrs SET estado = ?, fecha_cierre = ? WHERE id = ?", [
                $estado,
                $fechaCierre,
                $idPqrs
            ]);
        } else {
            $this->db->query("UPDATE pqrs SET estado = ? WHERE id = ?", [
                $estado,
                $idPqrs
            ]);
        }
        return true;
    }

    public function obtenerPqrsAbiertosPorUsuario($idUsuario) {
        $sql = "SELECT * FROM pqrs WHERE id_usuario = ? AND estado IN ('pendiente', 'en_proceso')";
        $this->db->query($sql, [$idUsuario]);
        return $this->db->fetchAll();
    }

    public function obtenerPqrsPorIdYUsuario($idPqrs, $idUsuario) {
        $this->db->query("SELECT * FROM pqrs WHERE id = ? AND id_usuario = ?", [$idPqrs, $idUsuario]);
        return $this->db->fetch();
    }

    public function obtenerMensajesPorPqrs($idPqrs) {
        $this->db->query("SELECT * FROM mensajes_pqrs WHERE id_pqrs = ? ORDER BY fecha_envio ASC", [$idPqrs]);
        return $this->db->fetchAll();
    }

    public function obtenerTodas() {
    $sql = "SELECT * FROM pqrs";
    $this->db->query($sql);
    return $this->db->fetchAll();
}



}


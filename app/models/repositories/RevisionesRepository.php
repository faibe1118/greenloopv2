<?php

require_once APP_ROOT . '/app/models/repositories/RevisionesRepositoryInterface.php';
require_once APP_ROOT . '/core/Database.php';

class RevisionesRepository implements RevisionesRepositoryInterface {
    private $db;

    public function __construct() {
        $this->db = new Database();
    }

    public function guardarRevision($data) {
        $this->db->query("INSERT INTO revisiones (id_publicacion, id_moderador, estado_revision, motivo_rechazo, fecha_revision) 
                        VALUES (?, ?, ?, ?, ?)", [
            $data['id_publicacion'],
            $data['id_moderador'],
            $data['estado_revision'],
            $data['motivo_rechazo'] ?? null,
            $data['fecha_revision']
        ]);
        return $this->db->lastInsertId();
    }

    public function obtenerRevisionPorId($idRevision) {
        $this->db->query("SELECT * FROM revisiones WHERE id = ?", [$idRevision]);
        return $this->db->fetch();
    }

    public function obtenerRevisionesPorPublicacion($idPublicacion) {
        $this->db->query("SELECT * FROM revisiones WHERE id_publicacion = ?", [$idPublicacion]);
        return $this->db->fetchAll();
    }

    public function obtenerRevisionesPorModerador($idModerador) {
        $this->db->query("SELECT * FROM revisiones WHERE id_moderador = ?", [$idModerador]);
        return $this->db->fetchAll();
    }

    public function obtenerRevisionesPendientes() {
        $this->db->query("SELECT * FROM revisiones WHERE estado_revision = 'pendiente'");
        return $this->db->fetchAll();
    }

    public function obtenerRevisionesAprobadas() {
        $this->db->query("SELECT * FROM revisiones WHERE estado_revision = 'aprobada'");
        return $this->db->fetchAll();
    }

    public function actualizarRevision($idRevision, $estado, $motivoRechazo = null) {
        $this->db->query("UPDATE revisiones SET estado_revision = ?, motivo_rechazo = ? WHERE id = ?", [
            $estado,
            $motivoRechazo,
            $idRevision
        ]);
        return true;
    }
}

<?php

require_once APP_ROOT . '/core/Database.php';

class MensajesConflictosRepository implements MensajesConflictosRepositoryInterface {
    private $db;

    public function __construct() {
        $this->db = new Database();
    }

    // Guardar un mensaje de conflicto
    public function guardarMensaje($data) {
        $sql = "INSERT INTO mensajes_conflictos (id_conflicto, tipo_emisor, id_emisor, mensaje, fecha_envio) 
                VALUES (?, ?, ?, ?, ?)";
        $this->db->query($sql, [
            $data['id_conflicto'],
            $data['tipo_emisor'],
            $data['id_emisor'],
            $data['mensaje'],
            $data['fecha_envio']
        ]);
        return $this->db->lastInsertId();  // Retorna el ID del mensaje insertado
    }

    // Obtener mensajes por conflicto
    public function obtenerMensajesPorConflicto($idConflicto) {
        $this->db->query("SELECT * FROM mensajes_conflictos WHERE id_conflicto = ?", [$idConflicto]);
        return $this->db->fetchAll();
    }

    // Obtener el último mensaje por conflicto
    public function obtenerUltimoMensajePorConflicto($idConflicto) {
        $this->db->query("SELECT * FROM mensajes_conflictos WHERE id_conflicto = ? ORDER BY fecha_envio DESC LIMIT 1", [$idConflicto]);
        return $this->db->fetch();
    }
}

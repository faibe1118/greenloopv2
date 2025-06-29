<?php

require_once APP_ROOT . '/core/Database.php';
require_once APP_ROOT . '/app/models/repositories/PagosRepositoryInterface.php';

class PagosRepository implements PagosRepositoryInterface {
    private $db;

    public function __construct() {
        $this->db = new Database();
    }

    // Guardar pago
    public function guardarPago($data) {
        $this->db->query("INSERT INTO pagos (id_acuerdo, monto, medio_pago, codigo_transaccion, estado) VALUES (?, ?, ?, ?, ?)", [
            $data['id_acuerdo'],
            $data['monto'],
            $data['medio_pago'],
            $data['codigo_transaccion'],
            $data['estado']
        ]);
        return $this->db->lastInsertId();
    }

    // Obtener pago por id
    public function obtenerPagoPorId($id) {
        $this->db->query("SELECT * FROM pagos WHERE id = ?", [$id]);
        return $this->db->fetch();
    }

    // Obtener pagos por estado
    public function obtenerPagosPorEstado($estado) {
        $this->db->query("SELECT * FROM pagos WHERE estado = ?", [$estado]);
        return $this->db->fetchAll();
    }

    // Obtener pagos por acuerdo
    public function obtenerPagosPorAcuerdo($idAcuerdo) {
        $this->db->query("SELECT * FROM pagos WHERE id_acuerdo = ?", [$idAcuerdo]);
        return $this->db->fetchAll();
    }

    // Obtener último pago por usuario
    public function obtenerUltimoPagoPorUsuario($idUsuario) {
        $this->db->query("SELECT * FROM pagos WHERE id_usuario = ? ORDER BY fecha_pago DESC LIMIT 1", [$idUsuario]);
        return $this->db->fetch();
    }

}

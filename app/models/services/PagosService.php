<?php

require_once APP_ROOT . '/app/models/repositories/PagosRepository.php';

class PagosService {
    private $pagosRepository;

    public function __construct() {
        $this->pagosRepository = new PagosRepository();
    }

    // Guardar pago
    public function guardarPago($data) {
        return $this->pagosRepository->guardarPago($data);
    }

    // Obtener pago por id
    public function obtenerPagoPorId($id) {
        return $this->pagosRepository->obtenerPagoPorId($id);
    }

    // Obtener pagos por estado
    public function obtenerPagosPorEstado($estado) {
        return $this->pagosRepository->obtenerPagosPorEstado($estado);
    }

    // Obtener pagos por acuerdo
    public function obtenerPagosPorAcuerdo($idAcuerdo) {
        return $this->pagosRepository->obtenerPagosPorAcuerdo($idAcuerdo);
    }

    // Obtener último pago por usuario
    public function obtenerUltimoPagoPorUsuario($idUsuario) {
        return $this->pagosRepository->obtenerUltimoPagoPorUsuario($idUsuario);
    }

}

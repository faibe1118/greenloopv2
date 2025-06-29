<?php

interface PagosRepositoryInterface {
    public function guardarPago($data);
    public function obtenerPagoPorId($id);
    public function obtenerPagosPorEstado($estado);
    public function obtenerPagosPorAcuerdo($idAcuerdo);
    public function obtenerUltimoPagoPorUsuario($idUsuario);

}

<?php

interface NegociacionesRepositoryInterface {
    public function guardarNegociacion($data);
    public function obtenerNegociacionPorId($idNegociacion);
    public function obtenerNegociacionesPorPublicacion($idPublicacion);
    public function obtenerNegociacionesPorComprador($idComprador);
    public function cambiarEstadoNegociacion($idNegociacion, $estado);
    public function obtenerNegociacionesPorUsuario($idUsuario);
    public function obtenerPublicacionPorId($idPublicacion);
    public function obtenerMensajesPorNegociacion($idNegociacion);
    public function guardarMensajeNegociacion($data);
}

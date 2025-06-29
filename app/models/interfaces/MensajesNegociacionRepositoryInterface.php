<?php

interface MensajesNegociacionRepositoryInterface {
    public function guardarMensaje($data);
    public function obtenerMensajesPorNegociacion($idNegociacion);
    public function obtenerMensajePorId($idMensaje);
    public function obtenerUltimoMensajePorNegociacion($idNegociacion);
}

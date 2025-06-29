<?php

interface MensajesPqrsRepositoryInterface {
    public function guardarMensaje($data);
    public function obtenerMensajesPorPqrs($idPqrs);
    public function obtenerMensajesPorEmisor($idEmisor);
    public function obtenerMensajeMasReciente($idPqrs);
}

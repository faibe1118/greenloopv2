<?php

interface PqrsRepositoryInterface {
    public function guardarPqrs($data);
    public function obtenerPqrsPorId($idPqrs);
    public function obtenerPqrsPorUsuario($idUsuario);
    public function obtenerPqrsPendientes();
    public function obtenerPqrsResueltos();
    public function actualizarPqrs($idPqrs, $estado, $fechaCierre = null);
}

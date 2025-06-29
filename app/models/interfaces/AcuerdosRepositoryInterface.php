<?php

interface AcuerdosRepositoryInterface {
    public function guardarAcuerdo($data);
    public function obtenerAcuerdoPorId($idAcuerdo);
    public function obtenerAcuerdosPorNegociacion($idNegociacion);
    public function obtenerAcuerdosActivos();
    public function actualizarAcuerdo($data);
}

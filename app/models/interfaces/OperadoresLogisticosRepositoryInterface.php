<?php

interface OperadoresLogisticosRepositoryInterface {
    public function guardarOperadorLogistico($data);
    public function obtenerOperadoresLogisticos();
    public function obtenerOperadorLogisticoPorId($id);
    public function actualizarOperadorLogistico($id, $data);
    public function eliminarOperadorLogistico($id);
}

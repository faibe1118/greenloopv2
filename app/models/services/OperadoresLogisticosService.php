<?php

require_once APP_ROOT . '/app/models/repositories/OperadoresLogisticosRepository.php';

class OperadoresLogisticosService {
    private $operadoresLogisticosRepository;

    public function __construct() {
        $this->operadoresLogisticosRepository = new OperadoresLogisticosRepository();
    }

    // Guardar operador logístico
    public function guardarOperadorLogistico($data) {
        return $this->operadoresLogisticosRepository->guardarOperadorLogistico($data);
    }

    // Obtener todos los operadores logísticos
    public function obtenerOperadoresLogisticos() {
        return $this->operadoresLogisticosRepository->obtenerOperadoresLogisticos();
    }

    // Obtener operador logístico por ID
    public function obtenerOperadorLogisticoPorId($id) {
        return $this->operadoresLogisticosRepository->obtenerOperadorLogisticoPorId($id);
    }

    // Actualizar operador logístico
    public function actualizarOperadorLogistico($id, $data) {
        return $this->operadoresLogisticosRepository->actualizarOperadorLogistico($id, $data);
    }

    // Eliminar operador logístico
    public function eliminarOperadorLogistico($id) {
        return $this->operadoresLogisticosRepository->eliminarOperadorLogistico($id);
    }
}

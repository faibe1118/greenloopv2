<?php

interface NegociacionesLogisticaRepositoryInterface {
    public function guardarNegociacionLogistica($data);
    public function obtenerNegociacionesLogisticaPorUsuario($idUsuario);
    public function obtenerNegociacionesLogisticaPorId($id);
    public function eliminarNegociacionLogistica($id);
}

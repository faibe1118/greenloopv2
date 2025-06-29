<?php

interface LogisticaRepositoryInterface {
    public function guardarLogistica($data);
    public function obtenerLogisticaPorAcuerdo($idAcuerdo);
    public function obtenerLogisticasPendientes();
    public function actualizarEstadoLogistica($idLogistica, $estado);
}

<?php

interface MensajesLogisticaRepositoryInterface {
    public function guardarMensajeLogistica($data);
    public function obtenerMensajesLogisticaPorNegociacion($idNegociacionLogistica);
    public function obtenerUltimoMensajePorNegociacion($idNegociacionLogistica);
    public function eliminarMensajeLogistica($id);
}

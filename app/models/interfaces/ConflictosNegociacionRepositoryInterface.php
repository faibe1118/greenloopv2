<?php

interface ConflictosNegociacionRepositoryInterface {
    public function guardarConflicto($data);
    public function obtenerConflictoPorId($idConflicto);
    public function obtenerConflictosPorNegociacion($idNegociacion);
    public function obtenerConflictosPendientes();
    public function obtenerConflictosCerrados();
    public function actualizarEstadoConflicto($idConflicto, $estado);
}

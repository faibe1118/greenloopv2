<?php

interface RevisionesRepositoryInterface {
    public function guardarRevision($data);
    public function obtenerRevisionPorId($idRevision);
    public function obtenerRevisionesPorPublicacion($idPublicacion);
    public function obtenerRevisionesPorModerador($idModerador);
    public function obtenerRevisionesPendientes();
    public function obtenerRevisionesAprobadas();
    public function actualizarRevision($idRevision, $estado, $motivoRechazo = null);
}

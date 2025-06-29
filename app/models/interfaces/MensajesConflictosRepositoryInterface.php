<?php

interface MensajesConflictosRepositoryInterface {
    public function guardarMensaje($data);
    public function obtenerMensajesPorConflicto($idConflicto);
    public function obtenerUltimoMensajePorConflicto($idConflicto);
}

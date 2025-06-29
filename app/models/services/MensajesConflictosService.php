<?php

require_once APP_ROOT . '/app/models/repositories/MensajesConflictosRepository.php';

class MensajesConflictosService {
    private $mensajesConflictosRepository;

    public function __construct() {
        $this->mensajesConflictosRepository = new MensajesConflictosRepository();
    }

    // Guardar un mensaje de conflicto
    public function guardarMensaje($data) {
        return $this->mensajesConflictosRepository->guardarMensaje($data);
    }

    // Obtener mensajes por conflicto
    public function obtenerMensajesPorConflicto($idConflicto) {
        return $this->mensajesConflictosRepository->obtenerMensajesPorConflicto($idConflicto);
    }

    // Obtener el último mensaje por conflicto
    public function obtenerUltimoMensajePorConflicto($idConflicto) {
        return $this->mensajesConflictosRepository->obtenerUltimoMensajePorConflicto($idConflicto);
    }
}

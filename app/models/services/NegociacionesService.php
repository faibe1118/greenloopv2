<?php

require_once APP_ROOT . '/app/models/repositories/NegociacionesRepository.php';

class NegociacionesService {
    private $negociacionesRepository;

    public function __construct() {
        $this->negociacionesRepository = new NegociacionesRepository();
    }

    // Guardar una nueva negociación
    public function guardarNegociacion($data) {
        return $this->negociacionesRepository->guardarNegociacion($data);
    }

    // Obtener una negociación por su ID
    public function obtenerNegociacionPorId($idNegociacion) {
        return $this->negociacionesRepository->obtenerNegociacionPorId($idNegociacion);
    }

    // Obtener todas las negociaciones por publicación
    public function obtenerNegociacionesPorPublicacion($idPublicacion) {
        return $this->negociacionesRepository->obtenerNegociacionesPorPublicacion($idPublicacion);
    }

    // Obtener todas las negociaciones por comprador
    public function obtenerNegociacionesPorComprador($idComprador) {
        return $this->negociacionesRepository->obtenerNegociacionesPorComprador($idComprador);
    }

    // Cambiar el estado de la negociación
    public function cambiarEstadoNegociacion($idNegociacion, $estado) {
        return $this->negociacionesRepository->cambiarEstadoNegociacion($idNegociacion, $estado);
    }

    public function obtenerNegociacionesPorUsuario($idUsuario) {
        return $this->negociacionesRepository->obtenerNegociacionesPorUsuario($idUsuario);
    }

    public function obtenerPublicacionPorId($idPublicacion) {
        return $this->negociacionesRepository->obtenerPublicacionPorId($idPublicacion);
    }

    public function obtenerMensajesPorNegociacion($idNegociacion) {
        return $this->negociacionesRepository->obtenerMensajesPorNegociacion($idNegociacion);
    }

    public function guardarMensajeNegociacion($data) {
        return $this->negociacionesRepository->guardarMensajeNegociacion($data);
    }

    public function obtenerPorUsuarioYPublicacion($usuarioId, $publicacionId) {
        return $this->negociacionesRepository->buscarPorUsuarioYPublicacion($usuarioId, $publicacionId);
    }

    public function crearNegociacion($data) {
        return $this->negociacionesRepository->crearNegociacion($data);
    }

    public function actualizarPropuestaPrecio($idNegociacion, $precio) {
        return $this->negociacionesRepository->actualizarPropuestaPrecio($idNegociacion, $precio);
    }

    public function cerrarTrato($idNegociacion, $estado, $precio = null) {
        return $this->negociacionesRepository->cerrarTrato($idNegociacion, $estado, $precio);
    }


}


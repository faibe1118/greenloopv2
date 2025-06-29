<?php

require_once APP_ROOT . '/app/models/repositories/PublicacionesRepository.php';

class PublicacionesService {
    private $publicacionesRepository;

    public function __construct() {
        $this->publicacionesRepository = new PublicacionesRepository();
    }

    // Guardar una nueva publicación
    public function guardarPublicacion($data) {
        // Validación de precio
        if (!isset($data['precio']) || $data['precio'] <= 0) {
            return ['error' => 'El precio debe ser mayor a cero.'];
        }

        // Validación de campos mínimos
        if (empty($data['titulo']) || empty($data['descripcion']) || empty($data['tipo_material']) || empty($data['cantidad']) || empty($data['ubicacion']) || empty($data['imagen'])) {
            return ['error' => 'Todos los campos son obligatorios.'];
        }

        // Guardar en base de datos
        try {
            $publicacionId = $this->publicacionesRepository->guardarPublicacion($data);
            return ['success' => 'Publicación guardada con éxito.', 'id' => $publicacionId];
        } catch (Exception $e) {
            return ['error' => 'Error al guardar la publicación: ' . $e->getMessage()];
        }
    }

    // Obtener todas las publicaciones (general)
    public function obtenerPublicaciones() {
        return $this->publicacionesRepository->obtenerPublicaciones();
    }

    // Obtener publicaciones *aprobadas* (para mostrar al público)
    public function obtenerPublicacionesAprobadas() {
        return $this->publicacionesRepository->obtenerPublicacionesAprobadas();
    }

    // Obtener publicaciones *pendientes* (moderadores/admin)
    public function obtenerPublicacionesPendientes() {
        return $this->publicacionesRepository->obtenerPublicacionesPendientes();
    }

    // Obtener publicaciones *de un usuario específico* (⚠ NUEVO → para el userDashboard)
    public function obtenerPublicacionesPorUsuario($usuarioId) {
        return $this->publicacionesRepository->obtenerPublicacionesPorUsuario($usuarioId);
    }

    // Obtener publicación por ID
    public function obtenerPublicacionPorId($idPublicacion) {
        return $this->publicacionesRepository->obtenerPublicacionPorId($idPublicacion);
    }

    // Búsqueda por material
    public function obtenerPublicacionesPorMaterial($material) {
        return $this->publicacionesRepository->obtenerPublicacionesPorMaterial($material);
    }

    // Búsqueda por precio
    public function obtenerPublicacionesPorPrecio($minimo, $maximo) {
        return $this->publicacionesRepository->obtenerPublicacionesPorPrecio($minimo, $maximo);
    }

    // Búsqueda por ubicación
    public function obtenerPublicacionesPorUbicacion($ubicacion) {
        return $this->publicacionesRepository->obtenerPublicacionesPorUbicacion($ubicacion);
    }

    public function eliminarPublicacion($id) {
    return $this->publicacionesRepository->eliminarPublicacion($id);
    }
    public function cambiarEstado($id, $nuevoEstado) {
    return $this->publicacionesRepository->actualizarEstado($id, $nuevoEstado);
}

}


<?php

require_once APP_ROOT . '/app/models/interfaces/PublicacionesRepositoryInterface.php';
require_once APP_ROOT . '/core/Database.php';

class PublicacionesRepository implements PublicacionesRepositoryInterface {
    private $db;

    public function __construct() {
        $this->db = new Database();  // Instancia de la base de datos
    }

    // Guardar una publicación (CORREGIDO)
    public function guardarPublicacion($data) {
        $sql = "INSERT INTO publicaciones (id_vendedor, titulo, descripcion, tipo_material, cantidad, ubicacion, precio, imagen) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

        $this->db->query($sql, [
            $data['id_vendedor'],
            $data['titulo'],
            $data['descripcion'],
            $data['tipo_material'],
            $data['cantidad'],
            $data['ubicacion'],
            $data['precio'],
            $data['imagen']
        ]);

        return $this->db->lastInsertId();  // Retorna el ID de la nueva publicación
    }

    // Obtener una publicación por su ID
    public function obtenerPublicacionPorId($idPublicacion) {
        $sql = "SELECT * FROM publicaciones WHERE id = ?";
        $this->db->query($sql, [$idPublicacion]);
        return $this->db->fetch();
    }

    // Obtener todas las publicaciones
    public function obtenerPublicaciones() {
        $sql = "SELECT * FROM publicaciones";
        $this->db->query($sql);
        return $this->db->fetchAll();
    }

    // Obtener publicaciones con estado 'pendiente'
    public function obtenerPublicacionesPendientes() {
        $sql = "SELECT * FROM publicaciones WHERE estado_publicacion = 'pendiente'";
        $this->db->query($sql);
        return $this->db->fetchAll();
    }

    // Obtener publicaciones con estado 'aprobada'
    public function obtenerPublicacionesAprobadas() {
        $sql = "SELECT * FROM publicaciones WHERE estado_publicacion = 'aprobada'";
        $this->db->query($sql);
        return $this->db->fetchAll();
    }

    // Obtener publicaciones por material
    public function obtenerPublicacionesPorMaterial($material) {
        $sql = "SELECT * FROM publicaciones WHERE tipo_material = ?";
        $this->db->query($sql, [$material]);
        return $this->db->fetchAll();
    }

    // Obtener publicaciones por rango de precio
    public function obtenerPublicacionesPorPrecio($minimo, $maximo) {
        $sql = "SELECT * FROM publicaciones WHERE precio BETWEEN ? AND ?";
        $this->db->query($sql, [$minimo, $maximo]);
        return $this->db->fetchAll();
    }

    // Obtener publicaciones por ubicación
    public function obtenerPublicacionesPorUbicacion($ubicacion) {
        $sql = "SELECT * FROM publicaciones WHERE ubicacion LIKE ?";
        $this->db->query($sql, ["%$ubicacion%"]);
        return $this->db->fetchAll();
    }

    // Actualizar una publicación
    public function actualizarPublicacion($idPublicacion, $data) {
        $sql = "UPDATE publicaciones SET 
            titulo = ?, 
            descripcion = ?, 
            tipo_material = ?, 
            cantidad = ?, 
            ubicacion = ?, 
            precio = ?, 
            imagen = ?, 
            estado_publicacion = ? 
            WHERE id = ?";
            
        $this->db->query($sql, [
            $data['titulo'],
            $data['descripcion'],
            $data['tipo_material'],
            $data['cantidad'],
            $data['ubicacion'],
            $data['precio'],
            $data['imagen'],
            $data['estado_publicacion'],
            $idPublicacion
        ]);
    }

    // Obtener publicaciones por usuario (✔️ para el userDashboard)
    public function obtenerPublicacionesPorUsuario($idUsuario) {
        $sql = "SELECT * FROM publicaciones WHERE id_vendedor = ?";
        $this->db->query($sql, [$idUsuario]);
        return $this->db->fetchAll();
    }

    public function eliminarPublicacion($id) {
    $sql = "DELETE FROM publicaciones WHERE id = ?";
    $this->db->query($sql, [$id]);
}
public function actualizarEstado($id, $estado) {
    $sql = "UPDATE publicaciones SET estado_publicacion = ? WHERE id = ?";
    $this->db->query($sql, [$estado, $id]);
    return $this->db->rowCount();
}

}
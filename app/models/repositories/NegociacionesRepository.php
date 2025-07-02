<?php

require_once APP_ROOT . '/core/Database.php';
require_once APP_ROOT . '/app/models/interfaces/NegociacionesRepositoryInterface.php';

class NegociacionesRepository implements NegociacionesRepositoryInterface {
    private $db;

    public function __construct() {
        $this->db = new Database();
    }

    // Guardar una nueva negociación
    public function guardarNegociacion($data) {
        $sql = "INSERT INTO negociaciones (id_publicacion, id_comprador, estado, fecha_inicio) 
                VALUES (?, ?, ?, ?)";
        $this->db->query($sql, [
            $data['id_publicacion'],
            $data['id_comprador'],
            $data['estado'],
            $data['fecha_inicio']
        ]);
        return $this->db->lastInsertId();  // Retorna el ID de la negociación insertada
    }

    // Obtener una negociación por su ID
    public function obtenerNegociacionPorId($idNegociacion) {
        $this->db->query("SELECT * FROM negociaciones WHERE id = ?", [$idNegociacion]);
        return $this->db->fetch();
    }

    // Obtener todas las negociaciones asociadas a una publicación
    public function obtenerNegociacionesPorPublicacion($idPublicacion) {
        $this->db->query("SELECT * FROM negociaciones WHERE id_publicacion = ?", [$idPublicacion]);
        return $this->db->fetchAll();
    }

    // Obtener todas las negociaciones asociadas a un comprador
    public function obtenerNegociacionesPorComprador($idComprador) {
        $this->db->query("SELECT * FROM negociaciones WHERE id_comprador = ?", [$idComprador]);
        return $this->db->fetchAll();
    }

    // Cambiar el estado de una negociación
    public function cambiarEstadoNegociacion($idNegociacion, $estado) {
        $this->db->query("UPDATE negociaciones SET estado = ? WHERE id = ?", [$estado, $idNegociacion]);
    }

    public function obtenerNegociacionesPorUsuario($idUsuario) {
    $sql = "SELECT 
            n.*, 
            p.titulo AS titulo_publicacion, 
            p.imagen AS imagen_publicacion
            FROM negociaciones n
            INNER JOIN publicaciones p ON n.id_publicacion = p.id
            WHERE n.id_comprador = ? OR p.id_vendedor = ?
            ORDER BY n.fecha_inicio DESC";

    $this->db->query($sql, [$idUsuario, $idUsuario]);
    return $this->db->fetchAll();
}


    public function obtenerPublicacionPorId($idPublicacion) {
        $sql = "SELECT * FROM publicaciones WHERE id = ?";
        $this->db->query($sql, [$idPublicacion]);
        return $this->db->fetch();
    }

    public function obtenerMensajesPorNegociacion($idNegociacion) {
        $sql = "SELECT * FROM mensajes_negociacion WHERE id_negociacion = ? ORDER BY fecha_envio ASC";
        $this->db->query($sql, [$idNegociacion]);
        return $this->db->fetchAll();
    }

    public function guardarMensajeNegociacion($data) {
        $sql = "INSERT INTO mensajes_negociacion (id_negociacion, id_emisor, mensaje) VALUES (?, ?, ?)";
        $this->db->query($sql, [
            $data['id_negociacion'],
            $data['id_emisor'],
            $data['mensaje']
        ]);
        return $this->db->lastInsertId();
    }

    public function buscarPorUsuarioYPublicacion($usuarioId, $publicacionId) {
        $sql = "SELECT * FROM negociaciones WHERE id_comprador = ? AND id_publicacion = ?";
        $this->db->query($sql, [$usuarioId, $publicacionId]);
        return $this->db->fetch();
    }

    public function crearNegociacion($data) {
        $sql = "INSERT INTO negociaciones (id_comprador, id_publicacion, fecha_inicio, estado) 
                VALUES (?, ?, ?, ?)";

        $this->db->query($sql, [
            $data['id_comprador'],
            $data['id_publicacion'],
            $data['fecha_inicio'],
            $data['estado']
        ]);

        return $this->db->lastInsertId();
    }

    // Actualizar el campo propuesta_precio en la tabla negociaciones
    public function actualizarPropuestaPrecio($idNegociacion, $precio) {
        $sql = "UPDATE negociaciones SET propuesta_precio = ? WHERE id = ?";
        $this->db->query($sql, [$precio, $idNegociacion]);
    }

    // Cerrar trato: actualizar estado y precio final
    public function cerrarTrato($idNegociacion, $estado, $precio = null) {
        $sql = "UPDATE negociaciones SET estado = ?, precio_final = ? WHERE id = ?";
        $this->db->query($sql, [$estado, $precio, $idNegociacion]);
    }

    public function registrarPago($data) {
        $sql = "INSERT INTO pagos (id_negociacion, id_comprador, monto, estado) VALUES (?, ?, ?, 'pendiente')";
        $this->db->query($sql, [
            $data['id_negociacion'],
            $data['id_comprador'],
            $data['monto']
        ]);
    }


}

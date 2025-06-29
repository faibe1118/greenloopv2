<?php

require_once APP_ROOT . '/app/models/interfaces/UsuarioRepositoryInterface.php';
require_once APP_ROOT . '/core/Database.php';

class UsuarioRepository implements UsuarioRepositoryInterface {
    private $db;

    public function __construct() {
        $this->db = new Database();
    }

    public function guardarUsuario($data) {
        $this->db->query("INSERT INTO usuarios (nombre, correo, contrasena, tipo_persona, rol) VALUES (?, ?, ?, ?, ?)", [
            $data['nombre'],
            $data['correo'],
            $data['contrasena'],  // Aquí ya llega hasheada desde UsuarioService
            $data['tipo_persona'],
            $data['rol']
        ]);
        return $this->db->lastInsertId();
    }

    public function guardarUsuarioNatural($idUsuario, $numeroCedula, $cedulaCara, $cedulaReverso) {
        $this->db->query("INSERT INTO usuarios_naturales (id_usuario, numero_cedula, cedula_cara, cedula_reverso) VALUES (?, ?, ?, ?)", [
            $idUsuario,
            $numeroCedula,
            $cedulaCara,
            $cedulaReverso
        ]);
    }

    public function guardarUsuarioJuridico($idUsuario, $nit) {
        $this->db->query("INSERT INTO usuarios_juridicos (id_usuario, nit) VALUES (?, ?)", [
            $idUsuario,
            $nit
        ]);
    }

    public function getUsuarioPorCorreo($correo) {
        $this->db->query("SELECT * FROM usuarios WHERE correo = ?", [$correo]);
        return $this->db->fetch();
    }

    public function correoExiste($correo) {
        $this->db->query("SELECT id FROM usuarios WHERE correo = ?", [$correo]);
        return $this->db->fetch() ? true : false;
    }

    public function cedulaExiste($numeroCedula) {
        $this->db->query("SELECT id FROM usuarios_naturales WHERE numero_cedula = ?", [$numeroCedula]);
        return $this->db->fetch() ? true : false;
    }

    public function nitExiste($nit) {
        $this->db->query("SELECT id FROM usuarios_juridicos WHERE nit = ?", [$nit]);
        return $this->db->fetch() ? true : false;
    }

    public function activarUsuario($idUsuario) {
        return $this->db->query("UPDATE usuarios SET estado = 'activo' WHERE id = ?", [$idUsuario]);
    }

    public function suspenderUsuario($idUsuario) {
        return $this->db->query("UPDATE usuarios SET estado = 'suspendido' WHERE id = ?", [$idUsuario]);
    }

    // Obtener datos adicionales si el usuario es NATURAL
    public function obtenerDatosNatural($idUsuario) {
        $sql = "SELECT * FROM usuarios_naturales WHERE id_usuario = ?";
        $this->db->query($sql, [$idUsuario]);
        return $this->db->fetch();
    }

    // Obtener datos adicionales si el usuario es JURÍDICO
    public function obtenerDatosJuridico($idUsuario) {
        $sql = "SELECT * FROM usuarios_juridicos WHERE id_usuario = ?";
        $this->db->query($sql, [$idUsuario]);
        return $this->db->fetch();
    }

    // Cambiar el estado del usuario (activo o suspendido)
    public function actualizarEstadoUsuario($idUsuario, $nuevoEstado) {
        $this->db->query("UPDATE usuarios SET estado = ? WHERE id = ?", [$nuevoEstado, $idUsuario]);
        return $this->db->rowCount(); // Asegúrate de devolver rowCount para saber si se actualizó
    }

    public function obtenerUsuariosPendientes() {
        $sql = "SELECT u.*, un.cedula_cara, un.cedula_reverso, uj.nit 
                FROM usuarios u
                LEFT JOIN usuarios_naturales un ON u.id = un.id_usuario
                LEFT JOIN usuarios_juridicos uj ON u.id = uj.id_usuario
                WHERE u.estado = 'pendiente'";
        $this->db->query($sql);
        return $this->db->fetchAll();
    }
    public function obtenerUsuarioPorId($id) {
    $this->db->query("SELECT * FROM usuarios WHERE id = ?", [$id]);
    return $this->db->fetch();
}

    
}
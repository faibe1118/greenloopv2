<?php

require_once APP_ROOT . '/app/models/repositories/UsuarioRepository.php';

class UsuarioService {
    private $usuarioRepository;

    public function __construct() {
        $this->usuarioRepository = new UsuarioRepository();
    }

    // Guarda solo el usuario en la tabla 'usuarios'
    public function registrar($data) {
        return $this->usuarioRepository->guardarUsuario($data);
    }

    // Guarda los detalles del usuario natural en su tabla
    public function guardarDetallesNatural($idUsuario, $numeroCedula, $cedulaCara, $cedulaReverso) {
        return $this->usuarioRepository->guardarUsuarioNatural($idUsuario, $numeroCedula, $cedulaCara, $cedulaReverso);
    }

    // Guarda los detalles del usuario jurídico en su tabla
    public function guardarDetallesJuridico($idUsuario, $nit) {
        return $this->usuarioRepository->guardarUsuarioJuridico($idUsuario, $nit);
    }

    // Verifica si el correo ya existe en la base de datos
    public function existeCorreo($correo) {
        return $this->usuarioRepository->correoExiste($correo);
    }

    public function activarUsuario($idUsuario) {
        return $this->usuarioRepository->activarUsuario($idUsuario);
    }

    public function suspenderUsuario($idUsuario) {
        return $this->usuarioRepository->suspenderUsuario($idUsuario);
    }

    public function obtenerUsuarioPorCorreo($correo) {
        return $this->usuarioRepository->getUsuarioPorCorreo($correo);
    }

    public function obtenerUsuariosPendientesConDetalles() {
    $usuarios = $this->usuarioRepository->obtenerUsuariosPendientes();

    foreach ($usuarios as &$usuario) {
        if ($usuario['tipo_persona'] === 'natural') {
            $usuario['datos'] = $this->usuarioRepository->obtenerDatosNatural($usuario['id']);
        } elseif ($usuario['tipo_persona'] === 'juridica') {
            $usuario['datos'] = $this->usuarioRepository->obtenerDatosJuridico($usuario['id']);
        }
    }

    return $usuarios;
}


    public function obtenerUsuariosPendientes() {
        return $this->usuarioRepository->obtenerUsuariosPendientes();
    }

    public function cambiarEstadoUsuario($idUsuario, $nuevoEstado) {
        return $this->usuarioRepository->actualizarEstadoUsuario($idUsuario, $nuevoEstado);
    }

    public function obtenerUsuarioPorId($id) {
    return $this->usuarioRepository->obtenerUsuarioPorId($id);
}

}
<?php

interface UsuarioRepositoryInterface {
    public function guardarUsuario($data);
    public function guardarUsuarioNatural($idUsuario, $numeroCedula, $cedulaCara, $cedulaReverso);
    public function guardarUsuarioJuridico($idUsuario, $nit);
    public function getUsuarioPorCorreo($correo);
    public function correoExiste($correo);
    public function cedulaExiste($numeroCedula);
    public function nitExiste($nit);
    public function activarUsuario($idUsuario);
    public function suspenderUsuario($idUsuario);
}

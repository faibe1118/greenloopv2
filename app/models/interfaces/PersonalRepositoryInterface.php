<?php

interface PersonalRepositoryInterface {
    public function guardarPersonal($data);
    public function obtenerPersonalPorId($id);
    public function obtenerTodosLosPersonales();
    public function obtenerPersonalPorCorreo($correo);
    public function obtenerPersonalPorTipo($tipo); 
}

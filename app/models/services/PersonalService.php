<?php

require_once APP_ROOT . '/app/models/repositories/PersonalRepository.php';

class PersonalService {
    private $personalRepository;

    public function __construct() {
        $this->personalRepository = new PersonalRepository();
    }

    // Llamada al repositorio para guardar un nuevo personal
    public function guardarPersonal($data) {
        return $this->personalRepository->guardarPersonal($data);
    }

    // Obtener personal por id
    public function obtenerPersonalPorId($id) {
        return $this->personalRepository->obtenerPersonalPorId($id);
    }

    // Obtener todos los personales
    public function obtenerTodosLosPersonales() {
        return $this->personalRepository->obtenerTodosLosPersonales();
    }

    // Obtener personal por correo
    public function obtenerPorCorreo($correo) {
        return $this->personalRepository->obtenerPersonalPorCorreo($correo);
    }

    // Obtener personal por tipo
    public function obtenerPersonalPorTipo($tipo) {
        return $this->personalRepository->obtenerPersonalPorTipo($tipo);
    }

    public function obtenerPersonalPorCorreo($correo) {
        return $this->personalRepository->obtenerPersonalPorCorreo($correo);
    }

    public function autenticarPersonal($correo, $contrasenia) {
        $personal = $this->personalRepository->obtenerPersonalPorCorreo($correo);

        if ($personal && password_verify($contrasenia, $personal['contrasenia'])) {
            return $personal;
        }

        return false;
    }

    


}

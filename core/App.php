<?php

/*class App {
    protected $controladorActual = 'HomeController';
    protected $metodoActual = 'index';
    protected $parametros = [];

    public function __construct() {
        $url = $this->getUrl();

        // Si la URL está vacía, asignamos HomeController por defecto
        if (empty($url[0])) {
            $this->controladorActual = 'HomeController';
        } else {
            // Asignamos el controlador basado en la URL
            $this->controladorActual = ucfirst($url[0]) . 'Controller';
        }

        // Cargar el controlador
        require_once '../app/controllers/' . $this->controladorActual . '.php';
        $this->controladorActual = new $this->controladorActual;

        // Verificar si el método existe en el controlador
        if (isset($url[1]) && method_exists($this->controladorActual, $url[1])) {
            $this->metodoActual = $url[1];
            unset($url[1]);
        }

        // Parámetros de la URL
        $this->parametros = $url ? array_values($url) : [];

        // Llamar al método del controlador con los parámetros
        call_user_func_array([$this->controladorActual, $this->metodoActual], $this->parametros);
    }

    private function getUrl() {
        // Obtener la URL limpia
        if (isset($_GET['url'])) {
            $url = rtrim($_GET['url'], '/');
            $url = filter_var($url, FILTER_SANITIZE_URL);
            return explode('/', $url);
        }
    }
}*/

class App {
    protected $controladorActual = 'HomeController';
    protected $metodoActual = 'index';
    protected $parametros = [];

    public function __construct() {
        $url = $this->getUrl();

        // Enrutamiento básico para asignar el controlador y el método
        if (empty($url[0])) {
            $this->controladorActual = 'HomeController';
        } elseif ($url[0] == 'registro') {
            if (isset($url[1]) && $url[1] == 'guardar') {
                $this->controladorActual = 'RegistroController';
                $this->metodoActual = 'guardar'; // Llama al método guardar en RegistroController
            } else {
                $this->controladorActual = 'RegistroController';
                $this->metodoActual = 'index';  // Método que carga la vista de registro
            }
        } elseif ($url[0] == 'dashboard') {
            $this->controladorActual = 'DashboardController';
        } elseif ($url[0] == 'verificacionCuenta'){
            $this->controladorActual = 'VerificacionCuentaController';
        } elseif ($url[0] == 'login') {
            $this->controladorActual = 'LoginController';
        } elseif ($url[0] == 'userDashboard') {
            $this->controladorActual = 'UserDashboardController';
        } elseif ($url[0] == 'crearPublicacion') {
            $this->controladorActual = 'CrearPublicacionController';
        } elseif ($url[0] == 'pqrs') {
            $this->controladorActual = 'PqrsController';
        } elseif ($url[0] == 'pqrsAdmin') {
            $this->controladorActual = 'PqrsAdminController';
        } elseif ($url[0] == 'bandejaMensajes') {
            $this->controladorActual = 'BandejaMensajesController';
        } elseif ($url[0] == 'mensajesPqrs') {
            $this->controladorActual = 'MensajesPqrsController';
            unset($url[0]);
        } elseif ($url[0] == 'pqrschat') {
            $this->controladorActual = 'PqrschatController';
        } elseif ($url[0] == 'mensajesNegociaciones') {
            $this->controladorActual = 'MensajesNegociacionesController';
        } elseif ($url[0] == 'aceptarUsuarios') {
            $this->controladorActual = 'AceptarUsuariosController';
        } elseif ($url[0] == 'dashboardAdmin') {
            $this->controladorActual = 'DashboardAdminController';
        } elseif ($url[0] == 'detallePublicacion') {
            $this->controladorActual = 'DetallePublicacionController';
        } elseif ($url[0] == 'mispublicaciones') {
            $this->controladorActual = 'mispublicacionesController';
        }elseif ($url[0] == 'eliminarPublicacion') {
            $this->controladorActual = 'mispublicacionesController';
            $this->metodoActual = 'eliminarPublicacion';
        } elseif ($url[0] == 'negociacion') {
            $this->controladorActual = 'NegociacionController';
        } elseif ($url[0] == 'chatNegociaciones') {
            $this->controladorActual = 'ChatNegociacionesController';
        } elseif ($url[0] == 'aceptarPublicaciones') {
            $this->controladorActual = 'AceptarPublicacionesController';
        } elseif ($url[0] == 'legal') {
            $this->controladorActual = 'LegalController';
        }

        // Cargar controlador
        require_once '../app/controllers/' . $this->controladorActual . '.php';
        $this->controladorActual = new $this->controladorActual;

        // Verificar si el método existe
        if (isset($url[1]) && method_exists($this->controladorActual, $url[1])) {
            $this->metodoActual = $url[1];
            unset($url[1]);
        }

        if (isset($url[0])) {
            unset($url[0]);
        }
        // Obtener parámetros
        $this->parametros = $url ? array_values($url) : [];

        // Ejecutar el método con los parámetros
        call_user_func_array([$this->controladorActual, $this->metodoActual], $this->parametros);
    }

    private function getUrl() {
        if (isset($_GET['url'])) {
            $url = rtrim($_GET['url'], '/');
            $url = filter_var($url, FILTER_SANITIZE_URL);
            return explode('/', $url);
        }
    }
}



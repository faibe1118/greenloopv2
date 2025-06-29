<?php

class DashboardAdminController {
    
    public function __construct() {
    }

    public function index() {
        // Verifica que esté logueado y que sea tipo_persona = 'admin'
        if (!isset($_SESSION['usuario_id']) || $_SESSION['usuario_tipo'] !== 'admin') {
            header('Location: ' . URL_ROOT . '/login/index');
            exit;
        }

        $this->view('dashboardAdmin/index');
    }

    private function view($vista, $data = []) {
        require_once '../app/views/' . $vista . '.php';
    }
}


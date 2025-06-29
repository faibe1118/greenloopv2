<?php

require_once APP_ROOT . '/app/models/services/PqrsService.php';

class PqrsAdminController extends Controller {
    private $pqrsService;

    public function __construct() {
        $this->pqrsService = new PqrsService();
    }

    public function index() {
        $pqrs = $this->pqrsService->obtenerTodas(); // ← cambia esto
        $this->view('pqrsAdmin/index', ['pqrs' => $pqrs]);
    }
    public function ver($id) {
    $pqrs = $this->pqrsService->obtenerPqrsPorId($id);

    if (!$pqrs) {
        $this->view('pqrsAdmin/ver', ['pqrs' => null]);
        return;
    }

    // Obtener nombre del usuario
    require_once APP_ROOT . '/app/models/services/UsuarioService.php';
    $usuarioService = new UsuarioService();
    $usuario = $usuarioService->obtenerUsuarioPorId($pqrs['id_usuario']);

    // Agregar el nombre al array de datos
    $pqrs['nombre_usuario'] = $usuario ? $usuario['nombre'] : 'Usuario desconocido';

    $this->view('pqrsAdmin/ver', ['pqrs' => $pqrs]);
}


}

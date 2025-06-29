<?php

require_once APP_ROOT . '/app/models/services/PqrsService.php';

class PqrsController extends Controller {
    private $pqrsService;

    public function __construct() {
        $this->pqrsService = new PqrsService();
    }

    // Mostrar formulario PQRS
    public function index($data = []) {
        $this->view('pqrs/index', $data); // permite pasar mensajes de error o éxito
    }

    // Procesar el formulario
    public function enviar() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Validación de sesión: ¿Está logueado el usuario?
            if (!isset($_SESSION['usuario_id'])) {
                header('Location: ' . URL_ROOT . '/login/index');
                exit;
            }

            // Recoger datos del formulario
            $data = [
                'id_usuario' => $_SESSION['usuario_id'],
                'tipo'       => trim($_POST['tipo'] ?? ''),
                'asunto'     => trim($_POST['asunto'] ?? ''),
                'descripcion'=> trim($_POST['mensaje'] ?? '')
            ];

            // Validaciones
            if (empty($data['tipo']) || empty($data['asunto']) || empty($data['descripcion'])) {
                return $this->index(['error' => 'Todos los campos son obligatorios.']);
            }

            // Guardar en la base de datos
            // Guardar en la base de datos y obtener el ID del PQRS creado
$idPqrs = $this->pqrsService->guardarPqrs($data);

// Redirigir al chat del PQRS creado
header('Location: ' . URL_ROOT . '/pqrschat/index/' . $idPqrs);
exit;

        } else {
            // Si es GET, mostrar el formulario
            $this->index();
        }
    }
}


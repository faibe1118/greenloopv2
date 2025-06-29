<?php

require_once APP_ROOT . '/app/models/services/PublicacionesService.php';

class CrearPublicacionController extends Controller {
    private $publicacionesService;

    public function __construct() {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        if (!isset($_SESSION['usuario_id'])) {
            header('Location: ' . URL_ROOT . '/login/index');
            exit;
        }

        $this->publicacionesService = new PublicacionesService();
    }

    // Mostrar el formulario
    public function index() {
        $this->view('crearPublicacion/index');
    }

    // Procesar el formulario
    public function guardar() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = $_POST;
            $files = $_FILES;

            // Validaciones básicas
            if (empty($data['titulo']) || empty($data['descripcion']) || empty($data['tipo_material']) || empty($data['cantidad']) || empty($data['ubicacion']) || empty($data['precio'])) {
                return $this->index(['error' => 'Todos los campos son obligatorios.']);
            }

            // Guardar imagen
            $imagenNombre = $this->guardarImagen($files['imagen']);
            if (!$imagenNombre) {
                return $this->index(['error' => 'Error al subir la imagen.']);
            }

            // Preparar los datos para guardar
            $publicacion = [
                'id_vendedor' => $_SESSION['usuario_id'],
                'titulo' => $data['titulo'],
                'descripcion' => $data['descripcion'],
                'tipo_material' => $data['tipo_material'],
                'cantidad' => $data['cantidad'],
                'ubicacion' => $data['ubicacion'],
                'precio' => $data['precio'],
                'imagen' => $imagenNombre,
                'estado_publicacion' => 'pendiente' // ⚠ Aquí se mantiene para control explícito
                // No enviamos 'fecha_publicacion' → lo hace automáticamente la BD
            ];

            // Guardar en BD
            $resultado = $this->publicacionesService->guardarPublicacion($publicacion);

            if (isset($resultado['success'])) {
                header('Location: ' . URL_ROOT . '/userDashboard/index');
                exit;
            } else {
                return $this->index(['error' => 'Error al guardar la publicación.']);
            }
        } else {
            $this->index();
        }
    }

    // Método auxiliar para subir la imagen
    private function guardarImagen($file) {
        if ($file['error'] !== UPLOAD_ERR_OK) {
            return false;
        }

        $directorio = APP_ROOT . '/public/uploads/';
        if (!is_dir($directorio)) {
            mkdir($directorio, 0777, true);
        }

        $nombreFinal = uniqid() . '_' . basename($file['name']);
        $rutaDestino = $directorio . $nombreFinal;

        if (move_uploaded_file($file['tmp_name'], $rutaDestino)) {
            return $nombreFinal;
        }

        return false;
    }
}


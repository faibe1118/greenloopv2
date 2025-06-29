<?php

require_once APP_ROOT . '/app/models/services/UsuarioService.php';

class RegistroController extends Controller {
    private $usuarioService;

    public function __construct() {
        $this->usuarioService = new UsuarioService();  // Instanciamos el servicio
    }

    // Muestra el formulario de registro
    public function index($data = []) {
        $this->view('registro/index', $data);  // Llama a la vista de registro con los datos
    }

    // Maneja la acción de guardar el usuario
    public function guardar() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = $_POST;
            $files = $_FILES;

            // Validación básica
            if (empty($data['nombre']) || empty($data['correo']) || empty($data['contrasena']) || empty($data['tipo_persona']) || empty($data['rol'])) {
                return $this->index([
                    'error' => 'Todos los campos son obligatorios.',
                    'data' => $data
                ]);
            }

            // Validar si el correo ya está registrado
            if ($this->usuarioService->existeCorreo($data['correo'])) {
                return $this->index([
                    'error' => 'El correo ya está registrado.',
                    'data' => $data
                ]);
            }

            // Encriptar contraseña antes de guardar
            $data['contrasena'] = password_hash($data['contrasena'], PASSWORD_DEFAULT);

            try {
                // Registrar usuario en tabla usuarios
                $usuarioId = $this->usuarioService->registrar($data);

                // Guardar detalles adicionales
                if ($data['tipo_persona'] === 'natural') {
                    $cedulaCara = $this->guardarImagen($files['cedula_cara']);
                    $cedulaReverso = $this->guardarImagen($files['cedula_reverso']);

                    if (!$cedulaCara || !$cedulaReverso) {
                        return $this->index([
                            'error' => 'Error al subir imágenes del documento.',
                            'data' => $data
                        ]);
                    }

                    // Guardar en tabla usuarios_naturales
                    $this->usuarioService->guardarDetallesNatural($usuarioId, $data['numero_cedula'], $cedulaCara, $cedulaReverso);

                } elseif ($data['tipo_persona'] === 'juridica') {
                    // Guardar en tabla usuarios_juridicos
                    $nit = $data['numero_cedula']; // Reutilizamos el campo numero_cedula
                    $this->usuarioService->guardarDetallesJuridico($usuarioId, $nit);
                }

                // Redirigir a dashboard
                header('Location: /greenloopv2/public/verificacionCuenta');
                exit;

            } catch (Exception $e) {
                return $this->index([
                    'error' => 'Hubo un error al guardar el registro. Intenta nuevamente.',
                    'data' => $data
                ]);
            }

        } else {
            $this->view('registro/index');
        }
    }



    // Función para guardar imágenes
    private function guardarImagen($archivo) {
        $permitidos = ['image/jpeg', 'image/png', 'image/jpg'];

        if (in_array($archivo['type'], $permitidos) && $archivo['error'] === 0) {
            $directorioDestino = '../public/uploads/';
            $nombreArchivo = uniqid() . '_' . basename($archivo['name']);
            $rutaDestino = $directorioDestino . $nombreArchivo;

            if (move_uploaded_file($archivo['tmp_name'], $rutaDestino)) {
                return $nombreArchivo;
            }
        }
        return null;
    }

}



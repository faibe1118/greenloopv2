<?php
require_once APP_ROOT . '/app/models/services/MensajesPqrsService.php';
require_once APP_ROOT . '/app/models/services/PqrsService.php';

class PqrschatController extends Controller {
    private $mensajesService;
    private $pqrsService;

    public function __construct() {
        $this->mensajesService = new MensajesPqrsService();
        $this->pqrsService = new PqrsService();
    }

    // Mostrar el chat de un PQRS específico
    public function index($idPqrs) {
        // Validar sesión (usuario o personal o admin)
        if (
            !isset($_SESSION['usuario_id']) &&
            !isset($_SESSION['personal_id']) &&
            !(
                isset($_SESSION['usuario_tipo']) &&
                $_SESSION['usuario_tipo'] === 'admin'
            )
        ) {
            header('Location: ' . URL_ROOT . '/login/index');
            exit;
        }

        // Obtener PQRS
        $pqrs = $this->pqrsService->obtenerPqrsPorId($idPqrs);

        // Validar acceso
        $esUsuario = isset($_SESSION['usuario_id']) && $pqrs['id_usuario'] == $_SESSION['usuario_id'];
        $esAdmin = (
            isset($_SESSION['personal_id']) ||
            (isset($_SESSION['usuario_tipo']) && $_SESSION['usuario_tipo'] === 'admin')
        );

        if (!$esUsuario && !$esAdmin) {
            header('Location: ' . URL_ROOT . '/mensajesPqrs/index');
            exit;
        }

        // Obtener mensajes del chat
        $mensajes = $this->mensajesService->obtenerMensajesPorPqrs($idPqrs);

        $this->view('pqrschat/index', [
            'pqrs' => $pqrs,
            'mensajes' => $mensajes
        ]);
    }

    // Enviar un mensaje al chat del PQRS
    public function enviarMensaje($idPqrs) {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            try {
                if (
                    !isset($_SESSION['usuario_id']) &&
                    !isset($_SESSION['personal_id']) &&
                    !(
                        isset($_SESSION['usuario_tipo']) &&
                        $_SESSION['usuario_tipo'] === 'admin'
                    )
                ) {
                    throw new Exception('No autenticado');
                }

                $mensaje = trim($_POST['mensaje'] ?? '');
                if (empty($mensaje)) {
                    throw new Exception('Mensaje vacío');
                }

                // Determinar tipo de emisor
                if (isset($_SESSION['personal_id']) || (isset($_SESSION['usuario_tipo']) && $_SESSION['usuario_tipo'] === 'admin')) {
                    $tipoEmisor = 'admin';
                    $idEmisor = $_SESSION['personal_id'] ?? $_SESSION['usuario_id'];
                } else {
                    $tipoEmisor = 'usuario';
                    $idEmisor = $_SESSION['usuario_id'];
                }

                $datosMensaje = [
                    'id_pqrs' => $idPqrs,
                    'tipo_emisor' => $tipoEmisor,
                    'id_emisor' => $idEmisor,
                    'mensaje' => $mensaje,
                    'fecha_envio' => date('Y-m-d H:i:s')
                ];

                if (!$this->mensajesService->guardarMensaje($datosMensaje)) {
                    throw new Exception('Error al guardar en servicio');
                }

                header('Location: ' . URL_ROOT . '/pqrschat/index/' . $idPqrs);
                exit;

            } catch (Exception $e) {
                error_log("Error en enviarMensaje: " . $e->getMessage());
                header('Location: ' . URL_ROOT . '/pqrschat/index/' . $idPqrs . '?error=' . urlencode($e->getMessage()));
                exit;
            }
        }
    }

    // Obtener mensajes en formato JSON (para AJAX si se usa)
    public function obtenerMensajes($idPqrs) {
        header('Content-Type: application/json');
        $mensajes = $this->mensajesService->obtenerMensajesPorPqrs($idPqrs);
        echo json_encode($mensajes);
        exit;
    }
}

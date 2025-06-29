<?php

require_once APP_ROOT . '/app/models/services/NegociacionesService.php';

class ChatNegociacionesController extends Controller {
    private $negociacionesService;

    public function __construct() {
        $this->negociacionesService = new NegociacionesService();
    }

    public function ver($idNegociacion) {
        if (!isset($_SESSION['usuario_id'])) {
            header('Location: ' . URL_ROOT . '/login/index');
            exit;
        }

        $negociacion = $this->negociacionesService->obtenerNegociacionPorId($idNegociacion);

        if (!$negociacion) {
            header('Location: ' . URL_ROOT . '/mensajesNegociaciones/index?error=notfound');
            exit;
        }

        $publicacion = $this->negociacionesService->obtenerPublicacionPorId($negociacion['id_publicacion']);

        $esComprador = $negociacion['id_comprador'] == $_SESSION['usuario_id'];
        $esVendedor = $publicacion['id_vendedor'] == $_SESSION['usuario_id'];

        if (!$esComprador && !$esVendedor) {
            header('Location: ' . URL_ROOT . '/mensajesNegociaciones/index?error=notfound');
            exit;
        }

        $mensajes = $this->negociacionesService->obtenerMensajesPorNegociacion($idNegociacion);

        $this->view('chatNegociaciones/index', [
            'negociacion' => $negociacion,
            'publicacion' => $publicacion,
            'mensajes' => $mensajes
        ]);
    }

    public function enviarMensaje($idNegociacion) {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['mensaje']) && !empty($_POST['mensaje'])) {
            if (!isset($_SESSION['usuario_id'])) {
                header('Location: ' . URL_ROOT . '/login/index');
                exit;
            }

            $negociacion = $this->negociacionesService->obtenerNegociacionPorId($idNegociacion);
            $publicacion = $this->negociacionesService->obtenerPublicacionPorId($negociacion['id_publicacion']);

            $esComprador = $negociacion['id_comprador'] == $_SESSION['usuario_id'];
            $esVendedor = $publicacion['id_vendedor'] == $_SESSION['usuario_id'];

            if (!$esComprador && !$esVendedor) {
                header('Location: ' . URL_ROOT . '/mensajesNegociaciones/index?error=notfound');
                exit;
            }

            $this->negociacionesService->guardarMensajeNegociacion([
                'id_negociacion' => $idNegociacion,
                'id_emisor' => $_SESSION['usuario_id'],
                'mensaje' => $_POST['mensaje']
            ]);

            header('Location: ' . URL_ROOT . '/chatNegociaciones/ver/' . $idNegociacion);
            exit;
        } else {
            header('Location: ' . URL_ROOT . '/chatNegociaciones/ver/' . $idNegociacion);
            exit;
        }
    }

    public function obtenerMensajes($idNegociacion) {
        if (!isset($_SESSION['usuario_id'])) {
            http_response_code(401); // No autorizado
            echo json_encode(['error' => 'No autenticado']);
            exit;
        }

        $negociacion = $this->negociacionesService->obtenerNegociacionPorId($idNegociacion);
        $publicacion = $this->negociacionesService->obtenerPublicacionPorId($negociacion['id_publicacion']);

        $esComprador = $negociacion['id_comprador'] == $_SESSION['usuario_id'];
        $esVendedor = $publicacion['id_vendedor'] == $_SESSION['usuario_id'];

        if (!$esComprador && !$esVendedor) {
            http_response_code(403); // Prohibido
            echo json_encode(['error' => 'Acceso denegado']);
            exit;
        }

        header('Content-Type: application/json');
        $mensajes = $this->negociacionesService->obtenerMensajesPorNegociacion($idNegociacion);
        echo json_encode($mensajes);
        exit;
    }

    // ✅ Comprador envía una propuesta de precio
    public function enviarPropuesta($idNegociacion) {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['precioPropuesto'])) {
            if (!isset($_SESSION['usuario_id'])) {
                header('Location: ' . URL_ROOT . '/login/index');
                exit;
            }

            $negociacion = $this->negociacionesService->obtenerNegociacionPorId($idNegociacion);

            // Solo el comprador puede enviar propuesta
            if ($negociacion['id_comprador'] != $_SESSION['usuario_id']) {
                header('Location: ' . URL_ROOT . '/chatNegociaciones/ver/' . $idNegociacion);
                exit;
            }

            $precio = intval($_POST['precioPropuesto']);

            // Guardar propuesta en la tabla negociaciones
            $this->negociacionesService->actualizarPropuestaPrecio($idNegociacion, $precio);

            // Opcional: enviar mensaje al chat indicando propuesta
            $mensaje = "Propuesta de precio: $" . number_format($precio, 0, ',', '.') . " COP";
            $this->negociacionesService->guardarMensajeNegociacion([
                'id_negociacion' => $idNegociacion,
                'id_emisor' => $_SESSION['usuario_id'],
                'mensaje' => $mensaje
            ]);

            header('Location: ' . URL_ROOT . '/chatNegociaciones/ver/' . $idNegociacion);
            exit;
        }
    }


    // ✅ Vendedor acepta o rechaza la propuesta
    public function responderPropuesta($idNegociacion) {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['accion'])) {
            if (!isset($_SESSION['usuario_id'])) {
                header('Location: ' . URL_ROOT . '/login/index');
                exit;
            }

            $negociacion = $this->negociacionesService->obtenerNegociacionPorId($idNegociacion);
            $publicacion = $this->negociacionesService->obtenerPublicacionPorId($negociacion['id_publicacion']);

            // Solo el vendedor puede responder propuestas
            if ($publicacion['id_vendedor'] != $_SESSION['usuario_id']) {
                header('Location: ' . URL_ROOT . '/chatNegociaciones/ver/' . $idNegociacion);
                exit;
            }

            $accion = $_POST['accion'];
            $precio = $negociacion['propuesta_precio'];

            if ($accion === 'aceptar') {
                $this->negociacionesService->cerrarTrato($idNegociacion, 'aceptada', $precio);

                // Opcional: mensaje al chat
                $this->negociacionesService->guardarMensajeNegociacion([
                    'id_negociacion' => $idNegociacion,
                    'id_emisor' => $_SESSION['usuario_id'],
                    'mensaje' => "✅ Trato aceptado por el vendedor. Precio final: $" . number_format($precio, 0, ',', '.') . " COP"
                ]);
            } elseif ($accion === 'rechazar') {
                $this->negociacionesService->cerrarTrato($idNegociacion, 'rechazada', null);

                // Opcional: mensaje al chat
                $this->negociacionesService->guardarMensajeNegociacion([
                    'id_negociacion' => $idNegociacion,
                    'id_emisor' => $_SESSION['usuario_id'],
                    'mensaje' => "❌ Propuesta rechazada por el vendedor."
                ]);
            }

            header('Location: ' . URL_ROOT . '/chatNegociaciones/ver/' . $idNegociacion);
            exit;
        }
    }


}

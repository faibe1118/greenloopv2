<?php

require_once APP_ROOT . '/app/models/services/PqrsService.php';

class MensajesPqrsController extends Controller {
    private $pqrsService;

    public function __construct() {
        $this->pqrsService = new PqrsService();
    }

    // Mostrar bandeja de PQRS del usuario logueado
    public function index() {
        if (!isset($_SESSION['usuario_id'])) {
            header('Location: ' . URL_ROOT . '/login/index');
            exit;
        }

        $idUsuario = $_SESSION['usuario_id'];
        $pqrs = $this->pqrsService->obtenerPqrsAbiertosPorUsuario($idUsuario);

        $this->view('mensajesPqrs/index', ['pqrs' => $pqrs]);
    }


    // Mostrar detalle de una PQRS
    public function ver($idPqrs) {
        if (!isset($_SESSION['usuario_id'])) {
            header('Location: ' . URL_ROOT . '/login/index');
            exit;
        }

        $detalle = $this->pqrsService->obtenerPqrsPorId($idPqrs);

        if (!$detalle || $detalle['id_usuario'] != $_SESSION['usuario_id']) {
            header('Location: ' . URL_ROOT . '/mensajesPqrs/index?error=notfound');
            exit;
        }

        // 👈 Aquí obtienes los mensajes asociados a esa PQRS
        $mensajes = $this->pqrsService->obtenerMensajesPorPqrs($idPqrs);

        $this->view('pqrschat/index', [
            'pqrs' => $detalle,
            'mensajes' => $mensajes
        ]);
    }


    /*public function ver($idPqrs) {
        session_start();  // <-- Al principio del método, por seguridad

        echo "<pre>SESION:\n";
        var_dump($_SESSION);
        echo "\nID PQRS:\n";
        var_dump($idPqrs);

        // Ahora utilizamos el nuevo método filtrando por ID de PQRS Y ID de usuario
        $detalle = $this->pqrsService->obtenerPqrsPorIdYUsuario($idPqrs, $_SESSION['usuario_id']);

        echo "\nDETALLE PQRS:\n";
        var_dump($detalle);
        echo "</pre>";

        exit;  // <-- IMPORTANTE: detener la ejecución para ver el resultado
    }*/

    // (Opcional) Método para cerrar una PQRS
    public function cerrar($idPqrs) {
        if (!isset($_SESSION['usuario_id'])) {
            header('Location: ' . URL_ROOT . '/login/index');
            exit;
        }

        $detalle = $this->pqrsService->obtenerPqrsPorId($idPqrs);
        if (!$detalle || $detalle['id_usuario'] != $_SESSION['usuario_id']) {
            header('Location: ' . URL_ROOT . '/mensajesPqrs/index?error=notfound');
            exit;
        }

        $this->pqrsService->actualizarPqrs($idPqrs, 'cerrado', date('Y-m-d H:i:s'));

        header('Location: ' . URL_ROOT . '/mensajesPqrs/index?success=closed');
        exit;
    }
}

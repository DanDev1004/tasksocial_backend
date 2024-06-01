<?php
require_once __DIR__ . '/../controllers/TareaController.php';

$tareaController = new TareaController();

$requestMethod = $_SERVER['REQUEST_METHOD'];
$data = json_decode(file_get_contents('php://input'), true);
$action = $_GET['action'] ?? null;


if ($action === null) {
    http_response_code(400);
    echo json_encode(['message' => 'Es requerido un parametro action']);
    exit();
}

switch ($requestMethod) {
    case 'POST':
        switch ($action) {
            case 'crear':
                echo json_encode($tareaController->crear($data));
                break;
            case 'actualizar':
                echo json_encode($tareaController->actualizar($data));
                break;
            case 'eliminar':
                echo json_encode($tareaController->eliminar($data));
                break;
            case 'eliminarHechas':
                echo json_encode($tareaController->eliminarHechas($data));
                break;
            default:
                http_response_code(400);
                echo json_encode(['message' => 'action invalido']);
                break;
        }
        break;
    case 'GET':
        switch ($action) {
            case 'obtenerPorUsuario':
                $usuario_id = $_GET['usuario_id'] ?? null;
                if ($usuario_id !== null) {
                    $data = ['usuario_id' => $usuario_id];
                    echo json_encode($tareaController->obtenerPorUsuario($data));
                } else {
                    http_response_code(400);
                    echo json_encode(['message' => 'Parametro usuario_id desconocido']);
                }
                break;
            default:
                http_response_code(400);
                echo json_encode(['message' => 'action invalido']);
                break;
        }
        break;
    default:
        http_response_code(405);
        echo json_encode(['message' => 'Metodo no permitido']);
        break;
}
?>

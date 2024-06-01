<?php
require_once __DIR__ . '/../controllers/AuthController.php';

$authController = new AuthController();

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
            case 'register':
                echo json_encode($authController->register($data));
                break;
            case 'login':
                echo json_encode($authController->login($data));
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

<?php
require_once 'vendor/autoload.php';
use \Firebase\JWT\JWT;
use \Firebase\JWT\Key;

function authenticate() {
    $headers = apache_request_headers();
    if (isset($headers['Authorization'])) {
        $token = str_replace('Bearer ', '', $headers['Authorization']);
        try {
            $decoded = JWT::decode($token, new Key('your_secret_key', 'HS256'));
            return $decoded;
        } catch (Exception $e) {
            http_response_code(401);
            echo json_encode(['message' => 'Acceso denegado', 'error' => $e->getMessage()]);
            exit();
        }
    } else {
        http_response_code(401);
        echo json_encode(['message' => 'Token no encontrado']);
        exit();
    }
}
?>

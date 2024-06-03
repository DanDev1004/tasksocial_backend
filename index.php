<?php
require_once 'CORS.php';
require_once 'middleware.php';


$request = $_SERVER['REQUEST_URI'];

switch (true) {
    case preg_match('/\/gestion_tareas\/backend\/index.php\/api\/auth/', $request):
        require 'routes/auth.php';
        break;
    case preg_match('/\/gestion_tareas\/backend\/index.php\/api\/tareas/', $request):
        authenticate();  
        require 'routes/tarea.php';
        break;
    case preg_match('/\/gestion_tareas\/backend\/index.php\/api\/pdf/', $request):
        authenticate();  
        require 'routes/pdf.php';
        break;


    default:
        http_response_code(404);
        echo json_encode(['message' => 'ruta desconocida']);
        break;
}
?>



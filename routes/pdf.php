<?php
require_once __DIR__ . '/../config/Conexion.php';
require_once __DIR__ . '/../controllers/TareaController.php';
require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../CORS.php'; 

use Dompdf\Dompdf;

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $tareaController = new TareaController();
    $usuario_id = $_GET['usuario_id'] ?? null;

    if ($usuario_id === null) {
        http_response_code(400);
        echo json_encode(['message' => 'Es requerido un parametro usuario_id']);
        exit();
    }

    $tareas = $tareaController->obtenerPorUsuario(['usuario_id' => $usuario_id]);

    $html = '<h1>Mis Tareas</h1>';
    $html .= '<ul>';
    foreach ($tareas as $tarea) {
        $html .= '<li><strong>' . $tarea['titulo'] . '</strong>: ' . $tarea['descripcion'] . '</li>';
    }
    $html .= '</ul>';

    // Creando el pdf
    $dompdf = new Dompdf();
    $dompdf->loadHtml($html);
    $dompdf->setPaper('A4', 'portrait');
    $dompdf->render();
    $dompdf->stream('mis_tareas.pdf', array('Attachment' => 1));
} else {
    http_response_code(405);
    echo json_encode(['message' => 'Metodo no permitido']);
}
?>

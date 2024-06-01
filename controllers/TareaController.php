<?php
require_once __DIR__ . '/../config/Conexion.php';
require_once __DIR__ . '/../models/Tarea.php';

class TareaController {
    private $db;
    private $tarea;

    public function __construct() {
        $database = new Conexion();
        $this->db = $database->getConnection();
        $this->tarea = new Tarea($this->db);
    }

    public function crear($data) {
        $this->tarea->usuario_id = $data['usuario_id'];
        $this->tarea->titulo = $data['titulo'];
        $this->tarea->descripcion = $data['descripcion'];

        return ($this->tarea->crear()) ? ['status' => 'success', 'message' => 'Tarea creada con éxito'] 
                                       : ['status' => 'error', 'message' => 'Error al crear la tarea'] ;
    }

    public function actualizar($data) {
        $this->tarea->id = $data['id'];
        $this->tarea->titulo = $data['titulo'];
        $this->tarea->descripcion = $data['descripcion'];
        $this->tarea->estado = $data['estado'];

        return ($this->tarea->actualizar()) ? ['status' => 'success', 'message' => 'Tarea actualizada con éxito'] 
                                            : ['status' => 'error', 'message' => 'Error al actualizar la tarea'] ;
    }

    public function eliminar($data) {
        $this->tarea->id = $data['id'];

        return ($this->tarea->eliminar()) ? ['status' => 'success', 'message' => 'Tarea eliminada con éxito'] 
                                          : ['status' => 'error', 'message' => 'Error al eliminar la tarea'] ; 
    }

    public function eliminarHechas($data) {
        $this->tarea->usuario_id = $data['usuario_id'];

        return ($this->tarea->eliminarHechas()) ? ['status' => 'success', 'message' => 'Tareas hechas eliminadas con éxito'] 
                                                : ['status' => 'error', 'message' => 'Error al eliminar las tareas hechas'] ;
    }

    public function obtenerPorUsuario($data) {
        $this->tarea->usuario_id = $data['usuario_id'];
        return $this->tarea->obtenerPorUsuario();
    }
}
?>

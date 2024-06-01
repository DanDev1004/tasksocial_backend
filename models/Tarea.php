<?php
class Tarea {
    private $conn;
    private $table_name = "tareas";

    public $id;
    public $usuario_id;
    public $titulo;
    public $descripcion;
    public $estado;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function crear() {
        $query = "INSERT INTO " . $this->table_name." SET usuario_id=:usuario_id, titulo=:titulo, descripcion=:descripcion, estado='ABIERTA'";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':usuario_id', $this->usuario_id);
        $stmt->bindParam(':titulo', $this->titulo);
        $stmt->bindParam(':descripcion', $this->descripcion);

         return ($stmt->execute()) ? true : false; 
    }

    public function actualizar() {
        $query = "UPDATE " . $this->table_name . " SET titulo=:titulo, descripcion=:descripcion, estado=:estado WHERE id=:id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $this->id);
        $stmt->bindParam(':titulo', $this->titulo);
        $stmt->bindParam(':descripcion', $this->descripcion);
        $stmt->bindParam(':estado', $this->estado);

        return ($stmt->execute()) ? true : false; 
    }

    public function eliminar() {
        $query = "DELETE FROM ".$this->table_name." WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $this->id);

        return ($stmt->execute()) ? true : false; 
    }

    public function eliminarHechas() {
        $query = "DELETE FROM " .$this->table_name. " WHERE usuario_id = :usuario_id AND estado = 'HECHO'";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':usuario_id', $this->usuario_id);

         return ($stmt->execute()) ? true : false; 
    }

    public function obtenerPorUsuario() {
        $query = "SELECT * FROM ".$this->table_name." WHERE usuario_id = :usuario_id";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':usuario_id', $this->usuario_id);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>

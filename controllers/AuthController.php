<?php
require_once __DIR__ . '/../config/Conexion.php';
require_once __DIR__ . '/../models/Usuario.php';
require_once __DIR__ . '/../jwt.php';

class AuthController {
    private $db;
    private $usuario;

    public function __construct() {
        $database = new Conexion();
        $this->db = $database->getConnection();
        $this->usuario = new Usuario($this->db);
    }

    public function register($data) {
        $this->usuario->username = $data['username'];
        $this->usuario->email = $data['email'];
        $this->usuario->password = $data['password'];
   
        return ($this->usuario->registrar()) ? ['status' => 'success', 'message' => 'Usuario registrado con éxito'] 
                                             : ['status' => 'error', 'message' => 'Error al registrar el usuario'] ;
    }

    public function login($data) {
        $this->usuario->email = $data['email'];
        $this->usuario->password = $data['password'];

        if ($this->usuario->login()) {
            $token = generate_jwt(['id' => $this->usuario->id, 'username' => $this->usuario->username]);
            return ['status' => 'success', 'token' => $token];
        }
        return ['status' => 'error', 'message' => 'Credenciales inválidas'];
    }
}
?>

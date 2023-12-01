<?php

class Conexion{

     private $host = 'localhost';
    private $usuario = 'root';
    private $clave = 'root';
    private $nombreDB = 'sistema_ube';
    private $conexion;

    public function __construct() {
        $this->conexion = new mysqli($this->host, $this->usuario, $this->clave, $this->nombreDB);

        if ($this->conexion->connect_error) {
            die("La conexión a la base de datos falló: " . $this->conexion->connect_error);
        }
    }
     public function obtenerConexion() {
        return $this->conexion;
    }
}

?>
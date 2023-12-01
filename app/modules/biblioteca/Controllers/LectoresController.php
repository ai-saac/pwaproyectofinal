<?php

/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/PHPClass.php to edit this template
 */

/**
 * Description of LectoresController
 *
  /**
 * @author CRISTIAN PAZ
 * @date 30 nov. 2023
 * @time 18:39:08
 */
//LLAMO LA CONECCION A LA BASE DE DATOS
include '../../../../config/conection.php';

//Esto es lo primero que se invoca al ingresar a este controlador (LLAMA AL METODO REGISTRAR)

$obj = new LectoresController();

if (isset($_GET['action']) && $_GET['action'] == 'load_lector') {
    $id = $_GET['id'];
    $response = $obj->load_lector($id);

    if (count($response) > 0) {
        echo json_encode($response);
    } else {
        echo json_encode('fail');
    }
} else if (isset($_GET['action']) && $_GET['action'] == 'delete_lector') {
    $id = $_GET['id'];
    $response = $obj->delete_lector($id);

    if ($response == "success") {
        $resp['status'] = 'success';
        $resp['msg'] = 'Usuario eliminado exitosamente';
    } else {
        $resp['status'] = 'fail';
        $resp['msg'] = 'A ocurrido un error al eliminar el usuario';
    }
    echo json_encode($resp);
}

class LectoresController {

    private $conexion;

    public function __construct() {
        $this->conexion = new Conexion();
    }

    public function load_lector($id) {
        $conn = $this->conexion->obtenerConexion();
        $sql = "SELECT * FROM users WHERE id = " . $id . " ";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $lector = [];

            while ($row = $result->fetch_assoc()) {
                $lector[] = $row;
            }
        } else {
            echo "No se encontro el lector.";
        }
        return $lector;
    }

    public function delete_lector($id) {
        $conn = $this->conexion->obtenerConexion();
        $sql = "DELETE FROM users WHERE id = " . $id . " ";

        if ($conn->query($sql) == true) {
            return "success";
        } else {
            return "fail";
        }
    }
}

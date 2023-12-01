<?php

/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/PHPClass.php to edit this template
 */

/**
 * Description of LoginController
 *
  /**
 * @author CRISTIAN PAZ
 * @date 30 nov. 2023
 * @time 11:30:00
 */
//LLAMO LA CONECCION A LA BASE DE DATOS
session_start();

include '../../config/conection.php';

//Esto es lo primero que se invoca al ingresar a este controlador (LLAMA AL METODO LOGIN)
$obj = new LoginController();

$respuesta = $obj->login();

if ($respuesta) {
    return 'success';
} else {
    return 'fail';
}

class LoginController {

    private $conexion;

    public function __construct() {

        $this->conexion = new Conexion();
    }

    public function login() {
        $conn = $this->conexion->obtenerConexion();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $usuario = $_POST['email_user'];
            $password = $_POST['password'];
        }

        if (empty($usuario)) {
            $resp['status'] = 'warning';
            $resp['file'] = 'El campo usuario esta vacio';
            echo json_encode($resp);
            die();
        }
        if (empty($password)) {
            $resp['status'] = 'warning';
            $resp['file'] = 'El campo contraseña esta vacio.';
            echo json_encode($resp);
            die();
        }

        $sql = "SELECT * FROM users WHERE username = '" . $usuario . "' OR email = '" . $usuario . "' ";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $users = [];

            while ($row = $result->fetch_assoc()) {
                $users[] = $row;
            }

            if (password_verify($password, $users[0]['password'])) {

                $_SESSION['user'] = $users[0];
                $_SESSION['user']['id'];
                $_SESSION['user']['nombres'];
                $_SESSION['user']['apellidos'];
                $_SESSION['user']['role_id'];

                $resp['status'] = 'success';
                $resp['file'] = $users[0]['role_id'];
            } else {
                $resp['status'] = 'fail';
                $resp['file'] = 'Contraseña Incorrecta.';
            }
        } else {
            $resp['status'] = 'fail';
            $resp['file'] = 'Usuario no registrado.';
        }

        echo json_encode($resp);
    }
}

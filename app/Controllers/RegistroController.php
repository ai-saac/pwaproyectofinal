<?php

/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/PHPClass.php to edit this template
 */

/**
 * Description of RegistroController
 *
  /**
 * @author CRISTIAN PAZ
 * @date 30 nov. 2023
 * @time 10:25:49
 */
//LLAMO LA CONECCION A LA BASE DE DATOS
include '../../config/conection.php';

//Esto es lo primero que se invoca al ingresar a este controlador (LLAMA AL METODO REGISTRAR)

$obj = new RegistroController();

$response = $obj->registrar();
if ($response == "success") {
    $resp['status'] = 'success';
    $resp['msg'] = 'Usuario registrado exitosamente';
} else if ($response == "success_edit") {
    $resp['status'] = 'succ_edit';
    $resp['msg'] = 'Usuario actualizado exitosamente';
} else {
    $resp['status'] = 'fail';
    $resp['msg'] = 'A ocurrido un error al registrar el usuario';
}
 echo json_encode($resp);

class RegistroController {

    private $conexion;

    public function __construct() {

        $this->conexion = new Conexion();
    }

    public function registrar() {

        $conn = $this->conexion->obtenerConexion();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nombres = $_POST['nombre'];
            $apellidos = $_POST['apellido'];
            $email = $_POST['email'];
            $rol = $_POST['role_id'];
            $state = $_POST['state'];
            $usuario = $_POST['username'];
            $password = $_POST['password'];
            $confirm_password = $_POST['confirm_password'];
            $id_lec = $_POST['id_lec'];

            if (empty($nombres)) {
                $resp['status'] = 'warning';
                $resp['msg'] = 'Por favor, ingresa tu nombre.';
                echo json_encode($resp);
                die();
            }

            if (empty($apellidos)) {
                $resp['status'] = 'warning';
                $resp['msg'] = 'Por favor, ingresa tu apellido.';
                echo json_encode($resp);
                die();
            }


            if (empty($email)) {
                $resp['status'] = 'warning';
                $resp['msg'] = 'Por favor, ingresa tu correo electrónico.';
                echo json_encode($resp);
                die();
            } else {
                $email = $this->test_input($email);
                if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    $resp['status'] = 'warning';
                    $resp['msg'] = 'Formato de correo electrónico no válido.';
                    echo json_encode($resp);
                    die();
                }
            }

            if (empty($usuario)) {
                $resp['status'] = 'warning';
                $resp['msg'] = 'Por favor, ingresa tu usuario.';
                echo json_encode($resp);
                die();
            }

            if (empty($password)) {
                $resp['status'] = 'warning';
                $resp['msg'] = 'Por favor, ingresa tu contraseña.';
                echo json_encode($resp);
                die();
            }

            if (empty($confirm_password)) {
                $resp['status'] = 'warning';
                $resp['msg'] = 'Por favor, confirma tu contraseña.';
                echo json_encode($resp);
                die();
            } else {
                $confirm_password = $this->test_input($confirm_password);
                if ($password != $confirm_password) {
                    $resp['status'] = 'warning';
                    $resp['msg'] = 'Las contraseñas no coinciden.';
                    echo json_encode($resp);
                    die();
                }
            }

            $p = password_hash($password, PASSWORD_DEFAULT);

            $sql_existe_mail = "SELECT * FROM users WHERE email = '" . $email . "' ";
            $consulta = $conn->query($sql_existe_mail);

            if ($consulta->num_rows > 0 &&  empty($id_lec)) {
                $resp['status'] = 'warning';
                $resp['msg'] = 'Este correo ya se encuentra registrado con otro usuario';
                echo json_encode($resp);
                die;
            }

            $sql_existe_user = "SELECT * FROM users WHERE username = '" . $usuario . "' ";
            $consulta2 = $conn->query($sql_existe_user);

            if ($consulta2->num_rows > 0 &&  empty($id_lec)) {
                $resp['status'] = 'warning';
                $resp['msg'] = 'Este nombre de usuario ya se encuentra registrado';
                echo json_encode($resp);
                die;
            }

            if (empty($id_lec)) {
                $sql = "INSERT INTO users (nombres ,apellidos, email, username, password, role_id, state) VALUES (?, ?, ?, ?, ?, ?, ?)";

                $stmt = $conn->prepare($sql);
                $stmt->bind_param("sssssii", $nombres, $apellidos, $email, $usuario, $p, $rol, $state);

                if ($stmt->execute()) {
                    return "success";
                } else {
                    return "fail";
                }
            } else {
                $sql = " UPDATE users SET nombres = '" . $nombres . "',"
                        . " apellidos = '" . $apellidos . "',"
                        . " email = '" . $email . "',"
                        . " username = '" . $usuario . "',"
                        . "password ='" . $p . "',"
                        . "role_id ='" . $rol . "',"
                        . " state='" . $state . "'"
                        . "  WHERE  id=" . $id_lec . "  ";

                if ($conn->query($sql) == true) {
                    return "success_edit";
                } else {
                    return "fail";
                }
            }
        }
    }

    function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
}

<?php

/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/PHPClass.php to edit this template
 */

/**
 * Description of PrestarController
 *
  /**
 * @author CRISTIAN PAZ
 * @date 30 nov. 2023
 * @time 20:51:30
 */
//LLAMO LA CONECCION A LA BASE DE DATOS
include '../../../../config/conection.php';

//Esto es lo primero que se invoca al ingresar a este controlador (LLAMA AL METODO REGISTRAR)

$obj = new PrestarController();

if (isset($_GET['action']) && $_GET['action'] == 'load_prestamo') {
    $id = $_GET['id'];
    $response = $obj->load_prestamo($id);

    if (count($response) > 0) {
        echo json_encode($response);
    } else {
        echo json_encode('fail');
    }
} else if (isset($_GET['action']) && $_GET['action'] == 'delete_prestamo') {
    $id = $_GET['id'];
    $response = $obj->delete_prestamo($id);

    if ($response == "success") {
        $resp['status'] = 'success';
        $resp['msg'] = 'Prestamo eliminado exitosamente';
    } else {
        $resp['status'] = 'fail';
        $resp['msg'] = 'A ocurrido un error al prestar el libro';
    }
    echo json_encode($resp);
} else {
    $response = $obj->prestar();
    if ($response == "success") {
        $resp['status'] = 'success';
        $resp['msg'] = 'Libro prestado al suaurio seleccionado';
    } else if ($response == "success_edit") {
        $resp['status'] = 'succ_edit';
        $resp['msg'] = 'Prestamo actualizado exitosamente';
    } else {
        $resp['status'] = 'fail';
        $resp['msg'] = 'A ocurrido un error al prestar el libro';
    }
    echo json_encode($resp);
}

class PrestarController {

    private $conexion;

    public function __construct() {

        $this->conexion = new Conexion();
    }

    public function prestar() {
        $conn = $this->conexion->obtenerConexion();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id_user = $_POST['id_user'];
            $lector = $_POST['lector_id'];
            $libro = $_POST['libro_id'];
            $f_devolucion = $_POST['f_devolucion'];
            $f_prestamo = date('Y-m-d');
            $id_prestamo = $_POST['id_prestamo'];

            if (empty($f_devolucion)) {
                $resp['status'] = 'warning';
                $resp['msg'] = 'Deve seleccionar una fecha de entrega';
                echo json_encode($resp);
                die();
            }
            if (empty($id_prestamo)) {
                $query = "INSERT INTO transactions (user_id, book_id, date_of_issue, date_of_return, lector_id) VALUES (?, ?, ?, ?, ?)";
                $stmt = $conn->prepare($query);
                $stmt->bind_param('iissi', $id_user, $libro, $f_prestamo, $f_devolucion, $lector);

                if ($stmt->execute()) {
                    return "success";
                } else {
                    return "fail";
                }
            } else {
                $sql = " UPDATE transactions SET user_id = '" . $id_user . "',"
                        . " book_id = '" . $libro . "',"
                        . " date_of_issue = '" . $f_prestamo . "',"
                        . " date_of_return = '" . $f_devolucion . "',"
                        . " lector_id ='" . $lector . "' "
                        . "  WHERE  id=" . $id_prestamo . "  ";
                if ($conn->query($sql) == true) {
                    return "success_edit";
                } else {
                    return "fail";
                }
            }
        }
    }

    public function load_prestamo($id) {
        $conn = $this->conexion->obtenerConexion();
        $sql = "SELECT * FROM transactions WHERE id = " . $id . " ";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $libro = [];

            while ($row = $result->fetch_assoc()) {
                $libro[] = $row;
            }
        } else {
            echo "No se encontro el prestamo.";
        }
        return $libro;
    }

    public function delete_prestamo($id) {
        $conn = $this->conexion->obtenerConexion();
        $sql = "DELETE FROM transactions WHERE id = " . $id . " ";
        $result = $conn->query($sql);

        if ($conn->query($sql) == true) {
            return "success";
        } else {
            return "fail";
        }
    }
}

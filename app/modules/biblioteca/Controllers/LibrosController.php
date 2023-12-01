<?php

/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/PHPClass.php to edit this template
 */

/**
 * Description of LibrosController
 *
  /**
 * @author CRISTIAN PAZ
 * @date 30 nov. 2023
 * @time 16:09:18
 */
//LLAMO LA CONECCION A LA BASE DE DATOS
include '../../../../config/conection.php';

//Esto es lo primero que se invoca al ingresar a este controlador (LLAMA AL METODO REGISTRAR)

$obj = new LibrosController();

if (isset($_GET['action']) && $_GET['action'] == 'load_libro') {
    $id = $_GET['id'];
    $response = $obj->load_libro($id);

    if (count($response) > 0) {
        echo json_encode($response);
    } else {
        echo json_encode('fail');
    }
} else if (isset($_GET['action']) && $_GET['action'] == 'delete_libro') {
    $id = $_GET['id'];
    $response = $obj->delete_libro($id);

    if ($response == "success") {
        $resp['status'] = 'success';
        $resp['msg'] = 'Libro eliminado exitosamente';
    } else {
        $resp['status'] = 'fail';
        $resp['msg'] = 'A ocurrido un error al eliminar el libro';
    }
    echo json_encode($resp);
} else {
    $response = $obj->save_libro();
    if ($response == "success") {
        $resp['status'] = 'success';
        $resp['msg'] = 'Libro registrado exitosamente';
    } else if ($response == "success_edit") {
        $resp['status'] = 'succ_edit';
        $resp['msg'] = 'Libro actualizado exitosamente';
    } else {
        $resp['status'] = 'fail';
        $resp['msg'] = 'A ocurrido un error al registrar el libro';
    }
    echo json_encode($resp);
}

class LibrosController {

    private $conexion;

    public function __construct() {
        $this->conexion = new Conexion();
    }

    public function save_libro() {
        $conn = $this->conexion->obtenerConexion();

        if ($_SERVER["REQUEST_METHOD"] == "POST") {

            $title = $_POST['title'];
            $author = $_POST['author'];
            $year = $_POST['year'];
            $genre = $_POST['genre'];
            $quantity = $_POST['quantity'];
            $state = $_POST['state'];
            $id_libro = $_POST['id_libro'];

            if (empty($title)) {
                $resp['status'] = 'warning';
                $resp['msg'] = 'Debe ingresar un título';
                echo json_encode($resp);
                die();
            }
            if (empty($author)) {
                $resp['status'] = 'warning';
                $resp['msg'] = 'Debe ingresar un autor';
                echo json_encode($resp);
                die();
            }
            if (empty($year)) {
                $resp['status'] = 'warning';
                $resp['msg'] = 'Debe ingresar un año';
                echo json_encode($resp);
                die();
            }
            if (empty($genre)) {
                $resp['status'] = 'warning';
                $resp['msg'] = 'Debe ingresar un genero';
                echo json_encode($resp);
                die();
            }
            if (empty($quantity)) {
                $resp['status'] = 'warning';
                $resp['msg'] = 'Debe ingresar una cantidad';
                echo json_encode($resp);
                die();
            }

            if (empty($id_libro)) {
                $query = "INSERT INTO books (title, author, year, genre, quantity,state) VALUES (?, ?, ?, ?, ?, ?)";
                $stmt = $conn->prepare($query);
                $stmt->bind_param('ssisii', $title, $author, $year, $genre, $quantity, $state);

                if ($stmt->execute()) {
                    return "success";
                } else {
                    return "fail";
                }
            } else {
                $sql = " UPDATE books SET title = '" . $title . "', author = '" . $author . "', year = '" . $year . "', genre = '" . $genre . "',quantity ='" . $quantity . "', state='" . $state . "'  WHERE  id=" . $id_libro . "  ";
                if ($conn->query($sql) == true) {
                    return "success_edit";
                } else {
                    return "fail";
                }
            }
        }
    }

    public function load_libro($id) {
        $conn = $this->conexion->obtenerConexion();
        $sql = "SELECT * FROM books WHERE id = " . $id . " ";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $libro = [];

            while ($row = $result->fetch_assoc()) {
                $libro[] = $row;
            }
        } else {
            echo "No se encontro el libro.";
        }
        return $libro;
    }

    public function delete_libro($id) {
        $conn = $this->conexion->obtenerConexion();
        $sql = "DELETE FROM books WHERE id = " . $id . " ";
        $result = $conn->query($sql);

        if ($conn->query($sql) == true) {
            return "success";
        } else {
            return "fail";
        }
    }
}

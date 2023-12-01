<?php

require_once '../../../../config/conn.php';

try {

    $query = "SELECT tb1.*, tb1.date_of_issue AS prestado, 
                        tb1.date_of_return AS devuelto, tb2.username AS nombre,CONCAT(tb2.nombres,' ',tb2.apellidos) AS nombre_user_prestador,
                        tb3.title AS titulo, tb3.state AS estado, CONCAT(tb4.nombres,' ',tb4.apellidos) AS nombre_lector
                    FROM transactions AS tb1
                    LEFT JOIN users AS tb2 ON tb1.user_id = tb2.id
                    LEFT JOIN books AS tb3 ON tb1.book_id = tb3.id
                    LEFT JOIN users AS tb4 ON tb4.id = tb1.lector_id";

    $consulta= $conn->query($query);

    $transacciones = [];
    if ($consulta->num_rows > 0) {
        while ($row = $consulta->fetch_assoc()) {
            $transacciones[] = $row;
        }
    }


} catch (PDOException $e) {
    echo json_encode(array('success' => false, 'error' => 'Error al procesar con la base de datos: ' . $e->getMessage()));
} 

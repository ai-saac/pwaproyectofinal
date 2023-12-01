<!DOCTYPE html>
<!--
/**
 * Description of view_prestar_libro
 *
/**
 * @author CRISTIAN PAZ
 * @date 30 nov. 2023
 * @time 15:13:31
 */       
 
Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHPWebPage.php to edit this template
-->

<?php
require_once '../../../../config/conn.php';

try {
    $libros_q = "SELECT * FROM books";
    $consulta = $conn->query($libros_q);

   $list_libros = [];
    while ($row = $consulta->fetch_assoc()) {
        $list_libros[] = $row;
    }
} catch (PDOException $e) {
    echo json_encode(array('success' => false, 'error' => 'Error al comunicarse con la base de datos: ' . $e->getMessage()));
} finally {
    // Cierra la conexión a la base de datos
    $pdo = null;
}

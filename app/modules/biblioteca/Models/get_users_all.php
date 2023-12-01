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
// Conectarse a la base de datos
require_once '../../../../config/conn.php';


try {
    $users_q = "SELECT tb1.*, tb2.name rol FROM users tb1 "
            . "LEFT JOIN roles tb2 ON tb2.id = tb1.role_id";
    $consulta = $conn->query($users_q);

    $list_users = [];
    while ($row = $consulta->fetch_assoc()) {
        $list_users[] = $row;
    }
} catch (PDOException $e) {
    echo json_encode(array('success' => false, 'error' => 'Error al comunicarse con la base de datos: ' . $e->getMessage()));
} finally {
    // Cierra la conexión a la base de datos
    $pdo = null;
}

<?php
    date_default_timezone_set('America/Guayaquil');

$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "sistema_ube";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("La conexión a fallado: " . $conn->connect_error);
}

?>

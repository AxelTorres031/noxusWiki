<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "noxuswiki";
// Crear conexión
$conexion = new mysqli($servername, $username, $password, $database);
// Verifica la conexión
if ($conexion->connect_error) {
    die("Error en la conexión: " . $conexion->connect_error);
}
?>

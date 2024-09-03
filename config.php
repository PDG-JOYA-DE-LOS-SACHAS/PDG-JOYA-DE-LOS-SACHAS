<?php
$servername = "sql312.infinityfree.com"; // Reemplaza con tu servidor MySQL
$username = "if0_37198882"; // Reemplaza con tu usuario MySQL
$password = "Freiya000"; // Reemplaza con tu contraseña MySQL
$dbname = "if0_37198882_registro_empleados"; // Reemplaza con el nombre de tu base de datos

// Crear la conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}
?>

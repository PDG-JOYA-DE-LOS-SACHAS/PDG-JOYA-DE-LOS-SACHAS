<?php
date_default_timezone_set('America/Guayaquil'); // Ajusta la zona horaria según tu ubicación
$servername = "sql312.infinityfree.com";
$username = "if0_37198882";
$password = "Freiya000";
$dbname = "if0_37198882_registro_empleados";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}
?>

<?php
include('config.php');

$empleados = [
    ['nombre_usuario' => 'Henry', 'password' => 'Henry123.'],
    ['nombre_usuario' => 'empleado2', 'password' => 'password2'],
    // Agrega más empleados aquí
];

foreach ($empleados as $empleado) {
    $nombre_usuario = $empleado['nombre_usuario'];
    $password = password_hash($empleado['password'], PASSWORD_DEFAULT); // Encriptar la contraseña

    $sql = "INSERT INTO empleados (nombre_usuario, password) VALUES ('$nombre_usuario', '$password')";

    if ($conn->query($sql) === TRUE) {
        echo "Empleado $nombre_usuario creado exitosamente.<br>";
    } else {
        echo "Error creando el empleado $nombre_usuario: " . $conn->error . "<br>";
    }
}

$conn->close();
?>

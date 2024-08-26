<?php
session_start();
include('config.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre_usuario = $_POST['nombre_usuario'];
    $password = $_POST['password'];

    $sql = "SELECT id FROM empleados WHERE nombre_usuario = '$nombre_usuario' AND password = '$password'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $_SESSION['employee_id'] = $result->fetch_assoc()['id'];
        header("Location: dashboard.html");
    } else {
        echo "Nombre de usuario o contraseña incorrectos.";
    }
}
?>

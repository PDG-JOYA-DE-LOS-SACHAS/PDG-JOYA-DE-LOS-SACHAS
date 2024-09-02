<?php
session_start();
include('config.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre_usuario = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT id, password FROM empleados WHERE nombre_usuario = '$nombre_usuario'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row['password'])) {
            $_SESSION['employee_id'] = $row['id'];
            header("Location: ../html/dashboard.html");
        } else {
            echo "Contraseña incorrecta.";
        }
    } else {
        echo "Nombre de usuario incorrecto.";
    }
}

$conn->close();
?>

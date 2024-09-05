<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $role = $_POST['role'];

    $sql = "INSERT INTO usuarios (username, password, role) VALUES ('$username', '$password', '$role')";
    if ($conn->query($sql) === TRUE) {
        echo "Usuario registrado exitosamente";
    } else {
        echo "Error: " . $conn->error;
    }
}
?>

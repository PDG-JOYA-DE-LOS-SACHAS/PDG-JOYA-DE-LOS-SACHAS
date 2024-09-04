<?php
session_start();
include 'db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: index.html");
    exit();
}

$user_id = $_SESSION['user_id'];
$ip_address = $_SERVER['REMOTE_ADDR'];
$geolocalizacion = "Latitud, Longitud"; // Aquí puedes implementar la obtención de geolocalización

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $hora = date('Y-m-d H:i:s');
    $tipo = $_POST['tipo'];

    $sql = "INSERT INTO registros (user_id, $tipo, ip_address, geolocalizacion) VALUES ('$user_id', '$hora', '$ip_address', '$geolocalizacion')";
    if ($conn->query($sql) === TRUE) {
        echo "Registro exitoso";
    } else {
        echo "Error: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Horas</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <h1>Registrar Hora</h1>
        <form action="registro.php" method="post">
            <input type="hidden" name="tipo" value="hora_inicio">
            <button type="submit">Registrar Inicio</button>
        </form>
        <form action="registro.php" method="post">
            <input type="hidden" name="tipo" value="salida_almuerzo">
            <button type="submit">Registrar Salida Almuerzo</button>
        </form>
        <form action="registro.php" method="post">
            <input type="hidden" name="tipo" value="regreso_almuerzo">
            <button type="submit">Registrar Regreso Almuerzo</button>
        </form>
        <form action="registro.php" method="post">
            <input type="hidden" name="tipo" value="hora_salida">
            <button type="submit">Registrar Salida</button>
        </form>
    </div>
</body>
</html>

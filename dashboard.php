<?php
session_start();
if (!isset($_SESSION['employee_id'])) {
    header("Location: login.php");
    exit();
}
include('config.php');

$employee_id = $_SESSION['employee_id'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $tipo_registro = $_POST['tipo_registro'];
    $observacion = $_POST['observacion'];
    $ip_address = $_SERVER['REMOTE_ADDR'];

    // Obtener geolocalización usando una API pública
    $api_url = "http://ip-api.com/json/{$ip_address}";
    $response = file_get_contents($api_url);
    $location_data = json_decode($response, true);

    if ($location_data['status'] == 'success') {
        $latitud = $location_data['lat'];
        $longitud = $location_data['lon'];
        $ciudad = $location_data['city'];
        $pais = $location_data['country'];
    } else {
        $latitud = null;
        $longitud = null;
        $ciudad = "Desconocido";
        $pais = "Desconocido";
    }

    $hora_registro = date('Y-m-d H:i:s');

    $sql = "INSERT INTO registros_horarios (empleado_id, tipo_registro, observacion, hora_registro, ip_address, latitud, longitud, ciudad, pais) 
            VALUES ('$employee_id', '$tipo_registro', '$observacion', '$hora_registro', '$ip_address', '$latitud', '$longitud', '$ciudad', '$pais')";

    if ($conn->query($sql) === TRUE) {
        echo "Registro guardado exitosamente.";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
</head>
<body>
    <form method="POST" action="dashboard.php">
        <label>Seleccione el tipo de registro:</label>
        <select name="tipo_registro" required>
            <option value="entrada">Hora de Entrada</option>
            <option value="salida_almuerzo">Salida al Almuerzo</option>
            <option value="regreso_almuerzo">Regreso del Almuerzo</option>
            <option value="fin_jornada">Fin de la Jornada</option>
        </select>
        <label>Observaciones:</label>
        <textarea name="observacion"></textarea>
        <button type="submit">Registrar</button>
    </form>
</body>
</html>

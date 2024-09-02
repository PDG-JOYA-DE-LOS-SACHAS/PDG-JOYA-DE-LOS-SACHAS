<?php
// dashboard.php
session_start();
if (!isset($_SESSION['employee_id'])) {
    header("Location: login.php");
    exit();
}
include('config.php');

$employee_id = $_SESSION['employee_id'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $type = $_POST['type'];
    $observaciones = $_POST['observaciones'];
    $ip_address = $_SERVER['REMOTE_ADDR'];

    // Obtener la dirección IP del usuario
    $ip = $_SERVER['REMOTE_ADDR'];

    // Usar una API pública para obtener la geolocalización
    $api_url = "http://ip-api.com/json/{$ip}";
    $response = file_get_contents($api_url);
    $location_data = json_decode($response, true);

    // Verificar si la solicitud fue exitosa
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

    // Insertar registro en la base de datos
    $sql = "INSERT INTO registros_horarios (employee_id, tipo, observaciones, ip_address, latitud, longitud, ciudad, pais)
            VALUES ('$employee_id', '$type', '$observaciones', '$ip_address', '$latitud', '$longitud', '$ciudad', '$pais')";

    if ($conn->query($sql) === TRUE) {
        echo "Registro guardado exitosamente.";
    } else {
        echo "Error al guardar el registro: " . $conn->error;
    }
}

$conn->close();
?>

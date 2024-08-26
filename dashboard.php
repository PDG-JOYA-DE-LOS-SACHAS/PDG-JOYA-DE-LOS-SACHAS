<?php
session_start();
include('config.php');

if (!isset($_SESSION['employee_id'])) {
    header("Location: login.html");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $employee_id = $_SESSION['employee_id'];
    $tipo = $_POST['tipo'];
    $observaciones = $_POST['observaciones'];
    $ip_address = $_SERVER['REMOTE_ADDR'];

    // Obtener la geolocalización usando una API pública
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

    $sql = "INSERT INTO registros_horarios (employee_id, tipo, observaciones, ip_address, latitud, longitud, ciudad, pais) 
            VALUES ('$employee_id', '$tipo', '$observaciones', '$ip_address', '$latitud', '$longitud', '$ciudad', '$pais')";

    if ($conn->query($sql) === TRUE) {
        header("Location: registro_exitoso.html");
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
$conn->close();
?>

<?php
session_start();
include 'db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: https://github.com/PDG-JOYA-DE-LOS-SACHAS/PDG-JOYA-DE-LOS-SACHAS/index.html");
    exit();
}

$user_id = $_SESSION['user_id'];

function getPublicIP() {
    $ip = file_get_contents('https://api.ipify.org');
    return $ip;
}

$ip_address = getPublicIP();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $hora = date('Y-m-d H:i:s');
    $tipo = $_POST['tipo'];
    $geolocalizacion = $_POST['geolocalizacion'];

    if ($conn->connect_error) {
        die("Conexión fallida: " . $conn->connect_error);
    }

    $sql = "SELECT * FROM registros WHERE user_id='$user_id' AND DATE(hora_inicio) = CURDATE()";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $registro = $result->fetch_assoc();
        $sql = "UPDATE registros SET $tipo='$hora', ip_address='$ip_address', geolocalizacion='$geolocalizacion' WHERE id=" . $registro['id'];
    } else {
        $sql = "INSERT INTO registros (user_id, $tipo, ip_address, geolocalizacion) VALUES ('$user_id', '$hora', '$ip_address', '$geolocalizacion')";
    }

    if ($conn->query($sql) === TRUE) {
        echo "Registro exitoso";
    } else {
        echo "Error en la consulta SQL: " . $conn->error;
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
    <script>
        function getLocation(tipo) {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(function(position) {
                    var lat = position.coords.latitude;
                    var lng = position.coords.longitude;
                    var apiKey = 'pk.f8e1be815c34737b3632ef3def7358b4';
                    var url = `https://us1.locationiq.com/v1/reverse.php?key=${apiKey}&lat=${lat}&lon=${lng}&format=json`;

                    fetch(url)
                        .then(response => response.json())
                        .then(data => {
                            var address = data.display_name;
                            document.getElementById('geolocalizacion').value = address;
                            document.getElementById('tipo').value = tipo;
                            document.getElementById('registroForm').submit();
                        })
                        .catch(error => {
                            alert('Error al obtener la geolocalización: ' + error);
                        });
                });
            } else {
                alert("Geolocalización no es soportada por este navegador.");
            }
        }
    </script>
</head>
<body>
    <div class="container">
        <h1>Registrar Hora</h1>
        <form id="registroForm" action="registro.php" method="post">
            <input type="hidden" id="tipo" name="tipo">
            <input type="hidden" id="geolocalizacion" name="geolocalizacion">
            <button type="button" onclick="getLocation('hora_inicio')">Registrar Inicio</button>
            <button type="button" onclick="getLocation('salida_almuerzo')">Registrar Salida Almuerzo</button>
            <button type="button" onclick="getLocation('regreso_almuerzo')">Registrar Regreso Almuerzo</button>
            <button type="button" onclick="getLocation('hora_salida')">Registrar Salida</button>
        </form>
    </div>
</body>
</html>

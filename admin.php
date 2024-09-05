<?php
session_start();
include 'db.php';

if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'admin') {
    header("Location: https://github.com/PDG-JOYA-DE-LOS-SACHAS/PDG-JOYA-DE-LOS-SACHAS/index.html");
    exit();
}

$sql = "SELECT r.*, u.username FROM registros r JOIN usuarios u ON r.user_id = u.id";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Administración</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <h1>Registros de Empleados</h1>
        <table>
            <tr>
                <th>Usuario</th>
                <th>Hora de Inicio</th>
                <th>Salida Almuerzo</th>
                <th>Regreso Almuerzo</th>
                <th>Hora de Salida</th>
                <th>IP Address</th>
                <th>Geolocalización</th>
            </tr>
            <?php while($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?php echo htmlspecialchars($row['username']); ?></td>
                <td><?php echo htmlspecialchars($row['hora_inicio']); ?></td>
                <td><?php echo htmlspecialchars($row['salida_almuerzo']); ?></td>
                <td><?php echo htmlspecialchars($row['regreso_almuerzo']); ?></td>
                <td><?php echo htmlspecialchars($row['hora_salida']); ?></td>
                <td><?php echo htmlspecialchars($row['ip_address']); ?></td>
                <td><?php echo htmlspecialchars($row['geolocalizacion']); ?></td>
            </tr>
            <?php endwhile; ?>
        </table>
    </div>
</body>
</html>

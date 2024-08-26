<?php
session_start();
include('config.php');

// Verificar si el usuario es admin (esto depende de cómo manejes los roles de usuario)

$sql = "SELECT r.*, e.nombre_usuario FROM registros_horarios r JOIN empleados e ON r.empleado_id = e.id";
$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Dashboard del Administrador</title>
</head>
<body>
    <h2>Registros de Horarios</h2>
    <table border="1">
        <tr>
            <th>Empleado</th>
            <th>Tipo de Registro</th>
            <th>Observaciones</th>
            <th>Hora de Registro</th>
            <th>IP</th>
            <th>Latitud</th>
            <th>Longitud</th>
            <th>Ciudad</th>
            <th>País</th>
        </tr>
        <?php
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td>" . $row['nombre_usuario'] . "</td>
                        <td>" . $row['tipo_registro'] . "</td>
                        <td>" . $row['observacion'] . "</td>
                        <td>" . $row['hora_registro'] . "</td>
                        <td>" . $row['ip_address'] . "</td>
                        <td>" . $row['latitud'] . "</td>
                        <td>" . $row['longitud'] . "</td>
                        <td>" . $row['ciudad'] . "</td>
                        <td>" . $row['pais'] . "</td>
                      </tr>";
            }
        } else {
            echo "<tr><td colspan='9'>No hay registros</td></tr>";
        }
        ?>
    </table>
</body>
</html>

<?php
$conn->close();
?>

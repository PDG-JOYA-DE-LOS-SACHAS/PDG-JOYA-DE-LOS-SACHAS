<?php
include('config.php');

$sql_empleados = "CREATE TABLE IF NOT EXISTS empleados (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre_usuario VARCHAR(50) NOT NULL,
    password VARCHAR(255) NOT NULL
)";

$sql_registros_horarios = "CREATE TABLE IF NOT EXISTS registros_horarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    employee_id INT,
    tipo VARCHAR(50),
    observaciones TEXT,
    ip_address VARCHAR(50),
    latitud FLOAT,
    longitud FLOAT,
    ciudad VARCHAR(50),
    pais VARCHAR(50),
    fecha TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (employee_id) REFERENCES empleados(id) ON DELETE CASCADE
)";

if ($conn->query($sql_empleados) === TRUE) {
    echo "Tabla 'empleados' creada exitosamente.<br>";
} else {
    echo "Error creando la tabla 'empleados': " . $conn->error . "<br>";
}

if ($conn->query($sql_registros_horarios) === TRUE) {
    echo "Tabla 'registros_horarios' creada exitosamente.<br>";
} else {
    echo "Error creando la tabla 'registros_horarios': " . $conn->error . "<br>";
}

$conn->close();
?>

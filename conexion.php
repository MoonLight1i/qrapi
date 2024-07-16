<?php

$dbHost = "34.16.51.17"; // Puedes usar la IP de tu instancia de Cloud SQL
$dbName = "testtrabajadores";
$dbUser = "root";
$dbPass = "Camila18.";

// Conexión a la base de datos
$mysqli = new mysqli($dbHost, $dbUser, $dbPass, $dbName);

// Verifica la conexión
if ($mysqli->connect_error) {
    die("Error de conexión2: " . $mysqli->connect_error);
} else {
    echo "Conexión exitosa a la base de datos en Google Cloud SQL";
}

// Cierra la conexión al finalizar el script (opcional)
$mysqli->close();
?>

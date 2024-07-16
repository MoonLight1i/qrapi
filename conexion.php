<?php

$dbHost = "bnkmhfbejtjb7spgoo9y-mysql.services.clever-cloud.com"; // Puedes usar la IP de tu instancia de Cloud SQL
$dbName = "bnkmhfbejtjb7spgoo9y";
$dbUser = "u9vnum12sjerze2e";
$dbPass = "mtFb4ZZOkfFc3ACB30W4";

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

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    require_once 'conexion.php';

    $nombre = $_POST["nombre"];
    $contrasena = $_POST["contrasena"];

    $query = "SELECT id FROM usuarios WHERE nombre = '$nombre' AND contrasena = '$contrasena'";
    $resultado = $mysql->query($query);

    if ($resultado->num_rows > 0) {
        $row = $resultado->fetch_assoc();
        $response = array("status" => "success", "message" => "Login exitoso", "id" => $row['id']);
    } else {
        $response = array("status" => "error", "message" => "Nombre de usuario o contraseña incorrectos");
    }
    // Establecer el encabezado Content-Type a application/json
    header('Content-Type: application/json');
    echo json_encode($response);
} else {
    $response = array("status" => "error", "message" => "Método no permitido");
    header('Content-Type: application/json');
    echo json_encode($response);
}
?>

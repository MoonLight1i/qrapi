<?php
header('Content-Type: application/json');

require_once 'conexion.php';

// Obtener datos POST
$numpedido = $_POST['numpedido'] ?? '';
$nombre_usuario = $_POST['nombre_usuario'] ?? '';

// Validar entrada
if (empty($numpedido) || empty($nombre_usuario)) {
    echo json_encode(array("status" => "error", "message" => "Número de pedido o nombre de usuario no proporcionado"));
    exit();
}

// Consulta SQL usando parámetros preparados para evitar SQL injection
$query = "SELECT u.nombre AS nombre_usuario, t.nombre_trabajo AS nombre_trabajo,e.progreso, e.fechaescaneo, p.numpedido 
          FROM usuarios u 
          JOIN escaneos e ON u.id = e.id_usuario 
          JOIN trabajos t ON e.id_trabajo = t.id 
          JOIN pedidos p ON e.id_pedido = p.numpedido 
          WHERE p.numpedido = ? AND u.nombre = ?";

// Preparar la consulta
$stmt = $mysql->prepare($query);
$stmt->bind_param("ss", $numpedido, $nombre_usuario);
$stmt->execute();
$result = $stmt->get_result();

// Verificar si la consulta se ejecutó correctamente
if ($result) {
    $trabajos = [];
    while ($row = $result->fetch_assoc()) {
        $trabajos[] = [
            "nombre_usuario" => $row['nombre_usuario'],
            "nombre_trabajo" => $row['nombre_trabajo'],
            "fechaescaneo" => $row['fechaescaneo'],
            "progreso" => $row['progreso'],
            "numpedido" => $row['numpedido']
        ];
    }
    echo json_encode(array("status" => "success", "trabajos" => $trabajos), JSON_UNESCAPED_UNICODE);
} else {
    echo json_encode(array("status" => "error", "message" => "Error al ejecutar la consulta"));
}

// Cerrar statement y conexión
$stmt->close();
$mysql->close();
?>

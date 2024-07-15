<?php
header('Content-Type: application/json');

require_once 'conexion.php';

// Obtener datos POST
$nombre = $_POST['nombre'] ?? '';

// Validar entrada
if (empty($nombre)) {
    echo json_encode(array("status" => "error", "message" => "Nombre de usuario no proporcionado"));
    exit();
}

// Consulta SQL usando parámetros preparados para evitar SQL injection
$query = "SELECT u.nombre AS nombre_usuario, t.nombre_trabajo AS nombre_trabajo, SUM(e.progreso) AS progreso_total, p.numpedido ,e.fechaescaneo
          FROM usuarios u 
          JOIN escaneos e ON u.id = e.id_usuario 
          JOIN trabajos t ON e.id_trabajo = t.id 
          JOIN pedidos p ON e.id_pedido = p.numpedido 
          WHERE u.nombre = ? 
          GROUP BY p.numpedido 
          ORDER BY e.fechaescaneo DESC";

// Preparar la consulta
$stmt = $mysql->prepare($query);
$stmt->bind_param("s", $nombre);
$stmt->execute();
$result = $stmt->get_result();

// Verificar si la consulta se ejecutó correctamente
if ($result) {
    $usuariosPedidos = [];
    while ($row = $result->fetch_assoc()) {
        $usuariosPedidos[] = array(
            "nombre_usuario" => $row['nombre_usuario'],
            "nombre_trabajo" => $row['nombre_trabajo'],
            "progreso_total" => $row['progreso_total'],
            "fechaescaneo" => $row['fechaescaneo'],
            "numpedido" => $row['numpedido']
        );
    }
    echo json_encode(array("status" => "success", "usuariosPedidos" => $usuariosPedidos), JSON_UNESCAPED_UNICODE);
} else {
    echo json_encode(array("status" => "error", "message" => "Error al ejecutar la consulta"));
}

// Cerrar statement y conexión
$stmt->close();
$mysql->close();
?>

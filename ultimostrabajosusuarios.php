<?php
require_once 'conexion.php';

$query = "SELECT u.nombrecom, u.nombre AS nombre_usuario, t.nombre_trabajo AS nombre_trabajo, e.fechaescaneo, p.numpedido FROM usuarios u LEFT JOIN escaneos e ON u.id = e.id_usuario LEFT 
JOIN trabajos t ON e.id_trabajo = t.id LEFT JOIN pedidos p ON e.id_pedido = p.numpedido WHERE e.fechaescaneo = ( SELECT MAX(e2.fechaescaneo) FROM escaneos e2 WHERE e2.id_usuario = u.id ) ORDER BY u.nombre";
$result = $mysql->query($query);

if ($result) {
    $usuarios = [];
    while ($row = $result->fetch_assoc()) {
        $usuarios[] = [
            "nombre_usuario" => $row['nombre_usuario'],
            "nombre_trabajo" => $row['nombre_trabajo'],
            "fechaescaneo" => $row['fechaescaneo'],
            "nombrecom" => $row['nombrecom'],
            "numpedido" => $row['numpedido']
        ];
    }
    echo json_encode(array("status" => "success", "usuarios" => $usuarios));
} else {
    echo json_encode(array("status" => "error", "message" => "Error al ejecutar la consulta"));
}

$mysql->close();
?>
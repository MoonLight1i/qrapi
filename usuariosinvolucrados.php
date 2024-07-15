<?php
require_once 'conexion.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_pedido = $_POST["id_pedido"];

    $query = "
        SELECT u.nombre, e.progreso, t.nombre_trabajo, e.tipo_prenda , e.inicio_trabajo, e.fechaescaneo
        FROM escaneos e
        JOIN usuarios u ON e.id_usuario = u.id
        JOIN trabajos t ON e.id_trabajo = t.id
        WHERE e.id_pedido = '$id_pedido'";

    $resultado = $mysql->query($query);

    if ($resultado) {
        $usuarios = array();
        while ($row = $resultado->fetch_assoc()) {
            $usuarios[] = $row;
        }
        echo json_encode(array("status" => "success", "usuarios" => $usuarios));
    } else {
        echo json_encode(array("status" => "error", "message" => "Error al realizar la consulta"));
    }
} else {
    echo json_encode(array("status" => "error", "message" => "Método no permitido"));
}
?>
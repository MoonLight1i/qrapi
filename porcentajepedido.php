<?php
require_once 'conexion.php';

// Recuperar el parámetro del pedido (id_pedido)
$id_pedido = $_POST['id_pedido'];

// Consulta para contar todos los registros de escaneos para el pedido
$query_registros = "SELECT COUNT(*) AS total_registros FROM escaneos WHERE id_pedido = '$id_pedido'";
$result_registros = $mysql->query($query_registros);

if ($result_registros) {
    $row_registros = $result_registros->fetch_assoc();
    $total_registros = $row_registros['total_registros'];
} else {
    $total_registros = 0;
}

// Consulta para obtener el progreso total del pedido
$query_progreso = "SELECT COALESCE(SUM(progreso), 0) AS progreso_total FROM escaneos WHERE id_pedido = '$id_pedido'";
$result_progreso = $mysql->query($query_progreso);

if ($result_progreso) {
    $row_progreso = $result_progreso->fetch_assoc();
    $progreso_total = $row_progreso['progreso_total'];
} else {
    $progreso_total = 0;
}

// Consulta para obtener la cantidad del pedido
$query_cantidad_pedido = "SELECT cantidad FROM pedidos WHERE numpedido = '$id_pedido'";
$result_cantidad_pedido = $mysql->query($query_cantidad_pedido);

if ($result_cantidad_pedido) {
    $row_cantidad_pedido = $result_cantidad_pedido->fetch_assoc();
    $cantidad_pedido = $row_cantidad_pedido['cantidad'];
} else {
    $cantidad_pedido = 0;
}

// Calcular el porcentaje de progreso
if ($cantidad_pedido > 0 && $total_registros > 0) {
    $porcentaje_progreso = ($progreso_total / $total_registros) / $cantidad_pedido * 100;
} else {
    $porcentaje_progreso = 0;
}

echo json_encode(array(
    "status" => "success",
    "porcentaje_progreso" => $porcentaje_progreso
));
?>
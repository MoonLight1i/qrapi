<?php
header('Content-Type: application/json');

// Verificar el método de solicitud
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    require_once 'conexion.php';

    // Realizar la consulta a la base de datos
    $query = "SELECT * FROM pedidos";
    $resultado = $mysql->query($query);

    // Verificar si se obtuvieron resultados
    if ($resultado->num_rows > 0) {
        $response = array();
        while ($row = $resultado->fetch_assoc()) {
            $pedido = array(
                "numpedido" => $row['numpedido'],
                "cantidad" => $row['cantidad'],
                "descripcion" => $row['descripcion'],
                "qr" => $row['qr'],
                "fecha_pedido" => $row['fecha_pedido']

            );
            array_push($response, $pedido);
        }
        // Enviar la lista de pedidos como JSON
        echo json_encode(array("status" => "success", "pedidos" => $response));
    } else {
        $response = array("status" => "error", "message" => "No se encontraron pedidos");
        echo json_encode($response);
    }
} else {
    $response = array("status" => "error", "message" => "Método no permitido");
    echo json_encode($response);
}
?>

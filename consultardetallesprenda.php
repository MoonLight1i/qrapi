<?php
header('Content-Type: application/json');

// Verificar el método de solicitud
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    require_once 'conexion.php';

    $numpedido = $_POST['numpedido'];

    if ($numpedido) {
        // Realizar la consulta a la base de datos para obtener los detalles del pedido y el nombre de la prenda
        $query = "
            SELECT dp.id_prenda, dp.cantidad, p.prenda AS nombre_prenda
            FROM detallespedidos dp
            INNER JOIN prendas p ON dp.id_prenda = p.id
            WHERE dp.id_pedido = '$numpedido'";
            
        $resultado = $mysql->query($query);

        // Verificar si se obtuvieron resultados
        if ($resultado->num_rows > 0) {
            $detalles = array();
            while ($row = $resultado->fetch_assoc()) {
                $detalle = array(
                    'id_prenda' => $row['id_prenda'],
                    'cantidad' => $row['cantidad'],
                    'nombre_prenda' => $row['nombre_prenda']
                );
                array_push($detalles, $detalle);
            }
            // Enviar la lista de detalles como JSON
            echo json_encode(array("status" => "success", "detalles" => $detalles));
        } else {
            $response = array("status" => "error", "message" => "No se encontraron detalles para este pedido");
            echo json_encode($response);
        }
    } else {
        $response = array("status" => "error", "message" => "Número de pedido no proporcionado");
        echo json_encode($response);
    }
} else {
    $response = array("status" => "error", "message" => "Método no permitido");
    echo json_encode($response);
}
?>

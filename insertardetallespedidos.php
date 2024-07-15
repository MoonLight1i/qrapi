<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    require_once 'conexion.php'; // Asegúrate de que este archivo contenga la configuración de tu conexión

    // Obtén los datos del POST
    $id_pedido = $_POST["id_pedido"];
    $id_prenda = $_POST["id_prenda"];
    $cantidad = $_POST["cantidad"]; // Cantidad de la prenda


    try {
        // Insertar en la tabla `detallespedidos`
        $query = "INSERT INTO detallespedidos (id_pedido, id_prenda, cantidad) VALUES ('".$id_pedido."','".$id_prenda."','".$cantidad."')";
        $resultado=$mysql->query($query);

        // Verificar si la inserción en `detallespedidos` fue exitosa
        if ($resultado) {
            echo "Inserción exitosa en detallespedidos.";
        } else {
            echo "Error al insertar detalles del pedido.";
        }


    } catch (mysqli_sql_exception $e) {
        echo "Error en la inserción de detalles: " . $e->getMessage();
    }

}
?>

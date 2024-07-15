<?php
require_once 'conexion.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $progreso = $_POST["progreso"];
    $fechaescaneo = $_POST["fechaescaneo"];
    $id_usuario = $_POST["id_usuario"];
    $id_pedido = $_POST["id_pedido"];
    $tipo_prenda = $_POST["tipo_prenda"];
    $id_trabajo = $_POST["id_trabajo"];
    $inicio_trabajo = $_POST["inicio_trabajo"];

    // Verificar si ya existe un registro con el mismo id_pedido e id_usuario
    $query = "SELECT * FROM escaneos WHERE id_pedido = '$id_pedido' AND id_usuario = '$id_usuario' AND id_trabajo = '$id_trabajo'";
    $resultado = $mysql->query($query);

    if ($resultado->num_rows > 0) {
        // Si existe, actualizar el registro con progreso + 1 y fechaescaneo actualizada
        $updateQuery = "UPDATE escaneos SET progreso = progreso + 1, fechaescaneo = '$fechaescaneo' WHERE id_pedido = '$id_pedido' AND id_usuario = '$id_usuario' AND id_trabajo ='$id_trabajo'";
        $updateResultado = $mysql->query($updateQuery);

        if ($updateResultado) {
            echo json_encode(array("status" => "success", "message" => "Actualización exitosa"));
        } else {
            echo json_encode(array("status" => "error", "message" => "Error al actualizar"));
        }
    } else {
        // Si no existe, insertar un nuevo registro con progreso inicial 1 y fechaescaneo actual
        $insertQuery = "INSERT INTO escaneos (progreso, fechaescaneo, id_usuario, id_pedido, tipo_prenda,id_trabajo,inicio_trabajo) VALUES ('1', '$fechaescaneo', '$id_usuario', '$id_pedido','$tipo_prenda','$id_trabajo','$inicio_trabajo')";
        $insertResultado = $mysql->query($insertQuery);

        if ($insertResultado) {
            echo json_encode(array("status" => "success", "message" => "Inserción exitosa"));
        } else {
            echo json_encode(array("status" => "error", "message" => "Error al insertar"));
        }
    }
} else {
    echo json_encode(array("status" => "error", "message" => "Método no permitido"));
}
?>

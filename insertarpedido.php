<?php
if($_SERVER["REQUEST_METHOD"]=="POST"){
require_once 'conexion.php';

    $numpedido=$_POST["numpedido"];
    $cantidad=$_POST["cantidad"];
    $descripcion=$_POST["descripcion"];
    $qr=$_POST["qr"];
    $fecha_pedido=$_POST["fecha_pedido"];

    $query="INSERT INTO pedidos(numpedido,cantidad,descripcion,qr,fecha_pedido) VALUES ('".$numpedido."','".$cantidad."','".$descripcion."','".$qr."','".$fecha_pedido."')";

    $resultado=$mysql->query($query);

    if($resultado==true){
echo"Incercion exitosa";
    }else{
        echo"Incercion fallida";
    }
}

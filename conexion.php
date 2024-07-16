<?php

$mysql= new mysqli("34.16.51.17","root2","Camila18.","testtrabajadores");
if($mysql->connect_error){
    die("Error de conexion");
}else{
    echo "conexion exitosa en google";
}

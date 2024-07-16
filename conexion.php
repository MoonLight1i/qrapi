<?php

$mysql= new mysqli("34.16.51.17","root2","Camila18.","testtrabajadores", null , "helpful-binder-429515-u1:us-central1:qrdatabase");
if($mysql->connect_error){
    die("Error de conexion jijija");
}else{
    echo "conexion exitosa en google";
}

<?php

$mysql= new mysqli("189.135.52.166"","root","Camila18.","testtrabajadores");
if($mysql->connect_error){
    die("Error de conexion");
}else{
    echo "conexion exitosa en google";
}

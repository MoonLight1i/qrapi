<?php
$mysql= new mysqli("localhost","root","","testtrabajadores");
if($mysql->connect_error){
    die("Error de conexion");
}else{
    echo "";
}
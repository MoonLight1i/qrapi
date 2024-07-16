<?php
$host = '0.0.0.0';
$port = 8080;

$docRoot = '/var/www/html';
$router = $docRoot . '/index.php';

echo "Iniciando servidor en $host:$port\n";
exec("php -S $host:$port -t $docRoot $router");

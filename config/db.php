<?php
$host = "localhost";
$dbname = "hotel";
$user = "root";
$password = "";

try{
    $conexion = new PDO("mysql:host=$host;dbname=$dbname",$user,$password);

    $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    echo "Conectado correctamente";
}catch(PDOException $e){
    echo "Error de conexión: " . $e->getMessage();
}

?>
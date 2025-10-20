<?php 
include_once 'credenciales.php';

function consulta($sql){
    // Usar directamente las variables de credenciales.php
    include 'credenciales.php';
    
    $connection = new mysqli($servidor, $usuario, $password, $baseDatos, $puerto);
    
    if ($connection->connect_error) {
        die("Error de conexión: " . $connection->connect_error);
    }
    
    $result = $connection->query($sql);
    return $result;
}
?>
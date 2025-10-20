<?php 
include_once 'credenciales.php';

function consulta($sql){
    // Usar variables definidas en credenciales.php
    global $servidor, $usuario, $password, $baseDatos, $puerto;
    
    // Si no están definidas, usar constantes (compatibilidad)
    $host = isset($servidor) ? $servidor : (defined('HOST') ? HOST : 'localhost');
    $user = isset($usuario) ? $usuario : (defined('USER') ? USER : 'root');
    $pass = isset($password) ? $password : (defined('PASS') ? PASS : '');
    $db = isset($baseDatos) ? $baseDatos : (defined('DB') ? DB : 'burgerkong');
    $port = isset($puerto) ? $puerto : 3306;
    
    $connection = new mysqli($host, $user, $pass, $db, $port);
    
    if ($connection->connect_error) {
        die("Error de conexión: " . $connection->connect_error);
    }
    
    $result = $connection->query($sql);
    return $result;
}
?>
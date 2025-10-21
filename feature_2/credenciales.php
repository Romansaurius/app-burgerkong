<?php
// Credenciales Railway
$servidor = "shuttle.proxy.rlwy.net";
$usuario = "root";
$password = "anJkMDnhTJoXaMDjgYFpfmkMBUskRZFu";
$baseDatos = "BurgerKong";
$puerto = 21840;

// Compatibilidad con código antiguo (solo si no están definidas)
if (!defined('HOST')) define("HOST", $servidor);
if (!defined('USER')) define("USER", $usuario);
if (!defined('PASS')) define("PASS", $password);
if (!defined('DB')) define("DB", $baseDatos);
?>
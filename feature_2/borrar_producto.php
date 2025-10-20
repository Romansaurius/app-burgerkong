<?php
session_start();
if (!isset($_SESSION['admin_logged']) || $_SESSION['admin_logged'] !== true) {
    header('Location: admin.php');
    exit();
}

include 'BurgerTools.php';

if (!isset($_GET['id'])) {
    header('Location: listar_producto.php');
    exit();
}

$id = $_GET['id'];

if (deleteProduct($id)) {
    $_SESSION['mensaje'] = "Producto eliminado exitosamente";
    $_SESSION['tipo_mensaje'] = "success";
} else {
    $_SESSION['mensaje'] = "Error al eliminar el producto";
    $_SESSION['tipo_mensaje'] = "error";
}

header('Location: listar_producto.php');
exit();
?>
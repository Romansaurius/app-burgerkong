<?php
session_start();
if (!isset($_SESSION['admin_logged']) || $_SESSION['admin_logged'] !== true) {
    header('Location: admin.php');
    exit();
}

include 'BurgerTools.php';
$productos = listAllProducts();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Productos - BurgerKong Admin</title>
    <link rel="stylesheet" href="css/styles_admin.css">
</head>
<body>
    <div class="admin-header">
        <h1>Gestión de Productos</h1>
        <div class="admin-nav">
            <a href="panel.php">Dashboard</a>
            <a href="listar_producto.php" class="active">Productos</a>
            <a href="listar_tickets.php">Tickets</a>
            <a href="logout.php">Cerrar Sesión</a>
        </div>
    </div>

    <div class="admin-container">
        <div class="table-header">
            <h2>Lista de Productos</h2>
            <a href="nuevo_producto.php" class="btn btn-primary">Nuevo Producto</a>
        </div>

        <div class="table-container">
            <table class="admin-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Imagen</th>
                        <th>Título</th>
                        <th>Categoría</th>
                        <th>Precio</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($productos as $producto): ?>
                    <tr>
                        <td><?= $producto['id'] ?></td>
                        <td>
                            <img src="<?= htmlspecialchars($producto['imagenMenu']) ?>" 
                                 alt="<?= htmlspecialchars($producto['titulo']) ?>" 
                                 class="product-thumb">
                        </td>
                        <td><?= htmlspecialchars($producto['titulo']) ?></td>
                        <td><?= htmlspecialchars($producto['categoria_nombre']) ?></td>
                        <td>$<?= number_format($producto['precio'], 2) ?></td>
                        <td class="actions">
                            <a href="editar_producto.php?id=<?= $producto['id'] ?>" class="btn btn-sm btn-warning">Editar</a>
                            <a href="borrar_producto.php?id=<?= $producto['id'] ?>" 
                               class="btn btn-sm btn-danger" 
                               onclick="return confirm('¿Estás seguro de eliminar este producto?')">Eliminar</a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
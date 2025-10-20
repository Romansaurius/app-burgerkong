<?php
session_start();
if (!isset($_SESSION['admin_logged']) || $_SESSION['admin_logged'] !== true) {
    header('Location: admin.php');
    exit();
}

include 'BurgerTools.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $titulo = $_POST['titulo'];
    $descripcion = $_POST['descripcion'];
    $precio = $_POST['precio'];
    $idCategoria = $_POST['idCategoria'];
    $imagenMenu = $_POST['imagenMenu'];
    $imagenDetalle = $_POST['imagenDetalle'];
    
    if (createProduct($titulo, $descripcion, $precio, $idCategoria, $imagenMenu, $imagenDetalle)) {
        $mensaje = "Producto creado exitosamente";
        $tipo_mensaje = "success";
    } else {
        $mensaje = "Error al crear el producto";
        $tipo_mensaje = "error";
    }
}

$categorias = listcategorias();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nuevo Producto - BurgerKong Admin</title>
    <link rel="stylesheet" href="css/styles_admin.css">
</head>
<body>
    <div class="admin-header">
        <h1>Nuevo Producto</h1>
        <div class="admin-nav">
            <a href="panel.php">Dashboard</a>
            <a href="listar_producto.php">Productos</a>
            <a href="listar_tickets.php">Tickets</a>
            <a href="logout.php">Cerrar Sesión</a>
        </div>
    </div>

    <div class="admin-container">
        <?php if (isset($mensaje)): ?>
            <div class="alert alert-<?= $tipo_mensaje ?>">
                <?= htmlspecialchars($mensaje) ?>
            </div>
        <?php endif; ?>

        <div class="form-container">
            <form method="POST" class="product-form">
                <div class="form-group">
                    <label for="titulo">Título del Producto:</label>
                    <input type="text" id="titulo" name="titulo" required>
                </div>

                <div class="form-group">
                    <label for="descripcion">Descripción:</label>
                    <textarea id="descripcion" name="descripcion" rows="4" required></textarea>
                </div>

                <div class="form-group">
                    <label for="precio">Precio:</label>
                    <input type="number" id="precio" name="precio" step="0.01" min="0" required>
                </div>

                <div class="form-group">
                    <label for="idCategoria">Categoría:</label>
                    <select id="idCategoria" name="idCategoria" required>
                        <option value="">Seleccionar categoría</option>
                        <?php foreach ($categorias as $categoria): ?>
                            <option value="<?= $categoria['id'] ?>"><?= htmlspecialchars($categoria['nombre']) ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="form-group">
                    <label for="imagenMenu">URL Imagen Menú:</label>
                    <input type="url" id="imagenMenu" name="imagenMenu" required>
                </div>

                <div class="form-group">
                    <label for="imagenDetalle">URL Imagen Detalle:</label>
                    <input type="url" id="imagenDetalle" name="imagenDetalle" required>
                </div>

                <div class="form-actions">
                    <button type="submit" class="btn btn-primary">Crear Producto</button>
                    <a href="listar_producto.php" class="btn btn-secondary">Cancelar</a>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
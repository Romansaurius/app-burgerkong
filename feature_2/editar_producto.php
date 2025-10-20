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
$producto = getProductById($id);

if (!$producto) {
    header('Location: listar_producto.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $titulo = $_POST['titulo'];
    $descripcion = $_POST['descripcion'];
    $precio = $_POST['precio'];
    $idCategoria = $_POST['idCategoria'];
    $imagenMenu = $_POST['imagenMenu'];
    $imagenDetalle = $_POST['imagenDetalle'];
    
    if (updateProduct($id, $titulo, $descripcion, $precio, $idCategoria, $imagenMenu, $imagenDetalle)) {
        $mensaje = "Producto actualizado exitosamente";
        $tipo_mensaje = "success";
        $producto = getProductById($id); // Recargar datos
    } else {
        $mensaje = "Error al actualizar el producto";
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
    <title>Editar Producto - BurgerKong Admin</title>
    <link rel="stylesheet" href="css/styles_admin.css">
</head>
<body>
    <div class="admin-header">
        <h1>Editar Producto</h1>
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
                    <input type="text" id="titulo" name="titulo" value="<?= htmlspecialchars($producto['titulo']) ?>" required>
                </div>

                <div class="form-group">
                    <label for="descripcion">Descripción:</label>
                    <textarea id="descripcion" name="descripcion" rows="4" required><?= htmlspecialchars($producto['descripcion']) ?></textarea>
                </div>

                <div class="form-group">
                    <label for="precio">Precio:</label>
                    <input type="number" id="precio" name="precio" step="0.01" min="0" value="<?= $producto['precio'] ?>" required>
                </div>

                <div class="form-group">
                    <label for="idCategoria">Categoría:</label>
                    <select id="idCategoria" name="idCategoria" required>
                        <?php foreach ($categorias as $categoria): ?>
                            <option value="<?= $categoria['id'] ?>" <?= $categoria['id'] == $producto['idCategoria'] ? 'selected' : '' ?>>
                                <?= htmlspecialchars($categoria['nombre']) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="form-group">
                    <label for="imagenMenu">URL Imagen Menú:</label>
                    <input type="url" id="imagenMenu" name="imagenMenu" value="<?= htmlspecialchars($producto['imagenMenu']) ?>" required>
                </div>

                <div class="form-group">
                    <label for="imagenDetalle">URL Imagen Detalle:</label>
                    <input type="url" id="imagenDetalle" name="imagenDetalle" value="<?= htmlspecialchars($producto['imagenDetalle']) ?>" required>
                </div>

                <div class="form-actions">
                    <button type="submit" class="btn btn-primary">Actualizar Producto</button>
                    <a href="listar_producto.php" class="btn btn-secondary">Cancelar</a>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
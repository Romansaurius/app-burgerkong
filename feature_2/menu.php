<?php
include 'BurgerTools.php';

if (isset($_GET['carrito'])) {
    $id = $_GET['carrito'];
    carrito($id); 
}

if (isset($_GET['sucursal'])) {
    $idSucursal = $_GET['sucursal'];
}



$cate=listcategorias();
$producto=[];

if (isset($_GET['id'])) {
    $categoria_id = $_GET['id'];
    $producto = listMyProduc($categoria_id);
} else {
    $categoria_id = $cate[0]['id'];
    $producto = listMyProduc($categoria_id);
}


$cantidadProductos = countproduct(); 
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/styles.css">
    <title>Menú BurgerKong</title>
</head>
<body>
    <div class="head">
        <!-- Logo principal -->
        <div class="a">
            <a href="sucursales.php">
                <img src="Logos/logo1.png" alt="Logo BurgerKong" class="logomain">
            </a>
        </div>
        
        <br><br>
        
        <!-- Categorías -->
        <div class="cat">
            <?php if (!empty($cate)): ?>
                <?php foreach ($cate as $info): ?>
                    <a href="menu.php?id=<?= htmlspecialchars($info['id']) ?>"><?= htmlspecialchars($info['nombre']) ?></a>‎ ‎
                <?php endforeach; ?>
            <?php else: ?>
                <p>No hay categorías disponibles.</p>
            <?php endif; ?>
        </div>
    </div>

    <div style="text-align: right; margin: 20px;">
<a href="carrito.php" class= "button">Ver carrito (<?php echo $cantidadProductos; ?>)</a>
</div>
   
    <div class="menu-container">
        <?php if (!empty($producto)): ?>
            <?php foreach ($producto as $info): ?>
                <div class="card">
                    <a href="detalles.php?id=<?= htmlspecialchars($info['id']) ?>">
                        <img src="<?= htmlspecialchars($info['imagenMenu']) ?>" alt="Imagen de <?= htmlspecialchars($info['titulo']) ?>" class="card-img">
                            <div class="card-info">  
                            <h2 class="card-title"><?= htmlspecialchars($info['titulo']) ?></h2> 
                            </a>
                         
                            </div>
                            <div class="card-footer">
                            <p class="text-tittle2">$<?= number_format($info['precio'], 2, ',', '.') ?></p>
                            <a href="menu.php?carrito=<?= htmlspecialchars($info['id']) ?>" class="card-button">🛒
                            </a>
                            </div>
                                    </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p>No hay productos disponibles.</p>
        <?php endif; ?>
    </div>

    <!-- Footer -->
    <footer>
        <p>&copy; 2024 BURGUER KONG. 
            <a href="https://drive.google.com/file/d/1A1QEBqsHXQake8fc94oqCjWPZsxcSF6i/view" target="_blank" rel="noopener">Información del creador</a>
        </p>
    </footer>
</body>
</html>
<?php
include_once 'BurgerTools.php';

// Manejar añadir al carrito
if (isset($_GET['carrito'])) {
    $id = $_GET['carrito'];
    carrito($id);
    // Redirigir para evitar reenvío del formulario
    header('Location: detalles.php?id=' . $id);
    exit();
}

$cate=listcategorias();
$producto=[];
if (isset($_GET['id'])) {
    $categoria_id = $_GET['id'];
    $producto = listMyProduc2($categoria_id);
} else {
    $categoria_id = $cate[0]['id'];
    $producto = listMyProduc2($categoria_id);
}

$cantidadProductos = countproduct();
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title></title>
<link rel="stylesheet" type="text/css" href="css/styles.css">

</head>
<body>

    <div class="head">
    <div class="a">
    <a href="sucursales.php"><img src="Logos/logo1.png" alt="Logo BurgerKong" class="logomain"> </a>
   </div>
    <br>
    <br>
  
   
  <div class="cat">

<?php

foreach ($cate as $info) {
    
    echo '<a href="menu.php?id=' . $info['id'] . '">' . $info['nombre'] . '  ‎ ‎   </a>';

}
     ?> 

    </div>

</div>

<div style="text-align: right; margin: 20px;">
    <a href="carrito.php" class="button2">Ver carrito (<?php echo $cantidadProductos; ?>)</a>
</div>








<div class="containerall">
    <div class="producto">
        <img src="<?php echo $producto['imagenMenu']; ?>" alt="<?php echo $producto['titulo']; ?>" class="producto-img">
        <h1 class="product-text"><?php echo $producto['titulo']; ?></h1>
        <p class="producto-price">$<?php echo number_format($producto['precio'], 2); ?></p>
        <div class="producto-actions">
            <a href="detalles.php?carrito=<?php echo $producto['id']; ?>" class="add-to-cart-btn">🛒 Añadir al Carrito</a>
            <a href="menu.php" class="back-button">Volver al Menú</a>
        </div>
    </div>
</div>


    <footer>
        <p>  &copy; 2024 BURGUER KONG.<a href="https://drive.google.com/file/d/1A1QEBqsHXQake8fc94oqCjWPZsxcSF6i/view" target="_blank"> Informacion del creador</a></p>
    </footer>
</body>
</html>

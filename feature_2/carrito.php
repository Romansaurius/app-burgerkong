<?php
session_start();
include 'BurgerTools.php';

if (!isset($_SESSION['carrito']) || !is_array($_SESSION['carrito'])) {
    $_SESSION['carrito'] = [];
}


if (isset($_GET['action'], $_GET['id'])) {
    $id = $_GET['id'];
    $action = $_GET['action'];

    if ($action === 'increment') {
     
        $_SESSION['carrito'][$id] = isset($_SESSION['carrito'][$id]) && is_numeric($_SESSION['carrito'][$id])
            ? intval($_SESSION['carrito'][$id]) + 1
            : 1;
    } elseif ($action === 'decrement') {
       
        if (isset($_SESSION['carrito'][$id]) && is_numeric($_SESSION['carrito'][$id])) {
            $_SESSION['carrito'][$id] = max(0, intval($_SESSION['carrito'][$id]) - 1);
            if ($_SESSION['carrito'][$id] === 0) {
                unset($_SESSION['carrito'][$id]);
            }
        }
    }
}


foreach ($_SESSION['carrito'] as $id => $cantidad) {
    if (!isset($_SESSION['carrito'][$id]) || !is_numeric($_SESSION['carrito'][$id])) {
        $_SESSION['carrito'][$id] = 1; 
    }
}


$total = calcularTotal($_SESSION['carrito']);
$_SESSION['total'] = $total;
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="css/styles.css">
    <title>Carrito</title>
</head>
<body>
    <div class="head">
        <div class="a">
            <a href="sucursales.php"><img src="Logos/logo1.png" alt="Logo BurgerKong" class="logomain"></a>
        </div>
        <br><br>
    </div>


<div class="containerall">
    <div style="text-align: right; margin: 20px;">
        <a href="menu.php" class="button2">Volver</a>
        <a href="ticket.php" class="button">Finalizar</a>
    </div>
    <br>

    <?php if (!empty($_SESSION['carrito'])): ?>
        <div class="total">
            <h1>TOTAL: $<?= number_format($_SESSION['total'], 2); ?></h1>
        </div>
          <div class="menu-container">            <?php foreach ($_SESSION['carrito'] as $id => $cantidad): 
                $producto = listMyProduc2($id);
                if ($producto):
            ?>
             
                    <div class="card">
                        <img src="<?= htmlspecialchars($producto['imagenMenu']); ?>" alt="<?= htmlspecialchars($producto['titulo']); ?>">
                        <div class="producto-info">
                            <h2><?= htmlspecialchars($producto['titulo']); ?></h2>
                            <p>Precio: $<?= number_format(floatval($producto['precio']), 2); ?></p>
                            <p>Cantidad: <?= intval($cantidad); ?></p>
                            <p>Total: $<?= number_format(floatval($producto['precio']) * intval($cantidad), 2); ?></p>
                        </div>
                        <div class="producto-cantidad">
                            <a href="carrito.php?action=increment&id=<?= urlencode($id); ?>">+</a>
                            <span><?= intval($cantidad); ?></span>
                            <a href="carrito.php?action=decrement&id=<?= urlencode($id); ?>">-</a>
                        </div>
                    </div>
            <?php endif; endforeach; ?>
        </div>
        
    <?php else: ?>
        <center><h1><p>El carrito está vacío. 😓</p></h1></center>
    <?php endif; ?>
</div>
    <footer>
        <p>&copy; 2024 BURGER KONG.<a href="https://mattprofe.com.ar/alumno/61/lso/9909/CV/"> Información del creador</a></p>
    </footer>
</body>
</html>

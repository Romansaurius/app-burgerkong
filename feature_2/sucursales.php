<?php
include_once 'BurgerTools.php';
$sucursales=listsucursales();

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="css/styles.css">
	<title></title>
</head>
<body background="#D0ADA7">

<div class="head">

    <a href="sucursales.php"><img src="Logos/logo1.png" alt="Logo BurgerKong" class="logomain"> </a>
    <a href="admin.php" class="button3">Eres Adminisrador? </a>

   
</div>


    <div class="texto">
	 <h1><b><p> Sucursales De BurgerKong </p></b></h1>
    </div>

<div class="container">
        <?php
        
        if ($sucursales) {
            foreach ($sucursales as $info) {
                echo "<div class='card'>
                         <img src='Logos/logo2.png' alt='Logo BurgerKong' class='logo2'>
                        <div class='card-info'>
                            <h2><a href='menu.php?sucursal=" . $info['id'] . "'>" . $info['nombre'] . "</a></h2>
                            <p><strong>Dirección:</strong> " . $info['ubicacion'] . "</p>
                        </div>
                      </div>";
            }
        } else {
            echo "<p>No hay sucursales disponibles.</p>";
        }
        ?>
    </div>
    <footer>
        <p>  &copy; 2024 BURGUER KONG.<a href="https://drive.google.com/file/d/1A1QEBqsHXQake8fc94oqCjWPZsxcSF6i/view" target="_blank"> Informacion del creador</a></p>
    </footer>
</body>
</html>
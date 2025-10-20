<?php
session_start();
$idTicket=$_SESSION['id_ticket'];
?><!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="css/styles.css">
	<title></title>
	<style type="text/css">

	</style>
</head>

<div class="head">
    <div class="a">
    <a href="sucursales.php"><img src="Logos/logo1.png" alt="Logo BurgerKong" class="logomain"> </a>
   </div>
    <br>
    <br>
 

</div>

    
<body>
 <br>
 <br>
<center>
	<div class="texto">
     <h1><b><p> ¡Que Disfrute Su Pedido!</p></b></h1>
    </div>
<div class="card">

        <h2 class="product-title">N° Ticket <br> </h2>
        <p class="product-description"><?php echo $idTicket ?></p>
        <h2 class="product-title">Gracias por confiar en nosotros.😁 <br> </h2>
        <a href="sucursales.php" class="card-button">Volver</a>
        
    </div>
</div>
<br>



</center>
</body>
<footer>

	<p>  &copy; 2024 BURGUER KONG.<a href="https://mattprofe.com.ar/alumno/61/lso/9909/CV/"> Informacion del creador</a></p>
</footer>
</html>
<?php
session_start();
$carrito=$_SESSION['carrito'];
include 'BurgerTools.php';
 $totalt= $_SESSION['total'];
 if (isset($_POST['Confirmar'])) {
   $nombre=$_POST['nombre'];
   $apellido=$_POST['apellido'];
   $email=$_POST['email'];
   $telefono=$_POST['telefono'];
   $_SESSION['email_cliente']=$email;
if (isset($_POST['payment'])) {
  $mdp=$_POST['payment'];
}
  
    $id_cliente = datoscliente($nombre, $apellido, $email, $mdp, $telefono);  
        $id_ticket = Ticket($id_cliente, $totalt);
        venta($id_ticket);
        $_SESSION['id_ticket'] = $id_ticket;
        $_SESSION['carrito'] = [];
         header('Location: gracias.php');
    
}
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" type="text/css" href="css/styles.css">
  <title></title>
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
    
<form action="" method="post" class="form">

<div class="texto"><h1><b><p>Total: $<?php echo $totalt ?></p></b></h1></div>

    <div class="texto">
    <h1><b><p> Metodos de Pago </p> </b> </h1>
     </div>
   
    <div class="payment-menu">
    <div class="payment-option">
        <input type="radio" name="payment" value="efectivo">
      <label>
        Efectivo
      </label>
    </div>
   
    <div class="payment-option">
      
        <input type="radio" name="payment" value="mercado_pago">
        <label>
        Mercado Pago
      </label>
    </div>
    
    <div class="payment-option">
        <input type="radio" name="payment" value="tarjeta_credito">
      <label>
        Tarjeta de Credito
      </label>
    </div>
    <div class="payment-option">
        <input type="radio" name="payment" value="tarjeta_debito">
      <label>
        Tarjeta de Debito
      </label>
    </div>
</div>

<div class="texto">
    <h1><b><p> Datos Personales </p> </b> </h1>
     </div>
    <p><input type="text" id="username" name="nombre" required="" class="input" placeholder="Nombre"></p>
    <p><input type="apellido" id="apellido" name="apellido" required="" class="input" placeholder="Apellido"> </p>
    <p><input type="email" id="email" name="email" required="" class="input" placeholder="Email"></p>
    <p><input type="text" id="telefono" name="telefono" required="" class="input" placeholder="Telefono"></p>

   
  
   <p><button type="submit" name="Confirmar">Confirmar</button>
    <p> <button><a href="carrito.php">Cancelar </a></button>
  </form>
<br>
</body>
<footer>

  <p>  &copy; 2024 BURGUER KONG.<a href="https://drive.google.com/file/d/1A1QEBqsHXQake8fc94oqCjWPZsxcSF6i/view" target="_blank"> Informacion del creador</a></p>
</footer>
</html>

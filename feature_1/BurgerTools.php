<?php 

function listcategorias() {
    include_once 'conexion.php';
    $sql = "SELECT * FROM `BurgerKong__categorias`;";
    $response = consulta($sql);
    return $response->fetch_all(MYSQLI_ASSOC);
}

function listsucursales() {
    include_once 'conexion.php';
    $sql = "SELECT * FROM `BurgerKong__sucursales`;";
    $response = consulta($sql);
    return $response->fetch_all(MYSQLI_ASSOC);
}

function listMyProduc($idcate) {
    include_once 'conexion.php';
    $sql = "SELECT * FROM `BurgerKong__productos` WHERE `idCategoria` LIKE '$idcate';";
    $response = consulta($sql);
    return $response->fetch_all(MYSQLI_ASSOC);
}

function listMyProduc2($id) {
    include_once 'conexion.php';
    $sql = "SELECT * FROM `BurgerKong__productos` WHERE `id` = '$id'";
    $response = consulta($sql);
    return $response->fetch_assoc();
}

function carrito($id) {
    include_once 'conexion.php';
    session_start();

    if (!isset($_SESSION['carrito']) || !is_array($_SESSION['carrito'])) {
        $_SESSION['carrito'] = [];
    }

    if (isset($_SESSION['carrito'][$id])) {
        $_SESSION['carrito'][$id]['cantidad']++;
    } else {
        $producto = listMyProduc2($id);
        if ($producto) {
            $_SESSION['carrito'][$id] = [
                'idProducto' => $producto['id'],
                'titulo' => $producto['titulo'],
                'imagenMenu' => $producto['imagenMenu'],
                'precio' => $producto['precio'],
                'cantidad' => 1
            ];
        }
    }
}

function calcularTotal($carrito) {
    $total = 0;

    foreach ($carrito as $id => $cantidad) {
        $productoDetails = listMyProduc2($id);
        if ($productoDetails && isset($productoDetails['precio']) && is_numeric($productoDetails['precio']) && is_numeric($cantidad)) {
            $total += $productoDetails['precio'] * $cantidad;
        }
    }
    return $total;
}

function Ticket($idcliente, $total) {
    include_once 'conexion.php';
    $sql = "INSERT INTO BurgerKong__tickets (id_clientes, total, fecha) VALUES ('$idcliente', '$total', CURRENT_TIMESTAMP)";
    $response = consulta($sql);

    if ($response) {
        $id_ticket = consulta("SELECT id FROM BurgerKong__tickets WHERE id_clientes = '$idcliente' ORDER BY Fecha DESC LIMIT 1");
        if ($id_ticket) {
            $ticket = $id_ticket->fetch_assoc();
            return $ticket['id'];
        }
    }
    return null;
}

function idcliente() {
    include_once 'conexion.php';
    $email = $_SESSION['email_cliente'];
    $sql = "SELECT id FROM BurgerKong__clientes WHERE `email` = '$email';";
    $response = consulta($sql);
    $data = $response->fetch_assoc();
    return $data['id'] ?? null;
}

function venta($ticket_id) {
    include_once 'conexion.php';
    $carrito = $_SESSION['carrito'] ?? [];
    foreach ($carrito as $producto) {
        $idProducto = $producto['idProducto'];
        $precio = $producto['precio'];
        $cantidad = $producto['cantidad'];

        $sql = "INSERT INTO BurgerKong__ventas (idTicket, idProducto, precio, cantidad) VALUES ('$ticket_id', '$idProducto', '$precio', '$cantidad')";
        consulta($sql);
    }
}

function countproduct() {
    return isset($_SESSION['carrito']) ? count($_SESSION['carrito']) : 0;
}

function datoscliente($nombre, $apellido, $email, $mdp, $telefono) {     
    include_once 'conexion.php';   
     $idcliente=idcliente();     
     if ($idcliente) {       
      return $idcliente;   
       }else{     
        $sql="INSERT INTO BurgerKong__clientes (nombre, apellido, email, payment, telefono) VALUES ('$nombre', '$apellido', '$email','$mdp','$telefono')";        
         $response = consulta($sql);        
          if($response){             
            return idcliente();        
             }    
         }    return null; 
     }
?>
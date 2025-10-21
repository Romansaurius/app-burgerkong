<?php 

function listcategorias() {
    include_once 'conexion.php';
    $sql = "SELECT * FROM `categorias`;";
    $response = consulta($sql);
    return $response->fetch_all(MYSQLI_ASSOC);
}

function listsucursales() {
    include_once 'conexion.php';
    $sql = "SELECT * FROM `sucursales`;";
    $response = consulta($sql);
    return $response->fetch_all(MYSQLI_ASSOC);
}

function listMyProduc($idcate) {
    include_once 'conexion.php';
    $sql = "SELECT * FROM `productos` WHERE `idCategoria` LIKE '$idcate';";
    $response = consulta($sql);
    return $response->fetch_all(MYSQLI_ASSOC);
}

function listMyProduc2($id) {
    include_once 'conexion.php';
    $sql = "SELECT * FROM `productos` WHERE `id` = '$id'";
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

    foreach ($carrito as $id => $item) {
        if (is_array($item)) {
            // Nuevo formato: array con datos del producto
            $precio = $item['precio'] ?? 0;
            $cantidad = $item['cantidad'] ?? 0;
            $total += $precio * $cantidad;
        } else {
            // Formato antiguo: solo cantidad
            $productoDetails = listMyProduc2($id);
            if ($productoDetails && isset($productoDetails['precio']) && is_numeric($productoDetails['precio']) && is_numeric($item)) {
                $total += $productoDetails['precio'] * $item;
            }
        }
    }
    return $total;
}

function Ticket($idcliente, $total) {
    include_once 'conexion.php';
    $sql = "INSERT INTO tickets (id_clientes, total, fecha) VALUES ('$idcliente', '$total', CURRENT_TIMESTAMP)";
    $response = consulta($sql);

    if ($response) {
        $id_ticket = consulta("SELECT id FROM tickets WHERE id_clientes = '$idcliente' ORDER BY fecha DESC LIMIT 1");
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
    $sql = "SELECT id FROM clientes WHERE `email` = '$email';";
    $response = consulta($sql);
    $data = $response->fetch_assoc();
    return $data['id'] ?? null;
}

function venta($ticket_id) {
    include_once 'conexion.php';
    $carrito = $_SESSION['carrito'] ?? [];
    foreach ($carrito as $producto) {
        // Verificar que el producto tenga los datos necesarios
        if (isset($producto['idProducto']) && isset($producto['precio']) && isset($producto['cantidad'])) {
            $idProducto = $producto['idProducto'];
            $precio = $producto['precio'];
            $cantidad = $producto['cantidad'];

            $sql = "INSERT INTO ventas (idTicket, idProducto, precio, cantidad) VALUES ('$ticket_id', '$idProducto', '$precio', '$cantidad')";
            consulta($sql);
        }
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
        $sql="INSERT INTO clientes (nombre, apellido, email, payment, telefono) VALUES ('$nombre', '$apellido', '$email','$mdp','$telefono')";        
         $response = consulta($sql);        
          if($response){             
            return idcliente();        
             }    
         }    return null; 
     }

// Funciones para administración
function loginAdmin($username, $password) {
    include_once 'conexion.php';
    $sql = "SELECT * FROM usuarios WHERE username = '$username' AND activo = 1";
    $response = consulta($sql);
    $user = $response->fetch_assoc();
    
    if ($user && password_verify($password, $user['password'])) {
        return true;
    }
    return false;
}

function listAllProducts() {
    include_once 'conexion.php';
    $sql = "SELECT p.*, c.nombre as categoria_nombre 
            FROM productos p 
            LEFT JOIN categorias c ON p.idCategoria = c.id 
            ORDER BY p.id DESC";
    $response = consulta($sql);
    return $response->fetch_all(MYSQLI_ASSOC);
}

function getProductById($id) {
    include_once 'conexion.php';
    $sql = "SELECT * FROM productos WHERE id = '$id'";
    $response = consulta($sql);
    return $response->fetch_assoc();
}

function createProduct($titulo, $descripcion, $precio, $idCategoria, $imagenMenu, $imagenDetalle) {
    include_once 'conexion.php';
    $sql = "INSERT INTO productos (titulo, subtitulo, precio, idCategoria, imagenMenu, imagenDescripcion) 
            VALUES ('$titulo', '$descripcion', '$precio', '$idCategoria', '$imagenMenu', '$imagenDetalle')";
    return consulta($sql);
}

function updateProduct($id, $titulo, $descripcion, $precio, $idCategoria, $imagenMenu, $imagenDetalle) {
    include_once 'conexion.php';
    $sql = "UPDATE productos SET 
            titulo = '$titulo', 
            subtitulo = '$descripcion', 
            precio = '$precio', 
            idCategoria = '$idCategoria', 
            imagenMenu = '$imagenMenu', 
            imagenDescripcion = '$imagenDetalle' 
            WHERE id = '$id'";
    return consulta($sql);
}

function deleteProduct($id) {
    include_once 'conexion.php';
    $sql = "DELETE FROM productos WHERE id = '$id'";
    return consulta($sql);
}

function listAllTickets() {
    include_once 'conexion.php';
    $sql = "SELECT t.*, c.nombre as cliente_nombre, c.apellido as cliente_apellido, c.email as cliente_email 
            FROM tickets t 
            LEFT JOIN clientes c ON t.id_clientes = c.id 
            ORDER BY t.fecha DESC";
    $response = consulta($sql);
    return $response->fetch_all(MYSQLI_ASSOC);
}

function updateTicketStatus($ticketId, $estado) {
    include_once 'conexion.php';
    $sql = "UPDATE tickets SET estado = '$estado' WHERE id = '$ticketId'";
    return consulta($sql);
}

function getTodaySales() {
    include_once 'conexion.php';
    $sql = "SELECT SUM(total) as total_ventas FROM tickets WHERE DATE(fecha) = CURDATE()";
    $response = consulta($sql);
    $result = $response->fetch_assoc();
    return $result['total_ventas'] ?? 0;
}

function getTicketDetail($ticketId) {
    include_once 'conexion.php';
    $sql = "SELECT v.*, p.titulo as producto_titulo 
            FROM ventas v 
            LEFT JOIN productos p ON v.idProducto = p.id 
            WHERE v.idTicket = '$ticketId'";
    $response = consulta($sql);
    return $response->fetch_all(MYSQLI_ASSOC);
}
?>
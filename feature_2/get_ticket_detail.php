<?php
session_start();
if (!isset($_SESSION['admin_logged']) || $_SESSION['admin_logged'] !== true) {
    exit('No autorizado');
}

include 'BurgerTools.php';

if (!isset($_GET['id'])) {
    exit('ID de ticket no proporcionado');
}

$ticketId = $_GET['id'];
$detalles = getTicketDetail($ticketId);

if (empty($detalles)) {
    echo '<p>No se encontraron detalles para este ticket.</p>';
    exit();
}
?>

<table class="detail-table">
    <thead>
        <tr>
            <th>Producto</th>
            <th>Precio Unitario</th>
            <th>Cantidad</th>
            <th>Subtotal</th>
        </tr>
    </thead>
    <tbody>
        <?php 
        $total = 0;
        foreach ($detalles as $detalle): 
            $subtotal = $detalle['precio'] * $detalle['cantidad'];
            $total += $subtotal;
        ?>
        <tr>
            <td><?= htmlspecialchars($detalle['producto_titulo']) ?></td>
            <td>$<?= number_format($detalle['precio'], 2) ?></td>
            <td><?= $detalle['cantidad'] ?></td>
            <td>$<?= number_format($subtotal, 2) ?></td>
        </tr>
        <?php endforeach; ?>
    </tbody>
    <tfoot>
        <tr>
            <th colspan="3">Total:</th>
            <th>$<?= number_format($total, 2) ?></th>
        </tr>
    </tfoot>
</table>
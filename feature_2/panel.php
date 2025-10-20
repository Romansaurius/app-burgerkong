<?php
session_start();
if (!isset($_SESSION['admin_logged']) || $_SESSION['admin_logged'] !== true) {
    header('Location: admin.php');
    exit();
}

include 'BurgerTools.php';
$productos = listAllProducts();
$tickets = listAllTickets();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel Administrativo - BurgerKong</title>
    <link rel="stylesheet" href="css/styles_admin.css">
</head>
<body>
    <div class="admin-header">
        <h1>Panel Administrativo BurgerKong</h1>
        <div class="admin-nav">
            <a href="panel.php" class="active">Dashboard</a>
            <a href="listar_producto.php">Productos</a>
            <a href="listar_tickets.php">Tickets</a>
            <a href="logout.php">Cerrar Sesión</a>
        </div>
    </div>

    <div class="admin-container">
        <div class="stats-grid">
            <div class="stat-card">
                <h3>Total Productos</h3>
                <p class="stat-number"><?= count($productos) ?></p>
            </div>
            <div class="stat-card">
                <h3>Total Tickets</h3>
                <p class="stat-number"><?= count($tickets) ?></p>
            </div>
            <div class="stat-card">
                <h3>Ventas Hoy</h3>
                <p class="stat-number">$<?= number_format(getTodaySales(), 2) ?></p>
            </div>
        </div>

        <div class="quick-actions">
            <h2>Acciones Rápidas</h2>
            <div class="action-buttons">
                <a href="nuevo_producto.php" class="btn btn-primary">Nuevo Producto</a>
                <a href="listar_producto.php" class="btn btn-secondary">Gestionar Productos</a>
                <a href="listar_tickets.php" class="btn btn-info">Ver Tickets</a>
            </div>
        </div>

        <div class="recent-tickets">
            <h2>Últimos Tickets</h2>
            <table class="admin-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Cliente</th>
                        <th>Total</th>
                        <th>Fecha</th>
                        <th>Estado</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach (array_slice($tickets, 0, 5) as $ticket): ?>
                    <tr>
                        <td>#<?= $ticket['id'] ?></td>
                        <td><?= htmlspecialchars($ticket['cliente_nombre']) ?></td>
                        <td>$<?= number_format($ticket['total'], 2) ?></td>
                        <td><?= date('d/m/Y H:i', strtotime($ticket['fecha'])) ?></td>
                        <td><span class="status <?= $ticket['estado'] ?>"><?= ucfirst($ticket['estado']) ?></span></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
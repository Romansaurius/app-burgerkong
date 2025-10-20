<?php
session_start();
if (!isset($_SESSION['admin_logged']) || $_SESSION['admin_logged'] !== true) {
    header('Location: admin.php');
    exit();
}

include 'BurgerTools.php';

// Actualizar estado si se envía
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['ticket_id']) && isset($_POST['nuevo_estado'])) {
    updateTicketStatus($_POST['ticket_id'], $_POST['nuevo_estado']);
}

$tickets = listAllTickets();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Tickets - BurgerKong Admin</title>
    <link rel="stylesheet" href="css/styles_admin.css">
</head>
<body>
    <div class="admin-header">
        <h1>Gestión de Tickets</h1>
        <div class="admin-nav">
            <a href="panel.php">Dashboard</a>
            <a href="listar_producto.php">Productos</a>
            <a href="listar_tickets.php" class="active">Tickets</a>
            <a href="logout.php">Cerrar Sesión</a>
        </div>
    </div>

    <div class="admin-container">
        <div class="table-header">
            <h2>Lista de Tickets</h2>
        </div>

        <div class="table-container">
            <table class="admin-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Cliente</th>
                        <th>Email</th>
                        <th>Total</th>
                        <th>Fecha</th>
                        <th>Estado</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($tickets as $ticket): ?>
                    <tr>
                        <td>#<?= $ticket['id'] ?></td>
                        <td><?= htmlspecialchars($ticket['cliente_nombre'] . ' ' . $ticket['cliente_apellido']) ?></td>
                        <td><?= htmlspecialchars($ticket['cliente_email']) ?></td>
                        <td>$<?= number_format($ticket['total'], 2) ?></td>
                        <td><?= date('d/m/Y H:i', strtotime($ticket['fecha'])) ?></td>
                        <td>
                            <form method="POST" style="display: inline;">
                                <input type="hidden" name="ticket_id" value="<?= $ticket['id'] ?>">
                                <select name="nuevo_estado" onchange="this.form.submit()" class="status-select <?= $ticket['estado'] ?>">
                                    <option value="pendiente" <?= $ticket['estado'] == 'pendiente' ? 'selected' : '' ?>>Pendiente</option>
                                    <option value="procesando" <?= $ticket['estado'] == 'procesando' ? 'selected' : '' ?>>Procesando</option>
                                    <option value="completado" <?= $ticket['estado'] == 'completado' ? 'selected' : '' ?>>Completado</option>
                                    <option value="cancelado" <?= $ticket['estado'] == 'cancelado' ? 'selected' : '' ?>>Cancelado</option>
                                </select>
                            </form>
                        </td>
                        <td class="actions">
                            <button onclick="verDetalle(<?= $ticket['id'] ?>)" class="btn btn-sm btn-info">Ver Detalle</button>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Modal para ver detalle del ticket -->
    <div id="modalDetalle" class="modal" style="display: none;">
        <div class="modal-content">
            <span class="close" onclick="cerrarModal()">&times;</span>
            <h2>Detalle del Ticket</h2>
            <div id="detalleContent"></div>
        </div>
    </div>

    <script>
    function verDetalle(ticketId) {
        fetch('get_ticket_detail.php?id=' + ticketId)
            .then(response => response.text())
            .then(data => {
                document.getElementById('detalleContent').innerHTML = data;
                document.getElementById('modalDetalle').style.display = 'block';
            });
    }

    function cerrarModal() {
        document.getElementById('modalDetalle').style.display = 'none';
    }
    </script>
</body>
</html>
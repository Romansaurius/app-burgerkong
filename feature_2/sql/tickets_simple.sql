CREATE TABLE IF NOT EXISTS `tickets` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_clientes` int(11) NOT NULL,
  `total` decimal(10,2) NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `estado` enum('pendiente','procesando','completado','cancelado') DEFAULT 'pendiente',
  PRIMARY KEY (`id`),
  KEY `fk_tickets_clientes` (`id_clientes`),
  CONSTRAINT `fk_tickets_clientes` FOREIGN KEY (`id_clientes`) REFERENCES `clientes` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
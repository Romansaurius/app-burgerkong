CREATE TABLE IF NOT EXISTS `ventas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idTicket` int(11) NOT NULL,
  `idProducto` int(11) NOT NULL,
  `precio` decimal(10,2) NOT NULL,
  `cantidad` int(11) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id`),
  KEY `fk_ventas_tickets` (`idTicket`),
  KEY `fk_ventas_productos` (`idProducto`),
  CONSTRAINT `fk_ventas_tickets` FOREIGN KEY (`idTicket`) REFERENCES `tickets` (`id`) ON DELETE CASCADE,
  CONSTRAINT `fk_ventas_productos` FOREIGN KEY (`idProducto`) REFERENCES `productos` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
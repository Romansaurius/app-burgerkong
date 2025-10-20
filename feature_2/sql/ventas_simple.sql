-- Crear tabla ventas sin foreign keys primero
CREATE TABLE IF NOT EXISTS `ventas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idTicket` int(11) NOT NULL,
  `idProducto` int(11) NOT NULL,
  `precio` decimal(10,2) NOT NULL,
  `cantidad` int(11) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Agregar foreign keys después (ejecutar solo si las otras tablas están listas)
-- ALTER TABLE `ventas` ADD CONSTRAINT `fk_ventas_tickets` FOREIGN KEY (`idTicket`) REFERENCES `tickets` (`id`) ON DELETE CASCADE;
-- ALTER TABLE `ventas` ADD CONSTRAINT `fk_ventas_productos` FOREIGN KEY (`idProducto`) REFERENCES `productos` (`id`) ON DELETE CASCADE;
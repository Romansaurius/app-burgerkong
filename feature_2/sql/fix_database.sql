-- Script para arreglar la base de datos existente
-- Ejecutar solo si ya tienes datos y no quieres perderlos

USE burgerkong;

-- 1. Crear tablas faltantes sin foreign keys primero
CREATE TABLE IF NOT EXISTS `BurgerKong__usuarios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `rol` enum('admin','superadmin') DEFAULT 'admin',
  `fecha_creacion` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `activo` tinyint(1) DEFAULT 1,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS `BurgerKong__clientes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) NOT NULL,
  `apellido` varchar(100) NOT NULL,
  `email` varchar(150) NOT NULL,
  `payment` varchar(255) DEFAULT NULL,
  `telefono` varchar(20) DEFAULT NULL,
  `fecha_registro` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS `BurgerKong__tickets` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_clientes` int(11) NOT NULL,
  `total` decimal(10,2) NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `estado` enum('pendiente','procesando','completado','cancelado') DEFAULT 'pendiente',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS `BurgerKong__ventas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idTicket` int(11) NOT NULL,
  `idProducto` int(11) NOT NULL,
  `precio` decimal(10,2) NOT NULL,
  `cantidad` int(11) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS `BurgerKong__sesiones` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `session_id` varchar(255) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `user_type` enum('admin','cliente') NOT NULL,
  `fecha_inicio` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `fecha_expiracion` timestamp NULL DEFAULT NULL,
  `activa` tinyint(1) DEFAULT 1,
  PRIMARY KEY (`id`),
  UNIQUE KEY `session_id` (`session_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- 2. Agregar foreign keys después
ALTER TABLE `BurgerKong__tickets` 
ADD CONSTRAINT `fk_tickets_clientes` 
FOREIGN KEY (`id_clientes`) REFERENCES `BurgerKong__clientes` (`id`) ON DELETE CASCADE;

ALTER TABLE `BurgerKong__ventas` 
ADD CONSTRAINT `fk_ventas_tickets` 
FOREIGN KEY (`idTicket`) REFERENCES `BurgerKong__tickets` (`id`) ON DELETE CASCADE;

ALTER TABLE `BurgerKong__ventas` 
ADD CONSTRAINT `fk_ventas_productos` 
FOREIGN KEY (`idProducto`) REFERENCES `BurgerKong__productos` (`id`) ON DELETE CASCADE;

-- 3. Insertar usuario admin por defecto
INSERT IGNORE INTO `BurgerKong__usuarios` (`username`, `password`, `email`, `rol`) VALUES
('admin', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'admin@burgerkong.com', 'admin');
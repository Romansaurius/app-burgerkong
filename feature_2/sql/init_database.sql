-- Script completo para inicializar la base de datos BurgerKong
-- Ejecutar en orden

-- 1. Crear base de datos
CREATE DATABASE IF NOT EXISTS burgerkong;
USE burgerkong;

-- 2. Tabla de categorías
CREATE TABLE IF NOT EXISTS `BurgerKong__categorias` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) NOT NULL,
  `descripcion` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- 3. Tabla de sucursales
CREATE TABLE IF NOT EXISTS `BurgerKong__sucursales` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) NOT NULL,
  `direccion` varchar(255) NOT NULL,
  `telefono` varchar(20),
  `horario` varchar(100),
  `imagen` varchar(255),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- 4. Tabla de productos
CREATE TABLE IF NOT EXISTS `BurgerKong__productos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `titulo` varchar(100) NOT NULL,
  `descripcion` text,
  `precio` decimal(10,2) NOT NULL,
  `idCategoria` int(11) NOT NULL,
  `imagenMenu` varchar(255),
  `imagenDetalle` varchar(255),
  PRIMARY KEY (`id`),
  KEY `fk_productos_categorias` (`idCategoria`),
  CONSTRAINT `fk_productos_categorias` FOREIGN KEY (`idCategoria`) REFERENCES `BurgerKong__categorias` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- 5. Tabla de usuarios administradores
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

-- 6. Tabla de clientes
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

-- 7. Tabla de tickets
CREATE TABLE IF NOT EXISTS `BurgerKong__tickets` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_clientes` int(11) NOT NULL,
  `total` decimal(10,2) NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `estado` enum('pendiente','procesando','completado','cancelado') DEFAULT 'pendiente',
  PRIMARY KEY (`id`),
  KEY `fk_tickets_clientes` (`id_clientes`),
  CONSTRAINT `fk_tickets_clientes` FOREIGN KEY (`id_clientes`) REFERENCES `BurgerKong__clientes` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- 8. Tabla de ventas (detalle de tickets)
CREATE TABLE IF NOT EXISTS `BurgerKong__ventas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idTicket` int(11) NOT NULL,
  `idProducto` int(11) NOT NULL,
  `precio` decimal(10,2) NOT NULL,
  `cantidad` int(11) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id`),
  KEY `fk_ventas_tickets` (`idTicket`),
  KEY `fk_ventas_productos` (`idProducto`),
  CONSTRAINT `fk_ventas_tickets` FOREIGN KEY (`idTicket`) REFERENCES `BurgerKong__tickets` (`id`) ON DELETE CASCADE,
  CONSTRAINT `fk_ventas_productos` FOREIGN KEY (`idProducto`) REFERENCES `BurgerKong__productos` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- 9. Tabla de sesiones
CREATE TABLE IF NOT EXISTS `BurgerKong__sesiones` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `session_id` varchar(255) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `user_type` enum('admin','cliente') NOT NULL,
  `fecha_inicio` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `fecha_expiracion` timestamp NULL DEFAULT NULL,
  `activa` tinyint(1) DEFAULT 1,
  PRIMARY KEY (`id`),
  UNIQUE KEY `session_id` (`session_id`),
  KEY `idx_user_session` (`user_id`, `user_type`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- 10. Insertar usuario administrador por defecto
INSERT INTO `BurgerKong__usuarios` (`username`, `password`, `email`, `rol`) VALUES
('admin', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'admin@burgerkong.com', 'admin');
-- Contraseña: password
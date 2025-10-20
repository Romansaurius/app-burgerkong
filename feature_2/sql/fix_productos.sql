-- Arreglar la tabla productos para que tenga PRIMARY KEY
ALTER TABLE `productos` ADD PRIMARY KEY (`id`);

-- Si da error porque ya existe, usar esto:
-- ALTER TABLE `productos` MODIFY `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY;
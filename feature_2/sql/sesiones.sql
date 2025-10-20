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
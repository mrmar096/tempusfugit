-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Versión del servidor:         10.1.21-MariaDB - mariadb.org binary distribution
-- SO del servidor:              Win32
-- HeidiSQL Versión:             9.4.0.5125
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Volcando estructura de base de datos para tempusfugit
CREATE DATABASE IF NOT EXISTS `tempusfugit` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `tempusfugit`;

-- Volcando estructura para tabla tempusfugit.apt
CREATE TABLE IF NOT EXISTS `apt` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `aptitud` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COMMENT='Aptitudes';

-- Volcando datos para la tabla tempusfugit.apt: ~6 rows (aproximadamente)
DELETE FROM `apt`;
/*!40000 ALTER TABLE `apt` DISABLE KEYS */;
INSERT INTO `apt` (`id`, `aptitud`) VALUES
	(1, 'Jardineria'),
	(2, 'Fontaneria'),
	(3, 'Enseñanza Idiomas'),
	(4, 'Cuidar Niños'),
	(5, 'Limpiar'),
	(6, 'Reparacion Dispositivos Informaticos'),
	(7, 'Programacion Informatica');
/*!40000 ALTER TABLE `apt` ENABLE KEYS */;

-- Volcando estructura para tabla tempusfugit.categories
CREATE TABLE IF NOT EXISTS `categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla tempusfugit.categories: ~2 rows (aproximadamente)
DELETE FROM `categories`;
/*!40000 ALTER TABLE `categories` DISABLE KEYS */;
INSERT INTO `categories` (`id`, `nombre`) VALUES
	(1, 'Informatica'),
	(2, 'Limpieza'),
	(3, 'Jardineria');
/*!40000 ALTER TABLE `categories` ENABLE KEYS */;

-- Volcando estructura para tabla tempusfugit.cities
CREATE TABLE IF NOT EXISTS `cities` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) NOT NULL DEFAULT '0',
  `lat` double NOT NULL DEFAULT '0',
  `log` double NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla tempusfugit.cities: ~5 rows (aproximadamente)
DELETE FROM `cities`;
/*!40000 ALTER TABLE `cities` DISABLE KEYS */;
INSERT INTO `cities` (`id`, `nombre`, `lat`, `log`) VALUES
	(1, 'Madrid', 40.416775, -3.70379),
	(2, 'Toledo', 39.862832, -4.027323),
	(3, 'Valencia', 39.469907, -0.376288),
	(4, 'Barcelona', 41.385064, 2.173403),
	(5, 'Sevilla', 37.389092, -5.984459);
/*!40000 ALTER TABLE `cities` ENABLE KEYS */;

-- Volcando estructura para tabla tempusfugit.consumer_services
CREATE TABLE IF NOT EXISTS `consumer_services` (
  `id_user` int(11) NOT NULL,
  `id_service` int(11) NOT NULL,
  PRIMARY KEY (`id_user`,`id_service`),
  KEY `consumer_service_service_services` (`id_service`),
  CONSTRAINT `consumer_service_service_services` FOREIGN KEY (`id_service`) REFERENCES `services` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `consumer_service_user_users` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla tempusfugit.consumer_services: ~0 rows (aproximadamente)
DELETE FROM `consumer_services`;
/*!40000 ALTER TABLE `consumer_services` DISABLE KEYS */;
/*!40000 ALTER TABLE `consumer_services` ENABLE KEYS */;

-- Volcando estructura para tabla tempusfugit.dates_services
CREATE TABLE IF NOT EXISTS `dates_services` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `rango_inicio` date NOT NULL,
  `rango_fin` date NOT NULL,
  `service` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `service` (`service`),
  CONSTRAINT `dates_service_services` FOREIGN KEY (`service`) REFERENCES `services` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Fechas de dispinibilidad del servicio';

-- Volcando datos para la tabla tempusfugit.dates_services: ~0 rows (aproximadamente)
DELETE FROM `dates_services`;
/*!40000 ALTER TABLE `dates_services` DISABLE KEYS */;
/*!40000 ALTER TABLE `dates_services` ENABLE KEYS */;

-- Volcando estructura para tabla tempusfugit.enabled_days_services
CREATE TABLE IF NOT EXISTS `enabled_days_services` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `dia` int(11) DEFAULT '0',
  `date_service` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `date_service` (`date_service`),
  CONSTRAINT `enabled_days_date_service` FOREIGN KEY (`date_service`) REFERENCES `dates_services` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla tempusfugit.enabled_days_services: ~0 rows (aproximadamente)
DELETE FROM `enabled_days_services`;
/*!40000 ALTER TABLE `enabled_days_services` DISABLE KEYS */;
/*!40000 ALTER TABLE `enabled_days_services` ENABLE KEYS */;

-- Volcando estructura para tabla tempusfugit.messages.php
CREATE TABLE IF NOT EXISTS `messages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `mensaje` text NOT NULL,
  `service` int(11) NOT NULL,
  `privado` tinyint(4) NOT NULL,
  `emisor` int(11) NOT NULL,
  `receptor` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_emisor` (`emisor`),
  KEY `receptor` (`receptor`),
  KEY `oferta` (`service`),
  CONSTRAINT `mess_emisor_users` FOREIGN KEY (`emisor`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `mess_receptor_users` FOREIGN KEY (`receptor`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `mess_service_services` FOREIGN KEY (`service`) REFERENCES `services` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla tempusfugit.messages.php: ~0 rows (aproximadamente)
DELETE FROM `messages`;
/*!40000 ALTER TABLE `messages.php` DISABLE KEYS */;
/*!40000 ALTER TABLE `messages.php` ENABLE KEYS */;

-- Volcando estructura para tabla tempusfugit.multimedia_services
CREATE TABLE IF NOT EXISTS `multimedia_services` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `src` varchar(250) DEFAULT NULL,
  `alt` varchar(250) DEFAULT NULL,
  `type` int(11) DEFAULT NULL,
  `service` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `multimedia_services_service_services` (`service`),
  CONSTRAINT `multimedia_services_service_services` FOREIGN KEY (`service`) REFERENCES `services` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla tempusfugit.multimedia_services: ~0 rows (aproximadamente)
DELETE FROM `multimedia_services`;
/*!40000 ALTER TABLE `multimedia_services` DISABLE KEYS */;
/*!40000 ALTER TABLE `multimedia_services` ENABLE KEYS */;

-- Volcando estructura para tabla tempusfugit.opinions_services
CREATE TABLE IF NOT EXISTS `opinions_services` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `opinion` int(11) DEFAULT NULL,
  `user` int(11) DEFAULT NULL,
  `puntuacion` double(10,2) DEFAULT NULL,
  `service` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user` (`user`),
  KEY `opiniones_service_service_services` (`service`),
  CONSTRAINT `opiniones_service_service_services` FOREIGN KEY (`service`) REFERENCES `services` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `opinions_service_user_users` FOREIGN KEY (`user`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla tempusfugit.opinions_services: ~0 rows (aproximadamente)
DELETE FROM `opinions_services`;
/*!40000 ALTER TABLE `opinions_services` DISABLE KEYS */;
/*!40000 ALTER TABLE `opinions_services` ENABLE KEYS */;

-- Volcando estructura para tabla tempusfugit.services
CREATE TABLE IF NOT EXISTS `services` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `categorie` int(11) NOT NULL DEFAULT '0',
  `titulo` varchar(140) NOT NULL DEFAULT '0',
  `subcategorie` int(11) NOT NULL DEFAULT '0',
  `ofertante` int(11) NOT NULL DEFAULT '0',
  `descripcion` text,
  `duracion` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `ofertante` (`ofertante`),
  KEY `categoria` (`categorie`),
  KEY `subcategoria` (`subcategorie`),
  CONSTRAINT `services_categorie_categories` FOREIGN KEY (`categorie`) REFERENCES `categories` (`id`),
  CONSTRAINT `services_ofert_users` FOREIGN KEY (`ofertante`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `services_subcategorie_subcategories` FOREIGN KEY (`subcategorie`) REFERENCES `subcategories` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla tempusfugit.services: ~0 rows (aproximadamente)
DELETE FROM `services`;
/*!40000 ALTER TABLE `services` DISABLE KEYS */;
/*!40000 ALTER TABLE `services` ENABLE KEYS */;

-- Volcando estructura para tabla tempusfugit.subcategories
CREATE TABLE IF NOT EXISTS `subcategories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) NOT NULL DEFAULT '0',
  `categorie` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `categoria` (`categorie`),
  CONSTRAINT `subcategories_categorie_categories` FOREIGN KEY (`categorie`) REFERENCES `categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla tempusfugit.subcategories: ~5 rows (aproximadamente)
DELETE FROM `subcategories`;
/*!40000 ALTER TABLE `subcategories` DISABLE KEYS */;
INSERT INTO `subcategories` (`id`, `nombre`, `categorie`) VALUES
	(1, 'Reparacion Moviles', 1),
	(2, 'Desarro de Aplicaciones', 1),
	(3, 'Integracion Sistemas', 1),
	(4, 'Cuidado', 3),
	(5, 'Plantacion', 3),
	(8, 'Domiciliar', 2);
/*!40000 ALTER TABLE `subcategories` ENABLE KEYS */;

-- Volcando estructura para tabla tempusfugit.type_users
CREATE TABLE IF NOT EXISTS `type_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tipo` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla tempusfugit.type_users: ~2 rows (aproximadamente)
DELETE FROM `type_users`;
/*!40000 ALTER TABLE `type_users` DISABLE KEYS */;
INSERT INTO `type_users` (`id`, `tipo`) VALUES
	(1, 'Administrador'),
	(2, 'Registrado');
/*!40000 ALTER TABLE `type_users` ENABLE KEYS */;

-- Volcando estructura para tabla tempusfugit.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) DEFAULT NULL,
  `apellidos` varchar(200) DEFAULT NULL,
  `ciudad` int(11) DEFAULT NULL,
  `tipo_usuario` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_ciudad` (`ciudad`),
  KEY `tipo_usuario` (`tipo_usuario`),
  CONSTRAINT `user_ciudad` FOREIGN KEY (`ciudad`) REFERENCES `cities` (`id`),
  CONSTRAINT `user_tipo` FOREIGN KEY (`tipo_usuario`) REFERENCES `type_users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla tempusfugit.users: ~0 rows (aproximadamente)
DELETE FROM `users`;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
/*!40000 ALTER TABLE `users` ENABLE KEYS */;

-- Volcando estructura para tabla tempusfugit.users_apt
CREATE TABLE IF NOT EXISTS `users_apt` (
  `id_user` int(11) NOT NULL,
  `id_apt` int(11) NOT NULL,
  PRIMARY KEY (`id_user`,`id_apt`),
  KEY `users_apt_id_apt` (`id_apt`),
  CONSTRAINT `users_apt_id_apt` FOREIGN KEY (`id_apt`) REFERENCES `apt` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `users_apt_id_user` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla tempusfugit.users_apt: ~0 rows (aproximadamente)
DELETE FROM `users_apt`;
/*!40000 ALTER TABLE `users_apt` DISABLE KEYS */;
/*!40000 ALTER TABLE `users_apt` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;

-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Versión del servidor:         10.1.19-MariaDB - mariadb.org binary distribution
-- SO del servidor:              Win32
-- HeidiSQL Versión:             9.4.0.5125
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Volcando estructura de base de datos para peliculas
CREATE DATABASE IF NOT EXISTS `peliculas` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `peliculas`;

-- Volcando estructura para tabla peliculas.categorias
CREATE TABLE IF NOT EXISTS `categorias` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `categoria` varchar(50) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla peliculas.categorias: ~6 rows (aproximadamente)
/*!40000 ALTER TABLE `categorias` DISABLE KEYS */;
INSERT INTO `categorias` (`id`, `categoria`) VALUES
	(1, 'Acción'),
	(2, 'Ciencia Ficción'),
	(3, 'Tragedia'),
	(4, 'Infantil'),
	(5, 'Thriller'),
	(6, 'Terror'),
	(7, 'Romántica');
/*!40000 ALTER TABLE `categorias` ENABLE KEYS */;

-- Volcando estructura para tabla peliculas.clientes
CREATE TABLE IF NOT EXISTS `clientes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) DEFAULT '0',
  `apellidos` varchar(50) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla peliculas.clientes: ~4 rows (aproximadamente)
/*!40000 ALTER TABLE `clientes` DISABLE KEYS */;
INSERT INTO `clientes` (`id`, `nombre`, `apellidos`) VALUES
	(1, 'Cristian', 'Florez Ruiz'),
	(2, 'Carlos', 'Restrepo Rojas'),
	(3, 'Andrea', 'Murcia López'),
	(4, 'Lisseth', 'Barajas Florez'),
	(5, 'Enrique', 'López Amado');
/*!40000 ALTER TABLE `clientes` ENABLE KEYS */;

-- Volcando estructura para tabla peliculas.peliculas
CREATE TABLE IF NOT EXISTS `peliculas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) DEFAULT '0',
  `id_categoria` int(11) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `FK__categorias` (`id_categoria`),
  CONSTRAINT `FK__categorias` FOREIGN KEY (`id_categoria`) REFERENCES `categorias` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla peliculas.peliculas: ~8 rows (aproximadamente)
/*!40000 ALTER TABLE `peliculas` DISABLE KEYS */;
INSERT INTO `peliculas` (`id`, `nombre`, `id_categoria`) VALUES
	(1, 'Mi villano favorito', 4),
	(2, 'Matrix', 2),
	(3, 'La huérfana', 6),
	(4, 'Logan', 1),
	(5, 'Wonder woman', 1),
	(6, 'Arma letal', 1),
	(7, 'Buscando a nemo', 4),
	(8, 'Toy story', 4),
	(9, 'El conjuro', 6),
	(10, 'Jungla de cristal', 1);
/*!40000 ALTER TABLE `peliculas` ENABLE KEYS */;

-- Volcando estructura para tabla peliculas.valoraciones
CREATE TABLE IF NOT EXISTS `valoraciones` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `valoracion` int(11) DEFAULT '0',
  `fecha` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `id_cliente` int(11) DEFAULT '0',
  `id_pelicula` int(11) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `FK__clientes` (`id_cliente`),
  KEY `FK__peliculas` (`id_pelicula`),
  CONSTRAINT `FK__clientes` FOREIGN KEY (`id_cliente`) REFERENCES `clientes` (`id`),
  CONSTRAINT `FK__peliculas` FOREIGN KEY (`id_pelicula`) REFERENCES `peliculas` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla peliculas.valoraciones: ~2 rows (aproximadamente)
/*!40000 ALTER TABLE `valoraciones` DISABLE KEYS */;
INSERT INTO `valoraciones` (`id`, `valoracion`, `fecha`, `id_cliente`, `id_pelicula`) VALUES
	(1, 10, '2017-06-15 16:13:58', 2, 6),
	(2, 8, '2017-06-15 16:15:17', 2, 9);
/*!40000 ALTER TABLE `valoraciones` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;

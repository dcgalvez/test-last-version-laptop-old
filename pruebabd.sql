-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Versión del servidor:         8.0.30 - MySQL Community Server - GPL
-- SO del servidor:              Win64
-- HeidiSQL Versión:             12.1.0.6537
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Volcando estructura de base de datos para prueba_laravel
CREATE DATABASE IF NOT EXISTS `prueba_laravel` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `prueba_laravel`;

-- Volcando estructura para tabla prueba_laravel.catalogos
CREATE TABLE IF NOT EXISTS `catalogos` (
  `id` int NOT NULL AUTO_INCREMENT,
  `valor` varchar(100) DEFAULT NULL,
  `grupo` varchar(100) DEFAULT NULL,
  `id_padre` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Volcando datos para la tabla prueba_laravel.catalogos: ~7 rows (aproximadamente)
INSERT INTO `catalogos` (`id`, `valor`, `grupo`, `id_padre`) VALUES
	(1, 'San Salvador', 'Departamentos', NULL),
	(2, 'San Salvador', 'Municipios', 1),
	(3, 'San Marcos', 'Municipios', 1),
	(4, 'Apopa', 'Municipios', 1),
	(5, 'La Libertad', 'Departamentos', NULL),
	(6, 'Antiguo Cuscatlan', 'Municipios', 5),
	(7, 'Santa Tecla', 'Municipios', 5);

-- Volcando estructura para tabla prueba_laravel.empleados
CREATE TABLE IF NOT EXISTS `empleados` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) DEFAULT NULL,
  `apellido` varchar(100) DEFAULT NULL,
  `correo` varchar(150) DEFAULT NULL,
  `telefono` varchar(8) DEFAULT NULL,
  `direccion` varchar(200) DEFAULT NULL,
  `id_municipio` int DEFAULT NULL,
  `id_depto` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_empleados_catalogos` (`id_municipio`),
  KEY `FK_empleados_catalogos_2` (`id_depto`),
  CONSTRAINT `FK_empleados_catalogos` FOREIGN KEY (`id_municipio`) REFERENCES `catalogos` (`id`),
  CONSTRAINT `FK_empleados_catalogos_2` FOREIGN KEY (`id_depto`) REFERENCES `catalogos` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Volcando datos para la tabla prueba_laravel.empleados: ~3 rows (aproximadamente)
INSERT INTO `empleados` (`id`, `nombre`, `apellido`, `correo`, `telefono`, `direccion`, `id_municipio`, `id_depto`) VALUES
	(3, 'Dini', 'Jarinn', 'dinjaren@gmail.com', '78954443', 'calle el arbol', 3, 1),
	(10, 'Carlos', 'Tanizen', 'carlitos@gmail.conm', '63734634', 'Calle a los planes, pasaje 2', 6, 5),
	(14, 'Alejandro', 'Galvez', 'alegalvez@gmail.com', '71626362', 'Calle a T', 2, 1);

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;

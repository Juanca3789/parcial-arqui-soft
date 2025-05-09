-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 09-05-2025 a las 15:05:31
-- Versión del servidor: 10.4.28-MariaDB
-- Versión de PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `proyecto_arqui`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `agenda`
--

CREATE TABLE `agenda` (
  `id` int(11) NOT NULL,
  `fecha_montada` datetime DEFAULT NULL,
  `practica` varchar(255) DEFAULT NULL,
  `tipo_actividad` varchar(255) DEFAULT NULL,
  `nombre_actividad` varchar(255) DEFAULT NULL,
  `nombre_artista` varchar(255) DEFAULT NULL,
  `enlace_actividad` text DEFAULT NULL,
  `institucion_responsable` varchar(255) DEFAULT NULL,
  `trata_de` text DEFAULT NULL,
  `tiempo_actividad` varchar(255) DEFAULT NULL,
  `desde` datetime DEFAULT NULL,
  `hasta` datetime DEFAULT NULL,
  `dias` varchar(255) DEFAULT NULL,
  `fecha_actividad_inscripcion` datetime DEFAULT NULL,
  `correo_inscripcion` varchar(255) DEFAULT NULL,
  `duracion` varchar(255) DEFAULT NULL,
  `nacionalidad` varchar(255) DEFAULT NULL,
  `pais_transmision` varchar(255) DEFAULT NULL,
  `sitio_web` text DEFAULT NULL,
  `facebook` text DEFAULT NULL,
  `instagram` text DEFAULT NULL,
  `youtube` text DEFAULT NULL,
  `twitter` text DEFAULT NULL,
  `publico` varchar(255) DEFAULT NULL,
  `nombre_apellido` varchar(255) DEFAULT NULL,
  `mail` varchar(255) DEFAULT NULL,
  `institucion` varchar(255) DEFAULT NULL,
  `publicar` tinyint(1) DEFAULT NULL,
  `uri_img` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `agenda`
--

INSERT INTO `agenda` (`id`, `fecha_montada`, `practica`, `tipo_actividad`, `nombre_actividad`, `nombre_artista`, `enlace_actividad`, `institucion_responsable`, `trata_de`, `tiempo_actividad`, `desde`, `hasta`, `dias`, `fecha_actividad_inscripcion`, `correo_inscripcion`, `duracion`, `nacionalidad`, `pais_transmision`, `sitio_web`, `facebook`, `instagram`, `youtube`, `twitter`, `publico`, `nombre_apellido`, `mail`, `institucion`, `publicar`, `uri_img`) VALUES
(22, '2025-05-09 07:16:17', 'Música; Arte dramático', 'Circulación', 'hash', 'hash', 'jdjaj', 'jdahs', 'jadsj', 'Disponible permanente', '2025-05-09 07:16:17', '2025-11-09 07:16:17', 'Lunes; Martes; Miércoles; Jueves; Viernes; Sábado; Domingo', NULL, NULL, '90', 'jasdh', 'hasdh', 'jafsh', 'bnasdbb', 'jsafdh', 'jasdj', 'hashd', 'Adultos', 'jsahdh', 'hdsa@sa.cp', 'hahdsa', 0, '../data/imagesagenda/17467929770ig3.png');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `agenda`
--
ALTER TABLE `agenda`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `agenda`
--
ALTER TABLE `agenda`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

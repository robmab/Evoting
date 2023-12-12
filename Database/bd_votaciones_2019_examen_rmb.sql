-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 12-12-2023 a las 13:01:28
-- Versión del servidor: 10.4.27-MariaDB
-- Versión de PHP: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `bd_votaciones_2019_examen_rmb`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `convocatoria`
--

CREATE TABLE `convocatoria` (
  `id` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `denominacion` varchar(50) NOT NULL,
  `circunscripcion` varchar(50) NOT NULL,
  `numeroelegibles` int(11) NOT NULL DEFAULT 0,
  `escrutinio` enum('Abierto','Cerrado') NOT NULL DEFAULT 'Cerrado'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `convocatoria`
--

INSERT INTO `convocatoria` (`id`, `fecha`, `denominacion`, `circunscripcion`, `numeroelegibles`, `escrutinio`) VALUES
(1, '2013-05-25', 'Elecciones municipales', 'Albacete', 27, 'Cerrado'),
(2, '2028-01-20', 'Elecciones providenciales', 'Albacete', 10, 'Cerrado'),
(3, '2025-01-26', 'Elecciones providenciales', 'Albacete', 75675, 'Cerrado'),
(4, '2019-01-27', 'Elecciones providenciales', 'Albacete', 1254, 'Cerrado'),
(5, '2018-09-27', 'Elecciones providenciales', 'Albacete', 4546564, 'Cerrado'),
(6, '2014-01-31', 'Elecciones providenciales', 'Albacete', 4546456, 'Cerrado'),
(7, '2019-01-27', 'Elecciones providenciales', 'Albacete', 456756, 'Cerrado'),
(8, '2015-01-27', 'Elecciones providenciales', 'Albacete', 465546, 'Cerrado'),
(9, '2024-01-27', 'Elecciones providenciales', 'Albacete', 456456, 'Cerrado'),
(10, '2018-01-28', 'Elecciones providenciales', 'Albacete', 555, 'Cerrado'),
(12, '2012-01-28', 'Elecciones providenciales', 'Albacete', 5645, 'Cerrado'),
(13, '2011-01-28', 'Elecciones providenciales', 'Albacete', 466, 'Cerrado'),
(14, '2015-02-01', 'Elecciones providenciales', 'Albacete', 4, 'Cerrado'),
(15, '2016-02-01', 'Elecciones providenciales', 'Albacete', 453453, 'Cerrado'),
(16, '2019-02-02', 'Elecciones providenciales', 'Albacete', 5645, 'Cerrado'),
(17, '2014-02-02', 'Elecciones providenciales', 'Albacete', 456456, 'Cerrado'),
(18, '2017-02-02', 'Elecciones providenciales', 'Albacete', 456, 'Cerrado'),
(19, '2018-07-04', 'Elecciones providenciales', 'Albacete', 4, 'Cerrado'),
(20, '2019-02-04', 'Elecciones providenciales', 'Albacete', 526423120, 'Cerrado'),
(21, '2020-02-06', 'Elecciones Nacionales', 'España', 20, 'Cerrado'),
(22, '2024-12-03', 'Elecciones municipales', 'Albacete', 546376, 'Cerrado'),
(23, '2024-12-30', 'Elecciones municipales', 'Albacete', 4353264, 'Cerrado');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `partido`
--

CREATE TABLE `partido` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `siglas` varchar(10) NOT NULL,
  `direccionSede` varchar(50) NOT NULL,
  `logo` varchar(50) DEFAULT NULL,
  `votosTotales` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `partido`
--

INSERT INTO `partido` (`id`, `nombre`, `siglas`, `direccionSede`, `logo`, `votosTotales`) VALUES
(1, 'Partido Popular', 'PP', 'C/ Muelle, 5 ', 'images/PP.jpg', 12000),
(2, 'Partido Socialista Obrero Espanol', 'PSOE', 'C/ Pedro Coca , 19', 'images/psoe.png', 13000),
(3, 'Unidos Podemos', 'UP', 'C/ Feria, 43', 'images/podemos.png', 10000),
(4, 'Ciudadanos', 'CS', 'C/ Marques de Molins, 5', 'images/Ciudadanos.png', 9000),
(5, 'Union Progreso y Democracia', 'UPyD', 'C/ Feria, 60', 'images/UPD.png', 2001);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `resultado`
--

CREATE TABLE `resultado` (
  `id` int(11) NOT NULL,
  `convocatoria` int(11) NOT NULL,
  `partido` int(11) NOT NULL,
  `totalVotos` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `resultado`
--

INSERT INTO `resultado` (`id`, `convocatoria`, `partido`, `totalVotos`) VALUES
(4, 1, 2, 564656),
(5, 3, 1, 2),
(6, 3, 2, 3),
(7, 3, 3, 2),
(8, 3, 4, 1),
(17, 2, 1, 50),
(18, 2, 2, 65),
(19, 2, 3, 20),
(20, 2, 4, 80),
(21, 4, 1, 1),
(22, 4, 2, 0),
(23, 4, 3, 0),
(24, 4, 4, 0),
(25, 5, 1, 1),
(26, 5, 2, 2),
(27, 5, 3, 0),
(28, 5, 4, 1),
(29, 6, 1, 0),
(30, 6, 2, 0),
(31, 6, 3, 0),
(32, 6, 4, 0),
(33, 6, 5, 0),
(34, 7, 1, 0),
(35, 7, 2, 0),
(36, 7, 3, 0),
(37, 7, 4, 0),
(38, 7, 5, 0),
(39, 8, 1, 0),
(40, 8, 2, 0),
(41, 8, 3, 0),
(42, 8, 4, 0),
(43, 8, 5, 0),
(44, 9, 1, 0),
(45, 9, 2, 3),
(46, 9, 3, 0),
(47, 9, 4, 2),
(48, 9, 5, 2),
(49, 10, 1, 0),
(50, 10, 2, 0),
(51, 10, 3, 0),
(52, 10, 4, 1),
(53, 10, 5, 0),
(54, 13, 1, 0),
(55, 13, 2, 1),
(56, 13, 3, 0),
(57, 13, 4, 0),
(58, 13, 5, 0),
(59, 12, 1, 0),
(60, 12, 2, 0),
(61, 12, 3, 0),
(62, 12, 4, 0),
(63, 12, 5, 0),
(64, 14, 1, 0),
(65, 14, 2, 0),
(66, 14, 3, 0),
(67, 14, 4, 0),
(68, 14, 5, 0),
(69, 15, 1, 1),
(70, 15, 2, 0),
(71, 15, 3, 0),
(72, 15, 4, 0),
(73, 15, 5, 0),
(74, 16, 1, 0),
(75, 16, 2, 0),
(76, 16, 3, 0),
(77, 16, 4, 0),
(78, 16, 5, 0),
(79, 17, 1, 0),
(80, 17, 2, 1),
(81, 17, 3, 1),
(82, 17, 4, 0),
(83, 17, 5, 0),
(84, 18, 1, 0),
(85, 18, 2, 0),
(86, 18, 3, 0),
(87, 18, 4, 0),
(88, 18, 5, 0),
(89, 19, 1, 0),
(90, 19, 2, 0),
(91, 19, 3, 0),
(92, 19, 4, 0),
(93, 19, 5, 0),
(94, 20, 1, 1),
(95, 20, 2, 0),
(96, 20, 3, 0),
(97, 20, 4, 0),
(98, 20, 5, 0),
(104, 21, 1, 12000),
(105, 21, 2, 13000),
(106, 21, 3, 10000),
(107, 21, 4, 9000),
(108, 21, 5, 2000),
(114, 22, 1, 12000),
(115, 22, 2, 13000),
(116, 22, 3, 10000),
(117, 22, 4, 9000),
(118, 22, 5, 2000),
(124, 23, 1, 12000),
(125, 23, 2, 13000),
(126, 23, 3, 10000),
(127, 23, 4, 9000),
(128, 23, 5, 2001);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `votante`
--

CREATE TABLE `votante` (
  `id` int(11) NOT NULL,
  `nif` varchar(9) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `domicilio` varchar(65) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `apellidos` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `fechaNac` date NOT NULL,
  `password` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `rol` enum('Administrador','Votante') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'Votante',
  `votante` enum('Si','No') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'No',
  `nombre` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `votante`
--

INSERT INTO `votante` (`id`, `nif`, `domicilio`, `apellidos`, `fechaNac`, `password`, `rol`, `votante`, `nombre`) VALUES
(24, '75645345B', 'C/Antonio Gotor NÂº4 6ÂºA', 'Ramirez', '2019-01-24', 'c2Fmc2FkZg==', 'Votante', 'No', 'Pepe'),
(25, '46545754A', 'C/Antonio Gotor NÂº4 6ÂºA', 'De la cruz', '2019-01-10', 'c2Rmc2Fk', 'Votante', 'No', 'Estefania'),
(47, '56456472S', 'C/Antonio Gotor NÂº4 6ÂºA', 'Ruiperez', '2019-01-10', 'aG9sYTIw', 'Votante', 'No', 'Kim'),
(48, '47645645K', 'C/ antonio gotor, 4, 6', 'Lopez', '2019-01-12', 'aG9sYQ==', 'Votante', 'No', 'Juan'),
(53, '45643423V', 'C/Antonio Gotor NÂº4 6ÂºA', 'Laguia', '2019-01-31', 'aG9sYQ==', 'Votante', 'No', 'Perez'),
(54, '464268745', 'C/Antonio Gotor NÂº4 6ÂºA', 'Moreno', '2019-02-07', 'aG9sYQ==', 'Votante', 'No', 'Alejandro'),
(55, '45454545M', 'C/Antonio Gotor NÂº4 6ÂºA', 'Fernandez', '2019-02-12', 'aG9sYQ==', 'Votante', 'No', 'Juan'),
(60, '454536423', 'C/Antonio Gotor NÂº4 6ÂºA', 'De Los Balos', '2019-02-15', 'aG9sYQ==', 'Votante', 'No', 'Pepe'),
(61, '47464564S', 'C/Antonio Gotor NÂº4 6ÂºA', 'Ortiz', '2019-02-15', 'aG9sYQ==', 'Votante', 'No', 'Siro'),
(64, '45645642J', 'C/Antonio Gotor NÂº4 6ÂºA', 'Garcia', '2019-02-06', 'aG9sYQ==', 'Votante', 'No', 'Carlos'),
(67, '24513465G', 'C/Antonio Gotor NÂº4 6ÂºA', 'Estefania', '2019-02-07', 'aG9sYQ==', 'Votante', 'No', 'Daniel'),
(71, '46576598J', 'C/Antonio Gotor NÂº4 6ÂºA', 'Lopez', '2019-02-14', 'aG9sYQ==', 'Votante', 'No', 'Rafael'),
(79, '645182764', 'C/Antonio Gotor NÂº4 6ÂºA', 'Picardo', '2019-02-13', 'aG9sYQ==', 'Votante', 'No', 'Juam'),
(94, '47097702G', 'C/Antonio Gotor NÂº4 6ÂºA', 'Maiquez Barahona', '1980-02-21', 'bWFnaWMuMDI5NA==', 'Administrador', 'Si', 'Roberto'),
(95, '48613390S', 'Si', 'Lul', '1960-12-31', 'aG9sYQ==', 'Votante', 'No', 'PruebaEx'),
(96, '81465267A', 'Jardines De España, 36, 3730', 'Jorge Madrid', '1988-06-13', 'dW5pbWFkZQ==', 'Votante', 'No', 'Noa');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `convocatoria`
--
ALTER TABLE `convocatoria`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `partido`
--
ALTER TABLE `partido`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nombre` (`nombre`);

--
-- Indices de la tabla `resultado`
--
ALTER TABLE `resultado`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `conv_part` (`convocatoria`,`partido`),
  ADD KEY `FK_resultado_partido` (`partido`),
  ADD KEY `convocatoria` (`convocatoria`);

--
-- Indices de la tabla `votante`
--
ALTER TABLE `votante`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nif` (`nif`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `convocatoria`
--
ALTER TABLE `convocatoria`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT de la tabla `partido`
--
ALTER TABLE `partido`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `resultado`
--
ALTER TABLE `resultado`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=129;

--
-- AUTO_INCREMENT de la tabla `votante`
--
ALTER TABLE `votante`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=98;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `resultado`
--
ALTER TABLE `resultado`
  ADD CONSTRAINT `FK_resultado_convocatoria` FOREIGN KEY (`convocatoria`) REFERENCES `convocatoria` (`id`),
  ADD CONSTRAINT `FK_resultado_partido` FOREIGN KEY (`partido`) REFERENCES `partido` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

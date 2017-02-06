-- phpMyAdmin SQL Dump
-- version 4.3.11
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 26-07-2015 a las 21:21:23
-- Versión del servidor: 5.6.24
-- Versión de PHP: 5.6.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `t4rio`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `factura`
--

CREATE TABLE IF NOT EXISTS `factura` (
  `id` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `id_empresa` int(11) DEFAULT NULL,
  `fechaCreacion` varchar(255) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `precioTotal` float DEFAULT NULL,
  `informacion` varchar(255) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `estatus` varchar(255) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `extra` varchar(255) COLLATE utf8_spanish2_ci DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `factura`
--

INSERT INTO `factura` (`id`, `id_usuario`, `id_empresa`, `fechaCreacion`, `precioTotal`, `informacion`, `estatus`, `extra`) VALUES
(1, 1, 1, '2015-07-26', 13000, '21321', 'APROBADO', 'APROBADO'),
(2, 1, 1, '2015-07-26', 13000, '21321', 'POREDITAR', 'POREDITAR'),
(3, 1, 1, '2015-07-26', 93000, '12345', 'APROBADO', 'APROBADO'),
(4, 1, 1, '2015-07-26', 93000, '12345', 'POREDITAR', NULL),
(5, 1, 1, '2015-07-26', 93000, '12345', 'APROBADO', 'APROBADO'),
(6, 1, 1, '2015-07-26', 93000, '12345', 'APROBADO', 'APROBADO'),
(7, 1, 1, '2015-07-26', 96000, 'jojo', 'POREDITAR', 'POREDITAR'),
(8, 1, 1, '2015-07-26', 96000, 'jojo', 'PENDIENTE', NULL),
(9, 1, 1, '2015-07-26', 96000, 'jojo', 'PENDIENTE', NULL),
(10, 1, 1, '2015-07-26', 87000, '12345', 'PENDIENTE', NULL),
(11, 1, 1, '2015-07-26', 144000, '1234', 'PENDIENTE', NULL),
(12, 1, 1, '2015-07-26', 129000, '3123', 'PENDIENTE', NULL),
(13, 1, 1, '2015-07-26', 36000, 'asdad', 'PENDIENTE', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `factura_producto`
--

CREATE TABLE IF NOT EXISTS `factura_producto` (
  `id` int(11) NOT NULL,
  `id_factura` int(11) DEFAULT NULL,
  `id_tipoProducto` int(11) DEFAULT NULL,
  `cantidad` int(11) DEFAULT NULL,
  `precioCompra` float DEFAULT NULL,
  `precioCantidad` float DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `factura_producto`
--

INSERT INTO `factura_producto` (`id`, `id_factura`, `id_tipoProducto`, `cantidad`, `precioCompra`, `precioCantidad`) VALUES
(1, 5, 1, 2, 2000, 4000),
(2, 5, 2, 3, 3000, 9000),
(3, 5, 3, 4, 5000, 20000),
(4, 5, 3, 12, 5000, 60000),
(5, 6, 1, 2, 2000, 4000),
(6, 6, 2, 3, 3000, 9000),
(7, 6, 3, 4, 5000, 20000),
(8, 6, 3, 12, 5000, 60000),
(9, 7, 1, 12, 2000, 24000),
(10, 7, 2, 24, 3000, 72000),
(11, 8, 1, 12, 2000, 24000),
(12, 8, 2, 24, 3000, 72000),
(13, 9, 1, 12, 2000, 24000),
(14, 9, 2, 24, 3000, 72000),
(15, 10, 1, 12, 2000, 24000),
(16, 10, 2, 21, 3000, 63000),
(17, 11, 1, 12, 2000, 24000),
(18, 11, 3, 24, 5000, 120000),
(19, 12, 1, 12, 2000, 24000),
(20, 12, 3, 21, 5000, 105000),
(29, 13, 2, 12, 3000, 36000);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_empresa`
--

CREATE TABLE IF NOT EXISTS `tipo_empresa` (
  `id` int(11) NOT NULL,
  `nombre` varchar(255) COLLATE utf8_spanish2_ci DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `tipo_empresa`
--

INSERT INTO `tipo_empresa` (`id`, `nombre`) VALUES
(1, 'tipo #1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_producto`
--

CREATE TABLE IF NOT EXISTS `tipo_producto` (
  `id` int(11) NOT NULL,
  `nombre` varchar(255) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `precioActual` varchar(255) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `estado` varchar(255) COLLATE utf8_spanish2_ci DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `tipo_producto`
--

INSERT INTO `tipo_producto` (`id`, `nombre`, `precioActual`, `estado`) VALUES
(1, 'Producto #1 ', '2000', 'activo'),
(2, 'Producto #2 ', '3000', 'activo'),
(3, 'Producto #3', '5000', 'ACTIVO');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE IF NOT EXISTS `usuario` (
  `id` int(11) NOT NULL,
  `nombre` varchar(255) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `apellido` varchar(255) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `cedula` varchar(255) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `correo` varchar(255) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `tipo` varchar(255) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `clave` varchar(255) COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id`, `nombre`, `apellido`, `cedula`, `correo`, `tipo`, `clave`) VALUES
(1, 'Leonor', 'Guzman', '19720106', 'ronoel54@gmail.com ', 'ANALISTA', '1234');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `factura`
--
ALTER TABLE `factura`
  ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `unique_id` (`id`);

--
-- Indices de la tabla `factura_producto`
--
ALTER TABLE `factura_producto`
  ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `unique_id` (`id`);

--
-- Indices de la tabla `tipo_empresa`
--
ALTER TABLE `tipo_empresa`
  ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `unique_id` (`id`);

--
-- Indices de la tabla `tipo_producto`
--
ALTER TABLE `tipo_producto`
  ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `unique_id` (`id`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `unique_id` (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `factura`
--
ALTER TABLE `factura`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT de la tabla `factura_producto`
--
ALTER TABLE `factura_producto`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=30;
--
-- AUTO_INCREMENT de la tabla `tipo_empresa`
--
ALTER TABLE `tipo_empresa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `tipo_producto`
--
ALTER TABLE `tipo_producto`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 04-07-2017 a las 16:50:46
-- Versión del servidor: 10.1.13-MariaDB
-- Versión de PHP: 7.0.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `bd_gibmafe2`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tb_disponibles`
--

CREATE TABLE `tb_disponibles` (
  `id_disponible` int(5) NOT NULL,
  `cod_producto` int(5) NOT NULL,
  `descripcion` varchar(45) COLLATE utf8_spanish_ci NOT NULL,
  `cantidad` int(4) NOT NULL,
  `estado` varchar(25) COLLATE utf8_spanish_ci NOT NULL,
  `mostrar` varchar(1) COLLATE utf8_spanish_ci NOT NULL,
  `precio_compra` int(10) NOT NULL,
  `fecha_registro` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `tb_disponibles`
--

INSERT INTO `tb_disponibles` (`id_disponible`, `cod_producto`, `descripcion`, `cantidad`, `estado`, `mostrar`, `precio_compra`, `fecha_registro`) VALUES
(7, 1, 'zapatillas nike clasicas', 4, 'Disponible', '1', 20000, '2017-07-04'),
(8, 2, 'zapatillas adidas clasica', 3, 'Disponible', '1', 20000, '2017-07-04'),
(9, 3, 'converse basicas', 8, 'Disponible', '1', 35000, '2017-07-04'),
(10, 4, 'Baleta dorada todas las tallas', 6, 'Disponible', '1', 20000, '2017-07-04'),
(11, 5, 'Baleta roja todas las tallas', 15, 'Disponible', '1', 20000, '2017-07-04'),
(12, 6, 'blusa roja nataliy', 7, 'Disponible', '1', 20000, '2017-07-04'),
(13, 7, 'short rosa roja talla unica', 10, 'Disponible', '1', 20000, '2017-07-04'),
(14, 8, 'tacones rojos charol', 4, 'Disponible', '1', 24000, '2017-07-04'),
(15, 9, 'tacones negros charol todas las tallas', 10, 'Disponible', '1', 24000, '2017-07-04'),
(16, 10, 'tacones animal pr', 16, 'Disponible', '1', 24000, '2017-07-04'),
(17, 11, 'blusa negra cestÂ´ la mort', 4, 'Disponible', '1', 24000, '2017-07-04');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tb_externos`
--

CREATE TABLE `tb_externos` (
  `identificacion_externo` varchar(15) COLLATE utf8_spanish_ci NOT NULL,
  `nombre` varchar(30) COLLATE utf8_spanish_ci NOT NULL,
  `tipo` varchar(10) COLLATE utf8_spanish_ci NOT NULL,
  `direccion` varchar(40) COLLATE utf8_spanish_ci NOT NULL,
  `celular` varchar(15) COLLATE utf8_spanish_ci NOT NULL,
  `fecha_registro` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `tb_externos`
--

INSERT INTO `tb_externos` (`identificacion_externo`, `nombre`, `tipo`, `direccion`, `celular`, `fecha_registro`) VALUES
('1', 'adidas', 'proveedor', 'puente aranda outlets', '3123234355', '2017-06-29 04:34:51'),
('2', 'nike', 'proveedor', 'calle13 #34-43 ', '3123456788', '2017-06-29 04:38:53'),
('3', 'matilde rojas', 'proveedor', 'diagonal 34 #33-55 sur molinos del sur', '3133667578', '2017-06-21 08:02:07');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tb_movimientos`
--

CREATE TABLE `tb_movimientos` (
  `cod_movimiento` int(11) NOT NULL,
  `descripcion` varchar(150) COLLATE utf8_spanish_ci NOT NULL,
  `cantidad` int(5) NOT NULL,
  `tipo_movimiento` varchar(25) COLLATE utf8_spanish_ci NOT NULL,
  `valor_movimiento` int(10) NOT NULL,
  `fecha_movimiento` datetime NOT NULL,
  `factura` varchar(15) COLLATE utf8_spanish_ci NOT NULL,
  `identificacion_externo` varchar(15) COLLATE utf8_spanish_ci NOT NULL,
  `usuario` varchar(30) COLLATE utf8_spanish_ci NOT NULL,
  `cod_producto` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `tb_movimientos`
--

INSERT INTO `tb_movimientos` (`cod_movimiento`, `descripcion`, `cantidad`, `tipo_movimiento`, `valor_movimiento`, `fecha_movimiento`, `factura`, `identificacion_externo`, `usuario`, `cod_producto`) VALUES
(52, 'zapatillas nike clasicas', 4, 'Abastecimiento', 20000, '2017-07-04 08:52:26', '35435', '2', 'stmendozza', 1),
(53, 'zapatillas adidas clasica', 3, 'Abastecimiento', 20000, '2017-07-04 08:55:25', '12302323', '1', 'stmendozza', 2),
(54, 'converse basicas', 8, 'Abastecimiento', 35000, '2017-07-04 08:57:20', '123124', '3', 'stmendozza', 3),
(55, 'Baleta dorada todas las tallas', 6, 'Abastecimiento', 20000, '2017-07-04 08:58:26', '12302323', '3', 'stmendozza', 4),
(56, 'Baleta roja todas las tallas', 5, 'Abastecimiento', 20000, '2017-07-04 08:59:23', '35435', '3', 'stmendozza', 5),
(57, 'Baleta roja todas las tallas', 5, 'Abastecimiento', 20000, '2017-07-04 08:59:29', '35435', '3', 'stmendozza', 5),
(58, 'Baleta roja todas las tallas', 5, 'Abastecimiento', 20000, '2017-07-04 08:59:34', '35435', '3', 'stmendozza', 5),
(59, 'blusa roja nataliy', 7, 'Abastecimiento', 20000, '2017-07-04 09:24:01', '35435', '3', 'stmendozza', 6),
(60, 'short rosa roja talla unica', 4, 'Abastecimiento', 20000, '2017-07-04 09:25:03', '12302323', '3', 'stmendozza', 7),
(61, 'zapatillas nike jordan', 2, 'Abastecimiento', 70000, '2017-07-04 09:26:05', '12302323', '2', 'stmendozza', 7),
(62, 'zapatillas nike jordan', 2, 'Abastecimiento', 70000, '2017-07-04 09:26:10', '12302323', '2', 'stmendozza', 7),
(63, 'zapatillas nike jordan', 2, 'Abastecimiento', 70000, '2017-07-04 09:26:17', '12302323', '2', 'stmendozza', 7),
(64, 'tacones rojos charol', 4, 'Abastecimiento', 24000, '2017-07-04 09:37:51', '5364566', '3', 'stmendozza', 8),
(65, 'tacones negros charol todas las tallas', 5, 'Abastecimiento', 24000, '2017-07-04 09:38:27', '5364566', '3', 'stmendozza', 9),
(66, 'tacones negros charol todas las tallas', 5, 'Abastecimiento', 24000, '2017-07-04 09:38:34', '5364566', '3', 'stmendozza', 9),
(67, 'tacones animal pr', 4, 'Abastecimiento', 24000, '2017-07-04 09:39:30', '5364566', '3', 'stmendozza', 10),
(68, 'tacones animal pr', 4, 'Abastecimiento', 24000, '2017-07-04 09:39:46', '5364566', '3', 'stmendozza', 10),
(69, 'tacones animal pr', 4, 'Abastecimiento', 24000, '2017-07-04 09:39:50', '5364566', '3', 'stmendozza', 10),
(70, 'tacones animal pr', 4, 'Abastecimiento', 24000, '2017-07-04 09:40:03', '5364566', '3', 'stmendozza', 10),
(71, 'blusa negra cestÂ´ la mort', 4, 'Abastecimiento', 24000, '2017-07-04 09:41:31', '5364566', '3', 'stmendozza', 11);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tb_productos`
--

CREATE TABLE `tb_productos` (
  `cod_producto` int(5) NOT NULL,
  `descripcion` varchar(45) COLLATE utf8_spanish_ci NOT NULL,
  `precio_compra` int(10) NOT NULL,
  `fecha_registro` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `tb_productos`
--

INSERT INTO `tb_productos` (`cod_producto`, `descripcion`, `precio_compra`, `fecha_registro`) VALUES
(1, 'zapatillas nike clasicas', 20000, '2017-07-04'),
(2, 'zapatillas adidas clasica', 20000, '2017-07-04'),
(3, 'converse basicas', 35000, '2017-07-04'),
(4, 'Baleta dorada todas las tallas', 20000, '2017-07-04'),
(5, 'Baleta roja todas las tallas', 20000, '2017-07-04'),
(6, 'blusa roja nataliy', 20000, '2017-07-04'),
(7, 'short rosa roja talla unica', 20000, '2017-07-04'),
(8, 'tacones rojos charol', 24000, '2017-07-04'),
(9, 'tacones negros charol todas las tallas', 24000, '2017-07-04'),
(10, 'tacones animal pr', 24000, '2017-07-04'),
(11, 'blusa negra cestÂ´ la mort', 24000, '2017-07-04');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tb_usuarios`
--

CREATE TABLE `tb_usuarios` (
  `usuario` varchar(30) COLLATE utf8_spanish_ci NOT NULL,
  `pass` varchar(130) COLLATE utf8_spanish_ci NOT NULL,
  `nombre` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `celular` varchar(11) COLLATE utf8_spanish_ci NOT NULL,
  `correo` varchar(30) COLLATE utf8_spanish_ci NOT NULL,
  `fecha_registro` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `tb_usuarios`
--

INSERT INTO `tb_usuarios` (`usuario`, `pass`, `nombre`, `celular`, `correo`, `fecha_registro`) VALUES
('rosa.mendoza', '3133957636', 'rosa mendoza', '3133957636', 'stmendozza@gmail.com', '2017-06-20 10:17:22'),
('stmendozza', '3183448285', 'cristhian mendoza', '3183448285', 'stmendozza@gmail.com', '2017-06-20 10:13:52');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `tb_disponibles`
--
ALTER TABLE `tb_disponibles`
  ADD PRIMARY KEY (`id_disponible`),
  ADD KEY `cod_producto` (`cod_producto`);

--
-- Indices de la tabla `tb_externos`
--
ALTER TABLE `tb_externos`
  ADD PRIMARY KEY (`identificacion_externo`);

--
-- Indices de la tabla `tb_movimientos`
--
ALTER TABLE `tb_movimientos`
  ADD PRIMARY KEY (`cod_movimiento`),
  ADD KEY `cod_producto` (`cod_producto`),
  ADD KEY `usuario` (`usuario`),
  ADD KEY `identificacion` (`identificacion_externo`);

--
-- Indices de la tabla `tb_productos`
--
ALTER TABLE `tb_productos`
  ADD PRIMARY KEY (`cod_producto`);

--
-- Indices de la tabla `tb_usuarios`
--
ALTER TABLE `tb_usuarios`
  ADD PRIMARY KEY (`usuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `tb_disponibles`
--
ALTER TABLE `tb_disponibles`
  MODIFY `id_disponible` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT de la tabla `tb_movimientos`
--
ALTER TABLE `tb_movimientos`
  MODIFY `cod_movimiento` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=72;
--
-- AUTO_INCREMENT de la tabla `tb_productos`
--
ALTER TABLE `tb_productos`
  MODIFY `cod_producto` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `tb_disponibles`
--
ALTER TABLE `tb_disponibles`
  ADD CONSTRAINT `tb_disponibles_ibfk_1` FOREIGN KEY (`cod_producto`) REFERENCES `tb_productos` (`cod_producto`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `tb_movimientos`
--
ALTER TABLE `tb_movimientos`
  ADD CONSTRAINT `tb_movimientos_ibfk_1` FOREIGN KEY (`cod_producto`) REFERENCES `tb_productos` (`cod_producto`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tb_movimientos_ibfk_2` FOREIGN KEY (`identificacion_externo`) REFERENCES `tb_externos` (`identificacion_externo`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tb_movimientos_ibfk_3` FOREIGN KEY (`usuario`) REFERENCES `tb_usuarios` (`usuario`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

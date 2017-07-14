-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 14-07-2017 a las 03:04:23
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
(4, 2, 'zapatillas nike', 4, 'Disponible', '1', 23000, '2017-07-13'),
(5, 2, 'zapatillas adidas clasica ', 1, 'Disponible', '1', 122, '2017-07-13'),
(6, 3, 'zapatillas a', 7, 'Disponible', '1', 23000, '2017-07-13'),
(7, 3, 'zapatillas b', 4, 'Disponible', '1', 34000, '2017-07-13'),
(8, 4, 'zapatillas adidas clasica ', 12, 'Disponible', '1', 323, '2017-07-13'),
(9, 5, 'dedo', 12, 'Disponible', '1', 122, '2017-07-13'),
(10, 2, 'zapatillas adidas clasica ', 12122, 'Solicitud de GarantÃ­a', '1', 122, '2017-07-13'),
(11, 4, 'assa', 4, 'Solicitud de GarantÃ­a', '1', 122, '2017-07-13'),
(13, 43, 'zapatillas adidas clasica ', 4, 'Disponible', '1', 122, '2017-07-13');

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
('1', 'adidas', 'Proveedor', 'estacion zona industrial ', '3132233456', '2017-07-13 05:29:42'),
('2', 'nike', 'Proveedor', 'estacion zona industrial ', '5762332', '2017-07-13 05:32:55'),
('3', 'fila', 'Proveedor', 'estacion zona industrial ', '3167879889', '2017-07-13 05:34:02');

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
  `fecha_movimiento` date NOT NULL,
  `factura` varchar(15) COLLATE utf8_spanish_ci NOT NULL,
  `identificacion_externo` varchar(15) COLLATE utf8_spanish_ci NOT NULL,
  `usuario` varchar(30) COLLATE utf8_spanish_ci NOT NULL,
  `cod_producto` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `tb_movimientos`
--

INSERT INTO `tb_movimientos` (`cod_movimiento`, `descripcion`, `cantidad`, `tipo_movimiento`, `valor_movimiento`, `fecha_movimiento`, `factura`, `identificacion_externo`, `usuario`, `cod_producto`) VALUES
(4, 'zapatillas nike', 5, 'venta', 23000, '2017-07-13', '121323', '3', 'stmendoxxa', 2),
(5, 'zapatillas adidas clasica ', 1, 'Venta', 122, '2017-07-13', '45', '2', 'stmendozza', 2),
(6, 'zapatillas adidas clasica ', 1, 'Venta', 122, '2017-07-13', '45', '2', 'stmendozza', 2),
(7, 'zapatillas a', 7, 'Abastecimiento', 23000, '2017-07-13', '45', '1', 'stmendoxxa', 3),
(8, 'zapatillas b', 4, 'Abastecimiento', 34000, '2017-07-13', '45', '1', 'stmendoxxa', 3),
(9, 'zapatillas adidas clasica ', 12, 'Abastecimiento', 323, '2017-07-13', '45', '1', 'stmendozza', 4),
(10, 'dedo', 12, 'Abastecimiento', 122, '2017-07-13', '45', '1', 'stmendoxxa', 5),
(11, 'zapatillas adidas clasica ', 12122, 'Solicitud de GarantÃ­a', 122, '2017-07-13', '45', '1', 'stmendozza', 2),
(12, 'assa', 4, 'Solicitud de GarantÃ­a', 122, '2017-07-13', '121323', '1', 'stmendoxxa', 4),
(13, 'assa4', 1, 'Solicitud de GarantÃ­a', 122, '2017-07-13', '45', '2', 'stmendozza', 78),
(14, 'zapatillas adidas clasica ', 4, 'Abastecimiento', 122, '2017-07-13', '45', '1', 'stmendoxxa', 43);

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
(2, 'zapatillas ni', 23000, '2017-07-13'),
(3, 'zapatillas a', 23000, '2017-07-13'),
(4, 'zapatillas adidas clasica ', 323, '2017-07-13'),
(5, 'dedo', 122, '2017-07-13'),
(43, 'zapatillas adidas clasica ', 122, '2017-07-13');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tb_usuarios`
--

CREATE TABLE `tb_usuarios` (
  `usuario` varchar(30) COLLATE utf8_spanish_ci NOT NULL,
  `password` varchar(130) COLLATE utf8_spanish_ci NOT NULL,
  `nombre` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `celular` varchar(11) COLLATE utf8_spanish_ci NOT NULL,
  `correo` varchar(30) COLLATE utf8_spanish_ci NOT NULL,
  `ultima_sesion` datetime DEFAULT NULL,
  `activacion` int(11) NOT NULL DEFAULT '0',
  `token` varchar(40) COLLATE utf8_spanish_ci NOT NULL,
  `token_password` varchar(100) COLLATE utf8_spanish_ci DEFAULT NULL,
  `password_request` int(11) DEFAULT '0',
  `fecha_registro` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `tb_usuarios`
--

INSERT INTO `tb_usuarios` (`usuario`, `password`, `nombre`, `celular`, `correo`, `ultima_sesion`, `activacion`, `token`, `token_password`, `password_request`, `fecha_registro`) VALUES
('stmendoxxa', '$2y$10$K6ClVugC/C0F82WK1PnESO4.c0i./E9FpLuNwsiiC7qwSIoZN2Vgy', 'cristhian mendoza', '3183448285', 'cristhiancm-1@hotmail.com', '2017-07-13 13:44:00', 1, 'af3299a1db0e5c0334d15c223d8e7647', '', 0, '2017-07-13 13:40:18'),
('stmendozza', '$2y$10$VG2km4cvVHo642dzwi.2Ze5yIINurJBILzWoIbw52pdFb9aV8jK.W', 'Cristhian Danilo Mendoza', '3183448285', 'stmendozza@gmail.com', '2017-07-13 17:24:24', 1, '38f942768b843a23e58441c5ab6905bb', '', 1, '2017-07-08 14:53:23');

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
  ADD PRIMARY KEY (`cod_movimiento`);

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
  MODIFY `id_disponible` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT de la tabla `tb_movimientos`
--
ALTER TABLE `tb_movimientos`
  MODIFY `cod_movimiento` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT de la tabla `tb_productos`
--
ALTER TABLE `tb_productos`
  MODIFY `cod_producto` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=408;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `tb_disponibles`
--
ALTER TABLE `tb_disponibles`
  ADD CONSTRAINT `tb_disponibles_ibfk_1` FOREIGN KEY (`cod_producto`) REFERENCES `tb_productos` (`cod_producto`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

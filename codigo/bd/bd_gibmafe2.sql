-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 10-06-2017 a las 20:47:35
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
  `cod_disponible` int(5) NOT NULL,
  `descripcion` varchar(30) COLLATE utf8_spanish_ci NOT NULL,
  `cantidad` int(4) NOT NULL,
  `estado` int(5) NOT NULL,
  `valor` int(9) NOT NULL,
  `fecha_registro` datetime NOT NULL,
  `cod_producto` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tb_externos`
--

CREATE TABLE `tb_externos` (
  `identificacion_externo` varchar(15) COLLATE utf8_spanish_ci NOT NULL,
  `nombre` varchar(30) COLLATE utf8_spanish_ci NOT NULL,
  `tipo` varchar(5) COLLATE utf8_spanish_ci NOT NULL,
  `direccion` varchar(40) COLLATE utf8_spanish_ci NOT NULL,
  `celular` varchar(15) COLLATE utf8_spanish_ci NOT NULL,
  `fecha_registro` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tb_movimientos`
--

CREATE TABLE `tb_movimientos` (
  `cod_movimiento` int(11) NOT NULL,
  `descripcion` varchar(150) COLLATE utf8_spanish_ci NOT NULL,
  `cantidad` int(5) NOT NULL,
  `tipo_movimiento` varchar(5) COLLATE utf8_spanish_ci NOT NULL,
  `valor_movimiento` int(10) NOT NULL,
  `fecha_movimiento` datetime NOT NULL,
  `factura` varchar(15) COLLATE utf8_spanish_ci NOT NULL,
  `identificacion_externo` varchar(15) COLLATE utf8_spanish_ci NOT NULL,
  `usuario` varchar(30) COLLATE utf8_spanish_ci NOT NULL,
  `cod_producto` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tb_productos`
--

CREATE TABLE `tb_productos` (
  `cod_producto` int(5) NOT NULL,
  `descripcion` varchar(30) COLLATE utf8_spanish_ci NOT NULL,
  `precio_compra` int(10) NOT NULL,
  `fecha_registro` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `tb_productos`
--

INSERT INTO `tb_productos` (`cod_producto`, `descripcion`, `precio_compra`, `fecha_registro`) VALUES
(12, 'sasa', 333333, '0000-00-00 00:00:00'),
(19, 'Ohm black campaÃ±a3', 35000, '2017-05-09 00:00:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tb_usuarios`
--

CREATE TABLE `tb_usuarios` (
  `usuario` varchar(30) COLLATE utf8_spanish_ci NOT NULL,
  `contraseña` varchar(130) COLLATE utf8_spanish_ci NOT NULL,
  `nombre` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `celular` varchar(11) COLLATE utf8_spanish_ci NOT NULL,
  `correo` varchar(30) COLLATE utf8_spanish_ci NOT NULL,
  `fecha_registro` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `tb_disponibles`
--
ALTER TABLE `tb_disponibles`
  ADD PRIMARY KEY (`cod_disponible`),
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
-- AUTO_INCREMENT de la tabla `tb_movimientos`
--
ALTER TABLE `tb_movimientos`
  MODIFY `cod_movimiento` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `tb_productos`
--
ALTER TABLE `tb_productos`
  MODIFY `cod_producto` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
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

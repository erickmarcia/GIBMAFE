-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 15-06-2017 a las 02:02:54
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

--
-- Volcado de datos para la tabla `tb_externos`
--

INSERT INTO `tb_externos` (`identificacion_externo`, `nombre`, `tipo`, `direccion`, `celular`, `fecha_registro`) VALUES
('121212', 'modas ltda', 'prove', 'centro comercia plaza españa', '3113457688', '2017-06-13 05:15:15'),
('23234453', 'Matilde Rojas ', 'clien', 'calle 133 #15a-34 villa maria ', '3122657898', '2017-06-12 07:18:17'),
('35234943', 'Patricia Toro', 'clien', 'diagonal 45f #5-23 sur ap 201', '3129834576', '2017-06-12 07:16:44');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tb_movimientos`
--

CREATE TABLE `tb_movimientos` (
  `cod_movimiento` int(11) NOT NULL,
  `descripcion` varchar(150) COLLATE utf8_spanish_ci NOT NULL,
  `cantidad` int(5) NOT NULL,
  `tipo_movimiento` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
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
(36, 'Bolso Rojo Toro duby', 5, 'abastecimiento', 25000, '2017-06-14 05:48:10', '000001', '121212', 'ross', 1),
(37, 'Bolso Azul Lord', 4, 'abastecimiento', 25000, '2017-06-14 05:50:28', '000001', '121212', 'ross', 2),
(38, 'Bolso Gris Toro duby', 6, 'abastecimiento', 34000, '2017-06-14 05:51:17', '000001', '121212', 'ross', 3),
(39, 'Bolso Negro Basic', 3, 'abastecimiento', 17000, '2017-06-14 06:11:02', '322332', '121212', 'ross', 4),
(40, 'Baletas Celeste', 12, 'abastecimiento', 12000, '2017-06-14 06:13:10', '000001', '121212', 'ross', 5),
(41, 'Zapaillas Converse Classic', 7, 'abastecimiento', 35000, '2017-06-14 06:16:54', '9421122', '121212', 'ross', 6),
(42, 'Tacon Coca-Colo', 6, 'abastecimiento', 30000, '2017-06-14 06:20:20', '324434', '121212', 'ross', 7),
(43, 'Blusa Smile Red', 5, 'abastecimiento', 15000, '2017-06-14 06:22:20', '324434', '121212', 'ross', 8),
(44, 'Polo Miss Laud', 13, 'abastecimiento', 13000, '2017-06-14 06:26:23', '42332', '121212', 'ross', 9),
(45, 'Bolso Triana Small', 3, 'abastecimiento', 40000, '2017-06-14 06:29:37', '324434', '121212', 'ross', 10),
(50, 'Bolso Rojo Toro duby', 21, 'devolucion', 25000, '2017-06-14 06:44:30', '322332', '121212', 'ross', 2),
(51, 'Baletas Celeste', 3, 'devolucion', 12000, '2017-06-14 06:52:42', '322332', '121212', 'ross', 5);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tb_productos`
--

CREATE TABLE `tb_productos` (
  `cod_producto` int(5) NOT NULL,
  `descripcion` varchar(30) COLLATE utf8_spanish_ci NOT NULL,
  `cantidad` int(4) NOT NULL,
  `estado` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  `precio_compra` int(10) NOT NULL,
  `fecha_registro` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `tb_productos`
--

INSERT INTO `tb_productos` (`cod_producto`, `descripcion`, `cantidad`, `estado`, `precio_compra`, `fecha_registro`) VALUES
(1, 'Bolso Rojo Toro duby', 5, 'Disponible', 25000, '2017-06-14 05:48:10'),
(2, 'Bolso Azul Lord', 25, 'Disponible', 25000, '2017-06-14 05:50:28'),
(3, 'Bolso Gris Toro duby', 6, 'Disponible', 34000, '2017-06-14 05:51:17'),
(4, 'Bolso Negro Basic', 3, 'Disponible', 17000, '2017-06-14 06:11:02'),
(5, 'Baletas Celeste', 15, 'Disponible', 12000, '2017-06-14 06:13:10'),
(6, 'Zapaillas Converse Classic', 7, 'Disponible', 35000, '2017-06-14 06:16:54'),
(7, 'Tacon Coca-Colo', 6, 'Disponible', 30000, '2017-06-14 06:20:20'),
(8, 'Blusa Smile Red', 5, 'Disponible', 15000, '2017-06-14 06:22:20'),
(9, 'Polo Miss Laud', 13, 'Disponible', 13000, '2017-06-14 06:26:23'),
(10, 'Bolso Triana Small', 3, 'Disponible', 40000, '2017-06-14 06:29:37');

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
('ross', 'mafe', 'rosa mendoza', '3133957636', 'rosa.mendoza@oportunity.com.co', '2017-06-11 11:43:58'),
('sdasdsa', 'a', 'sadasdas', 'dasdas', '34234@gmail.com', '2017-06-11 11:38:15'),
('stmendozza@gmail.com', '3133957636', 'cristhian danilo', '3183448285', 'stmendozza@gmail.com', '2017-06-11 11:40:24');

--
-- Índices para tablas volcadas
--

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
  MODIFY `cod_movimiento` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;
--
-- AUTO_INCREMENT de la tabla `tb_productos`
--
ALTER TABLE `tb_productos`
  MODIFY `cod_producto` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=139;
--
-- Restricciones para tablas volcadas
--

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

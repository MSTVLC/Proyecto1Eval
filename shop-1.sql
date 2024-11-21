-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 18-11-2024 a las 11:39:13
-- Versión del servidor: 10.4.11-MariaDB
-- Versión de PHP: 7.4.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `shop-1`
--

-- --------------------------------------------------------
CREATE DATABASE IF NOT EXISTS `shop` DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;
USE `shop`;
--
-- Estructura de tabla para la tabla `carrito`
--

CREATE TABLE `carrito` (
  `idCarrito` int(11) NOT NULL,
  `idProducto` int(6) NOT NULL,
  `cantidad` int(3) NOT NULL,
  `idUnico` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `nombre` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `precio` decimal(10,2) DEFAULT NULL,
  `dniCliente` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `carrito`
--

INSERT INTO `carrito` (`idCarrito`, `idProducto`, `cantidad`, `idUnico`, `nombre`, `precio`, `dniCliente`) VALUES
(53, 8, 2, NULL, NULL, NULL, NULL),
(54, 10, 2, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

CREATE TABLE `clientes` (
  `dniCliente` varchar(9) COLLATE utf8_unicode_ci NOT NULL,
  `nombre` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `direccion` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(75) COLLATE utf8_unicode_ci NOT NULL,
  `pwd` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `administrador` text COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `clientes`
--

INSERT INTO `clientes` (`dniCliente`, `nombre`, `direccion`, `email`, `pwd`, `administrador`) VALUES
('2', 'cliente2', '2', '2@2', '$2y$10$Qv38yCY7OS6OvW2OVeXAfONf64J5uws9uAXbYIiQTKhYA1zzxbfdO', '0'),
('3', '3', '3', '3@3', '$2y$10$K4HhCWnQfpTulzjwUn0dIOYr/PVMRJOtkeuk1Waepd.xhSSHtgThC', NULL),
('4', '4', '4', '4@4', '$2y$10$r9Lot1HulvvBqtoFI2VrLeWdae4/UhyJZD9yRD2GDiW/3FamOM2zq', '0'),
('c11', 'c11', 'c11', 'c1@1', '$2y$10$vACQkhMtCHzf/eixszHvz.KfQ.W9JQIgo6dsPxAhHvYMXgyzH6nj.', '0');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `lineaspedidos`
--

CREATE TABLE `lineaspedidos` (
  `idPedido` int(4) NOT NULL,
  `nlinea` int(2) NOT NULL,
  `idProducto` int(6) DEFAULT NULL,
  `cantidad` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `lineaspedidos`
--

INSERT INTO `lineaspedidos` (`idPedido`, `nlinea`, `idProducto`, `cantidad`) VALUES
(1, 1, 2, 5),
(1, 2, 1, 3),
(1, 3, 3, 3),
(1, 4, 4, 3),
(2, 1, 5, 10),
(2, 2, 7, 10),
(5, 1, 5, 3),
(5, 2, 5, 3),
(5, 3, 2, 4),
(5, 4, 9, 4),
(6, 1, 1, 3),
(6, 2, 7, 2),
(6, 3, 9, 2),
(6, 4, 6, 200),
(10, 1, 6, 2),
(10, 2, 1, 2),
(10, 3, 9, 4),
(10, 4, 4, 10),
(11, 1, 11, 200),
(12, 1, 2, 3),
(12, 2, 9, 2),
(12, 3, 5, 10),
(12, 4, 4, 1),
(13, 1, 8, 3),
(13, 2, 9, 3),
(13, 3, 1, 200),
(13, 4, 3, 4),
(13, 5, 4, 10),
(14, 1, 1, 1),
(14, 2, 7, 1),
(14, 3, 8, 4),
(15, 1, 3, 1),
(15, 2, 5, 3),
(16, 1, 3, 2),
(16, 2, 1, 2),
(17, 1, 3, 1),
(17, 2, 4, 1),
(18, 1, 2, 1),
(19, 1, 1, 1),
(19, 2, 1, 1),
(20, 1, 3, 1),
(20, 2, 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedidos`
--

CREATE TABLE `pedidos` (
  `idPedido` int(4) NOT NULL,
  `fecha` date NOT NULL,
  `dirEntrega` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `nTarjeta` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fechaCaducidad` date DEFAULT NULL,
  `matriculaRepartidor` varchar(8) COLLATE utf8_unicode_ci DEFAULT NULL,
  `dniCliente` varchar(9) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `pedidos`
--

INSERT INTO `pedidos` (`idPedido`, `fecha`, `dirEntrega`, `nTarjeta`, `fechaCaducidad`, `matriculaRepartidor`, `dniCliente`) VALUES
(1, '1111-01-01', 'C/ Valeras, 22', '111111', '2020-02-02', 'pbf-1144', '10'),
(2, '2021-11-16', 'C/ Princesa, 15', '333333', '2020-02-02', 'bbc-2589', '10'),
(5, '2020-11-09', '', NULL, NULL, NULL, '10'),
(6, '1010-11-16', '', NULL, NULL, NULL, '10'),
(10, '2020-11-17', '', NULL, NULL, NULL, '15'),
(11, '2020-11-17', '', NULL, NULL, NULL, '32'),
(12, '2020-11-18', '', NULL, NULL, NULL, '15'),
(13, '2020-11-19', '', NULL, NULL, NULL, '10'),
(14, '2020-11-23', '', NULL, NULL, NULL, '10'),
(15, '2020-11-23', '', NULL, NULL, NULL, '10'),
(16, '2024-11-15', '', NULL, NULL, NULL, '4'),
(17, '2024-11-15', '', NULL, NULL, NULL, '4'),
(18, '2024-11-15', '3', NULL, NULL, NULL, '3'),
(19, '2024-11-15', '', NULL, NULL, NULL, '3'),
(20, '2024-11-15', '', NULL, NULL, NULL, '4');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `idProducto` int(6) NOT NULL,
  `nombre` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `detalle` varchar(500) COLLATE utf8_unicode_ci DEFAULT NULL,
  `foto` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `marca` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `categoria` enum('frio','congelado','seco') COLLATE utf8_unicode_ci DEFAULT NULL,
  `peso` int(3) NOT NULL,
  `unidades` int(5) NOT NULL,
  `volumen` int(4) DEFAULT NULL,
  `precio` int(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`idProducto`, `nombre`, `detalle`, `foto`, `marca`, `categoria`, `peso`, `unidades`, `volumen`, `precio`) VALUES
(1, 'iP 13 Pro Max', '128GB, Graphite', 'ip13promaxsm.jpg', 'Apple', 'seco', 238, 50, 83, 1099),
(2, 'iPhone 13 Pro', '128GB, Sierra Blue', 'ip13prosm.jpg', 'Apple', 'seco', 204, 50, 76, 999),
(3, 'iPhone 13', '128GB, Pink', 'ip13sm.jpg', 'Apple', 'seco', 174, 50, 78, 799),
(4, 'iP 12 Pro Max', '128GB, Pacific Blue', 'ip12promaxsm.jpg', 'Apple', 'seco', 226, 50, 81, 1099),
(5, 'iPhone 12 Pro', '128GB, Gold', 'ip12prosm.jpg', 'Apple', 'seco', 187, 50, 77, 999),
(6, 'iPhone 12', '128GB, Red', 'ip12sm.jpg', 'Apple', 'seco', 164, 50, 75, 799),
(7, 'iPhone SE', '64GB, White', 'ipse22sm.jpg', 'Apple', 'seco', 148, 50, 67, 399),
(8, 'iPhone 11', '128GB, Black', 'ip11sm.jpg', 'Apple', 'seco', 194, 50, 75, 599),
(10, 'iPhone X', '64GB, Silver', 'ipxsm.jpg', 'Apple', 'seco', 174, 50, 77, 899);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `carrito`
--
ALTER TABLE `carrito`
  ADD PRIMARY KEY (`idCarrito`);

--
-- Indices de la tabla `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`dniCliente`);

--
-- Indices de la tabla `lineaspedidos`
--
ALTER TABLE `lineaspedidos`
  ADD PRIMARY KEY (`idPedido`,`nlinea`);

--
-- Indices de la tabla `pedidos`
--
ALTER TABLE `pedidos`
  ADD PRIMARY KEY (`idPedido`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`idProducto`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `carrito`
--
ALTER TABLE `carrito`
  MODIFY `idCarrito` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=70;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `idProducto` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

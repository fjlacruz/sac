-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 06-03-2019 a las 19:51:28
-- Versión del servidor: 10.1.37-MariaDB
-- Versión de PHP: 7.3.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `prueba_tecnica`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `n_roles`
--

CREATE TABLE `n_roles` (
  `id_rol` int(11) NOT NULL,
  `descripcion_rol` varchar(80) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `n_roles`
--

INSERT INTO `n_roles` (`id_rol`, `descripcion_rol`) VALUES
(1, 'ADMINISTRADOR'),
(2, 'ANALISTA');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `t_bodega`
--

CREATE TABLE `t_bodega` (
  `id_bodega` int(11) NOT NULL,
  `descripcion_bodega` varchar(200) COLLATE utf8_bin NOT NULL,
  `ubicacion_bodega` varchar(250) COLLATE utf8_bin NOT NULL,
  `fecha_registro` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `estatus` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `t_bodega`
--

INSERT INTO `t_bodega` (`id_bodega`, `descripcion_bodega`, `ubicacion_bodega`, `fecha_registro`, `estatus`) VALUES
(21, 'primera bodega', 'santiago centro', '2019-03-06 18:20:33', 1),
(22, 'segunda bodega', 'san miguel', '2019-03-06 18:21:21', 1),
(23, 'TERCERA BODEGA', 'CENTRO', '2019-03-06 18:25:47', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `t_productos`
--

CREATE TABLE `t_productos` (
  `id_producto` int(11) NOT NULL,
  `id_bodega` int(11) NOT NULL,
  `descripcion_producto` varchar(200) COLLATE utf8_bin NOT NULL,
  `precio` float NOT NULL,
  `stock` int(11) NOT NULL,
  `fecha_registro` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `estatus` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `t_productos`
--

INSERT INTO `t_productos` (`id_producto`, `id_bodega`, `descripcion_producto`, `precio`, `stock`, `fecha_registro`, `estatus`) VALUES
(5, 21, 'producto uno', 2000, 12, '2019-03-06 18:22:53', 1),
(6, 23, 'producto x', 1500, 50, '2019-03-06 18:26:23', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `t_usuarios`
--

CREATE TABLE `t_usuarios` (
  `id_usuario` int(11) NOT NULL,
  `cedula` varchar(12) COLLATE utf8_bin NOT NULL,
  `nombres` varchar(50) COLLATE utf8_bin NOT NULL,
  `apellidos` varchar(60) COLLATE utf8_bin NOT NULL,
  `correo` varchar(120) COLLATE utf8_bin NOT NULL,
  `fecha_registro` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `usuario` varchar(80) COLLATE utf8_bin NOT NULL,
  `clave` varchar(150) COLLATE utf8_bin NOT NULL,
  `estatus` tinyint(1) NOT NULL DEFAULT '1',
  `rol` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `t_usuarios`
--

INSERT INTO `t_usuarios` (`id_usuario`, `cedula`, `nombres`, `apellidos`, `correo`, `fecha_registro`, `usuario`, `clave`, `estatus`, `rol`) VALUES
(1, '12345678', 'ADMIN', 'ADMIN', 'FRANCISCOJAVIERLACRUZ@GMAIL.COM', '0000-00-00 00:00:00', 'ADMIN', '8f95fbcfd0654635a0c4800c5a8b49c1', 1, 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `t_bodega`
--
ALTER TABLE `t_bodega`
  ADD PRIMARY KEY (`id_bodega`);

--
-- Indices de la tabla `t_productos`
--
ALTER TABLE `t_productos`
  ADD PRIMARY KEY (`id_producto`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `t_bodega`
--
ALTER TABLE `t_bodega`
  MODIFY `id_bodega` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT de la tabla `t_productos`
--
ALTER TABLE `t_productos`
  MODIFY `id_producto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

<br />
<b>Warning</b>:  require(streams.php): failed to open stream: No such file or directory in <b>C:\AppServ\www\phpMyAdmin\libraries\php-gettext\gettext.inc</b> on line <b>41</b><br />
<br />
<b>Warning</b>:  require(gettext.php): failed to open stream: No such file or directory in <b>C:\AppServ\www\phpMyAdmin\libraries\php-gettext\gettext.inc</b> on line <b>42</b><br />
-- phpMyAdmin SQL Dump
-- version 4.6.6
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 15-06-2020 a las 05:31:14
-- Versión del servidor: 5.7.17-log
-- Versión de PHP: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `cozto_ventas`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `caracteristicas`
--

CREATE TABLE `caracteristicas` (
  `id` int(5) NOT NULL,
  `caracteristica` varchar(50) NOT NULL,
  `hash` varchar(12) NOT NULL,
  `time` int(12) NOT NULL,
  `td` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Nombre de las caracteristica especiales agregadas';

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `caracteristicas_asig`
--

CREATE TABLE `caracteristicas_asig` (
  `id` int(5) NOT NULL,
  `caracteristica` varchar(12) NOT NULL,
  `producto` int(50) NOT NULL,
  `cant` float(10,2) NOT NULL,
  `hash` varchar(12) NOT NULL,
  `time` int(12) NOT NULL,
  `td` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Caracteristicas que se le asignaron a cada producto';

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

CREATE TABLE `clientes` (
  `id` int(6) NOT NULL,
  `nombre` varchar(200) NOT NULL,
  `documento` varchar(50) NOT NULL,
  `direccion` varchar(100) NOT NULL,
  `municipio` varchar(50) NOT NULL,
  `departamento` varchar(25) NOT NULL,
  `telefono` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `nacimiento` varchar(50) NOT NULL,
  `comentarios` text NOT NULL,
  `hash` varchar(12) NOT NULL,
  `time` int(12) NOT NULL,
  `td` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `clientes`
--

INSERT INTO `clientes` (`id`, `nombre`, `documento`, `direccion`, `municipio`, `departamento`, `telefono`, `email`, `nacimiento`, `comentarios`, `hash`, `time`, `td`) VALUES
(1, 'JUAN PEREZ', '0000000-0', 'San Salvador ', 'San Salvador', 'San Salvador', '78451256', '', '27-05-2020', ' ', '9811234b6f', 1590500464, 11),
(2, 'CARLOS LOPEZ', '0000000-0', 'San salvador', 'San Salvador', 'San Salvador', '00000000', '', '', '', '73e0d7c3ff', 1583103942, 11),
(3, 'JUAN HERNANDEZ', '00000000-0', 'San Salvador', 'San Salvador', 'San Salvador', '00000000', '', '10-06-1992', ' ', '461904b806', 1591703312, 10),
(4, 'JUAN PEREZ', '00000000-0', 'San Salvador', 'San Salvador', 'San Salvador', '60623882', '', '21-03-1986', '       ', '4d2344fe9e', 1591703034, 10),
(5, 'NEAGAN MARADIAGA', '03251695-8', 'Las Americas', 'Metapan', 'Santa Ana', '89526325', 'neagan@pizto.com', '21-03-1986', '   Es el mejor de todos', '66d09fa92f', 1588785002, 10);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `config_master`
--

CREATE TABLE `config_master` (
  `id` int(6) NOT NULL,
  `sistema` varchar(60) NOT NULL,
  `cliente` varchar(60) NOT NULL,
  `slogan` varchar(60) NOT NULL,
  `propietario` varchar(60) NOT NULL,
  `telefono` varchar(30) NOT NULL,
  `giro` varchar(60) NOT NULL,
  `nit` varchar(40) NOT NULL,
  `imp` float(10,2) NOT NULL,
  `direccion` varchar(60) NOT NULL,
  `email` varchar(50) NOT NULL,
  `imagen` varchar(50) NOT NULL,
  `logo` varchar(50) NOT NULL,
  `skin` varchar(30) NOT NULL,
  `tipo_inicio` int(2) NOT NULL COMMENT '1= rapida 2 = mesas',
  `pais` varchar(50) NOT NULL,
  `moneda` varchar(30) NOT NULL,
  `moneda_simbolo` varchar(10) NOT NULL,
  `nombre_impuesto` varchar(10) NOT NULL,
  `nombre_documento` varchar(10) NOT NULL,
  `inicio_tx` int(2) NOT NULL,
  `otras_ventas` int(2) NOT NULL COMMENT '0 inactivo, 1 activo',
  `cambio_tx` varchar(4) DEFAULT NULL COMMENT 'Permitir Cambio Tx',
  `dias_vencimiento` int(3) NOT NULL,
  `dias_cotizacion` int(3) NOT NULL,
  `multicaja` varchar(3) NOT NULL,
  `hash` varchar(12) NOT NULL,
  `time` int(12) NOT NULL,
  `td` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `config_master`
--

INSERT INTO `config_master` (`id`, `sistema`, `cliente`, `slogan`, `propietario`, `telefono`, `giro`, `nit`, `imp`, `direccion`, `email`, `imagen`, `logo`, `skin`, `tipo_inicio`, `pais`, `moneda`, `moneda_simbolo`, `nombre_impuesto`, `nombre_documento`, `inicio_tx`, `otras_ventas`, `cambio_tx`, `dias_vencimiento`, `dias_cotizacion`, `multicaja`, `hash`, `time`, `td`) VALUES
(1, 'Sistema de contro', 'FERRETERIAS DE AQUI', 'LO MEJOR EN FERRETERIA', 'Erick Nunez', '60623882', '', '0207-210386-102-9', 13.00, 'San Salvador', 'aerick.nunez@gmail.com', '1592065898.png', 'pizto.png', 'grey-skin', 2, '1', 'Dolares', '$', 'IVA', 'NIT', 1, 1, '', 30, 30, '', '0215951ce2', 1592065898, 10),
(2, 'Sistema de control', 'LA CURVA', 'ABARROTES Y MAS', '', '', '', '', 13.00, '', '', '1592220116.png', 'pizto.png', 'mdb-skin', 1, '1', 'Dolares', '$', 'IVA', 'NIT', 1, 1, '', 0, 0, '', '', 1592220117, 11);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `config_root`
--

CREATE TABLE `config_root` (
  `id` int(5) NOT NULL,
  `expira` varchar(100) NOT NULL,
  `expiracion` varchar(100) NOT NULL,
  `ftp_servidor` varchar(100) NOT NULL,
  `ftp_path` varchar(100) NOT NULL,
  `ftp_ruta` varchar(100) NOT NULL,
  `ftp_user` varchar(100) NOT NULL,
  `ftp_password` varchar(100) NOT NULL,
  `tipo_sistema` varchar(100) NOT NULL COMMENT '0 = demo 1 - basico, 2- profesionl, 3 -corporativo',
  `plataforma` varchar(100) NOT NULL COMMENT '0 local, 1, web',
  `hash` varchar(12) NOT NULL,
  `time` int(12) NOT NULL,
  `td` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `config_root`
--

INSERT INTO `config_root` (`id`, `expira`, `expiracion`, `ftp_servidor`, `ftp_path`, `ftp_ruta`, `ftp_user`, `ftp_password`, `tipo_sistema`, `plataforma`, `hash`, `time`, `td`) VALUES
(1, 'eTFDTEpDRG12Qlc4K3dCenZzRVBrZz09', 'VUdMdTZ0VitMazhaeDJqbnNneWFwUT09', 'WlBoUUVvemxaU1M2Nm5wV0N2MGorUT09', 'WlBoUUVvemxaU1M2Nm5wV0N2MGorUT09', 'WlBoUUVvemxaU1M2Nm5wV0N2MGorUT09', 'WlBoUUVvemxaU1M2Nm5wV0N2MGorUT09', 'WlBoUUVvemxaU1M2Nm5wV0N2MGorUT09', 'S2hONmxpd3BldVlQOHVvSHhYa1BGdz09', 'S2hONmxpd3BldVlQOHVvSHhYa1BGdz09', 'dfb401079e', 1584659138, 10),
(2, 'QnR2NDN4U0x4WWJjcysybThvbWUyUT09', 'dUN2M25sZ0xNUy9UZS9KUXFzTlMydz09', 'SjJJUFJCM0lPczBaZVU4K3IrTnVEZz09', 'SjJJUFJCM0lPczBaZVU4K3IrTnVEZz09', 'SjJJUFJCM0lPczBaZVU4K3IrTnVEZz09', 'SjJJUFJCM0lPczBaZVU4K3IrTnVEZz09', 'SjJJUFJCM0lPczBaZVU4K3IrTnVEZz09', 'ZzZZcEg3bzJpUEpGeEVNRnVyQzBFUT09', 'WWpKeUpVeVoxT1pBZXZhazFrOGM4Zz09', '', 1584572222, 11);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `corte_diario`
--

CREATE TABLE `corte_diario` (
  `id` int(6) NOT NULL,
  `fecha` varchar(25) NOT NULL,
  `fecha_format` varchar(30) NOT NULL,
  `hora` varchar(30) NOT NULL,
  `productos` int(6) NOT NULL,
  `clientes` int(10) NOT NULL,
  `efectivo_ingresado` float(10,2) NOT NULL,
  `tx` float(10,2) NOT NULL,
  `no_tx` float(10,2) NOT NULL,
  `total` float(10,2) NOT NULL,
  `t_efectivo` float(10,2) NOT NULL,
  `t_tarjeta` float(10,2) NOT NULL,
  `t_credito` float(10,2) NOT NULL,
  `gastos` float(10,2) NOT NULL,
  `diferencia` float(10,2) NOT NULL,
  `user` varchar(100) NOT NULL,
  `edo` int(4) NOT NULL,
  `hash` varchar(12) NOT NULL,
  `time` int(12) NOT NULL,
  `td` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `corte_diario`
--

INSERT INTO `corte_diario` (`id`, `fecha`, `fecha_format`, `hora`, `productos`, `clientes`, `efectivo_ingresado`, `tx`, `no_tx`, `total`, `t_efectivo`, `t_tarjeta`, `t_credito`, `gastos`, `diferencia`, `user`, `edo`, `hash`, `time`, `td`) VALUES
(1, '01-03-2020', '1583042400', '17:10:24', 38, 9, 91.46, 161.54, 0.00, 161.54, 84.16, 46.44, 30.94, 8.70, 0.00, '3c67697e18899300a2648199a9798dffb359cab2', 1, 'b1d38ea0d6', 1583104224, 11),
(2, '01-03-2020', '1583042400', '17:21:24', 35, 7, 155.95, 365.85, 0.00, 365.85, 146.15, 52.30, 167.40, 0.00, 0.00, '3c67697e18899300a2648199a9798dffb359cab2', 1, '6690eec6ad', 1583104885, 10),
(3, '02-03-2020', '1583128800', '17:26:19', 17, 5, 253.34, 143.95, 0.00, 143.95, 109.15, 34.80, 0.00, 11.76, 0.00, '3c67697e18899300a2648199a9798dffb359cab2', 1, 'e9af21c5f4', 1583191579, 10),
(4, '02-03-2020', '1583128800', '17:33:40', 22, 5, 173.70, 121.68, 0.00, 121.68, 84.70, 36.98, 0.00, 2.46, 0.00, '3c67697e18899300a2648199a9798dffb359cab2', 1, 'c1f12a9589', 1583192020, 11),
(5, '03-03-2020', '1583215200', '17:48:11', 19, 5, 150.08, 88.46, 0.00, 88.46, 55.81, 32.65, 0.00, 84.10, 0.00, '3c67697e18899300a2648199a9798dffb359cab2', 2, '4b13f0bbb9', 1583280771, 11),
(6, '03-03-2020', '1583215200', '18:01:15', 18, 3, 390.79, 201.90, 0.00, 201.90, 118.60, 0.00, 83.30, 91.15, 0.00, '3c67697e18899300a2648199a9798dffb359cab2', 2, '2f3bfba195', 1583280771, 10),
(7, '03-03-2020', '1583215200', '18:13:25', 18, 3, 390.79, 201.90, 0.00, 201.90, 118.60, 0.00, 83.30, 91.15, 0.00, '3c67697e18899300a2648199a9798dffb359cab2', 1, 'b3dc87c1d3', 1583280805, 10),
(8, '03-03-2020', '1583215200', '18:18:03', 19, 5, 150.08, 88.46, 0.00, 88.46, 55.81, 32.65, 0.00, 84.10, 0.00, '3c67697e18899300a2648199a9798dffb359cab2', 1, '8c85ecfe93', 1583281084, 11),
(9, '04-03-2020', '1583301600', '18:25:51', 30, 6, 275.36, 156.22, 0.00, 156.22, 125.48, 11.67, 19.07, 15.20, 0.00, '3c67697e18899300a2648199a9798dffb359cab2', 1, '15fecd21c6', 1583367951, 11),
(10, '04-03-2020', '1583301600', '18:32:35', 29, 6, 105.09, 366.50, 0.00, 366.50, 164.30, 202.20, 0.00, 450.00, 0.00, '3c67697e18899300a2648199a9798dffb359cab2', 1, '06cd64290b', 1583368355, 10),
(11, '05-03-2020', '1583388000', '18:41:06', 49, 8, 475.63, 207.70, 0.00, 207.70, 195.00, 12.70, 0.00, 0.00, 0.00, '3c67697e18899300a2648199a9798dffb359cab2', 1, '283c2eea2f', 1583455267, 11),
(12, '05-03-2020', '1583388000', '18:45:21', 27, 7, 467.29, 362.20, 0.00, 362.20, 362.20, 0.00, 0.00, 0.00, 0.00, '3c67697e18899300a2648199a9798dffb359cab2', 1, '6f2c370c92', 1583455521, 10),
(13, '06-03-2020', '1583474400', '18:52:09', 26, 5, 527.95, 69.92, 0.00, 69.92, 62.52, 7.40, 0.00, 15.20, 0.00, '3c67697e18899300a2648199a9798dffb359cab2', 1, 'a46952363e', 1583542329, 11),
(14, '07-03-2020', '1583560800', '19:02:47', 31, 4, 182.21, 154.26, 0.00, 154.26, 154.26, 0.00, 0.00, 500.00, 0.00, '3c67697e18899300a2648199a9798dffb359cab2', 1, '552229a1aa', 1583629367, 11),
(15, '08-03-2020', '1583647200', '19:06:12', 37, 6, 308.38, 126.17, 0.00, 126.17, 126.17, 0.00, 0.00, 0.00, 0.00, '3c67697e18899300a2648199a9798dffb359cab2', 1, '7159597778', 1583715972, 11),
(16, '09-03-2020', '1583733600', '19:09:11', 29, 3, 408.88, 116.30, 0.00, 116.30, 116.30, 0.00, 0.00, 15.80, 0.00, '3c67697e18899300a2648199a9798dffb359cab2', 1, '8ad8e601f1', 1583802552, 11),
(17, '10-03-2020', '1583820000', '19:12:47', 57, 5, 41.82, 211.64, 0.00, 211.64, 197.14, 14.50, 0.00, 568.27, 0.00, '3c67697e18899300a2648199a9798dffb359cab2', 1, 'de2c27bbe9', 1583889167, 11),
(18, '11-03-2020', '1583906400', '19:15:55', 44, 4, 115.75, 131.08, 0.00, 131.08, 96.33, 34.75, 0.00, 22.40, 0.00, '3c67697e18899300a2648199a9798dffb359cab2', 1, '326918910d', 1583975756, 11),
(19, '12-03-2020', '1583992800', '19:27:55', 72, 5, 284.96, 195.81, 0.00, 195.81, 150.41, 0.00, 45.40, 1.20, 0.00, '3c67697e18899300a2648199a9798dffb359cab2', 2, 'a1a6a4dfe6', 1584062913, 11),
(20, '12-03-2020', '1583992800', '19:29:14', 81, 6, 284.96, 217.67, 0.00, 217.67, 150.41, 21.86, 45.40, 1.20, 0.00, '3c67697e18899300a2648199a9798dffb359cab2', 1, 'f714f40165', 1584062954, 11),
(21, '13-03-2020', '1584079200', '19:38:22', 59, 5, 402.60, 169.09, 0.00, 169.09, 102.64, 66.45, 0.00, 0.00, 0.00, '3c67697e18899300a2648199a9798dffb359cab2', 1, 'a61f5fb926', 1584149902, 11),
(22, '14-03-2020', '1584165600', '19:41:29', 50, 5, 257.36, 204.76, 0.00, 204.76, 204.76, 0.00, 0.00, 350.00, 0.00, '3c67697e18899300a2648199a9798dffb359cab2', 1, '1d60406f1b', 1584236489, 11),
(23, '15-03-2020', '1584252000', '19:43:16', 27, 3, 324.54, 67.18, 0.00, 67.18, 67.18, 0.00, 0.00, 0.00, 0.00, '3c67697e18899300a2648199a9798dffb359cab2', 1, '8e2bba0f7d', 1584322996, 11),
(24, '16-03-2020', '1584338400', '19:46:03', 27, 4, 420.58, 96.04, 0.00, 96.04, 96.04, 0.00, 0.00, 0.00, 0.00, '3c67697e18899300a2648199a9798dffb359cab2', 1, 'd27a8006e4', 1584409564, 11),
(25, '17-03-2020', '1584424800', '19:48:30', 42, 3, 134.13, 159.41, 0.00, 159.41, 151.95, 7.46, 0.00, 438.40, 0.00, '3c67697e18899300a2648199a9798dffb359cab2', 1, 'a85feceb78', 1584496111, 11),
(26, '18-03-2020', '1584511200', '19:52:30', 59, 5, 413.20, 291.58, 0.00, 291.58, 273.67, 8.24, 9.67, 5.00, 0.00, '3c67697e18899300a2648199a9798dffb359cab2', 1, '29d9a1d974', 1584582750, 11),
(27, '06-03-2020', '1583474400', '19:59:14', 21, 5, 437.44, 314.75, 0.00, 314.75, 110.15, 24.60, 180.00, 200.00, 0.00, '3c67697e18899300a2648199a9798dffb359cab2', 1, '2232e14466', 1583546354, 10),
(28, '07-03-2020', '1583560800', '20:02:44', 43, 6, 993.19, 606.15, 0.00, 606.15, 575.75, 30.40, 0.00, 20.00, 0.00, '3c67697e18899300a2648199a9798dffb359cab2', 1, 'c210d414d0', 1583632965, 10),
(29, '08-03-2020', '1583647200', '20:04:22', 2, 1, 1216.59, 62.50, 0.00, 62.50, 62.50, 0.00, 0.00, 0.00, 0.00, '3c67697e18899300a2648199a9798dffb359cab2', 1, 'ab732b6827', 1583719463, 10),
(30, '09-03-2020', '1583733600', '20:06:06', 68, 2, 129.29, 535.70, 0.00, 535.70, 412.70, 123.00, 0.00, 1500.00, 0.00, '3c67697e18899300a2648199a9798dffb359cab2', 1, '634ce138d2', 1583805966, 10),
(31, '10-03-2020', '1583820000', '20:07:52', 48, 3, 484.34, 356.40, 0.00, 356.40, 355.05, 1.35, 0.00, 0.00, 0.00, '3c67697e18899300a2648199a9798dffb359cab2', 1, '850a89e4a4', 1583892473, 10),
(32, '11-03-2020', '1583906400', '20:08:54', 51, 2, 920.04, 435.70, 0.00, 435.70, 435.70, 0.00, 0.00, 0.00, 0.00, '3c67697e18899300a2648199a9798dffb359cab2', 1, '788edf2fc2', 1583978934, 10),
(33, '12-03-2020', '1583992800', '20:10:33', 13, 2, 551.44, 131.40, 0.00, 131.40, 131.40, 0.00, 0.00, 500.00, 0.00, '3c67697e18899300a2648199a9798dffb359cab2', 1, '73261464a6', 1584065433, 10),
(34, '13-03-2020', '1584079200', '20:11:51', 70, 2, 1139.44, 538.00, 0.00, 538.00, 538.00, 0.00, 0.00, 0.00, 0.00, '3c67697e18899300a2648199a9798dffb359cab2', 1, 'a5884aaf2d', 1584151911, 10),
(35, '14-03-2020', '1584165600', '20:13:04', 50, 1, 549.44, 410.00, 0.00, 410.00, 410.00, 0.00, 0.00, 1000.00, 0.00, '3c67697e18899300a2648199a9798dffb359cab2', 1, 'af55a2d048', 1584238385, 10),
(36, '15-03-2020', '1584252000', '20:14:12', 51, 2, 968.94, 419.50, 0.00, 419.50, 419.50, 0.00, 0.00, 0.00, 0.00, '3c67697e18899300a2648199a9798dffb359cab2', 1, '56f3286466', 1584324852, 10),
(37, '16-03-2020', '1584338400', '20:15:16', 50, 3, 1499.94, 531.00, 0.00, 531.00, 531.00, 0.00, 0.00, 0.00, 0.00, '3c67697e18899300a2648199a9798dffb359cab2', 1, '734a2599ba', 1584411316, 10),
(38, '17-03-2020', '1584424800', '20:16:41', 51, 2, 1937.69, 442.95, 0.00, 442.95, 442.95, 0.00, 0.00, 5.20, 0.00, '3c67697e18899300a2648199a9798dffb359cab2', 1, 'c9bd3acad8', 1584497801, 10),
(39, '18-03-2020', '1584511200', '20:19:46', 42, 3, 1063.04, 667.95, 0.00, 667.95, 615.75, 52.20, 0.00, 1520.40, 0.00, '3c67697e18899300a2648199a9798dffb359cab2', 1, '3b769a638c', 1584584386, 10),
(40, '19-03-2020', '1584597600', '16:52:03', 15, 4, 1175.36, 112.32, 0.00, 112.32, 112.32, 0.00, 0.00, 0.00, 0.00, '3c67697e18899300a2648199a9798dffb359cab2', 2, '2742516902', 1584664070, 10),
(41, '19-03-2020', '1584597600', '17:05:07', 15, 4, 1175.36, 112.32, 0.00, 112.32, 112.32, 0.00, 0.00, 0.00, 0.00, '3c67697e18899300a2648199a9798dffb359cab2', 2, 'f793936854', 1584664070, 10),
(42, '19-03-2020', '1584597600', '17:06:08', 15, 4, 1175.36, 112.32, 0.00, 112.32, 112.32, 0.00, 0.00, 0.00, 0.00, '3c67697e18899300a2648199a9798dffb359cab2', 2, 'c446565980', 1584664070, 10),
(43, '19-03-2020', '1584597600', '18:28:05', 15, 4, 1175.36, 112.32, 0.00, 112.32, 112.32, 0.00, 0.00, 0.00, 0.00, '3c67697e18899300a2648199a9798dffb359cab2', 1, 'e3d0634393', 1584664085, 10);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cotizaciones`
--

CREATE TABLE `cotizaciones` (
  `id` int(6) NOT NULL,
  `cod` int(4) NOT NULL,
  `cant` int(4) NOT NULL,
  `producto` varchar(100) NOT NULL,
  `pv` float(10,2) NOT NULL,
  `stotal` float(10,2) NOT NULL,
  `imp` float(10,2) NOT NULL,
  `total` float(10,2) NOT NULL,
  `descuento` float(10,2) NOT NULL,
  `cotizacion` int(6) NOT NULL,
  `user` varchar(100) NOT NULL,
  `edo` int(2) NOT NULL COMMENT 'a= activo, 2= eliminada',
  `hash` varchar(12) NOT NULL,
  `time` int(12) NOT NULL,
  `td` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `cotizaciones`
--

INSERT INTO `cotizaciones` (`id`, `cod`, `cant`, `producto`, `pv`, `stotal`, `imp`, `total`, `descuento`, `cotizacion`, `user`, `edo`, `hash`, `time`, `td`) VALUES
(25, 1002, 2, 'CEMENTO BLANCO, BOLSA DE 42.5 KGS.', 17.50, 30.97, 4.03, 35.00, 0.00, 3, 'Erick', 1, '6fbb032ada', 1584748456, 10),
(26, 1006, 1, 'DECOBLOCK GRIS GRANO FINO, BOLSA DE 40 KGS.', 7.60, 6.73, 0.87, 7.60, 0.00, 3, 'Erick', 1, 'a079b62bb4', 1584748453, 10),
(27, 1004, 3, 'CEMENTO GRIS CUSCATLáN, BOLSA DE 42.5 KGS', 8.20, 21.77, 2.83, 24.60, 0.00, 3, 'Erick', 1, '57d68ad1b7', 1584748459, 10),
(28, 1011, 1, 'CAJA PARA HERRAMIENTAS PLáSTICA DE 26PLG', 45.00, 39.82, 5.18, 45.00, 0.00, 3, 'Erick', 1, '31767c471c', 1584748465, 10),
(29, 1001, 1, 'ABRAZADERA STRUT 1/2 TOPAZ', 0.95, 0.84, 0.11, 0.95, 0.00, 3, 'Erick', 1, '41ea3d254a', 1584748467, 10),
(30, 1014, 1, 'FOCO CLARO GE 60W-130V 24651/3', 0.70, 0.62, 0.08, 0.70, 0.00, 3, 'Erick', 1, '07b2daaf17', 1584748471, 10),
(35, 1002, 2, 'CEMENTO BLANCO, BOLSA DE 42.5 KGS.', 17.50, 30.97, 4.03, 35.00, 0.00, 4, 'Erick', 1, '307348d88d', 1584752229, 10),
(36, 1004, 3, 'CEMENTO GRIS CUSCATLáN, BOLSA DE 42.5 KGS', 8.20, 21.77, 2.83, 24.60, 0.00, 4, 'Erick', 1, 'eb1e60ba24', 1584752238, 10),
(37, 1003, 1, 'CEMENTO BLANCO, BOLSA DE 42.5 KGS.', 8.20, 7.26, 0.94, 8.20, 0.00, 4, 'Erick', 1, '1893a973ee', 1584752231, 10),
(38, 1013, 1, 'FOCO ESMERILADO DE 40 WATTS', 0.45, 0.40, 0.05, 0.45, 0.00, 4, 'Erick', 1, 'a2bff6fc1b', 1584752235, 10),
(39, 1010, 1, 'CAJA PARA HERRAMIENTAS PLáSTICA DE 12PLG', 3.25, 2.88, 0.37, 3.25, 0.00, 4, 'Erick', 1, '97fd52fdb0', 1584752239, 10),
(40, 1011, 1, 'CAJA PARA HERRAMIENTAS PLáSTICA DE 26PLG', 45.00, 39.82, 5.18, 45.00, 0.00, 4, 'Erick', 1, 'f78faa80a7', 1584752243, 10),
(41, 1003, 1, 'CEMENTO BLANCO, BOLSA DE 42.5 KGS.', 8.20, 7.26, 0.94, 8.20, 0.00, 5, 'Erick', 1, '25c9f5c5d3', 1584752272, 10),
(42, 1004, 1, 'CEMENTO GRIS CUSCATLáN, BOLSA DE 42.5 KGS', 8.20, 7.26, 0.94, 8.20, 0.00, 5, 'Erick', 1, 'e3e2d0eb7c', 1584752273, 10),
(43, 1002, 1, 'CEMENTO BLANCO, BOLSA DE 42.5 KGS.', 17.50, 15.49, 2.01, 17.50, 0.00, 5, 'Erick', 1, '5756774cb2', 1584752275, 10),
(44, 1002, 1, '2 PACK ARROZ BLANCO DANY 1 LB', 1.09, 0.96, 0.13, 1.09, 0.00, 1, 'db2625', 1, '090cf6cc71', 1584752423, 11),
(45, 1004, 1, '2PACK BEBIDA LACTEA SMILK 350 GRAMOS', 3.70, 3.27, 0.43, 3.70, 0.00, 1, 'db2625', 1, '02e1591b53', 1584752424, 11),
(46, 1010, 6, 'ACEITE ORISOL 3000ML PET', 6.15, 32.65, 4.25, 36.90, 0.00, 1, 'db2625', 1, 'b3ec5ab4d3', 1584752463, 11),
(47, 1012, 1, 'AVENA MOSH PARA FRESCO ORIGI QUAKER 600G', 2.21, 1.96, 0.25, 2.21, 0.00, 1, 'db2625', 1, '1db3b67962', 1584752427, 11),
(48, 1011, 3, 'ADEREZO P/ENSALADA RANCH LIGHT 237 ML CL', 2.10, 5.58, 0.72, 6.30, 0.00, 1, 'db2625', 1, '66dd828e47', 1584752436, 11),
(49, 1001, 1, '2 PACK ARROZ BLANCO CINCO ESTRELLA LIBRA', 1.38, 1.22, 0.16, 1.38, 0.00, 1, 'db2625', 1, '795b9dfe77', 1584752435, 11),
(50, 1002, 2, 'CEMENTO BLANCO, BOLSA DE 42.5 KGS.', 17.50, 30.97, 4.03, 35.00, 0.00, 6, 'Erick', 1, '7f9a31a01e', 1591708704, 10),
(51, 1005, 1, 'DECOBLOCK BLANCO HUESO GRANO MEDIO, BOLSA DE 40 KGS.', 8.70, 7.70, 1.00, 8.70, 0.00, 6, 'Erick', 1, '801ecfe687', 1591708696, 10),
(52, 1008, 1, 'NAVAJA PARA ELECTRICISTA', 4.60, 4.07, 0.53, 4.60, 0.00, 6, 'Erick', 1, 'ee7591ae29', 1591708700, 10),
(53, 1007, 1, 'LIMPIADOR DE CONTACTOS SECADO RáPIDO', 9.50, 8.41, 1.09, 9.50, 0.00, 6, 'Erick', 1, 'd800bf0764', 1591708706, 10),
(54, 1003, 1, 'CEMENTO BLANCO, BOLSA DE 42.5 KGS.', 8.20, 7.26, 0.94, 8.20, 0.00, 7, 'Erick', 1, 'c8f153ec45', 1592059317, 10),
(55, 1002, 1, 'CEMENTO BLANCO, BOLSA DE 42.5 KGS.', 17.50, 15.49, 2.01, 17.50, 0.00, 7, 'Erick', 1, '2331157c0d', 1592059320, 10),
(56, 1004, 1, 'CEMENTO GRIS CUSCATLáN, BOLSA DE 42.5 KGS', 8.20, 7.26, 0.94, 8.20, 0.00, 7, 'Erick', 1, 'f913c8d4d3', 1592059321, 10),
(57, 1005, 1, 'DECOBLOCK BLANCO HUESO GRANO MEDIO, BOLSA DE 40 KGS.', 8.70, 7.70, 1.00, 8.70, 0.00, 7, 'Erick', 1, 'f81a061ea1', 1592059323, 10),
(58, 1006, 1, 'DECOBLOCK GRIS GRANO FINO, BOLSA DE 40 KGS.', 7.60, 6.73, 0.87, 7.60, 0.00, 7, 'Erick', 1, 'b116606440', 1592059324, 10);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cotizaciones_data`
--

CREATE TABLE `cotizaciones_data` (
  `id` int(6) NOT NULL,
  `cliente` varchar(12) NOT NULL,
  `correlativo` int(5) NOT NULL,
  `fecha` varchar(20) NOT NULL,
  `hora` varchar(20) NOT NULL,
  `fechaF` varchar(20) NOT NULL,
  `caduca` varchar(20) NOT NULL,
  `caducaF` varchar(20) NOT NULL,
  `edo` int(11) NOT NULL COMMENT '1 activ0, 2 guardada',
  `hash` varchar(12) NOT NULL,
  `time` int(12) NOT NULL,
  `td` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `cotizaciones_data`
--

INSERT INTO `cotizaciones_data` (`id`, `cliente`, `correlativo`, `fecha`, `hora`, `fechaF`, `caduca`, `caducaF`, `edo`, `hash`, `time`, `td`) VALUES
(8, '461904b806', 3, '20-03-2020', '17:54:04', '1584684000', '04-04-2020', '1585980000', 2, '71576f2984', 1584748491, 10),
(10, '461904b806', 4, '20-03-2020', '18:57:00', '1584684000', '04-04-2020', '1585980000', 2, '2b17a156e9', 1584752245, 10),
(11, '4d2344fe9e', 5, '20-03-2020', '18:57:47', '1584684000', '04-04-2020', '1585980000', 2, '97f8b5c8e9', 1591708246, 10),
(12, '9811234b6f', 1, '20-03-2020', '19:00:18', '1584684000', '04-04-2020', '1585980000', 2, '3709a34ecd', 1584752465, 11),
(13, '461904b806', 6, '09-06-2020', '07:18:07', '1591682400', '24-06-2020', '1592978400', 2, 'a44bfce2c1', 1591708715, 10),
(14, '4d2344fe9e', 7, '13-06-2020', '08:41:53', '1592028000', '13-07-2020', '1594620000', 2, '67bed5c5c6', 1592059332, 10);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `creditos`
--

CREATE TABLE `creditos` (
  `id` int(6) NOT NULL,
  `hash_cliente` varchar(12) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `factura` int(6) NOT NULL,
  `orden` int(6) NOT NULL,
  `fecha` varchar(30) NOT NULL,
  `hora` varchar(30) NOT NULL,
  `tx` int(6) NOT NULL,
  `edo` int(2) NOT NULL COMMENT '0, eliminado 1 activo, 2 pagado',
  `hash` varchar(12) NOT NULL,
  `time` int(12) NOT NULL,
  `td` int(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `creditos`
--

INSERT INTO `creditos` (`id`, `hash_cliente`, `nombre`, `factura`, `orden`, `fecha`, `hora`, `tx`, `edo`, `hash`, `time`, `td`) VALUES
(1, '9811234b6f', 'JUAN PEREZ', 8, 8, '01-03-2020', '17:07:03', 1, 2, '8efb226e9f', 1583542266, 11),
(2, '73e0d7c3ff', 'CARLOS LOPEZ', 9, 9, '01-03-2020', '17:07:31', 1, 2, 'b9059d125a', 1583279217, 11),
(3, '9811234b6f', 'JUAN PEREZ', 0, 5, '01-03-2020', '17:13:52', 1, 2, '19a6739b74', 1583104495, 10),
(4, '461904b806', 'JUAN HERNANDEZ', 5, 5, '01-03-2020', '17:14:00', 1, 2, '8658737798', 1583719413, 10),
(5, '4d2344fe9e', 'JUAN PEREZ', 7, 7, '01-03-2020', '17:20:14', 1, 2, 'c4819a6516', 1583719442, 10),
(6, '461904b806', 'JUAN HERNANDEZ', 15, 15, '03-03-2020', '17:59:34', 1, 2, '4d227b1b61', 1583719430, 10),
(7, '9811234b6f', 'JUAN PEREZ', 23, 23, '04-03-2020', '18:23:11', 1, 2, '3bff3e7071', 1583889145, 11),
(8, '9811234b6f', 'JUAN PEREZ', 65, 65, '12-03-2020', '19:26:32', 1, 2, '4290443283', 1584582661, 11),
(9, '73e0d7c3ff', 'CARLOS LOPEZ', 92, 91, '18-03-2020', '19:50:23', 1, 1, 'aa576bda01', 1584582633, 11),
(10, '461904b806', 'JUAN HERNANDEZ', 32, 32, '06-03-2020', '19:56:53', 1, 1, '298c2dea30', 1583546219, 10);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `creditos_abonos`
--

CREATE TABLE `creditos_abonos` (
  `id` int(6) NOT NULL,
  `credito` varchar(12) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `abono` float(10,2) NOT NULL,
  `user` varchar(100) NOT NULL,
  `fecha` varchar(25) NOT NULL,
  `hora` varchar(25) NOT NULL,
  `user_del` varchar(100) NOT NULL,
  `hora_del` varchar(50) NOT NULL,
  `edo` int(2) NOT NULL COMMENT '1activo 2 borrado',
  `hash` varchar(12) NOT NULL,
  `time` int(12) NOT NULL,
  `td` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `creditos_abonos`
--

INSERT INTO `creditos_abonos` (`id`, `credito`, `nombre`, `abono`, `user`, `fecha`, `hora`, `user_del`, `hora_del`, `edo`, `hash`, `time`, `td`) VALUES
(1, 'b9059d125a', 'CARLOS LOPEZ', 5.00, 'a9166cd5465a89b70f144e4cb4700a5054f4d2cb', '01-03-2020', '17:07:52', '', '', 1, '1ca4c6cea1', 1583104072, 11),
(2, '8efb226e9f', 'JUAN PEREZ', 11.00, 'a9166cd5465a89b70f144e4cb4700a5054f4d2cb', '01-03-2020', '17:08:14', '', '', 1, '64f61ba06f', 1583104094, 11),
(3, '19a6739b74', 'JUAN PEREZ', 0.00, '1321247b13afc962352b12dc3545ba06c206afdf', '01-03-2020', '17:14:55', '', '', 1, 'b02a6f4a60', 1583104495, 10),
(4, 'c4819a6516', 'JUAN PEREZ', 9.80, '1321247b13afc962352b12dc3545ba06c206afdf', '01-03-2020', '17:20:41', '', '', 1, 'ac5c5cc6d9', 1583104841, 10),
(5, 'b9059d125a', 'CARLOS LOPEZ', 4.67, '3c67697e18899300a2648199a9798dffb359cab2', '03-03-2020', '17:46:57', '', '', 1, 'b7ed22e787', 1583279217, 11),
(6, '4d227b1b61', 'JUAN HERNANDEZ', 20.00, '3c67697e18899300a2648199a9798dffb359cab2', '03-03-2020', '18:00:00', '', '', 1, '0a27c112ea', 1583280000, 10),
(7, '3bff3e7071', 'JUAN PEREZ', 10.00, '3c67697e18899300a2648199a9798dffb359cab2', '04-03-2020', '18:23:58', '3c67697e18899300a2648199a9798dffb359cab2', '18:24:01', 2, 'cb69a97635', 1583367841, 11),
(8, '3bff3e7071', 'JUAN PEREZ', 15.00, '3c67697e18899300a2648199a9798dffb359cab2', '04-03-2020', '18:24:06', '', '', 1, 'e03bed4ed0', 1583367846, 11),
(9, '8efb226e9f', 'JUAN PEREZ', 5.27, '3c67697e18899300a2648199a9798dffb359cab2', '05-03-2020', '18:40:39', '', '', 1, '6be18f6aa4', 1583455239, 11),
(10, '8efb226e9f', 'JUAN PEREZ', 5.00, '3c67697e18899300a2648199a9798dffb359cab2', '06-03-2020', '18:50:27', '3c67697e18899300a2648199a9798dffb359cab2', '18:50:46', 2, '98c558b6cc', 1583542246, 11),
(11, '8efb226e9f', 'JUAN PEREZ', 5.00, '3c67697e18899300a2648199a9798dffb359cab2', '06-03-2020', '18:51:06', '', '', 1, '4e83951106', 1583542266, 11),
(12, '3bff3e7071', 'JUAN PEREZ', 4.07, '3c67697e18899300a2648199a9798dffb359cab2', '10-03-2020', '19:12:25', '', '', 1, '1ad471e6cd', 1583889145, 11),
(13, '4290443283', 'JUAN PEREZ', 20.00, '3c67697e18899300a2648199a9798dffb359cab2', '12-03-2020', '19:27:04', '3c67697e18899300a2648199a9798dffb359cab2', '19:27:06', 2, 'df87af7852', 1584062827, 11),
(14, '4290443283', 'JUAN PEREZ', 20.00, '3c67697e18899300a2648199a9798dffb359cab2', '12-03-2020', '19:27:10', '', '', 1, '026ef82c7d', 1584062830, 11),
(15, '4290443283', 'JUAN PEREZ', 15.00, '3c67697e18899300a2648199a9798dffb359cab2', '13-03-2020', '19:37:57', '', '', 1, '75e95e9972', 1584149877, 11),
(16, '4290443283', 'JUAN PEREZ', 10.40, '3c67697e18899300a2648199a9798dffb359cab2', '18-03-2020', '19:50:55', '3c67697e18899300a2648199a9798dffb359cab2', '19:50:57', 2, '35aa773bca', 1584582658, 11),
(17, '4290443283', 'JUAN PEREZ', 10.40, '3c67697e18899300a2648199a9798dffb359cab2', '18-03-2020', '19:51:01', '', '', 1, '0f39573b2e', 1584582661, 11),
(18, '8658737798', 'JUAN HERNANDEZ', 30.00, '3c67697e18899300a2648199a9798dffb359cab2', '06-03-2020', '19:57:32', '3c67697e18899300a2648199a9798dffb359cab2', '19:57:37', 2, 'a5ab7f2d0a', 1583546257, 10),
(19, '8658737798', 'JUAN HERNANDEZ', 20.00, '3c67697e18899300a2648199a9798dffb359cab2', '06-03-2020', '19:57:40', '', '', 1, '97eb025a5b', 1583546260, 10),
(20, 'c4819a6516', 'JUAN PEREZ', 9.80, '3c67697e18899300a2648199a9798dffb359cab2', '06-03-2020', '19:57:51', '3c67697e18899300a2648199a9798dffb359cab2', '19:58:15', 2, 'a62509ace0', 1583546295, 10),
(21, 'c4819a6516', 'JUAN PEREZ', 40.00, '3c67697e18899300a2648199a9798dffb359cab2', '06-03-2020', '19:58:21', '', '', 1, '91abc7efa5', 1583546301, 10),
(22, '8658737798', 'JUAN HERNANDEZ', 47.60, '3c67697e18899300a2648199a9798dffb359cab2', '08-03-2020', '20:03:33', '', '', 1, '92f358662e', 1583719413, 10),
(23, '4d227b1b61', 'JUAN HERNANDEZ', 20.00, '3c67697e18899300a2648199a9798dffb359cab2', '08-03-2020', '20:03:44', '', '', 1, 'e468f47cdf', 1583719424, 10),
(24, '4d227b1b61', 'JUAN HERNANDEZ', 43.30, '3c67697e18899300a2648199a9798dffb359cab2', '08-03-2020', '20:03:50', '', '', 1, '8cf54c50c1', 1583719430, 10),
(25, 'c4819a6516', 'JUAN PEREZ', 50.00, '3c67697e18899300a2648199a9798dffb359cab2', '08-03-2020', '20:04:02', '', '', 1, '98169de229', 1583719442, 10),
(26, '298c2dea30', 'JUAN HERNANDEZ', 50.00, '3c67697e18899300a2648199a9798dffb359cab2', '13-03-2020', '20:11:36', '', '', 1, '76550664f0', 1584151896, 10),
(27, '298c2dea30', 'JUAN HERNANDEZ', 30.00, '3c67697e18899300a2648199a9798dffb359cab2', '18-03-2020', '20:18:01', '', '', 1, '4ffea1ff6a', 1584584281, 10);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `entradas_efectivo`
--

CREATE TABLE `entradas_efectivo` (
  `id` int(6) NOT NULL,
  `descripcion` text NOT NULL,
  `cantidad` float(10,2) NOT NULL,
  `fecha` varchar(30) NOT NULL,
  `fechaF` varchar(30) NOT NULL,
  `hora` varchar(20) NOT NULL,
  `user` varchar(100) NOT NULL,
  `edo` int(2) NOT NULL,
  `hash` varchar(12) NOT NULL,
  `time` int(12) NOT NULL,
  `td` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `entradas_efectivo`
--

INSERT INTO `entradas_efectivo` (`id`, `descripcion`, `cantidad`, `fecha`, `fechaF`, `hora`, `user`, `edo`, `hash`, `time`, `td`) VALUES
(1, 'Para pago del recibo de Energia', 90.00, '03-03-2020', '1583215200', '18:00:31', '3c67697e18899300a2648199a9798dffb359cab2', 1, 'dd4ba40d5e', 1583280031, 10);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `facturar_documento`
--

CREATE TABLE `facturar_documento` (
  `id` int(6) NOT NULL,
  `documento` varchar(100) NOT NULL,
  `cliente` varchar(100) NOT NULL,
  `hash` varchar(12) NOT NULL,
  `time` int(12) NOT NULL,
  `td` int(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `facturar_documento_factura`
--

CREATE TABLE `facturar_documento_factura` (
  `id` int(6) NOT NULL,
  `factura` int(6) NOT NULL,
  `documento` varchar(100) NOT NULL,
  `cliente` varchar(100) NOT NULL,
  `hash` varchar(12) NOT NULL,
  `time` int(12) NOT NULL,
  `td` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `gastos`
--

CREATE TABLE `gastos` (
  `id` int(6) NOT NULL,
  `tipo` int(2) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `descripcion` varchar(100) NOT NULL,
  `cantidad` float(10,2) NOT NULL,
  `fecha` varchar(30) NOT NULL,
  `fechaF` varchar(30) NOT NULL,
  `hora` varchar(20) NOT NULL,
  `user` varchar(100) NOT NULL,
  `edo` int(2) NOT NULL,
  `hash` varchar(12) NOT NULL,
  `time` int(12) NOT NULL,
  `td` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `gastos`
--

INSERT INTO `gastos` (`id`, `tipo`, `nombre`, `descripcion`, `cantidad`, `fecha`, `fechaF`, `hora`, `user`, `edo`, `hash`, `time`, `td`) VALUES
(1, 1, 'Compra de Material de limpieza', 'Se compro desinfectante y lejia', 6.20, '01-03-2020', '1583042400', '17:09:05', 'a9166cd5465a89b70f144e4cb4700a5054f4d2cb', 1, 'deb8a59c94', 1583104145, 11),
(2, 1, 'Compra de Trapiador', '3 trapeadores para la sala', 2.50, '01-03-2020', '1583042400', '17:09:43', 'a9166cd5465a89b70f144e4cb4700a5054f4d2cb', 1, '265d13f807', 1583104183, 11),
(3, 2, 'Material de limpieza', 'Compra de desinfectante y lejia', 4.50, '02-03-2020', '1583128800', '17:24:53', '3c67697e18899300a2648199a9798dffb359cab2', 1, 'a260879998', 1583191493, 10),
(4, 2, 'Compra de candado', 'Candado para puerta trasera', 7.26, '02-03-2020', '1583128800', '17:25:59', '3c67697e18899300a2648199a9798dffb359cab2', 1, '163087971d', 1583191559, 10),
(5, 2, 'Compra de lapiz', 'Compra de lapices para oficina', 2.46, '02-03-2020', '1583128800', '17:33:17', '3c67697e18899300a2648199a9798dffb359cab2', 1, 'cd82bc9e5d', 1583191997, 11),
(6, 2, 'Pago de Luz', 'Pago del recibo de luz del mes de marzo', 84.10, '03-03-2020', '1583215200', '17:47:52', '3c67697e18899300a2648199a9798dffb359cab2', 1, 'b09f5a83fc', 1583279272, 11),
(7, 2, 'Energia', 'Para pago de energia electrica del mes de marzo', 91.15, '03-03-2020', '1583215200', '18:00:58', '3c67697e18899300a2648199a9798dffb359cab2', 1, 'f5bf7497a7', 1583280058, 10),
(8, 2, 'Compra de libros', 'Libros para apuntes de oficina', 15.20, '04-03-2020', '1583301600', '18:25:12', '3c67697e18899300a2648199a9798dffb359cab2', 1, '8318bc8fde', 1583367912, 11),
(9, 3, 'Banco', 'Remesa para el banco Agricola', 450.00, '04-03-2020', '1583301600', '18:32:19', '3c67697e18899300a2648199a9798dffb359cab2', 1, '82a939bdbb', 1583368339, 10),
(10, 2, 'Compra de Material de oficina', 'Compra de materia de oficina, lapices, cuadernos', 15.20, '06-03-2020', '1583474400', '18:51:53', '3c67697e18899300a2648199a9798dffb359cab2', 1, 'bf566d14f6', 1583542313, 11),
(11, 3, 'Remesa', 'Remesa banco Agricola', 500.00, '07-03-2020', '1583560800', '19:02:32', '3c67697e18899300a2648199a9798dffb359cab2', 1, '8497a834c8', 1583629352, 11),
(12, 2, 'Papel ', 'Compra de papel para impresora', 15.80, '09-03-2020', '1583733600', '19:08:16', '3c67697e18899300a2648199a9798dffb359cab2', 1, '1214913509', 1583802496, 11),
(13, 3, 'Banco', 'Remesa al banco Agricola', 568.27, '10-03-2020', '1583820000', '19:11:38', '3c67697e18899300a2648199a9798dffb359cab2', 1, '21b1171c36', 1583889098, 11),
(14, 1, 'Pago Agua', 'Compra de agua para los empleados', 22.40, '11-03-2020', '1583906400', '19:15:39', '3c67697e18899300a2648199a9798dffb359cab2', 1, '6a2fce8ed8', 1583975739, 11),
(15, 2, 'Baterias', 'Compra de baterias para los controles', 1.20, '12-03-2020', '1583992800', '19:27:41', '3c67697e18899300a2648199a9798dffb359cab2', 1, '5c35f44c55', 1584062861, 11),
(16, 3, 'Banco', 'Remesa Banco Agricola', 350.00, '14-03-2020', '1584165600', '19:41:13', '3c67697e18899300a2648199a9798dffb359cab2', 1, 'ea6b339d45', 1584236473, 11),
(17, 2, 'Telefono', 'Pago de telefono del mes de marzo', 38.40, '17-03-2020', '1584424800', '19:47:41', '3c67697e18899300a2648199a9798dffb359cab2', 1, '801674f9a1', 1584496061, 11),
(18, 3, 'Banco', 'Remesa al banco Agricola', 400.00, '17-03-2020', '1584424800', '19:48:15', '3c67697e18899300a2648199a9798dffb359cab2', 1, '7deab77fa2', 1584496095, 11),
(19, 1, 'Compra', 'Compra de desinfectante para piso', 5.00, '18-03-2020', '1584511200', '19:52:12', '3c67697e18899300a2648199a9798dffb359cab2', 1, 'e06516397e', 1584582732, 11),
(20, 3, 'Banco', 'Remes a banco Agricola', 200.00, '06-03-2020', '1583474400', '19:58:58', '3c67697e18899300a2648199a9798dffb359cab2', 1, 'f51fb9bfb6', 1583546338, 10),
(21, 2, 'Papeleria', 'Compra de papeleria ', 20.00, '07-03-2020', '1583560800', '20:02:30', '3c67697e18899300a2648199a9798dffb359cab2', 1, 'b3562819fa', 1583632950, 10),
(22, 3, 'Banco', 'Remesa a banco agricola', 1500.00, '09-03-2020', '1583733600', '20:05:51', '3c67697e18899300a2648199a9798dffb359cab2', 1, 'aeea4f03c4', 1583805951, 10),
(23, 3, 'Banco', 'Remesa a banco Agricola', 500.00, '12-03-2020', '1583992800', '20:10:20', '3c67697e18899300a2648199a9798dffb359cab2', 1, '45daec7740', 1584065420, 10),
(24, 3, 'Banco', 'Remesa a  Baanco Agricola', 1000.00, '14-03-2020', '1584165600', '20:12:48', '3c67697e18899300a2648199a9798dffb359cab2', 1, '248db749cf', 1584238368, 10),
(25, 1, 'papel', 'Compra de papel para impresora', 5.20, '17-03-2020', '1584424800', '20:16:24', '3c67697e18899300a2648199a9798dffb359cab2', 1, '680ee1942b', 1584497784, 10),
(26, 3, 'Banco', 'Remesa a banco Agricola', 1500.00, '18-03-2020', '1584511200', '20:18:31', '3c67697e18899300a2648199a9798dffb359cab2', 1, '1a18d93184', 1584584311, 10),
(27, 2, 'Tinta', 'Tinta para impresora', 20.40, '18-03-2020', '1584511200', '20:18:49', '3c67697e18899300a2648199a9798dffb359cab2', 1, '847d8dba93', 1584584329, 10),
(28, 5, 'Compra de Material', 'Compra de material para la remodela cion', 1250.00, '18-03-2020', '1584511200', '20:19:13', '3c67697e18899300a2648199a9798dffb359cab2', 1, '7b23ccc00a', 1584584353, 10),
(37, 4, 'Adelanto', 'Adelanto a ERICK NUNEZ', 10.00, '27-05-2020', '1590559200', '23:47:52', 'Erick', 0, 'bd69825b50', 1590644884, 10),
(38, 4, 'Adelanto', 'Adelanto a ERICK NUNEZ', 10.00, '27-05-2020', '1590559200', '23:53:38', 'Erick', 1, 'a3efccdc1d', 1590645218, 10),
(39, 2, 'Compra de sal', '30 libras de sal para cocina', 15.00, '09-06-2020', '1591682400', '04:29:04', 'Erick', 0, '5217cb499f', 1591698592, 10),
(40, 1, 'Compra de sal', 'Compra de sal para cocina', 15.20, '09-06-2020', '1591682400', '04:32:56', 'Erick', 1, 'fbcc934a96', 1591698776, 10);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `gastos_images`
--

CREATE TABLE `gastos_images` (
  `id` int(6) NOT NULL,
  `gasto` int(5) NOT NULL,
  `imagen` varchar(100) NOT NULL,
  `descripcion` varchar(100) NOT NULL,
  `fecha` varchar(30) NOT NULL,
  `fechaF` varchar(30) NOT NULL,
  `hora` varchar(30) NOT NULL,
  `hash` varchar(12) NOT NULL,
  `time` int(12) NOT NULL,
  `td` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `gastos_images`
--

INSERT INTO `gastos_images` (`id`, `gasto`, `imagen`, `descripcion`, `fecha`, `fechaF`, `hora`, `hash`, `time`, `td`) VALUES
(2, 40, '1591698784-10.png', '', '09-06-2020', '1591682400', '04:33:07', '9bd5bb75ee', 1591698787, 10);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `login_attempts`
--

CREATE TABLE `login_attempts` (
  `user_id` int(11) NOT NULL,
  `time` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `login_attempts`
--

INSERT INTO `login_attempts` (`user_id`, `time`) VALUES
(3, '1584729789'),
(4, '1584731699'),
(3, '1590483805'),
(3, '1590483813'),
(3, '1590645763'),
(3, '1591292833'),
(3, '1591725239'),
(3, '1591725242'),
(3, '1591725595');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `login_db_sync`
--

CREATE TABLE `login_db_sync` (
  `id` int(6) NOT NULL,
  `hash` varchar(100) NOT NULL,
  `fecha` varchar(30) NOT NULL,
  `hora` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Lleva el control de los cambios en las bases de datos locales';

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `login_db_user`
--

CREATE TABLE `login_db_user` (
  `id` int(6) NOT NULL,
  `hash` varchar(100) NOT NULL,
  `td` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `login_inout`
--

CREATE TABLE `login_inout` (
  `id` int(6) NOT NULL,
  `user` varchar(100) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `accion` int(2) NOT NULL,
  `ip` varchar(50) NOT NULL,
  `navegador` varchar(250) NOT NULL,
  `fecha` varchar(30) NOT NULL,
  `fechaF` varchar(30) NOT NULL,
  `hora` varchar(30) NOT NULL,
  `td` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `login_members`
--

CREATE TABLE `login_members` (
  `id` int(11) NOT NULL,
  `username` varchar(30) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` char(128) NOT NULL,
  `salt` char(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `login_members`
--

INSERT INTO `login_members` (`id`, `username`, `email`, `password`, `salt`) VALUES
(1, 'Erick', 'aerick.nunez@gmail.com', '50236c59c304c8b5c2f6b5c1af94f4416d998e3ba3fd2fc5a795f740431c35e9bbd9d4439a3dad8a182173b14291a308e4716458278fc228ad7c8f9930d9547e', '5f1e8cce7a67bf3282acf41dee11c7c784b5c8b6687bc4a10b3a81e2af81f186402d4f19e545b62e474f308f9dbc142eb3c66c6033b264cd0e1ffe1209cdf57d'),
(3, 'db2625', 'abarrotes@pizto.com', 'cbe63f9a2905f07c5e7eee57a063dfb7dc375c570aa1430ea46fe534a831763c73985df3eaf7fb2dd266b106739eb74ba81c659d0fdf46fcd007394d942cf690', '8251d03b00004a87aa90fa276fab8140a6ffa84bec6ab88132fd474cc6a2eae8f42b46e517ee22d19f950553aaba774aa98f374bb9b2aa5e3645192ee4779abc'),
(4, '6f129e', 'ferreteria@pizto.com', '35c84227380b306f0c75d874316a06090c1418ea86c97ac3830d41c456759879dea31cc4d39e680215534e15438925304c2f8c5a2a8204bfad4b40321da445ec', 'f6ad1faa4e63f5b4f1cf0266db07892cb92aa63f1cb4e9a73bd3cf8507fe35d14e13cfacb7c145c7c298245afb55df23f0694218f78ca85cc2600de5c9db05a9');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `login_sucursales`
--

CREATE TABLE `login_sucursales` (
  `id` int(5) NOT NULL,
  `user` varchar(50) NOT NULL,
  `sucursal` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `login_sync`
--

CREATE TABLE `login_sync` (
  `id` int(6) NOT NULL,
  `hash` varchar(100) NOT NULL,
  `tipo` int(2) NOT NULL,
  `edo` int(2) NOT NULL,
  `fecha` varchar(30) NOT NULL,
  `hora` varchar(30) NOT NULL,
  `td` int(3) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COMMENT='Controla en remoto si se subio sql respaldo';

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `login_userdata`
--

CREATE TABLE `login_userdata` (
  `id` int(6) NOT NULL,
  `nombre` varchar(200) NOT NULL,
  `tipo` int(2) NOT NULL COMMENT '1, root , 2 admin, 3 usuario',
  `user` varchar(100) NOT NULL,
  `tkn` varchar(200) NOT NULL,
  `avatar` varchar(50) NOT NULL,
  `td` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `login_userdata`
--

INSERT INTO `login_userdata` (`id`, `nombre`, `tipo`, `user`, `tkn`, `avatar`, `td`) VALUES
(1, 'Erick Nunez', 1, 'Erick', '1', '11.png', 10),
(3, 'Abarrotes Admin', 5, 'db2625', '1', '11.png', 11),
(4, 'Admin Ferreteria', 2, '6f129e', '1', 'neagan.jpg', 10);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `planilla_descuentos`
--

CREATE TABLE `planilla_descuentos` (
  `id` int(5) NOT NULL,
  `descuento` varchar(50) NOT NULL,
  `porcentaje` float(10,2) NOT NULL,
  `hash` varchar(12) NOT NULL,
  `time` int(12) NOT NULL,
  `td` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='descuentos que se pueden establecer a cada empleado';

--
-- Volcado de datos para la tabla `planilla_descuentos`
--

INSERT INTO `planilla_descuentos` (`id`, `descuento`, `porcentaje`, `hash`, `time`, `td`) VALUES
(1, 'Descuento ISSS', 5.00, '829d8770a8', 1590637113, 10);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `planilla_descuentos_asig`
--

CREATE TABLE `planilla_descuentos_asig` (
  `id` int(5) NOT NULL,
  `descuento` varchar(12) NOT NULL,
  `empleado` varchar(12) NOT NULL,
  `hash` varchar(12) NOT NULL,
  `time` int(12) NOT NULL,
  `td` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Empleados que se le han asignado un descuento';

--
-- Volcado de datos para la tabla `planilla_descuentos_asig`
--

INSERT INTO `planilla_descuentos_asig` (`id`, `descuento`, `empleado`, `hash`, `time`, `td`) VALUES
(1, '829d8770a8', '8742933e1c', '9925f14091', 1590637119, 10),
(2, '829d8770a8', '7f919596f8', '54db61b184', 1590637122, 10);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `planilla_empleados`
--

CREATE TABLE `planilla_empleados` (
  `id` int(6) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `puesto` varchar(30) NOT NULL,
  `documento` varchar(25) NOT NULL,
  `nit` varchar(25) NOT NULL,
  `direccion` varchar(50) NOT NULL,
  `telefono` varchar(25) NOT NULL,
  `sueldo` float(10,2) NOT NULL COMMENT 'sueldo por 30 dias',
  `entradas` varchar(2) NOT NULL,
  `extra` varchar(2) NOT NULL,
  `nocturnas` varchar(2) NOT NULL,
  `comentarios` varchar(200) NOT NULL,
  `edo` int(1) NOT NULL COMMENT '1 activo. 2 desactivado, 3 eliminado',
  `hash` varchar(12) NOT NULL,
  `time` int(12) NOT NULL,
  `td` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='registra los empleados del negocio';

--
-- Volcado de datos para la tabla `planilla_empleados`
--

INSERT INTO `planilla_empleados` (`id`, `nombre`, `puesto`, `documento`, `nit`, `direccion`, `telefono`, `sueldo`, `entradas`, `extra`, `nocturnas`, `comentarios`, `edo`, `hash`, `time`, `td`) VALUES
(1, 'ERICK NUNEZ', 'Gerente', '03547604-0', '0207-210386-1029', 'Las americas', '60623882', 500.00, '', '', '', '', 0, '8742933e1c', 1590636974, 10),
(2, 'JAZMIN NUNEZ', 'Empleado', '03659865-4', '02569859-1029', 'Las Americas', '20154854', 320.00, '', '', '', '', 0, '7f919596f8', 1590637013, 10);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `planilla_extras`
--

CREATE TABLE `planilla_extras` (
  `id` int(5) NOT NULL,
  `empleado` varchar(12) NOT NULL,
  `extra` varchar(100) NOT NULL COMMENT 'extra 1, adelanto 2, descuentos 3',
  `cantidad` float(10,2) NOT NULL,
  `tipo` int(2) NOT NULL,
  `fecha` varchar(20) NOT NULL,
  `hora` varchar(20) NOT NULL,
  `fechaF` varchar(20) NOT NULL,
  `hash` varchar(12) NOT NULL,
  `time` int(12) NOT NULL,
  `td` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='extras -  adelantos, descuentos o extras';

--
-- Volcado de datos para la tabla `planilla_extras`
--

INSERT INTO `planilla_extras` (`id`, `empleado`, `extra`, `cantidad`, `tipo`, `fecha`, `hora`, `fechaF`, `hash`, `time`, `td`) VALUES
(15, '8742933e1c', 'Adelanto', 10.00, 2, '27-05-2020', '23:53:37', '1590559200', '48f64ee9a5', 1590645217, 10),
(16, '8742933e1c', 'Descuento ISSS', 12.50, 3, '04-06-2020', '12:54:20', '1591250400', '15529cac5b', 1591296860, 10),
(17, '7f919596f8', 'Descuento ISSS', 8.00, 3, '04-06-2020', '12:54:28', '1591250400', '5a41cf5849', 1591296868, 10);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `planilla_pagos`
--

CREATE TABLE `planilla_pagos` (
  `id` int(5) NOT NULL,
  `empleado` varchar(12) NOT NULL,
  `fecha_inicio` varchar(20) NOT NULL,
  `fecha_fin` varchar(20) NOT NULL,
  `inicioF` int(20) NOT NULL,
  `finF` varchar(20) NOT NULL,
  `dias` int(20) NOT NULL,
  `sueldo` float(10,2) NOT NULL,
  `extras` float(10,2) NOT NULL,
  `descuentos` float(10,2) NOT NULL,
  `liquido` float(10,2) NOT NULL,
  `hash` varchar(12) NOT NULL,
  `time` int(12) NOT NULL,
  `td` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='control de las planillas generadas';

--
-- Volcado de datos para la tabla `planilla_pagos`
--

INSERT INTO `planilla_pagos` (`id`, `empleado`, `fecha_inicio`, `fecha_fin`, `inicioF`, `finF`, `dias`, `sueldo`, `extras`, `descuentos`, `liquido`, `hash`, `time`, `td`) VALUES
(1, '8742933e1c', '16-05-2020', '31-05-2020', 1589608800, '1590904800', 16, 266.67, 15.00, 23.33, 258.34, 'd20f849494', 1590642552, 10),
(2, '8742933e1c', '01-06-2020', '15-06-2020', 1590991200, '1592200800', 15, 250.00, 0.00, 12.50, 237.50, '5f4c8938fd', 1591296860, 10),
(3, '7f919596f8', '01-06-2020', '15-06-2020', 1590991200, '1592200800', 15, 160.00, 0.00, 8.00, 152.00, '4a5350a2b5', 1591296868, 10);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto`
--

CREATE TABLE `producto` (
  `id` int(6) NOT NULL,
  `cod` varchar(25) NOT NULL,
  `descripcion` varchar(200) NOT NULL,
  `categoria` varchar(12) NOT NULL,
  `cantidad` float(10,2) NOT NULL,
  `medida` varchar(30) NOT NULL,
  `proveedor` varchar(12) NOT NULL,
  `informacion` varchar(250) NOT NULL,
  `existencia_minima` float(10,2) NOT NULL,
  `caduca` varchar(5) NOT NULL COMMENT 'si tiene fecha de caducidad  si = 1 , no = 0',
  `compuesto` varchar(5) NOT NULL COMMENT 'si es un producto compuesto por otros productos  si = 1 , no = 0',
  `gravado` varchar(5) NOT NULL COMMENT 'gravado = 1, exento = 0',
  `receta` varchar(5) NOT NULL,
  `dependiente` varchar(5) NOT NULL COMMENT 'si depende de otro producto, una fraccion. si = 1 , no = 0',
  `servicio` varchar(5) NOT NULL COMMENT 'si es servicio o no para descontarlo',
  `hash` varchar(12) NOT NULL,
  `time` int(12) NOT NULL,
  `td` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Productos disponibles al publico';

--
-- Volcado de datos para la tabla `producto`
--

INSERT INTO `producto` (`id`, `cod`, `descripcion`, `categoria`, `cantidad`, `medida`, `proveedor`, `informacion`, `existencia_minima`, `caduca`, `compuesto`, `gravado`, `receta`, `dependiente`, `servicio`, `hash`, `time`, `td`) VALUES
(1, '1001', 'ABRAZADERA STRUT 1/2 TOPAZ', 'f42d664196', 248.00, 'c3254c9416', '162550f47d', '', 10.00, '0', '0', 'on', '0', '0', '0', 'c07a933eed', 1591707673, 10),
(2, '1002', 'CEMENTO BLANCO, BOLSA DE 42.5 KGS.', 'f42d664196', 307.00, '93b81b44cb', '162550f47d', '', 10.00, '0', '0', 'on', '0', '0', '0', 'f62197dd5b', 1591710990, 10),
(3, '1003', 'CEMENTO BLANCO, BOLSA DE 42.5 KGS.', 'f42d664196', 243.00, '93b81b44cb', '6da060c351', '', 20.00, '0', '0', 'on', '0', '0', '0', 'c88923f2d3', 1591708295, 10),
(4, '1004', 'CEMENTO GRIS CUSCATLáN, BOLSA DE 42.5 KGS', 'f42d664196', 214.00, '93b81b44cb', '6da060c351', '', 20.00, '0', '0', 'on', '0', '0', '0', '1c32d0e43d', 1591708295, 10),
(5, '1005', 'DECOBLOCK BLANCO HUESO GRANO MEDIO, BOLSA DE 40 KGS.', 'f42d664196', 243.00, '93b81b44cb', '162550f47d', '', 20.00, '0', '0', 'on', '0', '0', '0', 'e20e1f23c8', 1584751732, 10),
(6, '1006', 'DECOBLOCK GRIS GRANO FINO, BOLSA DE 40 KGS.', 'f42d664196', 240.00, '93b81b44cb', '162550f47d', '', 20.00, '0', '0', 'on', '0', '0', '0', '23f40f7a4c', 1588973395, 10),
(7, '1007', 'LIMPIADOR DE CONTACTOS SECADO RáPIDO', 'adf83d083b', 230.00, 'c3254c9416', '162550f47d', '', 20.00, '0', '0', 'on', '0', '0', '0', '3dd1002f6b', 1584654376, 10),
(8, '1008', 'NAVAJA PARA ELECTRICISTA', 'adf83d083b', 17.00, 'c3254c9416', '162550f47d', '', 10.00, '0', '0', 'on', '0', '0', '0', '3930c1b9ab', 1584654358, 10),
(9, '1009', 'TENAZA MULTIUSO 16 EN 1 CON ESTUCHE Y LUZ LED', 'adf83d083b', 34.00, 'c3254c9416', '162550f47d', '', 10.00, '0', '0', 'on', '0', '0', '0', 'f724519abe', 1584411281, 10),
(10, '1010', 'CAJA PARA HERRAMIENTAS PLáSTICA DE 12PLG', 'adf83d083b', 5.00, 'c3254c9416', '162550f47d', '', 5.00, '0', '0', 'on', '0', '0', '0', '125a435efe', 1591708295, 10),
(11, '1011', 'CAJA PARA HERRAMIENTAS PLáSTICA DE 26PLG', 'adf83d083b', 8.00, 'c3254c9416', '162550f47d', 'Ideal para el almacenamiento de artículos y accesorios de trabajo, material de alta resistencia y durabilidad prolongada.', 5.00, '0', '0', 'on', '0', '0', '0', 'a7d350ce89', 1591708295, 10),
(12, '1012', 'JUEGO DE LLAVES MIXTAS 6-19 MM, SET 9 PZS', 'adf83d083b', 18.00, 'c3254c9416', '162550f47d', 'Juego de llaves adecuadas para mantenimiento y reparaciones, fabricadas en material de alta resistencia a la tensión.', 10.00, '0', '0', 'on', '0', '0', '0', '9628da07ea', 1584751941, 10),
(13, '1013', 'FOCO ESMERILADO DE 40 WATTS', 'adf83d083b', 46.00, 'c3254c9416', '162550f47d', '', 20.00, '0', '0', 'on', '0', '0', '0', '8b05c85074', 1591708295, 10),
(14, '1014', 'FOCO CLARO GE 60W-130V 24651/3', 'adf83d083b', 51.00, 'c3254c9416', '162550f47d', '', 20.00, '0', '0', 'on', '0', '0', '0', '365d446876', 1590501185, 10),
(15, '1015', 'ACE - LáMPARA DE PARED LED 20W, LUZ BLANCA.', 'adf83d083b', 19.00, 'c3254c9416', '162550f47d', '', 10.00, '0', '0', 'on', '0', '0', '0', 'cef2ed0eee', 1583632875, 10),
(16, '1016', 'EXTENSIóN PARA MECáNICO DE 50', 'adf83d083b', 10.00, 'c3254c9416', '162550f47d', '', 2.00, '0', '0', 'on', '0', '0', '0', '7ddff06de5', 1583368170, 10),
(17, '1017', 'EXTENSIóN ELéCTRICA DE 15 MTS, 3 SALIDAS, 16/3 AWG.', 'adf83d083b', 12.00, 'c3254c9416', '162550f47d', '', 10.00, '0', '0', 'on', '0', '0', '0', '2c1d1d95bd', 1592067086, 10),
(18, '1018', 'TUBO PVC DE 160 PSI, 1 PULGADA.', 'f42d664196', 160.00, 'c3254c9416', '6da060c351', '', 25.00, '0', '0', 'on', '0', '0', '0', 'dc528b4c86', 1584485995, 10),
(19, '1019', 'TUBO PVC DE 160 PSI, 2.1/2 PULGADAS.', 'f42d664196', 85.00, 'c3254c9416', '6da060c351', '', 20.00, '0', '0', 'on', '0', '0', '0', 'bb237f950e', 1584411270, 10),
(20, '1001', '2 PACK ARROZ BLANCO CINCO ESTRELLA LIBRA', '940fe7179c', 485.00, 'd21c51860c', 'b06519fdb5', '', 25.00, '0', '0', 'on', '0', '0', '0', '4455ce8c12', 1584752502, 11),
(21, '1002', '2 PACK ARROZ BLANCO DANY 1 LB', '940fe7179c', 471.00, 'd21c51860c', '4aba2e319e', '', 20.00, '0', '0', 'on', '0', '0', '0', 'deedb4db2a', 1584752501, 11),
(22, '1003', '2 PACK HARINA DE MAIZ DANY 907 G', '940fe7179c', 478.00, 'd21c51860c', '4aba2e319e', '', 20.00, '0', '0', 'on', '0', '0', '0', '412fa5572e', 1584496020, 11),
(23, '1004', '2PACK BEBIDA LACTEA SMILK 350 GRAMOS', '940fe7179c', 271.00, 'd21c51860c', '4aba2e319e', '', 20.00, '0', '0', 'on', '0', '0', '0', 'c7de962e9a', 1584752501, 11),
(24, '1005', '4 PACK UNDERWOOD JAMON DEL DIABLO 120 G', '940fe7179c', 120.00, 'd21c51860c', '4aba2e319e', '', 20.00, '0', '0', 'on', '0', '0', '0', 'c53ba7d547', 1584582557, 11),
(25, '1006', 'JAMONADA BLACK LABEL 24/198 GRS HORMEL', '940fe7179c', 29.00, 'd21c51860c', '4aba2e319e', '', 20.00, '0', '0', 'on', '0', '0', '0', 'deffbb2b03', 1584582633, 11),
(26, '1007', '6PACK SOPAS INSTANTANEA LAKY MEN 64GR', '940fe7179c', 185.00, 'd21c51860c', '4aba2e319e', '', 10000.00, '0', '0', 'on', '0', '0', '0', '9dbf181f21', 1590500704, 11),
(27, '1008', 'SOPA EN VASO RES MARUCHAN 12/2 25 OZ', '940fe7179c', 173.00, 'd21c51860c', '4aba2e319e', '', 20.00, '0', '0', 'on', '0', '0', '0', '87fc44a1cf', 1584409530, 11),
(28, '1009', 'ACEITE CANOLA ORISOL 3000ML PET', '940fe7179c', 144.00, 'd21c51860c', '4aba2e319e', '', 20.00, '0', '0', 'on', '0', '0', '0', 'cb91116b74', 1584582579, 11),
(29, '1010', 'ACEITE ORISOL 3000ML PET', '940fe7179c', 191.00, 'd21c51860c', '4aba2e319e', '', 10.00, '0', '0', 'on', '0', '0', '0', 'bd471a840d', 1584752502, 11),
(30, '1011', 'ADEREZO P/ENSALADA RANCH LIGHT 237 ML CL', '940fe7179c', 177.00, 'd21c51860c', '4aba2e319e', '', 20.00, '0', '0', 'on', '0', '0', '0', 'c35aae3c6a', 1584752502, 11),
(31, '1012', 'AVENA MOSH PARA FRESCO ORIGI QUAKER 600G', '940fe7179c', 177.00, 'd21c51860c', '4aba2e319e', '', 20.00, '0', '0', 'on', '0', '0', '0', '96ce3c014f', 1584752502, 11),
(32, '1013', 'BARRA GRANOLA MIEL HELIOS 162 G', '940fe7179c', 150.00, 'd21c51860c', '4aba2e319e', '', 20.00, '0', '0', 'on', '0', '0', '0', '7b1e7305c1', 1584409453, 11),
(33, '1014', 'CEREAL KOMPLETE PASAS Y MANZANA 460 G', '940fe7179c', 162.00, 'd21c51860c', '4aba2e319e', '', 20.00, '0', '0', 'on', '0', '0', '0', '36af61b270', 1584409453, 11),
(34, '1015', 'PASTILLAS PARA DORMIR', '940fe7179c', 380.00, 'd21c51860c', '4aba2e319e', '', 10.00, 'on', '0', 'on', '0', '0', '0', '8adccf87dc', 1590497872, 11),
(35, '1016', 'PASTILLA PARA DESPERTAR', '940fe7179c', 195.00, 'd21c51860c', 'b06519fdb5', '', 10.00, 'on', '0', 'on', '0', '0', '0', '69a3ec574f', 1590497915, 11);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto_averias`
--

CREATE TABLE `producto_averias` (
  `id` int(5) NOT NULL,
  `producto` varchar(50) NOT NULL,
  `cant` float(10,2) NOT NULL,
  `comentarios` varchar(100) NOT NULL,
  `fecha` varchar(30) NOT NULL,
  `hora` varchar(30) NOT NULL,
  `usuario` varchar(50) NOT NULL,
  `hash` varchar(12) NOT NULL,
  `time` int(12) NOT NULL,
  `td` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto_cambios`
--

CREATE TABLE `producto_cambios` (
  `id` int(5) NOT NULL,
  `producto` int(25) NOT NULL,
  `cant` float(10,2) NOT NULL,
  `fecha` varchar(50) NOT NULL,
  `hora` varchar(50) NOT NULL,
  `usuario` varchar(100) NOT NULL,
  `proveedor` int(2) NOT NULL,
  `estado` int(2) NOT NULL,
  `hash` varchar(12) NOT NULL,
  `time` int(12) NOT NULL,
  `td` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Productos que se entregan para cambio a los proveedores';

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto_categoria`
--

CREATE TABLE `producto_categoria` (
  `id` int(5) NOT NULL,
  `categoria` varchar(50) NOT NULL,
  `hash` varchar(12) NOT NULL,
  `time` int(12) NOT NULL,
  `td` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Categorias de los productos';

--
-- Volcado de datos para la tabla `producto_categoria`
--

INSERT INTO `producto_categoria` (`id`, `categoria`, `hash`, `time`, `td`) VALUES
(1, 'CONSTRUCCION', 'f42d664196', 1584479859, 10),
(2, 'ELECTRICO', 'adf83d083b', 1584479867, 10),
(3, 'HOGAR', '05a6649213', 1584479878, 10),
(4, 'ABARROTES', '940fe7179c', 1584500312, 11);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto_compuestos`
--

CREATE TABLE `producto_compuestos` (
  `id` int(5) NOT NULL,
  `producto` varchar(25) NOT NULL,
  `cant` float(10,2) NOT NULL,
  `agregado` varchar(50) NOT NULL,
  `hash` varchar(12) NOT NULL,
  `time` int(12) NOT NULL,
  `td` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Los productos que comprenden un compuesto';

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto_dependiente`
--

CREATE TABLE `producto_dependiente` (
  `id` int(5) NOT NULL,
  `producto` varchar(25) NOT NULL,
  `dependiente` varchar(25) NOT NULL,
  `cant` float(10,2) NOT NULL,
  `hash` varchar(12) NOT NULL,
  `time` int(12) NOT NULL,
  `td` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Los productos que dependen de otros, de donde y cantidad';

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto_devoluciones`
--

CREATE TABLE `producto_devoluciones` (
  `id` int(5) NOT NULL,
  `producto` int(25) NOT NULL,
  `cantidad` float(10,5) NOT NULL,
  `fecha` varchar(50) NOT NULL,
  `hora` varchar(50) NOT NULL,
  `usuario` varchar(100) NOT NULL,
  `cliente` int(2) NOT NULL,
  `observaciones` text NOT NULL,
  `hash` varchar(12) NOT NULL,
  `time` int(12) NOT NULL,
  `td` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Productos que los clientes de como devolución';

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto_imagenes`
--

CREATE TABLE `producto_imagenes` (
  `id` int(5) NOT NULL,
  `producto` int(25) NOT NULL,
  `imagen` varchar(100) NOT NULL,
  `descripcion` varchar(150) NOT NULL,
  `ancho` int(11) NOT NULL,
  `alto` int(11) NOT NULL,
  `hash` varchar(12) NOT NULL,
  `time` int(12) NOT NULL,
  `td` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Imagenes del producto';

--
-- Volcado de datos para la tabla `producto_imagenes`
--

INSERT INTO `producto_imagenes` (`id`, `producto`, `imagen`, `descripcion`, `ancho`, `alto`, `hash`, `time`, `td`) VALUES
(1, 1002, '1584481593.jpg', '', 800, 800, 'd701de5e17', 1584481596, 10),
(2, 1003, '1584481707.jpg', '', 800, 800, 'd742c9a771', 1584481710, 10),
(3, 1004, '1584481835.jpg', '', 800, 800, '994186d6b4', 1584481838, 10),
(4, 1005, '1584482041.jpg', '', 800, 800, 'a1123760e9', 1584482044, 10),
(5, 1006, '1584482123.jpg', '', 800, 800, 'bba18bde67', 1584482127, 10),
(6, 1007, '1584482993.jpg', '', 800, 800, '068862f1e9', 1584482997, 10),
(7, 1008, '1584483075.jpg', '', 800, 800, 'dcf46638e1', 1584483078, 10),
(8, 1009, '1584484622.jpg', '', 800, 800, '039ae88d38', 1584484625, 10),
(9, 1010, '1584484708.jpg', '', 800, 800, '37d9db90c7', 1584484711, 10),
(10, 1011, '1584484881.jpg', '', 800, 800, '466b1f9c88', 1584484882, 10),
(11, 1012, '1584485300.jpg', '', 800, 800, 'b4bf10e100', 1584485303, 10),
(12, 1013, '1584485396.jpg', '', 800, 800, '01bf238324', 1584485400, 10),
(13, 1014, '1584485569.jpg', '', 800, 800, '6cf47270d9', 1584485573, 10),
(14, 1016, '1584485751.jpg', '', 800, 800, 'aa17aa04e3', 1584485755, 10),
(15, 1017, '1584485842.jpg', '', 800, 800, '5e67a98b91', 1584485847, 10),
(16, 1018, '1584486053.jpg', '', 800, 800, 'cf111c4dfb', 1584486057, 10),
(17, 1019, '1584486149.jpg', '', 800, 800, 'cf3c9523a4', 1584486152, 10),
(19, 1001, '1584500922.jpg', '', 451, 800, 'aea1729767', 1584500925, 11),
(20, 1002, '1584502001.jpg', '', 800, 800, 'fc97f0aa66', 1584502004, 11),
(21, 1003, '1584502378.jpg', '', 800, 668, '215b6d9536', 1584502381, 11),
(22, 1008, '1584502819.jpg', '', 684, 800, 'bb56a34037', 1584502822, 11),
(23, 1009, '1584502947.jpg', '', 500, 500, '6ea7cce567', 1584502948, 11),
(24, 1011, '1584503100.jpg', '', 800, 800, '53687b8e24', 1584503103, 11),
(25, 1012, '1584503247.jpg', '', 500, 500, 'e0998f6908', 1584503247, 11),
(26, 1014, '1584503634.jpg', '', 524, 800, 'be8fe8a009', 1584503636, 11);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto_ingresado`
--

CREATE TABLE `producto_ingresado` (
  `id` int(5) NOT NULL,
  `producto` int(25) NOT NULL,
  `cant` float(10,2) NOT NULL,
  `existencia` float(10,2) NOT NULL,
  `precio_costo` float(10,2) NOT NULL,
  `caduca` varchar(30) NOT NULL,
  `caducaF` varchar(30) NOT NULL,
  `comentarios` text NOT NULL,
  `fecha` varchar(30) NOT NULL,
  `hora` varchar(30) NOT NULL,
  `hash` varchar(12) NOT NULL,
  `time` int(12) NOT NULL,
  `td` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Registra los productos que ingresan al inventario';

--
-- Volcado de datos para la tabla `producto_ingresado`
--

INSERT INTO `producto_ingresado` (`id`, `producto`, `cant`, `existencia`, `precio_costo`, `caduca`, `caducaF`, `comentarios`, `fecha`, `hora`, `hash`, `time`, `td`) VALUES
(1, 1001, 256.00, 248.00, 0.50, '', '', '', '17-03-2020', '15:28:16', '4526fdcccb', 1591295758, 10),
(2, 1002, 365.00, 307.00, 14.00, '', '', '', '17-03-2020', '15:45:32', 'ac471105b3', 1591295758, 10),
(3, 1003, 365.00, 243.00, 6.00, '', '', '', '17-03-2020', '15:48:11', '2d4c202c04', 1591295758, 10),
(4, 1004, 365.00, 214.00, 7.00, '', '', '', '17-03-2020', '15:50:10', '752546047f', 1591295758, 10),
(5, 1005, 360.00, 243.00, 6.00, '', '', '', '17-03-2020', '15:53:44', 'de4fc4a837', 1591295758, 10),
(6, 1006, 360.00, 240.00, 6.00, '', '', '', '17-03-2020', '15:54:57', 'e091a84a41', 1591295758, 10),
(7, 1007, 250.00, 230.00, 5.00, '', '', '', '17-03-2020', '16:09:39', 'a9d931988c', 1591295759, 10),
(8, 1008, 30.00, 17.00, 2.50, '', '', '', '17-03-2020', '16:10:57', '184c239a7f', 1591295759, 10),
(9, 1009, 50.00, 34.00, 9.80, '', '', '', '17-03-2020', '16:36:35', 'fcdaa008bb', 1591295759, 10),
(10, 1010, 22.00, 5.00, 1.90, '', '', '', '17-03-2020', '16:37:54', '2a8bd5bc23', 1591295759, 10),
(11, 1011, 19.00, 8.00, 37.00, '', '', '', '17-03-2020', '16:40:23', '53d8298f4d', 1591295759, 10),
(12, 1012, 26.00, 18.00, 9.00, '', '', '', '17-03-2020', '16:47:57', 'ba772d3112', 1591295759, 10),
(13, 1013, 55.00, 46.00, 0.25, '', '', '', '17-03-2020', '16:49:35', '8b029cfecf', 1591295759, 10),
(14, 1014, 55.00, 51.00, 0.55, '', '', '', '17-03-2020', '16:52:31', 'ca5e0be1ac', 1591295759, 10),
(15, 1015, 26.00, 19.00, 15.00, '', '', '', '17-03-2020', '16:54:23', '3e22f00edd', 1591295759, 10),
(16, 1016, 15.00, 10.00, 17.20, '', '', '', '17-03-2020', '16:55:35', 'ff372819d6', 1591295760, 10),
(17, 1017, 20.00, 12.00, 23.00, '', '', '', '17-03-2020', '16:57:04', '2d884ee155', 1591295760, 10),
(18, 1018, 160.00, 160.00, 2.05, '', '', '', '17-03-2020', '17:00:16', 'b77df7b423', 1584486016, 10),
(19, 1019, 100.00, 85.00, 10.00, '', '', '', '17-03-2020', '17:01:53', '13666f3e09', 1591295760, 10),
(20, 1001, 500.00, 485.00, 0.95, '', '', '', '17-03-2020', '20:59:55', 'c5a650f736', 1590625912, 11),
(21, 1002, 500.00, 471.00, 0.80, '', '', '', '17-03-2020', '21:25:50', '5bb6ac5d32', 1590625912, 11),
(22, 1003, 500.00, 478.00, 1.05, '', '', '', '17-03-2020', '21:32:36', '5c6f4d08aa', 1590625912, 11),
(23, 1004, 500.00, 271.00, 3.00, '', '', '', '17-03-2020', '21:35:20', '09f0292203', 1590625913, 11),
(24, 1005, 200.00, 120.00, 8.00, '', '', '', '17-03-2020', '21:36:28', 'eca2a76d11', 1590625913, 11),
(25, 1006, 150.00, 29.00, 2.00, '', '', '', '17-03-2020', '21:37:18', 'adf8c3712b', 1590625913, 11),
(26, 1007, 200.00, 185.00, 2.06, '', '', '', '17-03-2020', '21:38:17', 'a627174cda', 1590625913, 11),
(27, 1008, 200.00, 173.00, 0.42, '', '', '', '17-03-2020', '21:39:09', '7d0724aae4', 1590625913, 11),
(28, 1009, 206.00, 144.00, 6.42, '', '', '', '17-03-2020', '21:41:50', 'b200d69c72', 1590625913, 11),
(29, 1010, 200.00, 191.00, 5.36, '', '', '', '17-03-2020', '21:43:15', 'a3bb2cebfb', 1590625913, 11),
(30, 1011, 200.00, 177.00, 1.60, '', '', '', '17-03-2020', '21:44:43', '8ae69320ee', 1590625913, 11),
(31, 1012, 200.00, 177.00, 1.90, '', '', '', '17-03-2020', '21:47:06', '142c3c6cf8', 1590625913, 11),
(32, 1013, 200.00, 150.00, 1.05, '', '', '', '17-03-2020', '21:50:28', '641b6f0e3e', 1590625914, 11),
(33, 1014, 200.00, 162.00, 2.85, '', '', '', '17-03-2020', '21:53:37', 'a1ec6e6ad0', 1590625914, 11),
(34, 1015, 200.00, 0.00, 0.10, '01-05-2020', '1588312800', 'Producto caduca pronto', '26-05-2020', '06:55:41', '07b14fced2', 1590625914, 11),
(35, 1016, 200.00, 0.00, 0.10, '01-05-2020', '1588312800', 'Producto caducado', '26-05-2020', '06:56:46', '4f5f810c16', 1590625914, 11),
(36, 1015, 200.00, 180.00, 0.10, '30-05-2020', '1590818400', '', '26-05-2020', '06:57:31', '7f7fd5f3b1', 1590625914, 11),
(37, 1015, 200.00, 200.00, 0.10, '30-06-2020', '1593496800', '', '26-05-2020', '06:57:52', '93905b18b2', 1590624018, 11),
(38, 1016, 200.00, 195.00, 0.10, '16-07-2020', '1594879200', '', '26-05-2020', '06:58:35', '5dae9e4630', 1590625914, 11),
(39, 1020, 1.00, 0.00, 20.00, '', '', '', '08-06-2020', '07:09:48', '59ad11392e', 1591621788, 10),
(40, 1020, 10.00, 0.00, 10.00, '', '', '', '13-06-2020', '12:27:02', '541c79309f', 1592072822, 10),
(41, 1020, 5.00, 0.00, 10.00, '', '', '', '13-06-2020', '13:24:18', '691c026e3d', 1592076258, 10),
(42, 1020, 12.00, 0.00, 12.00, '', '', '', '13-06-2020', '13:26:51', '0cda5a2f0f', 1592076411, 10),
(43, 1020, 12.00, 0.00, 1.00, '', '', '', '13-06-2020', '13:29:47', '772e03da31', 1592076587, 10);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto_precio`
--

CREATE TABLE `producto_precio` (
  `id` int(5) NOT NULL,
  `producto` varchar(25) NOT NULL,
  `cant` int(5) NOT NULL,
  `precio` float(10,2) NOT NULL,
  `hash` varchar(12) NOT NULL,
  `time` int(12) NOT NULL,
  `td` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Maneja los diferentes precios para cada producto';

--
-- Volcado de datos para la tabla `producto_precio`
--

INSERT INTO `producto_precio` (`id`, `producto`, `cant`, `precio`, `hash`, `time`, `td`) VALUES
(1, '1001', 1, 0.95, '81d0618b30', 1584480506, 10),
(2, '1002', 1, 17.50, 'b6abf18f03', 1584481541, 10),
(3, '1003', 1, 8.20, '0a06cadf3e', 1584481698, 10),
(4, '1004', 1, 8.20, '926be1cc40', 1584481816, 10),
(5, '1005', 1, 8.70, '746e3b476b', 1584482031, 10),
(6, '1006', 1, 7.60, 'ec5f6d2657', 1584482111, 10),
(7, '1007', 1, 9.50, 'd14a5356a6', 1584482984, 10),
(8, '1008', 1, 4.60, '5c2654bab3', 1584483065, 10),
(9, '1009', 1, 13.25, 'f823aabd5a', 1584484612, 10),
(10, '1010', 1, 3.25, '6e71d77c29', 1584484681, 10),
(11, '1011', 1, 45.00, '5b93755789', 1584484834, 10),
(12, '1012', 1, 12.75, 'ad35c3dd0e', 1584485287, 10),
(13, '1013', 1, 0.45, 'be9bbf8b18', 1584485386, 10),
(14, '1014', 1, 0.70, 'd516f07d6d', 1584485558, 10),
(15, '1015', 1, 22.50, 'adc7691a85', 1584485670, 10),
(16, '1016', 1, 24.95, 'd039fc649c', 1584485742, 10),
(17, '1017', 1, 32.95, 'c407bc19e3', 1584485830, 10),
(18, '1018', 1, 3.50, 'b52b723478', 1584486025, 10),
(19, '1018', 6, 3.40, 'c4169967c2', 1584486033, 10),
(20, '1018', 12, 3.30, 'e98f5ac023', 1584486041, 10),
(21, '1019', 1, 14.00, 'a3e3d65f0b', 1584486121, 10),
(22, '1019', 6, 13.75, '4ad988ef2a', 1584486131, 10),
(23, '1019', 12, 13.50, 'dba21675cb', 1584486139, 10),
(24, '1001', 1, 1.38, '07ce3ccb05', 1584500403, 11),
(25, '1002', 1, 1.09, '6002c429cc', 1584501958, 11),
(26, '1003', 1, 1.49, '84ee173ac2', 1584502367, 11),
(27, '1004', 1, 3.70, 'd4c239fda7', 1584502532, 11),
(28, '1005', 1, 9.40, 'a42dec8998', 1584502595, 11),
(29, '1006', 1, 2.27, 'dad8767d71', 1584502646, 11),
(30, '1007', 1, 2.95, 'd8efdd622e', 1584502706, 11),
(31, '1008', 1, 0.63, 'a698070876', 1584502757, 11),
(32, '1009', 1, 7.08, 'cf844e9947', 1584502918, 11),
(33, '1010', 1, 6.15, '206993f40f', 1584503002, 11),
(34, '1011', 1, 2.10, 'fdc7cb6ba0', 1584503090, 11),
(35, '1012', 1, 2.21, 'fbb220ae1a', 1584503237, 11),
(36, '1013', 1, 1.45, 'de674cdb7f', 1584503439, 11),
(37, '1014', 1, 3.25, '3aa20efe9a', 1584503624, 11),
(38, '1015', 1, 0.20, 'b412c40cf4', 1590497751, 11),
(39, '1016', 1, 0.20, '345dd6a94a', 1590497813, 11);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto_tags`
--

CREATE TABLE `producto_tags` (
  `id` int(5) NOT NULL,
  `producto` varchar(25) NOT NULL,
  `tag` varchar(30) NOT NULL,
  `hash` varchar(12) NOT NULL,
  `time` int(12) NOT NULL,
  `td` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='etiquetas para buscar productos';

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto_unidades`
--

CREATE TABLE `producto_unidades` (
  `id` int(6) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `abreviacion` varchar(50) NOT NULL,
  `hash` varchar(12) NOT NULL,
  `time` int(12) NOT NULL,
  `td` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Unidades de medida para los productos';

--
-- Volcado de datos para la tabla `producto_unidades`
--

INSERT INTO `producto_unidades` (`id`, `nombre`, `abreviacion`, `hash`, `time`, `td`) VALUES
(1, 'Unidades', 'U', 'c3254c9416', 1584479821, 10),
(2, 'Kilogramos', 'Kl', 'd6d028cefd', 1584479829, 10),
(3, 'Litros', 'L', '0cc8eee147', 1584479834, 10),
(4, 'Metro', 'Mts', 'b31b242452', 1584479845, 10),
(5, 'Bolsa', 'Bls', '93b81b44cb', 1584481489, 10),
(6, 'UNIDAD', 'U', 'd21c51860c', 1584500323, 11),
(7, 'Libra', 'Lbs', 'bccfff7785', 1584500344, 11),
(8, 'Kilogramo', 'Kg', '9b6e57b5ba', 1584500351, 11);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proveedores`
--

CREATE TABLE `proveedores` (
  `id` int(6) NOT NULL,
  `nombre` varchar(200) NOT NULL,
  `documento` varchar(50) NOT NULL,
  `registro` varchar(50) NOT NULL,
  `direccion` varchar(100) NOT NULL,
  `municipio` varchar(50) NOT NULL,
  `departamento` varchar(25) NOT NULL,
  `giro` varchar(100) NOT NULL,
  `telefono` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `contacto` varchar(50) NOT NULL,
  `tel_contacto` varchar(20) NOT NULL,
  `comentarios` text NOT NULL,
  `hash` varchar(12) NOT NULL,
  `time` int(12) NOT NULL,
  `td` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `proveedores`
--

INSERT INTO `proveedores` (`id`, `nombre`, `documento`, `registro`, `direccion`, `municipio`, `departamento`, `giro`, `telefono`, `email`, `contacto`, `tel_contacto`, `comentarios`, `hash`, `time`, `td`) VALUES
(1, 'PROMACO', '32659821-9', '987987', 'CALLE LA MASCOTA', 'SAN SALVADOR', 'SAN SLVADOR', 'FERRETEROS', '87984512', '', 'JUAN PEREZ', '', '', '162550f47d', 1584480070, 10),
(2, 'LA CASTELLANA', '98798789-8', '879878', 'CALLE LA DIVIAN PROVIDENCIA', 'SANTA ANA', 'SANTA ANA', 'FERRETEROS', '87854784', 'la castellana@gmail.com', 'JUAN HERNANDEZ', '78529862', ' ', '6da060c351', 1588786512, 10),
(3, 'DON JAB', '97898778-7', '987978', 'LAS CASCADAS ', 'SAN SALVADOR', 'SAN SALVADOR', '', '87874551', '', 'JUAN PEREZ', '', '', 'b06519fdb5', 1584500171, 11),
(4, 'LAS CASCADAS', '78897978-8', '8798787', 'CALLE CHILTIUPAN', 'SAN SALVADOR', 'SAN SALVADOR', '', '54874578', '', 'JUAN PEREZ', '', '', '4aba2e319e', 1584500275, 11);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sync_tabla`
--

CREATE TABLE `sync_tabla` (
  `id` int(5) NOT NULL,
  `tabla` varchar(50) NOT NULL,
  `edo` int(2) NOT NULL,
  `hash` varchar(12) NOT NULL,
  `time` int(12) NOT NULL,
  `td` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='las tablas que deben actualizarse';

--
-- Volcado de datos para la tabla `sync_tabla`
--

INSERT INTO `sync_tabla` (`id`, `tabla`, `edo`, `hash`, `time`, `td`) VALUES
(1, 'caracteristicas', 2, 'd04a8a4c85', 1591708171, 10);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sync_tables_updates`
--

CREATE TABLE `sync_tables_updates` (
  `id` int(5) NOT NULL,
  `tabla` varchar(50) NOT NULL,
  `hash` varchar(12) NOT NULL COMMENT 'has de la tabla a eliminar',
  `time` int(12) NOT NULL,
  `action` int(2) NOT NULL COMMENT '1 =  borrar. 2= actualizar',
  `td` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `sync_tables_updates`
--

INSERT INTO `sync_tables_updates` (`id`, `tabla`, `hash`, `time`, `action`, `td`) VALUES
(1, 'config_master', '0215951ce2', 1584201960, 2, 0),
(2, 'planilla_empleados', 'c7ee4be5e0', 1584205074, 2, 0),
(3, 'config_master', '0215951ce2', 1584479639, 2, 10),
(5, 'ticket', 'fca0aa9c23', 1584480589, 2, 10),
(6, 'ticket', 'fca0aa9c23', 1584480593, 1, 10),
(7, 'ticket_orden', 'ccaeec3b8d', 1584480593, 1, 10),
(10, 'ticket', 'b38b5ac098', 1584483336, 2, 10),
(11, 'ticket_orden', '5a117a74b3', 1584483346, 2, 10),
(12, 'ticket', 'b38b5ac098', 1584483354, 1, 10),
(13, 'ticket', 'f93d08150d', 1584483356, 1, 10),
(14, 'ticket_orden', '5a117a74b3', 1584483356, 1, 10),
(16, 'config_master', '', 1592220117, 2, 11),
(17, 'ticket', 'aa90a92352', 1584500468, 2, 11),
(18, 'ticket', 'aa90a92352', 1584500482, 1, 11),
(19, 'ticket_orden', '82c1ed8d0b', 1584500482, 1, 11),
(20, 'producto', '4455ce8c12', 1584752502, 2, 11),
(21, 'producto_imagenes', '5e4942f325', 1584500912, 1, 11),
(22, 'ticket', '38d19fbefb', 1584500947, 1, 11),
(23, 'ticket_orden', '2494495489', 1584500947, 1, 11),
(24, 'ticket', '2e6394fbb2', 1584501342, 2, 11),
(25, 'ticket', '2e6394fbb2', 1584501415, 1, 11),
(26, 'ticket_orden', '914ce92299', 1584501415, 1, 11),
(27, 'ticket', '27a27b0677', 1584501839, 2, 11),
(28, 'ticket', '27a27b0677', 1584501842, 1, 11),
(29, 'ticket_orden', '3d8dc167f3', 1584501842, 1, 11),
(30, 'producto', '87fc44a1cf', 1584409530, 2, 11),
(31, 'ticket', '1add799d91', 1584502848, 2, 11),
(32, 'ticket', '1add799d91', 1584502857, 1, 11),
(33, 'ticket', '12abe6b5ff', 1584502859, 1, 11),
(34, 'ticket', '268ab07da3', 1584502859, 1, 11),
(35, 'ticket_orden', '2f7b01b387', 1584502860, 1, 11),
(36, 'ticket', 'a041859333', 1584503279, 2, 11),
(37, 'ticket', 'a041859333', 1584503287, 1, 11),
(38, 'ticket_orden', '87d31af782', 1584503287, 1, 11),
(39, 'ticket', '8c3d658412', 1584503297, 2, 11),
(40, 'ticket', '52c744117c', 1584503301, 2, 11),
(41, 'ticket', '8c3d658412', 1584503322, 1, 11),
(42, 'ticket', '52c744117c', 1584503323, 1, 11),
(43, 'ticket', '0a699dcdaf', 1584503323, 1, 11),
(44, 'ticket_orden', '673b9a5e33', 1584503323, 1, 11),
(45, 'config_root', '', 1584572222, 2, 11),
(46, 'config_root', 'dfb401079e', 1584659138, 2, 10),
(47, 'ticket', 'd1f7b555c8', 1583103771, 2, 11),
(48, 'ticket', 'af3d539bc0', 1583103785, 2, 11),
(49, 'ticket_orden', '57c09c9e38', 1583103785, 2, 11),
(50, 'producto', 'c53ba7d547', 1584582557, 2, 11),
(51, 'producto', '36af61b270', 1584409453, 2, 11),
(52, 'producto', 'cb91116b74', 1584582579, 2, 11),
(53, 'ticket', '99160af828', 1583103800, 2, 11),
(54, 'ticket_orden', '6a85ebe632', 1583103800, 2, 11),
(55, 'producto', 'deffbb2b03', 1584582633, 2, 11),
(56, 'ticket', 'ad0f3e51bd', 1583103814, 2, 11),
(57, 'ticket', '4986870b89', 1583103822, 2, 11),
(58, 'ticket_orden', 'a16cb24004', 1583103822, 2, 11),
(59, 'producto', '96ce3c014f', 1584752502, 2, 11),
(60, 'producto', 'c35aae3c6a', 1584752502, 2, 11),
(61, 'producto', 'c7de962e9a', 1584752501, 2, 11),
(62, 'ticket', '2aeaea9543', 1583103836, 2, 11),
(63, 'ticket', 'c36e90c5fe', 1583103844, 2, 11),
(64, 'ticket_orden', 'ee686923e1', 1583103844, 2, 11),
(65, 'ticket', 'b3daa97e0c', 1583103858, 2, 11),
(66, 'ticket_orden', 'deff2c07e8', 1583103858, 2, 11),
(67, 'producto', '412fa5572e', 1584496020, 2, 11),
(68, 'ticket', '2ca5b7f295', 1583103868, 2, 11),
(69, 'ticket', 'a4d87c9d62', 1583103872, 2, 11),
(70, 'ticket_orden', '00973e9c3f', 1583103872, 2, 11),
(71, 'ticket', 'b31901e13a', 1583104002, 2, 11),
(72, 'ticket', 'dab1e0905d', 1583103994, 2, 11),
(73, 'ticket', 'ae785b916d', 1583103995, 2, 11),
(74, 'ticket_orden', '8343381e6c', 1583104002, 2, 11),
(75, 'ticket', 'dd70cb97f6', 1583104015, 2, 11),
(76, 'ticket', 'ac54ee99a2', 1583104031, 2, 11),
(77, 'ticket_orden', 'f321c97623', 1583104032, 2, 11),
(78, 'producto', '9dbf181f21', 1590500704, 2, 11),
(79, 'creditos', '8efb226e9f', 1583542266, 2, 11),
(80, 'ticket_cliente', 'ebe318df04', 1583104033, 2, 11),
(81, 'ticket', '24e8de71c6', 1583104039, 2, 11),
(82, 'ticket', '77d8317b12', 1583104055, 2, 11),
(83, 'ticket_orden', '22f05323a2', 1583104055, 2, 11),
(84, 'creditos', 'b9059d125a', 1583279217, 2, 11),
(85, 'ticket_cliente', 'd435a6718b', 1583104056, 2, 11),
(125, 'ticket', '96484e969f', 1583191874, 2, 11),
(126, 'ticket_orden', '3b2287bccf', 1583191875, 2, 11),
(127, 'ticket', '77638ab2bb', 1583191891, 2, 11),
(128, 'ticket_orden', '76cd6a7332', 1583191891, 2, 11),
(129, 'ticket', '2fc42ccb52', 1583191915, 2, 11),
(130, 'ticket', 'f762d8e402', 1583191908, 2, 11),
(131, 'ticket_orden', 'b9b86ff1f9', 1583191915, 2, 11),
(132, 'ticket', '4588c19b96', 1583191931, 2, 11),
(133, 'ticket_orden', '34fa909025', 1583191931, 2, 11),
(134, 'ticket', 'a709c6e860', 1583191957, 2, 11),
(135, 'ticket_orden', 'c811c5b658', 1583191957, 2, 11),
(136, 'ticket_cliente', 'ec80ab0915', 1583191958, 2, 11),
(137, 'ticket', '87fc95df11', 1583279066, 2, 11),
(138, 'ticket', 'c27c0abc28', 1583279063, 2, 11),
(139, 'ticket_orden', '526b740105', 1583279066, 2, 11),
(140, 'ticket', 'baf3502d16', 1583279080, 2, 11),
(141, 'ticket', 'a8348b773f', 1583279091, 2, 11),
(142, 'ticket_orden', 'af5c864470', 1583279091, 2, 11),
(143, 'producto', '7b1e7305c1', 1584409453, 2, 11),
(144, 'ticket', 'fa7338164c', 1583279146, 2, 11),
(145, 'ticket_orden', '8a13d01254', 1583279146, 2, 11),
(146, 'ticket_cliente', 'cfaf78d92e', 1583279146, 2, 11),
(147, 'ticket', '90bb02e8dc', 1583279166, 2, 11),
(148, 'ticket_orden', '2880841a3c', 1583279166, 2, 11),
(149, 'ticket', '534f5f3e0d', 1583279189, 2, 11),
(150, 'ticket_orden', '477ad39a1e', 1583279189, 2, 11),
(161, 'ticket', 'fb6143c77d', 1583367724, 2, 11),
(162, 'ticket', '0e23e3fc42', 1583367741, 2, 11),
(163, 'ticket', '1fc73389f5', 1583367731, 2, 11),
(164, 'ticket_orden', 'ad95e82f5f', 1583367741, 2, 11),
(165, 'ticket', 'f6fdaef9cc', 1583367751, 2, 11),
(166, 'ticket', '482e7cd0c1', 1583367765, 2, 11),
(167, 'ticket_orden', '7d39d2e3f6', 1583367765, 2, 11),
(168, 'ticket', '3cbfeec60c', 1583367774, 2, 11),
(169, 'ticket_orden', 'd95ddf6e84', 1583367774, 2, 11),
(170, 'ticket', '424ef19e2f', 1583367783, 2, 11),
(171, 'ticket', '9c3b678c7d', 1583367798, 2, 11),
(172, 'ticket_orden', '91dc80f70c', 1583367798, 2, 11),
(173, 'creditos', '3bff3e7071', 1583889145, 2, 11),
(174, 'ticket_cliente', 'a628073405', 1583367799, 2, 11),
(175, 'ticket', '7e982af132', 1583367815, 2, 11),
(176, 'ticket_orden', '98616d7c07', 1583367815, 2, 11),
(177, 'creditos_abonos', 'cb69a97635', 1583367841, 2, 11),
(178, 'ticket', '882ba8ee9b', 1583367875, 2, 11),
(179, 'ticket_orden', 'dd21cc1cff', 1583367875, 2, 11),
(192, 'ticket', '001360f312', 1583455077, 2, 11),
(193, 'ticket', 'afcebaa15c', 1583455085, 2, 11),
(194, 'ticket', 'aa3f31da20', 1583455080, 2, 11),
(195, 'ticket_orden', '21d9f90a9b', 1583455085, 2, 11),
(196, 'ticket', '6085683f6a', 1583455102, 2, 11),
(197, 'ticket_orden', 'df38ae346b', 1583455102, 2, 11),
(198, 'producto', 'deedb4db2a', 1584752501, 2, 11),
(199, 'ticket', '5ddc981761', 1583455112, 2, 11),
(200, 'ticket', 'f28f2f1fff', 1583455120, 2, 11),
(201, 'ticket', '522639d902', 1583455124, 2, 11),
(202, 'ticket', '1251e450b4', 1583455129, 2, 11),
(203, 'ticket_orden', 'c5915da9c5', 1583455129, 2, 11),
(204, 'ticket', '5a784dbe79', 1583455143, 2, 11),
(205, 'ticket', '816daed2e3', 1583455147, 2, 11),
(206, 'ticket_orden', 'd49e87bfec', 1583455147, 2, 11),
(207, 'ticket', '29bd2dfa20', 1583455165, 2, 11),
(208, 'ticket_orden', '9019f7fac3', 1583455165, 2, 11),
(209, 'ticket', '501153e617', 1583455186, 2, 11),
(210, 'ticket', 'cca67db3bd', 1583455180, 2, 11),
(211, 'ticket_orden', 'c4536f3413', 1583455186, 2, 11),
(212, 'ticket', '8ba44f35c6', 1583455199, 2, 11),
(213, 'ticket', 'b0385a7611', 1583455203, 2, 11),
(214, 'ticket_orden', '6fb7e4e2bd', 1583455203, 2, 11),
(215, 'ticket', '041c96d8d9', 1583455215, 2, 11),
(216, 'ticket', '1ed6dc2112', 1583455216, 2, 11),
(217, 'ticket', 'cca7af4576', 1583455220, 2, 11),
(218, 'ticket_orden', '2ee49efe17', 1583455221, 2, 11),
(234, 'ticket', '38c7db8c6e', 1583542048, 2, 11),
(235, 'ticket', '86c13e1f90', 1583542053, 2, 11),
(236, 'ticket_orden', 'c29e893f02', 1583542054, 2, 11),
(237, 'ticket', '06e6da60c2', 1583542070, 2, 11),
(238, 'ticket', '22479d7a27', 1583542076, 2, 11),
(239, 'ticket_orden', '2dba295db2', 1583542076, 2, 11),
(240, 'ticket', '0d375e467f', 1583542099, 2, 11),
(241, 'ticket', 'a1cd9e633e', 1583542092, 2, 11),
(242, 'ticket_orden', '5fa22e0b9e', 1583542099, 2, 11),
(243, 'ticket', 'e4875ed0b9', 1583542121, 2, 11),
(244, 'ticket', 'fc4452a19e', 1583542115, 2, 11),
(245, 'ticket_orden', '005a7ca573', 1583542121, 2, 11),
(246, 'ticket', 'e7b63e3a51', 1583542209, 2, 11),
(247, 'ticket_orden', 'f352018b28', 1583542209, 2, 11),
(248, 'creditos_abonos', '98c558b6cc', 1583542246, 2, 11),
(249, 'ticket', '9d70c74993', 1583628772, 2, 11),
(250, 'ticket', '04d4346db6', 1583628763, 2, 11),
(251, 'ticket', 'cb55c5398b', 1583628768, 2, 11),
(252, 'ticket', 'de285ce23c', 1583628779, 2, 11),
(253, 'ticket_orden', '034206cfad', 1583628779, 2, 11),
(254, 'ticket', '04dc1fe242', 1583628792, 2, 11),
(255, 'ticket', 'b68d248d7d', 1583629202, 2, 11),
(256, 'ticket', 'f80f2943a7', 1583629224, 2, 11),
(257, 'ticket_orden', '76b453bf61', 1583629224, 2, 11),
(258, 'ticket', '47c73bfbe0', 1583629265, 2, 11),
(259, 'ticket_orden', '5fd4374269', 1583629265, 2, 11),
(260, 'ticket', '342a60310f', 1583629321, 2, 11),
(261, 'ticket_orden', '1360d21bb7', 1583629321, 2, 11),
(262, 'ticket', 'a008ce8229', 1583715843, 2, 11),
(263, 'ticket', 'e9dec712a1', 1583715836, 2, 11),
(264, 'ticket', 'e6d6701fed', 1583715838, 2, 11),
(265, 'ticket_orden', '83ebce155d', 1583715843, 2, 11),
(266, 'ticket', 'b6a0a83264', 1583715859, 2, 11),
(267, 'ticket', '5271a5861d', 1583715863, 2, 11),
(268, 'ticket_orden', 'd8d95e4ae1', 1583715863, 2, 11),
(269, 'ticket', '2a97473fc8', 1583715877, 2, 11),
(270, 'ticket', 'e0dc189ce5', 1583715879, 2, 11),
(271, 'ticket', '4218ff9b66', 1583715885, 2, 11),
(272, 'ticket_orden', '537831185a', 1583715885, 2, 11),
(273, 'ticket', '0eb2219db9', 1583715896, 2, 11),
(274, 'ticket', '2575e2d0dd', 1583715900, 2, 11),
(275, 'ticket_orden', '292b79d9a5', 1583715900, 2, 11),
(276, 'ticket', '77c60cf2ae', 1583715925, 2, 11),
(277, 'ticket_orden', '852d2c2be0', 1583715925, 2, 11),
(278, 'ticket', 'b48217148a', 1583715938, 2, 11),
(279, 'ticket', 'ecc593c000', 1583715942, 2, 11),
(280, 'ticket_orden', '4dfeb57862', 1583715942, 2, 11),
(281, 'ticket', '9f539140f0', 1583802400, 2, 11),
(282, 'ticket', '213fd5b258', 1583802402, 2, 11),
(283, 'ticket', 'a30e55af2f', 1583802409, 2, 11),
(284, 'ticket_orden', 'f77971de80', 1583802410, 2, 11),
(285, 'ticket', '26fdff3893', 1583802454, 2, 11),
(286, 'ticket', 'c0c565327c', 1583802441, 2, 11),
(287, 'ticket', '2d3f65518e', 1583802438, 2, 11),
(288, 'ticket_orden', '7262b4259b', 1583802454, 2, 11),
(289, 'ticket', '1a3375ed10', 1583802533, 2, 11),
(290, 'ticket', '7a050e2edd', 1583802528, 2, 11),
(291, 'ticket', '0ccdbfc96b', 1583802527, 2, 11),
(292, 'ticket_orden', '44ecebe3e6', 1583802533, 2, 11),
(293, 'ticket', '3850fbb230', 1583889007, 2, 11),
(294, 'ticket_orden', 'ba40d768a1', 1583889007, 2, 11),
(295, 'ticket', 'abf167f27e', 1583889020, 2, 11),
(296, 'ticket', 'd4c563e39c', 1583889025, 2, 11),
(297, 'ticket', '6c7d95ce2d', 1583889023, 2, 11),
(298, 'ticket', '53cbbe8370', 1583889029, 2, 11),
(299, 'ticket_orden', '0c41de75b5', 1583889029, 2, 11),
(300, 'ticket', '49603f2890', 1583889049, 2, 11),
(301, 'ticket_orden', 'c17501ddb6', 1583889049, 2, 11),
(302, 'ticket', 'dfede8ab27', 1583889065, 2, 11),
(303, 'ticket_orden', '8b083c24c0', 1583889065, 2, 11),
(304, 'ticket', '929d6c1b52', 1583889117, 2, 11),
(305, 'ticket_orden', 'f2f50b5c50', 1583889117, 2, 11),
(306, 'ticket', '08c9eaf014', 1583975600, 2, 11),
(307, 'ticket', 'ad9748dc9c', 1583975603, 2, 11),
(308, 'ticket', '8b5fe194c6', 1583975646, 2, 11),
(309, 'ticket_orden', 'fbc44ebabe', 1583975646, 2, 11),
(310, 'ticket', '8c265ff4f2', 1583975659, 2, 11),
(311, 'ticket', 'ba9cb8be40', 1583975664, 2, 11),
(312, 'ticket_orden', '36f8e45e1c', 1583975664, 2, 11),
(313, 'ticket', 'f7b12edda4', 1583975689, 2, 11),
(314, 'ticket_orden', 'a9a1810e3b', 1583975689, 2, 11),
(315, 'ticket', 'a2249e18dd', 1583975699, 2, 11),
(316, 'ticket', '5ca45e5701', 1583975707, 2, 11),
(317, 'ticket', '0117861df7', 1583975711, 2, 11),
(318, 'ticket_orden', 'c339b46f0f', 1583975711, 2, 11),
(319, 'ticket', '637d521e44', 1584062660, 2, 11),
(320, 'ticket', '723ffba87e', 1584062671, 2, 11),
(321, 'ticket_orden', '8cc06b996a', 1584062671, 2, 11),
(322, 'ticket', 'e9267d78f1', 1584062702, 2, 11),
(323, 'ticket', '28d606c3bc', 1584062708, 2, 11),
(324, 'ticket_orden', '7c171169d4', 1584062708, 2, 11),
(325, 'ticket', '588606adec', 1584062730, 2, 11),
(326, 'ticket', '712119c8e8', 1584062720, 2, 11),
(327, 'ticket', 'd10619b73e', 1584062723, 2, 11),
(328, 'ticket', 'b4b8cf7767', 1584062729, 2, 11),
(329, 'ticket', 'c964f819ef', 1584062735, 2, 11),
(330, 'ticket_orden', 'ed30cef098', 1584062735, 2, 11),
(331, 'ticket', '929650bb2e', 1584062751, 2, 11),
(332, 'ticket', 'add6270901', 1584062750, 2, 11),
(333, 'ticket', 'd7a01f7f54', 1584062756, 2, 11),
(334, 'ticket_orden', '1e89e0d5d2', 1584062756, 2, 11),
(335, 'ticket', '066c83fd45', 1584062800, 2, 11),
(336, 'ticket_orden', '7b643c23d2', 1584062800, 2, 11),
(337, 'creditos', '4290443283', 1584582661, 2, 11),
(338, 'ticket_cliente', '0fb2a97894', 1584062801, 2, 11),
(339, 'creditos_abonos', 'df87af7852', 1584062827, 2, 11),
(340, 'corte_diario', 'a1a6a4dfe6', 1584062913, 2, 11),
(341, 'ticket', '584482de21', 1584062934, 2, 11),
(342, 'ticket_orden', '79be459df6', 1584062934, 2, 11),
(343, 'ticket', '19b601fc86', 1584149787, 2, 11),
(344, 'ticket', '7d7ab5c5f4', 1584149791, 2, 11),
(345, 'ticket_orden', 'ff4cbc3ab9', 1584149791, 2, 11),
(346, 'ticket', '8feaa66cf4', 1584149807, 2, 11),
(347, 'ticket_orden', '9c94b4abe0', 1584149807, 2, 11),
(348, 'ticket', 'd38df0dd48', 1584149821, 2, 11),
(349, 'ticket', '1c04c63daa', 1584149828, 2, 11),
(350, 'ticket_orden', 'c252e1d3b7', 1584149828, 2, 11),
(351, 'ticket', 'f491a1d83e', 1584149841, 2, 11),
(352, 'ticket', '78df4378e4', 1584149839, 2, 11),
(353, 'ticket', '7e2ee1dc99', 1584149849, 2, 11),
(354, 'ticket_orden', '3522e59175', 1584149849, 2, 11),
(355, 'ticket', '816f073f41', 1584149861, 2, 11),
(356, 'ticket_orden', 'e784b8ca9e', 1584149861, 2, 11),
(357, 'ticket', '28a2edbe8b', 1584236338, 2, 11),
(358, 'ticket', '016099a78f', 1584236333, 2, 11),
(359, 'ticket', 'c798e5ce42', 1584236334, 2, 11),
(360, 'ticket_orden', '3545223b02', 1584236338, 2, 11),
(361, 'ticket', 'eb49ba7d3a', 1584236353, 2, 11),
(362, 'ticket', '6a94cbffbd', 1584236357, 2, 11),
(363, 'ticket_orden', '1acf16fa57', 1584236357, 2, 11),
(364, 'ticket', 'd81d8d0de8', 1584236367, 2, 11),
(365, 'ticket_orden', 'cc1279957a', 1584236367, 2, 11),
(366, 'ticket', '3b655129a6', 1584236387, 2, 11),
(367, 'ticket', '7e9bed5b3d', 1584236378, 2, 11),
(368, 'ticket', '967a3f25ad', 1584236391, 2, 11),
(369, 'ticket_orden', '3e4dc15924', 1584236391, 2, 11),
(370, 'ticket', 'dba4f25779', 1584236401, 2, 11),
(371, 'ticket_orden', 'd27b1d46ce', 1584236401, 2, 11),
(372, 'ticket', '2e2fcfe6df', 1584322931, 2, 11),
(373, 'ticket', '010bfb9ed9', 1584322924, 2, 11),
(374, 'ticket', 'cdb08b3082', 1584322927, 2, 11),
(375, 'ticket_orden', 'd653003585', 1584322931, 2, 11),
(376, 'producto', 'bd471a840d', 1584752501, 2, 11),
(377, 'ticket', 'c8a6a3b9c5', 1584322946, 2, 11),
(378, 'ticket', '911ab94b8b', 1584322949, 2, 11),
(379, 'ticket_orden', 'e625a8bef7', 1584322949, 2, 11),
(380, 'ticket', '69f9981ac4', 1584322960, 2, 11),
(381, 'ticket', '51ef50a1ca', 1584322965, 2, 11),
(382, 'ticket_orden', '2d65be1c62', 1584322965, 2, 11),
(383, 'ticket', '66c657d263', 1584409451, 2, 11),
(384, 'ticket_orden', 'f7b8a6a7d2', 1584409451, 2, 11),
(385, 'ticket', 'be96348073', 1584409469, 2, 11),
(386, 'ticket', 'f2a5908f13', 1584409473, 2, 11),
(387, 'ticket_orden', '8137be5afa', 1584409473, 2, 11),
(388, 'ticket', '92cf78cf39', 1584409529, 2, 11),
(389, 'ticket_orden', '5577abe257', 1584409529, 2, 11),
(390, 'ticket', 'ceda5968b7', 1584409540, 2, 11),
(391, 'ticket', '1113d265da', 1584409544, 2, 11),
(392, 'ticket_orden', '3ecf3c3703', 1584409544, 2, 11),
(393, 'ticket', 'e5fbec5312', 1584495996, 2, 11),
(394, 'ticket', 'b6dae9f55e', 1584496001, 2, 11),
(395, 'ticket_orden', '49865a2eb6', 1584496002, 2, 11),
(396, 'ticket', 'd8ea7adaea', 1584496020, 2, 11),
(397, 'ticket_orden', 'ecaa65f8c9', 1584496020, 2, 11),
(398, 'ticket', '4995e395b7', 1584496030, 2, 11),
(399, 'ticket_orden', '8fd46eeee9', 1584496030, 2, 11),
(400, 'ticket', '171ba2ca15', 1584582552, 2, 11),
(401, 'ticket', 'dc37c4a521', 1584582547, 2, 11),
(402, 'ticket', '36cecd4c0b', 1584582556, 2, 11),
(403, 'ticket_orden', '003bf68820', 1584582556, 2, 11),
(404, 'ticket', 'efd8ca0029', 1584582579, 2, 11),
(405, 'ticket_orden', '9a1586ff7c', 1584582579, 2, 11),
(406, 'ticket', '31b2b8410f', 1584582592, 2, 11),
(407, 'ticket_orden', 'd4f067dec5', 1584582592, 2, 11),
(408, 'ticket', '153e21d39a', 1584582605, 2, 11),
(409, 'ticket_orden', 'ca03bb93da', 1584582605, 2, 11),
(410, 'ticket', '2534c357f3', 1584582612, 2, 11),
(411, 'ticket', '9de5a8d188', 1584582633, 2, 11),
(412, 'ticket_orden', '2608196223', 1584582633, 2, 11),
(413, 'creditos', 'aa576bda01', 1584582633, 2, 11),
(414, 'ticket_cliente', '5599727328', 1584582634, 2, 11),
(415, 'creditos_abonos', '35aa773bca', 1584582657, 2, 11),
(458, 'producto', 'f62197dd5b', 1584654882, 2, 10),
(465, 'producto', '23f40f7a4c', 1584151855, 2, 10),
(466, 'ticket', '92ca874b42', 1583805902, 2, 10),
(467, 'ticket_orden', '5f1d0512e3', 1583805903, 2, 10),
(468, 'producto', '1c32d0e43d', 1584654367, 2, 10),
(469, 'ticket', '70a387e3e3', 1583805924, 2, 10),
(470, 'ticket_orden', '8d8b12f399', 1583805924, 2, 10),
(471, 'ticket_orden', 'f53b77e690', 1583892414, 2, 10),
(472, 'producto', '8b05c85074', 1583892422, 2, 10),
(473, 'ticket', 'cd3107bb49', 1583892414, 2, 10),
(474, 'ticket', '435b4448fe', 1583892431, 2, 10),
(475, 'ticket_orden', '7935bdece0', 1583892431, 2, 10),
(476, 'ticket', 'ed77ec33e9', 1583892454, 2, 10),
(477, 'ticket_orden', 'b80fc78c54', 1583892454, 2, 10),
(478, 'producto', 'e20e1f23c8', 1584584256, 2, 10),
(479, 'ticket', 'e285fdbcc7', 1583978904, 2, 10),
(480, 'ticket_orden', '983eb50b4f', 1583978904, 2, 10),
(481, 'producto', '365d446876', 1583978910, 2, 10),
(482, 'ticket', '763e50089f', 1583978915, 2, 10),
(483, 'ticket_orden', '722c195eeb', 1583978915, 2, 10),
(484, 'producto', '3dd1002f6b', 1584654376, 2, 10),
(485, 'ticket', '5de1c2ee40', 1584065375, 2, 10),
(486, 'ticket_orden', '12fd49e633', 1584065375, 2, 10),
(487, 'producto', 'f724519abe', 1584411281, 2, 10),
(488, 'ticket', '7b2cea8389', 1584065388, 2, 10),
(489, 'ticket_orden', 'd2c629b822', 1584065389, 2, 10),
(490, 'ticket', 'df897d5c3c', 1584151860, 2, 10),
(491, 'ticket_orden', '79cc6610a5', 1584151860, 2, 10),
(492, 'ticket', '5a37657bd1', 1584151878, 2, 10),
(493, 'ticket_orden', '5d37531824', 1584151878, 2, 10),
(494, 'ticket', '58ea9ae493', 1584238338, 2, 10),
(495, 'ticket_orden', '42c7184268', 1584238338, 2, 10),
(496, 'producto', 'c88923f2d3', 1584497737, 2, 10),
(497, 'ticket', 'f21c5aa8f7', 1584324825, 2, 10),
(498, 'ticket_orden', '820c898a7c', 1584324825, 2, 10),
(499, 'ticket', 'd0e7877425', 1584324836, 2, 10),
(500, 'ticket_orden', 'd580831374', 1584324836, 2, 10),
(501, 'producto', 'bb237f950e', 1584411270, 2, 10),
(502, 'ticket', '400eb47b17', 1584411272, 2, 10),
(503, 'ticket_orden', 'ac9acca40a', 1584411272, 2, 10),
(504, 'ticket', '5d1d70edf5', 1584411285, 2, 10),
(505, 'ticket_orden', '0f1f7e525e', 1584411285, 2, 10),
(506, 'ticket', '0554c4e1d8', 1584411298, 2, 10),
(507, 'ticket_orden', '7d784b7393', 1584411299, 2, 10),
(508, 'ticket', '0166d3c916', 1584497741, 2, 10),
(509, 'ticket_orden', '7d49557ed6', 1584497741, 2, 10),
(510, 'producto', '2c1d1d95bd', 1584497748, 2, 10),
(511, 'ticket', 'a2bcbaf7aa', 1584497751, 2, 10),
(512, 'ticket_orden', '92ea8a877d', 1584497751, 2, 10),
(513, 'ticket', '84a45e982a', 1584584236, 2, 10),
(514, 'ticket_orden', 'f94721319f', 1584584237, 2, 10),
(515, 'producto', '125a435efe', 1584654317, 2, 10),
(516, 'ticket', 'dcb1bb617c', 1584584248, 2, 10),
(517, 'ticket_orden', 'ac7709ebc3', 1584584248, 2, 10),
(518, 'ticket', '796adef995', 1584584262, 2, 10),
(519, 'ticket_orden', 'e845d67bd9', 1584584262, 2, 10),
(520, 'ticket', 'd86e648b40', 1584654361, 2, 10),
(521, 'producto', '3930c1b9ab', 1584654358, 2, 10),
(522, 'ticket', '8487762333', 1584654340, 2, 10),
(523, 'ticket_orden', '4ca0efd304', 1584654361, 2, 10),
(524, 'ticket', '30acb92119', 1584654369, 2, 10),
(525, 'ticket_orden', '76c85dc124', 1584654369, 2, 10),
(526, 'ticket', '0a619c4af2', 1584654384, 2, 10),
(527, 'ticket_orden', '236f9da8cc', 1584654384, 2, 10),
(528, 'producto', 'c07a933eed', 1584654872, 2, 10),
(529, 'ticket', 'be9674a525', 1584654861, 2, 10),
(530, 'ticket', 'be9674a525', 1584654872, 1, 10),
(531, 'ticket_orden', 'a77d1b5d00', 1584654872, 1, 10),
(532, 'ticket', '0f71cfe615', 1584655153, 2, 10),
(533, 'ticket_orden', '7dfed48e88', 1584655153, 2, 10),
(534, 'corte_diario', '2742516902', 1584659093, 2, 10),
(535, 'cotizaciones', '66dd828e47', 1584752436, 2, 11),
(536, 'cotizaciones_data', '3709a34ecd', 1584752465, 2, 11),
(537, 'cotizaciones', 'b3ec5ab4d3', 1584752463, 2, 11),
(538, 'ticket', 'e6bcf19121', 1584752501, 2, 11),
(539, 'ticket_orden', '4b85dc9eb7', 1584752501, 2, 11),
(540, 'ticket', '8080e3dccc', 1584752532, 1, 11),
(541, 'ticket_orden', 'b16c57c8f6', 1584752532, 1, 11),
(542, 'ticket_orden', 'bc22176d88', 1584752539, 2, 11),
(543, 'ticket', '6192e80592', 1584752541, 1, 11),
(544, 'ticket_orden', 'bc22176d88', 1584752541, 1, 11),
(545, 'ticket', '6069788410', 1585005130, 2, 11),
(546, 'ticket', '00ff1b884f', 1585005268, 1, 11),
(547, 'ticket', 'c5cd62761a', 1585005268, 1, 11),
(548, 'ticket', '94794385c7', 1585005269, 1, 11),
(549, 'ticket', '6069788410', 1585005269, 1, 11),
(550, 'ticket_orden', '1ffc6bb2a7', 1585005269, 1, 11),
(551, 'ticket', 'ee48b3fdd8', 1585005282, 1, 11),
(552, 'ticket', '955e22def5', 1585005282, 1, 11),
(553, 'ticket_orden', '189990145d', 1585005283, 1, 11),
(554, 'ticket', '84124445c0', 1590495850, 2, 11),
(555, 'ticket', '84124445c0', 1590497763, 1, 11),
(556, 'ticket_orden', 'be48e2af2a', 1590497763, 1, 11),
(557, 'producto', '8adccf87dc', 1590497872, 2, 11),
(558, 'producto', '69a3ec574f', 1590497915, 2, 11),
(559, 'ticket', 'b0b6a4b7c2', 1590499811, 2, 11),
(560, 'ticket', 'b0b6a4b7c2', 1590499813, 1, 11),
(561, 'ticket_orden', '1cec516b64', 1590499813, 1, 11),
(562, 'ticket', '73a1637ed8', 1590500266, 1, 11),
(563, 'ticket', '4565302c54', 1590500267, 1, 11),
(564, 'ticket_orden', 'ec286ff666', 1590500267, 1, 11),
(565, 'ticket', '5d50b0a64c', 1590500272, 1, 11),
(566, 'ticket_orden', '7e22879f86', 1590500273, 1, 11),
(567, 'clientes', '9811234b6f', 1590500464, 2, 11),
(568, 'ticket', 'f038d21b3b', 1590500753, 2, 11),
(569, 'ticket', 'c778387b70', 1590500761, 2, 11),
(570, 'ticket', '6846c393ba', 1590500766, 1, 11),
(571, 'ticket', '6d30ab5e4f', 1590500767, 1, 11),
(572, 'ticket', 'f038d21b3b', 1590500768, 1, 11),
(573, 'ticket', '8ed7bcc084', 1590500769, 1, 11),
(574, 'ticket', '02025ebf09', 1590500770, 1, 11),
(575, 'ticket', 'c778387b70', 1590500770, 1, 11),
(576, 'ticket', '8a6f1c726e', 1590500771, 1, 11),
(577, 'ticket_orden', 'f30baf5794', 1590500771, 1, 11),
(578, 'ticket', '3f3fbbf292', 1590500813, 1, 11),
(579, 'ticket', '80e5d1f281', 1590500813, 1, 11),
(580, 'ticket_orden', '7867ea4ded', 1590500814, 1, 11),
(581, 'ticket', 'a000abf4d0', 1590501356, 2, 11),
(582, 'ticket', 'a000abf4d0', 1590501360, 1, 11),
(583, 'ticket_orden', 'b5e0102e5a', 1590501361, 1, 11),
(584, 'producto_ingresado', '07b14fced2', 1590625914, 2, 11),
(585, 'producto_ingresado', '7f7fd5f3b1', 1590625914, 2, 11),
(586, 'producto_ingresado', '93905b18b2', 1590624018, 2, 11),
(587, 'producto_ingresado', '4f5f810c16', 1590625914, 2, 11),
(588, 'producto_ingresado', '5dae9e4630', 1590625914, 2, 11),
(589, 'producto_ingresado', 'c5a650f736', 1590625912, 2, 11),
(590, 'producto_ingresado', '5bb6ac5d32', 1590625912, 2, 11),
(591, 'producto_ingresado', '5c6f4d08aa', 1590625912, 2, 11),
(592, 'producto_ingresado', '09f0292203', 1590625913, 2, 11),
(593, 'producto_ingresado', 'eca2a76d11', 1590625913, 2, 11),
(594, 'producto_ingresado', 'adf8c3712b', 1590625913, 2, 11),
(595, 'producto_ingresado', 'a627174cda', 1590625913, 2, 11),
(596, 'producto_ingresado', '7d0724aae4', 1590625913, 2, 11),
(597, 'producto_ingresado', 'b200d69c72', 1590625913, 2, 11),
(598, 'producto_ingresado', 'a3bb2cebfb', 1590625913, 2, 11),
(599, 'producto_ingresado', '8ae69320ee', 1590625913, 2, 11),
(600, 'producto_ingresado', '142c3c6cf8', 1590625913, 2, 11),
(601, 'producto_ingresado', '641b6f0e3e', 1590625914, 2, 11),
(602, 'producto_ingresado', 'a1ec6e6ad0', 1590625914, 2, 11),
(603, 'ticket', '0d84a8a5d9', 1590633116, 2, 11),
(604, 'ticket', '17240b1439', 1590633121, 2, 11),
(605, 'ticket', '1c2922720f', 1590633129, 2, 11),
(606, 'ticket', '1c2922720f', 1590633133, 1, 11),
(607, 'ticket', '0d84a8a5d9', 1590633136, 1, 11),
(608, 'ticket', '17240b1439', 1590633136, 1, 11),
(609, 'ticket', '5dd9a98195', 1590633137, 1, 11),
(610, 'ticket_orden', '90181cfa07', 1590633137, 1, 11),
(611, 'ticket', '0fe4f7f253', 1590635374, 2, 11),
(612, 'ticket', '19e0d0635b', 1590635380, 2, 11),
(613, 'ticket', '7b18e372da', 1590635384, 1, 11),
(614, 'ticket', '0fe4f7f253', 1590635385, 1, 11),
(615, 'ticket', '0f0c5c1a14', 1590635385, 1, 11),
(616, 'ticket', '19e0d0635b', 1590635385, 1, 11),
(617, 'ticket', 'fc467ceb62', 1590635385, 1, 11),
(618, 'ticket_orden', '8dc3d10e61', 1590635385, 1, 11),
(619, 'ticket', 'f2962c31a0', 1592220134, 2, 11),
(620, 'ticket', '059b52fb79', 1592220138, 2, 11),
(621, 'ticket', 'f2962c31a0', 1592220157, 1, 11),
(622, 'ticket', 'e5279f4ec5', 1592220157, 1, 11),
(623, 'ticket', '059b52fb79', 1592220158, 1, 11),
(624, 'ticket', '1391702347', 1592220159, 1, 11),
(625, 'ticket', 'eeba8c9978', 1592220211, 2, 11),
(626, 'ticket_orden', 'bcec8281e3', 1592220229, 2, 11),
(627, 'ticket', 'eeba8c9978', 1592220232, 1, 11),
(628, 'ticket', '95daa26f13', 1592220232, 1, 11),
(629, 'ticket_orden', 'bcec8281e3', 1592220233, 1, 11),
(630, 'ticket', '5498a16c95', 1592220247, 1, 11),
(631, 'ticket_orden', 'a9fe303a9e', 1592220247, 1, 11),
(632, 'ticket', 'e14f7603cc', 1592220265, 1, 11),
(633, 'ticket_orden', 'd981de4351', 1592220265, 1, 11);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sync_up`
--

CREATE TABLE `sync_up` (
  `id` int(6) NOT NULL,
  `creado` int(2) NOT NULL COMMENT '0 = no, 1 = si',
  `subido` int(2) NOT NULL COMMENT '0 = no, 1 = si',
  `ejecutado` int(2) NOT NULL COMMENT '0 = no, 1 = si',
  `fecha` varchar(30) NOT NULL,
  `hora` varchar(30) NOT NULL,
  `fechaF` varchar(40) NOT NULL,
  `comprobacion` varchar(100) NOT NULL,
  `inicio` int(12) NOT NULL,
  `final` int(12) NOT NULL,
  `hash` varchar(12) NOT NULL,
  `time` int(12) NOT NULL,
  `td` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `sync_up`
--

INSERT INTO `sync_up` (`id`, `creado`, `subido`, `ejecutado`, `fecha`, `hora`, `fechaF`, `comprobacion`, `inicio`, `final`, `hash`, `time`, `td`) VALUES
(2, 1, 0, 0, '01-03-2020', '17:21:26', '1583042400', '1583104886-10-84c214860bbf7a4746fa43211d53ebff', 0, 1583104886, 'daeb79b31f', 1583104886, 10),
(3, 1, 0, 0, '02-03-2020', '17:26:21', '1583128800', '1583191581-10-8a33e96606f7595ba4affd78774751fc', 1583104886, 1583191581, '414197c35d', 1583191581, 10),
(6, 1, 0, 0, '03-03-2020', '18:01:17', '1583215200', '1583280077-10-f87a71448d83bf66cd085692da415af8', 1583191581, 1583280077, '67248e69e3', 1583280077, 10),
(7, 1, 0, 0, '03-03-2020', '18:13:27', '1583215200', '1583280807-10-6d1bf22f25c53ec14c962ff14a0fb8a4', 1583280077, 1583280807, '4d05271a9b', 1583280807, 10),
(10, 1, 0, 0, '04-03-2020', '18:32:37', '1583301600', '1583368357-10-b83c06d728d791bb66fba59f077f8b28', 1583280807, 1583368357, '4b0716c877', 1583368357, 10),
(12, 1, 0, 0, '05-03-2020', '18:45:23', '1583388000', '1583455523-10-cb524f775e609765e5acd0200a069c94', 1583368357, 1583455523, 'b53fa0afe1', 1583455523, 10),
(25, 1, 0, 0, '17-03-2020', '19:48:32', '1584424800', '1584496112-10-b4df034c0b3b43dd5655bbf67ee29d08', 1583455523, 1584496112, '7ac114a40e', 1584496112, 10),
(26, 1, 0, 0, '18-03-2020', '19:52:32', '1584511200', '1584582752-10-1d007ab66e79460f0504f438864eb086', 1584496112, 1584582752, 'f197ac3c24', 1584582752, 10),
(39, 1, 0, 0, '18-03-2020', '20:19:48', '1584511200', '1584584388-10-0d4f4c6661dafd11d42771c32744d959', 1584582752, 1584584388, '84738b0e38', 1584584388, 10),
(40, 1, 0, 0, '19-03-2020', '16:55:08', '1584597600', '1584658508-10-ece5c5fe45e64d7b2ba64c0fe84ba379', 1584584388, 1584658508, 'ae9d9beee3', 1584658508, 10),
(41, 1, 0, 0, '19-03-2020', '17:05:08', '1584597600', '1584659108-10-4caf4650537f7a97d6d2070c414272fe', 1584658508, 1584659108, 'fac3661f19', 1584659108, 10);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sync_up_cloud`
--

CREATE TABLE `sync_up_cloud` (
  `id` int(6) NOT NULL,
  `creado` int(2) NOT NULL COMMENT '0 = no, 1 = si',
  `subido` int(2) NOT NULL COMMENT '0 = no, 1 = si',
  `ejecutado` int(2) NOT NULL COMMENT '0 = no, 1 = si',
  `fecha` varchar(30) NOT NULL,
  `hora` varchar(30) NOT NULL,
  `fechaF` varchar(40) NOT NULL,
  `comprobacion` varchar(100) NOT NULL,
  `inicio` int(12) NOT NULL,
  `final` int(12) NOT NULL,
  `hash` varchar(12) NOT NULL,
  `time` int(12) NOT NULL,
  `td` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ticket`
--

CREATE TABLE `ticket` (
  `id` int(6) NOT NULL,
  `cod` int(4) NOT NULL,
  `cant` int(4) NOT NULL,
  `producto` varchar(100) NOT NULL,
  `pv` float(10,2) NOT NULL,
  `stotal` float(10,2) NOT NULL,
  `imp` float(10,2) NOT NULL,
  `total` float(10,2) NOT NULL,
  `num_fac` int(6) NOT NULL,
  `descuento` float(10,2) DEFAULT '0.00',
  `fecha` varchar(20) NOT NULL,
  `hora` varchar(20) NOT NULL,
  `orden` int(6) NOT NULL,
  `cajero` varchar(100) NOT NULL,
  `tipo_pago` varchar(30) NOT NULL COMMENT '1 efectivo 2 tarjeta 3 credito',
  `user` varchar(100) NOT NULL,
  `tx` int(2) NOT NULL,
  `fechaF` varchar(50) NOT NULL,
  `edo` int(2) NOT NULL COMMENT 'a= activo, 2= eliminada',
  `hash` varchar(12) NOT NULL,
  `time` int(12) NOT NULL,
  `td` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `ticket`
--

INSERT INTO `ticket` (`id`, `cod`, `cant`, `producto`, `pv`, `stotal`, `imp`, `total`, `num_fac`, `descuento`, `fecha`, `hora`, `orden`, `cajero`, `tipo_pago`, `user`, `tx`, `fechaF`, `edo`, `hash`, `time`, `td`) VALUES
(2, 1005, 1, '4 PACK UNDERWOOD JAMON DEL DIABLO 120 G', 9.40, 8.32, 1.08, 9.40, 1, 0.00, '01-03-2020', '17:02:17', 1, 'Abarrotes Admin', '1', 'a9166cd5465a89b70f144e4cb4700a5054f4d2cb', 1, '1583042400', 1, 'af3d539bc0', 1583103785, 11),
(3, 1014, 2, 'CEREAL KOMPLETE PASAS Y MANZANA 460 G', 3.25, 5.75, 0.75, 6.50, 1, 0.00, '01-03-2020', '17:02:49', 1, 'Abarrotes Admin', '1', 'a9166cd5465a89b70f144e4cb4700a5054f4d2cb', 1, '1583042400', 1, 'd1f7b555c8', 1583103785, 11),
(4, 1009, 1, 'ACEITE CANOLA ORISOL 3000ML PET', 7.08, 6.27, 0.81, 7.08, 1, 0.00, '01-03-2020', '17:02:58', 1, 'Abarrotes Admin', '1', 'a9166cd5465a89b70f144e4cb4700a5054f4d2cb', 1, '1583042400', 1, '7c578a8e35', 1583103785, 11),
(5, 1006, 2, 'JAMONADA BLACK LABEL 24/198 GRS HORMEL', 2.27, 4.02, 0.52, 4.54, 2, 0.00, '01-03-2020', '17:03:10', 2, 'Abarrotes Admin', '1', 'a9166cd5465a89b70f144e4cb4700a5054f4d2cb', 1, '1583042400', 1, '99160af828', 1583103800, 11),
(6, 1005, 1, '4 PACK UNDERWOOD JAMON DEL DIABLO 120 G', 9.40, 8.32, 1.08, 9.40, 2, 0.00, '01-03-2020', '17:03:13', 2, 'Abarrotes Admin', '1', 'a9166cd5465a89b70f144e4cb4700a5054f4d2cb', 1, '1583042400', 1, '004ca8483f', 1583103800, 11),
(7, 1008, 1, 'SOPA EN VASO RES MARUCHAN 12/2 25 OZ', 0.63, 0.56, 0.07, 0.63, 2, 0.00, '01-03-2020', '17:03:15', 2, 'Abarrotes Admin', '1', 'a9166cd5465a89b70f144e4cb4700a5054f4d2cb', 1, '1583042400', 1, '3e9161f187', 1583103800, 11),
(8, 1014, 1, 'CEREAL KOMPLETE PASAS Y MANZANA 460 G', 3.25, 2.88, 0.37, 3.25, 3, 0.00, '01-03-2020', '17:03:27', 3, 'Abarrotes Admin', '1', 'a9166cd5465a89b70f144e4cb4700a5054f4d2cb', 1, '1583042400', 1, '4986870b89', 1583103822, 11),
(9, 1012, 1, 'AVENA MOSH PARA FRESCO ORIGI QUAKER 600G', 2.21, 1.96, 0.25, 2.21, 3, 0.00, '01-03-2020', '17:03:30', 3, 'Abarrotes Admin', '1', 'a9166cd5465a89b70f144e4cb4700a5054f4d2cb', 1, '1583042400', 1, '0b7f8af736', 1583103822, 11),
(10, 1011, 2, 'ADEREZO P/ENSALADA RANCH LIGHT 237 ML CL', 2.10, 3.72, 0.48, 4.20, 3, 0.00, '01-03-2020', '17:03:32', 3, 'Abarrotes Admin', '1', 'a9166cd5465a89b70f144e4cb4700a5054f4d2cb', 1, '1583042400', 1, 'ad0f3e51bd', 1583103822, 11),
(11, 1001, 1, '2 PACK ARROZ BLANCO CINCO ESTRELLA LIBRA', 1.38, 1.22, 0.16, 1.38, 3, 0.00, '01-03-2020', '17:03:36', 3, 'Abarrotes Admin', '1', 'a9166cd5465a89b70f144e4cb4700a5054f4d2cb', 1, '1583042400', 1, 'b1ed2ebaa2', 1583103822, 11),
(12, 1004, 1, '2PACK BEBIDA LACTEA SMILK 350 GRAMOS', 3.70, 3.27, 0.43, 3.70, 3, 0.00, '01-03-2020', '17:03:38', 3, 'Abarrotes Admin', '1', 'a9166cd5465a89b70f144e4cb4700a5054f4d2cb', 1, '1583042400', 1, '07ade1ecc1', 1583103822, 11),
(13, 1004, 1, '2PACK BEBIDA LACTEA SMILK 350 GRAMOS', 3.70, 3.27, 0.43, 3.70, 4, 0.00, '01-03-2020', '17:03:51', 4, 'Abarrotes Admin', '2', 'a9166cd5465a89b70f144e4cb4700a5054f4d2cb', 1, '1583042400', 1, 'c36e90c5fe', 1583103844, 11),
(14, 1006, 1, 'JAMONADA BLACK LABEL 24/198 GRS HORMEL', 2.27, 2.01, 0.26, 2.27, 4, 0.00, '01-03-2020', '17:03:52', 4, 'Abarrotes Admin', '2', 'a9166cd5465a89b70f144e4cb4700a5054f4d2cb', 1, '1583042400', 1, '91663cbf51', 1583103844, 11),
(15, 1009, 1, 'ACEITE CANOLA ORISOL 3000ML PET', 7.08, 6.27, 0.81, 7.08, 4, 0.00, '01-03-2020', '17:03:53', 4, 'Abarrotes Admin', '2', 'a9166cd5465a89b70f144e4cb4700a5054f4d2cb', 1, '1583042400', 1, '2695759b65', 1583103844, 11),
(16, 1005, 2, '4 PACK UNDERWOOD JAMON DEL DIABLO 120 G', 9.40, 16.64, 2.16, 18.80, 4, 0.00, '01-03-2020', '17:03:55', 4, 'Abarrotes Admin', '2', 'a9166cd5465a89b70f144e4cb4700a5054f4d2cb', 1, '1583042400', 1, '2aeaea9543', 1583103844, 11),
(17, 1005, 1, '4 PACK UNDERWOOD JAMON DEL DIABLO 120 G', 9.40, 8.32, 1.08, 9.40, 5, 0.00, '01-03-2020', '17:04:09', 5, 'Abarrotes Admin', '2', 'a9166cd5465a89b70f144e4cb4700a5054f4d2cb', 1, '1583042400', 1, 'b3daa97e0c', 1583103858, 11),
(18, 1004, 1, '2PACK BEBIDA LACTEA SMILK 350 GRAMOS', 3.70, 3.27, 0.43, 3.70, 5, 0.00, '01-03-2020', '17:04:10', 5, 'Abarrotes Admin', '2', 'a9166cd5465a89b70f144e4cb4700a5054f4d2cb', 1, '1583042400', 1, '197845fb9b', 1583103858, 11),
(19, 1003, 1, '2 PACK HARINA DE MAIZ DANY 907 G', 1.49, 1.32, 0.17, 1.49, 5, 0.00, '01-03-2020', '17:04:13', 5, 'Abarrotes Admin', '2', 'a9166cd5465a89b70f144e4cb4700a5054f4d2cb', 1, '1583042400', 1, 'c8e2ee2045', 1583103858, 11),
(20, 1009, 1, 'ACEITE CANOLA ORISOL 3000ML PET', 7.08, 6.27, 0.81, 7.08, 6, 0.00, '01-03-2020', '17:04:23', 6, 'Abarrotes Admin', '1', 'a9166cd5465a89b70f144e4cb4700a5054f4d2cb', 1, '1583042400', 1, 'a4d87c9d62', 1583103872, 11),
(21, 1004, 2, '2PACK BEBIDA LACTEA SMILK 350 GRAMOS', 3.70, 6.55, 0.85, 7.40, 6, 0.00, '01-03-2020', '17:04:25', 6, 'Abarrotes Admin', '1', 'a9166cd5465a89b70f144e4cb4700a5054f4d2cb', 1, '1583042400', 1, '2ca5b7f295', 1583103872, 11),
(22, 1005, 1, '4 PACK UNDERWOOD JAMON DEL DIABLO 120 G', 9.40, 8.32, 1.08, 9.40, 6, 0.00, '01-03-2020', '17:04:26', 6, 'Abarrotes Admin', '1', 'a9166cd5465a89b70f144e4cb4700a5054f4d2cb', 1, '1583042400', 1, 'f769bd392c', 1583103872, 11),
(23, 1006, 2, 'JAMONADA BLACK LABEL 24/198 GRS HORMEL', 2.04, 3.62, 0.47, 4.09, 7, 0.45, '01-03-2020', '17:06:23', 7, 'Abarrotes Admin', '1', 'a9166cd5465a89b70f144e4cb4700a5054f4d2cb', 1, '1583042400', 1, 'b31901e13a', 1583104002, 11),
(24, 1004, 1, '2PACK BEBIDA LACTEA SMILK 350 GRAMOS', 3.33, 2.95, 0.38, 3.33, 7, 0.37, '01-03-2020', '17:06:24', 7, 'Abarrotes Admin', '1', 'a9166cd5465a89b70f144e4cb4700a5054f4d2cb', 1, '1583042400', 1, 'dab1e0905d', 1583104002, 11),
(25, 1008, 1, 'SOPA EN VASO RES MARUCHAN 12/2 25 OZ', 0.57, 0.50, 0.07, 0.57, 7, 0.06, '01-03-2020', '17:06:26', 7, 'Abarrotes Admin', '1', 'a9166cd5465a89b70f144e4cb4700a5054f4d2cb', 1, '1583042400', 1, 'ae785b916d', 1583104002, 11),
(26, 1006, 1, 'JAMONADA BLACK LABEL 24/198 GRS HORMEL', 2.27, 2.01, 0.26, 2.27, 8, 0.00, '01-03-2020', '17:06:48', 8, 'Abarrotes Admin', '3', 'a9166cd5465a89b70f144e4cb4700a5054f4d2cb', 1, '1583042400', 1, 'ac54ee99a2', 1583104031, 11),
(27, 1004, 1, '2PACK BEBIDA LACTEA SMILK 350 GRAMOS', 3.70, 3.27, 0.43, 3.70, 8, 0.00, '01-03-2020', '17:06:49', 8, 'Abarrotes Admin', '3', 'a9166cd5465a89b70f144e4cb4700a5054f4d2cb', 1, '1583042400', 1, 'e9e16c7b53', 1583104031, 11),
(28, 1005, 1, '4 PACK UNDERWOOD JAMON DEL DIABLO 120 G', 9.40, 8.32, 1.08, 9.40, 8, 0.00, '01-03-2020', '17:06:50', 8, 'Abarrotes Admin', '3', 'a9166cd5465a89b70f144e4cb4700a5054f4d2cb', 1, '1583042400', 1, '57063d7d8a', 1583104031, 11),
(29, 1007, 2, '6PACK SOPAS INSTANTANEA LAKY MEN 64GR', 2.95, 5.22, 0.68, 5.90, 8, 0.00, '01-03-2020', '17:06:52', 8, 'Abarrotes Admin', '3', 'a9166cd5465a89b70f144e4cb4700a5054f4d2cb', 1, '1583042400', 1, 'dd70cb97f6', 1583104031, 11),
(30, 1006, 1, 'JAMONADA BLACK LABEL 24/198 GRS HORMEL', 2.27, 2.01, 0.26, 2.27, 9, 0.00, '01-03-2020', '17:07:17', 9, 'Abarrotes Admin', '3', 'a9166cd5465a89b70f144e4cb4700a5054f4d2cb', 1, '1583042400', 1, '77d8317b12', 1583104055, 11),
(31, 1004, 2, '2PACK BEBIDA LACTEA SMILK 350 GRAMOS', 3.70, 6.55, 0.85, 7.40, 9, 0.00, '01-03-2020', '17:07:18', 9, 'Abarrotes Admin', '3', 'a9166cd5465a89b70f144e4cb4700a5054f4d2cb', 1, '1583042400', 1, '24e8de71c6', 1583104055, 11),
(32, 1001, 3, 'ABRAZADERA STRUT 1/2 TOPAZ', 0.95, 2.52, 0.33, 2.85, 1, 0.00, '01-03-2020', '17:11:26', 1, 'Admin Ferreteria', '1', '1321247b13afc962352b12dc3545ba06c206afdf', 1, '1583042400', 1, '6420884013', 1583104304, 10),
(33, 1004, 2, 'CEMENTO GRIS CUSCATLáN, BOLSA DE 42.5 KGS', 8.20, 14.51, 1.89, 16.40, 1, 0.00, '01-03-2020', '17:11:33', 1, 'Admin Ferreteria', '1', '1321247b13afc962352b12dc3545ba06c206afdf', 1, '1583042400', 1, '2ae42391d1', 1583104304, 10),
(34, 1011, 1, 'CAJA PARA HERRAMIENTAS PLáSTICA DE 26PLG', 45.00, 39.82, 5.18, 45.00, 1, 0.00, '01-03-2020', '17:11:38', 1, 'Admin Ferreteria', '1', '1321247b13afc962352b12dc3545ba06c206afdf', 1, '1583042400', 1, '1402e4ad74', 1583104304, 10),
(35, 1012, 1, 'JUEGO DE LLAVES MIXTAS 6-19 MM, SET 9 PZS', 12.75, 11.28, 1.47, 12.75, 2, 0.00, '01-03-2020', '17:12:59', 2, 'Admin Ferreteria', '1', '1321247b13afc962352b12dc3545ba06c206afdf', 1, '1583042400', 1, '245f791b85', 1583104392, 10),
(36, 1014, 3, 'FOCO CLARO GE 60W-130V 24651/3', 0.70, 1.86, 0.24, 2.10, 2, 0.00, '01-03-2020', '17:13:03', 2, 'Admin Ferreteria', '1', '1321247b13afc962352b12dc3545ba06c206afdf', 1, '1583042400', 1, '16fa08707d', 1583104392, 10),
(37, 1004, 1, 'CEMENTO GRIS CUSCATLáN, BOLSA DE 42.5 KGS', 8.20, 7.26, 0.94, 8.20, 2, 0.00, '01-03-2020', '17:13:06', 2, 'Admin Ferreteria', '1', '1321247b13afc962352b12dc3545ba06c206afdf', 1, '1583042400', 1, 'ec493aed9b', 1583104392, 10),
(38, 1003, 5, 'CEMENTO BLANCO, BOLSA DE 42.5 KGS.', 8.20, 36.28, 4.72, 41.00, 3, 0.00, '01-03-2020', '17:13:18', 3, 'Admin Ferreteria', '1', '1321247b13afc962352b12dc3545ba06c206afdf', 1, '1583042400', 1, '2e7fee7cb8', 1583104405, 10),
(39, 1008, 1, 'NAVAJA PARA ELECTRICISTA', 4.60, 4.07, 0.53, 4.60, 3, 0.00, '01-03-2020', '17:13:22', 3, 'Admin Ferreteria', '1', '1321247b13afc962352b12dc3545ba06c206afdf', 1, '1583042400', 1, '50adad61ee', 1583104405, 10),
(40, 1009, 1, 'TENAZA MULTIUSO 16 EN 1 CON ESTUCHE Y LUZ LED', 13.25, 11.73, 1.52, 13.25, 4, 0.00, '01-03-2020', '17:13:31', 4, 'Admin Ferreteria', '1', '1321247b13afc962352b12dc3545ba06c206afdf', 1, '1583042400', 1, '320e6395df', 1583104414, 10),
(41, 1005, 4, 'DECOBLOCK BLANCO HUESO GRANO MEDIO, BOLSA DE 40 KGS.', 8.70, 30.80, 4.00, 34.80, 5, 0.00, '01-03-2020', '17:13:41', 5, 'Admin Ferreteria', '3', '1321247b13afc962352b12dc3545ba06c206afdf', 1, '1583042400', 1, '98058658b2', 1583104449, 10),
(42, 1004, 4, 'CEMENTO GRIS CUSCATLáN, BOLSA DE 42.5 KGS', 8.20, 29.03, 3.77, 32.80, 5, 0.00, '01-03-2020', '17:13:47', 5, 'Admin Ferreteria', '3', '1321247b13afc962352b12dc3545ba06c206afdf', 1, '1583042400', 1, 'c0eaad9e98', 1583104449, 10),
(43, 1002, 1, 'CEMENTO BLANCO, BOLSA DE 42.5 KGS.', 17.50, 15.49, 2.01, 17.50, 6, 0.00, '01-03-2020', '17:14:14', 6, 'Admin Ferreteria', '2', '1321247b13afc962352b12dc3545ba06c206afdf', 1, '1583042400', 1, '636d6fa473', 1583104470, 10),
(44, 1005, 4, 'DECOBLOCK BLANCO HUESO GRANO MEDIO, BOLSA DE 40 KGS.', 8.70, 30.80, 4.00, 34.80, 6, 0.00, '01-03-2020', '17:14:19', 6, 'Admin Ferreteria', '2', '1321247b13afc962352b12dc3545ba06c206afdf', 1, '1583042400', 1, '889c030985', 1583104470, 10),
(45, 1017, 3, 'EXTENSIóN ELéCTRICA DE 15 MTS, 3 SALIDAS, 16/3 AWG.', 32.95, 87.48, 11.37, 98.85, 7, 0.00, '01-03-2020', '17:17:17', 7, 'Admin Ferreteria', '3', '1321247b13afc962352b12dc3545ba06c206afdf', 1, '1583042400', 1, 'c2c10012f5', 1583104821, 10),
(46, 1001, 1, 'ABRAZADERA STRUT 1/2 TOPAZ', 0.95, 0.84, 0.11, 0.95, 7, 0.00, '01-03-2020', '17:17:21', 7, 'Admin Ferreteria', '3', '1321247b13afc962352b12dc3545ba06c206afdf', 1, '1583042400', 1, '14d148b0d3', 1583104821, 10),
(47, 1005, 4, 'DECOBLOCK BLANCO HUESO GRANO MEDIO, BOLSA DE 40 KGS.', 8.70, 30.80, 4.00, 34.80, 8, 0.00, '02-03-2020', '17:22:55', 8, 'Erick Nunez', '1', '3c67697e18899300a2648199a9798dffb359cab2', 1, '1583128800', 1, '925695e37c', 1583191385, 10),
(48, 1010, 2, 'CAJA PARA HERRAMIENTAS PLáSTICA DE 12PLG', 3.25, 5.75, 0.75, 6.50, 8, 0.00, '02-03-2020', '17:23:00', 8, 'Erick Nunez', '1', '3c67697e18899300a2648199a9798dffb359cab2', 1, '1583128800', 1, 'ad2b3b7666', 1583191385, 10),
(49, 1009, 1, 'TENAZA MULTIUSO 16 EN 1 CON ESTUCHE Y LUZ LED', 13.25, 11.73, 1.52, 13.25, 9, 0.00, '02-03-2020', '17:23:13', 9, 'Erick Nunez', '1', '3c67697e18899300a2648199a9798dffb359cab2', 1, '1583128800', 1, '824699f78f', 1583191403, 10),
(50, 1005, 3, 'DECOBLOCK BLANCO HUESO GRANO MEDIO, BOLSA DE 40 KGS.', 8.70, 23.10, 3.00, 26.10, 10, 0.00, '02-03-2020', '17:23:31', 10, 'Erick Nunez', '1', '3c67697e18899300a2648199a9798dffb359cab2', 1, '1583128800', 1, 'd709789f2d', 1583191416, 10),
(51, 1005, 4, 'DECOBLOCK BLANCO HUESO GRANO MEDIO, BOLSA DE 40 KGS.', 8.70, 30.80, 4.00, 34.80, 11, 0.00, '02-03-2020', '17:23:44', 11, 'Erick Nunez', '2', '3c67697e18899300a2648199a9798dffb359cab2', 1, '1583128800', 1, '2617cdcc12', 1583191432, 10),
(52, 1007, 3, 'LIMPIADOR DE CONTACTOS SECADO RáPIDO', 9.50, 25.22, 3.28, 28.50, 12, 0.00, '02-03-2020', '17:24:02', 12, 'Erick Nunez', '1', '3c67697e18899300a2648199a9798dffb359cab2', 1, '1583128800', 1, '9a0205c48d', 1583191446, 10),
(53, 1005, 1, '4 PACK UNDERWOOD JAMON DEL DIABLO 120 G', 9.40, 8.32, 1.08, 9.40, 10, 0.00, '02-03-2020', '17:31:00', 10, 'Erick Nunez', '1', '3c67697e18899300a2648199a9798dffb359cab2', 1, '1583128800', 1, '96484e969f', 1583191874, 11),
(54, 1006, 1, 'JAMONADA BLACK LABEL 24/198 GRS HORMEL', 2.27, 2.01, 0.26, 2.27, 10, 0.00, '02-03-2020', '17:31:03', 10, 'Erick Nunez', '1', '3c67697e18899300a2648199a9798dffb359cab2', 1, '1583128800', 1, '6139a2e6c8', 1583191874, 11),
(55, 1003, 1, '2 PACK HARINA DE MAIZ DANY 907 G', 1.49, 1.32, 0.17, 1.49, 10, 0.00, '02-03-2020', '17:31:05', 10, 'Erick Nunez', '1', '3c67697e18899300a2648199a9798dffb359cab2', 1, '1583128800', 1, '992880f47b', 1583191874, 11),
(56, 1004, 1, '2PACK BEBIDA LACTEA SMILK 350 GRAMOS', 3.70, 3.27, 0.43, 3.70, 10, 0.00, '02-03-2020', '17:31:09', 10, 'Erick Nunez', '1', '3c67697e18899300a2648199a9798dffb359cab2', 1, '1583128800', 1, '0579278e76', 1583191874, 11),
(57, 1005, 1, '4 PACK UNDERWOOD JAMON DEL DIABLO 120 G', 9.40, 8.32, 1.08, 9.40, 11, 0.00, '02-03-2020', '17:31:20', 11, 'Erick Nunez', '1', '3c67697e18899300a2648199a9798dffb359cab2', 1, '1583128800', 1, '77638ab2bb', 1583191891, 11),
(58, 1009, 1, 'ACEITE CANOLA ORISOL 3000ML PET', 7.08, 6.27, 0.81, 7.08, 11, 0.00, '02-03-2020', '17:31:22', 11, 'Erick Nunez', '1', '3c67697e18899300a2648199a9798dffb359cab2', 1, '1583128800', 1, 'a20d19c429', 1583191891, 11),
(59, 1012, 1, 'AVENA MOSH PARA FRESCO ORIGI QUAKER 600G', 2.21, 1.96, 0.25, 2.21, 11, 0.00, '02-03-2020', '17:31:23', 11, 'Erick Nunez', '1', '3c67697e18899300a2648199a9798dffb359cab2', 1, '1583128800', 1, 'a27e72eb71', 1583191891, 11),
(60, 1004, 1, '2PACK BEBIDA LACTEA SMILK 350 GRAMOS', 3.70, 3.27, 0.43, 3.70, 11, 0.00, '02-03-2020', '17:31:26', 11, 'Erick Nunez', '1', '3c67697e18899300a2648199a9798dffb359cab2', 1, '1583128800', 1, 'ed2b062ec2', 1583191891, 11),
(61, 1004, 3, '2PACK BEBIDA LACTEA SMILK 350 GRAMOS', 3.70, 9.82, 1.28, 11.10, 12, 0.00, '02-03-2020', '17:31:36', 12, 'Erick Nunez', '2', '3c67697e18899300a2648199a9798dffb359cab2', 1, '1583128800', 1, '2fc42ccb52', 1583191915, 11),
(62, 1009, 1, 'ACEITE CANOLA ORISOL 3000ML PET', 7.08, 6.27, 0.81, 7.08, 12, 0.00, '02-03-2020', '17:31:39', 12, 'Erick Nunez', '2', '3c67697e18899300a2648199a9798dffb359cab2', 1, '1583128800', 1, '6378550977', 1583191915, 11),
(63, 1005, 2, '4 PACK UNDERWOOD JAMON DEL DIABLO 120 G', 9.40, 16.64, 2.16, 18.80, 12, 0.00, '02-03-2020', '17:31:42', 12, 'Erick Nunez', '2', '3c67697e18899300a2648199a9798dffb359cab2', 1, '1583128800', 1, 'f762d8e402', 1583191915, 11),
(64, 1006, 1, 'JAMONADA BLACK LABEL 24/198 GRS HORMEL', 2.27, 2.01, 0.26, 2.27, 13, 0.00, '02-03-2020', '17:32:00', 13, 'Erick Nunez', '1', '3c67697e18899300a2648199a9798dffb359cab2', 1, '1583128800', 1, '4588c19b96', 1583191931, 11),
(65, 1005, 1, '4 PACK UNDERWOOD JAMON DEL DIABLO 120 G', 9.40, 8.32, 1.08, 9.40, 13, 0.00, '02-03-2020', '17:32:02', 13, 'Erick Nunez', '1', '3c67697e18899300a2648199a9798dffb359cab2', 1, '1583128800', 1, 'f9512c18ab', 1583191931, 11),
(66, 1012, 1, 'AVENA MOSH PARA FRESCO ORIGI QUAKER 600G', 2.21, 1.96, 0.25, 2.21, 13, 0.00, '02-03-2020', '17:32:04', 13, 'Erick Nunez', '1', '3c67697e18899300a2648199a9798dffb359cab2', 1, '1583128800', 1, '727e32a492', 1583191931, 11),
(67, 1014, 1, 'CEREAL KOMPLETE PASAS Y MANZANA 460 G', 3.25, 2.88, 0.37, 3.25, 13, 0.00, '02-03-2020', '17:32:07', 13, 'Erick Nunez', '1', '3c67697e18899300a2648199a9798dffb359cab2', 1, '1583128800', 1, 'e5c018ea6a', 1583191931, 11),
(68, 1009, 4, 'ACEITE CANOLA ORISOL 3000ML PET', 7.08, 25.06, 3.26, 28.32, 14, 0.00, '02-03-2020', '17:32:16', 14, 'Erick Nunez', '1', '3c67697e18899300a2648199a9798dffb359cab2', 1, '1583128800', 1, 'a709c6e860', 1583191957, 11),
(69, 1005, 3, '4 PACK UNDERWOOD JAMON DEL DIABLO 120 G', 9.40, 24.96, 3.24, 28.20, 15, 0.00, '03-03-2020', '17:44:13', 15, 'Erick Nunez', '1', '3c67697e18899300a2648199a9798dffb359cab2', 1, '1583215200', 1, '87fc95df11', 1583279066, 11),
(70, 1009, 2, 'ACEITE CANOLA ORISOL 3000ML PET', 7.08, 12.53, 1.63, 14.16, 15, 0.00, '03-03-2020', '17:44:19', 15, 'Erick Nunez', '1', '3c67697e18899300a2648199a9798dffb359cab2', 1, '1583215200', 1, 'c27c0abc28', 1583279066, 11),
(71, 1014, 1, 'CEREAL KOMPLETE PASAS Y MANZANA 460 G', 3.25, 2.88, 0.37, 3.25, 16, 0.00, '03-03-2020', '17:44:34', 16, 'Erick Nunez', '1', '3c67697e18899300a2648199a9798dffb359cab2', 1, '1583215200', 1, 'a8348b773f', 1583279091, 11),
(72, 1013, 3, 'BARRA GRANOLA MIEL HELIOS 162 G', 1.45, 3.85, 0.50, 4.35, 16, 0.00, '03-03-2020', '17:44:37', 16, 'Erick Nunez', '1', '3c67697e18899300a2648199a9798dffb359cab2', 1, '1583215200', 1, 'baf3502d16', 1583279091, 11),
(73, 1014, 2, 'CEREAL KOMPLETE PASAS Y MANZANA 460 G', 3.25, 5.75, 0.75, 6.50, 17, 0.00, '03-03-2020', '17:45:07', 17, 'Erick Nunez', '2', '3c67697e18899300a2648199a9798dffb359cab2', 1, '1583215200', 1, 'fa7338164c', 1583279146, 11),
(74, 1009, 1, 'ACEITE CANOLA ORISOL 3000ML PET', 7.08, 6.27, 0.81, 7.08, 17, 0.00, '03-03-2020', '17:45:19', 17, 'Erick Nunez', '2', '3c67697e18899300a2648199a9798dffb359cab2', 1, '1583215200', 1, '314a6f9607', 1583279146, 11),
(75, 1008, 1, 'SOPA EN VASO RES MARUCHAN 12/2 25 OZ', 0.63, 0.56, 0.07, 0.63, 18, 0.00, '03-03-2020', '17:45:58', 18, 'Erick Nunez', '1', '3c67697e18899300a2648199a9798dffb359cab2', 1, '1583215200', 1, '90bb02e8dc', 1583279166, 11),
(76, 1007, 1, '6PACK SOPAS INSTANTANEA LAKY MEN 64GR', 2.95, 2.61, 0.34, 2.95, 18, 0.00, '03-03-2020', '17:46:00', 18, 'Erick Nunez', '1', '3c67697e18899300a2648199a9798dffb359cab2', 1, '1583215200', 1, '1b45c891f0', 1583279166, 11),
(77, 1006, 1, 'JAMONADA BLACK LABEL 24/198 GRS HORMEL', 2.27, 2.01, 0.26, 2.27, 18, 0.00, '03-03-2020', '17:46:01', 18, 'Erick Nunez', '1', '3c67697e18899300a2648199a9798dffb359cab2', 1, '1583215200', 1, 'e3fba3154a', 1583279166, 11),
(78, 1004, 2, '2PACK BEBIDA LACTEA SMILK 350 GRAMOS', 3.70, 6.55, 0.85, 7.40, 19, 0.00, '03-03-2020', '17:46:13', 19, 'Erick Nunez', '2', '3c67697e18899300a2648199a9798dffb359cab2', 1, '1583215200', 1, '534f5f3e0d', 1583279189, 11),
(79, 1005, 1, '4 PACK UNDERWOOD JAMON DEL DIABLO 120 G', 9.40, 8.32, 1.08, 9.40, 19, 0.00, '03-03-2020', '17:46:15', 19, 'Erick Nunez', '2', '3c67697e18899300a2648199a9798dffb359cab2', 1, '1583215200', 1, '9602978e71', 1583279189, 11),
(80, 1006, 1, 'JAMONADA BLACK LABEL 24/198 GRS HORMEL', 2.27, 2.01, 0.26, 2.27, 19, 0.00, '03-03-2020', '17:46:19', 19, 'Erick Nunez', '2', '3c67697e18899300a2648199a9798dffb359cab2', 1, '1583215200', 1, '430e1531da', 1583279189, 11),
(81, 1001, 1, 'ABRAZADERA STRUT 1/2 TOPAZ', 0.95, 0.84, 0.11, 0.95, 13, 0.00, '03-03-2020', '17:58:41', 13, 'Erick Nunez', '1', '3c67697e18899300a2648199a9798dffb359cab2', 1, '1583215200', 1, '44682dc6b3', 1583279929, 10),
(82, 1005, 4, 'DECOBLOCK BLANCO HUESO GRANO MEDIO, BOLSA DE 40 KGS.', 8.70, 30.80, 4.00, 34.80, 13, 0.00, '03-03-2020', '17:58:45', 13, 'Erick Nunez', '1', '3c67697e18899300a2648199a9798dffb359cab2', 1, '1583215200', 1, 'daad56db6a', 1583279929, 10),
(83, 1017, 1, 'EXTENSIóN ELéCTRICA DE 15 MTS, 3 SALIDAS, 16/3 AWG.', 32.95, 29.16, 3.79, 32.95, 14, 0.00, '03-03-2020', '17:58:56', 14, 'Erick Nunez', '1', '3c67697e18899300a2648199a9798dffb359cab2', 1, '1583215200', 1, '473c0fa9e2', 1583279944, 10),
(84, 1016, 2, 'EXTENSIóN PARA MECáNICO DE 50', 24.95, 44.16, 5.74, 49.90, 14, 0.00, '03-03-2020', '17:59:01', 14, 'Erick Nunez', '1', '3c67697e18899300a2648199a9798dffb359cab2', 1, '1583215200', 1, '79a2744e3e', 1583279944, 10),
(85, 1007, 1, 'LIMPIADOR DE CONTACTOS SECADO RáPIDO', 9.50, 8.41, 1.09, 9.50, 15, 0.00, '03-03-2020', '17:59:12', 15, 'Erick Nunez', '3', '3c67697e18899300a2648199a9798dffb359cab2', 1, '1583215200', 1, '48a87d4561', 1583279981, 10),
(86, 1004, 9, 'CEMENTO GRIS CUSCATLáN, BOLSA DE 42.5 KGS', 8.20, 65.31, 8.49, 73.80, 15, 0.00, '03-03-2020', '17:59:26', 15, 'Erick Nunez', '3', '3c67697e18899300a2648199a9798dffb359cab2', 1, '1583215200', 1, '2cf14ccd15', 1583279981, 10),
(87, 1005, 4, '4 PACK UNDERWOOD JAMON DEL DIABLO 120 G', 9.40, 33.27, 4.33, 37.60, 20, 0.00, '04-03-2020', '18:21:55', 20, 'Erick Nunez', '1', '3c67697e18899300a2648199a9798dffb359cab2', 1, '1583301600', 1, '0e23e3fc42', 1583367741, 11),
(88, 1004, 3, '2PACK BEBIDA LACTEA SMILK 350 GRAMOS', 3.70, 9.82, 1.28, 11.10, 20, 0.00, '04-03-2020', '18:21:57', 20, 'Erick Nunez', '1', '3c67697e18899300a2648199a9798dffb359cab2', 1, '1583301600', 1, 'fb6143c77d', 1583367741, 11),
(89, 1006, 4, 'JAMONADA BLACK LABEL 24/198 GRS HORMEL', 2.27, 8.04, 1.04, 9.08, 20, 0.00, '04-03-2020', '18:21:58', 20, 'Erick Nunez', '1', '3c67697e18899300a2648199a9798dffb359cab2', 1, '1583301600', 1, '1fc73389f5', 1583367741, 11),
(90, 1004, 2, '2PACK BEBIDA LACTEA SMILK 350 GRAMOS', 3.70, 6.55, 0.85, 7.40, 21, 0.00, '04-03-2020', '18:22:26', 21, 'Erick Nunez', '1', '3c67697e18899300a2648199a9798dffb359cab2', 1, '1583301600', 1, '482e7cd0c1', 1583367765, 11),
(91, 1005, 2, '4 PACK UNDERWOOD JAMON DEL DIABLO 120 G', 9.40, 16.64, 2.16, 18.80, 21, 0.00, '04-03-2020', '18:22:27', 21, 'Erick Nunez', '1', '3c67697e18899300a2648199a9798dffb359cab2', 1, '1583301600', 1, 'f6fdaef9cc', 1583367765, 11),
(92, 1009, 1, 'ACEITE CANOLA ORISOL 3000ML PET', 7.08, 6.27, 0.81, 7.08, 21, 0.00, '04-03-2020', '18:22:34', 21, 'Erick Nunez', '1', '3c67697e18899300a2648199a9798dffb359cab2', 1, '1583301600', 1, '83cb8e385d', 1583367765, 11),
(93, 1012, 1, 'AVENA MOSH PARA FRESCO ORIGI QUAKER 600G', 2.21, 1.96, 0.25, 2.21, 21, 0.00, '04-03-2020', '18:22:36', 21, 'Erick Nunez', '1', '3c67697e18899300a2648199a9798dffb359cab2', 1, '1583301600', 1, '1a531fa739', 1583367765, 11),
(94, 1014, 1, 'CEREAL KOMPLETE PASAS Y MANZANA 460 G', 3.25, 2.88, 0.37, 3.25, 21, 0.00, '04-03-2020', '18:22:39', 21, 'Erick Nunez', '1', '3c67697e18899300a2648199a9798dffb359cab2', 1, '1583301600', 1, '3393830a37', 1583367765, 11),
(95, 1005, 1, '4 PACK UNDERWOOD JAMON DEL DIABLO 120 G', 9.40, 8.32, 1.08, 9.40, 22, 0.00, '04-03-2020', '18:22:50', 22, 'Erick Nunez', '1', '3c67697e18899300a2648199a9798dffb359cab2', 1, '1583301600', 1, '3cbfeec60c', 1583367774, 11),
(96, 1005, 1, '4 PACK UNDERWOOD JAMON DEL DIABLO 120 G', 9.40, 8.32, 1.08, 9.40, 23, 0.00, '04-03-2020', '18:22:59', 23, 'Erick Nunez', '3', '3c67697e18899300a2648199a9798dffb359cab2', 1, '1583301600', 1, '9c3b678c7d', 1583367798, 11),
(97, 1004, 2, '2PACK BEBIDA LACTEA SMILK 350 GRAMOS', 3.70, 6.55, 0.85, 7.40, 23, 0.00, '04-03-2020', '18:23:00', 23, 'Erick Nunez', '3', '3c67697e18899300a2648199a9798dffb359cab2', 1, '1583301600', 1, '424ef19e2f', 1583367798, 11),
(98, 1006, 1, 'JAMONADA BLACK LABEL 24/198 GRS HORMEL', 2.27, 2.01, 0.26, 2.27, 23, 0.00, '04-03-2020', '18:23:02', 23, 'Erick Nunez', '3', '3c67697e18899300a2648199a9798dffb359cab2', 1, '1583301600', 1, '616d5f7178', 1583367798, 11),
(99, 1006, 1, 'JAMONADA BLACK LABEL 24/198 GRS HORMEL', 2.27, 2.01, 0.26, 2.27, 24, 0.00, '04-03-2020', '18:23:23', 24, 'Erick Nunez', '2', '3c67697e18899300a2648199a9798dffb359cab2', 1, '1583301600', 1, '7e982af132', 1583367815, 11),
(100, 1005, 1, '4 PACK UNDERWOOD JAMON DEL DIABLO 120 G', 9.40, 8.32, 1.08, 9.40, 24, 0.00, '04-03-2020', '18:23:28', 24, 'Erick Nunez', '2', '3c67697e18899300a2648199a9798dffb359cab2', 1, '1583301600', 1, '30c667c2e9', 1583367815, 11),
(101, 1014, 2, 'CEREAL KOMPLETE PASAS Y MANZANA 460 G', 3.25, 5.75, 0.75, 6.50, 25, 0.00, '04-03-2020', '18:24:19', 25, 'Erick Nunez', '1', '3c67697e18899300a2648199a9798dffb359cab2', 1, '1583301600', 1, '882ba8ee9b', 1583367875, 11),
(102, 1012, 1, 'AVENA MOSH PARA FRESCO ORIGI QUAKER 600G', 2.21, 1.96, 0.25, 2.21, 25, 0.00, '04-03-2020', '18:24:21', 25, 'Erick Nunez', '1', '3c67697e18899300a2648199a9798dffb359cab2', 1, '1583301600', 1, '7b25f8cb12', 1583367875, 11),
(103, 1013, 1, 'BARRA GRANOLA MIEL HELIOS 162 G', 1.45, 1.28, 0.17, 1.45, 25, 0.00, '04-03-2020', '18:24:22', 25, 'Erick Nunez', '1', '3c67697e18899300a2648199a9798dffb359cab2', 1, '1583301600', 1, '61f9537e85', 1583367875, 11),
(104, 1005, 1, '4 PACK UNDERWOOD JAMON DEL DIABLO 120 G', 9.40, 8.32, 1.08, 9.40, 25, 0.00, '04-03-2020', '18:24:30', 25, 'Erick Nunez', '1', '3c67697e18899300a2648199a9798dffb359cab2', 1, '1583301600', 1, 'b6d85699d4', 1583367875, 11),
(105, 1004, 4, 'CEMENTO GRIS CUSCATLáN, BOLSA DE 42.5 KGS', 8.20, 29.03, 3.77, 32.80, 16, 0.00, '04-03-2020', '18:29:05', 16, 'Erick Nunez', '1', '3c67697e18899300a2648199a9798dffb359cab2', 1, '1583301600', 1, 'c82650cd3d', 1583368153, 10),
(106, 1007, 1, 'LIMPIADOR DE CONTACTOS SECADO RáPIDO', 9.50, 8.41, 1.09, 9.50, 16, 0.00, '04-03-2020', '18:29:09', 16, 'Erick Nunez', '1', '3c67697e18899300a2648199a9798dffb359cab2', 1, '1583301600', 1, '95cfa96324', 1583368153, 10),
(107, 1007, 3, 'LIMPIADOR DE CONTACTOS SECADO RáPIDO', 9.50, 25.22, 3.28, 28.50, 17, 0.00, '04-03-2020', '18:29:20', 17, 'Erick Nunez', '2', '3c67697e18899300a2648199a9798dffb359cab2', 1, '1583301600', 1, '62a6b0d961', 1583368182, 10),
(108, 1016, 3, 'EXTENSIóN PARA MECáNICO DE 50', 24.95, 66.24, 8.61, 74.85, 17, 0.00, '04-03-2020', '18:29:30', 17, 'Erick Nunez', '2', '3c67697e18899300a2648199a9798dffb359cab2', 1, '1583301600', 1, '95b488600b', 1583368182, 10),
(109, 1017, 3, 'EXTENSIóN ELéCTRICA DE 15 MTS, 3 SALIDAS, 16/3 AWG.', 32.95, 87.48, 11.37, 98.85, 17, 0.00, '04-03-2020', '18:29:35', 17, 'Erick Nunez', '2', '3c67697e18899300a2648199a9798dffb359cab2', 1, '1583301600', 1, '97bcacf168', 1583368182, 10),
(110, 1007, 2, 'LIMPIADOR DE CONTACTOS SECADO RáPIDO', 9.50, 16.81, 2.19, 19.00, 18, 0.00, '04-03-2020', '18:29:52', 18, 'Erick Nunez', '1', '3c67697e18899300a2648199a9798dffb359cab2', 1, '1583301600', 1, '77273361f5', 1583368199, 10),
(111, 1008, 1, 'NAVAJA PARA ELECTRICISTA', 4.60, 4.07, 0.53, 4.60, 18, 0.00, '04-03-2020', '18:29:55', 18, 'Erick Nunez', '1', '3c67697e18899300a2648199a9798dffb359cab2', 1, '1583301600', 1, '221d310add', 1583368199, 10),
(112, 1003, 3, 'CEMENTO BLANCO, BOLSA DE 42.5 KGS.', 8.20, 21.77, 2.83, 24.60, 19, 0.00, '04-03-2020', '18:30:06', 19, 'Erick Nunez', '1', '3c67697e18899300a2648199a9798dffb359cab2', 1, '1583301600', 1, 'ddc8c82195', 1583368212, 10),
(113, 1003, 5, 'CEMENTO BLANCO, BOLSA DE 42.5 KGS.', 8.20, 36.28, 4.72, 41.00, 20, 0.00, '04-03-2020', '18:31:00', 20, 'Erick Nunez', '1', '3c67697e18899300a2648199a9798dffb359cab2', 1, '1583301600', 1, '772e6ea433', 1583368265, 10),
(114, 1004, 4, 'CEMENTO GRIS CUSCATLáN, BOLSA DE 42.5 KGS', 8.20, 29.03, 3.77, 32.80, 21, 0.00, '04-03-2020', '18:31:16', 21, 'Erick Nunez', '1', '3c67697e18899300a2648199a9798dffb359cab2', 1, '1583301600', 1, '6bd5f979af', 1583368285, 10),
(115, 1004, 2, '2PACK BEBIDA LACTEA SMILK 350 GRAMOS', 3.70, 6.55, 0.85, 7.40, 26, 0.00, '05-03-2020', '18:37:44', 26, 'Erick Nunez', '1', '3c67697e18899300a2648199a9798dffb359cab2', 1, '1583388000', 1, 'afcebaa15c', 1583455085, 11),
(116, 1009, 1, 'ACEITE CANOLA ORISOL 3000ML PET', 7.08, 6.27, 0.81, 7.08, 26, 0.00, '05-03-2020', '18:37:46', 26, 'Erick Nunez', '1', '3c67697e18899300a2648199a9798dffb359cab2', 1, '1583388000', 1, '8bdb988c71', 1583455085, 11),
(117, 1005, 2, '4 PACK UNDERWOOD JAMON DEL DIABLO 120 G', 9.40, 16.64, 2.16, 18.80, 26, 0.00, '05-03-2020', '18:37:53', 26, 'Erick Nunez', '1', '3c67697e18899300a2648199a9798dffb359cab2', 1, '1583388000', 1, '001360f312', 1583455085, 11),
(118, 1008, 2, 'SOPA EN VASO RES MARUCHAN 12/2 25 OZ', 0.63, 1.12, 0.14, 1.26, 26, 0.00, '05-03-2020', '18:37:59', 26, 'Erick Nunez', '1', '3c67697e18899300a2648199a9798dffb359cab2', 1, '1583388000', 1, 'aa3f31da20', 1583455085, 11),
(119, 1004, 1, '2PACK BEBIDA LACTEA SMILK 350 GRAMOS', 3.70, 3.27, 0.43, 3.70, 27, 0.00, '05-03-2020', '18:38:11', 27, 'Erick Nunez', '1', '3c67697e18899300a2648199a9798dffb359cab2', 1, '1583388000', 1, '6085683f6a', 1583455102, 11),
(120, 1002, 1, '2 PACK ARROZ BLANCO DANY 1 LB', 1.09, 0.96, 0.13, 1.09, 27, 0.00, '05-03-2020', '18:38:12', 27, 'Erick Nunez', '1', '3c67697e18899300a2648199a9798dffb359cab2', 1, '1583388000', 1, 'b316c8c34e', 1583455102, 11),
(121, 1001, 1, '2 PACK ARROZ BLANCO CINCO ESTRELLA LIBRA', 1.38, 1.22, 0.16, 1.38, 27, 0.00, '05-03-2020', '18:38:13', 27, 'Erick Nunez', '1', '3c67697e18899300a2648199a9798dffb359cab2', 1, '1583388000', 1, '39c21875ca', 1583455102, 11),
(122, 1009, 1, 'ACEITE CANOLA ORISOL 3000ML PET', 7.08, 6.27, 0.81, 7.08, 27, 0.00, '05-03-2020', '18:38:15', 27, 'Erick Nunez', '1', '3c67697e18899300a2648199a9798dffb359cab2', 1, '1583388000', 1, 'c7b91780e8', 1583455102, 11),
(123, 1012, 1, 'AVENA MOSH PARA FRESCO ORIGI QUAKER 600G', 2.21, 1.96, 0.25, 2.21, 27, 0.00, '05-03-2020', '18:38:17', 27, 'Erick Nunez', '1', '3c67697e18899300a2648199a9798dffb359cab2', 1, '1583388000', 1, '1f7f58fc17', 1583455102, 11),
(124, 1006, 1, 'JAMONADA BLACK LABEL 24/198 GRS HORMEL', 2.27, 2.01, 0.26, 2.27, 28, 0.00, '05-03-2020', '18:38:28', 28, 'Erick Nunez', '1', '3c67697e18899300a2648199a9798dffb359cab2', 1, '1583388000', 1, '1251e450b4', 1583455129, 11),
(125, 1007, 2, '6PACK SOPAS INSTANTANEA LAKY MEN 64GR', 2.95, 5.22, 0.68, 5.90, 28, 0.00, '05-03-2020', '18:38:30', 28, 'Erick Nunez', '1', '3c67697e18899300a2648199a9798dffb359cab2', 1, '1583388000', 1, '5ddc981761', 1583455129, 11),
(126, 1009, 2, 'ACEITE CANOLA ORISOL 3000ML PET', 7.08, 12.53, 1.63, 14.16, 28, 0.00, '05-03-2020', '18:38:34', 28, 'Erick Nunez', '1', '3c67697e18899300a2648199a9798dffb359cab2', 1, '1583388000', 1, '522639d902', 1583455129, 11),
(127, 1004, 2, '2PACK BEBIDA LACTEA SMILK 350 GRAMOS', 3.70, 6.55, 0.85, 7.40, 28, 0.00, '05-03-2020', '18:38:36', 28, 'Erick Nunez', '1', '3c67697e18899300a2648199a9798dffb359cab2', 1, '1583388000', 1, 'f28f2f1fff', 1583455129, 11),
(128, 1005, 1, '4 PACK UNDERWOOD JAMON DEL DIABLO 120 G', 9.40, 8.32, 1.08, 9.40, 28, 0.00, '05-03-2020', '18:38:42', 28, 'Erick Nunez', '1', '3c67697e18899300a2648199a9798dffb359cab2', 1, '1583388000', 1, '4ea0d59aa3', 1583455129, 11),
(129, 1008, 1, 'SOPA EN VASO RES MARUCHAN 12/2 25 OZ', 0.63, 0.56, 0.07, 0.63, 29, 0.00, '05-03-2020', '18:38:54', 29, 'Erick Nunez', '1', '3c67697e18899300a2648199a9798dffb359cab2', 1, '1583388000', 1, '816daed2e3', 1583455147, 11),
(130, 1009, 1, 'ACEITE CANOLA ORISOL 3000ML PET', 7.08, 6.27, 0.81, 7.08, 29, 0.00, '05-03-2020', '18:38:57', 29, 'Erick Nunez', '1', '3c67697e18899300a2648199a9798dffb359cab2', 1, '1583388000', 1, 'b37ed0bc1e', 1583455147, 11),
(131, 1004, 2, '2PACK BEBIDA LACTEA SMILK 350 GRAMOS', 3.70, 6.55, 0.85, 7.40, 29, 0.00, '05-03-2020', '18:38:59', 29, 'Erick Nunez', '1', '3c67697e18899300a2648199a9798dffb359cab2', 1, '1583388000', 1, '5a784dbe79', 1583455147, 11),
(132, 1003, 1, '2 PACK HARINA DE MAIZ DANY 907 G', 1.49, 1.32, 0.17, 1.49, 29, 0.00, '05-03-2020', '18:39:00', 29, 'Erick Nunez', '1', '3c67697e18899300a2648199a9798dffb359cab2', 1, '1583388000', 1, 'cdf40e423b', 1583455147, 11),
(133, 1012, 1, 'AVENA MOSH PARA FRESCO ORIGI QUAKER 600G', 2.21, 1.96, 0.25, 2.21, 30, 0.00, '05-03-2020', '18:39:12', 30, 'Erick Nunez', '2', '3c67697e18899300a2648199a9798dffb359cab2', 1, '1583388000', 1, '29bd2dfa20', 1583455165, 11),
(134, 1002, 1, '2 PACK ARROZ BLANCO DANY 1 LB', 1.09, 0.96, 0.13, 1.09, 30, 0.00, '05-03-2020', '18:39:16', 30, 'Erick Nunez', '2', '3c67697e18899300a2648199a9798dffb359cab2', 1, '1583388000', 1, '2867b6e3c1', 1583455165, 11),
(135, 1005, 1, '4 PACK UNDERWOOD JAMON DEL DIABLO 120 G', 9.40, 8.32, 1.08, 9.40, 30, 0.00, '05-03-2020', '18:39:19', 30, 'Erick Nunez', '2', '3c67697e18899300a2648199a9798dffb359cab2', 1, '1583388000', 1, '457243c402', 1583455165, 11),
(136, 1006, 2, 'JAMONADA BLACK LABEL 24/198 GRS HORMEL', 2.27, 4.02, 0.52, 4.54, 31, 0.00, '05-03-2020', '18:39:31', 31, 'Erick Nunez', '1', '3c67697e18899300a2648199a9798dffb359cab2', 1, '1583388000', 1, '501153e617', 1583455186, 11),
(137, 1004, 2, '2PACK BEBIDA LACTEA SMILK 350 GRAMOS', 3.70, 6.55, 0.85, 7.40, 31, 0.00, '05-03-2020', '18:39:32', 31, 'Erick Nunez', '1', '3c67697e18899300a2648199a9798dffb359cab2', 1, '1583388000', 1, 'cca67db3bd', 1583455186, 11),
(138, 1009, 1, 'ACEITE CANOLA ORISOL 3000ML PET', 7.08, 6.27, 0.81, 7.08, 31, 0.00, '05-03-2020', '18:39:34', 31, 'Erick Nunez', '1', '3c67697e18899300a2648199a9798dffb359cab2', 1, '1583388000', 1, '6c18f55cff', 1583455186, 11),
(139, 1007, 1, '6PACK SOPAS INSTANTANEA LAKY MEN 64GR', 2.95, 2.61, 0.34, 2.95, 31, 0.00, '05-03-2020', '18:39:37', 31, 'Erick Nunez', '1', '3c67697e18899300a2648199a9798dffb359cab2', 1, '1583388000', 1, 'bb17fa3f7a', 1583455186, 11),
(140, 1005, 1, '4 PACK UNDERWOOD JAMON DEL DIABLO 120 G', 9.40, 8.32, 1.08, 9.40, 31, 0.00, '05-03-2020', '18:39:41', 31, 'Erick Nunez', '1', '3c67697e18899300a2648199a9798dffb359cab2', 1, '1583388000', 1, '1aa2a01e1d', 1583455186, 11),
(141, 1006, 2, 'JAMONADA BLACK LABEL 24/198 GRS HORMEL', 2.27, 4.02, 0.52, 4.54, 32, 0.00, '05-03-2020', '18:39:51', 32, 'Erick Nunez', '1', '3c67697e18899300a2648199a9798dffb359cab2', 1, '1583388000', 1, 'b0385a7611', 1583455203, 11),
(142, 1004, 3, '2PACK BEBIDA LACTEA SMILK 350 GRAMOS', 3.70, 9.82, 1.28, 11.10, 32, 0.00, '05-03-2020', '18:39:52', 32, 'Erick Nunez', '1', '3c67697e18899300a2648199a9798dffb359cab2', 1, '1583388000', 1, '8ba44f35c6', 1583455203, 11),
(143, 1005, 1, '4 PACK UNDERWOOD JAMON DEL DIABLO 120 G', 9.40, 8.32, 1.08, 9.40, 32, 0.00, '05-03-2020', '18:39:54', 32, 'Erick Nunez', '1', '3c67697e18899300a2648199a9798dffb359cab2', 1, '1583388000', 1, '48836dbcf8', 1583455203, 11),
(144, 1003, 1, '2 PACK HARINA DE MAIZ DANY 907 G', 1.49, 1.32, 0.17, 1.49, 32, 0.00, '05-03-2020', '18:39:55', 32, 'Erick Nunez', '1', '3c67697e18899300a2648199a9798dffb359cab2', 1, '1583388000', 1, '535187d580', 1583455203, 11),
(145, 1009, 1, 'ACEITE CANOLA ORISOL 3000ML PET', 7.08, 6.27, 0.81, 7.08, 33, 0.00, '05-03-2020', '18:40:08', 33, 'Erick Nunez', '1', '3c67697e18899300a2648199a9798dffb359cab2', 1, '1583388000', 1, 'cca7af4576', 1583455220, 11),
(146, 1007, 1, '6PACK SOPAS INSTANTANEA LAKY MEN 64GR', 2.95, 2.61, 0.34, 2.95, 33, 0.00, '05-03-2020', '18:40:10', 33, 'Erick Nunez', '1', '3c67697e18899300a2648199a9798dffb359cab2', 1, '1583388000', 1, '942203f1f7', 1583455220, 11),
(147, 1005, 1, '4 PACK UNDERWOOD JAMON DEL DIABLO 120 G', 9.40, 8.32, 1.08, 9.40, 33, 0.00, '05-03-2020', '18:40:11', 33, 'Erick Nunez', '1', '3c67697e18899300a2648199a9798dffb359cab2', 1, '1583388000', 1, '47c9854788', 1583455220, 11),
(148, 1004, 2, '2PACK BEBIDA LACTEA SMILK 350 GRAMOS', 3.70, 6.55, 0.85, 7.40, 33, 0.00, '05-03-2020', '18:40:12', 33, 'Erick Nunez', '1', '3c67697e18899300a2648199a9798dffb359cab2', 1, '1583388000', 1, '041c96d8d9', 1583455220, 11),
(149, 1006, 2, 'JAMONADA BLACK LABEL 24/198 GRS HORMEL', 2.27, 4.02, 0.52, 4.54, 33, 0.00, '05-03-2020', '18:40:13', 33, 'Erick Nunez', '1', '3c67697e18899300a2648199a9798dffb359cab2', 1, '1583388000', 1, '1ed6dc2112', 1583455220, 11),
(150, 1008, 3, 'NAVAJA PARA ELECTRICISTA', 4.60, 12.21, 1.59, 13.80, 22, 0.00, '05-03-2020', '18:43:24', 22, 'Erick Nunez', '1', '3c67697e18899300a2648199a9798dffb359cab2', 1, '1583388000', 1, 'f652fb7b14', 1583455412, 10),
(151, 1010, 3, 'CAJA PARA HERRAMIENTAS PLáSTICA DE 12PLG', 3.25, 8.63, 1.12, 9.75, 22, 0.00, '05-03-2020', '18:43:28', 22, 'Erick Nunez', '1', '3c67697e18899300a2648199a9798dffb359cab2', 1, '1583388000', 1, '90b630df66', 1583455412, 10),
(152, 1003, 4, 'CEMENTO BLANCO, BOLSA DE 42.5 KGS.', 8.20, 29.03, 3.77, 32.80, 23, 0.00, '05-03-2020', '18:43:39', 23, 'Erick Nunez', '1', '3c67697e18899300a2648199a9798dffb359cab2', 1, '1583388000', 1, '98d377e3e2', 1583455431, 10),
(153, 1005, 4, 'DECOBLOCK BLANCO HUESO GRANO MEDIO, BOLSA DE 40 KGS.', 8.70, 30.80, 4.00, 34.80, 24, 0.00, '05-03-2020', '18:44:01', 24, 'Erick Nunez', '1', '3c67697e18899300a2648199a9798dffb359cab2', 1, '1583388000', 1, '94269d08f1', 1583455447, 10),
(154, 1008, 3, 'NAVAJA PARA ELECTRICISTA', 4.60, 12.21, 1.59, 13.80, 25, 0.00, '05-03-2020', '18:44:16', 25, 'Erick Nunez', '1', '3c67697e18899300a2648199a9798dffb359cab2', 1, '1583388000', 1, 'b3b48c22fb', 1583455460, 10),
(155, 1015, 3, 'ACE - LáMPARA DE PARED LED 20W, LUZ BLANCA.', 22.50, 59.73, 7.77, 67.50, 26, 0.00, '05-03-2020', '18:44:27', 26, 'Erick Nunez', '1', '3c67697e18899300a2648199a9798dffb359cab2', 1, '1583388000', 1, '34fc31170e', 1583455472, 10),
(156, 1010, 3, 'CAJA PARA HERRAMIENTAS PLáSTICA DE 12PLG', 3.25, 8.63, 1.12, 9.75, 27, 0.00, '05-03-2020', '18:44:40', 27, 'Erick Nunez', '1', '3c67697e18899300a2648199a9798dffb359cab2', 1, '1583388000', 1, '08b4bccb96', 1583455484, 10),
(157, 1011, 4, 'CAJA PARA HERRAMIENTAS PLáSTICA DE 26PLG', 45.00, 159.29, 20.71, 180.00, 28, 0.00, '05-03-2020', '18:44:51', 28, 'Erick Nunez', '1', '3c67697e18899300a2648199a9798dffb359cab2', 1, '1583388000', 1, '2f956856c9', 1583455496, 10),
(158, 1006, 1, 'JAMONADA BLACK LABEL 24/198 GRS HORMEL', 2.27, 2.01, 0.26, 2.27, 34, 0.00, '06-03-2020', '18:47:24', 34, 'Erick Nunez', '1', '3c67697e18899300a2648199a9798dffb359cab2', 1, '1583474400', 1, '86c13e1f90', 1583542053, 11),
(159, 1004, 2, '2PACK BEBIDA LACTEA SMILK 350 GRAMOS', 3.70, 6.55, 0.85, 7.40, 34, 0.00, '06-03-2020', '18:47:25', 34, 'Erick Nunez', '1', '3c67697e18899300a2648199a9798dffb359cab2', 1, '1583474400', 1, '38c7db8c6e', 1583542053, 11),
(160, 1002, 1, '2 PACK ARROZ BLANCO DANY 1 LB', 1.09, 0.96, 0.13, 1.09, 34, 0.00, '06-03-2020', '18:47:26', 34, 'Erick Nunez', '1', '3c67697e18899300a2648199a9798dffb359cab2', 1, '1583474400', 1, '6ef669a07f', 1583542053, 11),
(161, 1005, 1, '4 PACK UNDERWOOD JAMON DEL DIABLO 120 G', 9.40, 8.32, 1.08, 9.40, 34, 0.00, '06-03-2020', '18:47:29', 34, 'Erick Nunez', '1', '3c67697e18899300a2648199a9798dffb359cab2', 1, '1583474400', 1, 'b67a8327e3', 1583542053, 11),
(162, 1006, 1, 'JAMONADA BLACK LABEL 24/198 GRS HORMEL', 2.27, 2.01, 0.26, 2.27, 35, 0.00, '06-03-2020', '18:47:40', 35, 'Erick Nunez', '1', '3c67697e18899300a2648199a9798dffb359cab2', 1, '1583474400', 1, '22479d7a27', 1583542076, 11),
(163, 1003, 1, '2 PACK HARINA DE MAIZ DANY 907 G', 1.49, 1.32, 0.17, 1.49, 35, 0.00, '06-03-2020', '18:47:41', 35, 'Erick Nunez', '1', '3c67697e18899300a2648199a9798dffb359cab2', 1, '1583474400', 1, '1b3fabfb45', 1583542076, 11),
(164, 1001, 5, '2 PACK ARROZ BLANCO CINCO ESTRELLA LIBRA', 1.38, 6.11, 0.79, 6.90, 35, 0.00, '06-03-2020', '18:47:44', 35, 'Erick Nunez', '1', '3c67697e18899300a2648199a9798dffb359cab2', 1, '1583474400', 1, '06e6da60c2', 1583542076, 11),
(165, 1014, 2, 'CEREAL KOMPLETE PASAS Y MANZANA 460 G', 3.25, 5.75, 0.75, 6.50, 36, 0.00, '06-03-2020', '18:48:03', 36, 'Erick Nunez', '1', '3c67697e18899300a2648199a9798dffb359cab2', 1, '1583474400', 1, '0d375e467f', 1583542099, 11),
(166, 1012, 6, 'AVENA MOSH PARA FRESCO ORIGI QUAKER 600G', 2.21, 11.73, 1.53, 13.26, 36, 0.00, '06-03-2020', '18:48:04', 36, 'Erick Nunez', '1', '3c67697e18899300a2648199a9798dffb359cab2', 1, '1583474400', 1, 'a1cd9e633e', 1583542099, 11),
(167, 1006, 2, 'JAMONADA BLACK LABEL 24/198 GRS HORMEL', 2.27, 4.02, 0.52, 4.54, 37, 0.00, '06-03-2020', '18:48:26', 37, 'Erick Nunez', '1', '3c67697e18899300a2648199a9798dffb359cab2', 1, '1583474400', 1, 'e4875ed0b9', 1583542121, 11),
(168, 1004, 2, '2PACK BEBIDA LACTEA SMILK 350 GRAMOS', 3.70, 6.55, 0.85, 7.40, 37, 0.00, '06-03-2020', '18:48:29', 37, 'Erick Nunez', '1', '3c67697e18899300a2648199a9798dffb359cab2', 1, '1583474400', 1, 'fc4452a19e', 1583542121, 11),
(169, 1004, 2, '2PACK BEBIDA LACTEA SMILK 350 GRAMOS', 3.70, 6.55, 0.85, 7.40, 38, 0.00, '06-03-2020', '18:48:47', 38, 'Erick Nunez', '2', '3c67697e18899300a2648199a9798dffb359cab2', 1, '1583474400', 1, 'e7b63e3a51', 1583542209, 11),
(170, 1002, 1, '2 PACK ARROZ BLANCO DANY 1 LB', 1.09, 0.96, 0.13, 1.09, 39, 0.00, '07-03-2020', '18:52:33', 39, 'Erick Nunez', '1', '3c67697e18899300a2648199a9798dffb359cab2', 1, '1583560800', 1, 'de285ce23c', 1583628779, 11),
(171, 1003, 2, '2 PACK HARINA DE MAIZ DANY 907 G', 1.49, 2.64, 0.34, 2.98, 39, 0.00, '07-03-2020', '18:52:35', 39, 'Erick Nunez', '1', '3c67697e18899300a2648199a9798dffb359cab2', 1, '1583560800', 1, 'cb55c5398b', 1583628779, 11),
(172, 1005, 6, '4 PACK UNDERWOOD JAMON DEL DIABLO 120 G', 9.40, 49.91, 6.49, 56.40, 39, 0.00, '07-03-2020', '18:52:37', 39, 'Erick Nunez', '1', '3c67697e18899300a2648199a9798dffb359cab2', 1, '1583560800', 1, '9d70c74993', 1583628779, 11),
(173, 1004, 2, '2PACK BEBIDA LACTEA SMILK 350 GRAMOS', 3.70, 6.55, 0.85, 7.40, 39, 0.00, '07-03-2020', '18:52:41', 39, 'Erick Nunez', '1', '3c67697e18899300a2648199a9798dffb359cab2', 1, '1583560800', 1, '04d4346db6', 1583628779, 11),
(174, 1007, 5, '6PACK SOPAS INSTANTANEA LAKY MEN 64GR', 2.95, 13.05, 1.70, 14.75, 40, 0.00, '07-03-2020', '18:53:04', 40, 'Erick Nunez', '1', '3c67697e18899300a2648199a9798dffb359cab2', 1, '1583560800', 1, 'f80f2943a7', 1583629224, 11),
(175, 1004, 3, '2PACK BEBIDA LACTEA SMILK 350 GRAMOS', 3.70, 9.82, 1.28, 11.10, 40, 0.00, '07-03-2020', '18:53:08', 40, 'Erick Nunez', '1', '3c67697e18899300a2648199a9798dffb359cab2', 1, '1583560800', 1, 'b68d248d7d', 1583629224, 11),
(176, 1005, 4, '4 PACK UNDERWOOD JAMON DEL DIABLO 120 G', 9.40, 33.27, 4.33, 37.60, 40, 0.00, '07-03-2020', '18:53:09', 40, 'Erick Nunez', '1', '3c67697e18899300a2648199a9798dffb359cab2', 1, '1583560800', 1, '04dc1fe242', 1583629224, 11),
(177, 1001, 1, '2 PACK ARROZ BLANCO CINCO ESTRELLA LIBRA', 1.38, 1.22, 0.16, 1.38, 40, 0.00, '07-03-2020', '19:00:12', 40, 'Erick Nunez', '1', '3c67697e18899300a2648199a9798dffb359cab2', 1, '1583560800', 1, '38a04961d4', 1583629224, 11),
(178, 1002, 1, '2 PACK ARROZ BLANCO DANY 1 LB', 1.09, 0.96, 0.13, 1.09, 40, 0.00, '07-03-2020', '19:00:14', 40, 'Erick Nunez', '1', '3c67697e18899300a2648199a9798dffb359cab2', 1, '1583560800', 1, '4be992a19f', 1583629224, 11),
(179, 1002, 1, '2 PACK ARROZ BLANCO DANY 1 LB', 1.09, 0.96, 0.13, 1.09, 41, 0.00, '07-03-2020', '19:00:29', 41, 'Erick Nunez', '1', '3c67697e18899300a2648199a9798dffb359cab2', 1, '1583560800', 1, '47c73bfbe0', 1583629265, 11),
(180, 1004, 1, '2PACK BEBIDA LACTEA SMILK 350 GRAMOS', 3.70, 3.27, 0.43, 3.70, 41, 0.00, '07-03-2020', '19:00:30', 41, 'Erick Nunez', '1', '3c67697e18899300a2648199a9798dffb359cab2', 1, '1583560800', 1, 'dba3cc5f51', 1583629265, 11),
(181, 1005, 1, '4 PACK UNDERWOOD JAMON DEL DIABLO 120 G', 9.40, 8.32, 1.08, 9.40, 41, 0.00, '07-03-2020', '19:00:32', 41, 'Erick Nunez', '1', '3c67697e18899300a2648199a9798dffb359cab2', 1, '1583560800', 1, '450b21a6d8', 1583629265, 11),
(182, 1003, 1, '2 PACK HARINA DE MAIZ DANY 907 G', 1.49, 1.32, 0.17, 1.49, 41, 0.00, '07-03-2020', '19:00:33', 41, 'Erick Nunez', '1', '3c67697e18899300a2648199a9798dffb359cab2', 1, '1583560800', 1, '39fcda5c46', 1583629265, 11),
(183, 1002, 1, '2 PACK ARROZ BLANCO DANY 1 LB', 1.09, 0.96, 0.13, 1.09, 42, 0.00, '07-03-2020', '19:01:54', 42, 'Erick Nunez', '1', '3c67697e18899300a2648199a9798dffb359cab2', 1, '1583560800', 1, '342a60310f', 1583629321, 11),
(184, 1004, 1, '2PACK BEBIDA LACTEA SMILK 350 GRAMOS', 3.70, 3.27, 0.43, 3.70, 42, 0.00, '07-03-2020', '19:01:56', 42, 'Erick Nunez', '1', '3c67697e18899300a2648199a9798dffb359cab2', 1, '1583560800', 1, '485e683d3c', 1583629321, 11),
(185, 1006, 4, 'JAMONADA BLACK LABEL 24/198 GRS HORMEL', 2.27, 8.04, 1.04, 9.08, 43, 0.00, '08-03-2020', '19:03:48', 43, 'Erick Nunez', '1', '3c67697e18899300a2648199a9798dffb359cab2', 1, '1583647200', 1, 'a008ce8229', 1583715843, 11),
(186, 1004, 3, '2PACK BEBIDA LACTEA SMILK 350 GRAMOS', 3.70, 9.82, 1.28, 11.10, 43, 0.00, '08-03-2020', '19:03:49', 43, 'Erick Nunez', '1', '3c67697e18899300a2648199a9798dffb359cab2', 1, '1583647200', 1, 'e9dec712a1', 1583715843, 11),
(187, 1012, 4, 'AVENA MOSH PARA FRESCO ORIGI QUAKER 600G', 2.21, 7.82, 1.02, 8.84, 43, 0.00, '08-03-2020', '19:03:50', 43, 'Erick Nunez', '1', '3c67697e18899300a2648199a9798dffb359cab2', 1, '1583647200', 1, 'e6d6701fed', 1583715843, 11),
(188, 1005, 1, '4 PACK UNDERWOOD JAMON DEL DIABLO 120 G', 9.40, 8.32, 1.08, 9.40, 44, 0.00, '08-03-2020', '19:04:11', 44, 'Erick Nunez', '1', '3c67697e18899300a2648199a9798dffb359cab2', 1, '1583647200', 1, '5271a5861d', 1583715863, 11),
(189, 1004, 3, '2PACK BEBIDA LACTEA SMILK 350 GRAMOS', 3.70, 9.82, 1.28, 11.10, 44, 0.00, '08-03-2020', '19:04:13', 44, 'Erick Nunez', '1', '3c67697e18899300a2648199a9798dffb359cab2', 1, '1583647200', 1, 'b6a0a83264', 1583715863, 11),
(190, 1002, 1, '2 PACK ARROZ BLANCO DANY 1 LB', 1.09, 0.96, 0.13, 1.09, 44, 0.00, '08-03-2020', '19:04:14', 44, 'Erick Nunez', '1', '3c67697e18899300a2648199a9798dffb359cab2', 1, '1583647200', 1, '6c976eac80', 1583715863, 11),
(191, 1006, 1, 'JAMONADA BLACK LABEL 24/198 GRS HORMEL', 2.27, 2.01, 0.26, 2.27, 44, 0.00, '08-03-2020', '19:04:16', 44, 'Erick Nunez', '1', '3c67697e18899300a2648199a9798dffb359cab2', 1, '1583647200', 1, '736a9f3626', 1583715863, 11),
(192, 1006, 1, 'JAMONADA BLACK LABEL 24/198 GRS HORMEL', 2.27, 2.01, 0.26, 2.27, 45, 0.00, '08-03-2020', '19:04:31', 45, 'Erick Nunez', '1', '3c67697e18899300a2648199a9798dffb359cab2', 1, '1583647200', 1, '4218ff9b66', 1583715885, 11),
(193, 1004, 3, '2PACK BEBIDA LACTEA SMILK 350 GRAMOS', 3.70, 9.82, 1.28, 11.10, 45, 0.00, '08-03-2020', '19:04:33', 45, 'Erick Nunez', '1', '3c67697e18899300a2648199a9798dffb359cab2', 1, '1583647200', 1, '2a97473fc8', 1583715885, 11),
(194, 1005, 2, '4 PACK UNDERWOOD JAMON DEL DIABLO 120 G', 9.40, 16.64, 2.16, 18.80, 45, 0.00, '08-03-2020', '19:04:34', 45, 'Erick Nunez', '1', '3c67697e18899300a2648199a9798dffb359cab2', 1, '1583647200', 1, 'e0dc189ce5', 1583715885, 11),
(195, 1002, 1, '2 PACK ARROZ BLANCO DANY 1 LB', 1.09, 0.96, 0.13, 1.09, 45, 0.00, '08-03-2020', '19:04:40', 45, 'Erick Nunez', '1', '3c67697e18899300a2648199a9798dffb359cab2', 1, '1583647200', 1, '9d69d9a2eb', 1583715885, 11),
(196, 1006, 1, 'JAMONADA BLACK LABEL 24/198 GRS HORMEL', 2.27, 2.01, 0.26, 2.27, 46, 0.00, '08-03-2020', '19:04:51', 46, 'Erick Nunez', '1', '3c67697e18899300a2648199a9798dffb359cab2', 1, '1583647200', 1, '2575e2d0dd', 1583715900, 11),
(197, 1004, 3, '2PACK BEBIDA LACTEA SMILK 350 GRAMOS', 3.70, 9.82, 1.28, 11.10, 46, 0.00, '08-03-2020', '19:04:52', 46, 'Erick Nunez', '1', '3c67697e18899300a2648199a9798dffb359cab2', 1, '1583647200', 1, '0eb2219db9', 1583715900, 11),
(198, 1003, 1, '2 PACK HARINA DE MAIZ DANY 907 G', 1.49, 1.32, 0.17, 1.49, 46, 0.00, '08-03-2020', '19:04:54', 46, 'Erick Nunez', '1', '3c67697e18899300a2648199a9798dffb359cab2', 1, '1583647200', 1, '6b8abec7ff', 1583715900, 11),
(199, 1006, 1, 'JAMONADA BLACK LABEL 24/198 GRS HORMEL', 2.27, 2.01, 0.26, 2.27, 47, 0.00, '08-03-2020', '19:05:18', 47, 'Erick Nunez', '1', '3c67697e18899300a2648199a9798dffb359cab2', 1, '1583647200', 1, '77c60cf2ae', 1583715925, 11),
(200, 1004, 1, '2PACK BEBIDA LACTEA SMILK 350 GRAMOS', 3.70, 3.27, 0.43, 3.70, 47, 0.00, '08-03-2020', '19:05:19', 47, 'Erick Nunez', '1', '3c67697e18899300a2648199a9798dffb359cab2', 1, '1583647200', 1, 'd317fb3764', 1583715925, 11),
(201, 1007, 1, '6PACK SOPAS INSTANTANEA LAKY MEN 64GR', 2.95, 2.61, 0.34, 2.95, 48, 0.00, '08-03-2020', '19:05:32', 48, 'Erick Nunez', '1', '3c67697e18899300a2648199a9798dffb359cab2', 1, '1583647200', 1, 'ecc593c000', 1583715942, 11),
(202, 1014, 5, 'CEREAL KOMPLETE PASAS Y MANZANA 460 G', 3.25, 14.38, 1.87, 16.25, 48, 0.00, '08-03-2020', '19:05:34', 48, 'Erick Nunez', '1', '3c67697e18899300a2648199a9798dffb359cab2', 1, '1583647200', 1, 'b48217148a', 1583715942, 11),
(203, 1004, 1, '2PACK BEBIDA LACTEA SMILK 350 GRAMOS', 3.70, 3.27, 0.43, 3.70, 49, 0.00, '09-03-2020', '19:06:36', 49, 'Erick Nunez', '1', '3c67697e18899300a2648199a9798dffb359cab2', 1, '1583733600', 1, 'a30e55af2f', 1583802410, 11),
(204, 1005, 3, '4 PACK UNDERWOOD JAMON DEL DIABLO 120 G', 9.40, 24.96, 3.24, 28.20, 49, 0.00, '09-03-2020', '19:06:37', 49, 'Erick Nunez', '1', '3c67697e18899300a2648199a9798dffb359cab2', 1, '1583733600', 1, '9f539140f0', 1583802410, 11),
(205, 1007, 1, '6PACK SOPAS INSTANTANEA LAKY MEN 64GR', 2.95, 2.61, 0.34, 2.95, 49, 0.00, '09-03-2020', '19:06:39', 49, 'Erick Nunez', '1', '3c67697e18899300a2648199a9798dffb359cab2', 1, '1583733600', 1, '324ba9b2ef', 1583802410, 11),
(206, 1008, 2, 'SOPA EN VASO RES MARUCHAN 12/2 25 OZ', 0.63, 1.12, 0.14, 1.26, 49, 0.00, '09-03-2020', '19:06:41', 49, 'Erick Nunez', '1', '3c67697e18899300a2648199a9798dffb359cab2', 1, '1583733600', 1, '213fd5b258', 1583802410, 11),
(207, 1009, 1, 'ACEITE CANOLA ORISOL 3000ML PET', 7.08, 6.27, 0.81, 7.08, 49, 0.00, '09-03-2020', '19:06:45', 49, 'Erick Nunez', '1', '3c67697e18899300a2648199a9798dffb359cab2', 1, '1583733600', 1, '57136eebbb', 1583802410, 11),
(208, 1006, 4, 'JAMONADA BLACK LABEL 24/198 GRS HORMEL', 2.27, 8.04, 1.04, 9.08, 50, 0.00, '09-03-2020', '19:06:55', 50, 'Erick Nunez', '1', '3c67697e18899300a2648199a9798dffb359cab2', 1, '1583733600', 1, '26fdff3893', 1583802454, 11),
(209, 1005, 3, '4 PACK UNDERWOOD JAMON DEL DIABLO 120 G', 9.40, 24.96, 3.24, 28.20, 50, 0.00, '09-03-2020', '19:06:57', 50, 'Erick Nunez', '1', '3c67697e18899300a2648199a9798dffb359cab2', 1, '1583733600', 1, 'c0c565327c', 1583802454, 11),
(210, 1008, 1, 'SOPA EN VASO RES MARUCHAN 12/2 25 OZ', 0.63, 0.56, 0.07, 0.63, 50, 0.00, '09-03-2020', '19:06:59', 50, 'Erick Nunez', '1', '3c67697e18899300a2648199a9798dffb359cab2', 1, '1583733600', 1, '6c17954f51', 1583802454, 11),
(211, 1004, 3, '2PACK BEBIDA LACTEA SMILK 350 GRAMOS', 3.70, 9.82, 1.28, 11.10, 50, 0.00, '09-03-2020', '19:07:05', 50, 'Erick Nunez', '1', '3c67697e18899300a2648199a9798dffb359cab2', 1, '1583733600', 1, '2d3f65518e', 1583802454, 11),
(212, 1003, 1, '2 PACK HARINA DE MAIZ DANY 907 G', 1.49, 1.32, 0.17, 1.49, 50, 0.00, '09-03-2020', '19:07:10', 50, 'Erick Nunez', '1', '3c67697e18899300a2648199a9798dffb359cab2', 1, '1583733600', 1, 'cbb5e9f47e', 1583802454, 11),
(213, 1006, 2, 'JAMONADA BLACK LABEL 24/198 GRS HORMEL', 2.27, 4.02, 0.52, 4.54, 51, 0.00, '09-03-2020', '19:08:36', 51, 'Erick Nunez', '1', '3c67697e18899300a2648199a9798dffb359cab2', 1, '1583733600', 1, '1a3375ed10', 1583802533, 11),
(214, 1004, 4, '2PACK BEBIDA LACTEA SMILK 350 GRAMOS', 3.70, 13.10, 1.70, 14.80, 51, 0.00, '09-03-2020', '19:08:37', 51, 'Erick Nunez', '1', '3c67697e18899300a2648199a9798dffb359cab2', 1, '1583733600', 1, '7a050e2edd', 1583802533, 11);
INSERT INTO `ticket` (`id`, `cod`, `cant`, `producto`, `pv`, `stotal`, `imp`, `total`, `num_fac`, `descuento`, `fecha`, `hora`, `orden`, `cajero`, `tipo_pago`, `user`, `tx`, `fechaF`, `edo`, `hash`, `time`, `td`) VALUES
(215, 1002, 3, '2 PACK ARROZ BLANCO DANY 1 LB', 1.09, 2.89, 0.38, 3.27, 51, 0.00, '09-03-2020', '19:08:38', 51, 'Erick Nunez', '1', '3c67697e18899300a2648199a9798dffb359cab2', 1, '1583733600', 1, '0ccdbfc96b', 1583802533, 11),
(216, 1001, 1, '2 PACK ARROZ BLANCO CINCO ESTRELLA LIBRA', 1.38, 1.22, 0.16, 1.38, 52, 0.00, '10-03-2020', '19:09:55', 52, 'Erick Nunez', '1', '3c67697e18899300a2648199a9798dffb359cab2', 1, '1583820000', 1, '3850fbb230', 1583889007, 11),
(217, 1002, 1, '2 PACK ARROZ BLANCO DANY 1 LB', 1.09, 0.96, 0.13, 1.09, 52, 0.00, '10-03-2020', '19:09:58', 52, 'Erick Nunez', '1', '3c67697e18899300a2648199a9798dffb359cab2', 1, '1583820000', 1, 'd60426c1e7', 1583889007, 11),
(218, 1006, 1, 'JAMONADA BLACK LABEL 24/198 GRS HORMEL', 2.27, 2.01, 0.26, 2.27, 52, 0.00, '10-03-2020', '19:09:59', 52, 'Erick Nunez', '1', '3c67697e18899300a2648199a9798dffb359cab2', 1, '1583820000', 1, 'b17b92fe28', 1583889007, 11),
(219, 1008, 1, 'SOPA EN VASO RES MARUCHAN 12/2 25 OZ', 0.63, 0.56, 0.07, 0.63, 52, 0.00, '10-03-2020', '19:10:00', 52, 'Erick Nunez', '1', '3c67697e18899300a2648199a9798dffb359cab2', 1, '1583820000', 1, '9e000ee8e3', 1583889007, 11),
(220, 1005, 1, '4 PACK UNDERWOOD JAMON DEL DIABLO 120 G', 9.40, 8.32, 1.08, 9.40, 52, 0.00, '10-03-2020', '19:10:02', 52, 'Erick Nunez', '1', '3c67697e18899300a2648199a9798dffb359cab2', 1, '1583820000', 1, 'ff46ba5102', 1583889007, 11),
(221, 1006, 1, 'JAMONADA BLACK LABEL 24/198 GRS HORMEL', 2.27, 2.01, 0.26, 2.27, 53, 0.00, '10-03-2020', '19:10:12', 53, 'Erick Nunez', '1', '3c67697e18899300a2648199a9798dffb359cab2', 1, '1583820000', 1, '53cbbe8370', 1583889029, 11),
(222, 1005, 2, '4 PACK UNDERWOOD JAMON DEL DIABLO 120 G', 9.40, 16.64, 2.16, 18.80, 53, 0.00, '10-03-2020', '19:10:14', 53, 'Erick Nunez', '1', '3c67697e18899300a2648199a9798dffb359cab2', 1, '1583820000', 1, '6c7d95ce2d', 1583889029, 11),
(223, 1004, 2, '2PACK BEBIDA LACTEA SMILK 350 GRAMOS', 3.70, 6.55, 0.85, 7.40, 53, 0.00, '10-03-2020', '19:10:16', 53, 'Erick Nunez', '1', '3c67697e18899300a2648199a9798dffb359cab2', 1, '1583820000', 1, 'abf167f27e', 1583889029, 11),
(224, 1002, 3, '2 PACK ARROZ BLANCO DANY 1 LB', 1.09, 2.89, 0.38, 3.27, 53, 0.00, '10-03-2020', '19:10:17', 53, 'Erick Nunez', '1', '3c67697e18899300a2648199a9798dffb359cab2', 1, '1583820000', 1, 'd4c563e39c', 1583889029, 11),
(225, 1003, 1, '2 PACK HARINA DE MAIZ DANY 907 G', 1.49, 1.32, 0.17, 1.49, 53, 0.00, '10-03-2020', '19:10:19', 53, 'Erick Nunez', '1', '3c67697e18899300a2648199a9798dffb359cab2', 1, '1583820000', 1, '018954c733', 1583889029, 11),
(226, 1009, 15, 'ACEITE CANOLA ORISOL 3000ML PET', 7.08, 93.98, 12.22, 106.20, 54, 0.00, '10-03-2020', '19:10:34', 54, 'Erick Nunez', '1', '3c67697e18899300a2648199a9798dffb359cab2', 1, '1583820000', 1, '49603f2890', 1583889049, 11),
(227, 1004, 1, '2PACK BEBIDA LACTEA SMILK 350 GRAMOS', 3.70, 3.27, 0.43, 3.70, 54, 0.00, '10-03-2020', '19:10:35', 54, 'Erick Nunez', '1', '3c67697e18899300a2648199a9798dffb359cab2', 1, '1583820000', 1, 'a6e21e5283', 1583889049, 11),
(228, 1003, 1, '2 PACK HARINA DE MAIZ DANY 907 G', 1.49, 1.32, 0.17, 1.49, 54, 0.00, '10-03-2020', '19:10:38', 54, 'Erick Nunez', '1', '3c67697e18899300a2648199a9798dffb359cab2', 1, '1583820000', 1, '93246de611', 1583889049, 11),
(229, 1013, 10, 'BARRA GRANOLA MIEL HELIOS 162 G', 1.45, 12.83, 1.67, 14.50, 55, 0.00, '10-03-2020', '19:10:54', 55, 'Erick Nunez', '2', '3c67697e18899300a2648199a9798dffb359cab2', 1, '1583820000', 1, 'dfede8ab27', 1583889065, 11),
(230, 1006, 15, 'JAMONADA BLACK LABEL 24/198 GRS HORMEL', 2.27, 30.13, 3.92, 34.05, 56, 0.00, '10-03-2020', '19:11:46', 56, 'Erick Nunez', '1', '3c67697e18899300a2648199a9798dffb359cab2', 1, '1583820000', 1, '929d6c1b52', 1583889117, 11),
(231, 1004, 1, '2PACK BEBIDA LACTEA SMILK 350 GRAMOS', 3.70, 3.27, 0.43, 3.70, 56, 0.00, '10-03-2020', '19:11:47', 56, 'Erick Nunez', '1', '3c67697e18899300a2648199a9798dffb359cab2', 1, '1583820000', 1, 'd8e064877b', 1583889117, 11),
(232, 1006, 1, 'JAMONADA BLACK LABEL 24/198 GRS HORMEL', 2.27, 2.01, 0.26, 2.27, 57, 0.00, '11-03-2020', '19:13:11', 57, 'Erick Nunez', '2', '3c67697e18899300a2648199a9798dffb359cab2', 1, '1583906400', 1, '8b5fe194c6', 1583975646, 11),
(233, 1004, 3, '2PACK BEBIDA LACTEA SMILK 350 GRAMOS', 3.70, 9.82, 1.28, 11.10, 57, 0.00, '11-03-2020', '19:13:13', 57, 'Erick Nunez', '2', '3c67697e18899300a2648199a9798dffb359cab2', 1, '1583906400', 1, '08c9eaf014', 1583975646, 11),
(234, 1002, 1, '2 PACK ARROZ BLANCO DANY 1 LB', 1.09, 0.96, 0.13, 1.09, 57, 0.00, '11-03-2020', '19:13:15', 57, 'Erick Nunez', '2', '3c67697e18899300a2648199a9798dffb359cab2', 1, '1583906400', 1, '6676e7b114', 1583975646, 11),
(235, 1005, 2, '4 PACK UNDERWOOD JAMON DEL DIABLO 120 G', 9.40, 16.64, 2.16, 18.80, 57, 0.00, '11-03-2020', '19:13:17', 57, 'Erick Nunez', '2', '3c67697e18899300a2648199a9798dffb359cab2', 1, '1583906400', 1, 'ad9748dc9c', 1583975646, 11),
(236, 1003, 1, '2 PACK HARINA DE MAIZ DANY 907 G', 1.49, 1.32, 0.17, 1.49, 57, 0.00, '11-03-2020', '19:13:19', 57, 'Erick Nunez', '2', '3c67697e18899300a2648199a9798dffb359cab2', 1, '1583906400', 1, 'f0106c0da7', 1583975646, 11),
(237, 1006, 1, 'JAMONADA BLACK LABEL 24/198 GRS HORMEL', 2.27, 2.01, 0.26, 2.27, 58, 0.00, '11-03-2020', '19:14:12', 58, 'Erick Nunez', '1', '3c67697e18899300a2648199a9798dffb359cab2', 1, '1583906400', 1, 'ba9cb8be40', 1583975664, 11),
(238, 1004, 15, '2PACK BEBIDA LACTEA SMILK 350 GRAMOS', 3.70, 49.12, 6.38, 55.50, 58, 0.00, '11-03-2020', '19:14:13', 58, 'Erick Nunez', '1', '3c67697e18899300a2648199a9798dffb359cab2', 1, '1583906400', 1, '8c265ff4f2', 1583975664, 11),
(239, 1002, 1, '2 PACK ARROZ BLANCO DANY 1 LB', 1.09, 0.96, 0.13, 1.09, 58, 0.00, '11-03-2020', '19:14:14', 58, 'Erick Nunez', '1', '3c67697e18899300a2648199a9798dffb359cab2', 1, '1583906400', 1, '0337ad2d9e', 1583975664, 11),
(240, 1006, 2, 'JAMONADA BLACK LABEL 24/198 GRS HORMEL', 2.27, 4.02, 0.52, 4.54, 59, 0.00, '11-03-2020', '19:14:37', 59, 'Erick Nunez', '1', '3c67697e18899300a2648199a9798dffb359cab2', 1, '1583906400', 1, 'f7b12edda4', 1583975689, 11),
(241, 1003, 1, '2 PACK HARINA DE MAIZ DANY 907 G', 1.49, 1.32, 0.17, 1.49, 59, 0.00, '11-03-2020', '19:14:42', 59, 'Erick Nunez', '1', '3c67697e18899300a2648199a9798dffb359cab2', 1, '1583906400', 1, '1bacb3ce09', 1583975689, 11),
(242, 1009, 1, 'ACEITE CANOLA ORISOL 3000ML PET', 7.08, 6.27, 0.81, 7.08, 60, 0.00, '11-03-2020', '19:14:54', 60, 'Erick Nunez', '1', '3c67697e18899300a2648199a9798dffb359cab2', 1, '1583906400', 1, '0117861df7', 1583975711, 11),
(243, 1004, 2, '2PACK BEBIDA LACTEA SMILK 350 GRAMOS', 3.70, 6.55, 0.85, 7.40, 60, 0.00, '11-03-2020', '19:14:55', 60, 'Erick Nunez', '1', '3c67697e18899300a2648199a9798dffb359cab2', 1, '1583906400', 1, 'a2249e18dd', 1583975711, 11),
(244, 1005, 1, '4 PACK UNDERWOOD JAMON DEL DIABLO 120 G', 9.40, 8.32, 1.08, 9.40, 60, 0.00, '11-03-2020', '19:14:56', 60, 'Erick Nunez', '1', '3c67697e18899300a2648199a9798dffb359cab2', 1, '1583906400', 1, '4942291346', 1583975711, 11),
(245, 1008, 12, 'SOPA EN VASO RES MARUCHAN 12/2 25 OZ', 0.63, 6.69, 0.87, 7.56, 60, 0.00, '11-03-2020', '19:15:00', 60, 'Erick Nunez', '1', '3c67697e18899300a2648199a9798dffb359cab2', 1, '1583906400', 1, '5ca45e5701', 1583975711, 11),
(246, 1006, 1, 'JAMONADA BLACK LABEL 24/198 GRS HORMEL', 2.27, 2.01, 0.26, 2.27, 61, 0.00, '12-03-2020', '19:24:09', 61, 'Erick Nunez', '1', '3c67697e18899300a2648199a9798dffb359cab2', 1, '1583992800', 1, '723ffba87e', 1584062671, 11),
(247, 1004, 2, '2PACK BEBIDA LACTEA SMILK 350 GRAMOS', 3.70, 6.55, 0.85, 7.40, 61, 0.00, '12-03-2020', '19:24:12', 61, 'Erick Nunez', '1', '3c67697e18899300a2648199a9798dffb359cab2', 1, '1583992800', 1, '637d521e44', 1584062671, 11),
(248, 1005, 1, '4 PACK UNDERWOOD JAMON DEL DIABLO 120 G', 9.40, 8.32, 1.08, 9.40, 61, 0.00, '12-03-2020', '19:24:14', 61, 'Erick Nunez', '1', '3c67697e18899300a2648199a9798dffb359cab2', 1, '1583992800', 1, '25e46aae2a', 1584062671, 11),
(249, 1009, 1, 'ACEITE CANOLA ORISOL 3000ML PET', 7.08, 6.27, 0.81, 7.08, 61, 0.00, '12-03-2020', '19:24:18', 61, 'Erick Nunez', '1', '3c67697e18899300a2648199a9798dffb359cab2', 1, '1583992800', 1, '43af5b5e3f', 1584062671, 11),
(250, 1003, 1, '2 PACK HARINA DE MAIZ DANY 907 G', 1.49, 1.32, 0.17, 1.49, 61, 0.00, '12-03-2020', '19:24:19', 61, 'Erick Nunez', '1', '3c67697e18899300a2648199a9798dffb359cab2', 1, '1583992800', 1, 'c7c4d4df4d', 1584062671, 11),
(251, 1001, 1, '2 PACK ARROZ BLANCO CINCO ESTRELLA LIBRA', 1.38, 1.22, 0.16, 1.38, 61, 0.00, '12-03-2020', '19:24:25', 61, 'Erick Nunez', '1', '3c67697e18899300a2648199a9798dffb359cab2', 1, '1583992800', 1, '764ac56b20', 1584062671, 11),
(252, 1012, 1, 'AVENA MOSH PARA FRESCO ORIGI QUAKER 600G', 2.21, 1.96, 0.25, 2.21, 61, 0.00, '12-03-2020', '19:24:26', 61, 'Erick Nunez', '1', '3c67697e18899300a2648199a9798dffb359cab2', 1, '1583992800', 1, '8b0d6a703a', 1584062671, 11),
(253, 1012, 1, 'AVENA MOSH PARA FRESCO ORIGI QUAKER 600G', 2.21, 1.96, 0.25, 2.21, 62, 0.00, '12-03-2020', '19:24:37', 62, 'Erick Nunez', '1', '3c67697e18899300a2648199a9798dffb359cab2', 1, '1583992800', 1, '28d606c3bc', 1584062708, 11),
(254, 1013, 20, 'BARRA GRANOLA MIEL HELIOS 162 G', 1.45, 25.66, 3.34, 29.00, 62, 0.00, '12-03-2020', '19:24:39', 62, 'Erick Nunez', '1', '3c67697e18899300a2648199a9798dffb359cab2', 1, '1583992800', 1, 'e9267d78f1', 1584062708, 11),
(255, 1005, 1, '4 PACK UNDERWOOD JAMON DEL DIABLO 120 G', 9.40, 8.32, 1.08, 9.40, 62, 0.00, '12-03-2020', '19:25:04', 62, 'Erick Nunez', '1', '3c67697e18899300a2648199a9798dffb359cab2', 1, '1583992800', 1, '04cde8d137', 1584062708, 11),
(256, 1006, 1, 'JAMONADA BLACK LABEL 24/198 GRS HORMEL', 2.27, 2.01, 0.26, 2.27, 63, 0.00, '12-03-2020', '19:25:13', 63, 'Erick Nunez', '1', '3c67697e18899300a2648199a9798dffb359cab2', 1, '1583992800', 1, 'c964f819ef', 1584062735, 11),
(257, 1004, 5, '2PACK BEBIDA LACTEA SMILK 350 GRAMOS', 3.70, 16.37, 2.13, 18.50, 63, 0.00, '12-03-2020', '19:25:15', 63, 'Erick Nunez', '1', '3c67697e18899300a2648199a9798dffb359cab2', 1, '1583992800', 1, '588606adec', 1584062735, 11),
(258, 1005, 2, '4 PACK UNDERWOOD JAMON DEL DIABLO 120 G', 9.40, 16.64, 2.16, 18.80, 63, 0.00, '12-03-2020', '19:25:16', 63, 'Erick Nunez', '1', '3c67697e18899300a2648199a9798dffb359cab2', 1, '1583992800', 1, '712119c8e8', 1584062735, 11),
(259, 1003, 3, '2 PACK HARINA DE MAIZ DANY 907 G', 1.49, 3.96, 0.51, 4.47, 63, 0.00, '12-03-2020', '19:25:17', 63, 'Erick Nunez', '1', '3c67697e18899300a2648199a9798dffb359cab2', 1, '1583992800', 1, 'd10619b73e', 1584062735, 11),
(260, 1002, 2, '2 PACK ARROZ BLANCO DANY 1 LB', 1.09, 1.93, 0.25, 2.18, 63, 0.00, '12-03-2020', '19:25:27', 63, 'Erick Nunez', '1', '3c67697e18899300a2648199a9798dffb359cab2', 1, '1583992800', 1, 'b4b8cf7767', 1584062735, 11),
(261, 1006, 1, 'JAMONADA BLACK LABEL 24/198 GRS HORMEL', 2.27, 2.01, 0.26, 2.27, 64, 0.00, '12-03-2020', '19:25:40', 64, 'Erick Nunez', '1', '3c67697e18899300a2648199a9798dffb359cab2', 1, '1583992800', 1, 'd7a01f7f54', 1584062756, 11),
(262, 1004, 5, '2PACK BEBIDA LACTEA SMILK 350 GRAMOS', 3.70, 16.37, 2.13, 18.50, 64, 0.00, '12-03-2020', '19:25:41', 64, 'Erick Nunez', '1', '3c67697e18899300a2648199a9798dffb359cab2', 1, '1583992800', 1, '929650bb2e', 1584062756, 11),
(263, 1005, 1, '4 PACK UNDERWOOD JAMON DEL DIABLO 120 G', 9.40, 8.32, 1.08, 9.40, 64, 0.00, '12-03-2020', '19:25:42', 64, 'Erick Nunez', '1', '3c67697e18899300a2648199a9798dffb359cab2', 1, '1583992800', 1, '31e13bfd25', 1584062756, 11),
(264, 1002, 2, '2 PACK ARROZ BLANCO DANY 1 LB', 1.09, 1.93, 0.25, 2.18, 64, 0.00, '12-03-2020', '19:25:46', 64, 'Erick Nunez', '1', '3c67697e18899300a2648199a9798dffb359cab2', 1, '1583992800', 1, 'add6270901', 1584062756, 11),
(265, 1006, 20, 'JAMONADA BLACK LABEL 24/198 GRS HORMEL', 2.27, 40.18, 5.22, 45.40, 65, 0.00, '12-03-2020', '19:26:10', 65, 'Erick Nunez', '3', '3c67697e18899300a2648199a9798dffb359cab2', 1, '1583992800', 1, '066c83fd45', 1584062800, 11),
(266, 1006, 8, 'JAMONADA BLACK LABEL 24/198 GRS HORMEL', 2.27, 16.07, 2.09, 18.16, 66, 0.00, '12-03-2020', '19:28:41', 66, 'Erick Nunez', '2', '3c67697e18899300a2648199a9798dffb359cab2', 1, '1583992800', 1, '584482de21', 1584062934, 11),
(267, 1004, 1, '2PACK BEBIDA LACTEA SMILK 350 GRAMOS', 3.70, 3.27, 0.43, 3.70, 66, 0.00, '12-03-2020', '19:28:42', 66, 'Erick Nunez', '2', '3c67697e18899300a2648199a9798dffb359cab2', 1, '1583992800', 1, 'fbcd74b8f1', 1584062934, 11),
(268, 1004, 1, '2PACK BEBIDA LACTEA SMILK 350 GRAMOS', 3.70, 3.27, 0.43, 3.70, 67, 0.00, '13-03-2020', '19:36:15', 67, 'Erick Nunez', '1', '3c67697e18899300a2648199a9798dffb359cab2', 1, '1584079200', 1, '7d7ab5c5f4', 1584149791, 11),
(269, 1006, 1, 'JAMONADA BLACK LABEL 24/198 GRS HORMEL', 2.27, 2.01, 0.26, 2.27, 67, 0.00, '13-03-2020', '19:36:16', 67, 'Erick Nunez', '1', '3c67697e18899300a2648199a9798dffb359cab2', 1, '1584079200', 1, 'bf7c5eadea', 1584149791, 11),
(270, 1005, 1, '4 PACK UNDERWOOD JAMON DEL DIABLO 120 G', 9.40, 8.32, 1.08, 9.40, 67, 0.00, '13-03-2020', '19:36:20', 67, 'Erick Nunez', '1', '3c67697e18899300a2648199a9798dffb359cab2', 1, '1584079200', 1, '4962311914', 1584149791, 11),
(271, 1013, 14, 'BARRA GRANOLA MIEL HELIOS 162 G', 1.45, 17.96, 2.34, 20.30, 67, 0.00, '13-03-2020', '19:36:22', 67, 'Erick Nunez', '1', '3c67697e18899300a2648199a9798dffb359cab2', 1, '1584079200', 1, '19b601fc86', 1584149791, 11),
(272, 1006, 11, 'JAMONADA BLACK LABEL 24/198 GRS HORMEL', 2.27, 22.10, 2.87, 24.97, 68, 0.00, '13-03-2020', '19:36:36', 68, 'Erick Nunez', '1', '3c67697e18899300a2648199a9798dffb359cab2', 1, '1584079200', 1, '8feaa66cf4', 1584149807, 11),
(273, 1008, 1, 'SOPA EN VASO RES MARUCHAN 12/2 25 OZ', 0.63, 0.56, 0.07, 0.63, 68, 0.00, '13-03-2020', '19:36:38', 68, 'Erick Nunez', '1', '3c67697e18899300a2648199a9798dffb359cab2', 1, '1584079200', 1, '96d9157832', 1584149807, 11),
(274, 1013, 1, 'BARRA GRANOLA MIEL HELIOS 162 G', 1.45, 1.28, 0.17, 1.45, 69, 0.00, '13-03-2020', '19:36:52', 69, 'Erick Nunez', '2', '3c67697e18899300a2648199a9798dffb359cab2', 1, '1584079200', 1, '1c04c63daa', 1584149828, 11),
(275, 1014, 20, 'CEREAL KOMPLETE PASAS Y MANZANA 460 G', 3.25, 57.52, 7.48, 65.00, 69, 0.00, '13-03-2020', '19:36:55', 69, 'Erick Nunez', '2', '3c67697e18899300a2648199a9798dffb359cab2', 1, '1584079200', 1, 'd38df0dd48', 1584149828, 11),
(276, 1006, 1, 'JAMONADA BLACK LABEL 24/198 GRS HORMEL', 2.27, 2.01, 0.26, 2.27, 70, 0.00, '13-03-2020', '19:37:13', 70, 'Erick Nunez', '1', '3c67697e18899300a2648199a9798dffb359cab2', 1, '1584079200', 1, '7e2ee1dc99', 1584149849, 11),
(277, 1004, 3, '2PACK BEBIDA LACTEA SMILK 350 GRAMOS', 3.70, 9.82, 1.28, 11.10, 70, 0.00, '13-03-2020', '19:37:14', 70, 'Erick Nunez', '1', '3c67697e18899300a2648199a9798dffb359cab2', 1, '1584079200', 1, 'f491a1d83e', 1584149849, 11),
(278, 1005, 2, '4 PACK UNDERWOOD JAMON DEL DIABLO 120 G', 9.40, 16.64, 2.16, 18.80, 70, 0.00, '13-03-2020', '19:37:17', 70, 'Erick Nunez', '1', '3c67697e18899300a2648199a9798dffb359cab2', 1, '1584079200', 1, '78df4378e4', 1584149849, 11),
(279, 1003, 1, '2 PACK HARINA DE MAIZ DANY 907 G', 1.49, 1.32, 0.17, 1.49, 70, 0.00, '13-03-2020', '19:37:24', 70, 'Erick Nunez', '1', '3c67697e18899300a2648199a9798dffb359cab2', 1, '1584079200', 1, '6aafcb930f', 1584149849, 11),
(280, 1009, 1, 'ACEITE CANOLA ORISOL 3000ML PET', 7.08, 6.27, 0.81, 7.08, 71, 0.00, '13-03-2020', '19:37:35', 71, 'Erick Nunez', '1', '3c67697e18899300a2648199a9798dffb359cab2', 1, '1584079200', 1, '816f073f41', 1584149861, 11),
(281, 1008, 1, 'SOPA EN VASO RES MARUCHAN 12/2 25 OZ', 0.63, 0.56, 0.07, 0.63, 71, 0.00, '13-03-2020', '19:37:37', 71, 'Erick Nunez', '1', '3c67697e18899300a2648199a9798dffb359cab2', 1, '1584079200', 1, '8b9351e57a', 1584149861, 11),
(282, 1005, 2, '4 PACK UNDERWOOD JAMON DEL DIABLO 120 G', 9.40, 16.64, 2.16, 18.80, 72, 0.00, '14-03-2020', '19:38:47', 72, 'Erick Nunez', '1', '3c67697e18899300a2648199a9798dffb359cab2', 1, '1584165600', 1, '28a2edbe8b', 1584236338, 11),
(283, 1004, 3, '2PACK BEBIDA LACTEA SMILK 350 GRAMOS', 3.70, 9.82, 1.28, 11.10, 72, 0.00, '14-03-2020', '19:38:49', 72, 'Erick Nunez', '1', '3c67697e18899300a2648199a9798dffb359cab2', 1, '1584165600', 1, '016099a78f', 1584236338, 11),
(284, 1002, 2, '2 PACK ARROZ BLANCO DANY 1 LB', 1.09, 1.93, 0.25, 2.18, 72, 0.00, '14-03-2020', '19:38:52', 72, 'Erick Nunez', '1', '3c67697e18899300a2648199a9798dffb359cab2', 1, '1584165600', 1, 'c798e5ce42', 1584236338, 11),
(285, 1006, 1, 'JAMONADA BLACK LABEL 24/198 GRS HORMEL', 2.27, 2.01, 0.26, 2.27, 73, 0.00, '14-03-2020', '19:39:03', 73, 'Erick Nunez', '1', '3c67697e18899300a2648199a9798dffb359cab2', 1, '1584165600', 1, '6a94cbffbd', 1584236357, 11),
(286, 1004, 4, '2PACK BEBIDA LACTEA SMILK 350 GRAMOS', 3.70, 13.10, 1.70, 14.80, 73, 0.00, '14-03-2020', '19:39:08', 73, 'Erick Nunez', '1', '3c67697e18899300a2648199a9798dffb359cab2', 1, '1584165600', 1, 'eb49ba7d3a', 1584236357, 11),
(287, 1002, 1, '2 PACK ARROZ BLANCO DANY 1 LB', 1.09, 0.96, 0.13, 1.09, 73, 0.00, '14-03-2020', '19:39:10', 73, 'Erick Nunez', '1', '3c67697e18899300a2648199a9798dffb359cab2', 1, '1584165600', 1, 'bac4432f04', 1584236357, 11),
(288, 1005, 1, '4 PACK UNDERWOOD JAMON DEL DIABLO 120 G', 9.40, 8.32, 1.08, 9.40, 73, 0.00, '14-03-2020', '19:39:12', 73, 'Erick Nunez', '1', '3c67697e18899300a2648199a9798dffb359cab2', 1, '1584165600', 1, 'ef6eef5abb', 1584236357, 11),
(289, 1006, 1, 'JAMONADA BLACK LABEL 24/198 GRS HORMEL', 2.27, 2.01, 0.26, 2.27, 74, 0.00, '14-03-2020', '19:39:21', 74, 'Erick Nunez', '1', '3c67697e18899300a2648199a9798dffb359cab2', 1, '1584165600', 1, 'd81d8d0de8', 1584236367, 11),
(290, 1004, 1, '2PACK BEBIDA LACTEA SMILK 350 GRAMOS', 3.70, 3.27, 0.43, 3.70, 74, 0.00, '14-03-2020', '19:39:23', 74, 'Erick Nunez', '1', '3c67697e18899300a2648199a9798dffb359cab2', 1, '1584165600', 1, '4b89491c8d', 1584236367, 11),
(291, 1009, 1, 'ACEITE CANOLA ORISOL 3000ML PET', 7.08, 6.27, 0.81, 7.08, 75, 0.00, '14-03-2020', '19:39:32', 75, 'Erick Nunez', '1', '3c67697e18899300a2648199a9798dffb359cab2', 1, '1584165600', 1, '967a3f25ad', 1584236391, 11),
(292, 1004, 30, '2PACK BEBIDA LACTEA SMILK 350 GRAMOS', 3.70, 98.23, 12.77, 111.00, 75, 0.00, '14-03-2020', '19:39:34', 75, 'Erick Nunez', '1', '3c67697e18899300a2648199a9798dffb359cab2', 1, '1584165600', 1, '3b655129a6', 1584236391, 11),
(293, 1005, 2, '4 PACK UNDERWOOD JAMON DEL DIABLO 120 G', 9.40, 16.64, 2.16, 18.80, 75, 0.00, '14-03-2020', '19:39:35', 75, 'Erick Nunez', '1', '3c67697e18899300a2648199a9798dffb359cab2', 1, '1584165600', 1, '7e9bed5b3d', 1584236391, 11),
(294, 1006, 1, 'JAMONADA BLACK LABEL 24/198 GRS HORMEL', 2.27, 2.01, 0.26, 2.27, 76, 0.00, '14-03-2020', '19:39:57', 76, 'Erick Nunez', '1', '3c67697e18899300a2648199a9798dffb359cab2', 1, '1584165600', 1, 'dba4f25779', 1584236401, 11),
(295, 1006, 2, 'JAMONADA BLACK LABEL 24/198 GRS HORMEL', 2.27, 4.02, 0.52, 4.54, 77, 0.00, '15-03-2020', '19:41:53', 77, 'Erick Nunez', '1', '3c67697e18899300a2648199a9798dffb359cab2', 1, '1584252000', 1, '2e2fcfe6df', 1584322931, 11),
(296, 1001, 1, '2 PACK ARROZ BLANCO CINCO ESTRELLA LIBRA', 1.38, 1.22, 0.16, 1.38, 77, 0.00, '15-03-2020', '19:42:00', 77, 'Erick Nunez', '1', '3c67697e18899300a2648199a9798dffb359cab2', 1, '1584252000', 1, '1e67770e0d', 1584322931, 11),
(297, 1010, 2, 'ACEITE ORISOL 3000ML PET', 6.15, 10.88, 1.42, 12.30, 77, 0.00, '15-03-2020', '19:42:03', 77, 'Erick Nunez', '1', '3c67697e18899300a2648199a9798dffb359cab2', 1, '1584252000', 1, '010bfb9ed9', 1584322931, 11),
(298, 1011, 2, 'ADEREZO P/ENSALADA RANCH LIGHT 237 ML CL', 2.10, 3.72, 0.48, 4.20, 77, 0.00, '15-03-2020', '19:42:05', 77, 'Erick Nunez', '1', '3c67697e18899300a2648199a9798dffb359cab2', 1, '1584252000', 1, 'cdb08b3082', 1584322931, 11),
(299, 1012, 1, 'AVENA MOSH PARA FRESCO ORIGI QUAKER 600G', 2.21, 1.96, 0.25, 2.21, 78, 0.00, '15-03-2020', '19:42:20', 78, 'Erick Nunez', '1', '3c67697e18899300a2648199a9798dffb359cab2', 1, '1584252000', 1, '911ab94b8b', 1584322949, 11),
(300, 1011, 15, 'ADEREZO P/ENSALADA RANCH LIGHT 237 ML CL', 2.10, 27.88, 3.62, 31.50, 78, 0.00, '15-03-2020', '19:42:21', 78, 'Erick Nunez', '1', '3c67697e18899300a2648199a9798dffb359cab2', 1, '1584252000', 1, 'c8a6a3b9c5', 1584322949, 11),
(301, 1006, 1, 'JAMONADA BLACK LABEL 24/198 GRS HORMEL', 2.27, 2.01, 0.26, 2.27, 79, 0.00, '15-03-2020', '19:42:34', 79, 'Erick Nunez', '1', '3c67697e18899300a2648199a9798dffb359cab2', 1, '1584252000', 1, '51ef50a1ca', 1584322965, 11),
(302, 1004, 2, '2PACK BEBIDA LACTEA SMILK 350 GRAMOS', 3.70, 6.55, 0.85, 7.40, 79, 0.00, '15-03-2020', '19:42:36', 79, 'Erick Nunez', '1', '3c67697e18899300a2648199a9798dffb359cab2', 1, '1584252000', 1, '69f9981ac4', 1584322965, 11),
(303, 1001, 1, '2 PACK ARROZ BLANCO CINCO ESTRELLA LIBRA', 1.38, 1.22, 0.16, 1.38, 79, 0.00, '15-03-2020', '19:42:39', 79, 'Erick Nunez', '1', '3c67697e18899300a2648199a9798dffb359cab2', 1, '1584252000', 1, '6437798369', 1584322965, 11),
(304, 1001, 1, '2 PACK ARROZ BLANCO CINCO ESTRELLA LIBRA', 1.38, 1.22, 0.16, 1.38, 80, 0.00, '16-03-2020', '19:43:37', 80, 'Erick Nunez', '1', '3c67697e18899300a2648199a9798dffb359cab2', 1, '1584338400', 1, '66c657d263', 1584409451, 11),
(305, 1002, 1, '2 PACK ARROZ BLANCO DANY 1 LB', 1.09, 0.96, 0.13, 1.09, 80, 0.00, '16-03-2020', '19:43:39', 80, 'Erick Nunez', '1', '3c67697e18899300a2648199a9798dffb359cab2', 1, '1584338400', 1, 'ee71c5b181', 1584409451, 11),
(306, 1003, 1, '2 PACK HARINA DE MAIZ DANY 907 G', 1.49, 1.32, 0.17, 1.49, 80, 0.00, '16-03-2020', '19:43:41', 80, 'Erick Nunez', '1', '3c67697e18899300a2648199a9798dffb359cab2', 1, '1584338400', 1, '3621c4b207', 1584409451, 11),
(307, 1004, 1, '2PACK BEBIDA LACTEA SMILK 350 GRAMOS', 3.70, 3.27, 0.43, 3.70, 80, 0.00, '16-03-2020', '19:43:42', 80, 'Erick Nunez', '1', '3c67697e18899300a2648199a9798dffb359cab2', 1, '1584338400', 1, '75771fe4f3', 1584409451, 11),
(308, 1005, 1, '4 PACK UNDERWOOD JAMON DEL DIABLO 120 G', 9.40, 8.32, 1.08, 9.40, 80, 0.00, '16-03-2020', '19:43:43', 80, 'Erick Nunez', '1', '3c67697e18899300a2648199a9798dffb359cab2', 1, '1584338400', 1, 'ab0a2e6c12', 1584409451, 11),
(309, 1007, 1, '6PACK SOPAS INSTANTANEA LAKY MEN 64GR', 2.95, 2.61, 0.34, 2.95, 80, 0.00, '16-03-2020', '19:43:46', 80, 'Erick Nunez', '1', '3c67697e18899300a2648199a9798dffb359cab2', 1, '1584338400', 1, 'be89c4e63d', 1584409451, 11),
(310, 1008, 1, 'SOPA EN VASO RES MARUCHAN 12/2 25 OZ', 0.63, 0.56, 0.07, 0.63, 80, 0.00, '16-03-2020', '19:43:53', 80, 'Erick Nunez', '1', '3c67697e18899300a2648199a9798dffb359cab2', 1, '1584338400', 1, '055eb6ea13', 1584409451, 11),
(311, 1009, 1, 'ACEITE CANOLA ORISOL 3000ML PET', 7.08, 6.27, 0.81, 7.08, 80, 0.00, '16-03-2020', '19:43:57', 80, 'Erick Nunez', '1', '3c67697e18899300a2648199a9798dffb359cab2', 1, '1584338400', 1, '2722e5ce30', 1584409451, 11),
(312, 1010, 1, 'ACEITE ORISOL 3000ML PET', 6.15, 5.44, 0.71, 6.15, 80, 0.00, '16-03-2020', '19:43:59', 80, 'Erick Nunez', '1', '3c67697e18899300a2648199a9798dffb359cab2', 1, '1584338400', 1, '2bbcb724d3', 1584409451, 11),
(313, 1011, 1, 'ADEREZO P/ENSALADA RANCH LIGHT 237 ML CL', 2.10, 1.86, 0.24, 2.10, 80, 0.00, '16-03-2020', '19:44:01', 80, 'Erick Nunez', '1', '3c67697e18899300a2648199a9798dffb359cab2', 1, '1584338400', 1, '115e63090f', 1584409451, 11),
(314, 1012, 1, 'AVENA MOSH PARA FRESCO ORIGI QUAKER 600G', 2.21, 1.96, 0.25, 2.21, 80, 0.00, '16-03-2020', '19:44:03', 80, 'Erick Nunez', '1', '3c67697e18899300a2648199a9798dffb359cab2', 1, '1584338400', 1, '114a23f29f', 1584409451, 11),
(315, 1013, 1, 'BARRA GRANOLA MIEL HELIOS 162 G', 1.45, 1.28, 0.17, 1.45, 80, 0.00, '16-03-2020', '19:44:05', 80, 'Erick Nunez', '1', '3c67697e18899300a2648199a9798dffb359cab2', 1, '1584338400', 1, '0d239677b1', 1584409451, 11),
(316, 1014, 1, 'CEREAL KOMPLETE PASAS Y MANZANA 460 G', 3.25, 2.88, 0.37, 3.25, 80, 0.00, '16-03-2020', '19:44:06', 80, 'Erick Nunez', '1', '3c67697e18899300a2648199a9798dffb359cab2', 1, '1584338400', 1, '719bb7b1bd', 1584409451, 11),
(317, 1012, 1, 'AVENA MOSH PARA FRESCO ORIGI QUAKER 600G', 2.21, 1.96, 0.25, 2.21, 81, 0.00, '16-03-2020', '19:44:19', 81, 'Erick Nunez', '1', '3c67697e18899300a2648199a9798dffb359cab2', 1, '1584338400', 1, 'f2a5908f13', 1584409473, 11),
(318, 1005, 2, '4 PACK UNDERWOOD JAMON DEL DIABLO 120 G', 9.40, 16.64, 2.16, 18.80, 81, 0.00, '16-03-2020', '19:44:23', 81, 'Erick Nunez', '1', '3c67697e18899300a2648199a9798dffb359cab2', 1, '1584338400', 1, 'be96348073', 1584409473, 11),
(319, 1002, 1, '2 PACK ARROZ BLANCO DANY 1 LB', 1.09, 0.96, 0.13, 1.09, 81, 0.00, '16-03-2020', '19:44:25', 81, 'Erick Nunez', '1', '3c67697e18899300a2648199a9798dffb359cab2', 1, '1584338400', 1, 'd86c43dec4', 1584409473, 11),
(320, 1004, 1, '2PACK BEBIDA LACTEA SMILK 350 GRAMOS', 3.70, 3.27, 0.43, 3.70, 81, 0.00, '16-03-2020', '19:44:27', 81, 'Erick Nunez', '1', '3c67697e18899300a2648199a9798dffb359cab2', 1, '1584338400', 1, '83aef13139', 1584409473, 11),
(321, 1006, 1, 'JAMONADA BLACK LABEL 24/198 GRS HORMEL', 2.27, 2.01, 0.26, 2.27, 83, 0.00, '16-03-2020', '19:44:39', 82, 'Erick Nunez', '1', '3c67697e18899300a2648199a9798dffb359cab2', 1, '1584338400', 1, '92cf78cf39', 1584409529, 11),
(322, 1004, 1, '2PACK BEBIDA LACTEA SMILK 350 GRAMOS', 3.70, 3.27, 0.43, 3.70, 83, 0.00, '16-03-2020', '19:44:42', 82, 'Erick Nunez', '1', '3c67697e18899300a2648199a9798dffb359cab2', 1, '1584338400', 1, '5ce303f2e7', 1584409529, 11),
(323, 1008, 1, 'SOPA EN VASO RES MARUCHAN 12/2 25 OZ', 0.63, 0.56, 0.07, 0.63, 83, 0.00, '16-03-2020', '19:44:43', 82, 'Erick Nunez', '1', '3c67697e18899300a2648199a9798dffb359cab2', 1, '1584338400', 1, '9fec508324', 1584409529, 11),
(324, 1001, 1, '2 PACK ARROZ BLANCO CINCO ESTRELLA LIBRA', 1.38, 1.22, 0.16, 1.38, 83, 0.00, '16-03-2020', '19:45:16', 82, 'Erick Nunez', '1', '3c67697e18899300a2648199a9798dffb359cab2', 1, '1584338400', 1, '63674cdb6b', 1584409529, 11),
(325, 1003, 1, '2 PACK HARINA DE MAIZ DANY 907 G', 1.49, 1.32, 0.17, 1.49, 84, 0.00, '16-03-2020', '19:45:35', 83, 'Erick Nunez', '1', '3c67697e18899300a2648199a9798dffb359cab2', 1, '1584338400', 1, '1113d265da', 1584409544, 11),
(326, 1004, 2, '2PACK BEBIDA LACTEA SMILK 350 GRAMOS', 3.70, 6.55, 0.85, 7.40, 84, 0.00, '16-03-2020', '19:45:36', 83, 'Erick Nunez', '1', '3c67697e18899300a2648199a9798dffb359cab2', 1, '1584338400', 1, 'ceda5968b7', 1584409544, 11),
(327, 1005, 1, '4 PACK UNDERWOOD JAMON DEL DIABLO 120 G', 9.40, 8.32, 1.08, 9.40, 84, 0.00, '16-03-2020', '19:45:37', 83, 'Erick Nunez', '1', '3c67697e18899300a2648199a9798dffb359cab2', 1, '1584338400', 1, '82fdd9b316', 1584409544, 11),
(328, 1002, 1, '2 PACK ARROZ BLANCO DANY 1 LB', 1.09, 0.96, 0.13, 1.09, 84, 0.00, '16-03-2020', '19:45:38', 83, 'Erick Nunez', '1', '3c67697e18899300a2648199a9798dffb359cab2', 1, '1584338400', 1, '952b8bdd4f', 1584409544, 11),
(329, 1005, 1, '4 PACK UNDERWOOD JAMON DEL DIABLO 120 G', 9.40, 8.32, 1.08, 9.40, 85, 0.00, '17-03-2020', '19:46:22', 84, 'Erick Nunez', '1', '3c67697e18899300a2648199a9798dffb359cab2', 1, '1584424800', 1, 'b6dae9f55e', 1584496002, 11),
(330, 1009, 1, 'ACEITE CANOLA ORISOL 3000ML PET', 7.08, 6.27, 0.81, 7.08, 85, 0.00, '17-03-2020', '19:46:25', 84, 'Erick Nunez', '1', '3c67697e18899300a2648199a9798dffb359cab2', 1, '1584424800', 1, '38a1dd804d', 1584496002, 11),
(331, 1004, 35, '2PACK BEBIDA LACTEA SMILK 350 GRAMOS', 3.70, 114.60, 14.90, 129.50, 85, 0.00, '17-03-2020', '19:46:27', 84, 'Erick Nunez', '1', '3c67697e18899300a2648199a9798dffb359cab2', 1, '1584424800', 1, 'e5fbec5312', 1584496002, 11),
(332, 1006, 1, 'JAMONADA BLACK LABEL 24/198 GRS HORMEL', 2.27, 2.01, 0.26, 2.27, 86, 0.00, '17-03-2020', '19:46:47', 85, 'Erick Nunez', '2', '3c67697e18899300a2648199a9798dffb359cab2', 1, '1584424800', 1, 'd8ea7adaea', 1584496020, 11),
(333, 1004, 1, '2PACK BEBIDA LACTEA SMILK 350 GRAMOS', 3.70, 3.27, 0.43, 3.70, 86, 0.00, '17-03-2020', '19:46:49', 85, 'Erick Nunez', '2', '3c67697e18899300a2648199a9798dffb359cab2', 1, '1584424800', 1, '68a9734b68', 1584496020, 11),
(334, 1003, 1, '2 PACK HARINA DE MAIZ DANY 907 G', 1.49, 1.32, 0.17, 1.49, 86, 0.00, '17-03-2020', '19:46:51', 85, 'Erick Nunez', '2', '3c67697e18899300a2648199a9798dffb359cab2', 1, '1584424800', 1, '1a4fd41137', 1584496020, 11),
(335, 1006, 1, 'JAMONADA BLACK LABEL 24/198 GRS HORMEL', 2.27, 2.01, 0.26, 2.27, 87, 0.00, '17-03-2020', '19:47:05', 86, 'Erick Nunez', '1', '3c67697e18899300a2648199a9798dffb359cab2', 1, '1584424800', 1, '4995e395b7', 1584496030, 11),
(336, 1004, 1, '2PACK BEBIDA LACTEA SMILK 350 GRAMOS', 3.70, 3.27, 0.43, 3.70, 87, 0.00, '17-03-2020', '19:47:06', 86, 'Erick Nunez', '1', '3c67697e18899300a2648199a9798dffb359cab2', 1, '1584424800', 1, '65c03200ea', 1584496030, 11),
(337, 1006, 1, 'JAMONADA BLACK LABEL 24/198 GRS HORMEL', 2.27, 2.01, 0.26, 2.27, 88, 0.00, '18-03-2020', '19:48:57', 87, 'Erick Nunez', '1', '3c67697e18899300a2648199a9798dffb359cab2', 1, '1584511200', 1, '36cecd4c0b', 1584582556, 11),
(338, 1004, 30, '2PACK BEBIDA LACTEA SMILK 350 GRAMOS', 3.70, 98.23, 12.77, 111.00, 88, 0.00, '18-03-2020', '19:48:58', 87, 'Erick Nunez', '1', '3c67697e18899300a2648199a9798dffb359cab2', 1, '1584511200', 1, '171ba2ca15', 1584582556, 11),
(339, 1005, 2, '4 PACK UNDERWOOD JAMON DEL DIABLO 120 G', 9.40, 16.64, 2.16, 18.80, 88, 0.00, '18-03-2020', '19:49:00', 87, 'Erick Nunez', '1', '3c67697e18899300a2648199a9798dffb359cab2', 1, '1584511200', 1, 'dc37c4a521', 1584582556, 11),
(340, 1009, 20, 'ACEITE CANOLA ORISOL 3000ML PET', 7.08, 125.31, 16.29, 141.60, 89, 0.00, '18-03-2020', '19:49:26', 88, 'Erick Nunez', '1', '3c67697e18899300a2648199a9798dffb359cab2', 1, '1584511200', 1, 'efd8ca0029', 1584582579, 11),
(341, 1006, 1, 'JAMONADA BLACK LABEL 24/198 GRS HORMEL', 2.27, 2.01, 0.26, 2.27, 90, 0.00, '18-03-2020', '19:49:43', 89, 'Erick Nunez', '2', '3c67697e18899300a2648199a9798dffb359cab2', 1, '1584511200', 1, '31b2b8410f', 1584582592, 11),
(342, 1004, 1, '2PACK BEBIDA LACTEA SMILK 350 GRAMOS', 3.70, 3.27, 0.43, 3.70, 90, 0.00, '18-03-2020', '19:49:46', 89, 'Erick Nunez', '2', '3c67697e18899300a2648199a9798dffb359cab2', 1, '1584511200', 1, '4e746ea71d', 1584582592, 11),
(343, 1006, 1, 'JAMONADA BLACK LABEL 24/198 GRS HORMEL', 2.27, 2.01, 0.26, 2.27, 91, 0.00, '18-03-2020', '19:49:57', 90, 'Erick Nunez', '2', '3c67697e18899300a2648199a9798dffb359cab2', 1, '1584511200', 1, '153e21d39a', 1584582605, 11),
(344, 1006, 1, 'JAMONADA BLACK LABEL 24/198 GRS HORMEL', 2.27, 2.01, 0.26, 2.27, 92, 0.00, '18-03-2020', '19:50:10', 91, 'Erick Nunez', '3', '3c67697e18899300a2648199a9798dffb359cab2', 1, '1584511200', 1, '9de5a8d188', 1584582633, 11),
(345, 1004, 2, '2PACK BEBIDA LACTEA SMILK 350 GRAMOS', 3.70, 6.55, 0.85, 7.40, 92, 0.00, '18-03-2020', '19:50:12', 91, 'Erick Nunez', '3', '3c67697e18899300a2648199a9798dffb359cab2', 1, '1584511200', 1, '2534c357f3', 1584582633, 11),
(346, 1003, 4, 'CEMENTO BLANCO, BOLSA DE 42.5 KGS.', 8.20, 29.03, 3.77, 32.80, 29, 0.00, '06-03-2020', '19:56:01', 29, 'Erick Nunez', '1', '3c67697e18899300a2648199a9798dffb359cab2', 1, '1583474400', 1, '1f0242c5cf', 1583546170, 10),
(347, 1005, 3, 'DECOBLOCK BLANCO HUESO GRANO MEDIO, BOLSA DE 40 KGS.', 8.70, 23.10, 3.00, 26.10, 29, 0.00, '06-03-2020', '19:56:05', 29, 'Erick Nunez', '1', '3c67697e18899300a2648199a9798dffb359cab2', 1, '1583474400', 1, '5d09522288', 1583546170, 10),
(348, 1012, 3, 'JUEGO DE LLAVES MIXTAS 6-19 MM, SET 9 PZS', 12.75, 33.85, 4.40, 38.25, 30, 0.00, '06-03-2020', '19:56:20', 30, 'Erick Nunez', '1', '3c67697e18899300a2648199a9798dffb359cab2', 1, '1583474400', 1, '2941f906e6', 1583546185, 10),
(349, 1010, 4, 'CAJA PARA HERRAMIENTAS PLáSTICA DE 12PLG', 3.25, 11.50, 1.50, 13.00, 31, 0.00, '06-03-2020', '19:56:34', 31, 'Erick Nunez', '1', '3c67697e18899300a2648199a9798dffb359cab2', 1, '1583474400', 1, '1c9da9b8af', 1583546197, 10),
(350, 1011, 4, 'CAJA PARA HERRAMIENTAS PLáSTICA DE 26PLG', 45.00, 159.29, 20.71, 180.00, 32, 0.00, '06-03-2020', '19:56:44', 32, 'Erick Nunez', '3', '3c67697e18899300a2648199a9798dffb359cab2', 1, '1583474400', 1, 'e52c40329a', 1583546219, 10),
(351, 1004, 3, 'CEMENTO GRIS CUSCATLáN, BOLSA DE 42.5 KGS', 8.20, 21.77, 2.83, 24.60, 33, 0.00, '06-03-2020', '19:57:05', 33, 'Erick Nunez', '2', '3c67697e18899300a2648199a9798dffb359cab2', 1, '1583474400', 1, 'cc0161cb16', 1583546234, 10),
(352, 1008, 1, 'NAVAJA PARA ELECTRICISTA', 4.60, 4.07, 0.53, 4.60, 34, 0.00, '07-03-2020', '20:00:20', 34, 'Erick Nunez', '1', '3c67697e18899300a2648199a9798dffb359cab2', 1, '1583560800', 1, 'f4e7496106', 1583632830, 10),
(353, 1011, 1, 'CAJA PARA HERRAMIENTAS PLáSTICA DE 26PLG', 45.00, 39.82, 5.18, 45.00, 34, 0.00, '07-03-2020', '20:00:24', 34, 'Erick Nunez', '1', '3c67697e18899300a2648199a9798dffb359cab2', 1, '1583560800', 1, '92bdff054b', 1583632830, 10),
(354, 1002, 15, 'CEMENTO BLANCO, BOLSA DE 42.5 KGS.', 17.50, 232.30, 30.20, 262.50, 35, 0.00, '07-03-2020', '20:00:40', 35, 'Erick Nunez', '1', '3c67697e18899300a2648199a9798dffb359cab2', 1, '1583560800', 1, '67d774a300', 1583632844, 10),
(355, 1007, 3, 'LIMPIADOR DE CONTACTOS SECADO RáPIDO', 9.50, 25.22, 3.28, 28.50, 38, 0.00, '07-03-2020', '20:00:51', 36, 'Erick Nunez', '1', '3c67697e18899300a2648199a9798dffb359cab2', 1, '1583560800', 1, '2f4f52674b', 1583632907, 10),
(356, 1006, 3, 'DECOBLOCK GRIS GRANO FINO, BOLSA DE 40 KGS.', 7.60, 20.18, 2.62, 22.80, 38, 0.00, '07-03-2020', '20:00:56', 36, 'Erick Nunez', '1', '3c67697e18899300a2648199a9798dffb359cab2', 1, '1583560800', 1, 'cfe85a41a8', 1583632907, 10),
(357, 1013, 3, 'FOCO ESMERILADO DE 40 WATTS', 0.45, 1.19, 0.16, 1.35, 37, 0.00, '07-03-2020', '20:01:02', 37, 'Erick Nunez', '1', '3c67697e18899300a2648199a9798dffb359cab2', 1, '1583560800', 1, 'c3325574a7', 1583632898, 10),
(358, 1019, 5, 'TUBO PVC DE 160 PSI, 2.1/2 PULGADAS.', 14.00, 61.95, 8.05, 70.00, 37, 0.00, '07-03-2020', '20:01:09', 37, 'Erick Nunez', '1', '3c67697e18899300a2648199a9798dffb359cab2', 1, '1583560800', 1, 'de6c1a43f8', 1583632898, 10),
(359, 1015, 4, 'ACE - LáMPARA DE PARED LED 20W, LUZ BLANCA.', 22.50, 79.65, 10.35, 90.00, 37, 0.00, '07-03-2020', '20:01:15', 37, 'Erick Nunez', '1', '3c67697e18899300a2648199a9798dffb359cab2', 1, '1583560800', 1, '23e3a0ce59', 1583632898, 10),
(360, 1006, 4, 'DECOBLOCK GRIS GRANO FINO, BOLSA DE 40 KGS.', 7.60, 26.90, 3.50, 30.40, 36, 0.00, '07-03-2020', '20:01:24', 38, 'Erick Nunez', '2', '3c67697e18899300a2648199a9798dffb359cab2', 1, '1583560800', 1, 'aa3a3876bd', 1583632891, 10),
(361, 1012, 4, 'JUEGO DE LLAVES MIXTAS 6-19 MM, SET 9 PZS', 12.75, 45.13, 5.87, 51.00, 39, 0.00, '07-03-2020', '20:02:00', 39, 'Erick Nunez', '1', '3c67697e18899300a2648199a9798dffb359cab2', 1, '1583560800', 1, '3f513c3d28', 1583632924, 10),
(362, 1002, 1, 'CEMENTO BLANCO, BOLSA DE 42.5 KGS.', 17.50, 15.49, 2.01, 17.50, 40, 0.00, '08-03-2020', '20:03:07', 40, 'Erick Nunez', '1', '3c67697e18899300a2648199a9798dffb359cab2', 1, '1583647200', 1, 'ac15a30b1e', 1583719396, 10),
(363, 1011, 1, 'CAJA PARA HERRAMIENTAS PLáSTICA DE 26PLG', 45.00, 39.82, 5.18, 45.00, 40, 0.00, '08-03-2020', '20:03:10', 40, 'Erick Nunez', '1', '3c67697e18899300a2648199a9798dffb359cab2', 1, '1583647200', 1, 'acc6d8ee3f', 1583719396, 10),
(364, 1002, 1, 'CEMENTO BLANCO, BOLSA DE 42.5 KGS.', 17.50, 15.49, 2.01, 17.50, 41, 0.00, '09-03-2020', '20:04:48', 41, 'Erick Nunez', '1', '3c67697e18899300a2648199a9798dffb359cab2', 1, '1583733600', 1, '92ca874b42', 1583805903, 10),
(365, 1006, 52, 'DECOBLOCK GRIS GRANO FINO, BOLSA DE 40 KGS.', 7.60, 349.73, 45.47, 395.20, 41, 0.00, '09-03-2020', '20:04:58', 41, 'Erick Nunez', '1', '3c67697e18899300a2648199a9798dffb359cab2', 1, '1583733600', 1, '1ae7866004', 1583805903, 10),
(366, 1004, 15, 'CEMENTO GRIS CUSCATLáN, BOLSA DE 42.5 KGS', 8.20, 108.85, 14.15, 123.00, 42, 0.00, '09-03-2020', '20:05:12', 42, 'Erick Nunez', '2', '3c67697e18899300a2648199a9798dffb359cab2', 1, '1583733600', 1, '70a387e3e3', 1583805924, 10),
(367, 1002, 1, 'CEMENTO BLANCO, BOLSA DE 42.5 KGS.', 17.50, 15.49, 2.01, 17.50, 43, 0.00, '10-03-2020', '20:06:28', 43, 'Erick Nunez', '1', '3c67697e18899300a2648199a9798dffb359cab2', 1, '1583820000', 1, 'cd3107bb49', 1583892414, 10),
(368, 1004, 1, 'CEMENTO GRIS CUSCATLáN, BOLSA DE 42.5 KGS', 8.20, 7.26, 0.94, 8.20, 43, 0.00, '10-03-2020', '20:06:33', 43, 'Erick Nunez', '1', '3c67697e18899300a2648199a9798dffb359cab2', 1, '1583820000', 1, '1b2a89c513', 1583892414, 10),
(369, 1013, 3, 'FOCO ESMERILADO DE 40 WATTS', 0.45, 1.19, 0.16, 1.35, 43, 0.00, '10-03-2020', '20:06:50', 43, 'Erick Nunez', '1', '3c67697e18899300a2648199a9798dffb359cab2', 1, '1583820000', 1, '451e36282b', 1583892414, 10),
(370, 1013, 3, 'FOCO ESMERILADO DE 40 WATTS', 0.45, 1.19, 0.16, 1.35, 44, 0.00, '10-03-2020', '20:07:02', 44, 'Erick Nunez', '2', '3c67697e18899300a2648199a9798dffb359cab2', 1, '1583820000', 1, '435b4448fe', 1583892431, 10),
(371, 1004, 40, 'CEMENTO GRIS CUSCATLáN, BOLSA DE 42.5 KGS', 8.20, 290.27, 37.73, 328.00, 45, 0.00, '10-03-2020', '20:07:30', 45, 'Erick Nunez', '1', '3c67697e18899300a2648199a9798dffb359cab2', 1, '1583820000', 1, 'ed77ec33e9', 1583892454, 10),
(372, 1005, 50, 'DECOBLOCK BLANCO HUESO GRANO MEDIO, BOLSA DE 40 KGS.', 8.70, 384.96, 50.04, 435.00, 46, 0.00, '11-03-2020', '20:08:20', 46, 'Erick Nunez', '1', '3c67697e18899300a2648199a9798dffb359cab2', 1, '1583906400', 1, 'e285fdbcc7', 1583978904, 10),
(373, 1014, 1, 'FOCO CLARO GE 60W-130V 24651/3', 0.70, 0.62, 0.08, 0.70, 47, 0.00, '11-03-2020', '20:08:30', 47, 'Erick Nunez', '1', '3c67697e18899300a2648199a9798dffb359cab2', 1, '1583906400', 1, '763e50089f', 1583978915, 10),
(374, 1007, 4, 'LIMPIADOR DE CONTACTOS SECADO RáPIDO', 9.50, 33.63, 4.37, 38.00, 48, 0.00, '12-03-2020', '20:09:14', 48, 'Erick Nunez', '1', '3c67697e18899300a2648199a9798dffb359cab2', 1, '1583992800', 1, '5de1c2ee40', 1584065375, 10),
(375, 1004, 4, 'CEMENTO GRIS CUSCATLáN, BOLSA DE 42.5 KGS', 8.20, 29.03, 3.77, 32.80, 48, 0.00, '12-03-2020', '20:09:23', 48, 'Erick Nunez', '1', '3c67697e18899300a2648199a9798dffb359cab2', 1, '1583992800', 1, 'ac0af7f64d', 1584065375, 10),
(376, 1006, 1, 'DECOBLOCK GRIS GRANO FINO, BOLSA DE 40 KGS.', 7.60, 6.73, 0.87, 7.60, 48, 0.00, '12-03-2020', '20:09:31', 48, 'Erick Nunez', '1', '3c67697e18899300a2648199a9798dffb359cab2', 1, '1583992800', 1, '86579597bb', 1584065375, 10),
(377, 1009, 4, 'TENAZA MULTIUSO 16 EN 1 CON ESTUCHE Y LUZ LED', 13.25, 46.90, 6.10, 53.00, 49, 0.00, '12-03-2020', '20:09:44', 49, 'Erick Nunez', '1', '3c67697e18899300a2648199a9798dffb359cab2', 1, '1583992800', 1, '7b2cea8389', 1584065388, 10),
(378, 1006, 60, 'DECOBLOCK GRIS GRANO FINO, BOLSA DE 40 KGS.', 7.60, 403.54, 52.46, 456.00, 50, 0.00, '13-03-2020', '20:10:55', 50, 'Erick Nunez', '1', '3c67697e18899300a2648199a9798dffb359cab2', 1, '1584079200', 1, 'df897d5c3c', 1584151860, 10),
(379, 1004, 10, 'CEMENTO GRIS CUSCATLáN, BOLSA DE 42.5 KGS', 8.20, 72.57, 9.43, 82.00, 51, 0.00, '13-03-2020', '20:11:09', 51, 'Erick Nunez', '1', '3c67697e18899300a2648199a9798dffb359cab2', 1, '1584079200', 1, '5a37657bd1', 1584151878, 10),
(380, 1004, 50, 'CEMENTO GRIS CUSCATLáN, BOLSA DE 42.5 KGS', 8.20, 362.83, 47.17, 410.00, 52, 0.00, '14-03-2020', '20:12:12', 52, 'Erick Nunez', '1', '3c67697e18899300a2648199a9798dffb359cab2', 1, '1584165600', 1, '58ea9ae493', 1584238338, 10),
(381, 1003, 50, 'CEMENTO BLANCO, BOLSA DE 42.5 KGS.', 8.20, 362.83, 47.17, 410.00, 53, 0.00, '15-03-2020', '20:13:40', 53, 'Erick Nunez', '1', '3c67697e18899300a2648199a9798dffb359cab2', 1, '1584252000', 1, 'f21c5aa8f7', 1584324825, 10),
(382, 1007, 1, 'LIMPIADOR DE CONTACTOS SECADO RáPIDO', 9.50, 8.41, 1.09, 9.50, 54, 0.00, '15-03-2020', '20:13:51', 54, 'Erick Nunez', '1', '3c67697e18899300a2648199a9798dffb359cab2', 1, '1584252000', 1, 'd0e7877425', 1584324836, 10),
(383, 1019, 10, 'TUBO PVC DE 160 PSI, 2.1/2 PULGADAS.', 13.75, 121.68, 15.82, 137.50, 55, 0.00, '16-03-2020', '20:14:30', 55, 'Erick Nunez', '1', '3c67697e18899300a2648199a9798dffb359cab2', 1, '1584338400', 1, '400eb47b17', 1584411272, 10),
(384, 1009, 10, 'TENAZA MULTIUSO 16 EN 1 CON ESTUCHE Y LUZ LED', 13.25, 117.26, 15.24, 132.50, 56, 0.00, '16-03-2020', '20:14:41', 56, 'Erick Nunez', '1', '3c67697e18899300a2648199a9798dffb359cab2', 1, '1584338400', 1, '5d1d70edf5', 1584411285, 10),
(385, 1005, 30, 'DECOBLOCK BLANCO HUESO GRANO MEDIO, BOLSA DE 40 KGS.', 8.70, 230.97, 30.03, 261.00, 57, 0.00, '16-03-2020', '20:14:54', 57, 'Erick Nunez', '1', '3c67697e18899300a2648199a9798dffb359cab2', 1, '1584338400', 1, '0554c4e1d8', 1584411298, 10),
(386, 1003, 50, 'CEMENTO BLANCO, BOLSA DE 42.5 KGS.', 8.20, 362.83, 47.17, 410.00, 58, 0.00, '17-03-2020', '20:15:37', 58, 'Erick Nunez', '1', '3c67697e18899300a2648199a9798dffb359cab2', 1, '1584424800', 1, '0166d3c916', 1584497741, 10),
(387, 1017, 1, 'EXTENSIóN ELéCTRICA DE 15 MTS, 3 SALIDAS, 16/3 AWG.', 32.95, 29.16, 3.79, 32.95, 59, 0.00, '17-03-2020', '20:15:47', 59, 'Erick Nunez', '1', '3c67697e18899300a2648199a9798dffb359cab2', 1, '1584424800', 1, 'a2bcbaf7aa', 1584497751, 10),
(388, 1002, 35, 'CEMENTO BLANCO, BOLSA DE 42.5 KGS.', 17.50, 542.04, 70.46, 612.50, 60, 0.00, '18-03-2020', '20:17:12', 60, 'Erick Nunez', '1', '3c67697e18899300a2648199a9798dffb359cab2', 1, '1584511200', 1, '84a45e982a', 1584584237, 10),
(389, 1010, 1, 'CAJA PARA HERRAMIENTAS PLáSTICA DE 12PLG', 3.25, 2.88, 0.37, 3.25, 61, 0.00, '18-03-2020', '20:17:24', 61, 'Erick Nunez', '1', '3c67697e18899300a2648199a9798dffb359cab2', 1, '1584511200', 1, 'dcb1bb617c', 1584584248, 10),
(390, 1005, 6, 'DECOBLOCK BLANCO HUESO GRANO MEDIO, BOLSA DE 40 KGS.', 8.70, 46.19, 6.01, 52.20, 62, 0.00, '18-03-2020', '20:17:36', 62, 'Erick Nunez', '2', '3c67697e18899300a2648199a9798dffb359cab2', 1, '1584511200', 1, '796adef995', 1584584262, 10),
(391, 1010, 3, 'CAJA PARA HERRAMIENTAS PLáSTICA DE 12PLG', 2.92, 7.77, 1.01, 8.78, 63, 0.98, '19-03-2020', '15:45:17', 63, 'Erick Nunez', '1', '3c67697e18899300a2648199a9798dffb359cab2', 1, '1584597600', 1, 'd86e648b40', 1584654361, 10),
(392, 1008, 3, 'NAVAJA PARA ELECTRICISTA', 3.68, 9.77, 1.27, 11.04, 63, 2.76, '19-03-2020', '15:45:31', 63, 'Erick Nunez', '1', '3c67697e18899300a2648199a9798dffb359cab2', 1, '1584597600', 1, '8487762333', 1584654361, 10),
(393, 1008, 1, 'NAVAJA PARA ELECTRICISTA', 4.60, 4.07, 0.53, 4.60, 63, 0.00, '19-03-2020', '15:45:58', 63, 'Erick Nunez', '1', '3c67697e18899300a2648199a9798dffb359cab2', 1, '1584597600', 1, 'ff6c8c4bd1', 1584654361, 10),
(394, 1004, 3, 'CEMENTO GRIS CUSCATLáN, BOLSA DE 42.5 KGS', 8.20, 21.77, 2.83, 24.60, 64, 0.00, '19-03-2020', '15:46:07', 64, 'Erick Nunez', '1', '3c67697e18899300a2648199a9798dffb359cab2', 1, '1584597600', 1, '30acb92119', 1584654369, 10),
(395, 1007, 2, 'LIMPIADOR DE CONTACTOS SECADO RáPIDO', 8.55, 15.13, 1.97, 17.10, 65, 1.90, '19-03-2020', '15:46:16', 65, 'Erick Nunez', '1', '3c67697e18899300a2648199a9798dffb359cab2', 1, '1584597600', 1, '0a619c4af2', 1584654384, 10),
(397, 1002, 3, 'CEMENTO BLANCO, BOLSA DE 42.5 KGS.', 15.40, 40.88, 5.32, 46.20, 66, 6.30, '19-03-2020', '15:54:42', 66, 'Erick Nunez', '1', '3c67697e18899300a2648199a9798dffb359cab2', 1, '1584597600', 1, '0f71cfe615', 1584655153, 10),
(405, 1005, 1, 'DECOBLOCK BLANCO HUESO GRANO MEDIO, BOLSA DE 40 KGS.', 8.70, 7.70, 1.00, 8.70, 67, 0.00, '20-03-2020', '17:48:37', 67, 'Erick Nunez', '1', 'Erick', 1, '1584684000', 1, 'c150d199f7', 1584752160, 10),
(406, 1010, 1, 'CAJA PARA HERRAMIENTAS PLáSTICA DE 12PLG', 3.25, 2.88, 0.37, 3.25, 67, 0.00, '20-03-2020', '17:53:52', 67, 'Erick Nunez', '1', 'Erick', 1, '1584684000', 1, '687dc0e069', 1584752160, 10),
(469, 1003, 1, 'CEMENTO BLANCO, BOLSA DE 42.5 KGS.', 8.20, 7.26, 0.94, 8.20, 68, 0.00, '20-03-2020', '18:58:46', 68, 'Erick Nunez', '1', 'Erick', 1, '1584684000', 1, 'ffcf23a7a0', 1584752359, 10),
(470, 1004, 1, 'CEMENTO GRIS CUSCATLáN, BOLSA DE 42.5 KGS', 8.20, 7.26, 0.94, 8.20, 68, 0.00, '20-03-2020', '18:58:46', 68, 'Erick Nunez', '1', 'Erick', 1, '1584684000', 1, '8974dc482d', 1584752359, 10),
(471, 1002, 1, 'CEMENTO BLANCO, BOLSA DE 42.5 KGS.', 17.50, 15.49, 2.01, 17.50, 68, 0.00, '20-03-2020', '18:58:46', 68, 'Erick Nunez', '1', 'Erick', 1, '1584684000', 1, '7c08ff434b', 1584752359, 10),
(473, 1002, 1, '2 PACK ARROZ BLANCO DANY 1 LB', 1.09, 0.96, 0.13, 1.09, 93, 0.00, '20-03-2020', '19:01:15', 92, 'Abarrotes Admin', '1', 'db2625', 1, '1584684000', 1, 'e6bcf19121', 1584752501, 11),
(474, 1004, 1, '2PACK BEBIDA LACTEA SMILK 350 GRAMOS', 3.70, 3.27, 0.43, 3.70, 93, 0.00, '20-03-2020', '19:01:15', 92, 'Abarrotes Admin', '1', 'db2625', 1, '1584684000', 1, '8320d2029c', 1584752501, 11),
(475, 1010, 6, 'ACEITE ORISOL 3000ML PET', 6.15, 32.65, 4.25, 36.90, 93, 0.00, '20-03-2020', '19:01:15', 92, 'Abarrotes Admin', '1', 'db2625', 1, '1584684000', 1, 'cb527f651d', 1584752501, 11),
(476, 1012, 1, 'AVENA MOSH PARA FRESCO ORIGI QUAKER 600G', 2.21, 1.96, 0.25, 2.21, 93, 0.00, '20-03-2020', '19:01:15', 92, 'Abarrotes Admin', '1', 'db2625', 1, '1584684000', 1, '5a4266fc36', 1584752501, 11),
(477, 1011, 3, 'ADEREZO P/ENSALADA RANCH LIGHT 237 ML CL', 2.10, 5.58, 0.72, 6.30, 93, 0.00, '20-03-2020', '19:01:15', 92, 'Abarrotes Admin', '1', 'db2625', 1, '1584684000', 1, '40b323171f', 1584752501, 11),
(478, 1001, 1, '2 PACK ARROZ BLANCO CINCO ESTRELLA LIBRA', 1.38, 1.22, 0.16, 1.38, 93, 0.00, '20-03-2020', '19:01:15', 92, 'Abarrotes Admin', '1', 'db2625', 1, '1584684000', 1, '22edd3bdb5', 1584752501, 11),
(479, 1001, 3, 'ABRAZADERA STRUT 1/2 TOPAZ', 0.95, 2.52, 0.33, 2.85, 69, 0.00, '23-03-2020', '15:45:17', 69, 'Erick Nunez', '1', 'Erick', 1, '1584943200', 1, 'd7a89affd8', 1584999925, 10);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ticket_cliente`
--

CREATE TABLE `ticket_cliente` (
  `id` int(6) NOT NULL,
  `factura` int(6) NOT NULL,
  `orden` int(6) NOT NULL,
  `tx` int(6) NOT NULL,
  `cliente` varchar(12) NOT NULL,
  `fecha` varchar(25) NOT NULL,
  `hora` varchar(25) NOT NULL,
  `hash` varchar(12) NOT NULL,
  `time` int(12) NOT NULL,
  `td` int(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Registra los clientes de cada factura';

--
-- Volcado de datos para la tabla `ticket_cliente`
--

INSERT INTO `ticket_cliente` (`id`, `factura`, `orden`, `tx`, `cliente`, `fecha`, `hora`, `hash`, `time`, `td`) VALUES
(1, 8, 8, 1, '9811234b6f', '01-03-2020', '17:07:03', 'ebe318df04', 1583104033, 11),
(2, 9, 9, 1, '73e0d7c3ff', '01-03-2020', '17:07:31', 'd435a6718b', 1583104056, 11),
(3, 0, 5, 1, '9811234b6f', '01-03-2020', '17:13:52', 'ae65f3c1dd', 1583104432, 10),
(4, 5, 5, 1, '461904b806', '01-03-2020', '17:14:00', 'fabfa203cc', 1583104449, 10),
(5, 7, 7, 1, '4d2344fe9e', '01-03-2020', '17:20:14', '40fb6dd2df', 1583104821, 10),
(6, 14, 14, 1, '9811234b6f', '02-03-2020', '17:32:30', 'ec80ab0915', 1583191958, 11),
(7, 17, 17, 1, '9811234b6f', '03-03-2020', '17:45:37', 'cfaf78d92e', 1583279146, 11),
(8, 15, 15, 1, '461904b806', '03-03-2020', '17:59:34', '6903eeee0b', 1583279982, 10),
(9, 23, 23, 1, '9811234b6f', '04-03-2020', '18:23:11', 'a628073405', 1583367799, 11),
(10, 65, 65, 1, '9811234b6f', '12-03-2020', '19:26:32', '0fb2a97894', 1584062801, 11),
(11, 92, 91, 1, '73e0d7c3ff', '18-03-2020', '19:50:23', '5599727328', 1584582634, 11),
(12, 32, 32, 1, '461904b806', '06-03-2020', '19:56:54', 'c7ec2ac753', 1583546219, 10);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ticket_descuenta`
--

CREATE TABLE `ticket_descuenta` (
  `id` int(5) NOT NULL,
  `orden` int(5) NOT NULL,
  `producto` varchar(25) NOT NULL,
  `producto_hash` varchar(12) NOT NULL,
  `descuenta` varchar(50) NOT NULL COMMENT '1. caracteristicas . 2 ubicacion',
  `codigo` varchar(50) NOT NULL,
  `cant` float(10,2) NOT NULL,
  `hash` varchar(12) NOT NULL,
  `time` int(12) NOT NULL,
  `tx` int(4) NOT NULL,
  `td` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='LLeva el registro de lo que descontara de ubica y carac';

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ticket_num`
--

CREATE TABLE `ticket_num` (
  `id` int(5) NOT NULL,
  `fecha` varchar(30) NOT NULL,
  `hora` varchar(30) NOT NULL,
  `num_fac` int(6) NOT NULL,
  `orden` int(5) NOT NULL,
  `efectivo` float(10,2) NOT NULL,
  `edo` int(2) NOT NULL COMMENT '1 = activo , 2= Eliminada',
  `tx` int(2) NOT NULL,
  `hash` varchar(12) NOT NULL,
  `time` int(12) NOT NULL,
  `td` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `ticket_num`
--

INSERT INTO `ticket_num` (`id`, `fecha`, `hora`, `num_fac`, `orden`, `efectivo`, `edo`, `tx`, `hash`, `time`, `td`) VALUES
(1, '01-03-2020', '17:03:05', 1, 1, 30.00, 1, 1, '4eb5f6fc39', 1583103785, 11),
(2, '01-03-2020', '17:03:20', 2, 2, 15.00, 1, 1, '721d6ae755', 1583103800, 11),
(3, '01-03-2020', '17:03:42', 3, 3, 15.00, 1, 1, '90988307dc', 1583103822, 11),
(4, '01-03-2020', '17:04:04', 4, 4, 0.00, 1, 1, 'd0d43507fb', 1583103844, 11),
(5, '01-03-2020', '17:04:18', 5, 5, 0.00, 1, 1, 'c36109337e', 1583103858, 11),
(6, '01-03-2020', '17:04:32', 6, 6, 0.00, 1, 1, '2c0a9d4379', 1583103872, 11),
(7, '01-03-2020', '17:06:42', 7, 7, 8.00, 1, 1, '8615a3a26d', 1583104002, 11),
(8, '01-03-2020', '17:07:11', 8, 8, 0.00, 1, 1, '4d136cd93e', 1583104031, 11),
(9, '01-03-2020', '17:07:35', 9, 9, 0.00, 1, 1, 'af688aa610', 1583104055, 11),
(10, '01-03-2020', '17:11:44', 1, 1, 100.00, 1, 1, '59b98e7ea4', 1583104304, 10),
(11, '01-03-2020', '17:13:12', 2, 2, 50.00, 1, 1, 'c76f4077c2', 1583104392, 10),
(12, '01-03-2020', '17:13:25', 3, 3, 0.00, 1, 1, 'eac2a30772', 1583104405, 10),
(13, '01-03-2020', '17:13:34', 4, 4, 0.00, 1, 1, 'ee8b2f6170', 1583104414, 10),
(14, '01-03-2020', '17:14:09', 5, 5, 0.00, 1, 1, '45d5044d29', 1583104449, 10),
(15, '01-03-2020', '17:14:30', 6, 6, 0.00, 1, 1, '9536bb048f', 1583104470, 10),
(16, '01-03-2020', '17:20:21', 7, 7, 0.00, 1, 1, '5f3c7fbb31', 1583104821, 10),
(17, '02-03-2020', '17:23:04', 8, 8, 0.00, 1, 1, '31fde3bc9d', 1583191384, 10),
(18, '02-03-2020', '17:23:23', 9, 9, 0.00, 1, 1, '01b444c370', 1583191403, 10),
(19, '02-03-2020', '17:23:36', 10, 10, 0.00, 1, 1, '4f283b6228', 1583191416, 10),
(20, '02-03-2020', '17:23:52', 11, 11, 0.00, 1, 1, '97f5f1bc15', 1583191432, 10),
(21, '02-03-2020', '17:24:06', 12, 12, 0.00, 1, 1, '8e14d02162', 1583191446, 10),
(22, '02-03-2020', '17:31:14', 10, 10, 0.00, 1, 1, '3868047489', 1583191874, 11),
(23, '02-03-2020', '17:31:31', 11, 11, 0.00, 1, 1, 'e6af34f87f', 1583191891, 11),
(24, '02-03-2020', '17:31:55', 12, 12, 0.00, 1, 1, '90ba0fd0f9', 1583191915, 11),
(25, '02-03-2020', '17:32:11', 13, 13, 0.00, 1, 1, 'c500c40c26', 1583191931, 11),
(26, '02-03-2020', '17:32:37', 14, 14, 0.00, 1, 1, '7dcc6872be', 1583191957, 11),
(27, '03-03-2020', '17:44:26', 15, 15, 0.00, 1, 1, '205e0adcfa', 1583279066, 11),
(28, '03-03-2020', '17:44:51', 16, 16, 0.00, 1, 1, '5a89866796', 1583279091, 11),
(29, '03-03-2020', '17:45:46', 17, 17, 0.00, 1, 1, 'e439f0b1eb', 1583279146, 11),
(30, '03-03-2020', '17:46:06', 18, 18, 0.00, 1, 1, '0cdcea6746', 1583279166, 11),
(31, '03-03-2020', '17:46:29', 19, 19, 0.00, 1, 1, 'c0b8ba720d', 1583279189, 11),
(32, '03-03-2020', '17:58:49', 13, 13, 0.00, 1, 1, '643af9d724', 1583279929, 10),
(33, '03-03-2020', '17:59:04', 14, 14, 0.00, 1, 1, '9459067cc6', 1583279944, 10),
(34, '03-03-2020', '17:59:41', 15, 15, 0.00, 1, 1, '0b6871faf1', 1583279981, 10),
(35, '04-03-2020', '18:22:21', 20, 20, 0.00, 1, 1, '54ca7e45d1', 1583367741, 11),
(36, '04-03-2020', '18:22:44', 21, 21, 0.00, 1, 1, 'fb05c68e5f', 1583367764, 11),
(37, '04-03-2020', '18:22:54', 22, 22, 0.00, 1, 1, 'efee90bf58', 1583367774, 11),
(38, '04-03-2020', '18:23:18', 23, 23, 0.00, 1, 1, 'c23bab9365', 1583367798, 11),
(39, '04-03-2020', '18:23:35', 24, 24, 0.00, 1, 1, '8e5876a03c', 1583367815, 11),
(40, '04-03-2020', '18:24:34', 25, 25, 0.00, 1, 1, 'ad3830edce', 1583367874, 11),
(41, '04-03-2020', '18:29:13', 16, 16, 0.00, 1, 1, 'eaf876e69f', 1583368153, 10),
(42, '04-03-2020', '18:29:42', 17, 17, 0.00, 1, 1, '3c06083ddf', 1583368182, 10),
(43, '04-03-2020', '18:29:59', 18, 18, 0.00, 1, 1, 'a67f961b71', 1583368199, 10),
(44, '04-03-2020', '18:30:11', 19, 19, 0.00, 1, 1, '3ec91c5382', 1583368211, 10),
(45, '04-03-2020', '18:31:05', 20, 20, 0.00, 1, 1, '2b677578a8', 1583368265, 10),
(46, '04-03-2020', '18:31:25', 21, 21, 0.00, 1, 1, 'a08626b7b9', 1583368285, 10),
(47, '05-03-2020', '18:38:05', 26, 26, 0.00, 1, 1, 'cbf9ae5f83', 1583455085, 11),
(48, '05-03-2020', '18:38:21', 27, 27, 0.00, 1, 1, '80ce235387', 1583455101, 11),
(49, '05-03-2020', '18:38:49', 28, 28, 0.00, 1, 1, 'def793014d', 1583455129, 11),
(50, '05-03-2020', '18:39:07', 29, 29, 0.00, 1, 1, '1f119dc5bd', 1583455147, 11),
(51, '05-03-2020', '18:39:25', 30, 30, 0.00, 1, 1, 'b7c4995317', 1583455165, 11),
(52, '05-03-2020', '18:39:46', 31, 31, 0.00, 1, 1, 'a831f171a8', 1583455186, 11),
(53, '05-03-2020', '18:40:03', 32, 32, 0.00, 1, 1, '4f670d2323', 1583455203, 11),
(54, '05-03-2020', '18:40:20', 33, 33, 0.00, 1, 1, '798657b1a9', 1583455220, 11),
(55, '05-03-2020', '18:43:32', 22, 22, 0.00, 1, 1, '464b91aeae', 1583455412, 10),
(56, '05-03-2020', '18:43:51', 23, 23, 0.00, 1, 1, '6ed0dfa06c', 1583455431, 10),
(57, '05-03-2020', '18:44:07', 24, 24, 0.00, 1, 1, '1cea4dc993', 1583455447, 10),
(58, '05-03-2020', '18:44:20', 25, 25, 0.00, 1, 1, 'a749e9cb02', 1583455460, 10),
(59, '05-03-2020', '18:44:32', 26, 26, 0.00, 1, 1, '066c53373e', 1583455472, 10),
(60, '05-03-2020', '18:44:44', 27, 27, 0.00, 1, 1, 'a32e388467', 1583455484, 10),
(61, '05-03-2020', '18:44:56', 28, 28, 0.00, 1, 1, 'ee6cdfaab2', 1583455496, 10),
(62, '06-03-2020', '18:47:33', 34, 34, 0.00, 1, 1, '1e3a9918d9', 1583542053, 11),
(63, '06-03-2020', '18:47:56', 35, 35, 0.00, 1, 1, 'a3947550e7', 1583542076, 11),
(64, '06-03-2020', '18:48:19', 36, 36, 0.00, 1, 1, '40d5aa72fd', 1583542099, 11),
(65, '06-03-2020', '18:48:41', 37, 37, 0.00, 1, 1, '459f06e8a0', 1583542121, 11),
(66, '06-03-2020', '18:50:09', 38, 38, 0.00, 1, 1, '5958d986b7', 1583542209, 11),
(67, '07-03-2020', '18:52:59', 39, 39, 0.00, 1, 1, '0cacf623c3', 1583628779, 11),
(68, '07-03-2020', '19:00:24', 40, 40, 0.00, 1, 1, 'd3aaab81d9', 1583629224, 11),
(69, '07-03-2020', '19:01:04', 41, 41, 0.00, 1, 1, 'e4c3954eb6', 1583629264, 11),
(70, '07-03-2020', '19:02:01', 42, 42, 0.00, 1, 1, '73c0216651', 1583629321, 11),
(71, '08-03-2020', '19:04:03', 43, 43, 0.00, 1, 1, 'de7b225921', 1583715843, 11),
(72, '08-03-2020', '19:04:23', 44, 44, 0.00, 1, 1, '962e05995f', 1583715863, 11),
(73, '08-03-2020', '19:04:45', 45, 45, 0.00, 1, 1, 'e7068fda28', 1583715885, 11),
(74, '08-03-2020', '19:05:00', 46, 46, 0.00, 1, 1, '643f26d6bf', 1583715900, 11),
(75, '08-03-2020', '19:05:24', 47, 47, 0.00, 1, 1, '699403e706', 1583715924, 11),
(76, '08-03-2020', '19:05:42', 48, 48, 0.00, 1, 1, '7bd30d90e3', 1583715942, 11),
(77, '09-03-2020', '19:06:49', 49, 49, 0.00, 1, 1, '6bc11f0656', 1583802409, 11),
(78, '09-03-2020', '19:07:34', 50, 50, 0.00, 1, 1, '0774fd1d3f', 1583802454, 11),
(79, '09-03-2020', '19:08:53', 51, 51, 0.00, 1, 1, 'a4ed663964', 1583802533, 11),
(80, '10-03-2020', '19:10:07', 52, 52, 0.00, 1, 1, '8f0627ef94', 1583889007, 11),
(81, '10-03-2020', '19:10:29', 53, 53, 0.00, 1, 1, 'c91cb7cbd1', 1583889029, 11),
(82, '10-03-2020', '19:10:49', 54, 54, 0.00, 1, 1, 'ffbe9d5139', 1583889049, 11),
(83, '10-03-2020', '19:11:05', 55, 55, 0.00, 1, 1, 'a6c8bb5079', 1583889065, 11),
(84, '10-03-2020', '19:11:57', 56, 56, 0.00, 1, 1, '08d061c12d', 1583889117, 11),
(85, '11-03-2020', '19:14:06', 57, 57, 0.00, 1, 1, '44ffee6977', 1583975646, 11),
(86, '11-03-2020', '19:14:24', 58, 58, 0.00, 1, 1, 'abe4e55c5e', 1583975664, 11),
(87, '11-03-2020', '19:14:49', 59, 59, 0.00, 1, 1, '7e5271b820', 1583975689, 11),
(88, '11-03-2020', '19:15:11', 60, 60, 0.00, 1, 1, '4a82416526', 1583975711, 11),
(89, '12-03-2020', '19:24:31', 61, 61, 0.00, 1, 1, '70420d99b5', 1584062671, 11),
(90, '12-03-2020', '19:25:08', 62, 62, 0.00, 1, 1, 'becad730cb', 1584062708, 11),
(91, '12-03-2020', '19:25:35', 63, 63, 0.00, 1, 1, 'b915de0083', 1584062735, 11),
(92, '12-03-2020', '19:25:56', 64, 64, 0.00, 1, 1, '27cbf7493f', 1584062756, 11),
(93, '12-03-2020', '19:26:40', 65, 65, 0.00, 1, 1, '8fb55cc978', 1584062800, 11),
(94, '12-03-2020', '19:28:54', 66, 66, 0.00, 1, 1, 'b25fa588dc', 1584062934, 11),
(95, '13-03-2020', '19:36:31', 67, 67, 0.00, 1, 1, '95059f308a', 1584149791, 11),
(96, '13-03-2020', '19:36:47', 68, 68, 0.00, 1, 1, '0485b9b751', 1584149807, 11),
(97, '13-03-2020', '19:37:08', 69, 69, 0.00, 1, 1, '5a591673a8', 1584149828, 11),
(98, '13-03-2020', '19:37:29', 70, 70, 0.00, 1, 1, '07f4c820b9', 1584149849, 11),
(99, '13-03-2020', '19:37:41', 71, 71, 0.00, 1, 1, '963f439f3e', 1584149861, 11),
(100, '14-03-2020', '19:38:58', 72, 72, 0.00, 1, 1, '4942ed0e46', 1584236338, 11),
(101, '14-03-2020', '19:39:17', 73, 73, 0.00, 1, 1, 'cb02a087e7', 1584236357, 11),
(102, '14-03-2020', '19:39:27', 74, 74, 0.00, 1, 1, '4c8e65aa1b', 1584236367, 11),
(103, '14-03-2020', '19:39:51', 75, 75, 0.00, 1, 1, 'b60dcbae16', 1584236391, 11),
(104, '14-03-2020', '19:40:01', 76, 76, 0.00, 1, 1, 'd0f393de7c', 1584236401, 11),
(105, '15-03-2020', '19:42:11', 77, 77, 0.00, 1, 1, '64563249ce', 1584322931, 11),
(106, '15-03-2020', '19:42:29', 78, 78, 0.00, 1, 1, '90fafc1aa0', 1584322949, 11),
(107, '15-03-2020', '19:42:45', 79, 79, 0.00, 1, 1, '48ded834fb', 1584322965, 11),
(108, '16-03-2020', '19:44:11', 80, 80, 0.00, 1, 1, '062df86509', 1584409451, 11),
(109, '16-03-2020', '19:44:33', 81, 81, 0.00, 1, 1, 'c8d6d8e696', 1584409473, 11),
(110, '16-03-2020', '19:44:47', 82, 82, 0.00, 1, 1, 'a8b040ffd1', 1584409487, 11),
(111, '16-03-2020', '19:45:29', 83, 82, 0.00, 1, 1, 'abd679ffc9', 1584409529, 11),
(112, '16-03-2020', '19:45:44', 84, 83, 0.00, 1, 1, '4a3d771363', 1584409544, 11),
(113, '17-03-2020', '19:46:41', 85, 84, 0.00, 1, 1, '5020406987', 1584496001, 11),
(114, '17-03-2020', '19:46:59', 86, 85, 0.00, 1, 1, 'd4ba691caa', 1584496019, 11),
(115, '17-03-2020', '19:47:10', 87, 86, 0.00, 1, 1, '2f139707e4', 1584496030, 11),
(116, '18-03-2020', '19:49:16', 88, 87, 0.00, 1, 1, '55c5cff017', 1584582556, 11),
(117, '18-03-2020', '19:49:39', 89, 88, 0.00, 1, 1, 'e4c7524f76', 1584582579, 11),
(118, '18-03-2020', '19:49:52', 90, 89, 0.00, 1, 1, '70be69dcc2', 1584582592, 11),
(119, '18-03-2020', '19:50:04', 91, 90, 0.00, 1, 1, 'bc7e873da7', 1584582604, 11),
(120, '18-03-2020', '19:50:33', 92, 91, 0.00, 1, 1, '4aa7900b0c', 1584582633, 11),
(121, '06-03-2020', '19:56:10', 29, 29, 0.00, 1, 1, '5e55148bf0', 1583546170, 10),
(122, '06-03-2020', '19:56:24', 30, 30, 0.00, 1, 1, '54093bd3e1', 1583546184, 10),
(123, '06-03-2020', '19:56:36', 31, 31, 0.00, 1, 1, '7b83541331', 1583546196, 10),
(124, '06-03-2020', '19:56:58', 32, 32, 0.00, 1, 1, 'ad4262ed09', 1583546218, 10),
(125, '06-03-2020', '19:57:13', 33, 33, 0.00, 1, 1, 'ef6f3757a3', 1583546233, 10),
(126, '07-03-2020', '20:00:29', 34, 34, 0.00, 1, 1, 'e2e5adc8d2', 1583632829, 10),
(127, '07-03-2020', '20:00:44', 35, 35, 0.00, 1, 1, '73291bdc4b', 1583632844, 10),
(128, '07-03-2020', '20:01:31', 36, 38, 0.00, 1, 1, '38e8665930', 1583632891, 10),
(129, '07-03-2020', '20:01:38', 37, 37, 0.00, 1, 1, 'c437fb7bb4', 1583632898, 10),
(130, '07-03-2020', '20:01:47', 38, 36, 0.00, 1, 1, '6ac72dbb3a', 1583632907, 10),
(131, '07-03-2020', '20:02:04', 39, 39, 0.00, 1, 1, '8fd439844f', 1583632924, 10),
(132, '08-03-2020', '20:03:16', 40, 40, 0.00, 1, 1, 'bdf24316bb', 1583719396, 10),
(133, '09-03-2020', '20:05:02', 41, 41, 0.00, 1, 1, '3ce83d80d8', 1583805902, 10),
(134, '09-03-2020', '20:05:24', 42, 42, 0.00, 1, 1, 'c55b0eb78b', 1583805924, 10),
(135, '10-03-2020', '20:06:54', 43, 43, 0.00, 1, 1, 'e064089365', 1583892414, 10),
(136, '10-03-2020', '20:07:11', 44, 44, 0.00, 1, 1, 'fff7f2dc31', 1583892431, 10),
(137, '10-03-2020', '20:07:34', 45, 45, 0.00, 1, 1, 'a42235e615', 1583892454, 10),
(138, '11-03-2020', '20:08:24', 46, 46, 0.00, 1, 1, '65fe95c298', 1583978904, 10),
(139, '11-03-2020', '20:08:35', 47, 47, 0.00, 1, 1, '112ae1d2c5', 1583978915, 10),
(140, '12-03-2020', '20:09:35', 48, 48, 0.00, 1, 1, 'c8409b64f4', 1584065375, 10),
(141, '12-03-2020', '20:09:48', 49, 49, 0.00, 1, 1, 'c51b270869', 1584065388, 10),
(142, '13-03-2020', '20:11:00', 50, 50, 0.00, 1, 1, '8bc2f3f1f7', 1584151860, 10),
(143, '13-03-2020', '20:11:18', 51, 51, 0.00, 1, 1, '6b29b34998', 1584151878, 10),
(144, '14-03-2020', '20:12:18', 52, 52, 0.00, 1, 1, '887c0ac39a', 1584238338, 10),
(145, '15-03-2020', '20:13:45', 53, 53, 0.00, 1, 1, '430a292d9d', 1584324825, 10),
(146, '15-03-2020', '20:13:56', 54, 54, 0.00, 1, 1, 'e2f9a380b6', 1584324836, 10),
(147, '16-03-2020', '20:14:32', 55, 55, 0.00, 1, 1, 'ed3f31a7cc', 1584411272, 10),
(148, '16-03-2020', '20:14:45', 56, 56, 0.00, 1, 1, 'c5223937d0', 1584411285, 10),
(149, '16-03-2020', '20:14:58', 57, 57, 0.00, 1, 1, '726c55982a', 1584411298, 10),
(150, '17-03-2020', '20:15:41', 58, 58, 0.00, 1, 1, '90b41d06f7', 1584497741, 10),
(151, '17-03-2020', '20:15:51', 59, 59, 0.00, 1, 1, '8ac1ea2987', 1584497751, 10),
(152, '18-03-2020', '20:17:16', 60, 60, 0.00, 1, 1, '1f6ac86759', 1584584236, 10),
(153, '18-03-2020', '20:17:28', 61, 61, 0.00, 1, 1, '086b74fdad', 1584584248, 10),
(154, '18-03-2020', '20:17:42', 62, 62, 0.00, 1, 1, 'acf13e42cc', 1584584262, 10),
(155, '19-03-2020', '15:46:00', 63, 63, 0.00, 1, 1, 'b1b0b623fe', 1584654360, 10),
(156, '19-03-2020', '15:46:09', 64, 64, 0.00, 1, 1, '2923596137', 1584654369, 10),
(157, '19-03-2020', '15:46:24', 65, 65, 0.00, 1, 1, '84d4b4ddf0', 1584654384, 10),
(158, '19-03-2020', '15:59:13', 66, 66, 0.00, 1, 1, '3e8844d20c', 1584655153, 10),
(159, '20-03-2020', '18:55:59', 67, 67, 0.00, 1, 1, '951c058412', 1584752159, 10),
(160, '20-03-2020', '18:59:19', 68, 68, 0.00, 1, 1, '7669c76098', 1584752359, 10),
(161, '20-03-2020', '19:01:41', 93, 92, 0.00, 1, 1, 'cfa0b8aad8', 1584752501, 11),
(162, '23-03-2020', '15:45:25', 69, 69, 0.00, 1, 1, '5c5b99c99e', 1584999925, 10);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ticket_orden`
--

CREATE TABLE `ticket_orden` (
  `id` int(6) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `correlativo` int(5) NOT NULL,
  `empleado` varchar(200) NOT NULL,
  `user` varchar(100) NOT NULL,
  `fecha` varchar(20) NOT NULL,
  `hora` varchar(20) NOT NULL,
  `estado` int(1) NOT NULL COMMENT '1 activo, 2 cobrado, 3 guardado',
  `tx` int(2) NOT NULL,
  `hash` varchar(12) NOT NULL,
  `time` int(12) NOT NULL,
  `td` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `ticket_orden`
--

INSERT INTO `ticket_orden` (`id`, `nombre`, `correlativo`, `empleado`, `user`, `fecha`, `hora`, `estado`, `tx`, `hash`, `time`, `td`) VALUES
(2, '', 1, 'Abarrotes Admin', '', '01-03-2020', '17:02:17', 2, 1, '57c09c9e38', 1583103785, 11),
(3, '', 2, 'Abarrotes Admin', '', '01-03-2020', '17:03:10', 2, 1, '6a85ebe632', 1583103800, 11),
(4, '', 3, 'Abarrotes Admin', '', '01-03-2020', '17:03:27', 2, 1, 'a16cb24004', 1583103822, 11),
(5, '', 4, 'Abarrotes Admin', '', '01-03-2020', '17:03:50', 2, 1, 'ee686923e1', 1583103844, 11),
(6, '', 5, 'Abarrotes Admin', '', '01-03-2020', '17:04:09', 2, 1, 'deff2c07e8', 1583103858, 11),
(7, '', 6, 'Abarrotes Admin', '', '01-03-2020', '17:04:23', 2, 1, '00973e9c3f', 1583103872, 11),
(8, '', 7, 'Abarrotes Admin', '', '01-03-2020', '17:06:22', 2, 1, '8343381e6c', 1583104002, 11),
(9, '', 8, 'Abarrotes Admin', '', '01-03-2020', '17:06:47', 2, 1, 'f321c97623', 1583104032, 11),
(10, '', 9, 'Abarrotes Admin', '', '01-03-2020', '17:07:17', 2, 1, '22f05323a2', 1583104055, 11),
(11, '', 1, 'Admin Ferreteria', '', '01-03-2020', '17:11:26', 2, 1, '3a02457ecb', 1583104304, 10),
(12, '', 2, 'Admin Ferreteria', '', '01-03-2020', '17:12:59', 2, 1, '1bc374ea1f', 1583104392, 10),
(13, '', 3, 'Admin Ferreteria', '', '01-03-2020', '17:13:18', 2, 1, '061aca5c41', 1583104405, 10),
(14, '', 4, 'Admin Ferreteria', '', '01-03-2020', '17:13:30', 2, 1, 'bf36450143', 1583104415, 10),
(15, '', 5, 'Admin Ferreteria', '', '01-03-2020', '17:13:41', 2, 1, 'd6d94a4ab3', 1583104449, 10),
(16, '', 6, 'Admin Ferreteria', '', '01-03-2020', '17:14:14', 2, 1, 'b8d0fedee7', 1583104470, 10),
(17, '', 7, 'Admin Ferreteria', '', '01-03-2020', '17:17:17', 2, 1, '2fe6e9ec2d', 1583104821, 10),
(18, '', 8, 'Erick Nunez', '', '02-03-2020', '17:22:55', 2, 1, 'd0aa09e0e6', 1583191385, 10),
(19, '', 9, 'Erick Nunez', '', '02-03-2020', '17:23:13', 2, 1, 'b92b3dad6c', 1583191403, 10),
(20, '', 10, 'Erick Nunez', '', '02-03-2020', '17:23:30', 2, 1, '195cb8be7f', 1583191416, 10),
(21, '', 11, 'Erick Nunez', '', '02-03-2020', '17:23:43', 2, 1, '6842084d68', 1583191432, 10),
(22, '', 12, 'Erick Nunez', '', '02-03-2020', '17:24:02', 2, 1, '6a59bf9e73', 1583191446, 10),
(23, '', 10, 'Erick Nunez', '', '02-03-2020', '17:31:00', 2, 1, '3b2287bccf', 1583191875, 11),
(24, '', 11, 'Erick Nunez', '', '02-03-2020', '17:31:20', 2, 1, '76cd6a7332', 1583191891, 11),
(25, '', 12, 'Erick Nunez', '', '02-03-2020', '17:31:36', 2, 1, 'b9b86ff1f9', 1583191915, 11),
(26, '', 13, 'Erick Nunez', '', '02-03-2020', '17:32:00', 2, 1, '34fa909025', 1583191931, 11),
(27, '', 14, 'Erick Nunez', '', '02-03-2020', '17:32:16', 2, 1, 'c811c5b658', 1583191957, 11),
(28, '', 15, 'Erick Nunez', '', '03-03-2020', '17:44:13', 2, 1, '526b740105', 1583279066, 11),
(29, '', 16, 'Erick Nunez', '', '03-03-2020', '17:44:34', 2, 1, 'af5c864470', 1583279091, 11),
(30, '', 17, 'Erick Nunez', '', '03-03-2020', '17:45:07', 2, 1, '8a13d01254', 1583279146, 11),
(31, '', 18, 'Erick Nunez', '', '03-03-2020', '17:45:58', 2, 1, '2880841a3c', 1583279166, 11),
(32, '', 19, 'Erick Nunez', '', '03-03-2020', '17:46:13', 2, 1, '477ad39a1e', 1583279190, 11),
(33, '', 13, 'Erick Nunez', '', '03-03-2020', '17:58:41', 2, 1, 'd690320ae9', 1583279929, 10),
(34, '', 14, 'Erick Nunez', '', '03-03-2020', '17:58:56', 2, 1, '65b517dfc4', 1583279945, 10),
(35, '', 15, 'Erick Nunez', '', '03-03-2020', '17:59:12', 2, 1, 'adc7f77de7', 1583279981, 10),
(36, '', 20, 'Erick Nunez', '', '04-03-2020', '18:21:55', 2, 1, 'ad95e82f5f', 1583367741, 11),
(37, '', 21, 'Erick Nunez', '', '04-03-2020', '18:22:26', 2, 1, '7d39d2e3f6', 1583367765, 11),
(38, '', 22, 'Erick Nunez', '', '04-03-2020', '18:22:50', 2, 1, 'd95ddf6e84', 1583367774, 11),
(39, '', 23, 'Erick Nunez', '', '04-03-2020', '18:22:59', 2, 1, '91dc80f70c', 1583367798, 11),
(40, '', 24, 'Erick Nunez', '', '04-03-2020', '18:23:23', 2, 1, '98616d7c07', 1583367815, 11),
(41, '', 25, 'Erick Nunez', '', '04-03-2020', '18:24:19', 2, 1, 'dd21cc1cff', 1583367875, 11),
(42, '', 16, 'Erick Nunez', '', '04-03-2020', '18:29:05', 2, 1, 'fa3f87788b', 1583368153, 10),
(43, '', 17, 'Erick Nunez', '', '04-03-2020', '18:29:20', 2, 1, '35140c15fd', 1583368182, 10),
(44, '', 18, 'Erick Nunez', '', '04-03-2020', '18:29:51', 2, 1, '0855941e8c', 1583368199, 10),
(45, '', 19, 'Erick Nunez', '', '04-03-2020', '18:30:06', 2, 1, '0f82a53b71', 1583368212, 10),
(46, '', 20, 'Erick Nunez', '', '04-03-2020', '18:31:00', 2, 1, 'bce6841488', 1583368265, 10),
(47, '', 21, 'Erick Nunez', '', '04-03-2020', '18:31:16', 2, 1, '38ca08e261', 1583368285, 10),
(48, '', 26, 'Erick Nunez', '', '05-03-2020', '18:37:44', 2, 1, '21d9f90a9b', 1583455085, 11),
(49, '', 27, 'Erick Nunez', '', '05-03-2020', '18:38:10', 2, 1, 'df38ae346b', 1583455102, 11),
(50, '', 28, 'Erick Nunez', '', '05-03-2020', '18:38:28', 2, 1, 'c5915da9c5', 1583455129, 11),
(51, '', 29, 'Erick Nunez', '', '05-03-2020', '18:38:54', 2, 1, 'd49e87bfec', 1583455147, 11),
(52, '', 30, 'Erick Nunez', '', '05-03-2020', '18:39:12', 2, 1, '9019f7fac3', 1583455165, 11),
(53, '', 31, 'Erick Nunez', '', '05-03-2020', '18:39:31', 2, 1, 'c4536f3413', 1583455186, 11),
(54, '', 32, 'Erick Nunez', '', '05-03-2020', '18:39:51', 2, 1, '6fb7e4e2bd', 1583455203, 11),
(55, '', 33, 'Erick Nunez', '', '05-03-2020', '18:40:08', 2, 1, '2ee49efe17', 1583455221, 11),
(56, '', 22, 'Erick Nunez', '', '05-03-2020', '18:43:23', 2, 1, 'afac387655', 1583455412, 10),
(57, '', 23, 'Erick Nunez', '', '05-03-2020', '18:43:39', 2, 1, '5a683b5cc2', 1583455431, 10),
(58, '', 24, 'Erick Nunez', '', '05-03-2020', '18:44:01', 2, 1, '176637b669', 1583455447, 10),
(59, '', 25, 'Erick Nunez', '', '05-03-2020', '18:44:16', 2, 1, '6df49c5112', 1583455460, 10),
(60, '', 26, 'Erick Nunez', '', '05-03-2020', '18:44:27', 2, 1, 'fc6baf935a', 1583455473, 10),
(61, '', 27, 'Erick Nunez', '', '05-03-2020', '18:44:40', 2, 1, '2a3da52a39', 1583455484, 10),
(62, '', 28, 'Erick Nunez', '', '05-03-2020', '18:44:51', 2, 1, 'cf3a61840b', 1583455496, 10),
(63, '', 34, 'Erick Nunez', '', '06-03-2020', '18:47:24', 2, 1, 'c29e893f02', 1583542054, 11),
(64, '', 35, 'Erick Nunez', '', '06-03-2020', '18:47:39', 2, 1, '2dba295db2', 1583542076, 11),
(65, '', 36, 'Erick Nunez', '', '06-03-2020', '18:48:03', 2, 1, '5fa22e0b9e', 1583542099, 11),
(66, '', 37, 'Erick Nunez', '', '06-03-2020', '18:48:26', 2, 1, '005a7ca573', 1583542121, 11),
(67, '', 38, 'Erick Nunez', '', '06-03-2020', '18:48:47', 2, 1, 'f352018b28', 1583542209, 11),
(68, '', 39, 'Erick Nunez', '', '07-03-2020', '18:52:33', 2, 1, '034206cfad', 1583628779, 11),
(69, '', 40, 'Erick Nunez', '', '07-03-2020', '18:53:04', 2, 1, '76b453bf61', 1583629224, 11),
(70, '', 41, 'Erick Nunez', '', '07-03-2020', '19:00:29', 2, 1, '5fd4374269', 1583629265, 11),
(71, '', 42, 'Erick Nunez', '', '07-03-2020', '19:01:54', 2, 1, '1360d21bb7', 1583629321, 11),
(72, '', 43, 'Erick Nunez', '', '08-03-2020', '19:03:48', 2, 1, '83ebce155d', 1583715843, 11),
(73, '', 44, 'Erick Nunez', '', '08-03-2020', '19:04:11', 2, 1, 'd8d95e4ae1', 1583715863, 11),
(74, '', 45, 'Erick Nunez', '', '08-03-2020', '19:04:31', 2, 1, '537831185a', 1583715885, 11),
(75, '', 46, 'Erick Nunez', '', '08-03-2020', '19:04:50', 2, 1, '292b79d9a5', 1583715900, 11),
(76, '', 47, 'Erick Nunez', '', '08-03-2020', '19:05:18', 2, 1, '852d2c2be0', 1583715925, 11),
(77, '', 48, 'Erick Nunez', '', '08-03-2020', '19:05:32', 2, 1, '4dfeb57862', 1583715942, 11),
(78, '', 49, 'Erick Nunez', '', '09-03-2020', '19:06:35', 2, 1, 'f77971de80', 1583802410, 11),
(79, '', 50, 'Erick Nunez', '', '09-03-2020', '19:06:55', 2, 1, '7262b4259b', 1583802454, 11),
(80, '', 51, 'Erick Nunez', '', '09-03-2020', '19:08:36', 2, 1, '44ecebe3e6', 1583802533, 11),
(81, '', 52, 'Erick Nunez', '', '10-03-2020', '19:09:55', 2, 1, 'ba40d768a1', 1583889007, 11),
(82, '', 53, 'Erick Nunez', '', '10-03-2020', '19:10:12', 2, 1, '0c41de75b5', 1583889029, 11),
(83, '', 54, 'Erick Nunez', '', '10-03-2020', '19:10:34', 2, 1, 'c17501ddb6', 1583889049, 11),
(84, '', 55, 'Erick Nunez', '', '10-03-2020', '19:10:54', 2, 1, '8b083c24c0', 1583889065, 11),
(85, '', 56, 'Erick Nunez', '', '10-03-2020', '19:11:46', 2, 1, 'f2f50b5c50', 1583889117, 11),
(86, '', 57, 'Erick Nunez', '', '11-03-2020', '19:13:11', 2, 1, 'fbc44ebabe', 1583975646, 11),
(87, '', 58, 'Erick Nunez', '', '11-03-2020', '19:14:12', 2, 1, '36f8e45e1c', 1583975664, 11),
(88, '', 59, 'Erick Nunez', '', '11-03-2020', '19:14:37', 2, 1, 'a9a1810e3b', 1583975689, 11),
(89, '', 60, 'Erick Nunez', '', '11-03-2020', '19:14:54', 2, 1, 'c339b46f0f', 1583975711, 11),
(90, '', 61, 'Erick Nunez', '', '12-03-2020', '19:24:09', 2, 1, '8cc06b996a', 1584062672, 11),
(91, '', 62, 'Erick Nunez', '', '12-03-2020', '19:24:37', 2, 1, '7c171169d4', 1584062708, 11),
(92, '', 63, 'Erick Nunez', '', '12-03-2020', '19:25:13', 2, 1, 'ed30cef098', 1584062735, 11),
(93, '', 64, 'Erick Nunez', '', '12-03-2020', '19:25:40', 2, 1, '1e89e0d5d2', 1584062757, 11),
(94, '', 65, 'Erick Nunez', '', '12-03-2020', '19:26:10', 2, 1, '7b643c23d2', 1584062801, 11),
(95, '', 66, 'Erick Nunez', '', '12-03-2020', '19:28:41', 2, 1, '79be459df6', 1584062934, 11),
(96, '', 67, 'Erick Nunez', '', '13-03-2020', '19:36:15', 2, 1, 'ff4cbc3ab9', 1584149791, 11),
(97, '', 68, 'Erick Nunez', '', '13-03-2020', '19:36:36', 2, 1, '9c94b4abe0', 1584149807, 11),
(98, '', 69, 'Erick Nunez', '', '13-03-2020', '19:36:52', 2, 1, 'c252e1d3b7', 1584149828, 11),
(99, '', 70, 'Erick Nunez', '', '13-03-2020', '19:37:13', 2, 1, '3522e59175', 1584149850, 11),
(100, '', 71, 'Erick Nunez', '', '13-03-2020', '19:37:35', 2, 1, 'e784b8ca9e', 1584149861, 11),
(101, '', 72, 'Erick Nunez', '', '14-03-2020', '19:38:47', 2, 1, '3545223b02', 1584236338, 11),
(102, '', 73, 'Erick Nunez', '', '14-03-2020', '19:39:03', 2, 1, '1acf16fa57', 1584236357, 11),
(103, '', 74, 'Erick Nunez', '', '14-03-2020', '19:39:21', 2, 1, 'cc1279957a', 1584236367, 11),
(104, '', 75, 'Erick Nunez', '', '14-03-2020', '19:39:32', 2, 1, '3e4dc15924', 1584236391, 11),
(105, '', 76, 'Erick Nunez', '', '14-03-2020', '19:39:57', 2, 1, 'd27b1d46ce', 1584236401, 11),
(106, '', 77, 'Erick Nunez', '', '15-03-2020', '19:41:52', 2, 1, 'd653003585', 1584322931, 11),
(107, '', 78, 'Erick Nunez', '', '15-03-2020', '19:42:19', 2, 1, 'e625a8bef7', 1584322949, 11),
(108, '', 79, 'Erick Nunez', '', '15-03-2020', '19:42:34', 2, 1, '2d65be1c62', 1584322965, 11),
(109, '', 80, 'Erick Nunez', '', '16-03-2020', '19:43:37', 2, 1, 'f7b8a6a7d2', 1584409451, 11),
(110, '', 81, 'Erick Nunez', '', '16-03-2020', '19:44:19', 2, 1, '8137be5afa', 1584409473, 11),
(111, '', 82, 'Erick Nunez', '', '16-03-2020', '19:44:39', 2, 1, '5577abe257', 1584409529, 11),
(112, '', 83, 'Erick Nunez', '', '16-03-2020', '19:45:35', 2, 1, '3ecf3c3703', 1584409544, 11),
(113, '', 84, 'Erick Nunez', '', '17-03-2020', '19:46:22', 2, 1, '49865a2eb6', 1584496002, 11),
(114, '', 85, 'Erick Nunez', '', '17-03-2020', '19:46:47', 2, 1, 'ecaa65f8c9', 1584496020, 11),
(115, '', 86, 'Erick Nunez', '', '17-03-2020', '19:47:05', 2, 1, '8fd46eeee9', 1584496030, 11),
(116, '', 87, 'Erick Nunez', '', '18-03-2020', '19:48:57', 2, 1, '003bf68820', 1584582556, 11),
(117, '', 88, 'Erick Nunez', '', '18-03-2020', '19:49:26', 2, 1, '9a1586ff7c', 1584582579, 11),
(118, '', 89, 'Erick Nunez', '', '18-03-2020', '19:49:43', 2, 1, 'd4f067dec5', 1584582592, 11),
(119, '', 90, 'Erick Nunez', '', '18-03-2020', '19:49:57', 2, 1, 'ca03bb93da', 1584582605, 11),
(120, '', 91, 'Erick Nunez', '', '18-03-2020', '19:50:10', 2, 1, '2608196223', 1584582633, 11),
(121, '', 29, 'Erick Nunez', '', '06-03-2020', '19:56:01', 2, 1, '0b40d4ff18', 1583546170, 10),
(122, '', 30, 'Erick Nunez', '', '06-03-2020', '19:56:20', 2, 1, '10a6f30a78', 1583546185, 10),
(123, '', 31, 'Erick Nunez', '', '06-03-2020', '19:56:33', 2, 1, 'a63670f77d', 1583546197, 10),
(124, '', 32, 'Erick Nunez', '', '06-03-2020', '19:56:44', 2, 1, '87ea07b9ff', 1583546219, 10),
(125, '', 33, 'Erick Nunez', '', '06-03-2020', '19:57:05', 2, 1, '515ee0299c', 1583546234, 10),
(126, '', 34, 'Erick Nunez', '', '07-03-2020', '20:00:20', 2, 1, 'fb244d4e9e', 1583632830, 10),
(127, '', 35, 'Erick Nunez', '', '07-03-2020', '20:00:40', 2, 1, 'ea8c2dbd2a', 1583632845, 10),
(128, '', 36, 'Erick Nunez', '', '07-03-2020', '20:00:51', 2, 1, 'c604b83f29', 1583632907, 10),
(129, '', 37, 'Erick Nunez', '', '07-03-2020', '20:01:02', 2, 1, 'b679349fc5', 1583632899, 10),
(130, '', 38, 'Erick Nunez', '', '07-03-2020', '20:01:24', 2, 1, '684daef8f2', 1583632891, 10),
(131, '', 39, 'Erick Nunez', '', '07-03-2020', '20:02:00', 2, 1, '4d39e0ca4a', 1583632924, 10),
(132, '', 40, 'Erick Nunez', '', '08-03-2020', '20:03:07', 2, 1, 'bf36c7c26b', 1583719397, 10),
(133, '', 41, 'Erick Nunez', '', '09-03-2020', '20:04:48', 2, 1, '5f1d0512e3', 1583805903, 10),
(134, '', 42, 'Erick Nunez', '', '09-03-2020', '20:05:12', 2, 1, '8d8b12f399', 1583805924, 10),
(135, '', 43, 'Erick Nunez', '', '10-03-2020', '20:06:28', 2, 1, 'f53b77e690', 1583892414, 10),
(136, '', 44, 'Erick Nunez', '', '10-03-2020', '20:07:02', 2, 1, '7935bdece0', 1583892431, 10),
(137, '', 45, 'Erick Nunez', '', '10-03-2020', '20:07:30', 2, 1, 'b80fc78c54', 1583892454, 10),
(138, '', 46, 'Erick Nunez', '', '11-03-2020', '20:08:20', 2, 1, '983eb50b4f', 1583978904, 10),
(139, '', 47, 'Erick Nunez', '', '11-03-2020', '20:08:30', 2, 1, '722c195eeb', 1583978915, 10),
(140, '', 48, 'Erick Nunez', '', '12-03-2020', '20:09:14', 2, 1, '12fd49e633', 1584065376, 10),
(141, '', 49, 'Erick Nunez', '', '12-03-2020', '20:09:44', 2, 1, 'd2c629b822', 1584065389, 10),
(142, '', 50, 'Erick Nunez', '', '13-03-2020', '20:10:55', 2, 1, '79cc6610a5', 1584151860, 10),
(143, '', 51, 'Erick Nunez', '', '13-03-2020', '20:11:08', 2, 1, '5d37531824', 1584151878, 10),
(144, '', 52, 'Erick Nunez', '', '14-03-2020', '20:12:11', 2, 1, '42c7184268', 1584238338, 10),
(145, '', 53, 'Erick Nunez', '', '15-03-2020', '20:13:40', 2, 1, '820c898a7c', 1584324825, 10),
(146, '', 54, 'Erick Nunez', '', '15-03-2020', '20:13:51', 2, 1, 'd580831374', 1584324836, 10),
(147, '', 55, 'Erick Nunez', '', '16-03-2020', '20:14:29', 2, 1, 'ac9acca40a', 1584411272, 10),
(148, '', 56, 'Erick Nunez', '', '16-03-2020', '20:14:41', 2, 1, '0f1f7e525e', 1584411285, 10),
(149, '', 57, 'Erick Nunez', '', '16-03-2020', '20:14:54', 2, 1, '7d784b7393', 1584411299, 10),
(150, '', 58, 'Erick Nunez', '', '17-03-2020', '20:15:37', 2, 1, '7d49557ed6', 1584497741, 10),
(151, '', 59, 'Erick Nunez', '', '17-03-2020', '20:15:47', 2, 1, '92ea8a877d', 1584497751, 10),
(152, '', 60, 'Erick Nunez', '', '18-03-2020', '20:17:11', 2, 1, 'f94721319f', 1584584237, 10),
(153, '', 61, 'Erick Nunez', '', '18-03-2020', '20:17:23', 2, 1, 'ac7709ebc3', 1584584248, 10),
(154, '', 62, 'Erick Nunez', '', '18-03-2020', '20:17:36', 2, 1, 'e845d67bd9', 1584584262, 10),
(155, '', 63, 'Erick Nunez', '', '19-03-2020', '15:45:16', 2, 1, '4ca0efd304', 1584654361, 10),
(156, '', 64, 'Erick Nunez', '', '19-03-2020', '15:46:07', 2, 1, '76c85dc124', 1584654369, 10),
(157, '', 65, 'Erick Nunez', '', '19-03-2020', '15:46:16', 2, 1, '236f9da8cc', 1584654384, 10),
(159, '', 66, 'Erick Nunez', '', '19-03-2020', '15:54:42', 2, 1, '7dfed48e88', 1584655153, 10),
(166, '', 67, 'Erick Nunez', '', '20-03-2020', '17:48:37', 2, 1, 'fa032a52c6', 1584752160, 10),
(178, '', 68, 'Erick Nunez', '', '20-03-2020', '18:58:46', 2, 1, '9e73c579e8', 1584752359, 10),
(180, '', 92, 'Abarrotes Admin', '', '20-03-2020', '19:01:15', 2, 1, '4b85dc9eb7', 1584752501, 11),
(181, '', 69, 'Erick Nunez', '', '23-03-2020', '15:45:17', 2, 1, '449b922b3b', 1584999925, 10);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ubicacion`
--

CREATE TABLE `ubicacion` (
  `id` int(5) NOT NULL,
  `ubicacion` varchar(100) NOT NULL,
  `hash` varchar(12) NOT NULL,
  `time` int(12) NOT NULL,
  `td` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='ubicacion de los productos, como eje estantes';

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ubicacion_asig`
--

CREATE TABLE `ubicacion_asig` (
  `id` int(5) NOT NULL,
  `ubicacion` varchar(12) NOT NULL,
  `producto` int(5) NOT NULL,
  `cant` float(10,5) NOT NULL,
  `hash` varchar(12) NOT NULL,
  `time` int(12) NOT NULL,
  `td` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='dond eta ubicado el producto';

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `caracteristicas`
--
ALTER TABLE `caracteristicas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `caracteristicas_asig`
--
ALTER TABLE `caracteristicas_asig`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `config_master`
--
ALTER TABLE `config_master`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `config_root`
--
ALTER TABLE `config_root`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `corte_diario`
--
ALTER TABLE `corte_diario`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `cotizaciones`
--
ALTER TABLE `cotizaciones`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `cotizaciones_data`
--
ALTER TABLE `cotizaciones_data`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `creditos`
--
ALTER TABLE `creditos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `creditos_abonos`
--
ALTER TABLE `creditos_abonos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `entradas_efectivo`
--
ALTER TABLE `entradas_efectivo`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `facturar_documento`
--
ALTER TABLE `facturar_documento`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `facturar_documento_factura`
--
ALTER TABLE `facturar_documento_factura`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `gastos`
--
ALTER TABLE `gastos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `gastos_images`
--
ALTER TABLE `gastos_images`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `login_db_sync`
--
ALTER TABLE `login_db_sync`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `login_db_user`
--
ALTER TABLE `login_db_user`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `login_inout`
--
ALTER TABLE `login_inout`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `login_members`
--
ALTER TABLE `login_members`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `login_sucursales`
--
ALTER TABLE `login_sucursales`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `login_sync`
--
ALTER TABLE `login_sync`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `login_userdata`
--
ALTER TABLE `login_userdata`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `planilla_descuentos`
--
ALTER TABLE `planilla_descuentos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `planilla_descuentos_asig`
--
ALTER TABLE `planilla_descuentos_asig`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `planilla_empleados`
--
ALTER TABLE `planilla_empleados`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `planilla_extras`
--
ALTER TABLE `planilla_extras`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `planilla_pagos`
--
ALTER TABLE `planilla_pagos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `producto`
--
ALTER TABLE `producto`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cod` (`cod`),
  ADD KEY `descripcion` (`descripcion`);

--
-- Indices de la tabla `producto_averias`
--
ALTER TABLE `producto_averias`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `producto_cambios`
--
ALTER TABLE `producto_cambios`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `producto_categoria`
--
ALTER TABLE `producto_categoria`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `producto_compuestos`
--
ALTER TABLE `producto_compuestos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `producto_dependiente`
--
ALTER TABLE `producto_dependiente`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `producto_devoluciones`
--
ALTER TABLE `producto_devoluciones`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `producto_imagenes`
--
ALTER TABLE `producto_imagenes`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `producto_ingresado`
--
ALTER TABLE `producto_ingresado`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `producto_precio`
--
ALTER TABLE `producto_precio`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `producto_tags`
--
ALTER TABLE `producto_tags`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `producto_unidades`
--
ALTER TABLE `producto_unidades`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `proveedores`
--
ALTER TABLE `proveedores`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `sync_tabla`
--
ALTER TABLE `sync_tabla`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `sync_tables_updates`
--
ALTER TABLE `sync_tables_updates`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `sync_up`
--
ALTER TABLE `sync_up`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `sync_up_cloud`
--
ALTER TABLE `sync_up_cloud`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `ticket`
--
ALTER TABLE `ticket`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fecha` (`fecha`),
  ADD KEY `fecha_2` (`fecha`),
  ADD KEY `orden` (`orden`);

--
-- Indices de la tabla `ticket_cliente`
--
ALTER TABLE `ticket_cliente`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `ticket_descuenta`
--
ALTER TABLE `ticket_descuenta`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `ticket_num`
--
ALTER TABLE `ticket_num`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fecha` (`fecha`);

--
-- Indices de la tabla `ticket_orden`
--
ALTER TABLE `ticket_orden`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fecha` (`fecha`),
  ADD KEY `fecha_2` (`fecha`),
  ADD KEY `correlativo` (`correlativo`);

--
-- Indices de la tabla `ubicacion`
--
ALTER TABLE `ubicacion`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `ubicacion_asig`
--
ALTER TABLE `ubicacion_asig`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `caracteristicas`
--
ALTER TABLE `caracteristicas`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `caracteristicas_asig`
--
ALTER TABLE `caracteristicas_asig`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `clientes`
--
ALTER TABLE `clientes`
  MODIFY `id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT de la tabla `config_master`
--
ALTER TABLE `config_master`
  MODIFY `id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `config_root`
--
ALTER TABLE `config_root`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `corte_diario`
--
ALTER TABLE `corte_diario`
  MODIFY `id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;
--
-- AUTO_INCREMENT de la tabla `cotizaciones`
--
ALTER TABLE `cotizaciones`
  MODIFY `id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;
--
-- AUTO_INCREMENT de la tabla `cotizaciones_data`
--
ALTER TABLE `cotizaciones_data`
  MODIFY `id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT de la tabla `creditos`
--
ALTER TABLE `creditos`
  MODIFY `id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT de la tabla `creditos_abonos`
--
ALTER TABLE `creditos_abonos`
  MODIFY `id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;
--
-- AUTO_INCREMENT de la tabla `entradas_efectivo`
--
ALTER TABLE `entradas_efectivo`
  MODIFY `id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `facturar_documento`
--
ALTER TABLE `facturar_documento`
  MODIFY `id` int(6) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `facturar_documento_factura`
--
ALTER TABLE `facturar_documento_factura`
  MODIFY `id` int(6) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `gastos`
--
ALTER TABLE `gastos`
  MODIFY `id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;
--
-- AUTO_INCREMENT de la tabla `gastos_images`
--
ALTER TABLE `gastos_images`
  MODIFY `id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `login_db_sync`
--
ALTER TABLE `login_db_sync`
  MODIFY `id` int(6) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `login_db_user`
--
ALTER TABLE `login_db_user`
  MODIFY `id` int(6) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `login_inout`
--
ALTER TABLE `login_inout`
  MODIFY `id` int(6) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `login_members`
--
ALTER TABLE `login_members`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de la tabla `login_sucursales`
--
ALTER TABLE `login_sucursales`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `login_sync`
--
ALTER TABLE `login_sync`
  MODIFY `id` int(6) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `login_userdata`
--
ALTER TABLE `login_userdata`
  MODIFY `id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de la tabla `planilla_descuentos`
--
ALTER TABLE `planilla_descuentos`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `planilla_descuentos_asig`
--
ALTER TABLE `planilla_descuentos_asig`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `planilla_empleados`
--
ALTER TABLE `planilla_empleados`
  MODIFY `id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `planilla_extras`
--
ALTER TABLE `planilla_extras`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT de la tabla `planilla_pagos`
--
ALTER TABLE `planilla_pagos`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `producto`
--
ALTER TABLE `producto`
  MODIFY `id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;
--
-- AUTO_INCREMENT de la tabla `producto_averias`
--
ALTER TABLE `producto_averias`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `producto_cambios`
--
ALTER TABLE `producto_cambios`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `producto_categoria`
--
ALTER TABLE `producto_categoria`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de la tabla `producto_compuestos`
--
ALTER TABLE `producto_compuestos`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT de la tabla `producto_dependiente`
--
ALTER TABLE `producto_dependiente`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `producto_devoluciones`
--
ALTER TABLE `producto_devoluciones`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `producto_imagenes`
--
ALTER TABLE `producto_imagenes`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;
--
-- AUTO_INCREMENT de la tabla `producto_ingresado`
--
ALTER TABLE `producto_ingresado`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;
--
-- AUTO_INCREMENT de la tabla `producto_precio`
--
ALTER TABLE `producto_precio`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;
--
-- AUTO_INCREMENT de la tabla `producto_tags`
--
ALTER TABLE `producto_tags`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `producto_unidades`
--
ALTER TABLE `producto_unidades`
  MODIFY `id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT de la tabla `proveedores`
--
ALTER TABLE `proveedores`
  MODIFY `id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de la tabla `sync_tabla`
--
ALTER TABLE `sync_tabla`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `sync_tables_updates`
--
ALTER TABLE `sync_tables_updates`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=634;
--
-- AUTO_INCREMENT de la tabla `sync_up`
--
ALTER TABLE `sync_up`
  MODIFY `id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;
--
-- AUTO_INCREMENT de la tabla `sync_up_cloud`
--
ALTER TABLE `sync_up_cloud`
  MODIFY `id` int(6) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `ticket`
--
ALTER TABLE `ticket`
  MODIFY `id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=490;
--
-- AUTO_INCREMENT de la tabla `ticket_cliente`
--
ALTER TABLE `ticket_cliente`
  MODIFY `id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT de la tabla `ticket_descuenta`
--
ALTER TABLE `ticket_descuenta`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `ticket_num`
--
ALTER TABLE `ticket_num`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=163;
--
-- AUTO_INCREMENT de la tabla `ticket_orden`
--
ALTER TABLE `ticket_orden`
  MODIFY `id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=187;
--
-- AUTO_INCREMENT de la tabla `ubicacion`
--
ALTER TABLE `ubicacion`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `ubicacion_asig`
--
ALTER TABLE `ubicacion_asig`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

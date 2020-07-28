<br />
<b>Warning</b>:  require(streams.php): failed to open stream: No such file or directory in <b>C:\AppServ\www\phpMyAdmin\libraries\php-gettext\gettext.inc</b> on line <b>41</b><br />
<br />
<b>Warning</b>:  require(gettext.php): failed to open stream: No such file or directory in <b>C:\AppServ\www\phpMyAdmin\libraries\php-gettext\gettext.inc</b> on line <b>42</b><br />
-- phpMyAdmin SQL Dump
-- version 4.6.6
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 27-07-2020 a las 13:29:07
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
(1, 'JUAN PEREZ', '23568954-1', 'San Salvador', 'Apopa', 'San Salvador', '24056895', '', '17-07-2007', '', 'bd5c23951c', 1595791548, 15);

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
  `mayorista` varchar(3) NOT NULL,
  `hash` varchar(12) NOT NULL,
  `time` int(12) NOT NULL,
  `td` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `config_master`
--

INSERT INTO `config_master` (`id`, `sistema`, `cliente`, `slogan`, `propietario`, `telefono`, `giro`, `nit`, `imp`, `direccion`, `email`, `imagen`, `logo`, `skin`, `tipo_inicio`, `pais`, `moneda`, `moneda_simbolo`, `nombre_impuesto`, `nombre_documento`, `inicio_tx`, `otras_ventas`, `cambio_tx`, `dias_vencimiento`, `dias_cotizacion`, `multicaja`, `mayorista`, `hash`, `time`, `td`) VALUES
(1, 'Sistema de control Repuestos Xtreme', 'Repuestos Xtreme', 'Lo mejor en repuestos', 'Erick Nunez', '60623882', '', '', 13.00, '', '', '1595962336.jpg', 'pizto.png', 'mdb-skin', 2, '1', 'Dolares', '$', 'IVA', 'NIT', 1, 1, '', 30, 30, '', '', '3fa129511f', 1595962337, 15);

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
  `multiusuario` varchar(100) NOT NULL,
  `ecommerce` varchar(100) NOT NULL,
  `hash` varchar(12) NOT NULL,
  `time` int(12) NOT NULL,
  `td` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `config_root`
--

INSERT INTO `config_root` (`id`, `expira`, `expiracion`, `ftp_servidor`, `ftp_path`, `ftp_ruta`, `ftp_user`, `ftp_password`, `tipo_sistema`, `plataforma`, `multiusuario`, `ecommerce`, `hash`, `time`, `td`) VALUES
(1, 'c2RDcmU4L3JkelIzMlgvRXVraFZ4dz09', 'bDR6V3d4azB2ZnJxbnZRQnBFU2pxQT09', 'MDQ1dmFqbzBod0Y3cjI2UFZFa1hyZz09', 'MDQ1dmFqbzBod0Y3cjI2UFZFa1hyZz09', 'MDQ1dmFqbzBod0Y3cjI2UFZFa1hyZz09', 'MDQ1dmFqbzBod0Y3cjI2UFZFa1hyZz09', 'MDQ1dmFqbzBod0Y3cjI2UFZFa1hyZz09', 'aStLSk5WaFlmVG5sdG5rbnBWbk1vZz09', 'aStLSk5WaFlmVG5sdG5rbnBWbk1vZz09', 'a2J0Z0VSM2tTN1c3OUV0S3YrZzVBZz09', 'MDQ1dmFqbzBod0Y3cjI2UFZFa1hyZz09', '13ae9c1e44', 1595962367, 15);

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
(1, '23-07-2020', '1595484000', '13:20:06', 17, 4, 116.55, 171.45, 0.00, 171.45, 116.55, 54.90, 0.00, 0.00, 0.00, 'Erick', 1, 'd6a3a8d808', 1595532006, 15),
(2, '24-07-2020', '1595570400', '13:21:37', 5, 2, 191.85, 76.50, 0.00, 76.50, 76.50, 0.00, 0.00, 1.20, 0.00, 'Erick', 1, 'ccb6c70e60', 1595618497, 15),
(3, '25-07-2020', '1595656800', '13:24:37', 10, 3, 240.40, 87.95, 0.00, 87.95, 57.50, 30.45, 0.00, 8.95, 0.00, 'Erick', 1, '78fbeb88b0', 1595705078, 15),
(4, '26-07-2020', '1595743200', '13:27:16', 10, 3, 298.70, 71.80, 0.00, 71.80, 48.30, 0.00, 23.50, 0.00, 0.00, 'Erick', 1, '399965f8fd', 1595791636, 15),
(5, '27-07-2020', '1595829600', '13:28:19', 9, 2, 414.09, 115.39, 0.00, 115.39, 115.39, 0.00, 0.00, 0.00, 0.00, 'Erick', 1, '7b3d8229e4', 1595878100, 15);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cotizaciones`
--

CREATE TABLE `cotizaciones` (
  `id` int(6) NOT NULL,
  `cod` int(4) NOT NULL,
  `cant` float(10,2) NOT NULL,
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
(1, 'bd5c23951c', 'JUAN PEREZ', 11, 11, '26-07-2020', '13:26:15', 1, 1, 'f1ed2140f2', 1595791584, 15);

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
(1, 'f1ed2140f2', 'JUAN PEREZ', 10.00, 'Erick', '26-07-2020', '13:26:40', '', '', 1, '6489c05544', 1595791600, 15);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cuentas`
--

CREATE TABLE `cuentas` (
  `id` int(6) NOT NULL,
  `hash_proveedor` varchar(12) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `detalles` text NOT NULL,
  `factura` int(6) NOT NULL,
  `total` float(10,2) NOT NULL,
  `fecha` varchar(30) NOT NULL,
  `fechaF` varchar(20) NOT NULL,
  `hora` varchar(30) NOT NULL,
  `fecha_limite` varchar(20) NOT NULL,
  `fecha_limiteF` varchar(20) NOT NULL,
  `edo` int(2) NOT NULL COMMENT '0, eliminado 1 activo, 2 pagado',
  `hash` varchar(12) NOT NULL,
  `time` int(12) NOT NULL,
  `td` int(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Tabla de las cuentas por cobrar';

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cuentas_abonos`
--

CREATE TABLE `cuentas_abonos` (
  `id` int(6) NOT NULL,
  `cuenta` varchar(12) NOT NULL,
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

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ecommerce`
--

CREATE TABLE `ecommerce` (
  `id` int(6) NOT NULL,
  `cod` int(4) NOT NULL,
  `cant` int(4) NOT NULL,
  `producto` varchar(100) NOT NULL,
  `pv` float(10,2) NOT NULL,
  `stotal` float(10,2) NOT NULL,
  `imp` float(10,2) NOT NULL,
  `total` float(10,2) NOT NULL,
  `descuento` float(10,2) NOT NULL,
  `orden` int(6) NOT NULL,
  `usuario` varchar(100) NOT NULL,
  `hash` varchar(12) NOT NULL,
  `time` int(12) NOT NULL,
  `td` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ecommerce_data`
--

CREATE TABLE `ecommerce_data` (
  `id` int(6) NOT NULL,
  `usuario` varchar(12) NOT NULL,
  `orden` int(5) NOT NULL,
  `fecha` varchar(20) NOT NULL,
  `hora` varchar(20) NOT NULL,
  `fechaF` varchar(20) NOT NULL,
  `edo` int(11) NOT NULL COMMENT '0 eliminada, 1 en proceso, 2 activo, 3 enviado, 4 entregado, 5 reemplazada',
  `hash` varchar(12) NOT NULL,
  `time` int(12) NOT NULL,
  `td` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
  `edo` int(2) NOT NULL COMMENT 'o eliminado, 1 activo, 2 - activo no se puede borrar',
  `hash` varchar(12) NOT NULL,
  `time` int(12) NOT NULL,
  `td` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `gastos`
--

INSERT INTO `gastos` (`id`, `tipo`, `nombre`, `descripcion`, `cantidad`, `fecha`, `fechaF`, `hora`, `user`, `edo`, `hash`, `time`, `td`) VALUES
(1, 1, 'Compra de papel', 'Compra de papel para apuntes', 1.20, '24-07-2020', '1595570400', '13:21:25', 'Erick', 1, '96fbc36fc1', 1595618485, 15),
(2, 2, 'Recibo de Agua', 'Pago del recibo de agua del mes de Julio', 8.95, '25-07-2020', '1595656800', '13:23:12', 'Erick', 1, '225e10ee90', 1595704992, 15);

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

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `login_attempts`
--

CREATE TABLE `login_attempts` (
  `user_id` int(11) NOT NULL,
  `time` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
(3, '52ce5b', 'admin@pizto.com', '98f0639d567c832700db09874cdd3880fb27f7b4ddadd060b121f5787a3623c61c3661995c20c776d057699a0dd958d24a093f912d35f38417c0ad5703d5bf88', 'c2114b413899e2b1227171de6194d45083ecf9b7b16553b4fecf96df6212901975c814fa564ec8510de0a39112591404415457e786f5fe39b334ab5ae992cbf3');

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
(1, 'Erick Nunez', 1, 'Erick', '1', '11.png', 15),
(3, 'Administrador del Sistema', 2, '52ce5b', '1', '11.png', 15);

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
  `promocion` varchar(2) NOT NULL,
  `verecommerce` varchar(10) NOT NULL,
  `hash` varchar(12) NOT NULL,
  `time` int(12) NOT NULL,
  `td` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Productos disponibles al publico';

--
-- Volcado de datos para la tabla `producto`
--

INSERT INTO `producto` (`id`, `cod`, `descripcion`, `categoria`, `cantidad`, `medida`, `proveedor`, `informacion`, `existencia_minima`, `caduca`, `compuesto`, `gravado`, `receta`, `dependiente`, `servicio`, `promocion`, `verecommerce`, `hash`, `time`, `td`) VALUES
(1, '1001', 'REFRIGERANTE DEL RADIADOR DEL COCHE', '7341a16d84', 94.00, '4de85e95d5', 'a527d0b00f', 'Refrigerante del radiador del coche de alta calidad con tapa del cuello de relleno para mitsuri si Lancer Outlander Sport 2007-2013 1350A015', 10.00, '0', '0', 'on', '0', '0', '0', '0', '0', 'ae2daf2d08', 1595704928, 15),
(2, '1002', 'AUTO CABLE DE ENCENDIDO PARA NISSAN AZUL U13 SR20 22450-53J88', '7341a16d84', 92.00, '4de85e95d5', 'a527d0b00f', '', 10.00, '0', '0', 'on', '0', '0', '0', '0', '0', 'bee43ca2cd', 1595878063, 15),
(3, '1003', 'CHISPA ELECTRóNICA BOBINA/MóDULO DE ENCENDIDO 90919-02244 PARA TOYOTA RAV4 ACA3', '7341a16d84', 90.00, '4de85e95d5', 'a527d0b00f', '', 10.00, '0', '0', 'on', '0', '0', '0', '0', '0', '9eaedb8076', 1595878078, 15),
(4, '1004', 'ELECTRONIC SENSOR AIR FLOW METER 0280217114 FOR BENZ 1993/03 - 2000/05 ', '7341a16d84', 96.00, '4de85e95d5', 'a527d0b00f', '', 10.00, '0', '0', 'on', '0', '0', '0', '0', '0', '29da8263d8', 1595531964, 15),
(5, '1005', 'PARA MITSUBISHI CHEVROLET AUDI IRIDIO BUJíA IK20TT 4702 ', '7341a16d84', 93.00, '4de85e95d5', 'a527d0b00f', '', 10.00, '0', '0', 'on', '0', '0', '0', '0', '0', '0d3651247f', 1595791563, 15),
(6, '1006', 'BOMBA DE AGUA PARA AUDI ASIENTO VW SKODA PORSCHE A4 8K2 B8 CJEB CNCD ACTúA COMO GRUPO DE METELLI 06L121011B ', '7341a16d84', 93.00, '4de85e95d5', 'a527d0b00f', '', 10.00, '0', '0', 'on', '0', '0', '0', '0', '0', '10b0872d9c', 1595791560, 15),
(7, '1007', 'PARA FORD 2009, ENFOQUE SEDáN LA LAMP10 LíNEA CON MOTOR AFS LOS FAROS DEL COCHE DE LA LáMPARA DE LA LUZ DEL COCHE AUTO FAROS AUTO LOS FAROS', '7341a16d84', 91.00, '4de85e95d5', 'a527d0b00f', '', 10.00, '0', '0', 'on', '0', '0', '0', '0', '0', '5e2987f986', 1595878053, 15);

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
(1, 'ACCESORIOS', 'aca175d7e5', 1595530981, 15);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto_categoria_sub`
--

CREATE TABLE `producto_categoria_sub` (
  `id` int(5) NOT NULL,
  `categoria` varchar(50) NOT NULL,
  `subcategoria` varchar(50) NOT NULL,
  `hash` varchar(12) NOT NULL,
  `time` int(12) NOT NULL,
  `td` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Categorias de los productos';

--
-- Volcado de datos para la tabla `producto_categoria_sub`
--

INSERT INTO `producto_categoria_sub` (`id`, `categoria`, `subcategoria`, `hash`, `time`, `td`) VALUES
(1, 'aca175d7e5', 'ACCESORIOS', '7341a16d84', 1595530998, 15);

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
(1, 1001, '1595531280.jpg', '', 800, 800, '9d2f8cd17a', 1595531282, 15),
(2, 1001, '1595531296.jpg', '', 800, 800, '2c9e0cb1a6', 1595531297, 15),
(3, 1001, '1595531322.jpg', '', 800, 800, '65044a1e9b', 1595531323, 15),
(4, 1002, '1595531434.jpg', '', 800, 800, 'a1162aa820', 1595531434, 15),
(5, 1003, '1595531513.webp', '', 0, 0, 'ba727c42b0', 1595531513, 15),
(6, 1004, '1595531600.jpg', '', 800, 800, '641edf82e8', 1595531601, 15),
(7, 1005, '1595531695.jpg', '', 800, 800, '3c670743dd', 1595531696, 15),
(8, 1006, '1595531777.jpg', '', 800, 800, '1402ff891b', 1595531778, 15),
(9, 1007, '1595531890.jpg', '', 550, 550, 'def3748b1b', 1595531890, 15);

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
(1, 1001, 100.00, 100.00, 4.80, '', '', '', '23-07-2020', '13:07:00', '2e970404c8', 1595531220, 15),
(2, 1002, 100.00, 100.00, 3.20, '', '', '', '23-07-2020', '13:10:16', 'cfe636cb26', 1595531416, 15),
(3, 1003, 100.00, 100.00, 7.00, '', '', '', '23-07-2020', '13:11:29', '58051964c9', 1595531489, 15),
(4, 1004, 100.00, 100.00, 10.00, '', '', '', '23-07-2020', '13:12:59', '829ff9cda4', 1595531579, 15),
(5, 1005, 100.00, 100.00, 2.00, '', '', '', '23-07-2020', '13:14:34', 'e3f18a0139', 1595531674, 15),
(6, 1006, 100.00, 100.00, 5.00, '', '', '', '23-07-2020', '13:16:00', 'cfe1e23b39', 1595531760, 15),
(7, 1007, 100.00, 100.00, 10.00, '', '', '', '23-07-2020', '13:17:36', '18c3c95b22', 1595531856, 15);

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
(1, '1001', 1, 5.35, '10352de56e', 1595531228, 15),
(2, '1002', 1, 4.80, 'bc0597d623', 1595531422, 15),
(3, '1003', 1, 12.00, '327f9a5335', 1595531493, 15),
(4, '1004', 1, 20.00, 'bbba18e87f', 1595531583, 15),
(5, '1005', 1, 3.00, '186e8ba076', 1595531678, 15),
(6, '1006', 1, 8.50, 'b2ffa66b75', 1595531765, 15),
(7, '1007', 1, 20.25, 'b276cda3d0', 1595531863, 15);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto_precio_mayorista`
--

CREATE TABLE `producto_precio_mayorista` (
  `id` int(5) NOT NULL,
  `producto` varchar(25) NOT NULL,
  `cant` int(5) NOT NULL,
  `precio` float(10,2) NOT NULL,
  `hash` varchar(12) NOT NULL,
  `time` int(12) NOT NULL,
  `td` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Maneja los diferentes precios para cada producto';

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
(1, 'Unidad', 'U', '4de85e95d5', 1595531145, 15),
(2, 'Paquete', 'Paq', 'f260bfc7ff', 1595531155, 15),
(3, 'Litros', 'L', 'c0f52f7d3b', 1595531166, 15),
(4, 'Galon', 'Gal', 'cae34db9e6', 1595531176, 15);

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
(1, 'Impressa', '03659865-5', '9896541', 'San Salvador', 'Apopa', 'San Sanvador', 'Venta de repuestos', '25469856', '', 'Juan Perez', '2536525', '', 'a527d0b00f', 1595531081, 15);

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
  `cant` float(10,2) NOT NULL,
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
(1, 1001, 3.00, 'REFRIGERANTE DEL RADIADOR DEL COCHE', 5.35, 14.20, 1.85, 16.05, 1, 0.00, '23-07-2020', '13:18:45', 1, 'Erick Nunez', '1', 'Erick', 1, '1595484000', 1, '6e921847fc', 1595531934, 15),
(2, 1005, 4.00, 'PARA MITSUBISHI CHEVROLET AUDI IRIDIO BUJíA IK20TT 4702 ', 3.00, 10.62, 1.38, 12.00, 2, 0.00, '23-07-2020', '13:19:02', 2, 'Erick Nunez', '1', 'Erick', 1, '1595484000', 1, '1df907a3aa', 1595531955, 15),
(3, 1006, 1.00, 'BOMBA DE AGUA PARA AUDI ASIENTO VW SKODA PORSCHE A4 8K2 B8 CJEB CNCD ACTúA COMO GRUPO DE METELLI 06L', 8.50, 7.52, 0.98, 8.50, 2, 0.00, '23-07-2020', '13:19:06', 2, 'Erick Nunez', '1', 'Erick', 1, '1595484000', 1, '318cdc3f4c', 1595531955, 15),
(4, 1004, 4.00, 'ELECTRONIC SENSOR AIR FLOW METER 0280217114 FOR BENZ 1993/03 - 2000/05 ', 20.00, 70.80, 9.20, 80.00, 3, 0.00, '23-07-2020', '13:19:24', 3, 'Erick Nunez', '1', 'Erick', 1, '1595484000', 1, '0cc74bf2df', 1595531970, 15),
(5, 1002, 3.00, 'AUTO CABLE DE ENCENDIDO PARA NISSAN AZUL U13 SR20 22450-53J88', 4.80, 12.74, 1.66, 14.40, 4, 0.00, '23-07-2020', '13:19:36', 4, 'Erick Nunez', '2', 'Erick', 1, '1595484000', 1, '6c806fd6e1', 1595531986, 15),
(6, 1007, 2.00, 'PARA FORD 2009, ENFOQUE SEDáN LA LAMP10 LíNEA CON MOTOR AFS LOS FAROS DEL COCHE DE LA LáMPARA DE LA ', 20.25, 35.84, 4.66, 40.50, 4, 0.00, '23-07-2020', '13:19:40', 4, 'Erick Nunez', '2', 'Erick', 1, '1595484000', 1, '135339a711', 1595531986, 15),
(7, 1007, 2.00, 'PARA FORD 2009, ENFOQUE SEDáN LA LAMP10 LíNEA CON MOTOR AFS LOS FAROS DEL COCHE DE LA LáMPARA DE LA ', 20.25, 35.84, 4.66, 40.50, 5, 0.00, '24-07-2020', '13:20:32', 5, 'Erick Nunez', '1', 'Erick', 1, '1595570400', 1, 'c0354cc37e', 1595618436, 15),
(8, 1003, 3.00, 'CHISPA ELECTRóNICA BOBINA/MóDULO DE ENCENDIDO 90919-02244 PARA TOYOTA RAV4 ACA3', 12.00, 31.86, 4.14, 36.00, 6, 0.00, '24-07-2020', '13:20:43', 6, 'Erick Nunez', '1', 'Erick', 1, '1595570400', 1, '444144e207', 1595618447, 15),
(9, 1002, 3.00, 'AUTO CABLE DE ENCENDIDO PARA NISSAN AZUL U13 SR20 22450-53J88', 4.80, 12.74, 1.66, 14.40, 7, 0.00, '25-07-2020', '13:22:03', 7, 'Erick Nunez', '2', 'Erick', 1, '1595656800', 1, '55b553c8d7', 1595704933, 15),
(10, 1001, 3.00, 'REFRIGERANTE DEL RADIADOR DEL COCHE', 5.35, 14.20, 1.85, 16.05, 7, 0.00, '25-07-2020', '13:22:08', 7, 'Erick Nunez', '2', 'Erick', 1, '1595656800', 1, '5049145ab0', 1595704933, 15),
(11, 1007, 2.00, 'PARA FORD 2009, ENFOQUE SEDáN LA LAMP10 LíNEA CON MOTOR AFS LOS FAROS DEL COCHE DE LA LáMPARA DE LA ', 20.25, 35.84, 4.66, 40.50, 8, 0.00, '25-07-2020', '13:22:20', 8, 'Erick Nunez', '1', 'Erick', 1, '1595656800', 1, 'f89ac40231', 1595704943, 15),
(12, 1006, 2.00, 'BOMBA DE AGUA PARA AUDI ASIENTO VW SKODA PORSCHE A4 8K2 B8 CJEB CNCD ACTúA COMO GRUPO DE METELLI 06L', 8.50, 15.04, 1.96, 17.00, 9, 0.00, '25-07-2020', '13:22:30', 9, 'Erick Nunez', '1', 'Erick', 1, '1595656800', 1, 'e17d78e09c', 1595704954, 15),
(13, 1005, 2.00, 'PARA MITSUBISHI CHEVROLET AUDI IRIDIO BUJíA IK20TT 4702 ', 3.00, 5.31, 0.69, 6.00, 10, 0.00, '26-07-2020', '13:24:55', 10, 'Erick Nunez', '1', 'Erick', 1, '1595743200', 1, '2ca62e57c6', 1595791505, 15),
(14, 1006, 3.00, 'BOMBA DE AGUA PARA AUDI ASIENTO VW SKODA PORSCHE A4 8K2 B8 CJEB CNCD ACTúA COMO GRUPO DE METELLI 06L', 8.50, 22.57, 2.93, 25.50, 10, 0.00, '26-07-2020', '13:25:00', 10, 'Erick Nunez', '1', 'Erick', 1, '1595743200', 1, 'aebd239eb5', 1595791505, 15),
(15, 1003, 1.00, 'CHISPA ELECTRóNICA BOBINA/MóDULO DE ENCENDIDO 90919-02244 PARA TOYOTA RAV4 ACA3', 12.00, 10.62, 1.38, 12.00, 11, 0.00, '26-07-2020', '13:25:56', 11, 'Erick Nunez', '3', 'Erick', 1, '1595743200', 1, '1789ad3a5b', 1595791584, 15),
(16, 1006, 1.00, 'BOMBA DE AGUA PARA AUDI ASIENTO VW SKODA PORSCHE A4 8K2 B8 CJEB CNCD ACTúA COMO GRUPO DE METELLI 06L', 8.50, 7.52, 0.98, 8.50, 11, 0.00, '26-07-2020', '13:25:59', 11, 'Erick Nunez', '3', 'Erick', 1, '1595743200', 1, 'dc76617d62', 1595791584, 15),
(17, 1005, 1.00, 'PARA MITSUBISHI CHEVROLET AUDI IRIDIO BUJíA IK20TT 4702 ', 3.00, 2.65, 0.35, 3.00, 11, 0.00, '26-07-2020', '13:26:03', 11, 'Erick Nunez', '3', 'Erick', 1, '1595743200', 1, 'c0083dbb6a', 1595791584, 15),
(18, 1003, 1.00, 'CHISPA ELECTRóNICA BOBINA/MóDULO DE ENCENDIDO 90919-02244 PARA TOYOTA RAV4 ACA3', 12.00, 10.62, 1.38, 12.00, 12, 0.00, '26-07-2020', '13:26:51', 12, 'Erick Nunez', '1', 'Erick', 1, '1595743200', 1, '9c676bc5e4', 1595791621, 15),
(19, 1002, 1.00, 'AUTO CABLE DE ENCENDIDO PARA NISSAN AZUL U13 SR20 22450-53J88', 4.80, 4.25, 0.55, 4.80, 12, 0.00, '26-07-2020', '13:26:54', 12, 'Erick Nunez', '1', 'Erick', 1, '1595743200', 1, '829f54b96f', 1595791621, 15),
(20, 1007, 3.00, 'PARA FORD 2009, ENFOQUE SEDáN LA LAMP10 LíNEA CON MOTOR AFS LOS FAROS DEL COCHE DE LA LáMPARA DE LA ', 18.23, 48.38, 6.29, 54.67, 13, 6.08, '27-07-2020', '13:27:33', 13, 'Erick Nunez', '1', 'Erick', 1, '1595829600', 1, '18e72f95e2', 1595878072, 15),
(21, 1003, 3.00, 'CHISPA ELECTRóNICA BOBINA/MóDULO DE ENCENDIDO 90919-02244 PARA TOYOTA RAV4 ACA3', 10.80, 28.67, 3.73, 32.40, 13, 3.60, '27-07-2020', '13:27:37', 13, 'Erick Nunez', '1', 'Erick', 1, '1595829600', 1, 'b1ddbbd7b3', 1595878072, 15),
(22, 1002, 1.00, 'AUTO CABLE DE ENCENDIDO PARA NISSAN AZUL U13 SR20 22450-53J88', 4.32, 3.82, 0.50, 4.32, 13, 0.48, '27-07-2020', '13:27:42', 13, 'Erick Nunez', '1', 'Erick', 1, '1595829600', 1, 'fc0572c744', 1595878072, 15),
(23, 1003, 2.00, 'CHISPA ELECTRóNICA BOBINA/MóDULO DE ENCENDIDO 90919-02244 PARA TOYOTA RAV4 ACA3', 12.00, 21.24, 2.76, 24.00, 14, 0.00, '27-07-2020', '13:27:58', 14, 'Erick Nunez', '1', 'Erick', 1, '1595829600', 1, 'be493ad529', 1595878082, 15);

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
(1, 11, 11, 1, 'bd5c23951c', '26-07-2020', '13:26:15', '53203adc85', 1595791585, 15);

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
(1, '23-07-2020', '13:18:53', 1, 1, 0.00, 1, 1, '475aa498d8', 1595531933, 15),
(2, '23-07-2020', '13:19:15', 2, 2, 25.00, 1, 1, '4e8fd00ac5', 1595531955, 15),
(3, '23-07-2020', '13:19:30', 3, 3, 100.00, 1, 1, '210ca6b70c', 1595531970, 15),
(4, '23-07-2020', '13:19:46', 4, 4, 0.00, 1, 1, '1dd3e8a51e', 1595531986, 15),
(5, '24-07-2020', '13:20:36', 5, 5, 0.00, 1, 1, '5e1795934a', 1595618436, 15),
(6, '24-07-2020', '13:20:47', 6, 6, 0.00, 1, 1, 'd1106da9e8', 1595618447, 15),
(7, '25-07-2020', '13:22:13', 7, 7, 0.00, 1, 1, 'a2353ce86a', 1595704933, 15),
(8, '25-07-2020', '13:22:23', 8, 8, 0.00, 1, 1, 'e56ee8a622', 1595704943, 15),
(9, '25-07-2020', '13:22:34', 9, 9, 0.00, 1, 1, 'c31d278772', 1595704954, 15),
(10, '26-07-2020', '13:25:05', 10, 10, 0.00, 1, 1, '58469d795d', 1595791505, 15),
(11, '26-07-2020', '13:26:24', 11, 11, 0.00, 1, 1, '4cfd853e93', 1595791584, 15),
(12, '26-07-2020', '13:27:01', 12, 12, 0.00, 1, 1, 'b1803fcc03', 1595791621, 15),
(13, '27-07-2020', '13:27:52', 13, 13, 0.00, 1, 1, 'a8ef1aa707', 1595878072, 15),
(14, '27-07-2020', '13:28:01', 14, 14, 0.00, 1, 1, '250c1b1637', 1595878081, 15);

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
(1, '', 1, 'Erick Nunez', 'Erick', '23-07-2020', '13:18:45', 2, 1, '001eac7dc2', 1595531934, 15),
(2, '', 2, 'Erick Nunez', 'Erick', '23-07-2020', '13:19:02', 2, 1, '8251c5ea18', 1595531955, 15),
(3, '', 3, 'Erick Nunez', 'Erick', '23-07-2020', '13:19:24', 2, 1, 'e567321ffd', 1595531970, 15),
(4, '', 4, 'Erick Nunez', 'Erick', '23-07-2020', '13:19:36', 2, 1, '0e21ea78b5', 1595531987, 15),
(5, '', 5, 'Erick Nunez', 'Erick', '24-07-2020', '13:20:32', 2, 1, '9306fb3e18', 1595618436, 15),
(6, '', 6, 'Erick Nunez', 'Erick', '24-07-2020', '13:20:42', 2, 1, 'cea5a00dd1', 1595618447, 15),
(7, '', 7, 'Erick Nunez', 'Erick', '25-07-2020', '13:22:03', 2, 1, '9bcb308729', 1595704933, 15),
(8, '', 8, 'Erick Nunez', 'Erick', '25-07-2020', '13:22:20', 2, 1, '65b9546ff9', 1595704943, 15),
(9, '', 9, 'Erick Nunez', 'Erick', '25-07-2020', '13:22:30', 2, 1, 'e1c0787025', 1595704954, 15),
(10, '', 10, 'Erick Nunez', 'Erick', '26-07-2020', '13:24:55', 2, 1, '00f0b38fb2', 1595791505, 15),
(11, '', 11, 'Erick Nunez', 'Erick', '26-07-2020', '13:25:55', 2, 1, 'f0b62a0cc3', 1595791584, 15),
(12, '', 12, 'Erick Nunez', 'Erick', '26-07-2020', '13:26:50', 2, 1, 'ef721a1880', 1595791622, 15),
(13, '', 13, 'Erick Nunez', 'Erick', '27-07-2020', '13:27:33', 2, 1, 'd41f72587b', 1595878072, 15),
(14, '', 14, 'Erick Nunez', 'Erick', '27-07-2020', '13:27:58', 2, 1, 'e5625dd8ee', 1595878082, 15);

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
-- Indices de la tabla `cuentas`
--
ALTER TABLE `cuentas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `cuentas_abonos`
--
ALTER TABLE `cuentas_abonos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `ecommerce`
--
ALTER TABLE `ecommerce`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `ecommerce_data`
--
ALTER TABLE `ecommerce_data`
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
-- Indices de la tabla `producto_categoria_sub`
--
ALTER TABLE `producto_categoria_sub`
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
-- Indices de la tabla `producto_precio_mayorista`
--
ALTER TABLE `producto_precio_mayorista`
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
  MODIFY `id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `config_master`
--
ALTER TABLE `config_master`
  MODIFY `id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `config_root`
--
ALTER TABLE `config_root`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `corte_diario`
--
ALTER TABLE `corte_diario`
  MODIFY `id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT de la tabla `cotizaciones`
--
ALTER TABLE `cotizaciones`
  MODIFY `id` int(6) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `cotizaciones_data`
--
ALTER TABLE `cotizaciones_data`
  MODIFY `id` int(6) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `creditos`
--
ALTER TABLE `creditos`
  MODIFY `id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `creditos_abonos`
--
ALTER TABLE `creditos_abonos`
  MODIFY `id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `cuentas`
--
ALTER TABLE `cuentas`
  MODIFY `id` int(6) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `cuentas_abonos`
--
ALTER TABLE `cuentas_abonos`
  MODIFY `id` int(6) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `ecommerce`
--
ALTER TABLE `ecommerce`
  MODIFY `id` int(6) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `ecommerce_data`
--
ALTER TABLE `ecommerce_data`
  MODIFY `id` int(6) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `entradas_efectivo`
--
ALTER TABLE `entradas_efectivo`
  MODIFY `id` int(6) NOT NULL AUTO_INCREMENT;
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
  MODIFY `id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `gastos_images`
--
ALTER TABLE `gastos_images`
  MODIFY `id` int(6) NOT NULL AUTO_INCREMENT;
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
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
  MODIFY `id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `planilla_descuentos`
--
ALTER TABLE `planilla_descuentos`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `planilla_descuentos_asig`
--
ALTER TABLE `planilla_descuentos_asig`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `planilla_empleados`
--
ALTER TABLE `planilla_empleados`
  MODIFY `id` int(6) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `planilla_extras`
--
ALTER TABLE `planilla_extras`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `planilla_pagos`
--
ALTER TABLE `planilla_pagos`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `producto`
--
ALTER TABLE `producto`
  MODIFY `id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
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
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `producto_categoria_sub`
--
ALTER TABLE `producto_categoria_sub`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `producto_compuestos`
--
ALTER TABLE `producto_compuestos`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT;
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
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT de la tabla `producto_ingresado`
--
ALTER TABLE `producto_ingresado`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT de la tabla `producto_precio`
--
ALTER TABLE `producto_precio`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT de la tabla `producto_precio_mayorista`
--
ALTER TABLE `producto_precio_mayorista`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `producto_tags`
--
ALTER TABLE `producto_tags`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `producto_unidades`
--
ALTER TABLE `producto_unidades`
  MODIFY `id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de la tabla `proveedores`
--
ALTER TABLE `proveedores`
  MODIFY `id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `sync_tabla`
--
ALTER TABLE `sync_tabla`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `sync_tables_updates`
--
ALTER TABLE `sync_tables_updates`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `sync_up`
--
ALTER TABLE `sync_up`
  MODIFY `id` int(6) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `sync_up_cloud`
--
ALTER TABLE `sync_up_cloud`
  MODIFY `id` int(6) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `ticket`
--
ALTER TABLE `ticket`
  MODIFY `id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
--
-- AUTO_INCREMENT de la tabla `ticket_cliente`
--
ALTER TABLE `ticket_cliente`
  MODIFY `id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `ticket_descuenta`
--
ALTER TABLE `ticket_descuenta`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `ticket_num`
--
ALTER TABLE `ticket_num`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT de la tabla `ticket_orden`
--
ALTER TABLE `ticket_orden`
  MODIFY `id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
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

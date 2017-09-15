-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 08-09-2017 a las 14:49:14
-- Versión del servidor: 10.1.22-MariaDB
-- Versión de PHP: 7.1.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `burgasac`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `abonos`
--

CREATE TABLE `abonos` (
  `id` int(10) UNSIGNED NOT NULL,
  `fecha` date NOT NULL,
  `observaciones` text COLLATE utf8_unicode_ci,
  `tipoabono_id` int(10) UNSIGNED NOT NULL,
  `compra_id` int(10) UNSIGNED NOT NULL,
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `accesorios`
--

CREATE TABLE `accesorios` (
  `id` int(10) UNSIGNED NOT NULL,
  `nombre` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `titulo_id` int(10) UNSIGNED NOT NULL,
  `proveedor_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `accesorios`
--

INSERT INTO `accesorios` (`id`, `nombre`, `titulo_id`, `proveedor_id`, `created_at`, `updated_at`) VALUES
(2, 'AGUJA', 5, 3, '2017-04-24 18:14:17', '2017-04-24 18:14:17');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `bancos`
--

CREATE TABLE `bancos` (
  `id` int(10) UNSIGNED NOT NULL,
  `nombre` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cargo`
--

CREATE TABLE `cargo` (
  `id` int(10) UNSIGNED NOT NULL,
  `nombre` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `descripcion` text COLLATE utf8_unicode_ci,
  `estado` tinyint(4) DEFAULT '1',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `user_created_at` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `user_updated_at` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `user_deleted_at` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `userid_created_at` smallint(6) DEFAULT NULL,
  `userid_updated_at` smallint(6) DEFAULT NULL,
  `userid_deleted_at` smallint(6) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `cargo`
--

INSERT INTO `cargo` (`id`, `nombre`, `descripcion`, `estado`, `created_at`, `updated_at`, `deleted_at`, `user_created_at`, `user_updated_at`, `user_deleted_at`, `userid_created_at`, `userid_updated_at`, `userid_deleted_at`) VALUES
(1, 'Asistente', 'Asistente descripcion editado', 1, '2017-04-29 23:11:46', '2017-04-29 23:18:33', NULL, 'Rodolfo', 'Rodolfo', NULL, 4, 4, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `color`
--

CREATE TABLE `color` (
  `id_color` int(11) NOT NULL,
  `nombre` varchar(100) DEFAULT NULL,
  `estado` tinyint(2) DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `user_created_at` varchar(45) DEFAULT NULL,
  `user_updated_at` varchar(45) DEFAULT NULL,
  `user_deleted_at` varchar(45) DEFAULT NULL,
  `userid_created_at` int(10) DEFAULT NULL,
  `userid_updated_at` int(10) DEFAULT NULL,
  `userid_deleted_at` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `color`
--

INSERT INTO `color` (`id_color`, `nombre`, `estado`, `created_at`, `updated_at`, `deleted_at`, `user_created_at`, `user_updated_at`, `user_deleted_at`, `userid_created_at`, `userid_updated_at`, `userid_deleted_at`) VALUES
(1, 'Blanco', 1, '2017-05-05 06:08:53', '2017-05-05 06:08:53', NULL, NULL, 'Rodolfo', NULL, NULL, 4, NULL),
(2, 'Negro', 1, '2017-05-04 19:26:25', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(3, 'Azul', 1, '2017-05-04 19:26:27', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(4, 'VERDE', 1, '2017-05-10 02:14:38', '2017-05-10 02:14:38', NULL, 'Rodolfo', NULL, NULL, 4, NULL, NULL),
(5, 'AMARILLO', 1, '2017-05-10 17:01:35', '2017-05-10 17:01:35', NULL, 'Rodolfo', NULL, NULL, 4, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `compras`
--

CREATE TABLE `compras` (
  `id` int(10) UNSIGNED NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `codigo` int(11) DEFAULT NULL,
  `nro_comprobante` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `nro_guia` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `observaciones` text COLLATE utf8_unicode_ci,
  `proveedor_id` int(10) UNSIGNED NOT NULL,
  `procedencia_id` int(10) UNSIGNED NOT NULL,
  `estado` int(10) UNSIGNED NOT NULL,
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `compras`
--

INSERT INTO `compras` (`id`, `fecha`, `codigo`, `nro_comprobante`, `nro_guia`, `observaciones`, `proveedor_id`, `procedencia_id`, `estado`, `created_by`, `updated_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, '2017-08-27 05:00:00', 1, '', 'GUIA1', NULL, 4, 1, 2, 4, 4, '2017-08-27 23:40:47', '2017-08-27 23:40:47', NULL),
(2, '2017-08-27 05:00:00', 2, '', 'GUIA2', NULL, 4, 1, 2, 4, 4, '2017-08-27 23:41:34', '2017-08-27 23:41:34', NULL),
(3, '2017-08-27 05:00:00', 3, '', 'GUIA3', NULL, 4, 1, 2, 4, 4, '2017-08-27 23:44:52', '2017-08-27 23:44:52', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `compra_estados`
--

CREATE TABLE `compra_estados` (
  `id` int(10) UNSIGNED NOT NULL,
  `nombre` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `compra_estados`
--

INSERT INTO `compra_estados` (`id`, `nombre`, `created_at`, `updated_at`) VALUES
(1, 'Transición', NULL, NULL),
(2, 'Recepcionado', NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cronogramas`
--

CREATE TABLE `cronogramas` (
  `id` int(10) UNSIGNED NOT NULL,
  `cuotas` int(11) DEFAULT NULL,
  `tipo_de_pago` tinyint(1) NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `monto` decimal(10,2) NOT NULL,
  `observaciones` text COLLATE utf8_unicode_ci,
  `banco_id` int(10) UNSIGNED DEFAULT NULL,
  `tipopago_id` int(10) UNSIGNED DEFAULT NULL,
  `compra_id` int(10) UNSIGNED NOT NULL,
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `despacho_terceros`
--

CREATE TABLE `despacho_terceros` (
  `id` int(10) UNSIGNED NOT NULL,
  `proveedor_id` int(10) DEFAULT NULL,
  `fecha` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `user_created_at` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `user_updated_at` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `user_deleted_at` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `userid_created_at` int(10) DEFAULT NULL,
  `userid_updated_at` int(10) DEFAULT NULL,
  `userid_deleted_at` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `despacho_tintoreria`
--

CREATE TABLE `despacho_tintoreria` (
  `id` int(10) UNSIGNED NOT NULL,
  `proveedor_id` int(10) DEFAULT NULL,
  `fecha` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `user_created_at` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `user_updated_at` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `user_deleted_at` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `userid_created_at` int(10) DEFAULT NULL,
  `userid_updated_at` int(10) DEFAULT NULL,
  `userid_deleted_at` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `despacho_tintoreria`
--

INSERT INTO `despacho_tintoreria` (`id`, `proveedor_id`, `fecha`, `created_at`, `updated_at`, `deleted_at`, `user_created_at`, `user_updated_at`, `user_deleted_at`, `userid_created_at`, `userid_updated_at`, `userid_deleted_at`) VALUES
(1, 5, '2017-08-28 04:48:21', '2017-08-27 23:48:21', '2017-08-27 23:48:21', NULL, 'Rodolfo D\'Brot', NULL, NULL, 4, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalles_despacho_terceros`
--

CREATE TABLE `detalles_despacho_terceros` (
  `id` int(10) UNSIGNED NOT NULL,
  `producto_id` int(10) UNSIGNED NOT NULL,
  `color_id` int(11) DEFAULT '0',
  `cantidad` double(8,2) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `proveedor_id` int(10) UNSIGNED NOT NULL,
  `despacho_id` int(10) UNSIGNED NOT NULL,
  `rollos` double(8,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalles_despacho_tintoreria`
--

CREATE TABLE `detalles_despacho_tintoreria` (
  `id` int(10) UNSIGNED NOT NULL,
  `color_id` int(10) NOT NULL DEFAULT '0',
  `producto_id` int(10) UNSIGNED NOT NULL,
  `nro_lote` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `cantidad` double(8,2) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `proveedor_id` int(10) UNSIGNED NOT NULL,
  `despacho_id` int(10) UNSIGNED NOT NULL,
  `rollos` double(8,2) NOT NULL,
  `estado` tinyint(4) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `detalles_despacho_tintoreria`
--

INSERT INTO `detalles_despacho_tintoreria` (`id`, `color_id`, `producto_id`, `nro_lote`, `cantidad`, `created_at`, `updated_at`, `proveedor_id`, `despacho_id`, `rollos`, `estado`) VALUES
(1, 1, 2, 'LOTE3', 155.00, '2017-08-27 23:48:21', '2017-09-08 05:47:54', 5, 1, 5.00, 0),
(2, 2, 2, 'LOTE3', 110.00, '2017-09-28 23:48:21', '2017-09-08 04:17:43', 5, 1, 5.00, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_abonos`
--

CREATE TABLE `detalle_abonos` (
  `id` int(10) UNSIGNED NOT NULL,
  `monto` decimal(8,2) NOT NULL,
  `observaciones` text COLLATE utf8_unicode_ci,
  `fecha` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `peso_bruto` decimal(8,2) NOT NULL,
  `peso_tara` decimal(8,2) NOT NULL,
  `cantidad_paquetes` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `producto_id` int(10) UNSIGNED NOT NULL,
  `abono_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_compras`
--

CREATE TABLE `detalle_compras` (
  `id` int(10) UNSIGNED NOT NULL,
  `nro_lote` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `peso_bruto` decimal(8,2) DEFAULT NULL,
  `peso_tara` decimal(8,2) DEFAULT NULL,
  `cantidad` decimal(8,2) DEFAULT NULL,
  `observaciones` text COLLATE utf8_unicode_ci,
  `titulo_id` int(10) UNSIGNED NOT NULL,
  `insumo_id` int(10) UNSIGNED DEFAULT NULL,
  `accesorio_id` int(10) UNSIGNED DEFAULT NULL,
  `compra_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `detalle_compras`
--

INSERT INTO `detalle_compras` (`id`, `nro_lote`, `peso_bruto`, `peso_tara`, `cantidad`, `observaciones`, `titulo_id`, `insumo_id`, `accesorio_id`, `compra_id`, `created_at`, `updated_at`) VALUES
(1, NULL, NULL, NULL, '100.00', NULL, 5, NULL, 2, 1, '2017-08-27 23:40:47', '2017-08-27 23:40:47'),
(2, 'LOTE2', '1200.00', '0.00', '85.00', NULL, 2, 2, NULL, 2, '2017-08-27 23:41:34', '2017-08-27 23:41:34'),
(3, 'LOTE3', '1400.00', '0.00', '110.00', NULL, 1, 1, NULL, 3, '2017-08-27 23:44:52', '2017-08-27 23:44:52');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_devoluciones`
--

CREATE TABLE `detalle_devoluciones` (
  `id` int(10) UNSIGNED NOT NULL,
  `observaciones` text COLLATE utf8_unicode_ci,
  `detalle_compra_id` int(11) NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `nro_lote` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `marca` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `titulo` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `peso_bruto` decimal(8,2) NOT NULL,
  `peso_tara` decimal(8,2) NOT NULL,
  `cantidad_paquetes` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `insumo_id` int(11) DEFAULT NULL,
  `accesorio_id` int(11) DEFAULT NULL,
  `devolucion_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_nota_ingreso`
--

CREATE TABLE `detalle_nota_ingreso` (
  `dNotIng_id` int(10) UNSIGNED NOT NULL,
  `ning_id` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `tienda_id` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `cod_barras` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `peso_cant` float(15,8) DEFAULT NULL,
  `rollo` int(11) DEFAULT NULL,
  `impreso` tinyint(4) NOT NULL DEFAULT '1',
  `fecha` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `detalle_nota_ingreso`
--

INSERT INTO `detalle_nota_ingreso` (`dNotIng_id`, `ning_id`, `tienda_id`, `cod_barras`, `peso_cant`, `rollo`, `impreso`, `fecha`) VALUES
(109, 72, 1, '722017-09-08-1', 1215.00000000, 121, 0, '2017-09-08 05:00:00'),
(112, 72, 1, '722017-09-08-1', 2121.00000000, 121, 0, '2017-09-08 05:00:00'),
(114, 73, 2, '732017-09-08-2', 2121.00000000, 121, 0, '2017-09-08 05:00:00'),
(115, 72, 1, '722017-09-08-1', 2121.00000000, 121, 0, '2017-09-08 05:00:00'),
(116, 73, 1, '732017-09-08-1', 2121.00000000, 121, 0, '2017-09-08 05:00:00'),
(117, 73, 2, '732017-09-08-2', 2121.00000000, 121, 0, '2017-09-08 05:00:00'),
(118, 72, 1, '722017-09-08-1', 2121.00000000, 121, 0, '2017-09-08 05:00:00'),
(119, 73, 1, '732017-09-08-1', 2121.00000000, 121, 0, '2017-09-08 05:00:00'),
(120, 73, 2, '732017-09-08-2', 2121.00000000, 121, 0, '2017-09-08 05:00:00'),
(121, 72, 1, '722017-09-08-1', 2121.00000000, 121, 0, '2017-09-08 05:00:00'),
(122, 73, 1, '732017-09-08-1', 2121.00000000, 121, 0, '2017-09-08 05:00:00'),
(123, 73, 2, '732017-09-08-2', 2121.00000000, 121, 0, '2017-09-08 05:00:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_nota_ingreso_a`
--

CREATE TABLE `detalle_nota_ingreso_a` (
  `dNotInga_id` int(10) UNSIGNED NOT NULL,
  `ninga_id` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `tienda_id` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `cod_barras` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `peso_cant` float(15,8) DEFAULT NULL,
  `rollo` int(11) DEFAULT NULL,
  `impreso` tinyint(4) NOT NULL DEFAULT '1',
  `estado` tinyint(4) NOT NULL DEFAULT '1',
  `fecha` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `detalle_nota_ingreso_a`
--

INSERT INTO `detalle_nota_ingreso_a` (`dNotInga_id`, `ninga_id`, `tienda_id`, `cod_barras`, `peso_cant`, `rollo`, `impreso`, `estado`, `fecha`) VALUES
(6, 7, 2, 'código de prueba', 5455.00000000, 5454, 1, 0, '2017-09-08 05:00:00'),
(9, 10, 1, 'código de prueba', 4545.00000000, 4545, 1, 0, '2017-09-08 05:00:00'),
(10, 11, 1, 'código de prueba', 5454.00000000, 5454, 1, 0, '2017-09-08 05:00:00'),
(11, 12, 1, 'código de prueba', 5454.00000000, 5454, 1, 0, '2017-09-08 05:00:00'),
(12, 13, 1, 'código de prueba', 5454.00000000, 5454, 1, 0, '2017-09-08 05:00:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_planeamientos`
--

CREATE TABLE `detalle_planeamientos` (
  `id` int(10) UNSIGNED NOT NULL,
  `fecha` date NOT NULL,
  `planeamiento_id` int(10) UNSIGNED NOT NULL,
  `titulo_id` int(10) UNSIGNED NOT NULL,
  `lote_insumo` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `insumo_id` int(11) NOT NULL DEFAULT '0',
  `cajas` int(11) NOT NULL,
  `kg` double(8,2) NOT NULL,
  `mp_producida` double(8,2) NOT NULL,
  `accesorio_id` int(11) NOT NULL DEFAULT '0',
  `lote_accesorio` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `cantidad` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `detalle_planeamientos`
--

INSERT INTO `detalle_planeamientos` (`id`, `fecha`, `planeamiento_id`, `titulo_id`, `lote_insumo`, `deleted_at`, `created_at`, `updated_at`, `insumo_id`, `cajas`, `kg`, `mp_producida`, `accesorio_id`, `lote_accesorio`, `cantidad`) VALUES
(3, '2017-08-27', 1, 5, '0', NULL, '2017-08-27 23:45:33', '2017-08-27 23:46:05', 0, 0, 0.00, 220.00, 2, '0', 10),
(4, '2017-08-27', 1, 1, 'LOTE3', NULL, '2017-08-27 23:45:33', '2017-08-27 23:46:05', 1, 0, 220.00, 220.00, 0, '0', 0),
(5, '2017-08-27', 2, 5, '0', NULL, '2017-08-27 23:54:46', '2017-08-27 23:55:08', 0, 0, 0.00, 110.00, 2, 'undefined', 5),
(6, '2017-08-27', 2, 1, 'LOTE3', NULL, '2017-08-27 23:54:46', '2017-08-27 23:55:08', 1, 0, 110.00, 110.00, 0, 'undefined', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `devoluciones`
--

CREATE TABLE `devoluciones` (
  `id` int(10) UNSIGNED NOT NULL,
  `fecha` date NOT NULL,
  `tipo_devolucion` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `observaciones` text COLLATE utf8_unicode_ci,
  `compra_id` int(10) UNSIGNED NOT NULL,
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empleados`
--

CREATE TABLE `empleados` (
  `id` int(10) UNSIGNED NOT NULL,
  `nombres` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `apellidos` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `fecha_nacimiento` date DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `telefono` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `observaciones` text COLLATE utf8_unicode_ci,
  `cargo` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `user_created_at` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `user_updated_at` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `user_deleted_at` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `userid_created_at` int(11) DEFAULT NULL,
  `userid_updated_at` int(11) DEFAULT NULL,
  `userid_deleted_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `empleados`
--

INSERT INTO `empleados` (`id`, `nombres`, `apellidos`, `fecha_nacimiento`, `email`, `telefono`, `observaciones`, `cargo`, `created_at`, `updated_at`, `deleted_at`, `user_created_at`, `user_updated_at`, `user_deleted_at`, `userid_created_at`, `userid_updated_at`, `userid_deleted_at`) VALUES
(2, 'GRIMANIER ', 'LEON SUXE', '1987-09-27', 'gimaleon2787@hotmail.com', '996476721', '', '0', '2017-04-24 17:12:11', '2017-04-24 17:12:11', NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empleado_cargo`
--

CREATE TABLE `empleado_cargo` (
  `id` int(11) NOT NULL,
  `empleado_id` int(11) DEFAULT NULL,
  `cargo_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `history`
--

CREATE TABLE `history` (
  `id` int(10) UNSIGNED NOT NULL,
  `type_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `entity_id` int(10) UNSIGNED DEFAULT NULL,
  `icon` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `class` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `text` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `assets` text COLLATE utf8_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `history_types`
--

CREATE TABLE `history_types` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `history_types`
--

INSERT INTO `history_types` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'User', '2017-04-07 10:08:33', '2017-04-07 10:08:33'),
(2, 'Role', '2017-04-07 10:08:33', '2017-04-07 10:08:33');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `indicador`
--

CREATE TABLE `indicador` (
  `id` int(10) UNSIGNED NOT NULL,
  `producto_id` int(11) NOT NULL,
  `insumo_id` int(11) NOT NULL,
  `titulo_id` int(10) DEFAULT '0',
  `valor` double(8,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `indicador`
--

INSERT INTO `indicador` (`id`, `producto_id`, `insumo_id`, `titulo_id`, `valor`, `created_at`, `updated_at`) VALUES
(3, 2, 1, 1, 1.00, '2017-04-24 17:50:27', '2017-04-24 17:50:27'),
(4, 3, 3, 2, 0.97, '2017-04-24 18:10:26', '2017-04-24 18:10:26'),
(5, 3, 4, 4, 0.03, '2017-04-24 18:10:26', '2017-04-24 18:10:26');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `insumos`
--

CREATE TABLE `insumos` (
  `id` int(10) UNSIGNED NOT NULL,
  `proveedor_id` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `titulo_id` int(10) UNSIGNED NOT NULL,
  `nombre_generico` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `nombre_especifico` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `material` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `descripcion` text COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `user_created_at` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `user_updated_at` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `user_deleted_at` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `userid_created_at` int(10) DEFAULT NULL,
  `userid_updated_at` int(10) DEFAULT NULL,
  `userid_deleted_at` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `insumos`
--

INSERT INTO `insumos` (`id`, `proveedor_id`, `titulo_id`, `nombre_generico`, `nombre_especifico`, `material`, `descripcion`, `created_at`, `updated_at`, `deleted_at`, `user_created_at`, `user_updated_at`, `user_deleted_at`, `userid_created_at`, `userid_updated_at`, `userid_deleted_at`) VALUES
(1, 0, 1, 'HILO', 'HILO', 'HILO', 'esto es Hilo', '2017-04-23 05:28:50', '2017-04-23 05:28:50', NULL, 'Rodolfo', NULL, NULL, 4, NULL, NULL),
(2, 0, 2, 'HILO', 'HILO', 'HILO', 'esto es hilo', '2017-04-23 05:31:23', '2017-04-23 05:31:23', NULL, 'Rodolfo', NULL, NULL, 4, NULL, NULL),
(3, 0, 2, 'HILO POLYCOTTON  CARDADO  52/48', 'HILO POLYCOTTON  CARDADO  52/48', 'HILO', '', '2017-04-24 18:01:26', '2017-04-24 18:01:26', NULL, 'Rodolfo', NULL, NULL, 4, NULL, NULL),
(4, 0, 4, 'LICRA USA', 'LICRA USA', 'FILAMENTO', '', '2017-04-24 18:08:48', '2017-04-24 18:08:48', NULL, 'Rodolfo', NULL, NULL, 4, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `locales`
--

CREATE TABLE `locales` (
  `id` int(10) UNSIGNED NOT NULL,
  `nombre` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `direccion` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `telefono` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ciudad` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `distrito` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `observaciones` text COLLATE utf8_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `maquinas`
--

CREATE TABLE `maquinas` (
  `id` int(10) UNSIGNED NOT NULL,
  `nombre` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `codigo` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `observaciones` text COLLATE utf8_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `maquinas`
--

INSERT INTO `maquinas` (`id`, `nombre`, `codigo`, `observaciones`, `created_at`, `updated_at`) VALUES
(2, 'PILOTELLY', 'MAQ-01', '', '2017-04-24 17:46:53', '2017-04-24 17:46:53');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `marcas`
--

CREATE TABLE `marcas` (
  `id` int(10) UNSIGNED NOT NULL,
  `nombre` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(98, '2014_10_12_000000_create_users_table', 1),
(99, '2014_10_12_100000_create_password_resets_table', 1),
(100, '2015_12_28_171741_create_social_logins_table', 1),
(101, '2015_12_29_015055_setup_access_tables', 1),
(102, '2016_07_03_062439_create_history_tables', 1),
(103, '2016_12_29_234847_create_empleados_table', 1),
(104, '2016_12_29_234908_create_proveedores_table', 1),
(105, '2016_12_29_235907_create_titulos_table', 1),
(106, '2016_12_29_235916_create_marcas_table', 1),
(107, '2016_12_29_235917_create_insumos_table', 1),
(108, '2016_12_30_000221_create_locales_table', 1),
(109, '2016_12_30_002126_create_maquinas_table', 1),
(110, '2017_01_03_005453_create_accesorios_table', 1),
(111, '2017_01_06_205718_create_procedencias_table', 1),
(112, '2017_01_06_355329_create_compra_estados_table', 1),
(113, '2017_01_06_385329_create_compras_table', 1),
(114, '2017_01_06_390705_create_detalle_compras_table', 1),
(115, '2017_01_10_021510_create_bancos_table', 1),
(116, '2017_01_10_021709_create_tipos_pagos_table', 1),
(117, '2017_01_10_022658_create_cronogramas_table', 1),
(118, '2017_01_13_142659_create_devoluciones_table', 1),
(119, '2017_01_13_150751_create_detalle_devoluciones_table', 1),
(120, '2017_01_17_223449_create_tipos_abonos_table', 1),
(121, '2017_01_17_223450_create_productos_table', 1),
(122, '2017_01_17_223536_create_abonos_table', 1),
(123, '2017_01_17_223540_create_detalle_abonos_table', 1),
(124, '2017_02_11_212142_create_planeamiento_table', 1),
(125, '2017_02_11_220614_create_detalle_planeamiento_table', 1),
(126, '2017_02_12_014331_alter_planeamiento_table_add_turno', 1),
(127, '2017_02_13_165355_alter_table_planeamiento_remove_empleado_turno_maquina', 1),
(128, '2017_02_13_165416_alter_table_detalle_planeamiento_add_empleado_turno_maquina', 1),
(129, '2017_02_14_145408_alter_planeamiento_table_add_estado', 1),
(130, '2017_02_15_220034_alter_table_detalle_planeamiento_add_turno', 1),
(131, '2017_02_17_144233_alter_planeamientos_table_add_fields', 1),
(132, '2017_02_17_144649_alter_table_detalle_planeamiento_remove_fields', 1),
(133, '2017_02_17_145011_alter_table_detalle_planeamientos_add_fields', 1),
(134, '2017_02_17_145257_alter_table_detalle_planeamientos_remove_fields', 1),
(135, '2017_02_17_150633_alter_table_planeamientos_remove_insumo_id', 1),
(136, '2017_02_17_150728_alter_table_planeamientos_add_accesorio_id', 1),
(137, '2017_02_18_012812_alter_table_detalle_add_fields', 1),
(138, '2017_02_18_022256_alter_table_planeamiento_add_data', 1),
(139, '2017_02_18_194314_alter_table_detalle_planeamiento_remove_data', 1),
(140, '2017_02_18_194453_alter_table_planeamientos_add_data', 1),
(141, '2017_02_23_203128_create_table_movimiento_materiaprima', 1),
(142, '2017_02_23_203629_create_table_resumen_stock_materiaprima', 1),
(143, '2017_02_23_203804_create_table_movimiento_tela', 1),
(144, '2017_02_23_203918_create_table_resumen_stock_telas', 1),
(145, '2017_02_23_204826_alter_table_movimiento_tela_add_proveedor_id', 1),
(146, '2017_02_24_032044_create_table_indicador', 1),
(147, '2017_02_24_141025_alter_table_movimiento_tela_cantidad', 1),
(148, '2017_02_24_141302_alter_table_resumen_stock_tela_cantidad', 1),
(149, '2017_02_24_151730_alter_table_movimiento_mp_cantidad', 1),
(150, '2017_02_24_151854_alter_table_resumen_stock_mp_cantidad', 1),
(151, '2017_02_24_200730_alter_table_planeamiento_mp_producida', 1),
(152, '2017_02_24_202032_alter_table_planeamiento_mp_producida_remove', 1),
(153, '2017_02_24_202216_alter_table_detalles_planeamiento_add_materia_prima', 1),
(154, '2017_02_25_212331_alter_detalle_compras_add_estado', 1),
(155, '2017_02_25_222653_alter_table_movimiento_tela_add_rollos', 1),
(156, '2017_02_25_222719_alter_table_resumen_stock_telas_add_rollos', 1),
(157, '2017_02_27_145812_alter_resumen_stock_mp_materia_prima_add_insumo_id_accesorio_id', 1),
(158, '2017_02_27_145834_alter_movimiento_mp_materia_prima_add_insumo_id_accesorio_id', 1),
(159, '2017_02_27_171922_alter_table_movimiento_mp_add_descripcion', 1),
(160, '2017_02_27_171957_alter_table_resumen_stock__mp_add_descripcion', 1),
(161, '2017_02_27_173317_alter_table_movimiento_mp_change_description', 1),
(162, '2017_02_27_173748_alter_table_resumen_mp_stock_remove_descripcion', 1),
(163, '2017_02_27_181033_create_table_recepcion_mp', 1),
(164, '2017_02_27_181045_create_table_detalle_recepcion_mp', 1),
(165, '2017_02_27_220816_alter_table_recepcion_mp_detalles_remove_marca', 1),
(166, '2017_03_02_041503_alter_table_planeamientos_remove_accesorio', 1),
(167, '2017_03_02_041526_alter_table_detalle_planeamientos_add_accesorio', 1),
(168, '2017_03_02_072134_alter_table_planeamiento_remove_lote_accesorio', 1),
(169, '2017_03_02_072150_alter_table_detalle_planeamiento_add_accesorio', 1),
(170, '2017_03_02_110736_alter_table_detalle_planeamiento_add_accesorio_change', 1),
(171, '2017_03_02_201717_create_table_despacho_tintoreria', 1),
(172, '2017_03_02_210441_create_table_detalles_despacho_tintoreria', 1),
(173, '2017_03_02_221212_alter_detalles_despacho_add_proveedor_id', 1),
(174, '2017_03_03_000419_alter_table_movimiento_telas_add_description', 1),
(175, '2017_03_03_003206_alter_table_detalles_despacho_tintoreria_add_despacho_id', 1),
(176, '2017_03_12_015238_alter_movimiento_mp_add_peso_neto', 1),
(177, '2017_03_12_021257_alter_resumen_mp_add_peso_neto', 1),
(178, '2017_03_16_210250_delete_cantidad', 1),
(179, '2017_03_16_215225_delete_agujas', 1),
(180, '2017_03_17_020725_alter_detalle_planeamiento_add_cantidad_table', 1),
(181, '2017_03_17_021016_delete_address', 1),
(182, '2017_03_17_111029_alter_detalle_planeamientos_default_value', 1),
(183, '2017_03_25_045330_alter_detalle_despacho_table_add_rollos', 1),
(184, '2017_03_26_020805_create_despacho_terceros_table', 1),
(185, '2017_03_26_020820_create_detalles_despacho_terceros_table', 1),
(186, '2017_03_26_025450_alter_table_detalle_despacho_terceros', 1),
(187, '2017_03_26_025843_alter_table_detalle_despachos_add_proveedor_id', 1),
(188, '2017_03_28_042039_Alter_tipo_cantidad_detalle_planeamiento', 1),
(189, '2017_03_28_163338_alter_table_planeamiento_add_rollos_falla', 1),
(190, '2017_03_28_163718_alter_table_planeamiento_add_rollos_falla_default', 1),
(191, '2017_03_28_172059_alter_table_indicador_change_insumo_id', 1),
(192, '2017_03_28_181108_alter_table_movimiento_tela_add_mp_producida', 1),
(193, '2017_04_01_040245_alter_table_mp_remove_mp_producida', 1),
(194, '2017_04_04_171250_alter_table_insumo_add_descripcion', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `movimiento_materiaprima`
--

CREATE TABLE `movimiento_materiaprima` (
  `id` int(10) UNSIGNED NOT NULL,
  `fecha` date NOT NULL,
  `compra_id` int(11) NOT NULL,
  `proveedor_id` int(11) NOT NULL,
  `lote` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `titulo_id` int(11) NOT NULL,
  `cantidad` double NOT NULL,
  `estado` smallint(6) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `insumo_id` int(11) NOT NULL,
  `accesorio_id` int(11) NOT NULL,
  `descripcion` text COLLATE utf8_unicode_ci NOT NULL,
  `peso_neto` double(8,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `movimiento_materiaprima`
--

INSERT INTO `movimiento_materiaprima` (`id`, `fecha`, `compra_id`, `proveedor_id`, `lote`, `titulo_id`, `cantidad`, `estado`, `created_at`, `updated_at`, `insumo_id`, `accesorio_id`, `descripcion`, `peso_neto`) VALUES
(1, '2017-08-27', 1, 4, '0', 5, 100, 1, '2017-08-27 23:40:48', '2017-08-27 23:40:48', 0, 2, 'Compra', 0.00),
(2, '2017-08-27', 2, 4, 'LOTE2', 2, 85, 1, '2017-08-27 23:41:34', '2017-08-27 23:41:34', 2, 0, 'Compra', 1200.00),
(3, '2017-08-27', 3, 4, 'LOTE3', 1, 110, 1, '2017-08-27 23:44:52', '2017-08-27 23:44:52', 1, 0, 'Compra', 1400.00);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `movimiento_tela`
--

CREATE TABLE `movimiento_tela` (
  `id` int(10) UNSIGNED NOT NULL,
  `planeacion_id` int(11) NOT NULL,
  `producto_id` int(11) NOT NULL,
  `proveedor_id` int(11) NOT NULL,
  `nro_lote` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `rollos` int(11) NOT NULL,
  `cantidad` double NOT NULL,
  `descripcion` text COLLATE utf8_unicode_ci NOT NULL,
  `estado` smallint(6) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `movimiento_tela`
--

INSERT INTO `movimiento_tela` (`id`, `planeacion_id`, `producto_id`, `proveedor_id`, `nro_lote`, `rollos`, `cantidad`, `descripcion`, `estado`, `created_at`, `updated_at`) VALUES
(1, 1, 2, 3, 'LOTE3', 10, 220, 'Planeamiento de Tela', 0, '2017-08-27 23:46:05', '2017-08-27 23:46:05'),
(2, 0, 2, 5, 'LOTE3', -5, -110, 'Despacho a tintorerias', 0, '2017-08-27 23:48:21', '2017-08-27 23:48:21'),
(3, 0, 2, 5, 'LOTE3', -5, -110, 'Despacho a tintorerias', 0, '2017-08-27 23:48:21', '2017-08-27 23:48:21'),
(4, 2, 2, 3, 'LOTE3', 5, 110, 'Planeamiento de Tela', 0, '2017-08-27 23:55:07', '2017-08-27 23:55:07');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `nota_ingreso`
--

CREATE TABLE `nota_ingreso` (
  `ning_id` int(10) UNSIGNED NOT NULL,
  `desptint_id` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `partida` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `nota_ingreso`
--

INSERT INTO `nota_ingreso` (`ning_id`, `desptint_id`, `partida`) VALUES
(72, 1, '1212'),
(73, 1, '112');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `nota_ingreso_a`
--

CREATE TABLE `nota_ingreso_a` (
  `ninga_id` int(10) UNSIGNED NOT NULL,
  `color_id` int(10) NOT NULL DEFAULT '0',
  `producto_id` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `proveedor_id` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `partida` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fecha` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `nota_ingreso_a`
--

INSERT INTO `nota_ingreso_a` (`ninga_id`, `color_id`, `producto_id`, `proveedor_id`, `partida`, `fecha`) VALUES
(7, 5, 3, 2, 'PA000000000007', '2017-09-08 05:00:00'),
(10, 1, 2, 1, 'PA00000000010', '2017-09-08 05:00:00'),
(11, 1, 2, 1, 'PA000000000011', '2017-09-08 05:00:00'),
(12, 1, 2, 1, 'PA00000000012', '2017-09-08 05:00:00'),
(13, 1, 2, 1, 'PA00000000013', '2017-09-08 05:00:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `permissions`
--

CREATE TABLE `permissions` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `display_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `sort` smallint(5) UNSIGNED NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `display_name`, `sort`, `created_at`, `updated_at`) VALUES
(1, 'view-backend', 'View Backend', 1, '2017-04-07 10:08:33', '2017-04-07 10:08:33'),
(2, 'manage-users', 'Manage Users', 2, '2017-04-07 10:08:33', '2017-04-07 10:08:33'),
(3, 'manage-roles', 'Manage Roles', 3, '2017-04-07 10:08:33', '2017-04-07 10:08:33');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `permission_role`
--

CREATE TABLE `permission_role` (
  `id` int(10) UNSIGNED NOT NULL,
  `permission_id` int(10) UNSIGNED NOT NULL,
  `role_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `permission_role`
--

INSERT INTO `permission_role` (`id`, `permission_id`, `role_id`) VALUES
(1, 1, 2),
(2, 2, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `planeamientos`
--

CREATE TABLE `planeamientos` (
  `id` int(10) UNSIGNED NOT NULL,
  `fecha` date NOT NULL,
  `proveedor_id` int(10) UNSIGNED NOT NULL,
  `producto_id` int(10) UNSIGNED NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `estado` smallint(6) NOT NULL,
  `empleado_id` int(11) NOT NULL,
  `turno` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `maquina_id` int(11) NOT NULL,
  `rollos` int(11) NOT NULL,
  `kg_producidos` double(8,2) NOT NULL,
  `kg_falla` double(8,2) NOT NULL,
  `rollos_falla` double NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `planeamientos`
--

INSERT INTO `planeamientos` (`id`, `fecha`, `proveedor_id`, `producto_id`, `deleted_at`, `created_at`, `updated_at`, `estado`, `empleado_id`, `turno`, `maquina_id`, `rollos`, `kg_producidos`, `kg_falla`, `rollos_falla`) VALUES
(1, '2017-08-27', 3, 2, NULL, '2017-08-27 23:42:33', '2017-08-27 23:46:05', 1, 2, 'Mañana', 2, 10, 220.00, 0.00, 0),
(2, '2017-08-27', 3, 2, NULL, '2017-08-27 23:54:46', '2017-08-27 23:55:07', 1, 2, 'Mañana', 2, 5, 110.00, 0.00, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `procedencias`
--

CREATE TABLE `procedencias` (
  `id` int(10) UNSIGNED NOT NULL,
  `nombre` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `procedencias`
--

INSERT INTO `procedencias` (`id`, `nombre`, `created_at`, `updated_at`) VALUES
(1, 'INDIA', '2017-04-23 06:44:02', '2017-04-23 06:44:02');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `id` int(10) UNSIGNED NOT NULL,
  `nombre_generico` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `nombre_especifico` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `material` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `tipo` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `observaciones` text COLLATE utf8_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `user_created_at` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `user_updated_at` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `user_deleted_at` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `userid_created_at` int(10) DEFAULT NULL,
  `userid_updated_at` int(10) DEFAULT NULL,
  `userid_deleted_at` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id`, `nombre_generico`, `nombre_especifico`, `material`, `tipo`, `observaciones`, `created_at`, `updated_at`, `deleted_at`, `user_created_at`, `user_updated_at`, `user_deleted_at`, `userid_created_at`, `userid_updated_at`, `userid_deleted_at`) VALUES
(1, 'FULL LICRA', 'FULL LICRA', 'HILO', NULL, NULL, '2017-04-23 06:26:45', '2017-04-24 17:47:30', '2017-04-24 17:47:30', 'Rodolfo', NULL, NULL, 4, NULL, NULL),
(2, 'JERSEY', 'JERSEY', 'HILO', NULL, NULL, '2017-04-24 17:50:27', '2017-04-24 17:50:27', NULL, 'Rodolfo', NULL, NULL, 4, NULL, NULL),
(3, 'FULL LICRA', 'FULL LICRA', 'HILO', NULL, NULL, '2017-04-24 18:10:26', '2017-04-24 18:10:26', NULL, 'Rodolfo', NULL, NULL, 4, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proveedores`
--

CREATE TABLE `proveedores` (
  `id` int(10) UNSIGNED NOT NULL,
  `nombre_comercial` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `razon_social` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ruc` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `direccion` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `direccion_secundaria` text COLLATE utf8_unicode_ci,
  `email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `telefono` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ciudad` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `observaciones` text COLLATE utf8_unicode_ci,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `user_created_at` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `user_updated_at` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `user_deleted_at` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `userid_created_at` int(11) DEFAULT NULL,
  `userid_updated_at` int(11) DEFAULT NULL,
  `userid_deleted_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `proveedores`
--

INSERT INTO `proveedores` (`id`, `nombre_comercial`, `razon_social`, `ruc`, `direccion`, `direccion_secundaria`, `email`, `telefono`, `ciudad`, `observaciones`, `created_at`, `updated_at`, `deleted_at`, `user_created_at`, `user_updated_at`, `user_deleted_at`, `userid_created_at`, `userid_updated_at`, `userid_deleted_at`) VALUES
(1, 'HILOS S.A', 'HILOS S.A', '35353535', 'SEBASTIAN BARRANCA 1860', NULL, 'consultoriadbrot@gmail.com', '956475200', '0', '', '2017-04-23 06:34:02', '2017-04-24 17:23:55', '2017-04-24 17:23:55', 'Rodolfo', NULL, NULL, 4, NULL, NULL),
(2, 'RODOLFO SAC', 'RODOLFO SAC', '3456789', 'SJL-EL BOSQUE', NULL, 'admin@corralito.com', '99999999', '0', '', '2017-04-23 11:31:24', '2017-04-24 17:23:59', '2017-04-24 17:23:59', 'Rodolfo', NULL, NULL, 4, NULL, NULL),
(3, 'BURGA SAC', 'BURGA SAC', '20511794553', 'MAZ J LT 17 A1 URB CANTO GRANDE S.J.L', '', 'textilburga@hotmail.com', '324-1224', '0', '', '2017-04-24 06:12:52', '2017-04-26 19:26:05', NULL, 'Rodolfo', 'Rodolfo', NULL, 4, 4, NULL),
(4, 'FARIDE ALGODON DEL PERU S.R.L', 'FARIDE ALGODON DEL PERU S.R.L', '20263804300', 'CALLE ICARO MZ KLT 6 URB LA CAMPIÑA CHORILLOS LIMA-LIMA', '', '', '', '0', '', '2017-04-24 17:31:59', '2017-05-09 01:55:45', NULL, 'Rodolfo', 'Rodolfo', NULL, 4, 4, NULL),
(5, 'JAS IMPORT & EXPORT S.R.L', 'JAS IMPORT & EXPORT S.R.L', '20338048905', 'AV. LOS LAURELES MZ A LT 20-25B C.P SANTA MARIA DE HUACHIPA LURIGANCHO-LIMA-LIMA', 'AV. LOS LAURELES MZ A LT 20-25B C.P SANTA MARIA DE HUACHIPA LURIGANCHO-LIMA-LIMA', '', '', '0', '', '2017-04-24 17:56:11', '2017-04-26 19:29:30', NULL, 'Rodolfo', 'Rodolfo', NULL, 4, 4, NULL),
(6, 'JJ TELA', 'JJ TELA', '2113131', '', '', '', '', '0', '', '2017-05-09 10:13:35', '2017-05-09 10:13:35', NULL, 'Rodolfo', NULL, NULL, 4, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proveedor_color`
--

CREATE TABLE `proveedor_color` (
  `id` int(11) NOT NULL,
  `proveedor_id` int(11) DEFAULT NULL,
  `color_id` int(11) DEFAULT NULL,
  `codigo` varchar(100) CHARACTER SET latin1 DEFAULT NULL,
  `estado` tinyint(2) DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `user_created_at` varchar(45) CHARACTER SET latin1 DEFAULT NULL,
  `user_updated_at` varchar(45) CHARACTER SET latin1 DEFAULT NULL,
  `user_deleted_at` varchar(45) CHARACTER SET latin1 DEFAULT NULL,
  `userid_created_at` int(10) DEFAULT NULL,
  `userid_updated_at` int(10) DEFAULT NULL,
  `userid_deleted_at` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `proveedor_color`
--

INSERT INTO `proveedor_color` (`id`, `proveedor_id`, `color_id`, `codigo`, `estado`, `created_at`, `updated_at`, `deleted_at`, `user_created_at`, `user_updated_at`, `user_deleted_at`, `userid_created_at`, `userid_updated_at`, `userid_deleted_at`) VALUES
(1, 5, 1, '01122', 0, '2017-05-09 00:59:07', '2017-05-09 00:59:07', '2017-05-09 00:59:07', NULL, NULL, NULL, NULL, NULL, NULL),
(2, 5, 2, '01322', 0, '2017-05-09 00:59:07', '2017-05-09 00:59:07', '2017-05-09 00:59:07', NULL, NULL, NULL, NULL, NULL, NULL),
(3, 5, 3, '01312', 0, '2017-05-09 00:59:07', '2017-05-09 00:59:07', '2017-05-09 00:59:07', NULL, NULL, NULL, NULL, NULL, NULL),
(4, 5, 1, '01122', 0, '2017-05-09 01:00:20', '2017-05-09 01:00:20', '2017-05-09 01:00:20', NULL, NULL, NULL, NULL, NULL, NULL),
(5, 5, 2, '01322', 0, '2017-05-09 01:00:20', '2017-05-09 01:00:20', '2017-05-09 01:00:20', NULL, NULL, NULL, NULL, NULL, NULL),
(6, 5, 3, '01312', 0, '2017-05-09 01:00:20', '2017-05-09 01:00:20', '2017-05-09 01:00:20', NULL, NULL, NULL, NULL, NULL, NULL),
(7, 5, 1, '01122', 0, '2017-05-09 05:02:02', '2017-05-09 05:02:02', '2017-05-09 05:02:02', NULL, NULL, NULL, NULL, NULL, NULL),
(8, 5, 2, '01322', 0, '2017-05-09 05:02:02', '2017-05-09 05:02:02', '2017-05-09 05:02:02', NULL, NULL, NULL, NULL, NULL, NULL),
(9, 5, 3, '01312', 0, '2017-05-09 05:02:02', '2017-05-09 05:02:02', '2017-05-09 05:02:02', NULL, NULL, NULL, NULL, NULL, NULL),
(10, 4, 1, '10100', 0, '2017-05-09 01:56:57', '2017-05-09 01:56:57', '2017-05-09 01:56:57', NULL, NULL, NULL, NULL, NULL, NULL),
(11, 4, 2, '10200', 0, '2017-05-09 01:56:57', '2017-05-09 01:56:57', '2017-05-09 01:56:57', NULL, NULL, NULL, NULL, NULL, NULL),
(12, 4, 3, '10302', 0, '2017-05-09 01:56:57', '2017-05-09 01:56:57', '2017-05-09 01:56:57', NULL, NULL, NULL, NULL, NULL, NULL),
(13, 4, 1, '10100', 0, '2017-05-10 02:09:59', '2017-05-10 02:09:59', '2017-05-10 02:09:59', NULL, NULL, NULL, NULL, NULL, NULL),
(14, 4, 2, '10200', 0, '2017-05-10 02:09:59', '2017-05-10 02:09:59', '2017-05-10 02:09:59', NULL, NULL, NULL, NULL, NULL, NULL),
(15, 4, 3, '10302', 0, '2017-05-10 02:09:59', '2017-05-10 02:09:59', '2017-05-10 02:09:59', NULL, NULL, NULL, NULL, NULL, NULL),
(16, 5, 1, '01122', 0, '2017-05-10 02:15:11', '2017-05-10 02:15:11', '2017-05-10 02:15:11', NULL, NULL, NULL, NULL, NULL, NULL),
(17, 5, 2, '01322', 0, '2017-05-10 02:15:11', '2017-05-10 02:15:11', '2017-05-10 02:15:11', NULL, NULL, NULL, NULL, NULL, NULL),
(18, 5, 3, '01312', 0, '2017-05-10 02:15:11', '2017-05-10 02:15:11', '2017-05-10 02:15:11', NULL, NULL, NULL, NULL, NULL, NULL),
(19, 4, 1, '10100', 0, '2017-05-10 09:10:43', '2017-05-10 09:10:43', '2017-05-10 09:10:43', NULL, NULL, NULL, NULL, NULL, NULL),
(20, 4, 2, '10200', 0, '2017-05-10 09:10:43', '2017-05-10 09:10:43', '2017-05-10 09:10:43', NULL, NULL, NULL, NULL, NULL, NULL),
(21, 4, 3, '10302', 0, '2017-05-10 09:10:43', '2017-05-10 09:10:43', '2017-05-10 09:10:43', NULL, NULL, NULL, NULL, NULL, NULL),
(22, 5, 1, '01122', 0, '2017-05-10 02:19:07', '2017-05-10 02:19:07', '2017-05-10 02:19:07', NULL, NULL, NULL, NULL, NULL, NULL),
(23, 5, 2, '01322', 0, '2017-05-10 02:19:07', '2017-05-10 02:19:07', '2017-05-10 02:19:07', NULL, NULL, NULL, NULL, NULL, NULL),
(24, 5, 3, '01312', 0, '2017-05-10 02:19:07', '2017-05-10 02:19:07', '2017-05-10 02:19:07', NULL, NULL, NULL, NULL, NULL, NULL),
(25, 5, 4, '232323', 0, '2017-05-10 02:19:07', '2017-05-10 02:19:07', '2017-05-10 02:19:07', NULL, NULL, NULL, NULL, NULL, NULL),
(26, 5, 2, '01322', 0, '2017-05-10 08:35:37', '2017-05-10 08:35:37', '2017-05-10 08:35:37', NULL, NULL, NULL, NULL, NULL, NULL),
(27, 5, 3, '01312', 0, '2017-05-10 08:35:37', '2017-05-10 08:35:37', '2017-05-10 08:35:37', NULL, NULL, NULL, NULL, NULL, NULL),
(28, 5, 4, '232323', 0, '2017-05-10 08:35:37', '2017-05-10 08:35:37', '2017-05-10 08:35:37', NULL, NULL, NULL, NULL, NULL, NULL),
(29, 5, 1, '011222', 1, '2017-05-10 08:35:37', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(30, 5, 2, '01322', 1, '2017-05-10 08:35:37', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(31, 5, 3, '01312', 1, '2017-05-10 08:35:37', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(32, 5, 4, '232323', 1, '2017-05-10 08:35:37', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(33, 4, 1, '10100', 1, '2017-05-10 09:10:43', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(34, 4, 2, '10200', 1, '2017-05-10 09:10:43', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(35, 4, 3, '10302', 1, '2017-05-10 09:10:43', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(36, 4, 4, '32311', 1, '2017-05-10 09:10:43', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proveedor_color_producto`
--

CREATE TABLE `proveedor_color_producto` (
  `id` int(11) NOT NULL,
  `proveedor_id` int(11) DEFAULT NULL,
  `producto_id` int(11) DEFAULT '1',
  `color_id` int(11) DEFAULT NULL,
  `moneda_id` int(11) DEFAULT NULL,
  `precio` double(12,2) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `user_created_at` varchar(45) CHARACTER SET latin1 DEFAULT NULL,
  `user_updated_at` varchar(45) CHARACTER SET latin1 DEFAULT NULL,
  `user_deleted_at` varchar(45) CHARACTER SET latin1 DEFAULT NULL,
  `userid_created_at` int(10) DEFAULT NULL,
  `userid_updated_at` int(10) DEFAULT NULL,
  `userid_deleted_at` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `proveedor_color_producto`
--

INSERT INTO `proveedor_color_producto` (`id`, `proveedor_id`, `producto_id`, `color_id`, `moneda_id`, `precio`, `created_at`, `updated_at`, `deleted_at`, `user_created_at`, `user_updated_at`, `user_deleted_at`, `userid_created_at`, `userid_updated_at`, `userid_deleted_at`) VALUES
(1, 5, 2, 1, 2, 25.00, '2017-05-08 20:54:04', '2017-05-08 20:54:04', NULL, 'Rodolfo', 'Rodolfo', NULL, 4, 4, NULL),
(2, 3, 3, 1, 1, 40.00, '2017-05-05 23:40:12', '2017-05-05 23:40:12', NULL, 'Rodolfo', NULL, NULL, 4, NULL, NULL),
(3, 5, 3, 3, 1, 25.00, '2017-05-08 21:09:51', '2017-05-08 21:09:51', NULL, 'Rodolfo', NULL, NULL, 4, NULL, NULL),
(4, 5, 2, 4, 1, 20.00, '2017-05-10 02:15:39', '2017-05-10 02:15:39', NULL, 'Rodolfo', NULL, NULL, 4, NULL, NULL),
(5, 5, 3, 1, 1, 10.00, '2017-05-10 08:36:24', '2017-05-10 08:36:24', NULL, 'Rodolfo', NULL, NULL, 4, NULL, NULL),
(6, 4, 3, 1, 1, 10.00, '2017-05-10 09:11:19', '2017-05-10 09:11:19', NULL, 'Rodolfo', NULL, NULL, 4, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proveedor_despacho_tintoreria_deuda`
--

CREATE TABLE `proveedor_despacho_tintoreria_deuda` (
  `id` int(11) NOT NULL,
  `proveedor_id` int(11) DEFAULT NULL,
  `producto_id` int(11) DEFAULT '1',
  `color_id` int(11) DEFAULT NULL,
  `moneda_id` int(11) DEFAULT NULL,
  `despacho_id` int(11) DEFAULT NULL,
  `detalle_despacho_id` int(11) DEFAULT NULL,
  `preciounitario` double(12,2) DEFAULT NULL,
  `total` double(12,2) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `user_created_at` varchar(45) CHARACTER SET latin1 DEFAULT NULL,
  `user_updated_at` varchar(45) CHARACTER SET latin1 DEFAULT NULL,
  `user_deleted_at` varchar(45) CHARACTER SET latin1 DEFAULT NULL,
  `userid_created_at` int(10) DEFAULT NULL,
  `userid_updated_at` int(10) DEFAULT NULL,
  `userid_deleted_at` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `proveedor_despacho_tintoreria_deuda`
--

INSERT INTO `proveedor_despacho_tintoreria_deuda` (`id`, `proveedor_id`, `producto_id`, `color_id`, `moneda_id`, `despacho_id`, `detalle_despacho_id`, `preciounitario`, `total`, `created_at`, `updated_at`, `deleted_at`, `user_created_at`, `user_updated_at`, `user_deleted_at`, `userid_created_at`, `userid_updated_at`, `userid_deleted_at`) VALUES
(1, 5, 2, 1, 2, 1, 1, 25.00, 2750.00, '2017-08-27 23:48:21', '2017-08-27 23:48:21', NULL, 'Rodolfo D\'Brot', NULL, NULL, 4, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proveedor_tipo`
--

CREATE TABLE `proveedor_tipo` (
  `id` int(11) NOT NULL,
  `proveedor_id` int(11) DEFAULT NULL,
  `tipo_proveedor_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `proveedor_tipo`
--

INSERT INTO `proveedor_tipo` (`id`, `proveedor_id`, `tipo_proveedor_id`) VALUES
(2, 1, 2),
(3, 1, 3),
(4, 1, 4),
(5, 2, 5),
(6, 2, 6),
(24, 3, 3),
(25, 3, 7),
(47, 5, 2),
(48, 5, 4),
(49, 5, 5),
(50, 4, 2),
(51, 4, 4),
(52, 6, 3),
(53, 6, 5),
(54, 6, 6);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `recepcion_mp`
--

CREATE TABLE `recepcion_mp` (
  `id` int(10) UNSIGNED NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `codigo` int(11) DEFAULT NULL,
  `nro_guia` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `observaciones` text COLLATE utf8_unicode_ci,
  `proveedor_id` int(10) UNSIGNED NOT NULL,
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `recepcion_mp`
--

INSERT INTO `recepcion_mp` (`id`, `fecha`, `codigo`, `nro_guia`, `observaciones`, `proveedor_id`, `created_by`, `updated_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, '2017-07-21 06:30:46', 1, 'GUIA113133', NULL, 6, 4, 4, '2017-07-21 01:30:30', '2017-07-21 01:30:46', '2017-07-21 01:30:46'),
(2, '2017-07-21 06:49:27', 2, 'GUIA10', NULL, 6, 4, 4, '2017-07-21 01:39:56', '2017-07-21 01:49:27', '2017-07-21 01:49:27');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `recepcion_mp_detalles`
--

CREATE TABLE `recepcion_mp_detalles` (
  `id` int(10) UNSIGNED NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `nro_lote` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `titulo` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `peso_bruto` decimal(8,2) NOT NULL,
  `peso_tara` decimal(8,2) NOT NULL,
  `cantidad_paquetes` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `observaciones` text COLLATE utf8_unicode_ci,
  `insumo_id` int(10) UNSIGNED DEFAULT NULL,
  `accesorio_id` int(10) UNSIGNED DEFAULT NULL,
  `recepcion_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `recepcion_mp_detalles`
--

INSERT INTO `recepcion_mp_detalles` (`id`, `fecha`, `nro_lote`, `titulo`, `peso_bruto`, `peso_tara`, `cantidad_paquetes`, `observaciones`, `insumo_id`, `accesorio_id`, `recepcion_id`, `created_at`, `updated_at`) VALUES
(1, '2017-07-21 06:30:30', 'LOTE5', '1', '0.00', '0.00', '61', NULL, 1, NULL, 1, '2017-07-21 01:30:30', '2017-07-21 01:30:30'),
(2, '2017-07-21 06:39:57', 'LOTE5', '1', '0.00', '0.00', '15', NULL, 1, NULL, 2, '2017-07-21 01:39:57', '2017-07-21 01:39:57');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `resumen_despacho_tintoreria`
--

CREATE TABLE `resumen_despacho_tintoreria` (
  `id` int(10) NOT NULL,
  `producto_id` int(10) DEFAULT NULL,
  `color_id` int(10) DEFAULT NULL,
  `rollos` int(11) DEFAULT NULL,
  `peso` decimal(12,2) DEFAULT NULL,
  `fecha` date DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `user_created_at` varchar(45) DEFAULT NULL,
  `user_updated_at` varchar(45) DEFAULT NULL,
  `user_deleted_at` varchar(45) DEFAULT NULL,
  `userid_created_at` int(10) DEFAULT NULL,
  `userid_updated_at` int(10) DEFAULT NULL,
  `userid_deleted_at` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `resumen_despacho_tintoreria`
--

INSERT INTO `resumen_despacho_tintoreria` (`id`, `producto_id`, `color_id`, `rollos`, `peso`, `fecha`, `created_at`, `updated_at`, `deleted_at`, `user_created_at`, `user_updated_at`, `user_deleted_at`, `userid_created_at`, `userid_updated_at`, `userid_deleted_at`) VALUES
(1, 2, 1, 5, '110.00', '2017-08-27', '2017-08-27 23:48:21', '2017-08-27 23:48:21', NULL, 'Rodolfo D\'Brot', 'Rodolfo D\'Brot', NULL, 4, 4, NULL),
(2, 2, 2, 5, '110.00', '2017-08-27', '2017-08-27 23:48:21', '2017-08-27 23:48:21', NULL, 'Rodolfo D\'Brot', 'Rodolfo D\'Brot', NULL, 4, 4, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `resumen_stock_materiaprima`
--

CREATE TABLE `resumen_stock_materiaprima` (
  `id` int(10) UNSIGNED NOT NULL,
  `lote` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `proveedor_id` int(11) NOT NULL,
  `titulo_id` int(10) DEFAULT '0',
  `cantidad` double NOT NULL,
  `estado` smallint(6) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `insumo_id` int(11) NOT NULL,
  `accesorio_id` int(11) NOT NULL,
  `peso_neto` double(8,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `resumen_stock_materiaprima`
--

INSERT INTO `resumen_stock_materiaprima` (`id`, `lote`, `proveedor_id`, `titulo_id`, `cantidad`, `estado`, `created_at`, `updated_at`, `insumo_id`, `accesorio_id`, `peso_neto`) VALUES
(1, '0', 3, 5, 85, 1, '2017-08-27 23:40:48', '2017-08-27 23:55:08', 0, 2, 0.00),
(2, 'LOTE2', 4, 2, 85, 1, '2017-08-27 23:41:34', '2017-08-27 23:41:34', 2, 0, 1200.00),
(3, 'LOTE3', 3, 1, 110, 1, '2017-08-27 23:44:52', '2017-08-27 23:55:08', 1, 0, 1070.00);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `resumen_stock_telas`
--

CREATE TABLE `resumen_stock_telas` (
  `id` int(10) UNSIGNED NOT NULL,
  `producto_id` int(11) NOT NULL,
  `proveedor_id` int(11) NOT NULL,
  `nro_lote` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `cantidad` double NOT NULL,
  `rollos` int(11) NOT NULL,
  `estado` smallint(6) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `userid_created_at` int(10) DEFAULT NULL,
  `userid_updated_at` int(10) DEFAULT NULL,
  `userid_deleted_at` int(10) DEFAULT NULL,
  `user_created_at` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `user_updated_at` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `user_deleted_at` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `resumen_stock_telas`
--

INSERT INTO `resumen_stock_telas` (`id`, `producto_id`, `proveedor_id`, `nro_lote`, `cantidad`, `rollos`, `estado`, `created_at`, `updated_at`, `deleted_at`, `userid_created_at`, `userid_updated_at`, `userid_deleted_at`, `user_created_at`, `user_updated_at`, `user_deleted_at`) VALUES
(1, 2, 3, 'LOTE3', 110, 5, 0, '2017-08-27 23:46:05', '2017-08-27 23:48:21', '2017-08-27 23:48:21', 4, 4, NULL, 'Rodolfo D\'Brot', 'Rodolfo D\'Brot', NULL),
(2, 2, 3, 'LOTE3', 110, 5, 0, '2017-08-27 23:55:07', '2017-08-27 23:55:07', NULL, 4, NULL, NULL, 'Rodolfo D\'Brot', NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

CREATE TABLE `roles` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `all` tinyint(1) NOT NULL DEFAULT '0',
  `sort` smallint(5) UNSIGNED NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`id`, `name`, `all`, `sort`, `created_at`, `updated_at`) VALUES
(1, 'Administrator', 1, 1, '2017-04-07 10:08:32', '2017-04-07 10:08:32'),
(2, 'Executive', 0, 2, '2017-04-07 10:08:32', '2017-04-07 10:08:32'),
(3, 'User', 0, 3, '2017-04-07 10:08:32', '2017-04-07 10:08:32');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `role_user`
--

CREATE TABLE `role_user` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `role_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `role_user`
--

INSERT INTO `role_user` (`id`, `user_id`, `role_id`) VALUES
(1, 1, 1),
(2, 2, 2),
(3, 3, 3),
(4, 4, 1),
(5, 5, 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `social_logins`
--

CREATE TABLE `social_logins` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `provider` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `provider_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `avatar` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tienda`
--

CREATE TABLE `tienda` (
  `tienda_id` int(10) UNSIGNED NOT NULL,
  `desc_tienda` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `tienda`
--

INSERT INTO `tienda` (`tienda_id`, `desc_tienda`) VALUES
(1, 'Manufacturas SAC'),
(2, 'Telas Arce');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipos_abonos`
--

CREATE TABLE `tipos_abonos` (
  `id` int(10) UNSIGNED NOT NULL,
  `nombre` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `tipos_abonos`
--

INSERT INTO `tipos_abonos` (`id`, `nombre`, `created_at`, `updated_at`) VALUES
(1, 'Concepto Abono 01', NULL, NULL),
(2, 'Concepto Abono 02', NULL, NULL),
(3, 'Concepto Abono 03', NULL, NULL),
(4, 'Concepto Abono 04', NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipos_pagos`
--

CREATE TABLE `tipos_pagos` (
  `id` int(10) UNSIGNED NOT NULL,
  `nombre` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `tipos_pagos`
--

INSERT INTO `tipos_pagos` (`id`, `nombre`, `created_at`, `updated_at`) VALUES
(1, 'Credito', NULL, NULL),
(2, 'Contado', NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_proveedor`
--

CREATE TABLE `tipo_proveedor` (
  `id` int(10) UNSIGNED NOT NULL,
  `nombre` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `estado` tinyint(4) DEFAULT '1',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `user_created_at` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `user_updated_at` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `user_deleted_at` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `userid_created_at` smallint(6) DEFAULT NULL,
  `userid_updated_at` smallint(6) DEFAULT NULL,
  `userid_deleted_at` smallint(6) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `tipo_proveedor`
--

INSERT INTO `tipo_proveedor` (`id`, `nombre`, `estado`, `created_at`, `updated_at`, `deleted_at`, `user_created_at`, `user_updated_at`, `user_deleted_at`, `userid_created_at`, `userid_updated_at`, `userid_deleted_at`) VALUES
(1, 'Compra edit', 1, '2017-04-16 07:54:15', '2017-04-16 09:01:59', '2017-04-16 09:01:59', 'Rodolfo', 'Rodolfo', NULL, 4, 4, NULL),
(2, 'Compra', 1, '2017-04-16 09:17:59', '2017-04-16 09:18:15', NULL, 'Rodolfo', 'Rodolfo', NULL, 4, 4, NULL),
(3, 'Planeamiento', 1, '2017-04-16 11:44:08', '2017-04-16 11:44:08', NULL, 'Rodolfo', NULL, NULL, 4, NULL, NULL),
(4, 'Tintoreria', 1, '2017-04-23 06:28:59', '2017-04-23 06:28:59', NULL, 'Rodolfo', NULL, NULL, 4, NULL, NULL),
(5, 'Despacho de Terceros', 1, '2017-04-23 11:23:27', '2017-04-23 11:23:27', NULL, 'Rodolfo', NULL, NULL, 4, NULL, NULL),
(6, 'Recepcion Materia Prima', 1, '2017-04-23 11:23:44', '2017-04-23 11:23:44', NULL, 'Rodolfo', NULL, NULL, 4, NULL, NULL),
(7, 'BURGA SAC', 1, '2017-04-24 06:10:47', '2017-04-24 06:10:47', NULL, 'Rodolfo', NULL, NULL, 4, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `titulos`
--

CREATE TABLE `titulos` (
  `id` int(10) UNSIGNED NOT NULL,
  `nombre` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `materia_prima` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `titulos`
--

INSERT INTO `titulos` (`id`, `nombre`, `materia_prima`, `created_at`, `updated_at`) VALUES
(1, '20/1', 'insumo', '2017-04-23 05:08:18', '2017-04-23 05:08:18'),
(2, '30/1', 'insumo', '2017-04-23 05:08:42', '2017-04-23 05:08:42'),
(4, '20-D', 'insumo', '2017-04-24 18:07:02', '2017-04-24 18:07:02'),
(5, '010101', 'accesorio', '2017-04-24 18:12:47', '2017-04-24 18:12:47');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` tinyint(3) UNSIGNED NOT NULL DEFAULT '1',
  `confirmation_code` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `confirmed` tinyint(1) NOT NULL DEFAULT '0',
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `status`, `confirmation_code`, `confirmed`, `remember_token`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Franck Mercado', 'franckmercado@gmail.com', '$2y$10$TM96BQfzwk.6K6x368Df2eljgMlldvaeNaRT43IGo59XBpN60O34S', 1, 'a2b31ed9ab1831a335fbfa5202080411', 1, NULL, '2017-04-07 10:08:32', '2017-04-07 10:08:32', NULL),
(2, 'Backend User', 'executive@executive.com', '$2y$10$RwNTNlaW3YwkSzxjwlod/uNLTw5KRzDr.EzPLeba1Z.GKXMmUa6uO', 1, '009b535bd1479946294c1cd1ea06707e', 1, NULL, '2017-04-07 10:08:32', '2017-04-07 10:08:32', NULL),
(3, 'Default User', 'user@user.com', '$2y$10$.6sLbnQ2BtkSog8qiLKwjuewyH.x8oqxDpjXTSpn/x9stJ3ZqBWoG', 1, 'e509e7eafa59472ab03480be01391d94', 1, NULL, '2017-04-07 10:08:32', '2017-04-07 10:08:32', NULL),
(4, 'Rodolfo D\'Brot', 'consultoriadbrot@gmail.com', '$2y$10$tArrwz042wFutts5lJegke9.WI3b/TXRG3mb4iYRTGcyHnyWPYyNW', 1, 'c45db330de617c77643f452078087617', 1, 'FFITOhoaJbdRWWtdPIpwdGaqUtReFmBENn0aDM73jnPuQ7kUkGev8rvDhvRf', '2017-04-07 10:08:32', '2017-08-28 04:58:11', NULL),
(5, 'prueba', 'prueba@gmail.com', '$2y$10$5vko2Fn9B3TKzPlWlEOvc.MJuUNNKqCCDUowl6rYl3KtdlFob1rqa', 1, '2dfa38b4d3edacfc8454b1f471fbe287', 1, 'yLv9GNuGbqQ03Nw4PUhh1MDqKflXnVmiCDGbMUQn7goaKNtHBTDlEJYyVS33', '2017-09-01 22:49:50', '2017-09-08 04:13:48', NULL);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `abonos`
--
ALTER TABLE `abonos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `abonos_tipoabono_id_foreign` (`tipoabono_id`),
  ADD KEY `abonos_compra_id_foreign` (`compra_id`);

--
-- Indices de la tabla `accesorios`
--
ALTER TABLE `accesorios`
  ADD PRIMARY KEY (`id`),
  ADD KEY `accesorios_titulo_id_foreign` (`titulo_id`),
  ADD KEY `accesorios_proveedor_id_foreign` (`proveedor_id`);

--
-- Indices de la tabla `bancos`
--
ALTER TABLE `bancos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `cargo`
--
ALTER TABLE `cargo`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `color`
--
ALTER TABLE `color`
  ADD PRIMARY KEY (`id_color`);

--
-- Indices de la tabla `compras`
--
ALTER TABLE `compras`
  ADD PRIMARY KEY (`id`),
  ADD KEY `compras_proveedor_id_foreign` (`proveedor_id`),
  ADD KEY `compras_procedencia_id_foreign` (`procedencia_id`),
  ADD KEY `compras_estado_foreign` (`estado`);

--
-- Indices de la tabla `compra_estados`
--
ALTER TABLE `compra_estados`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `cronogramas`
--
ALTER TABLE `cronogramas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cronogramas_banco_id_foreign` (`banco_id`),
  ADD KEY `cronogramas_tipopago_id_foreign` (`tipopago_id`),
  ADD KEY `cronogramas_compra_id_foreign` (`compra_id`);

--
-- Indices de la tabla `despacho_terceros`
--
ALTER TABLE `despacho_terceros`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `despacho_tintoreria`
--
ALTER TABLE `despacho_tintoreria`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `detalles_despacho_terceros`
--
ALTER TABLE `detalles_despacho_terceros`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `detalles_despacho_tintoreria`
--
ALTER TABLE `detalles_despacho_tintoreria`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `detalle_abonos`
--
ALTER TABLE `detalle_abonos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `detalle_abonos_producto_id_foreign` (`producto_id`),
  ADD KEY `detalle_abonos_abono_id_foreign` (`abono_id`);

--
-- Indices de la tabla `detalle_compras`
--
ALTER TABLE `detalle_compras`
  ADD PRIMARY KEY (`id`),
  ADD KEY `detalle_compras_titulo_id_foreign` (`titulo_id`),
  ADD KEY `detalle_compras_insumo_id_foreign` (`insumo_id`),
  ADD KEY `detalle_compras_accesorio_id_foreign` (`accesorio_id`),
  ADD KEY `detalle_compras_compra_id_foreign` (`compra_id`);

--
-- Indices de la tabla `detalle_devoluciones`
--
ALTER TABLE `detalle_devoluciones`
  ADD PRIMARY KEY (`id`),
  ADD KEY `detalle_devoluciones_devolucion_id_foreign` (`devolucion_id`);

--
-- Indices de la tabla `detalle_nota_ingreso`
--
ALTER TABLE `detalle_nota_ingreso`
  ADD PRIMARY KEY (`dNotIng_id`),
  ADD KEY `FK_ning_id` (`ning_id`),
  ADD KEY `FK_tienda_id` (`tienda_id`);

--
-- Indices de la tabla `detalle_nota_ingreso_a`
--
ALTER TABLE `detalle_nota_ingreso_a`
  ADD PRIMARY KEY (`dNotInga_id`),
  ADD KEY `FK_ninga_id` (`ninga_id`),
  ADD KEY `FK_tienda_ida` (`tienda_id`);

--
-- Indices de la tabla `detalle_planeamientos`
--
ALTER TABLE `detalle_planeamientos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `detalle_planeamientos_planeamiento_id_foreign` (`planeamiento_id`),
  ADD KEY `detalle_planeamientos_titulo_id_foreign` (`titulo_id`);

--
-- Indices de la tabla `devoluciones`
--
ALTER TABLE `devoluciones`
  ADD PRIMARY KEY (`id`),
  ADD KEY `devoluciones_compra_id_foreign` (`compra_id`);

--
-- Indices de la tabla `empleados`
--
ALTER TABLE `empleados`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `empleado_cargo`
--
ALTER TABLE `empleado_cargo`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `history`
--
ALTER TABLE `history`
  ADD PRIMARY KEY (`id`),
  ADD KEY `history_type_id_foreign` (`type_id`),
  ADD KEY `history_user_id_foreign` (`user_id`);

--
-- Indices de la tabla `history_types`
--
ALTER TABLE `history_types`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `indicador`
--
ALTER TABLE `indicador`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `insumos`
--
ALTER TABLE `insumos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `insumos_titulo_id_foreign` (`titulo_id`),
  ADD KEY `insumos_proveedor_id_foreign` (`proveedor_id`);

--
-- Indices de la tabla `locales`
--
ALTER TABLE `locales`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `maquinas`
--
ALTER TABLE `maquinas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `marcas`
--
ALTER TABLE `marcas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `movimiento_materiaprima`
--
ALTER TABLE `movimiento_materiaprima`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `movimiento_tela`
--
ALTER TABLE `movimiento_tela`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `nota_ingreso`
--
ALTER TABLE `nota_ingreso`
  ADD PRIMARY KEY (`ning_id`),
  ADD UNIQUE KEY `partida` (`partida`),
  ADD KEY `FK_desptint` (`desptint_id`),
  ADD KEY `partida_2` (`partida`);
ALTER TABLE `nota_ingreso` ADD FULLTEXT KEY `partida_3` (`partida`);

--
-- Indices de la tabla `nota_ingreso_a`
--
ALTER TABLE `nota_ingreso_a`
  ADD PRIMARY KEY (`ninga_id`),
  ADD KEY `FK_color_id` (`color_id`),
  ADD KEY `FK_producto_id` (`producto_id`),
  ADD KEY `FK_proveedor_id` (`proveedor_id`);

--
-- Indices de la tabla `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`),
  ADD KEY `password_resets_token_index` (`token`);

--
-- Indices de la tabla `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_name_unique` (`name`);

--
-- Indices de la tabla `permission_role`
--
ALTER TABLE `permission_role`
  ADD PRIMARY KEY (`id`),
  ADD KEY `permission_role_permission_id_foreign` (`permission_id`),
  ADD KEY `permission_role_role_id_foreign` (`role_id`);

--
-- Indices de la tabla `planeamientos`
--
ALTER TABLE `planeamientos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `planeamientos_proveedor_id_foreign` (`proveedor_id`),
  ADD KEY `planeamientos_producto_id_foreign` (`producto_id`);

--
-- Indices de la tabla `procedencias`
--
ALTER TABLE `procedencias`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `proveedores`
--
ALTER TABLE `proveedores`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `proveedor_color`
--
ALTER TABLE `proveedor_color`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `proveedor_color_producto`
--
ALTER TABLE `proveedor_color_producto`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `proveedor_despacho_tintoreria_deuda`
--
ALTER TABLE `proveedor_despacho_tintoreria_deuda`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `proveedor_tipo`
--
ALTER TABLE `proveedor_tipo`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `recepcion_mp`
--
ALTER TABLE `recepcion_mp`
  ADD PRIMARY KEY (`id`),
  ADD KEY `recepcion_mp_proveedor_id_foreign` (`proveedor_id`);

--
-- Indices de la tabla `recepcion_mp_detalles`
--
ALTER TABLE `recepcion_mp_detalles`
  ADD PRIMARY KEY (`id`),
  ADD KEY `recepcion_mp_detalles_insumo_id_foreign` (`insumo_id`),
  ADD KEY `recepcion_mp_detalles_accesorio_id_foreign` (`accesorio_id`),
  ADD KEY `recepcion_mp_detalles_recepcion_id_foreign` (`recepcion_id`);

--
-- Indices de la tabla `resumen_despacho_tintoreria`
--
ALTER TABLE `resumen_despacho_tintoreria`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `resumen_stock_materiaprima`
--
ALTER TABLE `resumen_stock_materiaprima`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `resumen_stock_telas`
--
ALTER TABLE `resumen_stock_telas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_unique` (`name`);

--
-- Indices de la tabla `role_user`
--
ALTER TABLE `role_user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `role_user_user_id_foreign` (`user_id`),
  ADD KEY `role_user_role_id_foreign` (`role_id`);

--
-- Indices de la tabla `social_logins`
--
ALTER TABLE `social_logins`
  ADD PRIMARY KEY (`id`),
  ADD KEY `social_logins_user_id_foreign` (`user_id`);

--
-- Indices de la tabla `tienda`
--
ALTER TABLE `tienda`
  ADD PRIMARY KEY (`tienda_id`);

--
-- Indices de la tabla `tipos_abonos`
--
ALTER TABLE `tipos_abonos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tipos_pagos`
--
ALTER TABLE `tipos_pagos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tipo_proveedor`
--
ALTER TABLE `tipo_proveedor`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `titulos`
--
ALTER TABLE `titulos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `abonos`
--
ALTER TABLE `abonos`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `accesorios`
--
ALTER TABLE `accesorios`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `bancos`
--
ALTER TABLE `bancos`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `cargo`
--
ALTER TABLE `cargo`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `color`
--
ALTER TABLE `color`
  MODIFY `id_color` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT de la tabla `compras`
--
ALTER TABLE `compras`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `compra_estados`
--
ALTER TABLE `compra_estados`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `cronogramas`
--
ALTER TABLE `cronogramas`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `despacho_terceros`
--
ALTER TABLE `despacho_terceros`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `despacho_tintoreria`
--
ALTER TABLE `despacho_tintoreria`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `detalles_despacho_terceros`
--
ALTER TABLE `detalles_despacho_terceros`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `detalles_despacho_tintoreria`
--
ALTER TABLE `detalles_despacho_tintoreria`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `detalle_abonos`
--
ALTER TABLE `detalle_abonos`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `detalle_compras`
--
ALTER TABLE `detalle_compras`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `detalle_devoluciones`
--
ALTER TABLE `detalle_devoluciones`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `detalle_nota_ingreso`
--
ALTER TABLE `detalle_nota_ingreso`
  MODIFY `dNotIng_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=124;
--
-- AUTO_INCREMENT de la tabla `detalle_nota_ingreso_a`
--
ALTER TABLE `detalle_nota_ingreso_a`
  MODIFY `dNotInga_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT de la tabla `detalle_planeamientos`
--
ALTER TABLE `detalle_planeamientos`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT de la tabla `devoluciones`
--
ALTER TABLE `devoluciones`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `empleados`
--
ALTER TABLE `empleados`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `empleado_cargo`
--
ALTER TABLE `empleado_cargo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `history`
--
ALTER TABLE `history`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `history_types`
--
ALTER TABLE `history_types`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `indicador`
--
ALTER TABLE `indicador`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT de la tabla `insumos`
--
ALTER TABLE `insumos`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de la tabla `locales`
--
ALTER TABLE `locales`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `maquinas`
--
ALTER TABLE `maquinas`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `marcas`
--
ALTER TABLE `marcas`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=195;
--
-- AUTO_INCREMENT de la tabla `movimiento_materiaprima`
--
ALTER TABLE `movimiento_materiaprima`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `movimiento_tela`
--
ALTER TABLE `movimiento_tela`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de la tabla `nota_ingreso`
--
ALTER TABLE `nota_ingreso`
  MODIFY `ning_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=74;
--
-- AUTO_INCREMENT de la tabla `nota_ingreso_a`
--
ALTER TABLE `nota_ingreso_a`
  MODIFY `ninga_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT de la tabla `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `permission_role`
--
ALTER TABLE `permission_role`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `planeamientos`
--
ALTER TABLE `planeamientos`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `procedencias`
--
ALTER TABLE `procedencias`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `proveedores`
--
ALTER TABLE `proveedores`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT de la tabla `proveedor_color`
--
ALTER TABLE `proveedor_color`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;
--
-- AUTO_INCREMENT de la tabla `proveedor_color_producto`
--
ALTER TABLE `proveedor_color_producto`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT de la tabla `proveedor_despacho_tintoreria_deuda`
--
ALTER TABLE `proveedor_despacho_tintoreria_deuda`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `proveedor_tipo`
--
ALTER TABLE `proveedor_tipo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;
--
-- AUTO_INCREMENT de la tabla `recepcion_mp`
--
ALTER TABLE `recepcion_mp`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `recepcion_mp_detalles`
--
ALTER TABLE `recepcion_mp_detalles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `resumen_despacho_tintoreria`
--
ALTER TABLE `resumen_despacho_tintoreria`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `resumen_stock_materiaprima`
--
ALTER TABLE `resumen_stock_materiaprima`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `resumen_stock_telas`
--
ALTER TABLE `resumen_stock_telas`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `role_user`
--
ALTER TABLE `role_user`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT de la tabla `social_logins`
--
ALTER TABLE `social_logins`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `tienda`
--
ALTER TABLE `tienda`
  MODIFY `tienda_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `tipos_abonos`
--
ALTER TABLE `tipos_abonos`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de la tabla `tipos_pagos`
--
ALTER TABLE `tipos_pagos`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `tipo_proveedor`
--
ALTER TABLE `tipo_proveedor`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT de la tabla `titulos`
--
ALTER TABLE `titulos`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `detalle_nota_ingreso`
--
ALTER TABLE `detalle_nota_ingreso`
  ADD CONSTRAINT `FK_ning_id` FOREIGN KEY (`ning_id`) REFERENCES `nota_ingreso` (`ning_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_tienda_id` FOREIGN KEY (`tienda_id`) REFERENCES `tienda` (`tienda_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `detalle_nota_ingreso_a`
--
ALTER TABLE `detalle_nota_ingreso_a`
  ADD CONSTRAINT `FK_ninga_id` FOREIGN KEY (`ninga_id`) REFERENCES `nota_ingreso_a` (`ninga_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_tienda_ida` FOREIGN KEY (`tienda_id`) REFERENCES `tienda` (`tienda_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `history`
--
ALTER TABLE `history`
  ADD CONSTRAINT `history_type_id_foreign` FOREIGN KEY (`type_id`) REFERENCES `history_types` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `history_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `nota_ingreso`
--
ALTER TABLE `nota_ingreso`
  ADD CONSTRAINT `FK_desptint` FOREIGN KEY (`desptint_id`) REFERENCES `detalles_despacho_tintoreria` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `nota_ingreso_a`
--
ALTER TABLE `nota_ingreso_a`
  ADD CONSTRAINT `FK_color_id` FOREIGN KEY (`color_id`) REFERENCES `color` (`id_color`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_producto_id` FOREIGN KEY (`producto_id`) REFERENCES `productos` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_proveedor_id` FOREIGN KEY (`proveedor_id`) REFERENCES `proveedores` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `permission_role`
--
ALTER TABLE `permission_role`
  ADD CONSTRAINT `permission_role_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `permission_role_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `role_user`
--
ALTER TABLE `role_user`
  ADD CONSTRAINT `role_user_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_user_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `social_logins`
--
ALTER TABLE `social_logins`
  ADD CONSTRAINT `social_logins_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

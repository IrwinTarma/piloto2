/*
SQLyog Ultimate v11.11 (64 bit)
MySQL - 5.7.19-0ubuntu0.16.04.1 : Database - burgasac
*********************************************************************
*/


/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`burgasac` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `burgasac`;

/*Table structure for table `abonos` */

DROP TABLE IF EXISTS `abonos`;

CREATE TABLE `abonos` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `fecha` date NOT NULL,
  `observaciones` text COLLATE utf8_unicode_ci,
  `tipoabono_id` int(10) unsigned NOT NULL,
  `compra_id` int(10) unsigned NOT NULL,
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `abonos_tipoabono_id_foreign` (`tipoabono_id`),
  KEY `abonos_compra_id_foreign` (`compra_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `abonos` */

/*Table structure for table `accesorios` */

DROP TABLE IF EXISTS `accesorios`;

CREATE TABLE `accesorios` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `titulo_id` int(10) unsigned NOT NULL,
  `proveedor_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `accesorios_titulo_id_foreign` (`titulo_id`),
  KEY `accesorios_proveedor_id_foreign` (`proveedor_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `accesorios` */

insert  into `accesorios`(`id`,`nombre`,`titulo_id`,`proveedor_id`,`created_at`,`updated_at`) values (2,'AGUJA',5,3,'2017-04-24 13:14:17','2017-04-24 13:14:17');

/*Table structure for table `bancos` */

DROP TABLE IF EXISTS `bancos`;

CREATE TABLE `bancos` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `bancos` */

/*Table structure for table `cargo` */

DROP TABLE IF EXISTS `cargo`;

CREATE TABLE `cargo` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
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
  `userid_deleted_at` smallint(6) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `cargo` */

insert  into `cargo`(`id`,`nombre`,`descripcion`,`estado`,`created_at`,`updated_at`,`deleted_at`,`user_created_at`,`user_updated_at`,`user_deleted_at`,`userid_created_at`,`userid_updated_at`,`userid_deleted_at`) values (1,'Asistente','Asistente descripcion editado',1,'2017-04-29 18:11:46','2017-04-29 18:18:33',NULL,'Rodolfo','Rodolfo',NULL,4,4,NULL);

/*Table structure for table `color` */

DROP TABLE IF EXISTS `color`;

CREATE TABLE `color` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
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
  `userid_deleted_at` int(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

/*Data for the table `color` */

insert  into `color`(`id`,`nombre`,`estado`,`created_at`,`updated_at`,`deleted_at`,`user_created_at`,`user_updated_at`,`user_deleted_at`,`userid_created_at`,`userid_updated_at`,`userid_deleted_at`) values (1,'Blanco',1,'2017-05-05 01:08:53','2017-05-05 01:08:53',NULL,NULL,'Rodolfo',NULL,NULL,4,NULL),(2,'Negro',1,'2017-05-04 14:26:25','0000-00-00 00:00:00',NULL,NULL,NULL,NULL,NULL,NULL,NULL),(3,'Azul',1,'2017-05-04 14:26:27','0000-00-00 00:00:00',NULL,NULL,NULL,NULL,NULL,NULL,NULL),(4,'VERDE',1,'2017-05-09 21:14:38','2017-05-09 21:14:38',NULL,'Rodolfo',NULL,NULL,4,NULL,NULL),(5,'AMARILLO',1,'2017-05-10 12:01:35','2017-05-10 12:01:35',NULL,'Rodolfo',NULL,NULL,4,NULL,NULL);

/*Table structure for table `compra_estados` */

DROP TABLE IF EXISTS `compra_estados`;

CREATE TABLE `compra_estados` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `compra_estados` */

insert  into `compra_estados`(`id`,`nombre`,`created_at`,`updated_at`) values (1,'Transición',NULL,NULL),(2,'Recepcionado',NULL,NULL);

/*Table structure for table `compras` */

DROP TABLE IF EXISTS `compras`;

CREATE TABLE `compras` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `fecha` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `codigo` int(11) DEFAULT NULL,
  `nro_comprobante` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `nro_guia` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `observaciones` text COLLATE utf8_unicode_ci,
  `proveedor_id` int(10) unsigned NOT NULL,
  `procedencia_id` int(10) unsigned NOT NULL,
  `estado` int(10) unsigned NOT NULL,
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `compras_proveedor_id_foreign` (`proveedor_id`),
  KEY `compras_procedencia_id_foreign` (`procedencia_id`),
  KEY `compras_estado_foreign` (`estado`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `compras` */

/*Table structure for table `cronogramas` */

DROP TABLE IF EXISTS `cronogramas`;

CREATE TABLE `cronogramas` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `cuotas` int(11) DEFAULT NULL,
  `tipo_de_pago` tinyint(1) NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `monto` decimal(10,2) NOT NULL,
  `observaciones` text COLLATE utf8_unicode_ci,
  `banco_id` int(10) unsigned DEFAULT NULL,
  `tipopago_id` int(10) unsigned DEFAULT NULL,
  `compra_id` int(10) unsigned NOT NULL,
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `cronogramas_banco_id_foreign` (`banco_id`),
  KEY `cronogramas_tipopago_id_foreign` (`tipopago_id`),
  KEY `cronogramas_compra_id_foreign` (`compra_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `cronogramas` */

/*Table structure for table `despacho_terceros` */

DROP TABLE IF EXISTS `despacho_terceros`;

CREATE TABLE `despacho_terceros` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
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
  `userid_deleted_at` int(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `despacho_terceros` */

/*Table structure for table `despacho_tintoreria` */

DROP TABLE IF EXISTS `despacho_tintoreria`;

CREATE TABLE `despacho_tintoreria` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
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
  `userid_deleted_at` int(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `despacho_tintoreria` */

/*Table structure for table `detalle_abonos` */

DROP TABLE IF EXISTS `detalle_abonos`;

CREATE TABLE `detalle_abonos` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `monto` decimal(8,2) NOT NULL,
  `observaciones` text COLLATE utf8_unicode_ci,
  `fecha` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `peso_bruto` decimal(8,2) NOT NULL,
  `peso_tara` decimal(8,2) NOT NULL,
  `cantidad_paquetes` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `producto_id` int(10) unsigned NOT NULL,
  `abono_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `detalle_abonos_producto_id_foreign` (`producto_id`),
  KEY `detalle_abonos_abono_id_foreign` (`abono_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `detalle_abonos` */

/*Table structure for table `detalle_compras` */

DROP TABLE IF EXISTS `detalle_compras`;

CREATE TABLE `detalle_compras` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nro_lote` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `peso_bruto` decimal(8,2) DEFAULT NULL,
  `peso_tara` decimal(8,2) DEFAULT NULL,
  `cantidad` decimal(8,2) DEFAULT NULL,
  `observaciones` text COLLATE utf8_unicode_ci,
  `titulo_id` int(10) unsigned NOT NULL,
  `insumo_id` int(10) unsigned DEFAULT NULL,
  `accesorio_id` int(10) unsigned DEFAULT NULL,
  `compra_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `detalle_compras_titulo_id_foreign` (`titulo_id`),
  KEY `detalle_compras_insumo_id_foreign` (`insumo_id`),
  KEY `detalle_compras_accesorio_id_foreign` (`accesorio_id`),
  KEY `detalle_compras_compra_id_foreign` (`compra_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `detalle_compras` */

/*Table structure for table `detalle_devoluciones` */

DROP TABLE IF EXISTS `detalle_devoluciones`;

CREATE TABLE `detalle_devoluciones` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
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
  `devolucion_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `detalle_devoluciones_devolucion_id_foreign` (`devolucion_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `detalle_devoluciones` */

/*Table structure for table `detalle_planeamientos` */

DROP TABLE IF EXISTS `detalle_planeamientos`;

CREATE TABLE `detalle_planeamientos` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `fecha` date NOT NULL,
  `planeamiento_id` int(10) unsigned NOT NULL,
  `titulo_id` int(10) unsigned NOT NULL,
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
  `cantidad` double NOT NULL,
  PRIMARY KEY (`id`),
  KEY `detalle_planeamientos_planeamiento_id_foreign` (`planeamiento_id`),
  KEY `detalle_planeamientos_titulo_id_foreign` (`titulo_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `detalle_planeamientos` */

/*Table structure for table `detalles_despacho_terceros` */

DROP TABLE IF EXISTS `detalles_despacho_terceros`;

CREATE TABLE `detalles_despacho_terceros` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `producto_id` int(10) unsigned NOT NULL,
  `color_id` int(11) DEFAULT '0',
  `cantidad` double(8,2) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `proveedor_id` int(10) unsigned NOT NULL,
  `despacho_id` int(10) unsigned NOT NULL,
  `rollos` double(8,2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `detalles_despacho_terceros` */

/*Table structure for table `detalles_despacho_tintoreria` */

DROP TABLE IF EXISTS `detalles_despacho_tintoreria`;

CREATE TABLE `detalles_despacho_tintoreria` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `color_id` int(10) NOT NULL DEFAULT '0',
  `producto_id` int(10) unsigned NOT NULL,
  `nro_lote` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `cantidad` double(8,2) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `proveedor_id` int(10) unsigned NOT NULL,
  `despacho_id` int(10) unsigned NOT NULL,
  `rollos` double(8,2) NOT NULL,
  /*`estado` boolean default true,*/
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `detalles_despacho_tintoreria` */

/*Table structure for table `devoluciones` */

DROP TABLE IF EXISTS `devoluciones`;

CREATE TABLE `devoluciones` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `fecha` date NOT NULL,
  `tipo_devolucion` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `observaciones` text COLLATE utf8_unicode_ci,
  `compra_id` int(10) unsigned NOT NULL,
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `devoluciones_compra_id_foreign` (`compra_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `devoluciones` */

/*Table structure for table `empleado_cargo` */

DROP TABLE IF EXISTS `empleado_cargo`;

CREATE TABLE `empleado_cargo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `empleado_id` int(11) DEFAULT NULL,
  `cargo_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `empleado_cargo` */

/*Table structure for table `empleados` */

DROP TABLE IF EXISTS `empleados`;

CREATE TABLE `empleados` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
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
  `userid_deleted_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `empleados` */

insert  into `empleados`(`id`,`nombres`,`apellidos`,`fecha_nacimiento`,`email`,`telefono`,`observaciones`,`cargo`,`created_at`,`updated_at`,`deleted_at`,`user_created_at`,`user_updated_at`,`user_deleted_at`,`userid_created_at`,`userid_updated_at`,`userid_deleted_at`) values (2,'GRIMANIER ','LEON SUXE','1987-09-27','gimaleon2787@hotmail.com','996476721','','0','2017-04-24 12:12:11','2017-04-24 12:12:11',NULL,NULL,NULL,NULL,NULL,NULL,NULL);

/*Table structure for table `history` */

DROP TABLE IF EXISTS `history`;

CREATE TABLE `history` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `type_id` int(10) unsigned NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `entity_id` int(10) unsigned DEFAULT NULL,
  `icon` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `class` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `text` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `assets` text COLLATE utf8_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `history_type_id_foreign` (`type_id`),
  KEY `history_user_id_foreign` (`user_id`),
  CONSTRAINT `history_type_id_foreign` FOREIGN KEY (`type_id`) REFERENCES `history_types` (`id`) ON DELETE CASCADE,
  CONSTRAINT `history_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `history` */

/*Table structure for table `history_types` */

DROP TABLE IF EXISTS `history_types`;

CREATE TABLE `history_types` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `history_types` */

insert  into `history_types`(`id`,`name`,`created_at`,`updated_at`) values (1,'User','2017-04-07 05:08:33','2017-04-07 05:08:33'),(2,'Role','2017-04-07 05:08:33','2017-04-07 05:08:33');

/*Table structure for table `indicador` */

DROP TABLE IF EXISTS `indicador`;

CREATE TABLE `indicador` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `producto_id` int(11) NOT NULL,
  `insumo_id` int(11) NOT NULL,
  `titulo_id` int(10) DEFAULT '0',
  `valor` double(8,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `indicador` */

insert  into `indicador`(`id`,`producto_id`,`insumo_id`,`titulo_id`,`valor`,`created_at`,`updated_at`) values (3,2,1,1,1.00,'2017-04-24 12:50:27','2017-04-24 12:50:27'),(4,3,3,2,0.97,'2017-04-24 13:10:26','2017-04-24 13:10:26'),(5,3,4,4,0.03,'2017-04-24 13:10:26','2017-04-24 13:10:26');

/*Table structure for table `insumos` */

DROP TABLE IF EXISTS `insumos`;

CREATE TABLE `insumos` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `proveedor_id` int(10) unsigned NOT NULL DEFAULT '0',
  `titulo_id` int(10) unsigned NOT NULL,
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
  `userid_deleted_at` int(10) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `insumos_titulo_id_foreign` (`titulo_id`),
  KEY `insumos_proveedor_id_foreign` (`proveedor_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `insumos` */

insert  into `insumos`(`id`,`proveedor_id`,`titulo_id`,`nombre_generico`,`nombre_especifico`,`material`,`descripcion`,`created_at`,`updated_at`,`deleted_at`,`user_created_at`,`user_updated_at`,`user_deleted_at`,`userid_created_at`,`userid_updated_at`,`userid_deleted_at`) values (1,0,1,'HILO','HILO','HILO','esto es Hilo','2017-04-23 00:28:50','2017-04-23 00:28:50',NULL,'Rodolfo',NULL,NULL,4,NULL,NULL),(2,0,2,'HILO','HILO','HILO','esto es hilo','2017-04-23 00:31:23','2017-04-23 00:31:23',NULL,'Rodolfo',NULL,NULL,4,NULL,NULL),(3,0,2,'HILO POLYCOTTON  CARDADO  52/48','HILO POLYCOTTON  CARDADO  52/48','HILO','','2017-04-24 13:01:26','2017-04-24 13:01:26',NULL,'Rodolfo',NULL,NULL,4,NULL,NULL),(4,0,4,'LICRA USA','LICRA USA','FILAMENTO','','2017-04-24 13:08:48','2017-04-24 13:08:48',NULL,'Rodolfo',NULL,NULL,4,NULL,NULL);

/*Table structure for table `locales` */

DROP TABLE IF EXISTS `locales`;

CREATE TABLE `locales` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `direccion` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `telefono` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ciudad` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `distrito` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `observaciones` text COLLATE utf8_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `locales` */

/*Table structure for table `maquinas` */

DROP TABLE IF EXISTS `maquinas`;

CREATE TABLE `maquinas` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `codigo` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `observaciones` text COLLATE utf8_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `maquinas` */

insert  into `maquinas`(`id`,`nombre`,`codigo`,`observaciones`,`created_at`,`updated_at`) values (2,'PILOTELLY','MAQ-01','','2017-04-24 12:46:53','2017-04-24 12:46:53');

/*Table structure for table `marcas` */

DROP TABLE IF EXISTS `marcas`;

CREATE TABLE `marcas` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `marcas` */

/*Table structure for table `migrations` */

DROP TABLE IF EXISTS `migrations`;

CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=195 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `migrations` */

insert  into `migrations`(`id`,`migration`,`batch`) values (98,'2014_10_12_000000_create_users_table',1),(99,'2014_10_12_100000_create_password_resets_table',1),(100,'2015_12_28_171741_create_social_logins_table',1),(101,'2015_12_29_015055_setup_access_tables',1),(102,'2016_07_03_062439_create_history_tables',1),(103,'2016_12_29_234847_create_empleados_table',1),(104,'2016_12_29_234908_create_proveedores_table',1),(105,'2016_12_29_235907_create_titulos_table',1),(106,'2016_12_29_235916_create_marcas_table',1),(107,'2016_12_29_235917_create_insumos_table',1),(108,'2016_12_30_000221_create_locales_table',1),(109,'2016_12_30_002126_create_maquinas_table',1),(110,'2017_01_03_005453_create_accesorios_table',1),(111,'2017_01_06_205718_create_procedencias_table',1),(112,'2017_01_06_355329_create_compra_estados_table',1),(113,'2017_01_06_385329_create_compras_table',1),(114,'2017_01_06_390705_create_detalle_compras_table',1),(115,'2017_01_10_021510_create_bancos_table',1),(116,'2017_01_10_021709_create_tipos_pagos_table',1),(117,'2017_01_10_022658_create_cronogramas_table',1),(118,'2017_01_13_142659_create_devoluciones_table',1),(119,'2017_01_13_150751_create_detalle_devoluciones_table',1),(120,'2017_01_17_223449_create_tipos_abonos_table',1),(121,'2017_01_17_223450_create_productos_table',1),(122,'2017_01_17_223536_create_abonos_table',1),(123,'2017_01_17_223540_create_detalle_abonos_table',1),(124,'2017_02_11_212142_create_planeamiento_table',1),(125,'2017_02_11_220614_create_detalle_planeamiento_table',1),(126,'2017_02_12_014331_alter_planeamiento_table_add_turno',1),(127,'2017_02_13_165355_alter_table_planeamiento_remove_empleado_turno_maquina',1),(128,'2017_02_13_165416_alter_table_detalle_planeamiento_add_empleado_turno_maquina',1),(129,'2017_02_14_145408_alter_planeamiento_table_add_estado',1),(130,'2017_02_15_220034_alter_table_detalle_planeamiento_add_turno',1),(131,'2017_02_17_144233_alter_planeamientos_table_add_fields',1),(132,'2017_02_17_144649_alter_table_detalle_planeamiento_remove_fields',1),(133,'2017_02_17_145011_alter_table_detalle_planeamientos_add_fields',1),(134,'2017_02_17_145257_alter_table_detalle_planeamientos_remove_fields',1),(135,'2017_02_17_150633_alter_table_planeamientos_remove_insumo_id',1),(136,'2017_02_17_150728_alter_table_planeamientos_add_accesorio_id',1),(137,'2017_02_18_012812_alter_table_detalle_add_fields',1),(138,'2017_02_18_022256_alter_table_planeamiento_add_data',1),(139,'2017_02_18_194314_alter_table_detalle_planeamiento_remove_data',1),(140,'2017_02_18_194453_alter_table_planeamientos_add_data',1),(141,'2017_02_23_203128_create_table_movimiento_materiaprima',1),(142,'2017_02_23_203629_create_table_resumen_stock_materiaprima',1),(143,'2017_02_23_203804_create_table_movimiento_tela',1),(144,'2017_02_23_203918_create_table_resumen_stock_telas',1),(145,'2017_02_23_204826_alter_table_movimiento_tela_add_proveedor_id',1),(146,'2017_02_24_032044_create_table_indicador',1),(147,'2017_02_24_141025_alter_table_movimiento_tela_cantidad',1),(148,'2017_02_24_141302_alter_table_resumen_stock_tela_cantidad',1),(149,'2017_02_24_151730_alter_table_movimiento_mp_cantidad',1),(150,'2017_02_24_151854_alter_table_resumen_stock_mp_cantidad',1),(151,'2017_02_24_200730_alter_table_planeamiento_mp_producida',1),(152,'2017_02_24_202032_alter_table_planeamiento_mp_producida_remove',1),(153,'2017_02_24_202216_alter_table_detalles_planeamiento_add_materia_prima',1),(154,'2017_02_25_212331_alter_detalle_compras_add_estado',1),(155,'2017_02_25_222653_alter_table_movimiento_tela_add_rollos',1),(156,'2017_02_25_222719_alter_table_resumen_stock_telas_add_rollos',1),(157,'2017_02_27_145812_alter_resumen_stock_mp_materia_prima_add_insumo_id_accesorio_id',1),(158,'2017_02_27_145834_alter_movimiento_mp_materia_prima_add_insumo_id_accesorio_id',1),(159,'2017_02_27_171922_alter_table_movimiento_mp_add_descripcion',1),(160,'2017_02_27_171957_alter_table_resumen_stock__mp_add_descripcion',1),(161,'2017_02_27_173317_alter_table_movimiento_mp_change_description',1),(162,'2017_02_27_173748_alter_table_resumen_mp_stock_remove_descripcion',1),(163,'2017_02_27_181033_create_table_recepcion_mp',1),(164,'2017_02_27_181045_create_table_detalle_recepcion_mp',1),(165,'2017_02_27_220816_alter_table_recepcion_mp_detalles_remove_marca',1),(166,'2017_03_02_041503_alter_table_planeamientos_remove_accesorio',1),(167,'2017_03_02_041526_alter_table_detalle_planeamientos_add_accesorio',1),(168,'2017_03_02_072134_alter_table_planeamiento_remove_lote_accesorio',1),(169,'2017_03_02_072150_alter_table_detalle_planeamiento_add_accesorio',1),(170,'2017_03_02_110736_alter_table_detalle_planeamiento_add_accesorio_change',1),(171,'2017_03_02_201717_create_table_despacho_tintoreria',1),(172,'2017_03_02_210441_create_table_detalles_despacho_tintoreria',1),(173,'2017_03_02_221212_alter_detalles_despacho_add_proveedor_id',1),(174,'2017_03_03_000419_alter_table_movimiento_telas_add_description',1),(175,'2017_03_03_003206_alter_table_detalles_despacho_tintoreria_add_despacho_id',1),(176,'2017_03_12_015238_alter_movimiento_mp_add_peso_neto',1),(177,'2017_03_12_021257_alter_resumen_mp_add_peso_neto',1),(178,'2017_03_16_210250_delete_cantidad',1),(179,'2017_03_16_215225_delete_agujas',1),(180,'2017_03_17_020725_alter_detalle_planeamiento_add_cantidad_table',1),(181,'2017_03_17_021016_delete_address',1),(182,'2017_03_17_111029_alter_detalle_planeamientos_default_value',1),(183,'2017_03_25_045330_alter_detalle_despacho_table_add_rollos',1),(184,'2017_03_26_020805_create_despacho_terceros_table',1),(185,'2017_03_26_020820_create_detalles_despacho_terceros_table',1),(186,'2017_03_26_025450_alter_table_detalle_despacho_terceros',1),(187,'2017_03_26_025843_alter_table_detalle_despachos_add_proveedor_id',1),(188,'2017_03_28_042039_Alter_tipo_cantidad_detalle_planeamiento',1),(189,'2017_03_28_163338_alter_table_planeamiento_add_rollos_falla',1),(190,'2017_03_28_163718_alter_table_planeamiento_add_rollos_falla_default',1),(191,'2017_03_28_172059_alter_table_indicador_change_insumo_id',1),(192,'2017_03_28_181108_alter_table_movimiento_tela_add_mp_producida',1),(193,'2017_04_01_040245_alter_table_mp_remove_mp_producida',1),(194,'2017_04_04_171250_alter_table_insumo_add_descripcion',1);

/*Table structure for table `movimiento_materiaprima` */

DROP TABLE IF EXISTS `movimiento_materiaprima`;

CREATE TABLE `movimiento_materiaprima` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
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
  `peso_neto` double(8,2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `movimiento_materiaprima` */

/*Table structure for table `movimiento_tela` */

DROP TABLE IF EXISTS `movimiento_tela`;

CREATE TABLE `movimiento_tela` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `planeacion_id` int(11) NOT NULL,
  `producto_id` int(11) NOT NULL,
  `proveedor_id` int(11) NOT NULL,
  `nro_lote` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `rollos` int(11) NOT NULL,
  `cantidad` double NOT NULL,
  `descripcion` text COLLATE utf8_unicode_ci NOT NULL,
  `estado` smallint(6) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `movimiento_tela` */

/*Table structure for table `password_resets` */

DROP TABLE IF EXISTS `password_resets`;

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`),
  KEY `password_resets_token_index` (`token`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `password_resets` */

/*Table structure for table `permission_role` */

DROP TABLE IF EXISTS `permission_role`;

CREATE TABLE `permission_role` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `permission_id` int(10) unsigned NOT NULL,
  `role_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `permission_role_permission_id_foreign` (`permission_id`),
  KEY `permission_role_role_id_foreign` (`role_id`),
  CONSTRAINT `permission_role_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  CONSTRAINT `permission_role_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `permission_role` */

insert  into `permission_role`(`id`,`permission_id`,`role_id`) values (1,1,2),(2,2,2);

/*Table structure for table `permissions` */

DROP TABLE IF EXISTS `permissions`;

CREATE TABLE `permissions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `display_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `sort` smallint(5) unsigned NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `permissions_name_unique` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `permissions` */

insert  into `permissions`(`id`,`name`,`display_name`,`sort`,`created_at`,`updated_at`) values (1,'view-backend','View Backend',1,'2017-04-07 05:08:33','2017-04-07 05:08:33'),(2,'manage-users','Manage Users',2,'2017-04-07 05:08:33','2017-04-07 05:08:33'),(3,'manage-roles','Manage Roles',3,'2017-04-07 05:08:33','2017-04-07 05:08:33');

/*Table structure for table `planeamientos` */

DROP TABLE IF EXISTS `planeamientos`;

CREATE TABLE `planeamientos` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `fecha` date NOT NULL,
  `proveedor_id` int(10) unsigned NOT NULL,
  `producto_id` int(10) unsigned NOT NULL,
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
  `rollos_falla` double NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `planeamientos_proveedor_id_foreign` (`proveedor_id`),
  KEY `planeamientos_producto_id_foreign` (`producto_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `planeamientos` */

/*Table structure for table `procedencias` */

DROP TABLE IF EXISTS `procedencias`;

CREATE TABLE `procedencias` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `procedencias` */

insert  into `procedencias`(`id`,`nombre`,`created_at`,`updated_at`) values (1,'INDIA','2017-04-23 01:44:02','2017-04-23 01:44:02');

/*Table structure for table `productos` */

DROP TABLE IF EXISTS `productos`;

CREATE TABLE `productos` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
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
  `userid_deleted_at` int(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `productos` */

insert  into `productos`(`id`,`nombre_generico`,`nombre_especifico`,`material`,`tipo`,`observaciones`,`created_at`,`updated_at`,`deleted_at`,`user_created_at`,`user_updated_at`,`user_deleted_at`,`userid_created_at`,`userid_updated_at`,`userid_deleted_at`) values (1,'FULL LICRA','FULL LICRA','HILO',NULL,NULL,'2017-04-23 01:26:45','2017-04-24 12:47:30','2017-04-24 12:47:30','Rodolfo',NULL,NULL,4,NULL,NULL),(2,'JERSEY','JERSEY','HILO',NULL,NULL,'2017-04-24 12:50:27','2017-04-24 12:50:27',NULL,'Rodolfo',NULL,NULL,4,NULL,NULL),(3,'FULL LICRA','FULL LICRA','HILO',NULL,NULL,'2017-04-24 13:10:26','2017-04-24 13:10:26',NULL,'Rodolfo',NULL,NULL,4,NULL,NULL);

/*Table structure for table `proveedor_color` */

DROP TABLE IF EXISTS `proveedor_color`;

CREATE TABLE `proveedor_color` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
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
  `userid_deleted_at` int(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=utf8;

/*Data for the table `proveedor_color` */

insert  into `proveedor_color`(`id`,`proveedor_id`,`color_id`,`codigo`,`estado`,`created_at`,`updated_at`,`deleted_at`,`user_created_at`,`user_updated_at`,`user_deleted_at`,`userid_created_at`,`userid_updated_at`,`userid_deleted_at`) values (1,5,1,'01122',0,'2017-05-08 19:59:07','2017-05-08 19:59:07','2017-05-08 19:59:07',NULL,NULL,NULL,NULL,NULL,NULL),(2,5,2,'01322',0,'2017-05-08 19:59:07','2017-05-08 19:59:07','2017-05-08 19:59:07',NULL,NULL,NULL,NULL,NULL,NULL),(3,5,3,'01312',0,'2017-05-08 19:59:07','2017-05-08 19:59:07','2017-05-08 19:59:07',NULL,NULL,NULL,NULL,NULL,NULL),(4,5,1,'01122',0,'2017-05-08 20:00:20','2017-05-08 20:00:20','2017-05-08 20:00:20',NULL,NULL,NULL,NULL,NULL,NULL),(5,5,2,'01322',0,'2017-05-08 20:00:20','2017-05-08 20:00:20','2017-05-08 20:00:20',NULL,NULL,NULL,NULL,NULL,NULL),(6,5,3,'01312',0,'2017-05-08 20:00:20','2017-05-08 20:00:20','2017-05-08 20:00:20',NULL,NULL,NULL,NULL,NULL,NULL),(7,5,1,'01122',0,'2017-05-09 00:02:02','2017-05-09 00:02:02','2017-05-09 00:02:02',NULL,NULL,NULL,NULL,NULL,NULL),(8,5,2,'01322',0,'2017-05-09 00:02:02','2017-05-09 00:02:02','2017-05-09 00:02:02',NULL,NULL,NULL,NULL,NULL,NULL),(9,5,3,'01312',0,'2017-05-09 00:02:02','2017-05-09 00:02:02','2017-05-09 00:02:02',NULL,NULL,NULL,NULL,NULL,NULL),(10,4,1,'10100',0,'2017-05-08 20:56:57','2017-05-08 20:56:57','2017-05-08 20:56:57',NULL,NULL,NULL,NULL,NULL,NULL),(11,4,2,'10200',0,'2017-05-08 20:56:57','2017-05-08 20:56:57','2017-05-08 20:56:57',NULL,NULL,NULL,NULL,NULL,NULL),(12,4,3,'10302',0,'2017-05-08 20:56:57','2017-05-08 20:56:57','2017-05-08 20:56:57',NULL,NULL,NULL,NULL,NULL,NULL),(13,4,1,'10100',0,'2017-05-09 21:09:59','2017-05-09 21:09:59','2017-05-09 21:09:59',NULL,NULL,NULL,NULL,NULL,NULL),(14,4,2,'10200',0,'2017-05-09 21:09:59','2017-05-09 21:09:59','2017-05-09 21:09:59',NULL,NULL,NULL,NULL,NULL,NULL),(15,4,3,'10302',0,'2017-05-09 21:09:59','2017-05-09 21:09:59','2017-05-09 21:09:59',NULL,NULL,NULL,NULL,NULL,NULL),(16,5,1,'01122',0,'2017-05-09 21:15:11','2017-05-09 21:15:11','2017-05-09 21:15:11',NULL,NULL,NULL,NULL,NULL,NULL),(17,5,2,'01322',0,'2017-05-09 21:15:11','2017-05-09 21:15:11','2017-05-09 21:15:11',NULL,NULL,NULL,NULL,NULL,NULL),(18,5,3,'01312',0,'2017-05-09 21:15:11','2017-05-09 21:15:11','2017-05-09 21:15:11',NULL,NULL,NULL,NULL,NULL,NULL),(19,4,1,'10100',0,'2017-05-10 04:10:43','2017-05-10 04:10:43','2017-05-10 04:10:43',NULL,NULL,NULL,NULL,NULL,NULL),(20,4,2,'10200',0,'2017-05-10 04:10:43','2017-05-10 04:10:43','2017-05-10 04:10:43',NULL,NULL,NULL,NULL,NULL,NULL),(21,4,3,'10302',0,'2017-05-10 04:10:43','2017-05-10 04:10:43','2017-05-10 04:10:43',NULL,NULL,NULL,NULL,NULL,NULL),(22,5,1,'01122',0,'2017-05-09 21:19:07','2017-05-09 21:19:07','2017-05-09 21:19:07',NULL,NULL,NULL,NULL,NULL,NULL),(23,5,2,'01322',0,'2017-05-09 21:19:07','2017-05-09 21:19:07','2017-05-09 21:19:07',NULL,NULL,NULL,NULL,NULL,NULL),(24,5,3,'01312',0,'2017-05-09 21:19:07','2017-05-09 21:19:07','2017-05-09 21:19:07',NULL,NULL,NULL,NULL,NULL,NULL),(25,5,4,'232323',0,'2017-05-09 21:19:07','2017-05-09 21:19:07','2017-05-09 21:19:07',NULL,NULL,NULL,NULL,NULL,NULL),(26,5,2,'01322',0,'2017-05-10 03:35:37','2017-05-10 03:35:37','2017-05-10 03:35:37',NULL,NULL,NULL,NULL,NULL,NULL),(27,5,3,'01312',0,'2017-05-10 03:35:37','2017-05-10 03:35:37','2017-05-10 03:35:37',NULL,NULL,NULL,NULL,NULL,NULL),(28,5,4,'232323',0,'2017-05-10 03:35:37','2017-05-10 03:35:37','2017-05-10 03:35:37',NULL,NULL,NULL,NULL,NULL,NULL),(29,5,1,'011222',1,'2017-05-10 03:35:37',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(30,5,2,'01322',1,'2017-05-10 03:35:37',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(31,5,3,'01312',1,'2017-05-10 03:35:37',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(32,5,4,'232323',1,'2017-05-10 03:35:37',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(33,4,1,'10100',1,'2017-05-10 04:10:43',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(34,4,2,'10200',1,'2017-05-10 04:10:43',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(35,4,3,'10302',1,'2017-05-10 04:10:43',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(36,4,4,'32311',1,'2017-05-10 04:10:43',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL);

/*Table structure for table `proveedor_color_producto` */

DROP TABLE IF EXISTS `proveedor_color_producto`;

CREATE TABLE `proveedor_color_producto` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
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
  `userid_deleted_at` int(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

/*Data for the table `proveedor_color_producto` */

insert  into `proveedor_color_producto`(`id`,`proveedor_id`,`producto_id`,`color_id`,`moneda_id`,`precio`,`created_at`,`updated_at`,`deleted_at`,`user_created_at`,`user_updated_at`,`user_deleted_at`,`userid_created_at`,`userid_updated_at`,`userid_deleted_at`) values (1,5,2,1,2,25.00,'2017-05-08 15:54:04','2017-05-08 15:54:04',NULL,'Rodolfo','Rodolfo',NULL,4,4,NULL),(2,3,3,1,1,40.00,'2017-05-05 18:40:12','2017-05-05 18:40:12',NULL,'Rodolfo',NULL,NULL,4,NULL,NULL),(3,5,3,3,1,25.00,'2017-05-08 16:09:51','2017-05-08 16:09:51',NULL,'Rodolfo',NULL,NULL,4,NULL,NULL),(4,5,2,4,1,20.00,'2017-05-09 21:15:39','2017-05-09 21:15:39',NULL,'Rodolfo',NULL,NULL,4,NULL,NULL),(5,5,3,1,1,10.00,'2017-05-10 03:36:24','2017-05-10 03:36:24',NULL,'Rodolfo',NULL,NULL,4,NULL,NULL),(6,4,3,1,1,10.00,'2017-05-10 04:11:19','2017-05-10 04:11:19',NULL,'Rodolfo',NULL,NULL,4,NULL,NULL);

/*Table structure for table `proveedor_despacho_tintoreria_deuda` */

DROP TABLE IF EXISTS `proveedor_despacho_tintoreria_deuda`;

CREATE TABLE `proveedor_despacho_tintoreria_deuda` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
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
  `userid_deleted_at` int(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `proveedor_despacho_tintoreria_deuda` */

/*Table structure for table `proveedor_tipo` */

DROP TABLE IF EXISTS `proveedor_tipo`;

CREATE TABLE `proveedor_tipo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `proveedor_id` int(11) DEFAULT NULL,
  `tipo_proveedor_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=55 DEFAULT CHARSET=latin1;

/*Data for the table `proveedor_tipo` */

insert  into `proveedor_tipo`(`id`,`proveedor_id`,`tipo_proveedor_id`) values (2,1,2),(3,1,3),(4,1,4),(5,2,5),(6,2,6),(24,3,3),(25,3,7),(47,5,2),(48,5,4),(49,5,5),(50,4,2),(51,4,4),(52,6,3),(53,6,5),(54,6,6);

/*Table structure for table `proveedores` */

DROP TABLE IF EXISTS `proveedores`;

CREATE TABLE `proveedores` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
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
  `userid_deleted_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `proveedores` */

insert  into `proveedores`(`id`,`nombre_comercial`,`razon_social`,`ruc`,`direccion`,`direccion_secundaria`,`email`,`telefono`,`ciudad`,`observaciones`,`created_at`,`updated_at`,`deleted_at`,`user_created_at`,`user_updated_at`,`user_deleted_at`,`userid_created_at`,`userid_updated_at`,`userid_deleted_at`) values (1,'HILOS S.A','HILOS S.A','35353535','SEBASTIAN BARRANCA 1860',NULL,'consultoriadbrot@gmail.com','956475200','0','','2017-04-23 01:34:02','2017-04-24 12:23:55','2017-04-24 12:23:55','Rodolfo',NULL,NULL,4,NULL,NULL),(2,'RODOLFO SAC','RODOLFO SAC','3456789','SJL-EL BOSQUE',NULL,'admin@corralito.com','99999999','0','','2017-04-23 06:31:24','2017-04-24 12:23:59','2017-04-24 12:23:59','Rodolfo',NULL,NULL,4,NULL,NULL),(3,'BURGA SAC','BURGA SAC','20511794553','MAZ J LT 17 A1 URB CANTO GRANDE S.J.L','','textilburga@hotmail.com','324-1224','0','','2017-04-24 01:12:52','2017-04-26 14:26:05',NULL,'Rodolfo','Rodolfo',NULL,4,4,NULL),(4,'FARIDE ALGODON DEL PERU S.R.L','FARIDE ALGODON DEL PERU S.R.L','20263804300','CALLE ICARO MZ KLT 6 URB LA CAMPIÑA CHORILLOS LIMA-LIMA','','','','0','','2017-04-24 12:31:59','2017-05-08 20:55:45',NULL,'Rodolfo','Rodolfo',NULL,4,4,NULL),(5,'JAS IMPORT & EXPORT S.R.L','JAS IMPORT & EXPORT S.R.L','20338048905','AV. LOS LAURELES MZ A LT 20-25B C.P SANTA MARIA DE HUACHIPA LURIGANCHO-LIMA-LIMA','AV. LOS LAURELES MZ A LT 20-25B C.P SANTA MARIA DE HUACHIPA LURIGANCHO-LIMA-LIMA','','','0','','2017-04-24 12:56:11','2017-04-26 14:29:30',NULL,'Rodolfo','Rodolfo',NULL,4,4,NULL),(6,'JJ TELA','JJ TELA','2113131','','','','','0','','2017-05-09 05:13:35','2017-05-09 05:13:35',NULL,'Rodolfo',NULL,NULL,4,NULL,NULL);

/*Table structure for table `recepcion_mp` */

DROP TABLE IF EXISTS `recepcion_mp`;

CREATE TABLE `recepcion_mp` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `fecha` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `codigo` int(11) DEFAULT NULL,
  `nro_guia` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `observaciones` text COLLATE utf8_unicode_ci,
  `proveedor_id` int(10) unsigned NOT NULL,
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `recepcion_mp_proveedor_id_foreign` (`proveedor_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `recepcion_mp` */

insert  into `recepcion_mp`(`id`,`fecha`,`codigo`,`nro_guia`,`observaciones`,`proveedor_id`,`created_by`,`updated_by`,`created_at`,`updated_at`,`deleted_at`) values (1,'2017-07-21 01:30:46',1,'GUIA113133',NULL,6,4,4,'2017-07-20 20:30:30','2017-07-20 20:30:46','2017-07-20 20:30:46'),(2,'2017-07-21 01:49:27',2,'GUIA10',NULL,6,4,4,'2017-07-20 20:39:56','2017-07-20 20:49:27','2017-07-20 20:49:27');

/*Table structure for table `recepcion_mp_detalles` */

DROP TABLE IF EXISTS `recepcion_mp_detalles`;

CREATE TABLE `recepcion_mp_detalles` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `fecha` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `nro_lote` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `titulo` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `peso_bruto` decimal(8,2) NOT NULL,
  `peso_tara` decimal(8,2) NOT NULL,
  `cantidad_paquetes` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `observaciones` text COLLATE utf8_unicode_ci,
  `insumo_id` int(10) unsigned DEFAULT NULL,
  `accesorio_id` int(10) unsigned DEFAULT NULL,
  `recepcion_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `recepcion_mp_detalles_insumo_id_foreign` (`insumo_id`),
  KEY `recepcion_mp_detalles_accesorio_id_foreign` (`accesorio_id`),
  KEY `recepcion_mp_detalles_recepcion_id_foreign` (`recepcion_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `recepcion_mp_detalles` */

insert  into `recepcion_mp_detalles`(`id`,`fecha`,`nro_lote`,`titulo`,`peso_bruto`,`peso_tara`,`cantidad_paquetes`,`observaciones`,`insumo_id`,`accesorio_id`,`recepcion_id`,`created_at`,`updated_at`) values (1,'2017-07-21 01:30:30','LOTE5','1',0.00,0.00,'61',NULL,1,NULL,1,'2017-07-20 20:30:30','2017-07-20 20:30:30'),(2,'2017-07-21 01:39:57','LOTE5','1',0.00,0.00,'15',NULL,1,NULL,2,'2017-07-20 20:39:57','2017-07-20 20:39:57');

/*Table structure for table `resumen_despacho_tintoreria` */

DROP TABLE IF EXISTS `resumen_despacho_tintoreria`;

CREATE TABLE `resumen_despacho_tintoreria` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
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
  `userid_deleted_at` int(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `resumen_despacho_tintoreria` */

/*Table structure for table `resumen_stock_materiaprima` */

DROP TABLE IF EXISTS `resumen_stock_materiaprima`;

CREATE TABLE `resumen_stock_materiaprima` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `lote` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `proveedor_id` int(11) NOT NULL,
  `titulo_id` int(10) DEFAULT '0',
  `cantidad` double NOT NULL,
  `estado` smallint(6) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `insumo_id` int(11) NOT NULL,
  `accesorio_id` int(11) NOT NULL,
  `peso_neto` double(8,2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `resumen_stock_materiaprima` */

/*Table structure for table `resumen_stock_telas` */

DROP TABLE IF EXISTS `resumen_stock_telas`;

CREATE TABLE `resumen_stock_telas` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
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
  `user_deleted_at` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `resumen_stock_telas` */

/*Table structure for table `role_user` */

DROP TABLE IF EXISTS `role_user`;

CREATE TABLE `role_user` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `role_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `role_user_user_id_foreign` (`user_id`),
  KEY `role_user_role_id_foreign` (`role_id`),
  CONSTRAINT `role_user_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE,
  CONSTRAINT `role_user_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `role_user` */

insert  into `role_user`(`id`,`user_id`,`role_id`) values (1,1,1),(2,2,2),(3,3,3),(4,4,1);

/*Table structure for table `roles` */

DROP TABLE IF EXISTS `roles`;

CREATE TABLE `roles` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `all` tinyint(1) NOT NULL DEFAULT '0',
  `sort` smallint(5) unsigned NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `roles_name_unique` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `roles` */

insert  into `roles`(`id`,`name`,`all`,`sort`,`created_at`,`updated_at`) values (1,'Administrator',1,1,'2017-04-07 05:08:32','2017-04-07 05:08:32'),(2,'Executive',0,2,'2017-04-07 05:08:32','2017-04-07 05:08:32'),(3,'User',0,3,'2017-04-07 05:08:32','2017-04-07 05:08:32');

/*Table structure for table `social_logins` */

DROP TABLE IF EXISTS `social_logins`;

CREATE TABLE `social_logins` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `provider` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `provider_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `avatar` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `social_logins_user_id_foreign` (`user_id`),
  CONSTRAINT `social_logins_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `social_logins` */

/*Table structure for table `tipo_proveedor` */

DROP TABLE IF EXISTS `tipo_proveedor`;

CREATE TABLE `tipo_proveedor` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
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
  `userid_deleted_at` smallint(6) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `tipo_proveedor` */

insert  into `tipo_proveedor`(`id`,`nombre`,`estado`,`created_at`,`updated_at`,`deleted_at`,`user_created_at`,`user_updated_at`,`user_deleted_at`,`userid_created_at`,`userid_updated_at`,`userid_deleted_at`) values (1,'Compra edit',1,'2017-04-16 02:54:15','2017-04-16 04:01:59','2017-04-16 04:01:59','Rodolfo','Rodolfo',NULL,4,4,NULL),(2,'Compra',1,'2017-04-16 04:17:59','2017-04-16 04:18:15',NULL,'Rodolfo','Rodolfo',NULL,4,4,NULL),(3,'Planeamiento',1,'2017-04-16 06:44:08','2017-04-16 06:44:08',NULL,'Rodolfo',NULL,NULL,4,NULL,NULL),(4,'Tintoreria',1,'2017-04-23 01:28:59','2017-04-23 01:28:59',NULL,'Rodolfo',NULL,NULL,4,NULL,NULL),(5,'Despacho de Terceros',1,'2017-04-23 06:23:27','2017-04-23 06:23:27',NULL,'Rodolfo',NULL,NULL,4,NULL,NULL),(6,'Recepcion Materia Prima',1,'2017-04-23 06:23:44','2017-04-23 06:23:44',NULL,'Rodolfo',NULL,NULL,4,NULL,NULL),(7,'BURGA SAC',1,'2017-04-24 01:10:47','2017-04-24 01:10:47',NULL,'Rodolfo',NULL,NULL,4,NULL,NULL);

/*Table structure for table `tipos_abonos` */

DROP TABLE IF EXISTS `tipos_abonos`;

CREATE TABLE `tipos_abonos` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `tipos_abonos` */

insert  into `tipos_abonos`(`id`,`nombre`,`created_at`,`updated_at`) values (1,'Concepto Abono 01',NULL,NULL),(2,'Concepto Abono 02',NULL,NULL),(3,'Concepto Abono 03',NULL,NULL),(4,'Concepto Abono 04',NULL,NULL);

/*Table structure for table `tipos_pagos` */

DROP TABLE IF EXISTS `tipos_pagos`;

CREATE TABLE `tipos_pagos` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `tipos_pagos` */

insert  into `tipos_pagos`(`id`,`nombre`,`created_at`,`updated_at`) values (1,'Credito',NULL,NULL),(2,'Contado',NULL,NULL);

/*Table structure for table `titulos` */

DROP TABLE IF EXISTS `titulos`;

CREATE TABLE `titulos` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `materia_prima` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `titulos` */

insert  into `titulos`(`id`,`nombre`,`materia_prima`,`created_at`,`updated_at`) values (1,'20/1','insumo','2017-04-23 00:08:18','2017-04-23 00:08:18'),(2,'30/1','insumo','2017-04-23 00:08:42','2017-04-23 00:08:42'),(4,'20-D','insumo','2017-04-24 13:07:02','2017-04-24 13:07:02'),(5,'010101','accesorio','2017-04-24 13:12:47','2017-04-24 13:12:47');

/*Table structure for table `users` */

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` tinyint(3) unsigned NOT NULL DEFAULT '1',
  `confirmation_code` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `confirmed` tinyint(1) NOT NULL DEFAULT '0',
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `users` */

insert  into `users`(`id`,`name`,`email`,`password`,`status`,`confirmation_code`,`confirmed`,`remember_token`,`created_at`,`updated_at`,`deleted_at`) values (1,'Franck Mercado','franckmercado@gmail.com','$2y$10$TM96BQfzwk.6K6x368Df2eljgMlldvaeNaRT43IGo59XBpN60O34S',1,'a2b31ed9ab1831a335fbfa5202080411',1,NULL,'2017-04-07 05:08:32','2017-04-07 05:08:32',NULL),(2,'Backend User','executive@executive.com','$2y$10$RwNTNlaW3YwkSzxjwlod/uNLTw5KRzDr.EzPLeba1Z.GKXMmUa6uO',1,'009b535bd1479946294c1cd1ea06707e',1,NULL,'2017-04-07 05:08:32','2017-04-07 05:08:32',NULL),(3,'Default User','user@user.com','$2y$10$.6sLbnQ2BtkSog8qiLKwjuewyH.x8oqxDpjXTSpn/x9stJ3ZqBWoG',1,'e509e7eafa59472ab03480be01391d94',1,NULL,'2017-04-07 05:08:32','2017-04-07 05:08:32',NULL),(4,'Rodolfo D\'Brot','consultoriadbrot@gmail.com','$2y$10$tArrwz042wFutts5lJegke9.WI3b/TXRG3mb4iYRTGcyHnyWPYyNW',1,'c45db330de617c77643f452078087617',1,'IGpMs4ywT9RdaB35cKvMlP6ZydKXJLiYSY5YvSAfZPrti32stjp3CFzux6KZ','2017-04-07 05:08:32','2017-08-15 12:28:18',NULL);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

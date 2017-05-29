-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Versión del servidor:         5.5.27-log - MySQL Community Server (GPL)
-- SO del servidor:              Win64
-- HeidiSQL Versión:             9.4.0.5142
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Volcando estructura de base de datos para textil
DROP DATABASE IF EXISTS `textil`;
CREATE DATABASE IF NOT EXISTS `textil` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `textil`;

-- Volcando estructura para tabla textil.almacen
DROP TABLE IF EXISTS `almacen`;
CREATE TABLE IF NOT EXISTS `almacen` (
  `IdAlmacen` int(11) NOT NULL AUTO_INCREMENT,
  `Descripcion` varchar(500) DEFAULT NULL,
  `Direccion` varchar(300) DEFAULT NULL,
  `IdUsuario` int(11) DEFAULT NULL,
  `FechaModificacion` datetime DEFAULT NULL,
  `Activo` bit(1) DEFAULT b'1',
  PRIMARY KEY (`IdAlmacen`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla textil.almacen: ~0 rows (aproximadamente)
DELETE FROM `almacen`;
/*!40000 ALTER TABLE `almacen` DISABLE KEYS */;
/*!40000 ALTER TABLE `almacen` ENABLE KEYS */;

-- Volcando estructura para tabla textil.articulo
DROP TABLE IF EXISTS `articulo`;
CREATE TABLE IF NOT EXISTS `articulo` (
  `IdArticulo` int(11) NOT NULL AUTO_INCREMENT,
  `Descripcion` varchar(300) DEFAULT NULL,
  `IdFamilia` int(11) DEFAULT NULL,
  `IdMedida` int(11) DEFAULT NULL,
  `IdMarca` int(11) DEFAULT NULL,
  `IdTipoArticulo` int(11) DEFAULT NULL,
  `FechaModificacion` datetime DEFAULT NULL,
  `IdUsuario` int(11) DEFAULT NULL,
  `Codigo` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`IdArticulo`),
  KEY `IdFamilia` (`IdFamilia`),
  KEY `IdMedida` (`IdMedida`),
  KEY `IdMarca` (`IdMarca`),
  KEY `IdTipoArticulo` (`IdTipoArticulo`),
  CONSTRAINT `articulo_familia_fk` FOREIGN KEY (`IdFamilia`) REFERENCES `familia` (`IdFamilia`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `articulo_marca_fk` FOREIGN KEY (`IdMarca`) REFERENCES `marca` (`IdMarca`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `articulo_medida_fk` FOREIGN KEY (`IdMedida`) REFERENCES `medida` (`IdMedida`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `articulo_tipoarticulo_fk` FOREIGN KEY (`IdTipoArticulo`) REFERENCES `tipoarticulo` (`IdTipoArticulo`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla textil.articulo: ~0 rows (aproximadamente)
DELETE FROM `articulo`;
/*!40000 ALTER TABLE `articulo` DISABLE KEYS */;
/*!40000 ALTER TABLE `articulo` ENABLE KEYS */;

-- Volcando estructura para tabla textil.cliente
DROP TABLE IF EXISTS `cliente`;
CREATE TABLE IF NOT EXISTS `cliente` (
  `IdCliente` int(11) NOT NULL AUTO_INCREMENT,
  `Nit` varchar(15) DEFAULT NULL,
  `RazonSocial` varchar(300) DEFAULT NULL,
  `Direccion` varchar(300) DEFAULT NULL,
  `Telefono` varchar(15) DEFAULT NULL,
  `CorreoElectronico` varchar(100) DEFAULT NULL,
  `Foto` longblob,
  `FechaModificacion` datetime DEFAULT NULL,
  `IdUsuario` int(11) DEFAULT NULL,
  `Activo` bit(1) DEFAULT b'1',
  PRIMARY KEY (`IdCliente`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla textil.cliente: ~0 rows (aproximadamente)
DELETE FROM `cliente`;
/*!40000 ALTER TABLE `cliente` DISABLE KEYS */;
/*!40000 ALTER TABLE `cliente` ENABLE KEYS */;

-- Volcando estructura para tabla textil.compra
DROP TABLE IF EXISTS `compra`;
CREATE TABLE IF NOT EXISTS `compra` (
  `IdCompra` int(11) NOT NULL AUTO_INCREMENT,
  `FechaCompra` date DEFAULT NULL,
  `IdProveedor` int(11) DEFAULT NULL,
  `IdTipoPago` int(11) DEFAULT NULL,
  `NumeroComprobante` int(11) DEFAULT NULL,
  `Observaciones` varchar(500) DEFAULT NULL,
  `IdUsuario` int(11) DEFAULT NULL,
  `Total` decimal(7,2) DEFAULT NULL,
  `Anulada` bit(1) DEFAULT b'0',
  `Eliminada` bit(1) DEFAULT b'0',
  `FechaRegistro` datetime DEFAULT NULL,
  `IdAlmacen` int(11) DEFAULT NULL,
  `Descuento` decimal(7,2) DEFAULT NULL,
  PRIMARY KEY (`IdCompra`),
  KEY `IdProveedor` (`IdProveedor`),
  KEY `IdTipoPago` (`IdTipoPago`),
  KEY `IdAlmacen` (`IdAlmacen`),
  CONSTRAINT `compra_almacen_fk` FOREIGN KEY (`IdAlmacen`) REFERENCES `almacen` (`IdAlmacen`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `compra_proveedor_fk` FOREIGN KEY (`IdProveedor`) REFERENCES `proveedor` (`IdProveedor`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla textil.compra: ~0 rows (aproximadamente)
DELETE FROM `compra`;
/*!40000 ALTER TABLE `compra` DISABLE KEYS */;
/*!40000 ALTER TABLE `compra` ENABLE KEYS */;

-- Volcando estructura para tabla textil.cotizacion
DROP TABLE IF EXISTS `cotizacion`;
CREATE TABLE IF NOT EXISTS `cotizacion` (
  `IdCotizacion` int(11) NOT NULL AUTO_INCREMENT,
  `Fecha` date DEFAULT NULL,
  `FechaRegistro` datetime DEFAULT NULL,
  `Observacion` varchar(500) DEFAULT NULL,
  `Anulado` bit(1) DEFAULT b'0',
  `IdUsuario` int(11) DEFAULT NULL,
  `IdCliente` int(11) DEFAULT NULL,
  `Eliminado` bit(1) DEFAULT b'0',
  `FechaValidez` date DEFAULT NULL,
  `Descuento` decimal(7,2) DEFAULT NULL,
  PRIMARY KEY (`IdCotizacion`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla textil.cotizacion: ~0 rows (aproximadamente)
DELETE FROM `cotizacion`;
/*!40000 ALTER TABLE `cotizacion` DISABLE KEYS */;
/*!40000 ALTER TABLE `cotizacion` ENABLE KEYS */;

-- Volcando estructura para tabla textil.detallecompra
DROP TABLE IF EXISTS `detallecompra`;
CREATE TABLE IF NOT EXISTS `detallecompra` (
  `IdDetalleCompra` int(11) NOT NULL AUTO_INCREMENT,
  `IdCompra` int(11) DEFAULT NULL,
  `IdArticulo` int(11) DEFAULT NULL,
  `Cantidad` float(7,2) DEFAULT NULL,
  `CostoUnitario` decimal(7,2) DEFAULT NULL,
  `CostoTotal` decimal(7,2) DEFAULT NULL,
  `Eliminado` bit(1) DEFAULT b'0',
  `IdUsuario` int(11) DEFAULT NULL,
  PRIMARY KEY (`IdDetalleCompra`),
  KEY `detallecompra_compra_fk` (`IdCompra`),
  KEY `FK_detallecompra_articulo_IdArticulo` (`IdArticulo`),
  CONSTRAINT `detallecompra_compra_fk` FOREIGN KEY (`IdCompra`) REFERENCES `compra` (`IdCompra`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_detallecompra_articulo_IdArticulo` FOREIGN KEY (`IdArticulo`) REFERENCES `articulo` (`IdArticulo`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla textil.detallecompra: ~0 rows (aproximadamente)
DELETE FROM `detallecompra`;
/*!40000 ALTER TABLE `detallecompra` DISABLE KEYS */;
/*!40000 ALTER TABLE `detallecompra` ENABLE KEYS */;

-- Volcando estructura para tabla textil.detallecotizacion
DROP TABLE IF EXISTS `detallecotizacion`;
CREATE TABLE IF NOT EXISTS `detallecotizacion` (
  `IdDetalleCotizacion` int(11) NOT NULL AUTO_INCREMENT,
  `IdCotizacion` int(11) DEFAULT NULL,
  `IdTipoVenta` int(11) DEFAULT NULL,
  `IdArticulo` int(11) DEFAULT NULL,
  `IdProducto` int(11) DEFAULT NULL,
  `Cantidad` float(7,2) DEFAULT NULL,
  `CostoTotal` decimal(7,2) DEFAULT NULL,
  `IdUsuario` int(11) DEFAULT NULL,
  `Eliminado` bit(1) DEFAULT b'0',
  PRIMARY KEY (`IdDetalleCotizacion`),
  KEY `FK_detallecotizacion_cotizacion_IdCotizacion` (`IdCotizacion`),
  KEY `FK_detallecotizacion_tipoventa_IdTipoVenta` (`IdTipoVenta`),
  KEY `FK_detallecotizacion_articulo_IdArticulo` (`IdArticulo`),
  KEY `FK_detallecotizacion_producto_IdProducto` (`IdProducto`),
  CONSTRAINT `FK_detallecotizacion_articulo_IdArticulo` FOREIGN KEY (`IdArticulo`) REFERENCES `articulo` (`IdArticulo`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_detallecotizacion_cotizacion_IdCotizacion` FOREIGN KEY (`IdCotizacion`) REFERENCES `cotizacion` (`IdCotizacion`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_detallecotizacion_producto_IdProducto` FOREIGN KEY (`IdProducto`) REFERENCES `producto` (`IdProducto`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_detallecotizacion_tipoventa_IdTipoVenta` FOREIGN KEY (`IdTipoVenta`) REFERENCES `tipoventa` (`IdTipoVenta`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla textil.detallecotizacion: ~0 rows (aproximadamente)
DELETE FROM `detallecotizacion`;
/*!40000 ALTER TABLE `detallecotizacion` DISABLE KEYS */;
/*!40000 ALTER TABLE `detallecotizacion` ENABLE KEYS */;

-- Volcando estructura para tabla textil.detalleproducto
DROP TABLE IF EXISTS `detalleproducto`;
CREATE TABLE IF NOT EXISTS `detalleproducto` (
  `IdDetalleProducto` int(11) NOT NULL AUTO_INCREMENT,
  `IdProducto` int(11) DEFAULT NULL,
  `IdArticulo` int(11) DEFAULT NULL,
  `Cantidad` float(7,2) DEFAULT NULL,
  `IdMedida` int(11) DEFAULT NULL,
  `Eliminado` bit(1) DEFAULT b'0',
  `IdUsuario` int(11) DEFAULT NULL,
  PRIMARY KEY (`IdDetalleProducto`),
  KEY `detalleproducto_producto_fk` (`IdProducto`),
  KEY `detalleproducto_articulo_fk` (`IdArticulo`),
  KEY `detalleproducto_medida_fk` (`IdMedida`),
  CONSTRAINT `detalleproducto_articulo_fk` FOREIGN KEY (`IdArticulo`) REFERENCES `articulo` (`IdArticulo`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `detalleproducto_medida_fk` FOREIGN KEY (`IdMedida`) REFERENCES `medida` (`IdMedida`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `detalleproducto_producto_fk` FOREIGN KEY (`IdProducto`) REFERENCES `producto` (`IdProducto`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla textil.detalleproducto: ~0 rows (aproximadamente)
DELETE FROM `detalleproducto`;
/*!40000 ALTER TABLE `detalleproducto` DISABLE KEYS */;
/*!40000 ALTER TABLE `detalleproducto` ENABLE KEYS */;

-- Volcando estructura para tabla textil.detalleventa
DROP TABLE IF EXISTS `detalleventa`;
CREATE TABLE IF NOT EXISTS `detalleventa` (
  `IdDetalleVenta` int(11) NOT NULL AUTO_INCREMENT,
  `IdVenta` int(11) DEFAULT NULL,
  `IdTipoVenta` int(11) DEFAULT NULL,
  `IdArticulo` int(11) DEFAULT NULL,
  `IdProducto` int(11) DEFAULT NULL,
  `Cantidad` float(7,2) DEFAULT NULL,
  `CostoTotal` decimal(7,2) DEFAULT NULL,
  `IdTipoPago` int(11) DEFAULT NULL,
  `IdUsuario` int(11) DEFAULT NULL,
  `Eliminado` bit(1) DEFAULT b'0',
  PRIMARY KEY (`IdDetalleVenta`),
  KEY `detalleventa_tipoventa_fk` (`IdTipoVenta`),
  KEY `detalleventa_articulo_fk` (`IdArticulo`),
  KEY `detalleventa_producto_fk` (`IdProducto`),
  KEY `FK_detalleventa_venta_IdVenta` (`IdVenta`),
  CONSTRAINT `detalleventa_articulo_fk` FOREIGN KEY (`IdArticulo`) REFERENCES `articulo` (`IdArticulo`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `detalleventa_producto_fk` FOREIGN KEY (`IdProducto`) REFERENCES `producto` (`IdProducto`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `detalleventa_tipoventa_fk` FOREIGN KEY (`IdTipoVenta`) REFERENCES `tipoventa` (`IdTipoVenta`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `detalleventa_venta_fk` FOREIGN KEY (`IdVenta`) REFERENCES `venta` (`IdVenta`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla textil.detalleventa: ~0 rows (aproximadamente)
DELETE FROM `detalleventa`;
/*!40000 ALTER TABLE `detalleventa` DISABLE KEYS */;
/*!40000 ALTER TABLE `detalleventa` ENABLE KEYS */;

-- Volcando estructura para tabla textil.egreso
DROP TABLE IF EXISTS `egreso`;
CREATE TABLE IF NOT EXISTS `egreso` (
  `IdEgreso` int(11) NOT NULL AUTO_INCREMENT,
  `IdArticulo` int(11) DEFAULT NULL,
  `IdAlmacen` int(11) DEFAULT NULL,
  `Cantidad` float(7,2) DEFAULT NULL,
  `Observacion` varchar(500) DEFAULT NULL,
  `FechaEgreso` datetime DEFAULT NULL,
  `Eliminado` bit(1) DEFAULT b'0',
  `IdUsuario` int(11) DEFAULT NULL,
  PRIMARY KEY (`IdEgreso`),
  KEY `egreso_articulo_fk` (`IdArticulo`),
  KEY `egreso_almacen_fk` (`IdAlmacen`),
  CONSTRAINT `egreso_almacen_fk` FOREIGN KEY (`IdAlmacen`) REFERENCES `almacen` (`IdAlmacen`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `egreso_articulo_fk` FOREIGN KEY (`IdArticulo`) REFERENCES `articulo` (`IdArticulo`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='salidas de articulos de almacen';

-- Volcando datos para la tabla textil.egreso: ~0 rows (aproximadamente)
DELETE FROM `egreso`;
/*!40000 ALTER TABLE `egreso` DISABLE KEYS */;
/*!40000 ALTER TABLE `egreso` ENABLE KEYS */;

-- Volcando estructura para tabla textil.empleado
DROP TABLE IF EXISTS `empleado`;
CREATE TABLE IF NOT EXISTS `empleado` (
  `IdEmpleado` int(11) NOT NULL AUTO_INCREMENT,
  `Ci` varchar(15) DEFAULT NULL,
  `Nombre` varchar(300) DEFAULT NULL,
  `Direccion` varchar(300) DEFAULT NULL,
  `Telefono` varchar(15) DEFAULT NULL,
  `CorreoElectronico` varchar(200) DEFAULT NULL,
  `FechaIngreso` date DEFAULT NULL,
  `FechaRegistro` datetime DEFAULT NULL,
  `Cargo` varchar(100) DEFAULT NULL,
  `Foto` longblob,
  `FechaModificacion` datetime DEFAULT NULL,
  `Activo` bit(1) DEFAULT NULL,
  PRIMARY KEY (`IdEmpleado`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla textil.empleado: ~0 rows (aproximadamente)
DELETE FROM `empleado`;
/*!40000 ALTER TABLE `empleado` DISABLE KEYS */;
/*!40000 ALTER TABLE `empleado` ENABLE KEYS */;

-- Volcando estructura para tabla textil.estadovisita
DROP TABLE IF EXISTS `estadovisita`;
CREATE TABLE IF NOT EXISTS `estadovisita` (
  `IdEstadoVisita` int(11) NOT NULL AUTO_INCREMENT,
  `Descripcion` varchar(30) DEFAULT NULL,
  `Activo` bit(1) DEFAULT b'1',
  PRIMARY KEY (`IdEstadoVisita`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla textil.estadovisita: ~0 rows (aproximadamente)
DELETE FROM `estadovisita`;
/*!40000 ALTER TABLE `estadovisita` DISABLE KEYS */;
/*!40000 ALTER TABLE `estadovisita` ENABLE KEYS */;

-- Volcando estructura para tabla textil.existencia
DROP TABLE IF EXISTS `existencia`;
CREATE TABLE IF NOT EXISTS `existencia` (
  `IdExistencia` int(11) NOT NULL AUTO_INCREMENT,
  `IdArticulo` int(11) DEFAULT NULL,
  `IdAlmacen` int(11) DEFAULT NULL,
  `CantidadExistente` float(7,2) DEFAULT NULL,
  PRIMARY KEY (`IdExistencia`),
  KEY `existencia_articulo_fk` (`IdArticulo`),
  KEY `existencia_almacen_fk` (`IdAlmacen`),
  CONSTRAINT `existencia_almacen_fk` FOREIGN KEY (`IdAlmacen`) REFERENCES `almacen` (`IdAlmacen`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `existencia_articulo_fk` FOREIGN KEY (`IdArticulo`) REFERENCES `articulo` (`IdArticulo`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla textil.existencia: ~0 rows (aproximadamente)
DELETE FROM `existencia`;
/*!40000 ALTER TABLE `existencia` DISABLE KEYS */;
/*!40000 ALTER TABLE `existencia` ENABLE KEYS */;

-- Volcando estructura para tabla textil.familia
DROP TABLE IF EXISTS `familia`;
CREATE TABLE IF NOT EXISTS `familia` (
  `IdFamilia` int(11) NOT NULL AUTO_INCREMENT,
  `Descripcion` varchar(100) DEFAULT NULL,
  `FechaModificacion` datetime DEFAULT NULL,
  `IdUsuario` int(11) DEFAULT NULL,
  `Activo` bit(1) DEFAULT b'1',
  PRIMARY KEY (`IdFamilia`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla textil.familia: ~0 rows (aproximadamente)
DELETE FROM `familia`;
/*!40000 ALTER TABLE `familia` DISABLE KEYS */;
/*!40000 ALTER TABLE `familia` ENABLE KEYS */;

-- Volcando estructura para tabla textil.ingreso
DROP TABLE IF EXISTS `ingreso`;
CREATE TABLE IF NOT EXISTS `ingreso` (
  `IdIngreso` int(11) NOT NULL AUTO_INCREMENT,
  `IdArticulo` int(11) DEFAULT NULL,
  `IdAlmacen` int(11) DEFAULT NULL,
  `Cantidad` float(7,2) DEFAULT NULL,
  `Observacion` varchar(500) DEFAULT NULL,
  `FechaIngreso` datetime DEFAULT NULL,
  `Eliminado` bit(1) DEFAULT b'0',
  `IdUsuario` int(11) DEFAULT NULL,
  PRIMARY KEY (`IdIngreso`),
  KEY `ingreso_articulo_fk` (`IdArticulo`),
  KEY `ingreso_almacen_fk` (`IdAlmacen`),
  KEY `ingreso_usuario_fk` (`IdUsuario`),
  CONSTRAINT `ingreso_almacen_fk` FOREIGN KEY (`IdAlmacen`) REFERENCES `almacen` (`IdAlmacen`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `ingreso_articulo_fk` FOREIGN KEY (`IdArticulo`) REFERENCES `articulo` (`IdArticulo`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `ingreso_usuario_fk` FOREIGN KEY (`IdUsuario`) REFERENCES `usuario` (`IdUsuario`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='ingreso de articulos a almacen';

-- Volcando datos para la tabla textil.ingreso: ~0 rows (aproximadamente)
DELETE FROM `ingreso`;
/*!40000 ALTER TABLE `ingreso` DISABLE KEYS */;
/*!40000 ALTER TABLE `ingreso` ENABLE KEYS */;

-- Volcando estructura para tabla textil.marca
DROP TABLE IF EXISTS `marca`;
CREATE TABLE IF NOT EXISTS `marca` (
  `IdMarca` int(11) NOT NULL AUTO_INCREMENT,
  `Descripcion` varchar(100) DEFAULT NULL,
  `FechaModificacion` datetime DEFAULT NULL,
  `IdUsuario` int(11) DEFAULT NULL,
  `Activo` bit(1) DEFAULT b'1',
  PRIMARY KEY (`IdMarca`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla textil.marca: ~0 rows (aproximadamente)
DELETE FROM `marca`;
/*!40000 ALTER TABLE `marca` DISABLE KEYS */;
/*!40000 ALTER TABLE `marca` ENABLE KEYS */;

-- Volcando estructura para tabla textil.medida
DROP TABLE IF EXISTS `medida`;
CREATE TABLE IF NOT EXISTS `medida` (
  `IdMedida` int(11) NOT NULL AUTO_INCREMENT,
  `Descripcion` varchar(50) DEFAULT NULL,
  `FechaModificacion` datetime DEFAULT NULL,
  `IdUsuario` int(11) DEFAULT NULL,
  `Activo` bit(1) DEFAULT b'1',
  PRIMARY KEY (`IdMedida`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla textil.medida: ~0 rows (aproximadamente)
DELETE FROM `medida`;
/*!40000 ALTER TABLE `medida` DISABLE KEYS */;
/*!40000 ALTER TABLE `medida` ENABLE KEYS */;

-- Volcando estructura para tabla textil.producto
DROP TABLE IF EXISTS `producto`;
CREATE TABLE IF NOT EXISTS `producto` (
  `IdProducto` int(11) NOT NULL DEFAULT '0',
  `Descripcion` varchar(500) DEFAULT NULL,
  `Imagen` longblob,
  `Activo` bit(1) DEFAULT b'1',
  `FechaRegistro` datetime DEFAULT NULL,
  `IdUsuario` int(11) DEFAULT NULL,
  PRIMARY KEY (`IdProducto`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla textil.producto: ~0 rows (aproximadamente)
DELETE FROM `producto`;
/*!40000 ALTER TABLE `producto` DISABLE KEYS */;
/*!40000 ALTER TABLE `producto` ENABLE KEYS */;

-- Volcando estructura para tabla textil.proveedor
DROP TABLE IF EXISTS `proveedor`;
CREATE TABLE IF NOT EXISTS `proveedor` (
  `IdProveedor` int(11) NOT NULL AUTO_INCREMENT,
  `Nit` varchar(20) DEFAULT NULL,
  `RazonSocial` varchar(500) DEFAULT NULL,
  `Direccion` varchar(300) DEFAULT NULL,
  `Telefono` varchar(15) DEFAULT NULL,
  `CorreoElectronico` varchar(300) DEFAULT NULL,
  `Foto` longblob,
  `FechaModificacion` datetime DEFAULT NULL,
  `Activo` bit(1) DEFAULT b'1',
  PRIMARY KEY (`IdProveedor`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla textil.proveedor: ~0 rows (aproximadamente)
DELETE FROM `proveedor`;
/*!40000 ALTER TABLE `proveedor` DISABLE KEYS */;
/*!40000 ALTER TABLE `proveedor` ENABLE KEYS */;

-- Volcando estructura para tabla textil.rol
DROP TABLE IF EXISTS `rol`;
CREATE TABLE IF NOT EXISTS `rol` (
  `IdRol` int(11) NOT NULL AUTO_INCREMENT,
  `Descripcion` varchar(50) DEFAULT NULL,
  `IdUsuario` int(11) DEFAULT NULL,
  `Activo` bit(1) DEFAULT b'1',
  PRIMARY KEY (`IdRol`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla textil.rol: ~0 rows (aproximadamente)
DELETE FROM `rol`;
/*!40000 ALTER TABLE `rol` DISABLE KEYS */;
/*!40000 ALTER TABLE `rol` ENABLE KEYS */;

-- Volcando estructura para tabla textil.tipoarticulo
DROP TABLE IF EXISTS `tipoarticulo`;
CREATE TABLE IF NOT EXISTS `tipoarticulo` (
  `IdTipoArticulo` int(11) NOT NULL AUTO_INCREMENT,
  `Descripcion` varchar(50) DEFAULT NULL,
  `IdUsuario` int(11) DEFAULT NULL,
  `Activo` bit(1) DEFAULT b'1',
  PRIMARY KEY (`IdTipoArticulo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla textil.tipoarticulo: ~0 rows (aproximadamente)
DELETE FROM `tipoarticulo`;
/*!40000 ALTER TABLE `tipoarticulo` DISABLE KEYS */;
/*!40000 ALTER TABLE `tipoarticulo` ENABLE KEYS */;

-- Volcando estructura para tabla textil.tipopago
DROP TABLE IF EXISTS `tipopago`;
CREATE TABLE IF NOT EXISTS `tipopago` (
  `IdTipoPago` int(11) NOT NULL AUTO_INCREMENT,
  `Descripcion` varchar(100) DEFAULT NULL,
  `Activo` bit(1) DEFAULT b'1',
  `IdUsuario` int(11) DEFAULT NULL,
  PRIMARY KEY (`IdTipoPago`)
) ENGINE=MEMORY DEFAULT CHARSET=utf8 COMMENT='Clasificaci?n de pago, en efectivo por bando, u otros';

-- Volcando datos para la tabla textil.tipopago: 0 rows
DELETE FROM `tipopago`;
/*!40000 ALTER TABLE `tipopago` DISABLE KEYS */;
/*!40000 ALTER TABLE `tipopago` ENABLE KEYS */;

-- Volcando estructura para tabla textil.tipoventa
DROP TABLE IF EXISTS `tipoventa`;
CREATE TABLE IF NOT EXISTS `tipoventa` (
  `IdTipoVenta` int(11) NOT NULL AUTO_INCREMENT,
  `Descripcion` varchar(100) DEFAULT NULL,
  `Activo` bit(1) DEFAULT b'1',
  `IdUsuario` int(11) DEFAULT NULL,
  PRIMARY KEY (`IdTipoVenta`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla textil.tipoventa: ~0 rows (aproximadamente)
DELETE FROM `tipoventa`;
/*!40000 ALTER TABLE `tipoventa` DISABLE KEYS */;
/*!40000 ALTER TABLE `tipoventa` ENABLE KEYS */;

-- Volcando estructura para tabla textil.usuario
DROP TABLE IF EXISTS `usuario`;
CREATE TABLE IF NOT EXISTS `usuario` (
  `IdUsuario` int(11) NOT NULL AUTO_INCREMENT,
  `NombreUsuario` varchar(300) DEFAULT NULL,
  `Contrasenia` varchar(30) DEFAULT NULL,
  `IdEmpleado` int(11) DEFAULT NULL,
  `IdRol` int(11) DEFAULT NULL,
  `FechaModificacion` datetime DEFAULT NULL,
  `Activo` bit(1) DEFAULT b'1',
  `Eliminado` bit(1) DEFAULT b'1',
  PRIMARY KEY (`IdUsuario`),
  KEY `usuario_empleado_fk` (`IdEmpleado`),
  KEY `usuario_rol_fk` (`IdRol`),
  CONSTRAINT `usuario_empleado_fk` FOREIGN KEY (`IdEmpleado`) REFERENCES `empleado` (`IdEmpleado`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `usuario_rol_fk` FOREIGN KEY (`IdRol`) REFERENCES `rol` (`IdRol`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla textil.usuario: ~0 rows (aproximadamente)
DELETE FROM `usuario`;
/*!40000 ALTER TABLE `usuario` DISABLE KEYS */;
/*!40000 ALTER TABLE `usuario` ENABLE KEYS */;

-- Volcando estructura para tabla textil.venta
DROP TABLE IF EXISTS `venta`;
CREATE TABLE IF NOT EXISTS `venta` (
  `IdVenta` int(11) NOT NULL AUTO_INCREMENT,
  `Fecha` date DEFAULT NULL,
  `FechaRegistro` datetime DEFAULT NULL,
  `Observacion` varchar(500) DEFAULT NULL,
  `Anulado` bit(1) DEFAULT b'0',
  `IdUsuario` int(11) DEFAULT NULL,
  `IdCliente` int(11) DEFAULT NULL,
  `Eliminado` bit(1) DEFAULT b'0',
  PRIMARY KEY (`IdVenta`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla textil.venta: ~0 rows (aproximadamente)
DELETE FROM `venta`;
/*!40000 ALTER TABLE `venta` DISABLE KEYS */;
/*!40000 ALTER TABLE `venta` ENABLE KEYS */;

-- Volcando estructura para tabla textil.visita
DROP TABLE IF EXISTS `visita`;
CREATE TABLE IF NOT EXISTS `visita` (
  `IdVisita` int(11) NOT NULL AUTO_INCREMENT,
  `IdCliente` int(11) DEFAULT NULL,
  `FechaVisitar` date DEFAULT NULL,
  `FechaVisitada` date DEFAULT NULL,
  `Direccion` varchar(300) DEFAULT NULL,
  `Telefono` varchar(15) DEFAULT NULL,
  `IdUsuario` int(11) DEFAULT NULL,
  `FechaModificacion` datetime DEFAULT NULL,
  `IdEstadoVisita` int(11) DEFAULT NULL,
  PRIMARY KEY (`IdVisita`),
  KEY `FK_visita_cliente_IdCliente` (`IdCliente`),
  KEY `FK_visita_estadovisita_IdEstadoVisita` (`IdEstadoVisita`),
  CONSTRAINT `FK_visita_cliente_IdCliente` FOREIGN KEY (`IdCliente`) REFERENCES `cliente` (`IdCliente`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_visita_estadovisita_IdEstadoVisita` FOREIGN KEY (`IdEstadoVisita`) REFERENCES `estadovisita` (`IdEstadoVisita`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla textil.visita: ~0 rows (aproximadamente)
DELETE FROM `visita`;
/*!40000 ALTER TABLE `visita` DISABLE KEYS */;
/*!40000 ALTER TABLE `visita` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;

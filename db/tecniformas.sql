-- phpMyAdmin SQL Dump
-- version 4.8.0.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 29-11-2018 a las 22:46:48
-- Versión del servidor: 10.1.32-MariaDB
-- Versión de PHP: 7.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `tecniformas`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `articulo`
--

CREATE TABLE `articulo` (
  `idarticulo` int(11) NOT NULL,
  `codigo` varchar(50) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `descripcion` varchar(250) NOT NULL,
  `lineas` int(11) NOT NULL,
  `condicion` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `articulo`
--

INSERT INTO `articulo` (`idarticulo`, `codigo`, `nombre`, `descripcion`, `lineas`, `condicion`) VALUES
(18, '01', 'canecas', 'canecas ambientales', 4, 1),
(19, '02', 'resbaladilla', 'resbaladilla para niños de 6 años', 5, 1),
(20, '03', 'canecas prueba 2', 'pruebas 1', 6, 1),
(21, '04', 'prueba 2', 'prueba 2', 7, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ciudad`
--

CREATE TABLE `ciudad` (
  `idciudad` int(11) NOT NULL,
  `nombre` varchar(45) NOT NULL,
  `estado` tinyint(4) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `ciudad`
--

INSERT INTO `ciudad` (`idciudad`, `nombre`, `estado`) VALUES
(1, 'Bogota', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cliente`
--

CREATE TABLE `cliente` (
  `idcliente` int(11) NOT NULL,
  `razon_social` varchar(100) NOT NULL,
  `identificacion` varchar(45) DEFAULT NULL,
  `tipo` varchar(15) NOT NULL COMMENT 'nuevo o antiguo',
  `uso` varchar(15) NOT NULL COMMENT 'Residencial o comercial',
  `mercado` varchar(15) NOT NULL COMMENT 'Espontaneo, google, referido, e-mailing, contactado',
  `obs` text,
  `estado` tinyint(4) DEFAULT '1',
  `empresa` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `cliente`
--

INSERT INTO `cliente` (`idcliente`, `razon_social`, `identificacion`, `tipo`, `uso`, `mercado`, `obs`, `estado`, `empresa`) VALUES
(50, 'SIA', '79524654-3', 'Antiguo', 'Comercial', 'Espontaneo', '', 1, 1),
(51, 'Computos s.a', '12345678', 'Nuevo', 'Comercial', 'Espontaneo', 'computadores a la orden', 1, 1),
(52, 'Edwin prieto', '80833673', 'Nuevo', 'Residencial', 'Espontaneo', 'computadores a la orden', 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_p`
--

CREATE TABLE `detalle_p` (
  `iddetalle` int(11) NOT NULL,
  `idnombre` int(11) NOT NULL,
  `cliente` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `fecha_entrega` date NOT NULL,
  `peso` decimal(10,0) NOT NULL,
  `color1` varchar(50) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `valor` float NOT NULL,
  `prioridad` int(11) NOT NULL,
  `observacion` varchar(250) NOT NULL,
  `grupo` int(11) NOT NULL,
  `encargado` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_produccion`
--

CREATE TABLE `detalle_produccion` (
  `iddetalle` int(11) NOT NULL,
  `idorden` int(11) NOT NULL,
  `idnombre` int(11) NOT NULL,
  `peso` decimal(10,2) NOT NULL,
  `color` varchar(50) DEFAULT NULL,
  `cantidad` int(11) NOT NULL,
  `idprioridad` int(11) DEFAULT NULL,
  `observacion` varchar(250) DEFAULT NULL,
  `estado` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `detalle_produccion`
--

INSERT INTO `detalle_produccion` (`iddetalle`, `idorden`, `idnombre`, `peso`, `color`, `cantidad`, `idprioridad`, `observacion`, `estado`) VALUES
(9, 6, 18, '12.00', 'amarillo', 100, 2, 'canecas ambientales', 2),
(10, 6, 19, '13.00', 'rojo', 200, 2, 'parques naturales kennedy', 2),
(12, 7, 20, '12.00', 'azul', 100, 3, 'buen estado', 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empresa`
--

CREATE TABLE `empresa` (
  `idempresa` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `tipo_documento` varchar(15) NOT NULL,
  `num_documento` varchar(25) NOT NULL,
  `regimen` varchar(45) NOT NULL,
  `iva` decimal(4,2) NOT NULL COMMENT 'dejar 0 para regimen simplificado',
  `direccion` varchar(150) DEFAULT NULL,
  `telefono` varchar(45) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `empresa`
--

INSERT INTO `empresa` (`idempresa`, `nombre`, `tipo_documento`, `num_documento`, `regimen`, `iva`, `direccion`, `telefono`, `email`) VALUES
(1, 'LA AREPA', 'NIT', '90000000', 'SIMPLIFICADO', '0.00', 'CALLE 26 SUR', '4561237', 'CORREO@CORREO.COM');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estados`
--

CREATE TABLE `estados` (
  `idestado` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `condicion` tinyint(4) NOT NULL,
  `ver_fabrica` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `estados`
--

INSERT INTO `estados` (`idestado`, `nombre`, `condicion`, `ver_fabrica`) VALUES
(1, 'Anulado', 0, 0),
(2, 'Registrado', 1, 1),
(3, 'En Proceso', 1, 1),
(4, 'Finalizado', 1, 0),
(5, 'Almacen', 1, 1),
(6, 'Entregado', 1, 1),
(7, 'Pausado', 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `lineas`
--

CREATE TABLE `lineas` (
  `idlineas` int(11) NOT NULL,
  `nombre` varchar(150) NOT NULL,
  `descripcion` varchar(250) NOT NULL,
  `condicion` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `lineas`
--

INSERT INTO `lineas` (`idlineas`, `nombre`, `descripcion`, `condicion`) VALUES
(4, 'canecas', 'canecas ambientales', 1),
(5, 'resbaladilla', 'parques naturales kennedy', 1),
(6, 'prueba 3', 'pureba 1', 1),
(7, 'prueba 1', 'prueba 2', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `localidad`
--

CREATE TABLE `localidad` (
  `idlocalidad` int(11) NOT NULL,
  `nombre` varchar(45) NOT NULL,
  `idciudad` int(11) NOT NULL,
  `estado` tinyint(4) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `localidad`
--

INSERT INTO `localidad` (`idlocalidad`, `nombre`, `idciudad`, `estado`) VALUES
(1, 'Usaquen', 1, 1),
(2, 'Suba', 1, 1),
(3, 'Chapinero', 1, 1),
(4, 'Santa Fe', 1, 1),
(5, 'San Cristobal', 1, 1),
(6, 'Usme', 1, 1),
(7, 'Tunjuelito', 1, 1),
(8, 'Bosa', 1, 1),
(9, 'Kennedy', 1, 1),
(10, 'Fontibon', 1, 1),
(11, 'Engativa', 1, 1),
(12, 'Barrios Unidos', 1, 1),
(13, 'Teusaquillo', 1, 1),
(14, 'Los Martires', 1, 1),
(15, 'Antonio Narino', 1, 1),
(16, 'Puente Aranda', 1, 1),
(17, 'La Candelaria', 1, 1),
(18, 'Rafael Uribe Uribe', 1, 1),
(19, 'Ciudad Bolivar', 1, 1),
(20, 'Sumapaz', 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `orden_produccion`
--

CREATE TABLE `orden_produccion` (
  `idorden` int(11) NOT NULL,
  `cliente` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `fecha_entrega` date NOT NULL,
  `estado` int(11) NOT NULL,
  `total` float DEFAULT NULL,
  `factura` int(11) DEFAULT NULL,
  `cotizacion` int(11) DEFAULT NULL,
  `prioridad` int(11) NOT NULL,
  `encargado` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `orden_produccion`
--

INSERT INTO `orden_produccion` (`idorden`, `cliente`, `fecha`, `fecha_entrega`, `estado`, `total`, `factura`, `cotizacion`, `prioridad`, `encargado`) VALUES
(7, 26, '2018-11-29', '2018-11-29', 2, 1500, 0, 0, 3, 5);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `permiso`
--

CREATE TABLE `permiso` (
  `idpermiso` int(11) NOT NULL,
  `nombre` varchar(30) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `permiso`
--

INSERT INTO `permiso` (`idpermiso`, `nombre`) VALUES
(1, 'almacen'),
(2, 'produccion'),
(3, 'usuarios'),
(4, 'fabricacion');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `prioridad`
--

CREATE TABLE `prioridad` (
  `idprioridad` int(11) NOT NULL,
  `nombre1` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `prioridad`
--

INSERT INTO `prioridad` (`idprioridad`, `nombre1`) VALUES
(1, 'Urgente'),
(2, 'Rapido'),
(3, 'Normal');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sucursal`
--

CREATE TABLE `sucursal` (
  `idsucursal` int(11) NOT NULL,
  `idcliente` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL COMMENT 'nombre de la sucursal',
  `contacto` varchar(100) DEFAULT NULL,
  `correo` varchar(150) NOT NULL,
  `telefono` varchar(30) DEFAULT NULL,
  `direccion` varchar(100) NOT NULL,
  `idciudad` int(11) DEFAULT NULL,
  `idlocalidad` int(11) DEFAULT NULL,
  `barrio` varchar(50) DEFAULT NULL,
  `estado` tinyint(4) DEFAULT '1',
  `facturacion` tinyint(4) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `sucursal`
--

INSERT INTO `sucursal` (`idsucursal`, `idcliente`, `nombre`, `contacto`, `correo`, `telefono`, `direccion`, `idciudad`, `idlocalidad`, `barrio`, `estado`, `facturacion`) VALUES
(25, 50, 'OFICINA', 'CARLOS LOZANO', 'clozano@ticsia.com', '3007584458', 'CALLE 6A 89-47', 1, 9, 'TINTAL', 1, 1),
(26, 50, 'CASA', 'YENNY CONTRERAS', 'yennyja@gmail.com', '3185789400', 'CRA 90 6A-98 INT 6 304', 1, 9, 'TINTAL', 1, 0),
(27, 51, 'computos s.a', 'Jhon secada', 'computos@gmail.com', '7784586', 'calle 41 sur # 78 - 16', 1, 7, 'tunjuelito', 1, 1),
(28, 52, 'edwin prieto', 'edwin gregorio prieto', 'osch@gmail.com', '4508233', 'calle 41 sur # 78B - 16', 1, 6, 'tunjuelito', 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `unidades`
--

CREATE TABLE `unidades` (
  `idunidad` int(11) NOT NULL,
  `nombre` varchar(150) NOT NULL,
  `condicion` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `unidades`
--

INSERT INTO `unidades` (`idunidad`, `nombre`, `condicion`) VALUES
(9, 'resbaladilla 123', 1),
(10, 'baños publico 11', 1),
(11, 'canecas reciclaje', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `idusuario` int(11) NOT NULL,
  `nombre` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `tipo_documento` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  `num_documento` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  `direccion` varchar(70) COLLATE utf8_spanish_ci DEFAULT NULL,
  `telefono` varchar(20) COLLATE utf8_spanish_ci DEFAULT NULL,
  `email` varchar(50) COLLATE utf8_spanish_ci DEFAULT NULL,
  `cargo` varchar(20) COLLATE utf8_spanish_ci DEFAULT NULL,
  `login` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  `clave` varchar(64) COLLATE utf8_spanish_ci NOT NULL,
  `imagen` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `fecha_reg` datetime NOT NULL,
  `fecha_ult_ingreso` date NOT NULL,
  `condicion` tinyint(1) NOT NULL DEFAULT '1',
  `bodega` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`idusuario`, `nombre`, `tipo_documento`, `num_documento`, `direccion`, `telefono`, `email`, `cargo`, `login`, `clave`, `imagen`, `fecha_reg`, `fecha_ult_ingreso`, `condicion`, `bodega`) VALUES
(3, 'Carlos', 'CEDULA', '79', 'calle', '456', 'bn@vb', 'Administracion', 'admin', '8c6976e5b5410415bde908bd4dee15dfb167a9c873fc4bb8a81f6f2ab448a918', '1541118708.jpg', '2018-09-25 00:00:00', '2018-10-10', 1, 1),
(4, 'sebastian', 'CEDULA', '456789', 'calle 8', '445698', 'sebas@sebas.com', 'Analista', 'sebas', '4dd68e2ab3a30973318ea903e088b3d3480655ef4236109fe47272c1c1582880', '1530217136.jpg', '2018-09-25 00:00:00', '0000-00-00', 1, 1),
(5, 'Planta 1', 'RUT', '456789', 'Calle 6A #89-47, of 484', '3007584458', 'tecnicomster@gmail.com', 'Planta', 'planta1', 'ab21ffa4aa65f31fecb5c30b450acd2330e71fb70e476d03cde6dba2a8a37745', '1539018312.jpg', '2018-10-08 00:00:00', '2018-10-10', 1, 0),
(7, 'Planta 2', 'CEDULA', '3141212', 'Calle 6A #89-47, of 484', '14124141421', 'laura@gmail.com', 'Planta', 'laura', '92709de66d7a59931b65be80d5254b8e5b8667d4f6ceaf47c051ba64220983ca', '1539023809.jpg', '2018-10-08 00:00:00', '0000-00-00', 1, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario_permiso`
--

CREATE TABLE `usuario_permiso` (
  `idusuario_permiso` int(11) NOT NULL,
  `idusuario` int(11) NOT NULL,
  `idpermiso` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `usuario_permiso`
--

INSERT INTO `usuario_permiso` (`idusuario_permiso`, `idusuario`, `idpermiso`) VALUES
(52, 3, 1),
(53, 3, 2),
(54, 3, 3),
(55, 3, 4),
(57, 5, 4),
(58, 7, 4),
(61, 4, 1),
(62, 4, 2),
(63, 4, 4);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `articulo`
--
ALTER TABLE `articulo`
  ADD PRIMARY KEY (`idarticulo`),
  ADD UNIQUE KEY `nombre_UNIQUE` (`nombre`),
  ADD KEY `codigo` (`codigo`);

--
-- Indices de la tabla `ciudad`
--
ALTER TABLE `ciudad`
  ADD PRIMARY KEY (`idciudad`);

--
-- Indices de la tabla `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`idcliente`),
  ADD KEY `fk_cliente_emp_idx` (`empresa`);

--
-- Indices de la tabla `detalle_p`
--
ALTER TABLE `detalle_p`
  ADD PRIMARY KEY (`iddetalle`);

--
-- Indices de la tabla `detalle_produccion`
--
ALTER TABLE `detalle_produccion`
  ADD PRIMARY KEY (`iddetalle`),
  ADD KEY `comp_lista_idx` (`iddetalle`),
  ADD KEY `comp_articulo_idx` (`idnombre`);

--
-- Indices de la tabla `empresa`
--
ALTER TABLE `empresa`
  ADD PRIMARY KEY (`idempresa`);

--
-- Indices de la tabla `estados`
--
ALTER TABLE `estados`
  ADD PRIMARY KEY (`idestado`);

--
-- Indices de la tabla `lineas`
--
ALTER TABLE `lineas`
  ADD PRIMARY KEY (`idlineas`);

--
-- Indices de la tabla `localidad`
--
ALTER TABLE `localidad`
  ADD PRIMARY KEY (`idlocalidad`);

--
-- Indices de la tabla `orden_produccion`
--
ALTER TABLE `orden_produccion`
  ADD PRIMARY KEY (`idorden`),
  ADD KEY `lista_categoria_idx` (`cliente`);

--
-- Indices de la tabla `permiso`
--
ALTER TABLE `permiso`
  ADD PRIMARY KEY (`idpermiso`);

--
-- Indices de la tabla `prioridad`
--
ALTER TABLE `prioridad`
  ADD PRIMARY KEY (`idprioridad`);

--
-- Indices de la tabla `sucursal`
--
ALTER TABLE `sucursal`
  ADD PRIMARY KEY (`idsucursal`),
  ADD KEY `fk_suc_cliente_idx` (`idcliente`),
  ADD KEY `fk_suc_localidad_idx` (`idlocalidad`),
  ADD KEY `fk_suc_ciudad_idx` (`idciudad`) USING BTREE;

--
-- Indices de la tabla `unidades`
--
ALTER TABLE `unidades`
  ADD PRIMARY KEY (`idunidad`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`idusuario`),
  ADD UNIQUE KEY `login_UNIQUE` (`login`);

--
-- Indices de la tabla `usuario_permiso`
--
ALTER TABLE `usuario_permiso`
  ADD PRIMARY KEY (`idusuario_permiso`),
  ADD KEY `fk_usuario_permiso_permiso_idx` (`idpermiso`),
  ADD KEY `fk_usuario_permiso_usuario_idx` (`idusuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `articulo`
--
ALTER TABLE `articulo`
  MODIFY `idarticulo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT de la tabla `ciudad`
--
ALTER TABLE `ciudad`
  MODIFY `idciudad` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `cliente`
--
ALTER TABLE `cliente`
  MODIFY `idcliente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT de la tabla `detalle_p`
--
ALTER TABLE `detalle_p`
  MODIFY `iddetalle` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT de la tabla `detalle_produccion`
--
ALTER TABLE `detalle_produccion`
  MODIFY `iddetalle` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `empresa`
--
ALTER TABLE `empresa`
  MODIFY `idempresa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `estados`
--
ALTER TABLE `estados`
  MODIFY `idestado` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `lineas`
--
ALTER TABLE `lineas`
  MODIFY `idlineas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `localidad`
--
ALTER TABLE `localidad`
  MODIFY `idlocalidad` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT de la tabla `orden_produccion`
--
ALTER TABLE `orden_produccion`
  MODIFY `idorden` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `permiso`
--
ALTER TABLE `permiso`
  MODIFY `idpermiso` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `prioridad`
--
ALTER TABLE `prioridad`
  MODIFY `idprioridad` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `sucursal`
--
ALTER TABLE `sucursal`
  MODIFY `idsucursal` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT de la tabla `unidades`
--
ALTER TABLE `unidades`
  MODIFY `idunidad` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `idusuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `usuario_permiso`
--
ALTER TABLE `usuario_permiso`
  MODIFY `idusuario_permiso` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `cliente`
--
ALTER TABLE `cliente`
  ADD CONSTRAINT `fk_cliente_emp` FOREIGN KEY (`empresa`) REFERENCES `empresa` (`idempresa`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

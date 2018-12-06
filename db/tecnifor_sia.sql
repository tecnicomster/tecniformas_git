-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 05-12-2018 a las 09:19:44
-- Versión del servidor: 10.1.36-MariaDB
-- Versión de PHP: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `tecnifor_sia`
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
(1, '01', 'PUERTA', 'PUERTA ESTANDAR', 1, 1),
(2, '02', 'MARCO DERECHO', 'MARCO DERECHO ESTANDAR', 1, 1),
(3, '03', 'MARCO IZQUIERDO', 'MARCO IZQUIERDO ESTANDAR', 1, 1),
(4, '04', 'PISO ESTIBA', 'PISO ESTANDAR', 1, 1),
(5, '05', 'TANQUE', 'TANQUE ESTANDAR', 1, 1),
(8, '06', 'TANQUE LAVAMANOS', 'TANQUE ESTANDAR', 1, 1);

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
(1, 'Bogota', 1),
(2, 'Cajica', 1);

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
(51, 'THERMOFORM', '900516962', 'Antiguo', 'Comercial', 'Referido', '', 1, 1);

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
  `encargado` int(11) NOT NULL,
  `entrega` varchar(20) NOT NULL DEFAULT 'Recogen'
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
(1, 1, 1, '10.00', 'azul', 5, 1, 'azul institucional', 2),
(2, 2, 1, '10.00', 'azul', 5, 1, 'azul institucional', 5);

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
(1, 'Anulado', 1, 1),
(2, 'Registrado', 1, 1),
(3, 'En proceso', 1, 1),
(4, 'Fabricacion ', 1, 1),
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
(1, 'BAÑOS PORTATILES', 'BAÑOS', 1);

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
(1, 'Kennedy', 1, 1),
(2, 'Cajica', 2, 1);

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
  `encargado` int(11) NOT NULL,
  `entrega` varchar(20) NOT NULL DEFAULT 'Recogen'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `orden_produccion`
--

INSERT INTO `orden_produccion` (`idorden`, `cliente`, `fecha`, `fecha_entrega`, `estado`, `total`, `factura`, `cotizacion`, `prioridad`, `encargado`, `entrega`) VALUES
(1, 1, '2018-12-04', '2018-12-13', 2, 90000, 0, 0, 1, 5, 'Recogen'),
(2, 1, '2018-12-04', '2018-12-13', 5, 900000, 0, 0, 1, 7, 'Recogen');

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
(1, 'Normal'),
(2, 'Urgente');

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
(1, 51, 'CAJICA', 'ALEJANDRO MONTANA', 'alejandro.montana@thermoform.com.co', '4173800', 'via cajica zipaquira kilometro 4', 2, 2, '', 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `unidades`
--

CREATE TABLE `unidades` (
  `idunidad` int(11) NOT NULL,
  `nombre` varchar(150) NOT NULL,
  `condicion` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
(5, 'JUAN MORENO', 'CEDULA', '1108998514', 'CARRERA 69B No 21-60 sur', '9261919', 'produccion@tecniformasplasticas.com', 'Planta', 'planta1', 'eb6c8775904832f73050927bbf86a9f0f0f029d9b1c1681812be444ad9af89b3', '1543942284.JPG', '2018-10-08 00:00:00', '2018-10-10', 1, 0),
(7, 'MIGUEL AGUILAR', 'CEDULA', '1033736009', 'CARRERA 69B No 21-60 sur', '9261919', 'produccion@tecniformasplasticas.com', 'Planta', 'planta2', '5012e9c045b17fa06d5d8b5fcdaabf7583a630dd3e26c4ec1cc80699b5c52f00', '1543942434.jpg', '2018-10-08 00:00:00', '0000-00-00', 1, 0),
(8, 'FREDDY QUIROGA', 'CEDULA', '79516351', 'CARRERA 69B No 21-60 sur', '9261919', 'freddy.quiroga@tecniformasplasticas.com', 'Administracion', 'freddyq', '9b4473a0e32130a59143d804dcb35ce31884bdf66c628f750cff8390ac1ef4cc', '1543942047.jpg', '0000-00-00 00:00:00', '0000-00-00', 1, 0);

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
(61, 4, 1),
(62, 4, 2),
(63, 4, 4),
(67, 8, 1),
(68, 8, 2),
(69, 8, 3),
(70, 5, 4),
(72, 7, 4);

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
  MODIFY `idarticulo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `ciudad`
--
ALTER TABLE `ciudad`
  MODIFY `idciudad` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `cliente`
--
ALTER TABLE `cliente`
  MODIFY `idcliente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT de la tabla `detalle_p`
--
ALTER TABLE `detalle_p`
  MODIFY `iddetalle` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `detalle_produccion`
--
ALTER TABLE `detalle_produccion`
  MODIFY `iddetalle` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

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
  MODIFY `idlineas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `localidad`
--
ALTER TABLE `localidad`
  MODIFY `idlocalidad` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `orden_produccion`
--
ALTER TABLE `orden_produccion`
  MODIFY `idorden` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `permiso`
--
ALTER TABLE `permiso`
  MODIFY `idpermiso` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `prioridad`
--
ALTER TABLE `prioridad`
  MODIFY `idprioridad` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `sucursal`
--
ALTER TABLE `sucursal`
  MODIFY `idsucursal` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `unidades`
--
ALTER TABLE `unidades`
  MODIFY `idunidad` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `idusuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `usuario_permiso`
--
ALTER TABLE `usuario_permiso`
  MODIFY `idusuario_permiso` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;

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

-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: bvvzaqa05oaftfot1xt5-mysql.services.clever-cloud.com:3306
-- Generation Time: Apr 23, 2021 at 04:29 AM
-- Server version: 8.0.15-5
-- PHP Version: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bvvzaqa05oaftfot1xt5`
--

-- --------------------------------------------------------

--
-- Table structure for table `Comercio`
--

CREATE TABLE `Comercio` (
  `idComercio` int(11) NOT NULL,
  `nombre` varchar(75) NOT NULL,
  `descripcion` varchar(255) DEFAULT NULL,
  `telefono` varchar(10) DEFAULT NULL,
  `direccion` varchar(255) DEFAULT NULL,
  `creacion` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `actualizacion` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `Comercio`
--

INSERT INTO `Comercio` (`idComercio`, `nombre`, `descripcion`, `telefono`, `direccion`, `actualizacion`) VALUES
(1, 'Distelsa', 'Ninguna...', '78675648', 'GT', '2021-04-08 01:31:23'),
(3, 'DISMASUR', 'Empresa Distribuidora de materales para hogares\r\nPiso, baños, regaderas', '78804520', '5 ave zona 1 Esc Guatemala', NULL),
(4, 'MACOMACO', 'Repuestos Automovilisticos', '78804525', 'GT', NULL),
(5, 'XXXX', 'XXX', 'XXX', 'XXX', '2021-04-15 04:26:18');

-- --------------------------------------------------------

--
-- Table structure for table `Departamento`
--

CREATE TABLE `Departamento` (
  `idDepartamento` int(11) NOT NULL,
  `nombre` varchar(75) NOT NULL,
  `creacion` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `actualizacion` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `idPais_Region` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `Departamento`
--

INSERT INTO `Departamento` (`idDepartamento`, `nombre`, `actualizacion`, `idPais_Region`) VALUES
(1, 'Escuintla', NULL, 1),
(2, 'Santa Rosa', NULL, 1),
(3, 'Quetzaltenango', NULL, 1),
(5, 'Huehuetenango', NULL, 6),
(6, 'Quiche', NULL, 6),
(7, 'Alta Verapaz', NULL, 6),
(8, 'Izabal', NULL, 6),
(9, 'Baja Verapaz', NULL, 6);

-- --------------------------------------------------------

--
-- Table structure for table `Municipio`
--

CREATE TABLE `Municipio` (
  `idMunicipio` int(11) NOT NULL,
  `nombre` varchar(75) NOT NULL,
  `creacion` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `actualizacion` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `idDepartamento` int(11) NOT NULL,
  `zipCode` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `Municipio`
--

INSERT INTO `Municipio` (`idMunicipio`, `nombre`, `actualizacion`, `idDepartamento`, `zipCode`) VALUES
(4, 'Santa Lucia', NULL, 1, '05001'),
(5, 'Escuintla', NULL, 1, '05001'),
(6, 'Palin', NULL, 1, '05002'),
(7, 'La Gomera', NULL, 1, '05001'),
(8, 'Sipacate', NULL, 1, '05003'),
(9, 'Cobán', '2021-04-15 04:14:11', 7, '50000');

-- --------------------------------------------------------

--
-- Table structure for table `Pais`
--

CREATE TABLE `Pais` (
  `idPais` int(11) NOT NULL,
  `nombre` varchar(75) NOT NULL,
  `isoCode` varchar(5) NOT NULL,
  `creacion` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `actualizacion` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `Pais`
--

INSERT INTO `Pais` (`idPais`, `nombre`, `isoCode`, `actualizacion`) VALUES
(1, 'Guatemala', '502', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `Pais_Region`
--

CREATE TABLE `Pais_Region` (
  `idPais_Region` int(11) NOT NULL,
  `idRegion` int(11) NOT NULL,
  `idPais` int(11) NOT NULL,
  `creacion` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `Pais_Region`
--

INSERT INTO `Pais_Region` (`idPais_Region`, `idRegion`, `idPais`) VALUES
(1, 1, 1),
(6, 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `Queja`
--

CREATE TABLE `Queja` (
  `idQueja` int(11) NOT NULL,
  `nombre` varchar(75) DEFAULT NULL,
  `descripcion` varchar(255) NOT NULL,
  `solucion` varchar(255) NOT NULL,
  `telefono` varchar(10) DEFAULT NULL,
  `creacion` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `actualizacion` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `idSucursal` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `Queja`
--

INSERT INTO `Queja` (`idQueja`, `nombre`, `descripcion`, `solucion`, `telefono`, `actualizacion`, `idSucursal`) VALUES
(1, NULL, 'Esta es una queja de prueba', 'No lo se', NULL, NULL, 1),
(2, NULL, 'asdasd', 'asdasd', NULL, NULL, 1),
(3, NULL, 'adasdasd', 'asdasd', NULL, NULL, 2),
(4, NULL, 'asdasd', 'asdas', NULL, '2021-04-09 02:53:16', 2),
(5, NULL, 'asdasd', 'asdasd', NULL, '2021-04-09 02:53:45', 3),
(6, NULL, 'asdasdasd', 'asdasd', NULL, '2021-04-09 02:55:20', 1),
(7, '', 'esta es una queja', 'alguna solucion tienen que darle', '', NULL, 2),
(8, '', 'Otra queja', 'Tienen que arreglarlo\r\n', '', NULL, 3),
(9, '', 'La atencion es mala', 'Cambien perosnal ujumm ', '', NULL, 1),
(10, '', 'Producto vencido', 'Mejorar procesos de calidad', '', NULL, 2),
(11, '', 'Esto es la descripcion de una queja ', 'Solucion de la queja', '', NULL, 5),
(12, '', 'No atienden bien', 'cambien a todos', '', NULL, 6);

-- --------------------------------------------------------

--
-- Table structure for table `Region`
--

CREATE TABLE `Region` (
  `idRegion` int(11) NOT NULL,
  `nombre` varchar(75) NOT NULL,
  `code` varchar(45) NOT NULL,
  `descripcion` varchar(255) DEFAULT NULL,
  `creacion` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `actualizacion` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `Region`
--

INSERT INTO `Region` (`idRegion`, `nombre`, `code`, `descripcion`, `actualizacion`) VALUES
(1, 'Sur', 'sur', 'Regiones sur\r\n', NULL),
(2, 'Norte', 'norte', 'Region norte', NULL),
(3, 'Oeste', 'oeste', 'Region Oeste\r\n', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `Sucursal`
--

CREATE TABLE `Sucursal` (
  `idSucursal` int(11) NOT NULL,
  `nombre` varchar(75) DEFAULT NULL,
  `direccion` varchar(255) DEFAULT NULL,
  `telefono` varchar(10) DEFAULT NULL,
  `creacion` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `actualizacion` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `idMunicipio` int(11) NOT NULL,
  `idComercio` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `Sucursal`
--

INSERT INTO `Sucursal` (`idSucursal`, `nombre`, `direccion`, `telefono`, `actualizacion`, `idMunicipio`, `idComercio`) VALUES
(1, 'Pradera Escuintla', 'Pradera Escuintla', '78564738', '2021-04-08 03:47:57', 5, 1),
(2, 'El minuto', 'El minuto escuintla', '54342322', NULL, 5, 1),
(3, 'Santa Lucia I', 'Santa Lucia', '5674567', NULL, 4, 1),
(4, 'Max - Coban', 'Pradera coban', '5463456', NULL, 9, 1),
(5, 'YYYY', 'XXXXX', '00000', NULL, 9, 1),
(6, 'Escuintla', 'GT', 'XX', NULL, 5, 4),
(7, 'YYFsdf', 'sdfsdf', 'dsdfsdf', '2021-04-22 01:16:01', 5, 5);

-- --------------------------------------------------------

--
-- Table structure for table `Usuario`
--

CREATE TABLE `Usuario` (
  `idUser` int(11) NOT NULL,
  `nombres` varchar(75) NOT NULL,
  `apellidos` varchar(75) DEFAULT NULL,
  `correo` varchar(75) NOT NULL,
  `contrasenia` varchar(255) NOT NULL,
  `creacion` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `actualizacion` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `Usuario`
--

INSERT INTO `Usuario` (`idUser`, `nombres`, `apellidos`, `correo`, `contrasenia`, `actualizacion`) VALUES
(1, 'Admin', 'Admin', 'admin', '743dbe84181f8f66a503083cefe18258', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Comercio`
--
ALTER TABLE `Comercio`
  ADD PRIMARY KEY (`idComercio`);

--
-- Indexes for table `Departamento`
--
ALTER TABLE `Departamento`
  ADD PRIMARY KEY (`idDepartamento`),
  ADD KEY `fk_Departamento_Region_has_Pais1_idx` (`idPais_Region`);

--
-- Indexes for table `Municipio`
--
ALTER TABLE `Municipio`
  ADD PRIMARY KEY (`idMunicipio`),
  ADD KEY `fk_Municipio_Departamento1_idx` (`idDepartamento`);

--
-- Indexes for table `Pais`
--
ALTER TABLE `Pais`
  ADD PRIMARY KEY (`idPais`);

--
-- Indexes for table `Pais_Region`
--
ALTER TABLE `Pais_Region`
  ADD PRIMARY KEY (`idPais_Region`),
  ADD KEY `fk_Region_has_Pais_Pais1_idx` (`idPais`),
  ADD KEY `fk_Region_has_Pais_Region1_idx` (`idRegion`);

--
-- Indexes for table `Queja`
--
ALTER TABLE `Queja`
  ADD PRIMARY KEY (`idQueja`),
  ADD KEY `fk_Queja_Sucursal1_idx` (`idSucursal`);

--
-- Indexes for table `Region`
--
ALTER TABLE `Region`
  ADD PRIMARY KEY (`idRegion`);

--
-- Indexes for table `Sucursal`
--
ALTER TABLE `Sucursal`
  ADD PRIMARY KEY (`idSucursal`),
  ADD KEY `fk_Sucursal_Municipio1_idx` (`idMunicipio`),
  ADD KEY `fk_Sucursal_Comercio1_idx` (`idComercio`);

--
-- Indexes for table `Usuario`
--
ALTER TABLE `Usuario`
  ADD PRIMARY KEY (`idUser`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `Comercio`
--
ALTER TABLE `Comercio`
  MODIFY `idComercio` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `Departamento`
--
ALTER TABLE `Departamento`
  MODIFY `idDepartamento` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `Municipio`
--
ALTER TABLE `Municipio`
  MODIFY `idMunicipio` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `Pais`
--
ALTER TABLE `Pais`
  MODIFY `idPais` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `Pais_Region`
--
ALTER TABLE `Pais_Region`
  MODIFY `idPais_Region` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `Queja`
--
ALTER TABLE `Queja`
  MODIFY `idQueja` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `Region`
--
ALTER TABLE `Region`
  MODIFY `idRegion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `Sucursal`
--
ALTER TABLE `Sucursal`
  MODIFY `idSucursal` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `Usuario`
--
ALTER TABLE `Usuario`
  MODIFY `idUser` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `Departamento`
--
ALTER TABLE `Departamento`
  ADD CONSTRAINT `fk_Departamento_Region_has_Pais1` FOREIGN KEY (`idPais_Region`) REFERENCES `Pais_Region` (`idPais_Region`);

--
-- Constraints for table `Municipio`
--
ALTER TABLE `Municipio`
  ADD CONSTRAINT `fk_Municipio_Departamento1` FOREIGN KEY (`idDepartamento`) REFERENCES `Departamento` (`idDepartamento`);

--
-- Constraints for table `Pais_Region`
--
ALTER TABLE `Pais_Region`
  ADD CONSTRAINT `fk_Region_has_Pais_Pais1` FOREIGN KEY (`idPais`) REFERENCES `Pais` (`idPais`),
  ADD CONSTRAINT `fk_Region_has_Pais_Region1` FOREIGN KEY (`idRegion`) REFERENCES `Region` (`idRegion`);

--
-- Constraints for table `Queja`
--
ALTER TABLE `Queja`
  ADD CONSTRAINT `fk_Queja_Sucursal1` FOREIGN KEY (`idSucursal`) REFERENCES `Sucursal` (`idSucursal`);

--
-- Constraints for table `Sucursal`
--
ALTER TABLE `Sucursal`
  ADD CONSTRAINT `fk_Sucursal_Comercio1` FOREIGN KEY (`idComercio`) REFERENCES `Comercio` (`idComercio`),
  ADD CONSTRAINT `fk_Sucursal_Municipio1` FOREIGN KEY (`idMunicipio`) REFERENCES `Municipio` (`idMunicipio`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

/*
 Navicat Premium Data Transfer

 Source Server         : MyDBSQL
 Source Server Type    : MySQL
 Source Server Version : 100428
 Source Host           : localhost:3306
 Source Schema         : db_orthocenter

 Target Server Type    : MySQL
 Target Server Version : 100428
 File Encoding         : 65001

 Date: 31/08/2023 11:12:10
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for tba_centrocostos
-- ----------------------------
DROP TABLE IF EXISTS `tba_centrocostos`;
CREATE TABLE `tba_centrocostos`  (
  `IdCentroCostos` int NOT NULL AUTO_INCREMENT,
  `DescripcionCentro` varchar(100) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `FechaCreacion` datetime NOT NULL,
  `FechaActualizacion` datetime NOT NULL,
  PRIMARY KEY (`IdCentroCostos`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8 COLLATE = utf8_spanish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tba_centrocostos
-- ----------------------------
INSERT INTO `tba_centrocostos` VALUES (1, 'Costos de Personal', '2023-08-26 12:05:51', '2023-08-26 12:05:51');
INSERT INTO `tba_centrocostos` VALUES (2, 'Costos de Insumos', '2023-08-26 12:05:55', '2023-08-26 12:05:55');
INSERT INTO `tba_centrocostos` VALUES (3, 'Gastos de Planillas', '2023-08-26 12:05:59', '2023-08-26 12:06:04');

-- ----------------------------
-- Table structure for tba_cita
-- ----------------------------
DROP TABLE IF EXISTS `tba_cita`;
CREATE TABLE `tba_cita`  (
  `IdCita` int NOT NULL AUTO_INCREMENT,
  `IdPaciente` int NOT NULL,
  `FechaProgramada` datetime NOT NULL,
  `MedicoAsignado` int NOT NULL,
  `EstadoCita` int NOT NULL,
  `FechaCreacion` datetime NOT NULL,
  `FechaActualizacion` datetime NOT NULL,
  PRIMARY KEY (`IdCita`) USING BTREE,
  INDEX `fk_paciente_cita`(`IdPaciente`) USING BTREE,
  CONSTRAINT `fk_paciente_cita` FOREIGN KEY (`IdPaciente`) REFERENCES `tba_paciente` (`IdPaciente`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_spanish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tba_cita
-- ----------------------------

-- ----------------------------
-- Table structure for tba_costo
-- ----------------------------
DROP TABLE IF EXISTS `tba_costo`;
CREATE TABLE `tba_costo`  (
  `IdCosto` int NOT NULL AUTO_INCREMENT,
  `IdCentroCostos` int NOT NULL,
  `MesCosto` varchar(10) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `TotalCosto` decimal(10, 2) NOT NULL,
  `EstadoCosto` int NOT NULL,
  `UsuarioCreado` int NOT NULL,
  `UsuarioActualiza` int NOT NULL,
  `FechaCreacion` datetime NOT NULL,
  `FechaActualizacion` datetime NOT NULL,
  PRIMARY KEY (`IdCosto`) USING BTREE,
  INDEX `fk_centrocostos_costo`(`IdCentroCostos`) USING BTREE,
  CONSTRAINT `fk_centrocostos_costo` FOREIGN KEY (`IdCentroCostos`) REFERENCES `tba_centrocostos` (`IdCentroCostos`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_spanish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tba_costo
-- ----------------------------

-- ----------------------------
-- Table structure for tba_detallecosto
-- ----------------------------
DROP TABLE IF EXISTS `tba_detallecosto`;
CREATE TABLE `tba_detallecosto`  (
  `IdDetalleCosto` int NOT NULL,
  `IdCosto` int NOT NULL,
  `IdGasto` int NOT NULL,
  `IdSocio` int NOT NULL,
  `NumeroDocumento` varchar(25) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `ObservacionGasto` varchar(255) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `FechaCosto` date NOT NULL,
  `PrecioGasto` decimal(10, 2) NOT NULL,
  PRIMARY KEY (`IdDetalleCosto`) USING BTREE,
  INDEX `fk_costo_detallecosto`(`IdCosto`) USING BTREE,
  INDEX `fk_gasto_detallecosto`(`IdGasto`) USING BTREE,
  INDEX `fk_socio_detallecosto`(`IdSocio`) USING BTREE,
  CONSTRAINT `fk_costo_detallecosto` FOREIGN KEY (`IdCosto`) REFERENCES `tba_costo` (`IdCosto`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `fk_gasto_detallecosto` FOREIGN KEY (`IdGasto`) REFERENCES `tba_gasto` (`IdGasto`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `fk_socio_detallecosto` FOREIGN KEY (`IdSocio`) REFERENCES `tba_socio` (`IdSocio`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB CHARACTER SET = utf8 COLLATE = utf8_spanish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tba_detallecosto
-- ----------------------------

-- ----------------------------
-- Table structure for tba_detallehistoriaclinica
-- ----------------------------
DROP TABLE IF EXISTS `tba_detallehistoriaclinica`;
CREATE TABLE `tba_detallehistoriaclinica`  (
  `IdDetalleHistoriaClinica` int NOT NULL AUTO_INCREMENT,
  `IdHistoriaClinica` int NOT NULL,
  `IdTratamiento` int NOT NULL,
  `PresionArterial` varchar(25) CHARACTER SET utf8 COLLATE utf8_spanish_ci NULL DEFAULT NULL,
  `Pulso` varchar(25) CHARACTER SET utf8 COLLATE utf8_spanish_ci NULL DEFAULT NULL,
  `Temperatura` varchar(25) CHARACTER SET utf8 COLLATE utf8_spanish_ci NULL DEFAULT NULL,
  `FrecuenciaCardiaca` varchar(25) CHARACTER SET utf8 COLLATE utf8_spanish_ci NULL DEFAULT NULL,
  `FrecuenciaRespiratoria` varchar(25) CHARACTER SET utf8 COLLATE utf8_spanish_ci NULL DEFAULT NULL,
  `ExamenOdonto` varchar(250) CHARACTER SET utf8 COLLATE utf8_spanish_ci NULL DEFAULT NULL,
  `DiagnosticoPresuntivo` varchar(200) CHARACTER SET utf8 COLLATE utf8_spanish_ci NULL DEFAULT NULL,
  `DiagnosticoDefinitivo` varchar(200) CHARACTER SET utf8 COLLATE utf8_spanish_ci NULL DEFAULT NULL,
  `Pronostico` varchar(500) CHARACTER SET utf8 COLLATE utf8_spanish_ci NULL DEFAULT NULL,
  `TratamientoPaciente` varchar(500) CHARACTER SET utf8 COLLATE utf8_spanish_ci NULL DEFAULT NULL,
  `InformacionAlta` varchar(500) CHARACTER SET utf8 COLLATE utf8_spanish_ci NULL DEFAULT NULL,
  `FechaCreado` datetime NOT NULL,
  `FechaActualiza` datetime NOT NULL,
  `UsuarioCreado` int NOT NULL,
  `UsuarioActualizado` int NOT NULL,
  PRIMARY KEY (`IdDetalleHistoriaClinica`) USING BTREE,
  INDEX `fk_historiaclinica_detallehistoria`(`IdHistoriaClinica`) USING BTREE,
  INDEX `fk_tratamiento_detallehistoria`(`IdTratamiento`) USING BTREE,
  CONSTRAINT `fk_historiaclinica_detallehistoria` FOREIGN KEY (`IdHistoriaClinica`) REFERENCES `tba_historiaclinica` (`IdHistoriaClinica`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = utf8 COLLATE = utf8_spanish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tba_detallehistoriaclinica
-- ----------------------------
INSERT INTO `tba_detallehistoriaclinica` VALUES (2, 7, 7, '', '', '', '', '', '', '', '', '', '', '', '2023-08-31 08:54:31', '2023-08-31 08:54:31', 1, 1);
INSERT INTO `tba_detallehistoriaclinica` VALUES (3, 8, 8, '', '', '', '', '', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna\r\naliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.\r\nDuis aute irure ', '', '', '', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', '2023-08-31 08:59:41', '2023-08-31 09:07:03', 1, 1);
INSERT INTO `tba_detallehistoriaclinica` VALUES (4, 9, 9, '', '', '', '', '', '', '', '', '', '', '', '2023-08-31 10:28:44', '2023-08-31 10:28:44', 1, 1);

-- ----------------------------
-- Table structure for tba_detalletratamiento
-- ----------------------------
DROP TABLE IF EXISTS `tba_detalletratamiento`;
CREATE TABLE `tba_detalletratamiento`  (
  `IdDetalleTratamiento` int NOT NULL AUTO_INCREMENT,
  `IdTratamiento` int NOT NULL,
  `IdProcedimiento` int NOT NULL,
  `EstadoTratamiento` int NOT NULL,
  `FechaProcedimiento` date NULL DEFAULT NULL,
  `ObservacionProcedimiento` varchar(150) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `PrecioProcedimiento` decimal(10, 2) NOT NULL,
  PRIMARY KEY (`IdDetalleTratamiento`) USING BTREE,
  INDEX `fk_tratamiento_detalletratamiento`(`IdTratamiento`) USING BTREE,
  INDEX `fk_procedimiento_detalletratamiento`(`IdProcedimiento`) USING BTREE,
  CONSTRAINT `fk_procedimiento_detalletratamiento` FOREIGN KEY (`IdProcedimiento`) REFERENCES `tba_procedimiento` (`IdProcedimiento`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `fk_tratamiento_detalletratamiento` FOREIGN KEY (`IdTratamiento`) REFERENCES `tba_tratamiento` (`IdTratamiento`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 27 CHARACTER SET = utf8 COLLATE = utf8_spanish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tba_detalletratamiento
-- ----------------------------
INSERT INTO `tba_detalletratamiento` VALUES (6, 7, 1, 2, '2023-08-30', '', 250.00);
INSERT INTO `tba_detalletratamiento` VALUES (7, 7, 1, 1, '0000-00-00', '', 250.00);
INSERT INTO `tba_detalletratamiento` VALUES (8, 7, 1, 1, '0000-00-00', '', 250.00);
INSERT INTO `tba_detalletratamiento` VALUES (14, 8, 1, 2, '2023-08-30', '', 250.00);
INSERT INTO `tba_detalletratamiento` VALUES (15, 8, 1, 2, '2023-08-31', '', 250.00);
INSERT INTO `tba_detalletratamiento` VALUES (16, 8, 1, 1, '0000-00-00', '', 250.00);
INSERT INTO `tba_detalletratamiento` VALUES (17, 8, 1, 1, '0000-00-00', '', 250.00);
INSERT INTO `tba_detalletratamiento` VALUES (18, 8, 1, 1, '0000-00-00', '', 250.00);
INSERT INTO `tba_detalletratamiento` VALUES (25, 9, 1, 2, '2023-08-31', '', 355.00);
INSERT INTO `tba_detalletratamiento` VALUES (26, 9, 1, 1, '0000-00-00', '', 250.00);

-- ----------------------------
-- Table structure for tba_gasto
-- ----------------------------
DROP TABLE IF EXISTS `tba_gasto`;
CREATE TABLE `tba_gasto`  (
  `IdGasto` int NOT NULL AUTO_INCREMENT,
  `IdCentroCostos` int NOT NULL,
  `NombreGasto` varchar(150) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `FechaCreacion` datetime NOT NULL,
  `FechaActualizacion` datetime NOT NULL,
  PRIMARY KEY (`IdGasto`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_spanish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tba_gasto
-- ----------------------------

-- ----------------------------
-- Table structure for tba_historiaclinica
-- ----------------------------
DROP TABLE IF EXISTS `tba_historiaclinica`;
CREATE TABLE `tba_historiaclinica`  (
  `IdHistoriaClinica` int NOT NULL AUTO_INCREMENT,
  `IdPaciente` int NOT NULL,
  `IdSocio` int NOT NULL,
  `AlergiasEncontradas` varchar(500) CHARACTER SET utf8 COLLATE utf8_spanish_ci NULL DEFAULT NULL,
  `MotivoConsulta` varchar(255) CHARACTER SET utf8 COLLATE utf8_spanish_ci NULL DEFAULT NULL,
  `DatosInformante` varchar(255) CHARACTER SET utf8 COLLATE utf8_spanish_ci NULL DEFAULT NULL,
  `TiempoEnfermedad` varchar(255) CHARACTER SET utf8 COLLATE utf8_spanish_ci NULL DEFAULT NULL,
  `SignosSintomas` varchar(255) CHARACTER SET utf8 COLLATE utf8_spanish_ci NULL DEFAULT NULL,
  `RelatoCronologico` varchar(255) CHARACTER SET utf8 COLLATE utf8_spanish_ci NULL DEFAULT NULL,
  `FuncionesBiologicas` varchar(255) CHARACTER SET utf8 COLLATE utf8_spanish_ci NULL DEFAULT NULL,
  `AntecedentesFamiliares` varchar(500) CHARACTER SET utf8 COLLATE utf8_spanish_ci NULL DEFAULT NULL,
  `AntecedentesPersonales` varchar(500) CHARACTER SET utf8 COLLATE utf8_spanish_ci NULL DEFAULT NULL,
  `RutaOdontograma` varchar(255) CHARACTER SET utf8 COLLATE utf8_spanish_ci NULL DEFAULT NULL,
  `UsuarioCreado` int NOT NULL,
  `UsuarioActualizado` int NOT NULL,
  `FechaCreado` datetime NOT NULL,
  `FechaActualiza` datetime NOT NULL,
  PRIMARY KEY (`IdHistoriaClinica`) USING BTREE,
  INDEX `fk_paciente_historia`(`IdPaciente`) USING BTREE,
  INDEX `fk_socio_historia`(`IdSocio`) USING BTREE,
  CONSTRAINT `fk_paciente_historia` FOREIGN KEY (`IdPaciente`) REFERENCES `tba_paciente` (`IdPaciente`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `fk_socio_historia` FOREIGN KEY (`IdSocio`) REFERENCES `tba_socio` (`IdSocio`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 10 CHARACTER SET = utf8 COLLATE = utf8_spanish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tba_historiaclinica
-- ----------------------------
INSERT INTO `tba_historiaclinica` VALUES (7, 2, 1, '', '', '', '', '', NULL, '', '', '', NULL, 1, 1, '2023-08-31 08:54:30', '2023-08-31 08:54:30');
INSERT INTO `tba_historiaclinica` VALUES (8, 1, 1, '', '', '', '', '', '', '', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', '76405728_1_8_2023-08-31.png', 1, 1, '2023-08-31 08:59:41', '2023-08-31 09:07:03');
INSERT INTO `tba_historiaclinica` VALUES (9, 3, 1, '', '', '', '', '', NULL, '', '', '', '123123123_3_9_2023-08-31.png', 1, 1, '2023-08-31 10:28:44', '2023-08-31 10:28:44');

-- ----------------------------
-- Table structure for tba_paciente
-- ----------------------------
DROP TABLE IF EXISTS `tba_paciente`;
CREATE TABLE `tba_paciente`  (
  `IdPaciente` int NOT NULL AUTO_INCREMENT,
  `NombrePaciente` varchar(100) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `ApellidoPaciente` varchar(100) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `DNIPaciente` int NOT NULL,
  `SexoPaciente` varchar(12) CHARACTER SET utf8 COLLATE utf8_spanish_ci NULL DEFAULT NULL,
  `EdadPaciente` varchar(11) CHARACTER SET utf8 COLLATE utf8_spanish_ci NULL DEFAULT NULL,
  `FechaNacimiento` date NULL DEFAULT NULL,
  `CelularPaciente` varchar(11) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `DomicilioPaciente` varchar(255) CHARACTER SET utf8 COLLATE utf8_spanish_ci NULL DEFAULT NULL,
  `LugarProcedencia` varchar(100) CHARACTER SET utf8 COLLATE utf8_spanish_ci NULL DEFAULT NULL,
  `LugarNacimiento` varchar(80) CHARACTER SET utf8 COLLATE utf8_spanish_ci NULL DEFAULT NULL,
  `GradoInstruccion` varchar(20) CHARACTER SET utf8 COLLATE utf8_spanish_ci NULL DEFAULT NULL,
  `RazaPaciente` varchar(20) CHARACTER SET utf8 COLLATE utf8_spanish_ci NULL DEFAULT NULL,
  `OcupacionPaciente` varchar(20) CHARACTER SET utf8 COLLATE utf8_spanish_ci NULL DEFAULT NULL,
  `ReligionPaciente` varchar(20) CHARACTER SET utf8 COLLATE utf8_spanish_ci NULL DEFAULT NULL,
  `EstadoCivil` varchar(20) CHARACTER SET utf8 COLLATE utf8_spanish_ci NULL DEFAULT NULL,
  `NumeroContactoPaciente` varchar(11) CHARACTER SET utf8 COLLATE utf8_spanish_ci NULL DEFAULT NULL,
  `NombreContactoPaciente` varchar(100) CHARACTER SET utf8 COLLATE utf8_spanish_ci NULL DEFAULT NULL,
  `UsuarioCreado` int NOT NULL,
  `UsuarioActualiza` int NOT NULL,
  `FechaCreacion` datetime NOT NULL,
  `FechaActualizacion` datetime NOT NULL,
  PRIMARY KEY (`IdPaciente`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8 COLLATE = utf8_spanish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of tba_paciente
-- ----------------------------
INSERT INTO `tba_paciente` VALUES (1, 'David', 'Poblette', 76405728, 'Masculino', '27', '0000-00-00', '987654321', '', 'Arequipa', 'Arequipa', '', '', '', '', 'Soltero', '', '', 1, 0, '2023-08-29 00:00:00', '2023-08-31 09:07:03');
INSERT INTO `tba_paciente` VALUES (2, 'Jose', 'Manrique', 456456456, '', '', '0000-00-00', '84684168468', '', '', '', '', '', '', '', '', '', '', 1, 0, '2023-08-31 08:54:03', '2023-08-31 08:54:30');
INSERT INTO `tba_paciente` VALUES (3, 'Andrea', 'Jimenez', 123123123, '', '', '0000-00-00', '1231231231', '', '', '', '', '', '', '', '', '', '', 1, 0, '2023-08-31 10:19:41', '2023-08-31 10:28:44');

-- ----------------------------
-- Table structure for tba_pago
-- ----------------------------
DROP TABLE IF EXISTS `tba_pago`;
CREATE TABLE `tba_pago`  (
  `IdPago` int NOT NULL AUTO_INCREMENT,
  `IdPaciente` int NOT NULL,
  `IdTipoPago` int NOT NULL,
  `TotalPago` decimal(10, 2) NOT NULL,
  `FechaPago` date NOT NULL,
  `ObservacionPago` varchar(200) CHARACTER SET utf8 COLLATE utf8_spanish_ci NULL DEFAULT NULL,
  `ComprobantePago` varchar(255) CHARACTER SET utf8 COLLATE utf8_spanish_ci NULL DEFAULT NULL,
  `FechaCreacion` datetime NOT NULL,
  `FechaActualizacion` datetime NOT NULL,
  PRIMARY KEY (`IdPago`) USING BTREE,
  INDEX `fk_paciente_pago`(`IdPaciente`) USING BTREE,
  INDEX `fk_tipopago_pago`(`IdTipoPago`) USING BTREE,
  CONSTRAINT `fk_paciente_pago` FOREIGN KEY (`IdPaciente`) REFERENCES `tba_paciente` (`IdPaciente`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `fk_tipopago_pago` FOREIGN KEY (`IdTipoPago`) REFERENCES `tba_tipodepago` (`IdTipoPago`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8 COLLATE = utf8_spanish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of tba_pago
-- ----------------------------
INSERT INTO `tba_pago` VALUES (1, 2, 1, 150.00, '2023-08-25', '', NULL, '2023-08-31 09:18:54', '2023-08-31 09:18:54');
INSERT INTO `tba_pago` VALUES (2, 3, 3, 600.00, '2023-08-31', '', NULL, '2023-08-31 10:34:30', '2023-08-31 10:34:30');

-- ----------------------------
-- Table structure for tba_perfilusuario
-- ----------------------------
DROP TABLE IF EXISTS `tba_perfilusuario`;
CREATE TABLE `tba_perfilusuario`  (
  `IdPerfilUsuario` int NOT NULL AUTO_INCREMENT,
  `NombrePerfil` varchar(20) CHARACTER SET utf8 COLLATE utf8_spanish_ci NULL DEFAULT NULL,
  PRIMARY KEY (`IdPerfilUsuario`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8 COLLATE = utf8_spanish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of tba_perfilusuario
-- ----------------------------
INSERT INTO `tba_perfilusuario` VALUES (1, 'Administrador');
INSERT INTO `tba_perfilusuario` VALUES (2, 'Recepcionista');
INSERT INTO `tba_perfilusuario` VALUES (3, 'Medico');

-- ----------------------------
-- Table structure for tba_procedimiento
-- ----------------------------
DROP TABLE IF EXISTS `tba_procedimiento`;
CREATE TABLE `tba_procedimiento`  (
  `IdProcedimiento` int NOT NULL AUTO_INCREMENT,
  `NombreProcedimiento` varchar(150) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `PrecioPromedio` decimal(10, 2) NOT NULL,
  `IdTipoProcedimiento` int NOT NULL,
  `FechaCreacion` datetime NOT NULL,
  `FechaActualizacion` datetime NOT NULL,
  PRIMARY KEY (`IdProcedimiento`) USING BTREE,
  INDEX `tba_procedimiento_fkTipoProcedimiento`(`IdTipoProcedimiento`) USING BTREE,
  CONSTRAINT `fk_tipoprocedimiento_procedimiento` FOREIGN KEY (`IdTipoProcedimiento`) REFERENCES `tba_tipoprocedimiento` (`IdTipoProcedimiento`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8 COLLATE = utf8_spanish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of tba_procedimiento
-- ----------------------------
INSERT INTO `tba_procedimiento` VALUES (1, 'Curación del diente x', 250.00, 1, '2023-08-29 00:00:00', '2023-08-29 00:00:00');

-- ----------------------------
-- Table structure for tba_socio
-- ----------------------------
DROP TABLE IF EXISTS `tba_socio`;
CREATE TABLE `tba_socio`  (
  `IdSocio` int NOT NULL AUTO_INCREMENT,
  `NombreSocio` varchar(150) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `IdTipoIdentificacion` int NULL DEFAULT NULL,
  `IdTipoSocio` int NOT NULL,
  `Identificacion` varchar(15) CHARACTER SET utf8 COLLATE utf8_spanish_ci NULL DEFAULT NULL,
  `FechaCreacion` datetime NOT NULL,
  `FechaActualizacion` datetime NOT NULL,
  PRIMARY KEY (`IdSocio`) USING BTREE,
  INDEX `tba_socio_fksocios`(`IdTipoIdentificacion`) USING BTREE,
  INDEX `tba_socio_fktiposocio`(`IdTipoSocio`) USING BTREE,
  CONSTRAINT `fk_tipoidentificacion_socio` FOREIGN KEY (`IdTipoIdentificacion`) REFERENCES `tba_tipoidentificacion` (`IdTipoIdentificacion`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `fk_tiposocio_socio` FOREIGN KEY (`IdTipoSocio`) REFERENCES `tba_tiposocio` (`IdTipoSocio`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8 COLLATE = utf8_spanish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of tba_socio
-- ----------------------------
INSERT INTO `tba_socio` VALUES (1, 'Diego Jimenez', 1, 2, '12345678', '2023-08-26 12:06:53', '2023-08-26 12:07:11');
INSERT INTO `tba_socio` VALUES (2, 'Liam Neeson', 1, 1, '78456321', '2023-08-26 12:07:05', '2023-08-26 12:07:05');

-- ----------------------------
-- Table structure for tba_tipodepago
-- ----------------------------
DROP TABLE IF EXISTS `tba_tipodepago`;
CREATE TABLE `tba_tipodepago`  (
  `IdTipoPago` int NOT NULL AUTO_INCREMENT,
  `DescripcionTipo` varchar(30) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`IdTipoPago`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 7 CHARACTER SET = utf8 COLLATE = utf8_spanish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of tba_tipodepago
-- ----------------------------
INSERT INTO `tba_tipodepago` VALUES (1, 'Efectivo');
INSERT INTO `tba_tipodepago` VALUES (2, 'Yape');
INSERT INTO `tba_tipodepago` VALUES (3, 'Plin');
INSERT INTO `tba_tipodepago` VALUES (4, 'Tarjeta');
INSERT INTO `tba_tipodepago` VALUES (5, 'Deposito');
INSERT INTO `tba_tipodepago` VALUES (6, 'Transferencia');

-- ----------------------------
-- Table structure for tba_tipoidentificacion
-- ----------------------------
DROP TABLE IF EXISTS `tba_tipoidentificacion`;
CREATE TABLE `tba_tipoidentificacion`  (
  `IdTipoIdentificacion` int NOT NULL AUTO_INCREMENT,
  `NombreTipoIdentificacion` varchar(20) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`IdTipoIdentificacion`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8 COLLATE = utf8_spanish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of tba_tipoidentificacion
-- ----------------------------
INSERT INTO `tba_tipoidentificacion` VALUES (1, 'DNI');
INSERT INTO `tba_tipoidentificacion` VALUES (2, 'RUC');
INSERT INTO `tba_tipoidentificacion` VALUES (3, 'OTRO');

-- ----------------------------
-- Table structure for tba_tipoprocedimiento
-- ----------------------------
DROP TABLE IF EXISTS `tba_tipoprocedimiento`;
CREATE TABLE `tba_tipoprocedimiento`  (
  `IdTipoProcedimiento` int NOT NULL AUTO_INCREMENT,
  `NombreTipoProcedimiento` varchar(100) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`IdTipoProcedimiento`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8 COLLATE = utf8_spanish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of tba_tipoprocedimiento
-- ----------------------------
INSERT INTO `tba_tipoprocedimiento` VALUES (1, 'Curaciones');

-- ----------------------------
-- Table structure for tba_tiposocio
-- ----------------------------
DROP TABLE IF EXISTS `tba_tiposocio`;
CREATE TABLE `tba_tiposocio`  (
  `IdTipoSocio` int NOT NULL AUTO_INCREMENT,
  `NombreTipoSocio` varchar(255) CHARACTER SET utf8 COLLATE utf8_spanish_ci NULL DEFAULT NULL,
  PRIMARY KEY (`IdTipoSocio`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8 COLLATE = utf8_spanish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of tba_tiposocio
-- ----------------------------
INSERT INTO `tba_tiposocio` VALUES (1, 'Proveedor');
INSERT INTO `tba_tiposocio` VALUES (2, 'Medico');

-- ----------------------------
-- Table structure for tba_tratamiento
-- ----------------------------
DROP TABLE IF EXISTS `tba_tratamiento`;
CREATE TABLE `tba_tratamiento`  (
  `IdTratamiento` int NOT NULL AUTO_INCREMENT,
  `IdHistoriaClinica` int NOT NULL,
  `IdPaciente` int NOT NULL,
  `TotalTratamiento` decimal(10, 2) NULL DEFAULT NULL,
  `TotalPagado` decimal(10, 2) NULL DEFAULT NULL,
  `UsuarioCreado` int NOT NULL,
  `UsuarioActualiza` int NOT NULL,
  `FechaCreacion` datetime NOT NULL,
  `FechaActualizacion` datetime NOT NULL,
  PRIMARY KEY (`IdTratamiento`) USING BTREE,
  INDEX `fk_historiaclinica_tratamiento`(`IdHistoriaClinica`) USING BTREE,
  CONSTRAINT `fk_historiaclinica_tratamiento` FOREIGN KEY (`IdHistoriaClinica`) REFERENCES `tba_historiaclinica` (`IdHistoriaClinica`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 10 CHARACTER SET = utf8 COLLATE = utf8_spanish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of tba_tratamiento
-- ----------------------------
INSERT INTO `tba_tratamiento` VALUES (7, 7, 2, 750.00, 150.00, 1, 1, '2023-08-31 08:54:31', '2023-08-31 08:54:31');
INSERT INTO `tba_tratamiento` VALUES (8, 8, 1, 1250.00, NULL, 1, 1, '2023-08-31 08:59:41', '2023-08-31 08:59:41');
INSERT INTO `tba_tratamiento` VALUES (9, 9, 3, 605.00, 600.00, 1, 1, '2023-08-31 10:28:44', '2023-08-31 10:28:44');

-- ----------------------------
-- Table structure for tba_usuario
-- ----------------------------
DROP TABLE IF EXISTS `tba_usuario`;
CREATE TABLE `tba_usuario`  (
  `IdUsuario` int NOT NULL AUTO_INCREMENT,
  `IdPerfilUsuario` int NOT NULL,
  `NombreUsuario` varchar(50) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `CorreoUsuario` varchar(255) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `PasswordUsuario` varchar(100) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `CelularUsuario` int NULL DEFAULT NULL,
  `FechaCreacion` datetime NOT NULL,
  `FechaActualizacion` datetime NOT NULL,
  `UltimaConexion` datetime NULL DEFAULT NULL,
  PRIMARY KEY (`IdUsuario`) USING BTREE,
  INDEX `tba_usuario_fkPerfilUsuario`(`IdPerfilUsuario`) USING BTREE,
  CONSTRAINT `tba_usuario_fkPerfilUsuario` FOREIGN KEY (`IdPerfilUsuario`) REFERENCES `tba_perfilusuario` (`IdPerfilUsuario`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8 COLLATE = utf8_spanish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of tba_usuario
-- ----------------------------
INSERT INTO `tba_usuario` VALUES (1, 1, 'Administrador', 'admin@gmail.com', '$2a$07$usesomesillystringforeh6tvwDNOAiEn9PYXfY79K3vDiKj6Ib6', 987654321, '2023-07-19 00:00:00', '2023-07-19 00:00:00', '2023-08-31 08:35:07');
INSERT INTO `tba_usuario` VALUES (2, 3, 'Liam Neeson', 'liam@gmail.com', '$2a$07$usesomesillystringforeh6tvwDNOAiEn9PYXfY79K3vDiKj6Ib6', NULL, '2023-08-19 11:00:53', '2023-08-19 11:00:53', '2023-08-19 11:01:48');

SET FOREIGN_KEY_CHECKS = 1;

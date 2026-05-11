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

 Date: 05/09/2023 16:56:10
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

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
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8 COLLATE = utf8_spanish_ci ROW_FORMAT = Dynamic;

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
) ENGINE = InnoDB AUTO_INCREMENT = 7 CHARACTER SET = utf8 COLLATE = utf8_spanish_ci ROW_FORMAT = Dynamic;

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
) ENGINE = InnoDB AUTO_INCREMENT = 40 CHARACTER SET = utf8 COLLATE = utf8_spanish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for tba_historiaclinica
-- ----------------------------
DROP TABLE IF EXISTS `tba_historiaclinica`;
CREATE TABLE `tba_historiaclinica`  (
  `IdHistoriaClinica` int NOT NULL AUTO_INCREMENT,
  `IdPaciente` int NOT NULL,
  `IdUsuario` int NOT NULL,
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
  INDEX `fk_usuario_historia`(`IdUsuario`) USING BTREE,
  CONSTRAINT `fk_paciente_historia` FOREIGN KEY (`IdPaciente`) REFERENCES `tba_paciente` (`IdPaciente`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `fk_usuario_historia` FOREIGN KEY (`IdUsuario`) REFERENCES `tba_usuario` (`IdUsuario`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 12 CHARACTER SET = utf8 COLLATE = utf8_spanish_ci ROW_FORMAT = Dynamic;

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
) ENGINE = InnoDB AUTO_INCREMENT = 6 CHARACTER SET = utf8 COLLATE = utf8_spanish_ci ROW_FORMAT = DYNAMIC;

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
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = utf8 COLLATE = utf8_spanish_ci ROW_FORMAT = DYNAMIC;

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
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8 COLLATE = utf8_spanish_ci ROW_FORMAT = DYNAMIC;

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
-- Table structure for tba_tipoprocedimiento
-- ----------------------------
DROP TABLE IF EXISTS `tba_tipoprocedimiento`;
CREATE TABLE `tba_tipoprocedimiento`  (
  `IdTipoProcedimiento` int NOT NULL AUTO_INCREMENT,
  `NombreTipoProcedimiento` varchar(100) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`IdTipoProcedimiento`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8 COLLATE = utf8_spanish_ci ROW_FORMAT = DYNAMIC;

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
) ENGINE = InnoDB AUTO_INCREMENT = 12 CHARACTER SET = utf8 COLLATE = utf8_spanish_ci ROW_FORMAT = DYNAMIC;

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
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8 COLLATE = utf8_spanish_ci ROW_FORMAT = DYNAMIC;

SET FOREIGN_KEY_CHECKS = 1;

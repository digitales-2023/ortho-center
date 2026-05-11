/*
 Development Database - Orthocenter Pro
 Consolidated from db_orthocenter.sql and pruebasbetaacide_concha.sql
 Combined Modules: CITAS, COSTOS, COTIZACION, GASTOS, HISTORIAS, PACIENTES, PAGOS, PROCEDIMIENTOS, SOCIOS, USUARIOS, VISITAS, TRATAMIENTO
 
 Creation Date: 06/05/2026
 Target Server Type: MySQL
 Target Server Version: 10.6.24-MariaDB
 Database Encoding: utf8mb3
*/

SET NAMES utf8mb3;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Create Database
-- ----------------------------
DROP DATABASE IF EXISTS `dev_orthocenter`;
CREATE DATABASE `dev_orthocenter` CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci;
USE `dev_orthocenter`;

-- ----------------------------
-- Table structure for tba_perfilusuario
-- ----------------------------
DROP TABLE IF EXISTS `tba_perfilusuario`;
CREATE TABLE `tba_perfilusuario` (
  `IdPerfilUsuario` int NOT NULL AUTO_INCREMENT,
  `NombrePerfil` varchar(20) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NULL DEFAULT NULL,
  PRIMARY KEY (`IdPerfilUsuario`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8mb3 COLLATE = utf8mb3_spanish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Table structure for tba_usuario
-- ----------------------------
DROP TABLE IF EXISTS `tba_usuario`;
CREATE TABLE `tba_usuario` (
  `IdUsuario` int NOT NULL AUTO_INCREMENT,
  `IdPerfilUsuario` int NOT NULL,
  `NombreUsuario` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `CorreoUsuario` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `PasswordUsuario` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `CelularUsuario` int NULL DEFAULT NULL,
  `FechaCreacion` datetime NOT NULL,
  `FechaActualizacion` datetime NOT NULL,
  `UltimaConexion` datetime NULL DEFAULT NULL,
  PRIMARY KEY (`IdUsuario`) USING BTREE,
  INDEX `tba_usuario_fkPerfilUsuario`(`IdPerfilUsuario`) USING BTREE,
  CONSTRAINT `tba_usuario_fkPerfilUsuario` FOREIGN KEY (`IdPerfilUsuario`) REFERENCES `tba_perfilusuario` (`IdPerfilUsuario`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8mb3 COLLATE = utf8mb3_spanish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Table structure for tba_paciente
-- ----------------------------
DROP TABLE IF EXISTS `tba_paciente`;
CREATE TABLE `tba_paciente` (
  `IdPaciente` int NOT NULL AUTO_INCREMENT,
  `NombrePaciente` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `ApellidoPaciente` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `TipoIdentificacion` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `NumeroIdentificacion` varchar(16) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `SexoPaciente` varchar(12) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NULL DEFAULT NULL,
  `EdadPaciente` varchar(11) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NULL DEFAULT NULL,
  `FechaNacimiento` date NULL DEFAULT NULL,
  `CelularPaciente` varchar(11) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `DomicilioPaciente` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NULL DEFAULT NULL,
  `LugarProcedencia` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NULL DEFAULT NULL,
  `LugarNacimiento` varchar(80) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NULL DEFAULT NULL,
  `GradoInstruccion` varchar(20) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NULL DEFAULT NULL,
  `RazaPaciente` varchar(20) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NULL DEFAULT NULL,
  `OcupacionPaciente` varchar(20) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NULL DEFAULT NULL,
  `ReligionPaciente` varchar(20) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NULL DEFAULT NULL,
  `EstadoCivil` varchar(20) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NULL DEFAULT NULL,
  `NumeroContactoPaciente` varchar(11) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NULL DEFAULT NULL,
  `NombreContactoPaciente` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NULL DEFAULT NULL,
  `UsuarioCreado` int NULL DEFAULT NULL,
  `UsuarioActualiza` int NULL DEFAULT NULL,
  `FechaCreacion` datetime NOT NULL,
  `FechaActualizacion` datetime NOT NULL,
  PRIMARY KEY (`IdPaciente`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb3 COLLATE = utf8mb3_spanish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Table structure for tba_tipoprocedimiento
-- ----------------------------
DROP TABLE IF EXISTS `tba_tipoprocedimiento`;
CREATE TABLE `tba_tipoprocedimiento` (
  `IdTipoProcedimiento` int NOT NULL AUTO_INCREMENT,
  `NombreTipoProcedimiento` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  PRIMARY KEY (`IdTipoProcedimiento`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8mb3 COLLATE = utf8mb3_spanish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Table structure for tba_tipoidentificacion
-- ----------------------------
DROP TABLE IF EXISTS `tba_tipoidentificacion`;
CREATE TABLE `tba_tipoidentificacion` (
  `IdTipoIdentificacion` int NOT NULL AUTO_INCREMENT,
  `NombreTipoIdentificacion` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  PRIMARY KEY (`IdTipoIdentificacion`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 6 CHARACTER SET = utf8mb3 COLLATE = utf8mb3_spanish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Table structure for tba_tiposocio
-- ----------------------------
DROP TABLE IF EXISTS `tba_tiposocio`;
CREATE TABLE `tba_tiposocio` (
  `IdTipoSocio` int NOT NULL AUTO_INCREMENT,
  `NombreTipoSocio` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NULL DEFAULT NULL,
  PRIMARY KEY (`IdTipoSocio`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = utf8mb3 COLLATE = utf8mb3_spanish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Table structure for tba_procedimiento
-- ----------------------------
DROP TABLE IF EXISTS `tba_procedimiento`;
CREATE TABLE `tba_procedimiento` (
  `IdProcedimiento` int NOT NULL AUTO_INCREMENT,
  `NombreProcedimiento` varchar(150) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `PrecioPromedio` decimal(10, 2) NOT NULL,
  `IdTipoProcedimiento` int NOT NULL,
  `FechaCreacion` datetime NOT NULL,
  `FechaActualizacion` datetime NOT NULL,
  PRIMARY KEY (`IdProcedimiento`) USING BTREE,
  INDEX `tba_procedimiento_fkTipoProcedimiento`(`IdTipoProcedimiento`) USING BTREE,
  CONSTRAINT `fk_tipoprocedimiento_procedimiento` FOREIGN KEY (`IdTipoProcedimiento`) REFERENCES `tba_tipoprocedimiento` (`IdTipoProcedimiento`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb3 COLLATE = utf8mb3_spanish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Table structure for tba_cita
-- ----------------------------
DROP TABLE IF EXISTS `tba_cita`;
CREATE TABLE `tba_cita` (
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
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb3 COLLATE = utf8mb3_spanish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Table structure for tba_historiaclinica
-- ----------------------------
DROP TABLE IF EXISTS `tba_historiaclinica`;
CREATE TABLE `tba_historiaclinica` (
  `IdHistoriaClinica` int NOT NULL AUTO_INCREMENT,
  `IdPaciente` int NOT NULL,
  `IdSocio` int NULL DEFAULT NULL,
  `AlergiasEncontradas` varchar(500) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NULL DEFAULT NULL,
  `MotivoConsulta` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NULL DEFAULT NULL,
  `DatosInformante` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NULL DEFAULT NULL,
  `TiempoEnfermedad` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NULL DEFAULT NULL,
  `SignosSintomas` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NULL DEFAULT NULL,
  `RelatoCronologico` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NULL DEFAULT NULL,
  `FuncionesBiologicas` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NULL DEFAULT NULL,
  `AntecedentesFamiliares` varchar(500) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NULL DEFAULT NULL,
  `AntecedentesPersonales` varchar(500) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NULL DEFAULT NULL,
  `RutaOdontograma` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NULL DEFAULT NULL,
  `UsuarioCreado` int NOT NULL,
  `UsuarioActualizado` int NOT NULL,
  `FechaCreado` datetime NOT NULL,
  `FechaActualiza` datetime NOT NULL,
  PRIMARY KEY (`IdHistoriaClinica`) USING BTREE,
  INDEX `fk_paciente_historia`(`IdPaciente`) USING BTREE,
  CONSTRAINT `fk_paciente_historia` FOREIGN KEY (`IdPaciente`) REFERENCES `tba_paciente` (`IdPaciente`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb3 COLLATE = utf8mb3_spanish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Table structure for tba_tratamiento
-- ----------------------------
DROP TABLE IF EXISTS `tba_tratamiento`;
CREATE TABLE `tba_tratamiento` (
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
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb3 COLLATE = utf8mb3_spanish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Table structure for tba_detallehistoriaclinica
-- ----------------------------
DROP TABLE IF EXISTS `tba_detallehistoriaclinica`;
CREATE TABLE `tba_detallehistoriaclinica` (
  `IdDetalleHistoriaClinica` int NOT NULL AUTO_INCREMENT,
  `IdHistoriaClinica` int NOT NULL,
  `IdTratamiento` int NOT NULL,
  `PresionArterial` varchar(25) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NULL DEFAULT NULL,
  `Pulso` varchar(25) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NULL DEFAULT NULL,
  `Temperatura` varchar(25) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NULL DEFAULT NULL,
  `FrecuenciaCardiaca` varchar(25) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NULL DEFAULT NULL,
  `FrecuenciaRespiratoria` varchar(25) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NULL DEFAULT NULL,
  `ExamenOdonto` varchar(150) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NULL DEFAULT NULL,
  `DiagnosticoPresuntivo` varchar(150) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NULL DEFAULT NULL,
  `DiagnosticoDefinitivo` varchar(150) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NULL DEFAULT NULL,
  `Pronostico` varchar(500) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NULL DEFAULT NULL,
  `TratamientoPaciente` varchar(500) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NULL DEFAULT NULL,
  `InformacionAlta` varchar(500) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NULL DEFAULT NULL,
  `FechaCreado` datetime NOT NULL,
  `FechaActualiza` datetime NOT NULL,
  `UsuarioCreado` int NOT NULL,
  `UsuarioActualizado` int NOT NULL,
  PRIMARY KEY (`IdDetalleHistoriaClinica`) USING BTREE,
  INDEX `fk_historiaclinica_detallehistoria`(`IdHistoriaClinica`) USING BTREE,
  INDEX `fk_tratamiento_detallehistoria`(`IdTratamiento`) USING BTREE,
  CONSTRAINT `fk_historiaclinica_detallehistoria` FOREIGN KEY (`IdHistoriaClinica`) REFERENCES `tba_historiaclinica` (`IdHistoriaClinica`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb3 COLLATE = utf8mb3_spanish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Table structure for tba_detalletratamiento
-- ----------------------------
DROP TABLE IF EXISTS `tba_detalletratamiento`;
CREATE TABLE `tba_detalletratamiento` (
  `IdDetalleTratamiento` int NOT NULL AUTO_INCREMENT,
  `IdTratamiento` int NOT NULL,
  `IdProcedimiento` int NOT NULL,
  `EstadoTratamiento` int NOT NULL,
  `MedicoProcedimiento` int NULL DEFAULT NULL,
  `FechaProcedimiento` date NULL DEFAULT NULL,
  `ObservacionProcedimiento` varchar(150) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NULL DEFAULT NULL,
  `PrecioProcedimiento` decimal(10, 2) NOT NULL,
  PRIMARY KEY (`IdDetalleTratamiento`) USING BTREE,
  INDEX `fk_tratamiento_detalletratamiento`(`IdTratamiento`) USING BTREE,
  INDEX `fk_procedimiento_detalletratamiento`(`IdProcedimiento`) USING BTREE,
  CONSTRAINT `fk_procedimiento_detalletratamiento` FOREIGN KEY (`IdProcedimiento`) REFERENCES `tba_procedimiento` (`IdProcedimiento`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `fk_tratamiento_detalletratamiento` FOREIGN KEY (`IdTratamiento`) REFERENCES `tba_tratamiento` (`IdTratamiento`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb3 COLLATE = utf8mb3_spanish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Table structure for tba_tipodepago
-- ----------------------------
DROP TABLE IF EXISTS `tba_tipodepago`;
CREATE TABLE `tba_tipodepago` (
  `IdTipoPago` int NOT NULL AUTO_INCREMENT,
  `DescripcionTipo` varchar(30) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  PRIMARY KEY (`IdTipoPago`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 7 CHARACTER SET = utf8mb3 COLLATE = utf8mb3_spanish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Table structure for tba_pago
-- ----------------------------
DROP TABLE IF EXISTS `tba_pago`;
CREATE TABLE `tba_pago` (
  `IdPago` int NOT NULL AUTO_INCREMENT,
  `IdPaciente` int NOT NULL,
  `IdTipoPago` int NOT NULL,
  `TotalPago` decimal(10, 2) NOT NULL,
  `FechaPago` date NOT NULL,
  `ObservacionPago` varchar(200) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NULL DEFAULT NULL,
  `ComprobantePago` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NULL DEFAULT NULL,
  `FechaCreacion` datetime NOT NULL,
  `FechaActualizacion` datetime NOT NULL,
  PRIMARY KEY (`IdPago`) USING BTREE,
  INDEX `fk_paciente_pago`(`IdPaciente`) USING BTREE,
  INDEX `fk_tipopago_pago`(`IdTipoPago`) USING BTREE,
  CONSTRAINT `fk_paciente_pago` FOREIGN KEY (`IdPaciente`) REFERENCES `tba_paciente` (`IdPaciente`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `fk_tipopago_pago` FOREIGN KEY (`IdTipoPago`) REFERENCES `tba_tipodepago` (`IdTipoPago`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb3 COLLATE = utf8mb3_spanish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Table structure for tba_centrocostos
-- ----------------------------
DROP TABLE IF EXISTS `tba_centrocostos`;
CREATE TABLE `tba_centrocostos` (
  `IdCentroCostos` int NOT NULL AUTO_INCREMENT,
  `DescripcionCentro` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `FechaCreacion` datetime NOT NULL,
  `FechaActualizacion` datetime NOT NULL,
  PRIMARY KEY (`IdCentroCostos`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb3 COLLATE = utf8mb3_spanish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Table structure for tba_gasto
-- ----------------------------
DROP TABLE IF EXISTS `tba_gasto`;
CREATE TABLE `tba_gasto` (
  `IdGasto` int NOT NULL AUTO_INCREMENT,
  `IdCentroCostos` int NOT NULL,
  `NombreGasto` varchar(150) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `FechaCreacion` datetime NOT NULL,
  `FechaActualizacion` datetime NOT NULL,
  PRIMARY KEY (`IdGasto`) USING BTREE,
  INDEX `fk_centrocostos_gasto`(`IdCentroCostos`) USING BTREE,
  CONSTRAINT `fk_centrocostos_gasto` FOREIGN KEY (`IdCentroCostos`) REFERENCES `tba_centrocostos` (`IdCentroCostos`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb3 COLLATE = utf8mb3_spanish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Table structure for tba_costo
-- ----------------------------
DROP TABLE IF EXISTS `tba_costo`;
CREATE TABLE `tba_costo` (
  `IdCosto` int NOT NULL AUTO_INCREMENT,
  `IdCentroCostos` int NOT NULL,
  `MesCosto` varchar(10) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `TotalCosto` decimal(10, 2) NOT NULL,
  `EstadoCosto` int NOT NULL,
  `UsuarioCreado` int NOT NULL,
  `UsuarioActualiza` int NOT NULL,
  `FechaCreacion` datetime NOT NULL,
  `FechaActualizacion` datetime NOT NULL,
  PRIMARY KEY (`IdCosto`) USING BTREE,
  INDEX `fk_centrocostos_costo`(`IdCentroCostos`) USING BTREE,
  CONSTRAINT `fk_centrocostos_costo` FOREIGN KEY (`IdCentroCostos`) REFERENCES `tba_centrocostos` (`IdCentroCostos`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb3 COLLATE = utf8mb3_spanish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Table structure for tba_detallecosto
-- ----------------------------
DROP TABLE IF EXISTS `tba_detallecosto`;
CREATE TABLE `tba_detallecosto` (
  `IdDetalleCosto` int NOT NULL AUTO_INCREMENT,
  `IdCosto` int NOT NULL,
  `IdGasto` int NOT NULL,
  `NumeroDocumento` varchar(25) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `ObservacionGasto` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `FechaCosto` date NOT NULL,
  `PrecioGasto` decimal(10, 2) NOT NULL,
  PRIMARY KEY (`IdDetalleCosto`) USING BTREE,
  INDEX `fk_costo_detallecosto`(`IdCosto`) USING BTREE,
  INDEX `fk_gasto_detallecosto`(`IdGasto`) USING BTREE,
  CONSTRAINT `fk_costo_detallecosto` FOREIGN KEY (`IdCosto`) REFERENCES `tba_costo` (`IdCosto`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `fk_gasto_detallecosto` FOREIGN KEY (`IdGasto`) REFERENCES `tba_gasto` (`IdGasto`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb3 COLLATE = utf8mb3_spanish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Table structure for tba_cotizacion
-- ----------------------------
DROP TABLE IF EXISTS `tba_cotizacion`;
CREATE TABLE `tba_cotizacion` (
  `IdCotizacion` int NOT NULL AUTO_INCREMENT,
  `IdPaciente` int NOT NULL,
  `TotalCotizacion` decimal(10, 2) NOT NULL,
  `FechaCotizacion` date NOT NULL,
  `EstadoCotizacion` varchar(10) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `UsuarioCreado` int NOT NULL,
  `UsuarioActualiza` int NOT NULL,
  `FechaCreacion` datetime NOT NULL,
  `FechaActualizacion` datetime NOT NULL,
  PRIMARY KEY (`IdCotizacion`) USING BTREE,
  INDEX `fk_paciente_cotizacion`(`IdPaciente`) USING BTREE,
  CONSTRAINT `fk_paciente_cotizacion` FOREIGN KEY (`IdPaciente`) REFERENCES `tba_paciente` (`IdPaciente`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb3 COLLATE = utf8mb3_spanish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Table structure for tba_detallecotizacion
-- ----------------------------
DROP TABLE IF EXISTS `tba_detallecotizacion`;
CREATE TABLE `tba_detallecotizacion` (
  `IdDetalleCotizacion` int NOT NULL AUTO_INCREMENT,
  `IdCotizacion` int NOT NULL,
  `IdProcedimiento` int NULL DEFAULT NULL,
  `ObservacionProcedimiento` varchar(150) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NULL DEFAULT NULL,
  `CantidadProcedimiento` int NOT NULL,
  `PrecioUnitario` decimal(10, 2) NOT NULL,
  `TotalProcedimiento` decimal(10, 2) NOT NULL,
  `UsuarioCreado` int NOT NULL,
  `UsuarioActualiza` int NOT NULL,
  `FechaCreacion` datetime NOT NULL,
  `FechaActualizacion` datetime NOT NULL,
  PRIMARY KEY (`IdDetalleCotizacion`) USING BTREE,
  INDEX `fk_cotizacion_detallecotizacion`(`IdCotizacion`) USING BTREE,
  INDEX `fk_procedimiento_detallecotizacion`(`IdProcedimiento`) USING BTREE,
  CONSTRAINT `fk_cotizacion_detallecotizacion` FOREIGN KEY (`IdCotizacion`) REFERENCES `tba_cotizacion` (`IdCotizacion`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `fk_procedimiento_detallecotizacion` FOREIGN KEY (`IdProcedimiento`) REFERENCES `tba_procedimiento` (`IdProcedimiento`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb3 COLLATE = utf8mb3_spanish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Table structure for tba_socio
-- ----------------------------
DROP TABLE IF EXISTS `tba_socio`;
CREATE TABLE `tba_socio` (
  `IdSocio` int NOT NULL AUTO_INCREMENT,
  `NombreSocio` varchar(150) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `IdTipoIdentificacion` int NULL DEFAULT NULL,
  `IdTipoSocio` int NOT NULL,
  `Identificacion` varchar(15) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NULL DEFAULT NULL,
  `FechaCreacion` datetime NOT NULL,
  `FechaActualizacion` datetime NOT NULL,
  PRIMARY KEY (`IdSocio`) USING BTREE,
  KEY `tba_socio_fksocios` (`IdTipoIdentificacion`) USING BTREE,
  KEY `tba_socio_fktiposocio` (`IdTipoSocio`) USING BTREE,
  CONSTRAINT `tba_socio_fksocios` FOREIGN KEY (`IdTipoIdentificacion`) REFERENCES `tba_tipoidentificacion` (`IdTipoIdentificacion`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `tba_socio_fktiposocio` FOREIGN KEY (`IdTipoSocio`) REFERENCES `tba_tiposocio` (`IdTipoSocio`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb3 COLLATE = utf8mb3_spanish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Table structure for tba_visita
-- ----------------------------
DROP TABLE IF EXISTS `tba_visita`;
CREATE TABLE `tba_visita` (
  `IdVisita` int NOT NULL AUTO_INCREMENT,
  `IdPaciente` int NOT NULL,
  `FechaVisita` datetime NOT NULL,
  `MotivoPrincipal` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NULL DEFAULT NULL,
  `Notas` varchar(500) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NULL DEFAULT NULL,
  `UsuarioCreado` int NOT NULL,
  `UsuarioActualizado` int NOT NULL,
  `FechaCreacion` datetime NOT NULL,
  `FechaActualizacion` datetime NOT NULL,
  PRIMARY KEY (`IdVisita`) USING BTREE,
  INDEX `fk_paciente_visita`(`IdPaciente`) USING BTREE,
  CONSTRAINT `fk_paciente_visita` FOREIGN KEY (`IdPaciente`) REFERENCES `tba_paciente` (`IdPaciente`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb3 COLLATE = utf8mb3_spanish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Insert Profiles
-- ----------------------------
INSERT INTO `tba_perfilusuario` (`IdPerfilUsuario`, `NombrePerfil`) VALUES (1, 'Administrador');
INSERT INTO `tba_perfilusuario` (`IdPerfilUsuario`, `NombrePerfil`) VALUES (2, 'Dentista');
INSERT INTO `tba_perfilusuario` (`IdPerfilUsuario`, `NombrePerfil`) VALUES (3, 'Recepcionista');

-- ----------------------------
-- Insert Identification Types
-- ----------------------------
INSERT INTO `tba_tipoidentificacion` (`IdTipoIdentificacion`, `NombreTipoIdentificacion`) VALUES (1, 'DNI');
INSERT INTO `tba_tipoidentificacion` (`IdTipoIdentificacion`, `NombreTipoIdentificacion`) VALUES (2, 'RUC');
INSERT INTO `tba_tipoidentificacion` (`IdTipoIdentificacion`, `NombreTipoIdentificacion`) VALUES (3, 'Pasaporte');
INSERT INTO `tba_tipoidentificacion` (`IdTipoIdentificacion`, `NombreTipoIdentificacion`) VALUES (4, 'Cédula de Identidad');
INSERT INTO `tba_tipoidentificacion` (`IdTipoIdentificacion`, `NombreTipoIdentificacion`) VALUES (5, 'Carné de Extranjería');

-- ----------------------------
-- Insert Types of Partners/Associates
-- ----------------------------
INSERT INTO `tba_tiposocio` (`IdTipoSocio`, `NombreTipoSocio`) VALUES (1, 'Medico');
INSERT INTO `tba_tiposocio` (`IdTipoSocio`, `NombreTipoSocio`) VALUES (2, 'Empleado');
INSERT INTO `tba_tiposocio` (`IdTipoSocio`, `NombreTipoSocio`) VALUES (3, 'Contratista');
INSERT INTO `tba_tiposocio` (`IdTipoSocio`, `NombreTipoSocio`) VALUES (4, 'Proveedor');

-- ----------------------------
-- Insert Default Administrator User
-- ----------------------------
-- Email: admin@orthocenter.pe
-- Password: #orthocenter20
INSERT INTO `tba_usuario` (`IdUsuario`, `IdPerfilUsuario`, `NombreUsuario`, `CorreoUsuario`, `PasswordUsuario`, `FechaCreacion`, `FechaActualizacion`) 
VALUES (1, 1, 'Administrador', 'admin@orthocenter.pe', '$2a$07$usesomesillystringfore2uDLvp1Ii2e./U9C8sBjqp8I90dH6hi', NOW(), NOW());

SET FOREIGN_KEY_CHECKS = 1;

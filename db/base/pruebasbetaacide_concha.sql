-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 06-05-2026 a las 16:33:28
-- Versión del servidor: 10.6.24-MariaDB
-- Versión de PHP: 8.4.20

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `pruebasbetaacide_concha`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tba_centrocostos`
--

CREATE TABLE `tba_centrocostos` (
  `IdCentroCostos` int(11) NOT NULL,
  `DescripcionCentro` varchar(100) NOT NULL,
  `FechaCreacion` datetime NOT NULL,
  `FechaActualizacion` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish_ci ROW_FORMAT=DYNAMIC;

--
-- Volcado de datos para la tabla `tba_centrocostos`
--

INSERT INTO `tba_centrocostos` (`IdCentroCostos`, `DescripcionCentro`, `FechaCreacion`, `FechaActualizacion`) VALUES
(1, 'Servicios Generales', '2023-07-31 11:49:50', '2023-07-31 11:49:50'),
(3, 'Costos de Laboratorio', '2023-07-31 13:22:06', '2023-07-31 13:22:06'),
(4, 'Costos de Personal', '2023-08-02 14:19:56', '2023-08-02 14:19:56'),
(5, 'Costos de Insumos', '2023-08-02 14:20:10', '2023-08-02 14:20:10');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tba_cita`
--

CREATE TABLE `tba_cita` (
  `IdCita` int(11) NOT NULL,
  `IdPaciente` int(11) NOT NULL,
  `FechaProgramada` datetime NOT NULL,
  `MedicoAsignado` int(11) NOT NULL,
  `EstadoCita` int(11) NOT NULL,
  `FechaCreacion` datetime NOT NULL,
  `FechaActualizacion` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tba_costo`
--

CREATE TABLE `tba_costo` (
  `IdCosto` int(11) NOT NULL,
  `IdCentroCostos` int(11) NOT NULL,
  `MesCosto` varchar(10) NOT NULL,
  `TotalCosto` decimal(10,2) NOT NULL,
  `EstadoCosto` int(11) NOT NULL,
  `UsuarioCreado` int(11) NOT NULL,
  `UsuarioActualiza` int(11) NOT NULL,
  `FechaCreacion` datetime NOT NULL,
  `FechaActualizacion` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tba_cotizacion`
--

CREATE TABLE `tba_cotizacion` (
  `IdCotizacion` int(11) NOT NULL,
  `IdPaciente` int(11) NOT NULL,
  `TotalCotizacion` decimal(10,2) NOT NULL,
  `FechaCotizacion` date NOT NULL,
  `EstadoCotizacion` varchar(10) NOT NULL,
  `UsuarioCreado` int(11) NOT NULL,
  `UsuarioActualiza` int(11) NOT NULL,
  `FechaCreacion` datetime NOT NULL,
  `FechaActualizacion` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish_ci ROW_FORMAT=DYNAMIC;

--
-- Volcado de datos para la tabla `tba_cotizacion`
--

INSERT INTO `tba_cotizacion` (`IdCotizacion`, `IdPaciente`, `TotalCotizacion`, `FechaCotizacion`, `EstadoCotizacion`, `UsuarioCreado`, `UsuarioActualiza`, `FechaCreacion`, `FechaActualizacion`) VALUES
(1, 1, 150.00, '2024-09-03', '1', 1, 1, '2023-11-09 16:20:04', '0000-00-00 00:00:00'),
(2, 107, 250.00, '2024-08-21', '1', 1, 1, '2024-09-17 09:07:21', '2024-09-17 09:07:21'),
(3, 432, 50.00, '2024-09-11', '1', 1, 1, '2024-09-17 09:22:28', '2024-09-17 09:22:28'),
(4, 433, 50.00, '2024-09-12', '1', 1, 1, '2024-09-17 09:25:54', '0000-00-00 00:00:00'),
(5, 434, 80.00, '2024-09-04', '1', 1, 1, '2024-09-17 09:30:30', '2024-09-17 09:30:30');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tba_detallecosto`
--

CREATE TABLE `tba_detallecosto` (
  `IdDetalleCosto` int(11) NOT NULL,
  `IdCosto` int(11) NOT NULL,
  `IdGasto` int(11) NOT NULL,
  `IdSocio` int(11) NOT NULL,
  `NumeroDocumento` varchar(25) NOT NULL,
  `ObservacionGasto` varchar(255) NOT NULL,
  `FechaCosto` date NOT NULL,
  `PrecioGasto` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tba_detallecotizacion`
--

CREATE TABLE `tba_detallecotizacion` (
  `IdDetalleCotizacion` int(11) NOT NULL,
  `IdCotizacion` int(11) NOT NULL,
  `IdProcedimiento` int(11) DEFAULT NULL,
  `ObservacionProcedimiento` varchar(150) DEFAULT NULL,
  `CantidadProcedimiento` int(11) NOT NULL,
  `PrecioUnitario` decimal(10,2) NOT NULL,
  `TotalProcedimiento` decimal(10,2) NOT NULL,
  `UsuarioCreado` int(11) NOT NULL,
  `UsuarioActualiza` int(11) NOT NULL,
  `FechaCreacion` datetime NOT NULL,
  `FechaActualizacion` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish_ci ROW_FORMAT=DYNAMIC;

--
-- Volcado de datos para la tabla `tba_detallecotizacion`
--

INSERT INTO `tba_detallecotizacion` (`IdDetalleCotizacion`, `IdCotizacion`, `IdProcedimiento`, `ObservacionProcedimiento`, `CantidadProcedimiento`, `PrecioUnitario`, `TotalProcedimiento`, `UsuarioCreado`, `UsuarioActualiza`, `FechaCreacion`, `FechaActualizacion`) VALUES
(1, 1, 2, '', 2, 150.00, 300.00, 1, 1, '2023-11-09 16:20:04', '2023-11-09 16:20:04'),
(2, 2, 1, '', 1, 250.00, 250.00, 1, 1, '2024-09-17 09:07:21', '2024-09-17 09:07:21'),
(3, 3, 4, '', 1, 50.00, 50.00, 1, 1, '2024-09-17 09:22:28', '2024-09-17 09:22:28'),
(4, 4, 4, '', 1, 50.00, 50.00, 1, 1, '2024-09-17 09:25:54', '2024-09-17 09:25:54'),
(5, 5, 8, '', 1, 80.00, 80.00, 1, 1, '2024-09-17 09:30:30', '2024-09-17 09:30:30');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tba_detallehistoriaclinica`
--

CREATE TABLE `tba_detallehistoriaclinica` (
  `IdDetalleHistoriaClinica` int(11) NOT NULL,
  `IdHistoriaClinica` int(11) NOT NULL,
  `IdTratamiento` int(11) NOT NULL,
  `PresionArterial` varchar(25) DEFAULT NULL,
  `Pulso` varchar(25) DEFAULT NULL,
  `Temperatura` varchar(25) DEFAULT NULL,
  `FrecuenciaCardiaca` varchar(25) DEFAULT NULL,
  `FrecuenciaRespiratoria` varchar(25) DEFAULT NULL,
  `ExamenOdonto` varchar(150) DEFAULT NULL,
  `DiagnosticoPresuntivo` varchar(150) DEFAULT NULL,
  `DiagnosticoDefinitivo` varchar(150) DEFAULT NULL,
  `Pronostico` varchar(500) DEFAULT NULL,
  `TratamientoPaciente` varchar(500) DEFAULT NULL,
  `InformacionAlta` varchar(500) DEFAULT NULL,
  `FechaCreado` datetime NOT NULL,
  `FechaActualiza` datetime NOT NULL,
  `UsuarioCreado` int(11) NOT NULL,
  `UsuarioActualizado` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish_ci ROW_FORMAT=DYNAMIC;

--
-- Volcado de datos para la tabla `tba_detallehistoriaclinica`
--

INSERT INTO `tba_detallehistoriaclinica` (`IdDetalleHistoriaClinica`, `IdHistoriaClinica`, `IdTratamiento`, `PresionArterial`, `Pulso`, `Temperatura`, `FrecuenciaCardiaca`, `FrecuenciaRespiratoria`, `ExamenOdonto`, `DiagnosticoPresuntivo`, `DiagnosticoDefinitivo`, `Pronostico`, `TratamientoPaciente`, `InformacionAlta`, `FechaCreado`, `FechaActualiza`, `UsuarioCreado`, `UsuarioActualizado`) VALUES
(1, 3, 1, '', '', '', '', '', '', '', '', '', '', '', '2023-11-08 22:23:00', '2023-11-08 22:23:00', 2, 2),
(2, 12, 2, '', '', '', '', '', '', '', '', '', '', '', '2023-11-21 15:17:31', '2023-11-21 15:17:31', 1, 1),
(5, 15, 5, '', '', '', '', '', '', '', '', '', '', '', '2023-11-21 17:09:04', '2023-11-21 17:09:04', 1, 1),
(6, 16, 6, '', '', '', '', '', '', '', '', '', '', '', '2024-09-16 12:37:41', '2024-09-16 12:37:41', 1, 1),
(7, 17, 7, '', '', '', '', '', '', '', '', '', '', '', '2024-09-16 12:37:53', '2024-09-16 12:37:53', 1, 1),
(8, 18, 8, '', '', '', '', '', '', '', '', '', '', '', '2024-09-16 12:37:59', '2024-09-16 12:37:59', 1, 1),
(9, 19, 9, '', '', '', '', '', '', '', '', '', '', '', '2024-09-16 12:38:07', '2024-09-16 12:38:07', 1, 1),
(10, 20, 10, '', '', '', '', '', '', '', '', '', '', '', '2024-09-16 12:38:17', '2024-09-16 12:38:17', 1, 1),
(11, 21, 11, '', '', '', '', '', '', '', '', '', '', '', '2024-09-16 12:38:26', '2024-09-16 12:38:26', 1, 1),
(12, 22, 12, '', '', '', '', '', '', '', '', '', '', '', '2024-09-16 12:38:33', '2024-09-16 12:38:33', 1, 1),
(13, 23, 13, '', '', '', '', '', '', '', '', '', '', '', '2024-09-16 12:38:40', '2024-09-16 12:38:40', 1, 1),
(14, 24, 14, '', '', '', '', '', '', '', '', '', '', '', '2024-09-16 12:38:49', '2024-09-16 12:38:49', 1, 1),
(15, 25, 15, '', '', '', '', '', '', '', '', '', '', '', '2024-09-16 22:12:21', '2024-09-16 22:12:21', 1, 1),
(16, 26, 16, '', '', '', '', '', '', '', '', '', '', '', '2024-09-16 22:12:30', '2024-09-16 22:12:30', 1, 1),
(17, 27, 17, '', '', '', '', '', '', '', '', '', '', '', '2024-09-16 22:12:38', '2024-09-16 22:12:38', 1, 1),
(18, 28, 18, '', '', '', '', '', '', '', '', '', '', '', '2024-09-16 22:12:53', '2024-09-16 22:12:53', 1, 1),
(19, 29, 19, '', '', '', '', '', '', '', '', '', '', '', '2024-09-16 22:13:05', '2024-09-16 22:13:05', 1, 1),
(20, 30, 20, '', '', '', '', '', '', '', '', '', '', '', '2024-09-16 22:13:12', '2024-09-16 22:13:12', 1, 1),
(21, 31, 21, '', '', '', '', '', '', '', '', '', '', '', '2024-09-16 22:13:17', '2024-09-16 22:13:17', 1, 1),
(22, 32, 22, '', '', '', '', '', '', '', '', '', '', '', '2024-09-16 22:13:26', '2024-09-16 22:13:26', 1, 1),
(23, 33, 23, '', '', '', '', '', '', '', '', '', '', '', '2024-09-16 22:13:33', '2024-09-16 22:13:33', 1, 1),
(24, 34, 24, '', '', '', '', '', '', '', '', '', '', '', '2024-09-16 22:13:39', '2024-09-16 22:13:39', 1, 1),
(25, 35, 25, '', '', '', '', '', '', '', '', '', '', '', '2024-09-16 22:13:46', '2024-09-16 22:13:46', 1, 1),
(26, 36, 26, '', '', '', '', '', '', '', '', '', '', '', '2024-09-16 22:13:53', '2024-09-16 22:13:53', 1, 1),
(27, 37, 27, '', '', '', '', '', '', '', '', '', '', '', '2024-09-16 22:14:00', '2024-09-16 22:14:00', 1, 1),
(28, 38, 28, '', '', '', '', '', '', '', '', '', '', '', '2024-09-16 22:14:07', '2024-09-16 22:14:07', 1, 1),
(29, 39, 29, '', '', '', '', '', '', '', '', '', '', '', '2024-09-16 22:14:15', '2024-09-16 22:14:15', 1, 1),
(30, 40, 30, '', '', '', '', '', '', '', '', '', '', '', '2024-09-16 22:14:26', '2024-09-16 22:14:26', 1, 1),
(31, 41, 31, '', '', '', '', '', '', '', '', '', '', '', '2024-09-16 22:14:34', '2024-09-16 22:14:34', 1, 1),
(32, 42, 32, '', '', '', '', '', '', '', '', '', '', '', '2024-09-16 22:14:41', '2024-09-16 22:14:41', 1, 1),
(33, 43, 33, '', '', '', '', '', '', '', '', '', '', '', '2024-09-16 22:14:48', '2024-09-16 22:14:48', 1, 1),
(34, 44, 34, '', '', '', '', '', '', '', '', '', '', '', '2024-09-16 22:14:55', '2024-09-16 22:14:55', 1, 1),
(35, 45, 35, '', '', '', '', '', '', '', '', '', '', '', '2024-09-16 22:15:03', '2024-09-16 22:15:03', 1, 1),
(36, 46, 36, '', '', '', '', '', '', '', '', '', '', '', '2024-09-16 22:15:11', '2024-09-16 22:15:11', 1, 1),
(37, 47, 37, '', '', '', '', '', '', '', '', '', '', '', '2024-09-16 22:15:19', '2024-09-16 22:15:19', 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tba_detalletratamiento`
--

CREATE TABLE `tba_detalletratamiento` (
  `IdDetalleTratamiento` int(11) NOT NULL,
  `IdTratamiento` int(11) NOT NULL,
  `IdProcedimiento` int(11) NOT NULL,
  `EstadoTratamiento` int(11) NOT NULL,
  `MedicoProcedimiento` int(11) DEFAULT NULL,
  `FechaProcedimiento` date DEFAULT NULL,
  `ObservacionProcedimiento` varchar(150) DEFAULT NULL,
  `PrecioProcedimiento` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish_ci ROW_FORMAT=DYNAMIC;

--
-- Volcado de datos para la tabla `tba_detalletratamiento`
--

INSERT INTO `tba_detalletratamiento` (`IdDetalleTratamiento`, `IdTratamiento`, `IdProcedimiento`, `EstadoTratamiento`, `MedicoProcedimiento`, `FechaProcedimiento`, `ObservacionProcedimiento`, `PrecioProcedimiento`) VALUES
(5, 1, 1, 2, 3, '2023-11-08', '', 30.00),
(6, 1, 2, 1, NULL, '0000-00-00', '', 1.00),
(19, 5, 1, 2, 2, '2023-11-10', 'retiro de Brackets', 50.00),
(20, 5, 4, 2, 2, '2023-11-15', 'Pzas 17-16-25', 280.00),
(21, 5, 12, 2, 2, '2023-11-16', 'Pza nro 47', 400.00),
(22, 5, 35, 1, NULL, '0000-00-00', '', 300.00),
(23, 5, 34, 1, NULL, '0000-00-00', '', 700.00),
(24, 5, 36, 1, NULL, '0000-00-00', 'cada 23 dias', 150.00),
(25, 37, 3, 1, 1, '2024-09-17', '', 250.00),
(26, 37, 4, 1, 2, '0000-00-00', '', 360.00),
(27, 37, 6, 1, 1, '0000-00-00', '', 420.00),
(28, 36, 8, 1, NULL, '0000-00-00', '', 250.00),
(29, 36, 9, 1, NULL, '0000-00-00', '', 350.00),
(30, 36, 21, 1, NULL, '0000-00-00', '', 150.00),
(31, 35, 6, 1, NULL, '0000-00-00', '', 150.00),
(32, 35, 3, 1, NULL, '0000-00-00', '', 250.00),
(33, 35, 2, 1, NULL, '0000-00-00', '', 300.00),
(34, 34, 1, 1, NULL, '0000-00-00', '', 150.00),
(35, 34, 2, 1, NULL, '0000-00-00', '', 250.00),
(36, 34, 4, 1, NULL, '0000-00-00', '', 110.00),
(37, 33, 6, 1, NULL, '0000-00-00', '', 150.00),
(38, 33, 7, 1, NULL, '0000-00-00', '', 200.00),
(39, 29, 6, 1, NULL, '0000-00-00', '', 100.00),
(40, 29, 7, 1, NULL, '0000-00-00', '', 120.00),
(41, 28, 4, 1, NULL, '0000-00-00', '', 150.00),
(42, 28, 5, 1, NULL, '0000-00-00', '', 250.00);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tba_gasto`
--

CREATE TABLE `tba_gasto` (
  `IdGasto` int(11) NOT NULL,
  `IdCentroCostos` int(11) NOT NULL,
  `NombreGasto` varchar(150) NOT NULL,
  `FechaCreacion` datetime NOT NULL,
  `FechaActualizacion` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tba_historiaclinica`
--

CREATE TABLE `tba_historiaclinica` (
  `IdHistoriaClinica` int(11) NOT NULL,
  `IdPaciente` int(11) NOT NULL,
  `IdSocio` int(11) DEFAULT NULL,
  `AlergiasEncontradas` varchar(500) DEFAULT NULL,
  `MotivoConsulta` varchar(255) DEFAULT NULL,
  `DatosInformante` varchar(255) DEFAULT NULL,
  `TiempoEnfermedad` varchar(255) DEFAULT NULL,
  `SignosSintomas` varchar(255) DEFAULT NULL,
  `RelatoCronologico` varchar(255) DEFAULT NULL,
  `FuncionesBiologicas` varchar(255) DEFAULT NULL,
  `AntecedentesFamiliares` varchar(500) DEFAULT NULL,
  `AntecedentesPersonales` varchar(500) DEFAULT NULL,
  `RutaOdontograma` varchar(255) DEFAULT NULL,
  `UsuarioCreado` int(11) NOT NULL,
  `UsuarioActualizado` int(11) NOT NULL,
  `FechaCreado` datetime NOT NULL,
  `FechaActualiza` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish_ci ROW_FORMAT=DYNAMIC;

--
-- Volcado de datos para la tabla `tba_historiaclinica`
--

INSERT INTO `tba_historiaclinica` (`IdHistoriaClinica`, `IdPaciente`, `IdSocio`, `AlergiasEncontradas`, `MotivoConsulta`, `DatosInformante`, `TiempoEnfermedad`, `SignosSintomas`, `RelatoCronologico`, `FuncionesBiologicas`, `AntecedentesFamiliares`, `AntecedentesPersonales`, `RutaOdontograma`, `UsuarioCreado`, `UsuarioActualizado`, `FechaCreado`, `FechaActualiza`) VALUES
(3, 1, 2, '', '', '', '', '', '', '', '', '', NULL, 2, 2, '2024-08-01 22:23:00', '2024-07-02 20:23:00'),
(12, 32, 1, '', '', '', '', '', '', '', '', '', NULL, 1, 1, '2023-11-21 15:17:31', '2024-07-05 15:17:31'),
(15, 428, 1, '', '', '', '', '', '', '', '', '', NULL, 1, 1, '2023-11-21 17:09:04', '2024-07-06 17:09:04'),
(16, 13, 1, '', '', '', '', '', '', '', '', '', NULL, 1, 1, '2024-09-16 12:37:41', '2024-07-12 12:37:41'),
(17, 16, 1, '', '', '', '', '', '', '', '', '', NULL, 1, 1, '2024-09-16 12:37:53', '2024-07-19 12:37:53'),
(18, 20, 1, '', '', '', '', '', '', '', '', '', NULL, 1, 1, '2024-09-16 12:37:59', '2024-07-28 12:37:59'),
(19, 31, 1, '', '', '', '', '', '', '', '', '', NULL, 1, 1, '2024-09-16 12:38:07', '2024-08-08 16:23:00'),
(20, 39, 1, '', '', '', '', '', '', '', '', '', NULL, 1, 1, '2024-09-16 12:38:17', '2024-08-11 15:23:31'),
(21, 42, 1, '', '', '', '', '', '', '', '', '', NULL, 1, 1, '2024-09-16 12:38:26', '2024-08-08 17:32:04'),
(22, 47, 1, '', '', '', '', '', '', '', '', '', NULL, 1, 1, '2024-09-16 12:38:33', '2024-08-16 11:14:41'),
(23, 49, 1, '', '', '', '', '', '', '', '', '', NULL, 1, 1, '2024-09-16 12:38:40', '2024-08-19 12:36:53'),
(24, 50, 1, '', '', '', '', '', '', '', '', '', NULL, 1, 1, '2024-08-16 12:38:49', '2024-08-20 12:37:59'),
(25, 33, 1, '', '', '', '', '', '', '', '', '', NULL, 1, 1, '2024-09-16 22:12:21', '2024-08-22 22:12:21'),
(26, 37, 1, '', '', '', '', '', '', '', '', '', NULL, 1, 1, '2024-09-16 22:12:30', '2024-08-27 10:12:30'),
(27, 38, 1, '', '', '', '', '', '', '', '', '', NULL, 1, 1, '2024-09-16 22:12:38', '2024-08-27 16:12:38'),
(28, 41, 1, '', '', '', '', '', '', '', '', '', NULL, 1, 1, '2024-09-16 22:12:53', '2024-08-28 09:12:53'),
(29, 58, 1, '', '', '', '', '', '', '', '', '', NULL, 1, 1, '2024-09-16 22:13:05', '2024-08-29 10:13:05'),
(30, 63, 1, '', '', '', '', '', '', '', '', '', NULL, 1, 1, '2024-09-16 22:13:12', '2024-08-29 13:13:12'),
(31, 66, 1, '', '', '', '', '', '', '', '', '', NULL, 1, 1, '2024-09-16 22:13:17', '2024-08-30 12:13:17'),
(32, 79, 1, '', '', '', '', '', '', '', '', '', NULL, 1, 1, '2024-09-16 22:13:26', '2024-09-01 09:13:26'),
(33, 91, 1, '', '', '', '', '', '', '', '', '', NULL, 1, 1, '2024-09-16 22:13:33', '2024-09-01 13:13:33'),
(34, 95, 1, '', '', '', '', '', '', '', '', '', NULL, 1, 1, '2024-09-16 22:13:39', '2024-09-01 22:13:39'),
(35, 98, 1, '', '', '', '', '', '', '', '', '', NULL, 1, 1, '2024-09-16 22:13:46', '2024-09-04 15:13:46'),
(36, 101, 1, '', '', '', '', '', '', '', '', '', NULL, 1, 1, '2024-09-16 22:13:53', '2024-09-09 16:13:53'),
(37, 103, 1, '', '', '', '', '', '', '', '', '', NULL, 1, 1, '2024-09-16 22:14:00', '2024-09-13 13:14:00'),
(38, 107, 1, '', '', '', '', '', '', '', '', '', NULL, 1, 1, '2024-09-16 22:14:07', '2024-09-16 22:14:07'),
(39, 111, 1, '', '', '', '', '', '', '', '', '', NULL, 1, 1, '2024-09-16 22:14:15', '2024-09-16 22:14:15'),
(40, 113, 1, '', '', '', '', '', '', '', '', '', NULL, 1, 1, '2024-09-16 22:14:26', '2024-09-16 22:14:26'),
(41, 117, 1, '', '', '', '', '', '', '', '', '', NULL, 1, 1, '2024-09-16 22:14:34', '2024-09-16 22:14:34'),
(42, 123, 1, '', '', '', '', '', '', '', '', '', NULL, 1, 1, '2024-09-16 22:14:41', '2024-09-16 22:14:41'),
(43, 135, 1, '', '', '', '', '', '', '', '', '', NULL, 1, 1, '2024-09-16 22:14:48', '2024-09-16 22:14:48'),
(44, 145, 1, '', '', '', '', '', '', '', '', '', NULL, 1, 1, '2024-09-16 22:14:55', '2024-09-16 22:14:55'),
(45, 151, 1, '', '', '', '', '', '', '', '', '', NULL, 1, 1, '2024-09-16 22:15:03', '2024-09-16 22:15:03'),
(46, 157, 1, '', '', '', '', '', '', '', '', '', NULL, 1, 1, '2024-09-16 22:15:11', '2024-09-16 22:15:11'),
(47, 162, 1, '', '', '', '', '', '', '', '', '', NULL, 1, 1, '2024-09-16 22:15:19', '2024-09-16 22:15:19');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tba_paciente`
--

CREATE TABLE `tba_paciente` (
  `IdPaciente` int(11) NOT NULL,
  `NombrePaciente` varchar(100) NOT NULL,
  `ApellidoPaciente` varchar(100) NOT NULL,
  `TipoIdentificacion` varchar(50) NOT NULL,
  `NumeroIdentificacion` varchar(16) NOT NULL,
  `SexoPaciente` varchar(12) DEFAULT NULL,
  `EdadPaciente` varchar(11) DEFAULT NULL,
  `FechaNacimiento` date DEFAULT NULL,
  `CelularPaciente` varchar(11) NOT NULL,
  `DomicilioPaciente` varchar(255) DEFAULT NULL,
  `LugarProcedencia` varchar(100) DEFAULT NULL,
  `LugarNacimiento` varchar(80) DEFAULT NULL,
  `GradoInstruccion` varchar(20) DEFAULT NULL,
  `RazaPaciente` varchar(20) DEFAULT NULL,
  `OcupacionPaciente` varchar(20) DEFAULT NULL,
  `ReligionPaciente` varchar(20) DEFAULT NULL,
  `EstadoCivil` varchar(20) DEFAULT NULL,
  `NumeroContactoPaciente` varchar(11) DEFAULT NULL,
  `NombreContactoPaciente` varchar(100) DEFAULT NULL,
  `UsuarioCreado` int(11) DEFAULT NULL,
  `UsuarioActualiza` int(11) DEFAULT NULL,
  `FechaCreacion` datetime NOT NULL,
  `FechaActualizacion` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish_ci ROW_FORMAT=DYNAMIC;

--
-- Volcado de datos para la tabla `tba_paciente`
--

INSERT INTO `tba_paciente` (`IdPaciente`, `NombrePaciente`, `ApellidoPaciente`, `TipoIdentificacion`, `NumeroIdentificacion`, `SexoPaciente`, `EdadPaciente`, `FechaNacimiento`, `CelularPaciente`, `DomicilioPaciente`, `LugarProcedencia`, `LugarNacimiento`, `GradoInstruccion`, `RazaPaciente`, `OcupacionPaciente`, `ReligionPaciente`, `EstadoCivil`, `NumeroContactoPaciente`, `NombreContactoPaciente`, `UsuarioCreado`, `UsuarioActualiza`, `FechaCreacion`, `FechaActualizacion`) VALUES
(1, 'LOURDES', 'ACOSTA PARRILLO', 'DNI', '29230250', 'FEMENINO', '61', '1962-06-18', '989690835', 'LA PRADERA . CERRO COLORADO', 'AREQUIPA', 'AREQUIPA', 'SUPERIOR', '', 'SU CASA', 'CATOLICA', '', '', '', 1, NULL, '2023-11-08 13:22:10', '2023-11-08 22:23:00'),
(2, 'TATIANA', 'AROCUTIPA GOMEZ', 'DNI', '71524312', 'FEMENINO', '21', '2002-10-22', '930545812', 'URB. EL ROSARIO CAYMA', 'AREQUIPA', 'AREQUIPA', 'SUPERIOR', NULL, 'ESTUDIANTE', '', '', NULL, NULL, 1, 1, '2023-11-08 13:22:10', '2023-11-08 13:22:10'),
(3, 'ADRIANA', 'ARANGUREN JIMENEZ', 'DNI', '90023501', 'FEMENINO', '06', '2017-01-09', '989032767', 'LA PUNTA DE BOMBON - MOLLENDO ', 'ISLAY ', 'MOLLENDO ', 'ESTUDIANTE ', NULL, 'ESTUDIANTE', '', '', NULL, NULL, 1, 1, '2023-11-08 13:22:10', '2023-11-08 13:22:10'),
(4, 'GISELL', 'ACHAHUI SANCHEZ', 'DNI', '46757128', 'FEMENINO', '32', '1991-01-30', '940149049', 'LAS CONDES A-5  YANAHUARA', 'AREQUIPA', 'AREQUIPA', 'SUPERIOR', NULL, 'ADMINISTRADORA', '', '', NULL, NULL, 1, 1, '2023-11-08 13:22:10', '2023-11-08 13:22:10'),
(5, 'ALICIA', 'ALOSILLA DE CHIRINOS', 'DNI', '40937835', 'FEMENINO', '42', '1981-03-29', '954955043', 'LOS OLIVOS -CAYMA', 'AREQUIPA', 'AREQUIPA', 'SUPERIOR', NULL, 'SU CASA', '', '', NULL, NULL, 1, 1, '2023-11-08 13:22:10', '2023-11-08 13:22:10'),
(6, 'BRISA', 'ALENCASTRE', 'DNI', '71461861', 'FEMENINO', '', '0000-00-00', '956688241', '', 'AREQUIPA', 'AREQUIPA', 'SUPERIOR', NULL, '', '', '', NULL, NULL, 1, 1, '2023-11-08 13:22:10', '2023-11-08 13:22:10'),
(7, 'MARIA ALEJANDRA', 'ARENAS RAMIREZ', 'DNI', '46045757', 'FEMENINO', '33', '1989-11-08', '992136145', 'CABAÑA MARIA -CERCADO ', 'AREQUIPA', 'AREQUIPA', 'SUPERIOR', NULL, 'ADMINISTRADORA', '', '', NULL, NULL, 1, 1, '2023-11-08 13:22:10', '2023-11-08 13:22:10'),
(8, 'AVELINA', 'ASCUÑA MAYHUA', 'DNI', '09344582', 'FEMENINO', '49', '1974-02-05', '986207252', 'LAS FLORES . CERRO COLORADO', 'AREQUIPA', 'AREQUIPA', '', NULL, '', '', '', NULL, NULL, 1, 1, '2023-11-08 13:22:10', '2023-11-08 13:22:10'),
(9, 'ROSARIO', 'ARREDONDO LAYME', 'DNI', '72276234', 'FEMENINO', '25', '1998-06-17', '921787684', 'ALTO SELVA ALEGRE', 'AREQUIPA', 'AREQUIPA', '', NULL, '', '', '', NULL, NULL, 1, 1, '2023-11-08 13:22:10', '2023-11-08 13:22:10'),
(10, 'FROINA', 'ALFARO', 'DNI', '29297617', 'FEMENINO', '57', '1966-04-08', '959614116', '', 'CUZCO', 'CUZCO', '', NULL, '', '', '', NULL, NULL, 1, 1, '2023-11-08 13:22:10', '2023-11-08 13:22:10'),
(11, 'GUILLERMINA', 'APAZA', 'DNI', '42101814', 'FEMENINO', '42', '1981-04-24', '975588157', 'PJ 23 DE JUNIO MZ D LOTE 9', 'AREQUIPA', 'AREQUIPA', '', NULL, 'AMA DE CASA', '', '', NULL, NULL, 1, 1, '2023-11-08 13:22:10', '2023-11-08 13:22:10'),
(12, 'JHONATHAN', 'AYMA', 'DNI', '44198042', 'MASCULINO', '36', '1987-01-14', '959749784', 'CALLE AREQUIPA 207 B C. SAN JACINTO ', 'AREQUIPA', 'AREQUIPA', '', NULL, '', '', '', NULL, NULL, 1, 1, '2023-11-08 13:22:10', '2023-11-08 13:22:10'),
(13, 'DAYRON', 'ALFARO', 'DNI', '80872972', 'MASCULINO', '08', '2015-06-03', '967991512', 'CERRO COLORADO', 'C.COLORADO', 'AREQUIPA', 'ESTUDIANTE ', '', '', '', '', '', '', 1, NULL, '2023-11-08 13:22:10', '2024-09-16 12:37:41'),
(14, 'FLOR', 'ALIAGA CAMPOS', 'DNI', '43268349', 'FEMENINO', '44', '1979-01-22', '996117632', '', 'AREQUIPA', 'AREQUIPA', '', NULL, '', '', '', NULL, NULL, 1, 1, '2023-11-08 13:22:10', '2023-11-08 13:22:10'),
(15, 'ANDREA ISABELA', 'AREVALO GIRALDO', 'DNI', '74105927', 'FEMENINO', '24', '1999-07-07', '952409598', 'CAYMA', 'AREQUIPA', 'AREQUIPA', 'ESTUDIANTE ', NULL, '', '', '', NULL, NULL, 1, 1, '2023-11-08 13:22:10', '2023-11-08 13:22:10'),
(16, 'RICARDO', 'AYALA FLORES', 'DNI', '29672790', 'FEMENINO', '74', '1949-01-01', '979719818', '', '', '', '', '', '', '', '', '', '', 1, NULL, '2023-11-08 13:22:10', '2024-09-16 12:37:53'),
(17, 'FRANCESCA', 'ABARCA', 'DNI', '70004599', 'FEMENINO', '30', '1993-01-13', '995577083', 'C.COLORADO', 'AREQUIPA', 'AREQUIPA', 'ESTUDIANTE ', NULL, '', '', '', NULL, NULL, 1, 1, '2023-11-08 13:22:10', '2023-11-08 13:22:10'),
(18, 'MEDALID', 'ALFARO', 'DNI', '70553159', 'FEMENINO', '27', '1996-02-25', '928719683', 'PERUARBO E-10 C.COLORADO', 'C. COLORADO', 'AREQUIPA', 'SUPERIOR', NULL, '', '', '', NULL, NULL, 1, 1, '2023-11-08 13:22:10', '2023-11-08 13:22:10'),
(19, 'MANUEL ANTONIO', 'AREVALO SULSO', 'DNI', '41500117', 'MASCULINO', '01', '2022-06-11', '971378012', 'CAYMA', 'CAYMA ', 'AREQUIPA', 'SUPERIOR', NULL, '', '', '', NULL, NULL, 1, 1, '2023-11-08 13:22:10', '2023-11-08 13:22:10'),
(20, 'GREGORIA', 'APFATA CJURO', 'DNI', '24782285', 'FEMENINO', '61', '1962-08-10', '997822285', 'AV. AVIACIÓN ', 'C. COLORADO', 'AREQUIPA', '', '', '', '', '', '', '', 1, NULL, '2023-11-08 13:22:10', '2024-09-16 12:37:59'),
(21, 'NATALY', 'ARTEAGA', 'DNI', '45102077', 'FEMENINO', '35', '1988-04-04', '951159508', 'C, SAN JACINTO CAYMA', 'CAYMA ', 'AREQUIPA', '', NULL, '', '', '', NULL, NULL, 1, 1, '2023-11-08 13:22:10', '2023-11-08 13:22:10'),
(22, 'MARIA ALEJANDRA', 'ANGLES', 'DNI', '46041541', 'FEMENINO', '33', '1989-11-22', '986678022', 'CALLE MISTI YANAHUARA', 'YANAHUARA', 'AREQUIPA', '', NULL, '', '', '', NULL, NULL, 1, 1, '2023-11-08 13:22:10', '2023-11-08 13:22:10'),
(23, 'GIANMARCO', 'AROQUIPA CCORIMANYA', 'DNI', '47057075', 'MASCULINO', '32', '1991-05-21', '912547283', 'MARISCAL CACERES', 'C. COLORADO ', 'AREQUIPA', 'SUPERIOR ', NULL, 'ASIST. LOGISTICA', '', '', NULL, NULL, 1, 1, '2023-11-08 13:22:10', '2023-11-08 13:22:10'),
(24, 'SANTIAGO', 'AMPUERO', 'DNI', '60967106', 'MASCULINO', '16', '2007-02-19', '956047099', 'AV. PIZARRO 112 JLBY RIVERO', 'JLBYR', 'AREQUIPA', 'ESTUDIANTE ', NULL, '', '', '', NULL, NULL, 1, 1, '2023-11-08 13:22:10', '2023-11-08 13:22:10'),
(25, 'RUTH', 'ARROYO BEGAZO', 'DNI', '29247784', 'FEMENINO', '70', '1953-08-15', '992113370', '', '', '', '', NULL, '', '', '', NULL, NULL, 1, 1, '2023-11-08 13:22:10', '2023-11-08 13:22:10'),
(26, 'GRACE', 'ALPACA', 'DNI', '45500782', 'FEMENINO', '32', '0000-00-00', '950310883', 'DEAN VALDIVIA E-9 CAYMA', '', '', '', NULL, '', '', '', NULL, NULL, 1, 1, '2023-11-08 13:22:10', '2023-11-08 13:22:10'),
(27, 'LUCIO', 'BENAVENTE CHAVEZ', 'DNI', '43408638', 'MASCULINO', '62', '1961-05-23', '959883988', 'VILLA MIRADOR B-41 CAYMA ', 'CAYMA', 'AREQUIPA', 'SUPERIOR', NULL, '', '', '', NULL, NULL, 1, 1, '2023-11-08 13:22:10', '2023-11-08 13:22:10'),
(28, 'SILVIA', 'BAHAMONDES', 'DNI', '29220320', 'FEMENINO', '86', '1937-03-21', '959188868', '', '', '', '', NULL, '', '', '', NULL, NULL, 1, 1, '2023-11-08 13:22:10', '2023-11-08 13:22:10'),
(29, 'JORDAN', 'BECERRA', 'DNI', '71486395', 'MASCULINO', '30', '1993-01-13', '957881947', '', '', '', '', NULL, '', '', '', NULL, NULL, 1, 1, '2023-11-08 13:22:10', '2023-11-08 13:22:10'),
(30, 'LUIS', 'BRILLANTE', 'DNI', '78803084', 'MASCULINO', '24', '1999-07-23', '997777983', 'ENACE SECTOR II CAYMA ', 'CAYMA', 'AREQUIPA', 'SUPERIOR', NULL, '', '', '', NULL, NULL, 1, 1, '2023-11-08 13:22:10', '2023-11-08 13:22:10'),
(31, 'CLAUDIA', 'BEGAZO', 'DNI', '46324656', 'FEMENINO', '34', '1989-08-14', '991587060', 'URB. LA PEÑA B-( SACHACA', 'SACHACA ', 'AREQUIPA', 'SUPERIOR', '', 'ARQUITECTA', '', '', '', '', 1, NULL, '2023-11-08 13:22:10', '2024-09-16 12:38:07'),
(32, 'HERLY', 'BENAVENTE', 'DNI', '43331594', 'FEMENINO', '38', '1985-10-16', '963974600', 'URB SAN JESUS -C-10 PAUCARPATA ', 'PAUCARPATA ', 'AREQUIPA', 'SUPERIOR', '', '', '', '', '', '', 1, NULL, '2023-11-08 13:22:10', '2023-11-21 15:17:31'),
(33, 'GIOVANA', 'BOLOCO SUMAYANI', 'DNI', '29661418', 'FEMENINO', '48', '1975-04-14', '945794026', 'URB ALTO CERRO VERDE B-4', 'C. VERDE', 'AREQUIPA', 'SUPERIOR', '', '', '', '', '', '', 1, NULL, '2023-11-08 13:22:10', '2024-09-16 22:12:21'),
(34, 'ANA BELEN', 'CUBA', 'DNI', '70005571', 'FEMENINO', '33', '1990-10-02', '984442335', 'LOS PORTALES - CAYMA', 'CAYMA', 'AREQUIPA', 'SUPERIOR', NULL, '', '', '', NULL, NULL, 1, 1, '2023-11-08 13:22:10', '2023-11-08 13:22:10'),
(35, 'WALTER', 'BANDA', 'DNI', '29273145', 'MASCULINO', '70', '1953-10-16', '958097886', 'VALLE BLANCO 85', 'C. COLORADO', 'AREQUIPA', 'SUPERIOR', NULL, '', '', '', NULL, NULL, 1, 1, '2023-11-08 13:22:10', '2023-11-08 13:22:10'),
(36, 'FLORANGEL', 'BENGOA FERIA', 'DNI', '29417450', 'FEMENINO', '06', '2017-07-13', '993225451', 'CALLE AMAZONAS 608 ', 'SELVA ALEGRE ', 'AREQUIPA', '', NULL, '', '', '', NULL, NULL, 1, 1, '2023-11-08 13:22:10', '2023-11-08 13:22:10'),
(37, 'EDWIN', 'BARDALES  HUAMAN', 'DNI', '26731732', 'MASCULINO', '53', '1970-02-21', '980508390', 'VALLE BLANCO 85', 'C. COLORADO', 'AREQUIPA', 'SUPERIOR', '', '', '', '', '', '', 1, NULL, '2023-11-08 13:22:10', '2024-09-16 22:12:30'),
(38, 'ADRIANA', 'BENAVIDES', 'DNI', '29347345', 'FEMENINO', '60', '1963-10-27', '992744276', 'CORBACHO 304 C. COLORADO ', 'C. COLORADO ', 'AREQUIPA', '', '', '', '', '', '', '', 1, NULL, '2023-11-08 13:22:10', '2024-09-16 22:12:38'),
(39, 'MILAGROS', 'BENDEZÚ MONTALVAN', 'DNI', '73034486', 'FEMENINO', '26', '1997-09-21', '992231561', 'LEANDRO TORRES 1455- HUANCAYO', 'HUANCAYO ', 'AREQUIPA', '', '', '', '', '', '', '', 1, NULL, '2023-11-08 13:22:10', '2024-09-16 12:38:17'),
(40, 'FERNANDO', 'BENAVENTE CORDOVA', 'DNI', '71710650', 'MASCULINO', '19', '2004-03-23', '967318907', 'SOCABAYA', 'SOCABAYA', 'AREQUIPA', 'ESTUDIANTE ', NULL, '', '', '', NULL, NULL, 1, 1, '2023-11-08 13:22:10', '2023-11-08 13:22:10'),
(41, 'MARIA ALEJANDRA', 'BORJA GALLEGOS', 'DNI', '44735136', 'FEMENINO', '35', '1988-10-28', '994799584', 'EL OLIVAR B-1 TAHUAYCANI ', 'YANAHUARA ', 'AREQUIPA', 'SUPERIOR', '', 'ADMINISTRADORA ', '', '', '', '', 1, NULL, '2023-11-08 13:22:10', '2024-09-16 22:12:53'),
(42, 'NICOL', 'CRUZ CORIMANYA', 'DNI', '60835825', 'FEMENINO', '16', '2007-09-07', '931809389', '', '', '', 'ESTUDIANTE ', '', '', '', '', '', '', 1, NULL, '2023-11-08 13:22:10', '2024-09-16 12:38:26'),
(43, 'ROXANA', 'CHAVEZ', 'DNI', '29512816', 'FEMENINO', '59', '1964-01-22', '915352650', '', '', '', '', NULL, '', '', '', NULL, NULL, 1, 1, '2023-11-08 13:22:10', '2023-11-08 13:22:10'),
(44, 'FRACK', 'CORNEJO VALDIVIA', 'DNI', '40948554', 'MASCULINO', '42', '1981-06-17', '956328501', '', '', '', '', NULL, '', '', '', NULL, NULL, 1, 1, '2023-11-08 13:22:10', '2023-11-08 13:22:10'),
(45, 'STEPHANIE', 'CHENEAUX', 'DNI', '46819503', 'FEMENINO', '33', '1990-09-07', '959397448', 'PIEDRA SANTA 1RA ETAPA C5  DEP 501', 'YANAHUARA', 'AREQUIPA', 'SUPERIOR', NULL, '', '', '', NULL, NULL, 1, 1, '2023-11-08 13:22:10', '2023-11-08 13:22:10'),
(46, 'ALFREDO', 'CHAVEZ DELGADO', 'DNI', '29286571', 'MASCULINO', '63', '1960-10-23', '959371414', 'GRAU 117', 'SACHACA ', 'AREQUIPA', 'SUPERIOR', NULL, 'MEDICO', '', '', NULL, NULL, 1, 1, '2023-11-08 13:22:10', '2023-11-08 13:22:10'),
(47, 'CRISTHIAN', 'CHAVEZ PAREDES', 'DNI', '47972168', 'MASCULINO', '30', '1993-08-05', '957063417', 'CALLE OBANDO 102', 'SACHACA ', 'AREQUIPA', 'SUPERIOR', '', 'INGENIERO ', '', '', '', '', 1, NULL, '2023-11-08 13:22:10', '2024-09-16 12:38:33'),
(48, 'CARLOS', 'CHILO VALDEZ', 'DNI', '29629781', 'MASCULINO', '29', '1994-05-18', '948318312', 'URB VALLE ESCONDIDO D-19', 'CAYMA', 'AREQUIPA', 'SUPERIOR', NULL, 'EMPLEADO', '', '', NULL, NULL, 1, 1, '2023-11-08 13:22:10', '2023-11-08 13:22:10'),
(49, 'JESICA BEATRIZ', 'CALLO', 'DNI', '49014439', 'FEMENINO', '36', '1987-06-18', '977832160', 'PASAJE HUASVCAR 204 A', 'YANAHUARA', 'AREQUIPA', 'SUPERIOR', '', 'MEDICO', '', '', '', '', 1, NULL, '2023-11-08 13:22:10', '2024-09-16 12:38:40'),
(50, 'ALISON', 'CARBAJAL', 'DNI', '74662977', 'FEMENINO', '29', '1994-03-12', '974545723', 'AV. MADRE DE DIOS 305 P. CAMARONES', 'SACHACA ', 'AREQUIPA', 'SUPERIOR', '', 'MEDICO', '', '', '', '', 1, NULL, '2023-11-08 13:22:10', '2024-09-16 12:38:49'),
(51, 'ELOISA', 'CUSI CHURA', 'DNI', '44857869', 'FEMENINO', '36', '1987-04-18', '944201065', 'ENACE 425 CAYMA ', 'CAYMA ', 'AREQUIPA', 'SUPERIOR', NULL, 'SU CASA', '', '', NULL, NULL, 1, 1, '2023-11-08 13:22:10', '2023-11-08 13:22:10'),
(52, 'FIORELLA MARIEL', 'CANAZA MAYTA', 'DNI', '71573144', 'FEMENINO', '19', '2004-08-05', '920189994', 'CARLOS AREVALO NRO 60 ', 'CERCADO ', 'AREQUIPA', 'ESTUDIANTE ', NULL, '', '', '', NULL, NULL, 1, 1, '2023-11-08 13:22:10', '2023-11-08 13:22:10'),
(53, 'LUIS', 'SOSA', 'DNI', '30832159', 'MASCULINO', '56', '1967-02-17', '950924520', 'MOLLENDO ', 'ISLAY ', 'AREQUIPA', 'SUPERIOR', NULL, 'COMERCIAMNTE', '', '', NULL, NULL, 1, 1, '2023-11-08 13:22:10', '2023-11-08 13:22:10'),
(54, 'ELIANA', 'SOSA', 'DNI', '30821324', 'FEMENINO', '60', '1962-12-17', '942076623', 'MOLLENDO ', 'MATARANI ', 'AREQUIPA', 'SUPERIOR', NULL, 'COMERCIANTE', '', '', NULL, NULL, 1, 1, '2023-11-08 13:22:10', '2023-11-08 13:22:10'),
(55, 'FLOR', 'NAJARRO', 'DNI', '29376996', 'FEMENINO', '59', '1964-10-16', '950368609', 'URB. MONTEBELLO M-9 CERRO COLORADO ', 'AREQUIPA', 'AREQUIPA', 'SUPERIOR', NULL, '', '', 'CASADA', NULL, NULL, 1, 1, '2023-11-08 13:22:10', '2023-11-08 13:22:10'),
(56, 'GUSTAVO', 'RUIZ DE SOMOCURCIO', 'DNI', '29327194', 'MASCULINO', '55', '1968-01-06', '981422976', 'AV. BOLOGNESI -YANAHUARA', 'AREQUIPA', 'AREQUIPA', 'SUPERIOR', NULL, 'ADMINISTRADOR ', '', 'CASADO', NULL, NULL, 1, 1, '2023-11-08 13:22:10', '2023-11-08 13:22:10'),
(57, 'ARNALDO', 'MEJIA', 'DNI', '29254561', 'MASCULINO', '68', '1955-05-12', '979376426', 'BOLIVAR 407', 'AREQUIPA', 'AREQUIPA', 'SUPERIOR', NULL, 'ADMINISTRADOR ', '', '', NULL, NULL, 1, 1, '2023-11-08 13:22:10', '2023-11-08 13:22:10'),
(58, 'JULIO', 'QUISPE', 'DNI', '72628635', 'MASCULINO', '19', '2004-10-17', '986441442', 'CALLE MANZANITOS 115', 'CERCADO ', 'ICA', 'ESTUDIANTE ', '', '', '', '', '', '', 1, NULL, '2023-11-08 13:22:10', '2024-09-16 22:13:05'),
(59, 'AHLEY', 'QUISPE  CALLOAPAZA', 'DNI', '72206186', 'FEMENINO', '06', '2017-07-05', '955020253', 'MARIANO MELGAR', 'AREQUIPA', 'AREQUIPA', 'ESTUDIANTE ', NULL, '', '', '', NULL, NULL, 1, 1, '2023-11-08 13:22:10', '2023-11-08 13:22:10'),
(60, 'ALBERTO', 'QUISPE PARI', 'DNI', '73996618', 'MASCULINO', '20', '2003-07-16', '950779078', 'CERRO COLORADO ', 'AREQUIPA', 'AREQUIPA', 'ESTUDIANTE ', NULL, '', '', '', NULL, NULL, 1, 1, '2023-11-08 13:22:10', '2023-11-08 13:22:10'),
(61, 'RUPERTA', 'QUICAÑA', 'DNI', '30570143', 'FEMENINO', '79', '1944-03-07', '950293704', '', 'AREQUIPA', 'AREQUIPA', '', '', 'SU CASA', '', '', '', '', 1, NULL, '2023-11-08 13:22:10', '2023-11-09 15:55:25'),
(62, 'MONICA', 'QUISPE BARRA', 'DNI', '30963585', 'FEMENINO', '46', '1977-05-06', '941135527', 'AV. 54 VILLA PARAISO Q-5 ', 'C. COLORADO ', 'AREQUIPA', '', NULL, '', '', 'SOTERA', NULL, NULL, 1, 1, '2023-11-08 13:22:10', '2023-11-08 13:22:10'),
(63, 'ALAN', 'QUINTANILLA', 'DNI', '42996755', 'MASCULINO', '38', '1985-03-23', '958198025', 'CERCADO', 'AREQUIPA', 'AREQUIPA', '', '', '', '', '', '', '', 1, NULL, '2023-11-08 13:22:10', '2024-09-16 22:13:12'),
(64, 'BRIANA ALEJANDRA', 'QUINTANILLA GOMEZ', 'DNI', '81629848', 'FEMENINO', '08', '2015-07-08', '992638048', '', 'AREQUIPA', 'AREQUIPA', '', NULL, '', '', '', NULL, NULL, 1, 1, '2023-11-08 13:22:10', '2023-11-08 13:22:10'),
(65, 'MARTHA', 'QUENTA MACHUCA', 'DNI', '29313133', 'FEMENINO', '66', '1957-01-17', '980762008', '', 'SOCABAYA', 'AREQUIPA', '', NULL, '', '', '', NULL, NULL, 1, 1, '2023-11-08 13:22:10', '2023-11-08 13:22:10'),
(66, 'ROSA', 'QUISPE FLORES', 'DNI', '01777150', 'FEMENINO', '53', '1970-01-30', '9581710224', 'C. COLORADO ', 'C. COLORADO ', 'AREQUIPA', '', '', '', '', '', '', '', 1, NULL, '2023-11-08 13:22:10', '2024-09-16 22:13:17'),
(67, 'NEIL', 'QUIJANO CASTAÑEDA', 'DNI', '40422829', 'MASCULINO', '44', '1979-09-20', '958210757', 'CERRO COLORADO ', 'C. COLORADO ', 'AREQUIPA', 'SUPERIOR', NULL, '', '', '', NULL, NULL, 1, 1, '2023-11-08 13:22:10', '2023-11-08 13:22:10'),
(68, 'FABRICIO NEYMAR', 'QUISPE QUISPE', 'DNI', '81194725', 'MASCULINO', '10', '2013-09-04', '951601653', '', 'PUNO', 'PUNO', '', NULL, '', '', '', NULL, NULL, 1, 1, '2023-11-08 13:22:10', '2023-11-08 13:22:10'),
(69, 'NIMER', 'QUISPE', 'DNI', '45087531', 'MASCULINO', '35', '1988-04-16', '958006860', 'PASAJE LOS EUCALIPTOS X-15 ', 'SOCABAYA', 'AREQUIPA', '', NULL, '', '', '', NULL, NULL, 1, 1, '2023-11-08 13:22:10', '2023-11-08 13:22:10'),
(70, 'FRANCISCO', 'QUICAÑA', 'DNI', '30657263', 'MASCULINO', '70', '1953-06-04', '974605090', '', 'AREQUIPA', 'AREQUIPA', '', NULL, '', '', '', NULL, NULL, 1, 1, '2023-11-08 13:22:10', '2023-11-08 13:22:10'),
(71, 'PAMELA', 'QUIROZ', 'DNI', '72897419', 'FEMENINO', '30', '1992-12-18', '965396506', 'URB SAN RAFEL C-2', 'YANAHUARA', 'AREQUIPA', '', NULL, '', '', '', NULL, NULL, 1, 1, '2023-11-08 13:22:10', '2023-11-08 13:22:10'),
(72, 'ANTONIA', 'QUISPE ZAPANA', 'DNI', '02427281', 'FEMENINO', '52', '1971-06-13', '950861781', 'GONZALES PRADFA 648', 'C. COLORADO ', 'AREQUIPA', '', NULL, '', '', '', NULL, NULL, 1, 1, '2023-11-08 13:22:10', '2023-11-08 13:22:10'),
(73, 'ANA PAULA', 'RUIZ DE SOMOCURCIO', 'DNI', '72111462', 'FEMENINO', '27', '1996-09-10', '983727745', 'AV. BOLOGNESI 902', 'CAYYMA', 'AREQUIPA', 'SUPERIOR', NULL, 'ADMINISTRADOR', '', 'SOLTER', NULL, NULL, 1, 1, '2023-11-08 13:22:10', '2023-11-08 13:22:10'),
(74, 'EDWIN', 'ROJAS ARAUJO', 'DNI', '40475870', 'MASCULINO', '44', '1978-12-03', '952514906', 'JUVENTUD FERROVIARIA F-9 B CERCADO ', 'CERCADO ', 'AREQUIPA ', 'SUPERIOR', NULL, '', '', '', NULL, NULL, 1, 1, '2023-11-08 13:22:10', '2023-11-08 13:22:10'),
(75, 'GUSTAVO', 'RUIZ DE SOMOCURCIO CUADROS', 'DNI', '72111466', 'MASCULINO', '19', '2003-12-18', '981422977', '', 'AREQUIPA', 'AREQUIPA', 'SUPERIOR', NULL, 'ESTUDIANTE ', '', '', NULL, NULL, 1, 1, '2023-11-08 13:22:10', '2023-11-08 13:22:10'),
(76, 'MAGALI ROXANA', 'RIVERA AVALOS', 'DNI', '47323878', 'FEMENINO', '31', '1992-08-23', '997044476', 'PASAJE LAS PEÑAS B-15 HUNTER', 'AREQUIPA', 'AREQUIPA', 'TECNICO SUPERIOR', NULL, '', '', '', NULL, NULL, 1, 1, '2023-11-08 13:22:10', '2023-11-08 13:22:10'),
(77, 'FLAVIA', 'ROJAS AVALOS', 'DNI', '62701593', 'FEMENINO', '12', '2010-12-07', '993003031', 'JUAN XXII  UMACOLLO', 'AREQUIPA', 'AREQUIPA ', 'ESTUDIANTE ', NULL, '', '', '', NULL, NULL, 1, 1, '2023-11-08 13:22:10', '2023-11-08 13:22:10'),
(78, 'PEDRO', 'RODRIGUEZ RENGIFO', 'DNI', '44192492', 'MASCULINO', '36', '1987-01-12', '993682650', 'INDEPENDENCIA ZN A- E-13 ', 'ALTO SELVA ALEGRE ', 'AREQUIPA ', 'SUPERIOR', NULL, 'MECANICO ', '', '', NULL, NULL, 1, 1, '2023-11-08 13:22:10', '2023-11-08 13:22:10'),
(79, 'CRISTIAN', 'RADO GUTIERREZ', 'DNI', '73212097', 'MASCULINO', '28', '1995-04-06', '', 'CALLE LAS DELICIAS 132 VERA RUZ - C. COLORADO ', 'C. COLORADO ', 'AREQUIPA ', 'SUPERIOR', '', '', '', '', '', '', 1, NULL, '2023-11-08 13:22:10', '2024-09-16 22:13:26'),
(80, 'BRUNO', 'RAMOS MARDINI', 'DNI', '77323295', 'MASCULINO', '27', '1996-07-22', '902397191', 'CALLE MAGNOPATA 707', 'YANAHUARA ', 'AREQUIPA ', '', NULL, '', '', '', NULL, NULL, 1, 1, '2023-11-08 13:22:10', '2023-11-08 13:22:10'),
(81, 'LUPE', 'REINOSO', 'DNI', '42532782', 'FEMENINO', '75', '1948-02-12', '959969990', 'URB. VALENCIA B-6 ', 'YANAHUARA ', 'AREQUIPA ', '', NULL, '', '', '', NULL, NULL, 1, 1, '2023-11-08 13:22:10', '2023-11-08 13:22:10'),
(82, 'JESUS', 'RODRIGUEZ MEDINA', 'DNI', '71025170', 'MASCULINO', '27', '1996-06-03', '923701415', 'C. COLORADO ', 'AREQUIPA ', 'AREQUIPA ', '', NULL, '', '', '', NULL, NULL, 1, 1, '2023-11-08 13:22:10', '2023-11-08 13:22:10'),
(83, ' SEBASTIAN', 'RIVERA BERNAL', 'DNI', '90637082', 'MASCULINO', '05', '2018-03-16', '982246312', '', 'AREQUIPA ', 'AREQUIPA ', '', NULL, '', '', '', NULL, NULL, 1, 1, '2023-11-08 13:22:10', '2023-11-08 13:22:10'),
(84, 'CLAUDIO', 'RIVERA', 'DNI', '43714670', 'MASCULINO', '37', '1986-07-04', '950307311', '', 'AREQUIPA ', 'AREQUIPA ', '', NULL, '', '', '', NULL, NULL, 1, 1, '2023-11-08 13:22:10', '2023-11-08 13:22:10'),
(85, 'LUIS ENRIQUE', 'RIVERA BENAVENTE', 'DNI', '79236295', 'MASCULINO', '08', '2015-08-06', '982246312', 'URB. LOS JAZMINES C-10', 'PAUCARPATA ', 'AREQUIPA ', 'ESTUDIANTE ', NULL, '', '', 'SOLTERO ', NULL, NULL, 1, 1, '2023-11-08 13:22:10', '2023-11-08 13:22:10'),
(86, 'LUIS', 'RAMIREZ', 'DNI', '43361496', 'MASCULINO', '71', '0000-00-00', '959300055', 'AV. ALFONSO UGARTE 112- C.C LA CANTUTA', 'AREQUIPA ', 'AREQUIPA ', '', NULL, '', '', '', NULL, NULL, 1, 1, '2023-11-08 13:22:10', '2023-11-08 13:22:10'),
(87, 'DARLA', 'RODRIGUEZ', 'DNI', '90946368', 'FEMENINO', '05', '2018-09-01', '914342682', 'PUEBLO T. ACEQUIA ALTA MZ W  ', 'CAYMA ', 'AREQUIPA ', '', NULL, '', '', '', NULL, NULL, 1, 1, '2023-11-08 13:22:10', '2023-11-08 13:22:10'),
(88, 'STAMBER', 'RAMIREZ REVILLA', 'DNI', '40685209', 'MASCULINO', '43', '1980-08-28', '974434314', 'PLAZA CAYMA 208', 'CAYMA ', 'AREQUIPA ', 'SUPERIOR', NULL, '', '', '', NULL, NULL, 1, 1, '2023-11-08 13:22:10', '2023-11-08 13:22:10'),
(89, 'WILBER MAURICIO', 'RONCALLA CCALA', 'DNI', '40985716', 'MASCULINO', '42', '1981-05-10', '973753030', 'A. SELVA ALEGRE ', 'A. S. A', 'AREQUIPA ', '', NULL, '', '', '', NULL, NULL, 1, 1, '2023-11-08 13:22:10', '2023-11-08 13:22:10'),
(90, 'PABLO', 'RIVERA MARTINEZ', 'DNI', '71218730', 'MASCULINO', '33', '1990-08-17', '959169216', 'UR. SAN RAFAEL E-5  YANAHUARA ', 'YANAHUARA ', 'AREQUIPA ', 'SUPERIOR ', NULL, '', '', 'CASADO ', NULL, NULL, 1, 1, '2023-11-08 13:22:10', '2023-11-08 13:22:10'),
(91, 'FLOR VALERIA', 'ROA CHUQUICONDOR', 'DNI', '72894003', 'FEMENINO', '22', '2001-07-07', '993161458', 'URB. INDEPENDENCIA AMERICANA C-11 ', 'YANAHUARA ', 'AREQUIPA ', 'SUPERIOR', '', '', '', '', '', '', 1, NULL, '2023-11-08 13:22:10', '2024-09-16 22:13:33'),
(92, 'EDITH', 'CHIRINOS DE PACHECO', 'DNI', '29264522', 'FEMENINO', '85', '1938-06-02', '993733185', 'URB. LOS PORTALES G-17 ', 'CAYMA ', 'AREQUIPA ', 'SUPERIOR', NULL, '', '', 'CASADA', NULL, NULL, 1, 1, '2023-11-08 13:22:10', '2023-11-08 13:22:10'),
(93, 'ROXANA', 'CHURA', 'DNI', '29614512', 'FEMENINO', '50', '1973-10-17', '950273704', 'URB. FUBNDO LA QUEBRADA C-2 C. COLORADO ', 'C. COLORADO ', 'AREQUIPA ', 'SUPERIOR', NULL, '', '', 'SOLTERA', NULL, NULL, 1, 1, '2023-11-08 13:22:10', '2023-11-08 13:22:10'),
(94, 'JACKELIN  BELINDA', 'CHIPANA MAMANI', 'DNI', '46680487', 'FEMENINO', '33', '1990-07-26', '965680690', 'CALLE RAMIRO PRIALE ASOC- CA. CUADROS B-6', 'JULIACA', 'PUNO ', 'SUPERIOR', NULL, '', '', '', NULL, NULL, 1, 1, '2023-11-08 13:22:10', '2023-11-08 13:22:10'),
(95, 'JENNY LIZETH', 'CUEVAZO COILA', 'DNI', '45194623', 'FEMENINO', '34', '1988-12-14', '958660009', 'AV. SAN MARTIN 3830', 'MIRAFLORES', 'AREQUIPA ', 'SUPERIOR', '', 'CONTADORA', '', 'SOLTERA', '', '', 1, NULL, '2023-11-08 13:22:10', '2024-09-16 22:13:39'),
(96, 'JOSE ALEJANDRO', 'CUSIRRAMOS RODRIGO', 'DNI', '43985390', 'MASCULINO', '37', '1986-09-11', '959222951', '', '', 'AREQUIPA ', 'SUPERIOR', NULL, '', '', 'CASADO ', NULL, NULL, 1, 1, '2023-11-08 13:22:10', '2023-11-08 13:22:10'),
(97, 'NOEMY', 'CHIPANA MAMANI', 'DNI', '48177920', 'FEMENINO', '30', '1993-06-18', '963444739', 'CASIMIRO CUADROS II B-6 CAYMA ', 'CAYMA ', 'AREQUIPA ', 'SUPERIOR', NULL, 'ADMINISTRADORA', '', '', NULL, NULL, 1, 1, '2023-11-08 13:22:10', '2023-11-08 13:22:10'),
(98, 'CONSUELO', 'COAQUIRA BEGAZO', 'DNI', '29594175', 'FEMENINO', '54', '1969-07-02', '987204883', 'CERRO VIEJO  - CERRO COLORADO ', 'C. COLORADO ', 'AREQUIPA ', 'SUPERIOR', '', 'PROFERSORA', '', 'CASADA', '', '', 1, NULL, '2023-11-08 13:22:10', '2024-09-16 22:13:46'),
(99, 'BETSY', 'CORDOVA  QUENTA', 'DNI', '29713077', 'FEMENINO', '46', '1977-07-07', '980792008', 'UR. LA CAMPIÑA -SOCABAYA ', 'SOCABAYA ', 'AREQUIPA ', 'SUPERIOR', NULL, '', '', 'SOLTERA', NULL, NULL, 1, 1, '2023-11-08 13:22:10', '2023-11-08 13:22:10'),
(100, 'JACKELIN  BELINDA', 'CHILO SAICO', 'DNI', '78596766', 'FEMENINO', '09', '2014-06-27', '785467696', '', '', 'CUZCO ', 'ESTUDIANTE ', NULL, '', '', '', NULL, NULL, 1, 1, '2023-11-08 13:22:10', '2023-11-08 13:22:10'),
(101, 'DANITZA', 'CORIMANYA', 'DNI', '46106924', 'FEMENINO', '34', '1989-09-28', '918507100', 'DEAN VALDIVIA SECTOR II I-', 'CAYMA ', 'AREQUIPA ', 'SUPERIOR', '', '', 'CATOLICO ', 'CONVIVIENTE ', '', '', 1, NULL, '2023-11-08 13:22:10', '2024-09-16 22:13:53'),
(102, 'VANESSA', 'CASANOVA', 'DNI', '10881303', 'FEMENINO', '45', '1978-07-24', '926456149', 'ASOC. LAS BUGAMBILAS  MZ C LOTE 10 C.COLORADO ', 'C. COLORADO ', 'AREQUIPA ', '´SUPERIOR ', NULL, '', '', 'CASADA', NULL, NULL, 1, 1, '2023-11-08 13:22:10', '2023-11-08 13:22:10'),
(103, 'KELLY', 'CAMILO LLAIQUI', 'DNI', '46987505', 'FEMENINO', '32', '1991-04-24', '989615631', 'AV. SANTA ROSA 504- MCAL CASTILLA PACHACUTEC', 'C, COLORADO ', 'AREQUIPA ', 'SUPERIOR', '', 'CONTADOR ', '', 'SOLTERA', '', '', 1, NULL, '2023-11-08 13:22:10', '2024-09-16 22:14:00'),
(104, 'FERNANDO GUILLERMO', 'CHIRINOS ROMERO', 'DNI', '29238819', 'MASCULINO', '63', '1960-04-06', '934647087', 'URB. VILLA ELECTRICA B-13 ', 'J:L:B.RIVERO ', 'AREQUIPA ', 'SUPERIOR', NULL, 'EMPLEADO ', '', 'VIUDO ', NULL, NULL, 1, 1, '2023-11-08 13:22:10', '2023-11-08 13:22:10'),
(105, 'LUCIA', 'CRUZ LLAYQUE', 'DNI', '42129949', 'FEMENINO', '40', '1983-10-31', '949990699', 'VILLA PARAISO L-8 MZ R  ', 'C. COLORADO ', 'AREQUIPA ', 'SUPERIOR', NULL, 'SU CAASA', '', '', NULL, NULL, 1, 1, '2023-11-08 13:22:10', '2023-11-08 13:22:10'),
(106, 'SHIOMY JANETH', 'CCAPIRA MALCUACHA', 'DNI', '45695946', 'FEMENINO', '34', '1989-04-14', '918112536', 'CALLE GRAU S7N ', 'CAYLLOMA', 'AREQUIPA ', 'SUPERIOR', NULL, '', '', '', NULL, NULL, 1, 1, '2023-11-08 13:22:10', '2023-11-08 13:22:10'),
(107, 'JENNY', 'CARBAJAL', 'DNI', '29635040', 'FEMENINO', '43', '1980-04-02', '973174992', 'SANTA ELISA F1 ', 'CAYMA ', 'AREQUIPA ', 'SUPERIOR', '', '', '', 'CASADA', '', '', 1, NULL, '2023-11-08 13:22:10', '2024-09-16 22:14:07'),
(108, 'MARIA LIZ', 'CANDIA PEÑALVA', 'DNI', '71947900', 'FEMENINO', '28', '1994-11-20', '', '', '', 'AREQUIPA ', 'SUPERIOR', NULL, '', '', '', NULL, NULL, 1, 1, '2023-11-08 13:22:10', '2023-11-08 13:22:10'),
(109, 'MARTHA', 'CHAVEZ', 'DNI', '29561553', 'FEMENINO', '72', '1951-01-19', '984784457', 'URB SUD ANERICANA MZ H- LOTE 8', 'C. COLORADO ', 'AREQUIPA ', '', NULL, '', '', '', NULL, NULL, 1, 1, '2023-11-08 13:22:10', '2023-11-08 13:22:10'),
(110, 'VALERIA', 'CHURATA RUELAS', 'DNI', '73336365', 'FEMENINO', '24', '1999-08-08', '918497378', 'NUEVO HORIZONTE MZ H LOTE 4 ', 'C. COLORADO ', 'AREQUIPA ', 'SUPERIOR', NULL, 'ESTUDIANTE ', '', '', NULL, NULL, 1, 1, '2023-11-08 13:22:10', '2023-11-08 13:22:10'),
(111, 'RAPHAEL', 'CARPIO PACHECO', 'DNI', '41227240', 'MASCULINO', '41', '1982-04-23', '959756413', 'URB MIRASOL F-21 ', 'CAYMA ', 'AREQUIPA ', 'SUPERIOR', '', 'GERENTE ', '', 'CASADO ', '', '', 1, NULL, '2023-11-08 13:22:10', '2024-09-16 22:14:15'),
(112, 'JEAN PIERRE', 'CARBAJAL GONZALES', 'DNI', '47203443', 'MASCULINO', '31', '1992-08-21', '974545720', 'MADRE DE DIOS 304 ', 'YANAHUARA ', 'AREQUIPA ', 'SUPERIOR', NULL, 'MEDICO ', '', '', NULL, NULL, 1, 1, '2023-11-08 13:22:10', '2023-11-08 13:22:10'),
(113, 'VERONICA', 'CHINCHILLA  CARDENAS', 'DNI', '70672928', 'FEMENINO', '28', '1995-06-07', '954129777', 'AV. PUNO 708', 'C. COLORADO ', 'AREQUIPA ', 'SUPERIOR', '', '', '', '', '', '', 1, NULL, '2023-11-08 13:22:10', '2024-09-16 22:14:26'),
(114, 'JUAN MIGUEL', 'CAVIEDES CHOQUE', 'DNI', '73022022', 'MASCULINO', '29', '1994-06-23', '969414865', 'CUZCO HUASAHUARA J-18 ', 'CUZCO ', 'CUZCO ', 'SUPERIOR', NULL, 'INGENIERO ', '', '', NULL, NULL, 1, 1, '2023-11-08 13:22:10', '2023-11-08 13:22:10'),
(115, 'RUTH', 'CHACCA', 'DNI', '47549675', 'FEMENINO', '31', '1991-12-07', '929914429', '', 'AREQUIPA ', 'AREQUIPA ', 'SUPERIOR', NULL, '', '', '', NULL, NULL, 1, 1, '2023-11-08 13:22:10', '2023-11-08 13:22:10'),
(116, 'HERADIO PASCUAL', 'CORNEJO RAMOS', 'DNI', '29382184', 'MASCULINO', '68', '1955-05-17', '922737015', 'DEAN VALDIVIA P-3 ENACE ', 'CAYMA ', 'AREQUIPÁ ', 'SUPERIOR', NULL, 'SEGURIDAD ', '', 'CASADO ', NULL, NULL, 1, 1, '2023-11-08 13:22:10', '2023-11-08 13:22:10'),
(117, 'FELIX', 'CRUZ HUAMANI', 'DNI', '45679945', 'MASCULINO', '35', '1988-06-11', '985826641', 'URB. SALAVERRY MZ J - LOTE B', 'MIRAFLORES ', 'AREQUIPA ', 'SUPERIOR', '', 'TECNICO OPERARIO ', '', '', '', '', 1, NULL, '2023-11-08 13:22:10', '2024-09-16 22:14:34'),
(118, 'DANTE', 'COAQUIRA BEGAZO', 'DNI', '29727862', 'MASCULINO', '45', '1978-02-16', '994621349', 'CALLE CORDOVA 203-A', 'C. COLORADO ', 'AREQUIPA ', 'SUPERIOR', NULL, 'INVESTIGADOR', '', 'SOLTERO ', NULL, NULL, 1, 1, '2023-11-08 13:22:10', '2023-11-08 13:22:10'),
(119, 'ALISON', 'CARLO CUSI', 'DNI', '44857869', 'FEMENINO', '07', '2016-04-08', '944201065', 'ENACE ', 'CAYMA ', 'AREQUIPA ', 'ESTUDIANTE ', NULL, '', '', '', NULL, NULL, 1, 1, '2023-11-08 13:22:10', '2023-11-08 13:22:10'),
(120, 'EMILIO', 'CASTROCUBA', 'DNI', '29214939', 'MASCULINO', '67', '1956-10-06', '958821536', '', 'AREQUIPA ', 'AREQUIPA ', 'JUBILADO ', NULL, '', '', '', NULL, NULL, 1, 1, '2023-11-08 13:22:10', '2023-11-08 13:22:10'),
(121, 'DILAN', 'CARLO CUSI', 'DNI', '44857869', 'MASCULINO', '04', '2018-12-14', '944201065', 'ENACE ', 'CAYMA ', 'AREQUIPA ', 'ESTUDIANTE ', NULL, '', '', '', NULL, NULL, 1, 1, '2023-11-08 13:22:10', '2023-11-08 13:22:10'),
(122, 'ANGELA', 'CARDENAS  CATERIANO', 'DNI', '41165453', 'FEMENINO', '41', '1981-11-29', '958315906', 'URB. LAS PEÑAS ', 'SACHACA ', 'AREQUIPA ', '', NULL, '', '', '', NULL, NULL, 1, 1, '2023-11-08 13:22:10', '2023-11-08 13:22:10'),
(123, 'TONNY', 'CAPIRA', 'DNI', '73777346', 'MASCULINO', '21', '2002-08-24', '925389643', 'CALLE GRAU S/N 4320', 'AREQUIPA ', 'AREQUIPA ', 'ESTUDIANTE ', '', '', '', '', '', '', 1, NULL, '2023-11-08 13:22:10', '2024-09-16 22:14:41'),
(124, 'PILAR', 'CUADROS', 'DNI', '73146481', 'FEMENINO', '23', '1999-12-11', '944123684', 'GIRON CUZCO  113', 'CAYMA ', 'AREQUIPA ', 'ESTUDIANTE ', NULL, '', '', '', NULL, NULL, 1, 1, '2023-11-08 13:22:10', '2023-11-08 13:22:10'),
(125, 'GAEL', 'CATUMA CORZO', 'DNI', '90142788', 'MASCULINO', '06', '2017-03-25', '983373160', 'URB. JUAN EL BUENO G-15', 'CERCADO ', 'AREQUIPA ', 'ESTUDIANTE ', NULL, '', '', '', NULL, NULL, 1, 1, '2023-11-08 13:22:10', '2023-11-08 13:22:10'),
(126, 'JAYDEN SAID', 'CONDEZO CORIMANYA', 'DNI', '91426098', 'MASCULINO', '04', '2019-07-23', '918507100', 'C. COLORADO ', 'C. COLORADO ', ' AREQUIPA ', '', NULL, '', '', '', NULL, NULL, 1, 1, '2023-11-08 13:22:10', '2023-11-08 13:22:10'),
(127, 'EMILIANO', 'CHIRINOS', 'DNI', '71558872', 'MASCULINO', '20', '2003-03-08', '973396599', '', 'YANAHUARA ', 'AREQUIPA ', 'SUPERIOR ', NULL, 'ESTUDIANTE ', '', '', NULL, NULL, 1, 1, '2023-11-08 13:22:10', '2023-11-08 13:22:10'),
(128, 'JESUS', 'CONDEZO-MAGARIÑO', 'DNI', '43484241', 'MASCULINO', '36', '0000-00-00', '959454558', '', '', '', 'SUPERIOR TECNICO ', NULL, '', '', '', NULL, NULL, 1, 1, '2023-11-08 13:22:10', '2023-11-08 13:22:10'),
(129, 'LINDA', 'CACERES LARICO', 'DNI', '70228404', 'FEMENINO', '32', '1991-08-20', '965190612', 'CALLE SANTA CLARA 305 PAUCARPATA ', 'PAUCARPATA ', 'AREQUIPA ', '', NULL, '', '', '', NULL, NULL, 1, 1, '2023-11-08 13:22:10', '2023-11-08 13:22:10'),
(130, 'ALEJANDRO', 'CURSE  VILLAFUERTE', 'DNI', '40249696', 'MASCULINO', '53', '1970-07-23', '980817324', 'AV. PROGRESO 950', 'MIRAFLORES ', 'AREQUIPA ', '', NULL, '', '', 'CASADO ', NULL, NULL, 1, 1, '2023-11-08 13:22:10', '2023-11-08 13:22:10'),
(131, 'JOAQUIN', 'CORNEJO SALAS', 'DNI', '61848409', 'MASCULINO', '14', '2009-09-01', '989302297', 'URB. RESIDENCIAL CAMPO VERDE', 'SACHACA ', 'AREQUIPA ', '', NULL, '', '', '', NULL, NULL, 1, 1, '2023-11-08 13:22:10', '2023-11-08 13:22:10'),
(132, 'GABY TERERSA', 'COTA QUISPE', 'DNI', '40396492', 'FEMENINO', '43', '1979-12-20', '949001219', 'PEDRO DIEZ CANSECO 616 ', 'CAYMA ', 'AREQUIPA ', 'SUPERIOR', NULL, '', '', '', NULL, NULL, 1, 1, '2023-11-08 13:22:10', '2023-11-08 13:22:10'),
(133, 'FERNANDO', 'CARRALES BERMEJO', 'DNI', '29630742', 'MASCULINO', '48', '1975-01-15', '959226147', 'LOS GUINDOS A-22 ', 'CAYMA ', 'AREQUIPA ', 'SUPERIOR', NULL, 'INVENTOR ', 'BUDISTA ', '', NULL, NULL, 1, 1, '2023-11-08 13:22:10', '2023-11-08 13:22:10'),
(134, 'ANA PAULA', 'CASTRO VILLEGAS', 'DNI', '71721933', 'FEMENINO', '17', '2006-01-02', '950309607', 'CAYMA ', 'CAYMA ', 'AREQUIPA ', 'ESTUDIANTE ', NULL, '', '', '', NULL, NULL, 1, 1, '2023-11-08 13:22:10', '2023-11-08 13:22:10'),
(135, 'SEBASTIAN', 'CARPIO MANCHEGO', 'DNI', '70433417', 'MASCULINO', '20', '2003-07-29', '', 'URB. EL CORTIJO ', 'C. COLORADO ', 'AREQUIPA ', 'ESTUDIANTE ', '', '', '', '', '', '', 1, NULL, '2023-11-08 13:22:10', '2024-09-16 22:14:48'),
(136, 'MAURA', 'CANSINO', 'DNI', '29373775', 'FEMENINO', '70', '1953-01-15', '959206005', 'AV. LIMA 1004', 'M. MELGAR ', 'AREQUIPA ', '', NULL, '', '', '', NULL, NULL, 1, 1, '2023-11-08 13:22:10', '2023-11-08 13:22:10'),
(137, 'HEYDI', 'CORDOVA HUAMAN', 'DNI', '73038306', 'FEMENINO', '25', '1998-01-01', '', 'AV. LOS GUINDOS 237 A.S.A ', 'A. S. ALEGRE', 'AREQUIPA ', 'ESTUDIANTE ', NULL, '', '', 'SOLTERA', NULL, NULL, 1, 1, '2023-11-08 13:22:10', '2023-11-08 13:22:10'),
(138, 'JOSE', 'CABRERA QUISPE', 'DNI', '29686175', 'MASCULINO', '47', '1976-09-07', '959027810', 'C. COLORADO ', 'C. COLORADO ', 'AREQUIPA ', 'SUPERIOR ', NULL, 'MECANICO ', '', 'CASADO ', NULL, NULL, 1, 1, '2023-11-08 13:22:10', '2023-11-08 13:22:10'),
(139, 'BRYAN KEVIN', 'CARPIO PACHECO', 'DNI', '70435895', 'MASCULINO', '30', '1993-08-28', '959758610', 'URB. MIRASOL F-21 ', 'CAYMA ', 'AREQUIPA ', 'SUPERIOR', NULL, 'ING, COMERCIAL ', '', 'SOLTERO ', NULL, NULL, 1, 1, '2023-11-08 13:22:10', '2023-11-08 13:22:10'),
(140, 'GUSTAVO', 'CAPIRA', 'DNI', '72355155', 'MASCULINO', '21', '2002-04-07', '927710091', 'ALTO SELVA ALEGRE ', 'A:SELVA ALEGRE ', 'AREQUIPA ', 'SUPERIOR', NULL, 'ESTUDIANTE ', '', '', NULL, NULL, 1, 1, '2023-11-08 13:22:10', '2023-11-08 13:22:10'),
(141, 'JENIFER', 'CCAHUA', 'DNI', '47663658', 'FEMENINO', '32', '1991-10-11', '918380009', 'CERCADO ', 'AREQUIPA ', 'AREQUIPA ', 'SUPERIOR', NULL, '', '', '', NULL, NULL, 1, 1, '2023-11-08 13:22:10', '2023-11-08 13:22:10'),
(142, 'LUISA', 'CARBAJAL', 'DNI', '46184897', 'FEMENINO', '33', '1990-01-05', '974545713', 'SACHACA ', 'AREQUIPA ', 'AREQUIPA ', 'SUPERIOR', NULL, 'MEDICO ', '', 'SOLTERA', NULL, NULL, 1, 1, '2023-11-08 13:22:10', '2023-11-08 13:22:10'),
(143, 'NEYMAR', 'CORDOBA', 'DNI', '80870812', 'MASCULINO', '11', '2012-10-14', '927007439', 'CALLALLI', 'AREQUIPA ', 'AREQUIPA ', 'ESTUDIANTE ', NULL, '', '', '', NULL, NULL, 1, 1, '2023-11-08 13:22:10', '2023-11-08 13:22:10'),
(144, 'DAVID', 'CHAVEZ', 'DNI', '73315002', 'MASCULINO', '30', '1992-12-14', '953765446', '', 'AREQUIPA ', 'AREQUIPA ', '', NULL, '', '', '', NULL, NULL, 1, 1, '2023-11-08 13:22:10', '2023-11-08 13:22:10'),
(145, 'LILIANA', 'CARPIO ZAVALETA', 'DNI', '29479745', 'FEMENINO', '61', '1962-01-09', '953271538', 'CALLE GRAU 117', 'SACHACA', 'AREQUIPA ', '', '', 'SU CASA', '', 'CASADA', '', '', 1, NULL, '2023-11-08 13:22:10', '2024-09-16 22:14:55'),
(146, 'HUMBERTO', 'CRUZ SANCHEZ', 'DNI', '29400151', 'MASCULINO', '75', '1948-10-12', '959999333', 'MIRAFLORES', 'MIRAFLORES ', 'AREQUIPA ', '', NULL, '', '', '', NULL, NULL, 1, 1, '2023-11-08 13:22:10', '2023-11-08 13:22:10'),
(147, 'BERGER', 'CHOQUE', 'DNI', '73879150', 'MASCULINO', '20', '2003-08-23', '979371493', 'CERRO COLORADO ', 'C. COLORADO ', 'AREQUIPA ', 'SUPERIOR', NULL, 'ESTUDIANTE ', '', 'SOLTERO ', NULL, NULL, 1, 1, '2023-11-08 13:22:10', '2023-11-08 13:22:10'),
(148, 'SANTIAGO', 'CAPIRA', 'DNI', '81559614', 'MASCULINO', '09', '2014-04-23', '632220641', 'ALTO SELVA ALEGRE ', 'A.S.A. ', 'AREQUIPA ', 'ESTUDIANTE ', NULL, 'ESTUDIANTE ', '', '', NULL, NULL, 1, 1, '2023-11-08 13:22:10', '2023-11-08 13:22:10'),
(149, 'ADRIANA', 'CARDENAS CATERIANO', 'DNI', '42917789', 'FEMENINO', '39', '1984-04-21', '959177352', 'LAS PEÑAS -SACHACA ', 'SACHACA ', 'AREQUIPA ', '', NULL, 'SU CASA', '', 'CASADA', NULL, NULL, 1, 1, '2023-11-08 13:22:10', '2023-11-08 13:22:10'),
(150, 'BRIGITTE', 'CARRIÓN ESTAÑO', 'DNI', '63694247', 'FEMENINO', '11', '2012-08-08', '977822891', 'JR. ANDRES AVELINO CACERES MZ Ñ 1 -B ', 'AREQUIPA ', 'AREQUIPA ', '', NULL, '', '', '', NULL, NULL, 1, 1, '2023-11-08 13:22:10', '2023-11-08 13:22:10'),
(151, 'ALESSKA MARIELA', 'DELGADO VALENCIA', 'DNI', '44057381', 'FEMENINO', '41', '1982-01-20', '950313060', 'CERRO COLORADO ', 'AREQUIPA ', 'AREQUIPA', 'SUPERIOR', '', 'PERIODISTA', '', 'SOLTERA', '', '', 1, NULL, '2023-11-08 13:22:10', '2024-09-16 22:15:03'),
(152, 'SEBASTIAN', 'DELGADO VALENCIA', 'DNI', '70105130', 'MASCULINO', '24', '1999-08-12', '957402080', 'CALLE RONDA LA RECOLETA 310', 'YANAHUARA ', 'AREQUIPA ', 'SUPERIOR', NULL, 'ENTRENADOR ', '', 'SOLTERO', NULL, NULL, 1, 1, '2023-11-08 13:22:10', '2023-11-08 13:22:10'),
(153, 'STEPHANIE', 'DEL CARPIO ACOSTA', 'DNI', '45439780', 'FEMENINO', '35', '1988-09-29', '985461946', 'CALLE BELLO HOROZONTE C-6 UMACOLLO ', 'CERCADO ', 'AREQUIPA ', 'SUPERIOR ', NULL, 'ADMINISTRADORA', '', 'SOLTERA', NULL, NULL, 1, 1, '2023-11-08 13:22:10', '2023-11-08 13:22:10'),
(154, 'ALEXANDRA', 'LONDRES  ZUÑIGA', 'DNI', '47069307', 'FEMENINO', '31', '1992-05-21', '966376145', 'LOS GLADIOLOS 210', 'YANAHUARA ', 'AREQUIPA ', 'SUPERIOR ', NULL, 'PSICOLOGA ', '', '', NULL, NULL, 1, 1, '2023-11-08 13:22:10', '2023-11-08 13:22:10'),
(155, 'JOSELINE', 'OSCA CCOPA', 'DNI', '73205711', 'FEMENINO', '19', '2004-08-12', '913596873', 'CALLE SIMON BOLIVAR B-32 LA TOMILLA', 'CAYMA ', 'AREQUIPA ', 'SUPERIOR', NULL, 'ESTUDIANTE ', '', '', NULL, NULL, 1, 1, '2023-11-08 13:22:10', '2023-11-08 13:22:10'),
(156, 'JUAN LUIS', 'TRUJILLO CALLA', 'DNI', '80542531', 'MASCULINO', '45', '1978-08-19', '982505398', '', 'AREQUIPA ', 'AREQUIPA ', 'SUPERIOR ', NULL, 'MECANICO ', '', '', NULL, NULL, 1, 1, '2023-11-08 13:22:10', '2023-11-08 13:22:10'),
(157, 'YANET PIEDAD', 'DELGADO NAVARRO', 'DNI', '29682219', 'FEMENINO', '64', '1959-03-21', '959042736', 'URB. SAN RAFAEL MZ C LTE 2 ', 'YANAHUARA ', 'AREQUIPA ', 'SUPERIOR', '', 'AMA DE CASA', '', 'CASADA', '', '', 1, NULL, '2023-11-08 13:22:10', '2024-09-16 22:15:11'),
(158, 'ERLITA', 'DELGADO INGA', 'DNI', '76521993', 'FEMENINO', '24', '1999-04-15', '949145659', 'CALLE ALEMANIA 105 JLBR.', 'J:L:B.RIVERO ', 'AREQUIPA ', 'SUPERIOR', NULL, 'ESTUDIANTE ', '', 'SOLTERA', NULL, NULL, 1, 1, '2023-11-08 13:22:10', '2023-11-08 13:22:10'),
(159, 'RODOLFO', 'DIAZ', 'DNI', '29600014', 'MASCULINO', '51', '1971-12-18', '959680942', 'AV. EJERCITO 631', 'CAYMA ', 'AREQUIPA', 'SUPERIOR', NULL, '', '', 'CASADO ', NULL, NULL, 1, 1, '2023-11-08 13:22:10', '2023-11-08 13:22:10'),
(160, 'WILFREDO EDUARDO', 'ESPINOZA CONDE', 'DNI', '73275297', 'MASCULINO', '22', '2001-05-08', '973590244', 'CALLE MELGAR 103', 'CAYMA ', 'AREQUIPA ', 'SUPERIOR', NULL, '', '', '', NULL, NULL, 1, 1, '2023-11-08 13:22:10', '2023-11-08 13:22:10'),
(161, 'BRIGITH', 'ENRIQUEZ SUCASACA', 'DNI', '74026305', 'FEMENINO', '11', '2012-02-23', '943911719', 'ENACE ALTO CAYMA ', 'CAYMA ', 'AREQUIPA ', 'SUPERIOR ', NULL, 'ESTUDIANTE ', '', '', NULL, NULL, 1, 1, '2023-11-08 13:22:10', '2023-11-08 13:22:10'),
(162, 'JEFERSON', 'ESPINOZA VALENCIA', 'DNI', '29620142', 'MASCULINO', '50', '1973-08-28', '961836923', 'TOMILLA ', 'CAYMA ', 'AREQUIPA ', 'SUPERIOR ', '', 'EMPLEADO ', '', '', '', '', 1, NULL, '2023-11-08 13:22:10', '2024-09-16 22:15:19'),
(163, 'TERESA', 'ENRIQUEZ SANCA', 'DNI', '02263932', 'FEMENINO', '65', '1958-08-10', '925130856', '', '', '', '', NULL, '', '', '', NULL, NULL, 1, 1, '2023-11-08 13:22:10', '2023-11-08 13:22:10'),
(164, 'ARTURO FREDY', 'ESCALANTE AGUILAR', 'DNI', '29672493', 'MASCULINO', '55', '1968-01-30', '949499404', 'RES. CAMPO VERDE I7 ', 'SACHACA ', 'AREQUIPA ', 'SUPERIOR', NULL, '', '', 'CASADA', NULL, NULL, 1, 1, '2023-11-08 13:22:10', '2023-11-08 13:22:10'),
(165, 'ERNESTO', 'EGUILUZ VERA', 'DNI', '73085251', 'MASCULINO', '23', '2000-09-26', '9940183529', '', 'J.L.B.RIVERO ', 'AREQUIPA ', 'SUPERIOR', NULL, 'ESTUDIANTE ', '', '', NULL, NULL, 1, 1, '2023-11-08 13:22:10', '2023-11-08 13:22:10'),
(166, 'ADELA', 'ESTAÑA LASTARRIA', 'DNI', '40442968', 'FEMENINO', '43', '1980-02-04', '977822891', 'JIRON ANDRES AVELINO MZ N BUENOS AIRES ', 'CAYMA ', 'AREQUIPA ', 'SUPERIOR ', NULL, 'SU CASA ', '', 'CASADA ', NULL, NULL, 1, 1, '2023-11-08 13:22:10', '2023-11-08 13:22:10'),
(167, 'MIRELLA', 'ESCAJADILLO', 'DNI', '72699290', 'FEMENINO', '31', '1992-09-14', '992528542', '', 'AREQUIPA ', 'AREQUIPA ', 'SUPERIOR', NULL, '', '', '', NULL, NULL, 1, 1, '2023-11-08 13:22:10', '2023-11-08 13:22:10'),
(168, 'LARISA', 'FLORES SENCIA', 'DNI', '42532545', 'FEMENINO', '39', '1984-08-02', '980034620', 'CALLE CORBACHO 209 DEP. 301 ', 'C. COLORADO ', 'AREQUIPA ', 'SUPERIOR', NULL, 'EMPLEADA ', '', 'CASADA ', NULL, NULL, 1, 1, '2023-11-08 13:22:10', '2023-11-08 13:22:10'),
(169, 'LEONARDO', 'FIGUEROA  SANCHEZ', 'DNI', '71932462', 'MASCULINO', '23', '2000-02-13', '936603614', 'CALLE MELGAR 217', 'C. COLORADO ', 'AREQUIPA ', 'SUPERIOR', NULL, 'BACHILLER', '', '', NULL, NULL, 1, 1, '2023-11-08 13:22:10', '2023-11-08 13:22:10'),
(170, 'JENIFER', 'FERNANDEZ HUALLPA', 'DNI', '72307210', 'FEMENINO', '18', '2005-05-12', '916080397', 'AV. AREQUIPA A-6  CAYMA ', 'CAYMA ', 'AREQUIPA ', 'SUPERIOR', NULL, 'ESTUDIANTE ', '', '', NULL, NULL, 1, 1, '2023-11-08 13:22:10', '2023-11-08 13:22:10'),
(171, 'GUILLERMO', 'FIGUEROA  PRADO', 'DNI', '90523454', 'MASCULINO', '05', '2017-12-02', '958074378', '', '', '', '', NULL, '', '', '', NULL, NULL, 1, 1, '2023-11-08 13:22:10', '2023-11-08 13:22:10'),
(172, 'JAIRO RAPHAEL', 'FUENTES MALDONADO', 'DNI', '72213334', 'MASCULINO', '22', '2001-10-04', '967174018', '', 'AREQUIPA ', 'AREQUIPA ', 'SUPERIOR', NULL, 'ESTUDIANTE', '', '', NULL, NULL, 1, 1, '2023-11-08 13:22:10', '2023-11-08 13:22:10'),
(173, 'ANDERSON', 'FLORES CHOQUE', 'DNI', '75453621', 'MASCULINO', '22', '2001-08-15', '944052280', 'CALLE TARAPACA 203 ', 'MIRAFLORES ', 'AREQUIPA ', 'SUPERIOR', NULL, 'ESTUDIANTE ', '', '', NULL, NULL, 1, 1, '2023-11-08 13:22:10', '2023-11-08 13:22:10'),
(174, 'ROSSANA', 'FUENTES PIZARRO', 'DNI', '06780094', 'FEMENINO', '52', '1971-08-30', '993456754', 'CERRO COLORADO ', 'C. COLORADO ', 'AREQUIPA ', 'SUPERIOR', NULL, '', '', '', NULL, NULL, 1, 1, '2023-11-08 13:22:10', '2023-11-08 13:22:10'),
(175, 'SHAYIRA', 'FERNANDEZ QUICAÑA', 'DNI', '41253878', 'FEMENINO', '42', '1981-06-27', '953751081', 'CAYMA ', 'CAYMA ', 'AREQUIPA ', 'SUPERIOR', NULL, '', '', '', NULL, NULL, 1, 1, '2023-11-08 13:22:10', '2023-11-08 13:22:10'),
(176, 'ELIANA', 'FABIAN MENDOZA', 'DNI', '45892540', 'FEMENINO', '36', '1987-03-16', '933994724', 'JIRON FRANCISCO MOSTAJO 501 A ', 'YANAHUARA ', 'AREQUIPA ', 'SUPERIOR', NULL, '', '', '', NULL, NULL, 1, 1, '2023-11-08 13:22:10', '2023-11-08 13:22:10'),
(177, 'MIRTHA', 'FARFAN GUTIERREZ', 'DNI', '42892409', 'FEMENINO', '38', '1985-03-11', '990802077', 'AV. SOCABAYA 507', 'SOCABAYA ', 'AREQUIPA ', 'SUPERIOR', NULL, 'SU CASA', '', 'CASAD', NULL, NULL, 1, 1, '2023-11-08 13:22:10', '2023-11-08 13:22:10'),
(178, 'JAVIER JESUS', 'FERNANDEZ CONDORI', 'DNI', '29641839', 'MASCULINO', '50', '1973-08-04', '980391595', 'CAYMA ', 'CAYMA ', 'AREQUIPA', 'SUPERIOR', NULL, '', '', 'CASADO', NULL, NULL, 1, 1, '2023-11-08 13:22:10', '2023-11-08 13:22:10'),
(179, 'EDUARDO', 'PANDIA IDME', 'DNI', '29584005', 'MASCULINO', '53', '1970-01-05', '966298822', 'BUENOS AIRES', 'CAYMA ', 'AREQUIPA', 'SUPERIOR', NULL, 'PANADERO ', '', 'CASADO', NULL, NULL, 1, 1, '2023-11-08 13:22:10', '2023-11-08 13:22:10'),
(180, 'RUTH', 'TICONA CHINO', 'DNI', '73640793', 'FEMENINO', '23', '2000-05-20', '928730502', 'MERCADO MAYORISTA DE RIOS SECO MZ.D L-56', 'C. COLORADO ', 'AREQUIPA ', 'SUPERIOR', NULL, 'NUTRICIONISTA ', '', '', NULL, NULL, 1, 1, '2023-11-08 13:22:10', '2023-11-08 13:22:10'),
(181, 'GREGORIO', 'MAQUERA', 'DNI', '43453341', 'MASCULINO', '71', '1952-04-24', '951802749', 'MARIANO MELGAR ', 'M. MELGAR ', 'AREQUIPA ', 'SUPERIOR', NULL, '', '', '', NULL, NULL, 1, 1, '2023-11-08 13:22:10', '2023-11-08 13:22:10'),
(182, 'ROXANA', 'VILCA', 'DNI', '46871110', 'FEMENINO', '32', '1991-01-31', '926604214', 'URB. DEAN VALDIVIA M-C LOTE 22', 'CAYMA ', 'AREQUIPA ', 'SUPERIOR', NULL, 'ENFERMERA', '', '', NULL, NULL, 1, 1, '2023-11-08 13:22:10', '2023-11-08 13:22:10'),
(183, 'PABLO ALFONSO', 'RODRIGUEZ REGALADO', 'DNI', '29652829', 'MASCULINO', '72', '1951-07-10', '959618030', 'FRANCISCO MOSTAJO E-11', 'CERCADO ', 'AREQUIPA', 'SUPERIOR ', NULL, 'RETIRADO', '', '', NULL, NULL, 1, 1, '2023-11-08 13:22:10', '2023-11-08 13:22:10'),
(184, 'DEIFILIA', 'MONTOYA', 'DNI', '29679248', 'FEMENINO', '67', '1956-02-20', '989302383', 'CALLE MARIANO MELGAR 726-LIBERTAD', 'C. COLORADO ', 'AREQUIPA ', 'SUPERIOR ', NULL, '', '', '', NULL, NULL, 1, 1, '2023-11-08 13:22:10', '2023-11-08 13:22:10'),
(185, 'FERNANDO', 'TEJADA QUISPE', 'DNI', '72503428', 'MASCULINO', '30', '1993-03-09', '918003927', 'CALLE TACNA 533', 'YANAHUARA ', 'AREQUIPA ', 'SUPERIOR ', NULL, '', '', '', NULL, NULL, 1, 1, '2023-11-08 13:22:10', '2023-11-08 13:22:10'),
(186, 'TATIANA', 'AGUILAR', 'DNI', '10620774', 'FEMENINO', '', '0000-00-00', '', '', 'CERCADO ', 'AREQUIPA ', '', NULL, '', '', '', NULL, NULL, 1, 1, '2023-11-08 13:22:10', '2023-11-08 13:22:10'),
(187, 'LITA', 'HUAMAN', 'DNI', '26607523', 'FEMENINO', '65', '1958-02-08', '943803152', 'CAJAMARCA ', 'C. COLORADO ', 'CAJAMARCA ', 'SUPERIOR', NULL, 'MAESTRA ', '', '', NULL, NULL, 1, 1, '2023-11-08 13:22:10', '2023-11-08 13:22:10'),
(188, 'LUIS ERNESTO', 'SOLORIO PAREDES', 'DNI', '29536382', 'MASCULINO', '', '0000-00-00', '958105082', 'URB PEDRO P DIEZ CANSECO R-17', 'J.L.B.RIVERO ', 'AREQUIPA ', 'SUPERIOR', NULL, 'ARTISTA ', '', '', NULL, NULL, 1, 1, '2023-11-08 13:22:10', '2023-11-08 13:22:10'),
(189, 'DELIA FLORCITA', 'LIMA ALVARO', 'DNI', '40984493', 'FEMENINO', '41', '1982-03-26', '965084990', 'APIPA MZ S LOTE 23', 'C.COLORADO ', 'AREQUIPA ', 'SECUNDARIA ', NULL, 'ARTISTA ', '', '', NULL, NULL, 1, 1, '2023-11-08 13:22:10', '2023-11-08 13:22:10'),
(190, 'NATALIA', 'CHURA', 'DNI', '29618944', 'FEMENINO', '48', '1974-12-01', '952009883', 'COOP VICTOR RAUL HAYA DE LA TORRE MZ. C LOT -2', 'CAYMA ', 'AREQUIPA ', 'SECUNDARIA', NULL, '', 'AMA DE CASA', '', NULL, NULL, 1, 1, '2023-11-08 13:22:10', '2023-11-08 13:22:10'),
(191, 'MAIRIN', 'GALLEGOS', 'DNI', '71659876', 'FEMENINO', '29', '1994-01-27', '987050926', 'URB. MONTERROSA B-6 ', 'CAYMA ', 'AREQUIPA ', 'SUPERIOR', NULL, '', '', '', NULL, NULL, 1, 1, '2023-11-08 13:22:10', '2023-11-08 13:22:10'),
(192, 'CINTHYA', 'GONZALES', 'DNI', '29697827', 'FEMENINO', '59', '1964-06-23', '957104768', 'SIN DIRECCIÓN ', '', '', '', NULL, 'PROFESORA', '', '', NULL, NULL, 1, 1, '2023-11-08 13:22:10', '2023-11-08 13:22:10'),
(193, 'ROMULO', 'GUTIERREZ', 'DNI', '42505161', 'MASCULINO', '42', '1980-11-11', '954805993', 'URB. VILLA PARAISO L-5 ', 'SOCABAYA ', 'AREQUIPA ', 'SUPERIOR', NULL, 'TECNICO OPERARIO ', '', '', NULL, NULL, 1, 1, '2023-11-08 13:22:10', '2023-11-08 13:22:10'),
(194, 'LUISA', 'GONZALES', 'DNI', '29701546', 'FEMENINO', '60', '1963-06-21', '973156682', 'AV. MADRE DE DIOS 304-PAMPA DE CAMARONES ', 'SACHACA', 'AREQUIPA ', 'SUPERIOR ', NULL, 'RESTAURANT', '', '', NULL, NULL, 1, 1, '2023-11-08 13:22:10', '2023-11-08 13:22:10'),
(195, 'ALMENDRA', 'GAMARRA', 'DNI', '74048696', 'FEMENINO', '', '0000-00-00', '', 'SIN DATOS ', '', '', '', NULL, '', '', '', NULL, NULL, 1, 1, '2023-11-08 13:22:10', '2023-11-08 13:22:10'),
(196, 'YESELIN', 'GUEVARA CHANCAYA', 'DNI', '71794870', 'FEMENINO', '19', '2004-10-10', '951769148', 'SIN DATOS ', '', '', 'ESTUDIANTE ', NULL, '', '', '', NULL, NULL, 1, 1, '2023-11-08 13:22:10', '2023-11-08 13:22:10'),
(197, 'PATRICIA', 'GOLDENBERG', 'DNI', '43460436', 'FEMENINO', '37', '1985-12-19', '973292837', 'URB. ADUCA D-17', 'CALLAPAMPA', 'AREQUIPA ', 'ESTUDIANTE ', NULL, '', '', '', NULL, NULL, 1, 1, '2023-11-08 13:22:10', '2023-11-08 13:22:10'),
(198, 'CELESTINO', 'GUERRA HUACALLO', 'DNI', '29617333', 'MASCULINO', '81', '1942-04-06', '949755131', 'URB,INDEPENDENCIA ZN B ALTO SELVA ALEGRE ', 'AREQUIPA ', 'AREQUIPA ', '', NULL, 'JUBILADO ', '', '', NULL, NULL, 1, 1, '2023-11-08 13:22:10', '2023-11-08 13:22:10'),
(199, 'MILAGROS', 'GONZALES', 'DNI', '43897023', 'FEMENINO', '40', '1983-10-21', '955839011', 'SIN DATOS ', '', '', '', NULL, '', '', '', NULL, NULL, 1, 1, '2023-11-08 13:22:10', '2023-11-08 13:22:10'),
(200, 'EDWIN', 'CORA', 'DNI', '04065817', 'MASCULINO', '52', '1970-11-15', '980222724', 'LIMA', 'LIMA', '', '', NULL, '', '', '', NULL, NULL, 1, 1, '2023-11-08 13:22:10', '2023-11-08 13:22:10'),
(201, 'ALVARO', 'GONZALES', 'DNI', '44285549', 'MASCULINO', '36', '1987-03-11', '965716377', 'SIN DATOS ', '', '', '', NULL, '', '', '', NULL, NULL, 1, 1, '2023-11-08 13:22:10', '2023-11-08 13:22:10'),
(202, 'ARANZA', 'GOMEZ', 'DNI', '79534705', 'FEMENINO', '07', '2016-02-10', '986766933', 'SIN DATOS ', 'CAYMA ', 'AREQUIPA ', 'ESTUDIANTE ', NULL, '', '', '', NULL, NULL, 1, 1, '2023-11-08 13:22:10', '2023-11-08 13:22:10'),
(203, 'ANABEL', 'GIRALDO', 'DNI', '10287858', 'FEMENINO', '46', '1977-01-04', '952409598', 'SIN DATOS ', 'CAYMA ', 'AREQUIPA ', 'SUPERIOR', NULL, '', '', '', NULL, NULL, 1, 1, '2023-11-08 13:22:10', '2023-11-08 13:22:10'),
(204, 'ROMINA', 'GALVEZ', 'DNI', '45821142', 'FEMENINO', '34', '1988-11-20', '986776879', 'URB. DEAN VALDIVIA H4 ', 'CAYMA ', 'AREQUIPA ', '', NULL, '', '', '', NULL, NULL, 1, 1, '2023-11-08 13:22:10', '2023-11-08 13:22:10'),
(205, 'NANO ANTONIO', 'GARCIA', 'DNI', '72208585', 'MASCULINO', '21', '2001-11-29', '940821603', '', '', '', 'ESTTUDIANTE ', NULL, '', '', 'SOLTERO ', NULL, NULL, 1, 1, '2023-11-08 13:22:10', '2023-11-08 13:22:10'),
(206, 'CECILIA', 'GARLAND VENTURO DE BALLON LANDA', 'DNI', '29529519', 'FEMENINO', '65', '1958-09-08', '959935785', 'URB. LOS ANDENES MZ A LOTE 3', 'CAYMA ', 'AREQUIPA ', 'SUPERIOR ', NULL, '', '', 'CASADA', NULL, NULL, 1, 1, '2023-11-08 13:22:10', '2023-11-08 13:22:10'),
(207, 'AMERICO', 'GONZALES TALAVERA', 'DNI', '29425279', 'MASCULINO', '53', '1970-09-11', '983087217', 'PASAJE LA MANSILLA -LA SEÑORIAL ', 'CAYMA ', 'AREQUIPA ', '', NULL, '', '', 'CASADO', NULL, NULL, 1, 1, '2023-11-08 13:22:10', '2023-11-08 13:22:10');
INSERT INTO `tba_paciente` (`IdPaciente`, `NombrePaciente`, `ApellidoPaciente`, `TipoIdentificacion`, `NumeroIdentificacion`, `SexoPaciente`, `EdadPaciente`, `FechaNacimiento`, `CelularPaciente`, `DomicilioPaciente`, `LugarProcedencia`, `LugarNacimiento`, `GradoInstruccion`, `RazaPaciente`, `OcupacionPaciente`, `ReligionPaciente`, `EstadoCivil`, `NumeroContactoPaciente`, `NombreContactoPaciente`, `UsuarioCreado`, `UsuarioActualiza`, `FechaCreacion`, `FechaActualizacion`) VALUES
(208, 'ADRIANA', 'GUZMAN', 'DNI', '60624532', 'FEMENINO', '15', '2008-06-12', '989310649', '', '', '', 'ESTUDIANTE ', NULL, '', '', '', NULL, NULL, 1, 1, '2023-11-08 13:22:10', '2023-11-08 13:22:10'),
(209, 'FRANCO', 'LÓPEZ VILCA', 'DNI', '76630481', 'MASCULINO', '20', '2003-09-21', '917365718', 'JACINTO IBAÑEZ - INDEPENDENCIA', 'A.S.A. ', 'AREQUIPA', 'SUPERIOR', NULL, 'ESTUDIANTE', '', 'SOLTERO', NULL, NULL, 1, 1, '2023-11-08 13:22:10', '2023-11-08 13:22:10'),
(210, 'LUISA', 'LOAIZA DE SALAZAR', 'DNI', '29512994', 'FEMENINO', '63', '1960-08-25', '958700521', 'URB. NUESTRA SEÑORA DE FATIMA A-14', 'YANAHUARA', 'AREQUIPÁ ', '', NULL, '', '', 'CASADA', NULL, NULL, 1, 1, '2023-11-08 13:22:10', '2023-11-08 13:22:10'),
(211, 'PERCY', 'LAZO', 'DNI', '41810297', 'MASCULINO', '35', '1988-01-13', '954002626', 'URB. JOSE MARIA ARGUEDAS 238', 'YANAHUARA', 'AREQUIPA', 'SUPERIOR', NULL, '', '', '', NULL, NULL, 1, 1, '2023-11-08 13:22:10', '2023-11-08 13:22:10'),
(212, 'SERGIO', 'LOPEZ', 'DNI', '44366354', 'MASCULINO', '36', '1987-02-09', '974279415', 'QUINTA LA FLORESTA', 'AREQUIPA ', '', '', NULL, '', '', '', NULL, NULL, 1, 1, '2023-11-08 13:22:10', '2023-11-08 13:22:10'),
(213, 'FLORA', 'LOPINTA SAPACAYO', 'DNI', '43412010', 'FEMENINO', '37', '1985-11-24', '979054177', 'PUEBLO JONAS 23 DE JUNIO D-4', 'SACHACA', 'AREQUIPA', 'SUPERIOR', NULL, 'ASISTENTA SOCIAL', '', 'CASADA', NULL, NULL, 1, 1, '2023-11-08 13:22:10', '2023-11-08 13:22:10'),
(214, 'MARIA TERESA', 'LA TORRE GONZALES', 'DNI', '29727787', 'FEMENINO', '52', '1970-11-25', '958908068', '', 'CAYMA ', 'LIMA', '', NULL, 'ENFERMERA', '', 'CASADA', NULL, NULL, 1, 1, '2023-11-08 13:22:10', '2023-11-08 13:22:10'),
(215, 'GIULIANA', 'LAJO MONTOYA', 'DNI', '43870387', 'FEMENINO', '37', '1986-07-07', '959380703', '', 'C. COLORADO ', 'LIMA', '', NULL, '', '', '', NULL, NULL, 1, 1, '2023-11-08 13:22:10', '2023-11-08 13:22:10'),
(216, 'ANTONIO', 'LLACHA ESCARZA', 'DNI', '30574060', 'MASCULINO', '60', '1963-01-21', '921036331', '', '', 'CAYLLOMA', '', NULL, '', '', 'CASADO', NULL, NULL, 1, 1, '2023-11-08 13:22:10', '2023-11-08 13:22:10'),
(217, 'BRENDA', 'LIRA DE MILLER', 'DNI', '05640293', 'FEMENINO', '64', '1959-08-31', '996780457', '', 'LIMA', 'LIMA', '', NULL, '', '', 'CASADA', NULL, NULL, 1, 1, '2023-11-08 13:22:10', '2023-11-08 13:22:10'),
(218, 'ROSANGELA', 'LASTARRIA', 'DNI', '49045983', 'FEMENINO', '43', '1980-05-11', '953271538', 'CALLE GRAU 117', 'SACHACA', 'AREQUIPA', '', NULL, '', '', 'CASADA', NULL, NULL, 1, 1, '2023-11-08 13:22:10', '2023-11-08 13:22:10'),
(219, 'FERNANDO', 'LOPEZ', 'DNI', '29564455', 'MASCULINO', '54', '1968-12-27', '978531515', 'CALLE SANCHEZ TRUJILLO 237', 'MIRAFLORES', 'TACNA', 'SECUNDARIA', NULL, 'COMERCIO', '', 'CASADO', NULL, NULL, 1, 1, '2023-11-08 13:22:10', '2023-11-08 13:22:10'),
(220, 'LUIS HUMBERTO', 'LAZO PAUCAR', 'DNI', '74948491', 'MASCULINO', '20', '2003-02-22', '923092297', '', 'TIABAYA', 'AREQUIPA', '', NULL, 'ESTUDIANTE', '', 'SOLTERO', NULL, NULL, 1, 1, '2023-11-08 13:22:10', '2023-11-08 13:22:10'),
(221, 'MARIANELA', 'LUNA ESPINOZA', 'DNI', '02628339', 'FEMENINO', '66', '1956-12-30', '954955043', 'AV. CAYMA 217 DPTO 301', '', 'HUANUCO', 'TECNICO', NULL, 'CASA', 'CATOLICO ', 'CASADA', NULL, NULL, 1, 1, '2023-11-08 13:22:10', '2023-11-08 13:22:10'),
(222, 'THELMA', 'MARQUEZ ATENCIO', 'DNI', '29245940', 'FEMENINO', '62', '1961-01-10', '982522617', 'URB. PIEDRA SANTA C-5', 'YANAHUARA', 'AREQUIPA', 'SUPERIOR', NULL, 'ADMINISTRACION', 'CATOLICA', '', NULL, NULL, 1, 1, '2023-11-08 13:22:10', '2023-11-08 13:22:10'),
(223, 'NEREYDA', 'MONTEAGUDO', 'DNI', '29221113', 'FEMENINO', '59', '1964-01-03', '962375617', '', '', '', 'SUPERIOR', NULL, '', '', '', NULL, NULL, 1, 1, '2023-11-08 13:22:10', '2023-11-08 13:22:10'),
(224, 'ZENAIDA YULY', 'MAMANI MAMANI', 'DNI', '44139490', 'FEMENINO', '38', '1985-08-02', '977448845', 'URB. CORAZÓN DE JESÚS MZ. N LOT-16', 'SOCABAYA ', 'JULIACA', '', NULL, '', '', 'SOLTERA', NULL, NULL, 1, 1, '2023-11-08 13:22:10', '2023-11-08 13:22:10'),
(225, 'ROSA', 'MONTEAGUDO', 'DNI', '29557078', 'FEMENINO', '53', '1970-08-02', '992577224', 'V.A.BELAUNDE C-9 L-8', 'C. COLORADO ', '', 'SUPERIOR', NULL, 'CONTADORA', '', '', NULL, NULL, 1, 1, '2023-11-08 13:22:10', '2023-11-08 13:22:10'),
(226, 'ADRIANA', 'MARDINI', 'DNI', '70575271', 'FEMENINO', '29', '1994-08-20', '918299693', '', '', '', '', NULL, '', '', '', NULL, NULL, 1, 1, '2023-11-08 13:22:10', '2023-11-08 13:22:10'),
(227, 'CARMEN', 'MENDOZA', 'DNI', '29290562', 'FEMENINO', '74', '1949-04-02', '959347675', 'URB. CAMPO VERDE L-12', '', 'AREQUIPA', '', NULL, '', '', 'CASADA', NULL, NULL, 1, 1, '2023-11-08 13:22:10', '2023-11-08 13:22:10'),
(228, 'YOVANA', 'MONTEAGUDO', 'DNI', '29222257', 'FEMENINO', '74', '1949-04-02', '951159741', 'URB. MIRASOL ', 'CAYMA ', 'AREQUIPA', 'SUPERIOR', NULL, '', '', 'CASADA', NULL, NULL, 1, 1, '2023-11-08 13:22:10', '2023-11-08 13:22:10'),
(229, 'YULIANA', 'MENDIZABAL ASTO', 'DNI', '43201934', 'FEMENINO', '38', '1984-12-20', '998642152', 'ASOC. APTASA AV, PERU I-3', 'C. COLORADO ', 'AREQUIPA ', 'SUPERIOR', NULL, 'ESTETISISTA', '', 'SOLTERA', NULL, NULL, 1, 1, '2023-11-08 13:22:10', '2023-11-08 13:22:10'),
(230, 'ALMENDRA', 'MEZA CHAVEZ', 'DNI', '72702210', 'FEMENINO', '27', '1995-12-11', '976372785', 'URB. SANTA ROSA DE LIMA  C-6 ', 'C. COLORADO ', 'AREQUIPA ', 'SUPERIOR', NULL, 'ADMINISTRADOR ', '', '', NULL, NULL, 1, 1, '2023-11-08 13:22:10', '2023-11-08 13:22:10'),
(231, 'CARLOS M', 'MONTOYA CONDE', 'DNI', '05358099', 'MASCULINO', '50', '1972-12-10', '985022884', 'CAÑETE ', 'LIMA', '', 'SUPERIOR', NULL, 'TECNICO OPERARIO ', '', '', NULL, NULL, 1, 1, '2023-11-08 13:22:10', '2023-11-08 13:22:10'),
(232, 'ALFONSO', 'NUÑEZ GERSI', 'DNI', '00471072', 'MASCULINO', '76', '1947-08-14', '913200215', '3RA ETAPA MAGISTERIAL F-13', 'YANAHUARA ', 'AREQUIPA ', '', NULL, 'JUBILADO ', '', '', NULL, NULL, 1, 1, '2023-11-08 13:22:10', '2023-11-08 13:22:10'),
(233, 'KARINA', 'NEYRA SALAZAR', 'DNI', '30424155', 'FEMENINO', '47', '1976-07-08', '943554467', 'OSCAR BENAVIDES 406', 'YANAHUARA ', 'AREQUIPA', 'SUPERIOR', NULL, 'JEFE DE VENTAS ', '', '', NULL, NULL, 1, 1, '2023-11-08 13:22:10', '2023-11-08 13:22:10'),
(234, 'GABRIEL', 'NEYRA', 'DNI', '75736646', 'MASCULINO', '19', '2004-03-12', '', '', '', '', '', NULL, '', '', '', NULL, NULL, 1, 1, '2023-11-08 13:22:10', '2023-11-08 13:22:10'),
(235, 'KARINA', 'OPORTO CARRASCO', 'DNI', '29483690', 'FEMENINO', '50', '1973-02-13', '', 'CALLE GARCILAZO DE LA VEGA 210', 'UMACOLLO ', 'AREQUIPA', 'SUPERIOR', NULL, '', '', '', NULL, NULL, 1, 1, '2023-11-08 13:22:10', '2023-11-08 13:22:10'),
(236, 'ESTEFANY', 'ORTIZ TEJERA', 'DNI', '70374202', 'FEMENINO', '19', '2004-08-17', '968415630', 'HUARANGUILLO', 'SACHACA', 'AREQUIPA', 'ESTUDIANTE ', NULL, '', '', '', NULL, NULL, 1, 1, '2023-11-08 13:22:10', '2023-11-08 13:22:10'),
(237, 'DAVID', 'OSCA', 'DNI', '41286490', 'MASCULINO', '41', '1981-12-20', '959199905', '', 'AREQUIPA', 'AREQUIPA', 'SUPERIOR', NULL, '', '', '', NULL, NULL, 1, 1, '2023-11-08 13:22:10', '2023-11-08 13:22:10'),
(238, 'JESUS', 'ORMACHEA', 'DNI', '72417374', 'MASCULINO', '28', '1995-08-07', '903582412', 'GONZALES PRADA 106', 'J.L.B. R', 'AREQUIPA', 'SUPERIOR', NULL, '', '', '', NULL, NULL, 1, 1, '2023-11-08 13:22:10', '2023-11-08 13:22:10'),
(239, 'LUIS', 'ORTIZ', 'DNI', '30854564', 'MASCULINO', '48', '1974-11-15', '992745774', '', '', 'AREQUIPA', 'SUPERIOR', NULL, '', '', '', NULL, NULL, 1, 1, '2023-11-08 13:22:10', '2023-11-08 13:22:10'),
(240, 'GIOVANA', 'ORURO', 'DNI', '47021780', 'FEMENINO', '31', '1992-02-07', '900094642', 'AV. ALFONSO UGARTE 700', 'C. COLORADO ', 'AREQUIPA', 'SUPERIOR', NULL, '', '', '', NULL, NULL, 1, 1, '2023-11-08 13:22:10', '2023-11-08 13:22:10'),
(241, 'OSCAR', 'MOLLO HUAMANI', 'DNI', '42877050', 'MASCULINO', '28', '1995-03-05', '983021067', 'PROLONG. AV. EJERCITO ', 'C.COLORADO ', 'AREQUIPA', 'SUPERIOR', NULL, 'TECNICO OPERARIO ', '', '', NULL, NULL, 1, 1, '2023-11-08 13:22:10', '2023-11-08 13:22:10'),
(242, 'JOSEMARIA SEBASTIAN', 'MANRIQUE PACHECO', 'DNI', '71844569', 'MASCULINO', '27', '1996-05-05', '988826748', 'URB LOS PORTALES DE CAYMA G-17', 'CAYMA ', 'AREQUIPA', 'SUPERIOR', NULL, '', '', '', NULL, NULL, 1, 1, '2023-11-08 13:22:10', '2023-11-08 13:22:10'),
(243, 'JERSON', 'MENA PALOMINO', 'DNI', '73510730', 'MASCULINO', '24', '1999-03-06', '927739417', '', 'CAYMA ', 'AREQUIPA', 'SUPERIOR', NULL, 'ESTUDIANTE ', '', '', NULL, NULL, 1, 1, '2023-11-08 13:22:10', '2023-11-08 13:22:10'),
(244, 'HILDA', 'MALCOACHA', 'DNI', '29714713', 'FEMENINO', '46', '1977-06-18', '962220641', 'VILLA CONFRATERNIDAD Y-7', 'A.S. A', 'AREQUIPA', 'SUPERIOR', NULL, '', '', 'CASADA', NULL, NULL, 1, 1, '2023-11-08 13:22:10', '2023-11-08 13:22:10'),
(245, 'FLORENCIA', 'MARTINEZ ALVIS', 'DNI', '29297321', 'FEMENINO', '58', '1965-10-26', '991054924', 'CALLE RICARDO PALMA 301-SIMON BOLOVAR ', 'SOCABAYA ', 'AREQUIPA', '', NULL, '', '', '', NULL, NULL, 1, 1, '2023-11-08 13:22:10', '2023-11-08 13:22:10'),
(246, 'SUSAN MARLEY', 'MAMANI PACHECO', 'DNI', '45032249', 'FEMENINO', '35', '1988-05-10', '956129600', '', '', 'AREQUIPA', 'SUPERIOR', NULL, '', '', '', NULL, NULL, 1, 1, '2023-11-08 13:22:10', '2023-11-08 13:22:10'),
(247, 'LUANA', 'MANRIQUE ROSAS', 'DNI', '81228653', 'FEMENINO', '10', '2013-06-11', '973696268', 'URB. PIEDRA SANTA II ETAPA T-/ ', 'YANAHUARA', 'AREQUIPA', 'SUPERIOR', NULL, 'ESTUDIANTE ', '', 'SOLTERA', NULL, NULL, 1, 1, '2023-11-08 13:22:10', '2023-11-08 13:22:10'),
(248, 'MARIA MAGDALENA', 'PORTILLA LINARES', 'DNI', '29255521', 'FEMENINO', '69', '1954-07-29', '967728571', 'PASAJE JAVIER DELGADO 107', 'UNACOLLO', 'AREQUIPA', 'SUPERIOR', NULL, '', '', '', NULL, NULL, 1, 1, '2023-11-08 13:22:10', '2023-11-08 13:22:10'),
(249, 'RENE', 'PEÑA CUBA', 'DNI', '47808127', 'MASCULINO', '32', '1991-04-26', '984415543', 'LA JOYA ', 'LA JOYA ', 'AREQUIPA', 'SUPERIOR', NULL, 'ARTISTA ', '', 'CASADO ', NULL, NULL, 1, 1, '2023-11-08 13:22:10', '2023-11-08 13:22:10'),
(250, 'ALONSO', 'PINTO', 'DNI', '45350869', 'MASCULINO', '35', '1988-09-16', '989104403', '5TA REAL FELIPE B-8', 'C. COLORADO ', 'AREQUIPA', 'SUPERIOR', NULL, 'CATEDRATICO ', '', 'SOLTERO ', NULL, NULL, 1, 1, '2023-11-08 13:22:10', '2023-11-08 13:22:10'),
(251, 'NERCY', 'PALOMINO', 'DNI', '29272195', 'FEMENINO', '57', '1966-05-30', '987249411', 'MOLLENDO ', 'ISLAY ', 'AREQUIPA', 'SUPERIOR', NULL, 'ENFERMERA', '', '', NULL, NULL, 1, 1, '2023-11-08 13:22:10', '2023-11-08 13:22:10'),
(252, 'TANIA LIZ', 'PACO YANA', 'DNI', '71414481', 'FEMENINO', '32', '1990-12-29', '967283583', '', '', 'AREQUIPA', '', NULL, '', '', '', NULL, NULL, 1, 1, '2023-11-08 13:22:10', '2023-11-08 13:22:10'),
(253, 'IZVETY', 'PACORA  GARCIA', 'DNI', '30834689', 'FEMENINO', '51', '0000-00-00', '934887532', 'ROBERT KENEDY 104 -VILLA LOURDES ', 'MOLLENDO ', 'AREQUIPA', '', NULL, '', '', '', NULL, NULL, 1, 1, '2023-11-08 13:22:10', '2023-11-08 13:22:10'),
(254, 'ESTELA', 'PINEDO DELGADO', 'DNI', '61954551', 'FEMENINO', '26', '1997-08-04', '977970778', 'LAAS MALVINAS H-7 ', 'CAYMA ', 'AREQUIPA ', 'SUPERIOR', NULL, 'DEPENDIENTE ', '', '', NULL, NULL, 1, 1, '2023-11-08 13:22:10', '2023-11-08 13:22:10'),
(255, 'ALEJANDRINA', 'PINTO VEGA', 'DNI', '29339603', 'FEMENINO', '76', '1947-02-27', '', 'CALLE TACNA 109 ', 'C. COLORADO ', 'AREQUIPA ', 'SUPERIOR', NULL, 'JUBILADA', '', '', NULL, NULL, 1, 1, '2023-11-08 13:22:10', '2023-11-08 13:22:10'),
(256, 'DAVID', 'PIZARRO CHURA', 'DNI', '45640455', 'MASCULINO', '34', '1989-03-12', '993371621', 'PACHACUTEC 206', 'C.C OLORADO ', 'AREQUIPA ', 'SUPERIOR', NULL, 'ESTUDIANTE ', '', '', NULL, NULL, 1, 1, '2023-11-08 13:22:10', '2023-11-08 13:22:10'),
(257, 'CESAR REYNALDO', 'PEREZ PAUCAR', 'DNI', '29574152', 'MASCULINO', '73', '1950-07-16', '957921652', 'PARQUE LOS ANGELES MZ-L LOTE 9', 'C. COLORADO ', 'AREQUIPA ', 'SUPERIOR', NULL, 'JUBILADO ', '', '', NULL, NULL, 1, 1, '2023-11-08 13:22:10', '2023-11-08 13:22:10'),
(258, 'FELICITAS', 'PUMACHARA', 'DNI', '24871840', 'FEMENINO', '66', '0000-00-00', '914161422', '', '', '', '', NULL, '', '', '', NULL, NULL, 1, 1, '2023-11-08 13:22:10', '2023-11-08 13:22:10'),
(259, 'ANA LUCIA', 'PRIETO ROSAS', 'DNI', '45294181', 'FEMENINO', '35', '1988-08-24', '987238862', '', '', '', '', NULL, '', '', '', NULL, NULL, 1, 1, '2023-11-08 13:22:10', '2023-11-08 13:22:10'),
(260, 'JHOVANA', 'PEQUEÑA', 'DNI', '40831351', 'FEMENINO', '39', '0000-00-00', '959583643', 'CALLE ALFONSO UGARTE ', 'HUNTER ', 'AREQUIPA ', '', NULL, '', '', '', NULL, NULL, 1, 1, '2023-11-08 13:22:10', '2023-11-08 13:22:10'),
(261, 'ELVIS', 'HUANCA', 'DNI', '74660921', 'MASCULINO', '24', '1999-02-12', '917435807', 'CAYMA ', 'AREQUIPA ', 'AREQUIPA ', 'SUPERIOR', NULL, 'ELECTRICISTA', '', '', NULL, NULL, 1, 1, '2023-11-08 13:22:10', '2023-11-08 13:22:10'),
(262, 'MANUELA MERCEDES', 'HUASHUAYO CHAVEZ', 'DNI', '30770988', 'FEMENINO', '49', '1974-04-28', '967991512', 'C.COLORADO ', '', 'AREQUIPA ', '', NULL, '', '', '', NULL, NULL, 1, 1, '2023-11-08 13:22:10', '2023-11-08 13:22:10'),
(263, 'SEYDINA', 'HUAYTO ACHAHUI', 'DNI', '74287073', 'FEMENINO', '24', '0000-00-00', '943831384', 'CIUDAD MUNICIPAL ', 'C.COLORADO ', 'AREQUIPA ', '', NULL, '', '', '', NULL, NULL, 1, 1, '2023-11-08 13:22:10', '2023-11-08 13:22:10'),
(264, 'MARISOL', 'HUAYQUE SURCO', 'DNI', '74942230', 'FEMENINO', '24', '1999-05-15', '973943927', '', 'C.COLORADO ', '', 'SUPERIOR', NULL, '', '', '', NULL, NULL, 1, 1, '2023-11-08 13:22:10', '2023-11-08 13:22:10'),
(265, 'DIEGO ALONSO', 'HURTADO ALEJO', 'DNI', '45611931', 'MASCULINO', '34', '1988-12-23', '994187394', 'CAYMA ', '', 'AREQUIPA ', 'SUPERIOR', NULL, 'POLICIA', '', '', NULL, NULL, 1, 1, '2023-11-08 13:22:10', '2023-11-08 13:22:10'),
(266, 'ROBERT', 'HAÑARI LOPINTA', 'DNI', '78794922', 'MASCULINO', '09', '2014-10-03', '', '', 'TIABAYA', 'AREQUIPA ', 'SUPERIOR', NULL, 'ESTUDIANTE', '', '', NULL, NULL, 1, 1, '2023-11-08 13:22:10', '2023-11-08 13:22:10'),
(267, 'TERESA CARMEN', 'HUAMANI PUMA', 'DNI', '48631764', 'FEMENINO', '28', '1995-03-12', '983056558', 'COOP VISTA ALEGRE MZ D LOTE 1 ', '', 'AREQUIPA ', 'SUPERIOR', NULL, '', '', '', NULL, NULL, 1, 1, '2023-11-08 13:22:10', '2023-11-08 13:22:10'),
(268, 'HIPOLITA', 'HUARSAYA', 'DNI', '29551209', 'FEMENINO', '55', '1968-01-30', '972935163', '15 DE AGOSTO 504 ', 'PAUCARPATA', 'AREQUIPA ', 'SUPERIOR', NULL, '', '', 'CASADA', NULL, NULL, 1, 1, '2023-11-08 13:22:10', '2023-11-08 13:22:10'),
(269, 'JUAN CARLOS', 'NEYRA PACHECO', 'DNI', '29714696', 'MASCULINO', '46', '1977-07-28', '959247689', 'CALLE GENERAL VARELA 880 ', 'CAYMA ', 'AREQUIPA ', 'SUPERIOR', NULL, 'EMPRESARIO', '', '', NULL, NULL, 1, 1, '2023-11-08 13:22:10', '2023-11-08 13:22:10'),
(270, 'GONZALO', 'VALDIVIA  ', 'DNI', '30676727', 'MASCULINO', '45', '0000-00-00', '932830130', '', '', '', '', NULL, '', '', '', NULL, NULL, 1, 1, '2023-11-08 13:22:10', '2023-11-08 13:22:10'),
(271, 'VALENTINA', 'GARCIA CORDOVA', 'DNI', '81560394', 'FEMENINO', '7', '0000-00-00', '959214213', 'URB. CAMPIÑA N-10 ', 'SOCABAYA ', 'AREQUIPA ', '', NULL, 'ESTUDIANTE ', '', '', NULL, NULL, 1, 1, '2023-11-08 13:22:10', '2023-11-08 13:22:10'),
(272, 'JENNY', 'PINO GALLEGOS', 'DNI', '29335982', 'FEMENINO', '58', '1965-05-24', '962203662', 'ALTO LIBERTAD GIRON CUZCO 202 ', '', 'C. COLORADO ', 'SUPERIOR', NULL, '', '', '', NULL, NULL, 1, 1, '2023-11-08 13:22:10', '2023-11-08 13:22:10'),
(273, 'SANTA', 'GONZALES SANCHEZ', 'DNI', '74315353', 'FEMENINO', '21', '0000-00-00', '978500520', '', '', 'CAJAMARCA', '', NULL, 'ESTUDIANTE ', '', '', NULL, NULL, 1, 1, '2023-11-08 13:22:10', '2023-11-08 13:22:10'),
(274, 'JOSHUA', 'GONZALES', 'DNI', '47099211', 'MASCULINO', '32', '1991-07-04', '969508038', 'CALLE LAS BEATAS 121 C-5 ', 'YANAHUARA ', 'AREQUIPA ', '', NULL, '', '', '', NULL, NULL, 1, 1, '2023-11-08 13:22:10', '2023-11-08 13:22:10'),
(275, 'DELIA', 'HILACUNDO AQUIRRE', 'DNI', '24813678', 'FEMENINO', '45', '1977-11-24', '970053645', 'PASAJE TUPAC AMARU 123  ', 'MIRAFLORES', 'AREQUIPA ', '', NULL, '', '', '', NULL, NULL, 1, 1, '2023-11-08 13:22:10', '2023-11-08 13:22:10'),
(276, 'MAYLI', 'HUACHACA ALA', 'DNI', '75117160', 'FEMENINO', '23', '2000-05-12', '906661643', 'H.H. LAS LOMAS ZN 1 ', 'C. COLORADO', 'AREQUIPA ', 'SUPERIOR', NULL, 'ESTUDIANTE ', '', '', NULL, NULL, 1, 1, '2023-11-08 13:22:10', '2023-11-08 13:22:10'),
(277, 'GIORGIO LUIS', 'HUERTA PRESBITERO', 'DNI', '41242572', 'MASCULINO', '40', '0000-00-00', '', 'URB,LOS GLADIOLOS 210 ', 'YANAHUARA ', 'AREQUIPA ', 'SUPERIOR', NULL, 'AGENTE INMOVILIARIO', '', '', NULL, NULL, 1, 1, '2023-11-08 13:22:10', '2023-11-08 13:22:10'),
(278, 'LIZETH', 'HUACHACA ALA', 'DNI', '81196288', 'FEMENINO', '09', '2013-11-29', '961722132', 'MONZERRAT MZ Z LT 3 ', 'C. COLORADO', 'AREQUIPA ', '', NULL, 'ESTUDIANTE ', '', '', NULL, NULL, 1, 1, '2023-11-08 13:22:10', '2023-11-08 13:22:10'),
(279, 'YOSELIN', 'HUACHACA ALA', 'DNI', '75117165', 'FEMENINO', '18', '2005-10-28', '961722132', 'MONZERRAT MZ Z LT 3 ', 'C. COLORADO', 'AREQUIPA ', '', NULL, 'ESTUDIANTE ', '', '', NULL, NULL, 1, 1, '2023-11-08 13:22:10', '2023-11-08 13:22:10'),
(280, 'AMANDINA AURELIA', 'HUAYCHO SISA', 'DNI', '30428988', 'FEMENINO', '49', '1973-12-02', '989999471', 'URB. JOSE LUIS BISTAMANTE Y RIVERO ', 'C. COLORADO', '', '', NULL, '', '', '', NULL, NULL, 1, 1, '2023-11-08 13:22:10', '2023-11-08 13:22:10'),
(281, 'INDIRA', 'HUACHACA MUELLE', 'DNI', '73528417', 'FEMENINO', '29', '1994-10-01', '901389233', 'CUZCO  - CHUMBIBILCAS ', '', 'CUZCO ', 'SUPERIOR', NULL, 'MAQUINARIA PESADA', '', '', NULL, NULL, 1, 1, '2023-11-08 13:22:10', '2023-11-08 13:22:10'),
(282, 'LUCRECIA', 'HUILLCA TAPARA', 'DNI', '75695948', 'FEMENINO', '22', '2000-12-07', '900476689', '', '', '', '', NULL, 'ESTUDIANTE ', '', '', NULL, NULL, 1, 1, '2023-11-08 13:22:10', '2023-11-08 13:22:10'),
(283, 'JANELLY', 'HURTADO LOPEZ', 'DNI', '44309957', 'FEMENINO', '36', '1987-02-11', '986983834', 'JOSE LUIS BUSTAMENTE Y RIVERO', '', 'AREQUIPA ', 'SUPERIOR', NULL, 'ADMINISTRACIÓN ', '', 'CASADA', NULL, NULL, 1, 1, '2023-11-08 13:22:10', '2023-11-08 13:22:10'),
(284, 'JORGE ISAC', 'HUACHA SUCCA', 'DNI', '72105828', 'MASCULINO', '27', '1995-12-02', '935340501', 'SOR ANA DE LOS ANGELES ZN2 MZ A 9', 'C. COLORADO ', 'AREQUIPA ', '', NULL, '', '', '', NULL, NULL, 1, 1, '2023-11-08 13:22:10', '2023-11-08 13:22:10'),
(285, 'JESUS', 'HERRERA', 'DNI', '74214658', 'MASCULINO', '25', '1998-02-21', '948035508', '', '', 'AREQUIPA ', 'SUPERIOR', NULL, 'TECNICO ELECTRICISTA', '', '', NULL, NULL, 1, 1, '2023-11-08 13:22:10', '2023-11-08 13:22:10'),
(286, 'LIZELDA', 'HINOSTROZA LUQUE', 'DNI', '43855131', 'FEMENINO', '37', '1986-06-30', '973595733', '', '', '', '', NULL, '', '', '', NULL, NULL, 1, 1, '2023-11-08 13:22:10', '2023-11-08 13:22:10'),
(287, 'ANGELICA', 'HALLASI VILLEGAS', 'DNI', '76948012', 'FEMENINO', '22', '2001-01-04', '980994512', 'MANUEL UGARTECHE 507 ', 'SELVA ALEGRE ', 'AREQUIPA ', 'SUPERIOR', NULL, 'ESTUDIANTE ', '', '', NULL, NULL, 1, 1, '2023-11-08 13:22:10', '2023-11-08 13:22:10'),
(288, 'PRUDENCIA', 'JAEN ABARCA', 'DNI', '29630100', 'FEMENINO', '83', '1940-04-28', '944684809', 'URB. 200 MILLAS PASAJE HUMBOLD C-14 ', 'PAUCARPATA', 'AREQUIPA ', '', NULL, '', '', '', NULL, NULL, 1, 1, '2023-11-08 13:22:10', '2023-11-08 13:22:10'),
(289, 'YESICA', 'JULA SOCLLE', 'DNI', '76609715', 'FEMENINO', '25', '0000-00-00', '', '', '', '', '', NULL, '', '', '', NULL, NULL, 1, 1, '2023-11-08 13:22:10', '2023-11-08 13:22:10'),
(290, 'LIDIA', 'JAUREGUI MALDONADO', 'DNI', '00454096', 'FEMENINO', '79', '1944-08-03', '999464744', 'MARIANO MELGAR ', 'M. MELGAR', 'AREQUIPA ', '', NULL, 'SU CASA', '', '', NULL, NULL, 1, 1, '2023-11-08 13:22:10', '2023-11-08 13:22:10'),
(291, 'HUBERT', 'LIMA ALFARO', 'DNI', '43071282', 'MASCULINO', '38', '1985-05-30', '928666586', 'CHUMBIBILCAS ', 'CUZCO ', 'CUZCO ', 'SUPERIOR', NULL, 'COMERCIANTE', '', '', NULL, NULL, 1, 1, '2023-11-08 13:22:10', '2023-11-08 13:22:10'),
(292, 'NINOSKA', 'LAZO MANACERO', 'DNI', '42991900', 'FEMENINO', '50', '1973-01-15', '957604006', 'SAENZ PEÑA 429 ', 'MIRAFLORES ', 'AREQUIPA ', '', NULL, '', '', '', NULL, NULL, 1, 1, '2023-11-08 13:22:10', '2023-11-08 13:22:10'),
(293, 'LUIS RODRIGO', 'LUJAN BEGAZO', 'DNI', '70451224', 'MASCULINO', '27', '1995-12-27', '971554700', 'URB. SANTA ROSA DE LIMA T.10', 'C. COLORADO ', 'AREQUIPA ', 'SUPERIOR', NULL, 'ADMINISTRACIÓN ', '', '', NULL, NULL, 1, 1, '2023-11-08 13:22:10', '2023-11-08 13:22:10'),
(294, 'SEVERINA', 'LOPEZ NARVAEZ', 'DNI', '29567716', 'FEMENINO', '71', '1951-11-08', '98700403', 'CALLE MADRE DE DIOS 428', 'M. MELGAR', 'AREQUIPA ', '', NULL, '', '', '', NULL, NULL, 1, 1, '2023-11-08 13:22:10', '2023-11-08 13:22:10'),
(295, 'KIARA', 'LLERENA MEDINA', 'DNI', '47439251', 'FEMENINO', '31', '1992-08-04', '992906569', 'JOSE LUIS BUSTAMANTE Y RIVERO', '', 'AREQUIPA ', '', NULL, '', '', '', NULL, NULL, 1, 1, '2023-11-08 13:22:10', '2023-11-08 13:22:10'),
(296, 'VERONICA', 'LAURA HURTADO', 'DNI', '73053603', 'FEMENINO', '20', '2003-11-03', '985887160', 'CALLE CHACHAPOYAS 520 ', 'SOCABAYA ', 'AREQUIPA ', 'SUPERIOR', NULL, 'ESTUDIANTE ', '', '', NULL, NULL, 1, 1, '2023-11-08 13:22:10', '2023-11-08 13:22:10'),
(297, 'PAOLA', 'PALOMINO', 'DNI', '30963758', 'FEMENINO', '46', '1977-06-16', '959144167', '', 'CAYMA ', 'AREQUIPA ', '', NULL, '', '', '', NULL, NULL, 1, 1, '2023-11-08 13:22:10', '2023-11-08 13:22:10'),
(298, 'EVER', 'PICHO SUPO', 'DNI', '40543292', 'MASCULINO', '53', '1970-05-03', '976694329', '', 'SIVAYO ', '', '', NULL, '', '', '', NULL, NULL, 1, 1, '2023-11-08 13:22:10', '2023-11-08 13:22:10'),
(299, 'FRANCKLIN', 'SIVANA ACHINQUIPA', 'DNI', '71904785', 'MASCULINO', '18', '2004-11-09', '916400120', 'SENASA -EMBAJADA DE JAPON- CAYMA  ', 'CAMANA', 'AREQUIPA ', '', NULL, '', '', '', NULL, NULL, 1, 1, '2023-11-08 13:22:10', '2023-11-08 13:22:10'),
(300, 'CARMEN', 'SILVA SILVA', 'DNI', '29311260', 'FEMENINO', '63', '1960-06-24', '987639723', 'URB MIRADO DE CAYMA D-2', 'CAYMA ', 'AREQUIPA ', '', NULL, '', '', '', NULL, NULL, 1, 1, '2023-11-08 13:22:10', '2023-11-08 13:22:10'),
(301, 'ELIANA', 'SOSA SANCHEZ', 'DNI', '30821227', 'FEMENINO', '60', '1962-12-17', '942076623', 'MATARANI', 'ISLAY ', 'AREQUIPA ', '', NULL, '', '', '', NULL, NULL, 1, 1, '2023-11-08 13:22:10', '2023-11-08 13:22:10'),
(302, 'CRISTHIAN', 'SANCHEZ MEDINA', 'DNI', '75240143', 'MASCULINO', '27', '1996-04-18', '966551222', 'ALTO CERRO VERDE B1 ', 'UCHUMAYO ', 'AREQUIPA ', '', NULL, '', '', '', NULL, NULL, 1, 1, '2023-11-08 13:22:10', '2023-11-08 13:22:10'),
(303, 'DOROTEO', 'SULLA SULLA', 'DNI', '24874117', 'MASCULINO', '54', '1969-02-06', '953562988', 'ALTO CAYMA ', 'CUZCO ', 'AREQUIPA ', '', NULL, '', '', '', NULL, NULL, 1, 1, '2023-11-08 13:22:10', '2023-11-08 13:22:10'),
(304, 'EUFRACIA', 'SAPACAYO SOTO', 'DNI', '29513094', 'FEMENINO', '70', '1953-07-01', '910144907', 'SACHACA ', 'ESPINAR ', 'AREQUIPA ', '', NULL, '', '', '', NULL, NULL, 1, 1, '2023-11-08 13:22:10', '2023-11-08 13:22:10'),
(305, 'MARCO ANTONIO', 'SUYCO HUAMANI', 'DNI', '42374367', 'MASCULINO', '41', '1982-03-30', '962368237', 'CERRO COLORADO ', 'YURA ', 'AREQUIPA ', '', NULL, 'COMERCIANTE', '', '', NULL, NULL, 1, 1, '2023-11-08 13:22:10', '2023-11-08 13:22:10'),
(306, 'CARMEN', 'SANCHEZ BENAVENTE', 'DNI', '42301172', 'FEMENINO', '39', '1984-04-05', '945950047', '28 DE JULIO 1236 ENACE ', 'CAYMA ', 'AREQUIPA ', '', NULL, '', '', '', NULL, NULL, 1, 1, '2023-11-08 13:22:10', '2023-11-08 13:22:10'),
(307, 'ALISTAIR', 'SALAS SALAZAR', 'DNI', '44445735', 'MASCULINO', '46', '1977-10-27', '950007045', 'URB. BELLO AMANECER B-8', 'CAYMA ', 'AREQUIPA ', '', NULL, '', '', '', NULL, NULL, 1, 1, '2023-11-08 13:22:10', '2023-11-08 13:22:10'),
(308, 'ALDO JAVIER', 'SOLIS', 'DNI', '20287282', 'MASCULINO', '53', '1969-12-01', '939627319', 'CALLE ICA 307', 'M. MELGAR ', 'AREQUIPA ', '', NULL, '', '', '', NULL, NULL, 1, 1, '2023-11-08 13:22:10', '2023-11-08 13:22:10'),
(309, 'CAMILA', 'SANCHEZ VALENCIA', 'DNI', '72298738', 'FEMENINO', '30', '1993-09-17', '941075663', 'URB. BELLO MONTE A-12', 'CAYMA ', 'AREQUIPA ', '', NULL, '', '', 'SOLTERA', NULL, NULL, 1, 1, '2023-11-08 13:22:10', '2023-11-08 13:22:10'),
(310, 'CESAR', 'SOTELO CARPIO', 'DNI', '29360889', 'MASCULINO', '78', '1944-11-08', '953486374', 'AV. UNION 819-YANAHUARA ', 'CUZCO ', 'AREQUIPA ', '', NULL, '', '', '', NULL, NULL, 1, 1, '2023-11-08 13:22:10', '2023-11-08 13:22:10'),
(311, 'ELSA', 'TALAVERA SANIS', 'DNI', '29515778', 'FEMENINO', '82', '1941-09-02', '999221294', 'GARCILAZO DE LA VEGA 109 DP. 201', 'UMACOLLO', 'AREQUIPA ', '', NULL, '', '', '', NULL, NULL, 1, 1, '2023-11-08 13:22:10', '2023-11-08 13:22:10'),
(312, 'WILBERT', 'TICONA TEJADA', 'DNI', '29297242', 'MASCULINO', '57', '1966-09-13', '997373639', 'BOLOGNESI -CAYMA ', 'TACNA ', 'TACNA ', 'SUPERIOR', NULL, 'SERV. PUBLICO ', '', 'SOLTERO ', NULL, NULL, 1, 1, '2023-11-08 13:22:10', '2023-11-08 13:22:10'),
(313, 'HARLETH', 'TUPA VILLALTA', 'DNI', '74418775', 'FEMENINO', '24', '1998-11-09', '922809953', 'JOSE CARLOS MARIATEGUI 900- B, AIRES', 'CAYMA ', 'AREQUIPA ', 'SUPERIOR', NULL, '', '', '', NULL, NULL, 1, 1, '2023-11-08 13:22:10', '2023-11-08 13:22:10'),
(314, 'ROSA MARIA', 'TERAN VILCAPAZA', 'DNI', '70815558', 'FEMENINO', '23', '2000-03-06', '917378073', 'PAUCARPATA -CIUDAD BLANCA ', 'PAUCARPATA ', 'AREQUIPA ', 'SUPERIOR', NULL, 'ESTUDIANTE', '', '', NULL, NULL, 1, 1, '2023-11-08 13:22:10', '2023-11-08 13:22:10'),
(315, 'NANCY', 'TORREBLANCA', 'DNI', '29298781', 'FEMENINO', '62', '1961-10-29', '987792672', '', 'PAUCARPATA ', 'AREQUIPA ', '', NULL, '', '', '', NULL, NULL, 1, 1, '2023-11-08 13:22:10', '2023-11-08 13:22:10'),
(316, 'KAREN', 'TORRES VALDIVIA', 'DNI', '47048947', 'FEMENINO', '33', '1990-09-28', '956732275', 'COOP. LAMBRAMANY -ED. SANTA ROSA ', 'J. L. B Y R', 'AREQUIPA ', '', NULL, '', '', '', NULL, NULL, 1, 1, '2023-11-08 13:22:10', '2023-11-08 13:22:10'),
(317, 'RUTH', 'TORRES QUISPE', 'DNI', '73212330', 'FEMENINO', '19', '2004-08-14', '975774077', 'VILLA ECOLOGICA ', 'A.S. A', 'AREQUIPA ', '', NULL, '', '', '', NULL, NULL, 1, 1, '2023-11-08 13:22:10', '2023-11-08 13:22:10'),
(318, 'ELENA', 'TORRES VALERIANO', 'DNI', '41024529', 'FEMENINO', '42', '1981-07-28', '952642553', '', '', '', '', NULL, '', '', '', NULL, NULL, 1, 1, '2023-11-08 13:22:10', '2023-11-08 13:22:10'),
(319, 'YECY', 'TAYRO MAMANI', 'DNI', '46557706', 'FEMENINO', '33', '1990-09-10', '951187572', 'AV. OBRERA 1501 ', 'A.S. A', 'AREQUIPA ', '', NULL, '', '', '', NULL, NULL, 1, 1, '2023-11-08 13:22:10', '2023-11-08 13:22:10'),
(320, 'JULIO', 'TURPO SUYCO', 'DNI', '43867316', 'MASCULINO', '35', '0000-00-00', '982534861', '', 'CAYMA ', 'AREQUIPA ', '', NULL, '', '', '', NULL, NULL, 1, 1, '2023-11-08 13:22:10', '2023-11-08 13:22:10'),
(321, 'MARIANA', 'URQUIETA RODRIGUEZ', 'DNI', '70364952', 'FEMENINO', '35', '1988-02-18', '951159697', 'URB, SAN ANTONIO B-3 DPTO 102', 'CAYMA ', 'AREQUIPA ', 'SUPERIOR', NULL, 'MEDICO ', '', 'CASADA', NULL, NULL, 1, 1, '2023-11-08 13:22:10', '2023-11-08 13:22:10'),
(322, 'JAZMIN', 'URACAHUA IRCO', 'DNI', '48184730', 'FEMENINO', '29', '1994-02-13', '923966405', 'URB. LAS ESMERALDAS MZ I LOTE #', 'C. COLORADO ', 'AREQUIPA ', 'SUPERIOR', NULL, 'ARQUITECTA', '', '', NULL, NULL, 1, 1, '2023-11-08 13:22:10', '2023-11-08 13:22:10'),
(323, 'HILDA', 'TALAVERA BUSTINZA', 'DNI', '02393197', 'FEMENINO', '88', '1935-03-07', '949391065', '', '', '', '', NULL, '', '', '', NULL, NULL, 1, 1, '2023-11-08 13:22:10', '2023-11-08 13:22:10'),
(324, 'CLAUDIA', 'VALDIVIA ROBLES', 'DNI', '70288011', 'FEMENINO', '31', '1992-06-26', '', 'URB. IBARCENA D-4 CHALLAPAMPA', 'C. COLORADO ', 'AREQUIPA ', 'SUPERIOR', NULL, 'ABOGADO', '', '', NULL, NULL, 1, 1, '2023-11-08 13:22:10', '2023-11-08 13:22:10'),
(325, 'VALENTINA', 'VILCA GUTIERREZ', 'DNI', '61366501', 'FEMENINO', '15', '2008-04-29', '939084277', 'CALLE LAS DELICIAS 1032 C. COLORADO ', 'C.COLORADO ', 'AREQUIPA ', 'SECUNDARIA ', NULL, 'ESTUDIANTE', '', '', NULL, NULL, 1, 1, '2023-11-08 13:22:10', '2023-11-08 13:22:10'),
(326, 'NESTOR', 'VELASQUEZ CHAVEZ', 'DNI', '26608271', 'MASCULINO', '57', '1966-06-02', '943357807', 'DANTE AGUILLERI 54 UR. LOS PINOS ', 'VALLECITO ', 'AREQUIPA ', 'SUPERIOR', NULL, '', '', '', NULL, NULL, 1, 1, '2023-11-08 13:22:10', '2023-11-08 13:22:10'),
(327, 'HERNAN', 'VALDIVIA GUTIERREZ', 'DNI', '17877893', 'MASCULINO', '78', '1945-02-02', '944227385', 'URB. CAMPO VERDE L12', 'C. COLORADO ', 'AREQUIPA ', '', NULL, '', '', '', NULL, NULL, 1, 1, '2023-11-08 13:22:10', '2023-11-08 13:22:10'),
(328, 'ROCIO', 'VILLA', 'DNI', '06448484', 'FEMENINO', '63', '1960-04-06', '959373299', '', 'S. ALEGRE ', 'AREQUIPA ', 'SUPERIOR', NULL, 'ARTISTA ', '', '', NULL, NULL, 1, 1, '2023-11-08 13:22:10', '2023-11-08 13:22:10'),
(329, 'MARITZA', 'VILLEGAS CACERES', 'DNI', '41799767', 'FEMENINO', '41', '1982-10-17', '963678319', 'PRIEDRA SANTA ', 'YANAHUARA ', 'AREQUIPA ', 'SUPERIOR', NULL, 'SU CASA', '', '', NULL, NULL, 1, 1, '2023-11-08 13:22:10', '2023-11-08 13:22:10'),
(330, 'LUCIANA', 'VILAVILA', 'DNI', '79921415', 'FEMENINO', '07', '2016-10-10', '', 'PASAJE SANTA MARIA DE GUADALUPE ', 'SACHACA ', 'AREQUIPA ', 'PRIMARIA ', NULL, 'ESTUDIANTE ', '', '', NULL, NULL, 1, 1, '2023-11-08 13:22:10', '2023-11-08 13:22:10'),
(331, 'MARIA BELEN', 'VALDIVIA FUENTES', 'DNI', '73103400', 'FEMENINO', '18', '2005-05-28', '991098552', 'VALLE BLANCO RESERVA TORRE 7 9007', 'C. COLORADO ', 'AREQUIPA ', 'SUPERIOR', NULL, 'ESTUDIANTE ', '', '', NULL, NULL, 1, 1, '2023-11-08 13:22:10', '2023-11-08 13:22:10'),
(332, 'LEINA', 'ZUNIGA CARCASI', 'DNI', '44105834', 'FEMENINO', '34', '1989-09-29', '984849000', 'CALLE NUEVA 204', 'CERCADO ', 'AREQUIPA ', 'SUPERIOR', NULL, 'ENFERMERA', '', '', NULL, NULL, 1, 1, '2023-11-08 13:22:10', '2023-11-08 13:22:10'),
(333, 'DIEGO ALONSO', 'ZEGARRA PINO', 'DNI', '70456801', 'MASCULINO', '27', '1996-07-10', '', 'JIRON CUZCO 202 B A. LIBERTAD ', 'C. COLORADO ', 'AREQUIPA ', 'SUPERIOR', NULL, 'ING. SSEGURIDAD', '', '', NULL, NULL, 1, 1, '2023-11-08 13:22:10', '2023-11-08 13:22:10'),
(334, 'ROBIN', 'ZEGARRA TEJADA', 'DNI', '29473969', 'MASCULINO', '55', '1968-10-11', '996668471', 'JIRON CUZCO 202 B A. LIBERTAD ', 'C. COLORADO ', 'AREQUIPA ', 'SUPERIOR', NULL, '', '', '', NULL, NULL, 1, 1, '2023-11-08 13:22:10', '2023-11-08 13:22:10'),
(335, 'ALEXANDER', 'ZEGARRA RODRIGUEZ', 'DNI', '41914331', 'MASCULINO', '40', '1983-05-20', '950716544', 'J. L. BUSTAMANTE Y RIVERO', 'J. L. B Y R', 'AREQUIPA ', 'SUPERIOR', NULL, 'ARQUITECTO ', '', '', NULL, NULL, 1, 1, '2023-11-08 13:22:10', '2023-11-08 13:22:10'),
(336, 'JOSE EDUARDO', 'ZENTENO MONTEAGUDO', 'DNI', '72862193', 'MASCULINO', '23', '1999-12-21', '984391545', 'URB. VICTOR A. BELAUNDE ', 'C. COLORADO ', 'AREQUIPA ', 'SUPERIOR', NULL, 'ING DE SISTEMAS ', '', '', NULL, NULL, 1, 1, '2023-11-08 13:22:10', '2023-11-08 13:22:10'),
(337, 'ZARELA', 'ZEGARRA', 'DNI', '29476703', 'FEMENINO', '64', '1959-01-21', '', 'AV. ARANCOTA 114', 'SACHACA ', 'AREQUIPA ', 'SUPERIOR', NULL, 'SU CASA', '', '', NULL, NULL, 1, 1, '2023-11-08 13:22:10', '2023-11-08 13:22:10'),
(338, 'MARIANGEL ', 'ARELLANO SEIJAS', 'CE', '00533475', 'FEMENINO', '31', '1992-09-01', '901284909', 'URB. TAHUAYCANI D-26 SACHACA', 'AREQUIPA', 'VENEZUELA', 'SUPERIOR', NULL, 'ENFERMERA', '', '', NULL, NULL, 1, 1, '2023-11-08 13:22:10', '2023-11-08 13:22:10'),
(339, 'CRISTO JOSE', 'ARELLANO MORALES', 'CE', '21684368', 'MASCULINO', '18', '2005-02-15', '930603494', 'SELVA ALEGRE  AREQUIPA CDRA 1', 'SELVA ALEGRE ', 'AREQUIPA', 'ESTUDIANTE ', NULL, '', '', '', NULL, NULL, 1, 1, '2023-11-08 13:22:10', '2023-11-08 13:22:10'),
(340, 'STHEWENEN R', 'ROMERO ROMERO ', 'CE', '00037427', 'MASCULINO', '23', '2000-07-08', '933659329', 'C. COLORADO ', 'AREQUIPA', 'AREQUIPA', 'SUPERIOR', NULL, 'COCINERO ', '', '', NULL, NULL, 1, 1, '2023-11-08 13:22:10', '2023-11-08 13:22:10'),
(341, 'YESENIA ', 'ROMERO', 'CE', '00046451', 'FEMENINO', '', '0000-00-00', '', '', '', '', '', NULL, '', '', '', NULL, NULL, 1, 1, '2023-11-08 13:22:10', '2023-11-08 13:22:10'),
(342, 'NOHEMY ', 'RODRIGUEZ MILLAN ', 'CE', '01531234', 'FEMENINO', '30', '1993-09-14', '983093119', 'LA FONDA MZ G - L-4 C. COLORADO ', 'C. COLORADO ', 'AREQUIPA ', 'BACHILLER ', NULL, 'AMA DE CASA', '', '', NULL, NULL, 1, 1, '2023-11-08 13:22:10', '2023-11-08 13:22:10'),
(343, 'ENWIS', 'CHIRINOS PORTILLO', 'CE', '02359152', 'MASCULINO', '29', '1994-05-31', '988768150', 'MIRAFLORES', 'MIRAFLORES ', 'AREQUIPA ', 'SUPER. VENTAS ', NULL, '', '', '', NULL, NULL, 1, 1, '2023-11-08 13:22:10', '2023-11-08 13:22:10'),
(344, 'GUSTAVO ', 'GONZALES ', 'CE', '02719867', 'MASCULINO', '45', '1978-07-12', '923977612', 'SIN DATOS ', '', '', '', NULL, '', '', 'CASADO', NULL, NULL, 1, 1, '2023-11-08 13:22:10', '2023-11-08 13:22:10'),
(345, 'MARIA ', 'PORTILLO TAPIA ', 'CE', '05456781', 'FEMENINO', '64', '1959-09-14', '936179771', 'C. C. LAS BUGAMBILLAS R-16', 'C. COLORADO ', 'AREQUIPA', 'SUPERIOR', NULL, '', '', '', NULL, NULL, 1, 1, '2023-11-08 13:22:10', '2023-11-08 13:22:10'),
(346, 'DAGNETT', 'LEON NARANJO ', 'CE', '02320608', 'FEMENINO', '28', '1995-05-14', '937622081', 'EL SOLAR DE LA ALAMEDA TORRE A', 'MIRAFLORES', 'AREQUIPA ', '', NULL, 'SUPERVISOR VEWNTAS ', '', '', NULL, NULL, 1, 1, '2023-11-08 13:22:10', '2023-11-08 13:22:10'),
(347, 'KAREN ', 'SAGARAY ', 'CE', '02956954', 'FEMENINO', '32', '1991-02-06', '960739576', '', 'YANAHUARA ', 'AREQUIPA ', '', NULL, '', '', '', NULL, NULL, 1, 1, '2023-11-08 13:22:10', '2023-11-08 13:22:10'),
(348, 'MARIA ', 'ALA', 'DNI', '', 'FEMENINO', '43', '1980-08-23', '961722132', '', 'AREQUIPA', 'AREQUIPA', '', NULL, '', '', '', NULL, NULL, 1, 1, '2023-11-08 13:22:10', '2023-11-08 13:22:10'),
(349, 'PAVEL ', 'ARANIBAR', 'DNI', '', 'MASCULINO', '', '0000-00-00', '993419119', '', 'AREQUIPA', 'AREQUIPA', 'SUPERIOR', NULL, 'ABOGADO', '', '', NULL, NULL, 1, 1, '2023-11-08 13:22:10', '2023-11-08 13:22:10'),
(350, 'MARIA FERNANDA ', 'ARENAS  ORDOÑEZ', 'DNI', '', 'FEMENINO', '30', '1993-07-19', '969283012', 'UR. LAS TORRES DE LA ALAMEDA BLOCK 4 B DP. 504', 'MIRAFLORES', 'AREQUIPA', 'SUPERIOR', NULL, 'DOCENTE', '', '', NULL, NULL, 1, 1, '2023-11-08 13:22:10', '2023-11-08 13:22:10'),
(351, 'PAMELA', 'ARENAS ORDOÑEZ', 'DNI', '', 'FEMENINO', '28', '1995-10-02', '914506123', 'UR. LAS TORRES DE LA ALAMEDA BLOCK 4 B DP. 504', 'AREQUIPA', 'AREQUIPA', 'SUPERIOR', NULL, 'CHEF', '', '', NULL, NULL, 1, 1, '2023-11-08 13:22:10', '2023-11-08 13:22:10'),
(352, 'ERNER ', 'ASTO', 'DNI', '', 'MASCULINO', '51', '1972-08-24', '976394853', 'PASAJE PORVENIR MZ P BELLPAMPA', 'SOCABAYA', 'AREQUIPA', 'SUPERIOR', NULL, '', '', '', NULL, NULL, 1, 1, '2023-11-08 13:22:10', '2023-11-08 13:22:10'),
(353, 'ERIKA', 'ABARCA APFATA', 'DNI', '', 'FEMENINO', '29', '1993-12-17', '932276968', 'H.H.PUEBLO LIBRE MZ.F LT & M. MELGAR ', 'M. MELGAR', 'AREQUIPA', 'SUPERIOR', NULL, '', '', '', NULL, NULL, 1, 1, '2023-11-08 13:22:10', '2023-11-08 13:22:10'),
(354, 'PEDRO ', 'ALVAREZ', 'DNI', '', 'MASCULINO', '46', '1977-05-19', '974393901', 'CALLE AVIACIÓN G-3 FCO BOLOGNESI ', 'CAYMA', 'AREQUIPA', 'SUPERIOR', NULL, '', '', '', NULL, NULL, 1, 1, '2023-11-08 13:22:10', '2023-11-08 13:22:10'),
(355, 'SOLANGE', 'BENAVENTE  SILVA', 'DNI', '', 'FEMENINO', '', '0000-00-00', '997726375', 'VILLA MIRADOR B-41 CAYMA ', 'CAYMA', 'AREQUIPA', 'SUPERIOR', NULL, 'ABOGADO', '', '', NULL, NULL, 1, 1, '2023-11-08 13:22:10', '2023-11-08 13:22:10'),
(356, 'PRICILA ', 'BACA', 'DNI', '', 'FEMENINO', '31', '1992-07-05', '943799081', '', '', '', '', NULL, '', '', '', NULL, NULL, 1, 1, '2023-11-08 13:22:10', '2023-11-08 13:22:10'),
(357, 'CAMILSA ', 'BEDREGAL RODRIGUEZ', 'DNI', '', 'FEMENINO', '28', '1995-02-09', '950380281', '', '', '', '', NULL, '', '', '', NULL, NULL, 1, 1, '2023-11-08 13:22:10', '2023-11-08 13:22:10'),
(358, 'ANDREA ', 'BALLON LANDA ', 'DNI', '', 'FEMENINO', '32', '0000-00-00', '', '', '', '', '', NULL, '', '', '', NULL, NULL, 1, 1, '2023-11-08 13:22:10', '2023-11-08 13:22:10'),
(359, 'ANGELA ', 'BARREDA', 'DNI', '', 'FEMENINO', '49', '1974-07-18', '', '', '', '', '', NULL, '', '', '', NULL, NULL, 1, 1, '2023-11-08 13:22:10', '2023-11-08 13:22:10'),
(360, 'JOSE DAVID', 'QUISPE CALLOAPAZA', 'DNI', '', 'MASCULINO', '8', '0000-00-00', '926408192', '', 'AREQUIPA', 'AREQUIPA', 'ESTUDIANTE ', NULL, '', '', '', NULL, NULL, 1, 1, '2023-11-08 13:22:10', '2023-11-08 13:22:10'),
(361, 'ANGELO ', 'QUIROZ', 'DNI', '', 'MASCULINO', '35', '1988-07-18', '953769005', 'URB. SQAN RAFAEL C-2', 'CAYMA ', 'AREQUIPA', '', NULL, '', '', '', NULL, NULL, 1, 1, '2023-11-08 13:22:10', '2023-11-08 13:22:10'),
(362, 'PATRICIA ', 'RAMOS MEDINA', 'DNI', '', 'FEMENINO', '42', '1981-04-26', '945186319', 'VILLA VERDE 1 TOTRRE 5 DEP 301', 'C. COLORADO ', 'AREQUIPA ', '', NULL, '', '', '', NULL, NULL, 1, 1, '2023-11-08 13:22:10', '2023-11-08 13:22:10'),
(363, 'JOSE DAVID', 'RIVERA DELGADO ', 'DNI', '', 'MASCULINO', '66', '1957-09-18', '959608901', '', '', '', '', NULL, '', '', '', NULL, NULL, 1, 1, '2023-11-08 13:22:10', '2023-11-08 13:22:10'),
(364, 'MATEO ', 'CHIRINOS ALOSILLA', 'DNI', '', 'MASCULINO', '14', '0000-00-00', '954955043', 'LOS OLIVOS ', 'CAYMA ', 'AREQUIPA ', 'ESTUDIANTE ', NULL, '', '', 'SOLTERO ', NULL, NULL, 1, 1, '2023-11-08 13:22:10', '2023-11-08 13:22:10'),
(365, 'CONCEVIDA ', 'CAMARGO  GARIBAY ', 'DNI', '', 'FEMENINO', '68', '1954-12-08', '989302297', 'RESIDENCIAL CAMPO VERDE L-16 MZ D SACHACA ', 'SACHACA', 'AREQUIPA ', '', NULL, '', '', 'SOLTERA', NULL, NULL, 1, 1, '2023-11-08 13:22:10', '2023-11-08 13:22:10'),
(366, 'DIANA ', 'CHAVEZ', 'DNI', '', 'FEMENINO', '34', '1988-12-28', '981481659', 'CALLE PACHITEA  101', 'C. COLORADO ', 'AREQUIPA ', 'SUPERIOR', NULL, '', '', 'CASADA', NULL, NULL, 1, 1, '2023-11-08 13:22:10', '2023-11-08 13:22:10'),
(367, 'SEGUNDINA', 'CHALLA', 'DNI', '', 'FEMENINO', '37', '1986-06-01', '974410774', '', '', '', '', NULL, '', '', '', NULL, NULL, 1, 1, '2023-11-08 13:22:10', '2023-11-08 13:22:10'),
(368, 'MAXIMILIANO ', 'COAQUIRA ', 'DNI', '', 'MASCULINO', '86', '1937-02-22', '959681112', 'CALLE CORDOVSA  CERRO VIEJO ', 'C. COLORADO ', 'AREQUIPA ', 'SUPERIOR', NULL, 'INGENIERO ', '', '', NULL, NULL, 1, 1, '2023-11-08 13:22:10', '2023-11-08 13:22:10'),
(369, 'DIANA ', 'CANDIA PEÑALVA ', 'DNI', '', 'FEMENINO', '31', '1992-01-09', '991294646', 'CALLE 9 DE OCTUBRE 203', 'PAUCARPATA ', 'AREQUIPA ', '', NULL, '', '', '', NULL, NULL, 1, 1, '2023-11-08 13:22:10', '2023-11-08 13:22:10'),
(370, 'LUCIA ', 'CARPIO ZAVALETA ', 'DNI', '', 'FEMENINO', '74', '1949-03-02', '953271538', '', '', 'AREQUIPA ', '', NULL, '', '', '', NULL, NULL, 1, 1, '2023-11-08 13:22:10', '2023-11-08 13:22:10'),
(371, 'GABRIELA ', 'CHOQUEHUANCA', 'DNI', '', 'FEMENINO', '27', '0000-00-00', '969966952', '', 'AREQUIPA ', 'AREQUIPA ', '', NULL, '', '', '', NULL, NULL, 1, 1, '2023-11-08 13:22:10', '2023-11-08 13:22:10'),
(372, 'JAVIER JESUS ', 'CARRION HERRERA', 'DNI', '', 'MASCULINO', '43', '1980-04-03', '939641201', 'CARLOS BACAFLOR F-4', 'UMACOLLO ', 'AREQUIPA ', 'SUPERIOR', NULL, 'BARMAN ', '', 'SOLTERO ', NULL, NULL, 1, 1, '2023-11-08 13:22:10', '2023-11-08 13:22:10'),
(373, 'KASANDRA MEYLY', 'DIAZ HUAYCHO ', 'DNI', '', 'FEMENINO', '21', '2002-03-08', '924309005', '', 'AREQUIPA ', 'AREQUIPA ', 'ESTUDIANTE ', NULL, '', '', '', NULL, NULL, 1, 1, '2023-11-08 13:22:10', '2023-11-08 13:22:10'),
(374, 'WILLIAM ', 'DELGADO PIZARRO ', 'DNI', '', 'MASCULINO', '14', '2009-01-07', '999807972', 'VILLA CONTINENTAL PZ P-17 ', 'CAYMA ', 'CHILE ', 'ESTUDIANTE ', NULL, '', '', '', NULL, NULL, 1, 1, '2023-11-08 13:22:10', '2023-11-08 13:22:10'),
(375, 'DAYLIN ', 'DELGADO PIZARRO ', 'DNI', '', 'FEMENINO', '5', '0000-00-00', '999807972', '', '', '', '', NULL, '', '', '', NULL, NULL, 1, 1, '2023-11-08 13:22:10', '2023-11-08 13:22:10'),
(376, 'CLAUDIA GIULIANA', 'ESPINAL SILVANO ', 'DNI', '', 'FEMENINO', '32', '1991-06-20', '959599856', '', '', 'ICA', '', NULL, '', '', '', NULL, NULL, 1, 1, '2023-11-08 13:22:10', '2023-11-08 13:22:10'),
(377, 'LOGAN ', 'FERNANDEZ HUALLPA ', 'DNI', '', 'MASCULINO', '07', '2015-12-21', '935779918', 'URB. LAS BUGAMBILLAS -PACHACUTE ', 'C. COLORADO ', 'AREQUIPA ', '', NULL, 'ESTUDIANTE ', '', '', NULL, NULL, 1, 1, '2023-11-08 13:22:10', '2023-11-08 13:22:10'),
(378, 'ALEXANDRA ', 'FLORES CORRALES ', 'DNI', '', 'FEMENINO', '33', '1990-08-19', '980754382', 'AV. INDUSTRIAL 804 APIMA ', 'APIMA ', 'AREQUIPA ', '', NULL, 'CAJERA ', '', '', NULL, NULL, 1, 1, '2023-11-08 13:22:10', '2023-11-08 13:22:10'),
(379, 'MARIA EDUARDA ', 'FERNAN ZEGARRA ', 'DNI', '', 'FEMENINO', '24', '1999-07-11', '917420503', 'URB QUINTA GAMERO B-16', 'CAYMA ', 'AREQUIPA ', 'SUPERIOR', NULL, 'ESTUDIANTE ', '', '', NULL, NULL, 1, 1, '2023-11-08 13:22:10', '2023-11-08 13:22:10'),
(380, 'FELIPA', 'CHURA ', 'DNI', '', 'FEMENINO', '59', '1964-04-10', '921542802', 'AV. CRISTOBAL COLON L-9 ZON C S.R PACHACUTEC', 'C. COLORADO ', 'AREQUIPA ', 'SUPERIOR ', NULL, '', '', '', NULL, NULL, 1, 1, '2023-11-08 13:22:10', '2023-11-08 13:22:10'),
(381, 'MARCELA ', 'BENAVIDES ', 'DNI', '', 'FEMENINO', '58', '1965-03-29', '54255892', 'CERRO COLORADO ', 'C. COLORADO ', 'AREQUIPA ', 'SUPERIOR', NULL, '', '', '', NULL, NULL, 1, 1, '2023-11-08 13:22:10', '2023-11-08 13:22:10'),
(382, 'MARCO ANTONIO ', 'MEDINA BARRIOS ', 'DNI', '', 'FEMENINO', '52', '1971-08-04', '945057151', 'URB. MONTERREY B-30 J.L:Y RIVERO', 'AREQUIPA ', 'AREQUIPA ', 'SUPERIOR', NULL, '', '', '', NULL, NULL, 1, 1, '2023-11-08 13:22:10', '2023-11-08 13:22:10'),
(383, 'MONICA ', 'PACHECO CHIRINOS ', 'DNI', '', 'FEMENINO', '60', '1963-04-26', '966436466', 'PLAZA LA TOMILLA 204- CAYMA ', 'CAYMA ', 'AREQUIPA', 'SUPERIOR', NULL, 'SU CASA ', '', 'CASADA ', NULL, NULL, 1, 1, '2023-11-08 13:22:10', '2023-11-08 13:22:10'),
(384, 'ROBERTO ', 'GUTIERREZ ', 'DNI', '', 'MASCULINO', '9', '0000-00-00', '945186319', 'SIN DIRECCION ', 'AREQUIPA ', 'AREQUIPA ', 'ESTUDIANTE ', NULL, '', '', '', NULL, NULL, 1, 1, '2023-11-08 13:22:10', '2023-11-08 13:22:10'),
(385, 'VALERIA ', 'GUTIERREZ RAMOS ', 'DNI', '', 'FEMENINO', '07', '2016-10-12', '945186319', 'SIN DATOS ', '', '', 'ESTUDIANTE ', NULL, '', '', '', NULL, NULL, 1, 1, '2023-11-08 13:22:10', '2023-11-08 13:22:10'),
(386, 'GONZALO ', 'GARNICA CUBA ', 'DNI', '', 'MASCULINO', '57', '1966-05-04', '958085659', 'RONDA SAN LAZARO ', 'CERCADO ', 'AREQUIPA ', 'MEDICO ', NULL, '', '', '', NULL, NULL, 1, 1, '2023-11-08 13:22:10', '2023-11-08 13:22:10'),
(387, 'FABIAN ', 'GARCIA LAJO ', 'DNI', '', 'MASCULINO', '12', '2011-06-07', '929095452', 'SIN DATOS ', 'AREQUIPA ', 'AREQUIPA ', 'ESTUDIANTE ', NULL, '', '', '', NULL, NULL, 1, 1, '2023-11-08 13:22:10', '2023-11-08 13:22:10'),
(388, 'LUCIA ', 'GALDOS ', 'DNI', '', 'FEMENINO', '36', '1987-08-15', '958610627', 'COOP-COLEGIO DE  INGENIEROS', 'C. COLORADO ', 'AREQUIPA ', 'SUPERIOR', NULL, 'ADMINISTRADORA', '', '', NULL, NULL, 1, 1, '2023-11-08 13:22:10', '2023-11-08 13:22:10'),
(389, 'JAVIER', 'GALDOS ', 'DNI', '', 'MASCULINO', '32', '1991-04-26', '965353349', 'COOP COLEGIO DE INGENIEROS ', 'C. COLORADO ', 'AREQUIPA ', 'SUPERIOR ', NULL, 'ABOGADO ', '', '', NULL, NULL, 1, 1, '2023-11-08 13:22:10', '2023-11-08 13:22:10'),
(390, 'GINO ', 'GARCIA ', 'DNI', '', 'MASCULINO', '14', '0000-00-00', '991412278', 'SIN DATOS', '', '', '', NULL, '', '', '', NULL, NULL, 1, 1, '2023-11-08 13:22:10', '2023-11-08 13:22:10'),
(391, 'JUAN ', 'LOPEZ BUTRON ', 'DNI', '', 'MASCULINO', '66', '1957-05-27', '981008649', 'AV. MIGUEL GRAU 704', 'PAUCARPATA ', 'MOLLENDO', '', NULL, '', '', '', NULL, NULL, 1, 1, '2023-11-08 13:22:10', '2023-11-08 13:22:10'),
(392, 'ROSMELL ', 'LUNA MARQUEZ', 'DNI', '', 'MASCULINO', '21', '0000-00-00', '922316058', 'JOSE MARIA ARGUEDAS MZ A-15', 'CUZCO ', '', '', NULL, '', '', '', NULL, NULL, 1, 1, '2023-11-08 13:22:10', '2023-11-08 13:22:10'),
(393, 'VALERIA ', 'LOPEZ TORRES ', 'DNI', '', 'FEMENINO', '12', '2011-09-07', '987132514', 'AV. MIGUEL GRRAU 704', 'PAUCARPATA ', 'AREQUIPA', '', NULL, 'ESTUDIANTE', '', '', NULL, NULL, 1, 1, '2023-11-08 13:22:10', '2023-11-08 13:22:10'),
(394, 'DIANA ', 'NEYRA PALOMINO ', 'DNI', '', 'FEMENINO', '03', '2019-11-12', '', 'GENERAL VARELA 880', 'CAYMA ', 'AREQUIPA ', 'ESTUDIENTE ', NULL, '', '', '', NULL, NULL, 1, 1, '2023-11-08 13:22:10', '2023-11-08 13:22:10'),
(395, 'KALESSI ', 'NIÑO DE GUZMAN ', 'DNI', '', 'FEMENINO', '04', '2019-02-26', '923458654', '', 'C. COLORADO ', 'AREQUIPA ', 'ESTUDIANTE', NULL, '', '', '', NULL, NULL, 1, 1, '2023-11-08 13:22:10', '2023-11-08 13:22:10'),
(396, 'SOFIA ', 'NUÑEZ DEL VILLAR ', 'DNI', '', 'FEMENINO', '38', '0000-00-00', '988327524', 'URB. QUINTA TRISTAN N-27', 'JL.B. R', 'AREQUIPA ', '', NULL, '', '', '', NULL, NULL, 1, 1, '2023-11-08 13:22:10', '2023-11-08 13:22:10'),
(397, 'JUAN JOSE ', 'NUÑEZ DEL VILLAR ', 'DNI', '', 'MASCULINO', '32', '1991-11-03', '958327524', 'UR. CERRO COLORADO V2', 'C.COLORADO ', 'LIMA', 'SUPERIOR', NULL, '', '', 'SOLTERO ', NULL, NULL, 1, 1, '2023-11-08 13:22:10', '2023-11-08 13:22:10'),
(398, 'JUAN DIEGO ', 'NIÑO DE GUZMAN  AROTAYPE ', 'DNI', '', 'MASCULINO', '14', '2009-06-28', '923458654', 'YAVARI 202- ZAMACOLA', 'C. COLORADO ', '', '', NULL, '', '', '', NULL, NULL, 1, 1, '2023-11-08 13:22:10', '2023-11-08 13:22:10'),
(399, 'ARTURO ', 'NUÑEZ LIRA', 'DNI', '', 'MASCULINO', '33', '1990-06-15', '993530187', 'COOP. INGENIEROS H-7', 'CAYMA ', '', '', NULL, '', '', '', NULL, NULL, 1, 1, '2023-11-08 13:22:10', '2023-11-08 13:22:10'),
(400, 'KATY ', 'MARTINEZ CASTILLO', 'DNI', '', 'FEMENINO', '34', '1989-09-15', '956730765', '', '', 'AREQUIPA', 'SUPERIOR', NULL, '', '', '', NULL, NULL, 1, 1, '2023-11-08 13:22:10', '2023-11-08 13:22:10'),
(401, 'CLAUDIA ', 'MERCADO ', 'DNI', '', 'FEMENINO', '33', '1990-10-02', '959752537', 'CALLE ZAMACOLA 426', 'YANAHUARA ', 'AREQUIPA', 'SUPERIOR', NULL, '', '', '', NULL, NULL, 1, 1, '2023-11-08 13:22:10', '2023-11-08 13:22:10'),
(402, 'LADY ', 'OJEDA', 'DNI', '', 'FEMENINO', '33', '1990-10-24', '953993294', 'CALLE BOLOGNESI 105 MIRAFLORES ', 'LIMA', 'AREQUIPA', 'SUPERIOR', NULL, '', '', 'SOLTERA', NULL, NULL, 1, 1, '2023-11-08 13:22:10', '2023-11-08 13:22:10'),
(403, 'MARCO ANTONIO ', 'OBANDO  LOAYZA', 'DNI', '', 'MASCULINO', '23', '2000-02-14', '983319326', 'CALLE ARICA 119', 'TIABAYA ', 'AREQUIPA', 'SUPERIOR', NULL, 'ESTUDIANTE ', '', '', NULL, NULL, 1, 1, '2023-11-08 13:22:10', '2023-11-08 13:22:10'),
(404, 'KEYSI ', 'PALACIOS LINO ', 'DNI', '', 'FEMENINO', '30', '1993-07-25', '987177473', 'PASAJE MANSILLA 103 URB. SEÑORIAL ', 'CAYMA ', 'AREQUIPA', '', NULL, '', '', '', NULL, NULL, 1, 1, '2023-11-08 13:22:10', '2023-11-08 13:22:10'),
(405, 'NINFA', 'HINCHO VELASQEZ ', 'DNI', '', 'FEMENINO', '35', '1987-12-09', '959733688', '', '', '', '', NULL, '', '', '', NULL, NULL, 1, 1, '2023-11-08 13:22:10', '2023-11-08 13:22:10'),
(406, 'DALESKA ', 'HUALLPA', 'DNI', '', 'FEMENINO', '28', '1995-06-14', '917378772', '', '', '', '', NULL, 'ESTUDIANTE ', '', '', NULL, NULL, 1, 1, '2023-11-08 13:22:10', '2023-11-08 13:22:10'),
(407, 'IVONE ', 'HURTADO GUTIERREZ', 'DNI', '', 'FEMENINO', '47', '1976-08-08', '902559003', 'III ETAPA MZ. N LOTE 7 ', '', 'AREQUIPA ', 'SUPERIOR', NULL, '', '', '', NULL, NULL, 1, 1, '2023-11-08 13:22:10', '2023-11-08 13:22:10'),
(408, 'SANTIAGO ', 'HUACHACA  AYME ', 'DNI', '', 'MASCULINO', '66', '1957-07-25', '916780753', 'CALLE MONSERRAT L-9 MZ 12 ', '', 'AREQUIPA ', 'SUPERIOR', NULL, '', '', 'CASADO', NULL, NULL, 1, 1, '2023-11-08 13:22:10', '2023-11-08 13:22:10'),
(409, 'THIAGO', 'HUARACHA SAAVEDRA ', 'DNI', '', 'MASCULINO', '06', '2016-12-29', '986112417', '', '', '', 'ESTUDIANTE ', NULL, 'ESTUDIANTE ', '', '', NULL, NULL, 1, 1, '2023-11-08 13:22:10', '2023-11-08 13:22:10'),
(410, 'DIANA ISABELA', 'HUAMANI QUICAÑO', 'DNI', '', 'FEMENINO', '06', '2017-03-17', '', '', '', '', '', NULL, '', '', '', NULL, NULL, 1, 1, '2023-11-08 13:22:10', '2023-11-08 13:22:10'),
(411, 'LEYDY', 'OJEDA', 'DNI', '', 'FEMENINO', '33', '1990-10-24', '953993294', '', '', '', 'SUPERIOR', NULL, '', '', '', NULL, NULL, 1, 1, '2023-11-08 13:22:10', '2023-11-08 13:22:10'),
(412, 'ALMENDRA ', 'GAMARRA', 'DNI', '', 'FEMENINO', '', '0000-00-00', '', '', '', '', '', NULL, '', '', '', NULL, NULL, 1, 1, '2023-11-08 13:22:10', '2023-11-08 13:22:10'),
(413, 'JOSHUA ', 'GUTIERREZ MAMANI ', 'DNI', '', 'MASCULINO', '06', '2017-09-22', '994968491', 'H-H LAS LOMAS MZ32 L-4 ', '', '', '', NULL, '', '', '', NULL, NULL, 1, 1, '2023-11-08 13:22:10', '2023-11-08 13:22:10'),
(414, 'ADRIAN ', 'GUTIERREZ', 'DNI', '', 'MASCULINO', '11', '2012-02-03', '951187572', '', '', '', '', NULL, 'ESTUDIANTE ', '', '', NULL, NULL, 1, 1, '2023-11-08 13:22:10', '2023-11-08 13:22:10'),
(415, 'KEYLYN ', 'HEREDIA ', 'DNI', '', 'FEMENINO', '31', '1991-12-29', '900364375', '', 'PAUCARPATA', 'AREQUIPA ', '', NULL, '', '', '', NULL, NULL, 1, 1, '2023-11-08 13:22:10', '2023-11-08 13:22:10'),
(416, 'DENIS ', 'HUAMANI ', 'DNI', '', 'MASCULINO', '16', '2007-10-04', '956129600', '', '', '', '', NULL, 'ESTUDIANTE ', '', '', NULL, NULL, 1, 1, '2023-11-08 13:22:10', '2023-11-08 13:22:10'),
(417, 'ELVIS ', 'JARA PEREZ', 'DNI', '', 'MASCULINO', '35', '1988-07-15', '991872127', '', '', '', '', NULL, '', '', '', NULL, NULL, 1, 1, '2023-11-08 13:22:10', '2023-11-08 13:22:10'),
(418, 'BRIANA ', 'JARA ALVIZ', 'DNI', '', 'FEMENINO', '06', '2016-12-12', '', '', '', '', '', NULL, '', '', '', NULL, NULL, 1, 1, '2023-11-08 13:22:10', '2023-11-08 13:22:10'),
(419, 'LUCIA KRISTEL ', 'JAEN ', 'DNI', '', 'FEMENINO', '13', '2010-02-25', '920568932', 'URB. LAS DALIAS ', 'ALTO SELVA ALEGRE ', 'AREQUIPA ', '', NULL, 'ESTUDIANTE', '', '', NULL, NULL, 1, 1, '2023-11-08 13:22:10', '2023-11-08 13:22:10'),
(420, 'ALEXANDRA', 'LONDRES ZUÑIGA', 'DNI', '', 'FEMENINO', '31', '1992-05-21', '966376145', 'LOS GLADIOLOS 210', 'YANAHUARA ', 'AREQUIPA ', 'SUPERIOR', NULL, 'PSICOLOGA', '', '', NULL, NULL, 1, 1, '2023-11-08 13:22:10', '2023-11-08 13:22:10');
INSERT INTO `tba_paciente` (`IdPaciente`, `NombrePaciente`, `ApellidoPaciente`, `TipoIdentificacion`, `NumeroIdentificacion`, `SexoPaciente`, `EdadPaciente`, `FechaNacimiento`, `CelularPaciente`, `DomicilioPaciente`, `LugarProcedencia`, `LugarNacimiento`, `GradoInstruccion`, `RazaPaciente`, `OcupacionPaciente`, `ReligionPaciente`, `EstadoCivil`, `NumeroContactoPaciente`, `NombreContactoPaciente`, `UsuarioCreado`, `UsuarioActualiza`, `FechaCreacion`, `FechaActualizacion`) VALUES
(421, 'JESSICA ', 'LAZO MANACERO ', 'DNI', '', 'FEMENINO', '48', '1975-07-06', '957604006', 'AV. TRINIDAD MORAN ', 'CAYMA ', 'AREQUIPA ', 'SUPERIOR', NULL, 'AMA DE CASA', '', '', NULL, NULL, 1, 1, '2023-11-08 13:22:10', '2023-11-08 13:22:10'),
(422, 'MARIA ', 'LARICO ', 'DNI', '', 'FEMENINO', '64', '1959-10-23', '983148297', 'SANTA CLARA 308 ', 'PAUCARPATA ', 'AREQUIPA ', 'SUPERIOR', NULL, '', '', '', NULL, NULL, 1, 1, '2023-11-08 13:22:10', '2023-11-08 13:22:10'),
(423, 'JAVIER', 'SOLIS ', 'DNI', '', 'MASCULINO', '48', '1975-02-06', '959310361', 'PASAJE COLOMBIA 104', 'M. MELGAR ', 'AREQUIPA ', '', NULL, '', '', 'CASADO ', NULL, NULL, 1, 1, '2023-11-08 13:22:10', '2023-11-08 13:22:10'),
(424, 'MARILUZ DEL CARMEN ', 'SANCHEZ', 'DNI', '', 'FEMENINO', '62', '1961-03-04', '', 'LAS BUGAMBILLAS H*11', 'C. COLORADO ', 'AREQUIPA ', '', NULL, '', '', '', NULL, NULL, 1, 1, '2023-11-08 13:22:10', '2023-11-08 13:22:10'),
(425, 'VERA LUCIA ', 'VILCHEZ', 'DNI', '', 'FEMENINO', '33', '1990-01-15', '958979086', 'QUINTA RESIDENCIAL CAYMA A-3', 'CAYMA ', 'AREQUIPA ', 'SUPERIOR', NULL, 'REMAX', '', '', NULL, NULL, 1, 1, '2023-11-08 13:22:10', '2023-11-08 13:22:10'),
(426, 'FRANK ', 'VALENZUELA ', 'DNI', '', 'MASCULINO', '38', '1985-07-13', '974209500', 'PASAJE COLON 102', 'YANAHUARA ', 'AREQUIPA ', 'SUPERIOR', NULL, '', '', '', NULL, NULL, 1, 1, '2023-11-08 13:22:10', '2023-11-08 13:22:10'),
(427, 'Meredith ', 'Gallegos Pacheco', 'DNI', '44423849', 'Femenino', '35', '1986-11-20', '987637956', 'Pasaje La Tomilla 204', 'Cayma', 'Arequipa', 'Superior', '', 'PNP', 'catolica', 'Soltera', '987637956', '', 1, NULL, '2023-11-09 16:07:15', '2023-11-09 16:11:42'),
(428, 'Maria Guadalupe', 'Salazar Ortiz', 'DNI', '40556921', 'Femenino', '43', '1980-05-22', '959824299', 'Calle Misti 418 Dpto 1-B', 'Arequipa', 'Arequipa', 'Superior', '', 'Medico', 'catolica', 'casada', '', '', 1, NULL, '2023-11-21 16:57:43', '2023-11-21 17:09:04'),
(429, 'Ruth Veronica  ', 'Fuentes Pacco', 'DNI', '29699458', NULL, NULL, NULL, '970885756', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, '2024-01-30 11:57:44', '2024-01-30 11:57:44'),
(430, 'Jaime Eduardo', 'Gutierrez del Carpio', 'DNI', '29270941', NULL, NULL, NULL, '932291014', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, '2024-01-30 11:59:10', '2024-01-30 11:59:10'),
(431, 'JENNY ', 'CARBAJAL', 'DNI', '29635040', NULL, NULL, NULL, '945623488', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, '2024-09-17 09:07:21', '2024-09-17 09:07:21'),
(432, 'Maria Guadalupe ', 'Salazar Ortiz', 'DNI', '20230250', NULL, NULL, NULL, '95300277', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, '2024-09-17 09:22:28', '2024-09-17 09:22:28'),
(433, 'Genesis Lucero', 'Peña Garcia', 'DNI', '76260288', NULL, NULL, NULL, '992356179', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, '2024-09-17 09:25:54', '2024-09-17 09:25:54'),
(434, 'JUAN BLADIMIR', 'ALCANTARA FERNANDEZ', 'DNI', '46857017', NULL, NULL, NULL, '918300277', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, '2024-09-17 09:30:30', '2024-09-17 09:30:30');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tba_pago`
--

CREATE TABLE `tba_pago` (
  `IdPago` int(11) NOT NULL,
  `IdPaciente` int(11) NOT NULL,
  `IdTipoPago` int(11) NOT NULL,
  `TotalPago` decimal(10,2) NOT NULL,
  `FechaPago` date NOT NULL,
  `ObservacionPago` varchar(200) DEFAULT NULL,
  `ComprobantePago` varchar(255) DEFAULT NULL,
  `FechaCreacion` datetime NOT NULL,
  `FechaActualizacion` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish_ci ROW_FORMAT=DYNAMIC;

--
-- Volcado de datos para la tabla `tba_pago`
--

INSERT INTO `tba_pago` (`IdPago`, `IdPaciente`, `IdTipoPago`, `TotalPago`, `FechaPago`, `ObservacionPago`, `ComprobantePago`, `FechaCreacion`, `FechaActualizacion`) VALUES
(1, 1, 4, 150.00, '2024-09-04', '', NULL, '2023-11-09 16:00:09', '2024-09-17 09:40:30'),
(2, 428, 1, 50.00, '2024-09-13', 'retiro de Brackets', NULL, '2023-11-21 17:41:23', '2024-09-17 09:41:20'),
(3, 107, 1, 250.00, '2024-08-23', '', NULL, '2024-09-17 07:08:41', '2024-09-17 07:08:41');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tba_perfilusuario`
--

CREATE TABLE `tba_perfilusuario` (
  `IdPerfilUsuario` int(11) NOT NULL,
  `NombrePerfil` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish_ci ROW_FORMAT=DYNAMIC;

--
-- Volcado de datos para la tabla `tba_perfilusuario`
--

INSERT INTO `tba_perfilusuario` (`IdPerfilUsuario`, `NombrePerfil`) VALUES
(1, 'Administrador'),
(2, 'Recepcionista'),
(3, 'Medico');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tba_procedimiento`
--

CREATE TABLE `tba_procedimiento` (
  `IdProcedimiento` int(11) NOT NULL,
  `NombreProcedimiento` varchar(150) NOT NULL,
  `PrecioPromedio` decimal(10,2) NOT NULL,
  `IdTipoProcedimiento` int(11) NOT NULL,
  `FechaCreacion` datetime NOT NULL,
  `FechaActualizacion` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish_ci ROW_FORMAT=DYNAMIC;

--
-- Volcado de datos para la tabla `tba_procedimiento`
--

INSERT INTO `tba_procedimiento` (`IdProcedimiento`, `NombreProcedimiento`, `PrecioPromedio`, `IdTipoProcedimiento`, `FechaCreacion`, `FechaActualizacion`) VALUES
(1, 'CONSULTA Y EVALUACIÓN ', 0.00, 1, '2023-11-09 12:53:17', '2023-11-09 12:53:17'),
(2, 'EXTRACCION SIMPLE', 0.00, 1, '2023-11-09 12:53:17', '2023-11-09 12:53:17'),
(3, 'EXTRACCIÓN COMPLEJA', 0.00, 1, '2023-11-09 12:53:17', '2023-11-09 12:53:17'),
(4, 'RESTAURACIONES SIMPLES ', 0.00, 1, '2023-11-09 12:53:17', '2023-11-09 12:53:17'),
(5, 'RESTAURACIONES COMPLEJAS', 0.00, 1, '2023-11-09 12:53:17', '2023-11-09 12:53:17'),
(6, 'AJUSTE OCLUSAL', 0.00, 1, '2023-11-09 12:53:17', '2023-11-09 12:53:17'),
(7, 'ARENCIÓN ODONTOLOGICA', 0.00, 1, '2023-11-09 12:53:17', '2023-11-09 12:53:17'),
(8, 'BLANQUEAMIENTO DENTAL', 0.00, 1, '2023-11-09 12:53:17', '2023-11-09 12:53:17'),
(9, 'FERULA DE MIORELAJACIÓN ', 0.00, 1, '2023-11-09 12:53:17', '2023-11-09 12:53:17'),
(10, 'CIRUGIA- PROCEDIMIENTO ODONTOLOGICO', 0.00, 1, '2023-11-09 12:53:17', '2023-11-09 12:53:17'),
(11, 'CIRUGIA TERCER MOLAR', 0.00, 1, '2023-11-09 12:53:17', '2023-11-09 12:53:17'),
(12, 'INCRUSTACIÓN', 0.00, 1, '2023-11-09 12:53:17', '2023-11-09 12:53:17'),
(13, 'PERNO DE FIBRA DE VIDRIO', 0.00, 1, '2023-11-09 12:53:17', '2023-11-09 12:53:17'),
(14, 'ENDODONCIA', 0.00, 1, '2023-11-09 12:53:17', '2023-11-09 12:53:17'),
(15, 'PROFILAXIS + FLUOR', 0.00, 1, '2023-11-09 12:53:17', '2023-11-09 12:53:17'),
(16, 'PROFILAXIS Y DESTARTAJE', 0.00, 1, '2023-11-09 12:53:17', '2023-11-09 12:53:17'),
(17, 'OBTURACIÓN ', 0.00, 1, '2023-11-09 12:53:17', '2023-11-09 12:53:17'),
(18, 'CORONA DE PORCELANA', 0.00, 1, '2023-11-09 12:53:17', '2023-11-09 12:53:17'),
(19, 'CORONA DE  ZIRCONIO', 0.00, 1, '2023-11-09 12:53:17', '2023-11-09 12:53:17'),
(20, 'PROTESIS SUPERIOR', 0.00, 1, '2023-11-09 12:53:17', '2023-11-09 12:53:17'),
(21, 'PROTESIS INFERIOR', 0.00, 1, '2023-11-09 12:53:17', '2023-11-09 12:53:17'),
(22, 'PROTESIS SUPERIOR PARCIAL', 0.00, 1, '2023-11-09 12:53:17', '2023-11-09 12:53:17'),
(23, 'PROTESIS INFERIOR PARCIAL', 0.00, 1, '2023-11-09 12:53:17', '2023-11-09 12:53:17'),
(24, 'RETIRO DE PUNTOS', 0.00, 1, '2023-11-09 12:53:17', '2023-11-09 12:53:17'),
(25, 'PRUEBA DE ENFILADO', 0.00, 1, '2023-11-09 12:53:17', '2023-11-09 12:53:17'),
(26, 'PRUEBA BISCOCHO', 0.00, 1, '2023-11-09 12:53:17', '2023-11-09 12:53:17'),
(27, 'CEMENTACIÓN CORONA ', 0.00, 1, '2023-11-09 12:53:17', '2023-11-09 12:53:17'),
(28, 'CEMENTACIÓN INCRUSTACIÓN', 0.00, 1, '2023-11-09 12:53:17', '2023-11-09 12:53:17'),
(29, 'TOMA DE IMPRESIÓN PUENTE', 0.00, 1, '2023-11-09 12:53:17', '2023-11-09 12:53:17'),
(30, 'TOMA IMPRESIÓN INCRUSTACIÓN ', 0.00, 1, '2023-11-09 12:53:17', '2023-11-09 12:53:17'),
(31, 'TOMA DE IMPRESIÓN CORONA', 0.00, 1, '2023-11-09 12:53:17', '2023-11-09 12:53:17'),
(32, 'PRUEBA PLACA BASE', 0.00, 1, '2023-11-09 12:53:17', '2023-11-09 12:53:17'),
(33, 'ENTREGA DE PROTESIS', 0.00, 1, '2023-11-09 12:53:17', '2023-11-09 12:53:17'),
(34, 'Aparatología de Ortodoncia', 700.00, 1, '2023-11-21 17:11:11', '2023-11-21 17:11:11'),
(35, 'Prtofilaxis y Blanqueamiento', 300.00, 1, '2023-11-21 17:11:34', '2023-11-21 17:11:34'),
(36, 'control de Ortodoncia', 150.00, 1, '2023-11-21 17:13:39', '2023-11-21 17:13:39'),
(37, 'control de Implantes', 0.00, 1, '2023-11-21 17:14:29', '2023-11-21 17:14:29'),
(38, 'Retiro de Puntos', 0.00, 1, '2023-11-21 17:14:55', '2023-11-21 17:14:55');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tba_socio`
--

CREATE TABLE `tba_socio` (
  `IdSocio` int(11) NOT NULL,
  `NombreSocio` varchar(150) NOT NULL,
  `IdTipoIdentificacion` int(11) DEFAULT NULL,
  `IdTipoSocio` int(11) NOT NULL,
  `Identificacion` varchar(15) DEFAULT NULL,
  `FechaCreacion` datetime NOT NULL,
  `FechaActualizacion` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish_ci ROW_FORMAT=DYNAMIC;

--
-- Volcado de datos para la tabla `tba_socio`
--

INSERT INTO `tba_socio` (`IdSocio`, `NombreSocio`, `IdTipoIdentificacion`, `IdTipoSocio`, `Identificacion`, `FechaCreacion`, `FechaActualizacion`) VALUES
(1, 'Jorge', 1, 1, '99999999', '2023-11-08 22:11:58', '2023-11-08 22:11:58'),
(2, 'Enmanuel', 1, 1, '72568595', '2023-11-08 22:11:58', '2023-11-08 22:11:58'),
(3, 'Andrea', 1, 1, '70153685', '2023-11-08 22:11:58', '2023-11-08 22:11:58');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tba_tipodepago`
--

CREATE TABLE `tba_tipodepago` (
  `IdTipoPago` int(11) NOT NULL,
  `DescripcionTipo` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish_ci ROW_FORMAT=DYNAMIC;

--
-- Volcado de datos para la tabla `tba_tipodepago`
--

INSERT INTO `tba_tipodepago` (`IdTipoPago`, `DescripcionTipo`) VALUES
(1, 'Contado'),
(2, 'Deposito'),
(3, 'Transferencia'),
(4, 'Yape'),
(5, 'Plin');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tba_tipoidentificacion`
--

CREATE TABLE `tba_tipoidentificacion` (
  `IdTipoIdentificacion` int(11) NOT NULL,
  `NombreTipoIdentificacion` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish_ci ROW_FORMAT=DYNAMIC;

--
-- Volcado de datos para la tabla `tba_tipoidentificacion`
--

INSERT INTO `tba_tipoidentificacion` (`IdTipoIdentificacion`, `NombreTipoIdentificacion`) VALUES
(1, 'DNI'),
(2, 'RUC'),
(3, 'OTRO');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tba_tipoprocedimiento`
--

CREATE TABLE `tba_tipoprocedimiento` (
  `IdTipoProcedimiento` int(11) NOT NULL,
  `NombreTipoProcedimiento` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish_ci ROW_FORMAT=DYNAMIC;

--
-- Volcado de datos para la tabla `tba_tipoprocedimiento`
--

INSERT INTO `tba_tipoprocedimiento` (`IdTipoProcedimiento`, `NombreTipoProcedimiento`) VALUES
(1, 'General');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tba_tiposocio`
--

CREATE TABLE `tba_tiposocio` (
  `IdTipoSocio` int(11) NOT NULL,
  `NombreTipoSocio` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish_ci ROW_FORMAT=DYNAMIC;

--
-- Volcado de datos para la tabla `tba_tiposocio`
--

INSERT INTO `tba_tiposocio` (`IdTipoSocio`, `NombreTipoSocio`) VALUES
(1, 'Medico'),
(2, 'Empleado'),
(3, 'Contratista'),
(4, 'Proveedor');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tba_tratamiento`
--

CREATE TABLE `tba_tratamiento` (
  `IdTratamiento` int(11) NOT NULL,
  `IdHistoriaClinica` int(11) NOT NULL,
  `IdPaciente` int(11) NOT NULL,
  `TotalTratamiento` decimal(10,2) DEFAULT NULL,
  `TotalPagado` decimal(10,2) DEFAULT NULL,
  `UsuarioCreado` int(11) NOT NULL,
  `UsuarioActualiza` int(11) NOT NULL,
  `FechaCreacion` datetime NOT NULL,
  `FechaActualizacion` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish_ci ROW_FORMAT=DYNAMIC;

--
-- Volcado de datos para la tabla `tba_tratamiento`
--

INSERT INTO `tba_tratamiento` (`IdTratamiento`, `IdHistoriaClinica`, `IdPaciente`, `TotalTratamiento`, `TotalPagado`, `UsuarioCreado`, `UsuarioActualiza`, `FechaCreacion`, `FechaActualizacion`) VALUES
(1, 3, 1, 31.00, 180.00, 2, 2, '2023-11-08 22:23:00', '2023-11-08 22:23:00'),
(2, 12, 32, 0.00, NULL, 1, 1, '2023-11-21 15:17:31', '2023-11-21 15:17:31'),
(5, 15, 428, 1880.00, 150.00, 1, 1, '2023-11-21 17:09:04', '2023-11-21 17:09:04'),
(6, 16, 13, 0.00, NULL, 1, 1, '2024-09-16 12:37:41', '2024-09-16 12:37:41'),
(7, 17, 16, 0.00, NULL, 1, 1, '2024-09-16 12:37:53', '2024-09-16 12:37:53'),
(8, 18, 20, 0.00, NULL, 1, 1, '2024-09-16 12:37:59', '2024-09-16 12:37:59'),
(9, 19, 31, 0.00, NULL, 1, 1, '2024-09-16 12:38:07', '2024-09-16 12:38:07'),
(10, 20, 39, 0.00, NULL, 1, 1, '2024-09-16 12:38:17', '2024-09-16 12:38:17'),
(11, 21, 42, 0.00, NULL, 1, 1, '2024-09-16 12:38:26', '2024-09-16 12:38:26'),
(12, 22, 47, 0.00, NULL, 1, 1, '2024-09-16 12:38:33', '2024-09-16 12:38:33'),
(13, 23, 49, 0.00, NULL, 1, 1, '2024-09-16 12:38:40', '2024-09-16 12:38:40'),
(14, 24, 50, 0.00, NULL, 1, 1, '2024-09-16 12:38:49', '2024-09-16 12:38:49'),
(15, 25, 33, 0.00, NULL, 1, 1, '2024-09-16 22:12:21', '2024-09-16 22:12:21'),
(16, 26, 37, 0.00, NULL, 1, 1, '2024-09-16 22:12:30', '2024-09-16 22:12:30'),
(17, 27, 38, 0.00, NULL, 1, 1, '2024-09-16 22:12:38', '2024-09-16 22:12:38'),
(18, 28, 41, 0.00, NULL, 1, 1, '2024-09-16 22:12:53', '2024-09-16 22:12:53'),
(19, 29, 58, 0.00, NULL, 1, 1, '2024-09-16 22:13:05', '2024-09-16 22:13:05'),
(20, 30, 63, 0.00, NULL, 1, 1, '2024-09-16 22:13:12', '2024-09-16 22:13:12'),
(21, 31, 66, 0.00, NULL, 1, 1, '2024-09-16 22:13:17', '2024-09-16 22:13:17'),
(22, 32, 79, 0.00, NULL, 1, 1, '2024-09-16 22:13:26', '2024-09-16 22:13:26'),
(23, 33, 91, 0.00, NULL, 1, 1, '2024-09-16 22:13:33', '2024-09-16 22:13:33'),
(24, 34, 95, 0.00, NULL, 1, 1, '2024-09-16 22:13:39', '2024-09-16 22:13:39'),
(25, 35, 98, 0.00, NULL, 1, 1, '2024-09-16 22:13:46', '2024-09-16 22:13:46'),
(26, 36, 101, 0.00, NULL, 1, 1, '2024-09-16 22:13:53', '2024-09-16 22:13:53'),
(27, 37, 103, 0.00, NULL, 1, 1, '2024-09-16 22:14:00', '2024-09-16 22:14:00'),
(28, 38, 107, 400.00, 250.00, 1, 1, '2024-09-16 22:14:07', '2024-09-16 22:14:07'),
(29, 39, 111, 220.00, NULL, 1, 1, '2024-09-16 22:14:15', '2024-09-16 22:14:15'),
(30, 40, 113, 0.00, NULL, 1, 1, '2024-09-16 22:14:26', '2024-09-16 22:14:26'),
(31, 41, 117, 0.00, NULL, 1, 1, '2024-09-16 22:14:34', '2024-09-16 22:14:34'),
(32, 42, 123, 0.00, NULL, 1, 1, '2024-09-16 22:14:41', '2024-09-16 22:14:41'),
(33, 43, 135, 350.00, NULL, 1, 1, '2024-09-16 22:14:48', '2024-09-16 22:14:48'),
(34, 44, 145, 510.00, NULL, 1, 1, '2024-09-16 22:14:55', '2024-09-16 22:14:55'),
(35, 45, 151, 700.00, NULL, 1, 1, '2024-09-16 22:15:03', '2024-09-16 22:15:03'),
(36, 46, 157, 750.00, NULL, 1, 1, '2024-09-16 22:15:11', '2024-09-16 22:15:11'),
(37, 47, 162, 1030.00, NULL, 1, 1, '2024-09-16 22:15:19', '2024-09-16 22:15:19');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tba_usuario`
--

CREATE TABLE `tba_usuario` (
  `IdUsuario` int(11) NOT NULL,
  `IdPerfilUsuario` int(11) NOT NULL,
  `NombreUsuario` varchar(50) NOT NULL,
  `CorreoUsuario` varchar(255) NOT NULL,
  `PasswordUsuario` varchar(100) NOT NULL,
  `CelularUsuario` int(11) DEFAULT NULL,
  `FechaCreacion` datetime NOT NULL,
  `FechaActualizacion` datetime NOT NULL,
  `UltimaConexion` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish_ci ROW_FORMAT=DYNAMIC;

--
-- Volcado de datos para la tabla `tba_usuario`
--

INSERT INTO `tba_usuario` (`IdUsuario`, `IdPerfilUsuario`, `NombreUsuario`, `CorreoUsuario`, `PasswordUsuario`, `CelularUsuario`, `FechaCreacion`, `FechaActualizacion`, `UltimaConexion`) VALUES
(1, 1, 'Jorge', 'jconcha@gmail.com', '$2a$07$usesomesillystringforeh6tvwDNOAiEn9PYXfY79K3vDiKj6Ib6', 987654321, '2023-07-19 00:00:00', '2023-07-19 00:00:00', '2024-09-17 14:41:57'),
(2, 3, 'Enmanuel', 'enmanuel@gmail.com', '$2a$07$usesomesillystringfore.bXBiiBmtmJExuW0GyFzyUnd2McTvrG', NULL, '2023-11-08 22:20:54', '2023-11-08 22:20:54', '2023-11-08 22:22:37'),
(3, 3, 'Andrea', 'andrea@gmail.com', '$2a$07$usesomesillystringfore5RwuGeh2KgwYOYNP.Aa25SGSVq27n02', NULL, '2023-11-08 22:21:22', '2023-11-08 22:21:22', '2023-11-08 22:22:37');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tba_visita`
--

CREATE TABLE `tba_visita` (
  `IdVisita` int(11) NOT NULL,
  `IdHistoriaClinica` int(11) NOT NULL,
  `IdDetalleTratamiento` int(11) DEFAULT NULL,
  `MotivoVisita` varchar(255) NOT NULL,
  `FechaVisita` date NOT NULL,
  `ObservacionVisita` varchar(255) DEFAULT NULL,
  `UsuarioCreado` int(11) NOT NULL,
  `UsuarioActualiza` int(11) NOT NULL,
  `FechaCreacion` datetime NOT NULL,
  `FechaActualizacion` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish_ci ROW_FORMAT=DYNAMIC;

--
-- Volcado de datos para la tabla `tba_visita`
--

INSERT INTO `tba_visita` (`IdVisita`, `IdHistoriaClinica`, `IdDetalleTratamiento`, `MotivoVisita`, `FechaVisita`, `ObservacionVisita`, `UsuarioCreado`, `UsuarioActualiza`, `FechaCreacion`, `FechaActualizacion`) VALUES
(4, 3, NULL, 'Dolor', '2023-11-08', '', 1, 1, '2023-11-09 16:13:35', '2023-11-09 16:13:35');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `tba_centrocostos`
--
ALTER TABLE `tba_centrocostos`
  ADD PRIMARY KEY (`IdCentroCostos`) USING BTREE;

--
-- Indices de la tabla `tba_cita`
--
ALTER TABLE `tba_cita`
  ADD PRIMARY KEY (`IdCita`) USING BTREE,
  ADD KEY `tba_cita_fkPaciente` (`IdPaciente`) USING BTREE;

--
-- Indices de la tabla `tba_costo`
--
ALTER TABLE `tba_costo`
  ADD PRIMARY KEY (`IdCosto`) USING BTREE;

--
-- Indices de la tabla `tba_cotizacion`
--
ALTER TABLE `tba_cotizacion`
  ADD PRIMARY KEY (`IdCotizacion`) USING BTREE,
  ADD KEY `fk_cotizacion_paciente` (`IdPaciente`) USING BTREE;

--
-- Indices de la tabla `tba_detallecosto`
--
ALTER TABLE `tba_detallecosto`
  ADD PRIMARY KEY (`IdDetalleCosto`) USING BTREE,
  ADD KEY `tba_movimiento_fkMovimiento` (`IdCosto`) USING BTREE,
  ADD KEY `tba_movimiento_fkGasto` (`IdGasto`) USING BTREE,
  ADD KEY `tba_detallecosto_fkSocio` (`IdSocio`) USING BTREE;

--
-- Indices de la tabla `tba_detallecotizacion`
--
ALTER TABLE `tba_detallecotizacion`
  ADD PRIMARY KEY (`IdDetalleCotizacion`) USING BTREE,
  ADD KEY `fk_detallecotizacion_cotizacion` (`IdCotizacion`) USING BTREE;

--
-- Indices de la tabla `tba_detallehistoriaclinica`
--
ALTER TABLE `tba_detallehistoriaclinica`
  ADD PRIMARY KEY (`IdDetalleHistoriaClinica`) USING BTREE,
  ADD KEY `tba_detallehistoriaclinica_fkHistoriaClinica` (`IdHistoriaClinica`) USING BTREE,
  ADD KEY `tba_detallehistoriaclinica_fkTratamiento` (`IdTratamiento`) USING BTREE;

--
-- Indices de la tabla `tba_detalletratamiento`
--
ALTER TABLE `tba_detalletratamiento`
  ADD PRIMARY KEY (`IdDetalleTratamiento`) USING BTREE,
  ADD KEY `tba_detalletratamiento_fkDetalleTratamiento` (`IdTratamiento`) USING BTREE,
  ADD KEY `tba_detalletratamiento_fkProcedimiento` (`IdProcedimiento`) USING BTREE;

--
-- Indices de la tabla `tba_gasto`
--
ALTER TABLE `tba_gasto`
  ADD PRIMARY KEY (`IdGasto`) USING BTREE,
  ADD KEY `tba_gasto_fkcentrocostos` (`IdCentroCostos`) USING BTREE;

--
-- Indices de la tabla `tba_historiaclinica`
--
ALTER TABLE `tba_historiaclinica`
  ADD PRIMARY KEY (`IdHistoriaClinica`) USING BTREE,
  ADD KEY `tba_historiaclinica_fkPaciente` (`IdPaciente`) USING BTREE,
  ADD KEY `tba_historiaclinica_fksocio` (`IdSocio`) USING BTREE;

--
-- Indices de la tabla `tba_paciente`
--
ALTER TABLE `tba_paciente`
  ADD PRIMARY KEY (`IdPaciente`) USING BTREE;

--
-- Indices de la tabla `tba_pago`
--
ALTER TABLE `tba_pago`
  ADD PRIMARY KEY (`IdPago`) USING BTREE,
  ADD KEY `tba_pago_fkPaciente` (`IdPaciente`) USING BTREE,
  ADD KEY `tba_pago_fkTipoPago` (`IdTipoPago`) USING BTREE;

--
-- Indices de la tabla `tba_perfilusuario`
--
ALTER TABLE `tba_perfilusuario`
  ADD PRIMARY KEY (`IdPerfilUsuario`) USING BTREE;

--
-- Indices de la tabla `tba_procedimiento`
--
ALTER TABLE `tba_procedimiento`
  ADD PRIMARY KEY (`IdProcedimiento`) USING BTREE,
  ADD KEY `tba_procedimiento_fkTipoProcedimiento` (`IdTipoProcedimiento`) USING BTREE;

--
-- Indices de la tabla `tba_socio`
--
ALTER TABLE `tba_socio`
  ADD PRIMARY KEY (`IdSocio`) USING BTREE,
  ADD KEY `tba_socio_fksocios` (`IdTipoIdentificacion`) USING BTREE,
  ADD KEY `tba_socio_fktiposocio` (`IdTipoSocio`) USING BTREE;

--
-- Indices de la tabla `tba_tipodepago`
--
ALTER TABLE `tba_tipodepago`
  ADD PRIMARY KEY (`IdTipoPago`) USING BTREE;

--
-- Indices de la tabla `tba_tipoidentificacion`
--
ALTER TABLE `tba_tipoidentificacion`
  ADD PRIMARY KEY (`IdTipoIdentificacion`) USING BTREE;

--
-- Indices de la tabla `tba_tipoprocedimiento`
--
ALTER TABLE `tba_tipoprocedimiento`
  ADD PRIMARY KEY (`IdTipoProcedimiento`) USING BTREE;

--
-- Indices de la tabla `tba_tiposocio`
--
ALTER TABLE `tba_tiposocio`
  ADD PRIMARY KEY (`IdTipoSocio`) USING BTREE;

--
-- Indices de la tabla `tba_tratamiento`
--
ALTER TABLE `tba_tratamiento`
  ADD PRIMARY KEY (`IdTratamiento`) USING BTREE,
  ADD KEY `tba_tratamiento_fkHistoriaClinica` (`IdHistoriaClinica`) USING BTREE;

--
-- Indices de la tabla `tba_usuario`
--
ALTER TABLE `tba_usuario`
  ADD PRIMARY KEY (`IdUsuario`) USING BTREE,
  ADD KEY `tba_usuario_fkPerfilUsuario` (`IdPerfilUsuario`) USING BTREE;

--
-- Indices de la tabla `tba_visita`
--
ALTER TABLE `tba_visita`
  ADD PRIMARY KEY (`IdVisita`) USING BTREE,
  ADD KEY `fk_visita_historiaclinica` (`IdHistoriaClinica`) USING BTREE;

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `tba_centrocostos`
--
ALTER TABLE `tba_centrocostos`
  MODIFY `IdCentroCostos` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `tba_cita`
--
ALTER TABLE `tba_cita`
  MODIFY `IdCita` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tba_costo`
--
ALTER TABLE `tba_costo`
  MODIFY `IdCosto` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tba_cotizacion`
--
ALTER TABLE `tba_cotizacion`
  MODIFY `IdCotizacion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `tba_detallecosto`
--
ALTER TABLE `tba_detallecosto`
  MODIFY `IdDetalleCosto` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tba_detallecotizacion`
--
ALTER TABLE `tba_detallecotizacion`
  MODIFY `IdDetalleCotizacion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `tba_detallehistoriaclinica`
--
ALTER TABLE `tba_detallehistoriaclinica`
  MODIFY `IdDetalleHistoriaClinica` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT de la tabla `tba_detalletratamiento`
--
ALTER TABLE `tba_detalletratamiento`
  MODIFY `IdDetalleTratamiento` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT de la tabla `tba_gasto`
--
ALTER TABLE `tba_gasto`
  MODIFY `IdGasto` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tba_historiaclinica`
--
ALTER TABLE `tba_historiaclinica`
  MODIFY `IdHistoriaClinica` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT de la tabla `tba_paciente`
--
ALTER TABLE `tba_paciente`
  MODIFY `IdPaciente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=436;

--
-- AUTO_INCREMENT de la tabla `tba_pago`
--
ALTER TABLE `tba_pago`
  MODIFY `IdPago` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `tba_perfilusuario`
--
ALTER TABLE `tba_perfilusuario`
  MODIFY `IdPerfilUsuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `tba_procedimiento`
--
ALTER TABLE `tba_procedimiento`
  MODIFY `IdProcedimiento` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT de la tabla `tba_socio`
--
ALTER TABLE `tba_socio`
  MODIFY `IdSocio` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `tba_tipodepago`
--
ALTER TABLE `tba_tipodepago`
  MODIFY `IdTipoPago` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `tba_tipoidentificacion`
--
ALTER TABLE `tba_tipoidentificacion`
  MODIFY `IdTipoIdentificacion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `tba_tipoprocedimiento`
--
ALTER TABLE `tba_tipoprocedimiento`
  MODIFY `IdTipoProcedimiento` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `tba_tiposocio`
--
ALTER TABLE `tba_tiposocio`
  MODIFY `IdTipoSocio` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `tba_tratamiento`
--
ALTER TABLE `tba_tratamiento`
  MODIFY `IdTratamiento` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT de la tabla `tba_usuario`
--
ALTER TABLE `tba_usuario`
  MODIFY `IdUsuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `tba_visita`
--
ALTER TABLE `tba_visita`
  MODIFY `IdVisita` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `tba_cita`
--
ALTER TABLE `tba_cita`
  ADD CONSTRAINT `tba_cita_fkPaciente` FOREIGN KEY (`IdPaciente`) REFERENCES `tba_paciente` (`IdPaciente`);

--
-- Filtros para la tabla `tba_cotizacion`
--
ALTER TABLE `tba_cotizacion`
  ADD CONSTRAINT `fk_cotizacion_paciente` FOREIGN KEY (`IdPaciente`) REFERENCES `tba_paciente` (`IdPaciente`);

--
-- Filtros para la tabla `tba_detallecosto`
--
ALTER TABLE `tba_detallecosto`
  ADD CONSTRAINT `tba_detallecosto_fkCosto` FOREIGN KEY (`IdCosto`) REFERENCES `tba_costo` (`IdCosto`),
  ADD CONSTRAINT `tba_detallecosto_fkGasto` FOREIGN KEY (`IdGasto`) REFERENCES `tba_gasto` (`IdGasto`),
  ADD CONSTRAINT `tba_detallecosto_fkSocio` FOREIGN KEY (`IdSocio`) REFERENCES `tba_socio` (`IdSocio`);

--
-- Filtros para la tabla `tba_detallecotizacion`
--
ALTER TABLE `tba_detallecotizacion`
  ADD CONSTRAINT `fk_detallecotizacion_cotizacion` FOREIGN KEY (`IdCotizacion`) REFERENCES `tba_cotizacion` (`IdCotizacion`);

--
-- Filtros para la tabla `tba_detallehistoriaclinica`
--
ALTER TABLE `tba_detallehistoriaclinica`
  ADD CONSTRAINT `tba_detallehistoriaclinica_fkHistoriaClinica` FOREIGN KEY (`IdHistoriaClinica`) REFERENCES `tba_historiaclinica` (`IdHistoriaClinica`);

--
-- Filtros para la tabla `tba_detalletratamiento`
--
ALTER TABLE `tba_detalletratamiento`
  ADD CONSTRAINT `tba_detalletratamiento_fkDetalleTratamiento` FOREIGN KEY (`IdTratamiento`) REFERENCES `tba_tratamiento` (`IdTratamiento`),
  ADD CONSTRAINT `tba_detalletratamiento_fkProcedimiento` FOREIGN KEY (`IdProcedimiento`) REFERENCES `tba_procedimiento` (`IdProcedimiento`);

--
-- Filtros para la tabla `tba_gasto`
--
ALTER TABLE `tba_gasto`
  ADD CONSTRAINT `tba_gasto_fkcentrocostos` FOREIGN KEY (`IdCentroCostos`) REFERENCES `tba_centrocostos` (`IdCentroCostos`);

--
-- Filtros para la tabla `tba_historiaclinica`
--
ALTER TABLE `tba_historiaclinica`
  ADD CONSTRAINT `tba_historiaclinica_fkPaciente` FOREIGN KEY (`IdPaciente`) REFERENCES `tba_paciente` (`IdPaciente`),
  ADD CONSTRAINT `tba_historiaclinica_fksocio` FOREIGN KEY (`IdSocio`) REFERENCES `tba_socio` (`IdSocio`);

--
-- Filtros para la tabla `tba_pago`
--
ALTER TABLE `tba_pago`
  ADD CONSTRAINT `tba_pago_fkPaciente` FOREIGN KEY (`IdPaciente`) REFERENCES `tba_paciente` (`IdPaciente`),
  ADD CONSTRAINT `tba_pago_fkTipoPago` FOREIGN KEY (`IdTipoPago`) REFERENCES `tba_tipodepago` (`IdTipoPago`);

--
-- Filtros para la tabla `tba_procedimiento`
--
ALTER TABLE `tba_procedimiento`
  ADD CONSTRAINT `tba_procedimiento_fkTipoProcedimiento` FOREIGN KEY (`IdTipoProcedimiento`) REFERENCES `tba_tipoprocedimiento` (`IdTipoProcedimiento`);

--
-- Filtros para la tabla `tba_socio`
--
ALTER TABLE `tba_socio`
  ADD CONSTRAINT `tba_socio_fksocios` FOREIGN KEY (`IdTipoIdentificacion`) REFERENCES `tba_tipoidentificacion` (`IdTipoIdentificacion`),
  ADD CONSTRAINT `tba_socio_fktiposocio` FOREIGN KEY (`IdTipoSocio`) REFERENCES `tba_tiposocio` (`IdTipoSocio`);

--
-- Filtros para la tabla `tba_tratamiento`
--
ALTER TABLE `tba_tratamiento`
  ADD CONSTRAINT `tba_tratamiento_fkHistoriaClinica` FOREIGN KEY (`IdHistoriaClinica`) REFERENCES `tba_historiaclinica` (`IdHistoriaClinica`);

--
-- Filtros para la tabla `tba_usuario`
--
ALTER TABLE `tba_usuario`
  ADD CONSTRAINT `tba_usuario_fkPerfilUsuario` FOREIGN KEY (`IdPerfilUsuario`) REFERENCES `tba_perfilusuario` (`IdPerfilUsuario`);

--
-- Filtros para la tabla `tba_visita`
--
ALTER TABLE `tba_visita`
  ADD CONSTRAINT `fk_visita_historiaclinica` FOREIGN KEY (`IdHistoriaClinica`) REFERENCES `tba_historiaclinica` (`IdHistoriaClinica`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

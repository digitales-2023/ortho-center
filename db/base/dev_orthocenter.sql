-- phpMyAdmin SQL Dump
-- version 5.2.3
-- https://www.phpmyadmin.net/
--
-- Servidor: db
-- Tiempo de generación: 11-05-2026 a las 15:27:37
-- Versión del servidor: 9.0.1
-- Versión de PHP: 8.3.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `dev_orthocenter`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tba_centrocostos`
--

CREATE TABLE `tba_centrocostos` (
  `IdCentroCostos` int NOT NULL,
  `DescripcionCentro` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `FechaCreacion` datetime NOT NULL,
  `FechaActualizacion` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish_ci ROW_FORMAT=DYNAMIC;

--
-- Volcado de datos para la tabla `tba_centrocostos`
--

INSERT INTO `tba_centrocostos` (`IdCentroCostos`, `DescripcionCentro`, `FechaCreacion`, `FechaActualizacion`) VALUES
(1, 'Servicios Generales', '2026-05-07 14:55:16', '2026-05-07 14:55:16'),
(2, 'Costos de Laboratorio', '2026-05-09 16:18:02', '2026-05-09 16:18:02'),
(3, 'Costos de Laboratorio', '2026-05-07 14:55:16', '2026-05-07 14:55:16'),
(4, 'Costos de Personal', '2026-05-07 14:55:16', '2026-05-07 14:55:16'),
(5, 'Costos de Insumos', '2026-05-07 14:55:16', '2026-05-07 14:55:16');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tba_cita`
--

CREATE TABLE `tba_cita` (
  `IdCita` int NOT NULL,
  `IdPaciente` int NOT NULL,
  `FechaProgramada` datetime NOT NULL,
  `MedicoAsignado` int NOT NULL,
  `EstadoCita` int NOT NULL,
  `FechaCreacion` datetime NOT NULL,
  `FechaActualizacion` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish_ci ROW_FORMAT=DYNAMIC;

--
-- Volcado de datos para la tabla `tba_cita`
--

INSERT INTO `tba_cita` (`IdCita`, `IdPaciente`, `FechaProgramada`, `MedicoAsignado`, `EstadoCita`, `FechaCreacion`, `FechaActualizacion`) VALUES
(1, 1, '2026-05-08 14:59:37', 2, 1, '2026-05-07 14:59:37', '2026-05-07 14:59:37'),
(2, 2, '2026-05-09 14:59:37', 2, 1, '2026-05-07 14:59:37', '2026-05-07 14:59:37'),
(3, 3, '2026-05-10 14:59:37', 2, 1, '2026-05-07 14:59:37', '2026-05-07 14:59:37'),
(4, 4, '2026-05-11 14:59:37', 2, 1, '2026-05-07 14:59:37', '2026-05-07 14:59:37'),
(5, 5, '2026-05-12 14:59:37', 2, 1, '2026-05-07 14:59:37', '2026-05-07 14:59:37'),
(6, 6, '2026-05-13 14:59:37', 2, 1, '2026-05-07 14:59:37', '2026-05-07 14:59:37'),
(7, 7, '2026-05-14 14:59:37', 2, 1, '2026-05-07 14:59:37', '2026-05-07 14:59:37'),
(8, 8, '2026-05-15 14:59:37', 2, 1, '2026-05-07 14:59:37', '2026-05-07 14:59:37'),
(9, 9, '2026-05-16 14:59:37', 2, 1, '2026-05-07 14:59:37', '2026-05-07 14:59:37'),
(10, 10, '2026-05-17 14:59:37', 2, 1, '2026-05-07 14:59:37', '2026-05-07 14:59:37');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tba_costo`
--

CREATE TABLE `tba_costo` (
  `IdCosto` int NOT NULL,
  `IdCentroCostos` int NOT NULL,
  `MesCosto` varchar(10) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `TotalCosto` decimal(10,2) NOT NULL,
  `EstadoCosto` int NOT NULL,
  `UsuarioCreado` int NOT NULL,
  `UsuarioActualiza` int NOT NULL,
  `FechaCreacion` datetime NOT NULL,
  `FechaActualizacion` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish_ci ROW_FORMAT=DYNAMIC;

--
-- Volcado de datos para la tabla `tba_costo`
--

INSERT INTO `tba_costo` (`IdCosto`, `IdCentroCostos`, `MesCosto`, `TotalCosto`, `EstadoCosto`, `UsuarioCreado`, `UsuarioActualiza`, `FechaCreacion`, `FechaActualizacion`) VALUES
(1, 1, '01-2026', 2500.00, 1, 1, 1, '2026-01-15 10:00:00', '2026-05-09 16:18:02'),
(2, 3, '2025-08', 1400.00, 1, 1, 1, '2026-05-07 14:59:38', '2026-05-07 14:59:38'),
(3, 4, '2025-09', 1600.00, 1, 1, 1, '2026-05-07 14:59:38', '2026-05-07 14:59:38'),
(4, 1, '2025-10', 1800.00, 1, 1, 1, '2026-05-07 14:59:38', '2026-05-07 14:59:38'),
(5, 1, '02-2026', 2650.00, 1, 1, 1, '2026-02-15 10:00:00', '2026-05-09 16:18:02'),
(6, 3, '2025-12', 2200.00, 1, 1, 1, '2026-05-07 14:59:38', '2026-05-07 14:59:38'),
(7, 4, '2026-01', 2400.00, 1, 1, 1, '2026-05-07 14:59:38', '2026-05-07 14:59:38'),
(8, 1, '2026-02', 2600.00, 1, 1, 1, '2026-05-07 14:59:38', '2026-05-07 14:59:38'),
(9, 1, '03-2026', 2400.00, 1, 1, 1, '2026-03-15 10:00:00', '2026-05-09 16:18:02'),
(10, 3, '2026-04', 3000.00, 1, 1, 1, '2026-05-07 14:59:38', '2026-05-07 14:59:38'),
(11, 3, '03-2026', 9000.00, 1, 1, 1, '2026-03-15 10:00:00', '2026-05-09 16:18:02'),
(12, 4, '03-2026', 3100.00, 1, 1, 1, '2026-03-15 10:00:00', '2026-05-09 16:18:02'),
(13, 1, '04-2026', 2750.00, 1, 1, 1, '2026-04-15 10:00:00', '2026-05-09 16:18:02'),
(14, 2, '04-2026', 2250.50, 1, 1, 1, '2026-04-15 10:00:00', '2026-05-09 16:18:02'),
(15, 3, '04-2026', 8900.00, 1, 1, 1, '2026-04-15 10:00:00', '2026-05-09 16:18:02'),
(16, 4, '04-2026', 3600.25, 1, 1, 1, '2026-04-15 10:00:00', '2026-05-09 16:18:02'),
(17, 1, '05-2026', 2800.00, 1, 1, 1, '2026-05-09 10:00:00', '2026-05-09 16:18:02'),
(18, 2, '05-2026', 2100.00, 1, 1, 1, '2026-05-09 10:00:00', '2026-05-09 16:18:02'),
(19, 3, '05-2026', 8600.00, 1, 1, 1, '2026-05-09 10:00:00', '2026-05-09 16:18:02'),
(20, 4, '05-2026', 3350.75, 1, 1, 1, '2026-05-09 10:00:00', '2026-05-09 16:18:02'),
(21, 1, '06-2026', 2600.00, 1, 1, 1, '2026-06-09 10:00:00', '2026-05-09 16:18:02'),
(22, 2, '06-2026', 2050.00, 1, 1, 1, '2026-06-09 10:00:00', '2026-05-09 16:18:02'),
(23, 3, '06-2026', 8450.00, 1, 1, 1, '2026-06-09 10:00:00', '2026-05-09 16:18:02'),
(24, 4, '06-2026', 3250.50, 1, 1, 1, '2026-06-09 10:00:00', '2026-05-09 16:18:02');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tba_cotizacion`
--

CREATE TABLE `tba_cotizacion` (
  `IdCotizacion` int NOT NULL,
  `IdPaciente` int NOT NULL,
  `TotalCotizacion` decimal(10,2) NOT NULL,
  `FechaCotizacion` date NOT NULL,
  `EstadoCotizacion` varchar(10) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `UsuarioCreado` int NOT NULL,
  `UsuarioActualiza` int NOT NULL,
  `FechaCreacion` datetime NOT NULL,
  `FechaActualizacion` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish_ci ROW_FORMAT=DYNAMIC;

--
-- Volcado de datos para la tabla `tba_cotizacion`
--

INSERT INTO `tba_cotizacion` (`IdCotizacion`, `IdPaciente`, `TotalCotizacion`, `FechaCotizacion`, `EstadoCotizacion`, `UsuarioCreado`, `UsuarioActualiza`, `FechaCreacion`, `FechaActualizacion`) VALUES
(1, 1, 600.00, '2026-05-08', 'Aceptada', 2, 2, '2026-05-07 14:59:38', '2026-05-07 14:59:38'),
(2, 2, 700.00, '2026-05-09', 'Aceptada', 2, 2, '2026-05-07 14:59:38', '2026-05-07 14:59:38'),
(3, 3, 800.00, '2026-05-10', 'Pendiente', 2, 2, '2026-05-07 14:59:38', '2026-05-07 14:59:38'),
(4, 4, 900.00, '2026-05-11', 'Aceptada', 2, 2, '2026-05-07 14:59:38', '2026-05-07 14:59:38'),
(5, 5, 1000.00, '2026-05-12', 'Aceptada', 2, 2, '2026-05-07 14:59:38', '2026-05-07 14:59:38'),
(6, 6, 1100.00, '2026-05-13', 'Pendiente', 2, 2, '2026-05-07 14:59:38', '2026-05-07 14:59:38'),
(7, 7, 1200.00, '2026-05-14', 'Aceptada', 2, 2, '2026-05-07 14:59:38', '2026-05-07 14:59:38'),
(8, 8, 1300.00, '2026-05-15', 'Aceptada', 2, 2, '2026-05-07 14:59:38', '2026-05-07 14:59:38'),
(9, 9, 1400.00, '2026-05-16', 'Pendiente', 2, 2, '2026-05-07 14:59:38', '2026-05-07 14:59:38'),
(10, 10, 1500.00, '2026-05-17', 'Aceptada', 2, 2, '2026-05-07 14:59:38', '2026-05-07 14:59:38');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tba_detallecosto`
--

CREATE TABLE `tba_detallecosto` (
  `IdDetalleCosto` int NOT NULL,
  `IdCosto` int NOT NULL,
  `IdGasto` int NOT NULL,
  `NumeroDocumento` varchar(25) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `ObservacionGasto` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `FechaCosto` date NOT NULL,
  `PrecioGasto` decimal(10,2) NOT NULL,
  `IdSocio` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish_ci ROW_FORMAT=DYNAMIC;

--
-- Volcado de datos para la tabla `tba_detallecosto`
--

INSERT INTO `tba_detallecosto` (`IdDetalleCosto`, `IdCosto`, `IdGasto`, `NumeroDocumento`, `ObservacionGasto`, `FechaCosto`, `PrecioGasto`, `IdSocio`) VALUES
(1, 1, 1, 'FAC-001', 'Recibo de energía eléctrica mes de enero', '2026-01-31', 800.00, NULL),
(2, 2, 3, 'FAC-2026-002', 'Comprobante de gasto', '2026-05-05', 160.00, NULL),
(3, 3, 4, 'FAC-2026-003', 'Comprobante de gasto', '2026-05-04', 190.00, NULL),
(4, 4, 5, 'FAC-2026-004', 'Comprobante de gasto', '2026-05-03', 220.00, NULL),
(5, 1, 5, 'FAC-005', 'Servicio de limpieza', '2026-01-28', 300.00, NULL),
(6, 6, 7, 'FAC-2026-006', 'Comprobante de gasto', '2026-05-01', 280.00, NULL),
(7, 7, 8, 'FAC-2026-007', 'Comprobante de gasto', '2026-04-30', 310.00, NULL),
(8, 8, 9, 'FAC-2026-008', 'Comprobante de gasto', '2026-04-29', 340.00, NULL),
(9, 2, 9, 'FAC-009', 'Calibración equipos laboratorio', '2026-01-25', 300.00, NULL),
(10, 10, 1, 'FAC-2026-0010', 'Comprobante de gasto', '2026-04-27', 400.00, NULL),
(11, 3, 11, 'ROL-001', 'Salarios administrativos', '2026-01-31', 2000.00, NULL),
(12, 3, 12, 'BON-001', 'Bonificación enero', '2026-01-31', 500.00, NULL),
(13, 3, 13, 'SEG-001', 'Seguro médico personal', '2026-01-31', 500.00, NULL),
(14, 4, 14, 'COM-001', 'Resinas y materiales dentales', '2026-01-28', 1200.75, NULL),
(15, 4, 15, 'FAC-010', 'Anestésicos y fármacos', '2026-01-30', 800.00, NULL),
(16, 4, 16, 'FAC-011', 'Instrumentos quirúrgicos', '2026-01-25', 900.00, NULL),
(17, 4, 17, 'FAC-012', 'Suministros de oficina', '2026-01-31', 300.00, NULL),
(18, 5, 1, 'FAC-013', 'Energía eléctrica febrero', '2026-02-28', 850.00, NULL),
(19, 5, 2, 'FAC-014', 'Agua febrero', '2026-02-28', 320.00, NULL),
(20, 5, 3, 'FAC-015', 'Internet febrero', '2026-02-28', 500.00, NULL),
(21, 5, 4, 'FAC-016', 'Reparación equipos', '2026-02-20', 700.00, NULL),
(22, 5, 5, 'FAC-017', 'Limpieza febrero', '2026-02-28', 280.00, NULL),
(23, 6, 6, 'FAC-018', 'Radiografías febrero', '2026-02-28', 650.00, NULL),
(24, 6, 7, 'FAC-019', 'Reactivos febrero', '2026-02-25', 500.25, NULL),
(25, 6, 8, 'FAC-020', 'Desechables laboratorio', '2026-02-27', 550.00, NULL),
(26, 6, 9, 'FAC-021', 'Mantenimiento equipos', '2026-02-20', 400.00, NULL),
(27, 7, 10, 'ROL-002', 'Salarios médicos febrero', '2026-02-28', 5750.00, NULL),
(28, 7, 11, 'ROL-002', 'Salarios administrativos', '2026-02-28', 2000.00, NULL),
(29, 7, 12, 'BON-002', 'Bonificación febrero', '2026-02-28', 500.00, NULL),
(30, 7, 13, 'SEG-002', 'Seguro médico', '2026-02-28', 500.00, NULL),
(31, 8, 14, 'COM-002', 'Resinas y materiales', '2026-02-27', 1250.50, NULL),
(32, 8, 15, 'FAC-022', 'Fármacos febrero', '2026-02-28', 850.00, NULL),
(33, 8, 16, 'FAC-023', 'Instrumentos', '2026-02-25', 950.00, NULL),
(34, 8, 17, 'FAC-024', 'Suministros', '2026-02-28', 400.00, NULL),
(35, 9, 1, 'FAC-025', 'Energía marzo', '2026-03-31', 800.00, NULL),
(36, 9, 2, 'FAC-026', 'Agua marzo', '2026-03-31', 300.00, NULL),
(37, 9, 3, 'FAC-027', 'Internet marzo', '2026-03-31', 500.00, NULL),
(38, 9, 4, 'FAC-028', 'Mantenimiento', '2026-03-25', 500.00, NULL),
(39, 9, 5, 'FAC-029', 'Limpieza', '2026-03-31', 300.00, NULL),
(40, 10, 6, 'FAC-030', 'Radiografías', '2026-03-31', 600.75, NULL),
(41, 10, 7, 'FAC-031', 'Reactivos', '2026-03-28', 450.00, NULL),
(42, 10, 8, 'FAC-032', 'Desechables', '2026-03-30', 500.00, NULL),
(43, 10, 9, 'FAC-033', 'Mantenimiento', '2026-03-20', 400.00, NULL),
(44, 11, 10, 'ROL-003', 'Salarios médicos', '2026-03-31', 6000.00, NULL),
(45, 11, 11, 'ROL-003', 'Salarios administrativos', '2026-03-31', 2000.00, NULL),
(46, 11, 12, 'BON-003', 'Bonificación', '2026-03-31', 500.00, NULL),
(47, 11, 13, 'SEG-003', 'Seguro', '2026-03-31', 500.00, NULL),
(48, 12, 14, 'COM-003', 'Materiales', '2026-03-28', 1200.00, NULL),
(49, 12, 15, 'FAC-034', 'Fármacos', '2026-03-30', 800.00, NULL),
(50, 12, 16, 'FAC-035', 'Instrumentos', '2026-03-25', 900.00, NULL),
(51, 12, 17, 'FAC-036', 'Suministros', '2026-03-31', 200.00, NULL),
(52, 13, 1, 'FAC-037', 'Energía abril', '2026-04-30', 850.00, NULL),
(53, 13, 2, 'FAC-038', 'Agua', '2026-04-30', 320.00, NULL),
(54, 13, 3, 'FAC-039', 'Internet', '2026-04-30', 500.00, NULL),
(55, 13, 4, 'FAC-040', 'Reparación', '2026-04-25', 700.00, NULL),
(56, 13, 5, 'FAC-041', 'Limpieza', '2026-04-30', 380.00, NULL),
(57, 14, 6, 'FAC-042', 'Radiografías', '2026-04-30', 700.00, NULL),
(58, 14, 7, 'FAC-043', 'Reactivos', '2026-04-28', 500.50, NULL),
(59, 14, 8, 'FAC-044', 'Desechables', '2026-04-29', 550.00, NULL),
(60, 14, 9, 'FAC-045', 'Mantenimiento', '2026-04-22', 500.00, NULL),
(61, 15, 10, 'ROL-004', 'Salarios médicos', '2026-04-30', 5900.00, NULL),
(62, 15, 11, 'ROL-004', 'Administrativos', '2026-04-30', 2000.00, NULL),
(63, 15, 12, 'BON-004', 'Bonificación', '2026-04-30', 500.00, NULL),
(64, 15, 13, 'SEG-004', 'Seguro', '2026-04-30', 500.00, NULL),
(65, 16, 14, 'COM-004', 'Materiales', '2026-04-28', 1300.25, NULL),
(66, 16, 15, 'FAC-046', 'Fármacos', '2026-04-29', 850.00, NULL),
(67, 16, 16, 'FAC-047', 'Instrumentos', '2026-04-26', 950.00, NULL),
(68, 16, 17, 'FAC-048', 'Suministros', '2026-04-30', 500.00, NULL),
(69, 17, 1, 'FAC-049', 'Energía mayo', '2026-05-09', 900.00, NULL),
(70, 17, 2, 'FAC-050', 'Agua mayo', '2026-05-09', 350.00, NULL),
(71, 17, 3, 'FAC-051', 'Internet mayo', '2026-05-09', 500.00, NULL),
(72, 17, 4, 'FAC-052', 'Mantenimiento', '2026-05-05', 600.00, NULL),
(73, 17, 5, 'FAC-053', 'Limpieza', '2026-05-08', 450.00, NULL),
(74, 18, 6, 'FAC-054', 'Radiografías', '2026-05-09', 650.00, NULL),
(75, 18, 7, 'FAC-055', 'Reactivos', '2026-05-08', 450.00, NULL),
(76, 18, 8, 'FAC-056', 'Desechables', '2026-05-07', 550.00, NULL),
(77, 18, 9, 'FAC-057', 'Mantenimiento', '2026-05-05', 450.00, NULL),
(78, 19, 10, 'ROL-005', 'Salarios médicos', '2026-05-09', 5600.00, NULL),
(79, 19, 11, 'ROL-005', 'Administrativos', '2026-05-09', 2000.00, NULL),
(80, 19, 12, 'BON-005', 'Bonificación', '2026-05-09', 500.00, NULL),
(81, 19, 13, 'SEG-005', 'Seguro', '2026-05-09', 500.00, NULL),
(82, 20, 14, 'COM-005', 'Materiales', '2026-05-08', 1200.75, NULL),
(83, 20, 15, 'FAC-058', 'Fármacos', '2026-05-07', 800.00, NULL),
(84, 20, 16, 'FAC-059', 'Instrumentos', '2026-05-06', 900.00, NULL),
(85, 20, 17, 'FAC-060', 'Suministros', '2026-05-09', 450.00, NULL),
(86, 21, 1, 'FAC-061', 'Energía junio', '2026-06-09', 800.00, NULL),
(87, 21, 2, 'FAC-062', 'Agua', '2026-06-09', 300.00, NULL),
(88, 21, 3, 'FAC-063', 'Internet', '2026-06-09', 500.00, NULL),
(89, 21, 4, 'FAC-064', 'Mantenimiento', '2026-06-05', 550.00, NULL),
(90, 21, 5, 'FAC-065', 'Limpieza', '2026-06-08', 450.00, NULL),
(91, 22, 6, 'FAC-066', 'Radiografías', '2026-06-09', 600.00, NULL),
(92, 22, 7, 'FAC-067', 'Reactivos', '2026-06-08', 450.00, NULL),
(93, 22, 8, 'FAC-068', 'Desechables', '2026-06-07', 500.00, NULL),
(94, 22, 9, 'FAC-069', 'Mantenimiento', '2026-06-05', 500.00, NULL),
(95, 23, 10, 'ROL-006', 'Salarios médicos', '2026-06-09', 5500.00, NULL),
(96, 23, 11, 'ROL-006', 'Administrativos', '2026-06-09', 2000.00, NULL),
(97, 23, 12, 'BON-006', 'Bonificación', '2026-06-09', 500.00, NULL),
(98, 23, 13, 'SEG-006', 'Seguro', '2026-06-09', 450.00, NULL),
(99, 24, 14, 'COM-006', 'Materiales', '2026-06-08', 1150.50, NULL),
(100, 24, 15, 'FAC-070', 'Fármacos', '2026-06-07', 750.00, NULL),
(101, 24, 16, 'FAC-071', 'Instrumentos', '2026-06-06', 900.00, NULL),
(102, 24, 17, 'FAC-072', 'Suministros', '2026-06-09', 500.00, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tba_detallecotizacion`
--

CREATE TABLE `tba_detallecotizacion` (
  `IdDetalleCotizacion` int NOT NULL,
  `IdCotizacion` int NOT NULL,
  `IdProcedimiento` int DEFAULT NULL,
  `ObservacionProcedimiento` varchar(150) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci DEFAULT NULL,
  `CantidadProcedimiento` int NOT NULL,
  `PrecioUnitario` decimal(10,2) NOT NULL,
  `TotalProcedimiento` decimal(10,2) NOT NULL,
  `UsuarioCreado` int NOT NULL,
  `UsuarioActualiza` int NOT NULL,
  `FechaCreacion` datetime NOT NULL,
  `FechaActualizacion` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish_ci ROW_FORMAT=DYNAMIC;

--
-- Volcado de datos para la tabla `tba_detallecotizacion`
--

INSERT INTO `tba_detallecotizacion` (`IdDetalleCotizacion`, `IdCotizacion`, `IdProcedimiento`, `ObservacionProcedimiento`, `CantidadProcedimiento`, `PrecioUnitario`, `TotalProcedimiento`, `UsuarioCreado`, `UsuarioActualiza`, `FechaCreacion`, `FechaActualizacion`) VALUES
(1, 1, 2, 'Procedimiento cotizado', 1, 300.00, 350.00, 2, 2, '2026-05-07 14:59:38', '2026-05-07 14:59:38'),
(2, 2, 3, 'Procedimiento cotizado', 1, 350.00, 400.00, 2, 2, '2026-05-07 14:59:38', '2026-05-07 14:59:38'),
(3, 3, 4, 'Procedimiento cotizado', 1, 400.00, 450.00, 2, 2, '2026-05-07 14:59:38', '2026-05-07 14:59:38'),
(4, 4, 5, 'Procedimiento cotizado', 1, 450.00, 500.00, 2, 2, '2026-05-07 14:59:38', '2026-05-07 14:59:38'),
(5, 5, 6, 'Procedimiento cotizado', 1, 500.00, 550.00, 2, 2, '2026-05-07 14:59:38', '2026-05-07 14:59:38'),
(6, 6, 7, 'Procedimiento cotizado', 1, 550.00, 600.00, 2, 2, '2026-05-07 14:59:38', '2026-05-07 14:59:38'),
(7, 7, 8, 'Procedimiento cotizado', 1, 600.00, 650.00, 2, 2, '2026-05-07 14:59:38', '2026-05-07 14:59:38'),
(8, 8, 9, 'Procedimiento cotizado', 1, 650.00, 700.00, 2, 2, '2026-05-07 14:59:38', '2026-05-07 14:59:38'),
(9, 9, 10, 'Procedimiento cotizado', 1, 700.00, 750.00, 2, 2, '2026-05-07 14:59:38', '2026-05-07 14:59:38'),
(10, 10, 1, 'Procedimiento cotizado', 1, 750.00, 800.00, 2, 2, '2026-05-07 14:59:38', '2026-05-07 14:59:38');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tba_detallehistoriaclinica`
--

CREATE TABLE `tba_detallehistoriaclinica` (
  `IdDetalleHistoriaClinica` int NOT NULL,
  `IdHistoriaClinica` int NOT NULL,
  `IdTratamiento` int NOT NULL,
  `PresionArterial` varchar(25) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci DEFAULT NULL,
  `Pulso` varchar(25) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci DEFAULT NULL,
  `Temperatura` varchar(25) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci DEFAULT NULL,
  `FrecuenciaCardiaca` varchar(25) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci DEFAULT NULL,
  `FrecuenciaRespiratoria` varchar(25) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci DEFAULT NULL,
  `ExamenOdonto` varchar(150) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci DEFAULT NULL,
  `DiagnosticoPresuntivo` varchar(150) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci DEFAULT NULL,
  `DiagnosticoDefinitivo` varchar(150) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci DEFAULT NULL,
  `Pronostico` varchar(500) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci DEFAULT NULL,
  `TratamientoPaciente` varchar(500) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci DEFAULT NULL,
  `InformacionAlta` varchar(500) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci DEFAULT NULL,
  `FechaCreado` datetime NOT NULL,
  `FechaActualiza` datetime NOT NULL,
  `UsuarioCreado` int NOT NULL,
  `UsuarioActualizado` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish_ci ROW_FORMAT=DYNAMIC;

--
-- Volcado de datos para la tabla `tba_detallehistoriaclinica`
--

INSERT INTO `tba_detallehistoriaclinica` (`IdDetalleHistoriaClinica`, `IdHistoriaClinica`, `IdTratamiento`, `PresionArterial`, `Pulso`, `Temperatura`, `FrecuenciaCardiaca`, `FrecuenciaRespiratoria`, `ExamenOdonto`, `DiagnosticoPresuntivo`, `DiagnosticoDefinitivo`, `Pronostico`, `TratamientoPaciente`, `InformacionAlta`, `FechaCreado`, `FechaActualiza`, `UsuarioCreado`, `UsuarioActualizado`) VALUES
(1, 1, 1, '120/80', '72', '37', '72', '16', 'Normal', 'Sin hallazgos', 'Buena salud dental', 'Excelente', 'Tratamiento preventivo', 'Continuar higiene', '2026-05-07 14:59:38', '2026-05-07 14:59:38', 2, 2),
(2, 2, 2, '120/80', '72', '37', '72', '16', 'Normal', 'Sin hallazgos', 'Buena salud dental', 'Excelente', 'Tratamiento preventivo', 'Continuar higiene', '2026-05-07 14:59:38', '2026-05-07 14:59:38', 2, 2),
(3, 3, 3, '120/80', '72', '37', '72', '16', 'Normal', 'Sin hallazgos', 'Buena salud dental', 'Excelente', 'Tratamiento preventivo', 'Continuar higiene', '2026-05-07 14:59:38', '2026-05-07 14:59:38', 2, 2),
(4, 4, 4, '120/80', '72', '37', '72', '16', 'Normal', 'Sin hallazgos', 'Buena salud dental', 'Excelente', 'Tratamiento preventivo', 'Continuar higiene', '2026-05-07 14:59:38', '2026-05-07 14:59:38', 2, 2),
(5, 5, 5, '120/80', '72', '37', '72', '16', 'Normal', 'Sin hallazgos', 'Buena salud dental', 'Excelente', 'Tratamiento preventivo', 'Continuar higiene', '2026-05-07 14:59:38', '2026-05-07 14:59:38', 2, 2),
(6, 6, 6, '120/80', '72', '37', '72', '16', 'Normal', 'Sin hallazgos', 'Buena salud dental', 'Excelente', 'Tratamiento preventivo', 'Continuar higiene', '2026-05-07 14:59:38', '2026-05-07 14:59:38', 2, 2),
(7, 7, 7, '120/80', '72', '37', '72', '16', 'Normal', 'Sin hallazgos', 'Buena salud dental', 'Excelente', 'Tratamiento preventivo', 'Continuar higiene', '2026-05-07 14:59:38', '2026-05-07 14:59:38', 2, 2),
(8, 8, 8, '120/80', '72', '37', '72', '16', 'Normal', 'Sin hallazgos', 'Buena salud dental', 'Excelente', 'Tratamiento preventivo', 'Continuar higiene', '2026-05-07 14:59:38', '2026-05-07 14:59:38', 2, 2),
(9, 9, 9, '120/80', '72', '37', '72', '16', 'Normal', 'Sin hallazgos', 'Buena salud dental', 'Excelente', 'Tratamiento preventivo', 'Continuar higiene', '2026-05-07 14:59:38', '2026-05-07 14:59:38', 2, 2),
(10, 10, 10, '120/80', '72', '37', '72', '16', 'Normal', 'Sin hallazgos', 'Buena salud dental', 'Excelente', 'Tratamiento preventivo', 'Continuar higiene', '2026-05-07 14:59:38', '2026-05-09 17:35:55', 2, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tba_detalletratamiento`
--

CREATE TABLE `tba_detalletratamiento` (
  `IdDetalleTratamiento` int NOT NULL,
  `IdTratamiento` int NOT NULL,
  `IdProcedimiento` int NOT NULL,
  `EstadoTratamiento` int NOT NULL,
  `MedicoProcedimiento` int DEFAULT NULL,
  `FechaProcedimiento` date DEFAULT NULL,
  `ObservacionProcedimiento` varchar(150) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci DEFAULT NULL,
  `PrecioProcedimiento` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish_ci ROW_FORMAT=DYNAMIC;

--
-- Volcado de datos para la tabla `tba_detalletratamiento`
--

INSERT INTO `tba_detalletratamiento` (`IdDetalleTratamiento`, `IdTratamiento`, `IdProcedimiento`, `EstadoTratamiento`, `MedicoProcedimiento`, `FechaProcedimiento`, `ObservacionProcedimiento`, `PrecioProcedimiento`) VALUES
(1, 1, 2, 1, 2, '2026-05-08', 'Procedimiento completado', 175.00),
(2, 2, 3, 1, 2, '2026-05-09', 'Procedimiento completado', 200.00),
(3, 3, 4, 1, 2, '2026-05-10', 'Procedimiento completado', 225.00),
(4, 4, 5, 1, 2, '2026-05-11', 'Procedimiento completado', 250.00),
(5, 5, 6, 1, 2, '2026-05-12', 'Procedimiento completado', 275.00),
(6, 6, 7, 1, 2, '2026-05-13', 'Procedimiento completado', 300.00),
(7, 7, 8, 1, 2, '2026-05-14', 'Procedimiento completado', 325.00),
(8, 8, 9, 1, 2, '2026-05-15', 'Procedimiento completado', 350.00),
(9, 9, 10, 1, 2, '2026-05-16', 'Procedimiento completado', 375.00),
(10, 10, 1, 1, 2, '2026-05-17', 'Procedimiento completado', 400.00);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tba_gasto`
--

CREATE TABLE `tba_gasto` (
  `IdGasto` int NOT NULL,
  `IdCentroCostos` int NOT NULL,
  `NombreGasto` varchar(150) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `FechaCreacion` datetime NOT NULL,
  `FechaActualizacion` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish_ci ROW_FORMAT=DYNAMIC;

--
-- Volcado de datos para la tabla `tba_gasto`
--

INSERT INTO `tba_gasto` (`IdGasto`, `IdCentroCostos`, `NombreGasto`, `FechaCreacion`, `FechaActualizacion`) VALUES
(1, 1, 'Servicios Básicos - Agua', '2026-05-07 14:59:37', '2026-05-07 14:59:37'),
(2, 1, 'Servicios Básicos - Luz', '2026-05-07 14:59:37', '2026-05-07 14:59:37'),
(3, 1, 'Servicios Básicos - Internet', '2026-05-07 14:59:37', '2026-05-07 14:59:37'),
(4, 3, 'Materiales Dentales - Composite', '2026-05-07 14:59:37', '2026-05-07 14:59:37'),
(5, 3, 'Materiales Dentales - Amalgama', '2026-05-07 14:59:37', '2026-05-07 14:59:37'),
(6, 3, 'Instrumentos Dentales', '2026-05-07 14:59:37', '2026-05-07 14:59:37'),
(7, 4, 'Sueldos Personal', '2026-05-07 14:59:37', '2026-05-07 14:59:37'),
(8, 5, 'Suministros de Oficina', '2026-05-07 14:59:37', '2026-05-07 14:59:37'),
(9, 5, 'Limpieza y Mantenimiento', '2026-05-07 14:59:37', '2026-05-07 14:59:37'),
(10, 5, 'Esterilización de Equipos', '2026-05-07 14:59:37', '2026-05-07 14:59:37'),
(11, 3, 'Salarios Administrativos', '2026-05-09 16:18:02', '2026-05-09 16:18:02'),
(12, 3, 'Bonificaciones', '2026-05-09 16:18:02', '2026-05-09 16:18:02'),
(13, 3, 'Seguro Médico Personal', '2026-05-09 16:18:02', '2026-05-09 16:18:02'),
(14, 4, 'Materiales Dentales', '2026-05-09 16:18:02', '2026-05-09 16:18:02'),
(15, 4, 'Fármacos y Medicamentos', '2026-05-09 16:18:02', '2026-05-09 16:18:02'),
(16, 4, 'Instrumentos Quirúrgicos', '2026-05-09 16:18:02', '2026-05-09 16:18:02'),
(17, 4, 'Suministros Oficina', '2026-05-09 16:18:02', '2026-05-09 16:18:02');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tba_historiaclinica`
--

CREATE TABLE `tba_historiaclinica` (
  `IdHistoriaClinica` int NOT NULL,
  `IdPaciente` int NOT NULL,
  `IdSocio` int DEFAULT NULL,
  `AlergiasEncontradas` varchar(500) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci DEFAULT NULL,
  `MotivoConsulta` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci DEFAULT NULL,
  `DatosInformante` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci DEFAULT NULL,
  `TiempoEnfermedad` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci DEFAULT NULL,
  `SignosSintomas` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci DEFAULT NULL,
  `RelatoCronologico` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci DEFAULT NULL,
  `FuncionesBiologicas` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci DEFAULT NULL,
  `AntecedentesFamiliares` varchar(500) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci DEFAULT NULL,
  `AntecedentesPersonales` varchar(500) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci DEFAULT NULL,
  `RutaOdontograma` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci DEFAULT NULL,
  `UsuarioCreado` int NOT NULL,
  `UsuarioActualizado` int NOT NULL,
  `FechaCreado` datetime NOT NULL,
  `FechaActualiza` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish_ci ROW_FORMAT=DYNAMIC;

--
-- Volcado de datos para la tabla `tba_historiaclinica`
--

INSERT INTO `tba_historiaclinica` (`IdHistoriaClinica`, `IdPaciente`, `IdSocio`, `AlergiasEncontradas`, `MotivoConsulta`, `DatosInformante`, `TiempoEnfermedad`, `SignosSintomas`, `RelatoCronologico`, `FuncionesBiologicas`, `AntecedentesFamiliares`, `AntecedentesPersonales`, `RutaOdontograma`, `UsuarioCreado`, `UsuarioActualizado`, `FechaCreado`, `FechaActualiza`) VALUES
(1, 1, NULL, 'Ninguna', 'Consulta dental', 'Paciente', 'N/A', 'Ninguno', 'Revisión general', 'Normales', 'Sin datos', 'Buena salud', '', 2, 2, '2026-05-07 14:59:37', '2026-05-07 14:59:37'),
(2, 2, NULL, 'Ninguna', 'Consulta dental', 'Paciente', 'N/A', 'Ninguno', 'Revisión general', 'Normales', 'Sin datos', 'Buena salud', '', 2, 2, '2026-05-07 14:59:37', '2026-05-07 14:59:37'),
(3, 3, NULL, 'Ninguna', 'Consulta dental', 'Paciente', 'N/A', 'Ninguno', 'Revisión general', 'Normales', 'Sin datos', 'Buena salud', '', 2, 2, '2026-05-07 14:59:37', '2026-05-07 14:59:37'),
(4, 4, NULL, 'Ninguna', 'Consulta dental', 'Paciente', 'N/A', 'Ninguno', 'Revisión general', 'Normales', 'Sin datos', 'Buena salud', '', 2, 2, '2026-05-07 14:59:37', '2026-05-07 14:59:37'),
(5, 5, NULL, 'Ninguna', 'Consulta dental', 'Paciente', 'N/A', 'Ninguno', 'Revisión general', 'Normales', 'Sin datos', 'Buena salud', '', 2, 2, '2026-05-07 14:59:37', '2026-05-07 14:59:37'),
(6, 6, NULL, 'Ninguna', 'Consulta dental', 'Paciente', 'N/A', 'Ninguno', 'Revisión general', 'Normales', 'Sin datos', 'Buena salud', '', 2, 2, '2026-05-07 14:59:37', '2026-05-07 14:59:37'),
(7, 7, NULL, 'Ninguna', 'Consulta dental', 'Paciente', 'N/A', 'Ninguno', 'Revisión general', 'Normales', 'Sin datos', 'Buena salud', '', 2, 2, '2026-05-07 14:59:37', '2026-05-07 14:59:37'),
(8, 8, NULL, 'Ninguna', 'Consulta dental', 'Paciente', 'N/A', 'Ninguno', 'Revisión general', 'Normales', 'Sin datos', 'Buena salud', '', 2, 2, '2026-05-07 14:59:37', '2026-05-07 14:59:37'),
(9, 9, NULL, 'Ninguna', 'Consulta dental', 'Paciente', 'N/A', 'Ninguno', 'Revisión general', 'Normales', 'Sin datos', 'Buena salud', '', 2, 2, '2026-05-07 14:59:37', '2026-05-07 14:59:37'),
(10, 10, NULL, 'Ninguna', 'Consulta dental', 'Paciente', 'N/A', 'Ninguno', 'Revisión general', 'Normales', 'Sin datos', 'Buena salud', '', 2, 1, '2026-05-07 14:59:37', '2026-05-09 17:35:55');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tba_paciente`
--

CREATE TABLE `tba_paciente` (
  `IdPaciente` int NOT NULL,
  `NombrePaciente` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `ApellidoPaciente` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `TipoIdentificacion` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `NumeroIdentificacion` varchar(16) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `SexoPaciente` varchar(12) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci DEFAULT NULL,
  `EdadPaciente` varchar(11) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci DEFAULT NULL,
  `FechaNacimiento` date DEFAULT NULL,
  `CelularPaciente` varchar(11) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `DomicilioPaciente` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci DEFAULT NULL,
  `LugarProcedencia` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci DEFAULT NULL,
  `LugarNacimiento` varchar(80) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci DEFAULT NULL,
  `GradoInstruccion` varchar(20) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci DEFAULT NULL,
  `RazaPaciente` varchar(20) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci DEFAULT NULL,
  `OcupacionPaciente` varchar(20) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci DEFAULT NULL,
  `ReligionPaciente` varchar(20) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci DEFAULT NULL,
  `EstadoCivil` varchar(20) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci DEFAULT NULL,
  `NumeroContactoPaciente` varchar(11) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci DEFAULT NULL,
  `NombreContactoPaciente` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci DEFAULT NULL,
  `UsuarioCreado` int DEFAULT NULL,
  `UsuarioActualiza` int DEFAULT NULL,
  `FechaCreacion` datetime NOT NULL,
  `FechaActualizacion` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish_ci ROW_FORMAT=DYNAMIC;

--
-- Volcado de datos para la tabla `tba_paciente`
--

INSERT INTO `tba_paciente` (`IdPaciente`, `NombrePaciente`, `ApellidoPaciente`, `TipoIdentificacion`, `NumeroIdentificacion`, `SexoPaciente`, `EdadPaciente`, `FechaNacimiento`, `CelularPaciente`, `DomicilioPaciente`, `LugarProcedencia`, `LugarNacimiento`, `GradoInstruccion`, `RazaPaciente`, `OcupacionPaciente`, `ReligionPaciente`, `EstadoCivil`, `NumeroContactoPaciente`, `NombreContactoPaciente`, `UsuarioCreado`, `UsuarioActualiza`, `FechaCreacion`, `FechaActualizacion`) VALUES
(1, 'Juan', 'Perez', 'DNI', '12345678', 'Masculino', '35', '1988-11-15', '987654321', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-05-07 14:55:16', '2026-05-07 14:55:16'),
(2, 'Maria', 'Garcia', 'DNI', '23456789', 'Femenino', '28', '1995-03-22', '987654322', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-05-07 14:55:16', '2026-05-07 14:55:16'),
(3, 'Carlos', 'Lopez', 'DNI', '34567890', 'Masculino', '45', '1978-07-10', '987654323', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-05-07 14:55:16', '2026-05-07 14:55:16'),
(4, 'Ana', 'Martinez', 'DNI', '45678901', 'Femenino', '32', '1991-09-05', '987654324', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-05-07 14:55:16', '2026-05-07 14:55:16'),
(5, 'Roberto', 'Sanchez', 'DNI', '56789012', 'Masculino', '52', '1971-12-20', '987654325', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-05-07 14:55:16', '2026-05-07 14:55:16'),
(6, 'Lucia', 'Ramirez', 'DNI', '67890123', 'Femenino', '38', '1985-05-14', '987654326', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-05-07 14:55:16', '2026-05-07 14:55:16'),
(7, 'Fernando', 'Torres', 'DNI', '78901234', 'Masculino', '41', '1982-01-30', '987654327', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-05-07 14:55:16', '2026-05-07 14:55:16'),
(8, 'Patricia', 'Flores', 'DNI', '89012345', 'Femenino', '29', '1994-08-18', '987654328', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-05-07 14:55:16', '2026-05-07 14:55:16'),
(9, 'Miguel', 'Vargas', 'DNI', '90123456', 'Masculino', '55', '1968-06-25', '987654329', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-05-07 14:55:16', '2026-05-07 14:55:16'),
(10, 'Sofia', 'Quispe', 'DNI', '01234567', 'Femenino', '26', '1997-02-11', '987654330', '', '', '', '', '', '', '', '', '', '', NULL, NULL, '2026-05-07 14:55:16', '2026-05-09 17:35:55');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tba_pago`
--

CREATE TABLE `tba_pago` (
  `IdPago` int NOT NULL,
  `IdPaciente` int NOT NULL,
  `IdTipoPago` int NOT NULL,
  `TotalPago` decimal(10,2) NOT NULL,
  `FechaPago` date NOT NULL,
  `ObservacionPago` varchar(200) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci DEFAULT NULL,
  `ComprobantePago` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci DEFAULT NULL,
  `FechaCreacion` datetime NOT NULL,
  `FechaActualizacion` datetime NOT NULL,
  `TotalPagado` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish_ci ROW_FORMAT=DYNAMIC;

--
-- Volcado de datos para la tabla `tba_pago`
--

INSERT INTO `tba_pago` (`IdPago`, `IdPaciente`, `IdTipoPago`, `TotalPago`, `FechaPago`, `ObservacionPago`, `ComprobantePago`, `FechaCreacion`, `FechaActualizacion`, `TotalPagado`) VALUES
(1, 1, 2, 150.00, '2026-05-08', 'Pago procesado', 'REC-001', '2026-05-07 14:59:38', '2026-05-07 14:59:38', 150.00),
(2, 2, 3, 200.00, '2026-05-09', 'Pago procesado', 'REC-002', '2026-05-07 14:59:38', '2026-05-07 14:59:38', 200.00),
(3, 3, 4, 250.00, '2026-05-10', 'Pago procesado', 'REC-003', '2026-05-07 14:59:38', '2026-05-07 14:59:38', 250.00),
(4, 4, 5, 300.00, '2026-05-11', 'Pago procesado', 'REC-004', '2026-05-07 14:59:38', '2026-05-07 14:59:38', 300.00),
(5, 5, 6, 350.00, '2026-05-12', 'Pago procesado', 'REC-005', '2026-05-07 14:59:38', '2026-05-07 14:59:38', 350.00),
(6, 6, 1, 400.00, '2026-05-13', 'Pago procesado', 'REC-006', '2026-05-07 14:59:38', '2026-05-07 14:59:38', 400.00),
(7, 7, 2, 450.00, '2026-05-14', 'Pago procesado', 'REC-007', '2026-05-07 14:59:38', '2026-05-07 14:59:38', 450.00),
(8, 8, 3, 500.00, '2026-05-15', 'Pago procesado', 'REC-008', '2026-05-07 14:59:38', '2026-05-07 14:59:38', 500.00),
(9, 9, 4, 550.00, '2026-05-16', 'Pago procesado', 'REC-009', '2026-05-07 14:59:38', '2026-05-07 14:59:38', 550.00),
(10, 10, 5, 600.00, '2026-05-17', 'Pago procesado', 'REC-0010', '2026-05-07 14:59:38', '2026-05-07 14:59:38', 600.00);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tba_perfilusuario`
--

CREATE TABLE `tba_perfilusuario` (
  `IdPerfilUsuario` int NOT NULL,
  `NombrePerfil` varchar(20) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish_ci ROW_FORMAT=DYNAMIC;

--
-- Volcado de datos para la tabla `tba_perfilusuario`
--

INSERT INTO `tba_perfilusuario` (`IdPerfilUsuario`, `NombrePerfil`) VALUES
(1, 'Administrador'),
(2, 'Dentista'),
(3, 'Recepcionista');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tba_procedimiento`
--

CREATE TABLE `tba_procedimiento` (
  `IdProcedimiento` int NOT NULL,
  `NombreProcedimiento` varchar(150) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `PrecioPromedio` decimal(10,2) NOT NULL,
  `IdTipoProcedimiento` int NOT NULL,
  `FechaCreacion` datetime NOT NULL,
  `FechaActualizacion` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish_ci ROW_FORMAT=DYNAMIC;

--
-- Volcado de datos para la tabla `tba_procedimiento`
--

INSERT INTO `tba_procedimiento` (`IdProcedimiento`, `NombreProcedimiento`, `PrecioPromedio`, `IdTipoProcedimiento`, `FechaCreacion`, `FechaActualizacion`) VALUES
(1, 'Limpieza Dental', 150.00, 1, '2026-05-07 14:55:16', '2026-05-07 14:55:16'),
(2, 'Restauración Resina Simple', 250.00, 1, '2026-05-07 14:55:16', '2026-05-07 14:55:16'),
(3, 'Restauración Resina Compuesta', 350.00, 1, '2026-05-07 14:55:16', '2026-05-07 14:55:16'),
(4, 'Tratamiento Endodóntico', 500.00, 2, '2026-05-07 14:55:16', '2026-05-07 14:55:16'),
(5, 'Endodoncia Completa', 800.00, 2, '2026-05-07 14:55:16', '2026-05-07 14:55:16'),
(6, 'Destartaje Periodontal', 200.00, 3, '2026-05-07 14:55:16', '2026-05-07 14:55:16'),
(7, 'Raspado y Alisado Radicular', 400.00, 3, '2026-05-07 14:55:16', '2026-05-07 14:55:16'),
(8, 'Colocación de Brackets', 1200.00, 4, '2026-05-07 14:55:16', '2026-05-07 14:55:16'),
(9, 'Extracción Dental', 300.00, 5, '2026-05-07 14:55:16', '2026-05-07 14:55:16'),
(10, 'Extracción Quirúrgica', 600.00, 5, '2026-05-07 14:55:16', '2026-05-07 14:55:16');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tba_socio`
--

CREATE TABLE `tba_socio` (
  `IdSocio` int NOT NULL,
  `NombreSocio` varchar(150) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `IdTipoIdentificacion` int DEFAULT NULL,
  `IdTipoSocio` int NOT NULL,
  `Identificacion` varchar(15) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci DEFAULT NULL,
  `FechaCreacion` datetime NOT NULL,
  `FechaActualizacion` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish_ci ROW_FORMAT=DYNAMIC;

--
-- Volcado de datos para la tabla `tba_socio`
--

INSERT INTO `tba_socio` (`IdSocio`, `NombreSocio`, `IdTipoIdentificacion`, `IdTipoSocio`, `Identificacion`, `FechaCreacion`, `FechaActualizacion`) VALUES
(1, 'Dr. Salazar', 1, 1, '12544578', '2026-05-07 14:59:38', '2026-05-07 14:59:38'),
(2, 'Dr. Peña', 1, 1, '23654689', '2026-05-07 14:59:38', '2026-05-07 14:59:38'),
(3, 'Dr. Quispe', 1, 1, '34765790', '2026-05-07 14:59:38', '2026-05-07 14:59:38'),
(4, 'Auxiliar Karina', 2, 2, '45876801', '2026-05-07 14:59:38', '2026-05-07 14:59:38'),
(5, 'Auxiliar Miguel', 2, 2, '56987912', '2026-05-07 14:59:38', '2026-05-07 14:59:38'),
(6, 'Limpieza Ana', 2, 2, '67098023', '2026-05-07 14:59:38', '2026-05-07 14:59:38'),
(7, 'Proveedor JD', 3, 4, '78109134', '2026-05-07 14:59:38', '2026-05-07 14:59:38'),
(8, 'Contratista Pérez', 1, 3, '89210245', '2026-05-07 14:59:38', '2026-05-07 14:59:38'),
(9, 'Laboratorio Dental', 2, 4, '90321356', '2026-05-07 14:59:38', '2026-05-07 14:59:38'),
(10, 'Suministros López', 1, 4, '01432467', '2026-05-07 14:59:38', '2026-05-07 14:59:38');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tba_tipodepago`
--

CREATE TABLE `tba_tipodepago` (
  `IdTipoPago` int NOT NULL,
  `DescripcionTipo` varchar(30) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish_ci ROW_FORMAT=DYNAMIC;

--
-- Volcado de datos para la tabla `tba_tipodepago`
--

INSERT INTO `tba_tipodepago` (`IdTipoPago`, `DescripcionTipo`) VALUES
(1, 'Efectivo'),
(2, 'Tarjeta Débito'),
(3, 'Tarjeta Crédito'),
(4, 'Transferencia'),
(5, 'Cheque'),
(6, 'Otro');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tba_tipoidentificacion`
--

CREATE TABLE `tba_tipoidentificacion` (
  `IdTipoIdentificacion` int NOT NULL,
  `NombreTipoIdentificacion` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish_ci ROW_FORMAT=DYNAMIC;

--
-- Volcado de datos para la tabla `tba_tipoidentificacion`
--

INSERT INTO `tba_tipoidentificacion` (`IdTipoIdentificacion`, `NombreTipoIdentificacion`) VALUES
(1, 'DNI'),
(2, 'RUC'),
(3, 'Pasaporte'),
(4, 'Cédula de Identidad'),
(5, 'Carné de Extranjería');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tba_tipoprocedimiento`
--

CREATE TABLE `tba_tipoprocedimiento` (
  `IdTipoProcedimiento` int NOT NULL,
  `NombreTipoProcedimiento` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish_ci ROW_FORMAT=DYNAMIC;

--
-- Volcado de datos para la tabla `tba_tipoprocedimiento`
--

INSERT INTO `tba_tipoprocedimiento` (`IdTipoProcedimiento`, `NombreTipoProcedimiento`) VALUES
(1, 'Operatoria'),
(2, 'Endodoncia'),
(3, 'Periodoncia'),
(4, 'Ortodoncia'),
(5, 'Cirugía');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tba_tiposocio`
--

CREATE TABLE `tba_tiposocio` (
  `IdTipoSocio` int NOT NULL,
  `NombreTipoSocio` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci DEFAULT NULL
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
  `IdTratamiento` int NOT NULL,
  `IdHistoriaClinica` int NOT NULL,
  `IdPaciente` int NOT NULL,
  `TotalTratamiento` decimal(10,2) DEFAULT NULL,
  `TotalPagado` decimal(10,2) DEFAULT NULL,
  `UsuarioCreado` int NOT NULL,
  `UsuarioActualiza` int NOT NULL,
  `FechaCreacion` datetime NOT NULL,
  `FechaActualizacion` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish_ci ROW_FORMAT=DYNAMIC;

--
-- Volcado de datos para la tabla `tba_tratamiento`
--

INSERT INTO `tba_tratamiento` (`IdTratamiento`, `IdHistoriaClinica`, `IdPaciente`, `TotalTratamiento`, `TotalPagado`, `UsuarioCreado`, `UsuarioActualiza`, `FechaCreacion`, `FechaActualizacion`) VALUES
(1, 1, 1, 150.00, 75.00, 2, 2, '2026-05-07 14:59:37', '2026-05-07 14:59:37'),
(2, 2, 2, 200.00, 100.00, 2, 2, '2026-05-07 14:59:37', '2026-05-07 14:59:37'),
(3, 3, 3, 250.00, 125.00, 2, 2, '2026-05-07 14:59:37', '2026-05-07 14:59:37'),
(4, 4, 4, 300.00, 150.00, 2, 2, '2026-05-07 14:59:37', '2026-05-07 14:59:37'),
(5, 5, 5, 350.00, 175.00, 2, 2, '2026-05-07 14:59:37', '2026-05-07 14:59:37'),
(6, 6, 6, 400.00, 200.00, 2, 2, '2026-05-07 14:59:37', '2026-05-07 14:59:37'),
(7, 7, 7, 450.00, 225.00, 2, 2, '2026-05-07 14:59:37', '2026-05-07 14:59:37'),
(8, 8, 8, 500.00, 250.00, 2, 2, '2026-05-07 14:59:37', '2026-05-07 14:59:37'),
(9, 9, 9, 550.00, 275.00, 2, 2, '2026-05-07 14:59:37', '2026-05-07 14:59:37'),
(10, 10, 10, 600.00, 300.00, 2, 2, '2026-05-07 14:59:37', '2026-05-07 14:59:37');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tba_usuario`
--

CREATE TABLE `tba_usuario` (
  `IdUsuario` int NOT NULL,
  `IdPerfilUsuario` int NOT NULL,
  `NombreUsuario` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `CorreoUsuario` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `PasswordUsuario` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `CelularUsuario` int DEFAULT NULL,
  `FechaCreacion` datetime NOT NULL,
  `FechaActualizacion` datetime NOT NULL,
  `UltimaConexion` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish_ci ROW_FORMAT=DYNAMIC;

--
-- Volcado de datos para la tabla `tba_usuario`
--

INSERT INTO `tba_usuario` (`IdUsuario`, `IdPerfilUsuario`, `NombreUsuario`, `CorreoUsuario`, `PasswordUsuario`, `CelularUsuario`, `FechaCreacion`, `FechaActualizacion`, `UltimaConexion`) VALUES
(1, 1, 'Administrador', 'admin@orthocenter.pe', '$2a$07$usesomesillystringforeOs4A3GevVfyrLa.0uw5MOaVATao0wq2', NULL, '2026-05-07 14:35:02', '2026-05-07 14:36:05', '2026-05-07 09:36:14'),
(2, 2, 'Dr. Martinez', 'dr.martinez@orthocenter.pe', '$2a$07$usesomesillystringfore2uDLvp1Ii2e./U9C8sBjqp8I90dH6hi', NULL, '2026-05-07 14:59:37', '2026-05-07 14:59:37', NULL),
(3, 3, 'Ana Recepción', 'ana.recepcion@orthocenter.pe', '$2a$07$usesomesillystringfore2uDLvp1Ii2e./U9C8sBjqp8I90dH6hi', NULL, '2026-05-07 14:59:37', '2026-05-07 14:59:37', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tba_visita`
--

CREATE TABLE `tba_visita` (
  `IdVisita` int NOT NULL,
  `IdPaciente` int NOT NULL,
  `FechaVisita` datetime NOT NULL,
  `MotivoPrincipal` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci DEFAULT NULL,
  `Notas` varchar(500) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci DEFAULT NULL,
  `UsuarioCreado` int NOT NULL,
  `UsuarioActualizado` int NOT NULL,
  `FechaCreacion` datetime NOT NULL,
  `FechaActualizacion` datetime NOT NULL,
  `IdHistoriaClinica` int DEFAULT NULL,
  `IdPago` int DEFAULT NULL,
  `IdDetalleTratamiento` int DEFAULT NULL,
  `MotivoVisita` varchar(255) COLLATE utf8mb3_spanish_ci DEFAULT NULL,
  `ObservacionVisita` varchar(255) COLLATE utf8mb3_spanish_ci DEFAULT NULL,
  `UsuarioActualiza` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish_ci ROW_FORMAT=DYNAMIC;

--
-- Volcado de datos para la tabla `tba_visita`
--

INSERT INTO `tba_visita` (`IdVisita`, `IdPaciente`, `FechaVisita`, `MotivoPrincipal`, `Notas`, `UsuarioCreado`, `UsuarioActualizado`, `FechaCreacion`, `FechaActualizacion`, `IdHistoriaClinica`, `IdPago`, `IdDetalleTratamiento`, `MotivoVisita`, `ObservacionVisita`, `UsuarioActualiza`) VALUES
(1, 1, '2026-05-08 14:59:38', 'Consulta dental', 'Paciente en buen estado', 2, 2, '2026-05-07 14:59:38', '2026-05-07 14:59:38', 1, NULL, NULL, 'Consulta dental', 'Paciente en buen estado', 2),
(2, 2, '2026-05-09 14:59:38', 'Consulta dental', 'Paciente en buen estado', 2, 2, '2026-05-07 14:59:38', '2026-05-07 14:59:38', 2, NULL, NULL, 'Consulta dental', 'Paciente en buen estado', 2),
(3, 3, '2026-05-10 14:59:38', 'Consulta dental', 'Paciente en buen estado', 2, 2, '2026-05-07 14:59:38', '2026-05-07 14:59:38', 3, NULL, NULL, 'Consulta dental', 'Paciente en buen estado', 2),
(4, 4, '2026-05-11 14:59:38', 'Consulta dental', 'Paciente en buen estado', 2, 2, '2026-05-07 14:59:38', '2026-05-07 14:59:38', 4, NULL, NULL, 'Consulta dental', 'Paciente en buen estado', 2),
(5, 5, '2026-05-12 14:59:38', 'Consulta dental', 'Paciente en buen estado', 2, 2, '2026-05-07 14:59:38', '2026-05-07 14:59:38', 5, NULL, NULL, 'Consulta dental', 'Paciente en buen estado', 2),
(6, 6, '2026-05-13 14:59:38', 'Consulta dental', 'Paciente en buen estado', 2, 2, '2026-05-07 14:59:38', '2026-05-07 14:59:38', 6, NULL, NULL, 'Consulta dental', 'Paciente en buen estado', 2),
(7, 7, '2026-05-14 14:59:38', 'Consulta dental', 'Paciente en buen estado', 2, 2, '2026-05-07 14:59:38', '2026-05-07 14:59:38', 7, NULL, NULL, 'Consulta dental', 'Paciente en buen estado', 2),
(8, 8, '2026-05-15 14:59:38', 'Consulta dental', 'Paciente en buen estado', 2, 2, '2026-05-07 14:59:38', '2026-05-07 14:59:38', 8, NULL, NULL, 'Consulta dental', 'Paciente en buen estado', 2),
(9, 9, '2026-05-16 14:59:38', 'Consulta dental', 'Paciente en buen estado', 2, 2, '2026-05-07 14:59:38', '2026-05-07 14:59:38', 9, NULL, NULL, 'Consulta dental', 'Paciente en buen estado', 2),
(10, 10, '2026-05-17 14:59:38', 'Consulta dental', 'Paciente en buen estado', 2, 2, '2026-05-07 14:59:38', '2026-05-07 14:59:38', 10, NULL, NULL, 'Consulta dental', 'Paciente en buen estado', 2);

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
  ADD KEY `fk_paciente_cita` (`IdPaciente`) USING BTREE;

--
-- Indices de la tabla `tba_costo`
--
ALTER TABLE `tba_costo`
  ADD PRIMARY KEY (`IdCosto`) USING BTREE,
  ADD KEY `fk_centrocostos_costo` (`IdCentroCostos`) USING BTREE;

--
-- Indices de la tabla `tba_cotizacion`
--
ALTER TABLE `tba_cotizacion`
  ADD PRIMARY KEY (`IdCotizacion`) USING BTREE,
  ADD KEY `fk_paciente_cotizacion` (`IdPaciente`) USING BTREE;

--
-- Indices de la tabla `tba_detallecosto`
--
ALTER TABLE `tba_detallecosto`
  ADD PRIMARY KEY (`IdDetalleCosto`) USING BTREE,
  ADD KEY `fk_costo_detallecosto` (`IdCosto`) USING BTREE,
  ADD KEY `fk_gasto_detallecosto` (`IdGasto`) USING BTREE,
  ADD KEY `fk_socio_detallecosto` (`IdSocio`);

--
-- Indices de la tabla `tba_detallecotizacion`
--
ALTER TABLE `tba_detallecotizacion`
  ADD PRIMARY KEY (`IdDetalleCotizacion`) USING BTREE,
  ADD KEY `fk_cotizacion_detallecotizacion` (`IdCotizacion`) USING BTREE,
  ADD KEY `fk_procedimiento_detallecotizacion` (`IdProcedimiento`) USING BTREE;

--
-- Indices de la tabla `tba_detallehistoriaclinica`
--
ALTER TABLE `tba_detallehistoriaclinica`
  ADD PRIMARY KEY (`IdDetalleHistoriaClinica`) USING BTREE,
  ADD KEY `fk_historiaclinica_detallehistoria` (`IdHistoriaClinica`) USING BTREE,
  ADD KEY `fk_tratamiento_detallehistoria` (`IdTratamiento`) USING BTREE;

--
-- Indices de la tabla `tba_detalletratamiento`
--
ALTER TABLE `tba_detalletratamiento`
  ADD PRIMARY KEY (`IdDetalleTratamiento`) USING BTREE,
  ADD KEY `fk_tratamiento_detalletratamiento` (`IdTratamiento`) USING BTREE,
  ADD KEY `fk_procedimiento_detalletratamiento` (`IdProcedimiento`) USING BTREE;

--
-- Indices de la tabla `tba_gasto`
--
ALTER TABLE `tba_gasto`
  ADD PRIMARY KEY (`IdGasto`) USING BTREE,
  ADD KEY `fk_centrocostos_gasto` (`IdCentroCostos`) USING BTREE;

--
-- Indices de la tabla `tba_historiaclinica`
--
ALTER TABLE `tba_historiaclinica`
  ADD PRIMARY KEY (`IdHistoriaClinica`) USING BTREE,
  ADD KEY `fk_paciente_historia` (`IdPaciente`) USING BTREE;

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
  ADD KEY `fk_paciente_pago` (`IdPaciente`) USING BTREE,
  ADD KEY `fk_tipopago_pago` (`IdTipoPago`) USING BTREE;

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
  ADD KEY `fk_historiaclinica_tratamiento` (`IdHistoriaClinica`) USING BTREE;

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
  ADD KEY `fk_paciente_visita` (`IdPaciente`) USING BTREE,
  ADD KEY `idx_visita_historia` (`IdHistoriaClinica`),
  ADD KEY `idx_visita_detalletratamiento` (`IdDetalleTratamiento`),
  ADD KEY `idx_visita_pago` (`IdPago`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `tba_centrocostos`
--
ALTER TABLE `tba_centrocostos`
  MODIFY `IdCentroCostos` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `tba_cita`
--
ALTER TABLE `tba_cita`
  MODIFY `IdCita` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `tba_costo`
--
ALTER TABLE `tba_costo`
  MODIFY `IdCosto` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT de la tabla `tba_cotizacion`
--
ALTER TABLE `tba_cotizacion`
  MODIFY `IdCotizacion` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `tba_detallecosto`
--
ALTER TABLE `tba_detallecosto`
  MODIFY `IdDetalleCosto` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=103;

--
-- AUTO_INCREMENT de la tabla `tba_detallecotizacion`
--
ALTER TABLE `tba_detallecotizacion`
  MODIFY `IdDetalleCotizacion` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `tba_detallehistoriaclinica`
--
ALTER TABLE `tba_detallehistoriaclinica`
  MODIFY `IdDetalleHistoriaClinica` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `tba_detalletratamiento`
--
ALTER TABLE `tba_detalletratamiento`
  MODIFY `IdDetalleTratamiento` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `tba_gasto`
--
ALTER TABLE `tba_gasto`
  MODIFY `IdGasto` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT de la tabla `tba_historiaclinica`
--
ALTER TABLE `tba_historiaclinica`
  MODIFY `IdHistoriaClinica` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `tba_paciente`
--
ALTER TABLE `tba_paciente`
  MODIFY `IdPaciente` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `tba_pago`
--
ALTER TABLE `tba_pago`
  MODIFY `IdPago` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `tba_perfilusuario`
--
ALTER TABLE `tba_perfilusuario`
  MODIFY `IdPerfilUsuario` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `tba_procedimiento`
--
ALTER TABLE `tba_procedimiento`
  MODIFY `IdProcedimiento` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `tba_socio`
--
ALTER TABLE `tba_socio`
  MODIFY `IdSocio` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `tba_tipodepago`
--
ALTER TABLE `tba_tipodepago`
  MODIFY `IdTipoPago` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `tba_tipoidentificacion`
--
ALTER TABLE `tba_tipoidentificacion`
  MODIFY `IdTipoIdentificacion` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `tba_tipoprocedimiento`
--
ALTER TABLE `tba_tipoprocedimiento`
  MODIFY `IdTipoProcedimiento` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `tba_tiposocio`
--
ALTER TABLE `tba_tiposocio`
  MODIFY `IdTipoSocio` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `tba_tratamiento`
--
ALTER TABLE `tba_tratamiento`
  MODIFY `IdTratamiento` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `tba_usuario`
--
ALTER TABLE `tba_usuario`
  MODIFY `IdUsuario` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `tba_visita`
--
ALTER TABLE `tba_visita`
  MODIFY `IdVisita` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `tba_cita`
--
ALTER TABLE `tba_cita`
  ADD CONSTRAINT `fk_paciente_cita` FOREIGN KEY (`IdPaciente`) REFERENCES `tba_paciente` (`IdPaciente`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Filtros para la tabla `tba_costo`
--
ALTER TABLE `tba_costo`
  ADD CONSTRAINT `fk_centrocostos_costo` FOREIGN KEY (`IdCentroCostos`) REFERENCES `tba_centrocostos` (`IdCentroCostos`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Filtros para la tabla `tba_cotizacion`
--
ALTER TABLE `tba_cotizacion`
  ADD CONSTRAINT `fk_paciente_cotizacion` FOREIGN KEY (`IdPaciente`) REFERENCES `tba_paciente` (`IdPaciente`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Filtros para la tabla `tba_detallecosto`
--
ALTER TABLE `tba_detallecosto`
  ADD CONSTRAINT `fk_costo_detallecosto` FOREIGN KEY (`IdCosto`) REFERENCES `tba_costo` (`IdCosto`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `fk_gasto_detallecosto` FOREIGN KEY (`IdGasto`) REFERENCES `tba_gasto` (`IdGasto`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `fk_socio_detallecosto` FOREIGN KEY (`IdSocio`) REFERENCES `tba_socio` (`IdSocio`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Filtros para la tabla `tba_detallecotizacion`
--
ALTER TABLE `tba_detallecotizacion`
  ADD CONSTRAINT `fk_cotizacion_detallecotizacion` FOREIGN KEY (`IdCotizacion`) REFERENCES `tba_cotizacion` (`IdCotizacion`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `fk_procedimiento_detallecotizacion` FOREIGN KEY (`IdProcedimiento`) REFERENCES `tba_procedimiento` (`IdProcedimiento`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Filtros para la tabla `tba_detallehistoriaclinica`
--
ALTER TABLE `tba_detallehistoriaclinica`
  ADD CONSTRAINT `fk_historiaclinica_detallehistoria` FOREIGN KEY (`IdHistoriaClinica`) REFERENCES `tba_historiaclinica` (`IdHistoriaClinica`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Filtros para la tabla `tba_detalletratamiento`
--
ALTER TABLE `tba_detalletratamiento`
  ADD CONSTRAINT `fk_procedimiento_detalletratamiento` FOREIGN KEY (`IdProcedimiento`) REFERENCES `tba_procedimiento` (`IdProcedimiento`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `fk_tratamiento_detalletratamiento` FOREIGN KEY (`IdTratamiento`) REFERENCES `tba_tratamiento` (`IdTratamiento`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Filtros para la tabla `tba_gasto`
--
ALTER TABLE `tba_gasto`
  ADD CONSTRAINT `fk_centrocostos_gasto` FOREIGN KEY (`IdCentroCostos`) REFERENCES `tba_centrocostos` (`IdCentroCostos`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Filtros para la tabla `tba_historiaclinica`
--
ALTER TABLE `tba_historiaclinica`
  ADD CONSTRAINT `fk_paciente_historia` FOREIGN KEY (`IdPaciente`) REFERENCES `tba_paciente` (`IdPaciente`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Filtros para la tabla `tba_pago`
--
ALTER TABLE `tba_pago`
  ADD CONSTRAINT `fk_paciente_pago` FOREIGN KEY (`IdPaciente`) REFERENCES `tba_paciente` (`IdPaciente`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `fk_tipopago_pago` FOREIGN KEY (`IdTipoPago`) REFERENCES `tba_tipodepago` (`IdTipoPago`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Filtros para la tabla `tba_procedimiento`
--
ALTER TABLE `tba_procedimiento`
  ADD CONSTRAINT `fk_tipoprocedimiento_procedimiento` FOREIGN KEY (`IdTipoProcedimiento`) REFERENCES `tba_tipoprocedimiento` (`IdTipoProcedimiento`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Filtros para la tabla `tba_socio`
--
ALTER TABLE `tba_socio`
  ADD CONSTRAINT `tba_socio_fksocios` FOREIGN KEY (`IdTipoIdentificacion`) REFERENCES `tba_tipoidentificacion` (`IdTipoIdentificacion`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `tba_socio_fktiposocio` FOREIGN KEY (`IdTipoSocio`) REFERENCES `tba_tiposocio` (`IdTipoSocio`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Filtros para la tabla `tba_tratamiento`
--
ALTER TABLE `tba_tratamiento`
  ADD CONSTRAINT `fk_historiaclinica_tratamiento` FOREIGN KEY (`IdHistoriaClinica`) REFERENCES `tba_historiaclinica` (`IdHistoriaClinica`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Filtros para la tabla `tba_usuario`
--
ALTER TABLE `tba_usuario`
  ADD CONSTRAINT `tba_usuario_fkPerfilUsuario` FOREIGN KEY (`IdPerfilUsuario`) REFERENCES `tba_perfilusuario` (`IdPerfilUsuario`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Filtros para la tabla `tba_visita`
--
ALTER TABLE `tba_visita`
  ADD CONSTRAINT `fk_paciente_visita` FOREIGN KEY (`IdPaciente`) REFERENCES `tba_paciente` (`IdPaciente`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `fk_visita_detalletratamiento` FOREIGN KEY (`IdDetalleTratamiento`) REFERENCES `tba_detalletratamiento` (`IdDetalleTratamiento`) ON DELETE SET NULL ON UPDATE RESTRICT,
  ADD CONSTRAINT `fk_visita_historiaclinica` FOREIGN KEY (`IdHistoriaClinica`) REFERENCES `tba_historiaclinica` (`IdHistoriaClinica`) ON DELETE SET NULL ON UPDATE RESTRICT,
  ADD CONSTRAINT `fk_visita_pago` FOREIGN KEY (`IdPago`) REFERENCES `tba_pago` (`IdPago`) ON DELETE SET NULL ON UPDATE RESTRICT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

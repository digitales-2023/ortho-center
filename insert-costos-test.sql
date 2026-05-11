-- =====================================================
-- Script: Insertar datos de prueba para Costos y Gastos
-- Base de datos: dev_orthocenter
-- =====================================================

SET FOREIGN_KEY_CHECKS = 0;

-- ========== CENTROS DE COSTOS ==========
INSERT IGNORE INTO `tba_centrocostos` (`IdCentroCostos`, `DescripcionCentro`, `FechaCreacion`, `FechaActualizacion`) VALUES
(1, 'Servicios Generales', NOW(), NOW()),
(2, 'Costos de Laboratorio', NOW(), NOW()),
(3, 'Costos de Personal', NOW(), NOW()),
(4, 'Costos de Insumos', NOW(), NOW());

-- ========== GASTOS (por Centro de Costos) ==========
-- Servicios Generales (IdCentroCostos = 1)
INSERT IGNORE INTO `tba_gasto` (`IdGasto`, `IdCentroCostos`, `NombreGasto`, `FechaCreacion`, `FechaActualizacion`) VALUES
(1, 1, 'Energía Eléctrica', NOW(), NOW()),
(2, 1, 'Agua y Alcantarillado', NOW(), NOW()),
(3, 1, 'Internet y Telefonía', NOW(), NOW()),
(4, 1, 'Mantenimiento Equipos', NOW(), NOW()),
(5, 1, 'Limpieza y Sanitización', NOW(), NOW());

-- Costos de Laboratorio (IdCentroCostos = 2)
INSERT IGNORE INTO `tba_gasto` (`IdGasto`, `IdCentroCostos`, `NombreGasto`, `FechaCreacion`, `FechaActualizacion`) VALUES
(6, 2, 'Radiografías Digitales', NOW(), NOW()),
(7, 2, 'Reactivos de Laboratorio', NOW(), NOW()),
(8, 2, 'Materiales Desechables', NOW(), NOW()),
(9, 2, 'Mantenimiento Equipos Lab', NOW(), NOW());

-- Costos de Personal (IdCentroCostos = 3)
INSERT IGNORE INTO `tba_gasto` (`IdGasto`, `IdCentroCostos`, `NombreGasto`, `FechaCreacion`, `FechaActualizacion`) VALUES
(10, 3, 'Salarios Médicos', NOW(), NOW()),
(11, 3, 'Salarios Administrativos', NOW(), NOW()),
(12, 3, 'Bonificaciones', NOW(), NOW()),
(13, 3, 'Seguro Médico Personal', NOW(), NOW());

-- Costos de Insumos (IdCentroCostos = 4)
INSERT IGNORE INTO `tba_gasto` (`IdGasto`, `IdCentroCostos`, `NombreGasto`, `FechaCreacion`, `FechaActualizacion`) VALUES
(14, 4, 'Materiales Dentales', NOW(), NOW()),
(15, 4, 'Fármacos y Medicamentos', NOW(), NOW()),
(16, 4, 'Instrumentos Quirúrgicos', NOW(), NOW()),
(17, 4, 'Suministros Oficina', NOW(), NOW());

-- ========== COSTOS (Cabeceras por mes) ==========
-- Enero 2026
INSERT IGNORE INTO `tba_costo` (`IdCosto`, `IdCentroCostos`, `MesCosto`, `TotalCosto`, `EstadoCosto`, `UsuarioCreado`, `UsuarioActualiza`, `FechaCreacion`, `FechaActualizacion`) VALUES
(1, 1, '01-2026', 2500.00, 1, 1, 1, '2026-01-15 10:00:00', NOW()),
(2, 2, '01-2026', 1850.50, 1, 1, 1, '2026-01-15 10:00:00', NOW()),
(3, 3, '01-2026', 8500.00, 1, 1, 1, '2026-01-15 10:00:00', NOW()),
(4, 4, '01-2026', 3200.75, 1, 1, 1, '2026-01-15 10:00:00', NOW());

-- Febrero 2026
INSERT IGNORE INTO `tba_costo` (`IdCosto`, `IdCentroCostos`, `MesCosto`, `TotalCosto`, `EstadoCosto`, `UsuarioCreado`, `UsuarioActualiza`, `FechaCreacion`, `FechaActualizacion`) VALUES
(5, 1, '02-2026', 2650.00, 1, 1, 1, '2026-02-15 10:00:00', NOW()),
(6, 2, '02-2026', 2100.25, 1, 1, 1, '2026-02-15 10:00:00', NOW()),
(7, 3, '02-2026', 8750.00, 1, 1, 1, '2026-02-15 10:00:00', NOW()),
(8, 4, '02-2026', 3450.50, 1, 1, 1, '2026-02-15 10:00:00', NOW());

-- Marzo 2026
INSERT IGNORE INTO `tba_costo` (`IdCosto`, `IdCentroCostos`, `MesCosto`, `TotalCosto`, `EstadoCosto`, `UsuarioCreado`, `UsuarioActualiza`, `FechaCreacion`, `FechaActualizacion`) VALUES
(9, 1, '03-2026', 2400.00, 1, 1, 1, '2026-03-15 10:00:00', NOW()),
(10, 2, '03-2026', 1950.75, 1, 1, 1, '2026-03-15 10:00:00', NOW()),
(11, 3, '03-2026', 9000.00, 1, 1, 1, '2026-03-15 10:00:00', NOW()),
(12, 4, '03-2026', 3100.00, 1, 1, 1, '2026-03-15 10:00:00', NOW());

-- Abril 2026
INSERT IGNORE INTO `tba_costo` (`IdCosto`, `IdCentroCostos`, `MesCosto`, `TotalCosto`, `EstadoCosto`, `UsuarioCreado`, `UsuarioActualiza`, `FechaCreacion`, `FechaActualizacion`) VALUES
(13, 1, '04-2026', 2750.00, 1, 1, 1, '2026-04-15 10:00:00', NOW()),
(14, 2, '04-2026', 2250.50, 1, 1, 1, '2026-04-15 10:00:00', NOW()),
(15, 3, '04-2026', 8900.00, 1, 1, 1, '2026-04-15 10:00:00', NOW()),
(16, 4, '04-2026', 3600.25, 1, 1, 1, '2026-04-15 10:00:00', NOW());

-- Mayo 2026 (actual)
INSERT IGNORE INTO `tba_costo` (`IdCosto`, `IdCentroCostos`, `MesCosto`, `TotalCosto`, `EstadoCosto`, `UsuarioCreado`, `UsuarioActualiza`, `FechaCreacion`, `FechaActualizacion`) VALUES
(17, 1, '05-2026', 2800.00, 1, 1, 1, '2026-05-09 10:00:00', NOW()),
(18, 2, '05-2026', 2100.00, 1, 1, 1, '2026-05-09 10:00:00', NOW()),
(19, 3, '05-2026', 8600.00, 1, 1, 1, '2026-05-09 10:00:00', NOW()),
(20, 4, '05-2026', 3350.75, 1, 1, 1, '2026-05-09 10:00:00', NOW());

-- Junio 2026
INSERT IGNORE INTO `tba_costo` (`IdCosto`, `IdCentroCostos`, `MesCosto`, `TotalCosto`, `EstadoCosto`, `UsuarioCreado`, `UsuarioActualiza`, `FechaCreacion`, `FechaActualizacion`) VALUES
(21, 1, '06-2026', 2600.00, 1, 1, 1, '2026-06-09 10:00:00', NOW()),
(22, 2, '06-2026', 2050.00, 1, 1, 1, '2026-06-09 10:00:00', NOW()),
(23, 3, '06-2026', 8450.00, 1, 1, 1, '2026-06-09 10:00:00', NOW()),
(24, 4, '06-2026', 3250.50, 1, 1, 1, '2026-06-09 10:00:00', NOW());

-- ========== DETALLE DE COSTOS (Gastos específicos) ==========
-- Enero 2026 - Servicios Generales
INSERT IGNORE INTO `tba_detallecosto` (`IdDetalleCosto`, `IdCosto`, `IdGasto`, `NumeroDocumento`, `ObservacionGasto`, `FechaCosto`, `PrecioGasto`) VALUES
(1, 1, 1, 'FAC-001', 'Recibo de energía eléctrica mes de enero', '2026-01-31', 800.00),
(2, 1, 2, 'FAC-002', 'Agua y alcantarillado', '2026-01-31', 300.00),
(3, 1, 3, 'FAC-003', 'Servicio de internet y telefonía', '2026-01-31', 500.00),
(4, 1, 4, 'FAC-004', 'Mantenimiento preventivo equipos', '2026-01-25', 600.00),
(5, 1, 5, 'FAC-005', 'Servicio de limpieza', '2026-01-28', 300.00);

-- Enero 2026 - Costos de Laboratorio
INSERT IGNORE INTO `tba_detallecosto` (`IdDetalleCosto`, `IdCosto`, `IdGasto`, `NumeroDocumento`, `ObservacionGasto`, `FechaCosto`, `PrecioGasto`) VALUES
(6, 2, 6, 'FAC-006', 'Radiografías digitales enero', '2026-01-31', 600.00),
(7, 2, 7, 'FAC-007', 'Reactivos de laboratorio', '2026-01-28', 450.50),
(8, 2, 8, 'FAC-008', 'Materiales desechables', '2026-01-30', 500.00),
(9, 2, 9, 'FAC-009', 'Calibración equipos laboratorio', '2026-01-25', 300.00);

-- Enero 2026 - Costos de Personal
INSERT IGNORE INTO `tba_detallecosto` (`IdDetalleCosto`, `IdCosto`, `IdGasto`, `NumeroDocumento`, `ObservacionGasto`, `FechaCosto`, `PrecioGasto`) VALUES
(10, 3, 10, 'ROL-001', 'Salarios médicos', '2026-01-31', 5500.00),
(11, 3, 11, 'ROL-001', 'Salarios administrativos', '2026-01-31', 2000.00),
(12, 3, 12, 'BON-001', 'Bonificación enero', '2026-01-31', 500.00),
(13, 3, 13, 'SEG-001', 'Seguro médico personal', '2026-01-31', 500.00);

-- Enero 2026 - Costos de Insumos
INSERT IGNORE INTO `tba_detallecosto` (`IdDetalleCosto`, `IdCosto`, `IdGasto`, `NumeroDocumento`, `ObservacionGasto`, `FechaCosto`, `PrecioGasto`) VALUES
(14, 4, 14, 'COM-001', 'Resinas y materiales dentales', '2026-01-28', 1200.75),
(15, 4, 15, 'FAC-010', 'Anestésicos y fármacos', '2026-01-30', 800.00),
(16, 4, 16, 'FAC-011', 'Instrumentos quirúrgicos', '2026-01-25', 900.00),
(17, 4, 17, 'FAC-012', 'Suministros de oficina', '2026-01-31', 300.00);

-- Febrero 2026 - Servicios Generales
INSERT IGNORE INTO `tba_detallecosto` (`IdDetalleCosto`, `IdCosto`, `IdGasto`, `NumeroDocumento`, `ObservacionGasto`, `FechaCosto`, `PrecioGasto`) VALUES
(18, 5, 1, 'FAC-013', 'Energía eléctrica febrero', '2026-02-28', 850.00),
(19, 5, 2, 'FAC-014', 'Agua febrero', '2026-02-28', 320.00),
(20, 5, 3, 'FAC-015', 'Internet febrero', '2026-02-28', 500.00),
(21, 5, 4, 'FAC-016', 'Reparación equipos', '2026-02-20', 700.00),
(22, 5, 5, 'FAC-017', 'Limpieza febrero', '2026-02-28', 280.00);

-- Febrero 2026 - Costos de Laboratorio
INSERT IGNORE INTO `tba_detallecosto` (`IdDetalleCosto`, `IdCosto`, `IdGasto`, `NumeroDocumento`, `ObservacionGasto`, `FechaCosto`, `PrecioGasto`) VALUES
(23, 6, 6, 'FAC-018', 'Radiografías febrero', '2026-02-28', 650.00),
(24, 6, 7, 'FAC-019', 'Reactivos febrero', '2026-02-25', 500.25),
(25, 6, 8, 'FAC-020', 'Desechables laboratorio', '2026-02-27', 550.00),
(26, 6, 9, 'FAC-021', 'Mantenimiento equipos', '2026-02-20', 400.00);

-- Febrero 2026 - Costos de Personal
INSERT IGNORE INTO `tba_detallecosto` (`IdDetalleCosto`, `IdCosto`, `IdGasto`, `NumeroDocumento`, `ObservacionGasto`, `FechaCosto`, `PrecioGasto`) VALUES
(27, 7, 10, 'ROL-002', 'Salarios médicos febrero', '2026-02-28', 5750.00),
(28, 7, 11, 'ROL-002', 'Salarios administrativos', '2026-02-28', 2000.00),
(29, 7, 12, 'BON-002', 'Bonificación febrero', '2026-02-28', 500.00),
(30, 7, 13, 'SEG-002', 'Seguro médico', '2026-02-28', 500.00);

-- Febrero 2026 - Costos de Insumos
INSERT IGNORE INTO `tba_detallecosto` (`IdDetalleCosto`, `IdCosto`, `IdGasto`, `NumeroDocumento`, `ObservacionGasto`, `FechaCosto`, `PrecioGasto`) VALUES
(31, 8, 14, 'COM-002', 'Resinas y materiales', '2026-02-27', 1250.50),
(32, 8, 15, 'FAC-022', 'Fármacos febrero', '2026-02-28', 850.00),
(33, 8, 16, 'FAC-023', 'Instrumentos', '2026-02-25', 950.00),
(34, 8, 17, 'FAC-024', 'Suministros', '2026-02-28', 400.00);

-- Marzo 2026 - Todos los centros (datos resumidos)
INSERT IGNORE INTO `tba_detallecosto` (`IdDetalleCosto`, `IdCosto`, `IdGasto`, `NumeroDocumento`, `ObservacionGasto`, `FechaCosto`, `PrecioGasto`) VALUES
(35, 9, 1, 'FAC-025', 'Energía marzo', '2026-03-31', 800.00),
(36, 9, 2, 'FAC-026', 'Agua marzo', '2026-03-31', 300.00),
(37, 9, 3, 'FAC-027', 'Internet marzo', '2026-03-31', 500.00),
(38, 9, 4, 'FAC-028', 'Mantenimiento', '2026-03-25', 500.00),
(39, 9, 5, 'FAC-029', 'Limpieza', '2026-03-31', 300.00);

-- Marzo 2026 - Lab
INSERT IGNORE INTO `tba_detallecosto` (`IdDetalleCosto`, `IdCosto`, `IdGasto`, `NumeroDocumento`, `ObservacionGasto`, `FechaCosto`, `PrecioGasto`) VALUES
(40, 10, 6, 'FAC-030', 'Radiografías', '2026-03-31', 600.75),
(41, 10, 7, 'FAC-031', 'Reactivos', '2026-03-28', 450.00),
(42, 10, 8, 'FAC-032', 'Desechables', '2026-03-30', 500.00),
(43, 10, 9, 'FAC-033', 'Mantenimiento', '2026-03-20', 400.00);

-- Marzo 2026 - Personal
INSERT IGNORE INTO `tba_detallecosto` (`IdDetalleCosto`, `IdCosto`, `IdGasto`, `NumeroDocumento`, `ObservacionGasto`, `FechaCosto`, `PrecioGasto`) VALUES
(44, 11, 10, 'ROL-003', 'Salarios médicos', '2026-03-31', 6000.00),
(45, 11, 11, 'ROL-003', 'Salarios administrativos', '2026-03-31', 2000.00),
(46, 11, 12, 'BON-003', 'Bonificación', '2026-03-31', 500.00),
(47, 11, 13, 'SEG-003', 'Seguro', '2026-03-31', 500.00);

-- Marzo 2026 - Insumos
INSERT IGNORE INTO `tba_detallecosto` (`IdDetalleCosto`, `IdCosto`, `IdGasto`, `NumeroDocumento`, `ObservacionGasto`, `FechaCosto`, `PrecioGasto`) VALUES
(48, 12, 14, 'COM-003', 'Materiales', '2026-03-28', 1200.00),
(49, 12, 15, 'FAC-034', 'Fármacos', '2026-03-30', 800.00),
(50, 12, 16, 'FAC-035', 'Instrumentos', '2026-03-25', 900.00),
(51, 12, 17, 'FAC-036', 'Suministros', '2026-03-31', 200.00);

-- Abril 2026 (similar pattern, variaciones)
INSERT IGNORE INTO `tba_detallecosto` (`IdDetalleCosto`, `IdCosto`, `IdGasto`, `NumeroDocumento`, `ObservacionGasto`, `FechaCosto`, `PrecioGasto`) VALUES
(52, 13, 1, 'FAC-037', 'Energía abril', '2026-04-30', 850.00),
(53, 13, 2, 'FAC-038', 'Agua', '2026-04-30', 320.00),
(54, 13, 3, 'FAC-039', 'Internet', '2026-04-30', 500.00),
(55, 13, 4, 'FAC-040', 'Reparación', '2026-04-25', 700.00),
(56, 13, 5, 'FAC-041', 'Limpieza', '2026-04-30', 380.00);

INSERT IGNORE INTO `tba_detallecosto` (`IdDetalleCosto`, `IdCosto`, `IdGasto`, `NumeroDocumento`, `ObservacionGasto`, `FechaCosto`, `PrecioGasto`) VALUES
(57, 14, 6, 'FAC-042', 'Radiografías', '2026-04-30', 700.00),
(58, 14, 7, 'FAC-043', 'Reactivos', '2026-04-28', 500.50),
(59, 14, 8, 'FAC-044', 'Desechables', '2026-04-29', 550.00),
(60, 14, 9, 'FAC-045', 'Mantenimiento', '2026-04-22', 500.00);

INSERT IGNORE INTO `tba_detallecosto` (`IdDetalleCosto`, `IdCosto`, `IdGasto`, `NumeroDocumento`, `ObservacionGasto`, `FechaCosto`, `PrecioGasto`) VALUES
(61, 15, 10, 'ROL-004', 'Salarios médicos', '2026-04-30', 5900.00),
(62, 15, 11, 'ROL-004', 'Administrativos', '2026-04-30', 2000.00),
(63, 15, 12, 'BON-004', 'Bonificación', '2026-04-30', 500.00),
(64, 15, 13, 'SEG-004', 'Seguro', '2026-04-30', 500.00);

INSERT IGNORE INTO `tba_detallecosto` (`IdDetalleCosto`, `IdCosto`, `IdGasto`, `NumeroDocumento`, `ObservacionGasto`, `FechaCosto`, `PrecioGasto`) VALUES
(65, 16, 14, 'COM-004', 'Materiales', '2026-04-28', 1300.25),
(66, 16, 15, 'FAC-046', 'Fármacos', '2026-04-29', 850.00),
(67, 16, 16, 'FAC-047', 'Instrumentos', '2026-04-26', 950.00),
(68, 16, 17, 'FAC-048', 'Suministros', '2026-04-30', 500.00);

-- Mayo 2026 (mes actual)
INSERT IGNORE INTO `tba_detallecosto` (`IdDetalleCosto`, `IdCosto`, `IdGasto`, `NumeroDocumento`, `ObservacionGasto`, `FechaCosto`, `PrecioGasto`) VALUES
(69, 17, 1, 'FAC-049', 'Energía mayo', '2026-05-09', 900.00),
(70, 17, 2, 'FAC-050', 'Agua mayo', '2026-05-09', 350.00),
(71, 17, 3, 'FAC-051', 'Internet mayo', '2026-05-09', 500.00),
(72, 17, 4, 'FAC-052', 'Mantenimiento', '2026-05-05', 600.00),
(73, 17, 5, 'FAC-053', 'Limpieza', '2026-05-08', 450.00);

INSERT IGNORE INTO `tba_detallecosto` (`IdDetalleCosto`, `IdCosto`, `IdGasto`, `NumeroDocumento`, `ObservacionGasto`, `FechaCosto`, `PrecioGasto`) VALUES
(74, 18, 6, 'FAC-054', 'Radiografías', '2026-05-09', 650.00),
(75, 18, 7, 'FAC-055', 'Reactivos', '2026-05-08', 450.00),
(76, 18, 8, 'FAC-056', 'Desechables', '2026-05-07', 550.00),
(77, 18, 9, 'FAC-057', 'Mantenimiento', '2026-05-05', 450.00);

INSERT IGNORE INTO `tba_detallecosto` (`IdDetalleCosto`, `IdCosto`, `IdGasto`, `NumeroDocumento`, `ObservacionGasto`, `FechaCosto`, `PrecioGasto`) VALUES
(78, 19, 10, 'ROL-005', 'Salarios médicos', '2026-05-09', 5600.00),
(79, 19, 11, 'ROL-005', 'Administrativos', '2026-05-09', 2000.00),
(80, 19, 12, 'BON-005', 'Bonificación', '2026-05-09', 500.00),
(81, 19, 13, 'SEG-005', 'Seguro', '2026-05-09', 500.00);

INSERT IGNORE INTO `tba_detallecosto` (`IdDetalleCosto`, `IdCosto`, `IdGasto`, `NumeroDocumento`, `ObservacionGasto`, `FechaCosto`, `PrecioGasto`) VALUES
(82, 20, 14, 'COM-005', 'Materiales', '2026-05-08', 1200.75),
(83, 20, 15, 'FAC-058', 'Fármacos', '2026-05-07', 800.00),
(84, 20, 16, 'FAC-059', 'Instrumentos', '2026-05-06', 900.00),
(85, 20, 17, 'FAC-060', 'Suministros', '2026-05-09', 450.00);

-- Junio 2026 (proyectado)
INSERT IGNORE INTO `tba_detallecosto` (`IdDetalleCosto`, `IdCosto`, `IdGasto`, `NumeroDocumento`, `ObservacionGasto`, `FechaCosto`, `PrecioGasto`) VALUES
(86, 21, 1, 'FAC-061', 'Energía junio', '2026-06-09', 800.00),
(87, 21, 2, 'FAC-062', 'Agua', '2026-06-09', 300.00),
(88, 21, 3, 'FAC-063', 'Internet', '2026-06-09', 500.00),
(89, 21, 4, 'FAC-064', 'Mantenimiento', '2026-06-05', 550.00),
(90, 21, 5, 'FAC-065', 'Limpieza', '2026-06-08', 450.00);

INSERT IGNORE INTO `tba_detallecosto` (`IdDetalleCosto`, `IdCosto`, `IdGasto`, `NumeroDocumento`, `ObservacionGasto`, `FechaCosto`, `PrecioGasto`) VALUES
(91, 22, 6, 'FAC-066', 'Radiografías', '2026-06-09', 600.00),
(92, 22, 7, 'FAC-067', 'Reactivos', '2026-06-08', 450.00),
(93, 22, 8, 'FAC-068', 'Desechables', '2026-06-07', 500.00),
(94, 22, 9, 'FAC-069', 'Mantenimiento', '2026-06-05', 500.00);

INSERT IGNORE INTO `tba_detallecosto` (`IdDetalleCosto`, `IdCosto`, `IdGasto`, `NumeroDocumento`, `ObservacionGasto`, `FechaCosto`, `PrecioGasto`) VALUES
(95, 23, 10, 'ROL-006', 'Salarios médicos', '2026-06-09', 5500.00),
(96, 23, 11, 'ROL-006', 'Administrativos', '2026-06-09', 2000.00),
(97, 23, 12, 'BON-006', 'Bonificación', '2026-06-09', 500.00),
(98, 23, 13, 'SEG-006', 'Seguro', '2026-06-09', 450.00);

INSERT IGNORE INTO `tba_detallecosto` (`IdDetalleCosto`, `IdCosto`, `IdGasto`, `NumeroDocumento`, `ObservacionGasto`, `FechaCosto`, `PrecioGasto`) VALUES
(99, 24, 14, 'COM-006', 'Materiales', '2026-06-08', 1150.50),
(100, 24, 15, 'FAC-070', 'Fármacos', '2026-06-07', 750.00),
(101, 24, 16, 'FAC-071', 'Instrumentos', '2026-06-06', 900.00),
(102, 24, 17, 'FAC-072', 'Suministros', '2026-06-09', 500.00);

SET FOREIGN_KEY_CHECKS = 1;

-- Verificar datos insertados
SELECT 'CENTROS DE COSTOS' as Resultado;
SELECT COUNT(*) as Total FROM tba_centrocostos;

SELECT 'GASTOS' as Resultado;
SELECT COUNT(*) as Total FROM tba_gasto;

SELECT 'COSTOS CABECERA' as Resultado;
SELECT COUNT(*) as Total FROM tba_costo;

SELECT 'DETALLES DE COSTOS' as Resultado;
SELECT COUNT(*) as Total FROM tba_detallecosto;

SELECT 'RESUMEN POR MES' as Resultado;
SELECT MesCosto, SUM(TotalCosto) as TotalMes FROM tba_costo GROUP BY MesCosto ORDER BY MesCosto;

SELECT 'RESUMEN POR CENTRO' as Resultado;
SELECT c.DescripcionCentro, SUM(co.TotalCosto) as Total FROM tba_costo co 
INNER JOIN tba_centrocostos c ON co.IdCentroCostos = c.IdCentroCostos 
GROUP BY c.IdCentroCostos, c.DescripcionCentro ORDER BY Total DESC;

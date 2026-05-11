-- ===================================
-- INSERTAR DATOS DE PRUEBA
-- ===================================
USE dev_orthocenter;

-- ===================================
-- 1. USUARIOS (3 total: Admin + Dentista + Recepcionista)
-- ===================================
INSERT INTO `tba_usuario` (`IdUsuario`, `IdPerfilUsuario`, `NombreUsuario`, `CorreoUsuario`, `PasswordUsuario`, `FechaCreacion`, `FechaActualizacion`) 
VALUES 
(2, 2, 'Dr. Martinez', 'dr.martinez@orthocenter.pe', '$2a$07$usesomesillystringfore2uDLvp1Ii2e./U9C8sBjqp8I90dH6hi', NOW(), NOW()),
(3, 3, 'Recepcionista Ana', 'ana.recepcion@orthocenter.pe', '$2a$07$usesomesillystringfore2uDLvp1Ii2e./U9C8sBjqp8I90dH6hi', NOW(), NOW());

-- ===================================
-- 2. CENTROS DE COSTOS (3 registros)
-- ===================================
INSERT INTO `tba_centrocostos` (`IdCentroCostos`, `DescripcionCentro`, `FechaCreacion`, `FechaActualizacion`) 
VALUES 
(1, 'Centro Administrativo', NOW(), NOW()),
(2, 'Centro Operativo Dental', NOW(), NOW()),
(3, 'Centro de Servicios', NOW(), NOW());

-- ===================================
-- 3. GASTOS (10 registros)
-- ===================================
INSERT INTO `tba_gasto` (`IdGasto`, `IdCentroCostos`, `NombreGasto`, `FechaCreacion`, `FechaActualizacion`) 
VALUES 
(1, 1, 'Servicios Básicos - Agua', NOW(), NOW()),
(2, 1, 'Servicios Básicos - Luz', NOW(), NOW()),
(3, 1, 'Servicios Básicos - Internet', NOW(), NOW()),
(4, 2, 'Materiales Dentales - Composite', NOW(), NOW()),
(5, 2, 'Materiales Dentales - Amalgama', NOW(), NOW()),
(6, 2, 'Instrumentos Dentales', NOW(), NOW()),
(7, 3, 'Limpieza y Mantenimiento', NOW(), NOW()),
(8, 3, 'Seguridad', NOW(), NOW()),
(9, 1, 'Suministros de Oficina', NOW(), NOW()),
(10, 2, 'Esterilización de Equipos', NOW(), NOW());

-- ===================================
-- 4. TIPOS DE PAGO (6 registros)
-- ===================================
INSERT INTO `tba_tipodepago` (`IdTipoPago`, `DescripcionTipo`, `FechaCreacion`, `FechaActualizacion`)
VALUES 
(1, 'Efectivo', NOW(), NOW()),
(2, 'Tarjeta Débito', NOW(), NOW()),
(3, 'Tarjeta Crédito', NOW(), NOW()),
(4, 'Transferencia', NOW(), NOW()),
(5, 'Cheque', NOW(), NOW()),
(6, 'Otro', NOW(), NOW());

-- ===================================
-- 5. TIPOS DE PROCEDIMIENTO (5 registros)
-- ===================================
INSERT INTO `tba_tipoprocedimiento` (`IdTipoProcedimiento`, `NombreTipoProcedimiento`)
VALUES 
(1, 'Operatoria'),
(2, 'Endodoncia'),
(3, 'Periodoncia'),
(4, 'Ortodoncia'),
(5, 'Cirugía');

-- ===================================
-- 6. PROCEDIMIENTOS (10 registros)
-- ===================================
INSERT INTO `tba_procedimiento` (`IdProcedimiento`, `NombreProcedimiento`, `PrecioPromedio`, `IdTipoProcedimiento`, `FechaCreacion`, `FechaActualizacion`)
VALUES 
(1, 'Limpieza Dental', 150.00, 1, NOW(), NOW()),
(2, 'Restauración Resina Simple', 250.00, 1, NOW(), NOW()),
(3, 'Restauración Resina Compuesta', 350.00, 1, NOW(), NOW()),
(4, 'Tratamiento Endodóntico', 500.00, 2, NOW(), NOW()),
(5, 'Endodoncia Completa', 800.00, 2, NOW(), NOW()),
(6, 'Destartaje Periodontal', 200.00, 3, NOW(), NOW()),
(7, 'Raspado y Alisado Radicular', 400.00, 3, NOW(), NOW()),
(8, 'Colocación de Brackets', 1200.00, 4, NOW(), NOW()),
(9, 'Extracción Dental', 300.00, 5, NOW(), NOW()),
(10, 'Extracción Quirúrgica', 600.00, 5, NOW(), NOW());

-- ===================================
-- 7. PACIENTES (10 registros)
-- ===================================
INSERT INTO `tba_paciente` (`IdPaciente`, `NombrePaciente`, `ApellidoPaciente`, `TipoIdentificacion`, `NumeroIdentificacion`, `SexoPaciente`, `EdadPaciente`, `FechaNacimiento`, `CelularPaciente`, `DomicilioPaciente`, `LugarProcedencia`, `LugarNacimiento`, `GradoInstruccion`, `RazaPaciente`, `OcupacionPaciente`, `ReligionPaciente`, `EstadoCivil`, `FechaCreacion`, `FechaActualizacion`)
VALUES 
(1, 'Juan', 'Perez', 'DNI', '12345678', 'Masculino', '35', '1988-11-15', '987654321', 'Av. Principal 123', 'Lima', 'Lima', 'Superior', 'Mestizo', 'Ingeniero', 'Católico', 'Casado', NOW(), NOW()),
(2, 'Maria', 'Garcia', 'DNI', '23456789', 'Femenino', '28', '1995-03-22', '987654322', 'Calle Los Pinos 456', 'Lima', 'Arequipa', 'Superior', 'Mestizo', 'Abogada', 'Católico', 'Soltera', NOW(), NOW()),
(3, 'Carlos', 'Lopez', 'DNI', '34567890', 'Masculino', '45', '1978-07-10', '987654323', 'Jr. Comercio 789', 'Lima', 'Trujillo', 'Secundaria', 'Mestizo', 'Empresario', 'Católico', 'Casado', NOW(), NOW()),
(4, 'Ana', 'Martinez', 'DNI', '45678901', 'Femenino', '32', '1991-09-05', '987654324', 'Av. Universitaria 321', 'Lima', 'Lima', 'Superior', 'Mestizo', 'Contador', 'Católico', 'Soltera', NOW(), NOW()),
(5, 'Roberto', 'Sanchez', 'DNI', '56789012', 'Masculino', '52', '1971-12-20', '987654325', 'Calle Nueva 654', 'Lima', 'Huancayo', 'Secundaria', 'Mestizo', 'Comerciante', 'Católico', 'Casado', NOW(), NOW()),
(6, 'Lucia', 'Ramirez', 'DNI', '67890123', 'Femenino', '38', '1985-05-14', '987654326', 'Av. Tecnologia 987', 'Lima', 'Lima', 'Superior', 'Mestizo', 'Doctora', 'Católico', 'Casada', NOW(), NOW()),
(7, 'Fernando', 'Torres', 'DNI', '78901234', 'Masculino', '41', '1982-01-30', '987654327', 'Jr. Bolognesi 147', 'Lima', 'Callao', 'Superior', 'Mestizo', 'Profesor', 'Católico', 'Casado', NOW(), NOW()),
(8, 'Patricia', 'Flores', 'DNI', '89012345', 'Femenino', '29', '1994-08-18', '987654328', 'Calle Flores 258', 'Lima', 'Lima', 'Superior', 'Mestizo', 'Psicóloga', 'Católico', 'Soltera', NOW(), NOW()),
(9, 'Miguel', 'Vargas', 'DNI', '90123456', 'Masculino', '55', '1968-06-25', '987654329', 'Av. Principal 369', 'Lima', 'Ica', 'Secundaria', 'Mestizo', 'Jubilado', 'Católico', 'Viudo', NOW(), NOW()),
(10, 'Sofia', 'Quispe', 'DNI', '01234567', 'Femenino', '26', '1997-02-11', '987654330', 'Jr. Independencia 741', 'Lima', 'Cusco', 'Superior', 'Quechua', 'Estudiante', 'Católico', 'Soltera', NOW(), NOW());

-- ===================================
-- 8. CITAS (10 registros)
-- ===================================
INSERT INTO `tba_cita` (`IdCita`, `IdPaciente`, `FechaProgramada`, `MedicoAsignado`, `EstadoCita`, `FechaCreacion`, `FechaActualizacion`)
VALUES 
(1, 1, '2026-05-10 09:00:00', 2, 1, NOW(), NOW()),
(2, 2, '2026-05-11 10:30:00', 2, 1, NOW(), NOW()),
(3, 3, '2026-05-12 14:00:00', 2, 1, NOW(), NOW()),
(4, 4, '2026-05-13 15:30:00', 2, 1, NOW(), NOW()),
(5, 5, '2026-05-14 08:00:00', 2, 1, NOW(), NOW()),
(6, 6, '2026-05-15 11:00:00', 2, 1, NOW(), NOW()),
(7, 7, '2026-05-16 09:30:00', 2, 1, NOW(), NOW()),
(8, 8, '2026-05-17 13:00:00', 2, 1, NOW(), NOW()),
(9, 9, '2026-05-18 10:00:00', 2, 1, NOW(), NOW()),
(10, 10, '2026-05-19 16:00:00', 2, 1, NOW(), NOW());

-- ===================================
-- 9. HISTORIAS CLÍNICAS (10 registros)
-- ===================================
INSERT INTO `tba_historiaclinica` (`IdHistoriaClinica`, `IdPaciente`, `IdSocio`, `AlergiasEncontradas`, `MotivoConsulta`, `DatosInformante`, `TiempoEnfermedad`, `SignosSintomas`, `RelatoCronologico`, `FuncionesBiologicas`, `AntecedentesFamiliares`, `AntecedentesPersonales`, `UsuarioCreado`, `UsuarioActualizado`, `FechaCreado`, `FechaActualiza`)
VALUES 
(1, 1, NULL, 'Penicilina', 'Dolor dental', 'Paciente', '1 semana', 'Dolor agudo', 'Inicio hace 7 días', 'Normales', 'Padre diabético', 'No significativos', 2, 2, NOW(), NOW()),
(2, 2, NULL, 'Ninguna', 'Limpieza dental', 'Paciente', 'N/A', 'Ninguno', 'Revisión rutinaria', 'Normales', 'Madre hipertensa', 'Buena salud', 2, 2, NOW(), NOW()),
(3, 3, NULL, 'Ninguna', 'Caries múltiples', 'Paciente', '6 meses', 'Sensibilidad dental', 'Progresivo', 'Normales', 'No conoce', 'Hipertensión controlada', 2, 2, NOW(), NOW()),
(4, 4, NULL, 'Ninguna', 'Endodoncia', 'Paciente', '2 semanas', 'Dolor persistente', 'Inicio reciente', 'Normales', 'Padre con problemas dentales', 'Alérgica a antibióticos beta-lactámicos', 2, 2, NOW(), NOW()),
(5, 5, NULL, 'Ninguna', 'Extracción dental', 'Paciente', '3 semanas', 'Movilidad dental', 'Gradual', 'Normales', 'Abuela con enfermedad periodontal', 'Fumador', 2, 2, NOW(), NOW()),
(6, 6, NULL, 'Ninguna', 'Blanqueamiento', 'Paciente', 'N/A', 'Ninguno', 'Cuidado estético', 'Normales', 'Buena salud dental familiar', 'Buena salud general', 2, 2, NOW(), NOW()),
(7, 7, NULL, 'Ninguna', 'Tratamiento periodontal', 'Paciente', '4 meses', 'Sangrado de encías', 'Progresivo', 'Normales', 'Padre con periodontitis', 'No controlado', 2, 2, NOW(), NOW()),
(8, 8, NULL, 'Ninguna', 'Ortodoncia inicial', 'Paciente', 'N/A', 'Ninguno', 'Evaluación ortodóntica', 'Normales', 'Madre con aparatos dentales', 'Buena salud', 2, 2, NOW(), NOW()),
(9, 9, NULL, 'Ninguna', 'Múltiples extracciones', 'Paciente', 'Crónico', 'Pérdida ósea', 'Largo plazo', 'Normales', 'No conoce antecedentes', 'Paciente de edad avanzada', 2, 2, NOW(), NOW()),
(10, 10, NULL, 'Ninguna', 'Prevención dental', 'Paciente', 'N/A', 'Ninguno', 'Joven con buen cuidado', 'Normales', 'Buena salud general', 'Estudiante responsable', 2, 2, NOW(), NOW());

-- ===================================
-- 10. TRATAMIENTOS (10 registros)
-- ===================================
INSERT INTO `tba_tratamiento` (`IdTratamiento`, `IdHistoriaClinica`, `IdPaciente`, `TotalTratamiento`, `TotalPagado`, `UsuarioCreado`, `UsuarioActualiza`, `FechaCreacion`, `FechaActualizacion`)
VALUES 
(1, 1, 1, 500.00, 250.00, 2, 2, NOW(), NOW()),
(2, 2, 2, 150.00, 150.00, 2, 2, NOW(), NOW()),
(3, 3, 3, 1000.00, 500.00, 2, 2, NOW(), NOW()),
(4, 4, 4, 800.00, 400.00, 2, 2, NOW(), NOW()),
(5, 5, 5, 600.00, 300.00, 2, 2, NOW(), NOW()),
(6, 6, 6, 400.00, 400.00, 2, 2, NOW(), NOW()),
(7, 7, 7, 1200.00, 600.00, 2, 2, NOW(), NOW()),
(8, 8, 8, 1200.00, 0.00, 2, 2, NOW(), NOW()),
(9, 9, 9, 1800.00, 900.00, 2, 2, NOW(), NOW()),
(10, 10, 10, 300.00, 300.00, 2, 2, NOW(), NOW());

-- ===================================
-- 11. DETALLES DE TRATAMIENTO (10 registros)
-- ===================================
INSERT INTO `tba_detalletratamiento` (`IdDetalleTratamiento`, `IdTratamiento`, `IdProcedimiento`, `EstadoTratamiento`, `MedicoProcedimiento`, `FechaProcedimiento`, `ObservacionProcedimiento`, `PrecioProcedimiento`)
VALUES 
(1, 1, 4, 1, 2, '2026-05-10', 'Endodoncia completada exitosamente', 500.00),
(2, 2, 1, 2, 2, '2026-05-11', 'Limpieza dental de rutina', 150.00),
(3, 3, 2, 1, 2, '2026-05-12', 'Primera restauración', 250.00),
(4, 3, 3, 0, 2, '2026-05-19', 'Segunda restauración pendiente', 350.00),
(5, 4, 4, 2, 2, '2026-05-13', 'Endodoncia en progreso', 400.00),
(6, 5, 9, 1, 2, '2026-05-14', 'Extracción molar', 600.00),
(7, 6, 1, 2, 2, '2026-05-15', 'Limpieza previo a blanqueamiento', 150.00),
(8, 7, 6, 1, 2, '2026-05-16', 'Destartaje periodontal', 400.00),
(9, 8, 8, 0, 2, '2026-06-01', 'Colocación de aparatología', 1200.00),
(10, 9, 10, 1, 2, '2026-05-18', 'Extracción quirúrgica compleja', 1800.00);

-- ===================================
-- 12. COTIZACIONES (10 registros)
-- ===================================
INSERT INTO `tba_cotizacion` (`IdCotizacion`, `IdPaciente`, `TotalCotizacion`, `FechaCotizacion`, `EstadoCotizacion`, `UsuarioCreado`, `UsuarioActualiza`, `FechaCreacion`, `FechaActualizacion`)
VALUES 
(1, 1, 500.00, '2026-05-09', 'Aceptada', 2, 2, NOW(), NOW()),
(2, 2, 150.00, '2026-05-10', 'Aceptada', 2, 2, NOW(), NOW()),
(3, 3, 1000.00, '2026-05-11', 'Pendiente', 2, 2, NOW(), NOW()),
(4, 4, 800.00, '2026-05-12', 'Aceptada', 2, 2, NOW(), NOW()),
(5, 5, 600.00, '2026-05-13', 'Aceptada', 2, 2, NOW(), NOW()),
(6, 6, 400.00, '2026-05-14', 'Aceptada', 2, 2, NOW(), NOW()),
(7, 7, 1200.00, '2026-05-15', 'Pendiente', 2, 2, NOW(), NOW()),
(8, 8, 1200.00, '2026-05-16', 'Rechazada', 2, 2, NOW(), NOW()),
(9, 9, 1800.00, '2026-05-17', 'Aceptada', 2, 2, NOW(), NOW()),
(10, 10, 300.00, '2026-05-18', 'Aceptada', 2, 2, NOW(), NOW());

-- ===================================
-- 13. DETALLES DE COTIZACION (10 registros)
-- ===================================
INSERT INTO `tba_detallecotizacion` (`IdDetalleCotizacion`, `IdCotizacion`, `IdProcedimiento`, `ObservacionProcedimiento`, `CantidadProcedimiento`, `PrecioUnitario`, `TotalProcedimiento`, `UsuarioCreado`, `UsuarioActualiza`, `FechaCreacion`, `FechaActualizacion`)
VALUES 
(1, 1, 4, 'Tratamiento endodóntico', 1, 500.00, 500.00, 2, 2, NOW(), NOW()),
(2, 2, 1, 'Limpieza dental', 1, 150.00, 150.00, 2, 2, NOW(), NOW()),
(3, 3, 2, 'Restauración resina simple', 2, 250.00, 500.00, 2, 2, NOW(), NOW()),
(4, 3, 3, 'Restauración resina compuesta', 1, 350.00, 350.00, 2, 2, NOW(), NOW()),
(5, 4, 4, 'Endodoncia completa', 1, 800.00, 800.00, 2, 2, NOW(), NOW()),
(6, 5, 9, 'Extracción dental', 1, 300.00, 300.00, 2, 2, NOW(), NOW()),
(7, 5, 10, 'Extracción quirúrgica', 1, 300.00, 300.00, 2, 2, NOW(), NOW()),
(8, 6, 1, 'Limpieza + blanqueamiento', 1, 400.00, 400.00, 2, 2, NOW(), NOW()),
(9, 7, 6, 'Destartaje periodontal', 1, 600.00, 600.00, 2, 2, NOW(), NOW()),
(10, 7, 7, 'Raspado y alisado', 1, 600.00, 600.00, 2, 2, NOW(), NOW());

-- ===================================
-- 14. COSTOS (10 registros)
-- ===================================
INSERT INTO `tba_costo` (`IdCosto`, `IdCentroCostos`, `MesCosto`, `TotalCosto`, `EstadoCosto`, `UsuarioCreado`, `UsuarioActualiza`, `FechaCreacion`, `FechaActualizacion`)
VALUES 
(1, 1, 'Mayo 2026', 2500.00, 1, 1, 1, NOW(), NOW()),
(2, 1, 'Abril 2026', 2300.00, 1, 1, 1, NOW(), NOW()),
(3, 2, 'Mayo 2026', 5000.00, 1, 1, 1, NOW(), NOW()),
(4, 2, 'Abril 2026', 4800.00, 1, 1, 1, NOW(), NOW()),
(5, 3, 'Mayo 2026', 1500.00, 1, 1, 1, NOW(), NOW()),
(6, 3, 'Abril 2026', 1400.00, 1, 1, 1, NOW(), NOW()),
(7, 1, 'Marzo 2026', 2200.00, 1, 1, 1, NOW(), NOW()),
(8, 2, 'Marzo 2026', 4600.00, 1, 1, 1, NOW(), NOW()),
(9, 3, 'Marzo 2026', 1300.00, 1, 1, 1, NOW(), NOW()),
(10, 1, 'Junio 2026', 2700.00, 0, 1, 1, NOW(), NOW());

-- ===================================
-- 15. DETALLES DE COSTO (10 registros)
-- ===================================
INSERT INTO `tba_detallecosto` (`IdDetalleCosto`, `IdCosto`, `IdGasto`, `NumeroDocumento`, `ObservacionGasto`, `FechaCosto`, `PrecioGasto`)
VALUES 
(1, 1, 1, 'FACT-2026-001', 'Pago agua mayo', '2026-05-01', 150.00),
(2, 1, 2, 'FACT-2026-002', 'Pago luz mayo', '2026-05-01', 800.00),
(3, 1, 3, 'FACT-2026-003', 'Pago internet mayo', '2026-05-01', 250.00),
(4, 3, 4, 'FACT-2026-004', 'Materiales resina', '2026-05-05', 2000.00),
(5, 3, 5, 'FACT-2026-005', 'Amalgama dental', '2026-05-10', 1500.00),
(6, 3, 6, 'FACT-2026-006', 'Instrumental dental', '2026-05-15', 1500.00),
(7, 5, 7, 'FACT-2026-007', 'Servicios limpieza', '2026-05-20', 800.00),
(8, 5, 8, 'FACT-2026-008', 'Contrato seguridad', '2026-05-01', 700.00),
(9, 2, 9, 'FACT-2026-009', 'Suministros oficina', '2026-04-25', 300.00),
(10, 4, 10, 'FACT-2026-010', 'Esterilización mayo', '2026-05-28', 1800.00);

-- ===================================
-- 16. PAGOS (10 registros)
-- ===================================
INSERT INTO `tba_pago` (`IdPago`, `IdPaciente`, `IdTipoPago`, `TotalPago`, `FechaPago`, `ObservacionPago`, `ComprobantePago`, `FechaCreacion`, `FechaActualizacion`)
VALUES 
(1, 1, 1, 250.00, '2026-05-09', 'Primer pago de tratamiento', 'REC-001', NOW(), NOW()),
(2, 2, 1, 150.00, '2026-05-11', 'Pago completo limpieza', 'REC-002', NOW(), NOW()),
(3, 3, 2, 500.00, '2026-05-12', 'Primer pago con tarjeta', 'REC-003', NOW(), NOW()),
(4, 4, 3, 400.00, '2026-05-13', 'Primer pago crédito', 'REC-004', NOW(), NOW()),
(5, 5, 1, 300.00, '2026-05-14', 'Pago efectivo', 'REC-005', NOW(), NOW()),
(6, 6, 1, 400.00, '2026-05-15', 'Pago completo servicio', 'REC-006', NOW(), NOW()),
(7, 7, 4, 600.00, '2026-05-16', 'Transferencia bancaria', 'REC-007', NOW(), NOW()),
(8, 8, 2, 300.00, '2026-05-17', 'Abono a cuenta', 'REC-008', NOW(), NOW()),
(9, 9, 3, 900.00, '2026-05-18', 'Pago parcial crédito', 'REC-009', NOW(), NOW()),
(10, 10, 1, 300.00, '2026-05-19', 'Pago completo', 'REC-010', NOW(), NOW());

-- ===================================
-- 17. VISITAS (10 registros)
-- ===================================
INSERT INTO `tba_visita` (`IdVisita`, `IdPaciente`, `FechaVisita`, `MotivoPrincipal`, `Notas`, `UsuarioCreado`, `UsuarioActualizado`, `FechaCreacion`, `FechaActualizacion`)
VALUES 
(1, 1, '2026-05-09 09:30:00', 'Evaluación inicial', 'Paciente presenta dolor dental', 2, 2, NOW(), NOW()),
(2, 2, '2026-05-11 10:00:00', 'Limpieza rutinaria', 'Buena salud bucal', 2, 2, NOW(), NOW()),
(3, 3, '2026-05-12 14:00:00', 'Restauración', 'Inicio tratamiento caries', 2, 2, NOW(), NOW()),
(4, 4, '2026-05-13 15:00:00', 'Consulta endodoncia', 'Requiere tratamiento canal', 2, 2, NOW(), NOW()),
(5, 5, '2026-05-14 08:30:00', 'Extracción', 'Extracción exitosa', 2, 2, NOW(), NOW()),
(6, 6, '2026-05-15 11:00:00', 'Blanqueamiento', 'Procedimiento estético', 2, 2, NOW(), NOW()),
(7, 7, '2026-05-16 09:00:00', 'Tratamiento periodontal', 'Enfermedad de encías', 2, 2, NOW(), NOW()),
(8, 8, '2026-05-17 13:30:00', 'Consulta ortodoncia', 'Evaluación inicial aparatos', 2, 2, NOW(), NOW()),
(9, 9, '2026-05-18 10:30:00', 'Seguimiento post-cirugía', 'Recuperación normal', 2, 2, NOW(), NOW()),
(10, 10, '2026-05-19 16:30:00', 'Control preventivo', 'Mantener salud bucal', 2, 2, NOW(), NOW());

<?php
/**
 * Script para insertar datos de prueba completos y coherentes
 * Ejecutar una sola vez
 */

require_once "model/conexion.php";

try {
    $conn = Conexion::conn();
    
    echo "<div style='padding: 20px; background: #f0f8ff; border-radius: 8px; font-family: Arial, sans-serif;'>";
    echo "<h2 style='color: #0066cc; text-align: center;'>🔄 Insertando Datos de Prueba Completos...</h2>";
    
    $inserts = array();
    
    // ===== 1. USUARIOS (3 TOTAL: Admin ya existe, agregar Dentista y Recepcionista) =====
    // El admin (IdUsuario=1) ya existe, agregar los otros 2
    $inserts[] = "INSERT IGNORE INTO `tba_usuario` (`IdUsuario`, `IdPerfilUsuario`, `NombreUsuario`, `CorreoUsuario`, `PasswordUsuario`, `FechaCreacion`, `FechaActualizacion`) VALUES (2, 2, 'Dr. Martinez', 'dr.martinez@orthocenter.pe', '\$2a\$07\$usesomesillystringfore2uDLvp1Ii2e./U9C8sBjqp8I90dH6hi', NOW(), NOW())";
    $inserts[] = "INSERT IGNORE INTO `tba_usuario` (`IdUsuario`, `IdPerfilUsuario`, `NombreUsuario`, `CorreoUsuario`, `PasswordUsuario`, `FechaCreacion`, `FechaActualizacion`) VALUES (3, 3, 'Ana Recepción', 'ana.recepcion@orthocenter.pe', '\$2a\$07\$usesomesillystringfore2uDLvp1Ii2e./U9C8sBjqp8I90dH6hi', NOW(), NOW())";
    
    // ===== 2. CENTROS DE COSTOS =====
    $inserts[] = "INSERT IGNORE INTO `tba_centrocostos` (`IdCentroCostos`, `DescripcionCentro`, `FechaCreacion`, `FechaActualizacion`) VALUES (1, 'Servicios Generales', NOW(), NOW())";
    $inserts[] = "INSERT IGNORE INTO `tba_centrocostos` (`IdCentroCostos`, `DescripcionCentro`, `FechaCreacion`, `FechaActualizacion`) VALUES (3, 'Costos de Laboratorio', NOW(), NOW())";
    $inserts[] = "INSERT IGNORE INTO `tba_centrocostos` (`IdCentroCostos`, `DescripcionCentro`, `FechaCreacion`, `FechaActualizacion`) VALUES (4, 'Costos de Personal', NOW(), NOW())";
    $inserts[] = "INSERT IGNORE INTO `tba_centrocostos` (`IdCentroCostos`, `DescripcionCentro`, `FechaCreacion`, `FechaActualizacion`) VALUES (5, 'Costos de Insumos', NOW(), NOW())";
    
    // ===== 3. GASTOS (10 REGISTROS) =====
    $gastos = array(
        array(1, 1, 'Servicios Básicos - Agua'),
        array(2, 1, 'Servicios Básicos - Luz'),
        array(3, 1, 'Servicios Básicos - Internet'),
        array(4, 3, 'Materiales Dentales - Composite'),
        array(5, 3, 'Materiales Dentales - Amalgama'),
        array(6, 3, 'Instrumentos Dentales'),
        array(7, 4, 'Sueldos Personal'),
        array(8, 5, 'Suministros de Oficina'),
        array(9, 5, 'Limpieza y Mantenimiento'),
        array(10, 5, 'Esterilización de Equipos')
    );
    foreach ($gastos as $g) {
        $inserts[] = "INSERT IGNORE INTO `tba_gasto` (`IdGasto`, `IdCentroCostos`, `NombreGasto`, `FechaCreacion`, `FechaActualizacion`) VALUES ({$g[0]}, {$g[1]}, '{$g[2]}', NOW(), NOW())";
    }
    
    // ===== 4. TIPOS DE PAGO =====
    $inserts[] = "INSERT IGNORE INTO `tba_tipodepago` (`IdTipoPago`, `DescripcionTipo`) VALUES (1, 'Efectivo')";
    $inserts[] = "INSERT IGNORE INTO `tba_tipodepago` (`IdTipoPago`, `DescripcionTipo`) VALUES (2, 'Tarjeta Débito')";
    $inserts[] = "INSERT IGNORE INTO `tba_tipodepago` (`IdTipoPago`, `DescripcionTipo`) VALUES (3, 'Tarjeta Crédito')";
    $inserts[] = "INSERT IGNORE INTO `tba_tipodepago` (`IdTipoPago`, `DescripcionTipo`) VALUES (4, 'Transferencia')";
    $inserts[] = "INSERT IGNORE INTO `tba_tipodepago` (`IdTipoPago`, `DescripcionTipo`) VALUES (5, 'Cheque')";
    $inserts[] = "INSERT IGNORE INTO `tba_tipodepago` (`IdTipoPago`, `DescripcionTipo`) VALUES (6, 'Otro')";
    
    // ===== 5. TIPOS DE PROCEDIMIENTO =====
    $inserts[] = "INSERT IGNORE INTO `tba_tipoprocedimiento` (`IdTipoProcedimiento`, `NombreTipoProcedimiento`) VALUES (1, 'Operatoria')";
    $inserts[] = "INSERT IGNORE INTO `tba_tipoprocedimiento` (`IdTipoProcedimiento`, `NombreTipoProcedimiento`) VALUES (2, 'Endodoncia')";
    $inserts[] = "INSERT IGNORE INTO `tba_tipoprocedimiento` (`IdTipoProcedimiento`, `NombreTipoProcedimiento`) VALUES (3, 'Periodoncia')";
    $inserts[] = "INSERT IGNORE INTO `tba_tipoprocedimiento` (`IdTipoProcedimiento`, `NombreTipoProcedimiento`) VALUES (4, 'Ortodoncia')";
    $inserts[] = "INSERT IGNORE INTO `tba_tipoprocedimiento` (`IdTipoProcedimiento`, `NombreTipoProcedimiento`) VALUES (5, 'Cirugía')";
    
    // ===== 6. PROCEDIMIENTOS (10 REGISTROS) =====
    $procedures = array(
        array(1, 'Limpieza Dental', 150.00, 1),
        array(2, 'Restauración Resina Simple', 250.00, 1),
        array(3, 'Restauración Resina Compuesta', 350.00, 1),
        array(4, 'Tratamiento Endodóntico', 500.00, 2),
        array(5, 'Endodoncia Completa', 800.00, 2),
        array(6, 'Destartaje Periodontal', 200.00, 3),
        array(7, 'Raspado y Alisado Radicular', 400.00, 3),
        array(8, 'Colocación de Brackets', 1200.00, 4),
        array(9, 'Extracción Dental', 300.00, 5),
        array(10, 'Extracción Quirúrgica', 600.00, 5)
    );
    foreach ($procedures as $proc) {
        $inserts[] = "INSERT IGNORE INTO `tba_procedimiento` (`IdProcedimiento`, `NombreProcedimiento`, `PrecioPromedio`, `IdTipoProcedimiento`, `FechaCreacion`, `FechaActualizacion`) VALUES ({$proc[0]}, '{$proc[1]}', {$proc[2]}, {$proc[3]}, NOW(), NOW())";
    }
    
    // ===== 7. PACIENTES (10 REGISTROS) =====
    $patients = array(
        array(1, 'Juan', 'Perez', 'DNI', '12345678', 'Masculino', '35', '1988-11-15', '987654321'),
        array(2, 'Maria', 'Garcia', 'DNI', '23456789', 'Femenino', '28', '1995-03-22', '987654322'),
        array(3, 'Carlos', 'Lopez', 'DNI', '34567890', 'Masculino', '45', '1978-07-10', '987654323'),
        array(4, 'Ana', 'Martinez', 'DNI', '45678901', 'Femenino', '32', '1991-09-05', '987654324'),
        array(5, 'Roberto', 'Sanchez', 'DNI', '56789012', 'Masculino', '52', '1971-12-20', '987654325'),
        array(6, 'Lucia', 'Ramirez', 'DNI', '67890123', 'Femenino', '38', '1985-05-14', '987654326'),
        array(7, 'Fernando', 'Torres', 'DNI', '78901234', 'Masculino', '41', '1982-01-30', '987654327'),
        array(8, 'Patricia', 'Flores', 'DNI', '89012345', 'Femenino', '29', '1994-08-18', '987654328'),
        array(9, 'Miguel', 'Vargas', 'DNI', '90123456', 'Masculino', '55', '1968-06-25', '987654329'),
        array(10, 'Sofia', 'Quispe', 'DNI', '01234567', 'Femenino', '26', '1997-02-11', '987654330')
    );
    foreach ($patients as $p) {
        $sql = "INSERT IGNORE INTO `tba_paciente` (`IdPaciente`, `NombrePaciente`, `ApellidoPaciente`, `TipoIdentificacion`, `NumeroIdentificacion`, `SexoPaciente`, `EdadPaciente`, `FechaNacimiento`, `CelularPaciente`, `FechaCreacion`, `FechaActualizacion`) VALUES ({$p[0]}, '{$p[1]}', '{$p[2]}', '{$p[3]}', '{$p[4]}', '{$p[5]}', '{$p[6]}', '{$p[7]}', '{$p[8]}', NOW(), NOW())";
        $inserts[] = $sql;
    }
    
    // ===== 8. CITAS (10 REGISTROS) =====
    for ($i = 1; $i <= 10; $i++) {
        $fecha = date('Y-m-d H:i:s', strtotime("+ $i days"));
        $inserts[] = "INSERT IGNORE INTO `tba_cita` (`IdCita`, `IdPaciente`, `FechaProgramada`, `MedicoAsignado`, `EstadoCita`, `FechaCreacion`, `FechaActualizacion`) VALUES ($i, $i, '$fecha', 2, 1, NOW(), NOW())";
    }
    
    // ===== 9. HISTORIAS CLÍNICAS (10 REGISTROS) =====
    for ($i = 1; $i <= 10; $i++) {
        $medico = ($i % 2 == 0) ? 2 : 2; // Alternar entre Dr. Martinez (2)
        $inserts[] = "INSERT IGNORE INTO `tba_historiaclinica` (`IdHistoriaClinica`, `IdPaciente`, `IdSocio`, `AlergiasEncontradas`, `MotivoConsulta`, `DatosInformante`, `TiempoEnfermedad`, `SignosSintomas`, `RelatoCronologico`, `FuncionesBiologicas`, `AntecedentesFamiliares`, `AntecedentesPersonales`, `RutaOdontograma`, `UsuarioCreado`, `UsuarioActualizado`, `FechaCreado`, `FechaActualiza`) VALUES ($i, $i, $medico, 'Ninguna', 'Consulta dental', 'Paciente', 'N/A', 'Ninguno', 'Revisión general', 'Normales', 'Sin datos', 'Buena salud', '', 2, 2, NOW(), NOW())";
    }
    
    // ===== 10. TRATAMIENTOS (10 REGISTROS) =====
    for ($i = 1; $i <= 10; $i++) {
        $total = 100 + ($i * 50);
        $pagado = intval($total / 2);
        $inserts[] = "INSERT IGNORE INTO `tba_tratamiento` (`IdTratamiento`, `IdHistoriaClinica`, `IdPaciente`, `TotalTratamiento`, `TotalPagado`, `UsuarioCreado`, `UsuarioActualiza`, `FechaCreacion`, `FechaActualizacion`) VALUES ($i, $i, $i, $total, $pagado, 2, 2, NOW(), NOW())";
    }
    
    // ===== 11. DETALLES DE TRATAMIENTO (10 REGISTROS) =====
    for ($i = 1; $i <= 10; $i++) {
        $proc = ($i % 10) + 1;
        $inserts[] = "INSERT IGNORE INTO `tba_detalletratamiento` (`IdDetalleTratamiento`, `IdTratamiento`, `IdProcedimiento`, `EstadoTratamiento`, `MedicoProcedimiento`, `FechaProcedimiento`, `ObservacionProcedimiento`, `PrecioProcedimiento`) VALUES ($i, $i, $proc, 1, 2, DATE_ADD(NOW(), INTERVAL $i DAY), 'Procedimiento completado', " . (150 + ($i * 25)) . ")";
    }
    
    // ===== 12. COTIZACIONES (10 REGISTROS) =====
    for ($i = 1; $i <= 10; $i++) {
        $total = 500 + ($i * 100);
        $estado = $i % 3 == 0 ? 'Pendiente' : 'Aceptada';
        $inserts[] = "INSERT IGNORE INTO `tba_cotizacion` (`IdCotizacion`, `IdPaciente`, `TotalCotizacion`, `FechaCotizacion`, `EstadoCotizacion`, `UsuarioCreado`, `UsuarioActualiza`, `FechaCreacion`, `FechaActualizacion`) VALUES ($i, $i, $total, DATE_ADD(NOW(), INTERVAL $i DAY), '$estado', 2, 2, NOW(), NOW())";
    }
    
    // ===== 13. DETALLES DE COTIZACIÓN (10 REGISTROS) =====
    for ($i = 1; $i <= 10; $i++) {
        $proc = ($i % 10) + 1;
        $total = 300 + ($i * 50);
        $inserts[] = "INSERT IGNORE INTO `tba_detallecotizacion` (`IdDetalleCotizacion`, `IdCotizacion`, `IdProcedimiento`, `ObservacionProcedimiento`, `CantidadProcedimiento`, `PrecioUnitario`, `TotalProcedimiento`, `UsuarioCreado`, `UsuarioActualiza`, `FechaCreacion`, `FechaActualizacion`) VALUES ($i, $i, $proc, 'Procedimiento cotizado', 1, " . ($total - 50) . ", $total, 2, 2, NOW(), NOW())";
    }
    
    // ===== 14. DETALLES DE HISTORIA CLÍNICA (10 REGISTROS) =====
    for ($i = 1; $i <= 10; $i++) {
        $inserts[] = "INSERT IGNORE INTO `tba_detallehistoriaclinica` (`IdDetalleHistoriaClinica`, `IdHistoriaClinica`, `IdTratamiento`, `PresionArterial`, `Pulso`, `Temperatura`, `FrecuenciaCardiaca`, `FrecuenciaRespiratoria`, `ExamenOdonto`, `DiagnosticoPresuntivo`, `DiagnosticoDefinitivo`, `Pronostico`, `TratamientoPaciente`, `InformacionAlta`, `FechaCreado`, `FechaActualiza`, `UsuarioCreado`, `UsuarioActualizado`) VALUES ($i, $i, $i, '120/80', '72', '37', '72', '16', 'Normal', 'Sin hallazgos', 'Buena salud dental', 'Excelente', 'Tratamiento preventivo', 'Continuar higiene', NOW(), NOW(), 2, 2)";
    }
    
    // ===== 15. COSTOS (10 REGISTROS) =====
    for ($i = 1; $i <= 10; $i++) {
        $centro = ($i % 4) + 1;
        $mes = date('Y-m', strtotime("- " . (11 - $i) . " months"));
        $total = 1000 + ($i * 200);
        $inserts[] = "INSERT IGNORE INTO `tba_costo` (`IdCosto`, `IdCentroCostos`, `MesCosto`, `TotalCosto`, `EstadoCosto`, `UsuarioCreado`, `UsuarioActualiza`, `FechaCreacion`, `FechaActualizacion`) VALUES ($i, $centro, '$mes', $total, 1, 1, 1, NOW(), NOW())";
    }
    
    // ===== 16. DETALLES DE COSTO (10 REGISTROS) =====
    for ($i = 1; $i <= 10; $i++) {
        $gasto = ($i % 10) + 1;
        $precio = 100 + ($i * 30);
        $inserts[] = "INSERT IGNORE INTO `tba_detallecosto` (`IdDetalleCosto`, `IdCosto`, `IdGasto`, `NumeroDocumento`, `ObservacionGasto`, `FechaCosto`, `PrecioGasto`) VALUES ($i, $i, $gasto, 'FAC-2026-00$i', 'Comprobante de gasto', DATE_ADD(NOW(), INTERVAL -$i DAY), $precio)";
    }
    
    // ===== 17. PAGOS (10 REGISTROS) =====
    for ($i = 1; $i <= 10; $i++) {
        $tipo = ($i % 6) + 1;
        $monto = 100 + ($i * 50);
        $inserts[] = "INSERT IGNORE INTO `tba_pago` (`IdPago`, `IdPaciente`, `IdTipoPago`, `TotalPago`, `FechaPago`, `ObservacionPago`, `ComprobantePago`, `FechaCreacion`, `FechaActualizacion`) VALUES ($i, $i, $tipo, $monto, DATE_ADD(NOW(), INTERVAL $i DAY), 'Pago procesado', 'REC-00$i', NOW(), NOW())";
    }
    
    // ===== 18. VISITAS (10 REGISTROS) =====
    for ($i = 1; $i <= 10; $i++) {
        $inserts[] = "INSERT IGNORE INTO `tba_visita` (`IdVisita`, `IdPaciente`, `FechaVisita`, `MotivoPrincipal`, `Notas`, `UsuarioCreado`, `UsuarioActualizado`, `FechaCreacion`, `FechaActualizacion`) VALUES ($i, $i, DATE_ADD(NOW(), INTERVAL $i DAY), 'Consulta dental', 'Paciente en buen estado', 2, 2, NOW(), NOW())";
    }
    
    // ===== 19. SOCIOS (10 REGISTROS) =====
    $socios = array(
        array(1, 'Dr. Salazar', 1, 1, '12544578'),
        array(2, 'Dr. Peña', 1, 1, '23654689'),
        array(3, 'Dr. Quispe', 1, 1, '34765790'),
        array(4, 'Auxiliar Karina', 2, 2, '45876801'),
        array(5, 'Auxiliar Miguel', 2, 2, '56987912'),
        array(6, 'Limpieza Ana', 2, 2, '67098023'),
        array(7, 'Proveedor JD', 3, 4, '78109134'),
        array(8, 'Contratista Pérez', 1, 3, '89210245'),
        array(9, 'Laboratorio Dental', 2, 4, '90321356'),
        array(10, 'Suministros López', 1, 4, '01432467')
    );
    foreach ($socios as $s) {
        $inserts[] = "INSERT IGNORE INTO `tba_socio` (`IdSocio`, `NombreSocio`, `IdTipoIdentificacion`, `IdTipoSocio`, `Identificacion`, `FechaCreacion`, `FechaActualizacion`) VALUES ({$s[0]}, '{$s[1]}', {$s[2]}, {$s[3]}, '{$s[4]}', NOW(), NOW())";
    }
    
    // Ejecutar todos los inserts
    $count = 0;
    $errors = array();
    
    foreach ($inserts as $sql) {
        try {
            $conn->exec($sql);
            $count++;
        } catch (Exception $e) {
            $errors[] = substr($sql, 0, 80) . "... => " . $e->getMessage();
        }
    }
    
    echo "<h3 style='color: green;'>✓ Inserción Completada</h3>";
    echo "<p><strong>Statements ejecutados:</strong> <span style='color: green; font-weight: bold;'>" . $count . "</span></p>";
    
    if (!empty($errors)) {
        echo "<h4 style='color: orange;'>⚠ Errores encontrados (" . count($errors) . "):</h4>";
        echo "<ul style='max-height: 300px; overflow-y: auto;'>";
        foreach ($errors as $error) {
            echo "<li style='color: #cc0000; font-size: 11px;'>" . htmlspecialchars($error) . "</li>";
        }
        echo "</ul>";
    }
    
    echo "<hr>";
    echo "<h3>📊 Resumen Final de Datos:</h3>";
    echo "<ul style='font-size: 15px; column-count: 2;'>";
    
    $tables = array(
        'tba_usuario' => 'Usuarios',
        'tba_paciente' => 'Pacientes',
        'tba_centrocostos' => 'Centros de Costos',
        'tba_gasto' => 'Gastos',
        'tba_tipodepago' => 'Tipos de Pago',
        'tba_tipoprocedimiento' => 'Tipos Procedimiento',
        'tba_procedimiento' => 'Procedimientos',
        'tba_cita' => 'Citas',
        'tba_historiaclinica' => 'Historias Clínicas',
        'tba_tratamiento' => 'Tratamientos',
        'tba_detalletratamiento' => 'Detalles Tratamiento',
        'tba_cotizacion' => 'Cotizaciones',
        'tba_detallecotizacion' => 'Detalles Cotización',
        'tba_detallehistoriaclinica' => 'Detalles Historia',
        'tba_costo' => 'Costos',
        'tba_detallecosto' => 'Detalles Costo',
        'tba_pago' => 'Pagos',
        'tba_visita' => 'Visitas',
        'tba_socio' => 'Socios'
    );
    
    foreach ($tables as $table => $label) {
        try {
            $result = $conn->query("SELECT COUNT(*) as cnt FROM $table");
            $row = $result->fetch();
            $count = $row['cnt'];
            $color = $count >= 10 ? 'green' : ($count > 0 ? 'orange' : 'red');
            $icon = $count >= 10 ? '✓' : ($count > 0 ? '◐' : '✗');
            echo "<li style='color: $color;'><strong>$icon $label:</strong> <span style='font-weight: bold;'>$count</span></li>";
        } catch (Exception $e) {
            echo "<li style='color: red;'><strong>✗ $label:</strong> Error</li>";
        }
    }
    
    echo "</ul>";
    echo "<hr>";
    echo "<p style='text-align: center; color: green; font-weight: bold;'>✓ Base de datos lista para pruebas</p>";
    echo "<p style='text-align: center;'>";
    echo "<a href='home' style='padding: 12px 25px; background-color: #28a745; color: white; text-decoration: none; border-radius: 5px; display: inline-block; margin-right: 10px; font-weight: bold;'>Ir a Inicio</a>";
    echo "<a href='pacientes' style='padding: 12px 25px; background-color: #17a2b8; color: white; text-decoration: none; border-radius: 5px; display: inline-block; margin-right: 10px; font-weight: bold;'>Ver Pacientes</a>";
    echo "<a href='socios' style='padding: 12px 25px; background-color: #6f42c1; color: white; text-decoration: none; border-radius: 5px; display: inline-block; font-weight: bold;'>Ver Socios</a>";
    echo "</p>";
    echo "</div>";
    
} catch (Exception $e) {
    echo "<div style='padding: 20px; background: #fff3cd; border-radius: 8px;'>";
    echo "<h2 style='color: #cc0000;'>❌ Error Crítico</h2>";
    echo "<p><strong>Mensaje:</strong> " . htmlspecialchars($e->getMessage()) . "</p>";
    echo "<p style='margin-top: 20px;'><a href='home' style='padding: 10px 20px; background-color: #cc0000; color: white; text-decoration: none; border-radius: 4px; font-weight: bold;'>Volver</a></p>";
    echo "</div>";
}
?>

<?php
/**
 * Script para distribuir las fechas de los pacientes existentes en diferentes meses
 * Esto permite que los gráficos muestren datos realistas
 */

require_once "../model/conexion.php";

try {
  $conn = Conexion::conn();
  
  // Obtener lista de pacientes ordenados por ID
  $sqlPacientes = "SELECT IdPaciente FROM tba_paciente ORDER BY IdPaciente ASC";
  $stmtPacientes = $conn->prepare($sqlPacientes);
  $stmtPacientes->execute();
  $pacientes = $stmtPacientes->fetchAll(PDO::FETCH_ASSOC);
  
  $actualizadas = 0;
  $baseDate = new DateTime('2026-01-01');
  
  // Distribuir pacientes en diferentes meses (2026)
  foreach ($pacientes as $index => $paciente) {
    $idPaciente = $paciente['IdPaciente'];
    
    // Calcular mes (0-11) y día (1-28)
    $mesOffset = floor($index / 3);  // Cada 3 pacientes, nuevo mes
    $diaOffset = ($index % 3) + 1;   // Días 1, 2, 3 en cada mes
    
    // Limitar a máximo 12 meses (hasta diciembre)
    if ($mesOffset >= 12) {
      $mesOffset = 11;
    }
    
    // Crear fecha
    $fecha = clone $baseDate;
    $fecha->modify("+{$mesOffset} months");
    $fecha->setDate($fecha->format('Y'), $fecha->format('m'), $diaOffset);
    $fechaStr = $fecha->format('Y-m-d H:i:s');
    
    // Actualizar paciente
    $sqlUpdate = "UPDATE tba_paciente 
                  SET FechaCreacion = :fecha, 
                      FechaActualizacion = :fecha 
                  WHERE IdPaciente = :id";
    
    $stmtUpdate = $conn->prepare($sqlUpdate);
    $stmtUpdate->bindParam(':fecha', $fechaStr);
    $stmtUpdate->bindParam(':id', $idPaciente);
    
    if ($stmtUpdate->execute()) {
      $actualizadas++;
    }
  }
  
  // Obtener nueva información
  $sqlFechas = "SELECT 
                COUNT(*) as total,
                MIN(FechaCreacion) as fecha_minima, 
                MAX(FechaCreacion) as fecha_maxima,
                YEAR(MIN(FechaCreacion)) as año_minimo,
                YEAR(MAX(FechaCreacion)) as año_maximo
                FROM tba_paciente WHERE FechaCreacion IS NOT NULL";
  $stmtFechas = $conn->prepare($sqlFechas);
  $stmtFechas->execute();
  $resultFechas = $stmtFechas->fetch();
  
  echo json_encode([
    "respuesta" => "ok",
    "mensaje" => "$actualizadas pacientes actualizados con fechas distribuidas",
    "total_pacientes" => $resultFechas['total'],
    "fecha_minima" => $resultFechas['fecha_minima'],
    "fecha_maxima" => $resultFechas['fecha_maxima'],
    "año_minimo" => $resultFechas['año_minimo'],
    "año_maximo" => $resultFechas['año_maximo']
  ]);
  
} catch (Exception $e) {
  echo json_encode([
    "respuesta" => "error",
    "mensaje" => "Error: " . $e->getMessage()
  ]);
}
?>
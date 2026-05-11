<?php
/**
 * Script para verificar y mostrar datos existentes de pacientes
 * Simplemente valida que existan datos en el sistema
 */

require_once "../model/conexion.php";

try {
  $conn = Conexion::conn();
  
  // Verificar total de pacientes
  $sqlTotal = "SELECT COUNT(*) as total FROM tba_paciente WHERE FechaCreacion IS NOT NULL";
  $stmtTotal = $conn->prepare($sqlTotal);
  $stmtTotal->execute();
  $resultTotal = $stmtTotal->fetch();
  
  // Obtener rango de fechas
  $sqlFechas = "SELECT 
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
    "mensaje" => "Sistema listo. Se encontraron " . $resultTotal['total'] . " pacientes registrados",
    "total_pacientes" => $resultTotal['total'],
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

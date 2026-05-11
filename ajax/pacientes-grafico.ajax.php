<?php

require_once "../controller/pacientes.controller.php";
require_once "../model/pacientes.model.php";

if (function_exists('ini_set')) {
  ini_set('display_errors', '0');
}

header('Content-Type: application/json; charset=UTF-8');

$filtro = $_POST["filtro"] ?? "año_actual";
$año = isset($_POST["año"]) ? intval($_POST["año"]) : intval(date('Y'));

try {
  if ($filtro === "ultimos_meses") {
    $pacientesPorMes = ControllerPacientes::ctrObtenerPacientesUltimosMeses(3);
  } elseif ($filtro === "ultimos_6_meses") {
    $pacientesPorMes = ControllerPacientes::ctrObtenerPacientesUltimosMeses(6);
  } else {
    $pacientesPorMes = ControllerPacientes::ctrObtenerPacientesPorMes($año);
  }

  $mesesNombre = [
    1 => 'Enero', 2 => 'Febrero', 3 => 'Marzo', 4 => 'Abril',
    5 => 'Mayo', 6 => 'Junio', 7 => 'Julio', 8 => 'Agosto',
    9 => 'Septiembre', 10 => 'Octubre', 11 => 'Noviembre', 12 => 'Diciembre'
  ];

  $mesesChart = [];
  $datos = [];

  if ($filtro === "ultimos_meses" || $filtro === "ultimos_6_meses") {
    foreach ($pacientesPorMes as $registro) {
      $fechaMes = $registro['fecha_mes'] ?? '';
      $partes = explode('-', $fechaMes);
      $numeroMes = isset($partes[1]) ? intval($partes[1]) : 0;
      $anioMes = isset($partes[0]) ? $partes[0] : '';
      $nombreMes = $mesesNombre[$numeroMes] ?? ($registro['mes_nombre'] ?? $fechaMes);

      $mesesChart[] = trim($nombreMes . ' ' . $anioMes);
      $datos[] = intval($registro['total_pacientes'] ?? 0);
    }
  } else {
    for ($m = 1; $m <= 12; $m++) {
      $mesesChart[] = $mesesNombre[$m];
      $datos[$m] = 0;
    }

    foreach ($pacientesPorMes as $registro) {
      $mes = intval($registro['mes'] ?? 0);
      if ($mes >= 1 && $mes <= 12) {
        $datos[$mes] = intval($registro['total_pacientes'] ?? 0);
      }
    }

    $datos = array_values($datos);
  }

  echo json_encode([
    "meses" => $mesesChart,
    "datos" => $datos,
    "filtro" => $filtro,
    "año" => $año,
    "total_registros" => count($pacientesPorMes)
  ], JSON_UNESCAPED_UNICODE);
} catch (Throwable $e) {
  echo json_encode([
    "meses" => [],
    "datos" => [],
    "filtro" => $filtro,
    "año" => $año,
    "total_registros" => 0,
    "error" => $e->getMessage()
  ], JSON_UNESCAPED_UNICODE);
}

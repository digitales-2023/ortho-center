<?php

require_once "../controller/pacientes.controller.php";
require_once "../model/pacientes.model.php";

// Recibir parámetro de año (si no se envía, usar el actual)
$año = isset($_POST["año"]) ? intval($_POST["año"]) : date('Y');

// Obtener datos de pacientes por mes
$pacientesPorMes = ControllerPacientes::ctrObtenerPacientesPorMes($año);

// Preparar datos para Chart.js
$meses = [];
$datos = [];
$datosPorMes = [];

$mesesNombre = [
  1 => 'Enero', 2 => 'Febrero', 3 => 'Marzo', 4 => 'Abril',
  5 => 'Mayo', 6 => 'Junio', 7 => 'Julio', 8 => 'Agosto',
  9 => 'Septiembre', 10 => 'Octubre', 11 => 'Noviembre', 12 => 'Diciembre'
];

// Llenar todos los meses del año con datos
for ($m = 1; $m <= 12; $m++) {
  $meses[] = $mesesNombre[$m];
  $datos[$m] = 0;
}

// Procesar datos de la BD
foreach ($pacientesPorMes as $registro) {
  $mes = intval($registro['mes']);
  $datos[$mes] = intval($registro['total_pacientes']);
  $datosPorMes[$mes] = $registro;
}

// Convertir a array indexado para Chart.js
$datosFinales = [];
for ($m = 1; $m <= 12; $m++) {
  $datosFinales[] = $datos[$m];
}

// Respuesta JSON
$respuesta = [
  "meses" => $meses,
  "datos" => $datosFinales,
  "detalles" => $datosPorMes,
  "año" => $año
];

echo json_encode($respuesta);
?>

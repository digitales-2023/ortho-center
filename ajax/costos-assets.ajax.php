<?php

if (function_exists('ini_set')) {
  ini_set('display_errors', '0');
}
error_reporting(E_ALL & ~E_WARNING & ~E_NOTICE & ~E_DEPRECATED);

header('Content-Type: application/json; charset=UTF-8');

function salidaJson($data)
{
  while (ob_get_level() > 0) {
    ob_end_clean();
  }

  echo json_encode($data, JSON_UNESCAPED_UNICODE);
  exit;
}

require_once "../controller/costos.controller.php";
require_once "../controller/funciones.controller.php";
require_once "../model/costos.model.php";

class AjaxCostoAsset
{
  public $FechaInicial;
  public $FechaFinal;
  public function ajaxFiltrarFecha()
  {
    $FechaInicial = $this->FechaInicial;
    $FechaFinal = $this->FechaFinal;
    $respuesta = ControllerCostos::ctrMostrarCostosPorMeses($FechaInicial, $FechaFinal);
    salidaJson($respuesta ?: []);
  }

  public $codCentroCostos;
  public function ajaxFiltrarCentroCostos()
  {
    $codCentroCostos = $this->codCentroCostos;
    $respuesta = ControllerCostos::ctrMostrarCostosPorCentro($codCentroCostos);
    salidaJson($respuesta ?: []);
  }

}

//  Mostrar los costos por fechas
if(isset($_POST["codCentroCostos"])){
	$mostrarCostosFecha = new AjaxCostoAsset();
  $mostrarCostosFecha -> codCentroCostos = $_POST["codCentroCostos"];
	$mostrarCostosFecha -> ajaxFiltrarCentroCostos();
}

//  Mostrar el costo mensual por el centro de costos
if(isset($_POST["FechaInicial"])){
	$mostrarCostosMes = new AjaxCostoAsset();
  $mostrarCostosMes -> FechaInicial = $_POST["FechaInicial"];
  $mostrarCostosMes -> FechaFinal = $_POST["FechaFinal"];
	$mostrarCostosMes -> ajaxFiltrarFecha();
}

salidaJson([]);

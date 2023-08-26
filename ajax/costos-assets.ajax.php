<?php

require_once "../controller/costos.controller.php";
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
    echo json_encode($respuesta);
  }

  public $codCentroCostos;
  public function ajaxFiltrarCentroCostos()
  {
    $codCentroCostos = $this->codCentroCostos;
    $respuesta = ControllerCostos::ctrMostrarCostosPorCentro($codCentroCostos);
    echo json_encode($respuesta);
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
<?php

require_once "../controller/costos.controller.php";
require_once "../model/costos.model.php";

class AjaxCostos
{
  //  Editar Centro Costos
  public $codCentroCosto;
  public function ajaxEditarCentro()
  {
    $codCentroCosto = $this->codCentroCosto;
    $respuesta = ControllerCostos::ctrMostrarDatosEditar($codCentroCosto);
    echo json_encode($respuesta);
  }

  public $FechaInicial;
  public $FechaFinal;
  public function ajaxBuscarPorFechas()
  {
    $FechaInicial = $this->FechaInicial;
    $FechaFinal = $this->FechaFinal;
    $respuesta = ControllerCostos::ctrMostrarCostosPorFechas($FechaInicial, $FechaFinal);
    echo json_encode($respuesta);
  }
}

//  Editar Centro Costos
if(isset($_POST["codCentroCosto"])){
	$editarCentroCostos = new AjaxCostos();
	$editarCentroCostos -> codCentroCosto = $_POST["codCentroCosto"];
	$editarCentroCostos -> ajaxEditarCentro();
}

//  Mostrar los costos por fechas
if(isset($_POST["FechaInicial"])){
	$mostrarCostosFecha = new AjaxCostos();
  $mostrarCostosFecha -> FechaInicial = $_POST["FechaInicial"];
  $mostrarCostosFecha -> FechaFinal = $_POST["FechaFinal"];
	$mostrarCostosFecha -> ajaxBuscarPorFechas();
}
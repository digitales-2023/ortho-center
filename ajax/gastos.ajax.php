<?php

require_once "../controller/gastos.controller.php";
require_once "../model/gastos.model.php";
require_once "../controller/socios.controller.php";
require_once "../model/socios.model.php";

class AjaxGastos
{
  //  Editar Usuario
  public $codGasto;
  public function ajaxEditarGasto()
  {
    $codGasto = $this->codGasto;
    $respuesta = ControllerGastos::ctrMostrarDatosEditar($codGasto);
    echo json_encode($respuesta);
  }

  //  Agregar los datos del modal hacia el listado
  public $codGastoAgregar;
  public function ajaxAgregarGasto()
  {
    $codGastoAgregar = $this->codGastoAgregar;
    $listaSocios = ControllerSocios::ctrMostrarSociosGastos();
    $datosGasto = ControllerGastos::ctrAgregarGasto($codGastoAgregar);
    $opcionesSocios = array();

    foreach($listaSocios as $value)
    {
      $opcionesSocios[] = array(
        "IdSocio" => $value["IdSocio"],
        "NombreSocio" => $value["NombreSocio"]
      );
    }

    $respuesta = array(
      "IdGasto" => $datosGasto["IdGasto"],
      "NombreGasto" => $datosGasto["NombreGasto"],
      "OpcionesSocios" => $opcionesSocios
    );

    echo json_encode($respuesta);
  }

  //  Modal para mostrar los gastos por un centro de costos
  public $codCCostosModal;
  public function ajaxMostrarGastosPorCentro()
  {
    $codCCostosModal = $this->codCCostosModal;
    $listaGastos = ControllerGastos::ctrNostrarGastosCentro($codCCostosModal);
    echo json_encode($listaGastos);
  }
}

//  Editar usuario
if(isset($_POST["codGasto"])){
	$editarGasto = new AjaxGastos();
	$editarGasto -> codGasto = $_POST["codGasto"];
	$editarGasto -> ajaxEditarGasto();
}

//  Agregar Gasto a guia de nuevo gasto
if(isset($_POST["codGastoAgregar"])){
	$agregarGastoFijo = new AjaxGastos();
	$agregarGastoFijo -> codGastoAgregar = $_POST["codGastoAgregar"];
	$agregarGastoFijo -> ajaxAgregarGasto();
}

//  Mostrar los gastos por el centro de costos
if(isset($_POST["codCCostosModal"])){
	$mostrarModalCentro = new AjaxGastos();
	$mostrarModalCentro -> codCCostosModal = $_POST["codCCostosModal"];
	$mostrarModalCentro -> ajaxMostrarGastosPorCentro();
}
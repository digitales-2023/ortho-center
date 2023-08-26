<?php

require_once "../controller/procedimientos.controller.php";
require_once "../model/procedimientos.model.php";

class AjaxProcedimientos
{
  //  Editar Procedimiento
  public $codProcedimiento;
  public function ajaxEditarProcedimiento()
  {
    $codProcedimiento = $this->codProcedimiento;
    $respuesta = ControllerProcedimientos::ctrMostrarDatosEditar($codProcedimiento);
    echo json_encode($respuesta);
  }

  public $codProcedimientoAgregar;
  public function ajaxAgregarProcedimiento()
  {
    $codProcedimientoAgregar = $this->codProcedimientoAgregar;
    $respuesta = ControllerProcedimientos::ctrObtenerDatosProcedimiento($codProcedimientoAgregar);
    echo json_encode($respuesta);
  }
}

//  Editar Procedimiento
if(isset($_POST["codProcedimiento"])){
	$editarProcedimiento = new AjaxProcedimientos();
	$editarProcedimiento -> codProcedimiento = $_POST["codProcedimiento"];
	$editarProcedimiento -> ajaxEditarProcedimiento();
}

//  Editar Procedimiento
if(isset($_POST["codProcedimientoAgregar"])){
	$agregarProcedimiento = new AjaxProcedimientos();
	$agregarProcedimiento -> codProcedimientoAgregar = $_POST["codProcedimientoAgregar"];
	$agregarProcedimiento -> ajaxAgregarProcedimiento();
}

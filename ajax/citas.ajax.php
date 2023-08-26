<?php

require_once "../controller/citas.controller.php";
require_once "../model/citas.model.php";

class AjaxCitas
{
  //  Editar Socio
  public $codCitaEditar;
  public function ajaxEditarCita()
  {
    $codCitaEditar = $this->codCitaEditar;
    $respuesta = ControllerCitas::ctrMostrarDatosEditar($codCitaEditar);
    echo json_encode($respuesta);
  }
}

//  Editar socio
if(isset($_POST["codCitaEditar"])){
	$editarCita = new AjaxCitas();
	$editarCita -> codCitaEditar = $_POST["codCitaEditar"];
	$editarCita -> ajaxEditarCita();
}

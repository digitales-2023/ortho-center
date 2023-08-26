<?php

require_once "../controller/socios.controller.php";
require_once "../model/socios.model.php";

class AjaxSocio
{
  //  Editar Socio
  public $codSocio;
  public function ajaxEditarSocio()
  {
    $codSocio = $this->codSocio;
    $respuesta = ControllerSocios::ctrMostrarDatosEditar($codSocio);
    echo json_encode($respuesta);
  }
}

//  Editar socio
if(isset($_POST["codSocio"])){
	$editarSocio = new AjaxSocio();
	$editarSocio -> codSocio = $_POST["codSocio"];
	$editarSocio -> ajaxEditarSocio();
}

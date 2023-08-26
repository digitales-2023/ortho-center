<?php

require_once "../controller/historias.controller.php";
require_once "../model/historias.model.php";
require_once "../controller/pacientes.controller.php";
require_once "../model/pacientes.model.php";

class AjaxHistorias
{
  //  Subir el odontograma de un paciente
  public $codSubirImg;
  public function ajaxSubirImagen()
  {
    $codSubirImg = $this->codSubirImg;
    $respuesta = ControllerHistorias::ctrSubirOdontograma($codSubirImg);
    echo json_encode($respuesta);
  }

  //  Descargar odontograma
  public $codHistoriaDescargar;
  public function ajaxDescargarImagen()
  {
    $codHistoriaDescargar = $this->codHistoriaDescargar;
    $respuesta = ControllerHistorias::ctrDescargarOdontograma($codHistoriaDescargar);
    $devolver = array(
      "archivo" => $respuesta["archivo"],
      "ruta" => $respuesta["ruta"]
    );
    echo json_encode($devolver);
  }
}

//  Subir el odontograma de un paciente
if(isset($_POST["codSubirImg"])){
  $subirOdontograma = new AjaxHistorias();
  $subirOdontograma -> codSubirImg = $_POST["codSubirImg"];
  $subirOdontograma -> ajaxSubirImagen();
}

//  Descagar odontograma
if(isset($_POST["codHistoriaDescargar"])){
  $descargarOdontograma = new AjaxHistorias();
  $descargarOdontograma -> codHistoriaDescargar = $_POST["codHistoriaDescargar"];
  $descargarOdontograma -> ajaxDescargarImagen();
}
<?php

require_once "../controller/visitas.controller.php";
require_once "../model/visitas.model.php";
require_once "../controller/tratamiento.controller.php";
require_once "../model/tratamiento.model.php";
require_once "../controller/pagos.controller.php";
require_once "../model/pagos.model.php";

class AjaxVisita
{
  //  Editar Procedimiento
  public $codDetalleTratamiento;
  public function ajaxMostrarPrecioDetalle()
  {
    $codDetalleTratamiento = $this->codDetalleTratamiento;
    $respuesta = ControllerTratamiento::ctrMostrarCostoDetalle($codDetalleTratamiento);
    echo json_encode($respuesta);
  }

  //  Listar la visita
  public $codPacienteVisita;
  public function ajaxListarProcedimientos()
  {
    $codPacienteVisita = $_POST["codPacienteVisita"];
    $listaTratamientos = ControllerTratamiento::ctrListarProcedimientosPaciente($codPacienteVisita);
    echo json_encode($listaTratamientos);
  }

  //  Eliminar una visita
  public $codVisitaEliminar;
  public function ajaxEliminarVisita()
  {
    $codVisitaEliminar = $_POST["codVisitaEliminar"];
    $respuesta = ControllerVisitas::ctrEliminarUnaVisita($codVisitaEliminar);
    echo json_encode($respuesta);
  }
}

//  Editar Procedimiento
if (isset($_POST["referenciaVisita"])) {
  $editarProcedimiento = new AjaxVisita();
  $editarProcedimiento->codDetalleTratamiento = $_POST["referenciaVisita"];
  $editarProcedimiento->ajaxMostrarPrecioDetalle();
}

//  Listar procedimiento de la visita
if (isset($_POST["codPacienteVisita"])) {
  $listarProcedimiento = new AjaxVisita();
  $listarProcedimiento->codPacienteVisita = $_POST["codPacienteVisita"];
  $listarProcedimiento->ajaxListarProcedimientos();
}

//  Eliminar una visita en específico
if (isset($_POST["codVisitaEliminar"])) {
  $eliminarVisita = new AjaxVisita();
  $eliminarVisita->codVisitaEliminar = $_POST["codVisitaEliminar"];
  $eliminarVisita->ajaxEliminarVisita();
}

<?php

require_once "../../controller/costos.controller.php";
require_once "../../controller/gastos.controller.php";
require_once "../../controller/historias.controller.php";
require_once "../../controller/pacientes.controller.php";
require_once "../../controller/procedimientos.controller.php";
require_once "../../controller/reportesExcel.controller.php";
require_once "../../controller/socios.controller.php";
require_once "../../controller/usuarios.controller.php";
require_once "../../controller/pagos.controller.php";
require_once "../../controller/tratamiento.controller.php";

require_once "../../model/costos.model.php";
require_once "../../model/gastos.model.php";
require_once "../../model/historias.model.php";
require_once "../../model/pacientes.model.php";
require_once "../../model/procedimientos.model.php";
require_once "../../model/socios.model.php";
require_once "../../model/usuarios.model.php";
require_once "../../model/pagos.model.php";
require_once "../../model/tratamiento.model.php";

require_once "../../vendor/autoload.php";

/*-------------------------
  DESCARGAR REPORTES EXCEL
-------------------------*/
//  Exportar reporte por fechas de la vista FiltrarCostos
if(isset($_GET["fechaInicial"]) && isset($_GET["fechaFinal"]))
{
	$reporteStockTienda = new ControllerReportesExcel();
	$reporteStockTienda -> ctrDescargarReportePorFechas();
}

//  Descargar todos los pagos realizados por los pacientes
if(isset($_GET["descargarPagos"]))
{
  $reportePagos =  new ControllerReportesExcel();
  $reportePagos -> ctrDescargarReportePagos();
}

//  Descargar todos los pagos pendientes de los pacientes
if(isset($_GET["descargarPagosPendientes"]))
{
  $reportePagos =  new ControllerReportesExcel();
  $reportePagos -> ctrDescargarReportePagosPendientes();
}

//  Descargar todos los procedimientos que un medico hizo con todos los gastos sumados
if(isset($_GET["descargarAtencionesMedicos"]))
{
  $reportePagos =  new ControllerReportesExcel();
  $reportePagos -> ctrDescargarAtencionesMedicos();
}
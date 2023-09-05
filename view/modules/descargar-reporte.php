<?php

require_once "../../controller/historias.controller.php";
require_once "../../controller/pacientes.controller.php";
require_once "../../controller/procedimientos.controller.php";
require_once "../../controller/reportesExcel.controller.php";
require_once "../../controller/usuarios.controller.php";
require_once "../../controller/pagos.controller.php";

require_once "../../model/historias.model.php";
require_once "../../model/pacientes.model.php";
require_once "../../model/procedimientos.model.php";
require_once "../../model/usuarios.model.php";
require_once "../../model/pagos.model.php";

require_once "../../vendor/autoload.php";

/*-------------------------
  DESCARGAR REPORTES EXCEL
-------------------------*/

if(isset($_GET["descargarPagos"]))
{
  $reportePagos =  new ControllerReportesExcel();
  $reportePagos -> ctrDescargarReportePagos();
}
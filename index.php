<?php 
date_default_timezone_set('America/Lima');

//  Controllers
require_once "controller/plantilla.controller.php";
require_once "controller/usuarios.controller.php";
require_once "controller/socios.controller.php";
require_once "controller/pacientes.controller.php";
require_once "controller/procedimientos.controller.php";
require_once "controller/gastos.controller.php";
require_once "controller/funciones.controller.php";
require_once "controller/costos.controller.php";
require_once "controller/historias.controller.php";
require_once "controller/reportesExcel.controller.php";
require_once "controller/tratamiento.controller.php";
require_once "controller/pagos.controller.php";
require_once "controller/citas.controller.php";

//  Models
require_once "model/usuarios.model.php";
require_once "model/gastos.model.php";
require_once "model/socios.model.php";
require_once "model/pacientes.model.php";
require_once "model/procedimientos.model.php";
require_once "model/costos.model.php";
require_once "model/historias.model.php";
require_once "model/tratamiento.model.php";
require_once "model/pagos.model.php";
require_once "model/citas.model.php";

$plantilla = new ControllerPlantilla();
$plantilla -> ctrPlantilla();
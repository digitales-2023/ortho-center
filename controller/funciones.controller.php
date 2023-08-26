<?php
date_default_timezone_set('America/Lima');
class ControllerFunciones
{
  public static function ctrConvertirMes($fechaMes)
  {
    //  El formato que voy a recibir del mes será "2023-06", se divide el string y solo tomo el valor de 06
    $meses = ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"];
    $mesNumero = explode("-", $fechaMes);
    $posicionMes = intval($mesNumero["1"]) - 1;
    $mesLetra = $meses[$posicionMes];
    $fechaRetorno = $mesNumero["0"].'-'.$mesLetra;
    return $fechaRetorno;
  }
}
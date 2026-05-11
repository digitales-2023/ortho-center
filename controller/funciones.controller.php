<?php
date_default_timezone_set('America/Lima');
class ControllerFunciones
{
  public static function ctrConvertirMes($fechaMes)
  {
    $meses = ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"];

    if (!$fechaMes || strpos($fechaMes, '-') === false) {
      return $fechaMes;
    }

    $partes = explode("-", $fechaMes);
    if (count($partes) < 2) {
      return $fechaMes;
    }

    $parteA = trim($partes[0]);
    $parteB = trim($partes[1]);

    if (strlen($parteA) === 4) {
      $anio = $parteA;
      $mes = (int)$parteB;
    } elseif (strlen($parteB) === 4) {
      $anio = $parteB;
      $mes = (int)$parteA;
    } else {
      $anio = $parteA;
      $mes = (int)$parteB;
    }

    if ($mes < 1 || $mes > 12) {
      return $fechaMes;
    }

    return $anio . '-' . $meses[$mes - 1];
  }
}

<?php
date_default_timezone_set('America/Lima');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
class ControllerReportesExcel
{
  //  Descargar reporte de pagos
  public static function ctrDescargarReportePagos()
  {
    if(isset($_GET["descargarPagos"]))
    {
      $listaPagos = ControllerPagos::ctrMostrarTodosLosPagos();

      //  Títulos de celdas
      $titleArray = ['Nombre Paciente', 'Apellido Paciente', 'DNI', 'Monto de Pago', 'Tipo de Pago', 'Fecha de pago'];
      $dataArray = [];
      $spreadsheet = new Spreadsheet();
      $activeWorksheet = $spreadsheet->getActiveSheet();
      $activeWorksheet->fromArray($titleArray, null, 'A1');

      foreach($listaPagos as $value)
      {
        $data = array(
          $value["NombrePaciente"],
          $value["ApellidoPaciente"],
          $value["DNIPaciente"],
          $value["TotalPago"],
          $value["DescripcionTipo"],
          $value["FechaPago"],
        );
        //  Data de cada celda
        array_push($dataArray, $data);
      }
      $activeWorksheet->fromArray($dataArray, null, 'A2');
      
      header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
      $writer = new Xlsx($spreadsheet);
      $writer->save('php://output');
    }
  }
}
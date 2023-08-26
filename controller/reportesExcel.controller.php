<?php
date_default_timezone_set('America/Lima');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
class ControllerReportesExcel
{
  //  Descargar reporte del filtro de costos por fecha en excel
  public static function ctrDescargarReportePorFechas()
  {
    if(isset($_GET["fechaInicial"]))
    {
      $listaImprimir = ControllerCostos::ctrMostrarCostosPorFechas($_GET["fechaInicial"], $_GET["fechaFinal"]);

      //  Títulos de celdas
      $titleArray = ['Centro de Costos','Nombre de Socio','Descripción de Costo', 'Observación de Costo', 'Número de Documento','Precio de Costo','Fecha de Costo'];
      $dataArray = [];
      $spreadsheet = new Spreadsheet();
      $activeWorksheet = $spreadsheet->getActiveSheet();
      $activeWorksheet->fromArray($titleArray, null, 'A1');

      foreach($listaImprimir as $value)
      {
        $data = array(
          $value["DescripcionCentro"],
          $value["NombreSocio"],
          $value["NombreGasto"],
          $value["ObservacionGasto"],
          $value["NumeroDocumento"],
          $value["PrecioGasto"],
          $value["FechaCosto"],
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
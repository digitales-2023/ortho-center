<?php
date_default_timezone_set('America/Lima');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
class ControllerReportesExcel
{
  private static function prepararSalidaExcel()
  {
    if (function_exists('ini_set')) {
      ini_set('display_errors', '0');
    }

    $nivelBuffer = ob_get_level();
    while ($nivelBuffer > 0) {
      ob_end_clean();
      $nivelBuffer--;
    }

    $nivelErrorActual = error_reporting();
    error_reporting($nivelErrorActual & ~E_DEPRECATED & ~E_WARNING & ~E_NOTICE);

    return $nivelErrorActual;
  }

  private static function enviarArchivoExcel($spreadsheet, $nombreArchivo)
  {
    $nivelErrorAnterior = self::prepararSalidaExcel();

    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment; filename="' . $nombreArchivo . '"');
    header('Cache-Control: max-age=0');

    $writer = new Xlsx($spreadsheet);
    $writer->save('php://output');

    error_reporting($nivelErrorAnterior);
    exit;
  }

  // Descargar reporte del filtro de costos por fecha en excel
  public static function ctrDescargarReportePorFechas()
  {
    if (isset($_GET["fechaInicial"])) {
      self::prepararSalidaExcel();
      $listaImprimir = ControllerCostos::ctrMostrarCostosPorFechas($_GET["fechaInicial"], $_GET["fechaFinal"]);

      // Títulos de celdas
      $titleArray = ['Centro de Costos','Nombre de Socio','Descripción de Costo', 'Observación de Costo', 'Número de Documento','Precio de Costo','Fecha de Costo'];
      $dataArray = [];
      $spreadsheet = new Spreadsheet();
      $activeWorksheet = $spreadsheet->getActiveSheet();
      $activeWorksheet->fromArray($titleArray, null, 'A1');

      foreach ($listaImprimir as $value) {
        $data = array(
          $value["DescripcionCentro"],
          $value["NombreSocio"],
          $value["NombreGasto"],
          $value["ObservacionGasto"],
          $value["NumeroDocumento"],
          $value["PrecioGasto"],
          $value["FechaCosto"],
        );
        array_push($dataArray, $data);
      }
      $activeWorksheet->fromArray($dataArray, null, 'A2');
      
      self::enviarArchivoExcel($spreadsheet, 'reporte-costos.xlsx');
    }
  }

  // Descargar reporte de pagos
  public static function ctrDescargarReportePagos()
  {
    if (isset($_GET["descargarPagos"])) {
      self::prepararSalidaExcel();
      $listaPagos = ControllerPagos::ctrMostrarTodosLosPagos();

      $titleArray = ['Nombre Paciente', 'Apellido Paciente', 'Identificacion', 'Monto de Pago', 'Observacion', 'Tipo de Pago', 'Fecha de pago'];
      $dataArray = [];
      $spreadsheet = new Spreadsheet();
      $activeWorksheet = $spreadsheet->getActiveSheet();
      $activeWorksheet->fromArray($titleArray, null, 'A1');

      foreach ($listaPagos as $value) {
        $data = array(
          $value["NombrePaciente"],
          $value["ApellidoPaciente"],
          $value["NumeroIdentificacion"],
          $value["TotalPago"],
          $value["ObservacionPago"],
          $value["DescripcionTipo"],
          $value["FechaPago"],
        );
        array_push($dataArray, $data);
      }
      $activeWorksheet->fromArray($dataArray, null, 'A2');
      $activeWorksheet->getColumnDimension('A')->setAutoSize(true);
      $activeWorksheet->getColumnDimension('B')->setAutoSize(true);
      $activeWorksheet->getColumnDimension('C')->setAutoSize(true);
      $activeWorksheet->getColumnDimension('D')->setAutoSize(true);
      $activeWorksheet->getColumnDimension('E')->setAutoSize(true);
      $activeWorksheet->getColumnDimension('F')->setAutoSize(true);
      $activeWorksheet->getColumnDimension('G')->setAutoSize(true);
      self::enviarArchivoExcel($spreadsheet, 'reporte-pagos.xlsx');
    }
  }

  // Descargar todos los pacientes y ver sus pagos pendientes
  public static function ctrDescargarReportePagosPendientes() 
  {
    if (isset($_GET["descargarPagosPendientes"])) {
      self::prepararSalidaExcel();
      // Títulos de celdas
      $titleArray = ['Paciente', 'Identificacion', 'Monto Presupuestado', 'Total Realizado', 'Total Cancelado', 'Saldo Actual'];
      $dataArray = [];
      $spreadsheet = new Spreadsheet();
      $activeWorksheet = $spreadsheet->getActiveSheet();
      $activeWorksheet->fromArray($titleArray, null, 'A1');

      $listaCostoTratamientos = ControllerPagos::ctrMostrarTotalPorPaciente();
      foreach ($listaCostoTratamientos as $value) {
        $totalesTratamiento = ControllerTratamiento::ctrObtenerTotalesTratamiento($value["IdPaciente"]);
        $totalRealizado = ControllerTratamiento::ctrObtenerTotalRealizado($value["IdHistoriaClinica"]);
        $deudaRealizados = number_format($totalRealizado["TotalRealizado"]-$totalesTratamiento["TotalPagado"], 2);

        $data = array(
          $value["NombrePaciente"].' '.$value["ApellidoPaciente"],
          $value["NumeroIdentificacion"],
          $value["TotalTratamiento"],
          $totalRealizado["TotalRealizado"],
          $totalesTratamiento["TotalPagado"],
          $deudaRealizados,
        );
        array_push($dataArray, $data);
      }

      $activeWorksheet->fromArray($dataArray, null, 'A2');
      $activeWorksheet->getColumnDimension('A')->setAutoSize(true);
      $activeWorksheet->getColumnDimension('B')->setAutoSize(true);
      $activeWorksheet->getColumnDimension('C')->setAutoSize(true);
      $activeWorksheet->getColumnDimension('D')->setAutoSize(true);
      $activeWorksheet->getColumnDimension('E')->setAutoSize(true);
      $activeWorksheet->getColumnDimension('F')->setAutoSize(true);
      self::enviarArchivoExcel($spreadsheet, 'reporte-pagos-pendientes.xlsx');
    }
  }

  // Descargar todas las atenciones que ha hecho un medico
  public static function ctrDescargarAtencionesMedicos()
  {
    if (isset($_GET["descargarAtencionesMedicos"])) {
      self::prepararSalidaExcel();
      $titleArray = ['Medico', 'Paciente', 'Identificacion', 'Procedimiento', 'Fecha', 'Precio', 'Observacion'];
      $dataArray = [];
      $spreadsheet = new Spreadsheet();
      $activeWorksheet = $spreadsheet->getActiveSheet();
      $activeWorksheet->fromArray($titleArray, null, 'A1');

      $listaAtenciones = ControllerTratamiento::ctrMostrarAtencionesMedicos();

      foreach ($listaAtenciones as $value) {
        $data = array(
          $value["NombreSocio"],
          $value["NombrePaciente"].' '.$value["ApellidoPaciente"],
          $value["NumeroIdentificacion"],
          $value["NombreProcedimiento"],
          $value["FechaProcedimiento"],
          $value["PrecioProcedimiento"],
          $value["ObservacionProcedimiento"],
        );
        array_push($dataArray, $data);
      }
      $activeWorksheet->fromArray($dataArray, null, 'A2');
      $activeWorksheet->getColumnDimension('A')->setAutoSize(true);
      $activeWorksheet->getColumnDimension('B')->setAutoSize(true);
      $activeWorksheet->getColumnDimension('C')->setAutoSize(true);
      $activeWorksheet->getColumnDimension('D')->setAutoSize(true);
      $activeWorksheet->getColumnDimension('E')->setAutoSize(true);
      $activeWorksheet->getColumnDimension('F')->setAutoSize(true);
      $activeWorksheet->getColumnDimension('G')->setAutoSize(true);
      self::enviarArchivoExcel($spreadsheet, 'reporte-atenciones-medicos.xlsx');
    }
  }
}

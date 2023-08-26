<?php
//  Controladores
require_once('../../controller/costos.controller.php');
require_once('../../controller/funciones.controller.php');

//  Modelos
require_once('../../model/costos.model.php');

require('tfpdf.php');

//  Historia en PDF
class PDFCostoSelect extends TFPDF
{
  // Cabecera de página
  function Header()
  {
    // Logo
    $this->Image('../../view/img/logo-denta.png', 155, 8, 35);
    // Arial bold 15
    $this->AddFont('DejaVu','','DejaVuSansCondensed.ttf',true);
    
    // Título
    $this->Ln(15);
    $this->Cell(80);
    $this->SetFont('Arial', 'B', 15);
    $this->Cell(30 ,10, utf8_decode('FICHA DE COSTOS'), 0, 0, 'C');

    
    // Salto de línea
    $this->Ln(15);
  }

  // Pie de página
  function Footer()
  {
    // Posición: a 1,5 cm del final
    $this->SetY(-15);
    // Arial italic 8
    $this->AddFont('DejaVu','','DejaVuSansCondensed.ttf',true);
    $this->SetFont('DejaVu', '', 8);
    // Número de página
    $this->Cell(0, 8, 'Página ' . $this->PageNo() . '/{nb}', 0, 0, 'L');
  }

  //  Imprimir la lista de costos
  function TablaCostos($header, $datosDetalleCosto)
  {
    $this->SetFont('Arial', 'B', 10);
    $this->Cell(65,7,$header[0],1,0,'C'); 
    $this->Cell(40,7,$header[1],1,0,'C'); 
    $this->Cell(30,7,$header[2],1,0,'C'); 
    $this->Cell(25,7,$header[3],1,0,'C');
    $this->Cell(25,7,$header[4],1,0,'C'); 
    
    foreach($datosDetalleCosto as $dato)
    {
      $this->SetFont('DejaVu', '', 10);
      $this->Ln();
      $this->Cell(65,5,$dato["NombreGasto"],1);
      $this->Cell(40,5,$dato["ObservacionGasto"],1);
      $this->Cell(30,5,$dato["NumeroDocumento"],1);
      $this->Cell(25,5,$dato["FechaCosto"],1);
      $this->Cell(25,5,$dato["PrecioGasto"],1);
    }
  }
}

//  Obtener el codigo del paciente para recoger sus datos 
$codCosto = $_GET["codCosto"];
$datosCabeceraCosto = ControllerCostos::ctrObtenerCabaceraCosto($codCosto);
$datosDetalleCosto = ControllerCostos::ctrObtenerDetalleCosto($codCosto);

$mesCosto = ControllerFunciones::ctrConvertirMes($datosCabeceraCosto["MesCosto"]);
$mesActual = explode('-', $mesCosto);
if($datosCabeceraCosto["EstadoCosto"] == '1')
{
  $estadOCosto = 'Abierto';
}
else
{
  $estadOCosto = 'Cerrado';
}

// Creacion de los datos con el costo Mensual
$pdf = new PDFCostoSelect();

$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->AddFont('DejaVu','','DejaVuSansCondensed.ttf',true);

/**
 * DATOS GENERALES DEL COSTO
 */
$pdf->SetFont('Arial','B',14);
$pdf->Cell(80,10,'Datos Generales Costo',0,'L');

$pdf->SetFont('Arial','B',10);
$pdf->Cell(35,8,'Centro de costos :',0);
$pdf->SetFont('DejaVu', '', 10);
$pdf->Cell(60,8,$datosCabeceraCosto["DescripcionCentro"],0);
$pdf->SetFont('Arial','B',10);
$pdf->Cell(22,8,'Mes Costo :',0);
$pdf->SetFont('DejaVu', '', 10);
$pdf->Cell(25,8,$mesActual[1],0);
$pdf->SetFont('Arial','B',10);
$pdf->Cell(16,8,'Estado :',0);
$pdf->SetFont('DejaVu', '', 10);
$pdf->Cell(20,8,$estadOCosto,0);

$pdf->Ln(5);

$pdf->SetFont('Arial','B',10);
$pdf->Cell(35,8,'Total Costo:',0);
$pdf->SetFont('DejaVu', '', 10);
$pdf->Cell(70,8,'S/. '.number_format($datosCabeceraCosto["TotalCosto"],2),0);

$pdf->Ln(5);
$pdf->Cell(10,8,'____________________________________________________________________________________________________________________',0);
$pdf->Ln(10);

/**
 * PLAN DE TRATAMIENTO DEL PACIENTE
 */
$pdf->SetFont('Arial','B',14);
$pdf->Cell(80,10,'Lista de Costos del Mes',0,'L');

$pdf->Ln(8);

//Títulos de las columnas
$header=array('Descripcion','Observacion','Nro. Documento', 'Fecha', 'Costo');
$pdf->AliasNbPages();

//$pdf->AddPage();
$pdf->TablaCostos($header, $datosDetalleCosto);


$pdf->Ln(5);

$pdf->Output();
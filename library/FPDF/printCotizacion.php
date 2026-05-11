<?php
//  Controladores
require_once('../../controller/pacientes.controller.php');
require_once('../../controller/cotizaciones.controller.php');

//  Modelos
require_once('../../model/pacientes.model.php');
require_once('../../model/cotizaciones.model.php');

require('tfpdf.php');

//  Historia en PDF
class PDFCotizacion extends TFPDF
{
  // Cabecera de página
  function Header()
  {
    // Logo
    $this->Image('../../view/img/logo-ortho-blanco.png', 155, 8, 35);

    // Título
    $this->Ln(15);
    $this->SetFont('DejaVu', 'B', 15);
    $this->SetTextColor(28,119,162);
    $this->Cell(0, 10, 'COTIZACIÓN', 0, 0, 'L');

    // Salto de línea
    $this->Ln(15);
  }

  // Pie de página
  function Footer()
  {
    // Posición: a 1,5 cm del final
    $this->SetY(-15);
    $this->SetFont('DejaVu', '', 8);
    // Número de página
    $this->Cell(0, 8, 'Página ' . $this->PageNo() . '/{nb}', 0, 0, 'L');
    $this->Cell(0, 8, 'Colegio Odontológico del Perú', 0, 0, 'R');
  }
}

//  Obtener el codigo del paciente para recoger sus datos 
$codCotizacion = $_GET["codCotizacion"];

$datosPacienteCotizacion = ControllerCotizaciones::ctrMostrarDatosCabecera($codCotizacion);
$datosDetalleCotizacion = ControllerCotizaciones::ctrObtenerListaProcedimientos($codCotizacion);

// Creacion de los datos de la historia clínica
$pdf = new PDFCotizacion();

$pdf->AliasNbPages();
$pdf->SetAutoPageBreak(true, 15);
$pdf->AddFont('DejaVu', '', 'DejaVuSansCondensed.ttf', true);
$pdf->AddFont('DejaVu', 'B', 'DejaVuSansCondensed-Bold.ttf', true);
$pdf->AddPage();

/**
 * DATOS GENERALES DEL PACIENTE
 */
$pdf->SetFont('DejaVu', 'B', 12);
$pdf->SetTextColor(28,119,162);
$pdf->Cell(0, 10, 'A la atención de', 0, 'L');

$pdf->SetFont('DejaVu', '', 10);
$pdf->SetTextColor(0,0,0);
$pdf->Cell(0, 8, $datosPacienteCotizacion["NombrePaciente"] . ' ' . $datosPacienteCotizacion["ApellidoPaciente"], 0);
$pdf->Ln(4);

$pdf->SetFont('DejaVu', '', 10);
$pdf->Cell(0, 8, $datosPacienteCotizacion["NumeroIdentificacion"], 0);

$pdf->Ln(4);
$pdf->SetFont('DejaVu', '', 10);
$pdf->Cell(0, 8, 'Denta Vitalis', 0);
$pdf->Ln(4);
$pdf->Cell(0, 8, 'Calle Tronchadero 203', 0);
$pdf->Ln(4);
$pdf->Cell(0, 8, 'Arequipa, Perú', 0);


$pdf->Ln(8);

$pdf->SetTextColor(28,119,162);
$pdf->SetDrawColor(28,119,162);
$pdf->SetLineWidth(0.4);
$pdf->Line(10, $pdf->GetY(), 200, $pdf->GetY());
/**
 * ENFERMEDAD ACTUAL
 */
$pdf->Ln(5);

$pdf->SetFont('DejaVu', 'B', 12);
$pdf->SetTextColor(28,119,162);
$pdf->SetFillColor(240, 245, 250);
$pdf->Cell(120, 8, 'Tratamiento', 1, 0, 'L', true);
$pdf->Cell(35, 8, 'Unidad', 1, 0, 'C', true);
$pdf->Cell(35, 8, 'Costo', 1, 1, 'C', true);

$pdf->SetFont('DejaVu', '', 11);
$pdf->SetTextColor(0,0,0);

foreach ($datosDetalleCotizacion as $value) {
  $procedimiento = trim($value["NombreProcedimiento"] . ' (' . $value["ObservacionProcedimiento"] . ')');
  $pdf->Cell(120, 8, $procedimiento, 1);
  $pdf->Cell(35, 8, '(S/.) '.$value["PrecioUnitario"], 1, 0, 'C');
  $pdf->Cell(35, 8, '(S/.) '.$value["TotalProcedimiento"], 1, 0, 'C');
  $pdf->Ln(8);
}

$pdf->Ln(8);


$pdf->SetFont('DejaVu', 'B', 12);
$pdf->SetTextColor(28,119,162);
$pdf->Cell(155, 8, 'Total' , 0, 0, 'R');
$pdf->Cell(35, 8, '(S/.) '.$datosPacienteCotizacion["TotalCotizacion"], 1, 0, 'C', true);
$pdf->Ln(8);


/**
 * MANDAR EL PDF A UNA NUEVA VENTANA
 */
$pdf->Output();

<?php
//  Controladores
require_once('../../controller/tratamiento.controller.php');
require_once('../../controller/pacientes.controller.php');

//  Modelos
require_once('../../model/tratamiento.model.php');
require_once('../../model/pacientes.model.php');

require('tfpdf.php');

//  Historia en PDF
class PDFPlanTratamiento extends TFPDF
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
    $this->Cell(30 ,10, utf8_decode('PLAN DE TRATAMIENTO'), 0, 0, 'C');

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
    $this->Cell(0, 8, 'Colegio Odontológico del Perú', 0, 0, 'R');
  }

  //  Imprimir Plan de tratamiento
  function TablaProcedimientos($header, $listaTratamiento)
  {
    $this->SetFont('Arial', 'B', 10);
    $this->Cell(70,7,$header[0],1,0,'C'); 
    $this->Cell(60,7,$header[1],1,0,'C'); 
    $this->Cell(25,7,$header[2],1,0,'C'); 
    $this->Cell(25,7,$header[3],1,0,'C'); 
    
    foreach($listaTratamiento as $dato)
    {
      $this->SetFont('DejaVu', '', 10);
      if($dato["EstadoTratamiento"] != '1'){
        $estado = "Realizado";
      } else {
        $estado = "No Realizado";
      }
      if($dato["FechaProcedimiento"] == '0000-00-00'){
        $fecha = "Sin Asignar";
      } else {
        $fecha = $dato["FechaProcedimiento"];
      }
      $this->Ln();
      $this->Cell(70,5,$dato["NombreProcedimiento"],1);
      $this->Cell(60,5,$dato["ObservacionProcedimiento"],1);
      $this->Cell(25,5,$estado,1);
      $this->Cell(25,5,$fecha,1);
    }
  }
}

//  Obtener el codigo del paciente para recoger el plan de tratamiento
$codHistoria = $_GET["codHistoria"];
$codPaciente = $_GET["codPaciente"];
$planTratamiento = ControllerTratamiento::ctrMostrarDetalleTratamientoCompleto($codHistoria);
$datosPaciente = ControllerPacientes::ctrMostrarDatosImprimir($codPaciente);

// Creacion de los datos de la historia clínica
$pdf = new PDFPlanTratamiento();

$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->AddFont('DejaVu','','DejaVuSansCondensed.ttf',true);

/**
 * DATOS GENERALES DEL PACIENTE
 */
$pdf->SetFont('Arial','B',14);
$pdf->Cell(80,10,'Datos Generales del Paciente',0,'L');

$pdf->SetFont('Arial','B',10);
$pdf->Cell(35,8,'Nombre Paciente:',0);
$pdf->SetFont('DejaVu', '', 10);
$pdf->Cell(80,8,$datosPaciente["NombrePaciente"].' '.$datosPaciente["ApellidoPaciente"],0);
$pdf->SetFont('Arial','B',10);
$pdf->Cell(10,8,'DNI:',0);
$pdf->SetFont('DejaVu', '', 10);
$pdf->Cell(25,8,$datosPaciente["DNIPaciente"],0);

$pdf->Ln(8);

$pdf->SetFont('Arial','B',10);
$pdf->Cell(15,8,'Celular:',0);
$pdf->SetFont('DejaVu', '', 10);
$pdf->Cell(20,8,$datosPaciente["CelularPaciente"],0);
$pdf->SetFont('Arial','B',10);
$pdf->Cell(10,8,'Edad:',0);
$pdf->SetFont('DejaVu', '', 10);
$pdf->Cell(10,8,$datosPaciente["EdadPaciente"],0);
$pdf->SetFont('Arial','B',10);
$pdf->Cell(35,8,'Fecha Nacimiento:',0);
$pdf->SetFont('DejaVu', '', 10);
$pdf->Cell(25,8,$datosPaciente["FechaNacimiento"],0);
$pdf->SetFont('Arial','B',10);
$pdf->Cell(10,8,'Sexo:',0);
$pdf->SetFont('DejaVu', '', 10);
$pdf->Cell(20,8,$datosPaciente["SexoPaciente"],0);

$pdf->Ln(10);

/**
 * PLAN DE TRATAMIENTO DEL PACIENTE
 */
$pdf->SetFont('Arial','B',14);
$pdf->Cell(80,10,'Lista de Procedimientos',0,'L');

$pdf->Ln(8);

//Títulos de las columnas
$header=array('Descripcion','Observacion','Estado','Fecha');
$pdf->AliasNbPages();

//$pdf->AddPage();
$pdf->TablaProcedimientos($header, $planTratamiento);

/**
 * MANDAR EL PDF A UNA NUEVA VENTANA
 */
$pdf->Output();

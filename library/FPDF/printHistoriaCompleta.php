<?php
//  Controladores
require_once('../../controller/pacientes.controller.php');
require_once('../../controller/tratamiento.controller.php');
require_once('../../controller/visitas.controller.php');

//  Modelos
require_once('../../model/pacientes.model.php');
require_once('../../model/tratamiento.model.php');
require_once('../../model/visitas.model.php');

require('tfpdf.php');

//  Historia en PDF
class PDFHistoriaClinica extends TFPDF
{
  // Cabecera de página
  function Header()
  {
    // Logo
    $this->Image('../../view/img/logo-ortho-blanco.png', 155, 8, 33);
    // Arial bold 15
    $this->AddFont('DejaVu', '', 'DejaVuSansCondensed.ttf', true);

    // Título
    $this->Ln(15);
    $this->Cell(80);
    $this->SetFont('Arial', 'B', 15);
    $this->Cell(30, 10, utf8_decode('HISTORIA CLINICA ODONTOLÓGICA'), 0, 0, 'C');


    // Salto de línea
    $this->Ln(15);
  }

  // Pie de página
  function Footer()
  {
    // Posición: a 1,5 cm del final
    $this->SetY(-15);
    // Arial italic 8
    $this->AddFont('DejaVu', '', 'DejaVuSansCondensed.ttf', true);
    $this->SetFont('DejaVu', '', 8);
    // Número de página
    $this->Cell(0, 8, 'Página ' . $this->PageNo() . '/{nb}', 0, 0, 'L');
    $this->Cell(0, 8, 'Colegio Odontológico del Perú', 0, 0, 'R');
  }

  //  Imprimir plan de tratamiento
  function TablaProcedimientos($header, $listaTratamiento)
  {
    $this->SetFont('Arial', 'B', 10);
    $this->Cell(70, 7, $header[0], 1, 0, 'C');
    $this->Cell(60, 7, $header[1], 1, 0, 'C');
    $this->Cell(25, 7, $header[2], 1, 0, 'C');
    $this->Cell(25, 7, $header[3], 1, 0, 'C');

    foreach ($listaTratamiento as $dato) {
      $this->SetFont('DejaVu', '', 10);
      if ($dato["EstadoTratamiento"] != '1') {
        $estado = "Realizado";
      } else {
        $estado = "No Realizado";
      }

      if ($dato["FechaProcedimiento"] == '0000-00-00') {
        $fecha = "Sin Asignar";
      } else {
        $fecha = $dato["FechaProcedimiento"];
      }
      $this->Ln();
      $this->Cell(70, 5, $dato["NombreProcedimiento"], 1);
      $this->Cell(60, 5, $dato["ObservacionProcedimiento"], 1);
      $this->Cell(25, 5, $estado, 1);
      $this->Cell(25, 5, $fecha, 1);
    }
  }

  //  Imprimir el historial de visitas
  function TablaVisitas($header, $historialVisitas)
  {
    $this->SetFont('Arial', 'B', 10);
    $this->Cell(70, 7, $header[0], 1, 0, 'C');
    $this->Cell(25, 7, $header[1], 1, 0, 'C');
    $this->Cell(65, 7, $header[2], 1, 0, 'C');
    $this->Cell(20, 7, $header[3], 1, 0, 'C');

    foreach ($historialVisitas as $dato) {
      $this->SetFont('DejaVu', '', 10);

      $this->Ln();
      $this->Cell(70, 5, $dato["MotivoVisita"], 1);
      $this->Cell(25, 5, $dato["FechaVisita"], 1);
      $this->Cell(65, 5, $dato["NombreProcedimiento"], 1);
      $this->Cell(20, 5,  $dato["TotalPagado"], 1);
    }
  }
}

//  Función para devolver el checklist en si o no
function checkList($check)
{
  if ($check == "on") {
    return "Si";
  } else {
    return "No";
  }
}

//  Obtener el codigo del paciente para recoger sus datos 
$codHistoria = $_GET["codHistoria"];
$datosHistoriaClinica = ControllerPacientes::ctrObtenerDatosHistoriaPdf($codHistoria);
$planTratamiento = ControllerTratamiento::ctrMostrarDetalleTratamientoCompleto($codHistoria);
$historialVisitas = ControllerVisitas::ctrMostrarHistorialVisitas($codHistoria);

// Creacion de los datos de la historia clínica
$pdf = new PDFHistoriaClinica();

$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->AddFont('DejaVu', '', 'DejaVuSansCondensed.ttf', true);

/**
 * DATOS GENERALES DEL PACIENTE
 */
$pdf->SetFont('Arial', 'B', 14);
$pdf->Cell(80, 10, 'Anamnesis', 0, 'L');

$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(35, 8, 'Nombre Paciente:', 0);
$pdf->SetFont('DejaVu', '', 10);
$pdf->Cell(70, 8, $datosHistoriaClinica["NombrePaciente"] . ' ' . $datosHistoriaClinica["ApellidoPaciente"], 0);
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(15, 8, 'Sexo:', 0);
$pdf->SetFont('DejaVu', '', 10);
$pdf->Cell(25, 8, $datosHistoriaClinica["SexoPaciente"], 0);
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(15, 8, 'Edad:', 0);
$pdf->SetFont('DejaVu', '', 10);
$pdf->Cell(25, 8, $datosHistoriaClinica["EdadPaciente"], 0);

$pdf->Ln(8);

$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(15, 8, 'DNI:', 0);
$pdf->SetFont('DejaVu', '', 10);
$pdf->Cell(25, 8, $datosHistoriaClinica["DNIPaciente"], 0);
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(25, 8, 'Ocupacion:', 0);
$pdf->SetFont('DejaVu', '', 10);
$pdf->Cell(25, 8, $datosHistoriaClinica["OcupacionPaciente"], 0);
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(40, 8, 'Lugar de Procedencia:', 0);
$pdf->SetFont('DejaVu', '', 10);
$pdf->Cell(30, 8, $datosHistoriaClinica["LugarProcedencia"], 0);

$pdf->Ln(8);

$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(30, 8, 'Domicilio Actual:', 0);
$pdf->SetFont('DejaVu', '', 10);
$pdf->Cell(50, 8, $datosHistoriaClinica["DomicilioPaciente"], 0);

$pdf->Ln(8);

$pdf->Cell(190, 8, '___________________________________________________________________________________________________________________', 0);

/**
 * ANTECEDENTES
 */
$pdf->Ln(8);

$pdf->SetFont('Arial', 'B', 14);
$pdf->Cell(80, 8, utf8_decode('Antecedentes'), 0, 'L');

$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(30, 8, 'Motivo de consulta:', 0);

$pdf->Ln(8);
$pdf->SetFont('DejaVu', '', 10);
$pdf->MultiCell(180, 8, $datosHistoriaClinica["MotivoConsulta"], 0);

$pdf->Ln(4);

/**
 * Del estado de salud general
 */

$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(30, 8, 'Del estado de salud general:', 0);

$pdf->Ln(8);

$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(35, 8, 'Alergias', 0);
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(10, 8, '(' . checkList($datosHistoriaClinica["CheckAlergias"]) . ')', 0);
$pdf->SetFont('DejaVu', '', 10);
$pdf->Cell(150, 8, $datosHistoriaClinica["DescripcionAlergias"], 0);

$pdf->Ln(8);

$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(35, 8, 'Hepatitis', 0);
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(10, 8, '(' . checkList($datosHistoriaClinica["CheckHepatitis"]) . ')', 0);
$pdf->SetFont('DejaVu', '', 10);
$pdf->Cell(150, 8, $datosHistoriaClinica["DescripcionHepatitis"], 0);

$pdf->Ln(8);

$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(35, 8, 'Diabetes', 0);
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(10, 8, '(' . checkList($datosHistoriaClinica["CheckDiabetes"]) . ')', 0);
$pdf->SetFont('DejaVu', '', 10);
$pdf->Cell(150, 8, $datosHistoriaClinica["DescripcionDiabetes"], 0);


$pdf->Ln(8);

$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(35, 8, utf8_decode('Hipertensión'), 0);
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(10, 8, '(' . checkList($datosHistoriaClinica["CheckHipertension"]) . ')', 0);
$pdf->SetFont('DejaVu', '', 10);
$pdf->Cell(150, 8, $datosHistoriaClinica["DescripcionHipertension"], 0);


$pdf->Ln(8);

$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(35, 8, 'Hemorragias', 0);
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(10, 8, '(' . checkList($datosHistoriaClinica["CheckHemorragias"]) . ')', 0);
$pdf->SetFont('DejaVu', '', 10);
$pdf->Cell(150, 8, $datosHistoriaClinica["DescripcionHemorragias"], 0);


$pdf->Ln(8);

$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(35, 8, 'Enfermedad renal', 0);
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(10, 8, '(' . checkList($datosHistoriaClinica["CheckRenal"]) . ')', 0);
$pdf->SetFont('DejaVu', '', 10);
$pdf->Cell(150, 8, $datosHistoriaClinica["DescripcionRenal"], 0);

$pdf->Ln(8);

$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(35, 8, utf8_decode('Alteración endocrina'), 0);
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(10, 8, '(' . checkList($datosHistoriaClinica["CheckEndocrina"]) . ')', 0);
$pdf->SetFont('DejaVu', '', 10);
$pdf->Cell(150, 8, $datosHistoriaClinica["DescripcionEndocrina"], 0);

$pdf->Ln(8);

$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(35, 8, 'Otros', 0);
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(10, 8, '(' . checkList($datosHistoriaClinica["CheckOtros"]) . ')', 0);
$pdf->SetFont('DejaVu', '', 10);
$pdf->Cell(150, 8, $datosHistoriaClinica["DescripcionOtros"], 0);

/**
 * Del estado de salud  estomatológico
 */

$pdf->Ln(16);

$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(30, 8, utf8_decode('Del estado de salud estomatológico:'), 0);

$pdf->Ln(8);

$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(35, 8, 'Alergias', 0);
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(10, 8, '(' . checkList($datosHistoriaClinica["CheckReaccion"]) . ')', 0);
$pdf->SetFont('DejaVu', '', 10);
$pdf->Cell(150, 8, $datosHistoriaClinica["DescripcionReaccion"], 0);

$pdf->Ln(8);

$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(35, 8, 'Hepatitis', 0);
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(10, 8, '(' . checkList($datosHistoriaClinica["CheckExodoncia"]) . ')', 0);
$pdf->SetFont('DejaVu', '', 10);
$pdf->Cell(150, 8, $datosHistoriaClinica["DescripcionExodoncia"], 0);

$pdf->Ln(8);

$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(35, 8, 'Diabetes', 0);
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(10, 8, '(' . checkList($datosHistoriaClinica["CheckMedicamento"]) . ')', 0);
$pdf->SetFont('DejaVu', '', 10);
$pdf->Cell(150, 8, $datosHistoriaClinica["DescripcionMedicamento"], 0);


$pdf->Ln(8);

$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(35, 8, utf8_decode('Hipertensión'), 0);
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(10, 8, '(' . checkList($datosHistoriaClinica["CheckGestacion"]) . ')', 0);
$pdf->SetFont('DejaVu', '', 10);
$pdf->Cell(150, 8, $datosHistoriaClinica["DescripcionGestacion"], 0);

$pdf->Ln(8);

/**
 * ODONTOGRAMA EN UNA NUEVA HOJA
 */
if ($datosHistoriaClinica["RutaOdontograma"] != null || $datosHistoriaClinica["RutaOdontograma"] != '') {
  $pdf->AddPage();
  $pdf->SetFont('Arial', 'B', 14);
  $pdf->Cell(80, 10, 'Odontograma', 0, 'L');

  $pdf->Ln(8);
  $rutaOdontograma = '../../image/odontograma/' . $datosHistoriaClinica["RutaOdontograma"];

  $pdf->Image($rutaOdontograma, 30, 50, 150, 170);
}

/**
 * PLAN DE TRATAMIENTO DEL PACIENTE EN UNA NUEVA HOJA
 */
$pdf->AddPage();
$pdf->SetFont('Arial', 'B', 14);
$pdf->Cell(80, 10, 'Lista de Procedimientos', 0, 'L');

$pdf->Ln(8);

//Títulos de las columnas
$headerTratamiento = array('Descripcion', 'Observacion', 'Estado', 'Fecha');
$pdf->AliasNbPages();

//$pdf->AddPage();
$pdf->TablaProcedimientos($headerTratamiento, $planTratamiento);

/**
 * HISTORIAL DE VISITAS
 */
$pdf->AddPage();
$pdf->SetFont('Arial', 'B', 14);
$pdf->Cell(80, 10, 'Historial de visitas', 0, 'L');

$pdf->Ln(8);

//Títulos de las columnas
$headerVisitas = array('Motivo', 'Fecha', 'Procedimiento Referencial', 'Cancelado');
$pdf->AliasNbPages();

//$pdf->AddPage();
$pdf->TablaVisitas($headerVisitas, $historialVisitas);

/**
 * MANDAR EL PDF A UNA NUEVA VENTANA
 */
$pdf->Output();

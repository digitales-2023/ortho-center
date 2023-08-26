<?php
//  Controladores
require_once('../../controller/pacientes.controller.php');

//  Modelos
require_once('../../model/pacientes.model.php');

require('tfpdf.php');

//  Historia en PDF
class PDFHistoriaClinica extends TFPDF
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
    $this->Cell(30 ,10, utf8_decode('HISTORIA CLINICA ODONTOLÓGICA DENTA VITALIS'), 0, 0, 'C');

    
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
}

//  Obtener el codigo del paciente para recoger sus datos 
$codHistoria = $_GET["codHistoria"];
$datosHistoriaClinica = ControllerPacientes::ctrObtenerDatosHistoriaPdf($codHistoria);

// Creacion de los datos de la historia clínica
$pdf = new PDFHistoriaClinica();

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
$pdf->Cell(70,8,$datosHistoriaClinica["NombrePaciente"].' '.$datosHistoriaClinica["ApellidoPaciente"],0);
$pdf->SetFont('Arial','B',10);
$pdf->Cell(15,8,'Sexo:',0);
$pdf->SetFont('DejaVu', '', 10);
$pdf->Cell(25,8,$datosHistoriaClinica["SexoPaciente"],0);
$pdf->SetFont('Arial','B',10);
$pdf->Cell(15,8,'Edad:',0);
$pdf->SetFont('DejaVu', '', 10);
$pdf->Cell(25,8,$datosHistoriaClinica["EdadPaciente"],0);

$pdf->Ln(8);

$pdf->SetFont('Arial','B',10);
$pdf->Cell(40,8,'Lugar de Nacimiento:',0);
$pdf->SetFont('DejaVu', '', 10);
$pdf->Cell(20,8,$datosHistoriaClinica["LugarNacimiento"],0);
$pdf->SetFont('Arial','B',10);
$pdf->Cell(40,8,'Fecha de Nacimiento:',0);
$pdf->SetFont('DejaVu', '', 10);
$pdf->Cell(25,8,$datosHistoriaClinica["FechaNacimiento"],0);
$pdf->SetFont('Arial','B',10);
$pdf->Cell(35,8,'Grado Instruccion:',0);
$pdf->SetFont('DejaVu', '', 10);
$pdf->Cell(25,8,$datosHistoriaClinica["GradoInstruccion"],0);

$pdf->Ln(8);

$pdf->SetFont('Arial','B',10);
$pdf->Cell(15,8,'Raza:',0);
$pdf->SetFont('DejaVu', '', 10);
$pdf->Cell(20,8,$datosHistoriaClinica["RazaPaciente"],0);
$pdf->SetFont('Arial','B',10);
$pdf->Cell(15,8,'DNI:',0);
$pdf->SetFont('DejaVu', '', 10);
$pdf->Cell(25,8,$datosHistoriaClinica["DNIPaciente"],0);
$pdf->SetFont('Arial','B',10);
$pdf->Cell(25,8,'Ocupacion:',0);
$pdf->SetFont('DejaVu', '', 10);
$pdf->Cell(25,8,$datosHistoriaClinica["OcupacionPaciente"],0);
$pdf->SetFont('Arial','B',10);
$pdf->Cell(20,8,'Religion:',0);
$pdf->SetFont('DejaVu', '', 10);
$pdf->Cell(25,8,$datosHistoriaClinica["ReligionPaciente"],0);

$pdf->Ln(8);

$pdf->SetFont('Arial','B',10);
$pdf->Cell(25,8,'Estado Civil:',0);
$pdf->SetFont('DejaVu', '', 10);
$pdf->Cell(20,8,$datosHistoriaClinica["EstadoCivil"],0);
$pdf->SetFont('Arial','B',10);
$pdf->Cell(40,8,'Lugar de Procedencia:',0);
$pdf->SetFont('DejaVu', '', 10);
$pdf->Cell(20,8,$datosHistoriaClinica["LugarProcedencia"],0);
$pdf->SetFont('Arial','B',10);
$pdf->Cell(30,8,'Domicilio Actual:',0);
$pdf->SetFont('DejaVu', '', 10);
$pdf->Cell(50,8,$datosHistoriaClinica["DomicilioPaciente"],0);

$pdf->Ln(8);

$pdf->SetFont('Arial','B',10);
$pdf->Cell(52,8,'Nombre y Apellidos Contacto:',0);
$pdf->SetFont('DejaVu', '', 10);
$pdf->Cell(80,8,$datosHistoriaClinica["NombreContactoPaciente"],0);
$pdf->SetFont('Arial','B',10);
$pdf->Cell(20,8,'Telefono:',0);
$pdf->SetFont('DejaVu', '', 10);
$pdf->Cell(25,8,$datosHistoriaClinica["NumeroContactoPaciente"],0);

$pdf->Ln(8);

$pdf->SetFont('Arial','B',10);
$pdf->Cell(20,8,'Riesgo de Alergia:',0);
$pdf->Ln(8);
$pdf->SetFont('DejaVu', '', 10);
$pdf->MultiCell(190,8,$datosHistoriaClinica["AlergiasEncontradas"],0);

$pdf->Cell(190,8,'___________________________________________________________________________________________________________________',0);
/**
 * ENFERMEDAD ACTUAL
 */
$pdf->Ln(8);

$pdf->SetFont('Arial','B',14);
$pdf->Cell(80,10,'Enfermedad Actual',0,'L');

$pdf->SetFont('Arial','B',10);
$pdf->Cell(38,8,'Datos del informante:',0);
$pdf->SetFont('DejaVu', '', 10);
$pdf->Cell(152,8,$datosHistoriaClinica["DatosInformante"],0);

$pdf->Ln(8);

$pdf->SetFont('Arial','B',10);
$pdf->Cell(35,8,'Motivo de consulta:',0);
$pdf->SetFont('DejaVu', '', 10);
$pdf->Cell(155,8,$datosHistoriaClinica["MotivoConsulta"],0);

$pdf->Ln(8);

$pdf->SetFont('Arial','B',10);
$pdf->Cell(42,8,'Tiempo de enfermedad:',0);
$pdf->SetFont('DejaVu', '', 10);
$pdf->Cell(148,8,$datosHistoriaClinica["TiempoEnfermedad"],0);

$pdf->Ln(8);

$pdf->SetFont('Arial','B',10);
$pdf->Cell(53,8,utf8_decode('Signos y síntomas principales:'),0);
$pdf->SetFont('DejaVu', '', 10);
$pdf->Cell(137,8,$datosHistoriaClinica["SignosSintomas"],0);

$pdf->Ln(8);

$pdf->SetFont('Arial','B',10);
$pdf->Cell(35,8,utf8_decode('Relato cronológico:'),0);
$pdf->SetFont('DejaVu', '', 10);
$pdf->Cell(155,8,$datosHistoriaClinica["RelatoCronologico"],0);

$pdf->Ln(8);

$pdf->SetFont('Arial','B',10);
$pdf->Cell(38,8,utf8_decode('Funciones biológicas:'),0);
$pdf->SetFont('DejaVu', '', 10);
$pdf->Cell(152,8,$datosHistoriaClinica["FuncionesBiologicas"],0);

/**
 * ANTECEDENTES
 */
$pdf->Ln(10);

$pdf->SetFont('Arial','B',14);
$pdf->Cell(80,8,'Antecedentes',0,'L');

$pdf->SetFont('Arial','B',10);
$pdf->Cell(8,8,'Antecendetes Familiares:',0);
$pdf->Ln(8);
$pdf->SetFont('DejaVu', '', 10);
$pdf->MultiCell(190,8,$datosHistoriaClinica["AntecedentesFamiliares"],0);

$pdf->Ln(4);

$pdf->SetFont('Arial','B',10);
$pdf->Cell(8,8,'Antecendetes Personales:',0);
$pdf->Ln(8);
$pdf->SetFont('DejaVu', '', 10);
$pdf->MultiCell(190,8,$datosHistoriaClinica["AntecedentesPersonales"],0);

/**
 * EXPLORACION FISICA
 */
$pdf->Ln(8);

$pdf->SetFont('Arial','B',14);
$pdf->Cell(80,8,utf8_decode('Exploración Física'),0,'L');

$pdf->SetFont('Arial','B',10);
$pdf->Cell(30,8,'Signos Vitales',0);
$pdf->Ln(8);
$pdf->Cell(10,8,'P.A.',0);
$pdf->SetFont('DejaVu', '', 10);
$pdf->Cell(20,8,$datosHistoriaClinica["PresionArterial"],0);
$pdf->SetFont('Arial','B',10);
$pdf->Cell(12,8,'Pulso:',0);
$pdf->SetFont('DejaVu', '', 10);
$pdf->Cell(20,8,$datosHistoriaClinica["Pulso"],0);
$pdf->SetFont('Arial','B',10);
$pdf->Cell(12,8,'Temp.',0);
$pdf->SetFont('DejaVu', '', 10);
$pdf->Cell(20,8,$datosHistoriaClinica["Temperatura"],0);
$pdf->SetFont('Arial','B',10);
$pdf->Cell(10,8,'F.C.',0);
$pdf->SetFont('DejaVu', '', 10);
$pdf->Cell(20,8,$datosHistoriaClinica["FrecuenciaCardiaca"],0);
$pdf->SetFont('Arial','B',10);
$pdf->Cell(20,8,'Frec. Resp.',0);
$pdf->SetFont('DejaVu', '', 10);
$pdf->Cell(20,8,$datosHistoriaClinica["FrecuenciaRespiratoria"],0);

$pdf->Ln(8);

$pdf->SetFont('Arial','B',10);
$pdf->Cell(10,8,utf8_decode('Examen Odontoestomatológico:'),0);
$pdf->Ln(8);
$pdf->SetFont('DejaVu', '', 10);
$pdf->MultiCell(190,8,$datosHistoriaClinica["ExamenOdonto"],0);

/**
 * DIAGNOSTICO 
 */
$pdf->Ln(8);

$pdf->SetFont('Arial','B',14);
$pdf->Cell(80,8,utf8_decode('Diagnóstico (CIE 10)'),0,'L');

$pdf->SetFont('Arial','B',10);
$pdf->Cell(42,8,utf8_decode('Diagnóstico Presuntivo'),0);
$pdf->SetFont('DejaVu', '', 10);
$pdf->Cell(148,8,$datosHistoriaClinica["DiagnosticoPresuntivo"],0);
$pdf->Ln(8);
$pdf->SetFont('Arial','B',10);
$pdf->Cell(42,8,utf8_decode('Diagnóstico Definitivo'),0);
$pdf->SetFont('DejaVu', '', 10);
$pdf->Cell(148,8,$datosHistoriaClinica["DiagnosticoDefinitivo"],0);

/**
 * PRONOSTICO / TRATAMIENTO / ALTA DEL PACIENTE
 */
$pdf->Ln(8);

$pdf->SetFont('Arial','B',10);
$pdf->Cell(10,8,utf8_decode('Pronóstico:'),0);
$pdf->Ln(8);
$pdf->SetFont('DejaVu', '', 10);
$pdf->MultiCell(190,8,$datosHistoriaClinica["Pronostico"],0);

$pdf->Ln(8);

$pdf->SetFont('Arial','B',10);
$pdf->Cell(50,4,'Tratamiento / Recomendaciones:',0);
$pdf->SetFont('Arial','B',8);
$pdf->Ln(4);
$pdf->MultiCell(190,8,utf8_decode('(Nombre genérico del medicamente, dosis, vía de administración, tiempo de administración, cuidados, medidas higiénico-dietéticas, preventivas)'),0);
$pdf->SetFont('DejaVu', '', 10);
$pdf->MultiCell(190,8,$datosHistoriaClinica["TratamientoPaciente"],0);

$pdf->Ln(4);

$pdf->SetFont('Arial','B',10);
$pdf->Cell(30,8,utf8_decode('Alta del Paciente:'),0);
$pdf->Ln(8);
$pdf->SetFont('DejaVu', '', 10);
$pdf->MultiCell(190,8,$datosHistoriaClinica["InformacionAlta"],0);

$pdf->Ln(20);

$pdf->SetFont('Arial','B',10);
$pdf->Cell(10,10,utf8_decode('Nombres y Apellidos del Profesional'),0);
$pdf->Ln(12);
$pdf->SetFont('DejaVu', '', 10);
$pdf->Cell(20,10,'_________________________________________',0);


/**
 * MANDAR EL PDF A UNA NUEVA VENTANA
 */
$pdf->Output();


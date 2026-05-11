<?php
header('Content-Type: application/pdf; charset=UTF-8');
mb_internal_encoding('UTF-8');

require_once('../../controller/pacientes.controller.php');
require_once('../../controller/tratamiento.controller.php');
require_once('../../model/pacientes.model.php');
require_once('../../model/tratamiento.model.php');
require('tfpdf.php');

class PDFHistoriaClinicaPro extends TFPDF
{
    private $colorPrimario = array(0, 102, 204);
    private $colorSecundario = array(240, 245, 250);
    private $colorTexto = array(50, 50, 50);
    private $colorBorde = array(200, 200, 200);

    function Header()
    {
        // Fondo con logo blanco
        $this->SetFillColor(255, 255, 255);
        $this->Rect(155, 8, 40, 18, 'F');
        
        $this->Image('../../view/img/logo-ortho-blanco.png', 157, 9, 36);
        
        // Titulo principal
        $this->SetFont('DejaVu', 'B', 13);
        $this->SetTextColor($this->colorPrimario[0], $this->colorPrimario[1], $this->colorPrimario[2]);
        $this->Cell(150, 10, 'HISTORIA CLINICA ODONTOLOGICA', 0, 1, 'L');
        
        // Subtitulos compactos
        $this->SetFont('DejaVu', 'B', 8);
        $this->SetTextColor(100, 100, 100);
        $this->Cell(150, 4, 'Orthocenter - Static Dental', 0, 1, 'L');
        
        $this->SetFont('DejaVu', '', 7);
        $this->Cell(150, 3, 'Colegio Odontologico del Peru', 0, 1, 'L');
        
        // Linea separadora
        $this->SetDrawColor($this->colorPrimario[0], $this->colorPrimario[1], $this->colorPrimario[2]);
        $this->SetLineWidth(0.5);
        $this->Line(10, 33, 200, 33);
        $this->Ln(3);
    }

    function Footer()
    {
        $this->SetY(-12);
        $this->SetFont('DejaVu', '', 7);
        $this->SetTextColor(150, 150, 150);
        $this->Cell(0, 3, 'Pagina ' . $this->PageNo() . '/{nb}', 0, 0, 'C');
        $this->SetY(-8);
        $this->Cell(0, 3, date('d/m/Y'), 0, 0, 'R');
    }

    function SectionHeader($titulo)
    {
        $this->SetFillColor($this->colorPrimario[0], $this->colorPrimario[1], $this->colorPrimario[2]);
        $this->SetFont('DejaVu', 'B', 9);
        $this->SetTextColor(255, 255, 255);
        $this->Cell(0, 5.5, '  ' . $titulo, 0, 1, 'L', true);
        $this->SetTextColor($this->colorTexto[0], $this->colorTexto[1], $this->colorTexto[2]);
        $this->Ln(1);
    }

    function RowDoble($e1, $v1, $e2, $v2)
    {
        $this->SetFont('DejaVu', 'B', 7);
        $this->SetTextColor(50, 50, 50);
        $this->Cell(40, 4.5, $e1 . ':', 0, 0);
        
        $this->SetFont('DejaVu', '', 7);
        $this->SetTextColor(80, 80, 80);
        $this->Cell(50, 4.5, $v1, 0, 0);
        
        $this->SetFont('DejaVu', 'B', 7);
        $this->SetTextColor(50, 50, 50);
        $this->Cell(40, 4.5, $e2 . ':', 0, 0);
        
        $this->SetFont('DejaVu', '', 7);
        $this->SetTextColor(80, 80, 80);
        $this->Cell(0, 4.5, $v2, 0, 1);
    }

    function RowTriple($e1, $v1, $e2, $v2, $e3, $v3)
    {
        $this->SetFont('DejaVu', 'B', 6.5);
        $this->SetTextColor(50, 50, 50);
        $this->Cell(30, 3.5, $e1 . ':', 0, 0);
        
        $this->SetFont('DejaVu', '', 6.5);
        $this->SetTextColor(80, 80, 80);
        $this->Cell(30, 3.5, $v1, 0, 0);
        
        $this->SetFont('DejaVu', 'B', 6.5);
        $this->SetTextColor(50, 50, 50);
        $this->Cell(40, 3.5, $e2 . ':', 0, 0);
        
        $this->SetFont('DejaVu', '', 6.5);
        $this->SetTextColor(80, 80, 80);
        $this->Cell(40, 3.5, $v2, 0, 0);
        
        $this->SetFont('DejaVu', 'B', 6.5);
        $this->SetTextColor(50, 50, 50);
        $this->Cell(25, 3.5, $e3 . ':', 0, 0);
        
        $this->SetFont('DejaVu', '', 6.5);
        $this->SetTextColor(80, 80, 80);
        $this->Cell(0, 3.5, $v3, 0, 1);
    }

    function CampoCompacto($etiqueta, $valor)
    {
        $this->SetFont('DejaVu', 'B', 7);
        $this->SetTextColor(50, 50, 50);
        $this->Cell(40, 4, $etiqueta . ':', 0, 1);
        
        $this->SetFont('DejaVu', '', 7);
        $this->SetTextColor(80, 80, 80);
        $this->SetX(15);
        $this->MultiCell(185, 3.5, $valor, 'B', 'L');
        $this->Ln(1);
    }

    function TablaSignosVitales($datos)
    {
        $this->SetFont('DejaVu', 'B', 6);
        $this->SetFillColor($this->colorSecundario[0], $this->colorSecundario[1], $this->colorSecundario[2]);
        $this->SetDrawColor($this->colorBorde[0], $this->colorBorde[1], $this->colorBorde[2]);
        
        $this->Cell(38, 4.5, 'Presion', 1, 0, 'C', true);
        $this->Cell(38, 4.5, 'Pulso', 1, 0, 'C', true);
        $this->Cell(38, 4.5, 'Temp', 1, 0, 'C', true);
        $this->Cell(38, 4.5, 'FC', 1, 0, 'C', true);
        $this->Cell(38, 4.5, 'FR', 1, 1, 'C', true);
        
        $this->SetFont('DejaVu', '', 6);
        $this->SetTextColor(100, 100, 100);
        $this->SetDrawColor($this->colorBorde[0], $this->colorBorde[1], $this->colorBorde[2]);
        
        $pa = $datos['PresionArterial'] ?? 'N/A';
        $pulso = $datos['Pulso'] ?? 'N/A';
        $temp = $datos['Temperatura'] ?? 'N/A';
        $fc = $datos['FrecuenciaCardiaca'] ?? 'N/A';
        $fr = $datos['FrecuenciaRespiratoria'] ?? 'N/A';
        
        $this->Cell(38, 4, $pa, 1, 0, 'C');
        $this->Cell(38, 4, $pulso, 1, 0, 'C');
        $this->Cell(38, 4, $temp, 1, 0, 'C');
        $this->Cell(38, 4, $fc, 1, 0, 'C');
        $this->Cell(38, 4, $fr, 1, 1, 'C');
        $this->Ln(1.5);
    }
}

// Obtener datos
$codHistoria = $_GET["codHistoria"] ?? 1;
$datosHistoria = ControllerPacientes::ctrObtenerDatosHistoriaPdf($codHistoria);
$planTratamiento = ControllerTratamiento::ctrMostrarDetalleTratamientoCompleto($codHistoria);

// Crear PDF
$pdf = new PDFHistoriaClinicaPro();
$pdf->AliasNbPages();
$pdf->SetAutoPageBreak(true, 10);
$pdf->AddFont('DejaVu', '', 'DejaVuSansCondensed.ttf', true);
$pdf->AddFont('DejaVu', 'B', 'DejaVuSansCondensed-Bold.ttf', true);
$pdf->AddPage();

// ========== DATOS GENERALES DEL PACIENTE ==========
$pdf->SectionHeader('DATOS GENERALES DEL PACIENTE');

$nombre = $datosHistoria["NombrePaciente"] . ' ' . $datosHistoria["ApellidoPaciente"];
$sexo = $datosHistoria["SexoPaciente"] ?? 'N/A';
$edad = $datosHistoria["EdadPaciente"] ?? 'N/A';
$dni = $datosHistoria["NumeroIdentificacion"] ?? 'N/A';
$fechaNac = $datosHistoria["FechaNacimiento"] ?? 'N/A';
$ocupacion = $datosHistoria["OcupacionPaciente"] ?? 'N/A';
$contacto = $datosHistoria["NombreContactoPaciente"] ?? 'N/A';
$telefono = $datosHistoria["NumeroContactoPaciente"] ?? 'N/A';

$pdf->RowDoble('Nombre', $nombre, 'Sexo', $sexo);
$pdf->RowDoble('DNI', $dni, 'Edad', $edad);
$pdf->RowDoble('Fecha Nacimiento', $fechaNac, 'Ocupacion', $ocupacion);
$pdf->RowDoble('Contacto', $contacto, 'Telefono', $telefono);

$alergia = $datosHistoria["AlergiasEncontradas"] ?? 'Sin datos';
$pdf->CampoCompacto('Riesgo Alergia', $alergia);

// ========== ENFERMEDAD ACTUAL ==========
$pdf->SectionHeader('ENFERMEDAD ACTUAL');

$informante = $datosHistoria["DatosInformante"] ?? 'Paciente';
$motivo = $datosHistoria["MotivoConsulta"] ?? 'N/A';
$tiempo = $datosHistoria["TiempoEnfermedad"] ?? 'N/A';

$pdf->RowDoble('Informante', $informante, 'Motivo Consulta', $motivo);
$pdf->RowDoble('Tiempo Enfermedad', $tiempo, 'Estado', '');

$sintomas = $datosHistoria["SignosSintomas"] ?? 'Sin datos';
$relato = $datosHistoria["RelatoCronologico"] ?? 'Sin datos';
$funciones = $datosHistoria["FuncionesBiologicas"] ?? 'Normales';

$pdf->CampoCompacto('Signos y Sintomas', $sintomas);
$pdf->CampoCompacto('Relato Cronologico', $relato);
$pdf->CampoCompacto('Funciones Biologicas', $funciones);

// ========== ANTECEDENTES ==========
$pdf->SectionHeader('ANTECEDENTES');

$antFam = $datosHistoria["AntecedentesFamiliares"] ?? 'Sin datos';
$antPer = $datosHistoria["AntecedentesPersonales"] ?? 'Sin datos';

$pdf->CampoCompacto('Familiares', $antFam);
$pdf->CampoCompacto('Personales', $antPer);

// ========== EXPLORACION FISICA ==========
$pdf->SectionHeader('EXPLORACION FISICA');

$pdf->SetFont('DejaVu', 'B', 7);
$pdf->SetTextColor(50, 50, 50);
$pdf->Cell(0, 3.5, 'Signos Vitales:', 0, 1);
$pdf->Ln(0.8);

$pdf->TablaSignosVitales($datosHistoria);

$examen = $datosHistoria["ExamenOdonto"] ?? 'Normal';
$pdf->CampoCompacto('Examen Odonto', $examen);

// ========== DIAGNOSTICO ==========
$pdf->SectionHeader('DIAGNOSTICO (CIE-10)');

$diagPres = $datosHistoria["DiagnosticoPresuntivo"] ?? 'Por determinar';
$diagDef = $datosHistoria["DiagnosticoDefinitivo"] ?? 'Por determinar';

$pdf->CampoCompacto('Presuntivo', $diagPres);
$pdf->CampoCompacto('Definitivo', $diagDef);

// ========== PRONOSTICO Y TRATAMIENTO ==========
$pdf->SectionHeader('PRONOSTICO Y TRATAMIENTO');

$pronostico = $datosHistoria["Pronostico"] ?? 'Favorable';
$tratamiento = $datosHistoria["TratamientoPaciente"] ?? 'Por determinar';

$pdf->CampoCompacto('Pronostico', $pronostico);
$pdf->CampoCompacto('Tratamiento', $tratamiento);

// ========== FIRMA ==========
$yFirmaMin = 266;
if ($pdf->GetY() < $yFirmaMin) {
    $pdf->SetY($yFirmaMin);
} else {
    $pdf->Ln(2);
}
$pdf->SetFont('DejaVu', 'B', 7);
$pdf->SetTextColor(50, 50, 50);
$pdf->Cell(95, 3, 'Profesional:', 0, 0);
$pdf->Cell(95, 3, 'Fecha:', 0, 1);

$pdf->Ln(6);
$pdf->SetDrawColor(100, 100, 100);
$pdf->SetLineWidth(0.3);
$pdf->Line(15, $pdf->GetY(), 100, $pdf->GetY());
$pdf->SetX(110);
$pdf->Line(110, $pdf->GetY(), 195, $pdf->GetY());

$pdf->Ln(2);
$pdf->SetFont('DejaVu', '', 6);
$pdf->SetTextColor(150, 150, 150);
$pdf->Cell(85, 3, 'Nombre y Firma', 0, 0, 'C');
$pdf->SetX(110);
$pdf->Cell(85, 3, 'dd/mm/yyyy', 0, 1, 'C');

// Generar PDF
$pdf->Output();
?>

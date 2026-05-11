<?php
date_default_timezone_set('America/Lima');

/**
 * ControllerVisitas — Fusionado ortho-center (A) + dentavitalis (B)
 *
 * Mezcla la lógica robusta de A (creación/eliminación automática de Pagos vinculados)
 * con los nuevos campos introducidos en B (ObservacionVisita).
 */
class ControllerVisitas
{
  // Mostrar visitas del paciente
  public static function ctrMostrarVisitasPaciente($codHistoria)
  {
    $tabla = "tba_visita";
    $listaVisitas = ModelVisitas::mdlMostrarVisitasPaciente($tabla, $codHistoria);
    return $listaVisitas;
  }

  // Guardar arreglos dinámicos de visitas desde la historia clínica
  public static function ctrEditarVisitas()
  {
    if (isset($_POST["codHistoria"]) && isset($_POST["codPaciente"])) {
      $codHistoria = $_POST["codHistoria"];
      $codPaciente = $_POST["codPaciente"];

      $listaVisitas = json_decode($_POST["listarNuevaListaVisitas"], true);
      foreach ($listaVisitas as $value) {

        // LÓGICA A: Si se ingresó un pago, registrarlo primero para vincularlo a la visita
        if (isset($value["pagoVisita"]) && $value["pagoVisita"] != "" && $value["pagoVisita"] != null) {
          $datosPago = array(
            "IdPaciente"        => $codPaciente,
            "IdHistoriaClinica" => $codHistoria,
            "TotalPagado"       => $value["pagoVisita"],
            "FechaPago"         => $value["fechaVisita"],
            "ObservacionPago"   => "Pago registrado en visita de la fecha: " . $value["fechaVisita"],
            "FechaCreacion"     => date("Y-m-d\TH:i:sP"),
            "FechaActualizacion"=> date("Y-m-d\TH:i:sP"),
          );
          ControllerPagos::ctrCrearPagoVisita($datosPago);
          
          $totalPagadoActual = ControllerTratamiento::ctrObtenerTotalPagado($codPaciente);
          $nuevoTotal = $value["pagoVisita"] + $totalPagadoActual["TotalPagado"];
          ControllerTratamiento::ctrActualizarTotal($nuevoTotal, $codPaciente);
          
          $ultimoPago = ControllerPagos::ctrObtenerUltimoPagoRealizado();
          $codPago = $ultimoPago["Id"];
        } else {
          $codPago = "";
        }

        // LÓGICA A+B: Unificar IdPago de A con ObservacionVisita de B
        $datosVisita = array(
          "IdHistoriaClinica"    => $codHistoria,
          "IdPago"               => $codPago,                                 // De A
          "IdDetalleTratamiento" => $value["referenciaVisita"],
          "MotivoVisita"         => $value["motivoVisita"],
          "FechaVisita"          => $value["fechaVisita"],
          "ObservacionVisita"    => $value["observacionVisita"] ?? "",        // De B
          "UsuarioCreado"        => $_SESSION["idUsuario"],
          "UsuarioActualiza"     => $_SESSION["idUsuario"],
          "FechaCreacion"        => date("Y-m-d\TH:i:sP"),
          "FechaActualizacion"   => date("Y-m-d\TH:i:sP")
        );
        $respuestaIngresar = self::ctrIngresarVisitas($datosVisita);
      }

      if ($respuestaIngresar == "ok") {
        echo '<script>Swal.fire({ icon: "success", title: "Correcto", text: "Visitas Guardadas Correctamente!" }).then(function(result){ if(result.value){ window.location = "historiaClinica"; } });</script>';
      } else {
        echo '<script>Swal.fire({ icon: "error", title: "Error", text: "¡Error al Guardar los Cambios!" }).then(function(result){ if(result.value){ window.location = "historiaClinica"; } });</script>';
      }
    }
  }

  // Ingresar nuevas visitas (interno)
  public static function ctrIngresarVisitas($datosCreate)
  {
    $tabla = "tba_visita";
    $respuesta = ModelVisitas::mdlIngresarVisitas($tabla, $datosCreate);
    return $respuesta;
  }

  // LÓGICA A: Eliminar la visita, borrando su pago en cascada si existe
  public static function ctrEliminarUnaVisita($codVisita)
  {
    $tabla = "tba_visita";
    $codPago = self::ctrObtenerCodPago($codVisita);
    
    // Si la visita tenía pago vinculado, eliminarlo
    if ($codPago && ($codPago["IdPago"] != "" && $codPago["IdPago"] != null)) {
      $respuestaPago = ControllerPagos::ctrEliminarPagoVisita($codPago["IdPago"]);
      if ($respuestaPago == "ok") {
        $respuesta = ModelVisitas::mdlEliminarUnaVisita($tabla, $codVisita);
      } else {
        $respuesta = "error";
      }
    } else {
      $respuesta = ModelVisitas::mdlEliminarUnaVisita($tabla, $codVisita);
    }
    return $respuesta;
  }

  // LÓGICA A: Obtener el IdPago asociado a esta visita
  public static function ctrObtenerCodPago($codVisita)
  {
    $tabla = "tba_visita";
    $respuesta = ModelVisitas::mdlObtenerCodPago($tabla, $codVisita);
    return $respuesta;
  }

  // LÓGICA A: Mostrar historial completo (usado en reportes)
  public static function ctrMostrarHistorialVisitas($codHistoria)
  {
    $tabla = "tba_visita";
    $listaVisitas = ModelVisitas::mdlMostrarHistorialVisitas($tabla, $codHistoria);
    return $listaVisitas;
  }

  // LÓGICA A: Eliminar en cascada todas las visitas de una historia 
  public static function ctrEliminarVisitas($codHistoria)
  {
    $tabla = "tba_visita";
    $eliminarVisita = ModelVisitas::mdlEliminarVisitas($tabla, $codHistoria);
    return $eliminarVisita;
  }
}

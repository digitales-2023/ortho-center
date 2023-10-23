<?php
date_default_timezone_set('America/Lima');
class ControllerVisitas
{
  //  Listar visitas
  public static function ctrMostrarVisitasPaciente($codHistoria)
  {
    $tabla = "tba_visita";
    $listaVisitas = ModelVisitas::mdlMostrarVisitasPaciente($tabla, $codHistoria);
    return $listaVisitas;
  }

  //  Guardar los datos de las visitas
  public static function ctrEditarVisitas()
  {
    if (isset($_POST["codHistoria"]) && isset($_POST["codPaciente"])) {
      $codHistoria = $_POST["codHistoria"];
      $codPaciente = $_POST["codPaciente"];

      $listaVisitas = json_decode($_POST["listarNuevaListaVisitas"], true);
      foreach ($listaVisitas as $value) {
        //  Si el pago que se registra es nulo o vacío, no se crea un pago por ningún concepto, caso contrario, se tiene que crear primera el pago y luego crear la visita con el codigo de pago
        if ($value["pagoVisita"] != "" || $value["pagoVisita"] != null) {
          $datosPago = array(
            "IdPaciente" => $codPaciente,
            "IdHistoriaClinica" => $codHistoria,
            "TotalPagado" => $value["pagoVisita"],
            "FechaPago" => $value["fechaVisita"],
            "ObservacionPago" => "Pago registrado en visita de la fecha: " . $value["fechaVisita"],
            "FechaCreacion" => date("Y-m-d") . ' ' . date('H:i:s'),
            "FechaActualizacion" => date("Y-m-d") . ' ' . date('H:i:s'),
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
        $datosVisita = array(
          "IdHistoriaClinica" => $codHistoria,
          "IdPago" => $codPago,
          "IdDetalleTratamiento" => $value["referenciaVisita"],
          "MotivoVisita" => $value["motivoVisita"],
          "FechaVisita" => $value["fechaVisita"],
          "UsuarioCreado" => $_SESSION["idUsuario"],
          "UsuarioActualiza" => $_SESSION["idUsuario"],
          "FechaCreacion" => date("Y-m-d") . ' ' . date('H:i:s'),
          "FechaActualizacion" => date("Y-m-d") . ' ' . date('H:i:s')
        );
        $respuestaIngresar = self::ctrIngresarVisitas($datosVisita);
      }
      if ($respuestaIngresar == "ok") {
        echo '
            <script>
              Swal.fire({
                icon: "success",
                title: "Correcto",
                text: "Visitas Guardadas Correctamente!",
              }).then(function(result){
                if(result.value){
                  window.location = "historiaClinica";
                }
              });
            </script>';
      } else {
        echo '
            <script>
              Swal.fire({
                icon: "error",
                title: "Error",
                text: "¡Error al Guardar los Cambios!",
              }).then(function(result){
                if(result.value){
                  window.location = "historiaClinica";
                }
              });
            </script>';
      }
    }
  }


  //  Ingresar las nuevas visitas
  public static function ctrIngresarVisitas($datosCreate)
  {
    $tabla = "tba_visita";
    $respuesta = ModelVisitas::mdlIngresarVisitas($tabla, $datosCreate);
    return $respuesta;
  }

  //  Eliminar una visita por codVisita
  public static function ctrEliminarUnaVisita($codVisita)
  {
    $tabla = "tba_visita";
    $codPago = self::ctrObtenerCodPago($codVisita);
    if ($codPago["IdPago"] != "" || $codPago["IdPago"] != null) {
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

  //  Obtener el codigo de pago a partir del codigo de la visita
  public static function ctrObtenerCodPago($codVisita)
  {
    $tabla = "tba_visita";
    $respuesta = ModelVisitas::mdlObtenerCodPago($tabla, $codVisita);
    return $respuesta;
  }

  //  Mostrar el historial de visitas por el codigo de historia clínica
  public static function ctrMostrarHistorialVisitas($codHistoria)
  {
    $tabla = "tba_visita";
    $listaVisitas = ModelVisitas::mdlMostrarHistorialVisitas($tabla, $codHistoria);
    return $listaVisitas;
  }

  //  Eliminar las visitas que tengan el codigo de la historia clínica
  public static function ctrEliminarVisitas($codHistoria)
  {
    $tabla = "tba_visita";
    $eliminarVisita = ModelVisitas::mdlEliminarVisitas($tabla, $codHistoria);
    return $eliminarVisita;
  }
}

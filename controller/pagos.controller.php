<?php
date_default_timezone_set('America/Lima');
class ControllerPagos
{
  //  Mostrar todo los pagos realizados hasta el momento
  public static function ctrMostrarTodosLosPagos()
  {
    $tabla = "tba_pago";
    $listaPagos = ModelPagos::mdlMostrarTodosLosPagos($tabla);
    return $listaPagos;
  }

  //  Generar un nuevo pago
  public static function ctrGenerarNuevoPago($datosCreate)
  {
    $tabla = "tba_pago";

    $respuestaPago = ModelPagos::mdlIngresarNuevoPago($tabla, $datosCreate);
    if ($respuestaPago == "ok") {
      //  Actualizamos el total y luego corroboramos si tiene un archivo, de ser asi lo subimos, caso contrario arrojamos en success
      $totalPagadoActual = ControllerTratamiento::ctrObtenerTotalPagado($datosCreate["IdPaciente"]);
      $nuevoTotal = $datosCreate["TotalPago"] + $totalPagadoActual["TotalPagado"];
      $respuestaTotal = ControllerTratamiento::ctrActualizarTotal($nuevoTotal, $datosCreate["IdPaciente"]);
      if ($respuestaTotal == "ok") {
        //  Obtengo el último pago que se realizo para poner ese valor como nombre del comprobante, esto para que se guarde con un valor único y evite que sobreescriba archivos      
        if (isset($_FILES["comprobantePago"])) {
          $respuesta = "error";
          $ultimoPago = self::ctrObtenerUltimoPagoRealizado();
          if ($_FILES["comprobantePago"]["type"] == "image/jpeg" || $_FILES["comprobantePago"]["type"] == "image/jpg" || $_FILES["comprobantePago"]["type"] == "image/png" || $_FILES["comprobantePago"]["type"] == "application/pdf") {
            $formato = explode('/', $_FILES["comprobantePago"]["type"]);
            //  Le ponemos nombre compuesta de fecha de pago, idpaciente, idtipopago, idtratamiento y el tipo de archivo que es
            $nombreArchivo = $datosCreate["FechaPago"] . '_' . $datosCreate["IdPaciente"] . '_' . $datosCreate["IdTipoPago"] . '_' . $totalPagadoActual["IdTratamiento"] . '_' . $ultimoPago["Id"] . '.' . $formato[1];
            $ruta = "../image/voucher/$nombreArchivo";
            //  Subimos el archivo y nos arroja true si se subió y false caso contrario


            $resultado = move_uploaded_file($_FILES["comprobantePago"]["tmp_name"], $ruta);


            //  Actualizar la ruta en la base de datos
            $actualizarRuta = self::ctrActualizarRuta($nombreArchivo, $ultimoPago["Id"]);
            if ($resultado == true) {
              $respuesta = "ok";
            } else {
              $respuesta = "error";
            }
          } else {
            $respuesta = "errorFormato";
          }
        } else {
          $respuesta = "ok";
        }
      } else {
        $respuesta = "error";
      }
    } else {
      $respuesta = "error";
    }
    return $respuesta;
  }

  //  Mostrar los datos para editar un pago
  public static function ctrMostrarDatosEditar($codPagoEditar)
  {
    $tabla = "tba_pago";
    $datosEditar = ModelPagos::mdlMostrarDatosEditar($tabla, $codPagoEditar);
    return $datosEditar;
  }

  //  Mostrar todos los pagos de un paciente
  public static function ctrMostrarPagosPorPaciente($codPaciente)
  {
    $tabla = "tba_pago";
    $listaPagosPaciente = ModelPagos::mdlMostrarPagosPorPaciente($tabla, $codPaciente);
    return $listaPagosPaciente;
  }

  //  Obtener el ultimo pago registrado
  public static function ctrObtenerUltimoPagoRealizado()
  {
    $tabla = "tba_pago";
    $respuesta = ModelPagos::mdlObtenerUltimoPagoRealizado($tabla);
    return $respuesta;
  }

  //  Actualizar la ruta del pago
  public static function ctrActualizarRuta($nombreArchivo, $codPago)
  {
    $tabla = "tba_pago";
    $respuesta = ModelPagos::mdlActualizarRuta($tabla, $nombreArchivo, $codPago);
    return $respuesta;
  }

  //  Descargar un voucher
  public static function ctrDescargarPago($codPago)
  {
    $tabla = "tba_pago";
    $rutaVoucher = ModelPagos::mdlDescargarPago($tabla, $codPago);
    $archivo = $rutaVoucher["ComprobantePago"];
    $ruta = "image/voucher/" . $archivo;

    $respuesta = array(
      "archivo" => $archivo,
      "ruta" => $ruta
    );

    return $respuesta;
  }

  //  Verificar el uso del paciente en un pago
  public static function ctrVerificarUsoPaciente($codPaciente)
  {
    $tabla = "tba_pago";
    $contarUso = ModelPagos::mdlVerificarUsoPaciente($tabla, $codPaciente);
    return $contarUso;
  }

  // Mostrar la lista de pacientes con los pagos en cada uno
  public static function ctrMostrarListaPacientesTratamiento()
  {
    $tabla = "tba_paciente";
    $listaTratamientoPagos = ModelPagos::mdlMostrarListaPacientesTratamiento($tabla);
    return $listaTratamientoPagos;
  }

  //  Crear nueva lista de pagos vacía al crear la historia
  public static function ctrCrearListaPagos($codPaciente, $codHistoriaClinica)
  {
    $tabla = "tba_pago";
    $datosCreate = array(
      "IdPaciente" => $codPaciente,
      "IdHistoriaClinica" => $codHistoriaClinica,
      "FechaCreacion" => date("Y-m-d") . ' ' . date('H:i:s'),
      "FechaActualizacion" => date("Y-m-d") . ' ' . date('H:i:s'),
    );
    $respuesta = ModelPagos::mdlCrearListaPagos($tabla, $datosCreate);
    return $respuesta;
  }

  //  Crear un pago a partir de una visita
  public static function ctrCrearPagoVisita($datosPago)
  {
    $tabla = "tba_pago";
    $respuesta = ModelPagos::mdlCrearPagoVisita($tabla, $datosPago);
    return $respuesta;
  }

  //  Eliminar un pago a partir de la visita
  public static function ctrEliminarPagoVisita($codPago)
  {
    $tabla = "tba_pago";
    $respuesta = ModelPagos::mdlEliminarPago($tabla, $codPago);
    return $respuesta;
  }
}

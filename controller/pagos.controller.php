<?php
date_default_timezone_set('America/Lima');

/**
 * ControllerPagos — Fusionado ortho-center (A) + dentavitalis (B)
 *
 * Métodos de A incorporados:
 *  - ctrCrearListaPagos: crea registro vacío al crear historia clínica
 *  - ctrCrearPagoVisita: crea un pago desde el flujo de visitas
 *  - ctrEliminarPagoVisita: elimina un pago ligado a una visita
 *  - ctrMostrarListaPacientesTratamiento: muestra lista de pacientes con pagos
 *
 * Métodos nuevos de B incorporados:
 *  - ctrMostrarTiposPago: lista los tipos de pago disponibles
 *  - ctrEliminarPago: eliminación con confirmación SweetAlert
 *  - ctrEditarPago: edita un pago existente (con soporte de comprobante)
 *  - ctrMostrarTotalPorPaciente: totales de tratamiento por paciente
 */
class ControllerPagos
{
  // ── LISTAR ──────────────────────────────────────────────────────────────

  // Mostrar todos los pagos realizados
  public static function ctrMostrarTodosLosPagos()
  {
    $tabla = "tba_pago";
    $listaPagos = ModelPagos::mdlMostrarTodosLosPagos($tabla);
    return $listaPagos;
  }

  // [NUEVO B] Mostrar los tipos de pago disponibles
  public static function ctrMostrarTiposPago()
  {
    $tabla = "tba_tipodepago";
    $listaTiposPago = ModelPagos::mdlMostrarTiposDePago($tabla);
    return $listaTiposPago;
  }

  // Mostrar todos los pagos de un paciente
  public static function ctrMostrarPagosPorPaciente($codPaciente)
  {
    $tabla = "tba_pago";
    $listaPagosPaciente = ModelPagos::mdlMostrarPagosPorPaciente($tabla, $codPaciente);
    return $listaPagosPaciente;
  }

  // Mostrar la lista de pacientes con los totales de pagos por tratamiento (de A)
  public static function ctrMostrarListaPacientesTratamiento()
  {
    $tabla = "tba_paciente";
    $listaTratamientoPagos = ModelPagos::mdlMostrarListaPacientesTratamiento($tabla);
    return $listaTratamientoPagos;
  }

  // [NUEVO B] Mostrar totales de tratamiento por paciente (query de B, más completo)
  public static function ctrMostrarTotalPorPaciente()
  {
    $tabla = "tba_pago";
    $listaCostoTratamientos = ModelPagos::mdlMostrarTotalPorPaciente($tabla);
    return $listaCostoTratamientos;
  }

  // Mostrar los datos de un pago para editar
  public static function ctrMostrarDatosEditar($codPagoEditar)
  {
    $tabla = "tba_pago";
    $datosEditar = ModelPagos::mdlMostrarDatosEditar($tabla, $codPagoEditar);
    return $datosEditar;
  }

  // Obtener el último pago registrado (para nombre único del comprobante)
  public static function ctrObtenerUltimoPagoRealizado()
  {
    $tabla = "tba_pago";
    $respuesta = ModelPagos::mdlObtenerUltimoPagoRealizado($tabla);
    return $respuesta;
  }

  // Descargar un voucher de pago
  public static function ctrDescargarPago($codPago)
  {
    $tabla       = "tba_pago";
    $rutaVoucher = ModelPagos::mdlDescargarPago($tabla, $codPago);
    $archivo     = $rutaVoucher["ComprobantePago"];
    return array(
      "archivo" => $archivo,
      "ruta"    => "image/voucher/" . $archivo
    );
  }

  // Verificar el uso de un paciente en pagos (antes de eliminar paciente)
  public static function ctrVerificarUsoPaciente($codPaciente)
  {
    $tabla = "tba_pago";
    $contarUso = ModelPagos::mdlVerificarUsoPaciente($tabla, $codPaciente);
    return $contarUso;
  }

  // ── CREAR ────────────────────────────────────────────────────────────────

  // Generar un nuevo pago con soporte de comprobante adjunto
  public static function ctrGenerarNuevoPago($datosCreate)
  {
    $tabla        = "tba_pago";
    $respuestaPago = ModelPagos::mdlIngresarNuevoPago($tabla, $datosCreate);

    if ($respuestaPago == "ok") {
      $totalPagadoActual = ControllerTratamiento::ctrObtenerTotalPagado($datosCreate["IdPaciente"]);
      $nuevoTotal        = $datosCreate["TotalPago"] + $totalPagadoActual["TotalPagado"];
      $respuestaTotal    = ControllerTratamiento::ctrActualizarTotal($nuevoTotal, $datosCreate["IdPaciente"]);

      if ($respuestaTotal == "ok") {
        if (isset($_FILES["comprobantePago"])) {
          $respuesta = "error";
          $ultimoPago = self::ctrObtenerUltimoPagoRealizado();
          $tipos = ["image/jpeg", "image/jpg", "image/png", "application/pdf"];
          if (in_array($_FILES["comprobantePago"]["type"], $tipos)) {
            $formato       = explode('/', $_FILES["comprobantePago"]["type"]);
            $nombreArchivo = $datosCreate["FechaPago"] . '_' . $datosCreate["IdPaciente"] . '_' . $datosCreate["IdTipoPago"] . '_' . $totalPagadoActual["IdTratamiento"] . '_' . $ultimoPago["Id"] . '.' . $formato[1];
            $ruta          = "../image/voucher/$nombreArchivo";
            $resultado     = move_uploaded_file($_FILES["comprobantePago"]["tmp_name"], $ruta);
            self::ctrActualizarRuta($nombreArchivo, $ultimoPago["Id"]);
            $respuesta = ($resultado == true) ? "ok" : "error";
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

  // Crear el registro inicial de pago al crear una historia clínica (de A)
  public static function ctrCrearListaPagos($codPaciente, $codHistoriaClinica)
  {
    $tabla = "tba_pago";
    $datosCreate = array(
      "IdPaciente"        => $codPaciente,
      "IdHistoriaClinica" => $codHistoriaClinica,
      "FechaCreacion"     => date("Y-m-d\TH:i:sP"),
      "FechaActualizacion"=> date("Y-m-d\TH:i:sP"),
    );
    $respuesta = ModelPagos::mdlCrearListaPagos($tabla, $datosCreate);
    return $respuesta;
  }

  // Crear un pago desde el flujo de visitas (de A)
  public static function ctrCrearPagoVisita($datosPago)
  {
    $tabla     = "tba_pago";
    $respuesta = ModelPagos::mdlCrearPagoVisita($tabla, $datosPago);
    return $respuesta;
  }

  // ── EDITAR ───────────────────────────────────────────────────────────────

  // [NUEVO B] Editar un pago existente con soporte de nuevo comprobante
  public static function ctrEditarPago()
  {
    if (isset($_POST["codPacienteEditado"])) {
      $tabla      = "tba_pago";
      $datosUpdate = array(
        "IdPaciente"        => $_POST["codPacienteEditado"],
        "IdTipoPago"        => $_POST["editarTipoPago"],
        "TotalPago"         => $_POST["editarMontoPago"],
        "ObservacionPago"   => $_POST["editarObservacion"],
        "FechaPago"         => $_POST["editarFechaPago"],
        "FechaActualizacion"=> date("Y-m-d\TH:i:sP"),
        "IdPago"            => $_POST["codPagoEdit"],
      );
      ModelPagos::mdlUpdatePago($tabla, $datosUpdate);

      $totalPagadoActual = ControllerTratamiento::ctrObtenerTotalPagado($datosUpdate["IdPaciente"]);
      $nuevoTotal        = $datosUpdate["TotalPago"] + $totalPagadoActual["TotalPagado"];
      $respuestaTotal    = ControllerTratamiento::ctrActualizarTotal($nuevoTotal, $datosUpdate["IdPaciente"]);

      if ($respuestaTotal == "ok") {
        if (!empty($_FILES["editarComprobantePago"]["name"])) {
          $tipos = ["image/jpeg", "image/jpg", "image/png", "application/pdf"];
          if (in_array($_FILES["editarComprobantePago"]["type"], $tipos)) {
            $formato       = explode('/', $_FILES["editarComprobantePago"]["type"]);
            $nombreArchivo = $datosUpdate["FechaPago"] . '_' . $datosUpdate["IdPaciente"] . '_' . $datosUpdate["IdTipoPago"] . '_' . $totalPagadoActual["IdTratamiento"] . '_' . $datosUpdate["IdPago"] . '.' . $formato[1];
            $ruta          = "image/voucher/$nombreArchivo";
            $resultado     = move_uploaded_file($_FILES["editarComprobantePago"]["tmp_name"], $ruta);
            self::ctrActualizarRuta($nombreArchivo, $datosUpdate["IdPago"]);
            if ($resultado == true) {
              echo '<script>Swal.fire({ icon: "success", title: "Correcto", text: "Pago Editado Correctamente!" }).then(function(r){ if(r.value) window.location = "historialPagos"; });</script>';
            } else {
              echo '<script>Swal.fire({ icon: "error", title: "Error", text: "¡Error al intentar subir el Archivo!" }).then(function(r){ if(r.value) window.location = "historialPagos"; });</script>';
            }
          } else {
            echo '<script>Swal.fire({ icon: "warning", title: "Error", text: "No se acepta otro formato que no sea JPG, JPEG, PNG o PDF" }).then(function(r){ if(r.value) window.location = "historialPagos"; });</script>';
          }
        } else {
          echo '<script>Swal.fire({ icon: "success", title: "Correcto", text: "Pago Editado Correctamente!" }).then(function(r){ if(r.value) window.location = "historialPagos"; });</script>';
        }
      } else {
        echo '<script>Swal.fire({ icon: "error", title: "Error", text: "¡Error al intentar editar el Pago!" }).then(function(r){ if(r.value) window.location = "historialPagos"; });</script>';
      }
    }
  }

  // ── ELIMINAR ─────────────────────────────────────────────────────────────

  // [NUEVO B] Eliminar un pago con confirmación SweetAlert
  public static function ctrEliminarPago()
  {
    if (isset($_GET["codPago"])) {
      $tabla    = "tba_pago";
      $codPago  = $_GET["codPago"];
      $respuesta = ModelPagos::mdlEliminarPago($tabla, $codPago);
      if ($respuesta == "ok") {
        echo '<script>Swal.fire({ icon: "success", title: "Correcto", text: "Pago Eliminado Correctamente!" }).then(function(r){ if(r.value) window.location = "historialPagos"; });</script>';
      }
    }
  }

  // Eliminar un pago desde el flujo de visitas (de A)
  public static function ctrEliminarPagoVisita($codPago)
  {
    $tabla     = "tba_pago";
    $respuesta = ModelPagos::mdlEliminarPago($tabla, $codPago);
    return $respuesta;
  }

  // ── ARCHIVOS ─────────────────────────────────────────────────────────────

  // Actualizar la ruta del comprobante de pago
  public static function ctrActualizarRuta($nombreArchivo, $codPago)
  {
    $tabla     = "tba_pago";
    $respuesta = ModelPagos::mdlActualizarRuta($tabla, $nombreArchivo, $codPago);
    return $respuesta;
  }
}

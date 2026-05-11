<?php
date_default_timezone_set('America/Lima');

/**
 * ControllerTratamiento — Fusionado ortho-center (A) + dentavitalis (B)
 *
 * Cambios respecto a ortho-center original:
 *  - [NUEVO B] ctrObtenerUltimoTratamiento: obtiene el ID del último tratamiento creado
 *  - [NUEVO B] ctrCrearDetalleTratamiento: inserta un procedimiento al detalle de tratamiento
 *  - [NUEVO B] ctrMostrarDetalleTratamiento: lista procedimientos simplificada (sin estado)
 *  - [NUEVO B] ctrObtenerCodigoTratamiento: alias de ctrObtenerIdTratamiento (usado en eliminar historia)
 *  - [NUEVO B] ctrMostrarAtencionesMedicos: lista todas las atenciones por médico
 *  - [NUEVO B] ctrAgregarProcedimientos: agrega procedimientos de una cotización al tratamiento
 *  - ctrEditarPlanTratamiento: ahora incluye MedicoProcedimiento en los datos del detalle
 *  - ctrUpdatePrecioTratamiento: llama a mdlUpdatePrecioTratamiento (nombre corregido, sin typo de B)
 *  - ctrEliminarTratamiento: unifica las dos variantes (A usaba mdlEliminarDetalleActual; B usaba mdlEliminarTratamiento)
 */
class ControllerTratamiento
{
  // ── CREAR ────────────────────────────────────────────────────────────────

  // Crear un nuevo tratamiento (cabecera)
  public static function ctrCrearTratamiento($datosCreateTratamiento)
  {
    $tabla = "tba_tratamiento";
    $respuesta = ModelTratamiento::mdlCrearTratamiento($tabla, $datosCreateTratamiento);
    return $respuesta;
  }

  // [NUEVO B] Crear un procedimiento en el detalle de tratamiento
  public static function ctrCrearDetalleTratamiento($datosDetalleTratamiento)
  {
    $tabla = "tba_detalletratamiento";
    $respuesta = ModelTratamiento::mdlCrearDetalleTratamiento($tabla, $datosDetalleTratamiento);
    return $respuesta;
  }

  // ── OBTENER / LISTAR ─────────────────────────────────────────────────────

  // [NUEVO B] Obtener el último tratamiento creado (usado al crear historia)
  public static function ctrObtenerUltimoTratamiento()
  {
    $tabla = "tba_tratamiento";
    $respuesta = ModelTratamiento::mdlObtenerUltimoTratamiento($tabla);
    return $respuesta;
  }

  // Obtener el IdTratamiento de un paciente específico
  public static function ctrObtenerIdTratamiento($codPaciente)
  {
    $tabla = "tba_tratamiento";
    $respuesta = ModelTratamiento::mdlObtenerIdTratamiento($tabla, $codPaciente);
    return $respuesta;
  }

  // [NUEVO B] Alias de ctrObtenerIdTratamiento (nombre usado en ctrEliminarHistoria de B)
  public static function ctrObtenerCodigoTratamiento($codPaciente)
  {
    return self::ctrObtenerIdTratamiento($codPaciente);
  }

  // [NUEVO B] Mostrar lista simplificada de procedimientos de una historia (sin estado)
  public static function ctrMostrarDetalleTratamiento($codHistoria)
  {
    $tabla = "tba_detalletratamiento";
    $respuesta = ModelTratamiento::mdlMostrarDetalleTratamiento($tabla, $codHistoria);
    return $respuesta;
  }

  // Mostrar la lista completa de procedimientos (con estado y médico)
  public static function ctrMostrarDetalleTratamientoCompleto($codHistoria)
  {
    $tabla = "tba_detalletratamiento";
    $respuesta = ModelTratamiento::mdlMostrarDetalleTratamientoCompleto($tabla, $codHistoria);
    return $respuesta;
  }

  // Mostrar lista de procedimientos realizados (estado = 2)
  public static function ctrMostrarDetalleTratamientoRealizado($codHistoria)
  {
    $tabla = "tba_detalletratamiento";
    $respuesta = ModelTratamiento::mdlMostrarDetalleTratamientoEstado($tabla, $codHistoria, 2);
    return $respuesta;
  }

  // Mostrar lista de procedimientos pendientes (estado = 1)
  public static function ctrMostrarDetalleTratamientoFaltante($codHistoria)
  {
    $tabla = "tba_detalletratamiento";
    $respuesta = ModelTratamiento::mdlMostrarDetalleTratamientoEstado($tabla, $codHistoria, 1);
    return $respuesta;
  }

  // [NUEVO B] Mostrar el total del tratamiento por código de tratamiento
  public static function ctrMostrarTotalTratamiento($codTratamiento)
  {
    $tabla = "tba_tratamiento";
    $respuesta = ModelTratamiento::mdlMostrarTotalTratamiento($tabla, $codTratamiento);
    return $respuesta;
  }

  // Obtener el monto total pagado actualmente
  public static function ctrObtenerTotalPagado($codPaciente)
  {
    $tabla = "tba_tratamiento";
    $totalPagado = ModelTratamiento::mdlObtenerTotalPagado($tabla, $codPaciente);
    return $totalPagado;
  }

  // Obtener el monto pagado y total del tratamiento (para calcular deuda)
  public static function ctrObtenerTotalesTratamiento($codPaciente)
  {
    $tabla = "tba_tratamiento";
    $respuesta = ModelTratamiento::mdlObtenerTotalesTratamiento($tabla, $codPaciente);
    return $respuesta;
  }

  // Obtener el total de procedimientos realizados hasta ahora
  public static function ctrObtenerTotalRealizado($codHistoria)
  {
    $tabla = "tba_detalletratamiento";
    $respuesta = ModelTratamiento::mdlObtenerTotalRealizado($tabla, $codHistoria);
    return $respuesta;
  }

  // Mostrar los procedimientos de un paciente (para pagos)
  public static function ctrListarProcedimientosPaciente($codPaciente)
  {
    $tabla = "tba_tratamiento";
    $listarProcedimientos = ModelTratamiento::mdlListarProcedimientosPaciente($tabla, $codPaciente);
    return $listarProcedimientos;
  }

  // Mostrar el costo de un procedimiento específico del detalle
  public static function ctrMostrarCostoDetalle($codDetalleTratamiento)
  {
    $tabla = "tba_detalletratamiento";
    $precioTratamiento = ModelTratamiento::mdlMostrarCostoDetalle($tabla, $codDetalleTratamiento);
    return $precioTratamiento;
  }

  // Verificar si un procedimiento está en uso en algún plan de tratamiento
  public static function ctrVerificarUsoProcedimiento($codProcedimiento)
  {
    $tabla = "tba_detalletratamiento";
    $contarProcedimiento = ModelTratamiento::mdlVerificarUsoProcedimiento($tabla, $codProcedimiento);
    return $contarProcedimiento;
  }

  // [NUEVO B] Mostrar todas las atenciones realizadas por médicos
  public static function ctrMostrarAtencionesMedicos()
  {
    $tabla = "tba_detalletratamiento";
    $listaAtenciones = ModelTratamiento::mdlMostrarAtencionesMedicos($tabla);
    return $listaAtenciones;
  }

  // ── ACTUALIZAR ───────────────────────────────────────────────────────────

  // Actualizar el total del tratamiento según los procedimientos
  public static function ctrUpdatePrecioTratamiento($codTratamiento, $totalTratamiento)
  {
    $tabla = "tba_tratamiento";
    $respuesta = ModelTratamiento::mdlUpdatePrecioTratamiento($tabla, $codTratamiento, $totalTratamiento);
    return $respuesta;
  }

  // Actualizar el total pagado del tratamiento
  public static function ctrActualizarTotal($nuevoTotal, $codPaciente)
  {
    $tabla = "tba_tratamiento";
    $respuesta = ModelTratamiento::mldActualizarTotal($tabla, $nuevoTotal, $codPaciente);
    return $respuesta;
  }

  // Editar el plan de tratamiento — ahora incluye MedicoProcedimiento (de B)
  public static function ctrEditarPlanTratamiento()
  {
    if (isset($_POST["listarNuevaListaProcedimientos"])) {
      if ($_POST["listarNuevaListaProcedimientos"] != '') {
        $codPaciente             = $_GET["codPaciente"];
        $tablaDetalleTratamiento = "tba_detalletratamiento";
        $listaProcedimientos     = json_decode($_POST["listarNuevaListaProcedimientos"], true);
        $idTratamiento           = self::ctrObtenerIdTratamiento($codPaciente);

        // Limpiar el detalle actual para regenerarlo
        $respuestaEliminarDetalle = ModelTratamiento::mdlEliminarDetalleActual($tablaDetalleTratamiento, $idTratamiento["IdTratamiento"]);

        if ($respuestaEliminarDetalle == "ok") {
          $totalTratamiento        = $_POST["editarTotalTratamiento"];
          $respuestaUpdateTratamiento = self::ctrUpdatePrecioTratamiento($idTratamiento["IdTratamiento"], $totalTratamiento);

          if ($respuestaUpdateTratamiento == "ok") {
            foreach ($listaProcedimientos as $value) {
              // 2 = realizado, 1 = pendiente
              $estado = ($value["EstadoProcedimiento"] == true) ? '2' : '1';

              $datosDetalleTratamiento = array(
                "IdTratamiento"            => $idTratamiento["IdTratamiento"],
                "IdProcedimiento"          => $value["CodProcedimiento"],
                "ObservacionProcedimiento" => $value["ObservacionProcedimiento"],
                "MedicoProcedimiento"      => $value["MedicoProcedimiento"] ?? $_SESSION["idUsuario"],
                "EstadoTratamiento"        => $estado,
                "FechaProcedimiento"       => $value["FechaProcedimiento"],
                "PrecioProcedimiento"      => $value["PrecioProcedimiento"],
              );
              $respuestaDetalleTratamiento = ModelTratamiento::mdlCrearEditadoDetalleTratamiento($tablaDetalleTratamiento, $datosDetalleTratamiento);
            }

            if ($respuestaDetalleTratamiento == "ok") {
              echo '<script>Swal.fire({ icon: "success", title: "Correcto", text: "¡Plan de Tratamiento Actualizado Correctamente!" }).then(function(r){ if(r.value) window.location = "historiaClinica"; });</script>';
            } else {
              echo '<script>Swal.fire({ icon: "error", title: "Error", text: "¡Error al actualizar el detalle del tratamiento!" }).then(function(r){ if(r.value) window.location = "historiaClinica"; });</script>';
            }
          } else {
            echo '<script>Swal.fire({ icon: "error", title: "Error", text: "¡Error al actualizar el total del plan de tratamiento!" }).then(function(r){ if(r.value) window.location = "historiaClinica"; });</script>';
          }
        } else {
          echo '<script>Swal.fire({ icon: "error", title: "Error", text: "¡Error eliminar los procedimientos!" }).then(function(r){ if(r.value) window.location = "historiaClinica"; });</script>';
        }
      } else {
        echo '<script>Swal.fire({ icon: "warning", title: "Sin Modificaciones", text: "¡No se Modificaron los datos!" }).then(function(r){ if(r.value) window.location = "historiaClinica"; });</script>';
      }
    }
  }

  // ── ELIMINAR ─────────────────────────────────────────────────────────────

  // Eliminar tratamiento completo (detalle + cabecera)
  public static function ctrEliminarTratamiento($codTratamiento)
  {
    $tablaTratamiento        = "tba_tratamiento";
    $tablaDetalleTratamiento = "tba_detalletratamiento";

    // Eliminar detalle primero, luego la cabecera
    $confirmarDetalle = ModelTratamiento::mdlEliminarDetalleActual($tablaDetalleTratamiento, $codTratamiento);
    if ($confirmarDetalle == "ok") {
      $respuesta = ModelTratamiento::mdlEliminarTratamiento($tablaTratamiento, $codTratamiento);
      return $respuesta;
    } else {
      return "errorDetalle";
    }
  }

  // ── COTIZACIONES ─────────────────────────────────────────────────────────

  // [NUEVO B] Agregar procedimientos de una cotización al tratamiento del paciente
  public static function ctrAgregarProcedimientos($codPaciente, $codCotizacion)
  {
    $codTratamiento    = self::ctrObtenerCodigoTratamiento($codPaciente);
    $listaProcedimientos = ControllerCotizaciones::ctrObtenerListaProcedimientos($codCotizacion);
    $nuevoDetalle = "ok";

    foreach ($listaProcedimientos as $value) {
      $datosDetalle = array(
        "IdTratamiento"            => $codTratamiento["IdTratamiento"],
        "IdProcedimiento"          => $value["IdProcedimiento"],
        "EstadoTratamiento"        => "1",
        "MedicoProcedimiento"      => $_SESSION["idUsuario"],
        "ObservacionProcedimiento" => "",
        "PrecioProcedimiento"      => $value["TotalProcedimiento"],
      );
      $nuevoDetalle = self::ctrCrearDetalleTratamiento($datosDetalle);
    }
    return ($nuevoDetalle == "ok") ? "ok" : "error";
  }
}

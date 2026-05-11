<?php
date_default_timezone_set('America/Lima');

/**
 * ControllerCotizaciones — Módulo nuevo incorporado de dentavitalis (B)
 *
 * Este módulo permite hacer presupuestos. Si el paciente no existe, lo crea
 * primero. Si la cotización se aprueba, crea o actualiza la historia clínica
 * y el plan de tratamiento.
 */
class ControllerCotizaciones
{
  // Crear una nueva cotización
  public static function ctrCrearCotizacion()
  {
    if (isset($_POST["nombrePaciente"]) && isset($_POST["apellidoPaciente"]) && isset($_POST["dniPaciente"])) {
      // Si ya hay código de paciente, procedemos. Si no, creamos un paciente rápido.
      if (isset($_POST["codPaciente"])) {
        $respuestaPaciente = "ok";
      } else {
        $datosCreatePaciente = array(
          "NombrePaciente"       => $_POST["nombrePaciente"],
          "ApellidoPaciente"     => $_POST["apellidoPaciente"],
          "TipoIdentificacion"   => $_POST["tipoIdentificacion"],
          "NumeroIdentificacion" => $_POST["dniPaciente"],
          "CelularPaciente"      => $_POST["celularPaciente"],
          "UsuarioCreado"        => $_SESSION["idUsuario"],
          "UsuarioActualiza"     => $_SESSION["idUsuario"],
          "FechaCreacion"        => date("Y-m-d\TH:i:sP"),
          "FechaActualizacion"   => date("Y-m-d\TH:i:sP"),
        );
        $respuestaPaciente = ControllerPacientes::ctrCrearPacienteCotizacion($datosCreatePaciente);
      }

      if ($respuestaPaciente == "ok") {
        $codPaciente = ControllerPacientes::ctrBuscarPacienteDNI($_POST["dniPaciente"]);
        $tablaCotizacion        = "tba_cotizacion";
        $tablaDetalleCotizacion = "tba_detallecotizacion";

        $datosCreateCotizacion = array(
          "IdPaciente"         => $codPaciente["IdPaciente"],
          "TotalCotizacion"    => $_POST["nuevoTotalCotizacion"],
          "FechaCotizacion"    => $_POST["fechaCotizacion"],
          "EstadoCotizacion"   => "1",
          "UsuarioCreado"      => $_SESSION["idUsuario"],
          "UsuarioActualiza"   => $_SESSION["idUsuario"],
          "FechaCreacion"      => date("Y-m-d\TH:i:sP"),
          "FechaActualizacion" => date("Y-m-d\TH:i:sP"),
        );
        $respuestaCotizacion = ModelCotizaciones::mdlCrearCotizacion($tablaCotizacion, $datosCreateCotizacion);

        if ($respuestaCotizacion == "ok") {
          $listaDetalle     = json_decode($_POST["listarCotizaciones"], true);
          $ultimaCotizacion = ModelCotizaciones::mdlObtenerUltimaCotizacion($tablaCotizacion);

          foreach ($listaDetalle as $value) {
            $datosCreateDetalle = array(
              "IdCotizacion"             => $ultimaCotizacion["codCotizacion"],
              "IdProcedimiento"          => $value["CodProcedimiento"],
              "ObservacionProcedimiento" => $value["ObservacionCotizacion"],
              "CantidadProcedimiento"    => $value["CantidadCotizacion"],
              "PrecioUnitario"           => $value["PrecioUCotizacion"],
              "TotalProcedimiento"       => $value["PrecioTCotizacion"],
              "UsuarioCreado"            => $_SESSION["idUsuario"],
              "UsuarioActualiza"         => $_SESSION["idUsuario"],
              "FechaCreacion"            => date("Y-m-d\TH:i:sP"),
              "FechaActualizacion"       => date("Y-m-d\TH:i:sP"),
            );
            $respuestaDetalleCotizacion = ModelCotizaciones::mdlCrearDetalleCotizacion($tablaDetalleCotizacion, $datosCreateDetalle);
          }

          if ($respuestaDetalleCotizacion == "ok") {
            echo '<script>Swal.fire({ icon: "success", title: "Correcto", text: "Cotización Creada Correctamente!" }).then(function(r){ if(r.value) window.location = "cotizaciones"; });</script>';
          } else {
            echo '<script>Swal.fire({ icon: "error", title: "Error", text: "Error al crear la cotización!" }).then(function(r){ if(r.value) window.location = "cotizaciones"; });</script>';
          }
        } else {
          echo '<script>Swal.fire({ icon: "error", title: "Error", text: "Error al crear la cotización!" }).then(function(r){ if(r.value) window.location = "cotizaciones"; });</script>';
        }
      } else {
        echo '<script>Swal.fire({ icon: "error", title: "Error", text: "Error al crear el paciente!" }).then(function(r){ if(r.value) window.location = "cotizaciones"; });</script>';
      }
    }
  }

  // Mostrar todas las cotizaciones
  public static function ctrListarCotizaciones()
  {
    $tabla = "tba_cotizacion";
    $listaCotizaciones = ModelCotizaciones::mdlListarCotizaciones($tabla);
    return $listaCotizaciones;
  }

  // Editar la lista de elementos de la cotización
  public static function ctrEditarCotizacion()
  {
    if (isset($_POST["codCotizacion"])) {
      $tablaCotizacion = "tba_cotizacion";
      $tablaDetalle    = "tba_detalleCotizacion";
      $codCotizacion   = $_POST["codCotizacion"];

      $datosUpdate = array(
        "FechaCotizacion"    => $_POST["fechaCotizacion"],
        "TotalCotizacion"    => $_POST["nuevoTotalCotizacion"],
        "IdCotizacion"       => $_POST["codCotizacion"],
        "UsuarioActualiza"   => $_SESSION["idUsuario"],
        "FechaActualizacion" => date("Y-m-d\TH:i:sP"),
      );
      $respuestaUpdate = ModelCotizaciones::mdlUpdateCotizacion($tablaCotizacion, $datosUpdate);

      if ($respuestaUpdate == "ok") {
        $respuestaEliminar = ModelCotizaciones::mdlEliminarCotizacion($tablaDetalle, $codCotizacion);

        if ($respuestaEliminar == "ok") {
          $listaDetalle = json_decode($_POST["listarCotizaciones"], true);
          foreach ($listaDetalle as $value) {
            $datosCreateDetalle = array(
              "IdCotizacion"             => $codCotizacion,
              "IdProcedimiento"          => $value["CodProcedimiento"],
              "ObservacionProcedimiento" => $value["ObservacionCotizacion"],
              "CantidadProcedimiento"    => $value["CantidadCotizacion"],
              "PrecioUnitario"           => $value["PrecioUCotizacion"],
              "TotalProcedimiento"       => $value["PrecioTCotizacion"],
              "UsuarioCreado"            => $_SESSION["idUsuario"],
              "UsuarioActualiza"         => $_SESSION["idUsuario"],
              "FechaCreacion"            => date("Y-m-d\TH:i:sP"),
              "FechaActualizacion"       => date("Y-m-d\TH:i:sP"),
            );
            $respuestaDetalleCotizacion = ModelCotizaciones::mdlCrearDetalleCotizacion($tablaDetalle, $datosCreateDetalle);
          }
          if ($respuestaDetalleCotizacion == "ok") {
            echo '<script>Swal.fire({ icon: "success", title: "Correcto", text: "Cotización editada Correctamente!" }).then(function(r){ if(r.value) window.location = "cotizaciones"; });</script>';
          } else {
            echo '<script>Swal.fire({ icon: "error", title: "Error", text: "¡Error al intentar editar el detalle!" }).then(function(r){ if(r.value) window.location = "cotizaciones"; });</script>';
          }
        } else {
          echo '<script>Swal.fire({ icon: "error", title: "Error", text: "¡Error al tratar de eliminar el detalle actual!" }).then(function(r){ if(r.value) window.location = "cotizaciones"; });</script>';
        }
      }
    }
  }

  // Cambiar (forzar) el estado de la cotización
  public static function ctrCambiarEstadoCotizacion($estado, $codCotizacion)
  {
    $tabla = "tba_cotizacion";
    $respuestaEstado = ModelCotizaciones::mdlCambiarEstado($tabla, $estado, $codCotizacion);
    return $respuestaEstado;
  }

  // Obtener la lista de procedimientos presupuestados
  public static function ctrObtenerListaProcedimientos($codCotizacion)
  {
    $tabla = "tba_detallecotizacion";
    $listaProcedimientos = ModelCotizaciones::mdlObtenerListaProcedimientos($tabla, $codCotizacion);
    return $listaProcedimientos;
  }

  // Cambiar el estado de la cotización a Aprobada (e integrar módulo de historias)
  public static function ctrCambiarEstado()
  {
    if (isset($_GET["codCotizacionAprobar"])) {
      $codCotizacion = $_GET["codCotizacionAprobar"];
      $tabla  = "tba_cotizacion";
      $estado = 2; // Aprobado

      $codPaciente       = self::ctrObtenerPacienteCotizacion($codCotizacion);
      $verificarHistoria = ControllerHistorias::mdlVerificarHistoriaPaciente($codPaciente["IdPaciente"]);

      // Si tiene historia, agregamos procedimientos al plan actual
      if ($verificarHistoria["TotalHistorias"] > 0) {
        $agregarProcedimientos = ControllerTratamiento::ctrAgregarProcedimientos($codPaciente["IdPaciente"], $codCotizacion);
        if ($agregarProcedimientos == "ok") {
          $respuestaEstado = ModelCotizaciones::mdlCambiarEstado($tabla, $estado, $codCotizacion);
        } else {
          $respuestaEstado = "error";
        }
      } else {
        // No tiene historia: crear toda la estructura (Historia -> Tratamiento -> Detalle)
        $crearHistoria = ControllerHistorias::ctrCrearHistoriaCotizacion($codPaciente["IdPaciente"], $codCotizacion);
        if ($crearHistoria == "ok") {
          $respuestaEstado = ModelCotizaciones::mdlCambiarEstado($tabla, $estado, $codCotizacion);
        } else {
          $respuestaEstado = "error";
        }
      }

      if ($respuestaEstado == "ok") {
        echo '<script>Swal.fire({ icon: "success", title: "Correcto", text: "¡Cotización aprobada Correctamente!" }).then(function(r){ if(r.value) window.location = "cotizaciones"; });</script>';
      } else {
        echo '<script>Swal.fire({ icon: "error", title: "Error", text: "¡No se pudo aprobar la cotización!" }).then(function(r){ if(r.value) window.location = "cotizaciones"; });</script>';
      }
    }
  }

  // Eliminar cotización completa
  public static function ctrEliminarCotizacion()
  {
    if (isset($_GET["codCotizacionEliminar"]) && isset($_GET["codEstado"])) {
      $codCotizacion = $_GET["codCotizacionEliminar"];
      $tablaCabecera   = "tba_cotizacion";
      $tablaDetalle    = "tba_detallecotizacion";
      
      $eliminarDetalle = ModelCotizaciones::mdlEliminarCotizacion($tablaDetalle, $codCotizacion);

      if ($eliminarDetalle == "ok") {
        $eliminarCabecera = ModelCotizaciones::mdlEliminarCotizacion($tablaCabecera, $codCotizacion);
        if ($eliminarCabecera == "ok") {
          echo '<script>Swal.fire({ icon: "success", title: "Correcto", text: "¡Cotización eliminada Correctamente!" }).then(function(r){ if(r.value) window.location = "cotizaciones"; });</script>';
        } else {
          echo '<script>Swal.fire({ icon: "error", title: "Error", text: "¡No se pudo eliminar la cotización!" }).then(function(r){ if(r.value) window.location = "cotizaciones"; });</script>';
        }
      } else {
        echo '<script>Swal.fire({ icon: "error", title: "Error", text: "¡No se pudo eliminar el detalle de la cotización!" }).then(function(r){ if(r.value) window.location = "cotizaciones"; });</script>';
      }
    }
  }

  // Mostrar datos del paciente (cabecera)
  public static function ctrMostrarDatosCabecera($codCotizacion)
  {
    $tabla = "tba_cotizacion";
    $detalleCabecera = ModelCotizaciones::mdlMostrarDatosCabecera($tabla, $codCotizacion);
    return $detalleCabecera;
  }

  // Obtener código de paciente por código cotización
  public static function ctrObtenerPacienteCotizacion($codCotizacion)
  {
    $tabla = "tba_cotizacion";
    $codPaciente = ModelCotizaciones::mdlObtenerPacienteCotizacion($tabla, $codCotizacion);
    return $codPaciente;
  }
}

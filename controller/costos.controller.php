<?php
date_default_timezone_set('America/Lima');

/**
 * ControllerCostos — Módulo incorporado desde dentavitalis (B)
 *
 * Manejo de centros de costos y el detalle de gastos efectuados.
 */
class ControllerCostos
{
  // Mostrar los centros de costos
  public static function ctrMostrarCentrosCostos()
  {
    $tabla = "tba_centrocostos";
    $respuesta = ModelCostos::mdlMostrarCentrosCostos($tabla);
    return $respuesta;
  }

  // crear un nuevo centro de costos
  public static function ctrCrearCentroCostos()
  {
    if (isset($_POST["nombreCentroCostos"])) {
      $tabla = "tba_centrocostos";
      $datosCreate = array(
        "DescripcionCentro"  => $_POST["nombreCentroCostos"],
        "FechaCreacion"      => date("Y-m-d\TH:i:sP"),
        "FechaActualizacion" => date("Y-m-d\TH:i:sP")
      );

      $respuestaCrear = ModelCostos::mdlCrearCentroCostos($tabla, $datosCreate);
      if ($respuestaCrear == "ok") {
        echo '<script>Swal.fire({ icon: "success", title: "Correcto", text: "¡Centro de costos creado Correctamente!" }).then(function(r){ if(r.value) window.location = "centroCostos"; });</script>';
      } else {
        echo '<script>Swal.fire({ icon: "error", title: "Error", text: "¡Error al crear un Centro de Costos!" }).then(function(r){ if(r.value) window.location = "centroCostos"; });</script>';
      }
    }
  }

  // Editar un centro de costos
  public static function ctrEditarCentroCostos()
  {
    if (isset($_POST["editarNombreCentro"])) {
      $tabla = "tba_centrocostos";
      $datosUpdate = array(
        "IdCentroCostos"     => $_POST["codCentroCosto"],
        "DescripcionCentro"  => $_POST["editarNombreCentro"],
        "FechaActualizacion" => date("Y-m-d\TH:i:sP")
      );

      $respuestaUpdate = ModelCostos::mdlEditarCentroCostos($tabla, $datosUpdate);
      if ($respuestaUpdate == "ok") {
        echo '<script>Swal.fire({ icon: "success", title: "Correcto", text: "¡Centro de costos editado Correctamente!" }).then(function(r){ if(r.value) window.location = "centroCostos"; });</script>';
      } else {
        echo '<script>Swal.fire({ icon: "error", title: "Error", text: "¡Error al editar un Centro de Costos!" }).then(function(r){ if(r.value) window.location = "centroCostos"; });</script>';
      }
    }
  }

  // Eliminar un centro de costos
  public static function ctrEliminarCentroCostos()
  {
    if (isset($_GET["codCentroCosto"])) {
      $tabla = "tba_centrocostos";
      $codCentro = $_GET["codCentroCosto"];
      $respuesta = ModelCostos::mdlEliminarCentroCostos($tabla, $codCentro);
      if ($respuesta == "ok") {
        echo '<script>Swal.fire({ icon: "success", title: "Correcto", text: "Centro de Costos eliminado Correctamente!" }).then(function(r){ if(r.value) window.location = "centroCostos"; });</script>';
      }
    }
  }

  // Mostrar los datos a editar en el modal
  public static function ctrMostrarDatosEditar($codCentroCosto)
  {
    $tabla = "tba_centrocostos";
    $respuesta = ModelCostos::mdlMostrarDatosEditar($tabla, $codCentroCosto);
    return $respuesta;
  }

  // Mostrar todos los costos
  public static function ctrMostrarTodosCostos()
  {
    $tabla = "tba_costo";
    $listaCostos = ModelCostos::mdlMostrarAllCostos($tabla);
    return $listaCostos;
  }

  // Crear un nuevo costo (cabecera y detalle)
  public static function ctrCrearNuevoCosto()
  {
    if (isset($_POST["centroDeCostos"])) {
      $tablaCabecera = "tba_costo";
      $tablaDetalle  = "tba_detallecosto";
      $datosCabecera = array(
        "IdCentroCostos"     => $_POST["centroDeCostos"],
        "MesCosto"           => $_POST["mesIngresoGasto"],
        "TotalCosto"         => $_POST["nuevoTotalGasto"],
        "EstadoCosto"        => "1",
        "UsuarioCreado"      => $_SESSION["idUsuario"],
        "UsuarioActualiza"   => $_SESSION["idUsuario"],
        "FechaCreacion"      => date("Y-m-d\TH:i:sP"),
        "FechaActualizacion" => date("Y-m-d\TH:i:sP"),
      );

      $respuestaCabecera = ModelCostos::mdlIngresarNuevoCosto($tablaCabecera, $datosCabecera);
      $idUltimoCosto     = ModelCostos::mdlObtenerUltimoID($tablaCabecera);

      if ($respuestaCabecera == "ok") {
        $listaGastos = json_decode($_POST["listarGastos"], true);

        foreach ($listaGastos as $value) {
          $datosDetalle = array(
            "IdCosto"          => $idUltimoCosto["Id"],
            "IdGasto"          => $value["CodGasto"],
            "IdSocio"          => $value["Socio"],
            "NumeroDocumento"  => $value["NroDocumento"],
            "ObservacionGasto" => $value["Observacion"],
            "FechaCosto"       => $value["FechaDocumento"],
            "PrecioGasto"      => $value["PrecioGasto"],
          );
          $respuestaDetalle = ModelCostos::mdlIngresarDetalleCosto($tablaDetalle, $datosDetalle);
        }
        if ($respuestaDetalle == "ok") {
          echo '<script>Swal.fire({ icon: "success", title: "Correcto", text: "Costo registrado Correctamente!" }).then(function(r){ if(r.value) window.location = "index.php?ruta=allCostos"; });</script>';
        } else {
          echo '<script>Swal.fire({ icon: "error", title: "Error", text: "¡Error al registrar el detalle del costo!" }).then(function(r){ if(r.value) window.location = "index.php?ruta=allCostos"; });</script>';
        }
      } else {
        echo '<script>Swal.fire({ icon: "error", title: "Error", text: "¡Error al registrar la cabecera del costo!" }).then(function(r){ if(r.value) window.location = "index.php?ruta=allCostos"; });</script>';
      }
    }
  }

  // Obtener cabecera del costo
  public static function ctrObtenerCabaceraCosto($codCosto)
  {
    $tabla = "tba_costo";
    $datosCabecera = ModelCostos::mdlObtenerCabeceraCosto($tabla, $codCosto);
    return $datosCabecera;
  }

  // Obtener detalle del costo
  public static function ctrObtenerDetalleCosto($codCosto)
  {
    $tabla = "tba_detallecosto";
    $listaDetalle = ModelCostos::mdlObtenerDetalleCosto($tabla, $codCosto);
    return $listaDetalle;
  }

  // Editar costo
  public static function ctrEditarCosto()
  {
    if (isset($_POST["listarGastos"])) {
      $tablaCabecera = "tba_costo";
      $tablaDetalle  = "tba_detallecosto";
      
      $codCosto     = $_GET["codCosto"];
      $listaDetalle = json_decode($_POST["listarGastos"], true);

      if ($listaDetalle != null) {
        $eliminarDetalle  = ModelCostos::mdlEliminarDetalleCosto($tablaDetalle, $codCosto);
      } else {
        $eliminarDetalle  = "error";
        $respuestaDetalle = "ok";
      }

      if ($eliminarDetalle == "ok") {
        foreach ($listaDetalle as $value) {
          $datosDetalle = array(
            "IdCosto"          => $codCosto,
            "IdGasto"          => $value["CodGasto"],
            "IdSocio"          => $value["Socio"],
            "NumeroDocumento"  => $value["NroDocumento"],
            "ObservacionGasto" => $value["Observacion"],
            "FechaCosto"       => $value["FechaDocumento"],
            "PrecioGasto"      => $value["PrecioGasto"],
          );
          $respuestaDetalle = ModelCostos::mdlIngresarDetalleCosto($tablaDetalle, $datosDetalle);
        }
      }
        
      if ($respuestaDetalle == "ok") {
        $datosCabecera = array(
          "IdCosto"            => $codCosto,
          "MesCosto"           => $_POST["editarMesGasto"],
          "TotalCosto"         => $_POST["nuevoTotalGasto"],
          "UsuarioActualiza"   => $_SESSION["idUsuario"],
          "FechaActualizacion" => date("Y-m-d\TH:i:sP"),
        );

        $respuestaCabecera = ModelCostos::mdlEditarCabeceraCosto($tablaCabecera, $datosCabecera);
        if ($respuestaCabecera == "ok") {
          echo '<script>Swal.fire({ icon: "success", title: "Correcto", text: "Costo Editado Correctamente!" }).then(function(r){ if(r.value) window.location = "index.php?ruta=allCostos"; });</script>';
        } else {
          echo '<script>Swal.fire({ icon: "error", title: "Error", text: "¡Error al editar la cabecera del costo!" }).then(function(r){ if(r.value) window.location = "index.php?ruta=allCostos"; });</script>';
        }
      } else {
        echo '<script>Swal.fire({ icon: "error", title: "Error", text: "¡Error al editar el detalle del costo!" }).then(function(r){ if(r.value) window.location = "index.php?ruta=allCostos"; });</script>';
      }
    }
  }

  // Eliminar un costo
  public static function ctrEliminarCosto()
  {
    if (isset($_GET["codCosto"])) {
      $tablaCabecera = "tba_costo";
      $tablaDetalle  = "tba_detallecosto";
      $codCosto      = $_GET["codCosto"];
      
      $respuestaDetalle = ModelCostos::mdlEliminarDetalleCosto($tablaDetalle, $codCosto);

      if ($respuestaDetalle == "ok") {
        $respuestaCabecera = ModelCostos::mdlEliminarCabeceraCosto($tablaCabecera, $codCosto);
        if ($respuestaCabecera == "ok") {
          echo '<script>Swal.fire({ icon: "success", title: "Correcto", text: "Costo Eliminado Correctamente!" }).then(function(r){ if(r.value) window.location = "index.php?ruta=allCostos"; });</script>';
        } else {
          echo '<script>Swal.fire({ icon: "error", title: "Error", text: "¡Error al eliminar la cabecera del costo!" }).then(function(r){ if(r.value) window.location = "index.php?ruta=allCostos"; });</script>';
        }
      } else {
        echo '<script>Swal.fire({ icon: "error", title: "Error", text: "¡Error al eliminar el detalle del costo!" }).then(function(r){ if(r.value) window.location = "index.php?ruta=allCostos"; });</script>';
      }
    }
  }

  // Cerrar el costo, cambiar el estado
  public static function ctrCerrarCosto()
  {
    if (isset($_GET["codCerrarCosto"])) {
      $tabla = "tba_costo";
      $datos = array(
        "EstadoCosto"        => "2",
        "FechaActualizacion" => date("Y-m-d\TH:i:sP"),
        "IdCosto"            => $_GET["codCerrarCosto"],
      );

      $respuestaEstado = ModelCostos::mdlCambiarEstado($tabla, $datos);
      if ($respuestaEstado == "ok") {
        echo '<script>Swal.fire({ icon: "success", title: "Correcto", text: "¡Costo cerrado correctamente!" }).then(function(r){ if(r.value) window.location = "index.php?ruta=allCostos"; });</script>';
      } else {
        echo '<script>Swal.fire({ icon: "error", title: "Error", text: "¡Error al cerrar el costo!" }).then(function(r){ if(r.value) window.location = "index.php?ruta=allCostos"; });</script>';
      }
    }
  }

  // Obtener lista de costos por fechas
  public static function ctrMostrarCostosPorFechas($fechaInicial, $fechaFinal)
  {
    $tabla = "tba_costo";
    $listaCostos = ModelCostos::mdlMostrarCostosPorFechas($tabla, $fechaInicial, $fechaFinal);
    return $listaCostos;
  }

  // Validar estado para visual
  public static function ctrValidarEstado($estado)
  {
    if ($estado == "1") return "Abierto";
    else return "Cerrado";
  }

  // Sumatorio mensual dashboard
  public static function ctrSumarCostosMesActual()
  {
    $tabla = "tba_costo";
    $mesActual = date('Y-m');
    $sumaMesActual = ModelCostos::mdlSumarCostosMesActual($tabla, $mesActual);
    return $sumaMesActual;
  }

  // Centro de costos más alto
  public static function ctrSumarMayorCentroCostos()
  {
    $tabla = "tba_centrocostos";
    $mayorCosto = ModelCostos::mdlSumarMayorCentroCostos($tabla);
    return $mayorCosto;
  }

  // Mostrar costos por rango de meses
  public static function ctrMostrarCostosPorMeses($fechaInicial, $fechaFinal)
  {
    $tabla = "tba_centrocostos";
    $listaMesesCostos = ModelCostos::mldMostrarSumaCostosPorMeses($tabla, $fechaInicial, $fechaFinal);
    return $listaMesesCostos;
  }

  // Mostrar los costos por centro de costos
  public static function ctrMostrarCostosPorCentro($codCentroCosto)
  {
    $tabla = "tba_costo";
    $listaCentroCostos = ModelCostos::mldMostrarSumaCostosPorCentro($tabla, $codCentroCosto);
    foreach ($listaCentroCostos as &$value) {
      $mesCosto = ControllerFunciones::ctrConvertirMes($value["MesCosto"]);
      $value["MesCosto"] = $mesCosto;
    }
    unset($value);

    return $listaCentroCostos;
  }

  // Verificar si un socio (médico) tiene dependencias de costos
  public static function ctrVerificarUsoSocio($codSocio)
  {
    $tabla = "tba_detallecosto";
    $contarSocio = ModelCostos::mdlVerificarUsoSocio($tabla, $codSocio);
    return $contarSocio;
  }
}

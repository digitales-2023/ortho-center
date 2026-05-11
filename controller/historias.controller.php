<?php
date_default_timezone_set('America/Lima');

/**
 * ControllerHistorias — Fusionado ortho-center (A) + dentavitalis (B)
 *
 * Decisión de fusión: se usa el esquema de B como base (narrativo clínico completo)
 * que reemplaza el modelo de checkboxes de A. La BD de ortho-center ya tiene
 * la estructura de B en tba_historiaclinica (ver mapa_funcional.md §5.2).
 *
 * Cambios respecto a ortho-center original:
 *  - ctrCrearNuevaHistoria: flujo completo B (paciente→historia→detalle→tratamiento→procedimientos)
 *  - ctrMostrarCabeceraHistoria: sin el walk modificarValor (ya no hay checkboxes)
 *  - [NUEVO B] ctrMostrarDetalleHistoria: retorna detalle clínico (signos vitales, diagnóstico)
 *  - ctrEditarHistoria: flujo B (actualiza detalle de historia además de cabecera)
 *  - ctrEliminarHistoria: lógica B más robusta (verifica procedimientos realizados antes de eliminar)
 *  - [NUEVO B] ctrEliminarDetalleHistoria: elimina solo el detalle
 *  - ctrSubirOdontograma: usa NumeroIdentificacion en nombre de archivo (antes DNIPaciente)
 *  - [NUEVO B] ctrVerificarUsoSocio: verifica si un socio tiene historias asociadas
 *  - [NUEVO B] ctrCrearHistoriaCotizacion: crea historia+detalle+tratamiento desde cotización
 *  - [NUEVO B] mdlVerificarHistoriaPaciente (expuesto como controller): verifica si existe historia
 *  - [NUEVO B] ctrCrearDetalleHistoriaCotizacion: crea solo el detalle desde cotización
 */
class ControllerHistorias
{
  // ── LISTAR ──────────────────────────────────────────────────────────────

  // Mostrar todas las historias clínicas
  public static function ctrMostrarAllHistorias()
  {
    $tabla = "tba_historiaclinica";
    $listaHistorias = ModelHistorias::mdlMostrarAllHistorias($tabla);
    return $listaHistorias;
  }

  // Mostrar la cabecera de la historia (anamnesis, antecedentes)
  public static function ctrMostrarCabeceraHistoria($codHistoria)
  {
    $tabla = "tba_historiaclinica";
    $respuesta = ModelHistorias::mdlMostrarCabeceraHistoria($tabla, $codHistoria);
    return $respuesta;
  }

  // [NUEVO B] Mostrar el detalle clínico de la historia (signos vitales, diagnóstico, etc.)
  public static function ctrMostrarDetalleHistoria($codHistoria)
  {
    $tabla = "tba_detallehistoriaclinica";
    $respuesta = ModelHistorias::mdlMostrarDetalleHistoria($tabla, $codHistoria);
    return $respuesta;
  }

  // ── CREAR ────────────────────────────────────────────────────────────────

  /**
   * Crear nueva historia clínica — Flujo completo de B:
   * 1. Actualizar datos del paciente (extendidos)
   * 2. Crear cabecera de historia (anamnesis narrativa)
   * 3. Crear plan de tratamiento vacío
   * 4. Crear detalle de historia (signos vitales, diagnóstico)
   * 5. Agregar procedimientos al plan de tratamiento
   * 6. Actualizar total del tratamiento
   */
  public static function ctrCrearNuevaHistoria()
  {
    if (isset($_POST["nombrePaciente"])) {
      $tablaHistoria        = "tba_historiaclinica";
      $tablaDetalleHistoria = "tba_detallehistoriaclinica";

      // 1. Actualizar datos del paciente
      $datosUpdatePaciente = array(
        "IdPaciente"             => $_GET["codPaciente"],
        "NumeroIdentificacion"   => $_POST["numeroDNI"],
        "SexoPaciente"           => $_POST["sexoPaciente"],
        "EdadPaciente"           => $_POST["edadPaciente"],
        "FechaNacimiento"        => $_POST["fechaNacimiento"],
        "CelularPaciente"        => $_POST["celularPaciente"],
        "DomicilioPaciente"      => $_POST["domicilioPaciente"],
        "LugarProcedencia"       => $_POST["lugarProcedencia"],
        "LugarNacimiento"        => $_POST["lugarNacimiento"],
        "GradoInstruccion"       => $_POST["gradoInstruccion"],
        "RazaPaciente"           => $_POST["razaPaciente"],
        "OcupacionPaciente"      => $_POST["ocupacionPaciente"],
        "ReligionPaciente"       => $_POST["religionPaciente"],
        "EstadoCivil"            => $_POST["estadoCivil"],
        "NumeroContactoPaciente" => $_POST["numeroContacto"],
        "NombreContactoPaciente" => $_POST["personaContacto"],
        "UsuarioActualizado"     => $_SESSION["idUsuario"],
        "FechaActualizacion"     => date("Y-m-d\TH:i:sP"),
      );
      $respuestaPaciente = ControllerPacientes::ctrUpdateDatosPaciente($datosUpdatePaciente);

      if ($respuestaPaciente == "ok") {
        // 2. Crear cabecera de historia clínica
        $datosCreateHistoria = array(
          "IdPaciente"            => $_GET["codPaciente"],
          "IdSocio"               => $_SESSION["idUsuario"],
          "AlergiasEncontradas"   => $_POST["riesgoAlergia"],
          "DatosInformante"       => $_POST["datosInformante"],
          "MotivoConsulta"        => $_POST["motivoConsulta"],
          "TiempoEnfermedad"      => $_POST["tiempoEnfermedad"],
          "SignosSintomas"        => $_POST["signosySintomas"],
          "RelatoCronologico"     => $_POST["relatoCronologico"],
          "FuncionesBiologicas"   => $_POST["funcionesBiologicas"],
          "AntecedentesFamiliares"=> $_POST["antecedentesFamiliares"],
          "AntecedentesPersonales"=> $_POST["antecedentesPersonales"],
          "UsuarioCreado"         => $_SESSION["idUsuario"],
          "UsuarioActualizado"    => $_SESSION["idUsuario"],
          "FechaCreado"           => date("Y-m-d\TH:i:sP"),
          "FechaActualiza"        => date("Y-m-d\TH:i:sP"),
        );
        $respuestaHistoria = ModelHistorias::mdlCrearHistoriaClinica($tablaHistoria, $datosCreateHistoria);

        if ($respuestaHistoria == "ok") {
          // 3. Obtener ID de la historia y crear tratamiento vacío
          $ultimaHistoria = ModelHistorias::mdlObtenerUltimaHistoria($tablaHistoria);
          $datosCreateTratamiento = array(
            "IdHistoriaClinica" => $ultimaHistoria["Id"],
            "IdPaciente"        => $_GET["codPaciente"],
            "UsuarioCreado"     => $_SESSION["idUsuario"],
            "UsuarioActualiza"  => $_SESSION["idUsuario"],
            "FechaCreacion"     => date("Y-m-d\TH:i:sP"),
            "FechaActualizacion"=> date("Y-m-d\TH:i:sP"),
          );
          $respuestaTratamiento = ControllerTratamiento::ctrCrearTratamiento($datosCreateTratamiento);

          if ($respuestaTratamiento == "ok") {
            // 4. Crear detalle de historia (signos vitales, diagnóstico)
            $ultimoTratamiento = ControllerTratamiento::ctrObtenerUltimoTratamiento();
            $datosCreateDetalleHistoria = array(
              "IdHistoriaClinica"      => $ultimaHistoria["Id"],
              "IdTratamiento"          => $ultimoTratamiento["Id"],
              "PresionArterial"        => $_POST["presionArterial"],
              "Pulso"                  => $_POST["pulsoPaciente"],
              "Temperatura"            => $_POST["temperaturaPaciente"],
              "FrecuenciaCardiaca"     => $_POST["frecuenciaCardiaca"],
              "FrecuenciaRespiratoria" => $_POST["frecuenciaRespiratoria"],
              "ExamenOdonto"           => $_POST["examenOdontoEst"],
              "DiagnosticoPresuntivo"  => $_POST["diagnostivoPresuntivo"],
              "DiagnosticoDefinitivo"  => $_POST["diagnostivoDefinitivo"],
              "Pronostico"             => $_POST["pronosticoHistoria"],
              "TratamientoPaciente"    => $_POST["tratamientoHistoria"],
              "InformacionAlta"        => $_POST["altaHistoria"],
              "UsuarioCreado"          => $_SESSION["idUsuario"],
              "UsuarioActualizado"     => $_SESSION["idUsuario"],
              "FechaCreado"            => date("Y-m-d\TH:i:sP"),
              "FechaActualiza"         => date("Y-m-d\TH:i:sP"),
            );
            $respuestaDetalleHistoria = ModelHistorias::mdlCrearDetalleHistoria($tablaDetalleHistoria, $datosCreateDetalleHistoria);

            if ($respuestaDetalleHistoria == "ok") {
              // 5. Agregar procedimientos al plan de tratamiento
              $idTratamiento      = ControllerTratamiento::ctrObtenerIdTratamiento($_GET["codPaciente"]);
              $listaProcedimientos = json_decode($_POST["listarProcedimientos"], true);
              if ($listaProcedimientos != null || $listaProcedimientos != '') {
                foreach ($listaProcedimientos as $value) {
                  $datosDetalleTratamiento = array(
                    "IdTratamiento"          => $idTratamiento["IdTratamiento"],
                    "IdProcedimiento"        => $value["CodProcedimiento"],
                    "ObservacionProcedimiento"=> $value["ObservacionProcedimiento"],
                    "EstadoTratamiento"      => "1",
                    "PrecioProcedimiento"    => $value["PrecioProcedimiento"],
                  );
                  $respuestaDetalleTratamiento = ControllerTratamiento::ctrCrearDetalleTratamiento($datosDetalleTratamiento);
                }
              } else {
                $respuestaDetalleTratamiento = "ok";
              }

              if ($respuestaDetalleTratamiento == "ok") {
                // 6. Actualizar total del tratamiento
                $totalTratamiento = $_POST["nuevoTotalTratamiento"];
                $respuestaUpdateTratamiento = ControllerTratamiento::ctrUpdatePrecioTratamiento($idTratamiento["IdTratamiento"], $totalTratamiento);
                if ($respuestaUpdateTratamiento == "ok") {
                  echo '<script>Swal.fire({ icon: "success", title: "Correcto", text: "¡Historia Clínica creada correctamente!" }).then(function(r){ if(r.value) window.location = "historiaClinica"; });</script>';
                } else {
                  echo '<script>Swal.fire({ icon: "error", title: "Error", text: "¡Error al actualizar la lista de tratamientos!" }).then(function(r){ if(r.value) window.location = "historiaClinica"; });</script>';
                }
              } else {
                echo '<script>Swal.fire({ icon: "error", title: "Error", text: "¡Error al crear el detalle del tratamiento!" }).then(function(r){ if(r.value) window.location = "historiaClinica"; });</script>';
              }
            } else {
              echo '<script>Swal.fire({ icon: "error", title: "Error", text: "¡Error al crear el detalle de la historia!" }).then(function(r){ if(r.value) window.location = "historiaClinica"; });</script>';
            }
          } else {
            echo '<script>Swal.fire({ icon: "error", title: "Error", text: "¡Error al crear el plan de tratamiento vacío!" }).then(function(r){ if(r.value) window.location = "historiaClinica"; });</script>';
          }
        } else {
          echo '<script>Swal.fire({ icon: "error", title: "Error", text: "Error al actualizar los datos del paciente!" }).then(function(r){ if(r.value) window.location = "historiaClinica"; });</script>';
        }
      }
    }
  }

  // [NUEVO B] Crear historia clínica desde el flujo de cotización
  public static function ctrCrearHistoriaCotizacion($codPaciente, $codCotizacion)
  {
    $tablaHistoria = "tba_historiaclinica";
    $datosCreateHistoria = array(
      "IdPaciente"        => $codPaciente,
      "IdSocio"           => "1",
      "UsuarioCreado"     => $_SESSION["idUsuario"],
      "UsuarioActualizado"=> $_SESSION["idUsuario"],
      "FechaCreado"       => date("Y-m-d\TH:i:sP"),
      "FechaActualiza"    => date("Y-m-d\TH:i:sP"),
    );
    $nuevaHistoria = ModelHistorias::mdlCrearHistoriaCotizacion($tablaHistoria, $datosCreateHistoria);

    if ($nuevaHistoria == "ok") {
      $ultimaHistoria  = ModelHistorias::mdlObtenerUltimaHistoria($tablaHistoria);
      $datosTratamiento = array(
        "IdHistoriaClinica" => $ultimaHistoria["Id"],
        "IdPaciente"        => $codPaciente,
        "UsuarioCreado"     => $_SESSION["idUsuario"],
        "UsuarioActualiza"  => $_SESSION["idUsuario"],
        "FechaCreacion"     => date("Y-m-d\TH:i:sP"),
        "FechaActualizacion"=> date("Y-m-d\TH:i:sP"),
      );
      $nuevoTratamiento = ControllerTratamiento::ctrCrearTratamiento($datosTratamiento);

      if ($nuevoTratamiento == "ok") {
        $ultimoTratamiento = ControllerTratamiento::ctrObtenerUltimoTratamiento();
        $datosDetalle = array(
          "IdHistoriaClinica" => $ultimaHistoria["Id"],
          "IdTratamiento"     => $ultimoTratamiento["Id"],
          "FechaCreado"       => date("Y-m-d\TH:i:sP"),
          "FechaActualiza"    => date("Y-m-d\TH:i:sP"),
          "UsuarioCreado"     => $_SESSION["idUsuario"],
          "UsuarioActualizado"=> $_SESSION["idUsuario"],
        );
        $respuestaDetalle = self::ctrCrearDetalleHistoriaCotizacion($datosDetalle);

        if ($respuestaDetalle == "ok") {
          $listaCotizacion = ControllerCotizaciones::ctrObtenerListaProcedimientos($codCotizacion);
          foreach ($listaCotizacion as $value) {
            $datosProcedimiento = array(
              "IdTratamiento"            => $ultimoTratamiento["Id"],
              "IdProcedimiento"          => $value["IdProcedimiento"],
              "EstadoTratamiento"        => "1",
              "ObservacionProcedimiento" => "",
              "PrecioProcedimiento"      => $value["TotalProcedimiento"],
            );
            $agregarProcedimiento = ControllerTratamiento::ctrCrearDetalleTratamiento($datosProcedimiento);
          }
          return ($agregarProcedimiento == "ok") ? "ok" : "error";
        }
      }
    }
    return "error";
  }

  // [NUEVO B] Crear solo el detalle de historia desde cotización
  public static function ctrCrearDetalleHistoriaCotizacion($datosDetalle)
  {
    $tabla = "tba_detallehistoriaclinica";
    $respuesta = ModelHistorias::mdlCrearDetalleHistoriaCotizacion($tabla, $datosDetalle);
    return $respuesta;
  }

  // ── EDITAR ───────────────────────────────────────────────────────────────

  // Editar historia clínica — Flujo B: actualiza paciente + cabecera + detalle
  public static function ctrEditarHistoria()
  {
    if (isset($_POST["nombrePaciente"])) {
      $tablaHistoria        = "tba_historiaclinica";
      $tablaDetalleHistoria = "tba_detallehistoriaclinica";
      $codPaciente = $_GET["codPaciente"];
      $codHistoria = $_GET["codHistoria"];

      // Actualizar datos del paciente
      $datosUpdatePaciente = array(
        "IdPaciente"             => $codPaciente,
        "SexoPaciente"           => $_POST["editarSexoPaciente"],
        "EdadPaciente"           => $_POST["editarEdadPaciente"],
        "FechaNacimiento"        => $_POST["editarFechaNacimiento"],
        "CelularPaciente"        => $_POST["editarCelular"],
        "DomicilioPaciente"      => $_POST["editarDomicilio"],
        "LugarProcedencia"       => $_POST["editarLugarProcedencia"],
        "LugarNacimiento"        => $_POST["editarLugarNacimiento"],
        "GradoInstruccion"       => $_POST["editarGradoInstruccion"],
        "RazaPaciente"           => $_POST["editarRazaPaciente"],
        "OcupacionPaciente"      => $_POST["editarOcupacionPaciente"],
        "ReligionPaciente"       => $_POST["editarReligionPaciente"],
        "EstadoCivil"            => $_POST["editarEstadoCivil"],
        "NumeroContactoPaciente" => $_POST["editarNumeroContacto"],
        "NombreContactoPaciente" => $_POST["editarPersonaContacto"],
        "UsuarioActualizado"     => $_SESSION["idUsuario"],
        "FechaActualizacion"     => date("Y-m-d\TH:i:sP"),
      );
      $respuestaPaciente = ControllerPacientes::ctrUpdateDatosPacienteEditar($datosUpdatePaciente);

      if ($respuestaPaciente == "ok") {
        // Actualizar cabecera de historia
        $datosUpdateHistoria = array(
          "IdPaciente"             => $codPaciente,
          "AlergiasEncontradas"    => $_POST["editarRiesgoAlergia"],
          "DatosInformante"        => $_POST["editarDatosInformante"],
          "MotivoConsulta"         => $_POST["editarMotivoConsulta"],
          "TiempoEnfermedad"       => $_POST["editarTiempoEnfermedad"],
          "SignosSintomas"         => $_POST["editarSignosSintomas"],
          "RelatoCronologico"      => $_POST["editarRelatoCronologico"],
          "FuncionesBiologicas"    => $_POST["editarFuncionesBiologicas"],
          "AntecedentesFamiliares" => $_POST["editarAntecedentesFamiliares"],
          "AntecedentesPersonales" => $_POST["editarAntecedentesPersonales"],
          "UsuarioActualizado"     => $_SESSION["idUsuario"],
          "FechaActualiza"         => date("Y-m-d\TH:i:sP"),
        );
        $respuestaHistoria = ModelHistorias::mdlUpdateHistoriaClinica($tablaHistoria, $datosUpdateHistoria);

        if ($respuestaHistoria == "ok") {
          // Actualizar detalle clínico de la historia
          $datosUpdateDetalleHistoria = array(
            "IdHistoriaClinica"      => $codHistoria,
            "PresionArterial"        => $_POST["editarPresionArterial"],
            "Pulso"                  => $_POST["editarPulsoPaciente"],
            "Temperatura"            => $_POST["editarTemperaturaPaciente"],
            "FrecuenciaCardiaca"     => $_POST["editarFrecuenciaCardiaca"],
            "FrecuenciaRespiratoria" => $_POST["editarFrecuenciaRespiratoria"],
            "ExamenOdonto"           => $_POST["editarExamenOdonto"],
            "DiagnosticoPresuntivo"  => $_POST["editarDiagnosticoPresuntivo"],
            "DiagnosticoDefinitivo"  => $_POST["editarDiagnosticoDefinitivo"],
            "Pronostico"             => $_POST["editarPronosticoHistoria"],
            "TratamientoPaciente"    => $_POST["editarTratamiento"],
            "InformacionAlta"        => $_POST["editarAltaPaciente"],
            "UsuarioActualizado"     => $_SESSION["idUsuario"],
            "FechaActualiza"         => date("Y-m-d\TH:i:sP"),
          );
          $respuestaDetalleHistoria = ModelHistorias::mdlUpdateDetalleHistoria($tablaDetalleHistoria, $datosUpdateDetalleHistoria);

          if ($respuestaDetalleHistoria == "ok") {
            echo '<script>Swal.fire({ icon: "success", title: "Correcto", text: "¡Historia Clínica editada correctamente!" }).then(function(r){ if(r.value) window.location = "historiaClinica"; });</script>';
          } else {
            echo '<script>Swal.fire({ icon: "error", title: "Error", text: "¡Error al editar el detalle de la historia clínica!" }).then(function(r){ if(r.value) window.location = "historiaClinica"; });</script>';
          }
        } else {
          echo '<script>Swal.fire({ icon: "error", title: "Error", text: "¡Error al editar la cabecera de la historia clínica!" }).then(function(r){ if(r.value) window.location = "historiaClinica"; });</script>';
        }
      } else {
        echo '<script>Swal.fire({ icon: "error", title: "Error", text: "¡Error al editar los datos del paciente!" }).then(function(r){ if(r.value) window.location = "historiaClinica"; });</script>';
      }
    }
  }

  // ── ELIMINAR ─────────────────────────────────────────────────────────────

  /**
   * Eliminar historia clínica — Lógica mejorada de B:
   * Verifica si tiene procedimientos realizados antes de permitir la eliminación.
   * Orden: detalle_historia → tratamiento+detalle_tratamiento → historia
   */
  public static function ctrEliminarHistoria()
  {
    if (isset($_GET["codHistoria"])) {
      $codHistoria = $_GET["codHistoria"];
      $codPaciente = $_GET["codPaciente"];

      // Verificar si tiene procedimientos realizados
      $listaProcedimientosRealizados = ControllerTratamiento::ctrMostrarDetalleTratamientoRealizado($codHistoria);
      if (count($listaProcedimientosRealizados) > 0) {
        echo '<script>Swal.fire({ icon: "error", title: "Error", text: "¡No se puede eliminar la historia! La historia tiene uno o más procedimientos realizados" }).then(function(r){ if(r.value) window.location = "historiaClinica"; });</script>';
      } else {
        $tablaHistoria = "tba_historiaclinica";
        // Eliminar detalle de la historia primero
        $eliminarDetalleHistoria = self::ctrEliminarDetalleHistoria($codHistoria);
        if ($eliminarDetalleHistoria == "ok") {
          $codTratamiento      = ControllerTratamiento::ctrObtenerCodigoTratamiento($codPaciente);
          $eliminarTratamiento = ControllerTratamiento::ctrEliminarTratamiento($codTratamiento["IdTratamiento"]);
          if ($eliminarTratamiento == "ok") {
            $eliminarHistoria = ModelHistorias::mdlEliminarHistoria($tablaHistoria, $codHistoria);
            if ($eliminarHistoria == "ok") {
              echo '<script>Swal.fire({ icon: "success", title: "Correcto", text: "¡La historia clínica ha sido eliminada correctamente!" }).then(function(r){ if(r.value) window.location = "historiaClinica"; });</script>';
            } else {
              echo '<script>Swal.fire({ icon: "error", title: "Error", text: "¡Error al tratar de eliminar la historia clínica!" }).then(function(r){ if(r.value) window.location = "historiaClinica"; });</script>';
            }
          } else {
            echo '<script>Swal.fire({ icon: "error", title: "Error", text: "¡Error al tratar de eliminar el plan de tratamiento!" }).then(function(r){ if(r.value) window.location = "historiaClinica"; });</script>';
          }
        } else {
          echo '<script>Swal.fire({ icon: "error", title: "Error", text: "¡Error al eliminar el detalle de la historia!" }).then(function(r){ if(r.value) window.location = "historiaClinica"; });</script>';
        }
      }
    }
  }

  // [NUEVO B] Eliminar solo el detalle de la historia clínica
  public static function ctrEliminarDetalleHistoria($codHistoria)
  {
    $tabla = "tba_detallehistoriaclinica";
    $respuesta = ModelHistorias::mdlEliminarHistoria($tabla, $codHistoria);
    return $respuesta;
  }

  // ── BÚSQUEDA / VERIFICACIÓN ───────────────────────────────────────────────

  // Buscar historia por número de identificación del paciente
  public static function ctrBuscarHistoriaDNI($numeroDNI)
  {
    $tabla = "tba_historiaclinica";
    $respuesta = ModelHistorias::mdlBuscarHistoriaDNI($tabla, $numeroDNI);
    return $respuesta;
  }

  // Obtener código de historia por código de paciente
  public static function ctrObtenerCodHistoria($codPaciente)
  {
    $tabla = "tba_historiaclinica";
    $respuesta = ModelHistorias::mdlObtenerCodHistoria($tabla, $codPaciente);
    return $respuesta;
  }

  // Contar historias creadas (dashboard)
  public static function ctrContarHistoriasCreadas()
  {
    $tabla = "tba_historiaclinica";
    $sumaHistorias = ModelHistorias::mdlContarHistoriasCreadas($tabla);
    return $sumaHistorias;
  }

  // Verificar si un paciente tiene historia clínica
  public static function ctrVerificarUsoPaciente($codPaciente)
  {
    $tabla = "tba_historiaclinica";
    $contarUso = ModelHistorias::mdlVerificarUsoPaciente($tabla, $codPaciente);
    return $contarUso;
  }

  // [NUEVO B] Verificar si un socio/médico tiene historias asociadas
  public static function ctrVerificarUsoSocio($codSocio)
  {
    $tabla = "tba_historiaclinica";
    $contarUso = ModelHistorias::mdlVerificarUsoSocio($tabla, $codSocio);
    return $contarUso;
  }

  // [NUEVO B] Verificar si existe una historia para un paciente (usado en cotizaciones)
  public static function mdlVerificarHistoriaPaciente($codPaciente)
  {
    $tabla = "tba_historiaclinica";
    $confirmacion = ModelHistorias::mdlVerificarHistoriaPaciente($tabla, $codPaciente);
    return $confirmacion;
  }

  // ── ODONTOGRAMA ───────────────────────────────────────────────────────────

  // Subir odontograma — usa NumeroIdentificacion en lugar de DNIPaciente
  public static function ctrSubirOdontograma($codHistoria)
  {
    if (isset($_FILES["nuevoOdontograma"])) {
      $tipos = ["image/jpeg", "image/jpg", "image/png", "application/pdf"];
      if (in_array($_FILES["nuevoOdontograma"]["type"], $tipos)) {
        $datosHistoria  = ControllerPacientes::ctrObtenerDNIPaciente($codHistoria);
        $formato        = explode('/', $_FILES["nuevoOdontograma"]["type"]);
        $date           = date("Y-m-d");
        $nombreArchivo  = $datosHistoria["NumeroIdentificacion"] . '_' . $datosHistoria["IdPaciente"] . '_' . $_POST["codSubirImg"] . '_' . $date . '.' . $formato[1];
        $ruta           = "../image/odontograma/$nombreArchivo";
        $resultado      = move_uploaded_file($_FILES["nuevoOdontograma"]["tmp_name"], $ruta);
        $actualizarRuta = self::ctrActualizarRuta($nombreArchivo, $codHistoria);
        $respuesta      = ($resultado == true && $actualizarRuta == "ok") ? "ok" : "error";
      } else {
        $respuesta = "errorFormato";
      }
    } else {
      $respuesta = "error";
    }
    return $respuesta;
  }

  // Actualizar la ruta del odontograma en BD
  public static function ctrActualizarRuta($nombreArchivo, $codHistoria)
  {
    $tabla = "tba_historiaclinica";
    $respuesta = ModelHistorias::mdlActualizarRuta($tabla, $nombreArchivo, $codHistoria);
    return $respuesta;
  }

  // Descargar ruta del odontograma
  public static function ctrDescargarOdontograma($codHistoria)
  {
    $tabla           = "tba_historiaclinica";
    $rutaOdontograma = ModelHistorias::mdlDescargarOdontograma($tabla, $codHistoria);
    $archivo         = $rutaOdontograma["RutaOdontograma"];
    return array(
      "archivo" => $archivo,
      "ruta"    => "image/odontograma/" . $archivo
    );
  }
}

<?php
date_default_timezone_set('America/Lima');
class ControllerHistorias
{
  //  Mostrar todas las historias
  public static function ctrMostrarAllHistorias()
  {
    $tabla = "tba_historiaclinica";
    $listaHistorias = ModelHistorias::mdlMostrarAllHistorias($tabla);
    return $listaHistorias;
  }

  //  Crear nueva historia clínica
  public static function ctrCrearNuevaHistoria()
  {
    if(isset($_POST["nombrePaciente"]))
    {
      //  El flujo es el siguiente actualizarDatosPaciente -> Crear historia clinica -> Crear Tratamiento vacío -> Crear Detalle de la historia -> Crear detalle del tratamiento -> Actualizar el precio del tratamiento
      $tablaHistoria = "tba_historiaclinica";
      $tablaDetalleHistoria = "tba_detallehistoriaclinica";
      
      //  Actualizar los datos del paciente
      $datosUpdatePaciente = array(
        "IdPaciente" => $_GET["codPaciente"],
        "DNIPaciente" => $_POST["numeroDNI"],
        "SexoPaciente" => $_POST["sexoPaciente"],
        "EdadPaciente" => $_POST["edadPaciente"],
        "FechaNacimiento" => $_POST["fechaNacimiento"],
        "CelularPaciente" => $_POST["celularPaciente"],
        "DomicilioPaciente" => $_POST["domicilioPaciente"],
        "LugarProcedencia" => $_POST["lugarProcedencia"],
        "LugarNacimiento" => $_POST["lugarNacimiento"],
        "GradoInstruccion" => $_POST["gradoInstruccion"],
        "RazaPaciente" => $_POST["razaPaciente"],
        "OcupacionPaciente" => $_POST["ocupacionPaciente"],
        "ReligionPaciente" => $_POST["religionPaciente"],
        "EstadoCivil" => $_POST["estadoCivil"],
        "NumeroContactoPaciente" => $_POST["numeroContacto"],
        "NombreContactoPaciente" => $_POST["personaContacto"],
        "UsuarioActualizado" => $_SESSION["idUsuario"],
        "FechaActualizacion" => date("Y-m-d\TH:i:sP"),
      );
      $respuestaPaciente = ControllerPacientes::ctrUpdateDatosPaciente($datosUpdatePaciente);

      //  Se creará la historia luego de que los datos del paciente fueron actualizados
      if($respuestaPaciente == "ok")
      {
        $datosCreateHistoria = array(
          "IdPaciente" => $_GET["codPaciente"],
          //  Solo el doctor creará la historia clínica con su usuario, o puede crearla otra persona???? -> ver si puedo poner ese valor en un campo extra para que pue cambiar de medico o no
          "IdSocio" => $_SESSION["idUsuario"],
          "AlergiasEncontradas" => $_POST["riesgoAlergia"],
          "DatosInformante" => $_POST["datosInformante"],
          "MotivoConsulta" => $_POST["motivoConsulta"],
          "TiempoEnfermedad" => $_POST["tiempoEnfermedad"],
          "SignosSintomas" => $_POST["signosySintomas"],
          "RelatoCronologico" => $_POST["relatoCronologico"],
          "FuncionesBiologicas" => $_POST["funcionesBiologicas"],
          "AntecedentesFamiliares" => $_POST["antecedentesFamiliares"],
          "AntecedentesPersonales" => $_POST["antecedentesPersonales"],
          "UsuarioCreado" => $_SESSION["idUsuario"],
          "UsuarioActualizado" => $_SESSION["idUsuario"],
          "FechaCreado" => date("Y-m-d\TH:i:sP"),
          "FechaActualiza" => date("Y-m-d\TH:i:sP"),
        );
        //  Se ingresa los datos de la cabecera de la historia clínica.
        //  Luego de crear los datos, se genera un plan de tratamiento para el paciente vacío
        $respuestaHistoria = ModelHistorias::mdlCrearHistoriaClinica($tablaHistoria, $datosCreateHistoria);
        if($respuestaHistoria == "ok")
        {
          //  Obtener la ultima historia clinica creada y tener ese valor para crear un plan de tratamiento vacío
          $ultimaHistoria = ModelHistorias::mdlObtenerUltimaHistoria($tablaHistoria);
          $datosCreateTratamiento = array(
            "IdHistoriaClinica" => $ultimaHistoria["Id"],
            "IdPaciente" => $_GET["codPaciente"],
            "UsuarioCreado" => $_SESSION["idUsuario"],
            "UsuarioActualiza" => $_SESSION["idUsuario"],
            "FechaCreacion" => date("Y-m-d\TH:i:sP"),
            "FechaActualizacion" => date("Y-m-d\TH:i:sP"),
          );
          $respuestaTratamiento = ControllerTratamiento::ctrCrearTratamiento($datosCreateTratamiento);
          if($respuestaTratamiento == "ok")
          {
            //  Crear el detalle del tratamiento con el ultimo id de la historia vacia creada anteriormente para que pueda guardar su valor.
            $ultimoTratamiento = ControllerTratamiento::ctrObtenerUltimoTratamiento();
            $datosCreateDetalleHistoria = array(
              "IdHistoriaClinica" => $ultimaHistoria["Id"],
              "IdTratamiento" => $ultimoTratamiento["Id"],
              "PresionArterial" => $_POST["presionArterial"],
              "Pulso" => $_POST["pulsoPaciente"],
              "Temperatura" => $_POST["temperaturaPaciente"],
              "FrecuenciaCardiaca" => $_POST["frecuenciaCardiaca"],
              "FrecuenciaRespiratoria" => $_POST["frecuenciaRespiratoria"],
              "ExamenOdonto" => $_POST["examenOdontoEst"],
              "DiagnosticoPresuntivo" => $_POST["diagnostivoPresuntivo"],
              "DiagnosticoDefinitivo" => $_POST["diagnostivoDefinitivo"],
              "Pronostico" => $_POST["pronosticoHistoria"],
              "TratamientoPaciente" => $_POST["tratamientoHistoria"],
              "InformacionAlta" => $_POST["altaHistoria"],
              "UsuarioCreado" => $_SESSION["idUsuario"],
              "UsuarioActualizado" => $_SESSION["idUsuario"],
              "FechaCreado" => date("Y-m-d\TH:i:sP"),
              "FechaActualiza" => date("Y-m-d\TH:i:sP"),
            );
            $respuestaDetalleHistoria = ModelHistorias::mdlCrearDetalleHistoria($tablaDetalleHistoria, $datosCreateDetalleHistoria);
            //  Ahora puedo jalar los procedimientos que se agregaron al plan de tratamiento y los coloco en el tratamiento que cree previamente.
            if($respuestaDetalleHistoria == "ok")
            {
              //  Obtener el tratamiento de este paciente en específico
              $idTratamiento = ControllerTratamiento::ctrObtenerIdTratamiento($_GET["codPaciente"]);
              //  Obtener la lista de procedimientos que se agregaron 
              $listaProcedimientos = json_decode($_POST["listarProcedimientos"], true);
              foreach($listaProcedimientos as $value)
              {
                $datosDetalleTratamiento = array(
                  "IdTratamiento" => $idTratamiento["IdTratamiento"],
                  "IdProcedimiento" => $value["CodProcedimiento"],
                  "ObservacionProcedimiento" => $value["ObservacionProcedimiento"],
                  "EstadoTratamiento" => "1",
                  "PrecioProcedimiento" => $value["PrecioProcedimiento"],
                );
                $respuestaDetalleTratamiento = ControllerTratamiento::ctrCrearDetalleTratamiento($datosDetalleTratamiento);
              }
              if($respuestaDetalleTratamiento == "ok")
              {
                $totalTratamiento = $_POST["nuevoTotalTratamiento"];
                $respuestaUpdateTratamiento = ControllerTratamiento::ctrUpdatePrecioTratamiento($idTratamiento["IdTratamiento"] ,$totalTratamiento);
                if($respuestaUpdateTratamiento == "ok")
                {
                  echo '
                    <script>
                      Swal.fire({
                        icon: "success",
                        title: "Correcto",
                        text: "¡Historia Clínica creada correctamente!",
                      }).then(function(result){
                        if(result.value){
                          window.location = "historiaClinica";
                        }
                      });
                    </script>';
                }
                else
                {
                  echo '
                    <script>
                      Swal.fire({
                        icon: "error",
                        title: "Error",
                        text: "¡Error al actualizar la lista de tratamientos!",
                      }).then(function(result){
                        if(result.value){
                          window.location = "historiaClinica";
                        }
                      });
                    </script>';
                }
              }
              else
              {
                echo '
                  <script>
                    Swal.fire({
                      icon: "error",
                      title: "Error",
                      text: "¡Error al crear el detalle del tratamiento!",
                    }).then(function(result){
                      if(result.value){
                        window.location = "historiaClinica";
                      }
                    });
                  </script>';
              }
            }
            else
            {
              echo '
                <script>
                  Swal.fire({
                    icon: "error",
                    title: "Error",
                    text: "¡Error al crear el detalle de la historia!",
                  }).then(function(result){
                    if(result.value){
                      window.location = "historiaClinica";
                    }
                  });
                </script>';
            }
          }
          else
          {
            echo '
              <script>
                Swal.fire({
                  icon: "error",
                  title: "Error",
                  text: "¡Error al crear el plan de tratamiento vacío!",
                }).then(function(result){
                  if(result.value){
                    window.location = "historiaClinica";
                  }
                });
              </script>';
          }
        }
        else
        {
          echo '
            <script>
              Swal.fire({
                icon: "error",
                title: "Error",
                text: "Error al actualizar los datos del paciente!",
              }).then(function(result){
                if(result.value){
                  window.location = "historiaClinica";
                }
              });
            </script>';
        }
      }
    }
  }

  //  Mostrar los datos de la historia de un paciente
  public static function ctrMostrarCabeceraHistoria($codHistoria)
  {
    $tabla = "tba_historiaclinica";
    $respuesta = ModelHistorias::mdlMostrarCabeceraHistoria($tabla, $codHistoria);
    return $respuesta;
  }

  //  Mostrar los datos del detalle de la historia
  public static function ctrMostrarDetalleHistoria($codHistoria)
  {
    $tabla = "tba_detallehistoriaclinica";
    $respuesta = ModelHistorias::mdlMostrarDetalleHistoria($tabla, $codHistoria);
    return $respuesta;
  }

  //  Editar Historia clínica
  public static function ctrEditarHistoria()
  {
    if(isset($_POST["nombrePaciente"]))
    {
      $tablaHistoria = "tba_historiaclinica";
      $tablaDetalleHistoria = "tba_detallehistoriaclinica";
      $codPaciente = $_GET["codPaciente"];
      $codHistoria = $_GET["codHistoria"];
      
      //  Actualizar los datos del paciente
      $datosUpdatePaciente = array(
        "IdPaciente" => $codPaciente,
        "SexoPaciente" => $_POST["editarSexoPaciente"],
        "EdadPaciente" => $_POST["editarEdadPaciente"],
        "FechaNacimiento" => $_POST["editarFechaNacimiento"],
        "CelularPaciente" => $_POST["editarCelular"],
        "DomicilioPaciente" => $_POST["editarDomicilio"],
        "LugarProcedencia" => $_POST["editarLugarProcedencia"],
        "LugarNacimiento" => $_POST["editarLugarNacimiento"],
        "GradoInstruccion" => $_POST["editarGradoInstruccion"],
        "RazaPaciente" => $_POST["editarRazaPaciente"],
        "OcupacionPaciente" => $_POST["editarOcupacionPaciente"],
        "ReligionPaciente" => $_POST["editarReligionPaciente"],
        "EstadoCivil" => $_POST["editarEstadoCivil"],
        "NumeroContactoPaciente" => $_POST["editarNumeroContacto"],
        "NombreContactoPaciente" => $_POST["editarPersonaContacto"],
        "UsuarioActualizado" => $_SESSION["idUsuario"],
        "FechaActualizacion" => date("Y-m-d\TH:i:sP"),
      );
      $respuestaPaciente = ControllerPacientes::ctrUpdateDatosPacienteEditar($datosUpdatePaciente);

      //  Actualiza los datos de la historia clinica
      if($respuestaPaciente == "ok")
      {
        $datosUpdateHistoria = array(
          "IdPaciente" => $codPaciente,
          "AlergiasEncontradas" => $_POST["editarRiesgoAlergia"],
          "DatosInformante" => $_POST["editarDatosInformante"],
          "MotivoConsulta" => $_POST["editarMotivoConsulta"],
          "TiempoEnfermedad" => $_POST["editarTiempoEnfermedad"],
          "SignosSintomas" => $_POST["editarSignosSintomas"],
          "RelatoCronologico" => $_POST["editarRelatoCronologico"],
          "FuncionesBiologicas" => $_POST["editarFuncionesBiologicas"],
          "AntecedentesFamiliares" => $_POST["editarAntecedentesFamiliares"],
          "AntecedentesPersonales" => $_POST["editarAntecedentesPersonales"],
          "UsuarioActualizado" => $_SESSION["idUsuario"],
          "FechaActualiza" => date("Y-m-d\TH:i:sP"),
        );
        $respuestaHistoria = ModelHistorias::mdlUpdateHistoriaClinica($tablaHistoria, $datosUpdateHistoria);

        //Actualizar el detalle de la historia clínica
        if($respuestaHistoria == "ok")
        {
          $datosUpdateDetalleHistoria = array(
            "IdHistoriaClinica" => $codHistoria,
            "PresionArterial" => $_POST["editarPresionArterial"],
            "Pulso" => $_POST["editarPulsoPaciente"],
            "Temperatura" => $_POST["editarTemperaturaPaciente"],
            "FrecuenciaCardiaca" => $_POST["editarFrecuenciaCardiaca"],
            "FrecuenciaRespiratoria" => $_POST["editarFrecuenciaRespiratoria"],
            "ExamenOdonto" => $_POST["editarExamenOdonto"],
            "DiagnosticoPresuntivo" => $_POST["editarDiagnosticoPresuntivo"],
            "DiagnosticoDefinitivo" => $_POST["editarDiagnosticoDefinitivo"],
            "Pronostico" => $_POST["editarPronosticoHistoria"],
            "TratamientoPaciente" => $_POST["editarTratamiento"],
            "InformacionAlta" => $_POST["editarAltaPaciente"],
            "UsuarioActualizado" => $_SESSION["idUsuario"],
            "FechaActualiza" => date("Y-m-d\TH:i:sP"),
          );
          $respuestaDetalleHistoria = ModelHistorias::mdlUpdateDetalleHistoria($tablaDetalleHistoria, $datosUpdateDetalleHistoria);

          //  Actualizar el total del tratamiento
          if($respuestaDetalleHistoria == "ok")
          {
            echo '
              <script>
                Swal.fire({
                  icon: "success",
                  title: "Correcto",
                  text: "¡Historia Clínica editada correctamente!",
                }).then(function(result){
                  if(result.value){
                    window.location = "historiaClinica";
                  }
                });
              </script>';
          }
          else
          {
            echo '
              <script>
                Swal.fire({
                  icon: "error",
                  title: "Error",
                  text: "¡Error al editar el detalle de la historia clínica!",
                }).then(function(result){
                  if(result.value){
                    window.location = "historiaClinica";
                  }
                });
              </script>';
          }
        }
        else
        {
          echo '
            <script>
              Swal.fire({
                icon: "error",
                title: "Error",
                text: "¡Error al editar la cabecera de la historia clínica!",
              }).then(function(result){
                if(result.value){
                  window.location = "historiaClinica";
                }
              });
            </script>';
        }
      }
      else
      {
        echo '
          <script>
            Swal.fire({
              icon: "error",
              title: "Error",
              text: "¡Error al editar los datos del paciente!",
            }).then(function(result){
              if(result.value){
                window.location = "historiaClinica";
              }
            });
          </script>';
      }
    }
  }

  //  Buscar historia por numero de deni
  public static function ctrBuscarHistoriaDNI($numeroDNI)
  {
    $tabla = "tba_historiaclinica";
    $respuesta = ModelHistorias::mdlBuscarHistoriaDNI($tabla, $numeroDNI);
    return $respuesta;
  }

  //  Eliminar historia clinica -> Solo se eliminará la historia clínica de este paciente, pero no el tratamiento, ni plan de tratamiento, ni los pagos relacionados a estos
  public static function ctrEliminarHistoria()
  {
    if(isset($_GET["codHistoria"]))
    {
      //  Primero verificamos si tiene algún tratamiento realizado, de ser el caso no se podrá eliminar la historia, se podría cambiar de estado para evitar mostrar estas historias que estén en otro estado (SUGERENCIA)
      $codHistoria = $_GET["codHistoria"];
      $codPaciente = $_GET["codPaciente"];
      $listaProcedimientosRealizados = ControllerTratamiento::ctrMostrarDetalleTratamientoRealizado($codHistoria);
      if (count($listaProcedimientosRealizados) > 0 )
      {
        echo '
          <script>
            Swal.fire({
              icon: "error",
              title: "Error",
              text: "¡No se puede eliminar la historia! La historia tiene uno o más procedimientos realizados",
            }).then(function(result){
              if(result.value){
                window.location = "historiaClinica";
              }
            });
          </script>';
      }
      else
      {
        $tablaHistoria = "tba_historiaclinica";
        //  En el caso que no se tenga procedimientos realizados en su plan de tratamiento, si se podrá eliminar la historia clínica
        $eliminarDetalleHistoria = self::ctrEliminarDetalleHistoria($codHistoria);
        if($eliminarDetalleHistoria == "ok")
        {
          //  Ahora eliminamos el tratamiento y el detalle de tratamiento, pasando el id de tratamiento
          $codTratamiento = ControllerTratamiento::ctrObtenerCodigoTratamiento($codPaciente);
          $eliminarTratamiento = ControllerTratamiento::ctrEliminarTratamiento($codTratamiento["IdTratamiento"]);
          if($eliminarTratamiento == "ok")
          {
            $eliminarHistoria = ModelHistorias::mdlEliminarHistoria($tablaHistoria, $codHistoria);
            if($eliminarHistoria == "ok")
            {
              echo '
              <script>
                Swal.fire({
                  icon: "success",
                  title: "Correcto",
                  text: "¡La historia clínica ha sido eliminada correctamente!",
                }).then(function(result){
                  if(result.value){
                    window.location = "historiaClinica";
                  }
                });
              </script>';
            }
            else
            {
              echo '
              <script>
                Swal.fire({
                  icon: "error",
                  title: "Error",
                  text: "¡Error al tratar de eliminar la historia clínica!",
                }).then(function(result){
                  if(result.value){
                    window.location = "historiaClinica";
                  }
                });
              </script>';
            }
          }
          else
          {
            echo '
            <script>
              Swal.fire({
                icon: "error",
                title: "Error",
                text: "¡Error al tratar de eliminar el plan de tratamiento!",
              }).then(function(result){
                if(result.value){
                  window.location = "historiaClinica";
                }
              });
            </script>';
          }
        }
        else
        {
          echo '
          <script>
            Swal.fire({
              icon: "error",
              title: "Error",
              text: "¡Error al eliminar el detalle de la historia!",
            }).then(function(result){
              if(result.value){
                window.location = "historiaClinica";
              }
            });
          </script>';
        }
      }
    }
  }

  //  Eliminar el detalle de la historia clínica
  public static function ctrEliminarDetalleHistoria($codHistoria)
  {
    $tabla = "tba_detallehistoriaclinica";
    $respuesta = ModelHistorias::mdlEliminarHistoria($tabla, $codHistoria);
    return $respuesta;
  }

  //  Buscar Historia por codigo de paciente
  public static function ctrObtenerCodHistoria($codPaciente)
  {
    $tabla = "tba_historiaclinica";
    $respuesta  = ModelHistorias::mdlObtenerCodHistoria($tabla, $codPaciente);
    return $respuesta;
  }

  //  Subir odontograma
  public static function ctrSubirOdontograma($codHistoria)
  {
    if(isset($_FILES["nuevoOdontograma"]))
    {
      if($_FILES["nuevoOdontograma"]["type"] == "image/jpeg" || $_FILES["nuevoOdontograma"]["type"] == "image/jpg" || $_FILES["nuevoOdontograma"]["type"] == "image/png" || $_FILES["nuevoOdontograma"]["type"] == "application/pdf")
      {
        $datosHistoria = ControllerPacientes::ctrObtenerDNIPaciente($codHistoria);
        $formato = explode('/', $_FILES["nuevoOdontograma"]["type"]);            
        $date = date("Y-m-d");
        $nombreArchivo = $datosHistoria["DNIPaciente"].'_'.$datosHistoria["IdPaciente"].'_'.$_POST["codSubirImg"].'_'.$date.'.'.$formato[1];
        $ruta = "../image/odontograma/$nombreArchivo";
        $resultado = move_uploaded_file($_FILES["nuevoOdontograma"]["tmp_name"], $ruta);

        $actualizarRuta = self::ctrActualizarRuta($nombreArchivo, $codHistoria);
        if($resultado == true && $actualizarRuta == "ok")
        {
          $respuesta = "ok";
        }
        else
        {
          $respuesta = "error";
        }
      }
      else
      {
        $respuesta = "errorFormato";
      }
    }
    else
    {
      $respuesta = "error";
    }
    return $respuesta;
  }

  //  Actualizar la ruta del odontograma
  public static function ctrActualizarRuta($nombreArchivo, $codHistoria)
  {
    $tabla = "tba_historiaclinica";
    $respuesta = ModelHistorias::mdlActualizarRuta($tabla, $nombreArchivo, $codHistoria);
    return $respuesta;
  }

  //  Descargar Odontograma
  public static function ctrDescargarOdontograma($codHistoria)
  {
    $tabla = "tba_historiaclinica";
    $rutaOdontograma = ModelHistorias::mdlDescargarOdontograma($tabla, $codHistoria);
    $archivo = $rutaOdontograma["RutaOdontograma"];
    $ruta = "image/odontograma/".$archivo;
    
    $respuesta = array("archivo" => $archivo,
        "ruta" => $ruta
        );
    
    return $respuesta;
  }

  //  Contar las historias que tenemos creadas
  public static function ctrContarHistoriasCreadas()
  {
    $tabla = "tba_historiaclinica";
    $sumaHistorias = ModelHistorias::mdlContarHistoriasCreadas($tabla);
    return $sumaHistorias;
  }

  //  Verificar uso de un socio en una historia clínica
  public static function ctrVerificarUsoSocio($codSocio)
  {
    $tabla = "tba_historiaclinica";
    $contarUso = ModelHistorias::mdlVerificarUsoSocio($tabla, $codSocio);
    return $contarUso;
  }

  //  Verificar uso de un paciente en una historia clínica
  public static function ctrVerificarUsoPaciente($codPaciente)
  {
    $tabla = "tba_historiaclinica";
    $contarUso = ModelHistorias::mdlVerificarUsoPaciente($tabla, $codPaciente);
    return $contarUso;
  }
  
}
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
    if (isset($_POST["nombrePaciente"])) {
      $tablaHistoria = "tba_historiaclinica";

      //  Actualizar los datos del paciente
      $datosUpdatePaciente = array(
        "IdPaciente" => $_GET["codPaciente"],
        "SexoPaciente" => $_POST["sexoPaciente"],
        "EdadPaciente" => $_POST["edadPaciente"],
        "OcupacionPaciente" => $_POST["ocupacionPaciente"],
        "LugarProcedencia" => $_POST["lugarProcedencia"],
        "DomicilioPaciente" => $_POST["domicilioPaciente"],
        "CelularPaciente" => $_POST["celularPaciente"],
        "UsuarioActualizado" => $_SESSION["idUsuario"],
        "FechaActualizacion" => date("Y-m-d") . ' ' . date('H:i:s'),
      );
      $respuestaPaciente = ControllerPacientes::ctrUpdateDatosPaciente($datosUpdatePaciente);

      //  Se creará la historia luego de que los datos del paciente fueron actualizados
      if ($respuestaPaciente == "ok") {
        $datosCreateHistoria = array(
          "IdPaciente" => $_GET["codPaciente"],
          "IdUsuario" => $_SESSION["idUsuario"],
          "MotivoConsulta" => $_POST["motivoConsulta"],
          "CheckAlergias" => $_POST["estadoAlergias"],
          "DescripcionAlergias" => $_POST["descripcionAlergias"],
          "CheckHepatitis" => $_POST["estadoHepatitis"],
          "DescripcionHepatitis" => $_POST["descripcionHepatitis"],
          "CheckDiabetes" => $_POST["estadoDiabetes"],
          "DescripcionDiabetes" => $_POST["descripcionDiabetes"],
          "CheckHipertension" => $_POST["estadoHipertension"],
          "DescripcionHipertension" => $_POST["descripcionHipertension"],
          "CheckHemorragias" => $_POST["estadoHemorragias"],
          "DescripcionHemorragias" => $_POST["descripcionHemorragias"],
          "CheckRenal" => $_POST["estadoRenal"],
          "DescripcionRenal" => $_POST["descripcionRenal"],
          "CheckEndocrina" => $_POST["estadoEndocrina"],
          "DescripcionEndocrina" => $_POST["descripcionEndocrina"],
          "CheckOtros" => $_POST["estadoOtros"],
          "DescripcionOtros" => $_POST["descripcionOtros"],
          "CheckReaccion" => $_POST["estadoReaccion"],
          "DescripcionReaccion" => $_POST["descripcionReaccion"],
          "CheckExodoncia" => $_POST["estadoExodoncia"],
          "DescripcionExodoncia" => $_POST["descripcionExodoncia"],
          "CheckMedicamento" => $_POST["estadoMedicamento"],
          "DescripcionMedicamento" => $_POST["descripcionMedicamento"],
          "CheckGestacion" => $_POST["estadoGestando"],
          "DescripcionGestacion" => $_POST["descripcionGestando"],
          "UsuarioCreado" => $_SESSION["idUsuario"],
          "UsuarioActualizado" => $_SESSION["idUsuario"],
          "FechaCreado" => date("Y-m-d") . ' ' . date('H:i:s'),
          "FechaActualiza" => date("Y-m-d") . ' ' . date('H:i:s'),
        );

        $respuestaHistoria = ModelHistorias::mdlCrearHistoriaClinica($tablaHistoria, $datosCreateHistoria);
        if ($respuestaHistoria == "ok") {
          //  Obtener la ultima historia clinica creada y tener ese valor para crear un plan de tratamiento vacío
          $ultimaHistoria = ModelHistorias::mdlObtenerUltimaHistoria($tablaHistoria);
          $datosCreateTratamiento = array(
            "IdHistoriaClinica" => $ultimaHistoria["Id"],
            "IdPaciente" => $_GET["codPaciente"],
            "UsuarioCreado" => $_SESSION["idUsuario"],
            "UsuarioActualiza" => $_SESSION["idUsuario"],
            "FechaCreacion" => date("Y-m-d") . ' ' . date('H:i:s'),
            "FechaActualizacion" => date("Y-m-d") . ' ' . date('H:i:s'),
          );
          $respuestaTratamiento = ControllerTratamiento::ctrCrearTratamiento($datosCreateTratamiento);
          ControllerPagos::ctrCrearListaPagos($_GET["codPaciente"], $ultimaHistoria["Id"]);
          if ($respuestaTratamiento == "ok") {
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
          } else {
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
        } else {
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

    //  Modifico los valores que son = "on" a "checked" para ponerlos en la etiqueta de cada input
    function modificarValor(&$value, $key)
    {
      if ($value === 'on') {
        $value = 'checked';
      }
    }
    array_walk($respuesta, 'modificarValor');
    return $respuesta;
  }

  //  Editar Historia clínica
  public static function ctrEditarHistoria()
  {
    if (isset($_POST["nombrePaciente"])) {
      $tablaHistoria = "tba_historiaclinica";
      $tablaDetalleHistoria = "tba_detallehistoriaclinica";
      $codPaciente = $_GET["codPaciente"];
      $codHistoria = $_GET["codHistoria"];

      //  Actualizar los datos del paciente
      $datosUpdatePaciente = array(
        "IdPaciente" => $codPaciente,
        "SexoPaciente" => $_POST["editarSexoPaciente"],
        "EdadPaciente" => $_POST["editarEdadPaciente"],
        "OcupacionPaciente" => $_POST["editarOcupacionPaciente"],
        "LugarProcedencia" => $_POST["editarLugarProcedencia"],
        "DomicilioPaciente" => $_POST["editarDomicilio"],
        "CelularPaciente" => $_POST["editarCelular"],
        "UsuarioActualizado" => $_SESSION["idUsuario"],
        "FechaActualizacion" => date("Y-m-d") . ' ' . date('H:i:s'),
      );
      $respuestaPaciente = ControllerPacientes::ctrUpdateDatosPacienteEditar($datosUpdatePaciente);

      //  Actualiza los datos de la historia clinica
      if ($respuestaPaciente == "ok") {
        $datosUpdateHistoria = array(
          "IdPaciente" => $_GET["codPaciente"],
          "MotivoConsulta" => $_POST["editarMotivoConsulta"],
          "CheckAlergias" => $_POST["editarEstadoAlergias"],
          "DescripcionAlergias" => $_POST["editarDescripcionAlergias"],
          "CheckHepatitis" => $_POST["editarEstadoHepatitis"],
          "DescripcionHepatitis" => $_POST["editarDescripcionHepatitis"],
          "CheckDiabetes" => $_POST["editarEstadoDiabetes"],
          "DescripcionDiabetes" => $_POST["editarDescripcionDiabetes"],
          "CheckHipertension" => $_POST["editarEstadoHipertension"],
          "DescripcionHipertension" => $_POST["editarDescripcionHipertension"],
          "CheckHemorragias" => $_POST["editarEstadoHemorragias"],
          "DescripcionHemorragias" => $_POST["editarDescripcionHemorragias"],
          "CheckRenal" => $_POST["editarEstadoRenal"],
          "DescripcionRenal" => $_POST["editarDescripcionRenal"],
          "CheckEndocrina" => $_POST["editarEstadoEndocrina"],
          "DescripcionEndocrina" => $_POST["editarDescripcionEndocrina"],
          "CheckOtros" => $_POST["editarEstadoOtros"],
          "DescripcionOtros" => $_POST["editarDescripcionOtros"],
          "CheckReaccion" => $_POST["editarEstadoReaccion"],
          "DescripcionReaccion" => $_POST["editarDescripcionReaccion"],
          "CheckExodoncia" => $_POST["editarEstadoExodoncia"],
          "DescripcionExodoncia" => $_POST["editarDescripcionExodoncia"],
          "CheckMedicamento" => $_POST["editarEstadoMedicamento"],
          "DescripcionMedicamento" => $_POST["editarDescripcionMedicamento"],
          "CheckGestacion" => $_POST["editarEstadoGestando"],
          "DescripcionGestacion" => $_POST["editarDescripcionGestando"],
          "UsuarioActualizado" => $_SESSION["idUsuario"],
          "FechaActualiza" => date("Y-m-d") . ' ' . date('H:i:s'),
        );
        $respuestaHistoria = ModelHistorias::mdlUpdateHistoriaClinica($tablaHistoria, $datosUpdateHistoria);

        //Actualizar el detalle de la historia clínica
        if ($respuestaHistoria == "ok") {
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
        } else {
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
      } else {
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

  //  Eliminar historia clinica 
  public static function ctrEliminarHistoria()
  {
    if (isset($_GET["codHistoria"])) {
      $tablaHistoria = "tba_historiaclinica";
      $codHistoria = $_GET["codHistoria"];
      $codPaciente = $_GET["codPaciente"];
      //  Primero vamos a elimiar el tratamiento, luego el historial de visitas y por último la historia clínica
      $codTratamiento = ControllerTratamiento::ctrObtenerIdTratamiento($codPaciente);

      $eliminarTratamiento = ControllerTratamiento::ctrEliminarTratamiento($codTratamiento["IdTratamiento"]);
      if ($eliminarTratamiento == "ok") {
        $eliminarVisita = ControllerVisitas::ctrEliminarVisitas($codHistoria);
        if ($eliminarVisita == "ok") {
          $eliminarHistoria = ModelHistorias::mdlEliminarHistoria($tablaHistoria, $codHistoria);
          if ($eliminarHistoria == "ok") {
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
          } else {
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
        } else {
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
      } else {
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
    if (isset($_FILES["nuevoOdontograma"])) {
      if ($_FILES["nuevoOdontograma"]["type"] == "image/jpeg" || $_FILES["nuevoOdontograma"]["type"] == "image/jpg" || $_FILES["nuevoOdontograma"]["type"] == "image/png" || $_FILES["nuevoOdontograma"]["type"] == "application/pdf") {
        $datosHistoria = ControllerPacientes::ctrObtenerDNIPaciente($codHistoria);
        $formato = explode('/', $_FILES["nuevoOdontograma"]["type"]);
        $date = date("Y-m-d");
        $nombreArchivo = $datosHistoria["DNIPaciente"] . '_' . $datosHistoria["IdPaciente"] . '_' . $_POST["codSubirImg"] . '_' . $date . '.' . $formato[1];
        $ruta = "../image/odontograma/$nombreArchivo";
        $resultado = move_uploaded_file($_FILES["nuevoOdontograma"]["tmp_name"], $ruta);

        $actualizarRuta = self::ctrActualizarRuta($nombreArchivo, $codHistoria);
        if ($resultado == true && $actualizarRuta == "ok") {
          $respuesta = "ok";
        } else {
          $respuesta = "error";
        }
      } else {
        $respuesta = "errorFormato";
      }
    } else {
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
    $ruta = "image/odontograma/" . $archivo;

    $respuesta = array(
      "archivo" => $archivo,
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

  //  Verificar uso de un paciente en una historia clínica
  public static function ctrVerificarUsoPaciente($codPaciente)
  {
    $tabla = "tba_historiaclinica";
    $contarUso = ModelHistorias::mdlVerificarUsoPaciente($tabla, $codPaciente);
    return $contarUso;
  }
}

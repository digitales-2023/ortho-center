<?php
date_default_timezone_set('America/Lima');
class ControllerPacientes
{
  //  Mostrar todos los pacientes
  public static function ctrMostrarPacientes()
  {
    $tabla = "tba_paciente";
    $listaPacientes = ModelPacientes::mdlMostrarPacientes($tabla);
    return $listaPacientes;
  }

  //  Mostrar los datos de un paciente para editar
  public static function ctrMostrarDatosEditar($codPaciente)
  {
    $tabla = "tba_paciente";
    $datosPaciente = ModelPacientes::mdlMostrarDatosEditar($tabla, $codPaciente);
    return $datosPaciente;
  }

  //  Crear un nuevo paciente
  public static function ctrCrearPaciente()
  {
    if(isset($_POST["nombrePaciente"]))
    {
      $tabla = "tba_paciente";
      $datosCreate = array(
        "NombrePaciente" => $_POST["nombrePaciente"],
        "ApellidoPaciente" => $_POST["apellidoPaciente"],
        "DNIPaciente" => $_POST["numeroDNI"],
        "CelularPaciente" => $_POST["celularPaciente"],
        "UsuarioCreado"=>$_SESSION["idUsuario"],
        "UsuarioActualiza"=>$_SESSION["idUsuario"],
        "FechaCreacion"=>date("Y-m-d\TH:i:sP"),
        "FechaActualizacion"=>date("Y-m-d\TH:i:sP"),
      );

      $respuesta = ModelPacientes::mdlCrearPaciente($tabla, $datosCreate);
      if($respuesta == "ok")
      {
        echo '
        <script>
          Swal.fire({
            icon: "success",
            title: "Correcto",
            text: "Paciente ingresado Correctamente!",
          }).then(function(result){
					  if(result.value){
							window.location = "pacientes";
						}
					});
        </script>';
      }	
    }
  }

  //  Editar un paciente
  public static function ctrEditarPaciente()
  {
    if(isset($_POST["editarNombrePaciente"]))
    {
      $tabla = "tba_paciente";
      $datosUpdate = array(
        "NombrePaciente" =>  $_POST["editarNombrePaciente"],
        "ApellidoPaciente" => $_POST["editarApellidoPaciente"],
        "DNIPaciente" => $_POST["editarDNIPaciente"],
        "CelularPaciente" => $_POST["editarCelularPaciente"],
        "IdPaciente" => $_POST["codPaciente"],
        "FechaActualizacion"=>date("Y-m-d\TH:i:sP"),
      );

      $respuesta = ModelPacientes::mdlUpdatePaciente($tabla, $datosUpdate);
      if($respuesta == "ok")
      {
        echo '
        <script>
          Swal.fire({
            icon: "success",
            title: "Correcto",
            text: "Socio editado Correctamente!",
          }).then(function(result){
            if(result.value){
              window.location = "pacientes";
            }
          });
        </script>';
      }
    }
  }

  //  Eliminar un paciente
  public static function ctrEliminarPaciente()
  {
    if (isset($_GET["codPaciente"]))
    {
      $codPaciente = $_GET["codPaciente"];
      $confirmarUsoHistoria = ControllerHistorias::ctrVerificarUsoPaciente($codPaciente);
      $confirmarUsoPago = ControllerPagos::ctrVerificarUsoPaciente($codPaciente);
      $confirmarUsoCita = ControllerCitas::ctrVerificarUsoPaciente($codPaciente);
      if(($confirmarUsoHistoria["TotalUso"] > 0) || ($confirmarUsoPago["TotalUso"] > 0) || ($confirmarUsoCita["TotalUso"] > 0))
      {
        echo '
          <script>
            Swal.fire({
              icon: "error",
              title: "Error",
              text: "¡No se puede eliminar el paciente, está en uso!",
            }).then(function(result){
              if(result.value){
                window.location = "pacientes";
              }
            });
          </script>';
      }
      else
      {
        $tabla = "tba_paciente";
        $respuesta = ModelPacientes::mdlEliminarPaciente($tabla, $codPaciente);
        if($respuesta == "ok")
        {
          echo '
            <script>
              Swal.fire({
                icon: "success",
                title: "Correcto",
                text: "¡Paciente eliminado Correctamente!",
              }).then(function(result){
                if(result.value){
                  window.location = "pacientes";
                }
              });
            </script>';
        }
      }
    }
  }

  //  Mostrar los pacientes para la historia clínica --> REVISAR ASDASDASda
  public static function ctrMostrarPacientesHistoria()
  {
    $tabla = "tba_paciente";
    $listaPacientes = ModelPacientes::mdlMostrarPacientesHistoria($tabla);
    return $listaPacientes;
  }

  //  Update datos del paciente en la historia clínica
  public static function ctrUpdateDatosPaciente($datosUpdatePaciente)
  {
    $tabla = "tba_paciente";
    $respuesta = ModelPacientes::mdlUpdateDatospaciente($tabla, $datosUpdatePaciente);
    return $respuesta;
  }

  //  Mostrar datos del paciente para la historia clínica
  public static function ctrMostrarDatosHistoria($codPaciente)
  {
    $tabla = "tba_paciente";
    $datosPaciente = ModelPacientes::mdlMostrarDatosHistoria($tabla, $codPaciente);
    return $datosPaciente;
  }

  //  Editar los datos del en la vista de editar
  public static function ctrUpdateDatosPacienteEditar($datosUpdatePaciente)
  {
    $tabla = "tba_paciente";
    $respuesta = ModelPacientes::mdlUpdateDatosPacienteEditar($tabla, $datosUpdatePaciente);
    return $respuesta;
  }

  //  Mostrar datos generales del paciente
  public static function ctrMostrarDatosTratamiento($codPaciente)
  {
    $tabla = "tba_paciente";
    $datosPaciente = ModelPacientes::mdlMostrarDatosTratamiento($tabla, $codPaciente);
    return $datosPaciente;
  }

  //  Buscar paciente por DNI
  public static function ctrBuscarPacienteDNI($numeroDNI)
  {
    $tabla = "tba_paciente";
    $datosPaciente = ModelPacientes::mdlBuscarPacienteDNI($tabla, $numeroDNI);
    return $datosPaciente;
  }

  //  Mostrar los datos del paciente en visualiar pagos
  public static function ctrMostrarDatosBasicos($codPaciente)
  {
    $tabla = "tba_paciente";
    $datosPaciente = ModelPacientes::mdlMostrarDatosBasicos($tabla, $codPaciente);
    return $datosPaciente;
  }

  //  Mostrar datos para imprimir historia clinica
  public static function ctrObtenerDatosHistoriaPdf($codHistoria)
  {
    $tabla = "tba_paciente";
    $datosHistoria = ModelPacientes::mdlObtenerDatosHistoriaPdf($tabla, $codHistoria);
    return $datosHistoria;
  }

  //  Mostrar los datos básicos del paciente para imprimir en pdf
  public static function ctrMostrarDatosImprimir($codPaciente)
  {
    $tabla = "tba_paciente";
    $datosHistoria = ModelPacientes::mdlMostrarDatosImprimir($tabla, $codPaciente);
    return $datosHistoria;
  }

  //  Verificar el numero de DNI para ver si se encuentra dentro de la base de datos
  public static function ctrVerificarNumeroDNI($numeroDNIBuscar)
  {
    $tabla = "tba_paciente";
    $respuesta = "ok";
    $nombrePaciente = ModelPacientes::mdlVerificarPacienteDNI($tabla, $numeroDNIBuscar);
    $historiaPaciente = ControllerHistorias::ctrBuscarHistoriaDNI($numeroDNIBuscar);
    $respuesta = array(
      "respuesta" => "error",
      "codPaciente" => '',
    );

    //  Si me devuelve un valor, significa que tiene una historia y no puede crear otra
    if($historiaPaciente["Contador"] == '1')
    {
      $respuesta["respuesta"] = "historia";
    }
    else
    {
      //  Si nos devuelve valor de 1, significa que el paciente existe por lo cual lo busco para mandarlo junto con la respuesta
      if($nombrePaciente["Contador"] == '1')
      {
        $codPaciente = self::ctrBuscarPacienteDNI($numeroDNIBuscar);
        $respuesta["codPaciente"] = $codPaciente["IdPaciente"];
        $respuesta["respuesta"] = "ok";
      }
      else
      {
        $respuesta["respuesta"] = "paciente";
      }
    }
    return $respuesta;
  }

  //  Obtener los nombres del paciente por el codigo de historia
  public static function ctrObtenerDNIPaciente($codHistoria)
  {
    $tabla = "tba_paciente";
    $nombresPaciente = ModelPacientes::mdlObtenerDNIPaciente($tabla, $codHistoria);
    return $nombresPaciente;
  }

  //  Contar los pacientes registrados
  public static function ctrContarPacientes()
  {
    $table = "tba_paciente";
    $totalPacientes = ModelPacientes::mdlContarPacientes($table);
    return $totalPacientes;
  }
}
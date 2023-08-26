<?php
date_default_timezone_set('America/Lima');
class ControllerCitas
{
  //  Mostrar todas las citas actuales
  public static function ctrMostrarTodasCitas()
  {
    $tabla = "tba_cita";
    $listaCitas = ModelCitas::ctrMostrarTodasCitas($tabla);
    return $listaCitas;
  }

  //  Crear una nueva cita
  public static function ctrCrearNuevaCita()
  {
    if(isset($_POST["codPacienteCita"]))
    {
      if($_POST["codPacienteCita"] != null || $_POST["codPacienteCita"] != '')
      {
        $tabla = "tba_cita";
        $datosCreate = array(
          "IdPaciente" => $_POST["codPacienteCita"],
          "FechaProgramada" => $_POST["fechaProgramacion"],
          "MedicoAsignado" => $_POST["medicoAsignadoCita"],
          "EstadoCita" => "1",
          "FechaCreacion" => date("Y-m-d\TH:i:sP"),
          "FechaActualizacion" => date("Y-m-d\TH:i:sP"),
        );
        $respuestaCita = ModelCitas::mdlCrearNuevaCita($tabla, $datosCreate);
  
        if($respuestaCita == "ok")
        {
          echo '
            <script>
              Swal.fire({
                icon: "success",
                title: "Correcto",
                text: "¡Cita Registrada Correctamente!",
              }).then(function(result){
                if(result.value){
                  window.location = "index.php?ruta=programacionCitas";
                }
              });
            </script>
          ';
        }
        else
        {
          echo '
            <script>
              Swal.fire({
                icon: "error",
                title: "Error",
                text: "¡Error al intentar registrar una cita!",
              }).then(function(result){
                if(result.value){
                  window.location = "index.php?ruta=programacionCitas";
                }
              });
            </script>
          ';
        }
      }
      else
      {
        echo '
          <script>
            Swal.fire({
              icon: "error",
              title: "Error",
              text: "¡No se indentificó ninguno paciente!",
            }).then(function(result){
              if(result.value){
                window.location = "index.php?ruta=programacionCitas";
              }
            });
          </script>
        ';
      }
      
    }
  }

  //  Editar una cita
  public static function ctrEditarCita()
  {
    if(isset($_POST["codCitaEditar"]))
    {
      if($_POST["codCitaEditar"] != null || $_POST["codCitaEditar"] != '')
      {
        $tabla = "tba_cita";
        $datosUpdate = array(
          "IdCita" => $_POST["codCitaEditar"],
          "IdPaciente" => $_POST["codPacienteCitaEditar"],
          "FechaProgramada" => $_POST["fechaProgramacionEditar"],
          "MedicoAsignado" => $_POST["medicoAsignadoCitaEditar"],
          "EstadoCita" => "1",
          "FechaActualizacion" => date("Y-m-d\TH:i:sP"),
        );
        $respuesta = ModelCitas::mdlEditarCita($tabla, $datosUpdate);
        if($respuesta == "ok")
        {
          echo '
            <script>
              Swal.fire({
                icon: "success",
                title: "Correcto",
                text: "¡Cita Editada Correctamente!",
              }).then(function(result){
                if(result.value){
                  window.location = "index.php?ruta=programacionCitas";
                }
              });
            </script>
          ';
        }
        else
        {
          echo '
            <script>
              Swal.fire({
                icon: "error",
                title: "Error",
                text: "¡Error al intentar editar la cita!",
              }).then(function(result){
                if(result.value){
                  window.location = "index.php?ruta=programacionCitas";
                }
              });
            </script>
          ';
        }
      }
      else
      {
        echo '
          <script>
            Swal.fire({
              icon: "error",
              title: "Error",
              text: "¡No se indentificó ninguno paciente!",
            }).then(function(result){
              if(result.value){
                window.location = "index.php?ruta=programacionCitas";
              }
            });
          </script>
        ';
      }
    }
  }

  //  Mostrar datos para editar una cita
  public static function ctrMostrarDatosEditar($codCita)
  {
    $tabla = "tba_cita";
    $respuesta = ModelCitas::mdlMostrarDatosEditar($tabla, $codCita);
    return $respuesta;
  }

  //  Eliminar una cita
  public static function ctrEliminarCita()
  {
    if(isset($_GET["codCita"]))
    {
      $tabla = "tba_cita";
      $codCita = $_GET["codCita"];
      $respuesta = ModelCitas::mdlEliminarCita($tabla, $codCita);
      if($respuesta == "ok")
      {
        echo '
          <script>
            Swal.fire({
              icon: "success",
              title: "Correcto",
              text: "¡Cita eliminada correctamente!",
            }).then(function(result){
              if(result.value){
                window.location = "index.php?ruta=programacionCitas";
              }
            });
          </script>
        ';
      }
      else
      {
        echo '
          <script>
            Swal.fire({
              icon: "error",
              title: "Error",
              text: "¡Error al intentar eliminar cita!",
            }).then(function(result){
              if(result.value){
                window.location = "index.php?ruta=programacionCitas";
              }
            });
          </script>
        ';
      }
    }
  }

  //  Contar las citas registradas para hoy
  public static function ctrSumarCitasHoy()
  {
    $tabla = "tba_cita";
    $fechaHoy = date("Y-m-d");
    $sumaCitasHoy = ModelCitas::mdlContarCitasHoy($tabla, $fechaHoy);
    return $sumaCitasHoy;
  }

  //  Verificar si un paciente tiene citas
  public static function ctrVerificarUsoPaciente($codPaciente)
  {
    $tabla = "tba_cita";
    $contarUso = ModelCitas::mdlVerificarUsoPaciente($tabla, $codPaciente);
    return $contarUso;
  }
}
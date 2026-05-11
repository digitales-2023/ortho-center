<?php
date_default_timezone_set('America/Lima');

/**
 * ControllerCitas — Módulo nuevo incorporado de dentavitalis (B)
 *
 * ortho-center no tenía módulo de citas. Se incorpora íntegro de B.
 * La tabla tba_cita usa MedicoAsignado como FK a tba_socio.IdSocio.
 *
 * Métodos:
 *  - ctrMostrarTodasCitas: lista todas las citas con paciente y médico
 *  - ctrCrearNuevaCita: registra una nueva cita
 *  - ctrEditarCita: edita una cita existente
 *  - ctrMostrarDatosEditar: obtiene los datos de una cita para editar
 *  - ctrEliminarCita: elimina una cita
 *  - ctrSumarCitasHoy: cuenta las citas programadas para hoy (dashboard)
 *  - ctrVerificarUsoPaciente: verifica si un paciente tiene citas (antes de eliminarlo)
 */
class ControllerCitas
{
  // ── LISTAR ──────────────────────────────────────────────────────────────

  // Mostrar todas las citas con datos del paciente y médico asignado
  public static function ctrMostrarTodasCitas()
  {
    $tabla = "tba_cita";
    $listaCitas = ModelCitas::mdlMostrarTodasCitas($tabla);
    return $listaCitas;
  }

  // Mostrar los datos de una cita para editar
  public static function ctrMostrarDatosEditar($codCita)
  {
    $tabla = "tba_cita";
    $respuesta = ModelCitas::mdlMostrarDatosEditar($tabla, $codCita);
    return $respuesta;
  }

  // Contar las citas programadas para hoy (widget de dashboard)
  public static function ctrSumarCitasHoy()
  {
    $tabla      = "tba_cita";
    $fechaHoy   = date("Y-m-d");
    $sumaCitasHoy = ModelCitas::mdlContarCitasHoy($tabla, $fechaHoy);
    return $sumaCitasHoy;
  }

  // Verificar si un paciente tiene citas (antes de eliminar paciente)
  public static function ctrVerificarUsoPaciente($codPaciente)
  {
    $tabla     = "tba_cita";
    $contarUso = ModelCitas::mdlVerificarUsoPaciente($tabla, $codPaciente);
    return $contarUso;
  }

  // ── CREAR ────────────────────────────────────────────────────────────────

  // Registrar una nueva cita
  public static function ctrCrearNuevaCita()
  {
    if (isset($_POST["codPacienteCita"])) {
      if ($_POST["codPacienteCita"] != null && $_POST["codPacienteCita"] != '') {
        $tabla = "tba_cita";
        $datosCreate = array(
          "IdPaciente"        => $_POST["codPacienteCita"],
          "FechaProgramada"   => $_POST["fechaProgramacion"],
          "MedicoAsignado"    => $_POST["medicoAsignadoCita"],
          "EstadoCita"        => "1",
          "FechaCreacion"     => date("Y-m-d\TH:i:sP"),
          "FechaActualizacion"=> date("Y-m-d\TH:i:sP"),
        );
        $respuestaCita = ModelCitas::mdlCrearNuevaCita($tabla, $datosCreate);

        if ($respuestaCita == "ok") {
          echo '<script>Swal.fire({ icon: "success", title: "Correcto", text: "¡Cita Registrada Correctamente!" }).then(function(r){ if(r.value) window.location = "index.php?ruta=programacionCitas"; });</script>';
        } else {
          echo '<script>Swal.fire({ icon: "error", title: "Error", text: "¡Error al intentar registrar una cita!" }).then(function(r){ if(r.value) window.location = "index.php?ruta=programacionCitas"; });</script>';
        }
      } else {
        echo '<script>Swal.fire({ icon: "error", title: "Error", text: "¡No se identificó ningún paciente!" }).then(function(r){ if(r.value) window.location = "index.php?ruta=programacionCitas"; });</script>';
      }
    }
  }

  // ── EDITAR ───────────────────────────────────────────────────────────────

  // Editar una cita existente
  public static function ctrEditarCita()
  {
    if (isset($_POST["codCitaEditar"])) {
      if ($_POST["codCitaEditar"] != null && $_POST["codCitaEditar"] != '') {
        $tabla = "tba_cita";
        $datosUpdate = array(
          "IdCita"            => $_POST["codCitaEditar"],
          "IdPaciente"        => $_POST["codPacienteCitaEditar"],
          "FechaProgramada"   => $_POST["fechaProgramacionEditar"],
          "MedicoAsignado"    => $_POST["medicoAsignadoCitaEditar"],
          "EstadoCita"        => "1",
          "FechaActualizacion"=> date("Y-m-d\TH:i:sP"),
        );
        $respuesta = ModelCitas::mdlEditarCita($tabla, $datosUpdate);

        if ($respuesta == "ok") {
          echo '<script>Swal.fire({ icon: "success", title: "Correcto", text: "¡Cita Editada Correctamente!" }).then(function(r){ if(r.value) window.location = "index.php?ruta=programacionCitas"; });</script>';
        } else {
          echo '<script>Swal.fire({ icon: "error", title: "Error", text: "¡Error al intentar editar la cita!" }).then(function(r){ if(r.value) window.location = "index.php?ruta=programacionCitas"; });</script>';
        }
      } else {
        echo '<script>Swal.fire({ icon: "error", title: "Error", text: "¡No se identificó ningún paciente!" }).then(function(r){ if(r.value) window.location = "index.php?ruta=programacionCitas"; });</script>';
      }
    }
  }

  // ── ELIMINAR ─────────────────────────────────────────────────────────────

  // Eliminar una cita
  public static function ctrEliminarCita()
  {
    if (isset($_GET["codCita"])) {
      $tabla   = "tba_cita";
      $codCita = $_GET["codCita"];
      $respuesta = ModelCitas::mdlEliminarCita($tabla, $codCita);

      if ($respuesta == "ok") {
        echo '<script>Swal.fire({ icon: "success", title: "Correcto", text: "¡Cita eliminada correctamente!" }).then(function(r){ if(r.value) window.location = "index.php?ruta=programacionCitas"; });</script>';
      } else {
        echo '<script>Swal.fire({ icon: "error", title: "Error", text: "¡Error al intentar eliminar cita!" }).then(function(r){ if(r.value) window.location = "index.php?ruta=programacionCitas"; });</script>';
      }
    }
  }
}

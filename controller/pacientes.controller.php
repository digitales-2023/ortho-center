<?php
date_default_timezone_set('America/Lima');

/**
 * ControllerPacientes — Fusionado ortho-center (A) + dentavitalis (B)
 *
 * Cambios respecto a ortho-center original:
 *  - ctrCrearPaciente: ahora envía TipoIdentificacion + NumeroIdentificacion (antes solo DNIPaciente)
 *  - ctrEditarPaciente: usa NumeroIdentificacion en lugar de DNIPaciente
 *  - ctrEliminarPaciente: agrega verificación de citas (ControllerCitas) — viene de B
 *  - ctrUpdateDatosPaciente: llama a mdlUpdateDatospaciente (nombre corregido igual que B)
 *  - [NUEVO B] ctrCrearPacienteCotizacion: crea paciente desde flujo de cotización
 *  - [NUEVO B] ctrMostrarDatosPaciente: retorna datos básicos por IdPaciente
 *  - [NUEVO B] ctrVerificarDNICotizacion: verifica si existe paciente para cotizar
 *  - ctrVerificarNumeroDNI: usa ctrBuscarPacienteDNI (unificado, igual en A y B)
 */
class ControllerPacientes
{
  // ── LISTAR ──────────────────────────────────────────────────────────────

  // Mostrar todos los pacientes
  public static function ctrMostrarPacientes()
  {
    $tabla = "tba_paciente";
    $listaPacientes = ModelPacientes::mdlMostrarPacientes($tabla);
    return $listaPacientes;
  }

  // Mostrar los datos de un paciente para editar
  public static function ctrMostrarDatosEditar($codPaciente)
  {
    $tabla = "tba_paciente";
    $datosPaciente = ModelPacientes::mdlMostrarDatosEditar($tabla, $codPaciente);
    return $datosPaciente;
  }

  // Mostrar datos básicos del paciente por código (nuevo de B, usado en cotizaciones)
  public static function ctrMostrarDatosPaciente($codPaciente)
  {
    $tabla = "tba_paciente";
    $respuesta = ModelPacientes::mdlMostrarDatosPaciente($tabla, $codPaciente);
    return $respuesta;
  }

  // Mostrar datos del paciente para la historia clínica
  public static function ctrMostrarDatosHistoria($codPaciente)
  {
    $tabla = "tba_paciente";
    $datosPaciente = ModelPacientes::mdlMostrarDatosHistoria($tabla, $codPaciente);
    return $datosPaciente;
  }

  // Mostrar datos generales del paciente (plan de tratamiento)
  public static function ctrMostrarDatosTratamiento($codPaciente)
  {
    $tabla = "tba_paciente";
    $datosPaciente = ModelPacientes::mdlMostrarDatosTratamiento($tabla, $codPaciente);
    return $datosPaciente;
  }

  // Mostrar los datos del paciente en visualizar pagos
  public static function ctrMostrarDatosBasicos($codPaciente)
  {
    $tabla = "tba_paciente";
    $datosPaciente = ModelPacientes::mdlMostrarDatosBasicos($tabla, $codPaciente);
    return $datosPaciente;
  }

  // Mostrar datos para imprimir historia clínica (PDF)
  public static function ctrObtenerDatosHistoriaPdf($codHistoria)
  {
    $tabla = "tba_paciente";
    $datosHistoria = ModelPacientes::mdlObtenerDatosHistoriaPdf($tabla, $codHistoria);
    return $datosHistoria;
  }

  // Mostrar los datos básicos del paciente para imprimir en PDF
  public static function ctrMostrarDatosImprimir($codPaciente)
  {
    $tabla = "tba_paciente";
    $datosHistoria = ModelPacientes::mdlMostrarDatosImprimir($tabla, $codPaciente);
    return $datosHistoria;
  }

  // Obtener los nombres/identificación del paciente por código de historia
  public static function ctrObtenerDNIPaciente($codHistoria)
  {
    $tabla = "tba_paciente";
    $nombresPaciente = ModelPacientes::mdlObtenerDNIPaciente($tabla, $codHistoria);
    return $nombresPaciente;
  }

  // Contar los pacientes registrados (dashboard)
  public static function ctrContarPacientes()
  {
    $table = "tba_paciente";
    $totalPacientes = ModelPacientes::mdlContarPacientes($table);
    return $totalPacientes;
  }

  // ── CREAR ────────────────────────────────────────────────────────────────

  // Crear un nuevo paciente (formulario pacientes)
  // Usa TipoIdentificacion + NumeroIdentificacion en lugar del antiguo DNIPaciente
  public static function ctrCrearPaciente()
  {
    if (isset($_POST["nombrePaciente"])) {
      $tabla = "tba_paciente";
      $datosCreate = array(
        "NombrePaciente"      => $_POST["nombrePaciente"],
        "ApellidoPaciente"    => $_POST["apellidoPaciente"],
        "TipoIdentificacion"  => $_POST["tipoIdentificacion"],
        "NumeroIdentificacion"=> $_POST["numeroDNI"],
        "CelularPaciente"     => $_POST["celularPaciente"],
        "UsuarioCreado"       => $_SESSION["idUsuario"],
        "UsuarioActualiza"    => $_SESSION["idUsuario"],
        "FechaCreacion"       => date("Y-m-d\TH:i:sP"),
        "FechaActualizacion"  => date("Y-m-d\TH:i:sP"),
      );

      $respuesta = ModelPacientes::mdlCrearPaciente($tabla, $datosCreate);
      if ($respuesta == "ok") {
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

  // [NUEVO B] Crear paciente directamente desde el flujo de cotización
  public static function ctrCrearPacienteCotizacion($datosPaciente)
  {
    $tabla = "tba_paciente";
    $respuesta = ModelPacientes::mdlCrearPaciente($tabla, $datosPaciente);
    return $respuesta;
  }

  // ── EDITAR ───────────────────────────────────────────────────────────────

  // Editar un paciente (formulario pacientes)
  public static function ctrEditarPaciente()
  {
    if (isset($_POST["editarNombrePaciente"])) {
      $tabla = "tba_paciente";
      $datosUpdate = array(
        "NombrePaciente"      => $_POST["editarNombrePaciente"],
        "ApellidoPaciente"    => $_POST["editarApellidoPaciente"],
        "NumeroIdentificacion"=> $_POST["editarDNIPaciente"],
        "CelularPaciente"     => $_POST["editarCelularPaciente"],
        "IdPaciente"          => $_POST["codPaciente"],
        "FechaActualizacion"  => date("Y-m-d\TH:i:sP"),
      );

      $respuesta = ModelPacientes::mdlUpdatePaciente($tabla, $datosUpdate);
      if ($respuesta == "ok") {
        echo '
        <script>
          Swal.fire({
            icon: "success",
            title: "Correcto",
            text: "Paciente editado Correctamente!",
          }).then(function(result){
            if(result.value){
              window.location = "pacientes";
            }
          });
        </script>';
      }
    }
  }

  // Update datos del paciente en la historia clínica (campos clínicos extendidos)
  public static function ctrUpdateDatosPaciente($datosUpdatePaciente)
  {
    $tabla = "tba_paciente";
    // Nota: mdlUpdateDatospaciente (minúscula 'p') es el nombre correcto en el modelo fusionado
    $respuesta = ModelPacientes::mdlUpdateDatospaciente($tabla, $datosUpdatePaciente);
    return $respuesta;
  }

  // Editar datos del paciente al editar la historia clínica
  public static function ctrUpdateDatosPacienteEditar($datosUpdatePaciente)
  {
    $tabla = "tba_paciente";
    $respuesta = ModelPacientes::mdlUpdateDatosPacienteEditar($tabla, $datosUpdatePaciente);
    return $respuesta;
  }

  // ── ELIMINAR ─────────────────────────────────────────────────────────────

  // Eliminar un paciente (verifica uso en historias, pagos y citas)
  public static function ctrEliminarPaciente()
  {
    if (isset($_GET["codPaciente"])) {
      $codPaciente = $_GET["codPaciente"];
      $confirmarUsoHistoria = ControllerHistorias::ctrVerificarUsoPaciente($codPaciente);
      $confirmarUsoPago     = ControllerPagos::ctrVerificarUsoPaciente($codPaciente);
      $confirmarUsoCita     = ControllerCitas::ctrVerificarUsoPaciente($codPaciente); // [NUEVO B]

      if (
        ($confirmarUsoHistoria["TotalUso"] > 0) ||
        ($confirmarUsoPago["TotalUso"]     > 0) ||
        ($confirmarUsoCita["TotalUso"]     > 0)
      ) {
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
      } else {
        $tabla    = "tba_paciente";
        $respuesta = ModelPacientes::mdlEliminarPaciente($tabla, $codPaciente);
        if ($respuesta == "ok") {
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

  // ── BÚSQUEDA / VERIFICACIÓN ───────────────────────────────────────────────

  // Buscar paciente por número de identificación (DNI / pasaporte / etc.)
  public static function ctrBuscarPacienteDNI($numeroDNI)
  {
    $tabla = "tba_paciente";
    $datosPaciente = ModelPacientes::mdlBuscarPacienteDNI($tabla, $numeroDNI);
    return $datosPaciente;
  }

  // Alias: buscar paciente por DNI para iniciar historia clínica
  public static function ctrBuscarPacienteDNIHistoria($numeroDNI)
  {
    return self::ctrBuscarPacienteDNI($numeroDNI);
  }

  // Buscar paciente por DNI y calcular su saldo en pagos
  public static function ctrBuscarPacienteDNIPago($numeroDNI)
  {
    $tabla = "tba_paciente";
    $datosPaciente = ModelPacientes::mdlBuscarPacienteDNI($tabla, $numeroDNI);
    if ($datosPaciente != false || $datosPaciente != '' || $datosPaciente != null) {
      $codHistoria   = ControllerHistorias::ctrObtenerCodHistoria($datosPaciente["IdPaciente"]);
      $totalRealizado = ControllerTratamiento::ctrObtenerTotalRealizado($codHistoria["IdHistoriaClinica"]);
      $totalPagado    = ControllerTratamiento::ctrObtenerTotalPagado($datosPaciente["IdPaciente"]);
      $saldoActual    = $totalRealizado["TotalRealizado"] - $totalPagado["TotalPagado"];
      $datosPaciente["TotalRealizado"] = $saldoActual;
      return $datosPaciente;
    } else {
      return $datosPaciente;
    }
  }

  // Verificar número de identificación para crear historia clínica
  public static function ctrVerificarNumeroDNI($numeroDNIBuscar)
  {
    $tabla          = "tba_paciente";
    $nombrePaciente = ModelPacientes::mdlVerificarPacienteDNI($tabla, $numeroDNIBuscar);
    $historiaPaciente = ControllerHistorias::ctrBuscarHistoriaDNI($numeroDNIBuscar);
    $respuesta = array(
      "respuesta"   => "error",
      "codPaciente" => '',
    );

    if ($historiaPaciente["Contador"] == '1') {
      $respuesta["respuesta"] = "historia";
    } else {
      if ($nombrePaciente["Contador"] == '1') {
        $codPaciente = self::ctrBuscarPacienteDNI($numeroDNIBuscar);
        $respuesta["codPaciente"] = $codPaciente["IdPaciente"];
        $respuesta["respuesta"]   = "ok";
      } else {
        $respuesta["respuesta"] = "paciente";
      }
    }
    return $respuesta;
  }

  // [NUEVO B] Verificar si existe un paciente por identificación para cotización
  public static function ctrVerificarDNICotizacion($numeroDNICotizacion)
  {
    $tabla     = "tba_paciente";
    $respuesta = array(
      "respuesta"   => '',
      "codPaciente" => '',
    );

    $contador = ModelPacientes::mdlVerificarPacienteDNI($tabla, $numeroDNICotizacion);

    if ($contador["Contador"] > 0) {
      $codPaciente = self::ctrBuscarPacienteDNI($numeroDNICotizacion);
      $respuesta["codPaciente"] = $codPaciente["IdPaciente"];
      $respuesta["respuesta"]   = "ok";
    } else {
      $respuesta["respuesta"] = "error";
    }

    return $respuesta;
  }
}
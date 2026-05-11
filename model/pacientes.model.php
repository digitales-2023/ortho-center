<?php

require_once "conexion.php";

/**
 * ModelPacientes — Fusionado ortho-center (A) + dentavitalis (B)
 *
 * Cambios respecto a ortho-center original:
 *  - Todos los SELECT/INSERT/UPDATE ahora usan NumeroIdentificacion + TipoIdentificacion
 *    en lugar de DNIPaciente (campo que queda como alias en la BD con ALTER TABLE)
 *  - mdlCrearPaciente: incluye TipoIdentificacion y NumeroIdentificacion
 *  - mdlUpdateDatospaciente: versión ampliada (B) que actualiza FechaNacimiento,
 *    LugarNacimiento, GradoInstruccion, RazaPaciente, ReligionPaciente, EstadoCivil,
 *    NumeroContactoPaciente, NombreContactoPaciente
 *  - [NUEVO B] mdlUpdateDatosPacienteEditar: actualiza campos extendidos al editar historia
 *  - [NUEVO B] mdlMostrarDatosPaciente: retorna datos básicos por IdPaciente
 *  - mdlObtenerDatosHistoriaPdf: versión B (más completa, JOIN con tba_detallehistoriaclinica)
 *  - mdlMostrarDatosImprimir: incluye TipoIdentificacion y FechaNacimiento
 */
class ModelPacientes
{
  // ── LISTAR ──────────────────────────────────────────────────────────────

  // Mostrar todos los pacientes (módulo pacientes)
  public static function mdlMostrarPacientes($tabla)
  {
    $statement = Conexion::conn()->prepare("SELECT tba_paciente.IdPaciente, tba_paciente.NombrePaciente, tba_paciente.ApellidoPaciente, tba_paciente.TipoIdentificacion, tba_paciente.NumeroIdentificacion, tba_paciente.CelularPaciente FROM $tabla ORDER BY IdPaciente DESC");
    $statement->execute();
    return $statement->fetchAll();
  }

  // Mostrar datos para editar un paciente
  public static function mdlMostrarDatosEditar($tabla, $codPaciente)
  {
    $statement = Conexion::conn()->prepare("SELECT tba_paciente.IdPaciente, tba_paciente.NombrePaciente, tba_paciente.ApellidoPaciente, tba_paciente.TipoIdentificacion, tba_paciente.NumeroIdentificacion, tba_paciente.CelularPaciente FROM $tabla WHERE tba_paciente.IdPaciente = $codPaciente");
    $statement->execute();
    return $statement->fetch();
  }

  // [NUEVO B] Mostrar datos básicos por código de paciente (usado en cotizaciones)
  public static function mdlMostrarDatosPaciente($tabla, $codPaciente)
  {
    $statement = Conexion::conn()->prepare("SELECT tba_paciente.IdPaciente, tba_paciente.NombrePaciente, tba_paciente.ApellidoPaciente, tba_paciente.TipoIdentificacion, tba_paciente.NumeroIdentificacion, tba_paciente.CelularPaciente FROM $tabla WHERE tba_paciente.IdPaciente = $codPaciente");
    $statement->execute();
    return $statement->fetch();
  }

  // Mostrar los datos del paciente para la historia clínica (campos clínicos extendidos)
  public static function mdlMostrarDatosHistoria($tabla, $codPaciente)
  {
    $statement = Conexion::conn()->prepare("SELECT tba_paciente.IdPaciente, tba_paciente.NombrePaciente, tba_paciente.ApellidoPaciente, tba_paciente.TipoIdentificacion, tba_paciente.NumeroIdentificacion, tba_paciente.SexoPaciente, tba_paciente.EdadPaciente, tba_paciente.FechaNacimiento, tba_paciente.CelularPaciente, tba_paciente.DomicilioPaciente, tba_paciente.LugarProcedencia, tba_paciente.LugarNacimiento, tba_paciente.GradoInstruccion, tba_paciente.RazaPaciente, tba_paciente.OcupacionPaciente, tba_paciente.ReligionPaciente, tba_paciente.EstadoCivil, tba_paciente.NumeroContactoPaciente, tba_paciente.NombreContactoPaciente FROM $tabla WHERE tba_paciente.IdPaciente = $codPaciente");
    $statement->execute();
    return $statement->fetch();
  }

  // Mostrar datos del paciente en el plan de tratamiento
  public static function mdlMostrarDatosTratamiento($tabla, $codPaciente)
  {
    $statement = Conexion::conn()->prepare("SELECT tba_paciente.IdPaciente, tba_paciente.NombrePaciente, tba_paciente.ApellidoPaciente, tba_paciente.TipoIdentificacion, tba_paciente.NumeroIdentificacion, tba_paciente.EdadPaciente, tba_paciente.CelularPaciente, tba_paciente.NumeroContactoPaciente, tba_paciente.NombreContactoPaciente FROM $tabla WHERE tba_paciente.IdPaciente = $codPaciente");
    $statement->execute();
    return $statement->fetch();
  }

  // Mostrar los datos básicos del paciente (visualizar pagos)
  public static function mdlMostrarDatosBasicos($tabla, $codPaciente)
  {
    $statement = Conexion::conn()->prepare("SELECT tba_paciente.IdPaciente, tba_paciente.NombrePaciente, tba_paciente.ApellidoPaciente, tba_paciente.NumeroIdentificacion, tba_paciente.CelularPaciente FROM $tabla WHERE tba_paciente.IdPaciente = $codPaciente");
    $statement->execute();
    return $statement->fetch();
  }

  // Obtener datos de la historia clínica para imprimir en PDF
  // Versión B: más completa — incluye JOIN con tba_detallehistoriaclinica
  public static function mdlObtenerDatosHistoriaPdf($tabla, $codHistoria)
  {
    $statement = Conexion::conn()->prepare("SELECT
    tba_paciente.NombrePaciente,
    tba_paciente.ApellidoPaciente,
    tba_paciente.TipoIdentificacion,
    tba_paciente.NumeroIdentificacion,
    tba_paciente.SexoPaciente,
    tba_paciente.EdadPaciente,
    tba_paciente.FechaNacimiento,
    tba_paciente.CelularPaciente,
    tba_paciente.DomicilioPaciente,
    tba_paciente.LugarProcedencia,
    tba_paciente.LugarNacimiento,
    tba_paciente.GradoInstruccion,
    tba_paciente.RazaPaciente,
    tba_paciente.OcupacionPaciente,
    tba_paciente.ReligionPaciente,
    tba_paciente.EstadoCivil,
    tba_paciente.NumeroContactoPaciente,
    tba_paciente.NombreContactoPaciente,
    tba_historiaclinica.AlergiasEncontradas,
    tba_historiaclinica.MotivoConsulta,
    tba_historiaclinica.DatosInformante,
    tba_historiaclinica.TiempoEnfermedad,
    tba_historiaclinica.SignosSintomas,
    tba_historiaclinica.RelatoCronologico,
    tba_historiaclinica.FuncionesBiologicas,
    tba_historiaclinica.AntecedentesFamiliares,
    tba_historiaclinica.AntecedentesPersonales,
    tba_detallehistoriaclinica.PresionArterial,
    tba_detallehistoriaclinica.Pulso,
    tba_detallehistoriaclinica.Temperatura,
    tba_detallehistoriaclinica.FrecuenciaCardiaca,
    tba_detallehistoriaclinica.FrecuenciaRespiratoria,
    tba_detallehistoriaclinica.ExamenOdonto,
    tba_detallehistoriaclinica.DiagnosticoPresuntivo,
    tba_detallehistoriaclinica.DiagnosticoDefinitivo,
    tba_detallehistoriaclinica.Pronostico,
    tba_detallehistoriaclinica.TratamientoPaciente,
    tba_detallehistoriaclinica.InformacionAlta,
    tba_historiaclinica.RutaOdontograma
  FROM
    $tabla
    INNER JOIN tba_historiaclinica
      ON tba_paciente.IdPaciente = tba_historiaclinica.IdPaciente
    INNER JOIN tba_detallehistoriaclinica
      ON tba_historiaclinica.IdHistoriaClinica = tba_detallehistoriaclinica.IdHistoriaClinica
  WHERE
    tba_historiaclinica.IdHistoriaClinica = $codHistoria");
    $statement->execute();
    return $statement->fetch();
  }

  // Mostrar datos básicos del paciente para imprimir (incluye TipoIdentificacion y FechaNacimiento)
  public static function mdlMostrarDatosImprimir($tabla, $codPaciente)
  {
    $statement = Conexion::conn()->prepare("SELECT tba_paciente.NombrePaciente, tba_paciente.ApellidoPaciente, tba_paciente.TipoIdentificacion, tba_paciente.NumeroIdentificacion, tba_paciente.EdadPaciente, tba_paciente.SexoPaciente, tba_paciente.FechaNacimiento, tba_paciente.CelularPaciente FROM $tabla WHERE tba_paciente.IdPaciente = $codPaciente");
    $statement->execute();
    return $statement->fetch();
  }

  // Obtener identificación del paciente por código de historia clínica
  public static function mdlObtenerDNIPaciente($tabla, $codHistoria)
  {
    $statement = Conexion::conn()->prepare("SELECT tba_paciente.NumeroIdentificacion, tba_paciente.IdPaciente FROM $tabla INNER JOIN tba_historiaclinica ON tba_paciente.IdPaciente = tba_historiaclinica.IdPaciente WHERE tba_historiaclinica.IdHistoriaClinica = $codHistoria");
    $statement->execute();
    return $statement->fetch();
  }

  // Contar el total de pacientes (dashboard)
  public static function mdlContarPacientes($tabla)
  {
    $statement = Conexion::conn()->prepare("SELECT COUNT(IdPaciente) AS TotalPacientes FROM $tabla");
    $statement->execute();
    return $statement->fetch();
  }

  // ── CREAR ────────────────────────────────────────────────────────────────

  // Crear un nuevo paciente
  public static function mdlCrearPaciente($tabla, $datosCreate)
  {
    $statement = Conexion::conn()->prepare("INSERT INTO $tabla (NombrePaciente, ApellidoPaciente, TipoIdentificacion, NumeroIdentificacion, CelularPaciente, UsuarioCreado, UsuarioActualiza, FechaCreacion, FechaActualizacion) VALUES(:NombrePaciente, :ApellidoPaciente, :TipoIdentificacion, :NumeroIdentificacion, :CelularPaciente, :UsuarioCreado, :UsuarioActualiza, :FechaCreacion, :FechaActualizacion)");
    $statement->bindParam(":NombrePaciente",       $datosCreate["NombrePaciente"],       PDO::PARAM_STR);
    $statement->bindParam(":ApellidoPaciente",     $datosCreate["ApellidoPaciente"],     PDO::PARAM_STR);
    $statement->bindParam(":TipoIdentificacion",   $datosCreate["TipoIdentificacion"],   PDO::PARAM_STR);
    $statement->bindParam(":NumeroIdentificacion", $datosCreate["NumeroIdentificacion"], PDO::PARAM_STR);
    $statement->bindParam(":CelularPaciente",      $datosCreate["CelularPaciente"],      PDO::PARAM_STR);
    $statement->bindParam(":UsuarioCreado",        $datosCreate["UsuarioCreado"],        PDO::PARAM_STR);
    $statement->bindParam(":UsuarioActualiza",     $datosCreate["UsuarioActualiza"],     PDO::PARAM_STR);
    $statement->bindParam(":FechaCreacion",        $datosCreate["FechaCreacion"],        PDO::PARAM_STR);
    $statement->bindParam(":FechaActualizacion",   $datosCreate["FechaActualizacion"],   PDO::PARAM_STR);

    if ($statement->execute()) {
      return "ok";
    } else {
      return "error";
    }
  }

  // ── EDITAR ───────────────────────────────────────────────────────────────

  // Actualizar datos básicos del paciente (módulo pacientes)
  public static function mdlUpdatePaciente($tabla, $datosUpdate)
  {
    $statement = Conexion::conn()->prepare("UPDATE $tabla SET NombrePaciente=:NombrePaciente, ApellidoPaciente=:ApellidoPaciente, NumeroIdentificacion=:NumeroIdentificacion, CelularPaciente=:CelularPaciente, FechaActualizacion=:FechaActualizacion WHERE IdPaciente=:IdPaciente");
    $statement->bindParam(":NombrePaciente",       $datosUpdate["NombrePaciente"],       PDO::PARAM_STR);
    $statement->bindParam(":ApellidoPaciente",     $datosUpdate["ApellidoPaciente"],     PDO::PARAM_STR);
    $statement->bindParam(":NumeroIdentificacion", $datosUpdate["NumeroIdentificacion"], PDO::PARAM_STR);
    $statement->bindParam(":CelularPaciente",      $datosUpdate["CelularPaciente"],      PDO::PARAM_STR);
    $statement->bindParam(":FechaActualizacion",   $datosUpdate["FechaActualizacion"],   PDO::PARAM_STR);
    $statement->bindParam(":IdPaciente",           $datosUpdate["IdPaciente"],           PDO::PARAM_STR);
    if ($statement->execute()) {
      return "ok";
    } else {
      return "error";
    }
  }

  // Actualizar campos clínicos del paciente al crear/guardar historia clínica
  // Versión B: actualiza campos extendidos (FechaNacimiento, LugarNacimiento, contactos, etc.)
  public static function mdlUpdateDatospaciente($tabla, $datosUpdatePaciente)
  {
    $statement = Conexion::conn()->prepare("UPDATE $tabla SET NumeroIdentificacion=:NumeroIdentificacion, SexoPaciente=:SexoPaciente, EdadPaciente=:EdadPaciente, FechaNacimiento=:FechaNacimiento, CelularPaciente=:CelularPaciente, DomicilioPaciente=:DomicilioPaciente, LugarProcedencia=:LugarProcedencia, LugarNacimiento=:LugarNacimiento, GradoInstruccion=:GradoInstruccion, RazaPaciente=:RazaPaciente, OcupacionPaciente=:OcupacionPaciente, ReligionPaciente=:ReligionPaciente, EstadoCivil=:EstadoCivil, NumeroContactoPaciente=:NumeroContactoPaciente, NombreContactoPaciente=:NombreContactoPaciente, UsuarioActualiza=:UsuarioActualiza, FechaActualizacion=:FechaActualizacion WHERE IdPaciente=:IdPaciente");
    $statement->bindParam(":NumeroIdentificacion",  $datosUpdatePaciente["NumeroIdentificacion"],  PDO::PARAM_STR);
    $statement->bindParam(":SexoPaciente",          $datosUpdatePaciente["SexoPaciente"],          PDO::PARAM_STR);
    $statement->bindParam(":EdadPaciente",          $datosUpdatePaciente["EdadPaciente"],          PDO::PARAM_STR);
    $statement->bindParam(":FechaNacimiento",       $datosUpdatePaciente["FechaNacimiento"],       PDO::PARAM_STR);
    $statement->bindParam(":CelularPaciente",       $datosUpdatePaciente["CelularPaciente"],       PDO::PARAM_STR);
    $statement->bindParam(":DomicilioPaciente",     $datosUpdatePaciente["DomicilioPaciente"],     PDO::PARAM_STR);
    $statement->bindParam(":LugarProcedencia",      $datosUpdatePaciente["LugarProcedencia"],      PDO::PARAM_STR);
    $statement->bindParam(":LugarNacimiento",       $datosUpdatePaciente["LugarNacimiento"],       PDO::PARAM_STR);
    $statement->bindParam(":GradoInstruccion",      $datosUpdatePaciente["GradoInstruccion"],      PDO::PARAM_STR);
    $statement->bindParam(":RazaPaciente",          $datosUpdatePaciente["RazaPaciente"],          PDO::PARAM_STR);
    $statement->bindParam(":OcupacionPaciente",     $datosUpdatePaciente["OcupacionPaciente"],     PDO::PARAM_STR);
    $statement->bindParam(":ReligionPaciente",      $datosUpdatePaciente["ReligionPaciente"],      PDO::PARAM_STR);
    $statement->bindParam(":EstadoCivil",           $datosUpdatePaciente["EstadoCivil"],           PDO::PARAM_STR);
    $statement->bindParam(":NumeroContactoPaciente",$datosUpdatePaciente["NumeroContactoPaciente"],PDO::PARAM_STR);
    $statement->bindParam(":NombreContactoPaciente",$datosUpdatePaciente["NombreContactoPaciente"],PDO::PARAM_STR);
    $statement->bindParam(":UsuarioActualiza",      $datosUpdatePaciente["UsuarioActualiza"],      PDO::PARAM_STR);
    $statement->bindParam(":FechaActualizacion",    $datosUpdatePaciente["FechaActualizacion"],    PDO::PARAM_STR);
    $statement->bindParam(":IdPaciente",            $datosUpdatePaciente["IdPaciente"],            PDO::PARAM_STR);
    if ($statement->execute()) {
      return "ok";
    } else {
      return "error";
    }
  }

  // [NUEVO B] Actualizar campos extendidos del paciente al editar historia clínica
  public static function mdlUpdateDatosPacienteEditar($tabla, $datosUpdatePaciente)
  {
    $statement = Conexion::conn()->prepare("UPDATE $tabla SET SexoPaciente=:SexoPaciente, EdadPaciente=:EdadPaciente, FechaNacimiento=:FechaNacimiento, CelularPaciente=:CelularPaciente, DomicilioPaciente=:DomicilioPaciente, LugarProcedencia=:LugarProcedencia, LugarNacimiento=:LugarNacimiento, GradoInstruccion=:GradoInstruccion, RazaPaciente=:RazaPaciente, OcupacionPaciente=:OcupacionPaciente, ReligionPaciente=:ReligionPaciente, EstadoCivil=:EstadoCivil, NumeroContactoPaciente=:NumeroContactoPaciente, NombreContactoPaciente=:NombreContactoPaciente, UsuarioActualiza=:UsuarioActualiza, FechaActualizacion=:FechaActualizacion WHERE IdPaciente=:IdPaciente");
    $statement->bindParam(":SexoPaciente",          $datosUpdatePaciente["SexoPaciente"],          PDO::PARAM_STR);
    $statement->bindParam(":EdadPaciente",          $datosUpdatePaciente["EdadPaciente"],          PDO::PARAM_STR);
    $statement->bindParam(":FechaNacimiento",       $datosUpdatePaciente["FechaNacimiento"],       PDO::PARAM_STR);
    $statement->bindParam(":CelularPaciente",       $datosUpdatePaciente["CelularPaciente"],       PDO::PARAM_STR);
    $statement->bindParam(":DomicilioPaciente",     $datosUpdatePaciente["DomicilioPaciente"],     PDO::PARAM_STR);
    $statement->bindParam(":LugarProcedencia",      $datosUpdatePaciente["LugarProcedencia"],      PDO::PARAM_STR);
    $statement->bindParam(":LugarNacimiento",       $datosUpdatePaciente["LugarNacimiento"],       PDO::PARAM_STR);
    $statement->bindParam(":GradoInstruccion",      $datosUpdatePaciente["GradoInstruccion"],      PDO::PARAM_STR);
    $statement->bindParam(":RazaPaciente",          $datosUpdatePaciente["RazaPaciente"],          PDO::PARAM_STR);
    $statement->bindParam(":OcupacionPaciente",     $datosUpdatePaciente["OcupacionPaciente"],     PDO::PARAM_STR);
    $statement->bindParam(":ReligionPaciente",      $datosUpdatePaciente["ReligionPaciente"],      PDO::PARAM_STR);
    $statement->bindParam(":EstadoCivil",           $datosUpdatePaciente["EstadoCivil"],           PDO::PARAM_STR);
    $statement->bindParam(":NumeroContactoPaciente",$datosUpdatePaciente["NumeroContactoPaciente"],PDO::PARAM_STR);
    $statement->bindParam(":NombreContactoPaciente",$datosUpdatePaciente["NombreContactoPaciente"],PDO::PARAM_STR);
    $statement->bindParam(":UsuarioActualiza",      $datosUpdatePaciente["UsuarioActualiza"],      PDO::PARAM_STR);
    $statement->bindParam(":FechaActualizacion",    $datosUpdatePaciente["FechaActualizacion"],    PDO::PARAM_STR);
    $statement->bindParam(":IdPaciente",            $datosUpdatePaciente["IdPaciente"],            PDO::PARAM_STR);
    if ($statement->execute()) {
      return "ok";
    } else {
      return "error";
    }
  }

  // ── ELIMINAR ─────────────────────────────────────────────────────────────

  // Eliminar un paciente
  public static function mdlEliminarPaciente($tabla, $codPaciente)
  {
    $statement = Conexion::conn()->prepare("DELETE FROM $tabla WHERE IdPaciente = $codPaciente");
    if ($statement->execute()) {
      return "ok";
    } else {
      return "error";
    }
  }

  // ── BÚSQUEDA / VERIFICACIÓN ───────────────────────────────────────────────

  // Buscar al paciente por número de identificación (NumeroIdentificacion)
  public static function mdlBuscarPacienteDNI($tabla, $numeroDNI)
  {
    $statement = Conexion::conn()->prepare("SELECT tba_paciente.IdPaciente, tba_paciente.NombrePaciente, tba_paciente.ApellidoPaciente, tba_paciente.NumeroIdentificacion, tba_paciente.CelularPaciente FROM $tabla WHERE tba_paciente.NumeroIdentificacion = $numeroDNI");
    $statement->execute();
    return $statement->fetch();
  }

  // Verificar si un paciente está registrado según su número de identificación
  public static function mdlVerificarPacienteDNI($tabla, $numeroDNI)
  {
    $statement = Conexion::conn()->prepare("SELECT COUNT(*) AS Contador FROM $tabla WHERE tba_paciente.NumeroIdentificacion = $numeroDNI");
    $statement->execute();
    return $statement->fetch();
  }

  // ── GRÁFICOS / REPORTES ──────────────────────────────────────────────────

  // Obtener pacientes registrados por mes en el año actual o especificado
  public static function mdlObtenerPacientesPorMes($tabla, $año = null)
  {
    if ($año === null) {
      $año = date('Y');
    }

    $query = "SELECT 
              YEAR(FechaRegistro) as año,
              MONTH(FechaRegistro) as mes,
              DATE_FORMAT(FechaRegistro, '%Y-%m') as fecha_mes,
              DATE_FORMAT(FechaRegistro, '%M %Y') as mes_nombre,
              COUNT(*) as total_pacientes,
              SUM(CASE WHEN FechaRegistro >= DATE_SUB(NOW(), INTERVAL 30 DAY) THEN 1 ELSE 0 END) as nuevos_ultimos_30d
              FROM $tabla
              WHERE YEAR(FechaRegistro) = :año
              GROUP BY YEAR(FechaRegistro), MONTH(FechaRegistro)
              ORDER BY mes ASC";

    $statement = Conexion::conn()->prepare($query);
    $statement->bindParam(":año", $año, PDO::PARAM_INT);
    $statement->execute();
    return $statement->fetchAll();
  }

  // Obtener años disponibles en los registros de pacientes
  public static function mdlObtenerAñosPacientes($tabla)
  {
    $statement = Conexion::conn()->prepare("SELECT DISTINCT YEAR(FechaRegistro) as año FROM $tabla ORDER BY año DESC");
    $statement->execute();
    return $statement->fetchAll();
  }

  // Obtener total acumulado de pacientes por mes
  public static function mdlObtenerPacientesAcumuladosPorMes($tabla, $año = null)
  {
    if ($año === null) {
      $año = date('Y');
    }

    $query = "SELECT 
              MONTH(FechaRegistro) as mes,
              DATE_FORMAT(FechaRegistro, '%M') as mes_nombre,
              COUNT(*) as total_mes,
              (SELECT COUNT(*) FROM $tabla t2 WHERE YEAR(t2.FechaRegistro) <= :año AND MONTH(t2.FechaRegistro) <= MONTH(FechaRegistro) AND YEAR(t2.FechaRegistro) = :año2) as total_acumulado
              FROM $tabla
              WHERE YEAR(FechaRegistro) = :año3
              GROUP BY MONTH(FechaRegistro)
              ORDER BY mes ASC";

    $statement = Conexion::conn()->prepare($query);
    $statement->bindParam(":año", $año, PDO::PARAM_INT);
    $statement->bindParam(":año2", $año, PDO::PARAM_INT);
    $statement->bindParam(":año3", $año, PDO::PARAM_INT);
    $statement->execute();
    return $statement->fetchAll();
  }
}
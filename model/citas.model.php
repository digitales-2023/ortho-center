<?php
require_once "conexion.php";

/**
 * ModelCitas — Módulo nuevo incorporado de dentavitalis (B)
 *
 * ortho-center no tenía módulo de citas. Se incorpora íntegro de B.
 * Bug corregido: el método de listar tenía nombre ctrMostrarTodasCitas
 * (prefijo de controller) — renombrado correctamente a mdlMostrarTodasCitas.
 *
 * Tabla: tba_cita
 * Campos: IdCita, IdPaciente, FechaProgramada, MedicoAsignado (FK tba_socio),
 *         EstadoCita, FechaCreacion, FechaActualizacion
 */
class ModelCitas
{
  // ── LISTAR ──────────────────────────────────────────────────────────────

  // Mostrar todas las citas con paciente, médico y celular
  // Bug corregido: nombre era ctrMostrarTodasCitas → mdlMostrarTodasCitas
  public static function mdlMostrarTodasCitas($tabla)
  {
    $statement = Conexion::conn()->prepare("SELECT tba_cita.IdCita, tba_cita.IdPaciente, tba_cita.FechaProgramada, tba_cita.MedicoAsignado, tba_cita.EstadoCita, tba_cita.FechaCreacion, tba_paciente.NombrePaciente, tba_paciente.ApellidoPaciente, tba_paciente.NumeroIdentificacion, tba_paciente.CelularPaciente, tba_socio.NombreSocio FROM $tabla INNER JOIN tba_paciente ON tba_cita.IdPaciente = tba_paciente.IdPaciente INNER JOIN tba_socio ON tba_cita.MedicoAsignado = tba_socio.IdSocio ORDER BY IdCita DESC");
    $statement->execute();
    return $statement->fetchAll();
  }

  // Mostrar los datos de una cita para editar (con JOIN a paciente y médico)
  public static function mdlMostrarDatosEditar($tabla, $codCita)
  {
    $statement = Conexion::conn()->prepare("SELECT tba_cita.IdCita, tba_cita.IdPaciente, tba_cita.FechaProgramada, tba_cita.MedicoAsignado, tba_cita.FechaCreacion, tba_paciente.NombrePaciente, tba_paciente.ApellidoPaciente, tba_paciente.NumeroIdentificacion, tba_paciente.CelularPaciente, tba_socio.NombreSocio FROM $tabla INNER JOIN tba_paciente ON tba_cita.IdPaciente = tba_paciente.IdPaciente INNER JOIN tba_socio ON tba_cita.MedicoAsignado = tba_socio.IdSocio WHERE tba_cita.IdCita = $codCita");
    $statement->execute();
    return $statement->fetch();
  }

  // Contar citas para una fecha específica (usado en dashboard)
  public static function mdlContarCitasHoy($tabla, $fechaHoy)
  {
    $statement = Conexion::conn()->prepare("SELECT COUNT(IdCita) AS TotalCitas FROM $tabla WHERE DATE_FORMAT(FechaProgramada, '%Y-%m-%d') = '$fechaHoy'");
    $statement->execute();
    return $statement->fetch();
  }

  // Verificar si un paciente tiene citas programadas
  public static function mdlVerificarUsoPaciente($tabla, $codPaciente)
  {
    $statement = Conexion::conn()->prepare("SELECT COUNT(IdCita) AS TotalUso FROM $tabla WHERE IdPaciente = $codPaciente");
    $statement->execute();
    return $statement->fetch();
  }

  // ── CREAR ────────────────────────────────────────────────────────────────

  // Insertar una nueva cita
  public static function mdlCrearNuevaCita($tabla, $datosCreate)
  {
    $statement = Conexion::conn()->prepare("INSERT INTO $tabla (IdPaciente, FechaProgramada, MedicoAsignado, EstadoCita, FechaCreacion, FechaActualizacion) VALUES(:IdPaciente, :FechaProgramada, :MedicoAsignado, :EstadoCita, :FechaCreacion, :FechaActualizacion)");
    $statement->bindParam(":IdPaciente",         $datosCreate["IdPaciente"],         PDO::PARAM_STR);
    $statement->bindParam(":FechaProgramada",    $datosCreate["FechaProgramada"],    PDO::PARAM_STR);
    $statement->bindParam(":MedicoAsignado",     $datosCreate["MedicoAsignado"],     PDO::PARAM_STR);
    $statement->bindParam(":EstadoCita",         $datosCreate["EstadoCita"],         PDO::PARAM_STR);
    $statement->bindParam(":FechaCreacion",      $datosCreate["FechaCreacion"],      PDO::PARAM_STR);
    $statement->bindParam(":FechaActualizacion", $datosCreate["FechaActualizacion"], PDO::PARAM_STR);
    return $statement->execute() ? "ok" : "error";
  }

  // ── EDITAR ───────────────────────────────────────────────────────────────

  // Actualizar los datos de una cita
  public static function mdlEditarCita($tabla, $datosUpdate)
  {
    $statement = Conexion::conn()->prepare("UPDATE $tabla SET IdPaciente=:IdPaciente, FechaProgramada=:FechaProgramada, MedicoAsignado=:MedicoAsignado, FechaActualizacion=:FechaActualizacion WHERE IdCita=:IdCita");
    $statement->bindParam(":IdPaciente",         $datosUpdate["IdPaciente"],         PDO::PARAM_STR);
    $statement->bindParam(":FechaProgramada",    $datosUpdate["FechaProgramada"],    PDO::PARAM_STR);
    $statement->bindParam(":MedicoAsignado",     $datosUpdate["MedicoAsignado"],     PDO::PARAM_STR);
    $statement->bindParam(":FechaActualizacion", $datosUpdate["FechaActualizacion"], PDO::PARAM_STR);
    $statement->bindParam(":IdCita",             $datosUpdate["IdCita"],             PDO::PARAM_STR);
    return $statement->execute() ? "ok" : "error";
  }

  // ── ELIMINAR ─────────────────────────────────────────────────────────────

  // Eliminar una cita por su ID
  public static function mdlEliminarCita($tabla, $codCita)
  {
    $statement = Conexion::conn()->prepare("DELETE FROM $tabla WHERE IdCita = $codCita");
    return $statement->execute() ? "ok" : "error";
  }
}

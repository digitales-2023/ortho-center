<?php
require_once "conexion.php";

/**
 * ModelTratamiento — Fusionado ortho-center (A) + dentavitalis (B)
 *
 * Cambios respecto a ortho-center original:
 *  - [NUEVO B] mdlObtenerUltimoTratamiento: obtiene MAX(IdTratamiento)
 *  - [NUEVO B] mdlCrearDetalleTratamiento: INSERT en tba_detalletratamiento (sin fecha, para crear historia)
 *  - [NUEVO B] mdlMostrarDetalleTratamiento: SELECT simplificado sin estado
 *  - [NUEVO B] mdlObtenerCodTratamiento: alias de mdlObtenerIdTratamiento
 *  - [NUEVO B] mdlObtenerListaProcedimientos: lista detallada por paciente para pagos
 *  - [NUEVO B] mdlMostrarAtencionesMedicos: todas las atenciones con JOIN a tba_socio
 *  - mdlCrearEditadoDetalleTratamiento: agrega MedicoProcedimiento (campo de B)
 *  - mdlMostrarDetalleTratamientoCompleto: agrega JOIN tba_socio y campo NombreSocio
 *  - mdlMostrarDetalleTratamientoEstado: agrega JOIN tba_socio y campo NombreSocio
 *  - mdlUpdatePrecioTratamiento: nombre correcto unificado (B tenía typo: mdlUpadatePrecioTratamiento)
 */
class ModelTratamiento
{
  // ── CREAR ────────────────────────────────────────────────────────────────

  // Crear un nuevo tratamiento (cabecera)
  public static function mdlCrearTratamiento($tabla, $datosCreateTratamiento)
  {
    $statement = Conexion::conn()->prepare("INSERT INTO $tabla (IdHistoriaClinica, IdPaciente, UsuarioCreado, UsuarioActualiza, FechaCreacion, FechaActualizacion) VALUES(:IdHistoriaClinica, :IdPaciente, :UsuarioCreado, :UsuarioActualiza, :FechaCreacion, :FechaActualizacion)");
    $statement->bindParam(":IdHistoriaClinica",  $datosCreateTratamiento["IdHistoriaClinica"],  PDO::PARAM_STR);
    $statement->bindParam(":IdPaciente",         $datosCreateTratamiento["IdPaciente"],         PDO::PARAM_STR);
    $statement->bindParam(":UsuarioCreado",      $datosCreateTratamiento["UsuarioCreado"],      PDO::PARAM_STR);
    $statement->bindParam(":UsuarioActualiza",   $datosCreateTratamiento["UsuarioActualiza"],   PDO::PARAM_STR);
    $statement->bindParam(":FechaCreacion",      $datosCreateTratamiento["FechaCreacion"],      PDO::PARAM_STR);
    $statement->bindParam(":FechaActualizacion", $datosCreateTratamiento["FechaActualizacion"], PDO::PARAM_STR);
    return $statement->execute() ? "ok" : "error";
  }

  // [NUEVO B] Crear un procedimiento en el detalle de tratamiento (INSERT básico desde historia)
  public static function mdlCrearDetalleTratamiento($tabla, $datosDetalleTratamiento)
  {
    $statement = Conexion::conn()->prepare("INSERT INTO $tabla (IdTratamiento, IdProcedimiento, EstadoTratamiento, ObservacionProcedimiento, PrecioProcedimiento) VALUES(:IdTratamiento, :IdProcedimiento, :EstadoTratamiento, :ObservacionProcedimiento, :PrecioProcedimiento)");
    $statement->bindParam(":IdTratamiento",            $datosDetalleTratamiento["IdTratamiento"],            PDO::PARAM_STR);
    $statement->bindParam(":IdProcedimiento",          $datosDetalleTratamiento["IdProcedimiento"],          PDO::PARAM_STR);
    $statement->bindParam(":EstadoTratamiento",        $datosDetalleTratamiento["EstadoTratamiento"],        PDO::PARAM_STR);
    $statement->bindParam(":ObservacionProcedimiento", $datosDetalleTratamiento["ObservacionProcedimiento"], PDO::PARAM_STR);
    $statement->bindParam(":PrecioProcedimiento",      $datosDetalleTratamiento["PrecioProcedimiento"],      PDO::PARAM_STR);
    return $statement->execute() ? "ok" : "error";
  }

  // Recrear el detalle del tratamiento al editar el plan (incluye MedicoProcedimiento de B)
  public static function mdlCrearEditadoDetalleTratamiento($tabla, $datosCreateTratamiento)
  {
    $statement = Conexion::conn()->prepare("INSERT INTO $tabla (IdTratamiento, IdProcedimiento, ObservacionProcedimiento, MedicoProcedimiento, EstadoTratamiento, FechaProcedimiento, PrecioProcedimiento) VALUES(:IdTratamiento, :IdProcedimiento, :ObservacionProcedimiento, :MedicoProcedimiento, :EstadoTratamiento, :FechaProcedimiento, :PrecioProcedimiento)");
    $statement->bindParam(":IdTratamiento",            $datosCreateTratamiento["IdTratamiento"],            PDO::PARAM_STR);
    $statement->bindParam(":IdProcedimiento",          $datosCreateTratamiento["IdProcedimiento"],          PDO::PARAM_STR);
    $statement->bindParam(":ObservacionProcedimiento", $datosCreateTratamiento["ObservacionProcedimiento"], PDO::PARAM_STR);
    $statement->bindParam(":MedicoProcedimiento",      $datosCreateTratamiento["MedicoProcedimiento"],      PDO::PARAM_STR);
    $statement->bindParam(":EstadoTratamiento",        $datosCreateTratamiento["EstadoTratamiento"],        PDO::PARAM_STR);
    $statement->bindParam(":FechaProcedimiento",       $datosCreateTratamiento["FechaProcedimiento"],       PDO::PARAM_STR);
    $statement->bindParam(":PrecioProcedimiento",      $datosCreateTratamiento["PrecioProcedimiento"],      PDO::PARAM_STR);
    return $statement->execute() ? "ok" : "error";
  }

  // ── OBTENER / LISTAR ─────────────────────────────────────────────────────

  // [NUEVO B] Obtener el último tratamiento creado
  public static function mdlObtenerUltimoTratamiento($tabla)
  {
    $statement = Conexion::conn()->prepare("SELECT MAX(IdTratamiento) as Id FROM $tabla");
    $statement->execute();
    return $statement->fetch();
  }

  // Obtener IdTratamiento de un paciente
  public static function mdlObtenerIdTratamiento($tabla, $codPaciente)
  {
    $statement = Conexion::conn()->prepare("SELECT tba_tratamiento.IdTratamiento FROM $tabla WHERE tba_tratamiento.IdPaciente = $codPaciente");
    $statement->execute();
    return $statement->fetch();
  }

  // [NUEVO B] Alias de mdlObtenerIdTratamiento (nombre usado en controller B)
  public static function mdlObtenerCodTratamiento($tabla, $codPaciente)
  {
    return self::mdlObtenerIdTratamiento($tabla, $codPaciente);
  }

  // [NUEVO B] Mostrar el total del tratamiento por código de tratamiento
  public static function mdlMostrarTotalTratamiento($tabla, $codTratamiento)
  {
    $statement = Conexion::conn()->prepare("SELECT tba_tratamiento.TotalTratamiento FROM $tabla WHERE tba_tratamiento.IdTratamiento = $codTratamiento");
    $statement->execute();
    return $statement->fetch();
  }

  // [NUEVO B] Listar procedimientos simplificado de una historia (sin estado ni médico)
  public static function mdlMostrarDetalleTratamiento($tabla, $codHistoria)
  {
    $statement = Conexion::conn()->prepare("SELECT
    tba_procedimiento.NombreProcedimiento,
    tba_detalletratamiento.PrecioProcedimiento,
    tba_detalletratamiento.ObservacionProcedimiento,
    tba_procedimiento.IdProcedimiento
  FROM $tabla
    INNER JOIN tba_tratamiento ON tba_detalletratamiento.IdTratamiento = tba_tratamiento.IdTratamiento
    INNER JOIN tba_historiaclinica ON tba_tratamiento.IdHistoriaClinica = tba_historiaclinica.IdHistoriaClinica
    INNER JOIN tba_procedimiento ON tba_detalletratamiento.IdProcedimiento = tba_procedimiento.IdProcedimiento
  WHERE tba_historiaclinica.IdHistoriaClinica = $codHistoria");
    $statement->execute();
    return $statement->fetchAll();
  }

  // Mostrar el detalle completo del tratamiento (con estado y nombre del médico)
  public static function mdlMostrarDetalleTratamientoCompleto($tabla, $codHistoria)
  {
    $statement = Conexion::conn()->prepare("SELECT
    tba_procedimiento.NombreProcedimiento,
    tba_detalletratamiento.PrecioProcedimiento,
    tba_detalletratamiento.ObservacionProcedimiento,
    tba_detalletratamiento.MedicoProcedimiento,
    tba_detalletratamiento.EstadoTratamiento,
    tba_detalletratamiento.FechaProcedimiento,
    tba_procedimiento.IdProcedimiento,
    tba_socio.NombreSocio
  FROM $tabla
    INNER JOIN tba_tratamiento ON tba_detalletratamiento.IdTratamiento = tba_tratamiento.IdTratamiento
    INNER JOIN tba_historiaclinica ON tba_tratamiento.IdHistoriaClinica = tba_historiaclinica.IdHistoriaClinica
    INNER JOIN tba_procedimiento ON tba_detalletratamiento.IdProcedimiento = tba_procedimiento.IdProcedimiento
    LEFT JOIN tba_socio ON tba_detalletratamiento.MedicoProcedimiento = tba_socio.IdSocio
  WHERE tba_historiaclinica.IdHistoriaClinica = $codHistoria");
    $statement->execute();
    return $statement->fetchAll();
  }

  // Mostrar procedimientos filtrados por estado (1=pendiente, 2=realizado) con nombre del médico
  public static function mdlMostrarDetalleTratamientoEstado($tabla, $codHistoria, $estado)
  {
    $statement = Conexion::conn()->prepare("SELECT
    tba_procedimiento.NombreProcedimiento,
    tba_detalletratamiento.PrecioProcedimiento,
    tba_detalletratamiento.ObservacionProcedimiento,
    tba_detalletratamiento.EstadoTratamiento,
    tba_detalletratamiento.FechaProcedimiento,
    tba_detalletratamiento.MedicoProcedimiento,
    tba_procedimiento.IdProcedimiento,
    tba_socio.NombreSocio
  FROM $tabla
    INNER JOIN tba_tratamiento ON tba_detalletratamiento.IdTratamiento = tba_tratamiento.IdTratamiento
    INNER JOIN tba_historiaclinica ON tba_tratamiento.IdHistoriaClinica = tba_historiaclinica.IdHistoriaClinica
    INNER JOIN tba_procedimiento ON tba_detalletratamiento.IdProcedimiento = tba_procedimiento.IdProcedimiento
    LEFT JOIN tba_socio ON tba_detalletratamiento.MedicoProcedimiento = tba_socio.IdSocio
  WHERE tba_historiaclinica.IdHistoriaClinica = $codHistoria AND tba_detalletratamiento.EstadoTratamiento = $estado");
    $statement->execute();
    return $statement->fetchAll();
  }

  // Obtener el monto pagado del tratamiento de un paciente
  public static function mdlObtenerTotalPagado($tabla, $codPaciente)
  {
    $statement = Conexion::conn()->prepare("SELECT tba_tratamiento.IdTratamiento, tba_tratamiento.TotalPagado FROM $tabla WHERE tba_tratamiento.IdPaciente = $codPaciente");
    $statement->execute();
    return $statement->fetch();
  }

  // Obtener totales del tratamiento (total, pagado, deuda)
  public static function mdlObtenerTotalesTratamiento($tabla, $codPaciente)
  {
    $statement = Conexion::conn()->prepare("SELECT tba_tratamiento.TotalTratamiento, tba_tratamiento.TotalPagado, (TotalTratamiento - TotalPagado) AS DeudaActual FROM $tabla WHERE tba_tratamiento.IdPaciente = $codPaciente");
    $statement->execute();
    return $statement->fetch();
  }

  // Obtener la suma de procedimientos realizados hasta ahora
  public static function mdlObtenerTotalRealizado($tabla, $codHistoria)
  {
    $statement = Conexion::conn()->prepare("SELECT SUM(PrecioProcedimiento) AS TotalRealizado FROM $tabla INNER JOIN tba_tratamiento ON tba_detalletratamiento.IdTratamiento = tba_tratamiento.IdTratamiento WHERE tba_tratamiento.IdHistoriaClinica = $codHistoria AND EstadoTratamiento = 2");
    $statement->execute();
    return $statement->fetch();
  }

  // Verificar si un procedimiento está en uso en algún tratamiento
  public static function mdlVerificarUsoProcedimiento($tabla, $codProcedimiento)
  {
    $statement = Conexion::conn()->prepare("SELECT COUNT(IdProcedimiento) AS TotalUso FROM $tabla WHERE IdProcedimiento = $codProcedimiento");
    $statement->execute();
    return $statement->fetch();
  }

  // Listar procedimientos de un paciente (para módulo de pagos)
  public static function mdlListarProcedimientosPaciente($tabla, $codPaciente)
  {
    $statement = Conexion::conn()->prepare("SELECT
    tba_procedimiento.NombreProcedimiento,
    tba_detalletratamiento.PrecioProcedimiento,
    tba_detalletratamiento.IdProcedimiento,
    tba_detalletratamiento.IdDetalleTratamiento
  FROM $tabla
    INNER JOIN tba_detalletratamiento ON tba_tratamiento.IdTratamiento = tba_detalletratamiento.IdTratamiento
    INNER JOIN tba_procedimiento ON tba_detalletratamiento.IdProcedimiento = tba_procedimiento.IdProcedimiento
  WHERE tba_tratamiento.IdPaciente = $codPaciente");
    $statement->execute();
    return $statement->fetchAll();
  }

  // Mostrar el costo de un procedimiento del detalle
  public static function mdlMostrarCostoDetalle($tabla, $codDetalleTratamiento)
  {
    $statement = Conexion::conn()->prepare("SELECT tba_detalletratamiento.PrecioProcedimiento FROM $tabla WHERE tba_detalletratamiento.IdDetalleTratamiento = $codDetalleTratamiento");
    $statement->execute();
    return $statement->fetch();
  }

  // [NUEVO B] Obtener lista de procedimientos de un tratamiento por paciente (para pagos)
  public static function mdlObtenerListaProcedimientos($tabla, $codPaciente)
  {
    $statement = Conexion::conn()->prepare("SELECT tba_detalletratamiento.IdDetalleTratamiento, tba_detalletratamiento.IdProcedimiento, tba_detalletratamiento.ObservacionProcedimiento, tba_detalletratamiento.EstadoTratamiento, tba_detalletratamiento.FechaProcedimiento, tba_detalletratamiento.PrecioProcedimiento, tba_detalletratamiento.IdTratamiento FROM $tabla INNER JOIN tba_tratamiento ON tba_detalletratamiento.IdTratamiento = tba_tratamiento.IdTratamiento WHERE tba_tratamiento.IdPaciente = $codPaciente ORDER BY IdDetalleTratamiento ASC");
    $statement->execute();
    return $statement->fetchAll();
  }

  // [NUEVO B] Mostrar todas las atenciones realizadas por médicos (reporte)
  public static function mdlMostrarAtencionesMedicos($tabla)
  {
    $statement = Conexion::conn()->prepare("SELECT
    tba_paciente.NombrePaciente,
    tba_paciente.ApellidoPaciente,
    tba_paciente.NumeroIdentificacion,
    tba_procedimiento.NombreProcedimiento,
    tba_detalletratamiento.FechaProcedimiento,
    tba_detalletratamiento.PrecioProcedimiento,
    tba_detalletratamiento.ObservacionProcedimiento,
    tba_socio.NombreSocio
  FROM $tabla
    INNER JOIN tba_tratamiento ON tba_detalletratamiento.IdTratamiento = tba_tratamiento.IdTratamiento
    INNER JOIN tba_paciente ON tba_tratamiento.IdPaciente = tba_paciente.IdPaciente
    INNER JOIN tba_procedimiento ON tba_detalletratamiento.IdProcedimiento = tba_procedimiento.IdProcedimiento
    INNER JOIN tba_socio ON tba_detalletratamiento.MedicoProcedimiento = tba_socio.IdSocio");
    $statement->execute();
    return $statement->fetchAll();
  }

  // ── ACTUALIZAR ───────────────────────────────────────────────────────────

  // Actualizar el total del tratamiento (nombre corregido — B tenía typo mdlUpadatePrecioTratamiento)
  public static function mdlUpdatePrecioTratamiento($tabla, $codTratamiento, $totalTratamiento)
  {
    $statement = Conexion::conn()->prepare("UPDATE $tabla SET TotalTratamiento=:TotalTratamiento WHERE IdTratamiento=:IdTratamiento");
    $statement->bindParam(":TotalTratamiento", $totalTratamiento, PDO::PARAM_STR);
    $statement->bindParam(":IdTratamiento",    $codTratamiento,   PDO::PARAM_STR);
    return $statement->execute() ? "ok" : "error";
  }

  // Actualizar el total pagado del tratamiento
  public static function mldActualizarTotal($tabla, $nuevoTotal, $codPaciente)
  {
    $statement = Conexion::conn()->prepare("UPDATE $tabla SET TotalPagado=:TotalPagado WHERE IdPaciente=:IdPaciente");
    $statement->bindParam(":TotalPagado", $nuevoTotal,   PDO::PARAM_STR);
    $statement->bindParam(":IdPaciente",  $codPaciente,  PDO::PARAM_STR);
    return $statement->execute() ? "ok" : "error";
  }

  // ── ELIMINAR ─────────────────────────────────────────────────────────────

  // Eliminar el detalle del tratamiento actual (por IdTratamiento)
  public static function mdlEliminarDetalleActual($tabla, $codTratamiento)
  {
    $statement = Conexion::conn()->prepare("DELETE FROM $tabla WHERE IdTratamiento = $codTratamiento");
    return $statement->execute() ? "ok" : "error";
  }

  // Eliminar tratamiento (cabecera o detalle, según la tabla pasada)
  public static function mdlEliminarTratamiento($tabla, $codTratamiento)
  {
    $statement = Conexion::conn()->prepare("DELETE FROM $tabla WHERE IdTratamiento = $codTratamiento");
    return $statement->execute() ? "ok" : "error";
  }
}

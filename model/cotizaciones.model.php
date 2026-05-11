<?php
require_once "conexion.php";

/**
 * ModelCotizaciones — Módulo nuevo incorporado de dentavitalis (B)
 *
 * Módulo para manejo de presupuestos de procedimientos.
 * Bug corregido en mdlUpdateCotizacion: FechaActualiza -> FechaActualizacion.
 */
class ModelCotizaciones
{
  // Ingresar cabecera de la cotización
  public static function mdlCrearCotizacion($tabla, $datosCreate)
  {
    $statement = Conexion::conn()->prepare("INSERT INTO $tabla (IdPaciente, TotalCotizacion, FechaCotizacion, EstadoCotizacion, UsuarioCreado, UsuarioActualiza, FechaCreacion, FechaActualizacion) VALUES(:IdPaciente, :TotalCotizacion, :FechaCotizacion, :EstadoCotizacion, :UsuarioCreado, :UsuarioActualiza, :FechaCreacion, :FechaActualizacion)");
    $statement->bindParam(":IdPaciente",         $datosCreate["IdPaciente"],         PDO::PARAM_STR);
    $statement->bindParam(":TotalCotizacion",    $datosCreate["TotalCotizacion"],    PDO::PARAM_STR);
    $statement->bindParam(":FechaCotizacion",    $datosCreate["FechaCotizacion"],    PDO::PARAM_STR);
    $statement->bindParam(":EstadoCotizacion",   $datosCreate["EstadoCotizacion"],   PDO::PARAM_STR);
    $statement->bindParam(":UsuarioCreado",      $datosCreate["UsuarioCreado"],      PDO::PARAM_STR);
    $statement->bindParam(":UsuarioActualiza",   $datosCreate["UsuarioActualiza"],   PDO::PARAM_STR);
    $statement->bindParam(":FechaCreacion",      $datosCreate["FechaCreacion"],      PDO::PARAM_STR);
    $statement->bindParam(":FechaActualizacion", $datosCreate["FechaActualizacion"], PDO::PARAM_STR);
    return $statement->execute() ? "ok" : "error";
  }

  // Ingresar detalle (procedimientos) de cotizacion
  public static function mdlCrearDetalleCotizacion($tabla, $datosCreate)
  {
    $statement = Conexion::conn()->prepare("INSERT INTO $tabla (IdCotizacion, IdProcedimiento, ObservacionProcedimiento, CantidadProcedimiento, PrecioUnitario, TotalProcedimiento, UsuarioCreado, UsuarioActualiza, FechaCreacion, FechaActualizacion) VALUES(:IdCotizacion, :IdProcedimiento, :ObservacionProcedimiento, :CantidadProcedimiento, :PrecioUnitario, :TotalProcedimiento, :UsuarioCreado, :UsuarioActualiza, :FechaCreacion, :FechaActualizacion)");
    $statement->bindParam(":IdCotizacion",             $datosCreate["IdCotizacion"],             PDO::PARAM_STR);
    $statement->bindParam(":IdProcedimiento",          $datosCreate["IdProcedimiento"],          PDO::PARAM_STR);
    $statement->bindParam(":ObservacionProcedimiento", $datosCreate["ObservacionProcedimiento"], PDO::PARAM_STR);
    $statement->bindParam(":CantidadProcedimiento",    $datosCreate["CantidadProcedimiento"],    PDO::PARAM_STR);
    $statement->bindParam(":PrecioUnitario",           $datosCreate["PrecioUnitario"],           PDO::PARAM_STR);
    $statement->bindParam(":TotalProcedimiento",       $datosCreate["TotalProcedimiento"],       PDO::PARAM_STR);
    $statement->bindParam(":UsuarioCreado",            $datosCreate["UsuarioCreado"],            PDO::PARAM_STR);
    $statement->bindParam(":UsuarioActualiza",         $datosCreate["UsuarioActualiza"],         PDO::PARAM_STR);
    $statement->bindParam(":FechaCreacion",            $datosCreate["FechaCreacion"],            PDO::PARAM_STR);
    $statement->bindParam(":FechaActualizacion",       $datosCreate["FechaActualizacion"],       PDO::PARAM_STR);
    return $statement->execute() ? "ok" : "error";
  }

  // Obtener ultima cotizacion (para guardar su detalle justo después de crearla)
  public static function mdlObtenerUltimaCotizacion($tabla)
  {
    $statement = Conexion::conn()->prepare("SELECT MAX(IdCotizacion) as codCotizacion FROM $tabla");
    $statement->execute();
    return $statement->fetch();
  }

  // Listar todas las cotizaciones con datos de paciente
  public static function mdlListarCotizaciones($tabla)
  {
    $statement = Conexion::conn()->prepare("SELECT tba_cotizacion.IdCotizacion, tba_cotizacion.IdPaciente, tba_cotizacion.TotalCotizacion, tba_cotizacion.FechaCotizacion, tba_cotizacion.EstadoCotizacion, tba_paciente.NombrePaciente, tba_paciente.ApellidoPaciente, tba_paciente.NumeroIdentificacion FROM $tabla INNER JOIN tba_paciente ON tba_cotizacion.IdPaciente = tba_paciente.IdPaciente ORDER BY IdCotizacion DESC");
    $statement->execute();
    return $statement->fetchAll();
  }

  // Cambiar el estado de la cotizacion (ej. 1 -> 2 Aprobada)
  public static function mdlCambiarEstado($tabla, $estado, $codCotizacion)
  {
    $statement = Conexion::conn()->prepare("UPDATE $tabla SET EstadoCotizacion=:EstadoCotizacion WHERE IdCotizacion=:IdCotizacion");
    $statement->bindParam(":EstadoCotizacion", $estado,         PDO::PARAM_STR);
    $statement->bindParam(":IdCotizacion",     $codCotizacion,  PDO::PARAM_STR);
    return $statement->execute() ? "ok" : "error";
  }

  // Obtener lista de procedimientos presupuestados en una cotizacion
  public static function mdlObtenerListaProcedimientos($tabla, $codCotizacion)
  {
    $statement = Conexion::conn()->prepare("SELECT tba_detallecotizacion.IdDetalleCotizacion, tba_detallecotizacion.IdProcedimiento, tba_detallecotizacion.ObservacionProcedimiento, tba_detallecotizacion.CantidadProcedimiento, tba_detallecotizacion.PrecioUnitario, tba_detallecotizacion.TotalProcedimiento, tba_procedimiento.NombreProcedimiento FROM $tabla INNER JOIN tba_procedimiento ON tba_detallecotizacion.IdProcedimiento = tba_procedimiento.IdProcedimiento WHERE tba_detallecotizacion.IdCotizacion = $codCotizacion");
    $statement->execute();
    return $statement->fetchAll();
  }

  // Eliminar el detalle o cabecera de la cotización
  public static function mdlEliminarCotizacion($tabla, $codCotizacion)
  {
    $statement = Conexion::conn()->prepare("DELETE FROM $tabla WHERE IdCotizacion = $codCotizacion");
    return $statement->execute() ? "ok" : "error";
  }

  // Mostrar detalle cabecera (datos principales del paciente)
  public static function mdlMostrarDatosCabecera($tabla, $codCotizacion)
  {
    $statement = Conexion::conn()->prepare("SELECT tba_paciente.NombrePaciente, tba_cotizacion.IdPaciente, tba_cotizacion.FechaCotizacion, tba_paciente.ApellidoPaciente, tba_paciente.NumeroIdentificacion, tba_paciente.TipoIdentificacion ,tba_paciente.CelularPaciente, tba_cotizacion.TotalCotizacion FROM $tabla INNER JOIN tba_paciente ON tba_cotizacion.IdPaciente = tba_paciente.IdPaciente WHERE tba_cotizacion.IdCotizacion = $codCotizacion");
    $statement->execute();
    return $statement->fetch();
  }

  // Obtener codigo de paciente por codigo de cotizacion
  public static function mdlObtenerPacienteCotizacion($tabla, $codCotizacion)
  {
    $statement = Conexion::conn()->prepare("SELECT tba_cotizacion.IdPaciente FROM $tabla WHERE tba_cotizacion.IdCotizacion = $codCotizacion");
    $statement->execute();
    return $statement->fetch();
  }

  // Update cabecera de la cotizacion
  public static function mdlUpdateCotizacion($tabla, $datosUpdate) 
  {
    $statement = Conexion::conn()->prepare("UPDATE $tabla SET FechaCotizacion=:FechaCotizacion, TotalCotizacion=:TotalCotizacion, UsuarioActualiza=:UsuarioActualiza, FechaActualizacion=:FechaActualizacion WHERE IdCotizacion=:IdCotizacion");
    $statement->bindParam(":FechaCotizacion",    $datosUpdate["FechaCotizacion"],    PDO::PARAM_STR);
    $statement->bindParam(":TotalCotizacion",    $datosUpdate["TotalCotizacion"],    PDO::PARAM_STR);
    $statement->bindParam(":UsuarioActualiza",   $datosUpdate["UsuarioActualiza"],   PDO::PARAM_STR);
    
    // BUG FIX: Se envía "FechaActualizacion" desde el controller
    $statement->bindParam(":FechaActualizacion", $datosUpdate["FechaActualizacion"], PDO::PARAM_STR);
    
    $statement->bindParam(":IdCotizacion",       $datosUpdate["IdCotizacion"],       PDO::PARAM_STR);
    return $statement->execute() ? "ok" : "error";
  }
}

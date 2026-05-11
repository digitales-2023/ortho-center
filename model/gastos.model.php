<?php
require_once "conexion.php";

/**
 * ModelGastos — Módulo incorporado de dentavitalis (B)
 *
 * Accesos a base de datos de tba_gasto, que alimenta centros de costos.
 */
class ModelGastos
{
  public static function mdlMostrarGastos($tabla)
  {
    $statement = Conexion::conn()->prepare("SELECT tba_gasto.IdGasto, tba_gasto.NombreGasto, tba_gasto.IdCentroCostos, tba_centrocostos.DescripcionCentro FROM $tabla INNER JOIN tba_centrocostos ON tba_gasto.IdCentroCostos = tba_centrocostos.IdCentroCostos ORDER BY IdGasto DESC");
    $statement->execute();
    return $statement->fetchAll();
  }

  public static function mdlMostrarCentrosCostos($tabla)
  {
    $statement = Conexion::conn()->prepare("SELECT tba_centrocostos.IdCentroCostos, tba_centrocostos.DescripcionCentro FROM $tabla");
    $statement->execute();
    return $statement->fetchAll();
  }

  public static function mdlCrearGasto($tabla, $datosCreate)
  {
    $statement = Conexion::conn()->prepare("INSERT INTO $tabla (IdCentroCostos, NombreGasto, FechaCreacion, FechaActualizacion) VALUES(:IdCentroCostos, :NombreGasto, :FechaCreacion, :FechaActualizacion)");
    $statement->bindParam(":IdCentroCostos",     $datosCreate["IdCentroCostos"],     PDO::PARAM_STR);
    $statement->bindParam(":NombreGasto",        $datosCreate["NombreGasto"],        PDO::PARAM_STR);
    $statement->bindParam(":FechaCreacion",      $datosCreate["FechaCreacion"],      PDO::PARAM_STR);
    $statement->bindParam(":FechaActualizacion", $datosCreate["FechaActualizacion"], PDO::PARAM_STR);
    return $statement->execute() ? "ok" : "error";
  }

  public static function mdlUpdateGasto($tabla, $datosUpdate)
  {
    $statement = Conexion::conn()->prepare("UPDATE $tabla SET NombreGasto=:NombreGasto, IdCentroCostos=:IdCentroCostos, FechaActualizacion=:FechaActualizacion WHERE IdGasto=:IdGasto");
    $statement->bindParam(":NombreGasto",        $datosUpdate["NombreGasto"],        PDO::PARAM_STR);
    $statement->bindParam(":IdCentroCostos",     $datosUpdate["IdCentroCostos"],     PDO::PARAM_STR);
    $statement->bindParam(":IdGasto",            $datosUpdate["IdGasto"],            PDO::PARAM_STR);
    $statement->bindParam(":FechaActualizacion", $datosUpdate["FechaActualizacion"], PDO::PARAM_STR);
    return $statement->execute() ? "ok" : "error";
  }

  public static function mdlEliminarGasto($tabla, $codGasto)
  {
    $statement = Conexion::conn()->prepare("DELETE FROM $tabla WHERE IdGasto = $codGasto");
    return $statement->execute() ? "ok" : "error";
  }

  public static function mdlMostrarDatosEditar($tabla, $codGasto)
  {
    $statement = Conexion::conn()->prepare("SELECT tba_gasto.IdGasto, tba_gasto.IdCentroCostos, tba_gasto.NombreGasto, tba_centrocostos.DescripcionCentro FROM $tabla INNER JOIN tba_centrocostos ON tba_gasto.IdCentroCostos = tba_centrocostos.IdCentroCostos WHERE tba_gasto.IdGasto = $codGasto");
    $statement->execute();
    return $statement->fetch();
  }

  public static function mdlMostrarGastosPorTipo($tabla, $tipoGasto)
  {
    $statement = Conexion::conn()->prepare("SELECT tba_gasto.IdGasto, tba_gasto.NombreGasto FROM $tabla WHERE tba_gasto.IdCentroCostos = $tipoGasto");
    $statement->execute();
    return $statement->fetchAll();
  }

  public static function mdlDatosGasto($tabla, $codGastoFijo)
  {
    $statement = Conexion::conn()->prepare("SELECT tba_gasto.IdGasto, tba_gasto.IdCentroCostos, tba_gasto.NombreGasto FROM $tabla WHERE tba_gasto.IdGasto = $codGastoFijo");
    $statement->execute();
    return $statement->fetch();
  }

  public static function mdlMostrarGastosCentroCosto($tabla, $codCentroCosto)
  {
    $statement = Conexion::conn()->prepare("SELECT tba_gasto.IdGasto, tba_gasto.IdCentroCostos, tba_gasto.NombreGasto FROM $tabla WHERE tba_gasto.IdCentroCostos = $codCentroCosto");
    $statement->execute();
    return $statement->fetchAll();
  }
}

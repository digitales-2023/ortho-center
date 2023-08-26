<?php

require_once "conexion.php";

class ModelProcedimientos
{
  //  Mostrar lista de procedimientos modulo procedimientos
  public static function mdlMostrarProcedimientos($tabla)
  {
    $statement = Conexion::conn()->prepare("SELECT tba_procedimiento.IdProcedimiento, tba_procedimiento.NombreProcedimiento, tba_procedimiento.PrecioPromedio, tba_procedimiento.IdTipoProcedimiento, tba_tipoprocedimiento.NombreTipoProcedimiento FROM $tabla INNER JOIN tba_tipoprocedimiento ON tba_procedimiento.IdTipoProcedimiento = tba_tipoprocedimiento.IdTipoProcedimiento ORDER BY IdProcedimiento DESC");
    $statement -> execute();
    return $statement -> fetchAll();
  }
  
  //  Mostrar lista de procedimientos para el modal de historia clinica
  public static function mdlMostrarProcedimientosHistoria($tabla)
  {
    $statement = Conexion::conn()->prepare("SELECT tba_procedimiento.IdProcedimiento, tba_procedimiento.NombreProcedimiento, tba_procedimiento.PrecioPromedio FROM $tabla");
    $statement -> execute();
    return $statement -> fetchAll();
  }


  //  Mostrar los tipos de procedimiento existentes
  public static function mdlMostrarTiposProcedimiento($tabla)
  {
    $statement = Conexion::conn()->prepare("SELECT tba_tipoprocedimiento.IdTipoProcedimiento, tba_tipoprocedimiento.NombreTipoProcedimiento FROM $tabla");
    $statement -> execute();
    return $statement -> fetchAll();
  }

  //  Crear un nuevo procedimiento
  public static function mdlCrearProcedimiento($tabla, $datosCreate)
  {
    $statement = Conexion::conn()->prepare("INSERT INTO $tabla (NombreProcedimiento, PrecioPromedio, IdTipoProcedimiento, FechaCreacion, FechaActualizacion) VALUES(:NombreProcedimiento, :PrecioPromedio, :IdTipoProcedimiento, :FechaCreacion, :FechaActualizacion)");
    $statement -> bindParam(":NombreProcedimiento", $datosCreate["NombreProcedimiento"], PDO::PARAM_STR);
    $statement -> bindParam(":PrecioPromedio", $datosCreate["PrecioPromedio"], PDO::PARAM_STR);
    $statement -> bindParam(":IdTipoProcedimiento", $datosCreate["IdTipoProcedimiento"], PDO::PARAM_STR);
    $statement -> bindParam(":FechaCreacion", $datosCreate["FechaCreacion"], PDO::PARAM_STR);
    $statement -> bindParam(":FechaActualizacion", $datosCreate["FechaActualizacion"], PDO::PARAM_STR);

    if($statement -> execute())
    {
      return "ok";
    }
    else
    {
      return "error";
    }
  }

  //  Editar un procedimiento
  public static function mdlUpdateProcedimiento($tabla, $datosUpdate)
  {
    $statement = Conexion::conn()->prepare("UPDATE $tabla SET NombreProcedimiento=:NombreProcedimiento, IdTipoProcedimiento=:IdTipoProcedimiento, PrecioPromedio=:PrecioPromedio, FechaActualizacion=:FechaActualizacion WHERE IdProcedimiento=:IdProcedimiento");
    $statement -> bindParam(":NombreProcedimiento", $datosUpdate["NombreProcedimiento"], PDO::PARAM_STR);
    $statement -> bindParam(":IdTipoProcedimiento", $datosUpdate["IdTipoProcedimiento"], PDO::PARAM_STR);
    $statement -> bindParam(":PrecioPromedio", $datosUpdate["PrecioPromedio"], PDO::PARAM_STR);
    $statement -> bindParam(":FechaActualizacion", $datosUpdate["FechaActualizacion"], PDO::PARAM_STR);
    $statement -> bindParam(":IdProcedimiento", $datosUpdate["IdProcedimiento"], PDO::PARAM_STR);
    if($statement -> execute())
    {
      return "ok";
    }
    else
    {
      return "error";
    }
  }

  //  Eliminar un procedimiento
  public static function mdlEliminarProcedimiento($tabla, $codProcedimiento)
  {
    $statement = Conexion::conn()->prepare("DELETE FROM $tabla WHERE IdProcedimiento = $codProcedimiento");
    if ($statement -> execute())
    {
      return "ok";
    }
    else
    {
      return "error";
    }
  }

  //  Mostrar datos para editar un procedimiento
  public static function mdlMostrarDatosEditar($tabla, $codProcedimiento)
  {
    $statement = Conexion::conn()->prepare("SELECT tba_procedimiento.IdProcedimiento, tba_procedimiento.NombreProcedimiento, tba_procedimiento.PrecioPromedio, tba_procedimiento.IdTipoProcedimiento, tba_tipoprocedimiento.NombreTipoProcedimiento FROM $tabla INNER JOIN tba_tipoprocedimiento ON tba_procedimiento.IdTipoProcedimiento = tba_tipoprocedimiento.IdTipoProcedimiento WHERE tba_procedimiento.IdProcedimiento = $codProcedimiento");
    $statement -> execute();
    return $statement -> fetch();
  }

  //  Obtener los datos de un procedimiento
  public static function mdlObtenerDatosProcedimiento($tabla, $codProcedimiento)
  {
    $statement = Conexion::conn()->prepare("SELECT tba_procedimiento.IdProcedimiento, tba_procedimiento.NombreProcedimiento, tba_procedimiento.PrecioPromedio FROM $tabla WHERE tba_procedimiento.IdProcedimiento = $codProcedimiento");
    $statement -> execute();
    return $statement -> fetch();
  }

  //  Crear nuevo tipo de procedimiento
  public static function mdlCrearTipoProcedimiento($tabla, $datosCreate)
  {
    $statement = Conexion::conn()->prepare("INSERT INTO $tabla (NombreTipoProcedimiento) VALUES(:NombreTipoProcedimiento)");
    $statement -> bindParam(":NombreTipoProcedimiento", $datosCreate["NombreTipoProcedimiento"], PDO::PARAM_STR);
    if($statement -> execute())
    {
      return "ok";
    }
    else
    {
      return "error";
    }
  }
}
<?php

require_once "conexion.php";

class ModelSocios
{
  //  Mostrar todos los socios
  public static function mdlMostrarSocios($tabla)
  {
    $statement = Conexion::conn()->prepare("SELECT tba_socio.IdSocio, tba_socio.NombreSocio, tba_socio.IdTipoIdentificacion, tba_socio.IdTipoSocio, tba_socio.Identificacion, tba_socio.FechaCreacion, tba_tipoidentificacion.NombreTipoIdentificacion, tba_tiposocio.NombreTipoSocio FROM $tabla INNER JOIN tba_tipoidentificacion ON tba_socio.IdTipoIdentificacion = tba_tipoidentificacion.IdTipoIdentificacion INNER JOIN tba_tiposocio ON tba_socio.IdTipoSocio = tba_tiposocio.IdTipoSocio ORDER BY IdSocio DESC");
    $statement -> execute();
    return $statement -> fetchAll();
  }

  //  Mostrar los tipos de socio
  public static function mdlMostrarTiposSocio($tabla)
  {
    $statement = Conexion::conn()->prepare("SELECT tba_tiposocio.IdTipoSocio, tba_tiposocio.NombreTipoSocio FROM $tabla");
    $statement -> execute();
    return $statement -> fetchAll();
  }

  //  Mostrar los tipos de identificacion
  public static function mdlMostrarTiposIdentificacion($tabla)
  {
    $statement = Conexion::conn()->prepare("SELECT tba_tipoidentificacion.IdTipoIdentificacion, tba_tipoidentificacion.NombreTipoIdentificacion FROM $tabla");
    $statement -> execute();
    return $statement -> fetchAll();
  }

  //  Crear un nuevo socio
  public static function mdlCrearSocio($tabla, $datosCreate)
  {
    $statement = Conexion::conn()->prepare("INSERT INTO $tabla (NombreSocio, IdTipoSocio, IdTipoIdentificacion, Identificacion, FechaCreacion, FechaActualizacion) VALUES(:NombreSocio, :IdTipoSocio, :IdTipoIdentificacion, :Identificacion, :FechaCreacion, :FechaActualizacion)");
    $statement -> bindParam(":NombreSocio", $datosCreate["NombreSocio"], PDO::PARAM_STR);
    $statement -> bindParam(":IdTipoSocio", $datosCreate["IdTipoSocio"], PDO::PARAM_STR);
    $statement -> bindParam(":IdTipoIdentificacion", $datosCreate["IdTipoIdentificacion"], PDO::PARAM_STR);
    $statement -> bindParam(":Identificacion", $datosCreate["Identificacion"], PDO::PARAM_STR);
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

  //  Mostrar los datos para editar a un socio
  public static function mdlMostrarDatosEditar($tabla, $codSocio)
  {
    $statement = Conexion::conn()->prepare("SELECT tba_socio.IdSocio, tba_socio.NombreSocio, tba_socio.IdTipoIdentificacion, tba_socio.Identificacion, tba_tipoidentificacion.NombreTipoIdentificacion FROM $tabla INNER JOIN tba_tipoidentificacion ON tba_socio.IdTipoIdentificacion = tba_tipoidentificacion.IdTipoIdentificacion WHERE tba_socio.IdSocio = $codSocio");
    $statement -> execute();
    return $statement -> fetch();
  }

  //  Editar un socio
  public static function mdlUpdateSocio($tabla, $datosUpdate)
  {
    $statement = Conexion::conn()->prepare("UPDATE $tabla SET NombreSocio=:NombreSocio, IdTipoSocio=:IdTipoSocio, IdTipoIdentificacion=:IdTipoIdentificacion, Identificacion=:Identificacion, FechaActualizacion=:FechaActualizacion WHERE IdSocio=:IdSocio");
    $statement -> bindParam(":NombreSocio", $datosUpdate["NombreSocio"], PDO::PARAM_STR);
    $statement -> bindParam(":IdTipoSocio", $datosUpdate["IdTipoSocio"], PDO::PARAM_STR);
    $statement -> bindParam(":IdTipoIdentificacion", $datosUpdate["IdTipoIdentificacion"], PDO::PARAM_STR);
    $statement -> bindParam(":Identificacion", $datosUpdate["Identificacion"], PDO::PARAM_STR);
    $statement -> bindParam(":IdSocio", $datosUpdate["IdSocio"], PDO::PARAM_STR);
    $statement -> bindParam(":FechaActualizacion", $datosUpdate["FechaActualizacion"], PDO::PARAM_STR);
    if($statement -> execute())
    {
      return "ok";
    }
    else
    {
      return "error";
    }
  }

  //  Eliminar un socio
  public static function mdlEliminarSocio($tabla, $codSocio)
  {
    $statement = Conexion::conn()->prepare("DELETE FROM $tabla WHERE IdSocio = $codSocio");
    if ($statement -> execute())
    {
      return "ok";
    }
    else
    {
      return "error";
    }
  }

  //  Mostrar los socios para la cabecera de costos
  public static function mdlMostrarSociosGastos($tabla)
  {
    $statement = Conexion::conn()->prepare("SELECT tba_socio.IdSocio, tba_socio.NombreSocio FROM $tabla");
    $statement -> execute();
    return $statement -> fetchAll();
  }

  //  Mostrar los socios por el tipo de socio
  public static function mdlMostrarSociosPorTipo($tabla, $codTipoSocio)
  {
    $statement = Conexion::conn()->prepare("SELECT tba_socio.IdSocio, tba_socio.NombreSocio FROM $tabla WHERE tba_socio.IdTipoSocio = $codTipoSocio");
    $statement -> execute();
    return $statement -> fetchAll();
  }

  //  Crear tipo de socio
  public static function mdlCrearTipoSocio($tabla, $datosCreate)
  {
    $statement = Conexion::conn()->prepare("INSERT INTO $tabla (NombreTipoSocio) VALUES(:NombreTipoSocio)");
    $statement -> bindParam(":NombreTipoSocio", $datosCreate["NombreTipoSocio"], PDO::PARAM_STR);
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
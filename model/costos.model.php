<?php

require_once "conexion.php";

class ModelCostos
{
  //  Mostrar todos los centros de costos
  public static function mdlMostrarCentrosCostos($tabla)
  {
    $statement = Conexion::conn()->prepare("SELECT tba_centrocostos.IdCentroCostos, tba_centrocostos.DescripcionCentro, tba_centrocostos.FechaCreacion FROM $tabla ORDER BY IdCentroCostos DESC");
    $statement -> execute();
    return $statement -> fetchAll();
  }

  //  Crear un nuevo centro de costos
  public static function mdlCrearCentroCostos($tabla, $datosCreate)
  {
    $statement = Conexion::conn()->prepare("INSERT INTO $tabla (DescripcionCentro, FechaCreacion, FechaActualizacion) VALUES(:DescripcionCentro, :FechaCreacion, :FechaActualizacion)");
    $statement -> bindParam(":DescripcionCentro", $datosCreate["DescripcionCentro"], PDO::PARAM_STR);
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

  //  Editar un centro de costos
  public static function mdlEditarCentroCostos($tabla, $datosUpdate)
  {
    $statement = Conexion::conn()->prepare("UPDATE $tabla SET DescripcionCentro=:DescripcionCentro, FechaActualizacion=:FechaActualizacion WHERE IdCentroCostos=:IdCentroCostos");
    $statement -> bindParam(":DescripcionCentro", $datosUpdate["DescripcionCentro"], PDO::PARAM_STR);
    $statement -> bindParam(":FechaActualizacion", $datosUpdate["FechaActualizacion"], PDO::PARAM_STR);
    $statement -> bindParam(":IdCentroCostos", $datosUpdate["IdCentroCostos"], PDO::PARAM_STR);
    if($statement -> execute())
    {
      return "ok";
    }
    else
    {
      return "error";
    }
  }

  //  Eliminar un centro de costos
  public static function mdlEliminarCentroCostos($tabla, $codCentro)
  {
    $statement = Conexion::conn()->prepare("DELETE FROM $tabla WHERE IdCentroCostos = $codCentro");
    if ($statement -> execute())
    {
      return "ok";
    }
    else
    {
      return "error";
    }
  }

  //  Mostrar los datos a editar
  public static function mdlMostrarDatosEditar($tabla, $codCentroCosto)
  {
    $statement = Conexion::conn()->prepare("SELECT tba_centrocostos.IdCentroCostos, tba_centrocostos.DescripcionCentro FROM $tabla WHERE tba_centrocostos.IdCentroCostos = $codCentroCosto");
    $statement -> execute();
    return $statement -> fetch();
  }

  //  Crear un nuevo costo
  public static function mdlIngresarNuevoCosto($tabla, $datosCabecera)
  {
    $statement = Conexion::conn()->prepare("INSERT INTO $tabla (IdCentroCostos, MesCosto, TotalCosto, EstadoCosto, UsuarioCreado, UsuarioActualiza, FechaCreacion, FechaActualizacion) VALUES(:IdCentroCostos, :MesCosto, :TotalCosto, :EstadoCosto, :UsuarioCreado, :UsuarioActualiza, :FechaCreacion, :FechaActualizacion)");
    $statement -> bindParam(":IdCentroCostos", $datosCabecera["IdCentroCostos"], PDO::PARAM_STR);
    $statement -> bindParam(":MesCosto", $datosCabecera["MesCosto"], PDO::PARAM_STR);
    $statement -> bindParam(":IdCentroCostos", $datosCabecera["IdCentroCostos"], PDO::PARAM_STR);
    $statement -> bindParam(":TotalCosto", $datosCabecera["TotalCosto"], PDO::PARAM_STR);
    $statement -> bindParam(":EstadoCosto", $datosCabecera["EstadoCosto"], PDO::PARAM_STR);
    $statement -> bindParam(":UsuarioCreado", $datosCabecera["UsuarioCreado"], PDO::PARAM_STR);
    $statement -> bindParam(":UsuarioActualiza", $datosCabecera["UsuarioActualiza"], PDO::PARAM_STR);
    $statement -> bindParam(":FechaCreacion", $datosCabecera["FechaCreacion"], PDO::PARAM_STR);
    $statement -> bindParam(":FechaActualizacion", $datosCabecera["FechaActualizacion"], PDO::PARAM_STR);

    if($statement -> execute())
    {
      return "ok";
    }
    else
    {
      return "error";
    }
  }

  //  Obtener el último id de costo creado
  public static function mdlObtenerUltimoID($tabla)
  {
    $statement = Conexion::conn()->prepare("SELECT MAX(IdCosto) as Id FROM $tabla");
    $statement -> execute();
    return $statement -> fetch();
  }

  //  Agregar el detalle de un costo
  public static function mdlIngresarDetalleCosto($tabla, $datosDetalle)
  {
    $statement = Conexion::conn()->prepare("INSERT INTO $tabla (IdCosto, IdGasto, IdSocio, NumeroDocumento, ObservacionGasto, FechaCosto, PrecioGasto) VALUES(:IdCosto, :IdGasto, :IdSocio, :NumeroDocumento, :ObservacionGasto, :FechaCosto, :PrecioGasto)");
    $statement -> bindParam(":IdCosto", $datosDetalle["IdCosto"], PDO::PARAM_STR);
    $statement -> bindParam(":IdGasto", $datosDetalle["IdGasto"], PDO::PARAM_STR);
    $statement -> bindParam(":IdSocio", $datosDetalle["IdSocio"], PDO::PARAM_STR);
    $statement -> bindParam(":NumeroDocumento", $datosDetalle["NumeroDocumento"], PDO::PARAM_STR);
    $statement -> bindParam(":ObservacionGasto", $datosDetalle["ObservacionGasto"], PDO::PARAM_STR);
    $statement -> bindParam(":FechaCosto", $datosDetalle["FechaCosto"], PDO::PARAM_STR);
    $statement -> bindParam(":PrecioGasto", $datosDetalle["PrecioGasto"], PDO::PARAM_STR);

    if($statement -> execute())
    {
      return "ok";
    }
    else
    {
      return "error";
    }
  }

  //  Mostrar todos los costos
  public static function mdlMostrarAllCostos($tabla)
  {
    $statement = Conexion::conn()->prepare("SELECT tba_costo.IdCosto, tba_costo.IdCentroCostos, tba_costo.MesCosto, tba_costo.TotalCosto, tba_costo.EstadoCosto, tba_costo.FechaCreacion, tba_centrocostos.DescripcionCentro FROM $tabla INNER JOIN tba_centrocostos ON tba_costo.IdCentroCostos = tba_centrocostos.IdCentroCostos ORDER BY IdCosto DESC");
    $statement -> execute();
    return $statement -> fetchAll();
  }

  //  Obtener cabecera del costo
  public static function mdlObtenerCabeceraCosto($tabla, $codCosto)
  {
    $statement = Conexion::conn()->prepare("SELECT tba_costo.IdCosto, tba_costo.IdCentroCostos, tba_costo.MesCosto, tba_costo.TotalCosto, tba_centrocostos.DescripcionCentro, tba_costo.EstadoCosto FROM $tabla INNER JOIN tba_centrocostos ON tba_costo.IdCentroCostos = tba_centrocostos.IdCentroCostos WHERE tba_costo.IdCosto = $codCosto");
    $statement -> execute();
    return $statement -> fetch();
  }

  //  Obtener el detalle del costo
  public static function mdlObtenerDetalleCosto($tabla, $codCosto)
  {
    $statement = Conexion::conn()->prepare("SELECT tba_detallecosto.IdDetalleCosto, tba_detallecosto.IdGasto, tba_detallecosto.IdSocio, tba_detallecosto.NumeroDocumento, tba_detallecosto.ObservacionGasto, tba_detallecosto.FechaCosto, tba_detallecosto.PrecioGasto, tba_gasto.NombreGasto, tba_socio.NombreSocio FROM $tabla INNER JOIN tba_gasto ON tba_detallecosto.IdGasto = tba_gasto.IdGasto INNER JOIN tba_socio ON tba_detallecosto.IdSocio = tba_socio.IdSocio WHERE tba_detallecosto.IdCosto = $codCosto");
    $statement -> execute();
    return $statement -> fetchAll();
  }

  //  Eliminar el detalle del costo
  public static function mdlEliminarDetalleCosto($tabla, $codCosto)
  {
    $statement = Conexion::conn()->prepare("DELETE FROM $tabla WHERE IdCosto = $codCosto");
    if ($statement -> execute())
    {
      return "ok";
    }
    else
    {
      return "error";
    }
  }

  //  Editar la cabecera del costo
  public static function mdlEditarCabeceraCosto($tabla, $datosCabecera)
  {
    $statement = Conexion::conn()->prepare("UPDATE $tabla SET MesCosto=:MesCosto, TotalCosto=:TotalCosto, UsuarioActualiza=:UsuarioActualiza, FechaActualizacion=:FechaActualizacion WHERE tba_costo.IdCosto=:IdCosto");
    $statement -> bindParam(":MesCosto", $datosCabecera["MesCosto"], PDO::PARAM_STR);
    $statement -> bindParam(":TotalCosto", $datosCabecera["TotalCosto"], PDO::PARAM_STR);
    $statement -> bindParam(":UsuarioActualiza", $datosCabecera["UsuarioActualiza"], PDO::PARAM_STR);
    $statement -> bindParam(":FechaActualizacion", $datosCabecera["FechaActualizacion"], PDO::PARAM_STR);
    $statement -> bindParam(":IdCosto", $datosCabecera["IdCosto"], PDO::PARAM_STR);

    if($statement -> execute())
    {
      return "ok";
    }
    else
    {
      return "error";
    }
  }

  //  Eliminar cabecera costo
  public static function mdlEliminarCabeceraCosto($tabla, $codCosto)
  {
    $statement = Conexion::conn()->prepare("DELETE FROM $tabla WHERE IdCosto = $codCosto");
    if ($statement -> execute())
    {
      return "ok";
    }
    else
    {
      return "error";
    }
  }

  //  Cambiar el estado al costo
  public static function mdlCambiarEstado($tabla, $datos)
  {
    $statement = Conexion::conn()->prepare("UPDATE $tabla SET EstadoCosto=:EstadoCosto, FechaActualizacion=:FechaActualizacion WHERE IdCosto=:IdCosto");
    $statement -> bindParam(":EstadoCosto", $datos["EstadoCosto"], PDO::PARAM_STR);
    $statement -> bindParam(":FechaActualizacion", $datos["FechaActualizacion"], PDO::PARAM_STR);
    $statement -> bindParam(":IdCosto", $datos["IdCosto"], PDO::PARAM_STR);
    if($statement -> execute())
    {
      return "ok";
    }
    else
    {
      return "error";
    }
  }

  //  Mostrar los costos por rango de fechas
  public static function mdlMostrarCostosPorFechas($tabla, $fechaInicial, $fechaFinal)
  {
    $statement = Conexion::conn()->prepare("SELECT tba_costo.IdCosto, tba_costo.IdCentroCostos, tba_detallecosto.IdDetalleCosto, tba_detallecosto.IdGasto, tba_detallecosto.IdSocio, tba_detallecosto.NumeroDocumento, tba_detallecosto.ObservacionGasto, tba_detallecosto.FechaCosto, tba_detallecosto.PrecioGasto, tba_centrocostos.DescripcionCentro, tba_gasto.NombreGasto, tba_socio.NombreSocio 
    FROM $tabla 
    INNER JOIN tba_detallecosto ON tba_costo.IdCosto = tba_detallecosto.IdCosto 
    INNER JOIN tba_centrocostos ON tba_costo.IdCentroCostos = tba_centrocostos.IdCentroCostos 
    INNER JOIN tba_gasto ON tba_detallecosto.IdGasto = tba_gasto.IdGasto 
    INNER JOIN tba_socio ON tba_detallecosto.IdSocio = tba_socio.IdSocio 
    WHERE tba_detallecosto.FechaCosto BETWEEN '$fechaInicial' AND '$fechaFinal'
    ");
    $statement -> execute();
    return $statement -> fetchAll();
  }

  //  Sumar todos los costos de la base de datos
  public static function mdlSumarTodosCostos($tabla)
  {
    $statement = Conexion::conn()->prepare("SELECT SUM(TotalCosto) AS suma_total FROM $tabla");
    $statement -> execute();
    return $statement -> fetch();
  }
  
  //  Sumar los costos del mes actual
  public static function mdlSumarCostosMesActual($tabla, $mesActual)
  {
    $statement = Conexion::conn()->prepare("SELECT SUM(TotalCosto) AS suma_mes FROM $tabla WHERE MesCosto = '$mesActual'");
    $statement -> execute();
    return $statement -> fetch();
  }

  //  Sumar el costo del mayor centro de costos
  public static function mdlSumarMayorCentroCostos($tabla)
  {
    $statement = Conexion::conn()->prepare("SELECT cc.IdCentroCostos, cc.DescripcionCentro, SUM(c.TotalCosto) AS SumaMayorCosto FROM tba_centrocostos cc INNER JOIN tba_costo c ON cc.IdCentroCostos = c.IdCentroCostos GROUP BY cc.IdCentroCostos, cc.DescripcionCentro HAVING SUM(c.TotalCosto) = (SELECT MAX(TotalCostoSum) FROM (SELECT IdCentroCostos, SUM(TotalCosto) AS TotalCostoSum FROM tba_costo GROUP BY IdCentroCostos) AS Subquery)");
    $statement -> execute();
    return $statement -> fetch();
  }
  
  //  Mostrar costos por rango de meses
  public static function mldMostrarSumaCostosPorMeses($tabla, $fechaInicial, $fechaFinal)
  {
    $statement = Conexion::conn()->prepare("SELECT
    cc.IdCentroCostos, 
    cc.DescripcionCentro, 
    SUM(tba_detallecosto.PrecioGasto) AS SumaTotalCosto, 
    tba_detallecosto.NumeroDocumento, 
    tba_detallecosto.ObservacionGasto, 
    tba_socio.NombreSocio, 
    tba_detallecosto.FechaCosto, 
    tba_gasto.NombreGasto, 
	  tba_detallecosto.PrecioGasto
  FROM
    $tabla AS cc
    INNER JOIN
    tba_costo AS c
    ON 
      cc.IdCentroCostos = c.IdCentroCostos
    INNER JOIN
    tba_detallecosto
    ON 
      c.IdCosto = tba_detallecosto.IdCosto
    INNER JOIN
    tba_socio
    ON 
      tba_detallecosto.IdSocio = tba_socio.IdSocio
    INNER JOIN
    tba_gasto
    ON 
      cc.IdCentroCostos = tba_gasto.IdCentroCostos AND
      tba_detallecosto.IdGasto = tba_gasto.IdGasto
  WHERE
    tba_detallecosto.FechaCosto >= '$fechaInicial' AND
    tba_detallecosto.FechaCosto <= '$fechaFinal'
  GROUP BY
    cc.IdCentroCostos, 
    cc.DescripcionCentro");
    $statement -> execute();
    return $statement -> fetchAll();
  }

  //  Mostrar costos por centro de costos
  public static function mldMostrarSumaCostosPorCentro($tabla, $codCentroCosto)
  {
    $statement = Conexion::conn()->prepare("SELECT MesCosto, SUM(TotalCosto) AS SumaTotalCosto FROM $tabla WHERE IdCentroCostos = $codCentroCosto GROUP BY MesCosto");
    $statement -> execute();
    return $statement -> fetchAll();
  }
  
  //  Verificar costo
  public static function mdlVerificarUsoSocio($tabla, $codSocio)
  {
    $statement = Conexion::conn()->prepare("SELECT COUNT(IdDetalleCosto) AS TotalUso FROM $tabla WHERE IdSocio = $codSocio ");
    $statement -> execute();
    return $statement -> fetch();
  }
}
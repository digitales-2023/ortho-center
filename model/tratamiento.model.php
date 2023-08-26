<?php
require_once "conexion.php";

class ModelTratamiento
{
  //  Crear un nuevo tratamiento
  public static function mdlCrearTratamiento($tabla, $datosCreateTratamiento)
  {
    $statement = Conexion::conn()->prepare("INSERT INTO $tabla (IdHistoriaClinica, IdPaciente, UsuarioCreado, UsuarioActualiza, FechaCreacion, FechaActualizacion) VALUES(:IdHistoriaClinica, :IdPaciente, :UsuarioCreado, :UsuarioActualiza, :FechaCreacion, :FechaActualizacion)");
    $statement -> bindParam(":IdHistoriaClinica", $datosCreateTratamiento["IdHistoriaClinica"], PDO::PARAM_STR);
    $statement -> bindParam(":IdPaciente", $datosCreateTratamiento["IdPaciente"], PDO::PARAM_STR);
    $statement -> bindParam(":UsuarioCreado", $datosCreateTratamiento["UsuarioCreado"], PDO::PARAM_STR);
    $statement -> bindParam(":UsuarioActualiza", $datosCreateTratamiento["UsuarioActualiza"], PDO::PARAM_STR);
    $statement -> bindParam(":FechaCreacion", $datosCreateTratamiento["FechaCreacion"], PDO::PARAM_STR);
    $statement -> bindParam(":FechaActualizacion", $datosCreateTratamiento["FechaActualizacion"], PDO::PARAM_STR);

    if($statement -> execute())
    {
      return "ok";
    }
    else
    {
      return "error";
    }
  }

  //  Crear un nuevo tratamiento luego de eliminarse el que ya había
  public static function mdlCrearEditadoDetalleTratamiento($tabla, $datosCreateTratamiento)
  {
    $statement = Conexion::conn()->prepare("INSERT INTO $tabla (IdTratamiento, IdProcedimiento, ObservacionProcedimiento, EstadoTratamiento, FechaProcedimiento, PrecioProcedimiento) VALUES(:IdTratamiento, :IdProcedimiento, :ObservacionProcedimiento, :EstadoTratamiento, :FechaProcedimiento, :PrecioProcedimiento)");
    $statement -> bindParam(":IdTratamiento", $datosCreateTratamiento["IdTratamiento"], PDO::PARAM_STR);
    $statement -> bindParam(":IdProcedimiento", $datosCreateTratamiento["IdProcedimiento"], PDO::PARAM_STR);
    $statement -> bindParam(":ObservacionProcedimiento", $datosCreateTratamiento["ObservacionProcedimiento"], PDO::PARAM_STR);
    $statement -> bindParam(":EstadoTratamiento", $datosCreateTratamiento["EstadoTratamiento"], PDO::PARAM_STR);
    $statement -> bindParam(":FechaProcedimiento", $datosCreateTratamiento["FechaProcedimiento"], PDO::PARAM_STR);
    $statement -> bindParam(":PrecioProcedimiento", $datosCreateTratamiento["PrecioProcedimiento"], PDO::PARAM_STR);

    if($statement -> execute())
    {
      return "ok";
    }
    else
    {
      return "error";
    }
  }

  //  Obtener el ultimo tratamiento
  public static function mdlObtenerUltimoTratamiento($tabla)
  {
    $statement = Conexion::conn()->prepare("SELECT MAX(IdTratamiento) as Id FROM $tabla");
    $statement -> execute();
    return $statement -> fetch();
  }

  //  Obtener el tratamiento de un paciente
  public static function mdlObtenerIdTratamiento($tabla, $codPaciente)
  {
    $statement = Conexion::conn()->prepare("SELECT tba_tratamiento.IdTratamiento FROM $tabla WHERE tba_tratamiento.IdPaciente = $codPaciente");
    $statement -> execute();
    return $statement -> fetch();
  }

  //  Crear el detalle del tratamiento
  public static function mdlCrearDetalleTratamiento($tabla, $datosDetalleTratamiento)
  {
    $statement = Conexion::conn()->prepare("INSERT INTO $tabla (IdTratamiento, IdProcedimiento, EstadoTratamiento, ObservacionProcedimiento, PrecioProcedimiento) VALUES(:IdTratamiento, :IdProcedimiento, :EstadoTratamiento, :ObservacionProcedimiento, :PrecioProcedimiento)");
    $statement -> bindParam(":IdTratamiento", $datosDetalleTratamiento["IdTratamiento"], PDO::PARAM_STR);
    $statement -> bindParam(":IdProcedimiento", $datosDetalleTratamiento["IdProcedimiento"], PDO::PARAM_STR);
    $statement -> bindParam(":EstadoTratamiento", $datosDetalleTratamiento["EstadoTratamiento"], PDO::PARAM_STR);
    $statement -> bindParam(":ObservacionProcedimiento", $datosDetalleTratamiento["ObservacionProcedimiento"], PDO::PARAM_STR);
    $statement -> bindParam(":PrecioProcedimiento", $datosDetalleTratamiento["PrecioProcedimiento"], PDO::PARAM_STR);

    if($statement -> execute())
    {
      return "ok";
    }
    else
    {
      return "error";
    }
  }

  //  Actualizar el total del tratamiento
  public static function mdlUpadatePrecioTratamiento($tabla, $codTratamiento, $totalTratamiento)
  {
    $statement = Conexion::conn()->prepare("UPDATE $tabla SET TotalTratamiento=:TotalTratamiento WHERE IdTratamiento=:IdTratamiento");
    $statement -> bindParam(":TotalTratamiento", $totalTratamiento, PDO::PARAM_STR);
    $statement -> bindParam(":IdTratamiento", $codTratamiento, PDO::PARAM_STR);
    if($statement -> execute())
    {
      return "ok";
    }
    else
    {
      return "error";
    }
  }

  //  Mostrar el total del tratamiento
  public static function mdlMostrarTotalTratamiento($tabla, $codTratamiento)
  {
    $statement = Conexion::conn()->prepare("SELECT tba_tratamiento.TotalTratamiento FROM $tabla WHERE tba_tratamiento.IdTratamiento = $codTratamiento");
    $statement -> execute();
    return $statement -> fetch();
  }

  //  mostrar detalle del tratamiento por la historia clinica
  public static function mdlMostrarDetalleTratamiento($tabla, $codHistoria)
  {
    $statement = Conexion::conn()->prepare("SELECT
    tba_procedimiento.NombreProcedimiento, 
    tba_detalletratamiento.PrecioProcedimiento, 
    tba_detalletratamiento.ObservacionProcedimiento, 
    tba_procedimiento.IdProcedimiento
  FROM
    $tabla
    INNER JOIN
    tba_tratamiento
    ON 
      tba_detalletratamiento.IdTratamiento = tba_tratamiento.IdTratamiento
    INNER JOIN
    tba_historiaclinica
    ON 
      tba_tratamiento.IdHistoriaClinica = tba_historiaclinica.IdHistoriaClinica
    INNER JOIN
    tba_procedimiento
    ON 
      tba_detalletratamiento.IdProcedimiento = tba_procedimiento.IdProcedimiento
  WHERE
    tba_historiaclinica.IdHistoriaClinica = $codHistoria");
    $statement -> execute();
    return $statement -> fetchAll();
  }

  //  Mostrar el detalle del tratamiento en su totalidad
  public static function mdlMostrarDetalleTratamientoCompleto($tabla, $codHistoria)
  {
    $statement = Conexion::conn()->prepare("SELECT
    tba_procedimiento.NombreProcedimiento, 
    tba_detalletratamiento.PrecioProcedimiento, 
    tba_detalletratamiento.ObservacionProcedimiento,
    tba_detalletratamiento.EstadoTratamiento,
    tba_detalletratamiento.FechaProcedimiento, 
    tba_procedimiento.IdProcedimiento
  FROM
    $tabla
    INNER JOIN
    tba_tratamiento
    ON 
      tba_detalletratamiento.IdTratamiento = tba_tratamiento.IdTratamiento
    INNER JOIN
    tba_historiaclinica
    ON 
      tba_tratamiento.IdHistoriaClinica = tba_historiaclinica.IdHistoriaClinica
    INNER JOIN
    tba_procedimiento
    ON 
      tba_detalletratamiento.IdProcedimiento = tba_procedimiento.IdProcedimiento
  WHERE
    tba_historiaclinica.IdHistoriaClinica = $codHistoria");
    $statement -> execute();
    return $statement -> fetchAll();
  }

  //  Mostrar el plan de tratamiento de los procedimientos segun el estado del procedimiento
  public static function mdlMostrarDetalleTratamientoEstado($tabla, $codHistoria, $estado)
  {
    $statement = Conexion::conn()->prepare("SELECT
    tba_procedimiento.NombreProcedimiento, 
    tba_detalletratamiento.PrecioProcedimiento, 
    tba_detalletratamiento.ObservacionProcedimiento,
    tba_detalletratamiento.EstadoTratamiento,
    tba_detalletratamiento.FechaProcedimiento, 
    tba_procedimiento.IdProcedimiento
  FROM
    $tabla
    INNER JOIN
    tba_tratamiento
    ON 
      tba_detalletratamiento.IdTratamiento = tba_tratamiento.IdTratamiento
    INNER JOIN
    tba_historiaclinica
    ON 
      tba_tratamiento.IdHistoriaClinica = tba_historiaclinica.IdHistoriaClinica
    INNER JOIN
    tba_procedimiento
    ON 
      tba_detalletratamiento.IdProcedimiento = tba_procedimiento.IdProcedimiento
  WHERE
    tba_historiaclinica.IdHistoriaClinica = $codHistoria AND tba_detalletratamiento.EstadoTratamiento = $estado");
    $statement -> execute();
    return $statement -> fetchAll();
  }

  //  Obtener el codigo del tratamiento
  public static function mdlObtenerCodTratamiento($tabla, $codPaciente)
  {
    $statement = Conexion::conn()->prepare("SELECT tba_tratamiento.IdTratamiento FROM $tabla WHERE tba_tratamiento.IdPaciente = $codPaciente");
    $statement -> execute();
    return $statement -> fetch();
  }

  //  Obtener la lista de procedimientos de un tratamiento por el codigo de paciente ---> USAR PARA LISTADO DE PAGOS POR PACIENTE
  public static function mdlObtenerListaProcedimientos($tabla, $codPaciente)
  {
    $statement = Conexion::conn()->prepare("SELECT tba_detalletratamiento.IdDetalleTratamiento, tba_detalletratamiento.IdProcedimiento, tba_detalletratamiento.ObservacionProcedimiento, tba_detalletratamiento.EstadoTratamiento, tba_detalletratamiento.FechaProcedimiento, tba_detalletratamiento.PrecioProcedimiento, tba_detalletratamiento.IdTratamiento FROM $tabla	INNER JOIN tba_tratamiento ON tba_detalletratamiento.IdTratamiento = tba_tratamiento.IdTratamiento WHERE	tba_tratamiento.IdPaciente = $codPaciente ORDER BY IdDetalleTratamiento ASC");
    $statement -> execute();
    return $statement -> fetchAll();
  }

  //  Eliminar detalle de tratamiento del paciente
  public static function mdlEliminarDetalleActual($tabla, $codTratamiento)
  {
    $statement = Conexion::conn()->prepare("DELETE FROM $tabla WHERE IdTratamiento = $codTratamiento");
    if ($statement -> execute())
    {
      return "ok";
    }
    else
    {
      return "error";
    }
  }

  //  Obtener el monto pagado actualmente
  public static function mdlObtenerTotalPagado($tabla, $codPaciente)
  {
    $statement = Conexion::conn()->prepare("SELECT tba_tratamiento.IdTratamiento, tba_tratamiento.TotalPagado FROM $tabla WHERE tba_tratamiento.IdPaciente = $codPaciente");
    $statement -> execute();
    return $statement -> fetch();
  }

  //  Actualizar el nuevo total pagado
  public static function mldActualizarTotal($tabla, $nuevoTotal, $codPaciente)
  {
    $statement = Conexion::conn()->prepare("UPDATE $tabla SET TotalPagado=:TotalPagado WHERE IdPaciente=:IdPaciente");
    $statement -> bindParam(":TotalPagado", $nuevoTotal, PDO::PARAM_STR);
    $statement -> bindParam(":IdPaciente", $codPaciente, PDO::PARAM_STR);
    if($statement -> execute())
    {
      return "ok";
    }
    else
    {
      return "error";
    }
  }

  //  Obtener totales del tratamiento 
  public static function mdlObtenerTotalesTratamiento($tabla, $codPaciente)
  {
    $statement = Conexion::conn()->prepare("SELECT tba_tratamiento.TotalTratamiento, tba_tratamiento.TotalPagado, (TotalTratamiento - TotalPagado) AS DeudaActual FROM $tabla WHERE tba_tratamiento.IdPaciente = $codPaciente");
    $statement -> execute();
    return $statement -> fetch();
  }

  //  Obtener el costo total de los procedimientos realizdos hastas ahora
  public static function mdlObtenerTotalRealizado($tabla, $codHistoria)
  {
    $statement = Conexion::conn()->prepare("SELECT SUM(PrecioProcedimiento) AS TotalRealizado FROM $tabla INNER JOIN tba_tratamiento ON tba_detalletratamiento.IdTratamiento = tba_tratamiento.IdTratamiento WHERE tba_tratamiento.IdHistoriaClinica = $codHistoria AND EstadoTratamiento = 2");
    $statement -> execute();
    return $statement -> fetch();
  }

  //  Eliminar detalle de tratamiento
  public static function mdlEliminarTratamiento($tabla, $codTratamiento)
  {
    $statement = Conexion::conn()->prepare("DELETE FROM $tabla WHERE IdTratamiento = $codTratamiento");
    if($statement -> execute())
    {
      return "ok";
    }
    else
    {
      return "error";
    }
  }

  //  Verificar si un procedimiento está siendo usado en algún plan de tratamiento
  public static function mdlVerificarUsoProcedimiento($tabla, $codProcedimiento)
  {
    $statement = Conexion::conn()->prepare("SELECT COUNT(IdProcedimiento) AS TotalUso FROM $tabla WHERE IdProcedimiento = $codProcedimiento ");
    $statement -> execute();
    return $statement -> fetch();
  }
}
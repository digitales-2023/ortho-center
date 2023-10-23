<?php

require_once "conexion.php";

class ModelVisitas
{
  //  Mostrar lista de visitas por paciente
  public static function mdlMostrarVisitasPaciente($tabla, $codHistoria)
  {
    $statement = Conexion::conn()->prepare("SELECT
    tba_visita.IdPago, 
    tba_procedimiento.NombreProcedimiento, 
    tba_procedimiento.IdProcedimiento, 
    tba_visita.IdDetalleTratamiento, 
    tba_visita.FechaVisita, 
    tba_visita.IdVisita, 
    tba_visita.IdHistoriaClinica, 
    tba_visita.MotivoVisita, 
    tba_detalletratamiento.PrecioProcedimiento, 
    tba_pago.TotalPagado
  FROM
    $tabla
    LEFT JOIN
    tba_detalletratamiento
    ON 
      tba_visita.IdDetalleTratamiento = tba_detalletratamiento.IdDetalleTratamiento
    LEFT JOIN
    tba_procedimiento
    ON 
      tba_detalletratamiento.IdProcedimiento = tba_procedimiento.IdProcedimiento
    LEFT JOIN
    tba_pago
    ON 
      tba_visita.IdPago = tba_pago.IdPago
  WHERE
    tba_visita.IdHistoriaClinica = $codHistoria");
    $statement->execute();
    return $statement->fetchAll();
  }

  //  Ingresar nuevas visitas
  public static function mdlIngresarVisitas($tabla, $datosCreate)
  {
    $statement = Conexion::conn()->prepare("INSERT INTO $tabla (IdHistoriaClinica, IdPago, IdDetalleTratamiento, MotivoVisita, FechaVisita, UsuarioCreado, UsuarioActualiza, FechaCreacion, FechaActualizacion) VALUES(:IdHistoriaClinica, :IdPago, :IdDetalleTratamiento, :MotivoVisita, :FechaVisita, :UsuarioCreado, :UsuarioActualiza, :FechaCreacion, :FechaActualizacion)");
    $statement->bindParam(":IdHistoriaClinica", $datosCreate["IdHistoriaClinica"], PDO::PARAM_STR);
    $statement->bindParam(":IdPago", $datosCreate["IdPago"], PDO::PARAM_STR);
    $statement->bindParam(":IdDetalleTratamiento", $datosCreate["IdDetalleTratamiento"], PDO::PARAM_STR);
    $statement->bindParam(":MotivoVisita", $datosCreate["MotivoVisita"], PDO::PARAM_STR);
    $statement->bindParam(":FechaVisita", $datosCreate["FechaVisita"], PDO::PARAM_STR);
    $statement->bindParam(":UsuarioCreado", $datosCreate["UsuarioCreado"], PDO::PARAM_STR);
    $statement->bindParam(":UsuarioActualiza", $datosCreate["UsuarioActualiza"], PDO::PARAM_STR);
    $statement->bindParam(":FechaCreacion", $datosCreate["FechaCreacion"], PDO::PARAM_STR);
    $statement->bindParam(":FechaActualizacion", $datosCreate["FechaActualizacion"], PDO::PARAM_STR);

    if ($statement->execute()) {
      return "ok";
    } else {
      return "error";
    }
  }

  //  Eliminar una visita
  public static function mdlEliminarUnaVisita($tabla, $codVisita)
  {
    $statement = Conexion::conn()->prepare("DELETE FROM $tabla WHERE IdVisita = $codVisita");
    if ($statement->execute()) {
      return "ok";
    } else {
      return "error";
    }
  }

  //  Obtener el codigo de pago a partir del codigo de visita
  public static function mdlObtenerCodPago($tabla, $codVisita)
  {
    $statement = Conexion::conn()->prepare("SELECT tba_visita.IdPago FROM $tabla WHERE tba_visita.IdVisita = $codVisita");
    $statement->execute();
    return $statement->fetch();
  }

  //  Obtener el historial de visitas completo 
  public static function mdlMostrarHistorialVisitas($tabla, $codHistoria)
  {
    $statement = Conexion::conn()->prepare("SELECT
		tba_visita.MotivoVisita, 
		tba_visita.FechaVisita, 
		tba_pago.TotalPagado, 
		tba_procedimiento.NombreProcedimiento
	FROM
		$tabla
		LEFT JOIN
		tba_pago
		ON 
			tba_visita.IdPago = tba_pago.IdPago
		LEFT JOIN
		tba_detalletratamiento
		ON 
			tba_visita.IdDetalleTratamiento = tba_detalletratamiento.IdDetalleTratamiento
		LEFT JOIN
		tba_procedimiento
		ON 
			tba_detalletratamiento.IdProcedimiento = tba_procedimiento.IdProcedimiento
	WHERE
		tba_visita.IdHistoriaClinica = $codHistoria");
    $statement->execute();
    return $statement->fetchAll();
  }

  //  Eliminar todas las visitas de un solo codigo de historia clinica
  public static function mdlEliminarVisitas($tabla, $codHistoria)
  {
    $statement = Conexion::conn()->prepare("DELETE FROM $tabla WHERE IdHistoriaClinica = $codHistoria");
    if ($statement->execute()) {
      return "ok";
    } else {
      return "error";
    }
  }
}

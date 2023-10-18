<?php
require_once "conexion.php";

class ModelPagos
{
  //  Mostrar todos los pagos realizados
  public static function mdlMostrarTodosLosPagos($tabla)
  {
    $statement = Conexion::conn()->prepare("SELECT tba_pago.IdPago, tba_pago.IdPaciente, tba_pago.IdTipoPago, tba_pago.TotalPago, tba_pago.FechaPago, tba_tipodepago.DescripcionTipo, tba_paciente.NombrePaciente, tba_paciente.ApellidoPaciente, tba_paciente.DNIPaciente FROM $tabla INNER JOIN tba_tipodepago ON tba_pago.IdTipoPago = tba_tipodepago.IdTipoPago INNER JOIN tba_paciente ON tba_pago.IdPaciente = tba_paciente.IdPaciente ORDER BY IdPago DESC");
    $statement->execute();
    return $statement->fetchAll();
  }

  //  Eliminar un pago
  public static function mdlEliminarPago($tabla, $codPago)
  {
    $statement = Conexion::conn()->prepare("DELETE FROM $tabla WHERE IdPago = $codPago");
    if ($statement->execute()) {
      return "ok";
    } else {
      return "error";
    }
  }

  //  Ingresar un nuevo pago
  public static function mdlIngresarNuevoPago($tabla, $datosCreate)
  {
    $statement = Conexion::conn()->prepare("INSERT INTO $tabla (IdPaciente, IdTipoPago, TotalPago, FechaPago, ObservacionPago, FechaCreacion, FechaActualizacion) VALUES(:IdPaciente, :IdTipoPago, :TotalPago, :FechaPago, :ObservacionPago, :FechaCreacion, :FechaActualizacion)");
    $statement->bindParam(":IdPaciente", $datosCreate["IdPaciente"], PDO::PARAM_STR);
    $statement->bindParam(":IdTipoPago", $datosCreate["IdTipoPago"], PDO::PARAM_STR);
    $statement->bindParam(":TotalPago", $datosCreate["TotalPago"], PDO::PARAM_STR);
    $statement->bindParam(":FechaPago", $datosCreate["FechaPago"], PDO::PARAM_STR);
    $statement->bindParam(":ObservacionPago", $datosCreate["ObservacionPago"], PDO::PARAM_STR);
    $statement->bindParam(":FechaCreacion", $datosCreate["FechaCreacion"], PDO::PARAM_STR);
    $statement->bindParam(":FechaActualizacion", $datosCreate["FechaActualizacion"], PDO::PARAM_STR);
    if ($statement->execute()) {
      return "ok";
    } else {
      return "error";
    }
  }

  //  Mostrar los datos del pago a editar
  public static function mdlMostrarDatosEditar($tabla, $codPagoEditar)
  {
    $statement = Conexion::conn()->prepare("SELECT tba_pago.IdPago, tba_pago.IdPaciente, tba_pago.IdTipoPago, tba_pago.TotalPago, tba_pago.FechaPago, tba_pago.ObservacionPago, tba_tipodepago.DescripcionTipo, tba_paciente.NombrePaciente, tba_paciente.ApellidoPaciente, tba_paciente.DNIPaciente FROM $tabla INNER JOIN tba_tipodepago ON tba_pago.IdTipoPago = tba_tipodepago.IdTipoPago INNER JOIN tba_paciente ON tba_pago.IdPaciente = tba_paciente.IdPaciente WHERE tba_pago.IdPago = $codPagoEditar");
    $statement->execute();
    return $statement->fetch();
  }

  //  Mostrar la lista de pagos por paciente
  public static function mdlMostrarPagosPorPaciente($tabla, $codPaciente)
  {
    $statement = Conexion::conn()->prepare("SELECT
    tba_pago.IdPago, 
    tba_pago.TotalPagado, 
    tba_pago.FechaPago, 
    tba_pago.ObservacionPago, 
    tba_visita.IdVisita,
    tba_visita.IdDetalleTratamiento,
    tba_procedimiento.NombreProcedimiento
  FROM
    $tabla
    INNER JOIN
    tba_paciente
    ON 
      tba_pago.IdPaciente = tba_paciente.IdPaciente
    LEFT JOIN
    tba_visita
    ON 
      tba_pago.IdPago = tba_visita.IdPago
    LEFT JOIN
    tba_detalletratamiento
    ON 
      tba_visita.IdDetalleTratamiento = tba_detalletratamiento.IdDetalleTratamiento
    LEFT JOIN
    tba_procedimiento
    ON 
      tba_detalletratamiento.IdProcedimiento = tba_procedimiento.IdProcedimiento
  WHERE
    tba_pago.IdPaciente = $codPaciente
  ORDER BY
    IdPago ASC");
    $statement->execute();
    return $statement->fetchAll();
  }

  //  Obtener el ultimop pago realizado
  public static function mdlObtenerUltimoPagoRealizado($tabla)
  {
    $statement = Conexion::conn()->prepare("SELECT MAX(IdPago) as Id FROM $tabla");
    $statement->execute();
    return $statement->fetch();
  }

  //  Actualizar la ruta del archivo en la base de datos
  public static function mdlActualizarRuta($tabla, $nombreArchivo, $codPago)
  {
    $statement = Conexion::conn()->prepare("UPDATE $tabla SET ComprobantePago=:ComprobantePago WHERE IdPago=:IdPago");
    $statement->bindParam(":ComprobantePago", $nombreArchivo, PDO::PARAM_STR);
    $statement->bindParam(":IdPago", $codPago, PDO::PARAM_STR);
    if ($statement->execute()) {
      return "ok";
    } else {
      return "error";
    }
  }

  //  Obtener la ruta para descargar el voucher
  public static function mdlDescargarPago($tabla, $codPago)
  {
    $statement = Conexion::conn()->prepare("SELECT tba_pago.ComprobantePago FROM $tabla WHERE tba_pago.IdPago = $codPago");
    $statement->execute();
    return $statement->fetch();
  }

  //  Verificar el uso de un paciente en un pago
  public static function mdlVerificarUsoPaciente($tabla, $codPaciente)
  {
    $statement = Conexion::conn()->prepare("SELECT COUNT(IdPago) AS TotalUso FROM $tabla WHERE IdPaciente = $codPaciente");
    $statement->execute();
    return $statement->fetch();
  }

  //  Mostrar los pagos por tratamiento de cada pacientep
  public static function mdlMostrarListaPacientesTratamiento($tabla)
  {
    $statement = Conexion::conn()->prepare("SELECT
    tba_paciente.IdPaciente, 
    tba_paciente.NombrePaciente, 
    tba_paciente.ApellidoPaciente,
    tba_paciente.DNIPaciente, 
    SUM(tba_pago.TotalPagado) AS TotalCancelado, 
    tba_tratamiento.TotalTratamiento
  FROM
    $tabla
    LEFT JOIN
    tba_pago
    ON 
      tba_paciente.IdPaciente = tba_pago.IdPaciente
    LEFT JOIN
    tba_tratamiento
    ON 
      tba_paciente.IdPaciente = tba_tratamiento.IdPaciente
  WHERE
    tba_tratamiento.TotalTratamiento <> ''
  GROUP BY
    tba_paciente.IdPaciente
  ");
    $statement->execute();
    return $statement->fetchAll();
  }

  //  Crear un nuevo pago al crear la historia clínica
  public static function mdlCrearListaPagos($tabla, $datosCreate)
  {
    $statement = Conexion::conn()->prepare("INSERT INTO $tabla (IdPaciente, IdHistoriaClinica, FechaCreacion, FechaActualizacion) VALUES(:IdPaciente, :IdHistoriaClinica, :FechaCreacion, :FechaActualizacion)");
    $statement->bindParam(":IdPaciente", $datosCreate["IdPaciente"], PDO::PARAM_STR);
    $statement->bindParam(":IdHistoriaClinica", $datosCreate["IdHistoriaClinica"], PDO::PARAM_STR);
    $statement->bindParam(":FechaCreacion", $datosCreate["FechaCreacion"], PDO::PARAM_STR);
    $statement->bindParam(":FechaActualizacion", $datosCreate["FechaActualizacion"], PDO::PARAM_STR);
    if ($statement->execute()) {
      return "ok";
    } else {
      return "error";
    }
  }

  //  Crear un pago a partir de una visita
  public static function mdlCrearPagoVisita($tabla, $datosPago)
  {
    $statement = Conexion::conn()->prepare("INSERT INTO $tabla (IdPaciente, IdHistoriaClinica, TotalPagado, FechaPago, ObservacionPago, FechaCreacion, FechaActualizacion) VALUES(:IdPaciente, :IdHistoriaClinica, :TotalPagado, :FechaPago, :ObservacionPago, :FechaCreacion, :FechaActualizacion)");
    $statement->bindParam(":IdPaciente", $datosPago["IdPaciente"], PDO::PARAM_STR);
    $statement->bindParam(":IdHistoriaClinica", $datosPago["IdHistoriaClinica"], PDO::PARAM_STR);
    $statement->bindParam(":TotalPagado", $datosPago["TotalPagado"], PDO::PARAM_STR);
    $statement->bindParam(":FechaPago", $datosPago["FechaPago"], PDO::PARAM_STR);
    $statement->bindParam(":ObservacionPago", $datosPago["ObservacionPago"], PDO::PARAM_STR);
    $statement->bindParam(":FechaCreacion", $datosPago["FechaCreacion"], PDO::PARAM_STR);
    $statement->bindParam(":FechaActualizacion", $datosPago["FechaActualizacion"], PDO::PARAM_STR);
    if ($statement->execute()) {
      return "ok";
    } else {
      return "error";
    }
  }
}

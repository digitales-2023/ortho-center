<?php
require_once "conexion.php";

/**
 * ModelPagos — Fusionado ortho-center (A) + dentavitalis (B)
 *
 * Cambios respecto a ortho-center original:
 *  - mdlMostrarTodosLosPagos: usa NumeroIdentificacion (antes DNIPaciente) + agrega ObservacionPago
 *  - mdlMostrarDatosEditar: usa NumeroIdentificacion (antes DNIPaciente)
 *  - mdlMostrarPagosPorPaciente: versión B (más limpia, con JOIN tipodepago y sin JOIN visita)
 *  - [NUEVO B] mdlMostrarTiposDePago: lista los tipos de pago de tba_tipodepago
 *  - [NUEVO B] mdlUpdatePago: actualiza un pago existente
 *  - [NUEVO B] mdlMostrarTotalPorPaciente: totales por paciente con JOIN a tratamiento e historia
 *  - mdlMostrarListaPacientesTratamiento: de A, usa NumeroIdentificacion
 *  - mdlCrearListaPagos: de A (INSERT mínimo al crear historia)
 *  - mdlCrearPagoVisita: de A (INSERT desde flujo de visitas)
 */
class ModelPagos
{
  // ── LISTAR ──────────────────────────────────────────────────────────────

  // Mostrar todos los pagos realizados con datos de paciente y tipo de pago
  public static function mdlMostrarTodosLosPagos($tabla)
  {
    $statement = Conexion::conn()->prepare("SELECT tba_pago.IdPago, tba_pago.IdPaciente, tba_pago.IdTipoPago, tba_pago.TotalPago, tba_pago.ObservacionPago, tba_pago.FechaPago, tba_tipodepago.DescripcionTipo, tba_paciente.NombrePaciente, tba_paciente.ApellidoPaciente, tba_paciente.NumeroIdentificacion FROM $tabla INNER JOIN tba_tipodepago ON tba_pago.IdTipoPago = tba_tipodepago.IdTipoPago INNER JOIN tba_paciente ON tba_pago.IdPaciente = tba_paciente.IdPaciente ORDER BY IdPago DESC");
    $statement->execute();
    return $statement->fetchAll();
  }

  // [NUEVO B] Mostrar los tipos de pago disponibles
  public static function mdlMostrarTiposDePago($tabla)
  {
    $statement = Conexion::conn()->prepare("SELECT tba_tipodepago.IdTipoPago, tba_tipodepago.DescripcionTipo FROM $tabla");
    $statement->execute();
    return $statement->fetchAll();
  }

  // Mostrar los datos de un pago para editar
  public static function mdlMostrarDatosEditar($tabla, $codPagoEditar)
  {
    $statement = Conexion::conn()->prepare("SELECT tba_pago.IdPago, tba_pago.IdPaciente, tba_pago.IdTipoPago, tba_pago.TotalPago, tba_pago.FechaPago, tba_pago.ObservacionPago, tba_tipodepago.DescripcionTipo, tba_paciente.NombrePaciente, tba_paciente.ApellidoPaciente, tba_paciente.NumeroIdentificacion FROM $tabla INNER JOIN tba_tipodepago ON tba_pago.IdTipoPago = tba_tipodepago.IdTipoPago INNER JOIN tba_paciente ON tba_pago.IdPaciente = tba_paciente.IdPaciente WHERE tba_pago.IdPago = $codPagoEditar");
    $statement->execute();
    return $statement->fetch();
  }

  // Mostrar la lista de pagos de un paciente con tipo de pago
  public static function mdlMostrarPagosPorPaciente($tabla, $codPaciente)
  {
    $statement = Conexion::conn()->prepare("SELECT tba_pago.IdPago, tba_pago.IdTipoPago, tba_pago.TotalPago, tba_pago.FechaPago, tba_pago.ObservacionPago, tba_tipodepago.DescripcionTipo FROM $tabla INNER JOIN tba_tipodepago ON tba_pago.IdTipoPago = tba_tipodepago.IdTipoPago INNER JOIN tba_paciente ON tba_pago.IdPaciente = tba_paciente.IdPaciente WHERE tba_pago.IdPaciente = $codPaciente ORDER BY IdPago DESC");
    $statement->execute();
    return $statement->fetchAll();
  }

  // Mostrar la lista de pacientes con totales de pagos (de A, usa NumeroIdentificacion)
  public static function mdlMostrarListaPacientesTratamiento($tabla)
  {
    $statement = Conexion::conn()->prepare("SELECT
    tba_paciente.IdPaciente,
    tba_paciente.NombrePaciente,
    tba_paciente.ApellidoPaciente,
    tba_paciente.NumeroIdentificacion,
    SUM(tba_pago.TotalPagado) AS TotalCancelado,
    tba_tratamiento.TotalTratamiento
  FROM $tabla
    LEFT JOIN tba_pago ON tba_paciente.IdPaciente = tba_pago.IdPaciente
    LEFT JOIN tba_tratamiento ON tba_paciente.IdPaciente = tba_tratamiento.IdPaciente
  WHERE tba_tratamiento.TotalTratamiento <> ''
  GROUP BY tba_paciente.IdPaciente");
    $statement->execute();
    return $statement->fetchAll();
  }

  // [NUEVO B] Mostrar totales de tratamiento por paciente (query B, más detallado)
  public static function mdlMostrarTotalPorPaciente($tabla)
  {
    $statement = Conexion::conn()->prepare("SELECT
    tba_paciente.IdPaciente,
    tba_paciente.NombrePaciente,
    tba_paciente.ApellidoPaciente,
    tba_paciente.NumeroIdentificacion,
    tba_tratamiento.IdHistoriaClinica,
    MAX(tba_tratamiento.TotalTratamiento) AS TotalTratamiento,
    MAX(tba_tratamiento.TotalPagado) AS TotalPagado
  FROM $tabla
    INNER JOIN tba_paciente ON tba_pago.IdPaciente = tba_paciente.IdPaciente
    LEFT JOIN tba_historiaclinica ON tba_paciente.IdPaciente = tba_historiaclinica.IdPaciente
    LEFT JOIN tba_tratamiento ON tba_historiaclinica.IdHistoriaClinica = tba_tratamiento.IdHistoriaClinica
  GROUP BY tba_paciente.IdPaciente, tba_paciente.NombrePaciente, tba_paciente.ApellidoPaciente, tba_paciente.NumeroIdentificacion, tba_tratamiento.IdHistoriaClinica");
    $statement->execute();
    return $statement->fetchAll();
  }

  // Obtener el último pago registrado (para nombre único de comprobante)
  public static function mdlObtenerUltimoPagoRealizado($tabla)
  {
    $statement = Conexion::conn()->prepare("SELECT MAX(IdPago) as Id FROM $tabla");
    $statement->execute();
    return $statement->fetch();
  }

  // Obtener la ruta del comprobante para descarga
  public static function mdlDescargarPago($tabla, $codPago)
  {
    $statement = Conexion::conn()->prepare("SELECT tba_pago.ComprobantePago FROM $tabla WHERE tba_pago.IdPago = $codPago");
    $statement->execute();
    return $statement->fetch();
  }

  // Verificar uso de un paciente en pagos
  public static function mdlVerificarUsoPaciente($tabla, $codPaciente)
  {
    $statement = Conexion::conn()->prepare("SELECT COUNT(IdPago) AS TotalUso FROM $tabla WHERE IdPaciente = $codPaciente");
    $statement->execute();
    return $statement->fetch();
  }

  // ── CREAR ────────────────────────────────────────────────────────────────

  // Ingresar un nuevo pago
  public static function mdlIngresarNuevoPago($tabla, $datosCreate)
  {
    $statement = Conexion::conn()->prepare("INSERT INTO $tabla (IdPaciente, IdTipoPago, TotalPago, FechaPago, ObservacionPago, FechaCreacion, FechaActualizacion) VALUES(:IdPaciente, :IdTipoPago, :TotalPago, :FechaPago, :ObservacionPago, :FechaCreacion, :FechaActualizacion)");
    $statement->bindParam(":IdPaciente",         $datosCreate["IdPaciente"],         PDO::PARAM_STR);
    $statement->bindParam(":IdTipoPago",         $datosCreate["IdTipoPago"],         PDO::PARAM_STR);
    $statement->bindParam(":TotalPago",          $datosCreate["TotalPago"],          PDO::PARAM_STR);
    $statement->bindParam(":FechaPago",          $datosCreate["FechaPago"],          PDO::PARAM_STR);
    $statement->bindParam(":ObservacionPago",    $datosCreate["ObservacionPago"],    PDO::PARAM_STR);
    $statement->bindParam(":FechaCreacion",      $datosCreate["FechaCreacion"],      PDO::PARAM_STR);
    $statement->bindParam(":FechaActualizacion", $datosCreate["FechaActualizacion"], PDO::PARAM_STR);
    return $statement->execute() ? "ok" : "error";
  }

  // Crear registro inicial de pago al crear una historia clínica (de A)
  public static function mdlCrearListaPagos($tabla, $datosCreate)
  {
    $statement = Conexion::conn()->prepare("INSERT INTO $tabla (IdPaciente, IdHistoriaClinica, FechaCreacion, FechaActualizacion) VALUES(:IdPaciente, :IdHistoriaClinica, :FechaCreacion, :FechaActualizacion)");
    $statement->bindParam(":IdPaciente",         $datosCreate["IdPaciente"],         PDO::PARAM_STR);
    $statement->bindParam(":IdHistoriaClinica",  $datosCreate["IdHistoriaClinica"],  PDO::PARAM_STR);
    $statement->bindParam(":FechaCreacion",      $datosCreate["FechaCreacion"],      PDO::PARAM_STR);
    $statement->bindParam(":FechaActualizacion", $datosCreate["FechaActualizacion"], PDO::PARAM_STR);
    return $statement->execute() ? "ok" : "error";
  }

  // Crear un pago desde el flujo de visitas (de A)
  public static function mdlCrearPagoVisita($tabla, $datosPago)
  {
    $statement = Conexion::conn()->prepare("INSERT INTO $tabla (IdPaciente, IdHistoriaClinica, TotalPagado, FechaPago, ObservacionPago, FechaCreacion, FechaActualizacion) VALUES(:IdPaciente, :IdHistoriaClinica, :TotalPagado, :FechaPago, :ObservacionPago, :FechaCreacion, :FechaActualizacion)");
    $statement->bindParam(":IdPaciente",         $datosPago["IdPaciente"],         PDO::PARAM_STR);
    $statement->bindParam(":IdHistoriaClinica",  $datosPago["IdHistoriaClinica"],  PDO::PARAM_STR);
    $statement->bindParam(":TotalPagado",        $datosPago["TotalPagado"],        PDO::PARAM_STR);
    $statement->bindParam(":FechaPago",          $datosPago["FechaPago"],          PDO::PARAM_STR);
    $statement->bindParam(":ObservacionPago",    $datosPago["ObservacionPago"],    PDO::PARAM_STR);
    $statement->bindParam(":FechaCreacion",      $datosPago["FechaCreacion"],      PDO::PARAM_STR);
    $statement->bindParam(":FechaActualizacion", $datosPago["FechaActualizacion"], PDO::PARAM_STR);
    return $statement->execute() ? "ok" : "error";
  }

  // ── EDITAR ───────────────────────────────────────────────────────────────

  // [NUEVO B] Actualizar los datos de un pago existente
  public static function mdlUpdatePago($tabla, $datosUpdate)
  {
    $statement = Conexion::conn()->prepare("UPDATE $tabla SET IdPaciente=:IdPaciente, IdTipoPago=:IdTipoPago, TotalPago=:TotalPago, ObservacionPago=:ObservacionPago, FechaPago=:FechaPago, FechaActualizacion=:FechaActualizacion WHERE IdPago=:IdPago");
    $statement->bindParam(":IdPaciente",         $datosUpdate["IdPaciente"],         PDO::PARAM_STR);
    $statement->bindParam(":IdTipoPago",         $datosUpdate["IdTipoPago"],         PDO::PARAM_STR);
    $statement->bindParam(":TotalPago",          $datosUpdate["TotalPago"],          PDO::PARAM_STR);
    $statement->bindParam(":ObservacionPago",    $datosUpdate["ObservacionPago"],    PDO::PARAM_STR);
    $statement->bindParam(":FechaPago",          $datosUpdate["FechaPago"],          PDO::PARAM_STR);
    $statement->bindParam(":FechaActualizacion", $datosUpdate["FechaActualizacion"], PDO::PARAM_STR);
    $statement->bindParam(":IdPago",             $datosUpdate["IdPago"],             PDO::PARAM_STR);
    return $statement->execute() ? "ok" : "error";
  }

  // Actualizar la ruta del comprobante de pago
  public static function mdlActualizarRuta($tabla, $nombreArchivo, $codPago)
  {
    $statement = Conexion::conn()->prepare("UPDATE $tabla SET ComprobantePago=:ComprobantePago WHERE IdPago=:IdPago");
    $statement->bindParam(":ComprobantePago", $nombreArchivo, PDO::PARAM_STR);
    $statement->bindParam(":IdPago",          $codPago,       PDO::PARAM_STR);
    return $statement->execute() ? "ok" : "error";
  }

  // ── ELIMINAR ─────────────────────────────────────────────────────────────

  // Eliminar un pago
  public static function mdlEliminarPago($tabla, $codPago)
  {
    $statement = Conexion::conn()->prepare("DELETE FROM $tabla WHERE IdPago = $codPago");
    return $statement->execute() ? "ok" : "error";
  }
}

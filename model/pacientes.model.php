<?php

require_once "conexion.php";

class ModelPacientes
{
  //  Mostrar todos los pacientes modulo pacientes
  public static function mdlMostrarPacientes($tabla)
  {
    $statement = Conexion::conn()->prepare("SELECT tba_paciente.IdPaciente, tba_paciente.NombrePaciente, tba_paciente.ApellidoPaciente, tba_paciente.DNIPaciente, tba_paciente.CelularPaciente FROM $tabla ORDER BY IdPaciente DESC");
    $statement -> execute();
    return $statement -> fetchAll();
  }

  //  Crear un nuevo paciente por modulo de pacientes
  public static function mdlCrearPaciente($tabla, $datosCreate)
  {
    $statement = Conexion::conn()->prepare("INSERT INTO $tabla (NombrePaciente, ApellidoPaciente, DNIPaciente, CelularPaciente, UsuarioCreado, UsuarioActualiza, FechaCreacion, FechaActualizacion) VALUES(:NombrePaciente, :ApellidoPaciente, :DNIPaciente, :CelularPaciente, :UsuarioCreado, :UsuarioActualiza, :FechaCreacion, :FechaActualizacion)");
    $statement -> bindParam(":NombrePaciente", $datosCreate["NombrePaciente"], PDO::PARAM_STR);
    $statement -> bindParam(":ApellidoPaciente", $datosCreate["ApellidoPaciente"], PDO::PARAM_STR);
    $statement -> bindParam(":DNIPaciente", $datosCreate["DNIPaciente"], PDO::PARAM_STR);
    $statement -> bindParam(":CelularPaciente", $datosCreate["CelularPaciente"], PDO::PARAM_STR);
    $statement -> bindParam(":UsuarioCreado", $datosCreate["UsuarioCreado"], PDO::PARAM_STR);
    $statement -> bindParam(":UsuarioActualiza", $datosCreate["UsuarioActualiza"], PDO::PARAM_STR);
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

  //  Mostrar los datos para editar un paciente
  public static function mdlMostrarDatosEditar($tabla, $codPaciente)
  {
    $statement = Conexion::conn()->prepare("SELECT tba_paciente.IdPaciente, tba_paciente.NombrePaciente, tba_paciente.ApellidoPaciente, tba_paciente.DNIPaciente, tba_paciente.CelularPaciente FROM $tabla WHERE tba_paciente.IdPaciente = $codPaciente");
    $statement -> execute();
    return $statement -> fetch();
  }

  //  Actualizar datos del paciente en modulo pacientes
  public static function mdlUpdatePaciente($tabla, $datosUpdate)
  {
    $statement = Conexion::conn()->prepare("UPDATE $tabla SET NombrePaciente=:NombrePaciente, ApellidoPaciente=:ApellidoPaciente, DNIPaciente=:DNIPaciente, CelularPaciente=:CelularPaciente, FechaActualizacion=:FechaActualizacion WHERE IdPaciente=:IdPaciente");
    $statement -> bindParam(":NombrePaciente", $datosUpdate["NombrePaciente"], PDO::PARAM_STR);
    $statement -> bindParam(":ApellidoPaciente", $datosUpdate["ApellidoPaciente"], PDO::PARAM_STR);
    $statement -> bindParam(":DNIPaciente", $datosUpdate["DNIPaciente"], PDO::PARAM_STR);
    $statement -> bindParam(":CelularPaciente", $datosUpdate["CelularPaciente"], PDO::PARAM_STR);
    $statement -> bindParam(":FechaActualizacion", $datosUpdate["FechaActualizacion"], PDO::PARAM_STR);
    $statement -> bindParam(":IdPaciente", $datosUpdate["IdPaciente"], PDO::PARAM_STR);
    if($statement -> execute())
    {
      return "ok";
    }
    else
    {
      return "error";
    }
  }

  //  Eliminar un paciente
  public static function mdlEliminarPaciente($tabla, $codPaciente)
  {
    $statement = Conexion::conn()->prepare("DELETE FROM $tabla WHERE IdPaciente = $codPaciente");
    if ($statement -> execute())
    {
      return "ok";
    }
    else
    {
      return "error";
    }
  }

  //  Update de los datos del paciente en la historia clínica
  public static function mdlUpdateDatosPaciente($tabla, $datosUpdatePaciente)
  {
    $statement = Conexion::conn()->prepare("UPDATE $tabla SET SexoPaciente=:SexoPaciente, EdadPaciente=:EdadPaciente, OcupacionPaciente=:OcupacionPaciente, LugarProcedencia=:LugarProcedencia, DomicilioPaciente=:DomicilioPaciente, CelularPaciente=:CelularPaciente, UsuarioActualiza=:UsuarioActualiza, FechaActualizacion=:FechaActualizacion WHERE IdPaciente=:IdPaciente");

    $statement -> bindParam(":IdPaciente", $datosUpdatePaciente["IdPaciente"], PDO::PARAM_STR);
    $statement -> bindParam(":SexoPaciente", $datosUpdatePaciente["SexoPaciente"], PDO::PARAM_STR);
    $statement -> bindParam(":EdadPaciente", $datosUpdatePaciente["EdadPaciente"], PDO::PARAM_STR);
    $statement -> bindParam(":OcupacionPaciente", $datosUpdatePaciente["OcupacionPaciente"], PDO::PARAM_STR);
    $statement -> bindParam(":LugarProcedencia", $datosUpdatePaciente["LugarProcedencia"], PDO::PARAM_STR);
    $statement -> bindParam(":DomicilioPaciente", $datosUpdatePaciente["DomicilioPaciente"], PDO::PARAM_STR);
    $statement -> bindParam(":CelularPaciente", $datosUpdatePaciente["CelularPaciente"], PDO::PARAM_STR);
    $statement -> bindParam(":UsuarioActualiza", $datosUpdatePaciente["UsuarioActualiza"], PDO::PARAM_STR);
    $statement -> bindParam(":FechaActualizacion", $datosUpdatePaciente["FechaActualizacion"], PDO::PARAM_STR);
    if($statement -> execute())
    {
      return "ok";
    }
    else
    {
      return "error";
    }
  }

  //  Mostrar los datos del paciente para la historia clínica
  public static function mdlMostrarDatosHistoria($tabla, $codPaciente)
  {
    $statement = Conexion::conn()->prepare("SELECT tba_paciente.IdPaciente, tba_paciente.NombrePaciente, tba_paciente.ApellidoPaciente, tba_paciente.DNIPaciente, tba_paciente.SexoPaciente, tba_paciente.EdadPaciente, tba_paciente.CelularPaciente, tba_paciente.DomicilioPaciente, tba_paciente.LugarProcedencia, tba_paciente.OcupacionPaciente FROM $tabla WHERE tba_paciente.IdPaciente = $codPaciente");
    $statement -> execute();
    return $statement -> fetch();
  }
  
  //  Mostrar los datos del paciente al ver el plan de tratamiento
  public static function mdlMostrarDatosTratamiento($tabla, $codPaciente)
  {
    $statement = Conexion::conn()->prepare("SELECT
    tba_paciente.IdPaciente, 
    tba_paciente.NombrePaciente, 
    tba_paciente.ApellidoPaciente, 
    tba_paciente.DNIPaciente, 
    tba_paciente.EdadPaciente, 
    tba_paciente.CelularPaciente, 
    tba_tratamiento.TotalTratamiento
  FROM
    $tabla
    INNER JOIN
    tba_tratamiento
    ON 
      tba_paciente.IdPaciente = tba_tratamiento.IdPaciente
  WHERE
    tba_paciente.IdPaciente = $codPaciente");
    $statement -> execute();
    return $statement -> fetch();
  }

  //  Buscar al paciente por el número de DNI
  public static function mdlBuscarPacienteDNI($tabla, $numeroDNI)
  {
    $statement = Conexion::conn()->prepare("SELECT tba_paciente.IdPaciente, tba_paciente.NombrePaciente, tba_paciente.ApellidoPaciente, tba_paciente.DNIPaciente, tba_paciente.CelularPaciente FROM $tabla WHERE tba_paciente.DNIPaciente = $numeroDNI");
    $statement -> execute();
    return $statement -> fetch();
  }

  //  Mostrar los datos del paciente basicos 
  public static function mdlMostrarDatosBasicos($tabla, $codPaciente)
  {
    $statement = Conexion::conn()->prepare("SELECT tba_paciente.IdPaciente, tba_paciente.NombrePaciente, tba_paciente.ApellidoPaciente, tba_paciente.DNIPaciente, tba_paciente.CelularPaciente FROM $tabla WHERE tba_paciente.IdPaciente = $codPaciente");
    $statement -> execute();
    return $statement -> fetch();
  }

  //  Obtener los datos de la historia clinica para imprimir en pdf
  public static function mdlObtenerDatosHistoriaPdf($tabla, $codHistoria)
  {
    $statement = Conexion::conn()->prepare("SELECT
    tba_paciente.NombrePaciente, 
    tba_paciente.ApellidoPaciente, 
    tba_paciente.DNIPaciente, 
    tba_paciente.SexoPaciente, 
    tba_paciente.EdadPaciente, 
    tba_paciente.CelularPaciente, 
    tba_paciente.DomicilioPaciente, 
    tba_paciente.LugarProcedencia, 
    tba_paciente.OcupacionPaciente, 
    tba_historiaclinica.MotivoConsulta, 
    tba_historiaclinica.CheckAlergias, 
    tba_historiaclinica.DescripcionAlergias, 
    tba_historiaclinica.CheckHepatitis, 
    tba_historiaclinica.DescripcionHepatitis, 
    tba_historiaclinica.CheckDiabetes, 
    tba_historiaclinica.DescripcionDiabetes, 
    tba_historiaclinica.CheckHipertension, 
    tba_historiaclinica.DescripcionHipertension, 
    tba_historiaclinica.CheckHemorragias, 
    tba_historiaclinica.DescripcionHemorragias, 
    tba_historiaclinica.CheckRenal, 
    tba_historiaclinica.DescripcionRenal, 
    tba_historiaclinica.CheckEndocrina, 
    tba_historiaclinica.DescripcionEndocrina, 
    tba_historiaclinica.CheckOtros, 
    tba_historiaclinica.DescripcionOtros, 
    tba_historiaclinica.CheckReaccion, 
    tba_historiaclinica.DescripcionReaccion, 
    tba_historiaclinica.CheckExodoncia, 
    tba_historiaclinica.DescripcionExodoncia, 
    tba_historiaclinica.CheckMedicamento, 
    tba_historiaclinica.DescripcionMedicamento, 
    tba_historiaclinica.CheckGestacion, 
    tba_historiaclinica.DescripcionGestacion,
    tba_historiaclinica.RutaOdontograma
  FROM
    $tabla
    INNER JOIN
    tba_historiaclinica
    ON 
      tba_paciente.IdPaciente = tba_historiaclinica.IdPaciente
  WHERE
    tba_historiaclinica.IdHistoriaClinica = $codHistoria");
    $statement -> execute();
    return $statement -> fetch();
  }

  //  Mostrar datos básicos del paciente para imprimir
  public static function mdlMostrarDatosImprimir($tabla, $codPaciente)
  {
    $statement = Conexion::conn()->prepare("SELECT tba_paciente.NombrePaciente, tba_paciente.ApellidoPaciente, tba_paciente.DNIPaciente, tba_paciente.EdadPaciente, tba_paciente.SexoPaciente, tba_paciente.CelularPaciente FROM $tabla WHERE tba_paciente.IdPaciente = $codPaciente");
    $statement -> execute();
    return $statement -> fetch();
  }

  //  Verificar si un paciente está registrado o no, según su DNI
  public static function mdlVerificarPacienteDNI($tabla, $numeroDNI)
  {
    $statement = Conexion::conn()->prepare("SELECT COUNT(*) AS Contador FROM $tabla WHERE tba_paciente.DNIPaciente = $numeroDNI");
    $statement -> execute();
    return $statement -> fetch();
  }

  //  Obtener los nombres del paciente
  public static function mdlObtenerDNIPaciente($tabla, $codHistoria)
  {
    $statement = Conexion::conn()->prepare("SELECT tba_paciente.DNIPaciente, tba_paciente.IdPaciente FROM $tabla INNER JOIN tba_historiaclinica ON  tba_paciente.IdPaciente = tba_historiaclinica.IdPaciente WHERE tba_historiaclinica.IdHistoriaClinica = $codHistoria");
    $statement -> execute();
    return $statement -> fetch();
  }

  //  Mostrar la cantidad de pacientes creados
  public static function mdlContarPacientes($tabla)
  {
    $statement = Conexion::conn()->prepare("SELECT COUNT(IdPaciente) AS TotalPacientes FROM $tabla");
    $statement -> execute();
    return $statement -> fetch();
  }
}
<?php

require_once "conexion.php";

class ModelHistorias
{
  //  Mostrar todas las historias clinicas
  public static function mdlMostrarAllHistorias($tabla)
  {
    $statement = Conexion::conn()->prepare("SELECT tba_historiaclinica.IdHistoriaClinica, tba_historiaclinica.IdPaciente, tba_historiaclinica.IdUsuario, tba_historiaclinica.FechaActualiza, tba_paciente.NombrePaciente, tba_paciente.ApellidoPaciente, tba_paciente.DNIPaciente, tba_usuario.NombreUsuario FROM $tabla INNER JOIN tba_paciente ON tba_historiaclinica.IdPaciente = tba_paciente.IdPaciente INNER JOIN tba_usuario ON tba_historiaclinica.IdUsuario = tba_usuario.IdUsuario ORDER BY IdHistoriaClinica DESC");
    $statement -> execute();
    return $statement -> fetchAll();
  }

  //  Crear una nueva historia
  public static function mdlCrearHistoriaClinica($tabla, $datosCreateHistoria)
  {
    $statement = Conexion::conn()->prepare("INSERT INTO $tabla (IdPaciente, IdUsuario, MotivoConsulta, CheckAlergias, DescripcionAlergias, CheckHepatitis, DescripcionHepatitis, CheckDiabetes, DescripcionDiabetes, CheckHipertension, DescripcionHipertension, CheckHemorragias, DescripcionHemorragias, CheckRenal, DescripcionRenal, CheckEndocrina, DescripcionEndocrina, CheckOtros, DescripcionOtros, CheckReaccion, DescripcionReaccion, CheckExodoncia, DescripcionExodoncia, CheckMedicamento, DescripcionMedicamento, CheckGestacion, DescripcionGestacion, UsuarioCreado, UsuarioActualizado, FechaCreado, FechaActualiza) VALUES(:IdPaciente, :IdUsuario, :MotivoConsulta, :CheckAlergias, :DescripcionAlergias, :CheckHepatitis, :DescripcionHepatitis, :CheckDiabetes, :DescripcionDiabetes, :CheckHipertension, :DescripcionHipertension, :CheckHemorragias, :DescripcionHemorragias, :CheckRenal, :DescripcionRenal, :CheckEndocrina, :DescripcionEndocrina, :CheckOtros, :DescripcionOtros, :CheckReaccion, :DescripcionReaccion, :CheckExodoncia, :DescripcionExodoncia, :CheckMedicamento, :DescripcionMedicamento, :CheckGestacion, :DescripcionGestacion, :UsuarioCreado, :UsuarioActualizado, :FechaCreado, :FechaActualiza)");
    $statement -> bindParam(":IdPaciente", $datosCreateHistoria["IdPaciente"], PDO::PARAM_STR);
    $statement -> bindParam(":IdUsuario", $datosCreateHistoria["IdUsuario"], PDO::PARAM_STR);
    $statement -> bindParam(":MotivoConsulta", $datosCreateHistoria["MotivoConsulta"], PDO::PARAM_STR);
    $statement -> bindParam(":CheckAlergias", $datosCreateHistoria["CheckAlergias"], PDO::PARAM_STR);
    $statement -> bindParam(":DescripcionAlergias", $datosCreateHistoria["DescripcionAlergias"], PDO::PARAM_STR);
    $statement -> bindParam(":CheckHepatitis", $datosCreateHistoria["CheckHepatitis"], PDO::PARAM_STR);
    $statement -> bindParam(":DescripcionHepatitis", $datosCreateHistoria["DescripcionHepatitis"], PDO::PARAM_STR);
    $statement -> bindParam(":CheckDiabetes", $datosCreateHistoria["CheckDiabetes"], PDO::PARAM_STR);
    $statement -> bindParam(":DescripcionDiabetes", $datosCreateHistoria["DescripcionDiabetes"], PDO::PARAM_STR);
    $statement -> bindParam(":CheckHipertension", $datosCreateHistoria["CheckHipertension"], PDO::PARAM_STR);
    $statement -> bindParam(":DescripcionHipertension", $datosCreateHistoria["DescripcionHipertension"], PDO::PARAM_STR);
    $statement -> bindParam(":CheckHemorragias", $datosCreateHistoria["CheckHemorragias"], PDO::PARAM_STR);
    $statement -> bindParam(":DescripcionHemorragias", $datosCreateHistoria["DescripcionHemorragias"], PDO::PARAM_STR);
    $statement -> bindParam(":CheckRenal", $datosCreateHistoria["CheckRenal"], PDO::PARAM_STR);
    $statement -> bindParam(":DescripcionRenal", $datosCreateHistoria["DescripcionRenal"], PDO::PARAM_STR);
    $statement -> bindParam(":CheckEndocrina", $datosCreateHistoria["CheckEndocrina"], PDO::PARAM_STR);
    $statement -> bindParam(":DescripcionEndocrina", $datosCreateHistoria["DescripcionEndocrina"], PDO::PARAM_STR);
    $statement -> bindParam(":CheckOtros", $datosCreateHistoria["CheckOtros"], PDO::PARAM_STR);
    $statement -> bindParam(":DescripcionOtros", $datosCreateHistoria["DescripcionOtros"], PDO::PARAM_STR);
    $statement -> bindParam(":CheckReaccion", $datosCreateHistoria["CheckReaccion"], PDO::PARAM_STR);
    $statement -> bindParam(":DescripcionReaccion", $datosCreateHistoria["DescripcionReaccion"], PDO::PARAM_STR);
    $statement -> bindParam(":CheckExodoncia", $datosCreateHistoria["CheckExodoncia"], PDO::PARAM_STR);
    $statement -> bindParam(":DescripcionExodoncia", $datosCreateHistoria["DescripcionExodoncia"], PDO::PARAM_STR);
    $statement -> bindParam(":CheckMedicamento", $datosCreateHistoria["CheckMedicamento"], PDO::PARAM_STR);
    $statement -> bindParam(":DescripcionMedicamento", $datosCreateHistoria["DescripcionMedicamento"], PDO::PARAM_STR);
    $statement -> bindParam(":CheckGestacion", $datosCreateHistoria["CheckGestacion"], PDO::PARAM_STR);
    $statement -> bindParam(":DescripcionGestacion", $datosCreateHistoria["DescripcionGestacion"], PDO::PARAM_STR);
    $statement -> bindParam(":UsuarioCreado", $datosCreateHistoria["UsuarioCreado"], PDO::PARAM_STR);
    $statement -> bindParam(":UsuarioActualizado", $datosCreateHistoria["UsuarioActualizado"], PDO::PARAM_STR);
    $statement -> bindParam(":FechaCreado", $datosCreateHistoria["FechaCreado"], PDO::PARAM_STR);
    $statement -> bindParam(":FechaActualiza", $datosCreateHistoria["FechaActualiza"], PDO::PARAM_STR);
    
    if($statement -> execute())
    {
      return "ok";
    }
    else
    {
      return "error";
    }
  }

  //  Obtener la última historia clínica creada
  public static function mdlObtenerUltimaHistoria($tabla)
  {
    $statement = Conexion::conn()->prepare("SELECT MAX(IdHistoriaClinica) as Id FROM $tabla");
    $statement -> execute();
    return $statement -> fetch();
  }

  //  Mostrar la cabecera de la historia
  public static function mdlMostrarCabeceraHistoria($tabla, $codHistoria)
  {
    $statement = Conexion::conn()->prepare("SELECT tba_historiaclinica.IdHistoriaClinica, tba_historiaclinica.MotivoConsulta, tba_historiaclinica.CheckAlergias, tba_historiaclinica.DescripcionAlergias, tba_historiaclinica.CheckHepatitis, tba_historiaclinica.DescripcionHepatitis, tba_historiaclinica.CheckDiabetes, tba_historiaclinica.DescripcionDiabetes, tba_historiaclinica.CheckHipertension, tba_historiaclinica.DescripcionHipertension, tba_historiaclinica.CheckHemorragias, tba_historiaclinica.DescripcionHemorragias, tba_historiaclinica.CheckRenal, tba_historiaclinica.DescripcionRenal, tba_historiaclinica.CheckEndocrina, tba_historiaclinica.DescripcionEndocrina, tba_historiaclinica.CheckOtros, tba_historiaclinica.DescripcionOtros, tba_historiaclinica.CheckReaccion, tba_historiaclinica.DescripcionReaccion, tba_historiaclinica.CheckExodoncia, tba_historiaclinica.DescripcionExodoncia, tba_historiaclinica.CheckMedicamento, tba_historiaclinica.DescripcionMedicamento, tba_historiaclinica.CheckGestacion, tba_historiaclinica.DescripcionGestacion FROM $tabla WHERE tba_historiaclinica.IdHistoriaClinica = $codHistoria");
    $statement -> execute();
    return $statement -> fetch();
  }

  //  Update historia clinica
  public static function mdlUpdateHistoriaClinica($tabla, $datosUpdate)
  {
    $statement = Conexion::conn()->prepare("UPDATE $tabla SET MotivoConsulta=:MotivoConsulta, CheckAlergias=:CheckAlergias, DescripcionAlergias=:DescripcionAlergias, CheckHepatitis=:CheckHepatitis, DescripcionHepatitis=:DescripcionHepatitis, CheckDiabetes=:CheckDiabetes, DescripcionDiabetes=:DescripcionDiabetes, CheckHipertension=:CheckHipertension, DescripcionHipertension=:DescripcionHipertension, CheckHemorragias=:CheckHemorragias, DescripcionHemorragias=:DescripcionHemorragias, CheckRenal=:CheckRenal, DescripcionRenal=:DescripcionRenal, CheckEndocrina=:CheckEndocrina, DescripcionEndocrina=:DescripcionEndocrina, CheckOtros=:CheckOtros, DescripcionOtros=:DescripcionOtros, CheckReaccion=:CheckReaccion, DescripcionReaccion=:DescripcionReaccion, CheckExodoncia=:CheckExodoncia, DescripcionExodoncia=:DescripcionExodoncia, CheckMedicamento=:CheckMedicamento, DescripcionMedicamento=:DescripcionMedicamento, CheckGestacion=:CheckGestacion, DescripcionGestacion=:DescripcionGestacion, UsuarioActualizado=:UsuarioActualizado, FechaActualiza=:FechaActualiza WHERE IdPaciente=:IdPaciente");
    $statement -> bindParam(":MotivoConsulta", $datosUpdate["MotivoConsulta"], PDO::PARAM_STR);
    $statement -> bindParam(":CheckAlergias", $datosUpdate["CheckAlergias"], PDO::PARAM_STR);
    $statement -> bindParam(":DescripcionAlergias", $datosUpdate["DescripcionAlergias"], PDO::PARAM_STR);
    $statement -> bindParam(":CheckHepatitis", $datosUpdate["CheckHepatitis"], PDO::PARAM_STR);
    $statement -> bindParam(":DescripcionHepatitis", $datosUpdate["DescripcionHepatitis"], PDO::PARAM_STR);
    $statement -> bindParam(":CheckDiabetes", $datosUpdate["CheckDiabetes"], PDO::PARAM_STR);
    $statement -> bindParam(":DescripcionDiabetes", $datosUpdate["DescripcionDiabetes"], PDO::PARAM_STR);
    $statement -> bindParam(":CheckHipertension", $datosUpdate["CheckHipertension"], PDO::PARAM_STR);
    $statement -> bindParam(":DescripcionHipertension", $datosUpdate["DescripcionHipertension"], PDO::PARAM_STR);
    $statement -> bindParam(":CheckHemorragias", $datosUpdate["CheckHemorragias"], PDO::PARAM_STR);
    $statement -> bindParam(":DescripcionHemorragias", $datosUpdate["DescripcionHemorragias"], PDO::PARAM_STR);
    $statement -> bindParam(":CheckRenal", $datosUpdate["CheckRenal"], PDO::PARAM_STR);
    $statement -> bindParam(":DescripcionRenal", $datosUpdate["DescripcionRenal"], PDO::PARAM_STR);
    $statement -> bindParam(":CheckEndocrina", $datosUpdate["CheckEndocrina"], PDO::PARAM_STR);
    $statement -> bindParam(":DescripcionEndocrina", $datosUpdate["DescripcionEndocrina"], PDO::PARAM_STR);
    $statement -> bindParam(":CheckOtros", $datosUpdate["CheckOtros"], PDO::PARAM_STR);
    $statement -> bindParam(":DescripcionOtros", $datosUpdate["DescripcionOtros"], PDO::PARAM_STR);
    $statement -> bindParam(":CheckReaccion", $datosUpdate["CheckReaccion"], PDO::PARAM_STR);
    $statement -> bindParam(":DescripcionReaccion", $datosUpdate["DescripcionReaccion"], PDO::PARAM_STR);
    $statement -> bindParam(":CheckExodoncia", $datosUpdate["CheckExodoncia"], PDO::PARAM_STR);
    $statement -> bindParam(":DescripcionExodoncia", $datosUpdate["DescripcionExodoncia"], PDO::PARAM_STR);
    $statement -> bindParam(":CheckMedicamento", $datosUpdate["CheckMedicamento"], PDO::PARAM_STR);
    $statement -> bindParam(":DescripcionMedicamento", $datosUpdate["DescripcionMedicamento"], PDO::PARAM_STR);
    $statement -> bindParam(":CheckGestacion", $datosUpdate["CheckGestacion"], PDO::PARAM_STR);
    $statement -> bindParam(":DescripcionGestacion", $datosUpdate["DescripcionGestacion"], PDO::PARAM_STR);
    $statement -> bindParam(":UsuarioActualizado", $datosUpdate["UsuarioActualizado"], PDO::PARAM_STR);
    $statement -> bindParam(":FechaActualiza", $datosUpdate["FechaActualiza"], PDO::PARAM_STR);
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

  //  Buscar Historia por numero de DNI
  public static function mdlBuscarHistoriaDNI($tabla, $numeroDNI)
  {
    $statement = Conexion::conn()->prepare("SELECT COUNT(*) AS Contador FROM $tabla INNER JOIN tba_paciente ON tba_historiaclinica.IdPaciente = tba_paciente.IdPaciente WHERE tba_paciente.DNIPaciente = $numeroDNI");
    $statement -> execute();
    return $statement -> fetch();
  }

  //  Obtener el codigo de la historia por el codigo del paciente
  public static function mdlObtenerCodHistoria($tabla, $codPaciente)
  {
    $statement = Conexion::conn()->prepare("SELECT tba_historiaclinica.IdHistoriaClinica FROM $tabla WHERE tba_historiaclinica.IdPaciente = $codPaciente");
    $statement -> execute();
    return $statement -> fetch();
  }

  //  Actualizar la ruta del odontograma
  public static function mdlActualizarRuta($tabla, $nombreArchivo, $codHistoria)
  {
    $statement = Conexion::conn()->prepare("UPDATE $tabla SET RutaOdontograma=:RutaOdontograma WHERE IdHistoriaClinica=:IdHistoriaClinica");
    $statement -> bindParam(":RutaOdontograma", $nombreArchivo, PDO::PARAM_STR);
    $statement -> bindParam(":IdHistoriaClinica", $codHistoria, PDO::PARAM_STR);
    if($statement -> execute())
    {
      return "ok";
    }
    else
    {
      return "error";
    }
  }

  //  Descargar ruta de odontograma
  public static function mdlDescargarOdontograma($tabla, $codHistoria)
  {
    $statement = Conexion::conn()->prepare("SELECT tba_historiaclinica.RutaOdontograma FROM $tabla WHERE tba_historiaclinica.IdHistoriaClinica = $codHistoria");
    $statement -> execute();
    return $statement -> fetch();
  }

  //  Eliminar detalle de la historia clínica
  public static function mdlEliminarHistoria($tabla, $codHistoria)
  {
    $statement = Conexion::conn()->prepare("DELETE FROM $tabla WHERE IdHistoriaClinica = $codHistoria");
    if($statement -> execute())
    {
      return "ok";
    }
    else
    {
      return "error";
    }
  }

  //  Contar las historias creadas
  public static function mdlContarHistoriasCreadas($tabla)
  {
    $statement = Conexion::conn()->prepare("SELECT COUNT(IdHistoriaClinica) AS TotalHistorias FROM $tabla");
    $statement -> execute();
    return $statement -> fetch();
  }

  //  Verificar el uso de un paciente en una historia clínica
  public static function mdlVerificarUsoPaciente($tabla, $codPaciente)
  {
    $statement = Conexion::conn()->prepare("SELECT COUNT(IdHistoriaClinica) AS TotalUso FROM $tabla WHERE IdPaciente = $codPaciente");
    $statement -> execute();
    return $statement -> fetch();
  }
}
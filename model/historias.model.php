<?php

require_once "conexion.php";

class ModelHistorias
{
  //  Mostrar todas las historias clinicas
  public static function mdlMostrarAllHistorias($tabla)
  {
    $statement = Conexion::conn()->prepare("SELECT tba_historiaclinica.IdHistoriaClinica, tba_historiaclinica.IdPaciente, tba_historiaclinica.IdSocio, tba_historiaclinica.FechaActualiza, tba_paciente.NombrePaciente, tba_paciente.ApellidoPaciente, tba_paciente.DNIPaciente, tba_socio.NombreSocio FROM $tabla INNER JOIN tba_paciente ON tba_historiaclinica.IdPaciente = tba_paciente.IdPaciente INNER JOIN tba_socio ON tba_historiaclinica.IdSocio = tba_socio.IdSocio ORDER BY IdHistoriaClinica DESC");
    $statement -> execute();
    return $statement -> fetchAll();
  }

  //  Crear una nueva historia
  public static function mdlCrearHistoriaClinica($tabla, $datosCreateHistoria)
  {
    $statement = Conexion::conn()->prepare("INSERT INTO $tabla (IdPaciente, IdSocio, AlergiasEncontradas, DatosInformante, MotivoConsulta, TiempoEnfermedad, SignosSintomas, RelatoCronologico, FuncionesBiologicas, AntecedentesFamiliares, AntecedentesPersonales, UsuarioCreado, UsuarioActualizado, FechaCreado, FechaActualiza) VALUES(:IdPaciente, :IdSocio, :AlergiasEncontradas, :DatosInformante, :MotivoConsulta, :TiempoEnfermedad, :SignosSintomas, :RelatoCronologico, :FuncionesBiologicas, :AntecedentesFamiliares, :AntecedentesPersonales, :UsuarioCreado, :UsuarioActualizado, :FechaCreado, :FechaActualiza)");
    $statement -> bindParam(":IdPaciente", $datosCreateHistoria["IdPaciente"], PDO::PARAM_STR);
    $statement -> bindParam(":IdSocio", $datosCreateHistoria["IdSocio"], PDO::PARAM_STR);
    $statement -> bindParam(":AlergiasEncontradas", $datosCreateHistoria["AlergiasEncontradas"], PDO::PARAM_STR);
    $statement -> bindParam(":DatosInformante", $datosCreateHistoria["DatosInformante"], PDO::PARAM_STR);
    $statement -> bindParam(":MotivoConsulta", $datosCreateHistoria["MotivoConsulta"], PDO::PARAM_STR);
    $statement -> bindParam(":TiempoEnfermedad", $datosCreateHistoria["TiempoEnfermedad"], PDO::PARAM_STR);
    $statement -> bindParam(":SignosSintomas", $datosCreateHistoria["SignosSintomas"], PDO::PARAM_STR);
    $statement -> bindParam(":RelatoCronologico", $datosCreateHistoria["RelatoCronologico"], PDO::PARAM_STR);
    $statement -> bindParam(":FuncionesBiologicas", $datosCreateHistoria["FuncionesBiologicas"], PDO::PARAM_STR);
    $statement -> bindParam(":AntecedentesFamiliares", $datosCreateHistoria["AntecedentesFamiliares"], PDO::PARAM_STR);
    $statement -> bindParam(":AntecedentesPersonales", $datosCreateHistoria["AntecedentesPersonales"], PDO::PARAM_STR);
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

  //  Crear detalle de la historia
  public static function mdlCrearDetalleHistoria($tabla, $datosCreateDetalle)
  {
    $statement = Conexion::conn()->prepare("INSERT INTO $tabla (IdHistoriaClinica, IdTratamiento, PresionArterial, Pulso, Temperatura, FrecuenciaCardiaca, FrecuenciaRespiratoria, ExamenOdonto, DiagnosticoPresuntivo, DiagnosticoDefinitivo, Pronostico, TratamientoPaciente, InformacionAlta, UsuarioCreado, UsuarioActualizado, FechaCreado, FechaActualiza) VALUES(:IdHistoriaClinica, :IdTratamiento, :PresionArterial, :Pulso, :Temperatura, :FrecuenciaCardiaca, :FrecuenciaRespiratoria, :ExamenOdonto, :DiagnosticoPresuntivo, :DiagnosticoDefinitivo, :Pronostico, :TratamientoPaciente, :InformacionAlta, :UsuarioCreado, :UsuarioActualizado, :FechaCreado, :FechaActualiza)");
    $statement -> bindParam(":IdHistoriaClinica", $datosCreateDetalle["IdHistoriaClinica"], PDO::PARAM_STR);
    $statement -> bindParam(":IdTratamiento", $datosCreateDetalle["IdTratamiento"], PDO::PARAM_STR);
    $statement -> bindParam(":PresionArterial", $datosCreateDetalle["PresionArterial"], PDO::PARAM_STR);
    $statement -> bindParam(":Pulso", $datosCreateDetalle["Pulso"], PDO::PARAM_STR);
    $statement -> bindParam(":Temperatura", $datosCreateDetalle["Temperatura"], PDO::PARAM_STR);
    $statement -> bindParam(":FrecuenciaCardiaca", $datosCreateDetalle["FrecuenciaCardiaca"], PDO::PARAM_STR);
    $statement -> bindParam(":FrecuenciaRespiratoria", $datosCreateDetalle["FrecuenciaRespiratoria"], PDO::PARAM_STR);
    $statement -> bindParam(":ExamenOdonto", $datosCreateDetalle["ExamenOdonto"], PDO::PARAM_STR);
    $statement -> bindParam(":DiagnosticoPresuntivo", $datosCreateDetalle["DiagnosticoPresuntivo"], PDO::PARAM_STR);
    $statement -> bindParam(":DiagnosticoDefinitivo", $datosCreateDetalle["DiagnosticoDefinitivo"], PDO::PARAM_STR);
    $statement -> bindParam(":Pronostico", $datosCreateDetalle["Pronostico"], PDO::PARAM_STR);
    $statement -> bindParam(":TratamientoPaciente", $datosCreateDetalle["TratamientoPaciente"], PDO::PARAM_STR);
    $statement -> bindParam(":InformacionAlta", $datosCreateDetalle["InformacionAlta"], PDO::PARAM_STR);
    $statement -> bindParam(":UsuarioCreado", $datosCreateDetalle["UsuarioCreado"], PDO::PARAM_STR);
    $statement -> bindParam(":UsuarioActualizado", $datosCreateDetalle["UsuarioActualizado"], PDO::PARAM_STR);
    $statement -> bindParam(":FechaCreado", $datosCreateDetalle["FechaCreado"], PDO::PARAM_STR);
    $statement -> bindParam(":FechaActualiza", $datosCreateDetalle["FechaActualiza"], PDO::PARAM_STR);
    if($statement -> execute())
    {
      return "ok";
    }
    else
    {
      return "error";
    }
  }

  //  Mostrar la cabecera de la historia
  public static function mdlMostrarCabeceraHistoria($tabla, $codHistoria)
  {
    $statement = Conexion::conn()->prepare("SELECT tba_historiaclinica.IdHistoriaClinica, tba_historiaclinica.AlergiasEncontradas, tba_historiaclinica.MotivoConsulta, tba_historiaclinica.DatosInformante, tba_historiaclinica.TiempoEnfermedad, tba_historiaclinica.SignosSintomas, tba_historiaclinica.RelatoCronologico, tba_historiaclinica.FuncionesBiologicas, tba_historiaclinica.AntecedentesFamiliares, tba_historiaclinica.AntecedentesPersonales FROM $tabla WHERE tba_historiaclinica.IdHistoriaClinica = $codHistoria");
    $statement -> execute();
    return $statement -> fetch();
  }

  //  Mostrar el detall de la historia clinica
  public static function mdlMostrarDetalleHistoria($tabla, $codHistoria)
  {
    $statement = Conexion::conn()->prepare("SELECT tba_detallehistoriaclinica.IdTratamiento, tba_detallehistoriaclinica.PresionArterial, tba_detallehistoriaclinica.Pulso, tba_detallehistoriaclinica.Temperatura, tba_detallehistoriaclinica.FrecuenciaCardiaca, tba_detallehistoriaclinica.FrecuenciaRespiratoria, tba_detallehistoriaclinica.ExamenOdonto, tba_detallehistoriaclinica.DiagnosticoPresuntivo, tba_detallehistoriaclinica.DiagnosticoDefinitivo, tba_detallehistoriaclinica.Pronostico, tba_detallehistoriaclinica.TratamientoPaciente, tba_detallehistoriaclinica.InformacionAlta FROM $tabla WHERE tba_detallehistoriaclinica.IdHistoriaClinica = $codHistoria");
    $statement -> execute();
    return $statement -> fetch();
  }

  //  Update historia clinica
  public static function mdlUpdateHistoriaClinica($tabla, $datosUpdate)
  {
    $statement = Conexion::conn()->prepare("UPDATE $tabla SET AlergiasEncontradas=:AlergiasEncontradas, DatosInformante=:DatosInformante, MotivoConsulta=:MotivoConsulta, TiempoEnfermedad=:TiempoEnfermedad, SignosSintomas=:SignosSintomas, RelatoCronologico=:RelatoCronologico, FuncionesBiologicas=:FuncionesBiologicas, AntecedentesFamiliares=:AntecedentesFamiliares, AntecedentesPersonales=:AntecedentesPersonales, UsuarioActualizado=:UsuarioActualizado, FechaActualiza=:FechaActualiza WHERE IdPaciente=:IdPaciente");
    $statement -> bindParam(":IdPaciente", $datosUpdate["IdPaciente"], PDO::PARAM_STR);
    $statement -> bindParam(":AlergiasEncontradas", $datosUpdate["AlergiasEncontradas"], PDO::PARAM_STR);
    $statement -> bindParam(":DatosInformante", $datosUpdate["DatosInformante"], PDO::PARAM_STR);
    $statement -> bindParam(":MotivoConsulta", $datosUpdate["MotivoConsulta"], PDO::PARAM_STR);
    $statement -> bindParam(":TiempoEnfermedad", $datosUpdate["TiempoEnfermedad"], PDO::PARAM_STR);
    $statement -> bindParam(":SignosSintomas", $datosUpdate["SignosSintomas"], PDO::PARAM_STR);
    $statement -> bindParam(":RelatoCronologico", $datosUpdate["RelatoCronologico"], PDO::PARAM_STR);
    $statement -> bindParam(":FuncionesBiologicas", $datosUpdate["FuncionesBiologicas"], PDO::PARAM_STR);
    $statement -> bindParam(":AntecedentesFamiliares", $datosUpdate["AntecedentesFamiliares"], PDO::PARAM_STR);
    $statement -> bindParam(":AntecedentesPersonales", $datosUpdate["AntecedentesPersonales"], PDO::PARAM_STR);
    $statement -> bindParam(":UsuarioActualizado", $datosUpdate["UsuarioActualizado"], PDO::PARAM_STR);
    $statement -> bindParam(":FechaActualiza", $datosUpdate["FechaActualiza"], PDO::PARAM_STR);
    if($statement -> execute())
    {
      return "ok";
    }
    else
    {
      return "error";
    }
  }

  //  Update del detalle de la historia
  public static function mdlUpdateDetalleHistoria($tabla, $datosUpdate)
  {
    $statement = Conexion::conn()->prepare("UPDATE $tabla SET PresionArterial=:PresionArterial, Pulso=:Pulso, Temperatura=:Temperatura, FrecuenciaCardiaca=:FrecuenciaCardiaca, FrecuenciaRespiratoria=:FrecuenciaRespiratoria, ExamenOdonto=:ExamenOdonto, DiagnosticoPresuntivo=:DiagnosticoPresuntivo, DiagnosticoDefinitivo=:DiagnosticoDefinitivo, Pronostico=:Pronostico, TratamientoPaciente=:TratamientoPaciente, InformacionAlta=:InformacionAlta, UsuarioActualizado=:UsuarioActualizado, FechaActualiza=:FechaActualiza WHERE IdHistoriaClinica=:IdHistoriaClinica");
    $statement -> bindParam(":PresionArterial", $datosUpdate["PresionArterial"], PDO::PARAM_STR);
    $statement -> bindParam(":Pulso", $datosUpdate["Pulso"], PDO::PARAM_STR);
    $statement -> bindParam(":Temperatura", $datosUpdate["Temperatura"], PDO::PARAM_STR);
    $statement -> bindParam(":FrecuenciaCardiaca", $datosUpdate["FrecuenciaCardiaca"], PDO::PARAM_STR);
    $statement -> bindParam(":FrecuenciaRespiratoria", $datosUpdate["FrecuenciaRespiratoria"], PDO::PARAM_STR);
    $statement -> bindParam(":ExamenOdonto", $datosUpdate["ExamenOdonto"], PDO::PARAM_STR);
    $statement -> bindParam(":DiagnosticoPresuntivo", $datosUpdate["DiagnosticoPresuntivo"], PDO::PARAM_STR);
    $statement -> bindParam(":DiagnosticoDefinitivo", $datosUpdate["DiagnosticoDefinitivo"], PDO::PARAM_STR);
    $statement -> bindParam(":Pronostico", $datosUpdate["Pronostico"], PDO::PARAM_STR);
    $statement -> bindParam(":TratamientoPaciente", $datosUpdate["TratamientoPaciente"], PDO::PARAM_STR);
    $statement -> bindParam(":InformacionAlta", $datosUpdate["InformacionAlta"], PDO::PARAM_STR);
    $statement -> bindParam(":UsuarioActualizado", $datosUpdate["UsuarioActualizado"], PDO::PARAM_STR);
    $statement -> bindParam(":FechaActualiza", $datosUpdate["FechaActualiza"], PDO::PARAM_STR);
    $statement -> bindParam(":IdHistoriaClinica", $datosUpdate["IdHistoriaClinica"], PDO::PARAM_STR);
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

  //  Verificar el uso de un socio en una historia clinica
  public static function mdlVerificarUsoSocio($tabla, $codSocio)
  {
    $statement = Conexion::conn()->prepare("SELECT COUNT(IdHistoriaClinica) AS TotalUso FROM $tabla WHERE IdSocio = $codSocio");
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
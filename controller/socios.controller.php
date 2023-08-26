<?php
date_default_timezone_set('America/Lima');
class ControllerSocios
{
  //  Mostrar todos los socios creados
  public static function ctrMostrarSocios()
  {
    $tabla = "tba_socio";
    $listaSocios = ModelSocios::mdlMostrarSocios($tabla);
    return $listaSocios;
  }

  //  Mostrar los tipos de socio
  public static function ctrMostrarTiposSocio()
  {
    $tabla =  "tba_tiposocio";
    $listaTiposSocio = ModelSocios::mdlMostrarTiposSocio($tabla);
    return $listaTiposSocio;
  }

  //  Mostrar los tipos de identificacion
  public static function ctrMostrarTiposIdentificacion()
  {
    $tabla = "tba_tipoidentificacion";
    $listaTiposIdentificacion = ModelSocios::mdlMostrarTiposIdentificacion($tabla);
    return $listaTiposIdentificacion;
  }

  //  Mostrar los datos para editar un socio
  public static function ctrMostrarDatosEditar($codSocio)
  {
    $tabla = "tba_socio";
    $datosSocio = ModelSocios::mdlMostrarDatosEditar($tabla, $codSocio);
    return $datosSocio;
  }

  //  Crear un nuevo socio
  public static function ctrCrearSocio()
  {
    if(isset($_POST["nombreSocio"]))
    {
      $tabla = "tba_socio";
      $datosCreate = array(
        "NombreSocio" => $_POST["nombreSocio"],
        "IdTipoSocio" => $_POST["tipoSocio"],
        "IdTipoIdentificacion" => $_POST["tipoIdentificacion"],
        "Identificacion" => $_POST["numeroIdentificacion"],
        "FechaCreacion"=>date("Y-m-d\TH:i:sP"),
        "FechaActualizacion"=>date("Y-m-d\TH:i:sP"),
      );

      $respuesta = ModelSocios::mdlCrearSocio($tabla, $datosCreate);
      if($respuesta == "ok")
      {
        echo '
        <script>
          Swal.fire({
            icon: "success",
            title: "Correcto",
            text: "Socio ingresado Correctamente!",
          }).then(function(result){
					  if(result.value){
							window.location = "socios";
						}
					});
        </script>';
      }	
    }
  }

  //  Eliminar un socio
  public static function ctrEditarSocio()
  {
    if(isset($_POST["editarNombreSocio"]))
    {
      $tabla = "tba_socio";
      $datosUpdate = array(
        "IdSocio" =>  $_POST["codSocio"],
        "NombreSocio" => $_POST["editarNombreSocio"],
        "IdTipoSocio" => $_POST["editarTipoSocio"],
        "IdTipoIdentificacion" => $_POST["editarTipoIdentificacion"],
        "Identificacion" => $_POST["editarNumeroIdentificacion"],
        "FechaActualizacion"=>date("Y-m-d\TH:i:sP"),
      );

      $respuesta = ModelSocios::mdlUpdateSocio($tabla, $datosUpdate);
      if($respuesta == "ok")
      {
        echo '
        <script>
          Swal.fire({
            icon: "success",
            title: "Correcto",
            text: "Socio editado Correctamente!",
          }).then(function(result){
            if(result.value){
              window.location = "socios";
            }
          });
        </script>';
      }
    }
  }

  //  Eliminar Socio
  public static function ctrEliminarSocio()
  {
    if (isset($_GET["codSocio"]))
    {
      $codSocio = $_GET["codSocio"];
      $confirmarUsoCosto = ControllerCostos::ctrVerificarUsoSocio($codSocio);
      $confirmarUsoHistoria = ControllerHistorias::ctrVerificarUsoSocio($codSocio);
      if(($confirmarUsoCosto["TotalUso"] > 0) || ($confirmarUsoHistoria["TotalUso"] > 0))
      {
        echo '
          <script>
            Swal.fire({
              icon: "error",
              title: "Error",
              text: "¡No se puede eliminar el socio, está en uso!",
            }).then(function(result){
              if(result.value){
                window.location = "socios";
              }
            });
          </script>';
      }
      else
      {
        $tabla = "tba_socio";
        $respuesta = ModelSocios::mdlEliminarSocio($tabla, $codSocio);
        if($respuesta == "ok")
        {
          echo '
            <script>
              Swal.fire({
                icon: "success",
                title: "Correcto",
                text: "¡Socio eliminado Correctamente!",
              }).then(function(result){
                if(result.value){
                  window.location = "socios";
                }
              });
            </script>';
        }
      }
    }
  }

  //  Mostrar usuarios por tipo de usuario
  public static function ctrMostrarSociosGastos()
  {
    $tabla = "tba_socio";
    $listaSocios = ModelSocios::mdlMostrarSociosGastos($tabla);
    return $listaSocios;
  }
  
  //  Mostrar socios por el tipo de socio que es
  public static function ctrMostrarSociosPorTipo($codTipoSocio)
  {
    $tabla = "tba_socio";
    $listaSocios = ModelSocios::mdlMostrarSociosPorTipo($tabla, $codTipoSocio);
    return $listaSocios;
  }

  //  Crear tipo de socio
  public static function ctrCrearTipoSocio()
  {
    if(isset($_POST["nombreTipoSocio"]))
    {
      if($_POST["nombreTipoSocio"] != '')
      {
        $tabla = "tba_tiposocio";
        $datosCreate = array(
          "NombreTipoSocio" => $_POST["nombreTipoSocio"]
        );
        $respuesta = ModelSocios::mdlCrearTipoSocio($tabla, $datosCreate);
        if($respuesta == "ok")
        {
          echo '
          <script>
            Swal.fire({
              icon: "success",
              title: "Correcto",
              text: "Se creo correctamente el tipo de socio",
            }).then(function(result){
              if(result.value){
                window.location = "socios";
              }
            });
          </script>';
        }
        else
        {
          echo '
          <script>
            Swal.fire({
              icon: "error",
              title: "Error",
              text: "No se pudo crear el tipo de socio",
            }).then(function(result){
              if(result.value){
                window.location = "socios";
              }
            });
          </script>';
        }
      }
      else
      {
        echo '
        <script>
          Swal.fire({
            icon: "error",
            title: "Error",
            text: "Tipo de socio no válido",
          }).then(function(result){
						if(result.value){
							window.location = "socios";
						}
					});
        </script>';
      }
    }
  }
}
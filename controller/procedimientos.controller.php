<?php
date_default_timezone_set('America/Lima');
class ControllerProcedimientos
{
  //  Mostrar todos los procedimientos en el modulo de procedimientos
  public static function ctrMostrarProcedimientos()
  {
    $tabla = "tba_procedimiento";
    $listaProcedimientos = ModelProcedimientos::mdlMostrarProcedimientos($tabla);
    return $listaProcedimientos;
  }

  //  Mostrar los tipos de procedimiento
  public static function ctrMostrarTiposProcedimiento()
  {
    $tabla = "tba_tipoprocedimiento";
    $listaTiposProcedimientos = ModelProcedimientos::mdlMostrarTiposProcedimiento($tabla);
    return $listaTiposProcedimientos;
  }

  //  Crear un nuevo procedimiento
  public static function ctrCrearNuevoProcedimiento()
  {
    if(isset($_POST["nombreProcedimiento"]))
    {
      $tabla = "tba_procedimiento";
      $datosCreate = array(
        "NombreProcedimiento" => $_POST["nombreProcedimiento"],
        "IdTipoProcedimiento" => $_POST["tipoProcedimiento"],
        "PrecioPromedio" => $_POST["precioProcedimiento"],
        "FechaCreacion"=>date("Y-m-d\TH:i:sP"),
        "FechaActualizacion"=>date("Y-m-d\TH:i:sP"),
      );

      $respuesta = ModelProcedimientos::mdlCrearProcedimiento($tabla, $datosCreate);
      if($respuesta == "ok")
      {
        echo '
        <script>
          Swal.fire({
            icon: "success",
            title: "Correcto",
            text: "Procedimiento ingresado Correctamente!",
          }).then(function(result){
					  if(result.value){
							window.location = "procedimientos";
						}
					});
        </script>';
      }	
    }
  }

  //  Editar un procedimiento
  public static function ctrEditarProcedimiento()
  {
    if(isset($_POST["editarNombreProcedimiento"]))
    {
      $tabla = "tba_procedimiento";
      $datosUpdate = array(
        "NombreProcedimiento" =>  $_POST["editarNombreProcedimiento"],
        "IdTipoProcedimiento" => $_POST["editarTipoProcedimiento"],
        "PrecioPromedio" => $_POST["editarPrecioProcedimiento"],
        "IdProcedimiento" => $_POST["codProcedimiento"],
        "FechaActualizacion"=>date("Y-m-d\TH:i:sP"),
      );

      $respuesta = ModelProcedimientos::mdlUpdateProcedimiento($tabla, $datosUpdate);
      if($respuesta == "ok")
      {
        echo '
        <script>
          Swal.fire({
            icon: "success",
            title: "Correcto",
            text: "Procedimiento editado Correctamente!",
          }).then(function(result){
            if(result.value){
              window.location = "procedimientos";
            }
          });
        </script>';
      }
    }
  }

  //  Eliminar un procedimiento
  public static function ctrEliminarProcedimiento()
  {
    if (isset($_GET["codProcedimiento"]))
    {      
      $codProcedimiento = $_GET["codProcedimiento"];
      $confirmarUso = ControllerTratamiento::ctrVerificarUsoProcedimiento($codProcedimiento);
      if($confirmarUso["TotalUso"] > 0)
      {
        echo '
          <script>
            Swal.fire({
              icon: "error",
              title: "Error",
              text: "¡No se puede eliminar un procedimiento en uso!",
            }).then(function(result){
              if(result.value){
                window.location = "procedimientos";
              }
            });
          </script>';
      }
      else
      {
        $tabla = "tba_procedimiento";
        $respuesta = ModelProcedimientos::mdlEliminarProcedimiento($tabla, $codProcedimiento);
        if($respuesta == "ok")
        {
          echo '
            <script>
              Swal.fire({
                icon: "success",
                title: "Correcto",
                text: "¡Procedimiento eliminado Correctamente!",
              }).then(function(result){
                if(result.value){
                  window.location = "procedimientos";
                }
              });
            </script>';
        }
      }
    }
  }

  //  Mostrar datos para editar un procedimiento
  public static function ctrMostrarDatosEditar($codProcedimiento)
  {
    $tabla = "tba_procedimiento";
    $datosProcedimiento = ModelProcedimientos::mdlMostrarDatosEditar($tabla, $codProcedimiento);
    return $datosProcedimiento;
  }

  //  Mostrar procedimientos para el modal de historia clinica
  public static function ctrMostraProcedimientosHistoria()
  {
    $tabla = "tba_procedimiento";
    $listaProcedimientos = ModelProcedimientos::mdlMostrarProcedimientosHistoria($tabla);
    return $listaProcedimientos;
  }

  //  Obtener los datos de un procedimiento en especifico para agregar a la lista de procedimientos
  public static function ctrObtenerDatosProcedimiento($codProcedimientoAgregar)
  {
    $tabla = "tba_procedimiento";
    $datosProcedimiento = ModelProcedimientos::mdlObtenerDatosProcedimiento($tabla, $codProcedimientoAgregar);
    return $datosProcedimiento;
  }

  //  Crear nuevo tipo de procedimiento
  public static function ctrCrearTipoProcedimiento()
  {
    if(isset($_POST["nombreTipoProcedimiento"]))
    {
      if($_POST["nombreTipoProcedimiento"] != '')
      {
        $tabla = "tba_tipoprocedimiento";
        $datosCreate = array(
          "NombreTipoProcedimiento" => $_POST["nombreTipoProcedimiento"]
        );
        $respuesta = ModelProcedimientos::mdlCrearTipoProcedimiento($tabla, $datosCreate);
        if($respuesta == "ok")
        {
          echo '
          <script>
            Swal.fire({
              icon: "success",
              title: "Correcto",
              text: "Se creo correctamente el tipo de procedimiento",
            }).then(function(result){
              if(result.value){
                window.location = "procedimientos";
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
              text: "No se pudo crear el tipo de procedimiento",
            }).then(function(result){
              if(result.value){
                window.location = "procedimientos";
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
            text: "Tipo de procedimiento no válido",
          }).then(function(result){
						if(result.value){
							window.location = "procedimientos";
						}
					});
        </script>';
      }
    }
  }
  
}
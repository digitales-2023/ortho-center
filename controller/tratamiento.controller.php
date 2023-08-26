<?php
date_default_timezone_set('America/Lima');
class ControllerTratamiento
{
  //  Crear un nuevo tratamiento
  public static function ctrCrearTratamiento($datosCreateTratamiento)
  {
    $tabla = "tba_tratamiento";
    $respuesta = ModelTratamiento::mdlCrearTratamiento($tabla, $datosCreateTratamiento);
    return $respuesta;
  }

  //  Obtener el último tratamiento creado
  public static function ctrObtenerUltimoTratamiento()
  {
    $tabla = "tba_tratamiento";
    $respuesta = ModelTratamiento::mdlObtenerUltimoTratamiento($tabla);
    return $respuesta;
  }

  //  Obtener el tratamiento de un paciente en específico
  public static function ctrObtenerIdTratamiento($codPaciente)
  {
    $tabla = "tba_tratamiento";
    $respuesta = ModelTratamiento::mdlObtenerIdTratamiento($tabla, $codPaciente);
    return $respuesta;
  }

  //  Crear el detalle del tratamiento
  public static function ctrCrearDetalleTratamiento($datosDetalleTratamiento)
  {
    $tabla = "tba_detalletratamiento";
    $respuesta = ModelTratamiento::mdlCrearDetalleTratamiento($tabla, $datosDetalleTratamiento);
    return $respuesta;
  }

  //  Update del precio del tratamiento segun el los procedimientos
  public static function ctrUpdatePrecioTratamiento($codTratamiento, $totalTratamiento)
  {
    $tabla = "tba_tratamiento";
    $respuesta = ModelTratamiento::mdlUpadatePrecioTratamiento($tabla, $codTratamiento, $totalTratamiento);
    return $respuesta;
  }

  //  Mostrar el total del tratamiento actual por el codigo de tratamiento
  public static function ctrMostrarTotalTratamiento($codTratamiento)
  {
    $tabla = "tba_tratamiento";
    $respuesta = ModelTratamiento::mdlMostrarTotalTratamiento($tabla, $codTratamiento);
    return $respuesta;
  }
  
  //  Mostrar la lista de procedimientos de una historia
  public static function ctrMostrarDetalleTratamiento($codHistoria)
  {
    $tabla = "tba_detalletratamiento";
    $respuesta = ModelTratamiento::mdlMostrarDetalleTratamiento($tabla, $codHistoria);
    return $respuesta;
  }

  //  Mostrar la lista de procedimientos completa
  public static function ctrMostrarDetalleTratamientoCompleto($codHistoria)
  {
    $tabla = "tba_detalletratamiento";
    $respuesta = ModelTratamiento::mdlMostrarDetalleTratamientoCompleto($tabla, $codHistoria);
    return $respuesta;
  }

  //  Mostrar lista de procedimientos realizados 
  public static function ctrMostrarDetalleTratamientoRealizado($codHistoria)
  {
    $tabla = "tba_detalletratamiento";
    $respuesta = ModelTratamiento::mdlMostrarDetalleTratamientoEstado($tabla, $codHistoria, 2);
    return $respuesta;
  }

  //  Mostrar lista de procedimientos realizados 
  public static function ctrMostrarDetalleTratamientoFaltante($codHistoria)
  {
    $tabla = "tba_detalletratamiento";
    $respuesta = ModelTratamiento::mdlMostrarDetalleTratamientoEstado($tabla, $codHistoria, 1);
    return $respuesta;
  }
  
  //  Obtener el codigo del tratamiento
  public static function ctrObtenerCodigoTratamiento($codPaciente)
  {
    $tabla = "tba_tratamiento";
    $respuesta = ModelTratamiento::mdlObtenerCodTratamiento($tabla, $codPaciente);
    return $respuesta;
  }

  //  Editar el plan de tratamiento
  public static function ctrEditarPlanTratamiento()
  {
    if(isset($_POST["listarNuevaListaProcedimientos"]))
    {
      if($_POST["listarNuevaListaProcedimientos"] != '')
      {
        $codPaciente = $_GET["codPaciente"];
        $tablaDetalleTratamiento = "tba_detalletratamiento";
        
        $listaProcedimientos = json_decode($_POST["listarNuevaListaProcedimientos"], true);
        $idTratamiento = self::ctrObtenerIdTratamiento($codPaciente);
  
        //  Eliminamos el tratamiento actual para crear una nueva con todas las características que se quiera
        $respuestaEliminarDetalle = ModelTratamiento::mdlEliminarDetalleActual($tablaDetalleTratamiento, $idTratamiento["IdTratamiento"]);
        
        if($respuestaEliminarDetalle == "ok")
        {
          $totalTratamiento = $_POST["editarTotalTratamiento"];
          $respuestaUpdateTratamiento = ControllerTratamiento::ctrUpdatePrecioTratamiento($idTratamiento["IdTratamiento"] ,$totalTratamiento);
          if($respuestaUpdateTratamiento == "ok")
          {
            foreach($listaProcedimientos as $value)
            {
              //  Si el estado es true, colocamos 2, sino colocamos 1 -> 1 es realizado y 2 no realizado
              if($value["EstadoProcedimiento"] == true)
              {
                $estado = '2';
              }
              else
              {
                $estado = '1';
              }
  
              $datosDetalleTratamiento = array(
                "IdTratamiento" => $idTratamiento["IdTratamiento"],
                "IdProcedimiento" => $value["CodProcedimiento"],
                "ObservacionProcedimiento" => $value["ObservacionProcedimiento"],
                "EstadoTratamiento" => $estado,
                "FechaProcedimiento" => $value["FechaProcedimiento"],
                "PrecioProcedimiento" => $value["PrecioProcedimiento"],
              );
              $respuestaDetalleTratamiento = ModelTratamiento::mdlCrearEditadoDetalleTratamiento($tablaDetalleTratamiento, $datosDetalleTratamiento);
            }
  
            if($respuestaDetalleTratamiento == "ok")
            {
              echo '
                <script>
                  Swal.fire({
                    icon: "success",
                    title: "Correcto",
                    text: "¡Plan de Tratamiento Actualizado Correctamente!",
                  }).then(function(result){
                    if(result.value){
                      window.location = "historiaClinica";
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
                    text: "¡Error al actualizar el detalle del tratamiento!",
                  }).then(function(result){
                    if(result.value){
                      window.location = "historiaClinica";
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
                  text: "¡Error al actualizar el total del plan de tratamiento!",
                }).then(function(result){
                  if(result.value){
                    window.location = "historiaClinica";
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
                text: "¡Error eliminar los procedimientos!",
              }).then(function(result){
                if(result.value){
                  window.location = "historiaClinica";
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
              icon: "warning",
              title: "Sin Modificaciones",
              text: "¡No se Modificaron los datos!",
            }).then(function(result){
              if(result.value){
                window.location = "historiaClinica";
              }
            });
          </script>';
      }
    }
  }

  //  Obtener el monto pagado actualmente
  public static function ctrObtenerTotalPagado($codPaciente)
  {
    $tabla = "tba_tratamiento";
    $totalPagado = ModelTratamiento::mdlObtenerTotalPagado($tabla, $codPaciente);
    return $totalPagado;
  }

  //  Actualizar el nuevo total pagado
  public static function ctrActualizarTotal($nuevoTotal, $codPaciente)
  {
    $tabla = "tba_tratamiento";
    $respuesta = ModelTratamiento::mldActualizarTotal($tabla, $nuevoTotal, $codPaciente);
    return $respuesta;
  }

  //  Obtener el monto pagado y el total del tratamiento
  public static function ctrObtenerTotalesTratamiento($codPaciente)
  {
    $tabla = "tba_tratamiento";
    $respuesta = ModelTratamiento::mdlObtenerTotalesTratamiento($tabla, $codPaciente);
    return $respuesta;
  }

  //  Obtener el monto que suma actualmente los procedimientos que estan con estado de realizado para el paciente
  public static function ctrObtenerTotalRealizado($codHistoria)
  {
    $tabla = "tba_detalletratamiento";
    $respuesta = ModelTratamiento::mdlObtenerTotalRealizado($tabla, $codHistoria);
    return $respuesta;
  }

  //  Eliminar todo el tratamiento
  public static function ctrEliminarTratamiento($codTratamiento)
  {
    $tablaTratamiento = "tba_tratamiento";
    $tablaDetalleTratamiento = "tba_detalletratamiento";

    //  Primero le pasamos la tabla de detalle de tratamiento y luego la tabla de tratamiento para eliminar los registros que tengan el codigo de tratamiento en ambas tablas
    $confirmarDetalle = ModelTratamiento::mdlEliminarTratamiento($tablaDetalleTratamiento, $codTratamiento);
    if($confirmarDetalle == "ok")
    {
      $respuesta = ModelTratamiento::mdlEliminarTratamiento($tablaTratamiento, $codTratamiento);
    }
    else
    {
      $respuesta = "errorDetalle";
    }
    return $respuesta;
  }

  //  Verificar uso de tratamiento
  public static function ctrVerificarUsoProcedimiento($codProcedimiento)
  {
    $tabla = "tba_detalletratamiento";
    $contarProcedimiento = ModelTratamiento::mdlVerificarUsoProcedimiento($tabla, $codProcedimiento);
    return $contarProcedimiento;
  }
}
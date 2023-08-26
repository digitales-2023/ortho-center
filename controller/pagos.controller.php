<?php
date_default_timezone_set('America/Lima');
class ControllerPagos
{
  //  Mostrar todo los pagos realizados hasta el momento
  public static function ctrMostrarTodosLosPagos()
  {
    $tabla = "tba_pago";
    $listaPagos = ModelPagos::mdlMostrarTodosLosPagos($tabla);
    return $listaPagos;
  }

  //  Mostrar los tipos de pagos
  public static function ctrMostrarTiposPago()
  {
    $tabla = "tba_tipodepago";
    $listaTiposPago = ModelPagos::mdlMostrarTiposDePago($tabla);
    return $listaTiposPago;
  }

  //  Generar un nuevo pago
  public static function ctrGenerarNuevoPago($datosCreate)
  {
    $tabla = "tba_pago";

    $respuestaPago = ModelPagos::mdlIngresarNuevoPago($tabla, $datosCreate);
    if($respuestaPago == "ok")
    {
      //  Actualizamos el total y luego corroboramos si tiene un archivo, de ser asi lo subimos, caso contrario arrojamos en success
      $totalPagadoActual = ControllerTratamiento::ctrObtenerTotalPagado($datosCreate["IdPaciente"]);
      $nuevoTotal = $datosCreate["TotalPago"] + $totalPagadoActual["TotalPagado"];
      $respuestaTotal = ControllerTratamiento::ctrActualizarTotal($nuevoTotal, $datosCreate["IdPaciente"]);
      if($respuestaTotal == "ok")
      {
        //  Obtengo el último pago que se realizo para poner ese valor como nombre del comprobante, esto para que se guarde con un valor único y evite que sobreescriba archivos      
        if(isset($_FILES["comprobantePago"]))
        {
          $respuesta = "error";
          $ultimoPago = self::ctrObtenerUltimoPagoRealizado();
          if($_FILES["comprobantePago"]["type"] == "image/jpeg" || $_FILES["comprobantePago"]["type"] == "image/jpg" || $_FILES["comprobantePago"]["type"] == "image/png" || $_FILES["comprobantePago"]["type"] == "application/pdf")
          {
            $formato = explode('/', $_FILES["comprobantePago"]["type"]);            
            //  Le ponemos nombre compuesta de fecha de pago, idpaciente, idtipopago, idtratamiento y el tipo de archivo que es
            $nombreArchivo = $datosCreate["FechaPago"].'_'.$datosCreate["IdPaciente"].'_'.$datosCreate["IdTipoPago"].'_'.$totalPagadoActual["IdTratamiento"].'_'.$ultimoPago["Id"].'.'.$formato[1];
            $ruta = "../image/voucher/$nombreArchivo";
            //  Subimos el archivo y nos arroja true si se subió y false caso contrario


            $resultado = move_uploaded_file($_FILES["comprobantePago"]["tmp_name"], $ruta);

            
            //  Actualizar la ruta en la base de datos
            $actualizarRuta = self::ctrActualizarRuta($nombreArchivo, $ultimoPago["Id"]);
            if($resultado == true)
            {
              $respuesta = "ok";
            }
            else
            {
              $respuesta = "error";
            }
          }
          else
          {
            $respuesta = "errorFormato";
          }
        }
        else
        {
          $respuesta = "ok";
        }
      }
      else
      {
        $respuesta = "error";
      }
    }
    else
    {
      $respuesta = "error";
    }
    return $respuesta;
  }

  //  Eliminar un pago
  public static function ctrEliminarPago()
  {
    if (isset($_GET["codPago"]))
    {
      $tabla = "tba_pago";
      $codPago = $_GET["codPago"];
      $respuesta = ModelPagos::mdlEliminarPago($tabla, $codPago);
      if($respuesta == "ok")
      {
        echo '
        <script>
          Swal.fire({
            icon: "success",
            title: "Correcto",
            text: "Pago Eliminado Correctamente!",
          }).then(function(result){
						if(result.value){
							window.location = "historialPagos";
						}
					});
        </script>';
      }
    }
  }

  //  Mostrar los datos para editar un pago
  public static function ctrMostrarDatosEditar($codPagoEditar)
  {
    $tabla = "tba_pago";
    $datosEditar = ModelPagos::mdlMostrarDatosEditar($tabla, $codPagoEditar);
    return $datosEditar;
  }
  
  //  Editar Pago
  public static function ctrEditarPago()
  {
    if(isset($_POST["codPacienteEditado"]))
    {
      $tabla = "tba_pago";
      $datosUpdate = array(
        "IdPaciente" =>  $_POST["codPacienteEditado"],
        "IdTipoPago" => $_POST["editarTipoPago"],
        "TotalPago" => $_POST["editarMontoPago"],
        "ObservacionPago" => $_POST["editarObservacion"],
        "FechaPago" => $_POST["editarFechaPago"],
        "FechaActualizacion"=>date("Y-m-d\TH:i:sP"),
        "IdPago" => $_POST["codPagoEdit"],
      );
      ModelPagos::mdlUpdatePago($tabla, $datosUpdate);

      $totalPagadoActual = ControllerTratamiento::ctrObtenerTotalPagado($datosUpdate["IdPaciente"]);
      //  Actualizo el total pagado
      $nuevoTotal = $datosUpdate["TotalPago"] + $totalPagadoActual["TotalPagado"];
      $respuestaTotal = ControllerTratamiento::ctrActualizarTotal($nuevoTotal, $datosUpdate["IdPaciente"]);
      if($respuestaTotal == "ok")
      {
        if($_FILES["editarComprobantePago"]["name"] != null || $_FILES["editarComprobantePago"]["name"] != '')
        {
          if($_FILES["editarComprobantePago"]["type"] == "image/jpeg" || $_FILES["editarComprobantePago"]["type"] == "image/jpg" || $_FILES["editarComprobantePago"]["type"] == "image/png" || $_FILES["editarComprobantePago"]["type"] == "application/pdf")
          {
            $formato = explode('/', $_FILES["editarComprobantePago"]["type"]);            
            //  Le ponemos nombre compuesta de fecha de pago, idpaciente, idtipopago, idtratamiento y el tipo de archivo que es
            $nombreArchivo = $datosUpdate["FechaPago"].'_'.$datosUpdate["IdPaciente"].'_'.$datosUpdate["IdTipoPago"].'_'.$totalPagadoActual["IdTratamiento"].'_'.$datosUpdate["IdPago"].'.'.$formato[1];
            $ruta = "image/voucher/$nombreArchivo";
            //  Subimos el archivo y nos arroja true si se subió y false caso contrario
            $resultado = move_uploaded_file($_FILES["editarComprobantePago"]["tmp_name"], $ruta);
            //  Actualizar la ruta en la base de datos
            self::ctrActualizarRuta($nombreArchivo, $datosUpdate["IdPago"]);
            if($resultado == true)
            {
              echo '
                <script>
                  Swal.fire({
                    icon: "success",
                    title: "Correcto",
                    text: "Pago Editado Correctamente!",
                  }).then(function(result){
                    if(result.value){
                      window.location = "historialPagos";
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
                    text: "¡Error al intentar subir el Archivo!",
                  }).then(function(result){
                    if(result.value){
                      window.location = "historialPagos";
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
                  title: "Error",
                  text: "No se acepta otro formato que no sea de tipo JPG, JPEG, PNG o PDF",
                }).then(function(result){
                  if(result.value){
                    window.location = "historialPagos";
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
                icon: "success",
                title: "Correcto",
                text: "Pago Editado Correctamente!",
              }).then(function(result){
                if(result.value){
                  window.location = "historialPagos";
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
            text: "¡Error al intentar editar el Pago!",
          }).then(function(result){
            if(result.value){
              window.location = "historialPagos";
            }
          });
        </script>';
      }
    }
  }

  //  Mostrar todos los costos por el tratamiento por cada paciente
  public static function ctrMostrarTotalPorPaciente()
  {
    $tabla = "tba_pago";
    $listaCostoTratamientos = ModelPagos::mdlMostrarTotalPorPaciente($tabla);
    return $listaCostoTratamientos;
  }

  //  Mostrar todos los pagos de un paciente
  public static function ctrMostrarPagosPorPaciente($codPaciente)
  {
    $tabla = "tba_pago";
    $listaPagosPaciente = ModelPagos::mdlMostrarPagosPorPaciente($tabla, $codPaciente);
    return $listaPagosPaciente;
  }
  
  //  Obtener el ultimo pago registrado
  public static function ctrObtenerUltimoPagoRealizado()
  {
    $tabla = "tba_pago";
    $respuesta = ModelPagos::mdlObtenerUltimoPagoRealizado($tabla);
    return $respuesta;
  }

  //  Actualizar la ruta del pago
  public static function ctrActualizarRuta($nombreArchivo, $codPago)
  {
    $tabla = "tba_pago";
    $respuesta = ModelPagos::mdlActualizarRuta($tabla, $nombreArchivo, $codPago);
    return $respuesta;
  }

  //  Descargar un voucher
  public static function ctrDescargarPago($codPago)
  {
    $tabla = "tba_pago";
    $rutaVoucher = ModelPagos::mdlDescargarPago($tabla, $codPago);
    $archivo = $rutaVoucher["ComprobantePago"];
    $ruta = "image/voucher/".$archivo;
    
    $respuesta = array("archivo" => $archivo,
        "ruta" => $ruta
        );
    
    return $respuesta;
  }

  //  Verificar el uso del paciente en un pago
  public static function ctrVerificarUsoPaciente($codPaciente)
  {
    $tabla = "tba_pago";
    $contarUso = ModelPagos::mdlVerificarUsoPaciente($tabla, $codPaciente);
    return $contarUso;
  }
}
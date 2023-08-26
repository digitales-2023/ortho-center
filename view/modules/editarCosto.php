</div>
        </div>
        <div class="sb-sidenav-footer">
          <div class="small">Sesión iniciada como:</div>
          <?php echo $_SESSION["nombreUsuario"] ?>
        </div>
      </nav>
    </div>
    <div id="layoutSidenav_content">
      <main class="bg">
        <div class="container-fluid px-4">
          <h1 class="mt-4">
            <?php
              if(isset($_GET["codCosto"]))
              {
                $cabeceraIngreso = ControllerCostos::ctrObtenerCabaceraCosto($_GET["codCosto"]);
                echo "Editar Costo".' - '.$cabeceraIngreso["DescripcionCentro"].' - '.$cabeceraIngreso["MesCosto"] ;
              }
              else 
              {
                echo'
                  <script>
                    window.location = "index.php?ruta=allcostos";
                  </script>
                ';
              }
            ?>
          </h1>
        </div>

        <div class="container-fluid">
          <form role="form" method="post" class="row g-3 m-2 formularioNuevoCosto">

            <!-- Cabecera -->
            <span class="border border-3 p-3">
              <div class="container row g-3">

                <!-- Seleccionar la fecha del costo -->
                <div class="col-md-3">
                  <label for="editarMesGasto" class="form-label" style="font-weight: bold">Mes de Ingreso</label>
                  <input type="month" class="form-control" id="editarMesGasto" name="editarMesGasto" value="<?php echo $cabeceraIngreso['MesCosto']?>">
                </div>

                <!-- Seleccionar el centro de costos -->
                <div class="form-group col-md-4">
                  <label for="centroDeCostos" class="form-label" style="font-weight: bold">Centro de Costos:</label>
                  <select class="form-select" name="centroDeCostos" id="centroDeCostos" disabled>
                    <option selected="true" value="<?php echo $cabeceraIngreso['IdCentroCostos']?>"><?php echo $cabeceraIngreso['DescripcionCentro']?></option>
                  </select>
                </div>
              </div>
            </span>

            <!-- Detalle del Costo -->
            <span class="border border-3 p-3">
              <div class="container row g-3">
                <h3>Datos Detalle</h3>
                <div class="d-inline-flex m-2">
                  <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalAgregarGastoEditar">Agregar Item</button>
                </div>

                <div class="row" style="font-weight: bold">
                  <div class="col-lg-2">Nombre Costo</div>
                  <div class="col-lg-2">Observacion</div>
                  <div class="col-lg-1">Cantidad</div>
                  <div class="col-lg-2">Socio</div>
                  <div class="col-lg-2">Nro. Documento</div>
                  <div class="col-lg-2">Fecha Pago</div>
                  <div class="col-lg-1">Costo(S/.)</div>
                </div>

                <div class="form-group row nuevoGasto">
                  <?php
                    $listaCostos = ControllerCostos::ctrObtenerDetalleCosto($_GET["codCosto"]);
                    $listaSocios = ControllerSocios::ctrMostrarSociosGastos();

                    $selectSocios = '';
                    foreach($listaSocios as $value)
                    {
                      $selectSocios .= '<option value="'.$value['IdSocio'].'">'.$value['NombreSocio'].'</option>';
                    }
                    
                    foreach($listaCostos as $value)
                    {
                      echo '
                        <div class="row" style="padding:5px 15px">

                          <!-- Descripción del producto -->          
                          <div class="col-lg-2" style="padding-right:0px">
                            <div class="input-group">
                              <span class="input-group-addon"><button type="button" class="btn btn-danger btn-xs quitarGasto" idGasto="'.$value["IdGasto"].'"><i class="fa fa-times"></i></button></span>
                              <input type="text" class="form-control nuevogasto" idGasto="'.$value["IdGasto"].'" value="'.$value["NombreGasto"].'" readonly>
                            </div>
                          </div>

                          <!-- Observacion -->
                          <div class="col-lg-2 ingresoObservacionGasto">
                            <input type="text" class="form-control nuevaObservacionGasto" name="nuevaObservacionGasto" value="'.$value["ObservacionGasto"].'">
                          </div> 

                          <!-- Cantidad del producto -->
                          <div class="col-lg-1 ingresoCantidad">
                            <input type="number" class="form-control cantidadGasto" name="cantidadGasto" value="1" readonly>
                          </div> 

                          <!-- Socio -->
                          <div class="form-group col-lg-2 ingresoSocio">
                            <select class="form-control nuevoSocio" name="nuevoSocio">
                              <option selected="true" value="'.$value['IdSocio'].'">'.$value['NombreSocio'].'</option>'.$selectSocios.'
                            </select>
                          </div>

                          <!-- Numero Documento -->
                          <div class="col-lg-2 ingresoNroDocumento">
                            <input type="text" class="form-control nuevonNroDocumento" name="nuevonNroDocumento" value="'.$value["NumeroDocumento"].'" required>
                          </div> 

                          <!-- Fecha de Documento -->
                          <div class="col-lg-2 ingresoFecha">
                            <input type="date" class="form-control nuevaFechaDocumento" name="nuevaFechaDocumento" value="'.$value["FechaCosto"].'" required>
                          </div> 

                          <!-- Precio del Gasto -->
                          <div class="col-lg-1 ingresoPrecioGasto">
                            <input type="number" class="form-control nuevoCostoGasto" name="nuevoCostoGasto" min="1.00" step="0.01" value="'.$value["PrecioGasto"].'" required>
                          </div> 

                        </div>
                      ';
                    }
                  ?>  
                  <input type="hidden" id="listarGastos" name="listarGastos">
                </div>
              </div>
            </span>

            <!-- Pie de movimiento -->
            <span class="border border-3 p-3">
              <div class="container row g-3">
                <h3>Datos Total</h3>

                <div class="row" style="font-weight: bold">
                  <div class="col-lg-2"></div>
                  <div class="col-lg-2"><span>Total (S/.):</span></div><div class="col-lg-2"><input type="number" style="text-align: right;" class="form-control input-lg" min="0" id="nuevoTotalGasto" name="nuevoTotalGasto" placeholder="0.00"  value="<?php echo $cabeceraIngreso['TotalCosto'] ?>" readonly></div>
                </div>
              </div>

              <div class="container row g-3 p-3 justify-content-between">
                <button type="button" class="col-1 d-inline-flex-center p-2 btn btn-secondary cerrarCosto">Cerrar</button>
                <button type="submit" class="col-2 d-inline-flex-center p-2 btn btn-primary ">Editar Movimiento</button>
              </div>
            </span>
          </form>
        </div>
      </main>
    </div>
  </div>

<?php
  $crearCosto = new ControllerCostos;
  $crearCosto -> ctrEditarCosto();
?>

<div class="modal fade" id="modalAgregarGastoEditar" tabindex="-1" role="dialog" aria-labelledby="modalAgregarGastoEditar" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Listado de Costos</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <!-- Cuerpo modal -->
      <div class="modal-body">
        <table class="table table-striped dt-responsive tablaGastos" width="100%">
          <thead>
            <tr>
              <th>Descripción del Gasto</th>
              <th>Acciones</th>           
            </tr> 
          </thead>
          <tbody class="nuevaListaGastos">
            <?php
              $listaGastos = ControllerGastos::ctrMostrarGastosPorTipo($cabeceraIngreso["IdCentroCostos"]);
              foreach($listaCostos as $gasto)
              {
                echo '
                <tr id="nuevoRecurso">
                  <td>'.$gasto["NombreGasto"].'</td>
                  <td>
                    <div class="btn-group">
                      <button class="btn btn-primary btnAgregarGasto recuperarBoton" codGasto="'.$gasto["IdGasto"].'">Agregar</button>
                    </div>
                  </td>
                </tr
                ';
              }
            ?>
          </tbody>
        </table>
      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-secondary pull-left" data-bs-dismiss="modal">Salir</button>
      </div>
    </div>
  </div>
</div>
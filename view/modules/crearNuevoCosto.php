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
          <h1 class="mt-4">Nuevo Costo Mensual</h1>
        </div>

        <div class="container-fluid">
          <form role="form" method="post" class="row g-3 m-2 formularioNuevoCosto">

            <!-- Cabecera -->
            <span class="border border-3 p-3">
              <div class="container row g-3">
                <!-- Seleccionar la fecha del costo -->
                <div class="col-md-3">
                  <label for="mesIngresoGasto" class="form-label" style="font-weight: bold">Mes de Ingreso</label>
                  <input type="month" class="form-control" id="mesIngresoGasto" name="mesIngresoGasto" required>
                </div>

                <!-- Seleccionar el centro de costos -->
                <div class="form-group col-md-4">
                  <label for="centroDeCostos" class="form-label" style="font-weight: bold">Centro de Costos:</label>
                  <select class="form-select" name="centroDeCostos" id="centroDeCostos" required>
                    <option selected="true" value="" disabled>Elige una opcion</option>
                    <?php
                      $centrosCostos = ControllerCostos::ctrMostrarCentrosCostos();
                      foreach ($centrosCostos as $key => $value)
                      {
                        echo '<option value="'.$value["IdCentroCostos"].'">'.$value["DescripcionCentro"].'</option>';
                      }
                    ?>
                  </select>
                </div>
              </div>
            </span>

            <!-- Detalle del Costo -->
            <span class="border border-3 p-3">
              <div class="container row g-3">
                <h3>Datos Detalle</h3>
                <div class="d-inline-flex m-2">
                  <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalAgregarGasto">Agregar Item</button>
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

                <div class="form-group row nuevoGasto" id="nuevaListaGastos">
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
                  <div class="col-lg-2"><span>Total (S/.):</span></div><div class="col-lg-2"><input type="number" style="text-align: right;" class="form-control input-lg" min="0" id="nuevoTotalGasto" name="nuevoTotalGasto" placeholder="0.00" readonly></div>              
                </div>
              </div>

              <div class="container row g-3 p-3 justify-content-between">
                <button type="button" class="col-1 d-inline-flex-center p-2 btn btn-secondary cerrarCosto">Cerrar</button>
                <button type="submit" class="col-2 d-inline-flex-center p-2 btn btn-primary ">Registrar Movimiento</button>
              </div>
            </span>

          </form>
        </div>
      </main>
    </div>
  </div>

<?php
  $crearCosto = new ControllerCostos;
  $crearCosto -> ctrCrearNuevoCosto();
?>

<div class="modal fade" id="modalAgregarGasto" tabindex="-1" role="dialog" aria-labelledby="modalAgregarGasto" aria-hidden="true">
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
              <th>Descripción de Costo</th>
              <th>Acciones</th>           
            </tr> 
          </thead>
          <tbody class="nuevaListaGastos">
            
          </tbody>
        </table>
      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-secondary pull-left" data-bs-dismiss="modal">Salir</button>
      </div>
    </div>
  </div>
</div>
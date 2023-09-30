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
        $datosPaciente = ControllerPacientes::ctrMostrarDatosTratamiento($_GET["codPaciente"]);
        if ($_GET["codPaciente"] && $_GET["codHistoria"]) {
          echo 'Historial de Procedimientos: ' . $datosPaciente["NombrePaciente"] . ' ' . $datosPaciente["ApellidoPaciente"];
        } else {
          echo 'No hay datos del paciente';
        }
        ?>
      </h1>
    </div>

    <div class="container-fluid">
      <form role="form" method="post" class="row g-3 m-2 formularioPlanTratamiento">

        <!-- Cabecera -->
        <span class="border border-3 p-3">
          <div class="container row g-3">

            <div class="container row g-3 p-3 justify-content-between">
              <h3 class="col-3 d-inline-flex-center">Datos Paciente</h3>
              <button type="button" class="col-3 d-inline-flex-center btn btn-success btnDescargarTratamiento" id="btnDescargarTratamiento" codHistoria="<?php echo $_GET["codHistoria"] ?>" codPaciente="<?php echo $_GET["codPaciente"] ?>"><i class="fa fa-print" aria-hidden="true"></i> Procedimientos Realizados</button>
            </div>

            <!-- Seleccionar al paciente -->
            <div class="form-group col-md-8">
              <label for="nombrePaciente" class="form-label" style="font-weight: bold">Paciente:</label>
              <input type="text" class="form-control" id="nombrePaciente" name="nombrePaciente" value="<?php echo $datosPaciente["NombrePaciente"] . ' ' . $datosPaciente["ApellidoPaciente"] ?>" readonly>
            </div>

            <!-- Numero de DNI -->
            <div class="col-md-4">
              <label for="numeroDNI" class="form-label" style="font-weight: bold">DNI: </label>
              <input type="text" class="form-control" id="numeroDNI" name="numeroDNI" value="<?php echo $datosPaciente["DNIPaciente"] ?>" readonly>
            </div>

            <!-- Edad -->
            <div class="col-md-4">
              <label for="editarEdad" class="form-label" style="font-weight: bold">Edad: </label>
              <input type="text" class="form-control" id="editarEdad" name="editarEdad" value="<?php echo $datosPaciente["EdadPaciente"] ?>" readonly>
            </div>

            <!-- Telefono Celular -->
            <div class="col-md-4">
              <label for="editarCelular" class="form-label" style="font-weight: bold">Telefono / Celular: </label>
              <input type="text" class="form-control" id="editarCelular" name="editarCelular" value="<?php echo $datosPaciente["CelularPaciente"] ?>" readonly>
            </div>
          </div>
        </span>

        <!-- Plan de tratamiento -->
        <span class="border border-3 p-3">
          <div class="container row g-3">
            <h3>Lista de Procedimientos</h3>
            <div class="d-inline-flex m-2">
              <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalAgregarProcedimiento">Agregar Procedimiento</button>
            </div>

            <div class="row" style="font-weight: bold">
              <div class="col-lg-3">Descripción</div>
              <div class="col-lg-3">Observacion</div>
              <div class="col-lg-2">Estado</div>
              <div class="col-lg-2">Fecha Intervencion</div>
              <div class="col-lg-2">Precio(S/.)</div>
            </div>

            <div class="form-group row nuevoProcedimientoAgregar">
              <?php
              $listaProcedimientos = ControllerTratamiento::ctrMostrarDetalleTratamientoCompleto($_GET["codHistoria"]);
              foreach ($listaProcedimientos as $value) {
                if ($value["EstadoTratamiento"] == 1) {
                  $estado = "";
                } else {
                  $estado = "checked";
                }
                echo '
                        <div class="row" style="padding:5px 15px">

                          <!-- Descripción del procedimiento -->     
                          <div class="col-lg-3" style="padding-right:0px">
                            <div class="input-group">
                              <span class="input-group-addon"><button type="button" class="btn btn-danger btn-xs eliminarProcedimiento" codProcedimiento="' . $value["IdProcedimiento"] . '" codEstado="' . $value["EstadoTratamiento"] . '"><i class="fa fa-times"></i></button></span>
                              <input type="text" class="form-control editarProcedimiento" codProcedimiento="' . $value["IdProcedimiento"] . '" value="' . $value["NombreProcedimiento"] . '" readonly>
                            </div>
                          </div>
                  
                          <!-- Observacion -->
                          <div class="col-lg-3 observacionProcedimiento">
                            <input type="text" class="form-control editarObservacionProcedimiento" name="editarObservacionProcedimiento" value="' . $value["ObservacionProcedimiento"] . '">
                          </div>

                          <!-- Estado -->
                          <div class="col-lg-2 form-check form-switch estadoProcedimiento">
                            <input  type="checkbox" class="form-check-input editarEstadoProcedimiento" name="editarEstadoProcedimiento" id="editarEstadoProcedimiento" ' . $estado . '>
                            <label class="form-check-label" for="editarEstadoProcedimiento">Intervencion Realizada</label>
                          </div>

                          <!-- Fecha del Procedimiento -->
                          <div class="col-lg-2 fechaProcedimiento">
                            <input type="date" class="form-control editarFechaIntervencion" name="editarFechaIntervencion" value="' . $value["FechaProcedimiento"] . '">
                          </div>
                  
                          <!-- Precio del procedimiento -->
                          <div class="col-lg-2 precioProcedimiento">
                            <input type="number" class="form-control editarPrecioTratamiento" name="editarPrecioTratamiento" min="1.00" step="0.01" value="' . $value["PrecioProcedimiento"] . '" required>
                          </div> 
                        </div>
                      ';
              }
              ?>
              <input type="hidden" id="listarNuevaListaProcedimientos" name="listarNuevaListaProcedimientos">
            </div>
          </div>
        </span>

        <!-- Pie de historia -->
        <span class="border border-3 p-3">
          <div class="container row g-3 p-3">
            <h3>Costo Total</h3>
            <div class="row" style="font-weight: bold">
              <div class="col-lg-2"></div>
              <div class="col-lg-2"><span>Costo Total(S/.):</span></div>
              <div class="col-lg-2"><input type="number" style="text-align: right;" class="form-control input-lg" id="editarTotalTratamiento" name="editarTotalTratamiento" placeholder="0.00" value="" readonly></div>
            </div>
            <div class="container row g-3 p-3 justify-content-between">
              <button type="button" class="col-1 d-inline-flex-center p-2 btn btn-secondary cerrarHistoria">Cerrar</button>
              <button type="submit" class="col-2 d-inline-flex-center p-2 btn btn-primary ">Registrar Procedimientos</button>
            </div>
          </div>
        </span>

      </form>
    </div>
  </main>
</div>
</div>

<?php
$crearPlanTratamiento = new ControllerTratamiento;
$crearPlanTratamiento->ctrEditarPlanTratamiento();
?>

<!-- Modal agregar nuevo procedimiento -->
<div class="modal fade" id="modalAgregarProcedimiento" tabindex="-1" role="dialog" aria-labelledby="modalAgregarProcedimiento" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Listado de Gastos</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <!-- Cuerpo modal -->
      <div class="modal-body">
        <table class="table table-striped dt-responsive tablaProcedimientosEditar" width="100%">
          <thead>
            <tr>
              <th style="width:10px">#</th>
              <th>Descripción del Gasto</th>
              <th>Acciones</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $listaProcedimientos = ControllerProcedimientos::ctrMostraProcedimientosHistoria();
            foreach ($listaProcedimientos as $key => $value) {
              echo ' 
                  <tr>
                    <td>' . ($key + 1) . '</td>
                    <td>' . $value["NombreProcedimiento"] . '</td>
                    <td>
                      <div class="btn-group">
                        <button class="btn btn-primary btnAgregarProcedimiento recuperarBoton" codProcedimiento="' . $value["IdProcedimiento"] . '">Agregar</button> 
                      </div>
                    </td>
                  </tr>';
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
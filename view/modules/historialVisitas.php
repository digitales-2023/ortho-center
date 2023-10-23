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

        if ($_GET["codPaciente"] && $_GET["codHistoria"]) {
          $codPaciente = $_GET["codPaciente"];
          $datosPaciente = ControllerPacientes::ctrMostrarDatosTratamiento($codPaciente);
          echo 'Historial de Visitas: ' . $datosPaciente["NombrePaciente"] . ' ' . $datosPaciente["ApellidoPaciente"];
          $listarProcedimientos = ControllerTratamiento::ctrListarProcedimientosPaciente($codPaciente);
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
            </div>

            <!-- Seleccionar al paciente -->
            <div class="form-group col-md-8">
              <label for="nombrePaciente" class="form-label" style="font-weight: bold">Paciente:</label>
              <input type="text" class="form-control" value="<?php echo $datosPaciente["NombrePaciente"] . ' ' . $datosPaciente["ApellidoPaciente"] ?>" readonly>
            </div>

            <!-- Numero de DNI -->
            <div class="col-md-4">
              <label for="numeroDNI" class="form-label" style="font-weight: bold">DNI: </label>
              <input type="text" class="form-control" value="<?php echo $datosPaciente["DNIPaciente"] ?>" readonly>
            </div>

            <!-- Edad -->
            <div class="col-md-4">
              <label for="editarEdad" class="form-label" style="font-weight: bold">Edad: </label>
              <input type="text" class="form-control" value="<?php echo $datosPaciente["EdadPaciente"] ?>" readonly>
            </div>

            <!-- Telefono Celular -->
            <div class="col-md-4">
              <label for="editarCelular" class="form-label" style="font-weight: bold">Telefono / Celular: </label>
              <input type="text" class="form-control" value="<?php echo $datosPaciente["CelularPaciente"] ?>" readonly>
            </div>
          </div>
        </span>

        <!-- Lista de Visitas -->
        <span class="border border-3 p-3">
          <div class="container row g-3">

            <h3>Historial de Visitas</h3>
            <div class="d-inline-flex m-2">
              <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalAgregarVisita">Nueva Visita</button>
            </div>

            <div class="row" style="font-weight: bold">
              <div class="col-lg-3">Motivo</div>
              <div class="col-lg-2">Fecha</div>
              <div class="col-lg-2">Procedimiento Ref.</div>
              <div class="col-lg-1">Costo(S/.)</div>
              <div class="col-lg-2">Pagado(S/.)</div>
              <div class="col-lg-2">Saldo(S/.)</div>
            </div>

            <div class="form-group row nuevaVisitaAgregar">
              <?php

              $listaVisitas = ControllerVisitas::ctrMostrarVisitasPaciente($_GET["codHistoria"]);
              foreach ($listaVisitas as $value) {

                if ($value["PrecioProcedimiento"] != "" || $value["PrecioProcedimiento"] != null) {
                  $saldo = number_format($value["PrecioProcedimiento"] - $value["TotalPagado"], 2);
                } else {
                  $saldo = "";
                }

                echo '
                        <div class="row" style="padding:5px 15px">
                          <!-- Motivo Visita -->     
                          <div class="col-lg-3" style="padding-right:0px">
                            <div class="input-group">
                              <span class="input-group-addon"><button type="button" class="btn btn-danger btn-xs eliminarVisita" codVisita="' . $value["IdVisita"] . '"><i class="fa fa-times"></i></button></span>
                              <input type="text" class="form-control motivoVisitaGuardada" codVisita="' . $value["IdVisita"] . '" value="' . $value["MotivoVisita"] . '" readonly>
                            </div>
                          </div>
  
                          <!-- Fecha de visita -->
                          <div class="col-lg-2">
                            <input type="date" class="form-control fechaVisitaGuardada" name="fechaVisitaGuardada" id="fechaVisitaGuardada" value="' . $value["FechaVisita"] . '" readonly>
                          </div>

                          <!-- Nombre Procedimiento -->
                          <div class="col-lg-2">
                            <input  type="text" class="form-control referenciaVisitaGuardada" name="referenciaVisitaGuardada" id="referenciaVisitaGuardada" value="' . $value["NombreProcedimiento"] . '" readonly>
                          </div>

                          <!-- Costo Procedimiento -->
                          <div class="col-lg-1">
                            <input  type="text" class="form-control costoProcedimientoGuardada" name="costoProcedimientoGuardada" id="costoProcedimientoGuardada" value="' . $value["PrecioProcedimiento"] . '" readonly>
                          </div>

                          <!-- A cuenta del procedimiento -->
                          <div class="col-lg-2">
                            <input type="number" class="form-control acuentaProcedimientoGuardada" name="acuentaProcedimientoGuardada" id="acuentaProcedimientoGuardada" value="' . $value["TotalPagado"] . '" readonly>
                          </div>

                          <!-- Saldo -->
                          <div class="col-lg-2">
                            <input type="number" class="form-control saldoProcedimientoGuardada" name="saldoProcedimientoGuardada" id="saldoProcedimientoGuardada" value="' . $saldo . '" readonly>
                          </div> 
                        </div>
                      ';
              }
              ?>
              <input type="hidden" id="listarNuevaListaVisitas" name="listarNuevaListaVisitas">
            </div>
          </div>
        </span>

        <!-- Pie de historia -->
        <span class="border border-3 p-3">
          <div class="container row g-3 p-3">
            <h3>Costo Total</h3>
            <div class="row" style="font-weight: bold">
              <!-- COLOCAR TOTALES -->
            </div>
            <div class="container row g-3 p-3 justify-content-between">
              <input type="hidden" name="codHistoria" id="codHistoria" value="<?php echo $_GET["codHistoria"] ?>">
              <input type="hidden" name="codPaciente" id="codPaciente" value="<?php echo $codPaciente ?>">
              <button type="button" class="col-1 d-inline-flex-center p-2 btn btn-secondary cerrarVisita">Cerrar</button>
              <button type="submit" class="col-2 d-inline-flex-center p-2 btn btn-primary ">Guardar Visitas</button>
            </div>
          </div>
        </span>
      </form>
    </div>
  </main>
</div>
</div>

<?php
$editarVisitas = new ControllerVisitas;
$editarVisitas->ctrEditarVisitas();
?>

<!-- Modal agregar nuevo procedimiento -->
<div class="modal fade" id="modalAgregarVisita" tabindex="-1" role="dialog" aria-labelledby="modalAgregarVisita" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Agregar Visita</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <!-- Cuerpo modal -->
      <div class="modal-body">
        <form role="form" method="post" class="formularioAgregarVisita">
          <!-- Motivo Visita -->
          <div class="form-group">
            <label for="motivoVisita" class="col-form-label">Motivo de visita:</label>
            <input type="text" class="form-control motivoVisitaForm" id="motivoVisitaForm" name="motivoVisitaForm" required>
          </div>

          <!-- Fecha de la visita -->
          <div class="form-group">
            <label for="fechaVisita" class="col-form-label">Fecha de visita:</label>
            <input type="date" class="form-control fechaVisitaForm" id="fechaVisitaForm" name="fechaVisitaForm" required>
          </div>

          <!-- Lista Procedimientos -->
          <div class="form-group">
            <label for="referenciaVisita" class="col-form-label">Procedimiento Referencial:</label>
            <select class="form-control referenciaVisitaForm" name="referenciaVisitaForm" id="referenciaVisitaForm">
              <option value="0">Otro</option>
              <?php
              foreach ($listarProcedimientos as $value) {
                echo '<option value="' . $value["IdDetalleTratamiento"] . '">' . $value["NombreProcedimiento"] . '</option>';
              }
              ?>
            </select>
          </div>

          <!-- Costo Procedimiento -->
          <div class="form-group">
            <label for="costoProcedimiento" class="col-form-label">Costo de Procedimiento:</label>
            <input type="text" class="form-control costoProcedimientoForm" id="costoProcedimientoForm" name="costoProcedimientoForm" readonly>
          </div>

          <!-- Pago a cuenta -->
          <div class="form-group">
            <label for="pagoVisita" class="col-form-label">A cuenta:</label>
            <input type="text" class="form-control pagoVisitaForm" id="pagoVisitaForm" name="pagoVisitaForm">
          </div>

          <!-- Saldo Procedimiento -->
          <div class="form-group">
            <label for="saldoProcedimiento" class="col-form-label">Saldo:</label>
            <input type="text" class="form-control saldoProcedimientoForm" id="saldoProcedimientoForm" name="saldoProcedimientoForm" readonly>
          </div>

          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
            <button type="button" class="btn btn-primary btnRegistrarVisita" id="btnRegistrarVisita" data-bs-dismiss="modal">Agregar Visita</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
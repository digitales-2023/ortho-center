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
      <h2 class="mt-4">
        <?php
        if (isset($_GET["codPaciente"]) && isset($_GET["codHistoria"])) {
          $codPaciente = $_GET["codPaciente"];
          $codHistoria = $_GET["codHistoria"];
          $datosPaciente = ControllerPacientes::ctrMostrarDatosBasicos($codPaciente);
          $detalleTratamiento = ControllerTratamiento::ctrMostrarDetalleTratamientoCompleto($codHistoria);
          $totalesTratamiento = ControllerTratamiento::ctrObtenerTotalesTratamiento($codPaciente);
          $totalRealizado = ControllerTratamiento::ctrObtenerTotalRealizado($codHistoria);
          echo ' Pagos Pendientes Paciente: ' . $datosPaciente["NombrePaciente"] . ' ' . $datosPaciente["ApellidoPaciente"];
        } else {
          echo 'No hay datos de los Pagos Pendientes';
        }
        ?>
      </h2>
    </div>

    <!-- Datos Paciente -->
    <div class="container-fluid">
      <form role="form" method="post" class="row g-3 m-2 formularioPagosPendientes">
        <div class="row g-3 m-2">
          <span class="border border-3 p-3">
            <div class="container row g-3">
              <h3>Datos del Paciente</h3>
              <!-- Nombre del paciente -->
              <div class="col-md-8">
                <label for="visualizarNombre" class="form-label" style="font-weight: bold">Paciente: </label>
                <input type="text" class="form-control border-0" id="visualizarNombre" name="visualizarNombre" value="<?php echo $datosPaciente["NombrePaciente"] . ' ' . $datosPaciente["ApellidoPaciente"] ?>" readonly>
              </div>

              <!-- Numero de DNI -->
              <div class="col-md-4">
                <label for="visualizarDNI" class="form-label" style="font-weight: bold">DNI: </label>
                <input type="text" class="form-control border-0" id="visualizarDNI" name="visualizarDNI" value="<?php echo $datosPaciente["DNIPaciente"] ?>" readonly>
              </div>

            </div>
          </span>

          <!-- Plan de tratamiento, donde se mostrará toda la lista de Procedimientos -->
          <span class="border border-3 p-3">
            <div class="container row g-3">
              <h3>Plan de Tratamiento</h3>

              <div class="row" style="font-weight: bold">
                <div class="col-lg-3">Descripción</div>
                <div class="col-lg-2">Fecha Intervencion</div>
                <div class="col-lg-1">Estado</div>
                <div class="col-lg-2">Precio(S/.)</div>
                <div class="col-lg-2">A Cuenta(S/.)</div>
                <div class="col-lg-2">Saldo(S/.)</div>
              </div>

              <div class="form-group row nuevoProcedimientoAgregar">
                <?php
                foreach ($detalleTratamiento as $value) {
                  echo '
                        <div class="row" style="padding:5px 15px">

                          <!-- Descripción del procedimiento -->
                          <div class="col-lg-3">
                            <div class="input-group">
                              <input type="text" class="form-control" value="' . $value["NombreProcedimiento"] . '" readonly>
                              <input type="hidden" class="form-control editarProcedimiento" codProcedimiento="' . $value["IdProcedimiento"] . '">
                            </div>
                          </div>

                          <!-- Fecha del Procedimiento -->
                          <div class="col-lg-2 fechaProcedimiento">
                            <input type="date" class="form-control" value="' . $value["FechaProcedimiento"] . '" readonly>
                          </div>
                  
                          <!-- Precio del procedimiento -->
                          <div class="col-lg-1 precioProcedimiento">
                            <input type="number" class="form-control" value="' . $value["EstadoTratamiento"] . '" readonly>
                          </div>

                          <!-- Precio del procedimiento -->
                          <div class="col-lg-2 precioProcedimiento">
                            <input type="number" class="form-control" value="' . $value["PrecioProcedimiento"] . '" readonly>
                          </div>

                          <!-- A cuenta del procedimiento -->
                          <div class="col-lg-2 aCuentaProcedimiento">
                            <input type="number" class="form-control" name="aCuentaProcedimiento" id="aCuentaProcedimiento">
                          </div>

                          <!-- Saldo del procedimiento -->
                          <div class="col-lg-2 saldoProcedimiento">
                            <input type="number" class="form-control" name="saldoProcedimiento" id="saldoProcedimiento">
                          </div>

                        </div>
                      ';
                }
                ?>
              </div>
            </div>
          </span>

          <!-- Pie de historia -->
          <span class="border border-3 p-3">
            <div class="container row g-3 p-3">
              <h3>Costos Totales</h3>
              <div class="row" style="font-weight: bold">
                <div class="col-lg-3">
                  <span>Monto Presupuestado (S/.):</span>
                </div>
                <div class="col-lg-2">
                  <input type="text" style="text-align: right;" class="form-control input-lg border-0" value="<?php echo number_format($totalesTratamiento["TotalTratamiento"], 2) ?>" readonly>
                </div>
              </div>

              <div class="row" style="font-weight: bold">
                <div class="col-lg-3">
                  <span>Total Procedimientos Realizados (S/.):</span>
                </div>
                <div class="col-lg-2">
                  <input type="text" style="text-align: right;" class="form-control input-lg border-0" value="<?php echo number_format($totalRealizado["TotalRealizado"], 2) ?>" readonly>
                </div>
              </div>

              <div class="row" style="font-weight: bold">
                <div class="col-lg-3">
                  <span>Total Cancelado (S/.):</span>
                </div>
                <div class="col-lg-2">
                  <input type="text" style="text-align: right;" class="form-control input-lg border-0" value="<?php echo number_format($totalesTratamiento["TotalPagado"], 2) ?>" readonly>
                </div>
              </div>

              <div class="row" style="font-weight: bold">
                <div class="col-lg-3">
                  <span>Saldo Actual (S/.):</span>
                </div>
                <div class="col-lg-2">
                  <input type="text" style="text-align: right;" class="form-control input-lg border-0" value="<?php echo number_format(($totalRealizado["TotalRealizado"] - $totalesTratamiento["TotalPagado"]), 2) ?>" readonly>
                </div>
              </div>

              <div class="container row g-3 p-3 justify-content-between">
                <button type="button" class="col-1 d-inline-flex-center p-2 btn btn-secondary cerrarVisualizar">Cerrar</button>
                <button type="submit" class="col-1 d-inline-flex-center p-2 btn btn-primary registrarPago">Guardar</button>
              </div>
            </div>
          </span>
        </div>
        <?php
        $guardarPagos = new ControllerPagos;
        $guardarPagos->ctrGuardarPagos();
        ?>
      </form>
    </div>
</div>
</main>
</div>
</div>
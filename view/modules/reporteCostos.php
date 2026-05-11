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
          <h1 class="mt-4">Reporte de Costos</h1>

        <?php
          $mayorCostoMes = ControllerCostos::ctrSumarCostosMesActual();
          $totalMesActual = (float)($mayorCostoMes["suma_mes"] ?? 0);

          $mayorCentroCostos = ControllerCostos::ctrSumarMayorCentroCostos();
          $nombreMayorCentro = $mayorCentroCostos["DescripcionCentro"] ?? 'Sin datos';
          $montoMayorCentro = (float)($mayorCentroCostos["SumaMayorCosto"] ?? 0);
        ?>

        <!-- KPI principales --> 
        <div class="row">
          <div class="col-xl-3 col-md-6">
            <div class="card bg-success text-white mb-4">
              <div class="card-body">
                <div style="font-size: 13px">Costo Total del Mes Actual</div>
                <div id="kpiCostoMes" style="font-size: 22px; font-weight: 700">S/. <?php echo number_format($totalMesActual, 2, '.', ''); ?></div>
              </div>
            </div>
          </div>

          <div class="col-xl-3 col-md-6">
            <div class="card bg-danger text-white mb-4">
              <div class="card-body">
                <div style="font-size: 13px">Centro con Mayor Costo</div>
                <div id="kpiCentroMayor" style="font-size: 17px; font-weight: 700"><?php echo $nombreMayorCentro; ?></div>
                <div id="kpiMontoCentroMayor" style="font-size: 14px">S/. <?php echo number_format($montoMayorCentro, 2, '.', ''); ?></div>
              </div>
            </div>
          </div>

          <div class="col-xl-3 col-md-6">
            <div class="card bg-primary text-white mb-4">
              <div class="card-body">
                <div style="font-size: 13px">Total del Rango Seleccionado</div>
                <div id="kpiTotalRango" style="font-size: 22px; font-weight: 700">S/. 0.00</div>
                <div id="kpiRangoFechas" style="font-size: 12px">Selecciona un rango de fechas</div>
              </div>
            </div>
          </div>

          <div class="col-xl-3 col-md-6">
            <div class="card bg-info text-white mb-4">
              <div class="card-body">
                <div style="font-size: 13px">Promedio Mensual del Centro</div>
                <div id="kpiPromedioCentro" style="font-size: 22px; font-weight: 700">S/. 0.00</div>
                <div id="kpiMesPicoCentro" style="font-size: 12px">Selecciona un centro de costos</div>
              </div>
            </div>
          </div>
        </div>

          <hr>

          <h3 class="mt-4">Filtrar Por Fechas</h3>
          <!-- Grafica de gastos por filtrado de fecha -->
          <div class="row justify-content-center">
            <div class="col-xl-10">
              <div class="d-inline-flex m-2">
                <button type="button" class="btn btn-success" id="dateRangeRptCostoFecha">
                  <i class="fa fa-calendar"></i> Rango de fecha  <i class="fa fa-caret-down"></i>
                </button>
              </div>

              <div class="card mb-4">
                <div class="card-header">
                  <i class="fas fa-chart-area me-1"></i>
                  Gasto Por Fechas 
                </div>
                <div class="card-body"><canvas id="chartCostoFecha" width="100%" height="40"></canvas></div>
              </div>
            </div>
          </div>

          <h3 class="mt-4">Filtrar Por Centro de Costos</h3>

          <div class="row justify-content-center">
            <div class="col-xl-10">
              <div class="d-inline-flex m-2">
                <select class="form-select" name="chartCentroCostos" id="chartCentroCostos" required>
                  <option selected="true" value="" disabled>Centro de Costos</option>
                  <?php
                    $centrosCostos = ControllerCostos::ctrMostrarCentrosCostos();
                    foreach ($centrosCostos as $key => $value)
                    {
                      echo '<option value="'.$value["IdCentroCostos"].'">'.$value["DescripcionCentro"].'</option>';
                    }
                  ?>
                </select>
              </div>
              <div class="card mb-4">
                <div class="card-header">
                  <i class="fas fa-chart-bar me-1"></i>
                  Costos Por Centro de Costos
                </div>
                <div class="card-body"><canvas id="charCentroCosto" width="100%" height="40"></canvas></div>
              </div>
            </div>
          </div>
        </div>
      </main>
    </div>
  </div>

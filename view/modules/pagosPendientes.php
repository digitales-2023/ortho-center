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
          <h1 class="mt-4">Todos los Pagos Pendientes</h1>
          <div class="d-inline-flex m-2">

          </div>

          <div class="card-body">
            <table id="datatablesSimple" class="data-table-AllCostos table">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Paciente</th>
                  <th>DNI</th>
                  <th>Monto Presupuestado (S/.)</th>
                  <th>Total Realizado (S/.)</th>
                  <th>Total Pagado (S/.)</th>
                  <th>Saldo Actual(S/.)</th>
                  <th>Acciones</th>
                </tr>
              </thead>
              <tbody>
                <?php
                  $listaCostoTratamientos = ControllerPagos::ctrMostrarTotalPorPaciente();
                  foreach ($listaCostoTratamientos as $key => $value)
                  {
                    $totalesTratamiento = ControllerTratamiento::ctrObtenerTotalesTratamiento($value["IdPaciente"]);
                    $totalRealizado = ControllerTratamiento::ctrObtenerTotalRealizado($value["IdHistoriaClinica"]);
                    $deudaRealizados = number_format($totalRealizado["TotalRealizado"]-$totalesTratamiento["TotalPagado"], 2);
                    echo
                      '<tr>
                        <td>'.($key + 1).'</td>
                        <td>'.$value["NombrePaciente"].' '.$value["ApellidoPaciente"].'</td>
                        <td>'.$value["DNIPaciente"].'</td>
                        <td>'.number_format($value["TotalTratamiento"],2).'</td>
                        <td>'.number_format($totalRealizado["TotalRealizado"],2).'</td>
                        <td>'.number_format($totalesTratamiento["TotalPagado"],2).'</td>
                        <td>'.$deudaRealizados.'</td>
                        <td>
                          <button class="btn btn-success btnFichaPagos" id="btnFichaPagos" codPaciente="'.$value["IdPaciente"].'"><i class="fa-solid fa fa-print"></i></button>
                          <button class="btn btn-primary btnVisualizarPagos" id="btnVisualizarPagos" codPaciente="'.$value["IdPaciente"].'" codHistoria="'.$value["IdHistoriaClinica"].'"><i class="fa fa-eye"></i></button>
                        </td>
                      </tr>';
                  }
                ?>
              </tbody>
            </table>
          </div>
        </div>
      </main>
    </div>
  </div>
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
            <button title="Descargar Pagos Pendientes" type="button" class="btn btn-success descargarPagosPendientes m-1" id="descargarPagosPendientes">
              Descargar Pagos Pendientes
            </button>
            <button title="Descargar Atenciones" type="button" class="btn btn-success descargarAtencionesMedicos m-1" id="descargarAtencionesMedicos">
            Descargar Atenciones
            </button>
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
                  <th>Total Cancelado (S/.)</th>
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
                    $codHistoria = !empty($value["IdHistoriaClinica"]) ? $value["IdHistoriaClinica"] : null;
                    $totalRealizado = $codHistoria ? ControllerTratamiento::ctrObtenerTotalRealizado($codHistoria) : ["TotalRealizado" => 0];
                    $deudaRealizados = number_format(($totalRealizado["TotalRealizado"] ?? 0) - ($totalesTratamiento["TotalPagado"] ?? 0), 2);
                    echo
                      '<tr>
                        <td>'.($key + 1).'</td>
                        <td>'.$value["NombrePaciente"].' '.$value["ApellidoPaciente"].'</td>
                        <td>'.$value["NumeroIdentificacion"].'</td>
                        <td>'.number_format($value["TotalTratamiento"] ?? 0, 2).'</td>
                        <td>'.number_format($totalRealizado["TotalRealizado"] ?? 0, 2).'</td>
                        <td>'.number_format($totalesTratamiento["TotalPagado"] ?? 0, 2).'</td>
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
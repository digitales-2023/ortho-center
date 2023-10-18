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
      <h1 class="mt-4">Todos los Pagos</h1>
      <div class="d-inline-flex m-2">

      </div>

      <div class="card-body">
        <table id="datatablesSimple" class="data-table-AllCostos table">
          <thead>
            <tr>
              <th>#</th>
              <th>Nombres</th>
              <th>Apellidos</th>
              <th>DNI</th>
              <th>Costo Tratamiento(S/.)</th>
              <th>Total Cancelado(S/.)</th>
              <th>Saldo Actual(S/.)</th>
              <th>Acciones</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $listaTratamientos = ControllerPagos::ctrMostrarListaPacientesTratamiento();
            foreach ($listaTratamientos as $key => $value) {
              $saldoActual = $value["TotalCancelado"] - $value["TotalTratamiento"];
              echo
              '<tr>
                        <td>' . ($key + 1) . '</td>
                        <td>' . $value["NombrePaciente"] . '</td>
                        <td>' . $value["ApellidoPaciente"] . '</td>
                        <td>' . $value["DNIPaciente"] . '</td>
                        <td>' . $value["TotalTratamiento"] . '</td>
                        <td>' . number_format($value["TotalCancelado"], 2) . '</td>
                        <td>' . $saldoActual . '</td>
                        <td>  
                          <button class="btn btn-primary btnVisualizarPagos" id="btnVisualizarPagos" codPaciente="' . $value["IdPaciente"] . '"><i class="fa fa-search"></i></button>
                          <button class="btn btn-success btnImprimirFicha" id="btnImprimirFicha" codPaciente="' . $value["IdPaciente"] . '"><i class="fa-solid fa fa-print"></i></button>
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

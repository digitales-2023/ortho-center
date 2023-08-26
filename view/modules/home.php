
        </div>
      </div>
      <div class="sb-sidenav-footer">
        <div class="small">Sesión iniciada como:</div>
        <?php echo $_SESSION["nombreUsuario"] ?>
      </div>
    </nav>
  </div>
  <div id="layoutSidenav_content">
    <main>
      <div class="container-fluid px-4">
        <h1 class="mt-4">Inicio</h1>
        <ol class="breadcrumb mb-4">
          <li class="breadcrumb-item active">Inicio</li>
        </ol>
        <div class="row">
          <div class="col-xl-3 col-md-6">
            <div class="card bg-primary text-white mb-4">
              <div class="card-body">
                <?php 
                  $TotalPacientes = ControllerPacientes::ctrContarPacientes();
                  echo 'Pacientes Registrados :       '.$TotalPacientes["TotalPacientes"];
                ?>
              </div>
              <div class="card-footer d-flex align-items-center justify-content-between">
                <a class="small text-white stretched-link" href="pacientes">Ver Detalles</a>
                <div class="small text-white"><i class="fas fa-angle-right"></i></div>
              </div>
            </div>
          </div>
          <div class="col-xl-3 col-md-6">
            <div class="card bg-warning text-white mb-4">
              <div class="card-body">
                <?php
                  $mayorCostoMes = ControllerCostos::ctrSumarCostosMesActual();
                  echo 'Costo Total del Mes (S/.) : '.$mayorCostoMes["suma_mes"];
                ?>
              </div>
              <div class="card-footer d-flex align-items-center justify-content-between">
                <a class="small text-white stretched-link" href="allCostos">Ver Detalles</a>
                <div class="small text-white"><i class="fas fa-angle-right"></i></div>
              </div>
            </div>
          </div>
          <div class="col-xl-3 col-md-6">
            <div class="card bg-success text-white mb-4">
              <div class="card-body">
                <?php
                  $citasRegistradas = ControllerCitas::ctrSumarCitasHoy();
                  echo 'Citas Registradas hoy : '.$citasRegistradas["TotalCitas"];
                ?>
              </div>
              <div class="card-footer d-flex align-items-center justify-content-between">
                <a class="small text-white stretched-link" href="programacionCitas">Ver Detalles</a>
                <div class="small text-white"><i class="fas fa-angle-right"></i></div>
              </div>
            </div>
          </div>
          <div class="col-xl-3 col-md-6">
            <div class="card bg-danger text-white mb-4">
              <div class="card-body">
              <?php
                  $totalHistorias = ControllerHistorias::ctrContarHistoriasCreadas();
                  echo 'Historias Clinicas Registradas : '.$totalHistorias["TotalHistorias"];
                ?>
              </div>
              <div class="card-footer d-flex align-items-center justify-content-between">
                <a class="small text-white stretched-link" href="historiaClinica">Ver Detalles</a>
                <div class="small text-white"><i class="fas fa-angle-right"></i></div>
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          
        </div>
        <div class="card mb-4">
          
        </div>
      </div>
    </main>
  </div>
</div>
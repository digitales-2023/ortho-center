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
      <div class="container-fluid px-4 todosLosCostos">
        <h1 class="mt-4">
          <?php
            if (isset($_GET["fechaInicial"])) 
            {
              $fechaInicial = $_GET["fechaInicial"];
              $fechaFinal = $_GET["fechaFinal"];
              echo 'Filtrar Costos del (Del : ' . $fechaInicial . ' Hasta: ' . $fechaFinal . ')';
            } 
            else 
            {
              $fechaInicial = null;
              $fechaFinal = null;
              echo 'Filtrar Costos Por Fecha';
            }
          ?>
          <!-- <input type="text" value="texto" style="border: 0cm; " disabled> -->
        </h1>

        <div class="d-inline-flex m-2">
          <div class="p-1 rangoFechas">
            <button type="button" class="btn btn-warning dateRangeCosto" id="dateRangeCosto">
              <i class="fa fa-calendar calendarioPicker"></i> Rango de fecha <i class="fa fa-caret-down"></i>
            </button>
          </div>
          <div class="p-1">
            <button class="btn btn-success btnDescargarFiltro" id="btnDescargarFiltro" >
              Descargar Excel
            </button>
          </div>
        </div>
        
        <div class="card-body">
          <table class="data-table table tablasFiltrarCostos" width="100%">
            <thead>
              <tr>
                <th>Centro de Costos</th>
                <th>Socio</th>
                <th>Descripción de Costo</th>
                <th>Nro. Documento</th>
                <th>Fecha</th>
                <th>Costo (S/.)</th>
              </tr>
            </thead>
            <tbody class="listaCostosPickFechas">

            </tbody>
          </table>
        </div>

      </div>
    </main>
  </div>
</div>

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

        <!-- Gráficos de Dashboard -->
        <div class="row mt-5">
          <div class="col-lg-12">
            <div class="card mb-4">
              <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Análisis de Pacientes Registrados</h5>
                <div>
                  <select id="filtroAñoPacientes" class="form-select" style="width: 150px; display: inline-block;">
                    <option value="">Cargando años...</option>
                  </select>
                </div>
              </div>
              <div class="card-body">
                <canvas id="chartPacientesMes"></canvas>
              </div>
            </div>
          </div>
        </div>

        <!-- Gráfico Acumulado -->
        <div class="row">
          <div class="col-lg-12">
            <div class="card mb-4">
              <div class="card-header">
                <h5 class="mb-0">Pacientes Acumulados por Mes</h5>
              </div>
              <div class="card-body">
                <canvas id="chartPacientesAcumulados"></canvas>
              </div>
            </div>
          </div>
        </div>
      </div>
    </main>
  </div>
</div>

<!-- Cargar Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js@3.9.1/dist/chart.min.js"></script>

<script>
  // Variables globales para los gráficos
  let chartPacientesMes = null;
  let chartPacientesAcumulados = null;
  const añoActual = new Date().getFullYear();

  $(document).ready(function() {
    // Cargar años disponibles
    cargarAñosDisponibles();
    
    // Cargar gráficos con año actual
    cargarGraficosPacientes(añoActual);

    // Event listener para cambio de año
    $("#filtroAñoPacientes").on("change", function() {
      const año = $(this).val() || añoActual;
      cargarGraficosPacientes(año);
    });
  });

  function cargarAñosDisponibles() {
    $.ajax({
      url: "ajax/pacientes.ajax.php",
      method: "POST",
      data: {
        accion: "obtenerAños"
      },
      dataType: "json",
      success: function(response) {
        let selectAños = $("#filtroAñoPacientes");
        selectAños.empty();
        
        if (response && response.length > 0) {
          response.forEach(function(item) {
            selectAños.append('<option value="' + item.año + '">' + item.año + '</option>');
          });
          // Seleccionar año actual
          selectAños.val(añoActual);
        } else {
          selectAños.append('<option value="">No hay datos</option>');
        }
      },
      error: function() {
        console.error("Error cargando años");
      }
    });
  }

  function cargarGraficosPacientes(año) {
    $.ajax({
      url: "ajax/pacientes-grafico.ajax.php",
      method: "POST",
      data: {
        año: año
      },
      dataType: "json",
      success: function(response) {
        console.log("Datos recibidos:", response);
        
        // Actualizar gráfico de pacientes por mes
        actualizarGraficoPacientesMes(response);
        
        // Actualizar gráfico acumulado
        actualizarGraficoAcumulado(response);
      },
      error: function(jqXHR, textStatus, errorThrown) {
        console.error("Error en AJAX:", textStatus, errorThrown);
      }
    });
  }

  function actualizarGraficoPacientesMes(data) {
    const ctx = document.getElementById('chartPacientesMes').getContext('2d');
    
    if (chartPacientesMes) {
      chartPacientesMes.destroy();
    }

    chartPacientesMes = new Chart(ctx, {
      type: 'line',
      data: {
        labels: data.meses,
        datasets: [{
          label: 'Pacientes Nuevos por Mes',
          data: data.datos,
          borderColor: '#0d6efd',
          backgroundColor: 'rgba(13, 110, 253, 0.1)',
          borderWidth: 3,
          fill: true,
          tension: 0.4,
          pointRadius: 5,
          pointBackgroundColor: '#0d6efd',
          pointBorderColor: '#fff',
          pointBorderWidth: 2,
          pointHoverRadius: 7
        }]
      },
      options: {
        responsive: true,
        maintainAspectRatio: true,
        plugins: {
          legend: {
            display: true,
            labels: {
              usePointStyle: true,
              padding: 15,
              font: {
                size: 12
              }
            }
          },
          tooltip: {
            backgroundColor: 'rgba(0, 0, 0, 0.8)',
            padding: 12,
            titleFont: { size: 13 },
            bodyFont: { size: 12 },
            callbacks: {
              label: function(context) {
                return 'Pacientes: ' + context.parsed.y;
              }
            }
          }
        },
        scales: {
          y: {
            beginAtZero: true,
            ticks: {
              stepSize: 1
            },
            title: {
              display: true,
              text: 'Cantidad de Pacientes'
            }
          }
        }
      }
    });
  }

  function actualizarGraficoAcumulado(data) {
    // Calcular datos acumulados
    let acumulado = [];
    let suma = 0;
    data.datos.forEach(function(valor) {
      suma += valor;
      acumulado.push(suma);
    });

    const ctx = document.getElementById('chartPacientesAcumulados').getContext('2d');
    
    if (chartPacientesAcumulados) {
      chartPacientesAcumulados.destroy();
    }

    chartPacientesAcumulados = new Chart(ctx, {
      type: 'line',
      data: {
        labels: data.meses,
        datasets: [{
          label: 'Pacientes Acumulados',
          data: acumulado,
          borderColor: '#198754',
          backgroundColor: 'rgba(25, 135, 84, 0.1)',
          borderWidth: 3,
          fill: true,
          tension: 0.4,
          pointRadius: 5,
          pointBackgroundColor: '#198754',
          pointBorderColor: '#fff',
          pointBorderWidth: 2,
          pointHoverRadius: 7
        }]
      },
      options: {
        responsive: true,
        maintainAspectRatio: true,
        plugins: {
          legend: {
            display: true,
            labels: {
              usePointStyle: true,
              padding: 15,
              font: {
                size: 12
              }
            }
          },
          tooltip: {
            backgroundColor: 'rgba(0, 0, 0, 0.8)',
            padding: 12,
            titleFont: { size: 13 },
            bodyFont: { size: 12 },
            callbacks: {
              label: function(context) {
                return 'Total Acumulado: ' + context.parsed.y;
              }
            }
          }
        },
        scales: {
          y: {
            beginAtZero: true,
            ticks: {
              stepSize: 1
            },
            title: {
              display: true,
              text: 'Total Acumulado de Pacientes'
            }
          }
        }
      }
    });
  }
</script>
      </div>
    </main>
  </div>
</div>
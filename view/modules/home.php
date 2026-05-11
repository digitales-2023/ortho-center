
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
                <div style="display: flex; gap: 10px;">
                  <select id="filtroTipoPacientes" class="form-select" style="width: 180px;">
                    <option value="ultimos_meses" selected>Últimos 3 Meses</option>
                    <option value="ultimos_6_meses">Últimos 6 Meses</option>
                    <option value="año_actual">Por Año</option>
                  </select>
                  <select id="filtroAñoPacientes" class="form-select" style="width: 150px; display: none;">
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
      </div>
    </main>
  </div>
</div>

<!-- Cargar Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js@3.9.1/dist/chart.min.js"></script>

<script>
  // Variables globales para los gráficos
  let chartPacientesMes = null;
  const añoActual = new Date().getFullYear();

  $(document).ready(function() {
    // Cargar años disponibles y gráficos
    cargarAñosDisponibles();
    
    // Esperar a que los años se carguen antes de mostrar gráficos de año
    setTimeout(function() {
      cargarGraficosPacientes("ultimos_meses", null, 3);
    }, 500);

    // Event listeners para cambios de filtro
    $("#filtroTipoPacientes").on("change", function() {
      const filtro = $(this).val();
      if (filtro === "ultimos_meses") {
        $("#filtroAñoPacientes").fadeOut(200);
        cargarGraficosPacientes("ultimos_meses", null, 3);
      } else if (filtro === "ultimos_6_meses") {
        $("#filtroAñoPacientes").fadeOut(200);
        cargarGraficosPacientes("ultimos_6_meses", null, 6);
      } else if (filtro === "año_actual") {
        $("#filtroAñoPacientes").fadeIn(200);
        // Esperar un poco para que el select sea visible
        setTimeout(function() {
          const año = $("#filtroAñoPacientes").val();
          if (año && año !== "") {
            cargarGraficosPacientes("año_actual", parseInt(año));
          }
        }, 300);
      }
    });

    $("#filtroAñoPacientes").on("change", function() {
      const año = $(this).val();
      if (año && año !== "") {
        cargarGraficosPacientes("año_actual", parseInt(año));
      } else {
        // Si no hay año, cargar con el año actual
        cargarGraficosPacientes("año_actual", añoActual);
      }
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
          // Seleccionar el primer año disponible (mayor)
          selectAños.val(response[0].año);
        } else {
          selectAños.append('<option value="' + añoActual + '">' + añoActual + '</option>');
          selectAños.val(añoActual);
        }
      },
      error: function() {
        let selectAños = $("#filtroAñoPacientes");
        selectAños.empty();
        selectAños.append('<option value="' + añoActual + '">' + añoActual + '</option>');
        selectAños.val(añoActual);
      }
    });
  }

  function cargarGraficosPacientes(filtro, año = null, meses = 3) {
    let datos_ajax = {
      filtro: filtro
    };
    
    if (filtro === "año_actual" && año) {
      datos_ajax.año = parseInt(año);
    } else if (filtro === "ultimos_meses") {
      datos_ajax.meses = 3;
    } else if (filtro === "ultimos_6_meses") {
      datos_ajax.meses = 6;
    }

    console.log("📊 Enviando AJAX:", datos_ajax, "Tipo año:", typeof datos_ajax.año);

    $.ajax({
      url: "ajax/pacientes-grafico.ajax.php",
      method: "POST",
      data: datos_ajax,
      dataType: "json",
      success: function(response) {
        console.log("✓ Respuesta AJAX:", response);
        
        if (!response || response.total_registros === undefined) {
          console.error("✗ Respuesta inválida");
          return;
        }
        
        // Actualizar gráfico de pacientes por mes
        actualizarGraficoPacientesMes(response);
      },
      error: function(err) {
        console.error("✗ Error AJAX:", err);
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
          label: 'Pacientes Nuevos',
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



</script>
      </div>
    </main>
  </div>
</div>
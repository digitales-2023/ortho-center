(function () {
  var chartCanvas = document.getElementById("chartCostoFecha");
  var dateRangeButton = document.getElementById("dateRangeRptCostoFecha");

  if (!chartCanvas || !dateRangeButton) {
    return;
  }

  function formatearMoneda(valor) {
    return "S/. " + Number(valor || 0).toFixed(2);
  }

  function actualizarKpiTexto(id, texto) {
    var nodo = document.getElementById(id);
    if (nodo) {
      nodo.textContent = texto;
    }
  }

  function actualizarTextoBotonRango(fechaInicial, fechaFinal) {
    dateRangeButton.innerHTML = '<i class="fa fa-calendar"></i> ' + fechaInicial + ' - ' + fechaFinal + ' <i class="fa fa-caret-down"></i>';
  }

  Chart.defaults.global.defaultFontFamily = 'Arial,sans-serif, -apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue"';
  Chart.defaults.global.defaultFontColor = '#1C2427';

  var chartCostoRango = new Chart(chartCanvas, {
    type: 'bar',
    data: {
      labels: [],
      datasets: [{
        label: "Gasto Total (S/.)",
        backgroundColor: "rgba(12,152,0,0.8)",
        borderColor: "rgba(2,117,216,1)",
        borderWidth: 1,
        data: []
      }]
    },
    options: {
      scales: {
        xAxes: [{
          gridLines: {
            display: false
          },
          ticks: {
            maxTicksLimit: 8
          }
        }],
        yAxes: [{
          ticks: {
            min: 0,
            maxTicksLimit: 6
          },
          gridLines: {
            color: "rgba(0, 0, 0, .125)"
          }
        }]
      },
      legend: {
        display: false
      }
    }
  });

  var fechaInicioDefault = moment().subtract(3, 'months').format('YYYY-MM-DD');
  var fechaFinDefault = moment().format('YYYY-MM-DD');

  $('#dateRangeRptCostoFecha').daterangepicker({
    opens: 'right',
    startDate: fechaInicioDefault,
    endDate: fechaFinDefault,
    locale: {
      format: 'YYYY-MM-DD'
    }
  });

  function cargarDatosRango(fechaInicial, fechaFinal) {
    var datos = new FormData();
    datos.append("FechaInicial", fechaInicial);
    datos.append("FechaFinal", fechaFinal);

    $.ajax({
      url: "ajax/costos-assets.ajax.php",
      method: "POST",
      data: datos,
      cache: false,
      contentType: false,
      processData: false,
      dataType: "json",
      success: function (respuesta) {
        var centrosCostos = [];
        var costosTotales = [];
        var totalRango = 0;
        var maxCosto = -1;
        var maxCentro = 'Sin datos';

        for (var i = 0; i < respuesta.length; i++) {
          var costo = parseFloat(respuesta[i].SumaTotalCosto || 0);
          centrosCostos.push(respuesta[i].DescripcionCentro);
          costosTotales.push(costo);
          totalRango += costo;

          if (costo > maxCosto) {
            maxCosto = costo;
            maxCentro = respuesta[i].DescripcionCentro;
          }
        }

        chartCostoRango.data.labels = centrosCostos;
        chartCostoRango.data.datasets[0].data = costosTotales;
        chartCostoRango.update();

        actualizarKpiTexto('kpiTotalRango', formatearMoneda(totalRango));
        actualizarKpiTexto('kpiRangoFechas', fechaInicial + ' a ' + fechaFinal);

        if (maxCosto >= 0) {
          actualizarKpiTexto('kpiCentroMayor', maxCentro);
          actualizarKpiTexto('kpiMontoCentroMayor', formatearMoneda(maxCosto));
        }
      },
      error: function (jqXHR, textStatus, errorThrown) {
        console.log("Error en la solicitud AJAX: ", textStatus, errorThrown);
      }
    });
  }

  $('#dateRangeRptCostoFecha').on('apply.daterangepicker', function (ev, picker) {
    var fechaInicial = picker.startDate.format('YYYY-MM-DD');
    var fechaFinal = picker.endDate.format('YYYY-MM-DD');
    actualizarTextoBotonRango(fechaInicial, fechaFinal);
    cargarDatosRango(fechaInicial, fechaFinal);
  });

  actualizarTextoBotonRango(fechaInicioDefault, fechaFinDefault);
  actualizarKpiTexto('kpiRangoFechas', fechaInicioDefault + ' a ' + fechaFinDefault);
  cargarDatosRango(fechaInicioDefault, fechaFinDefault);
})();

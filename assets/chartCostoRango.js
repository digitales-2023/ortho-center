//  Select de Fechas
$('#dateRangeRptCostoFecha').daterangepicker({
  opens: 'right',
  locale: {
    format: 'YYYY-MM-DD',
  },
});

// Agrega el evento 'apply.daterangepicker' para manejar la selección de fechas
$('#dateRangeRptCostoFecha').on('apply.daterangepicker', function(ev, picker) {
  var fechaInicial = picker.startDate.format('YYYY-MM-DD');
  var fechaFinal = picker.endDate.format('YYYY-MM-DD');

  var datos = new FormData();
  datos.append("FechaInicial", fechaInicial);
  datos.append("FechaFinal", fechaFinal);

  $.ajax({
    url:"ajax/costos-assets.ajax.php",
    method: "POST",
    data: datos,
    data: datos,
    cache: false,
    contentType: false,
    processData: false,
    dataType:"json",
    success:function(respuesta)
    {
      var centrosCostos = [];
      var costosTotales = [];

      for (var i = 0; i < respuesta.length; i++) {
        centrosCostos.push(respuesta[i].DescripcionCentro);
        costosTotales.push(parseFloat(respuesta[i].SumaTotalCosto));
      }
      //  Actualizar las etiquetas y datos del gráfico
      chartCostoRango.data.labels = centrosCostos;
      chartCostoRango.data.datasets[0].data = costosTotales;

      // Actualizar el gráfico
      chartCostoRango.update();
    },
    error: function(jqXHR, textStatus, errorThrown) {
      console.log("Error en la solicitud AJAX: ", textStatus, errorThrown);
    }
  });
});

// Set new default font family and font color to mimic Bootstrap's default styling
Chart.defaults.global.defaultFontFamily = 'Arial,sans-serif, -apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue"';
Chart.defaults.global.defaultFontColor = '#1C2427';

// Area Chart Example
var ctx = document.getElementById("chartCostoFecha");
var chartCostoRango = new Chart(ctx, {
  type: 'bar',
  data: {
    labels: ["Servicios Generales", "Costos de Laboratorio", "Costos de personal", "Costos de insumos"],
    datasets: [{
      label: "Gasto Total (S/.)",
      backgroundColor: "rgba(12,152,0,0.8)",
      borderColor: "rgba(2,117,216,1)",
    }],
  },
  options: {
    scales: {
      xAxes: [{
        time: {
          unit: 'date'
        },
        gridLines: {
          display: false
        },
        ticks: {
          maxTicksLimit: 7
        }
      }],
      yAxes: [{
        ticks: {
          min: 0,
          max: 5000,
          maxTicksLimit: 6
        },
        gridLines: {
          color: "rgba(0, 0, 0, .125)",
        }
      }],
    },
    legend: {
      display: false
    }
  }
});

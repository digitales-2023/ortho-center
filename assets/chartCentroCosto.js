(function () {
  var chartCanvas = document.getElementById("charCentroCosto");
  var selectCentro = document.getElementById("chartCentroCostos");

  if (!chartCanvas || !selectCentro) {
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

  Chart.defaults.global.defaultFontFamily = 'Arial,sans-serif, -apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue"';
  Chart.defaults.global.defaultFontColor = '#1C2427';

  var chartCentrCostos = new Chart(chartCanvas, {
    type: 'bar',
    data: {
      labels: [],
      datasets: [{
        label: "Gasto Total (S/.)",
        backgroundColor: "rgba(2,117,216,0.8)",
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
            maxTicksLimit: 7
          }
        }],
        yAxes: [{
          ticks: {
            min: 0,
            maxTicksLimit: 6
          },
          gridLines: {
            display: true
          }
        }]
      },
      legend: {
        display: false
      }
    }
  });

  $("#chartCentroCostos").change(function () {
    var codCentroCostos = $('#chartCentroCostos').val();
    var nombreCentro = $('#chartCentroCostos option:selected').text();

    var datos = new FormData();
    datos.append("codCentroCostos", codCentroCostos);

    $.ajax({
      url: "ajax/costos-assets.ajax.php",
      method: "POST",
      data: datos,
      cache: false,
      contentType: false,
      processData: false,
      dataType: "json",
      success: function (respuesta) {
        var labels = [];
        var data = [];
        var sumaTotal = 0;
        var maxMonto = -1;
        var mesPico = 'Sin datos';

        respuesta.forEach(function (item) {
          var monto = parseFloat(item.SumaTotalCosto || 0);
          labels.push(item.MesCosto);
          data.push(monto);
          sumaTotal += monto;

          if (monto > maxMonto) {
            maxMonto = monto;
            mesPico = item.MesCosto;
          }
        });

        chartCentrCostos.data.labels = labels;
        chartCentrCostos.data.datasets[0].label = "Gasto Total (S/.) - " + nombreCentro;
        chartCentrCostos.data.datasets[0].data = data;
        chartCentrCostos.update();

        var promedio = data.length > 0 ? (sumaTotal / data.length) : 0;
        actualizarKpiTexto('kpiPromedioCentro', formatearMoneda(promedio));
        actualizarKpiTexto('kpiMesPicoCentro', 'Mes pico: ' + mesPico);
      },
      error: function (jqXHR, textStatus, errorThrown) {
        console.log("Error en la solicitud AJAX: ", textStatus, errorThrown);
      }
    });
  });

  if (selectCentro.options.length > 1) {
    var indiceDefault = 1;

    for (var i = 0; i < selectCentro.options.length; i++) {
      var textoOpcion = (selectCentro.options[i].text || '').toLowerCase();
      if (textoOpcion.indexOf('costos de personal') !== -1) {
        indiceDefault = i;
        break;
      }
    }

    selectCentro.selectedIndex = indiceDefault;
    $("#chartCentroCostos").trigger('change');
  }
})();

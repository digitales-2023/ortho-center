$("#chartCentroCostos").change(function(){
  var codCentroCostos = $('#chartCentroCostos').val();

  var datos = new FormData();
  datos.append("codCentroCostos", codCentroCostos);

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
      var labels = [];
      var data = [];

      respuesta.forEach(function(item) {
        labels.push(item.MesCosto);
        data.push(parseFloat(item.SumaTotalCosto));
      });

      chartCentrCostos.data.labels = labels;
      chartCentrCostos.data.datasets[0].data = data;
      chartCentrCostos.update();
    },
    error: function(jqXHR, textStatus, errorThrown) {
      console.log("Error en la solicitud AJAX: ", textStatus, errorThrown);
    }
  });
});

// Set new default font family and font color to mimic Bootstrap's default styling
Chart.defaults.global.defaultFontFamily = 'Arial,sans-serif, -apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue"';
Chart.defaults.global.defaultFontColor = '#1C2427';

// Bar Chart Example
var ctx = document.getElementById("charCentroCosto");
var chartCentrCostos = new Chart(ctx, {
  type: 'bar',
  data: {
    labels: ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio"],
    datasets: [{
      label: "Gasto Total (S/.)",
      backgroundColor: "rgba(2,117,216,0.8)",
      borderColor: "rgba(2,117,216,1)",
    }],
  },
  options: {
    scales: {
      xAxes: [{
        time: {
          unit: 'month'
        },
        gridLines: {
          display: false
        },
        ticks: {
          maxTicksLimit: 6
        }
      }],
      yAxes: [{
        ticks: {
          min: 0,
          max: 6000,
          maxTicksLimit: 5
        },
        gridLines: {
          display: true
        }
      }],
    },
    legend: {
      display: false
    }
  }
});

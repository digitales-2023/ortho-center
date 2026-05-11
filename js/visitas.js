//  Costo procedimiento y calcular saldo
$(".formularioAgregarVisita").on("change", ".referenciaVisitaForm", function () {
  var referenciaVisita = $(".referenciaVisitaForm").val();
  if (referenciaVisita === 0) {
    $("#costoProcedimientoForm").val("0");
  } else {
    var datos = new FormData();
    datos.append("referenciaVisita", referenciaVisita);
    $.ajax({
      url: "ajax/visitas.ajax.php",
      method: "POST",
      data: datos,
      cache: false,
      contentType: false,
      processData: false,
      dataType: "json",

      success: function (respuesta) {
        $(".costoProcedimientoForm").val(respuesta["PrecioProcedimiento"]);
        $(".saldoProcedimientoForm").val(respuesta["PrecioProcedimiento"]);
        $(".pagoVisitaForm").val(0);
      }
    });
  }
});

//  Calcular el saldo a partir de la cuenta
$(".formularioAgregarVisita").on("change", ".pagoVisitaForm", function () {
  var pagoVisita = $(".pagoVisitaForm").val();
  var costoProcedimiento = $("#costoProcedimientoForm").val();
  if (costoProcedimiento > 0) {
    var saldoActual = costoProcedimiento - pagoVisita;
    if (saldoActual < 0) {
      $(".pagoVisitaForm").val(0);
      $(".saldoProcedimientoForm").val(costoProcedimiento);
      Swal.fire({
        icon: 'error',
        title: 'Error',
        text: '¡El valor no puede ser mayor al costo del procedimiento!',
      });
    } else {
      $(".saldoProcedimientoForm").val(saldoActual);
    }
  } else {
    if (pagoVisita < 0) {
      $(".pagoVisitaForm").val(0);
      Swal.fire({
        icon: 'error',
        title: 'Error',
        text: '¡El valor no puede ser negativo!',
      });
    } else {
      $(".saldoProcedimientoForm").val(saldoActual);
    }
  }
});

$(".nuevaVisitaAgregar").on("click", "button.eliminarVisita", function () {
  var codVisita = $(this).attr("codVisita");
  if (codVisita == undefined) {
    $(this).parent().parent().parent().parent().remove();
  } else {
    swal.fire({
      title: '¿Está seguro de borrar este registro?',
      text: '¡Los datos se perderán y no podrán recuperarse!',
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      cancelButtonText: 'Cancelar',
      confirmButtonText: 'Si, borrar visita!'
    }).then((result) => {
      if (result.isConfirmed) {
        var datos = new FormData();
        datos.append("codVisitaEliminar", codVisita);
        $.ajax({
          url: "ajax/visitas.ajax.php",
          method: "POST",
          data: datos,
          cache: false,
          contentType: false,
          processData: false,
          dataType: "json",

          success: function (respuesta) {
            if (respuesta == "ok") {
              $(this).parent().parent().parent().parent().remove();
              Swal.fire({
                icon: 'success',
                title: 'Correcto',
                text: '¡Visita eliminada correctamente!',
              }).then(function (result) {
                if (result.value) {
                  location.reload(true);
                }
              });
            } else {
              Swal.fire({
                icon: 'error',
                title: 'Error',
                text: '¡Error al tratar de eliminar la visita!',
              });
            }
          }
        });
      }
    });
  }
  listarVisitas();
});

//  Listar la visita en la lista de visitas
$(".formularioAgregarVisita").on("click", ".btnRegistrarVisita", function () {
  var motivoVisita = $(".motivoVisitaForm").val();
  var fechaVisita = $(".fechaVisitaForm").val();
  var referenciaVisita = $(".referenciaVisitaForm").val();
  var costoVisita = $(".costoProcedimientoForm").val();
  var pagoVisita = $(".pagoVisitaForm").val();
  var saldoVisita = $(".saldoProcedimientoForm").val();

  $(".nuevaVisitaAgregar").append(
    '<div class="row" style="padding:5px 15px">' +
    '<div class="col-lg-3" style="padding-right:0px">' +
    '<div class="input-group">' +
    '<span class="input-group-addon"><button type="button" class="btn btn-danger btn-xs eliminarVisita"><i class="fa fa-times"></i></button></span>' +
    '<input type="text" class="form-control motivoVisita" value="' + motivoVisita + '" readonly>' +
    '</div>' +
    '</div>' +

    '<div class="col-lg-2">' +
    '<input type="date" class="form-control fechaVisita" name="fechaVisita" id="fechaVisita" value="' + fechaVisita + '" >' +
    '</div>' +

    '<div class="col-lg-2">' +
    '<input  type="text" class="form-control referenciaVisita" name="referenciaVisita" id="referenciaVisita" value="' + referenciaVisita + '" readonly>' +
    '</div>' +

    '<div class="col-lg-1">' +
    '<input  type="text" class="form-control costoProcedimiento" name="costoProcedimiento" id="costoProcedimiento" value="' + costoVisita + '" readonly>' +
    '</div>' +

    '<div class="col-lg-2">' +
    '<input type="number" class="form-control acuentaProcedimiento" name="acuentaProcedimiento" id="acuentaProcedimiento" value="' + pagoVisita + '">' +
    '</div>' +

    '<div class="col-lg-2">' +
    '<input type="number" class="form-control saldoProcedimiento" name="saldoProcedimiento" id="saldoProcedimiento" value="' + saldoVisita + '" readonly>' +
    '</div>' +
    '</div>'
  );
  listarVisitas();
});

//  Listar la lista de visitas
function listarVisitas() {
  var listarVisitasPaciente = [];
  var motivoVisita = $(".motivoVisita");
  var fechaVisita = $(".fechaVisita");
  var referenciaVisita = $(".referenciaVisita");
  var costoProcedimiento = $(".costoProcedimiento");
  var pagoVisita = $(".acuentaProcedimiento");
  var saldoProcedimiento = $(".saldoProcedimiento");

  for (var i = 0; i < motivoVisita.length; i++) {
    listarVisitasPaciente.push({
      "motivoVisita": $(motivoVisita[i]).val(),
      "fechaVisita": $(fechaVisita[i]).val(),
      "referenciaVisita": $(referenciaVisita[i]).val(),
      "costoProcedimiento": $(costoProcedimiento[i]).val(),
      "pagoVisita": $(pagoVisita[i]).val(),
      "saldoProcedimiento": $(saldoProcedimiento[i]).val()
    });
  }
  $("#listarNuevaListaVisitas").val(JSON.stringify(listarVisitasPaciente));
}

//  Boton para redirigir la vista actual a la de historia clinica
$(".cerrarVisita").on("click", function () {
  window.location = "index.php?ruta=historiaClinica";
});


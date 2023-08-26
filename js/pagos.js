//  Alerta para eliminar un gasto Fijo
$(".table").on("click", ".btnEliminarPago", function () {
  var codPago = $(this).attr("codPago");
  swal.fire({
    title: '¿Está seguro de borrar este Pago?',
    text: "¡No podrá revertir el cambio!",
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    cancelButtonText: 'Cancelar',
    confirmButtonText: 'Si, borrar historia!'
  }).then((result) => {
    if (result.isConfirmed) {
      window.location = "index.php?ruta=historialPagos&codPago="+codPago;
    }
  });
});

//  Buscar el numero de DNI en la base de datos para que se muestre el nombre del paciente
$(".formularioGenerarPago").on("click", ".btnBuscarPorDNI", function () {
  var numeroDNI = $('#dniPacientePago').val();
  if(numeroDNI != '')
  {
    var datos = new FormData();
    datos.append("numeroDNI", numeroDNI);
    $.ajax({
      url: "ajax/pacientes.ajax.php",
      method: "POST",
      data: datos,
      cache: false,
      contentType: false,
      processData: false,
      dataType: "json",

      success: function (respuesta) {
        if(respuesta["NombrePaciente"] != null || respuesta["NombrePaciente"] != undefined )
        {
          nombrePaciente = respuesta["NombrePaciente"]+' '+respuesta["ApellidoPaciente"];
          codPaciente = respuesta["IdPaciente"];
          $("#nombrePaciente").val(nombrePaciente);
          $("#codPaciente").val(codPaciente);
        }
        else
        {
          Swal.fire({
            icon: 'error',
            title: 'Error',
            text: '¡No se pudo encontrar el numero de DNI!',
          });
          $("#nombrePaciente").val('');
          $("#dniPacientePago").val('');
        }
      },
      error: function(jqXHR, textStatus, errorThrown) {
        console.log("Error en la solicitud AJAX: ", textStatus, errorThrown);
      } 
    });
  }
  else
  {
    Swal.fire({
      icon: 'error',
      title: 'Error',
      text: '¡No se pudo encontrar el numero de DNI!',
    });
    $("#nombrePaciente").val('');
    $("#dniPacientePago").val('');
  }
});

//  Registrar el pago en la base de datos, no se puede registrar si no se tiene el numero del DNI.
$(".formularioGenerarPago").on("click", ".btnGenerarPago", function () {
  var nombrePaciente = $('#nombrePaciente').val();  
  var codPaciente = $('#codPaciente').val();
  var tipoPago = $('#tipoDePago').val();
  var montoDePago = $('#montoDePago').val();
  var fechaPago = $('#fechaPago').val();
  var observacionPago = $('#observacionPago').val();
  var files = $('#comprobantePago')[0].files[0];
  
  //  Falta considerar si se podrá subir archivos o no, de ser el caso aquí se trabajaría el documento a subir 
  var datos = new FormData();
  datos.append("codPaciente", codPaciente);
  datos.append("tipoPago", tipoPago);
  datos.append("montoDePago", montoDePago);
  datos.append("fechaPago", fechaPago);
  datos.append("observacionPago", observacionPago);
  datos.append("comprobantePago", files);

  if(nombrePaciente != '' && montoDePago != ''&& fechaPago != '')
  {
    $.ajax({
      url: "ajax/pagos.ajax.php",
      method: "POST",
      data: datos,
      cache: false,
      contentType: false,
      processData: false,
      dataType: "json",
      success: function (respuesta) {
        valor = respuesta;
        console.log(valor);
        if(respuesta == "ok")
        {
          Swal.fire({
            icon: 'success',
            title: 'Correcto',
            text: '¡Pago Registrado Exitosamente!',
          }).then((result) => {
            if (result.isConfirmed) {
              window.location = "index.php?ruta=historialPagos";
            }
          });
        }
        else if (respuesta == "errorFormato") {
          Swal.fire({
            icon: 'warning',
            title: 'Correcto',
            text: '¡El pago se registró, pero el documento no. Solo se aceptan formatos JPG, JPEG, PNG y PDF!',
          }).then((result) => {
            if (result.isConfirmed) {
              window.location = "index.php?ruta=historialPagos";
            }
          });
        } else {
          Swal.fire({
            icon: 'error',
            title: 'Error',
            text: '¡Error al Registrar el Pago, vuelva a ingresar los datos!',
          }).then((result) => {
            if (result.isConfirmed) {
              window.location = "index.php?ruta=historialPagos";
            }
          });
        }
      },
      error: function(jqXHR, textStatus, errorThrown) {
        console.log("Error en la solicitud AJAX: ", textStatus, errorThrown);
      } 
    });
  }
  else
  {
    Swal.fire({
      icon: 'error',
      title: 'Error',
      text: '¡No se puede registrar la acción, faltan datos!',
    }).then(
      $("#dniPacientePago").val(''),
    );
  }
});

$(".table").on("click", ".btnEditarPago", function () {
  var codPago = $(this).attr("codPago");
  var datos = new FormData();

  datos.append("codPagoEditar", codPago);
  $.ajax({
    url: "ajax/pagos.ajax.php",
    method: "POST",
    data: datos,
    cache: false,
    contentType: false,
    processData: false,
    dataType: "json",
    success: function (respuesta) {
      dniPaciente = respuesta["DNIPaciente"];
      nombrePaciente = respuesta["NombrePaciente"]+' '+respuesta["ApellidoPaciente"];
      totalPago = respuesta["TotalPago"];
      fechaPago = respuesta["FechaPago"];
      observacionPago = respuesta["ObservacionPago"];
      codPaciente = respuesta["IdPaciente"];
      codTipoPago = respuesta["IdTipoPago"];
      codPago = respuesta["IdPago"];

      //  Devolvemos los valores de lo pagado al modal de editar pago
      $("#editarDNIPaciente").val(dniPaciente);
      $("#editarNombrePaciente").val(nombrePaciente);
      $("#editarTipoPago").val(codTipoPago);
      $("#editarMontoPago").val(totalPago);
      $("#editarFechaPago").val(fechaPago);
      $("#editarObservacion").val(observacionPago);
      $("#codPacienteEditado").val(codPaciente);
      $("#codPagoEdit").val(codPago);
    }
  });
});

//  Buscar el numero de DNI en la base de datos para que se muestre el nombre del paciente
$(".formularioEditarPago").on("click", ".btnBuscarPorDNI", function () {
  var numeroDNI = $('#editarDNIPaciente').val();
  if(numeroDNI != '')
  {
    var datos = new FormData();
    datos.append("numeroDNI", numeroDNI);
    $.ajax({
      url: "ajax/pacientes.ajax.php",
      method: "POST",
      data: datos,
      cache: false,
      contentType: false,
      processData: false,
      dataType: "json",

      success: function (respuesta) {
        if(respuesta["NombrePaciente"] != null || respuesta["NombrePaciente"] != undefined )
        {
          nombrePaciente = respuesta["NombrePaciente"]+' '+respuesta["ApellidoPaciente"];
          codPaciente = respuesta["IdPaciente"];
          $("#editarNombrePaciente").val(nombrePaciente);
          $("#codPacienteEditado").val(codPaciente);
        }
        else
        {
          Swal.fire({
            icon: 'error',
            title: 'Error',
            text: '¡No se pudo encontrar el numero de DNI!',
          });
          $("#editarNombrePaciente").val('');
          $("#editarDNIPaciente").val('');
        }
      },
      error: function(jqXHR, textStatus, errorThrown) {
        console.log("Error en la solicitud AJAX: ", textStatus, errorThrown);
      } 
    });
  }
  else
  {
    Swal.fire({
      icon: 'error',
      title: 'Error',
      text: '¡No se pudo encontrar el numero de DNI!',
    });
    $("#editarNombrePaciente").val('');
    $("#editarDNIPaciente").val('');
  }
});

//  Redirigir la vista para visualizar los pagos actuales
$(".table").on("click", ".btnVisualizarPagos", function () {
  var codPaciente = $(this).attr("codPaciente");
  var codHistoria = $(this).attr("codHistoria");
  if(codPaciente!=null && codPaciente!=null)
  {
    window.location = "index.php?ruta=visualizarPagos&codPaciente="+codPaciente+"&codHistoria="+codHistoria;
  }
});

//  Boton para redirigir la vista actual a la de costos
$(".cerrarVisualizar").on("click", function(){
  window.location = "index.php?ruta=pagosPendientes";
});

//  Descargar la historia clínica completa con el detalle de los procedimientos más
$(".table").on("click", ".btnFichaPagos", function () {
  codPaciente = $(this).attr('codPaciente');
  if(codPaciente != null || codPaciente != undefined || codPaciente != '')
  {
    window.open("library/FPDF/printFichaPago.php?&codPaciente=" + codPaciente, "_blank");
  }
  else
  {
    Swal.fire({
      icon: 'error',
      title: 'Error',
      text: '¡No se encontró una Ficha de Pagos!',
    });
  }
});

//  Descargar el comprobante
$(".table").on("click", ".btnDescargarPago", function () {
  codPago = $(this).attr('codPago');
  var datos = new FormData();
  datos.append('codPagoDescargar', codPago);
  $.ajax({
    url:"ajax/pagos.ajax.php",
    method: "POST",
    data: datos,
    cache: false,
    contentType: false,
    processData: false,
    dataType: "json",
    success: function(devolver)
    {
      archivo = devolver["archivo"];
      ruta = devolver["ruta"];
      if(archivo!=null)
      {
        $.get(ruta).done(function(){
            window.open(ruta, '_blank'); 
        });
      }
      else
      {
        Swal.fire({
          icon: 'error',
          title: 'Error',
          text: '¡No se encontró un documento guardado!',
        });
      }
    }
  });
});

$(".nuevoProcedimientoAgregar").on("click", ".btnDescargarPago", function () {
  codPago = $(this).attr('codPago');
  var datos = new FormData();
  datos.append('codPagoDescargar', codPago);
  $.ajax({
    url:"ajax/pagos.ajax.php",
    method: "POST",
    data: datos,
    cache: false,
    contentType: false,
    processData: false,
    dataType: "json",
    success: function(devolver)
    {
      archivo = devolver["archivo"];
      ruta = devolver["ruta"];
      if(archivo!==null)
      {
        $.get(ruta).done(function(){
            window.open(ruta, '_blank'); 
        });
      }
      else
      {
        Swal.fire({
          icon: 'error',
          title: 'Error',
          text: '¡No se encontró un documento guardado!',
        });
      }
    }
  });
});

//  Descargar todos los pagos realizados
$("#descargarPagos").on("click", function(){
  window.location = "view/modules/descargar-reporte.php?&descargarPagos";
});
//  Buscar el numero de DNI en la base de datos para que se muestre el nombre del paciente
$(".formularioAgregarCita").on("click", ".btnBuscarPorDNICita", function () {
  var numeroDNI = $('#dniPacienteCita').val();
  if(numeroDNI != '')
  {
    var datos = new FormData();
    datos.append("numeroDNICita", numeroDNI);
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
          celularPaciente = respuesta["CelularPaciente"];
          dniPaciente = respuesta["DNIPaciente"];
          codPaciente = respuesta["IdPaciente"];
          $("#nombrePacienteCita").val(nombrePaciente);
          $("#celularPacienteCita").val(celularPaciente);
          $("#codPacienteCita").val(codPaciente);
        }
        else
        {
          Swal.fire({
            icon: 'error',
            title: 'Error',
            text: '¡No se pudo encontrar el numero de DNI!',
          });
          $("#nombrePacienteCita").val('');
          $("#dniPacienteCita").val('');
          $("#celularPacienteCita").val('');
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
    $("#nombrePacienteCita").val('');
    $("#dniPacienteCita").val('');
    $("#celularPacienteCita").val('');
  }
});

//  Enviar los datos al modal de editar cita
$(".table").on("click", ".btnEditarCita", function () {
  var codCita = $(this).attr("codCita");
  var datos = new FormData();

  datos.append("codCitaEditar", codCita);
  $.ajax({
    url: "ajax/citas.ajax.php",
    method: "POST",
    data: datos,
    cache: false,
    contentType: false,
    processData: false,
    dataType: "json",
    success: function (respuesta) {
      dniPaciente = respuesta["DNIPaciente"];
      nombrePaciente = respuesta["NombrePaciente"]+' '+respuesta["ApellidoPaciente"];
      celularPaciente = respuesta["CelularPaciente"];
      fechaProgramada = respuesta["FechaProgramada"];
      codMedicoAsignado = respuesta["MedicoAsignado"];
      codPaciente = respuesta["IdPaciente"];
      codCita = respuesta["IdCita"];

      //  Devolvemos los valores de lo pagado al modal de editar pago
      $("#dniPacienteCitaEditar").val(dniPaciente);
      $("#nombrePacienteCitaEditar").val(nombrePaciente);
      $("#celularPacienteCitaEditar").val(celularPaciente);
      $("#fechaProgramacionEditar").val(fechaProgramada);
      $("#medicoAsignadoCitaEditar").val(codMedicoAsignado);
      $("#codCitaEditar").val(codCita);
      $("#codPacienteCitaEditar").val(codPaciente);
    }
  });
});

//  Eliminar una cita
$(".table").on("click", ".btnEliminarCita", function () {
  var codCita = $(this).attr("codCita");
  swal.fire({
    title: '¿Está seguro de borrar la cita?',
    text: "¡No podrá revertir el cambio!",
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    cancelButtonText: 'Cancelar',
    confirmButtonText: 'Si, borrar cita!'
  }).then((result) => {
    if (result.isConfirmed) {
      window.location = "index.php?ruta=programacionCitas&codCita="+codCita;
    }
  });
});
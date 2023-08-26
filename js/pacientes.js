//  Mostrar los datos en el modal para editar un paciente
$(".table").on("click", ".btnEditarPaciente", function () {
  var codPaciente = $(this).attr("codPaciente");
  var datos = new FormData();

  datos.append("codPaciente", codPaciente);
  $.ajax({
    url: "ajax/pacientes.ajax.php",
    method: "POST",
    data: datos,
    cache: false,
    contentType: false,
    processData: false,
    dataType: "json",

    success: function (respuesta) {
      $("#editarNombrePaciente").val(respuesta["NombrePaciente"]);
      $("#editarApellidoPaciente").val(respuesta["ApellidoPaciente"]);
      $("#editarDNIPaciente").val(respuesta["DNIPaciente"]);
      $("#editarCelularPaciente").val(respuesta["CelularPaciente"]);
      $("#codPaciente").val(respuesta["IdPaciente"]);
    }
  });
});

//  Alerta para eliminar un paciente
$(".table").on("click", ".btnEliminarPaciente", function () {
  var codPaciente = $(this).attr("codPaciente");

  swal.fire({
    title: '¿Está seguro de borrar el paciente?',
    text: "¡No podrá revertir el cambio!",
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    cancelButtonText: 'Cancelar',
    confirmButtonText: 'Si, borrar paciente!'
  }).then((result) => {
    if (result.isConfirmed) {
      window.location = "index.php?ruta=pacientes&codPaciente="+codPaciente;
    }
  });
});

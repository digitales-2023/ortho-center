//  Mostrar los datos en el modal para editar un procedimiento
$(".table").on("click", ".btnEditarProcedimiento", function () {
  var codProcedimiento = $(this).attr("codProcedimiento");
  var datos = new FormData();

  datos.append("codProcedimiento", codProcedimiento);
  $.ajax({
    url: "ajax/procedimientos.ajax.php",
    method: "POST",
    data: datos,
    cache: false,
    contentType: false,
    processData: false,
    dataType: "json",

    success: function (respuesta) {
      $("#editarNombreProcedimiento").val(respuesta["NombreProcedimiento"]);
      $("#editarTipoProcedimiento").val(respuesta["NombreTipoProcedimiento"]);
      $("#editarPrecioProcedimiento").val(respuesta["PrecioPromedio"]);
      $("#codProcedimiento").val(respuesta["IdProcedimiento"]);
    }
  });
});

//  Alerta para eliminar un paciente
$(".table").on("click", ".btnEliminarProcedimiento", function () {
  var codProcedimiento = $(this).attr("codProcedimiento");

  swal.fire({
    title: '¿Está seguro de borrar el procedimiento?',
    text: "¡No podrá revertir el cambio!",
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    cancelButtonText: 'Cancelar',
    confirmButtonText: 'Si, borrar procedimiento!'
  }).then((result) => {
    if (result.isConfirmed) {
      window.location = "index.php?ruta=procedimientos&codProcedimiento="+codProcedimiento;
    }
  });
});

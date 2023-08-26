//  Mostrar los datos en el modal para editar usuario
$(".table").on("click", ".btnEditarGasto", function () {
  var codGasto = $(this).attr("codGasto");
  var datos = new FormData();

  datos.append("codGasto", codGasto);
  $.ajax({
    url: "ajax/gastos.ajax.php",
    method: "POST",
    data: datos,
    cache: false,
    contentType: false,
    processData: false,
    dataType: "json",

    success: function (respuesta) {
      $("#editarNombreGasto").val(respuesta["NombreGasto"]);
      $("#editarCentroCosto").val(respuesta["DescripcionCentro"]);
      $("#codGasto").val(respuesta["IdGasto"]);
    }
  });
});

//  Alerta para eliminar un gasto
$(".table").on("click", ".btnEliminarGasto", function () {
  var codGasto = $(this).attr("codGasto");

  swal.fire({
    title: '¿Está seguro de borrar el gasto?',
    text: "¡No podrá revertir el cambio!",
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    cancelButtonText: 'Cancelar',
    confirmButtonText: 'Si, borrar gasto!'
  }).then((result) => {
    if (result.isConfirmed) {
      window.location = "index.php?ruta=gastos&codGasto="+codGasto;
    }
  });
});

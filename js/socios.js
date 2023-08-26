//  Mostrar los datos en el modal para editar un socio
$(".table").on("click", ".btnEditarSocio", function () {
  var codSocio = $(this).attr("codSocio");
  var datos = new FormData();

  datos.append("codSocio", codSocio);
  $.ajax({
    url: "ajax/socios.ajax.php",
    method: "POST",
    data: datos,
    cache: false,
    contentType: false,
    processData: false,
    dataType: "json",

    success: function (respuesta) {
      $("#editarNombreSocio").val(respuesta["NombreSocio"]);
      $("#editarTipoIdentificacion").val(respuesta["NombreTipoIdentificacion"]);
      $("#editarNumeroIdentificacion").val(respuesta["Identificacion"]);
      $("#codSocio").val(respuesta["IdSocio"]);
    }
  });
});

//  Alerta para eliminar un socio
$(".table").on("click", ".btnEliminarSocio", function () {
  var codSocio = $(this).attr("codSocio");

  swal.fire({
    title: '¿Está seguro de borrar el socio?',
    text: "¡No podrá revertir el cambio!",
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    cancelButtonText: 'Cancelar',
    confirmButtonText: 'Si, borrar socio!'
  }).then((result) => {
    if (result.isConfirmed) {
      window.location = "index.php?ruta=socios&codSocio="+codSocio;
    }
  });
});

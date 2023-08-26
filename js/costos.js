//  Mostrar los datos en el modal para editar centro de costos
$(".table").on("click", ".btnEditarCentro", function () {
  var codCentroCosto = $(this).attr("codCentroCosto");
  var datos = new FormData();

  datos.append("codCentroCosto", codCentroCosto);
  $.ajax({
    url: "ajax/costos.ajax.php",
    method: "POST",
    data: datos,
    cache: false,
    contentType: false,
    processData: false,
    dataType: "json",

    success: function (respuesta) {
      $("#editarNombreCentro").val(respuesta["DescripcionCentro"]);
      $("#codCentroCosto").val(respuesta["IdCentroCostos"]);
    }
  });
});

//  Alerta para eliminar un centro de costos
$(".table").on("click", ".btnEliminarCentro", function () {
  var codCentroCosto = $(this).attr("codCentroCosto");

  swal.fire({
    title: '¿Está seguro de borrar el centro de costos?',
    text: "¡No podrá revertir el cambio!",
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    cancelButtonText: 'Cancelar',
    confirmButtonText: 'Si, borrar Centro de Costos!'
  }).then((result) => {
    if (result.isConfirmed) {
      window.location = "index.php?ruta=centroCostos&codCentroCosto="+codCentroCosto;
    }
  });
});

//  Alerta para eliminar un centro de costos
$(".table").on("click", ".btnFinalizarEstado", function () {
  var codCerrarCosto = $(this).attr("codCosto");

  swal.fire({
    title: '¿Está seguro de cerrar los costos de este mes?',
    text: "No podrá realizar modificaciones después de esta acción",
    icon: 'question',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    cancelButtonText: 'Cancelar',
    confirmButtonText: 'Si, cerrar costos mensuales!'
  }).then((result) => {
    if (result.isConfirmed) {
      window.location = "index.php?ruta=allCostos&codCerrarCosto="+codCerrarCosto;
    }
  });
});

//  Redirigir la vista para crear un nuevo gasto 
$("#btnNuevoCosto").on("click", function(){
  window.location = "index.php?ruta=crearNuevoCosto";
});

//  Boton para redirigir la vista actual a la de costos
$(".cerrarCosto").on("click", function(){
  window.location = "index.php?ruta=allCostos";
});

//  Redirigir la vista para editar un gasto
$(".table").on("click", ".btnEditarCosto", function () {
  var codCosto = $(this).attr("codCosto");
  if(codCosto!=null)
  {
    window.location = "index.php?ruta=editarCosto&codCosto="+codCosto;
  }
});

//  Agregar los productos del modal al detalle del ingreso
$(".tablaGastos").on("click", ".btnAgregarGasto", function(){
  
  var codGastoAgregar = $(this).attr("codGasto");
  // $(this).removeClass("btn-primary btnAgregarGasto");
  // $(this).addClass("btn-default disabled");

  var datos = new FormData();
  datos.append("codGastoAgregar", codGastoAgregar);
  $.ajax({
    url:"ajax/gastos.ajax.php",
    method: "POST",
    data: datos,
    cache: false,
    contentType: false,
    processData: false,
    dataType:"json",
    success:function(respuesta)
    {
      var idGasto = respuesta["IdGasto"];
      var nombreGasto = respuesta["NombreGasto"];
      var opcionesSocios = respuesta["OpcionesSocios"];

      var selectSocios = '<select class="form-select nuevoSocio" name="nuevoSocio">';
      opcionesSocios.forEach(function (opcion) {
        selectSocios += '<option value="' + opcion.IdSocio + '">' + opcion.NombreSocio + '</option>';
      });
      selectSocios += '</select>';

      $(".nuevoGasto").append(
      '<div class="row" style="padding:5px 15px">'+

        '<!-- Descripción del producto -->'+          
        '<div class="col-lg-2" style="padding-right:0px">'+
          '<div class="input-group">'+
            '<span class="input-group-addon"><button type="button" class="btn btn-danger btn-xs quitarGasto" idGasto="'+idGasto+'"><i class="fa fa-times"></i></button></span>'+
            '<input type="text" class="form-control nuevogasto" idGasto="'+idGasto+'" value="'+nombreGasto+'" readonly>'+
          '</div>'+
        '</div>'+

        '<!-- Observacion -->'+
        '<div class="col-lg-2 ingresoObservacionGasto">'+
          '<input type="text" class="form-control nuevaObservacionGasto" name="nuevaObservacionGasto" >'+
        '</div>' +

        '<!-- Cantidad del producto -->'+
        '<div class="col-lg-1 ingresoCantidad">'+
          '<input type="number" class="form-control cantidadGasto" name="cantidadGasto" value="1" readonly>'+
        '</div>' +

        '<!-- Socio -->'+
        '<div class="form-group col-lg-2 ingresoSocio">'+
          selectSocios+
        '</div>'+

        '<!-- Numero Documento -->'+
        '<div class="col-lg-2 ingresoNroDocumento">'+
          '<input type="text" class="form-control nuevonNroDocumento" name="nuevonNroDocumento" required>'+
        '</div>' +

        '<!-- Fecha de Documento -->'+
        '<div class="col-lg-2 ingresoFecha">'+
          '<input type="date" class="form-control nuevaFechaDocumento" name="nuevaFechaDocumento" required>'+
        '</div>' +

        '<!-- Precio del Gasto -->'+
        '<div class="col-lg-1 ingresoPrecioGasto">'+
          '<input type="number" class="form-control nuevoCostoGasto" name="nuevoCostoGasto" min="1.00" step="0.01" required>'+
        '</div>' +

      '</div>'
      );
      listarGastos();
      sumarListaGastos();
    },
    error: function(jqXHR, textStatus, errorThrown) {
      console.log("Error en la solicitud AJAX: ", textStatus, errorThrown);
    } 
	});
});

//  Quitar los producto del ingreso
$(".formularioNuevoCosto").on("click", "button.quitarGasto", function(){
  //  Eliminar el elemento listado
  $(this).parent().parent().parent().parent().remove();
  var idGasto = $(this).attr("idGasto");
  //  reactivar el boton del producto en el modal
  // $("button.recuperarBoton[codGasto='"+idGasto+"']").removeClass('btn-default disabled');
  // $("button.recuperarBoton[codGasto='"+idGasto+"']").addClass('btn-primary btnAgregarGasto');

  listarGastos();
  sumarListaGastos();
});

//  Actualizar al modificar el costo
$(".formularioNuevoCosto").on("change", "input.nuevoCostoGasto", function(){
  listarGastos();
  sumarListaGastos();
});

//  Actualizar al modificar el nro de documento
$(".formularioNuevoCosto").on("change", "input.nuevonNroDocumento", function(){
  listarGastos();
  sumarListaGastos();
});

//  Actualizar al modificar la fecha de documento
$(".formularioNuevoCosto").on("change", "input.nuevaFechaDocumento", function(){
  listarGastos();
  sumarListaGastos();
});

//  Actualizar al modificar la observacion 
$(".formularioNuevoCosto").on("change", "input.nuevaObservacionGasto", function(){
  listarGastos();
  sumarListaGastos();
});

//  Actualizar al modificar el socio
$(".formularioNuevoCosto").on("change", "select.nuevoSocio", function(){
  listarGastos();
  sumarListaGastos();
});

//  Alerta para eliminar un gasto Variable
$(".table").on("click", ".btnEliminarCosto", function () {
  var codCosto = $(this).attr("codCosto");
  swal.fire({
    title: '¿Está seguro de borrar el registro?',
    text: "¡No podrá revertir el cambio!",
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    cancelButtonText: 'Cancelar',
    confirmButtonText: 'Si, borrar costo!'
  }).then((result) => {
    if (result.isConfirmed) {
      window.location = "index.php?ruta=allCostos&codCosto="+codCosto;
    }
  });
});

//  Actualizar el modal al momento de modificar el centro de costos, solo mostrará los gastos que tienen este codigo de centro de costos.
$("#centroDeCostos").change(function(){
  //  Al modificar el centro de costos, automáticamente se elimina la lista actual, para evitar que puedan poner varios recursos de distintos centros de costo
  $(".nuevaListaGastos").empty();
  var codCCostosModal = $('#centroDeCostos').val();
  var listaGastos = $('.nuevogasto').val();
  //  Datos para ajax
  var datos = new FormData();
  datos.append("codCCostosModal", codCCostosModal);

  //  Validamos hay una lista de gastos, de ser asi y se selecciona otro valor del select de costos, se le notificará que se borrará toda la lista acumulada del momento.
  if(listaGastos != undefined)
  {
    swal.fire({
      title: '¿Está seguro de cambiar el centro de costos?',
      text: "¡Se borrarán todos los costos seleccionados!",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      cancelButtonText: 'Cancelar',
      confirmButtonText: 'Si, borrar costo!'
    }).then((result) => {
      if (result.isConfirmed) 
      {
        var divVaciar = document.getElementById("nuevaListaGastos");
        divVaciar.innerHTML = "";

        // Crear un nuevo elemento <input> de tipo "hidden"
        var nuevoInput = document.createElement("input");
        nuevoInput.type = "hidden";
        nuevoInput.id = "listarGastos";
        nuevoInput.name = "listarGastos";

        // Agregar el nuevo elemento <input> al elemento divVaciar
        divVaciar.appendChild(nuevoInput);
        divVaciar.add;
      }
      else
      {
        $(".nuevaListaGastos").empty();
      }
    });
  }

  $.ajax({
    url:"ajax/gastos.ajax.php",
    method: "POST",
    data: datos,
    cache: false,
    contentType: false,
    processData: false,
    dataType:"json",
    success:function(respuesta)
    {
      respuesta.forEach(elemento => {
        $(".nuevaListaGastos").append(
          '<tr id="nuevoRecurso">'+
            '<td>'+elemento["NombreGasto"]+'</td>'+
            '<td>'+
              '<div class="btn-group">'+
                '<button class="btn btn-primary btnAgregarGasto recuperarBoton" codGasto="'+elemento["IdGasto"]+'">Agregar</button>'+
              '</div>'+
            '</td>'+
          '</tr>'
        );
      });
    },
    error: function(jqXHR, textStatus, errorThrown) {
      console.log("Error en la solicitud AJAX: ", textStatus, errorThrown);
    }
  });
});

//  FUNCIONES PARA SUMAR Y LISTAR LOS PRODUCTOS
function listarGastos()
{
  var listarGastos = [];
  var recurso = $(".nuevogasto")
  var observacion = $(".nuevaObservacionGasto")
  var socio = $(".nuevoSocio")
  var nroDocumento = $(".nuevonNroDocumento")
  var fechaDocumento = $(".nuevaFechaDocumento")
  var precioGasto = $(".nuevoCostoGasto")
  for(var i = 0; i < recurso.length; i++)
  {
    listarGastos.push({
      "CodGasto" : $(recurso[i]).attr("idGasto"),
      "Observacion" : $(observacion[i]).val(),
      "Socio" : $(socio[i]).val(),
      "NroDocumento" : $(nroDocumento[i]).val(),
      "FechaDocumento" : $(fechaDocumento[i]).val(),
      "PrecioGasto" : $(precioGasto[i]).val(),
    });
  }
  $("#listarGastos").val(JSON.stringify(listarGastos));
}

function sumarListaGastos()
{
  var precioGasto = $(".nuevoCostoGasto");
  var arraySumaPrecio = []; 

  for(var i = 0; i < precioGasto.length; i++)
  {
    arraySumaPrecio.push(Number($(precioGasto[i]).val()));
  }

  //  Funcion para sumar todos los precios del array
  function sumaArrayPrecios(total, numero)
  {
    return total + numero;
  }

  if(arraySumaPrecio.length == 0)
  {
    var sumaTotalPrecio = 0;
  }
  else
  {
    var sumaTotalPrecio = arraySumaPrecio.reduce(sumaArrayPrecios);
  }

  $("#nuevoTotalGasto").val(sumaTotalPrecio.toFixed(2));
}

$('#dateRangeCosto').daterangepicker({
  opens: 'right',
  locale: {
    format: 'YYYY-MM-DD',
  },
});

// Agrega el evento 'apply.daterangepicker' para manejar la selección de fechas
$('#dateRangeCosto').on('apply.daterangepicker', function(ev, picker) {
  var fechaInicial = picker.startDate.format('YYYY-MM-DD');
  var fechaFinal = picker.endDate.format('YYYY-MM-DD');
  
  sessionStorage.setItem('fechaInicial', fechaInicial);
  sessionStorage.setItem('fechaFinal', fechaFinal);

  var datos = new FormData();
  datos.append("FechaInicial", fechaInicial);
  datos.append("FechaFinal", fechaFinal);

  $.ajax({
    url:"ajax/costos.ajax.php",
    method: "POST",
    data: datos,
    cache: false,
    contentType: false,
    processData: false,
    dataType:"json",
    success:function(respuesta)
    {
      respuesta.forEach(elemento => {
        $(".listaCostosPickFechas").append(
          '<tr>'+
            '<td>'+elemento["DescripcionCentro"]+'</td>'+
            '<td>'+elemento["NombreSocio"]+'</td>'+
            '<td>'+elemento["NombreGasto"]+'</td>'+
            '<td>'+elemento["NumeroDocumento"]+'</td>'+
            '<td>'+elemento["FechaCosto"]+'</td>'+
            '<td>'+elemento["PrecioGasto"]+'</td>'+
          '</tr>'
        );
      });
    },
    error: function(jqXHR, textStatus, errorThrown) {
      console.log("Error en la solicitud AJAX: ", textStatus, errorThrown);
    } 
  });
});

$("#btnDescargarFiltro").on("click", function(){
  fechaInicial = sessionStorage.getItem('fechaInicial');
  fechaFinal = sessionStorage.getItem('fechaFinal');
  
  if(fechaInicial != null || fechaInicial != undefined || fechaInicial != '')
  {
    window.location = "view/modules/descargar-reporte.php?&fechaInicial="+fechaInicial+"&fechaFinal="+fechaFinal;
  }
  else
  {
    Swal.fire({
      icon: 'error',
      title: 'Error',
      text: '¡Intruduzca la Fecha Inicial y Fecha Final!',
    });
  }
});

//  Imprimir un costo en específico
$(".table").on("click", ".btnImprimirGasto", function () {
  var codCosto = $(this).attr("codCosto");
  if(codCosto != null || codCosto != undefined || codCosto != '')
  {
    window.open("library/FPDF/printCostoSelect.php?&codCosto=" + codCosto, "_blank");
  }
  else
  {
    Swal.fire({
      icon: 'error',
      title: 'Error',
      text: '¡No se encontró un código asociado!',
    });
  }
});
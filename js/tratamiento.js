//  Eliminar el elemento listado
$(".formularioPlanTratamiento").on("click", "button.eliminarProcedimiento", function(){
  var codProcedimiento = $(this).attr("codProcedimiento");
  //  Obtengo el valor el estado del procedimiento, si está checked, no se podrá eliminar, caso contrario si se va a eliminar.
  var codEstado = $(this).parent().parent().parent().parent().children('.estadoProcedimiento').children('.editarEstadoProcedimiento').prop('checked');
  console.log(codEstado);
  //  Si el procedimiento está realizado, no se podrá eliminar. Caso contrario, se le notificará si quiere que este elemento se elimine o no, ya que esto puede ocacionar variaciones en el plan de tratamiento original
  if(codEstado == false)
  {
    swal.fire({
      title: '¿Está seguro de borrar este procedimiento?',
      text: "¡Se eliminará del plan de tratamiento original!",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      cancelButtonText: 'Cancelar',
      confirmButtonText: 'Si, borrar historia!'
    }).then((result) => {
      if (result.isConfirmed) {
        $(this).parent().parent().parent().parent().remove();
        listarProcedimientosTratamiento();
        sumaProcedimientosTratamiento();
      }
    });
  }
  else
  {
    Swal.fire({
      icon: 'error',
      title: 'Error',
      text: '¡No se puede eliminar un procedimiento que ya esté realizado!',
    });
  }
});

//  Actualizar al modificar la observacion
$(".formularioPlanTratamiento").on("change", "input.editarObservacionProcedimiento", function(){
  listarProcedimientosTratamiento();
  sumaProcedimientosTratamiento();
});

//  Actualizar al modificar el estado, revisamos la propiedad checked si la tiene o no y en base a eso desactivamos el boton que permita eliminar un procedimiento o no
$(".formularioPlanTratamiento").on("change", "input.editarEstadoProcedimiento", function(){
  var estadoCheckBox = $(this).prop('checked');
  if(estadoCheckBox == true)
  {
    //  Si está con valor true, bloquearemos los valores de fecha intervención, observación y precio
    $(this).prop('checked', true);
    console.log(estadoCheckBox);
  }
  else
  {
    //  Si es false, vamos a habilitar los campos de fecha de intervención, observación y precio
    $(this).prop('checked', false);
    console.log(estadoCheckBox);
  }
  
  listarProcedimientosTratamiento();
  sumaProcedimientosTratamiento();
});

//  Actualizar al modificar la fecha de intervencion
$(".formularioPlanTratamiento").on("change", "input.editarFechaIntervencion", function(){
  listarProcedimientosTratamiento();
  sumaProcedimientosTratamiento();
});

//  Actualizar al modificar el precio
$(".formularioPlanTratamiento").on("change", "input.editarPrecioTratamiento", function(){
  listarProcedimientosTratamiento();
  sumaProcedimientosTratamiento();
});

//  Agregar nuevos procedimientos al plan de tratamiento
$(".tablaProcedimientosEditar").on("click", ".btnAgregarProcedimiento", function(){
  var codProcedimientoAgregar = $(this).attr("codProcedimiento");

  var datos = new FormData();
  datos.append("codProcedimientoAgregar", codProcedimientoAgregar);
  $.ajax({
    url:"ajax/procedimientos.ajax.php",
    method: "POST",
    data: datos,
    cache: false,
    contentType: false,
    processData: false,
    dataType:"json",
    success:function(respuesta)
    {
      var idProcedimiento = respuesta["IdProcedimiento"];
      var nombreProcedimiento = respuesta["NombreProcedimiento"];
      var precioPromedio = respuesta["PrecioPromedio"];

      $(".nuevoProcedimientoAgregar").append(
      '<div class="row" style="padding:5px 15px">'+

        '<!-- Descripción del procedimiento -->'+          
        '<div class="col-lg-3" style="padding-right:0px">'+
          '<div class="input-group">'+
            '<span class="input-group-addon"><button type="button" class="btn btn-danger btn-xs eliminarProcedimiento" codProcedimiento="'+idProcedimiento+'"><i class="fa fa-times"></i></button></span>'+
            '<input type="text" class="form-control editarProcedimiento" codProcedimiento="'+idProcedimiento+'" value="'+nombreProcedimiento+'" readonly>'+
          '</div>'+
        '</div>'+

        '<!-- Observacion -->'+
        '<div class="col-lg-3 observacionProcedimiento">'+
          '<input type="text" class="form-control editarObservacionProcedimiento" name="editarObservacionProcedimiento">'+
        '</div>' +

        '<!-- Estado -->'+
        '<div class="col-lg-2 form-check form-switch estadoProcedimiento">'+
          '<input type="checkbox" class="form-check-input editarEstadoProcedimiento" name="editarEstadoProcedimiento" id="editarEstadoProcedimiento">'+
          '<label class="form-check-label" for="editarEstadoProcedimiento">Intervencion Realizada</label>'+
        '</div>' +

        '<!-- Fecha del Procedimiento -->'+
        '<div class="col-lg-2 fechaProcedimiento">'+
          '<input type="date" class="form-control editarFechaIntervencion" name="editarFechaIntervencion">'+
        '</div>' +

        '<!-- Precio del procedimiento -->'+
        '<div class="col-lg-2 precioProcedimiento">'+
          '<input type="number" class="form-control editarPrecioTratamiento" name="editarPrecioTratamiento" min="1.00" step="0.01" value="'+precioPromedio+'" required>'+
        '</div>' +

      '</div>'
      );
      listarProcedimientosTratamiento();
      sumaProcedimientosTratamiento();
    },
    error: function(jqXHR, textStatus, errorThrown) {
      console.log("Error en la solicitud AJAX: ", textStatus, errorThrown);
    } 
	});
});


//  FUNCIONES PARA SUMAR Y LISTAR LOS PROCEDIMIENTOS
function listarProcedimientosTratamiento()
{
  var listarProcedimientos = [];
  var procedimiento = $(".editarProcedimiento");
  var observacion = $(".editarObservacionProcedimiento");
  var estado = $(".editarEstadoProcedimiento");
  var fecha = $(".editarFechaIntervencion");
  var precio = $(".editarPrecioTratamiento");

  for(var i = 0; i < procedimiento.length; i++)
  {
    listarProcedimientos.push({
      "CodProcedimiento" : $(procedimiento[i]).attr("codProcedimiento"),
      "ObservacionProcedimiento" : $(observacion[i]).val(),
      "PrecioProcedimiento" : $(precio[i]).val(),
      "EstadoProcedimiento" : $(estado[i]).prop('checked'),
      "FechaProcedimiento" : $(fecha[i]).val(),
    });
  }
  $("#listarNuevaListaProcedimientos").val(JSON.stringify(listarProcedimientos));
}

function sumaProcedimientosTratamiento()
{
  var precioTratamiento = $(".editarPrecioTratamiento");
  var arraySumaPrecio = []; 

  for(var i = 0; i < precioTratamiento.length; i++) {
    arraySumaPrecio.push(Number($(precioTratamiento[i]).val()));
  }

  //  Función para sumar todos los procedimientos
  function sumarProcedimientos(total, numero) {
    return total + numero;
  }

  if(arraySumaPrecio.length == 0) {
    var sumaTotalTratamiento = 0;
  } else {
    var sumaTotalTratamiento = arraySumaPrecio.reduce(sumarProcedimientos);
  }

  $("#editarTotalTratamiento").val(sumaTotalTratamiento.toFixed(2));
}

$("#btnDescargarTratamiento").on("click", function(){
  codHistoria = $(this).attr('codHistoria');
  codPaciente = $(this).attr('codPaciente');
  if(codHistoria != null || codHistoria != undefined || codHistoria != '')
  {
    window.open("library/FPDF/printPlanTratamiento.php?&codHistoria="+codHistoria+'&codPaciente='+codPaciente, "_blank");
  }
  else
  {
    Swal.fire({
      icon: 'error',
      title: 'Error',
      text: '¡No se encontró una Historia Clínica!',
    });
  }
});


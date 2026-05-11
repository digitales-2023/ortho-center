$("#btnCotizacionPacienteNuevo").on("click", function () {
  window.location = "index.php?ruta=crearCotizacion"
});

console.log("✓ cotizacion.js cargado correctamente");

// Verificar que los selectores existen
$(document).ready(function() {
  console.log("✓ Document ready - Verificando selectores...");
  console.log("  → .tablaProcedimientosCotizacion encontrado:", $(".tablaProcedimientosCotizacion").length, "elementos");
  console.log("  → .btnAgregarProcedCotizacion encontrado:", $(".btnAgregarProcedCotizacion").length, "elementos");
  console.log("  → .nuevaListaCotizacion encontrado:", $(".nuevaListaCotizacion").length, "elementos");
  console.log("  → #listarCotizaciones encontrado:", $("#listarCotizaciones").length, "elementos");
  console.log("  → #nuevoTotalCotizacion encontrado:", $("#nuevoTotalCotizacion").length, "elementos");
});

//  Agregar los productos del modal al detalle del ingreso
$(".tablaProcedimientosCotizacion").on("click", ".btnAgregarProcedCotizacion", function () {
  console.log("✓ PASO 1: Click en botón 'Agregar Procedimiento'");
  
  var codProcedimiento = $(this).attr("data-codprocedimiento");
  console.log("  → Atributo data-codprocedimiento:", codProcedimiento);
  
  // Si no encuentra el atributo data-, intenta con el atributo personalizado antiguo
  if (!codProcedimiento) {
    codProcedimiento = $(this).attr("codProcedimiento");
    console.log("  → Usando atributo codProcedimiento (legacy):", codProcedimiento);
  }

  if (!codProcedimiento) {
    console.error("✗ ERROR: No se encontró codProcedimiento");
    return;
  }

  var datos = new FormData();
  datos.append("codProcedimientoAgregar", codProcedimiento);
  
  console.log("✓ PASO 2: FormData preparado con codProcedimientoAgregar:", codProcedimiento);
  
  $.ajax({
    url: "ajax/procedimientos.ajax.php",
    method: "POST",
    data: datos,
    cache: false,
    contentType: false,
    processData: false,
    dataType: "json",
    success: function (respuesta) {
      console.log("✓ PASO 3: AJAX recibió respuesta:", respuesta);
      
      var idProcedimiento = respuesta["IdProcedimiento"];
      var nombreProcedimiento = respuesta["NombreProcedimiento"];
      var precioPromedio = respuesta["PrecioPromedio"];
      
      console.log("  → IdProcedimiento:", idProcedimiento);
      console.log("  → NombreProcedimiento:", nombreProcedimiento);
      console.log("  → PrecioPromedio:", precioPromedio);

      var htmlNuevo = '<div class="row" style="padding:5px 15px">' +
        '<!-- Descripción del procedimiento -->' +
        '<div class="col-lg-4" style="padding-right:0px">' +
        '<div class="input-group">' +
        '<span class="input-group-addon"><button type="button" class="btn btn-danger btn-xs quitarProcedimiento" data-codprocedimiento="' + idProcedimiento + '"><i class="fa fa-times"></i></button></span>' +
        '<input type="text" id="nuevoprocedimiento_' + idProcedimiento + '" name="nuevoprocedimiento_' + idProcedimiento + '" class="form-control nuevoprocedimiento" data-codprocedimiento="' + idProcedimiento + '" value="' + nombreProcedimiento + '" readonly>' +
        '</div>' +
        '</div>' +
        '<!-- Observacion -->' +
        '<div class="col-lg-3">' +
        '<input type="text" id="nuevaObservacionCotizacion_' + idProcedimiento + '" name="nuevaObservacionCotizacion_' + idProcedimiento + '" class="form-control nuevaObservacionCotizacion">' +
        '</div>' +
        '<!-- Cantidad -->' +
        '<div class="col-lg-1 cantidadCotizacion">' +
        '<input type="number" id="nuevaCantidadCotizacion_' + idProcedimiento + '" name="nuevaCantidadCotizacion_' + idProcedimiento + '" class="form-control nuevaCantidadCotizacion" min="1.00" step="1" value="1" required>' +
        '</div>' +
        '<!-- Precio Unitario -->' +
        '<div class="col-lg-2 puCotizacion">' +
        '<input type="number" id="nuevoPrecioUnitarioCotizacion_' + idProcedimiento + '" name="nuevoPrecioUnitarioCotizacion_' + idProcedimiento + '" class="form-control nuevoPrecioUnitarioCotizacion" min="1.00" step="0.01" value="' + precioPromedio + '" required>' +
        '</div>' +
        '<!-- Costo Total -->' +
        '<div class="col-lg-2 totalCotizacion">' +
        '<input type="number" id="nuevoCostoTotalCotizacion_' + idProcedimiento + '" name="nuevoCostoTotalCotizacion_' + idProcedimiento + '" class="form-control nuevoCostoTotalCotizacion" min="1.00" step="0.01" value="' + precioPromedio + '" readonly>' +
        '</div>' +
        '</div>';
      
      console.log("✓ PASO 4: HTML generado. Longitud:", htmlNuevo.length);
      console.log("  → HTML preview:", htmlNuevo.substring(0, 150) + "...");
      
      $(".nuevaListaCotizacion").append(htmlNuevo);
      console.log("✓ PASO 5: HTML insertado en .nuevaListaCotizacion");
      
      console.log("✓ PASO 6: Ejecutando listarCotizacion()");
      listarCotizacion();
      
      console.log("✓ PASO 7: Ejecutando sumarCotizacion()");
      sumarCotizacion();
      
      console.log("✓ PROCESO COMPLETADO EXITOSAMENTE");
    },
    error: function (jqXHR, textStatus, errorThrown) {
      console.error("✗ ERROR en AJAX:");
      console.error("  → Status:", textStatus);
      console.error("  → Error:", errorThrown);
      console.error("  → Response:", jqXHR.responseText);
    }
  });

});

//  Eliminar procedimiento de la cotización
$(".formularioCotizacion").on("click", "button.quitarProcedimiento", function () {
  $(this).parent().parent().parent().parent().remove();

  listarCotizacion();
  sumarCotizacion();
});
//  Al modificar la cantidad
$(".formularioCotizacion").on("change", ".nuevaCantidadCotizacion", function () {
  listarCotizacion();
  sumarCotizacion();
});
//  El editar la observacion
$(".formularioCotizacion").on("change", ".nuevaObservacionCotizacion", function () {
  listarCotizacion();
  sumarCotizacion();
});

//  Cambiar el valor unitario
$(".formularioCotizacion").on("change", "input.nuevoPrecioUnitarioCotizacion", function () {
  var cantidad = $(this).parent().parent().children(".cantidadCotizacion").children(".nuevaCantidadCotizacion");
  var total = $(this).parent().parent().children(".totalCotizacion").children(".nuevoCostoTotalCotizacion");

  var nuevoTotal = $(this).val() * cantidad.val();

  total.val(nuevoTotal.toFixed(2));

  listarCotizacion();
  sumarCotizacion();
});

//  Cambiar la cantidad
$(".formularioCotizacion").on("change", "input.nuevaCantidadCotizacion", function () {
  var precioU = $(this).parent().parent().children(".puCotizacion").children(".nuevoPrecioUnitarioCotizacion");
  var total = $(this).parent().parent().children(".totalCotizacion").children(".nuevoCostoTotalCotizacion");

  var nuevoTotal = $(this).val() * precioU.val();

  total.val(nuevoTotal.toFixed(2));

  listarCotizacion();
  sumarCotizacion();
});

//  Listar todos los procedimientos de la cotización
function listarCotizacion() {
  console.log("  → [listarCotizacion] Iniciando...");
  var listarCotizaciones = [];
  var procedimiento = $(".nuevoprocedimiento")
  var observacion = $(".nuevaObservacionCotizacion")
  var cantidad = $(".nuevaCantidadCotizacion")
  var precioU = $(".nuevoPrecioUnitarioCotizacion")
  var precioT = $(".nuevoCostoTotalCotizacion")
  
  console.log("  → [listarCotizacion] Elementos encontrados:", {
    procedimientos: procedimiento.length,
    observaciones: observacion.length,
    cantidades: cantidad.length,
    precios: precioU.length,
    totales: precioT.length
  });
  
  for (var i = 0; i < procedimiento.length; i++) {
    listarCotizaciones.push({
      "CodProcedimiento": $(procedimiento[i]).data("codprocedimiento") || $(procedimiento[i]).attr("codProcedimiento"),
      "ObservacionCotizacion": $(observacion[i]).val(),
      "CantidadCotizacion": $(cantidad[i]).val(),
      "PrecioUCotizacion": $(precioU[i]).val(),
      "PrecioTCotizacion": $(precioT[i]).val(),
    });
  }
  
  console.log("  → [listarCotizacion] JSON generado:", JSON.stringify(listarCotizaciones));
  $("#listarCotizaciones").val(JSON.stringify(listarCotizaciones));
}

//Sumar los procedimientos
function sumarCotizacion() {
  console.log("  → [sumarCotizacion] Iniciando...");
  var precioCotizacion = $(".nuevoCostoTotalCotizacion");
  var arraySumaProcedimientos = [];
  
  console.log("  → [sumarCotizacion] Elementos '.nuevoCostoTotalCotizacion' encontrados:", precioCotizacion.length);

  for (var i = 0; i < precioCotizacion.length; i++) {
    arraySumaProcedimientos.push(Number($(precioCotizacion[i]).val()));
  }

  //  Función para sumar todos los procedimientos
  function sumarProcedimientos(total, numero) {
    return total + numero;
  }

  if (arraySumaProcedimientos.length == 0) {
    var sumaTotalCotizacion = 0;
    console.log("  → [sumarCotizacion] No hay procedimientos para sumar");
  } else {
    var sumaTotalCotizacion = arraySumaProcedimientos.reduce(sumarProcedimientos);
    console.log("  → [sumarCotizacion] Array de precios:", arraySumaProcedimientos);
    console.log("  → [sumarCotizacion] Total calculado:", sumaTotalCotizacion);
  }

  console.log("  → [sumarCotizacion] Escribiendo en #nuevoTotalCotizacion:", sumaTotalCotizacion.toFixed(2));
  $("#nuevoTotalCotizacion").val(sumaTotalCotizacion.toFixed(2));
}

//  Redirigir la vista para crear una nueva cotización de un paciente
$("#btnCotizacionPacienteExistente").on("click", function () {
  Swal.fire({
    title: 'Ingrese el número de DNI del Paciente',
    input: 'number',
    inputAttributes: {
      autocapitalize: 'off'
    },
    showCancelButton: true,
    confirmButtonText: 'Confirmar',
  }).then((result) => {
    if (result.value) {
      var datos = new FormData();
      numeroDNICotizacion = result.value;
      datos.append("numeroDNICotizacion", numeroDNICotizacion);

      $.ajax({
        url: "ajax/pacientes.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function (respuesta) {
          if (respuesta["respuesta"] == "ok" || respuesta["respuesta"] == "historia") {
            window.location = "index.php?ruta=crearCotizacion&codPaciente=" + respuesta["codPaciente"];
          } else {
            Swal.fire(
              'Error',
              'Número de DNI no registrado',
              'warning'
            );
          }
        },
        error: function (jqXHR, textStatus, errorThrown) {
          console.log("Error en la solicitud AJAX: ", textStatus, errorThrown);
        }
      });
    }
  });
});

//  Eliminar una cotización
$(".table").on("click", ".btnEliminarCotizacion", function () {
  var codCotizacion = $(this).attr("codCotizacion");
  var codEstado = $(this).attr("codEstado");
  swal.fire({
    title: '¿Está seguro de borrar la Cotización?',
    text: "¡No podrá revertir el cambio! Se borrarán todos los datos",
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    cancelButtonText: 'Cancelar',
    confirmButtonText: 'Si, borrar cotización!'
  }).then((result) => {
    if (result.isConfirmed) {
      window.location = "index.php?ruta=cotizaciones&codCotizacionEliminar=" + codCotizacion + "&codEstado=" + codEstado;
    }
  });
});

//  Redirigir la vista a editar cotizacion
$(".table").on("click", ".btnEditarCotizacion", function () {
  var codCotizacion = $(this).attr("codCotizacion");
  if (codCotizacion != null) {
    window.location = "index.php?ruta=editarCotizacion&codCotizacion=" + codCotizacion;
  }
});

//  Redirigir la vista a editar cotizacion
$(".table").on("click", ".btnAprobarCotizacion", function () {
  var codCotizacion = $(this).attr("codCotizacion");
  swal.fire({
    title: '¿Está seguro de aprobar la cotización?',
    text: "¡No podrá revertir el cambio!",
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    cancelButtonText: 'Cancelar',
    confirmButtonText: '¡Si, aprobar cotización!'
  }).then((result) => {
    if (result.isConfirmed) {
      window.location = "index.php?ruta=cotizaciones&codCotizacionAprobar=" + codCotizacion;
    }
  });
});

//  Imprimir un costo en específico
$(".table").on("click", ".btnImprimirCotizacion", function () {
  var codCotizacion = $(this).attr("codCotizacion");
  var codPaciente = $(this).attr("codPaciente");
  if(codCotizacion != null || codCotizacion != '')
  {
    window.open("library/FPDF/printCotizacion.php?&codCotizacion=" + codCotizacion, "_blank");
  }
  else
  {
    Swal.fire({
      icon: 'error',
      title: 'Error',
      text: '¡No se puede imprimir esta cotización!',
    });
  }
});

//  Botón para redirigir la vista actual a la de cotizacion
$(".cerrarCotizacion").on("click", function () {
  window.location = "index.php?ruta=cotizaciones";
});

// Manejadores ARIA e inert para el modal de procedimientos
const modalAgregarProcedimiento = document.getElementById('modalAgregarProcedimiento');

console.log("✓ Modal 'modalAgregarProcedimiento' encontrado:", !!modalAgregarProcedimiento);

if (modalAgregarProcedimiento) {
  console.log("  → Agregando event listeners al modal...");
  
  // Cuando el modal está a punto de mostrarse
  modalAgregarProcedimiento.addEventListener('show.bs.modal', function() {
    console.log("  → Modal: show.bs.modal");
    this.removeAttribute('inert');
  });

  // Cuando el modal está completamente mostrado
  modalAgregarProcedimiento.addEventListener('shown.bs.modal', function() {
    console.log("  → Modal: shown.bs.modal");
    // Enfoca el primer elemento interactivo del modal
    const firstFocusable = this.querySelector('button, [href], input, select, textarea, [tabindex]:not([tabindex="-1"])');
    if (firstFocusable) {
      console.log("  → Enfocando primer elemento:", firstFocusable.tagName, firstFocusable.className);
      firstFocusable.focus();
    }
  });

  // Cuando el modal está a punto de ocultarse
  modalAgregarProcedimiento.addEventListener('hide.bs.modal', function() {
    console.log("  → Modal: hide.bs.modal");
    this.setAttribute('inert', '');
  });

  // Cuando el modal se oculta completamente
  modalAgregarProcedimiento.addEventListener('hidden.bs.modal', function() {
    console.log("  → Modal: hidden.bs.modal");
    this.setAttribute('inert', '');
  });
}
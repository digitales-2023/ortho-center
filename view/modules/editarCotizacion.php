</div>
</div>
<div class="sb-sidenav-footer">
  <div class="small">Sesión iniciada como:</div>
  <?php echo $_SESSION["nombreUsuario"] ?>
</div>
</nav>
</div>
<div id="layoutSidenav_content">
  <main class="bg">
    <div class="container-fluid px-4">
      <?php
      $datosPaciente = ControllerCotizaciones::ctrMostrarDatosCabecera($_GET["codCotizacion"]);
      echo '<h1 class="mt-4">Nueva Cotización: ' . $datosPaciente["NombrePaciente"] . ' ' . $datosPaciente["ApellidoPaciente"] . '</h1>';
      ?>
    </div>

    <div class="container-fluid">
      <form role="form" method="post" class="row g-3 m-2 formularioCotizacion">
        <!-- Nombre del Paciente -->
        <span class="border border-3 p-3">
          <div class="container row g-3">
            <h3>Datos Paciente</h3>
            <?php
            echo '
              <div class="form-group col-md-6">
                <label for="nombrePaciente" class="form-label" style="font-weight: bold">Nombre Paciente:</label>
                <input type="text" class="form-control" id="nombrePaciente" name="nombrePaciente" value="' . $datosPaciente["NombrePaciente"] . '" readonly>
                <input type="hidden" class="form-control" id="codPaciente" name="codPaciente" value="' . $datosPaciente["IdPaciente"] . '" readonly>
              </div>
              <div class="form-group col-md-6">
                <label for="apellidoPaciente" class="form-label" style="font-weight: bold">Apellido Paciente:</label>
                <input type="text" class="form-control" id="apellidoPaciente" name="apellidoPaciente" value="' . $datosPaciente["ApellidoPaciente"] . '" readonly>
              </div>
              <div class="form-group col-md-4">
                <label for="dniPaciente" class="form-label" style="font-weight: bold">DNI:</label>
                <input type="text" class="form-control" id="dniPaciente" name="dniPaciente" value="' . $datosPaciente["NumeroIdentificacion"] . '" readonly>
              </div>
              <div class="form-group col-md-4">
                <label for="celularPaciente" class="form-label" style="font-weight: bold">Celular:</label>
                <input type="text" class="form-control" id="celularPaciente" name="celularPaciente" value="' . $datosPaciente["CelularPaciente"] . '" readonly>
              </div>
              <div class="form-group col-md-4">
                <label for="fechaCotizacion" class="form-label" style="font-weight: bold">Fecha de Cotización:</label>
                <input type="date" class="form-control" id="fechaCotizacion" name="fechaCotizacion" value="' . $datosPaciente["FechaCotizacion"] . '" required>
              </div>
                ';
            ?>
          </div>
        </span>

        <!-- Detalle del Costo -->
        <span class="border border-3 p-3">
          <div class="container row g-3">
            <h3>Datos Cotizacion</h3>
            <div class="d-inline-flex m-2">
              <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalAgregarProcedimiento">Agregar Procedimiento</button>
            </div>

            <div class="row" style="font-weight: bold">
              <div class="col-lg-4">Nombre Procedimiento</div>
              <div class="col-lg-3">Observacion</div>
              <div class="col-lg-1">Cantidad</div>
              <div class="col-lg-2">Precio Unitario</div>
              <div class="col-lg-2">Costo Total</div>
            </div>

            <div class="form-group row nuevaListaCotizacion" id="nuevaListaCotizacion">
              <?php
              $detalleCotizacion = ControllerCotizaciones::ctrObtenerListaProcedimientos($_GET["codCotizacion"]);
              foreach ($detalleCotizacion as $value) {
                echo '
                  <div class="row" style="padding:5px 15px">

                  <!-- Descripción del procedimiento -->
                  <div class="col-lg-4" style="padding-right:0px">
                  <div class="input-group">
                  <span class="input-group-addon"><button type="button" class="btn btn-danger btn-xs quitarProcedimiento" codProcedimiento="' . $value["IdProcedimiento"] . '"><i class="fa fa-times"></i></button></span>
                  <input type="text" class="form-control nuevoprocedimiento" codProcedimiento="' . $value["IdProcedimiento"] . '" value=" ' . $value["NombreProcedimiento"] . ' " readonly>
                  </div>
                  </div>
          
                  <!-- Observacion -->
                  <div class="col-lg-3">
                  <input type="text" class="form-control nuevaObservacionCotizacion" name="nuevaObservacionCotizacion" value="' . $value["ObservacionProcedimiento"] . '">
                  </div>
          
                  <!-- Cantidad -->
                  <div class="col-lg-1 cantidadCotizacion">
                  <input type="number" class="form-control nuevaCantidadCotizacion" name="nuevaCantidadCotizacion" min="1.00" step="1" value="' . $value["CantidadProcedimiento"] . '" required>
                  </div>
          
                  <!-- Precio Unitario -->
                  <div class="col-lg-2 puCotizacion">
                  <input type="number" class="form-control nuevoPrecioUnitarioCotizacion" name="nuevoPrecioUnitarioCotizacion" min="1.00" value="' . $value["PrecioUnitario"] . '" required>
                  </div>
          
                  <!-- Costo Total -->
                  <div class="col-lg-2 totalCotizacion">
                  <input type="number" class="form-control nuevoCostoTotalCotizacion" name="nuevoCostoTotalCotizacion" min="1.00" value="' . $value["TotalProcedimiento"] . '" readonly>
                  </div>
          
                  </div>
                ';
              }
              ?>
              <input type="hidden" id="listarCotizaciones" name="listarCotizaciones">
            </div>
          </div>
        </span>

        <!-- Pie de movimiento -->
        <span class="border border-3 p-3">
          <div class="container row g-3">
            <h3>Datos Total</h3>

            <div class="row" style="font-weight: bold">
              <div class="col-lg-2"></div>
              <div class="col-lg-2"><span>Costo Total(S/.):</span></div>
              <div class="col-lg-2"><input type="number" style="text-align: right;" class="form-control input-lg" id="nuevoTotalCotizacion" name="nuevoTotalCotizacion" value="<?php echo $datosPaciente["TotalCotizacion"] ?>" readonly></div>
            </div>
          </div>

          <div class="container row g-3 p-3 justify-content-between">
            <input type="hidden" name="codCotizacion" id="codCotizacion" value="<?php echo $_GET["codCotizacion"]?>">
            <button type="button" class="col-1 d-inline-flex-center p-2 btn btn-secondary cerrarCotizacion">Cerrar</button>
            <button type="submit" class="col-2 d-inline-flex-center p-2 btn btn-success ">Editar Cotizacion</button>
          </div>
        </span>

      </form>
    </div>
  </main>
</div>
</div>

<?php
$editarCotizacion = new ControllerCotizaciones;
$editarCotizacion->ctrEditarCotizacion();
?>

<div class="modal fade" id="modalAgregarProcedimiento" tabindex="-1" role="dialog" aria-labelledby="modalAgregarProcedimiento" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Listado de Procedimientos</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <!-- Cuerpo modal -->
      <div class="modal-body">
        <table class="table table-striped dt-responsive tablaCotizacion" width="100%">
          <thead>
            <tr>
              <th>Descripción de Procedimiento</th>
              <th>Acciones</th>
            </tr>
          </thead>
          <tbody class="tablaProcedimientosCotizacion">
            <?php
            $listaProcedimientos = ControllerProcedimientos::ctrMostraProcedimientosHistoria();
            foreach ($listaProcedimientos as $value) {
              echo ' 
                  <tr>
                    <td>' . $value["NombreProcedimiento"] . '</td>
                    <td>
                      <div class="btn-group">
                        <button class="btn btn-primary btnAgregarProcedCotizacion" codProcedimiento="' . $value["IdProcedimiento"] . '">Agregar</button> 
                      </div>
                    </td>
                  </tr>';
            }
            ?>
          </tbody>
        </table>
      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-secondary pull-left" data-bs-dismiss="modal">Salir</button>
      </div>
    </div>
  </div>
</div>
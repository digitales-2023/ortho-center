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
      if (isset($_GET["codPaciente"])) {
        $datosPaciente = ControllerPacientes::ctrMostrarDatosPaciente($_GET["codPaciente"]);
        echo '<h1 class="mt-4">Nueva Cotización: ' . $datosPaciente["NombrePaciente"] . ' ' . $datosPaciente["ApellidoPaciente"] . '</h1>';
      } else {
        echo '<h1 class="mt-4">Nueva Cotización</h1>';
      }
      ?>
    </div>

    <div class="container-fluid">
      <form role="form" method="post" class="row g-3 m-2 formularioCotizacion">
        <!-- Nombre del Paciente -->
        <span class="border border-3 p-3">
          <div class="container row g-3">
            <h3>Datos Paciente</h3>
            <?php
            if (isset($_GET["codPaciente"])) {
              echo '
              <div class="form-group col-md-6">
                <label for="nombrePaciente" class="form-label" style="font-weight: bold">Nombre Paciente:</label>
                <input type="text" class="form-control" id="nombrePaciente" name="nombrePaciente" value="'.$datosPaciente["NombrePaciente"].'" readonly>
                <input type="hidden" class="form-control" id="codPaciente" name="codPaciente" value="'.$datosPaciente["IdPaciente"].'" readonly>
              </div>
              <div class="form-group col-md-6">
                <label for="apellidoPaciente" class="form-label" style="font-weight: bold">Apellido Paciente:</label>
                <input type="text" class="form-control" id="apellidoPaciente" name="apellidoPaciente" value="'.$datosPaciente["ApellidoPaciente"].'" readonly>
              </div>
              <div class="form-group col-md-6">
                <label for="dniPaciente" class="form-label" style="font-weight: bold">Número de Identificación:</label>
                <input type="text" class="form-control" id="dniPaciente" name="dniPaciente" value="'.$datosPaciente["NumeroIdentificacion"].'" readonly>
              </div>
              <div class="form-group col-md-3">
                <label for="celularPaciente" class="form-label" style="font-weight: bold">Celular:</label>
                <input type="text" class="form-control" id="celularPaciente" name="celularPaciente" value="'.$datosPaciente["CelularPaciente"].'" readonly>
              </div>
              <div class="form-group col-md-3">
                <label for="fechaCotizacion" class="form-label" style="font-weight: bold">Fecha de Cotización:</label>
                <input type="date" class="form-control" id="fechaCotizacion" name="fechaCotizacion" required>
              </div>
                ';
            } else {
              echo '
              <div class="form-group col-md-6">
                <label for="nombrePaciente" class="form-label" style="font-weight: bold">Nombre Paciente:</label>
                <input type="text" class="form-control" id="nombrePaciente" name="nombrePaciente" required>
              </div>
              <div class="form-group col-md-6">
                <label for="apellidoPaciente" class="form-label" style="font-weight: bold">Apellido Paciente:</label>
                <input type="text" class="form-control" id="apellidoPaciente" name="apellidoPaciente" required>
              </div>
              <div class="form-group col-md-6">
                <label for="dniPaciente" class="form-label" style="font-weight: bold">Numero Identificación:</label>
                <input type="text" class="form-control" id="dniPaciente" name="dniPaciente" required>
              </div>
              <div class="form-group col-md-3">
                <label for="celularPaciente" class="form-label" style="font-weight: bold">Celular:</label>
                <input type="text" class="form-control" id="celularPaciente" name="celularPaciente" required>
              </div>
              <div class="form-group col-md-3">
                <label for="fechaCotizacion" class="form-label" style="font-weight: bold">Fecha de Cotización:</label>
                <input type="date" class="form-control" id="fechaCotizacion" name="fechaCotizacion" required>
              </div>
                ';
            }
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
              <div class="col-lg-2"><input type="number" style="text-align: right;" class="form-control input-lg" id="nuevoTotalCotizacion" name="nuevoTotalCotizacion" placeholder="0.00" readonly></div>
            </div>
          </div>

          <div class="container row g-3 p-3 justify-content-between">
            <button type="button" class="col-1 d-inline-flex-center p-2 btn btn-secondary cerrarCotizacion">Cerrar</button>
            <button type="submit" class="col-2 d-inline-flex-center p-2 btn btn-success ">Registrar Cotizacion</button>
          </div>
        </span>

      </form>
    </div>
  </main>
</div>
</div>

<?php
$crearCotizacion = new ControllerCotizaciones;
$crearCotizacion->ctrCrearCotizacion();
?>

<div class="modal fade" id="modalAgregarProcedimiento" tabindex="-1" aria-labelledby="modalAgregarProcedimientoLabel" inert>
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalAgregarProcedimientoLabel">Listado de Procedimientos</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <!-- Cuerpo modal -->
      <div class="modal-body">
        <table id="datatablesSimple" class="table table-striped dt-responsive tablaCotizacion" width="100%">
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
                        <button type="button" class="btn btn-primary btnAgregarProcedCotizacion" data-codprocedimiento="' . $value["IdProcedimiento"] . '">Agregar</button> 
                      </div>
                    </td>
                  </tr>';
            }
            ?>
          </tbody>
        </table>
      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-secondary float-start" data-bs-dismiss="modal">Salir</button>
      </div>
    </div>
  </div>
</div>
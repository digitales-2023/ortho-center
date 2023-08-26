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
          <h1 class="mt-4">Historial de Pagos</h1>
          <div class="d-inline-flex m-2">
            <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#modalAgregarPago">
              Agregar Nuevo Pago
            </button>
            <button type="button" class="btn btn-success descargarPagos" id="descargarPagos">
              Descargar Pagos
            </button>
          </div>

          <div class="card-body">
            <table id="datatablesSimple" class="data-table-AllCostos table">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Paciente</th>
                  <th>DNI</th>
                  <th>Total Cancelado</th>
                  <th>Tipo de Pago</th>
                  <th>Fecha de Pago</th>
                  <th>Acciones</th>
                </tr>
              </thead>
              <tbody>
                <?php
                  $listaPagos = ControllerPagos::ctrMostrarTodosLosPagos();
                  foreach($listaPagos as $key => $value)
                  {
                    echo
                    '<tr>
                      <td>'.($key + 1).'</td>
                      <td>'.$value["NombrePaciente"].' '.$value["ApellidoPaciente"].'</td>
                      <td>'.$value["DNIPaciente"].'</td>
                      <td>'.$value["TotalPago"].'</td>
                      <td>'.$value["DescripcionTipo"].'</td>
                      <td>'.$value["FechaPago"].'</td>
                      <td>
                        <button class="btn btn-success btnDescargarPago" id="btnDescargarPago" codPago="'.$value["IdPago"].'"><i class="fa-solid fa fa-cloud-download"></i></button>
                        <button class="btn btn-warning btnEditarPago" id="btnEditarPago" codPago="'.$value["IdPago"].'" data-bs-toggle="modal" data-bs-target="#modalEditarPago"><i class="fa-solid fa-pencil"></i></button>
                        <button class="btn btn-danger btnEliminarPago" codPago="'.$value["IdPago"].'"><i class="fa-solid fa-trash"></i></button>
                      </td>
                    </tr>';
                  }
                ?>
              </tbody>
            </table>
          </div>
        </div>
      </main>
    </div>
  </div>

<!-- Modal Agregar un nuevo pago -->
<div class="modal fade" id="modalAgregarPago" tabindex="-1" role="dialog" aria-labelledby="modalAgregarPago" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Generar un nuevo Pago</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <!-- Cuerpo modal -->
      <div class="modal-body">
        <form role="form" method="post" class="formularioGenerarPago" enctype="multipart/form-data">
          <!-- DNI Paciente -->
          <div class="form-group">
            <label for="dniPacientePago" class="col-form-label">Buscar Por DNI</label>
            <div class="input-group">  
              <div class="input-group-prepend">
                <button class="btn btn-outline-primary btnBuscarPorDNI" type="button">Buscar</button>
              </div>
                <input type="number" step="1" class="form-control" id="dniPacientePago" name="dniPacientePago" aria-label="" aria-describedby="basic-addon1" required>
            </div>
          </div>

          <!-- Nombre del Paciente-->
          <div class="form-group">
            <label for="nombrePaciente" class="col-form-label">Nombre del Paciente:</label>
            <input type="hidden" class="codPaciente" name="codPaciente" id="codPaciente">
            <input type="text" class="form-control" id="nombrePaciente" name="nombrePaciente" readonly>
          </div>

          <!-- Tipo de pago -->
          <div class="form-group">
            <label for="tipoDePago" class="col-form-label">Método de Pago:</label>
            <select class="form-control tipoDePago" name="tipoDePago" id="tipoDePago">
              <?php
                $listaTipoPago = ControllerPagos::ctrMostrarTiposPago();
                foreach ($listaTipoPago as $value)
                {
                  echo '<option value="'.$value["IdTipoPago"].'">'.$value["DescripcionTipo"].'</option>';
                }
              ?>
            </select>
          </div>

          <!-- Monto a Pagar -->
          <div class="form-group">
            <label for="montoDePago" class="col-form-label">Monto a Cancelar:</label>
            <input type="number" class="form-control" id="montoDePago" name="montoDePago" required>
          </div>
          
          <!-- Fecha de Pago -->
          <div class="form-group">
            <label for="fechaPago" class="col-form-label">Fecha de pago:</label>
            <input type="date" class="form-control" id="fechaPago" name="fechaPago" required>
          </div>

          <!-- Observacion -->
          <div class="form-group">
            <label for="observacionPago" class="col-form-label">Observaciones:</label>
            <input type="text" class="form-control" id="observacionPago" name="observacionPago">
          </div>

          <!-- Subir archivo-->
          <div class="form-group">
            <label for="comprobantePago" class="col-form-label">Subir Archivo:</label>
            <div class="input-group">
              <label class="input-group-btn">
                <span class="btn-file">
                  <input accept=".jpg,.png,.jpeg,.pdf" class="hidden" name="comprobantePago" type="file" id="comprobantePago">
                  <p class="help-block">Solo formato JPG, JPEG, PNG y PDF. Máximo de 2 mb</p>
                </span>
              </label>
            </div>
          </div>

          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
            <button type="button" class="btn btn-primary btnGenerarPago" id="btnGenerarPago">Generar Pago</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- Modal Editar un Pago -->
<div class="modal fade" id="modalEditarPago" tabindex="-1" role="dialog" aria-labelledby="modalEditarPago" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Editar un Pago</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <!-- Cuerpo modal -->
      <div class="modal-body">
        <form role="form" method="post" class="formularioEditarPago" enctype="multipart/form-data">
          <!-- DNI Paciente -->
          <div class="form-group">
            <label for="editarDNIPaciente" class="col-form-label">Buscar Por DNI</label>
            <div class="input-group">  
              <div class="input-group-prepend">
                <button class="btn btn-outline-primary btnBuscarPorDNI" type="button">Buscar</button>
              </div>
                <input type="number" step="1" class="form-control" id="editarDNIPaciente" name="editarDNIPaciente" aria-label="" aria-describedby="basic-addon1" required>
            </div>
          </div>

          <!-- Nombre del Paciente-->
          <div class="form-group">
            <label for="editarNombrePaciente" class="col-form-label">Nombre del Paciente:</label>
            <input type="hidden" class="codPacienteEditado" name="codPacienteEditado" id="codPacienteEditado">
            <input type="hidden" class="codPagoEdit" name="codPagoEdit" id="codPagoEdit">
            <input type="text" class="form-control" id="editarNombrePaciente" name="editarNombrePaciente" readonly>
          </div>

          <!-- Tipo de pago -->
          <div class="form-group">
            <label for="editarTipoPago" class="col-form-label">Método de Pago:</label>
            <select class="form-control editarTipoPago" name="editarTipoPago" id="editarTipoPago">
              <?php
                $listaTipoPago = ControllerPagos::ctrMostrarTiposPago();
                echo '';
                foreach ($listaTipoPago as $value)
                {
                  echo '<option value="'.$value["IdTipoPago"].'">'.$value["DescripcionTipo"].'</option>';
                }
              ?>
            </select>
          </div>

          <!-- Monto a Pagar -->
          <div class="form-group">
            <label for="editarMontoPago" class="col-form-label">Monto a Cancelar:</label>
            <input type="number" class="form-control" id="editarMontoPago" name="editarMontoPago" required>
          </div>
          
          <!-- Fecha de Pago -->
          <div class="form-group">
            <label for="editarFechaPago" class="col-form-label">Fecha de pago:</label>
            <input type="date" class="form-control" id="editarFechaPago" name="editarFechaPago" required>
          </div>
          
          <!-- Observacion -->
          <div class="form-group">
            <label for="editarObservacion" class="col-form-label">Observaciones:</label>
            <input type="text" class="form-control" id="editarObservacion" name="editarObservacion">
          </div>

          <!-- Subir archivo-->
          <div class="form-group">
            <label for="editarComprobantePago" class="col-form-label">Subir Archivo:</label>
            <div class="input-group">
              <label class="input-group-btn">
                <span class="btn-file">
                  <input accept=".jpg,.png,.jpeg,.pdf" class="hidden" name="editarComprobantePago" type="file" id="editarComprobantePago">
                </span>
              </label>
            </div>
          </div>

          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
            <button type="submit" class="btn btn-primary btnEditarPago" id="btnEditarPago">Editar Pago</button>
          </div>
          <?php
              $editarPago = new ControllerPagos();
              $editarPago -> ctrEditarPago();
            ?>
        </form>
      </div>
    </div>
  </div>
</div>

<?php
  $eliminarPago = new ControllerPagos();
  $eliminarPago -> ctrEliminarPago();
?>
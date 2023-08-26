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
          <h1 class="mt-4">Programación de Citas</h1>

          <div class="d-inline-flex m-2">
            <button type="button" class="btn btn-warning btnNuevaCita" id="btnNuevaCita" data-bs-toggle="modal" data-bs-target="#modalAgregarCita"><i class="fa fa-calendar-plus"></i>
              Nueva Cita
            </button>
          </div>

          <div class="card mb-4">
            <div class="card-header">
              <i class="fas fa-table me-1"></i>
              Todas las citas programadas
            </div>

            <div class="card-body">
              <table id="datatablesSimple" class="data-table-AllHistorias table">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>Paciente</th>
                    <th>DNI</th>
                    <th>Celular</th>
                    <th>Fecha Programada</th>
                    <th>Medico Asignado</th>
                    <th>Estado</th>
                    <th>Acciones</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                    $listaCitas = ControllerCitas::ctrMostrarTodasCitas();
                    foreach ($listaCitas as $key => $value)
                    {
                      echo
                      '<tr>
                        <td>'.($key + 1).'</td>
                        <td>'.$value["NombrePaciente"].' '.$value["ApellidoPaciente"].'</td>
                        <td>'.$value["DNIPaciente"].'</td>
                        <td>'.$value["CelularPaciente"].'</td>
                        <td>'.$value["FechaProgramada"].'</td>
                        <td>'.$value["NombreSocio"].'</td>
                        <td>'.$value["EstadoCita"].'</td>
                        <td>
                          <button class="btn btn-warning btnEditarCita" id="btnEditarCita" codCita="'.$value["IdCita"].'" data-bs-toggle="modal" data-bs-target="#modalEditarCita"><i class="fa fa-pencil"></i></button>
                          <button class="btn btn-danger btnEliminarCita" id="btnEliminarCita" codCita="'.$value["IdCita"].'"><i class="fa fa-trash"></i></button>
                        </td>
                      </tr>';
                    }
                  ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </main>
    </div>
  </div>

<!-- Modal Agender una Nueva Cita -->
<div class="modal fade" id="modalAgregarCita" tabindex="-1" role="dialog" aria-labelledby="modalAgregarCita" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Asignar nueva Cita</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <!-- Cuerpo modal -->
      <div class="modal-body">
        <form role="form" method="post" class="formularioAgregarCita">
          <!-- DNI Paciente -->
          <div class="form-group">
            <label for="dniPacienteCita" class="col-form-label">Buscar Por DNI</label>
            <div class="input-group">  
              <div class="input-group-prepend">
                <button class="btn btn-outline-primary btnBuscarPorDNICita" type="button">Buscar</button>
              </div>
                <input type="number" step="1" class="form-control" id="dniPacienteCita" name="dniPacienteCita" aria-label="" aria-describedby="basic-addon1" required>
            </div>
          </div>

          <!-- Nombre del Paciente-->
          <div class="form-group">
            <label for="nombrePacienteCita" class="col-form-label">Nombre del Paciente:</label>
            <input type="text" class="form-control" id="nombrePacienteCita" name="nombrePacienteCita" readonly>
          </div>

          <!-- Celular Paciente -->
          <div class="form-group">
            <label for="celularPacienteCita" class="col-form-label">Celular Paciente:</label>
            <input type="text" class="form-control" id="celularPacienteCita" name="celularPacienteCita" readonly>
          </div>
          
          <!-- Fecha de Programación -->
          <div class="form-group">
            <label for="fechaProgramacion" class="col-form-label">Fecha cita:</label>
            <input type="datetime-local" class="form-control" id="fechaProgramacion" name="fechaProgramacion" required>
          </div>

          <!-- Medico Asignado -->
          <div class="form-group ">
            <label for="medicoAsignadoCita" class="form-label">Medico Asignado:</label>
            <select class="form-select" name="medicoAsignadoCita" id="medicoAsignadoCita" required>
              <option selected="true" value="" disabled>Elige una opcion</option>
              <?php
                $listaMedicos = ControllerSocios::ctrMostrarSociosPorTipo('1');
                foreach ($listaMedicos as $key => $value)
                {
                  echo '<option value="'.$value["IdSocio"].'">'.$value["NombreSocio"].'</option>';
                }
              ?>
            </select>
          </div>

          <div class="modal-footer">
            <input type="hidden" class="codPacienteCita" name="codPacienteCita" id="codPacienteCita">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
            <button type="submit" class="btn btn-primary btnAgenderCita" id="btnAgenderCita">Agender Cita</button>
          </div>
          <?php
            $crearCita = new ControllerCitas;
            $crearCita -> ctrCrearNuevaCita();
          ?>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- Modal Editar una Nueva Cita -->
<div class="modal fade" id="modalEditarCita" tabindex="-1" role="dialog" aria-labelledby="modalEditarCita" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Asignar nueva Cita</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <!-- Cuerpo modal -->
      <div class="modal-body">
        <form role="form" method="post" class="formularioAgregarCita">
          <!-- DNI Paciente -->
          <div class="form-group">
            <label for="dniPacienteCitaEditar" class="col-form-label">Buscar Por DNI</label>
            <div class="input-group">  
              <div class="input-group-prepend">
                <button class="btn btn-outline-primary btnBuscarPorDNICita" type="button">Buscar</button>
              </div>
                <input type="number" step="1" class="form-control" id="dniPacienteCitaEditar" name="dniPacienteCitaEditar" aria-label="" aria-describedby="basic-addon1" required>
            </div>
          </div>

          <!-- Nombre del Paciente-->
          <div class="form-group">
            <label for="nombrePacienteCitaEditar" class="col-form-label">Nombre del Paciente:</label>
            <input type="text" class="form-control" id="nombrePacienteCitaEditar" name="nombrePacienteCitaEditar" readonly>
          </div>

          <!-- Celular Paciente -->
          <div class="form-group">
            <label for="celularPacienteCitaEditar" class="col-form-label">Celular Paciente:</label>
            <input type="text" class="form-control" id="celularPacienteCitaEditar" name="celularPacienteCitaEditar" readonly>
          </div>
          
          <!-- Fecha de Programación -->
          <div class="form-group">
            <label for="fechaProgramacionEditar" class="col-form-label">Fecha cita:</label>
            <input type="datetime-local" class="form-control" id="fechaProgramacionEditar" name="fechaProgramacionEditar" required>
          </div>

          <!-- Medico Asignado -->
          <div class="form-group ">
            <label for="medicoAsignadoCitaEditar" class="form-label">Medico Asignado:</label>
            <select class="form-select" name="medicoAsignadoCitaEditar" id="medicoAsignadoCitaEditar" required>
              <?php
                $listaMedicos = ControllerSocios::ctrMostrarSociosPorTipo('1');
                foreach ($listaMedicos as $key => $value)
                {
                  echo '<option value="'.$value["IdSocio"].'">'.$value["NombreSocio"].'</option>';
                }
              ?>
            </select>
          </div>

          <div class="modal-footer">
          <input type="hidden" class="codPacienteCitaEditar" name="codPacienteCitaEditar" id="codPacienteCitaEditar">
            <input type="hidden" class="codCitaEditar" name="codCitaEditar" id="codCitaEditar">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
            <button type="submit" class="btn btn-primary btnAgenderCita" id="btnAgenderCita">Editar Cita</button>
          </div>
          <?php
            $editarCita = new ControllerCitas;
            $editarCita -> ctrEditarCita();
          ?>
        </form>
      </div>
    </div>
  </div>
</div>

<?php
  $eliminarCita = new ControllerCitas;
  $eliminarCita -> ctrEliminarCita();
?>
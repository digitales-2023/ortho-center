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
          <h1 class="mt-4">Todos los pacientes</h1>
          
          <div class="d-flex m-2">
            <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#modalAgregarPaciente">
              Agregar Paciente
            </button>
          </div>
          <div class="card mb-4">
            <div class="card-header">
              <i class="fas fa-table me-1"></i>
              Todos los Pacientes
            </div>
            <div class="card-body">
              <table id="datatablesSimple" class="data-table-Paciente table">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>Nombre</th>
                    <th>Apellido</th>
                    <th>DNI</th>
                    <th>Celular</th>
                    <th>Acciones</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $listaPacientes = ControllerPacientes::ctrMostrarPacientes();
                  foreach ($listaPacientes as $key => $value) 
                  {
                    echo
                    '<tr>
                      <td>'.($key + 1).'</td>
                      <td>'.$value["NombrePaciente"].'</td>
                      <td>'.$value["ApellidoPaciente"].'</td>
                      <td>'.$value["DNIPaciente"].'</td>
                      <td>'.$value["CelularPaciente"].'</td>
                      <td>
                        <button class="btn btn-warning btnEditarPaciente" codPaciente="'.$value["IdPaciente"].'" data-bs-toggle="modal" data-bs-target="#modalEditarpaciente">Editar <i class="fa-solid fa-pencil"></i></button>
                        <button class="btn btn-danger btnEliminarPaciente" codPaciente="'.$value["IdPaciente"].'">Eliminar <i class="fa-solid fa-trash"></i></button>
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

<!-- Modal Agregar un nuevo Paciente -->
<div class="modal fade" id="modalAgregarPaciente" tabindex="-1" role="dialog" aria-labelledby="modalAgregarPaciente" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Crear un nuevo Paciente</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <!-- Cuerpo modal -->
      <div class="modal-body">
        <form role="form" method="post">
          <!-- Nombre del Paciente-->
          <div class="form-group">
            <label for="nombrePaciente" class="col-form-label">Nombre del Paciente:</label>
            <input type="text" class="form-control" id="nombrePaciente" name="nombrePaciente">
          </div>

          <!-- Apellido del Paciente -->
          <div class="form-group">
            <label for="apellidoPaciente" class="col-form-label">Apellido del Paciente:</label>
            <input type="text" class="form-control" id="apellidoPaciente" name="apellidoPaciente">
          </div>

          <!-- Celular del Paciente -->
          <div class="form-group">
            <label for="celularPaciente" class="col-form-label">Numero de celular:</label>
            <input type="text" class="form-control" id="celularPaciente" name="celularPaciente">
          </div>

          <!-- DNI Paciente -->
          <div class="form-group">
            <label for="numeroDNI" class="col-form-label">DNI:</label>
            <input type="text" class="form-control" id="numeroDNI" name="numeroDNI">
          </div>

          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
            <button type="submit" class="btn btn-primary">Crear Paciente</button>
          </div>
          <?php
            $crearPaciente = new ControllerPacientes();
            $crearPaciente -> ctrCrearPaciente();
          ?>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- Modal Editar Paciente -->
<div class="modal fade" id="modalEditarpaciente" tabindex="-1" aria-labelledby="modalEditarpaciente" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5">Editar un Paciente</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form role="form" method="post">
        <div class="modal-body">
          <div class="box-body">
            
            <!-- Nombre del Paciente -->
            <div class="form-group">
              <label for="editarNombrePaciente" class="col-form-label">Nombre Socio:</label>
              <input type="text" class="form-control" id="editarNombrePaciente" name="editarNombrePaciente">
            </div>

            <!-- Apellido del Paciente -->
            <div class="form-group">
              <label for="editarApellidoPaciente" class="col-form-label">Nombre Socio:</label>
              <input type="text" class="form-control" id="editarApellidoPaciente" name="editarApellidoPaciente">
            </div>

            <!-- DNI del Paciente -->
            <div class="form-group">
              <label for="editarDNIPaciente" class="col-form-label">DNI:</label>
              <input type="text" class="form-control" id="editarDNIPaciente" name="editarDNIPaciente">
            </div>

            <!-- Celular del Paciente -->
            <div class="form-group">
              <label for="editarCelularPaciente" class="col-form-label">Celular:</label>
              <input type="text" class="form-control" id="editarCelularPaciente" name="editarCelularPaciente">
            </div>

            <div class="modal-footer">
              <input type="hidden" id="codPaciente" name="codPaciente" class="codPaciente">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
              <button type="submit" class="btn btn-primary">Editar Paciente</button>
            </div>
            <?php
              $editarPaciente = new ControllerPacientes();
              $editarPaciente -> ctrEditarPaciente();
            ?>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>

<?php
  $eliminarSocio = new ControllerPacientes();
  $eliminarSocio -> ctrEliminarPaciente();
?>
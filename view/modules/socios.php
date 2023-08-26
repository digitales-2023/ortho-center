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
          <h1 class="mt-4">Catálogo de Socios</h1>
          <div class="d-flex m-2">
            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalAgregarSocio">
              Agregar Socio
            </button>
            <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#modalAgregarTipoSocio">
              Nuevo Tipo de Socio
            </button>
          </div>
          <div class="card mb-4">
            <div class="card-header">
              <i class="fas fa-table me-1"></i>
              Catálogo de Socios
            </div>
            <div class="card-body">
              <table id="datatablesSimple" class="data-table-Socio table">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>Nombre Socio</th>
                    <th>Tipo de Socio</th>
                    <th>Tipo de identificacion</th>
                    <th>Identificacion</th>
                    <th>Fecha Creacion</th>
                    <th>Acciones</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $listaSocios = ControllerSocios::ctrMostrarSocios();
                  foreach ($listaSocios as $key => $value) 
                  {
                    echo
                    '<tr>
                      <td>'.($key + 1).'</td>
                      <td>'.$value["NombreSocio"].'</td>
                      <td>'.$value["NombreTipoSocio"].'</td>
                      <td>'.$value["NombreTipoIdentificacion"].'</td>
                      <td>'.$value["Identificacion"].'</td>
                      <td>'.$value["FechaCreacion"].'</td>
                      <td>
                        <button class="btn btn-warning btnEditarSocio" codSocio="'.$value["IdSocio"].'" data-bs-toggle="modal" data-bs-target="#modelEditarSocio">Editar <i class="fa-solid fa-pencil"></i></button>
                        <button class="btn btn-danger btnEliminarSocio" codSocio="'.$value["IdSocio"].'">Eliminar <i class="fa-solid fa-trash"></i></button>
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

<!-- Modal Agregar un nuevo Socio -->
<div class="modal fade" id="modalAgregarSocio" tabindex="-1" role="dialog" aria-labelledby="modalAgregarSocio" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Crear un nuevo Socio</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <!-- Cuerpo modal -->
      <div class="modal-body">
        <form role="form" method="post">
          <!-- Nombre del Socio-->
          <div class="form-group">
            <label for="nombreSocio" class="col-form-label">Nombre Socio:</label>
            <input type="text" class="form-control" id="nombreSocio" name="nombreSocio" required>
          </div>

          <!-- Tipo de socio -->
          <div class="form-group">
            <label for="tipoSocio" class="col-form-label">Tipo de Socio:</label>
            <select class="form-select" name="tipoSocio">
              <?php
                $tiposSocio = ControllerSocios::ctrMostrarTiposSocio();
                foreach ($tiposSocio as $key => $value)
                {
                  echo '<option value="'.$value["IdTipoSocio"].'">'.$value["NombreTipoSocio"].'</option>';
                }
              ?>
            </select>
          </div>

          <!-- Tipo de identificacion -->
          <div class="form-group">
            <label for="tipoIdentificacion" class="col-form-label">Tipo de Identificacion:</label>
            <select class="form-select" name="tipoIdentificacion">
              <?php
                $tiposIdentificacion = ControllerSocios::ctrMostrarTiposIdentificacion();
                foreach ($tiposIdentificacion as $key => $value)
                {
                  echo '<option value="'.$value["IdTipoIdentificacion"].'">'.$value["NombreTipoIdentificacion"].'</option>';
                }
              ?>
            </select>
          </div>

          <!-- Numero de indentificacion DNI o RUC -->
          <div class="form-group">
            <label for="numeroIdentificacion" class="col-form-label">Numero de Identificacion:</label>
            <input type="text" class="form-control" id="numeroIdentificacion" name="numeroIdentificacion">
          </div>

          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
            <button type="submit" class="btn btn-primary">Crear Socio</button>
          </div>
          <?php
            $crearSocio = new ControllerSocios();
            $crearSocio -> ctrCrearSocio();
          ?>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- Modal Editar Socio -->
<div class="modal fade" id="modelEditarSocio" tabindex="-1" aria-labelledby="modelEditarSocio" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5">Editar un Socio</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form role="form" method="post">
        <div class="modal-body">
          <div class="box-body">
            
            <!-- Nombre del Socio-->
            <div class="form-group">
              <label for="editarNombreSocio" class="col-form-label">Nombre Socio:</label>
              <input type="text" class="form-control" id="editarNombreSocio" name="editarNombreSocio">
            </div>

            <!-- Tipo de socio -->
            <div class="form-group">
              <label for="editarTipoSocio" class="col-form-label">Tipo de Socio:</label>
              <select class="form-control" name="editarTipoSocio">
                <?php
                  $tiposSocio = ControllerSocios::ctrMostrarTiposSocio();
                  foreach ($tiposSocio as $key => $value)
                  {
                    echo '<option value="'.$value["IdTipoSocio"].'">'.$value["NombreTipoSocio"].'</option>';
                  }
                ?>
              </select>
            </div>

            <!-- Tipo de identificacion -->
            <div class="form-group">
              <label for="editarTipoIdentificacion" class="col-form-label">Tipo de Identificacion:</label>
              <select class="form-control" name="editarTipoIdentificacion">
                <?php
                  $tiposIdentificacion = ControllerSocios::ctrMostrarTiposIdentificacion();
                  foreach ($tiposIdentificacion as $key => $value)
                  {
                    echo '<option value="'.$value["IdTipoIdentificacion"].'">'.$value["NombreTipoIdentificacion"].'</option>';
                  }
                ?>
              </select>
            </div>

            <!-- Numero de indentificacion DNI o RUC -->
            <div class="form-group">
              <label for="editarNumeroIdentificacion" class="col-form-label">Numero de Identificacion:</label>
              <input type="text" class="form-control" id="editarNumeroIdentificacion" name="editarNumeroIdentificacion">
            </div>

            <div class="modal-footer">
              <input type="hidden" id="codSocio" name="codSocio" class="codSocio">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
              <button type="submit" class="btn btn-primary">Editar Socio</button>
            </div>
            <?php
              $editarSocio = new ControllerSocios();
              $editarSocio -> ctrEditarSocio();
            ?>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- Modal Agregar Tipo de Socio -->
<div class="modal fade" id="modalAgregarTipoSocio" tabindex="-1" aria-labelledby="modalAgregarTipoSocio" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5">Agregar Nuevo Tipo de Socio</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form role="form" method="post">
        <div class="modal-body">
          <div class="box-body">
            
            <!-- Tipo de Socio-->
            <div class="form-group">
              <label for="nombreTipoSocio" class="col-form-label">Nombre Tipo de Socio:</label>
              <input type="text" class="form-control" id="nombreTipoSocio" name="nombreTipoSocio">
            </div>

            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
              <button type="submit" class="btn btn-primary">Crear Tipo de Socio</button>
            </div>
            <?php
              $agregarTipoSocio = new ControllerSocios();
              $agregarTipoSocio -> ctrCrearTipoSocio();
            ?>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>

<?php
  $eliminarSocio = new ControllerSocios();
  $eliminarSocio -> ctrEliminarSocio();
?>
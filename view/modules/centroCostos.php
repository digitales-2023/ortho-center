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
          <h1 class="mt-4">Centros de costos</h1>

          <div class="d-flex m-2">
            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalAgregarCentroCostos">
              Agregar Centro Costos
            </button>
          </div>
          <div class="card mb-4">
            <div class="card-header">
              <i class="fas fa-table me-1"></i>
              Todos los Centros de Costos
            </div>
            <div class="card-body">
              <table id="datatablesSimple" class="data-table-Gasto table">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>Descripcion</th>
                    <th>Fecha Creacion</th>
                    <th>Acciones</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $listaCentroCostos = ControllerCostos::ctrMostrarCentrosCostos();
                  foreach ($listaCentroCostos as $key => $value) 
                  {
                    echo
                    '<tr>
                      <td>'.($key + 1).'</td>
                      <td>'.$value["DescripcionCentro"].'</td>
                      <td>'.$value["FechaCreacion"].'</td>
                      <td>
                        <button class="btn btn-warning btnEditarCentro" codCentroCosto="'.$value["IdCentroCostos"].'" data-bs-toggle="modal" data-bs-target="#modalEditarCentroCostos">Editar <i class="fa-solid fa-pencil"></i></button>
                        <button class="btn btn-danger btnEliminarCentro" codCentroCosto="'.$value["IdCentroCostos"].'">Eliminar <i class="fa-solid fa-trash"></i></button>
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

<!-- Modal Agregar un nuevo Centro de Costos -->
<div class="modal fade" id="modalAgregarCentroCostos" tabindex="-1" role="dialog" aria-labelledby="modalAgregarCentroCostos" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Crear Nuevo Centro Costos</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <!-- Cuerpo modal -->
      <div class="modal-body">
        <form role="form" method="post">

          <!-- Nombre del Centro de costos -->
          <div class="form-group">
            <label for="nombreCentroCostos" class="col-form-label">Nombre Centro de Costos:</label>
            <input type="text" class="form-control" id="nombreCentroCostos" name="nombreCentroCostos">
          </div>

          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
            <button type="submit" class="btn btn-primary">Crear Centro de Costos</button>
          </div>
          <?php
            $crearCentroCostos = new ControllerCostos();
            $crearCentroCostos -> ctrCrearCentroCostos();
          ?>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- Modal Editar Centro Costos -->
<div class="modal fade" id="modalEditarCentroCostos" tabindex="-1" aria-labelledby="modalEditarCentroCostos" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5">Editar un Centro de Costos</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form role="form" method="post">
        <div class="modal-body">
          <div class="box-body">
            
            <!-- Nombre del Socio-->
            <div class="form-group">
              <label for="editarNombreCentro" class="col-form-label">Nombre Socio:</label>
              <input type="text" class="form-control" id="editarNombreCentro" name="editarNombreCentro">
            </div>

            <div class="modal-footer">
              <input type="hidden" id="codCentroCosto" name="codCentroCosto" class="codCentroCosto">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
              <button type="submit" class="btn btn-primary">Editar Centro de Costos</button>
            </div>
            <?php
              $editarCentroCostos = new ControllerCostos();
              $editarCentroCostos -> ctrEditarCentroCostos();
            ?>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>

<?php
  $eliminarCentroCostos = new ControllerCostos();
  $eliminarCentroCostos -> ctrEliminarCentroCostos();
?>
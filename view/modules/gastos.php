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
          <h1 class="mt-4">Catálogo de Costos</h1>
          
          <div class="d-flex m-2">
            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalAgregarGasto">
              Agregar Costo
            </button>
          </div>
          <div class="card mb-4">
            <div class="card-header">
              <i class="fas fa-table me-1"></i>
              Catálogo de Costos
            </div>
            <div class="card-body">
              <table id="datatablesSimple" class="data-table-Gasto table">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>Descripcion</th>
                    <th>Centro de Costos</th>
                    <th>Acciones</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $listaGastos = ControllerGastos::ctrMostrarGastos();
                  foreach ($listaGastos as $key => $value) 
                  {
                    echo
                    '<tr>
                      <td>'.($key + 1).'</td>
                      <td>'.$value["NombreGasto"].'</td>
                      <td>'.$value["DescripcionCentro"].'</td>
                      <td>
                        <button class="btn btn-warning btnEditarGasto" codGasto="'.$value["IdGasto"].'" data-bs-toggle="modal" data-bs-target="#modalEditarGasto">Editar <i class="fa-solid fa-pencil"></i></button>
                        <button class="btn btn-danger btnEliminarGasto" codGasto="'.$value["IdGasto"].'">Eliminar <i class="fa-solid fa-trash"></i></button>
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

<!-- Modal Agregar un nuevo Gasto -->
<div class="modal fade" id="modalAgregarGasto" tabindex="-1" role="dialog" aria-labelledby="modalAgregarGasto" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Crear un nuevo Gasto</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <!-- Cuerpo modal -->
      <div class="modal-body">
        <form role="form" method="post">
          <!-- Nombre del Gasto-->
          <div class="form-group">
            <label for="nombreGasto" class="col-form-label">Descripcion Gasto:</label>
            <input type="text" class="form-control" id="nombreGasto" name="nombreGasto">
          </div>

          <!-- Tipo de Gasto -->
          <div class="form-group">
            <label for="centroCosto" class="col-form-label">Tipo de Gasto:</label>
            <select class="form-control" name="centroCosto">
              <?php
                $centrosCosto = ControllerGastos::ctrMostrarCentrosCostos();
                foreach ($centrosCosto as $key => $value)
                {
                  echo '<option value="'.$value["IdCentroCostos"].'">'.$value["DescripcionCentro"].'</option>';
                }
              ?>
            </select>
          </div>

          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
            <button type="submit" class="btn btn-primary">Crear Gasto</button>
          </div>
          <?php
            $crearGasto = new ControllerGastos();
            $crearGasto -> ctrCrearGasto();
          ?>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- Modal Editar Gasto -->
<div class="modal fade" id="modalEditarGasto" tabindex="-1" aria-labelledby="modalEditarGasto" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5">Editar un Gasto</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form role="form" method="post">
        <div class="modal-body">
          <div class="box-body">
            <!-- Nombre del Gasto-->
            <div class="form-group">
              <label for="editarNombreGasto" class="col-form-label">Descripcion Gasto:</label>
              <input type="text" class="form-control" id="editarNombreGasto" name="editarNombreGasto">
            </div>

            <!-- Tipo de Gasto -->
            <div class="form-group">
              <label for="editarCentroCosto" class="col-form-label">Tipo de Gasto:</label>
              <select class="form-control" name="editarCentroCosto">
                <?php
                  $centrosCosto = ControllerGastos::ctrMostrarCentrosCostos();
                  foreach ($centrosCosto as $key => $value)
                  {
                    echo '<option value="'.$value["IdCentroCostos"].'">'.$value["DescripcionCentro"].'</option>';
                  }
                ?>
              </select>
            </div>

            <div class="modal-footer">
              <input type="hidden" id="codGasto" name="codGasto" class="codGasto">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
              <button type="submit" class="btn btn-primary">Editar Gasto</button>
            </div>
            <?php
              $editarGasto = new ControllerGastos();
              $editarGasto -> ctrEditarGasto();
            ?>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>

<?php
  $eliminarGasto = new ControllerGastos();
  $eliminarGasto -> ctrEliminarGasto();
?>
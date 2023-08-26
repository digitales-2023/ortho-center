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
          <h1 class="mt-4">Todos los Procedimientos</h1>
          <div class="d-flex m-2">
              <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalAgregarProcedimiento">
                Agregar Procedimiento
              </button>
              <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#modalAgregarTipoProcedimiento">
                Agregar Tipo de Procedimiento
              </button>
            </div>

          <div class="card mb-4">
            <div class="card-header">
              <i class="fas fa-table me-1"></i>
              Todos los Procedimiento
            </div>
            <div class="card-body">
              <table id="datatablesSimple" class="data-table-Procedimiento table">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>Tipo</th>
                    <th>Descripcion</th>
                    <th>Precio</th>
                    <th>Acciones</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $listaProcedimientos = ControllerProcedimientos::ctrMostrarProcedimientos();
                  foreach ($listaProcedimientos as $key => $value) 
                  {
                    echo
                    '<tr>
                      <td>'.($key + 1).'</td>
                      <td>'.$value["NombreTipoProcedimiento"].'</td>
                      <td>'.$value["NombreProcedimiento"].'</td>
                      <td>'.$value["PrecioPromedio"].'</td>
                      <td>
                        <button class="btn btn-warning btnEditarProcedimiento" codProcedimiento="'.$value["IdProcedimiento"].'" data-bs-toggle="modal" data-bs-target="#modalEditarProcedimiento">Editar <i class="fa-solid fa-pencil"></i></button>
                        <button class="btn btn-danger btnEliminarProcedimiento" codProcedimiento="'.$value["IdProcedimiento"].'">Eliminar <i class="fa-solid fa-trash"></i></button>
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

<!-- Modal Agregar un nuevo Procedimiento -->
<div class="modal fade" id="modalAgregarProcedimiento" tabindex="-1" role="dialog" aria-labelledby="modalAgregarProcedimiento" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Crear un nuevo Procedimiento</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <!-- Cuerpo modal -->
      <div class="modal-body">
        <form role="form" method="post">
          <!-- Nombre del Procedimiento-->
          <div class="form-group">
            <label for="nombreProcedimiento" class="col-form-label">Nombre del Procedimiento:</label>
            <input type="text" class="form-control" id="nombreProcedimiento" name="nombreProcedimiento">
          </div>

          <!-- Tipo de procedimiento -->
          <div class="form-group">
            <label for="tipoProcedimiento" class="col-form-label">Tipo de Procedimiento:</label>
            <select class="form-control" name="tipoProcedimiento">
              <?php
                $tiposProcedimiento = ControllerProcedimientos::ctrMostrarTiposProcedimiento();
                foreach ($tiposProcedimiento as $key => $value)
                {
                  echo '<option value="'.$value["IdTipoProcedimiento"].'">'.$value["NombreTipoProcedimiento"].'</option>';
                }
              ?>
            </select>
          </div>

          <!-- Precio promedio del procedimiento -->
          <div class="form-group">
            <label for="precioProcedimiento" class="col-form-label">Precio Promedio:</label>
            <input type="text" class="form-control" id="precioProcedimiento" name="precioProcedimiento">
          </div>

          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
            <button type="submit" class="btn btn-primary">Crear Procedimiento</button>
          </div>
          <?php
            $crearProcedimiento = new ControllerProcedimientos();
            $crearProcedimiento -> ctrCrearNuevoProcedimiento();
          ?>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- Modal Editar un procedimiento -->
<div class="modal fade" id="modalEditarProcedimiento" tabindex="-1" aria-labelledby="modalEditarProcedimiento" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5">Editar Procedimiento</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form role="form" method="post">
        <div class="modal-body">
          <div class="box-body">
            
            <!-- Nombre del Procedimiento-->
            <div class="form-group">
              <label for="editarNombreProcedimiento" class="col-form-label">Nombre del Procedimiento:</label>
              <input type="text" class="form-control" id="editarNombreProcedimiento" name="editarNombreProcedimiento">
            </div>

            <!-- Tipo de procedimiento -->
            <div class="form-group">
              <label for="editarTipoProcedimiento" class="col-form-label">Tipo de Procedimiento:</label>
              <select class="form-control" name="editarTipoProcedimiento">
                <?php
                  $tiposProcedimiento = ControllerProcedimientos::ctrMostrarTiposProcedimiento();
                  foreach ($tiposProcedimiento as $key => $value)
                  {
                    echo '<option value="'.$value["IdTipoProcedimiento"].'">'.$value["NombreTipoProcedimiento"].'</option>';
                  }
                ?>
              </select>
            </div>

            <!-- Precio promedio del procedimiento -->
            <div class="form-group">
              <label for="editarPrecioProcedimiento" class="col-form-label">Precio Promedio:</label>
              <input type="text" class="form-control" id="editarPrecioProcedimiento" name="editarPrecioProcedimiento">
            </div>

            <div class="modal-footer">
              <input type="hidden" id="codProcedimiento" name="codProcedimiento" class="codProcedimiento">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
              <button type="submit" class="btn btn-primary">Editar Procedimiento</button>
            </div>
            <?php
              $editarProcedimiento = new ControllerProcedimientos();
              $editarProcedimiento -> ctrEditarProcedimiento();
            ?>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- Modal Agregar Tipo de Procedimiento -->
<div class="modal fade" id="modalAgregarTipoProcedimiento" tabindex="-1" aria-labelledby="modalAgregarTipoProcedimiento" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5">Agregar Nuevo Tipo de Procedimiento</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form role="form" method="post">
        <div class="modal-body">
          <div class="box-body">
            
            <!-- Tipo de Socio-->
            <div class="form-group">
              <label for="nombreTipoProcedimiento" class="col-form-label">Nombre Tipo de Procedimiento:</label>
              <input type="text" class="form-control" id="nombreTipoProcedimiento" name="nombreTipoProcedimiento">
            </div>

            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
              <button type="submit" class="btn btn-primary">Crear Tipo de Socio</button>
            </div>
            <?php
              $agregarTipoProcedimiento = new ControllerProcedimientos();
              $agregarTipoProcedimiento -> ctrCrearTipoProcedimiento();
            ?>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>

<?php
  $eliminarProcedimiento = new ControllerProcedimientos();
  $eliminarProcedimiento -> ctrEliminarProcedimiento();
?>
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
          <h1 class="mt-4">Planilla de Costos</h1>
          
          <div class="d-inline-flex m-2">
            <button type="button" class="btn btn-warning btnNuevoCosto" id="btnNuevoCosto">
              Agregar Nuevo Costo
            </button>
          </div>

          <div class="card mb-4">
            <div class="card-header">
              <i class="fas fa-table me-1"></i>
              Planilla de Costos
            </div>

            <div class="card-body">
              <table id="datatablesSimple" class="data-table-AllCostos table">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>Centro de Costos</th>
                    <th>Mes de Costo</th>
                    <th>Estado</th>
                    <th>Total</th>
                    <th>Fecha Creacion</th>
                    <th>Acciones</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                    $listaCostos = ControllerCostos::ctrMostrarTodosCostos();
                    foreach($listaCostos as $key => $value)
                    {
                      $estado = ControllerCostos::ctrValidarEstado($value["EstadoCosto"]);
                      $mesCosto = ControllerFunciones::ctrConvertirMes($value["MesCosto"]);
                      if($value["EstadoCosto"] == "1")
                      {
                        echo
                        '<tr>
                          <td>'.($key + 1).'</td>
                          <td>'.$value["DescripcionCentro"].'</td>
                          <td>'.$mesCosto.'</td>
                          <td>'.$estado.'</td>
                          <td>'.$value["TotalCosto"].'</td>
                          <td>'.$value["FechaCreacion"].'</td>
                          <td>
                            <button class="btn btn-success btnImprimirGasto" id="btnImprimirGasto" codCosto="'.$value["IdCosto"].'"><i class="fa-solid fa-file-text"></i></button>
                            <button class="btn btn-primary btnFinalizarEstado" id="btnFinalizarEstado" codCosto="'.$value["IdCosto"].'"><i class="fa fa-check-circle"></i></button>
                            <button class="btn btn-warning btnEditarCosto" id="btnEditarCosto" codCosto="'.$value["IdCosto"].'"><i class="fa-solid fa-pencil"></i></button>
                            <button class="btn btn-danger btnEliminarCosto" codCosto="'.$value["IdCosto"].'"><i class="fa-solid fa-trash"></i></button>
                          </td>
                        </tr>';
                      }
                      else
                      {
                        echo
                        '<tr>
                          <td>'.($key + 1).'</td>
                          <td>'.$value["DescripcionCentro"].'</td>
                          <td>'.$mesCosto.'</td>
                          <td>'.$estado.'</td>
                          <td>'.$value["TotalCosto"].'</td>
                          <td>'.$value["FechaCreacion"].'</td>
                          <td>
                            <button class="btn btn-success btnImprimirGasto" id="btnImprimirGasto" codCosto="'.$value["IdCosto"].'"><i class="fa-solid fa-file-text"></i></button>
                            <button class="btn btn-primary btnFinalizarEstado" id="btnFinalizarEstado" codCosto="'.$value["IdCosto"].'" disabled><i class="fa fa-check-circle"></i></button>
                            <button class="btn btn-warning btnEditarCosto" id="btnEditarCosto" codCosto="'.$value["IdCosto"].'" disabled><i class="fa-solid fa-pencil"></i></button>
                            <button class="btn btn-danger btnEliminarCosto" codCosto="'.$value["IdCosto"].'" disabled><i class="fa-solid fa-trash"></i></button>
                          </td>
                        </tr>';
                      }
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
<?php
  $eliminarCosto = new ControllerCostos();
  $eliminarCosto -> ctrEliminarCosto();

  $cerrarCosto = new ControllerCostos();
  $cerrarCosto -> ctrCerrarCosto();
?>
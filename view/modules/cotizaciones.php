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
      <h1 class="mt-4">Todas las cotizaciones</h1>
      <div class="d-inline-flex m-2">
        <button type="button" class="btn btn-warning m-1 btnCotizacionPacienteNuevo" id="btnCotizacionPacienteNuevo">
          Nuevo Paciente
        </button>
        <button type="button" class="btn btn-info m-1 btnCotizacionPacienteExistente" id="btnCotizacionPacienteExistente">
          Paciente Existente
        </button>
      </div>

      <div class="card mb-4">
        <div class="card-header">
          <i class="fas fa-table me-1"></i>
          Todas las Cotizaciones
        </div>

        <div class="card-body">
          <table id="datatablesSimple" class="data-table-AllCotizaciones table">
            <thead>
              <tr>
                <th>#</th>
                <th>Nombres</th>
                <th>Apellidos</th>
                <th>DNI</th>
                <th>Total Cotizacion</th>
                <th>Estado</th>
                <th>Fecha Cotizacion</th>
                <th>Acciones</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $listaCotizaciones = ControllerCotizaciones::ctrListarCotizaciones();
              foreach ($listaCotizaciones as $key => $value) {
                if ($value["EstadoCotizacion"] == "1") {
                  $estado = "Registrado";
                  echo
                  '<tr>
                  <td>' . ($key + 1) . '</td>
                  <td>' . $value["NombrePaciente"] . '</td>
                  <td>' . $value["ApellidoPaciente"] . '</td>
                  <td>' . $value["NumeroIdentificacion"] . '</td>
                  <td>' . $value["TotalCotizacion"] . '</td>
                  <td>' . $estado . '</td>
                  <td>' . $value["FechaCotizacion"] . '</td>
                  <td>
                    <button title="Imprimir" class="btn btn-success btnImprimirCotizacion" id="btnImprimirCotizacion" codCotizacion="' . $value["IdCotizacion"] . '" codPaciente="' . $value["IdPaciente"] . '"><i class="fa fa-print"></i></button>
                    <button title="Editar" class="btn btn-warning btnEditarCotizacion" id="btnEditarCotizacion" codCotizacion="' . $value["IdCotizacion"] . '"><i class="fa fa-pencil"></i></button>
                    <button title="Aprobar" class="btn btn-info btnAprobarCotizacion" id="btnAprobarCotizacion" codCotizacion="' . $value["IdCotizacion"] . '"><i class="fa fa-check-circle"></i></button>
                    <button title="Eliminar" class="btn btn-danger btnEliminarCotizacion" id="btnEliminarCotizacion" codCotizacion="' . $value["IdCotizacion"] . '" codEstado="' . $value["EstadoCotizacion"] . '"><i class="fa fa-trash"></i></button>
                  </td>
                </tr>';
                } else {
                  $estado = "Aprobado";
                  echo
                  '<tr>
                  <td>' . ($key + 1) . '</td>
                  <td>' . $value["NombrePaciente"] . '</td>
                  <td>' . $value["ApellidoPaciente"] . '</td>
                  <td>' . $value["NumeroIdentificacion"] . '</td>
                  <td>' . $value["TotalCotizacion"] . '</td>
                  <td>' . $estado . '</td>
                  <td>' . $value["FechaCotizacion"] . '</td>
                  <td>
                    <button title="Imprimir" class="btn btn-success btnImprimirCotizacion" id="btnImprimirCotizacion" codCotizacion="' . $value["IdCotizacion"] . '" codPaciente="' . $value["IdPaciente"] . '"><i class="fa fa-print"></i></button>
                    <button title="Editar" class="btn btn-warning btnEditarCotizacion" id="btnEditarCotizacion" codCotizacion="' . $value["IdCotizacion"] . '" disabled><i class="fa fa-pencil"></i></button>
                    <button title="Aprobar" class="btn btn-info btnAprobarCotizacion" id="btnAprobarCotizacion" codCotizacion="' . $value["IdCotizacion"] . '" disabled><i class="fa fa-check-circle"></i></button>
                    <button title="Eliminar" class="btn btn-danger btnEliminarCotizacion" id="btnEliminarCotizacion" codCotizacion="' . $value["IdCotizacion"] . '" codEstado="' . $value["EstadoCotizacion"] . '" disabled><i class="fa fa-trash"></i></button>
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
$cotizacion = new ControllerCotizaciones();
$cotizacion->ctrEliminarCotizacion();
$cotizacion->ctrCambiarEstado();
?>
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
      <h1 class="mt-4">
        <?php
        $datosPaciente = ControllerPacientes::ctrMostrarDatosHistoria($_GET["codPaciente"]);
        $datosHistoria = ControllerHistorias::ctrMostrarCabeceraHistoria($_GET["codHistoria"]);
        if ($_GET["codPaciente"] && $_GET["codHistoria"]) {
          echo 'Editar Historia De: ' . $datosPaciente["NombrePaciente"] . ' ' . $datosPaciente["ApellidoPaciente"];
        } else {
          echo '
                  <script>
                    window.location = "index.php?ruta=historiaClinica";
                  </script>
                ';
        }
        ?>
      </h1>
    </div>

    <div class="container-fluid">
      <form role="form" method="post" class="row g-3 m-2 formularioHistoriaClinica">

        <!-- Datos Paciente -->
        <span class="border border-3 p-3">
          <div class="container row g-3">

            <div class="container row g-3 p-3 justify-content-between">
              <h3 class="col-3 d-inline-flex-center">Datos Paciente</h3>
              <div class="col-9 d-flex justify-content-end">
                <label class="btn btn-info btnSubirOdontograma ms-2">
                  <i class="fa fa-cloud-upload" aria-hidden="true"></i> Subir Control
                  <input type="file" name="nuevoOdontograma" id="nuevoOdontograma" codHistoria="<?php echo $_GET["codHistoria"] ?>" style="display:none;">
                </label>
                <button type="button" class="btn btn-warning btnDescargarOdontograma ms-2" id="btnDescargarOdontograma" codHistoria="<?php echo $_GET["codHistoria"] ?>"><i class="fa fa-cloud-download" aria-hidden="true"></i> Descargar Control</button>
              </div>
            </div>

            <!-- Seleccionar al paciente -->
            <div class="form-group col-md-8">
              <label for="nombrePaciente" class="form-label" style="font-weight: bold">Paciente:</label>
              <input type="text" class="form-control" id="nombrePaciente" name="nombrePaciente" value="<?php echo $datosPaciente["NombrePaciente"] . ' ' . $datosPaciente["ApellidoPaciente"] ?>" readonly>
            </div>

            <!-- Numero de DNI -->
            <div class="col-md-4">
              <label for="numeroDNI" class="form-label" style="font-weight: bold">DNI: </label>
              <input type="text" class="form-control" id="numeroDNI" name="numeroDNI" value="<?php echo $datosPaciente["DNIPaciente"] ?>" readonly>
            </div>

            <!-- Sexo -->
            <div class="col-md-3">
              <label for="editarSexoPaciente" class="form-label" style="font-weight: bold">Sexo: </label>
              <input type="text" class="form-control" id="editarSexoPaciente" name="editarSexoPaciente" value="<?php echo $datosPaciente["SexoPaciente"] ?>">
            </div>

            <!-- Edad -->
            <div class="col-md-3">
              <label for="editarEdadPaciente" class="form-label" style="font-weight: bold">Edad: </label>
              <input type="text" class="form-control" id="editarEdadPaciente" name="editarEdadPaciente" value="<?php echo $datosPaciente["EdadPaciente"] ?>">
            </div>

            <!-- Ocupación -->
            <div class="col-md-3">
              <label for="editarOcupacionPaciente" class="form-label" style="font-weight: bold">Ocupación: </label>
              <input type="text" class="form-control" id="editarOcupacionPaciente" name="editarOcupacionPaciente" value="<?php echo $datosPaciente["OcupacionPaciente"] ?>">
            </div>

            <!-- Lugar de procedencia -->
            <div class="col-md-3">
              <label for="editarLugarProcedencia" class="form-label" style="font-weight: bold">Lugar de Procedencia: </label>
              <input type="text" class="form-control" id="editarLugarProcedencia" name="editarLugarProcedencia" value="<?php echo $datosPaciente["LugarProcedencia"] ?>">
            </div>

            <!-- Domicilio Actual -->
            <div class="col-md-3">
              <label for="editarDomicilio" class="form-label" style="font-weight: bold">Domicilio Actual: </label>
              <input type="text" class="form-control" id="editarDomicilio" name="editarDomicilio" value="<?php echo $datosPaciente["DomicilioPaciente"] ?>">
            </div>

            <!-- Telefono Celular -->
            <div class="col-md-3">
              <label for="editarCelular" class="form-label" style="font-weight: bold">Telefono / Celular: </label>
              <input type="text" class="form-control" id="editarCelular" name="editarCelular" value="<?php echo $datosPaciente["CelularPaciente"] ?>">
            </div>

          </div>
        </span>

        <!-- Datos Historia Clinica -->
        <span class="border border-3 p-3">
          <div class="container row g-3">
            <h3>Datos Historia</h3>

            <!-- Motivo de la consulta -->
            <div class="col-md-12">
              <label for="editarMotivoConsulta" class="form-label" style="font-weight: bold">Motivo de la consulta: </label>
              <input type="text" class="form-control" id="editarMotivoConsulta" name="editarMotivoConsulta" value="<?php echo $datosHistoria["MotivoConsulta"] ?>">
            </div>

            <!-- Salud general -->
            <div class="col-md-6">
              <label for="saludGeneral m-2" style="font-weight: bold" class=" m-2">Datos estado salud general</label>
              <div class="form-check">
                <input class="form-check-input" type="checkbox" id="editarEstadoAlergias" name="editarEstadoAlergias" <?php echo $datosHistoria["CheckAlergias"] ?>>
                <label class="form-check-label" for="editarEstadoAlergias">
                  Alergias
                </label>
                <input type="text" class="form-control" id="editarDescripcionAlergias" name="editarDescripcionAlergias" value="<?php echo $datosHistoria["DescripcionAlergias"] ?>">
              </div>
              <div class="form-check">
                <input class="form-check-input" type="checkbox" id="editarEstadoHepatitis" name="editarEstadoHepatitis" <?php echo $datosHistoria["CheckHepatitis"] ?>>
                <label class="form-check-label" for="editarEstadoHepatitis">
                  Hepatitis
                </label>
                <input type="text" class="form-control" id="editarDescripcionHepatitis" name="editarDescripcionHepatitis" value="<?php echo $datosHistoria["DescripcionHepatitis"] ?>">
              </div>
              <div class="form-check">
                <input class="form-check-input" type="checkbox" id="editarEstadoDiabetes" name="editarEstadoDiabetes" <?php echo $datosHistoria["CheckDiabetes"] ?>>
                <label class="form-check-label" for="editarEstadoDiabetes">
                  Diabetes
                </label>
                <input type="text" class="form-control" id="editarDescripcionDiabetes" name="editarDescripcionDiabetes" value="<?php echo $datosHistoria["DescripcionDiabetes"] ?>">
              </div>
              <div class="form-check">
                <input class="form-check-input" type="checkbox" id="editarEstadoHipertension" name="editarEstadoHipertension" <?php echo $datosHistoria["CheckHipertension"] ?>>
                <label class="form-check-label" for="editarEstadoHipertension">
                  Hipertension
                </label>
                <input type="text" class="form-control" id="editarDescripcionHipertension" name="editarDescripcionHipertension" value="<?php echo $datosHistoria["DescripcionHipertension"] ?>">
              </div>
              <div class="form-check">
                <input class="form-check-input" type="checkbox" id="editarEstadoHemorragias" name="editarEstadoHemorragias" <?php echo $datosHistoria["CheckHemorragias"] ?>>
                <label class="form-check-label" for="editarEstadoHemorragias">
                  Hemorragias
                </label>
                <input type="text" class="form-control" id="editarDescripcionHemorragias" name="editarDescripcionHemorragias" value="<?php echo $datosHistoria["DescripcionHemorragias"] ?>">
              </div>
              <div class="form-check">
                <input class="form-check-input" type="checkbox" id="editarEstadoRenal" name="editarEstadoRenal" <?php echo $datosHistoria["CheckRenal"] ?>>
                <label class="form-check-label" for="editarEstadoRenal">
                  Enfermedad renal
                </label>
                <input type="text" class="form-control" id="editarDescripcionRenal" name="editarDescripcionRenal" value="<?php echo $datosHistoria["DescripcionRenal"] ?>">
              </div>
              <div class="form-check">
                <input class="form-check-input" type="checkbox" id="editarEstadoEndocrina" name="editarEstadoEndocrina" <?php echo $datosHistoria["CheckEndocrina"] ?>>
                <label class="form-check-label" for="editarEstadoEndocrina">
                  Alteración endocrina
                </label>
                <input type="text" class="form-control" id="editarDescripcionEndocrina" name="editarDescripcionEndocrina" value="<?php echo $datosHistoria["DescripcionEndocrina"] ?>">
              </div>
              <div class="form-check">
                <input class="form-check-input" type="checkbox" id="editarEstadoOtros" name="editarEstadoOtros" <?php echo $datosHistoria["CheckOtros"] ?>>
                <label class="form-check-label" for="editarEstadoOtros">
                  Otros
                </label>
                <input type="text" class="form-control" id="editarDescripcionOtros" name="editarDescripcionOtros" value="<?php echo $datosHistoria["DescripcionOtros"] ?>">
              </div>
            </div>

            <!-- Del estado de salud estomatológico -->
            <div class="col-md-6">
              <label for="saludGeneral" style="font-weight: bold" class=" m-2">Del estado de salud estomatológico</label>
              <div class="form-check">
                <input class="form-check-input" type="checkbox" id="editarEstadoReaccion" name="editarEstadoReaccion" <?php echo $datosHistoria["CheckReaccion"] ?>>
                <label class="form-check-label" for="editarEstadoReaccion">
                  Ha tenido reacción adversa a la anestesia local
                </label>
                <input type="text" class="form-control" id="editarDescripcionReaccion" name="editarDescripcionReaccion" value="<?php echo $datosHistoria["DescripcionReaccion"] ?>">
              </div>
              <div class="form-check">
                <input class="form-check-input" type="checkbox" id="editarEstadoExodoncia" name="editarEstadoExodoncia" <?php echo $datosHistoria["CheckExodoncia"] ?>>
                <label class="form-check-label" for="editarEstadoExodoncia">
                  Ha sufrido hemorragias después de alguna exodoncia
                </label>
                <input type="text" class="form-control" id="editarDescripcionExodoncia" name="editarDescripcionExodoncia" value="<?php echo $datosHistoria["DescripcionExodoncia"] ?>">
              </div>
              <div class="form-check">
                <input class="form-check-input" type="checkbox" id="editarEstadoMedicamento" name="editarEstadoMedicamento" <?php echo $datosHistoria["CheckMedicamento"] ?>>
                <label class="form-check-label" for="editarEstadoMedicamento">
                  Recibe actualmente algún medicamento
                </label>
                <input type="text" class="form-control" id="editarDescripcionMedicamento" name="editarDescripcionMedicamento" value="<?php echo $datosHistoria["DescripcionMedicamento"] ?>">
              </div>
              <div class="form-check">
                <input class="form-check-input" type="checkbox" id="editarEstadoGestando" name="editarEstadoGestando" <?php echo $datosHistoria["CheckGestacion"] ?>>
                <label class="form-check-label" for="editarEstadoGestando">
                  Está gestando
                </label>
                <input type="text" class="form-control" id="editarDescripcionGestando" name="editarDescripcionGestando" value="<?php echo $datosHistoria["DescripcionGestacion"] ?>">
              </div>
            </div>

          </div>
        </span>

        <!-- Pie de historia -->
        <span class="border border-3 p-3">
          <div class="container row g-3 p-3">
            <div class="container row g-3 p-3 justify-content-between">
              <button type="button" class="col-1 d-inline-flex-center p-2 btn btn-secondary cerrarHistoria">Cerrar</button>
              <button type="submit" class="col-2 d-inline-flex-center p-2 btn btn-primary ">Editar Historia</button>
            </div>
          </div>
        </span>
      </form>
    </div>
  </main>
</div>
</div>

<?php
$editarHistoriaClinica = new ControllerHistorias;
$editarHistoriaClinica->ctrEditarHistoria();
?>
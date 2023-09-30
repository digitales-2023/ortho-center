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
        $codPaciente = $_GET["codPaciente"];
        if ($codPaciente != null || $codPaciente != '') {
          $datosPaciente = ControllerPacientes::ctrMostrarDatosBasicos($codPaciente);
          if ($datosPaciente != false) {
            echo 'Nueva Historia Clínica: ' . $datosPaciente["NombrePaciente"] . ' ' . $datosPaciente["ApellidoPaciente"];
          } else {
            echo '
                    <script>
                      window.location = "index.php?ruta=historiaClinica";
                    </script>
                ';
          }
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

            <h3>Datos Paciente</h3>
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
              <label for="sexoPaciente" class="form-label" style="font-weight: bold">Sexo: </label>
              <input type="text" class="form-control" id="sexoPaciente" name="sexoPaciente">
            </div>

            <!-- Edad -->
            <div class="col-md-3">
              <label for="edadPaciente" class="form-label" style="font-weight: bold">Edad: </label>
              <input type="text" class="form-control" id="edadPaciente" name="edadPaciente">
            </div>

            <!-- Ocupación -->
            <div class="col-md-3">
              <label for="ocupacionPaciente" class="form-label" style="font-weight: bold">Ocupación: </label>
              <input type="text" class="form-control" id="ocupacionPaciente" name="ocupacionPaciente">
            </div>

            <!-- Lugar de procedencia -->
            <div class="col-md-3">
              <label for="lugarProcedencia" class="form-label" style="font-weight: bold">Lugar de Procedencia: </label>
              <input type="text" class="form-control" id="lugarProcedencia" name="lugarProcedencia">
            </div>

            <!-- Domicilio Actual -->
            <div class="col-md-3">
              <label for="domicilioPaciente" class="form-label" style="font-weight: bold">Dirección: </label>
              <input type="text" class="form-control" id="domicilioPaciente" name="domicilioPaciente">
            </div>

            <!-- Telefono Celular -->
            <div class="col-md-3">
              <label for="celularPaciente" class="form-label" style="font-weight: bold">Teléfono / Celular: </label>
              <input type="text" class="form-control" id="celularPaciente" name="celularPaciente" value="<?php echo $datosPaciente["CelularPaciente"] ?>">
            </div>

          </div>
        </span>

        <!-- Datos Historia Clinica -->
        <span class="border border-3 p-3">
          <div class="container row g-3">
            <h3>Datos Historia</h3>
            <!-- Motivo de la consulta -->
            <div class="col-md-12">
              <label for="motivoConsulta" class="form-label" style="font-weight: bold">Motivo de la consulta: </label>
              <input type="text" class="form-control" id="motivoConsulta" name="motivoConsulta">
            </div>

            <!-- Salud general -->
            <div class="col-md-6">
              <label for="saludGeneral m-2" style="font-weight: bold" class=" m-2">Datos estado salud general</label>
              <div class="form-check">
                <input class="form-check-input" type="checkbox" id="estadoAlergias" name="estadoAlergias">
                <label class="form-check-label" for="estadoAlergias">
                  Alergias
                </label>
                <input type="text" class="form-control" id="descripcionAlergias" name="descripcionAlergias">
              </div>
              <div class="form-check">
                <input class="form-check-input" type="checkbox" id="estadoHepatitis" name="estadoHepatitis">
                <label class="form-check-label" for="estadoHepatitis" id="descripcionHepatitis">
                  Hepatitis
                </label>
                <input type="text" class="form-control" id="descripcionHepatitis" name="descripcionHepatitis">
              </div>
              <div class="form-check">
                <input class="form-check-input" type="checkbox" id="estadoDiabetes" name="estadoDiabetes">
                <label class="form-check-label" for="estadoDiabetes">
                  Diabetes
                </label>
                <input type="text" class="form-control" id="descripcionDiabetes" name="descripcionDiabetes">
              </div>
              <div class="form-check">
                <input class="form-check-input" type="checkbox" id="estadoHipertension" name="estadoHipertension">
                <label class="form-check-label" for="estadoHipertension">
                  Hipertension
                </label>
                <input type="text" class="form-control" id="descripcionHipertension" name="descripcionHipertension">
              </div>
              <div class="form-check">
                <input class="form-check-input" type="checkbox" id="estadoHemorragias" name="estadoHemorragias">
                <label class="form-check-label" for="estadoHemorragias">
                  Hemorragias
                </label>
                <input type="text" class="form-control" id="descripcionHemorragias" name="descripcionHemorragias">
              </div>
              <div class="form-check">
                <input class="form-check-input" type="checkbox" id="estadoRenal" name="estadoRenal">
                <label class="form-check-label" for="estadoRenal">
                  Enfermedad renal
                </label>
                <input type="text" class="form-control" id="descripcionRenal" name="descripcionRenal">
              </div>
              <div class="form-check">
                <input class="form-check-input" type="checkbox" id="estadoEndocrina" name="estadoEndocrina">
                <label class="form-check-label" for="estadoEndocrina">
                  Alteración endocrina
                </label>
                <input type="text" class="form-control" id="descripcionEndocrina" name="descripcionEndocrina">
              </div>
              <div class="form-check">
                <input class="form-check-input" type="checkbox" id="estadoOtros" name="estadoOtros">
                <label class="form-check-label" for="estadoOtros">
                  Otros
                </label>
                <input type="text" class="form-control" id="descripcionOtros" name="descripcionOtros">
              </div>
            </div>


            <!-- Del estado de salud estomatológico -->
            <div class="col-md-6">
              <label for="saludGeneral" style="font-weight: bold" class=" m-2">Del estado de salud estomatológico</label>
              <div class="form-check">
                <input class="form-check-input" type="checkbox" id="estadoReaccion" name="estadoReaccion">
                <label class="form-check-label" for="estadoReaccion">
                  Ha tenido reacción adversa a la anestesia local
                </label>
                <input type="text" class="form-control" id="descripcionReaccion" name="descripcionReaccion">
              </div>
              <div class="form-check">
                <input class="form-check-input" type="checkbox" id="estadoExodoncia" name="estadoExodoncia">
                <label class="form-check-label" for="estadoExodoncia">
                  Ha sufrido hemorragias después de alguna exodoncia
                </label>
                <input type="text" class="form-control" id="descripcionExodoncia" name="descripcionExodoncia">
              </div>
              <div class="form-check">
                <input class="form-check-input" type="checkbox" id="estadoMedicamento" name="estadoMedicamento">
                <label class="form-check-label" for="estadoMedicamento">
                  Recibe actualmente algún medicamento
                </label>
                <input type="text" class="form-control" id="descripcionMedicamento" name="descripcionMedicamento">
              </div>
              <div class="form-check">
                <input class="form-check-input" type="checkbox" id="estadoGestando" name="estadoGestando">
                <label class="form-check-label" for="estadoGestando">
                  Está gestando
                </label>
                <input type="text" class="form-control" id="descripcionGestando" name="descripcionGestando">
              </div>
            </div>
          </div>
        </span>

        <span class="border border-3 p-3">
          <div class="container row g-3 p-3">
            <div class="container row g-3 p-3 justify-content-between">
              <button type="button" class="col-1 d-inline-flex-center p-2 btn btn-secondary cerrarHistoria">Cerrar</button>
              <button type="submit" class="col-2 d-inline-flex-center p-2 btn btn-primary ">Registrar Historia</button>
            </div>
          </div>
        </span>
      </form>
    </div>
  </main>
</div>
</div>

<?php
$crearNuevaHistoria = new ControllerHistorias;
$crearNuevaHistoria->ctrCrearNuevaHistoria();
?>
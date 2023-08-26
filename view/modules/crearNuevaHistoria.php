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
              if($codPaciente != null || $codPaciente != '')
              {
                $datosPaciente = ControllerPacientes::ctrMostrarDatosBasicos($codPaciente);
                if($datosPaciente != false)
                {
                  echo 'Nueva Historia Clínica :'.$datosPaciente["NombrePaciente"].' '.$datosPaciente["ApellidoPaciente"];
                }
                else
                {
                  echo'
                    <script>
                      window.location = "index.php?ruta=historiaClinica";
                    </script>
                ';
                }
              }
              else
              {
                echo'
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
                  <input type="text" class="form-control" id="nombrePaciente" name="nombrePaciente" value="<?php echo $datosPaciente["NombrePaciente"].' '.$datosPaciente["ApellidoPaciente"] ?>" readonly>
                </div>

                <!-- Numero de DNI -->
                <div class="col-md-4">
                  <label for="numeroDNI" class="form-label" style="font-weight: bold">DNI: </label>
                  <input type="text" class="form-control" id="numeroDNI" name="numeroDNI" value="<?php echo $datosPaciente["DNIPaciente"]?>" readonly>
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

                <!-- Lugar de nacimiento -->
                <div class="col-md-3">
                  <label for="lugarNacimiento" class="form-label" style="font-weight: bold">Lugar nacimiento: </label>
                  <input type="text" class="form-control" id="lugarNacimiento" name="lugarNacimiento">
                </div>

                <!-- Grado de instruccion -->
                <div class="col-md-3">
                  <label for="gradoInstruccion" class="form-label" style="font-weight: bold">Grado de instrucción: </label>
                  <input type="text" class="form-control" id="gradoInstruccion" name="gradoInstruccion">
                </div>

                <!-- Ocupación -->
                <div class="col-md-3">
                  <label for="ocupacionPaciente" class="form-label" style="font-weight: bold">Ocupación: </label>
                  <input type="text" class="form-control" id="ocupacionPaciente" name="ocupacionPaciente">
                </div>

                <!-- Fecha Nacimiento -->
                <div class="col-md-3">
                  <label for="fechaNacimiento" class="form-label" style="font-weight: bold">Fecha de Nacimiento: </label>
                  <input type="date" class="form-control" id="fechaNacimiento" name="fechaNacimiento">
                </div>

                <!-- Raza -->
                <div class="col-md-3">
                  <label for="razaPaciente" class="form-label" style="font-weight: bold">Raza: </label>
                  <input type="text" class="form-control" id="razaPaciente" name="razaPaciente">
                </div>

                <!-- Religión -->
                <div class="col-md-3">
                  <label for="religionPaciente" class="form-label" style="font-weight: bold">Religión: </label>
                  <input type="text" class="form-control" id="religionPaciente" name="religionPaciente">
                </div>

                <!-- Estado Civil -->
                <div class="col-md-3">
                  <label for="estadoCivil" class="form-label" style="font-weight: bold">Estado Civil: </label>
                  <input type="text" class="form-control" id="estadoCivil" name="estadoCivil">
                </div>

                <!-- Lugar de procedencia -->
                <div class="col-md-3">
                  <label for="lugarProcedencia" class="form-label" style="font-weight: bold">Lugar de Procedencia: </label>
                  <input type="text" class="form-control" id="lugarProcedencia" name="lugarProcedencia">
                </div>

                <!-- Domicilio Actual -->
                <div class="col-md-3">
                  <label for="domicilioPaciente" class="form-label" style="font-weight: bold">Domicilio Actual: </label>
                  <input type="text" class="form-control" id="domicilioPaciente" name="domicilioPaciente">
                </div>

                <!-- Telefono Celular -->
                <div class="col-md-3">
                  <label for="celularPaciente" class="form-label" style="font-weight: bold">Teléfono / Celular: </label>
                  <input type="text" class="form-control" id="celularPaciente" name="celularPaciente" value="<?php echo $datosPaciente["CelularPaciente"]?>">
                </div>

                <!-- Persona Contacto Celular -->
                <div class="col-md-3">
                  <label for="personaContacto" class="form-label" style="font-weight: bold">Persona de Contacto: </label>
                  <input type="text" class="form-control" id="personaContacto" name="personaContacto">
                </div>

                <!-- Telefono Celular -->
                <div class="col-md-3">
                  <label for="numeroContacto" class="form-label" style="font-weight: bold">Número de Contacto: </label>
                  <input type="text" class="form-control" id="numeroContacto" name="numeroContacto">
                </div>

              </div>
            </span>

            <!-- Datos Historia Clinica -->
            <span class="border border-3 p-3">
              <div class="container row g-3">
                <h3>Datos Historia</h3>
                <!-- Alergias encontradas -->
                <div class="col-md-12">
                  <label for="riesgoAlergia" class="form-label" style="font-weight: bold">Riesgo de Alergia: </label>
                  <input type="text" class="form-control" id="riesgoAlergia" name="riesgoAlergia">
                </div>

                <!-- Datos del paciente -->
                <div class="col-md-12">
                  <label for="datosInformante" class="form-label" style="font-weight: bold">Datos del informante: </label>
                  <input type="text" class="form-control" id="datosInformante" name="datosInformante">
                </div>

                <!-- Motivo de la consulta -->
                <div class="col-md-12">
                  <label for="motivoConsulta" class="form-label" style="font-weight: bold">Motivo de la consulta: </label>
                  <input type="text" class="form-control" id="motivoConsulta" name="motivoConsulta">
                </div>

                <!-- Tiempo de enfermedad -->
                <div class="col-md-12">
                  <label for="tiempoEnfermedad" class="form-label" style="font-weight: bold">Tiempo de enfermedad: </label>
                  <input type="text" class="form-control" id="tiempoEnfermedad" name="tiempoEnfermedad">
                </div>

                <!-- Signos y síntomas principales -->
                <div class="col-md-12">
                  <label for="signosySintomas" class="form-label" style="font-weight: bold">Signos y síntomas principales: </label>
                  <input type="text" class="form-control" id="signosySintomas" name="signosySintomas">
                </div>

                <!-- Relato Cronólogico -->
                <div class="col-md-12">
                  <label for="relatoCronologico" class="form-label" style="font-weight: bold">Relato Cronólogico: </label>
                  <input type="text" class="form-control" id="relatocronologico" name="relatocronologico">
                </div>

                <!-- Funciones Biológicas -->
                <div class="col-md-12">
                  <label for="funcionesBiologicas" class="form-label" style="font-weight: bold">Funciones Biológicas: </label>
                  <input type="text" class="form-control" id="funcionesBiologicas" name="funcionesBiologicas">
                </div>

                <!-- Antecedentes Familiares -->
                <div class="col-md-12">
                  <label for="antecedentesFamiliares" class="form-label" style="font-weight: bold">Antecedentes Familiares: </label>
                  <textarea class="form-control" id="antecedentesFamiliares" name="antecedentesFamiliares" rows="3"></textarea>
                </div>

                <!-- Antecedentes Personales -->
                <div class="col-md-12">
                  <label for="antecedentesPersonales" class="form-label" style="font-weight: bold">Antecedentes Personales: </label>
                  <textarea class="form-control" id="antecedentesPersonales" name="antecedentesPersonales" rows="3"></textarea>
                </div>

                <h4>Exploración Física</h4>
                <!-- Presion Arterial -->
                <div class="col-md-2">
                  <label for="presionArterial" class="form-label" style="font-weight: bold">P.A: </label>
                  <input type="text" class="form-control" id="presionArterial" name="presionArterial">
                </div>

                <!-- Pulso -->
                <div class="col-md-2">
                  <label for="pulsoPaciente" class="form-label" style="font-weight: bold">Pulso: </label>
                  <input type="text" class="form-control" id="pulsoPaciente" name="pulsoPaciente">
                </div>

                <!-- Antecedentes Personales -->
                <div class="col-md-2">
                  <label for="temperaturaPaciente" class="form-label" style="font-weight: bold">Temperatura: </label>
                  <input type="text" class="form-control" id="temperaturaPaciente" name="temperaturaPaciente">
                </div>

                <!-- Frecuencia Cardiaca -->
                <div class="col-md-2">
                  <label for="frecuenciaCardiaca" class="form-label" style="font-weight: bold">F.C : </label>
                  <input type="text" class="form-control" id="frecuenciaCardiaca" name="frecuenciaCardiaca">
                </div>

                <!-- Frecuencia Respiratoria -->
                <div class="col-md-2">
                  <label for="frecuenciaRespiratoria" class="form-label" style="font-weight: bold">Frec. Resp: </label>
                  <input type="text" class="form-control" id="frecuenciaRespiratoria" name="frecuenciaRespiratoria">
                </div>

                <!-- Primer examen, evaluacion -->
                <div class="col-md-12">
                  <label for="examenOdontoEst" class="form-label" style="font-weight: bold">Exámen Odontoestoamatológico: </label>
                  <textarea class="form-control" id="examenOdontoEst" name="examenOdontoEst" rows="3"></textarea>
                </div>

                <!-- Diagnóstico presuntivo -->
                <div class="col-md-12">
                  <label for="diagnostivoPresuntivo" class="form-label" style="font-weight: bold">Diagnóstico Presuntivo: </label>
                  <input type="text" class="form-control" id="diagnostivoPresuntivo" name="diagnostivoPresuntivo">
                </div>
                
                <!-- Diagnóstico Definitivo -->
                <div class="col-md-12">
                  <label for="diagnostivoDefinitivo" class="form-label" style="font-weight: bold">Diagnóstico Definitivo: </label>
                  <input type="text" class="form-control" id="diagnostivoDefinitivo" name="diagnostivoDefinitivo">
                </div>
                
                <!-- Pronóstico -->
                <div class="col-md-12">
                  <label for="pronosticoHistoria" class="form-label" style="font-weight: bold">Pronóstico: </label>
                  <input type="text" class="form-control" id="pronosticoHistoria" name="pronosticoHistoria">
                </div>

                <!-- Tratamiento -->
                <div class="col-md-12">
                  <label for="tratamientoHistoria" class="form-label" style="font-weight: bold">Tratamiento: </label>
                  <textarea class="form-control" id="tratamientoHistoria" name="tratamientoHistoria" rows="3"></textarea>
                </div>

                <!-- Alta Paciente -->
                <div class="col-md-12">
                  <label for="altaHistoria" class="form-label" style="font-weight: bold">Alta Paciente: </label>
                  <textarea class="form-control" id="altaHistoria" name="altaHistoria" rows="3"></textarea>
                </div>
                
              </div>
            </span>

            <!-- Plan de tratamiento, donde se mostrará toda la lista de Procedimientos -->
            <span class="border border-3 p-3">
              <div class="container row g-3">
                <h3>Plan de Tratamiento</h3>
                <div class="d-inline-flex m-2">
                  <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalAgregarProcedimiento">Agregar Procedimiento</button>
                </div>

                <div class="row" style="font-weight: bold">
                  <div class="col-lg-5">Descripción</div>
                  <div class="col-lg-5">Observación</div>
                  <div class="col-lg-2">Precio(S/.)</div>
                </div>

                <div class="form-group row nuevoProcedimiento">
                  <input type="hidden" id="listarProcedimientos" name="listarProcedimientos">
                </div>
              </div>
            </span>

            <!-- Pie de historia -->
            <span class="border border-3 p-3">
              <div class="container row g-3 p-3">
                <h3>Costo Total</h3>
                <div class="row" style="font-weight: bold">
                  <div class="col-lg-2"></div>
                  <div class="col-lg-2"><span>Costo Total(S/.):</span></div><div class="col-lg-2"><input type="number" style="text-align: right;" class="form-control input-lg" id="nuevoTotalTratamiento" name="nuevoTotalTratamiento" placeholder="0.00" readonly></div>            
                </div>
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
  $crearNuevaHistoria -> ctrCrearNuevaHistoria();
?>

  
<!-- Modal agregar nuevo procedimiento -->
<div class="modal fade" id="modalAgregarProcedimiento" tabindex="-1" role="dialog" aria-labelledby="modalAgregarProcedimiento" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Listado de Procedimientos</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <!-- Cuerpo modal -->
      <div class="modal-body">
        <table class="table table-striped dt-responsive tablaProcedimientos" width="100%">
          <thead>
            <tr>
              <th style ="width:10px">#</th>
              <th>Descripción del Procedimiento</th>
              <th>Acciones</th>           
            </tr> 
          </thead>
          <tbody>
            <?php
              $listaProcedimientos = ControllerProcedimientos::ctrMostraProcedimientosHistoria();
              foreach ($listaProcedimientos as $key => $value)
              {
                echo ' 
                  <tr>
                    <td>'.($key + 1).'</td>
                    <td>'.$value["NombreProcedimiento"].'</td>
                    <td>
                      <div class="btn-group">
                        <button class="btn btn-primary btnAgregarProcedimiento recuperarBoton" codProcedimiento="'.$value["IdProcedimiento"].'">Agregar</button> 
                      </div>
                    </td>
                  </tr>'
                ;
              }
            ?> 
          </tbody>
        </table>
      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-secondary pull-left" data-bs-dismiss="modal">Salir</button>
      </div>
    </div>
  </div>
</div>

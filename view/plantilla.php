<?php
session_start();
?>
<!DOCTYPE html>
<html lang="es">

<head>
  <?php require "modules/header.php" ?>
</head>

<?php
if (isset($_SESSION["login"]) && $_SESSION["login"] == "ok") {
  echo '<body class="sb-nav-fixed">';

  include "modules/navbar.php";

  echo '
      <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
          <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
            <div class="sb-sidenav-menu">
              <div class="nav">';
  include "modules/menu.php";

  if (isset($_GET["ruta"])) {
    if (
      $_GET["ruta"] == "home" ||
      $_GET["ruta"] == "usuario" ||
      $_GET["ruta"] == "procedimientos" ||
      $_GET["ruta"] == "gastos" ||
      $_GET["ruta"] == "socios" ||
      $_GET["ruta"] == "pacientes" ||
      $_GET["ruta"] == "allCostos" ||
      $_GET["ruta"] == "centroCostos" ||
      $_GET["ruta"] == "crearNuevoCosto" ||
      $_GET["ruta"] == "editarCosto" ||
      $_GET["ruta"] == "buscarCostos" ||
      $_GET["ruta"] == "reporteCostos" ||
      $_GET["ruta"] == "historiaClinica" ||
      $_GET["ruta"] == "crearNuevaHistoria" ||
      $_GET["ruta"] == "editarHistoria" ||
      $_GET["ruta"] == "planTratamiento" ||
      $_GET["ruta"] == "pagosPendientes" ||
      $_GET["ruta"] == "historialPagos" ||
      $_GET["ruta"] == "visualizarPagos" ||
      $_GET["ruta"] == "programacionCitas" ||
      $_GET["ruta"] == "cotizaciones" ||
      $_GET["ruta"] == "crearCotizacion" ||
      $_GET["ruta"] == "editarCotizacion" ||
      $_GET["ruta"] == "historialVisitas" ||
      $_GET["ruta"] == "signout"
    ) {
      include "modules/" . $_GET["ruta"] . ".php";
    } else {
      include "web/404.html";
    }
  } else {
    include "modules/home.php";
  }
  echo '<footer>';
  include "modules/footer.php";
  echo '</footer>';
  echo '</div>';
  echo '</div>';
} else {
  include "modules/login.php";
}
?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
<script src="js/scripts.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
<script src="js/datatables-simple-demo.js"></script>
<script type="text/javascript" src="https://code.jquery.com/jquery-3.7.0.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css" />

<script src="js/usuario.js"></script>
<script src="js/gastos.js"></script>
<script src="js/socios.js"></script>
<script src="js/pacientes.js"></script>
<script src="js/procedimientos.js"></script>
<script src="js/costos.js"></script>
<script src="js/historias.js"></script>
<script src="js/tratamiento.js"></script>
<script src="js/pagos.js"></script>
<script src="js/citas.js"></script>
<script src="js/cotizacion.js"></script>
<script src="js/visitas.js"></script>

<script src="assets/chartCostoRango.js"></script>
<script src="assets/chartCentroCosto.js"></script>
</body>

</html>
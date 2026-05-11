<!-- Menu de todos los usuarios en general -->
<div class="sb-sidenav-menu-heading">Inicio</div>
<a class="nav-link" href="home">
  <div class="sb-nav-link-icon"><i class="fas fa-home"></i></div>
  Inicio
</a>

<!-- Historias Clinica - Enlace directo -->
<div class="sb-sidenav-menu-heading">Pacientes</div>
<a class="nav-link" href="historiaClinica">
  <div class="sb-nav-link-icon"><i class="fas fa-file-medical"></i></div>
  Historias Clínicas
</a>
<a class="nav-link" href="pacientes">
  <div class="sb-nav-link-icon"><i class="fas fa-users"></i></div>
  Registros Pacientes
</a>

<!-- Cotizaciones - Enlace directo -->
<div class="sb-sidenav-menu-heading">Cotizaciones</div>
<a class="nav-link" href="cotizaciones">
  <div class="sb-nav-link-icon"><i class="fas fa-file-invoice-dollar"></i></div>
  Cotizaciones
</a>

<!-- Historias Pagos -->
<div class="sb-sidenav-menu-heading">Pagos</div>
<a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#listaPagos" aria-expanded="false" aria-controls="collapseLayouts">
  <div class="sb-nav-link-icon"><i class="fas fa-money-bill-wave"></i></div>
  Pagos
  <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
</a>
<div class="collapse" id="listaPagos" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
  <nav class="sb-sidenav-menu-nested nav">
    <a class="nav-link" href="historialPagos"><div class="sb-nav-link-icon"><i class="fas fa-history"></i></div> Todos los pagos</a>
    <a class="nav-link" href="pagosPendientes"><div class="sb-nav-link-icon"><i class="fas fa-clock"></i></div> Pagos pendientes</a>
  </nav>
</div>

<!-- Costos  -->
<div class="sb-sidenav-menu-heading">Costos</div>
<a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#listaCostos" aria-expanded="false" aria-controls="collapseLayouts">
  <div class="sb-nav-link-icon"><i class="fas fa-chart-line"></i></div>
  Costos
  <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
</a>
<div class="collapse" id="listaCostos" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
  <nav class="sb-sidenav-menu-nested nav">
    <a class="nav-link" href="allCostos"><div class="sb-nav-link-icon"><i class="fas fa-table"></i></div> Planilla de Costos</a>
    <a class="nav-link" href="buscarCostos"><div class="sb-nav-link-icon"><i class="fas fa-search"></i></div> Filtrar Costos</a>
    <a class="nav-link" href="reporteCostos"><div class="sb-nav-link-icon"><i class="fas fa-file-pdf"></i></div> Reporte de Costos</a>
  </nav>
</div>

<!-- Catálogo -->
<div class="sb-sidenav-menu-heading">Catálogo</div>

<?php
if ($_SESSION["perfilUsuario"] == 1 || $_SESSION["perfilUsuario"] == 2) {
?>
  <!-- Catálogo  de Costos -->
  <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#listaCatalogoCostos" aria-expanded="false" aria-controls="collapseLayouts">
    <div class="sb-nav-link-icon"><i class="fas fa-layer-group"></i></div>
    Catálogo Costos
    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
  </a>
  <div class="collapse" id="listaCatalogoCostos" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
    <nav class="sb-sidenav-menu-nested nav">
      <a class="nav-link" href="centroCostos"><div class="sb-nav-link-icon"><i class="fas fa-building"></i></div> Centros de Costos</a>
      <a class="nav-link" href="socios"><div class="sb-nav-link-icon"><i class="fas fa-handshake"></i></div> Catálogo de Socios</a>
      <a class="nav-link" href="gastos"><div class="sb-nav-link-icon"><i class="fas fa-receipt"></i></div> Catálogo de Costos</a>
    </nav>
  </div>
<?php
}
?>

<!-- Catálogo  de Historias Clinicas -->
<a class="nav-link" href="procedimientos">
  <div class="sb-nav-link-icon"><i class="fas fa-tools"></i></div>
  Procedimientos
</a>
<?php
if ($_SESSION["perfilUsuario"] == 1) {
?>
  <!-- Catálogo de Usuarios -->
  <a class="nav-link" href="usuario">
    <div class="sb-nav-link-icon"><i class="fas fa-user-cog"></i></div>
    Usuarios
  </a>
<?php
}
?>
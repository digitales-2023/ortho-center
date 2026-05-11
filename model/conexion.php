<?php

/**
 * Conexion — Sistema OrthocenterPro (fusionado)
 *
 * ENTORNO LOCAL:
 *   Host: localhost | DB: db_orthocenter | Usuario: root
 *
 * PRODUCCIÓN (descomentar la línea correspondiente y comentar la local):
 *   Host: servidor hosting | DB: u553466910_db_dentavitali | Usuario: u553466910_admin_denta
 */
class Conexion
{
  static public function conn()
  {
    // --- LOCAL (Docker LAMP) ---
    // El servicio de MySQL se llama 'db' según docker-compose.yml
   /*  $link = new PDO("mysql:host=db;dbname=dev_orthocenter", "root", "test"); */

    // --- PRODUCCIÓN (hostinger) ---
        $link = new PDO("mysql:host=localhost;dbname=pruebasbetaacide_dev_orthocenter", "pruebasbetaacide_admin_ortho", "Acide*2026");

    $link->exec("set names utf8");
    return $link;
  }
}
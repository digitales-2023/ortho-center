<?php

class Conexion
{
  static public function conn()
  {
    $link = new PDO("mysql:host=localhost;dbname=db_orthocenter","root","");
    //$link = new PDO("mysql:host=localhost;dbname=u534662521_db_dentavitali","u534662521_root","PruebaAcide2023");
		$link->exec("set names utf8");
		return $link;
  }
}
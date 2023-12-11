<?php
@$conexion = new mysqli('localhost', 'root', '');
$conexion->set_charset("utf8");

if (!$conexion->connect_errno)
  $conexion->select_db("bd_votaciones_2019_Examen_rmb") or die("Base de Datos no encontrada");
?>
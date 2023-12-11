<?php
session_start();
include 'conexionBD.php';

$sql50 = "SELECT * FROM convocatoria where escrutinio='Abierto' ";
$memi50 = $conexion->query($sql50);

if ($memi50 && $memi50->num_rows > 0) {
  $info1 = $memi50->fetch_array();
  $sq1 = "UPDATE convocatoria SET escrutinio='Cerrado' WHERE escrutinio='Abierto' ";
  $comprobar = $conexion->query($sq1);

  $sql2 = "SELECT count(*) FROM partido";
  $memi2 = $conexion->query($sql2);
  if ($memi2->num_rows > 0) {
    $info2 = $memi2->fetch_array();
    $num = $info2[0];
    $num = (int) $num;
  }

  $cont = 0;
  $listaVot = array();
  for ($cont2 = 0; $cont < $num; $cont2++) {
    $sql1 = "SELECT id,votosTotales FROM partido WHERE ID='" . $cont2 . "'";
    $memi1 = $conexion->query($sql1);

    if ($memi1 && $memi1->num_rows > 0) {
      $info10 = $memi1->fetch_array();
      $listaVot[$info10['id']] = $info10['votosTotales'];

      $cont++;
    }
  }

  foreach ($listaVot as $key => $value) {
    $sq1 = "INSERT INTO resultado(convocatoria,partido,totalVotos)   VALUES(" . $info1['id'] . "," . $key . "," . $value . ")";
    $comprobar = $conexion->query($sq1);
  }

  $_SESSION['mas'] = 1;
  $_SESSION['mensajeBD'] = "Escrutinio Cerrado. Ya se pueden consultar los resultados desde el menu";
  header("Location:MensajeErrores.php");
  exit;

} else {
  $_SESSION['mensajeBD'] = "No puedes cerrar lo que abierto no esta.";
  header("Location:MensajeErrores.php");
  exit;
} ?>
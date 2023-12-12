<?php
session_start();
include 'conexionBD.php';

$sql = "SELECT * FROM convocatoria where escrutinio='Abierto' ";
$memory = $conexion->query($sql);

if ($memory && $memory->num_rows > 0) {
  $info = $memory->fetch_array();
  $sql3 = "UPDATE convocatoria SET escrutinio='Cerrado' WHERE escrutinio='Abierto' ";
  $check = $conexion->query($sql3);

  $sql2 = "SELECT count(*) FROM partido";
  $memory2 = $conexion->query($sql2);
  if ($memory2->num_rows > 0) {
    $info2 = $memory2->fetch_array();
    $num = $info2[0];
    $num = (int) $num;
  }

  $cont = 0;
  $votList = array();
  for ($cont2 = 0; $cont < $num; $cont2++) {
    $sql1 = "SELECT id,votosTotales FROM partido WHERE ID='" . $cont2 . "'";
    $memory1 = $conexion->query($sql1);

    if ($memory1 && $memory1->num_rows > 0) {
      $info1 = $memory1->fetch_array();
      $votList[$info1['id']] = $info1['votosTotales'];

      $cont++;
    }
  }

  foreach ($votList as $key => $value) {
    $sql3 = "INSERT INTO resultado(convocatoria,partido,totalVotos)   VALUES(" . $info['id'] . "," . $key . "," . $value . ")";
    $check = $conexion->query($sql3);
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
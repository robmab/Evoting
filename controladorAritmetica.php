<?php
session_start();
include 'conexionBD.php';

//Controladores
$sql50 = "SELECT * FROM convocatoria where escrutinio='Abierto' ";
$memi50 = $conexion->query($sql50);

if ($memi50 && $memi50->num_rows > 0) {
  $_SESSION['mensajeBD'] = "No puedes ver los resultados hasta que se halla cerrado el escrutinio.";
  header("Location:MensajeErrores.php");
  exit;
}

if (!isset($_SESSION['mas'])) {
  $_SESSION['mensajeBD'] = "No puedes ver los resultados hasta que se halla cerrado el escrutinio.";
  header("Location:MensajeErrores.php");
  exit;
}

$votosTotales = 0;
$sql2 = "SELECT count(*) FROM partido";
$memi2 = $conexion->query($sql2);

if ($memi2->num_rows > 0) {
  $info2 = $memi2->fetch_array();
  $num = $info2[0];
  $num = (int) $num;
}

$cont = 0;
$listaPar = array();

for ($cont2 = 0; $cont < $num; $cont2++) {
  $sql1 = "SELECT * FROM partido WHERE ID='" . $cont2 . "'";
  $memi1 = $conexion->query($sql1);

  if ($memi1 && $memi1->num_rows > 0) {
    $info1 = $memi1->fetch_array();
    $votosTotales = $info1['votosTotales'] + $votosTotales;
    $cont++;
  }
}

$media = $votosTotales / $cont;
$sql2 = "SELECT count(*) FROM partido";
$memi2 = $conexion->query($sql2);

if ($memi2->num_rows > 0) {
  $info2 = $memi2->fetch_array();
  $num = $info2[0];
  $num = (int) $num;
}

$cont = 0;
$listaPar = array();
for ($cont2 = 0; $cont < $num; $cont2++) {
  $sql1 = "SELECT * FROM partido WHERE ID='" . $cont2 . "'";
  $memi1 = $conexion->query($sql1);

  if ($memi1 && $memi1->num_rows > 0) {
    $info1 = $memi1->fetch_array();
    if ($info1['votosTotales'] > $media) {
      $listaPar[$cont]['nombre'] = $info1['nombre'];
      $listaPar[$cont]['siglas'] = $info1['siglas'];
      $listaPar[$cont]['logo'] = $info1['logo'];
      $listaPar[$cont]['votosTotales'] = $info1['votosTotales'];
    }
    $cont++;
  }
}

function array_sort($array, $on, $order = SORT_ASC)
{
  $new_array = array();
  $sortable_array = array();

  if (count($array) > 0) {
    foreach ($array as $k => $v) {
      if (is_array($v)) {
        foreach ($v as $k2 => $v2) {
          if ($k2 == $on) {
            $sortable_array[$k] = $v2;
          }
        }
      } else {
        $sortable_array[$k] = $v;
      }
    }

    switch ($order) {
      case SORT_ASC:
        asort($sortable_array);
        break;
      case SORT_DESC:
        arsort($sortable_array);
        break;
    }

    foreach ($sortable_array as $k => $v) {
      $new_array[$k] = $array[$k];
    }
  }
  return $new_array;
}

$listaPar = array_sort($listaPar, 'votosTotales', SORT_DESC);
$_SESSION['ARRAYPARTIDOS'] = $listaPar;
header("Location:vistaAritmetica.php");
exit;
?>
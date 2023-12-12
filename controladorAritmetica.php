<?php
session_start();
include 'conexionBD.php';

//Controllers
$sql = "SELECT * FROM convocatoria where escrutinio='Abierto' ";
$memory = $conexion->query($sql);

if ($memory && $memory->num_rows > 0) {
  $_SESSION['mensajeBD'] = "No puedes ver los resultados hasta que se halla cerrado el escrutinio.";
  header("Location:MensajeErrores.php");
  exit;
}

if (!isset($_SESSION['mas'])) {
  $_SESSION['mensajeBD'] = "No puedes ver los resultados hasta que se halla cerrado el escrutinio.";
  header("Location:MensajeErrores.php");
  exit;
}

$amountVotes = 0;
$sql2 = "SELECT count(*) FROM partido";
$memi2 = $conexion->query($sql2);

if ($memi2->num_rows > 0) {
  $info2 = $memi2->fetch_array();
  $num = $info2[0];
  $num = (int) $num;
}

$cont = 0;
$parList = array();

for ($cont2 = 0; $cont < $num; $cont2++) {
  $sql2 = "SELECT * FROM partido WHERE ID='" . $cont2 . "'";
  $memory2 = $conexion->query($sql2);

  if ($memory2 && $memory2->num_rows > 0) {
    $info1 = $memory2->fetch_array();
    $amountVotes = $info1['votosTotales'] + $amountVotes;
    $cont++;
  }
}

$media = $amountVotes / $cont;
$sql2 = "SELECT count(*) FROM partido";
$memi2 = $conexion->query($sql2);

if ($memi2->num_rows > 0) {
  $info2 = $memi2->fetch_array();
  $num = $info2[0];
  $num = (int) $num;
}

$cont = 0;
$parList = array();
for ($cont2 = 0; $cont < $num; $cont2++) {
  $sql2 = "SELECT * FROM partido WHERE ID='" . $cont2 . "'";
  $memory2 = $conexion->query($sql2);

  if ($memory2 && $memory2->num_rows > 0) {
    $info1 = $memory2->fetch_array();
    if ($info1['votosTotales'] > $media) {
      $parList[$cont]['nombre'] = $info1['nombre'];
      $parList[$cont]['siglas'] = $info1['siglas'];
      $parList[$cont]['logo'] = $info1['logo'];
      $parList[$cont]['votosTotales'] = $info1['votosTotales'];
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

$parList = array_sort($parList, 'votosTotales', SORT_DESC);
$_SESSION['ARRAYPARTIDOS'] = $parList;
header("Location:vistaAritmetica.php");
exit;
?>
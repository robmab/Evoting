<?php
$counter1 = 1;
$counter2 = 1;
session_start();

if (isset($_REQUEST["dni"]))
  $dni = $_REQUEST["dni"];

if (isset($_REQUEST["contraseña"])) {
  $password = $_REQUEST["contraseña"];
  include 'conexionBD.php';

  //Check DNI
  $sql = "SELECT count(*) FROM votante";
  $memory = $conexion->query($sql);

  if ($memory->num_rows > 0) {
    $info = $memory->fetch_array();
    $num = $info[0];
    $num = (int) $num;
  }

  $cont = 0;
  $votList = array();

  for ($cont2 = 0; $cont < $num; $cont2++) {
    $sql2 = "SELECT nif FROM votante WHERE ID='" . $cont2 . "'";
    $memi3 = $conexion->query($sql2);

    if ($memi3 && $memi3->num_rows > 0) {
      $info3 = $memi3->fetch_array();
      $votList[$cont] = $info3['nif'];
      $cont++;
    }
  }

  foreach ($votList as $nif) {
    if ($nif == $dni)
      $counter1 = 0;
  }

  if ($counter1 == 1) {
    $_SESSION['errDni'] = 'Este dni no esta registrado.';
    unset($_SESSION['user']);
    $counter2 = 0;
    header("Location:index.php");
  }

  //Check password and voted. Avoid SQL Injection ---2 method
  $sql1 = "SELECT * FROM votante WHERE nif='" . $dni . "'  ";
  $memory3 = $conexion->query($sql1);

  if ($memory3 && $memory3->num_rows > 0) {
    $info1 = $memory3->fetch_array();
    $decPassword = base64_decode($info1['password']);
    $_SESSION['domicilio'] = $info1['domicilio'];
    $_SESSION['fechaNac'] = $info1['fechaNac'];
    $_SESSION['user'] = $info1['nif'];
    $_SESSION['nombre'] = $info1['nombre'];
    $_SESSION['apellidos'] = $info1['apellidos'];
    $_SESSION['votante'] = $info1['votante'];
    $_SESSION['rol'] = $info1['rol'];
    $_SESSION['password'] = $info1['password'];

    //Check if the password matches the one you have set
    if ($decPassword != $password) {
      $_SESSION['err'] = 'Contraseña incorrecta.';
      unset($_SESSION['user']);
      $counter2 = 0;
      header("Location:index.php");
    }
  }
}

//Redirection
if ($counter2 == 1) {
  if ($_SESSION['modo'] == 'borrar')
    header("Location:vistaBorrarVotantes.php");
  elseif ($_SESSION['modo'] == 'modificar')
    header("Location:controladorModificarVotantes.php");
  elseif ($_SESSION['modo'] == 'login')
    header("Location:menuEntrada.php");
  elseif ($_SESSION['modo'] == 'votar')
    header("Location:controladorVotar.php");
}
?>
<?php
$contador = 1;
$contador2 = 1;
session_start();

if (isset($_REQUEST["dni"]))
  $dni = $_REQUEST["dni"];

if (isset($_REQUEST["contraseña"])) {
  $password = $_REQUEST["contraseña"];
  include 'conexionBD.php';

  //Comprobar DNI
  $sql2 = "SELECT count(*) FROM votante";
  $memi2 = $conexion->query($sql2);

  if ($memi2->num_rows > 0) {
    $info2 = $memi2->fetch_array();
    $num = $info2[0];
    $num = (int) $num;
  }

  $cont = 0;
  $listaVot = array();

  for ($cont2 = 0; $cont < $num; $cont2++) {
    $sql3 = "SELECT nif FROM votante WHERE ID='" . $cont2 . "'";
    $memi3 = $conexion->query($sql3);

    if ($memi3 && $memi3->num_rows > 0) {
      $info3 = $memi3->fetch_array();
      $listaVot[$cont] = $info3['nif'];
      $cont++;
    }
  }

  foreach ($listaVot as $nif) {
    if ($nif == $dni)
      $contador = 0;
  }

  if ($contador == 1) {
    $_SESSION['errDni'] = 'Este dni no esta registrado.';
    unset($_SESSION['user']);
    $contador2 = 0;
    header("Location:index.php");
  }

  //Comprobar contraseña y votado. Evitar SQL Inyection ---2 metodo
  $sql1 = "SELECT * FROM votante WHERE nif='" . $dni . "'  ";
  $memi1 = $conexion->query($sql1);

  if ($memi1 && $memi1->num_rows > 0) {
    $info1 = $memi1->fetch_array();
    $contraseñaDec = base64_decode($info1['password']);
    $_SESSION['domicilio'] = $info1['domicilio'];
    $_SESSION['fechaNac'] = $info1['fechaNac'];
    $_SESSION['user'] = $info1['nif'];
    $_SESSION['nombre'] = $info1['nombre'];
    $_SESSION['apellidos'] = $info1['apellidos'];
    $_SESSION['votante'] = $info1['votante'];
    $_SESSION['rol'] = $info1['rol'];
    $_SESSION['password'] = $info1['password'];

    //Comprueba si la contraseña coincide con la puesta
    if ($contraseñaDec != $password) {
      $_SESSION['err'] = 'Contraseña incorrecta.';
      unset($_SESSION['user']);
      $contador2 = 0;
      header("Location:index.php");
    }
  }
}

//Redirección
if ($contador2 == 1) {
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
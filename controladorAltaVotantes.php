<?php
session_start();
include 'conexionBD.php';

$sql = "SELECT * FROM convocatoria WHERE escrutinio='Abierto'";
$memory = $conexion->query($sql);

if ($memory && $memory->num_rows > 0) {
  $_SESSION['mensajeBD'] = "No puedes darte de alta mientras este el escrutinio abierto";
  header("Location:MensajeErrores.php");
  exit;
}

$sql = "SELECT * FROM votante WHERE votante='Si' AND nif='" . $_SESSION['user'] . "'";
$memory = $conexion->query($sql);

if ($memory && $memory->num_rows > 0) {
  $_SESSION['mensajeBD'] = "No puedes modificar tu usuario si ya has votado ";
  header("Location:MensajeErrores.php");
  exit;
}

if (isset($_REQUEST["dni"]))
  $dni = $_REQUEST["dni"];

if (isset($_REQUEST['nombre'])) {
  $name = $_REQUEST["nombre"];
  $name = ucwords($name);
}

if (isset($_REQUEST['apellidos'])) {
  $lastname = $_REQUEST["apellidos"];
  $lastname = ucwords($lastname);
}

if (isset($_REQUEST['fechaN']))
  $dateN = $_REQUEST["fechaN"];

if (isset($_REQUEST['domicilio'])) {
  $address = $_REQUEST["domicilio"];
  $address = ucwords($address);
}
if (isset($_REQUEST['contraseña'])) {
  $password = $_REQUEST["contraseña"];
  $encPassword = base64_encode($password);

  if (isset($_REQUEST['contraseña2'])) {
    $password2 = $_REQUEST["contraseña2"];

    if ($password2 != $password) {
      $_SESSION['dosPassw'] = 'No coincide la contraseña.';
      header("Location:vistaAltaVotante.php");
      exit;
    }
  }
}

$sql2 = "INSERT INTO votante(nif,domicilio,apellidos,fechaNac,password,rol,votante,nombre)   VALUES('" . $dni . "','" . $address . "','" . $lastname . "','" . $dateN . "','" . $encPassword . "','Votante','No','" . $name . "')";
$check = $conexion->query($sql2);

if ($conexion->affected_rows > 0) {
  $_SESSION['mensajeBD'] = "Se ha añadido a " . $name . " " . $lastname . "  a la base de datos.";
  header("Location:MensajeErrores.php");
} else {
  $_SESSION['mensajeBD'] = "Este votante ya se ha dado de alta.";
  header("Location:MensajeErrores.php");
}
?>

<br><br>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />
<a href="menuEntrada.php" class="btn btn-success">Atras</a>
</div>
<br>
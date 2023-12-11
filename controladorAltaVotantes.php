<?php
session_start();
include 'conexionBD.php';

$sql5 = "SELECT * FROM convocatoria WHERE escrutinio='Abierto'";
$memi5 = $conexion->query($sql5);

if ($memi5 && $memi5->num_rows > 0) {
  $_SESSION['mensajeBD'] = "No puedes darte de alta mientras este el escrutinio abierto";
  header("Location:MensajeErrores.php");
  exit;
}

$sql5 = "SELECT * FROM votante WHERE votante='Si' AND nif='" . $_SESSION['user'] . "'";
$memi5 = $conexion->query($sql5);

if ($memi5 && $memi5->num_rows > 0) {
  $_SESSION['mensajeBD'] = "No puedes modificar tu usuario si ya has votado ";
  header("Location:MensajeErrores.php");
  exit;
}

if (isset($_REQUEST["dni"]))
  $dni = $_REQUEST["dni"];

if (isset($_REQUEST['nombre'])) {
  $nombre = $_REQUEST["nombre"];
  $nombre = ucwords($nombre);
}

if (isset($_REQUEST['apellidos'])) {
  $apellidos = $_REQUEST["apellidos"];
  $apellidos = ucwords($apellidos);
}

if (isset($_REQUEST['fechaN']))
  $fechaN = $_REQUEST["fechaN"];

if (isset($_REQUEST['domicilio'])) {
  $domicilio = $_REQUEST["domicilio"];
  $domicilio = ucwords($domicilio);
}
if (isset($_REQUEST['contraseña'])) {
  $contraseña = $_REQUEST["contraseña"];
  $contraseñaEnc = base64_encode($contraseña);

  if (isset($_REQUEST['contraseña2'])) {
    $contraseña2 = $_REQUEST["contraseña2"];

    if ($contraseña2 != $contraseña) {
      $_SESSION['dosPassw'] = 'No coincide la contraseña.';
      header("Location:vistaAltaVotante.php");
      exit;
    }
  }
}

$sq1 = "INSERT INTO votante(nif,domicilio,apellidos,fechaNac,password,rol,votante,nombre)   VALUES('" . $dni . "','" . $domicilio . "','" . $apellidos . "','" . $fechaN . "','" . $contraseñaEnc . "','Votante','No','" . $nombre . "')";
$comprobar = $conexion->query($sq1);

if ($conexion->affected_rows > 0) {
  $_SESSION['mensajeBD'] = "Se ha añadido a " . $nombre . " " . $apellidos . "  a la base de datos.";
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
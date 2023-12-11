<?php
session_start();
include 'conexionBD.php';

if (isset($_SESSION['user']))
  $dni = $_SESSION['user'];

if (isset($_REQUEST["dni"]))
  $dni = $_REQUEST["dni"];

$sql5 = "SELECT apellidos,nombre FROM votante WHERE nif='" . $dni . "'";
$memi5 = $conexion->query($sql5);

if ($memi5 && $memi5->num_rows > 0) {
  $info5 = $memi5->fetch_array();
  $sql5 = "SELECT * FROM convocatoria WHERE escrutinio='Abierto'";
  $memi5 = $conexion->query($sql5);

  if ($memi5 && $memi5->num_rows > 0) {
    $_SESSION['mensajeBD'] = "No puedes borrar tu usuario mientras este el escrutinio abierto";
    header("Location:MensajeErrores.php");
    exit;
  }
}

// Prevenir SQL Inyection
$sql1 = "DELETE FROM votante WHERE nif=? AND votante='No'";
$comprobar = $conexion->prepare($sql1);
$comprobar->bind_param("s", $Vdni);
$Vdni = $dni;
$comprobar->execute();

if ($conexion->affected_rows > 0) {
  $_SESSION['mensajeBD'] = "Se ha borrado a " . $info5['nombre'] . " " . $info5['apellidos'] . "  de la base de datos.";

  if ($_SESSION['user'] == $dni) {
    unset($_SESSION['user']);
    unset($_SESSION['rol']);
  }

  header("Location:MensajeErrores.php");
} else {
  $_SESSION['mensajeBD'] = "Este votante no existe o ya has votado.";
  header("Location:MensajeErrores.php");
  exit;
}

?>
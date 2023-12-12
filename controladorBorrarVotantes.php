<?php
session_start();
include 'conexionBD.php';

if (isset($_SESSION['user']))
  $dni = $_SESSION['user'];

if (isset($_REQUEST["dni"]))
  $dni = $_REQUEST["dni"];

$sql = "SELECT apellidos,nombre FROM votante WHERE nif='" . $dni . "'";
$memory = $conexion->query($sql);

if ($memory && $memory->num_rows > 0) {
  $info = $memory->fetch_array();
  $sql = "SELECT * FROM convocatoria WHERE escrutinio='Abierto'";
  $memory = $conexion->query($sql);

  if ($memory && $memory->num_rows > 0) {
    $_SESSION['mensajeBD'] = "No puedes borrar tu usuario mientras este el escrutinio abierto";
    header("Location:MensajeErrores.php");
    exit;
  }
}

// Prevent SQL Injection
$sql1 = "DELETE FROM votante WHERE nif=? AND votante='No'";
$check = $conexion->prepare($sql1);
$check->bind_param("s", $Vdni);
$Vdni = $dni;
$check->execute();

if ($conexion->affected_rows > 0) {
  $_SESSION['mensajeBD'] = "Se ha borrado a " . $info['nombre'] . " " . $info['apellidos'] . "  de la base de datos.";

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
<?php
session_start();
include 'conexionBD.php';

if (isset($_REQUEST["cancelar"])) {
	unset($_SESSION['CHECK']);
	header("Location:vistaModificarVotantes.php ");
	exit;
}

//Voting and canvassing checks
$sql = "SELECT * FROM convocatoria WHERE escrutinio='Abierto'";
$memory = $conexion->query($sql);

if ($memory && $memory->num_rows > 0) {
	$_SESSION['mensajeBD'] = "No puedes modificar tu usuario mientras este el escrutinio abierto ";
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

//Voting and canvassing checks
$counter = 1;
$cont = 1;

//Summit check
if (isset($_REQUEST['probar']))
	$counter = 0;

//Collect data for the form
if ($counter == 1) {
	$sql1 = "SELECT * FROM votante WHERE nif='" . $_SESSION['user'] . "'";
	$memory1 = $conexion->query($sql1);

	if ($memory1 && $memory1->num_rows > 0) {
		$info = $memory1->fetch_array();
		$_SESSION['datosVotante'] = $info;
		$_SESSION['CHECK'] = 1;
		$nif = $_SESSION['datosVotante']['nif'];
		header("Location:vistaModificarVotantes.php");
		exit;
	}
}

//Data request
if (isset($_REQUEST["contraseñaA"]) && ($_REQUEST['contraseñaA'] != '')) {
	$passwordA = $_REQUEST["contraseñaA"];

	if (isset($_REQUEST['contraseñaN']) && ($_REQUEST['contraseñaN'] != '')) {
		$passwordN = $_REQUEST["contraseñaN"];

		if (isset($_REQUEST['contraseñaN2']) && ($_REQUEST['contraseñaN2'] != '')) {
			$passwordN2 = $_REQUEST["contraseñaN2"];
			$decPassword = base64_decode($_SESSION['password']);

			if ($passwordA != $decPassword) {
				$cont = 0;
				$_SESSION['errCont'] = 'No coincide la contraseña actual';
				header("Location:vistaModificarVotantes.php");
				exit;
			}
			if ($cont = 1) {
				$encPasswordN2 = base64_encode($passwordN2);
				$dni = $_SESSION['user'];
				$sql2 = "UPDATE votante SET password='" . $encPasswordN2 . "' WHERE nif='" . $_SESSION['user'] . "'";
				$check = $conexion->query($sql2);

				if ($conexion->affected_rows > 0) {
					$_SESSION['comprobacionContraseña'] = "La contraseña ha sido modificada correctamente.";
					$cont = 0;
				}
			}
		}
	}

}

if (isset($_REQUEST['nombre2']) && ($_REQUEST['nombre2'] != '')) {
	$name = $_REQUEST["nombre2"];
	$name = ucwords($name);
	$sq = "UPDATE votante SET nombre='" . $name . "' WHERE nif='" . $_SESSION['user'] . "'";
	$check = $conexion->query($sq);

	if ($conexion->affected_rows > 0) {
		$_SESSION['datosVotante']['nombre'] = $name;
		$cont = 0;
	}
}

if (isset($_REQUEST['apellidos2']) && ($_REQUEST['apellidos2'] != '')) {
	$lastname = $_REQUEST["apellidos2"];
	$lastname = ucwords($lastname);
	$sq = "UPDATE votante SET apellidos='" . $lastname . "' WHERE nif='" . $_SESSION['user'] . "'";
	$check = $conexion->query($sq);

	if ($conexion->affected_rows > 0) {
		$_SESSION['datosVotante']['apellidos'] = $lastname;
		$cont = 0;
	}
}

if (isset($_REQUEST['fechaN2']) && ($_REQUEST['fechaN2'] != '')) {
	$dateN = $_REQUEST["fechaN2"];
	$sq = "UPDATE votante SET fechaNac='" . $dateN . "' WHERE nif='" . $_SESSION['user'] . "'";
	$check = $conexion->query($sq);

	if ($conexion->affected_rows > 0)
		$cont = 0;
}


if (isset($_REQUEST['domicilio2']) && ($_REQUEST['domicilio2'] != '')) {
	$address = $_REQUEST["domicilio2"];
	$address = ucwords($address);
	$sq = "UPDATE votante SET domicilio='" . $address . "' WHERE nif='" . $_SESSION['user'] . "'";
	$check = $conexion->query($sq);

	if ($conexion->affected_rows > 0)
		$cont = 0;
}

if (isset($_REQUEST['rol2']) && ($_REQUEST['rol2'] != '')) {
	$role = $_REQUEST["rol2"];
	$sq = "UPDATE votante SET rol='" . $role . "' WHERE nif='" . $_SESSION['user'] . "'";
	$check = $conexion->query($sq);

	if ($conexion->affected_rows > 0)
		$cont = 0;

}

if (isset($_REQUEST['votado2']) && ($_REQUEST['votado2'] != '')) {
	$voted = $_REQUEST["votado2"];
	$sq = "UPDATE votante SET votante='" . $voted . "' WHERE nif='" . $_SESSION['user'] . "'";
	$check = $conexion->query($sq);

	if ($conexion->affected_rows > 0)
		$cont = 0;
}

//If a piece of data has not been modified, or if
if ($cont == 0) {
	unset($_SESSION['CHECK']);
	$sql1 = "SELECT * FROM votante WHERE nif='" . $_SESSION['user'] . "'";
	$memory1 = $conexion->query($sql1);

	if ($memory1 && $memory1->num_rows > 0)
		$info = $memory1->fetch_array();

	$_SESSION['visionVot'] = $info;
	$_SESSION['VAL'] = 1;
	header("Location:vistaModificarVotantes.php");
	exit;
} elseif ($cont == 1) {
	unset($_SESSION['CHECK']);
	$_SESSION['mensajeBD'] = "No se ha modificado ningun dato, cerrando...";
	header("Location:MensajeErrores.php");
	exit;
} ?>
<?php
session_start();
include 'conexionBD.php';

$cont = 1;
if (isset($_REQUEST['validacion']))
	$cont = 0;

if ($cont == 1) {

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

	$sql = "SELECT count(*) FROM convocatoria";
	$memory = $conexion->query($sql);

	if ($memory->num_rows > 0) {
		$info = $memory->fetch_array();
		$num = $info[0];
		$num = (int) $num;
	}

	$cont = 0;
	$conList = array();

	for ($cont2 = 0; $cont < $num; $cont2++) {
		$sql1 = "SELECT id,fecha FROM convocatoria WHERE id=" . $cont2 . "";
		$memory1 = $conexion->query($sql1);

		if ($memory1 && $memory1->num_rows > 0) {
			$info1 = $memory1->fetch_array();
			$sql1 = "SELECT * FROM resultado WHERE convocatoria=" . $info1['id'] . "";
			$memory1 = $conexion->query($sql1);

			if ($memory1 && $memory1->num_rows <= 0) {
				$conList[$cont]['id'] = $info1['id'];
				$conList[$cont]['fecha'] = $info1['fecha'];
			}
			$cont++;
		}
	}

	$conList = array_sort($conList, 'fecha', SORT_ASC);
	$listC = array_slice($conList, 0, 1);

	foreach ($listC as $value) {
		foreach ($value as $key => $value) {
			if ($key == 'id')
				$solucion = $value;
		}
	}

	$sql2 = "SELECT * FROM convocatoria where id='" . $solucion . "' ";
	$memory2 = $conexion->query($sql2);

	if ($memory2 && $memory2->num_rows > 0)
		$info3 = $memory2->fetch_array();

	$_SESSION['convocat']['denominacion'] = $info3['denominacion'];
	$_SESSION['convocat']['id'] = $info3['id'];

	$sql2 = "SELECT * FROM convocatoria where escrutinio='Abierto' ";
	$memory2 = $conexion->query($sql2);

	if ($memory2 && $memory2->num_rows > 0) {
		$_SESSION['mensajeBD'] = "Ya esta abierta la convocatoria.";
		$_SESSION['set'] = 1;
	}

	header("Location:vistaOnEscrutinio.php");
	exit;
}

$sql2 = "SELECT * FROM convocatoria where escrutinio='Abierto' ";
$memory2 = $conexion->query($sql2);

if ($memory2 && $memory2->num_rows > 0) {
	$_SESSION['mensajeBD'] = "No puedes abrir si ya esta abierto";
	header("Location:MensajeErrores.php");
	exit;
} else {
	unset($_SESSION['mas']);
	$sql3 = "UPDATE votante SET votante='No'";
	$check = $conexion->query($sql3);
	$_SESSION['votante'] = 'No';

	$sql3 = "UPDATE convocatoria SET escrutinio='Abierto' WHERE id='" . $_SESSION['convocat']['id'] . "'";
	$check = $conexion->query($sql3);
	if ($conexion->affected_rows > 0) {
		$_SESSION['mensajeBD'] = "¡Escrutinio Abierto!";
		header("Location:MensajeErrores.php");
		exit;
	}
} ?>
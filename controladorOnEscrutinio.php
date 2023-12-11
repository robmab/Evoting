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

	$sql2 = "SELECT count(*) FROM convocatoria";
	$memi2 = $conexion->query($sql2);

	if ($memi2->num_rows > 0) {
		$info2 = $memi2->fetch_array();
		$num = $info2[0];
		$num = (int) $num;
	}

	$cont = 0;
	$listaCon = array();

	for ($cont2 = 0; $cont < $num; $cont2++) {
		$sql1 = "SELECT id,fecha FROM convocatoria WHERE id=" . $cont2 . "";
		$memi1 = $conexion->query($sql1);

		if ($memi1 && $memi1->num_rows > 0) {
			$info1 = $memi1->fetch_array();
			$sql1 = "SELECT * FROM resultado WHERE convocatoria=" . $info1['id'] . "";
			$memi1 = $conexion->query($sql1);

			if ($memi1 && $memi1->num_rows <= 0) {
				$listaCon[$cont]['id'] = $info1['id'];
				$listaCon[$cont]['fecha'] = $info1['fecha'];
			}
			$cont++;
		}
	}

	$listaCon = array_sort($listaCon, 'fecha', SORT_ASC);
	$listaC = array_slice($listaCon, 0, 1);

	foreach ($listaC as $value) {
		foreach ($value as $key => $value) {
			if ($key == 'id')
				$solucion = $value;
		}
	}

	$sql50 = "SELECT * FROM convocatoria where id='" . $solucion . "' ";
	$memi50 = $conexion->query($sql50);

	if ($memi50 && $memi50->num_rows > 0)
		$info3 = $memi50->fetch_array();

	$_SESSION['convocat']['denominacion'] = $info3['denominacion'];
	$_SESSION['convocat']['id'] = $info3['id'];

	$sql50 = "SELECT * FROM convocatoria where escrutinio='Abierto' ";
	$memi50 = $conexion->query($sql50);

	if ($memi50 && $memi50->num_rows > 0) {
		$_SESSION['mensajeBD'] = "Ya esta abierta la convocatoria.";
		$_SESSION['set'] = 1;
	}

	header("Location:vistaOnEscrutinio.php");
	exit;
}

$sql50 = "SELECT * FROM convocatoria where escrutinio='Abierto' ";
$memi50 = $conexion->query($sql50);

if ($memi50 && $memi50->num_rows > 0) {
	$_SESSION['mensajeBD'] = "No puedes abrir si ya esta abierto";
	header("Location:MensajeErrores.php");
	exit;
} else {
	unset($_SESSION['mas']);
	$sq1 = "UPDATE votante SET votante='No'";
	$comprobar = $conexion->query($sq1);
	$_SESSION['votante'] = 'No';

	$sq1 = "UPDATE convocatoria SET escrutinio='Abierto' WHERE id='" . $_SESSION['convocat']['id'] . "'";
	$comprobar = $conexion->query($sq1);
	if ($conexion->affected_rows > 0) {
		$_SESSION['mensajeBD'] = "¡Escrutinio Abierto!";
		header("Location:MensajeErrores.php");
		exit;
	}
} ?>
<?php

session_start();
include 'conexionBD.php';

if (isset($_REQUEST['resultado'])) {
	$denominacion = $_REQUEST['resultado'];
	$sql1 = "SELECT id FROM convocatoria WHERE denominacion='" . $denominacion . "'";
	$memi1 = $conexion->query($sql1);

	if ($memi1 && $memi1->num_rows > 0) {
		$info1 = $memi1->fetch_array();
		$id = $info1['id'];
	}

	$sql2 = "SELECT count(*) FROM partido";
	$memi2 = $conexion->query($sql2);

	if ($memi2->num_rows > 0) {
		$info2 = $memi2->fetch_array();
		$num = $info2[0];
		$num = (int) $num;
	}

	$cont = 0;
	$listaVot = array();

	for ($cont2 = 0; $cont < $num; $cont2++) {
		$sql1 = "SELECT id,nombre,logo FROM partido WHERE id=" . $cont2 . "";
		$memi1 = $conexion->query($sql1);

		if ($memi1 && $memi1->num_rows > 0) {
			$info1 = $memi1->fetch_array();
			$listaVot[$info1['id']][$info1['logo']] = $info1['nombre'];

			$cont++;
		}
	}

	$listaPartidos = array();

	foreach ($listaVot as $key => $value1) {
		foreach ($value1 as $logo => $value) {
			$sql1 = "SELECT totalVotos FROM resultado WHERE convocatoria=" . $id . " AND partido=" . $key . " ";
			$memi1 = $conexion->query($sql1);

			if ($memi1 && $memi1->num_rows > 0) {
				$info1 = $memi1->fetch_array();
				$totalVotos = $info1['totalVotos'];
				$listaPartidos[$logo][0] = $value;
				$listaPartidos[$logo][1] = $totalVotos;
			}
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

	$listaPartidos = array_sort($listaPartidos, 1, SORT_DESC);

	$_SESSION['listaPartidos'] = $listaPartidos;
	$_SESSION['denomin'] = $denominacion;

	header("Location:vistaResultados.php");
	exit;

} else {
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
		$sql1 = "SELECT * FROM convocatoria WHERE id=" . $cont2 . "";
		$memi1 = $conexion->query($sql1);

		if ($memi1 && $memi1->num_rows > 0) {
			$info1 = $memi1->fetch_array();
			$sql1 = "SELECT * FROM resultado WHERE convocatoria=" . $info1['id'] . "";
			$memi1 = $conexion->query($sql1);
			if ($memi1 && $memi1->num_rows > 0) {
				$listaCon[$cont]['denominacion'] = $info1['denominacion'];
				$listaCon[$cont]['fecha'] = date("d-m-Y", strtotime($info1['fecha']));
				$listaCon[$cont]['circunscripcion'] = $info1['circunscripcion'];
			}
			$cont++;
		}
	}

	$_SESSION['resultados'] = $listaCon;
	header("Location:vistaResultados.php");
	exit;
} ?>
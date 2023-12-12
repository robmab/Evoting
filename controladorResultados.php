<?php

session_start();
include 'conexionBD.php';

if (isset($_REQUEST['resultado'])) {
	$denomination = $_REQUEST['resultado'];
	$sql = "SELECT id FROM convocatoria WHERE denominacion='" . $denomination . "'";
	$memory = $conexion->query($sql);

	if ($memory && $memory->num_rows > 0) {
		$info = $memory->fetch_array();
		$id = $info['id'];
	}

	$sql2 = "SELECT count(*) FROM partido";
	$memory2 = $conexion->query($sql2);

	if ($memory2->num_rows > 0) {
		$info2 = $memory2->fetch_array();
		$num = $info2[0];
		$num = (int) $num;
	}

	$cont = 0;
	$votList = array();

	for ($cont2 = 0; $cont < $num; $cont2++) {
		$sql = "SELECT id,nombre,logo FROM partido WHERE id=" . $cont2 . "";
		$memory = $conexion->query($sql);

		if ($memory && $memory->num_rows > 0) {
			$info = $memory->fetch_array();
			$votList[$info['id']][$info['logo']] = $info['nombre'];

			$cont++;
		}
	}

	$teamList = array();

	foreach ($votList as $key => $value1) {
		foreach ($value1 as $logo => $value) {
			$sql = "SELECT totalVotos FROM resultado WHERE convocatoria=" . $id . " AND partido=" . $key . " ";
			$memory = $conexion->query($sql);

			if ($memory && $memory->num_rows > 0) {
				$info = $memory->fetch_array();
				$totalVotos = $info['totalVotos'];
				$teamList[$logo][0] = $value;
				$teamList[$logo][1] = $totalVotos;
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

	$teamList = array_sort($teamList, 1, SORT_DESC);

	$_SESSION['listaPartidos'] = $teamList;
	$_SESSION['denomin'] = $denomination;

	header("Location:vistaResultados.php");
	exit;

} else {
	$sql2 = "SELECT count(*) FROM convocatoria";
	$memory2 = $conexion->query($sql2);

	if ($memory2->num_rows > 0) {
		$info2 = $memory2->fetch_array();
		$num = $info2[0];
		$num = (int) $num;
	}
	$cont = 0;
	$conList = array();

	for ($cont2 = 0; $cont < $num; $cont2++) {
		$sql = "SELECT * FROM convocatoria WHERE id=" . $cont2 . "";
		$memory = $conexion->query($sql);

		if ($memory && $memory->num_rows > 0) {
			$info = $memory->fetch_array();
			$sql = "SELECT * FROM resultado WHERE convocatoria=" . $info['id'] . "";
			$memory = $conexion->query($sql);
			if ($memory && $memory->num_rows > 0) {
				$conList[$cont]['denominacion'] = $info['denominacion'];
				$conList[$cont]['fecha'] = date("d-m-Y", strtotime($info['fecha']));
				$conList[$cont]['circunscripcion'] = $info['circunscripcion'];
			}
			$cont++;
		}
	}

	$_SESSION['resultados'] = $conList;
	header("Location:vistaResultados.php");
	exit;
} ?>
<?php
session_start();
include 'conexionBD.php';

$sql = "SELECT count(*) FROM partido";
$memory = $conexion->query($sql);

if ($memory->num_rows > 0) {
	$info = $memory->fetch_array();
	$num = $info[0];
	$num = (int) $num;
}

$cont = 0;
$parList = array();

for ($cont2 = 0; $cont < $num; $cont2++) {
	$sql1 = "SELECT * FROM partido WHERE ID='" . $cont2 . "'";
	$memory1 = $conexion->query($sql1);

	if ($memory1 && $memory1->num_rows > 0) {
		$info1 = $memory1->fetch_array();
		$parList[$cont]['nombre'] = $info1['nombre'];
		$parList[$cont]['siglas'] = $info1['siglas'];
		$parList[$cont]['direccionSede'] = $info1['direccionSede'];
		$parList[$cont]['logo'] = $info1['logo'];
		$parList[$cont]['votosTotales'] = $info1['votosTotales'];

		$cont++;
	}

}

//Sorted by name
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

$parList = array_sort($parList, 'nombre', SORT_ASC);

// Name Semi-automatic call
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

$sql2 = "SELECT denominacion,circunscripcion,fecha FROM convocatoria where id='" . $solucion . "' ";
$memory2 = $conexion->query($sql2);

if ($memory2 && $memory2->num_rows > 0) {
	$info3 = $memory2->fetch_array();
	$info3['fecha'] = date("d-m-Y", strtotime($info3['fecha']));
	$sql3 = "SELECT denominacion,circunscripcion,fecha FROM convocatoria where escrutinio='Abierto' ";
	$memory3 = $conexion->query($sql3);

	if ($memory3 && $memory3->num_rows > 0) {
		$info3 = $memory3->fetch_array();
		$_SESSION['comprobarEscrutinio'] = 1;
		$info3['fecha'] = date("d-m-Y", strtotime($info3['fecha']));
	}
}

$_SESSION['ARRAYPARTIDOS'] = $parList;
$_SESSION['Convocatoria'] = $info3;

header("Location:vistaPartidosVotantes.php") ?>
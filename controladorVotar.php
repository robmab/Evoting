<?php

session_start();
include 'conexionBD.php';

$counter = 1;

if (isset($_REQUEST["partido"])) {
	$team = $_REQUEST["partido"];
	unset($_SESSION['vota']);
	$_SESSION['votante'] = 'Si';
	$counter = 0;
}

if ($counter == 1) {
	$sql = "SELECT * FROM votante where nif='" . $_SESSION['user'] . "' ";
	$memory = $conexion->query($sql);

	if ($memory && $memory->num_rows > 0) {
		$info = $memory->fetch_array();

		//Check if you have voted or not
		if ($info['votante'] == 'No') {
			$_SESSION['votante'] = 'No';
			$_SESSION['vota'] = 1;
		} else {
			$_SESSION['votante'] = 'Si';
			unset($_SESSION['vota']);
		}
	}

	//Name of call for proposals
	$sql = "SELECT denominacion,circunscripcion,fecha FROM convocatoria where escrutinio='Abierto' ";
	$memory = $conexion->query($sql);

	if ($memory && $memory->num_rows > 0)
		$info = $memory->fetch_array();

	$sql1 = "SELECT escrutinio FROM convocatoria WHERE escrutinio='Abierto'";
	$memory1 = $conexion->query($sql1);

	if ($memory1 && $memory1->num_rows <= 0) {
		$_SESSION['Convocatoria'] = $info;
		$_SESSION['escrutinioAbierto'] = 1;
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

	//After all the opreations, here it is resolved
	$sql3 = "SELECT denominacion,circunscripcion,fecha FROM convocatoria where id='" . $solucion . "' ";
	$memory3 = $conexion->query($sql3);

	if ($memory3 && $memory3->num_rows > 0) {
		$info = $memory3->fetch_array();
		$sql = "SELECT denominacion,circunscripcion,fecha FROM convocatoria where escrutinio='Abierto' ";
		$memory = $conexion->query($sql);

		if ($memory && $memory->num_rows > 0) {
			$info = $memory->fetch_array();
			$info['fecha'] = date("d-m-Y", strtotime($info['fecha']));
		}
	}

	//Now it scrolls through the matches to show them in the table
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
		$sql1 = "SELECT * FROM partido WHERE ID='" . $cont2 . "'";
		$memory1 = $conexion->query($sql1);

		if ($memory1 && $memory1->num_rows > 0) {
			$info1 = $memory1->fetch_array();
			$votList[$info1['siglas']] = $info1['logo'];

			$cont++;
		}
	}

	session_start();
	$_SESSION['ARRAYVOTANTES'] = $votList;
	$_SESSION['Convocatoria'] = $info;
	$_SESSION['listapart'] = $votList;

	header("Location:vistaVotar.php");
	exit;
}
unset($_SESSION['escrutinioAbierto']);

if ($team == 'blanco') {
	$sql4 = "UPDATE votante SET votante='Si' WHERE nif='" . $_SESSION['user'] . "' ";
	$check = $conexion->query($sql4);
	$_SESSION['mensajeBD'] = "Voto en blanco, gracias.";
	$_SESSION['votante'] = 'Si';
	header("Location:MensajeErrores.php");
	exit;
} else {
	$sql1 = "SELECT votosTotales FROM partido WHERE siglas='" . $team . "'";
	$memory1 = $conexion->query($sql1);

	if ($memory1 && $memory1->num_rows > 0)
		$info1 = $memory1->fetch_array();

	$votes = $info1['votosTotales'] + 1;
	$conexion->autocommit(FALSE);

	$sql5 = "UPDATE partido SET votosTotales='" . $votes . "' WHERE siglas='" . $team . "' ";
	$check = $conexion->query($sql5);

	if ($conexion->affected_rows > 0) {
		$sql4 = "UPDATE votante SET votante='Si' WHERE nif='" . $_SESSION['user'] . "' ";
		$check = $conexion->query($sql4);

		if ($conexion->affected_rows > 0) {
			$conexion->commit();
			$conexion->autocommit(TRUE);
			$_SESSION['votante'] = 'Si';
			$_SESSION['mensajeBD'] = "Se ha votado a " . $team . " (total Votos: " . $votes . ")";
			header("Location:MensajeErrores.php");
			exit;

		} else {
			$conexion->rollback();
			$_SESSION['mensajeBD'] = "Corrupion de datos.";
			header("Location:MensajeErrores.php");
		}
	} else {
		$conexion->rollback();
		$_SESSION['mensajeBD'] = "Error Inesperado.";
		header("Location:MensajeErrores.php");
		exit;
	}
} ?>

<br><br>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />
<a href="menuEntrada.php" class="btn btn-success">Atras</a></div><br>
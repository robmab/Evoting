<?php

session_start();
include 'conexionBD.php';

$contadi = 1;

if (isset($_REQUEST["partido"])) {
	$partido = $_REQUEST["partido"];
	unset($_SESSION['vota']);
	$_SESSION['votante'] = 'Si';
	$contadi = 0;
}

if ($contadi == 1) {
	$sql3 = "SELECT * FROM votante where nif='" . $_SESSION['user'] . "' ";
	$memi3 = $conexion->query($sql3);

	if ($memi3 && $memi3->num_rows > 0) {
		$info3 = $memi3->fetch_array();

		//_____Comprobar si a votado o no.
		if ($info3['votante'] == 'No') {
			$_SESSION['votante'] = 'No';
			$_SESSION['vota'] = 1;
		} else {
			$_SESSION['votante'] = 'Si';
			unset($_SESSION['vota']);
		}
	}

	//Nombre convocatoria
	$sql3 = "SELECT denominacion,circunscripcion,fecha FROM convocatoria where escrutinio='Abierto' ";
	$memi3 = $conexion->query($sql3);

	if ($memi3 && $memi3->num_rows > 0)
		$info3 = $memi3->fetch_array();

	$sql1 = "SELECT escrutinio FROM convocatoria WHERE escrutinio='Abierto'";
	$memi1 = $conexion->query($sql1);

	if ($memi1 && $memi1->num_rows <= 0) {
		$_SESSION['Convocatoria'] = $info3;
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

	//Tras todas las opreaciones, aqui se resuelve
	$sql50 = "SELECT denominacion,circunscripcion,fecha FROM convocatoria where id='" . $solucion . "' ";
	$memi50 = $conexion->query($sql50);

	if ($memi50 && $memi50->num_rows > 0) {
		$info3 = $memi50->fetch_array();
		$sql3 = "SELECT denominacion,circunscripcion,fecha FROM convocatoria where escrutinio='Abierto' ";
		$memi3 = $conexion->query($sql3);

		if ($memi3 && $memi3->num_rows > 0) {
			$info3 = $memi3->fetch_array();
			$info3['fecha'] = date("d-m-Y", strtotime($info3['fecha']));
		}
	}

	//_Ahora se recorre los partidos que hay para mostrarlos en tabla.
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
		$sql1 = "SELECT * FROM partido WHERE ID='" . $cont2 . "'";
		$memi1 = $conexion->query($sql1);

		if ($memi1 && $memi1->num_rows > 0) {
			$info1 = $memi1->fetch_array();
			$listaVot[$info1['siglas']] = $info1['logo'];

			$cont++;
		}
	}

	session_start();
	$_SESSION['ARRAYVOTANTES'] = $listaVot;
	$_SESSION['Convocatoria'] = $info3;
	$_SESSION['listapart'] = $listaVot;

	header("Location:vistaVotar.php");
	exit;
}
unset($_SESSION['escrutinioAbierto']);

if ($partido == 'blanco') {
	$sq1c = "UPDATE votante SET votante='Si' WHERE nif='" . $_SESSION['user'] . "' ";
	$comprobar = $conexion->query($sq1c);
	$_SESSION['mensajeBD'] = "Voto en blanco, gracias.";
	$_SESSION['votante'] = 'Si';
	header("Location:MensajeErrores.php");
	exit;
} else {
	$sql1 = "SELECT votosTotales FROM partido WHERE siglas='" . $partido . "'";
	$memi1 = $conexion->query($sql1);

	if ($memi1 && $memi1->num_rows > 0)
		$info1 = $memi1->fetch_array();

	$votos = $info1['votosTotales'] + 1;
	$conexion->autocommit(FALSE);

	$sq1 = "UPDATE partido SET votosTotales='" . $votos . "' WHERE siglas='" . $partido . "' ";
	$comprobar = $conexion->query($sq1);

	if ($conexion->affected_rows > 0) {
		$sq1c = "UPDATE votante SET votante='Si' WHERE nif='" . $_SESSION['user'] . "' ";
		$comprobar = $conexion->query($sq1c);

		if ($conexion->affected_rows > 0) {
			$conexion->commit();
			$conexion->autocommit(TRUE);
			$_SESSION['votante'] = 'Si';
			$_SESSION['mensajeBD'] = "Se ha votado a " . $partido . " (total Votos: " . $votos . ")";
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
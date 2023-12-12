<!DOCTYPE html>
<html lang="en">

<head>
	<?php session_start(); ?>
	<title>Lista Votantes</title>
	<?php include 'Extras/css.php'; ?>
</head>

<?php include 'Extras/menu.php' ?>
<div class="container-contact100">

	<?php include 'conexionBD.php';
	$parView = $_SESSION['ARRAYPARTIDOS'];
	$counterT = 0;

	foreach ($parView as $num => $vot) {
		if ($counterT == 0) { ?>
			<div class="table100 ver1 m-b-110">
				<br>
				<h1> Listado Partidos +
					<br><br>
					<div class="wrap-input100 validate-input">
						<table data-vertable="ver1">
							<thead>
								<tr class="row100 head">
									<th class="column100 column1" data-column="column1">Nombre</th>
									<th class="column100 column2" data-column="column2">Siglas</th>
									<th class="column100 column4" data-column="column4">Logo</th>
									<th class="column100 column5" data-column="column5">Votos totales</th>
								</tr>
							</thead>
							<tbody>
							<?php } ?>

							<tr class="row100">
								<td class="column100 column1" data-column="column1">
									<?php echo $parView[$num]['nombre'] ?>
								</td>
								<td class="column100 column2" data-column="column2">
									<?php echo $parView[$num]['siglas'] ?>
								</td>
								<td class="column100 column4" data-column="column4"><img src="<?php
								echo $parView[$num]['logo'] ?> " alt="Logo Partido" style="width:100px;height:100px;">
								</td>

								<td class="column100 column5" data-column="column5">
									<?php echo $parView[$num]['votosTotales'] ?>
								</td>
								<?php
								$counterT = 1;
	} ?>
						</tr>
						<?php if (isset($_SESSION['comprobarEscrutinio']))
							unset($_SESSION['comprobarEscrutinio']); ?>
					</tbody>
				</table>
			</div>
	</div>
</div>

<div>
	<br>
	<div class="center-column">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />
		<a href="menuEntrada.php" class="btn btn-success">Atras</a>
	</div>
</div>

<?php include 'Extras/scripts.php' ?>

</html>
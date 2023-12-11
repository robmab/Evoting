<!DOCTYPE html>
<html lang="en">

<head>
	<title>Alta Votantes</title>
	<?php session_start();
	include 'Extras/css.php'; ?>
</head>

<body>
	<?php include 'Extras/menu.php' ?>

	<div class="container-contact100">
		<span class="contact100-form-title">
			¿Quieres borrar tu usuario?
		</span>

		<span class="contact100-form-title">
			<div class="center center-column">
				<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />
				<a href="controladorBorrarVotantes.php" class="btn btn-success">Si</a>
				<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />
				<a href="menuEntrada.php" class="btn btn-success">No</a>
			</div>
		</span>

	</div>
	<div>
		<br>
		<div class="center-column">
			<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />
			<a href="menuEntrada.php" class="btn btn-success">Atras</a>
		</div>
	</div>

	<div id="dropDownSelect1"></div>
	<?php include 'Extras/scripts.php' ?>
</body>

</html>
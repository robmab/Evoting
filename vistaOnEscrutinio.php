<!DOCTYPE html>
<html lang="en">

<head>
	<title>Alta Votantes</title>
	<?php session_start();
	include 'Extras/css.php' ?>
</head>

<body>
	<?php include 'Extras/menu.php';

	if (isset($_SESSION['set'])) {
		unset($_SESSION['set']); ?>

		<div class="container-contact100">
			<?php echo $_SESSION['mensajeBD']; ?>
			<div>
				<br><br> <br><br> <br><br>
				<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />
				<a href="menuEntrada.php" class="btn btn-success">Atras</a>
			</div>
		</div>

	<?php } elseif ($_SESSION['convocat']['denominacion'] == null) { ?>
		<div class="container-contact100">
			<?php echo "No se esperan mas convocatorias por el momento." ?>
		</div>
		<div>
			<div class="center-column">
				<br><br>
				<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />
				<a href="menuEntrada.php" class="btn btn-success">Atras</a>
			</div>
		</div>


	<?php } else { ?>
		<div class="container-contact100">
			<span class="contact100-form-title">
				Empezar votos de la convocatoria
				<?php echo $_SESSION['convocat']['denominacion'];
				unset($_SESSION['convocat']['denominacion']) ?>
			</span>
		</div>

		<form class="contact100-form validate-form">
			<div>
				<div class="center-column">
					<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />
					<a href="controladorOnEscrutinio.php?validacion=1" class="btn btn-success">Si</a>
					<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />
					<a href="menuEntrada.php" class="btn btn-success">No</a>
				</div>
			</div>
		</form>

		<div>
			<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />
			<a href="menuEntrada.php" class="btn btn-success">Atras</a>
		</div>

		<div id="dropDownSelect1"></div>
	<?php }
	include 'Extras/scripts.php' ?>

</body>

</html>
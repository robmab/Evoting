<html>

<head>
	<title>Proyecto e-Votantes </title>
	<?php session_start();
	header("Refresh:8; url=menuEntrada.php");
	include 'Extras/css.php'; ?>
</head>

<body>
	<?php include 'Extras/menu.php' ?>

	<div class="container-contact100">
		<p>
			<?php echo $_SESSION['mensajeBD']; ?>
		</p>
	</div>
	<div>
		<div class="center-column">
			<br>
			<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />
			<a href="menuEntrada.php" class="btn btn-success">Atras</a>
		</div>
	</div>

	<?php include 'Extras/scripts.php'; ?>
</body>

</html>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>

<head>
	<title>Proyecto e-Votantes </title>
	<?php session_start();
	include 'Extras/css.php'; ?>
</head>

<body>
	<?php include 'Extras/menu.php';

	//Comprobar sesion abierta / mostrarla
	if (isset($_SESSION['user'])) { ?>
		<div class="container-contact100">
			<div class="table100 ver1 m-b-110">
				<br>

				<div class="center-column">
					<?php if (isset($_SESSION['sesionIniciada'])) {
						echo " <p style='color:red;'> " . $_SESSION['sesionIniciada'] . "</p> ";
						unset($_SESSION['sesionIniciada']);
					} ?>

					<h1> Usuario Logeado </h1>
					<?php if ($_SESSION['rol'] == 'Administrador')
						echo '<h1> Administrador</h1>'; ?>
				</div>

				<br><br>

				<div class="wrap-input100 validate-input">
					<table data-vertable="ver1">
						<thead>
							<tr class="row100 head">
								<th class="column100 column1" data-column="column1">Nombre</th>
								<th class="column100 column2" data-column="column2">Apellidos</th>
								<th class="column100 column7" data-column="column7">DNI</th>
								<th class="column100 column7" data-column="column7">Fecha</th>
								<th class="column100 column7" data-column="column7">Domicilio</th>
								<th class="column100 column7" data-column="column7">Voto</th>
							</tr>
						</thead>
						<tbody>
							<tr class="row100">
								<td class="column100 column1" data-column="column1">
									<?php echo $_SESSION['nombre'] ?>
								</td>
								<td class="column100 column2" data-column="column2">
									<?php echo $_SESSION['apellidos'] ?>
								</td>
								<td class="column100 column3" data-column="column3">
									<?php echo $_SESSION['user'] ?>
								</td>
								<td class="column100 column3" data-column="column3">
									<?php echo $_SESSION['fechaNac'] ?>
								</td>
								<td class="column100 column3" data-column="column3">
									<?php echo $_SESSION['domicilio'] ?>
								</td>
								<td class="column100 column3" data-column="column3">
									<?php echo $_SESSION['votante'] ?>
								</td>
							</tr>
							<tr class="center-text">
								<td rowspan="1" colspan="3">
									<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />
									<a href="index.php?vari=1" class="btn btn-success">Cerrar Sesión</a>
								</td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
		</div>

		<div>
			<br><br><br><br>
		</div>

	<?php }
	include 'Extras/scripts.php'; ?>

</body>

</html>
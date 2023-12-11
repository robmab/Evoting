<!DOCTYPE html>
<html lang="en">

<head>
	<title>Alta Votantes</title>
	<?php session_start();
	include 'Extras/css.php' ?>
</head>

<body>
	<?php include 'Extras/menu.php';
	if (isset($_SESSION['listaPartidos'])) { ?>
		<div class="container-contact100">
			<?php include 'conexionBD.php'; 

			$vistaVot = $_SESSION['listaPartidos'];
			unset($_SESSION['listaPartidos']);
			$contadorT = 0;
			$cont = 1;

			foreach ($vistaVot as $logo => $value1) {
				foreach ($value1 as $indice => $value) {
					if ($contadorT == 0) { ?>

						<div class="table100 ver1 m-b-110">
							<br>

							<h1 class="center">
								Resultado
								<b>
									<?php echo $_SESSION['denomin'] ?>
								</b>
							</h1>

							<br><br>
							<div class="wrap-input100 validate-input">
								<table data-vertable="ver1">
									<thead>
										<tr class="row100 head">
											<th class="column100 column2" data-column="column2"></th>
											<th class="column100 column1" data-column="column1"></th>
											<th class="column100 column2" data-column="column2">Votos</th>
										</tr>
									</thead>
									<tbody>

									<?php }
					if ($indice == 0) { ?>
										<tr class="row100">
											<td class="column100 column1" data-column="column1">
												<?php if ($cont == 1) { ?>
													<div class="center-column">
														<img style="width:100px;height:100px;" src="images/1.png">
													</div>
												<?php }

												if ($cont > 1) { ?>
													<b class="center">
														<h1>
															<?php echo $cont ?>º
														</h1>
													</b>
												<?php }
												$cont++ ?>

											</td>

											<td class="column100 column1" data-column="column1">
												<img style="width:100px;height:100px;" src="<?php echo $logo ?>">
												<div>
													<br>
													<i>
														<?php echo $value ?>
													</i>
												</div>
											</td>

										<?php }
					if ($indice == 1) { ?>

											<td class="column100 column2" data-column="column2"><b>
													<?php echo $value ?>
												</b>
											</td>
										</tr>
									<?php }
					$contadorT = 1;
				}
			} ?>
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

	<?php } else { ?>

		<div class="container-contact100">
			<div class="wrap-contact100">
				<form class="contact100-form validate-form" action="controladorResultados.php" method="POST">
					<span class="contact100-form-title">
						Lista de convocatorias finalizadas
					</span>
					<div class="center center-column">
						<div class="styled-select slate" data-validate="Pon tu DNI">
							<select name="resultado">
								<?php $array = array();

								foreach ($_SESSION['resultados'] as $key => $value) {
									foreach ($value as $key1 => $value1) {
										if ($key1 == 'denominacion')
											$array['denominacion'] = $value1;

										if ($key1 == 'fecha')
											$array['fecha'] = $value1;

										if ($key1 == 'circunscripcion')
											$array['circunscripcion'] = $value1;
									} ?>

									<option value="<?php echo $array['denominacion'] ?>">
										<?php echo $array['denominacion'] ?> -
										<?php echo $array['circunscripcion'] ?> -
										<?php echo $array['fecha'] ?>
									</option>
								<?php } ?>
							</select>
							<br>
						</div>
					</div>


					<div class="container-contact100-form-btn">
						<button class="contact100-form-btn">
							<span>
								<i class="fa fa-paper-plane-o m-r-6" aria-hidden="true"></i>
								Confirmar
							</span>
						</button>
					</div>
			</div>
		</div>
		<div><br>
			<div class="center-column">
				<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />
				<a href="menuEntrada.php" class="btn btn-success">Atras</a>
			</div>
		</div>
		</form>

		<div id="dropDownSelect1"></div>

	<?php }
	include 'Extras/scripts.php' ?>

</body>

</html>

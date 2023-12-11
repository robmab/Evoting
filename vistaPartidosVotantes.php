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
  $vistaPar = $_SESSION['ARRAYPARTIDOS'];
  $contadorT = 0;

  foreach ($vistaPar as $num => $vot) {
    if ($contadorT == 0) { ?>

      <div class="table100 ver1 m-b-110">
        <br>
        <h1> Listado Partidos
          <?php
          if (isset($_SESSION['Convocatoria'])) {
            if ($_SESSION['Convocatoria']['denominacion'] != null) {
              ?> para convocatoria de <b>
                <?php
                echo $_SESSION['Convocatoria']['denominacion']; ?>
              </b> en <b>
                <?php echo $_SESSION['Convocatoria']['circunscripcion'] ?>
              </b>
            </h1>

            <h1 class="center">
              <i>
                <?php echo $_SESSION['Convocatoria']['fecha']; ?>
              </i>
            </h1>
          <?php }
          } ?>
        <br><br>
        <div class="wrap-input100 validate-input">
          <table data-vertable="ver1">
            <thead>
              <tr class="row100 head">
                <th class="column100 column1" data-column="column1">Nombre</th>
                <th class="column100 column2" data-column="column2">Siglas</th>
                <th class="column100 column3" data-column="column3">Dirección de la Sede</th>
                <th class="column100 column4" data-column="column4">Logo</th>
                <?php if (isset($_SESSION['comprobarEscrutinio'])) { ?>
                  <th class="column100 column5" data-column="column5">Votos totales</th>
                <?php } ?>
              </tr>
            </thead>
            <tbody>
            <?php } ?>

            <tr class="row100">
              <td class="column100 column1" data-column="column1">
                <?php echo $vistaPar[$num]['nombre'] ?>
              </td>
              <td class="column100 column2" data-column="column2">
                <?php echo $vistaPar[$num]['siglas'] ?>
              </td>
              <td class="column100 column3" data-column="column3">
                <?php echo $vistaPar[$num]['direccionSede'] ?>
              </td>
              <td class="column100 column4" data-column="column4"><img src="<?php
              echo $vistaPar[$num]['logo'] ?> " alt="Logo Partido" style="width:100px;height:100px;">
              </td>

              <?php if (isset($_SESSION['comprobarEscrutinio'])) { ?>

                <td class="column100 column5" data-column="column5">
                  <?php echo $vistaPar[$num]['votosTotales'] ?>
                </td>
              <?php }

              $contadorT = 1; ?>

            </tr>
          <?php }

  if (isset($_SESSION['comprobarEscrutinio']))
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
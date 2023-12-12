<!DOCTYPE html>
<html lang="en">

<head>
  <?php session_start() ?>
  <title>Lista Votantes</title>
  <?php include 'Extras/css.php'; ?>
</head>

<?php include 'Extras/menu.php' ?>

<div class="container-contact100">

  <?php include 'conexionBD.php';
  $votView = $_SESSION['ARRAYVOTANTES'];
  $counterT = 0;


  foreach ($votView as $num => $vot) {

    if ($counterT == 0) { ?>

      <div class="table100 ver1 m-b-110">
        <br>
        <div class="center">
          <h1> Listado votantes
            <?php
            if (isset($_SESSION['Convocatoria'])) {
              if ($_SESSION['Convocatoria']['denominacion'] != null) { ?>
                convocatoria de
                <b>
                  <?php echo $_SESSION['Convocatoria']['denominacion']; ?>
                </b>
                en
                <b>
                  <?php echo $_SESSION['Convocatoria']['circunscripcion']; ?>
                </b>
              </h1>
              <h1>
                <i>
                  <?php echo $_SESSION['Convocatoria']['fecha']; ?>
                </i>
              </h1>
            </div>
          <?php }
            } ?>
        <br><br>
        <div class="wrap-input100 validate-input" data-validate="Pon tu DNI">

          <table data-vertable="ver1">
            <thead>
              <tr class="row100 head">
                <th class="column100 column1" data-column="column1">Nombre</th>
                <th class="column100 column2" data-column="column2">Apellidos</th>
                <th class="column100 column3" data-column="column3">Fecha Nacimiento</th>
                <th class="column100 column4" data-column="column4">Domicilio</th>
                <th class="column100 column5" data-column="column5">NIF</th>

                <th class="column100 column7" data-column="column7">Votado</th>
              </tr>
            </thead>
            <tbody>
            <?php } ?>

            <tr class="row100">
              <td class="column100 column1" data-column="column1">
                <?php echo $votView[$num]['nombre'] ?>
              </td>
              <td class="column100 column2" data-column="column2">
                <?php echo $votView[$num]['apellidos'] ?>
              </td>
              <td class="column100 column3" data-column="column3">
                <?php echo $votView[$num]['fechaNac'] ?>
              </td>
              <td class="column100 column4" data-column="column4">
                <?php echo $votView[$num]['domicilio'] ?>
              </td>
              <td class="column100 column5" data-column="column5">
                <?php echo $votView[$num]['nif'] ?>
              </td>
              <td class="column100 column6" data-column="column6">
                <?php echo $votView[$num]['votante'] ?>
              </td>

              <?php $counterT = 1; ?>
            </tr>

          <?php } ?>
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
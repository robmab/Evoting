<!DOCTYPE html>
<html lang="en">

<head>
  <title>Alta Votantes</title>
  <?php session_start();
  include 'Extras/css.php'; ?>
</head>

<body>

  <?php include 'Extras/menu.php';

  //Formulario
  if (isset($_SESSION['CHECK'])) { ?>

    <script>
      function dobValidate(birth) {
        var today = new Date();
        var nowyear = today.getFullYear();
        var nowmonth = today.getMonth();
        var nowday = today.getDate();
        var b = document.getElementById('fechaN2').value;
        var birth = new Date(b);
        var birthyear = birth.getFullYear();
        var birthmonth = birth.getMonth();
        var birthday = birth.getDate();
        var age = nowyear - birthyear;
        var age_month = nowmonth - birthmonth;
        var age_day = nowday - birthday;

        if (age > 150) {
          alert("Introduce un fecha vádila. No puede ser mas de 150 años.")
          return false;
        }
        if (age_month < 0 || (age_month == 0 && age_day < 0))
          age = parseInt(age) - 1;

        if ((age == 18 && age_month <= 0 && age_day <= 0) || age < 18) {
          alert("Debes tener más de 18 años para votar");
          return false;
        }
      }
    </script>

    <div class="container-contact100">
      <div class="wrap-contact100">
        <form class="contact100-form validate-form" action="controladorModificarVotantes.php?probar=1" method="POST"
          onsubmit="return dobValidate('date')">
          <span class="contact100-form-title">
            Modificar votante <p>
              <?php echo $_SESSION['datosVotante']['nombre'] . " " . $_SESSION['datosVotante']['apellidos']; ?>
            </p>
          </span>

          <div class="wrap-input100 validate-input" data-validate="Pon tu DNI">
            <input class="input100" type="text" name="dni2" readonly="readonly"
              value="DNI: <?php echo $_SESSION['datosVotante']['nif']; ?>">
            <span class="focus-input100"></span>
          </div>

          <div class="wrap-input100 validate-input" data-validate="Pon tu Nombre">
            <input style="text-transform: capitalize;" class="input100" type="text" name="nombre2"
              placeholder="Nombre: <?php echo $_SESSION['datosVotante']['nombre']; ?>">
            <span class="focus-input100"></span>
          </div>

          <div class="wrap-input100 validate-input" data-validate="Pon tus Apellidos">
            <input style="text-transform: capitalize;" class="input100" type="text" name="apellidos2"
              placeholder="Apellidos: <?php echo $_SESSION['datosVotante']['apellidos']; ?>">
            <span class="focus-input100"></span>
          </div>

          <div class="wrap-input100 validate-input">
            <input class="input100" type="text" name="fechaN22" readonly="readonly"
              value="Fecha Nacimiento: <?php echo $_SESSION['datosVotante']['fechaNac'] ?> ">
            <span class="focus-input100"></span>
          </div>
          <div class="wrap-input100 validate-input" data-validate="Pon tu Fecha de Nacimiento">
            <input class="input100" type="date" name="fechaN2" id="fechaN2">
            <span class="focus-input100"></span>
          </div>
          <div style="text-transform: capitalize;" class="wrap-input100 validate-input" data-validate="Pon tu Domicilio">
            <input class="input100" type="text" name="domicilio2"
              placeholder="Domicilio: <?php echo $_SESSION['datosVotante']['domicilio']; ?>">
            <span class="focus-input100"></span>
          </div>

          <p class="center">____________</p>

          <div class="wrap-input100 validate-input" data-validate="Contraseña actual">
            <input class="input100" type="password" name="contraseñaA" placeholder="Contraseña actual">
            <span class="focus-input100"></span>
          </div>

          <?php if (isset($_SESSION['errCont'])) {
            echo " <p style='color:red;'> " . $_SESSION['errCont'] . "</p> ";
            unset($_SESSION['errCont']);
          } ?>

          <div class="wrap-input100 validate-input" data-validate="Contraseña nuevaa">
            <input id="passwd" class="input100" type="password" name="contraseñaN" placeholder="Contraseña nueva">
            <span class="focus-input100"></span>

          </div>
          <div class="wrap-input100 validate-input" data-validate="Repite la Contraseña">
            <input id="passwd2" class="input100" type="password" name="contraseñaN2" placeholder="Repite Contraseña nueva"
              oninput="check(this)">


            <script language='javascript' type='text/javascript'>
              function check(input) {
                if (input.value != document.getElementById('passwd').value) {
                  input.setCustomValidity('Las contraseñas no coinciden.');
                } else {

                  input.setCustomValidity('');
                }
              }
            </script>
            <span class="focus-input100"></span>
          </div>

          <div class="container-contact100-form-btn">
            <button type="submit" class="contact100-form-btn">
              <span>
                <i class="fa fa-paper-plane-o m-r-6" aria-hidden="true"></i>
                Confirmar
              </span>
              <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />
            </button>
            <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />

            <a href="controladorModificarVotantes.php?cancelar=1" class="btn btn-success">Cancelar</a>
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

    <?php
  }

  //Tabla datos
  if (isset($_SESSION['VAL'])) {
    unset($_SESSION['VAL']) ?>

    <div class="container-contact100">
      <div class="table100 ver1 m-b-110">
        <br>
        <h1 class="center"> Datos Votante
          <?php echo $_SESSION['datosVotante']['nombre'] . " " . $_SESSION['datosVotante']['apellidos']; ?>
          <b>
        </h1>
        <br><br>

        <div class="wrap-input100 validate-input">
          <table data-vertable="ver1">
            <thead>
              <tr class="row100 head">
                <th class="column100 column1" data-column="column1">DNI</th>
                <th class="column100 column2" data-column="column2">Nombre</th>
                <th class="column100 column3" data-column="column3">Apellidos</th>
                <th class="column100 column4" data-column="column4">Fecha Nacimiento</th>
                <th class="column100 column5" data-column="column5">Domicilio</th>
                <th class="column100 column7" data-column="column7">Rol</th>
                <th class="column100 column7" data-column="column7">Votado</th>
              </tr>
            </thead>
            <tbody>
              <tr class="row100">
                <td class="column100 column1" data-column="column1">
                  <?php echo $_SESSION['visionVot']['nif'] ?>
                </td>
                <td class="column100 column2" data-column="column2">
                  <?php echo $_SESSION['visionVot']['nombre'] ?>
                </td>
                <td class="column100 column3" data-column="column3">
                  <?php echo $_SESSION['visionVot']['apellidos'] ?>
                </td>
                <td class="column100 column4" data-column="column4">
                  <?php echo $_SESSION['visionVot']['fechaNac'] ?>
                </td>
                <td class="column100 column5" data-column="column5">
                  <?php echo $_SESSION['visionVot']['domicilio'] ?>
                </td>
                <td class="column100 column6" data-column="column6">
                  <?php echo $_SESSION['visionVot']['rol'] ?>
                </td>
                <td class="column100 column6" data-column="column6">
                  <?php echo $_SESSION['visionVot']['votante'] ?>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
        <?php if (isset($_SESSION['comprobacionContraseña'])) {
          echo " <center><p style='color:red;'> " . $_SESSION['comprobacionContraseña'] . "</p> </center>";
          unset($_SESSION['comprobacionContraseña']);
        } ?>
      </div>
    </div>

    <div>
      <br>
      <div class="center-column">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />
        <a href="menuEntrada.php" class="btn btn-success">Atras</a>
      </div>
    </div>

  <?php }
  include 'Extras/scripts.php' ?>

</body>

</html>
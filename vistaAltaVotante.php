<!DOCTYPE html>
<html lang="en">
<head>
	<title>Alta Votantes</title>
        
        <?php   
        session_start();
        include 'Extras/css.php';
    ?>  
        
   

</head>
<body>

    <?php    include 'Extras/menu.php';
    
    
    
    
    ?>  
    

		
    

              
    
	<div class="container-contact100">

		<div class="wrap-contact100">
                    <form class="contact100-form validate-form" action="controladorAltaVotantes.php" method="POST" onsubmit="return dobValidate('dn','date')">
				<span class="contact100-form-title">
					Alta Votantes
				</span>

				<div class="wrap-input100 validate-input" data-validate="Pon tu DNI">
                                    <input maxlength="9" minlength="9" class="input100" type="text" name="dni" placeholder="DNI" id="lul" required="" >
					<span class="focus-input100"></span>
				</div>
                            
                   
              
                              

				<div class="wrap-input100 validate-input" data-validate = "Pon tu Nombre">
                                    <input class="input100" type="text" name="nombre" placeholder="Nombre" style="text-transform: capitalize;" required="">
					<span class="focus-input100"></span>
				</div>

				<div class="wrap-input100 validate-input" data-validate = "Pon tus Apellidos" >
					<input class="input100" type="text" name="apellidos" placeholder="Apellidos" style="text-transform: capitalize;" required="">
					<span class="focus-input100"></span>
				</div>
                            
                                <div class="wrap-input100 validate-input" data-validate = "Pon tu Fecha de Nacimiento" >
					<input class="input100" type="date" name="fechaN" id="fecha" required="">
					<span class="focus-input100"></span>
				</div>
                        
                        
                        <script>


    function dobValidate(dni,birth) {

     var dni = document.getElementById('lul').value;
          numero = dni.substr(0,dni.length-1);
  let = dni.substr(dni.length-1,1);
  numero = numero % 23;
  letra='TRWAGMYFPDXBNJZSQVHLCKET';
  letra=letra.substring(numero,numero+1);
  if (letra!=let) {
   
     
     alert("Dni inválido");
     return false;
    
   
  } 



        var today = new Date();
        var nowyear = today.getFullYear();
        var nowmonth = today.getMonth();
        var nowday = today.getDate();
        var b = document.getElementById('fecha').value;



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
        if (age_month < 0 || (age_month == 0 && age_day < 0)) {
            age = parseInt(age) - 1;


        }
        if ((age == 18 && age_month <= 0 && age_day <= 0) || age < 18) {
            alert("Debes tener más de 18 años para votar");
            return false;
        }
        
   
    
  
    }



</script>
                        
                                <div class="wrap-input100 validate-input" data-validate = "Pon tu Domicilio">
					<input class="input100" type="text" name="domicilio" placeholder="Domicilio" required="" >
					<span class="focus-input100"></span>
				</div>
                                <div class="wrap-input100 validate-input" data-validate = "Pon tu Contraseña">
                                    <input class="input100" type="password" name="contraseña" placeholder="Contraseña" id="password" required="" >
					<span class="focus-input100"></span>
				</div>
                            
                                <div class="wrap-input100 validate-input" data-validate = "Repite la Contraseña">
                                    <input class="input100" type="password" name="contraseña2" placeholder="Repite Contraseña" id="password_confirm" required="" oninput="check(this)">
                                    
                                                      <script language='javascript' type='text/javascript'>
    function check(inpu) {
        if (inpu.value != document.getElementById('password').value) {
            inpu.setCustomValidity('Las contraseñas no coinciden.');
        } else {
            
            inpu.setCustomValidity('');
        }
    }
</script>
                                    
					<span class="focus-input100"></span>
                                        
                                        
				</div>

		<?php
//             if (isset($_SESSION['dosPassw'])){
//                    
//                    echo  " <p style='color:red;'> ". $_SESSION['dosPassw']."</p> "  ;
//                    unset($_SESSION['dosPassw']);
//                    }   ;
            ?>

          
                            
				<div class="container-contact100-form-btn">
					<button type="submit" class="contact100-form-btn">
						<span>
							<i class="fa fa-paper-plane-o m-r-6" aria-hidden="true"></i>
							Confirmar
						</span>
					</button>
                                   
                                    
				</div>
                            </form>
                    
                    </div>
            </div>
                <div><br><center><link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />


                        <a href="menuEntrada.php" class="btn btn-success">Atras</a></center></div>
			
		
	



	<div id="dropDownSelect1"></div>

        
        <?php    include 'Extras/scripts.php';
    ?>  
</body>
</html>

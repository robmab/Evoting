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
    
    
//    if ( $_SESSION['rol'] == 'Administrador' ){
    
    ?>  

<!--	<div class="container-contact100">

		<div class="wrap-contact100">
			<form class="contact100-form validate-form" action="controladorBorrarVotantes.php" method="POST">
				<span class="contact100-form-title">
					Borrar Votante
				</span>

				<div class="wrap-input100 validate-input" data-validate="Pon DNI para borrar usuario.">
					<input class="input100" type="text" name="dni" placeholder="DNI">
					<span class="focus-input100"></span>
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
    <div><br><center><link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />


            <a href="menuEntrada.php" class="btn btn-success">Atras</a></center></div>
			</form>
	-->

    <?php //   } 
    
//    else {
        ?>
    <div class="container-contact100">
    <span class="contact100-form-title">
					¿Quieres borrar tu usuario?
				</span>
    
    

             
    <span class="contact100-form-title">
        <center><link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />


                                    <a href="controladorBorrarVotantes.php" class="btn btn-success">Si</a>
                                    
       <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />


       <a href="menuEntrada.php" class="btn btn-success">No</a></center>
        
    </span>	
    
    </div>
    <div><br><center><link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />


            <a href="menuEntrada.php" class="btn btn-success">Atras</a></center></div>
    <?php
//    } ;
?>

	<div id="dropDownSelect1"></div>

        
        <?php    include 'Extras/scripts.php';
    ?>  
</body>
</html>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Autentificacion</title>
        
        <?php   
     
              session_start();
  
           $count=1;   
                     
       //_______________________________________________________   
       //_______________________________________________________  
           
       if(isset($_REQUEST['vari'])){       
              
              
       unset($_SESSION['user']) ;
       unset($_SESSION['rol'])  ;
       
       // header("Location:menuEntrada.php"); 
           
       }       
       
       //_______________________________________________________   
       //_______________________________________________________  
              
                  $_SESSION['modo']='login' ;
                  
   if(isset($_REQUEST['modo'])){
    $_SESSION['modo'] = $_REQUEST['modo']   ;
    
    if (  isset($_SESSION['user']) ){
     
  header("Location:Autentificacion.php"); 
     $count=0;
 }
 } ;

     //_______________________________________________________   
     //_______________________________________________________  Entrando desde el menu directamente

 if (  (isset($_SESSION['user'] )) && ($count == 1)  ){
     
     $_SESSION['sesionIniciada'] = '¡Ya estas logeado!'  ;
   header("Location:menuEntrada.php"); 
     
 }
      //_______________________________________________________   
     //_______________________________________________________  Menu directo

;
             include 'Extras/css.php';
             
                
    ?>  
    <style>
       .registro {
    background-color: red;
  box-shadow: 0 5px 0 darkred;
  color: white;
  padding: 1em 1.5em;
  position: relative;
  text-decoration: none;
  text-transform: uppercase;
}

.registro:hover {
  background-color: #ce0606;
  cursor: pointer;
  text-decoration: none;
  
}

.registro:active {
  box-shadow: none;
  top: 5px;
}
.registro:hover {
  cursor: pointer;
}
    </style>
</head>
<body>

    <?php    
    
    

    
    include 'Extras/menu.php';
    
   
    

    

 
 

    
    ?>  

 

    
    
    
	<div class="container-contact100">

		<div class="wrap-contact100">
                    <form class="contact100-form validate-form" action="Autentificacion.php" method="POST">
				<span class="contact100-form-title">
					Login
				</span>

                 
                        
				<div class="wrap-input100 validate-input" data-validate="DNI">
					<input class="input100" type="text" name="dni" placeholder="DNI">
					<span class="focus-input100"></span>
				</div>
           <?php
                    
                    if (isset($_SESSION['errDni'])){
                    
                    echo  " <p style='color:red;'> ". $_SESSION['errDni']."</p> "  ;
                    unset($_SESSION['errDni']);
                    }   ;
                    ?>

                                <div class="wrap-input100 validate-input" data-validate = "Contraseña">
                                    <input class="input100" type="password" name="contraseña" placeholder="Contraseña">
					<span class="focus-input100"></span>
				</div>
                           <?php
                   
                    if (isset($_SESSION['err'])){
                    
                    echo  " <p style='color:red;'> ". $_SESSION['err']."</p> "  ;
                    unset($_SESSION['err']);
                    }   ;
                    ?>
		

				<div class="container-contact100-form-btn">
					<button class="contact100-form-btn">
						<span>
							<i class="fa fa-paper-plane-o m-r-6" aria-hidden="true"></i>
							Confirmar
						</span>
					</button>
                                   
                                    <a class="registro" href="vistaAltaVotante.php">¡Registrate si aun no lo estas!</a>
				</div>
                        
                            	</div>
	</div>
    <div><br><center><link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />


            <a href="menuEntrada.php" class="btn btn-success">Atras</a></center></div>
			</form>

                    
	



	<div id="dropDownSelect1"></div>

        
        <?php    include 'Extras/scripts.php';
    ?>  
</body>
</html>
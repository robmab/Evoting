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


    
    <?php   
    
 
    
    //_________________________________________________________________________________________
    
    
    
 
    
    
    
   
    
    
    
    if ( isset($_SESSION['escrutinioAbierto']) ){   
        unset  ($_SESSION['escrutinioAbierto']);
        
         ?> <div class="container-contact100">
            
            
            
             <p>
        <?php    echo '¡Aun no puedes votar!'  ;
            
            
            
        ?></p>
              </div>
    <div> <center>
    <br> 
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />


    <a href="menuEntrada.php" class="btn btn-success">Atras</a></center></div>
           
        
   
        
        
        
        <?php

//_______________________________________________________
//_______________________________________________________
//_______________________________________________________
        
    }
    
    elseif(isset( $_SESSION['vota']) && ($_SESSION['votante'] == 'No')){
       
   
    ?>
    
	<div class="container-contact100">

		<div class="wrap-contact100">
			<form class="contact100-form validate-form" action="controladorVotar.php" method="POST">
				<span class="contact100-form-title">
					Voto para la convocatoria <b><?php 
       
       echo $_SESSION['Convocatoria']['denominacion'] ;
       ?></b> en <b><?php 
       
       echo $_SESSION['Convocatoria']['circunscripcion'] ;
       ?></b></h1><center><h1><i>
           <?php
           echo $_SESSION['Convocatoria']['fecha'];
           ?> </center></h1></i>
				</span>

				<div class="wrap-input100 validate-input" ><br>
                                    <center> 
                                            
         <?php
         
                    foreach ($_SESSION['listapart'] as $key => $value) {
                        
                        
                        
                        
                   
         ?>
              <label><ul>
                  <li><input name="partido" value="<?php echo $key ?>" type="radio"><img style="width:150px;height:150px;" src="<?php echo $value ?>"></li>
                  </ul></label>
                                        <p>_________________</p> 
  
                
            <?php
                    };
            ?>
                                        <label>
                                        <ul>
                                            <li><input name="partido" value="blanco" type="radio" ><img style="width:200px;height:150px;" src="images/blanco.jpg"></li>
                                        </ul></label>
                                    </center>
                <br>
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
	



	<div id="dropDownSelect1"></div>

        
        
        
    <?php
    
    
    
    
    
    //_______________________________________________________
    //_______________________________________________________
    //_______________________________________________________
    
    }
    else{   
  
        
       ?> <div class="container-contact100">
            
            
            
           
        <?php    echo '¡Ya has votado!'  ;
            
            
            
            ?>
            </div>
        <div> <br><center>
    <br>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />


    <a href="menuEntrada.php" class="btn btn-success">Atras</a></center></div>
           
        
   
        
        
        
        <?php
    };
        
        
        
        include 'Extras/scripts.php';
        
    ?>  
</body>
</html>
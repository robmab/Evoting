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
    
    
//___________________-----------
//___________________---------------------
//___________________-----------

    
    if (isset( $_SESSION['set'])){
        
        unset($_SESSION['set']);
 ?>
          <div class="container-contact100">
            
            <?php
            
           
            echo $_SESSION['mensajeBD']  ;
            
            
            
            ?>
           <div> <center
    <br><br> <br><br> <br><br>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />


                                    <a href="menuEntrada.php" class="btn btn-success">Atras</a></div>
            </div>
    
        <?php
    }
    
    
    
    
//___________________-----------
//___________________---------------------
//___________________-----------

    
    
    
        elseif ( $_SESSION['convocat']['denominacion'] == null ) {
        
         
 ?>
          <div class="container-contact100">
            
            <?php
            
           
            echo "No se esperan mas convocatorias por el momento."  ;
            
            
            
            ?>
              </div>
              <div> <center>
    <br><br>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />


    <a href="menuEntrada.php" class="btn btn-success">Atras</a></center></div>
            
    
        <?php
        
    }
    
    
    
//___________________-----------
//___________________---------------------
//___________________-----------

    
    else {
        
        
?>

    
 <div class="container-contact100">
    <span class="contact100-form-title">
					Empezar votos de la convocatoria <?php  echo $_SESSION['convocat']['denominacion'];
                                        unset($_SESSION['convocat']['denominacion']);
                                        
                                       ?>
				</span>
    
    <form class="contact100-form validate-form"
</div>
             
    <div>
        <center><link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />


                                    <a href="controladorOnEscrutinio.php?validacion=1" class="btn btn-success">Si</a>
                                    
       <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />


       <a href="menuEntrada.php" class="btn btn-success">No</a></center>
        
    </div>
    
   
			</form>
    
    
    <div><link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />


                                    <a href="menuEntrada.php" class="btn btn-success">Atras</a></div>
  
	<div id="dropDownSelect1"></div>

    
 
    
   
   
        
        
        
     <?php  
        
        
       
    };     
     include 'Extras/scripts.php';
    ?>  
</body>
</html>

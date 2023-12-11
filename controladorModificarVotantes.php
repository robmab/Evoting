
   

    <?php
    
        session_start();
    include 'conexionBD.php';
 

 
    
    
    //_----------- Anticuado
    
   if(isset($_REQUEST["cancelar"])){
     
     unset ($_SESSION['CHECK']) ;
     header("Location:vistaModificarVotantes.php ");
       exit;
     }
    
    //_----------- Anticuado
     
     //_----------- Comprobaciones si vota y escrutinio
         
     $sql5="SELECT * FROM convocatoria WHERE escrutinio='Abierto'"; 

$memi5=$conexion->query($sql5) ;

if ( $memi5&&$memi5->num_rows>0 ) {
     
      $_SESSION['mensajeBD']= "No puedes modificar tu usuario mientras este el escrutinio abierto " ;
  header("Location:MensajeErrores.php");  
  exit;
}

          
     $sql5="SELECT * FROM votante WHERE votante='Si' AND nif='".$_SESSION['user']."'"; 

$memi5=$conexion->query($sql5) ;

if ( $memi5&&$memi5->num_rows>0 ) {
     
      $_SESSION['mensajeBD']= "No puedes modificar tu usuario si ya has votado " ;
  header("Location:MensajeErrores.php");  
  exit;
}

     
     //_----------- Comprobaciones si vota y escrutinio
     
     
 

     
  //_________________________________________________________________________________
     
     $countador=1;
     $cont=1;
     
    
          //_----------- summit comprobacion
     
     if(isset($_REQUEST['probar'])){
         
         
         $countador=0;
         
     };
     
     
           //_----------- summit comprobacion
    
     //_________________________________________________________________________________
     
     
     
       //_----------- Recoger datos para el formulario
     
     
    if ($countador==1){
     
     $sql1="SELECT * FROM votante WHERE nif='".$_SESSION['user']."'"; 

$memi1=$conexion->query($sql1) ;

if ( $memi1&&$memi1->num_rows>0 ) {
    $info1= $memi1->fetch_array() ;
    $_SESSION['datosVotante']= $info1 ;
    $_SESSION['CHECK']=1;
    
     $nif=$_SESSION['datosVotante']['nif'];
     header("Location:vistaModificarVotantes.php"); 
    
    exit;
}
    
    
    };
    
     
     //_----------- Recoger datos
    
    
    //_----------- Request de los datos
    
    
     
      if(isset($_REQUEST["contraseñaA"]) && ( $_REQUEST['contraseñaA'] !='' )){
     $contraseñaA=$_REQUEST["contraseñaA"];
     
     
 if(isset($_REQUEST['contraseñaN'])&& ( $_REQUEST['contraseñaN'] !='' )){
     $contraseñaN=$_REQUEST["contraseñaN"];
 
 
 if(isset($_REQUEST['contraseñaN2'])&& ( $_REQUEST['contraseñaN2'] !='' )){
     $contraseñaN2=$_REQUEST["contraseñaN2"];
     
     $contraseñaDec= base64_decode ($_SESSION['password']);
     
      if ( $contraseñaA != $contraseñaDec ){
     $cont=0;
          $_SESSION['errCont']='No coincide la contraseña actual';
          header("Location:vistaModificarVotantes.php");
        exit;
 };
 
 
 if ( $cont=1){
 
 $contraseñaN2enc= base64_encode ($contraseñaN2);
 
    $dni10=$_SESSION['user']    ;
 
 $sq1="UPDATE votante SET password='".$contraseñaN2enc."' WHERE nif='".$_SESSION['user']."'";
$comprobar=$conexion->query($sq1);

if ($conexion->affected_rows>0 ){ 
    $_SESSION['comprobacionContraseña']="La contraseña ha sido modificada correctamente.";
   
    $cont=0;
    
}

 }
 }
      }
      
 }

 if(isset($_REQUEST['nombre2']) && ( $_REQUEST['nombre2'] !='' ) ){
     $nombre=$_REQUEST["nombre2"];
     $nombre=ucwords($nombre) ;
     
          $sq="UPDATE votante SET nombre='".$nombre."' WHERE nif='".$_SESSION['user']."'";
$comprobar=$conexion->query($sq);


if ($conexion->affected_rows>0 ){ 
    
    $_SESSION['datosVotante']['nombre']= $nombre ;
    $cont=0;
    
}
     
 }
 
 if(isset($_REQUEST['apellidos2'])&& ( $_REQUEST['apellidos2'] !='' )){
     $apellidos=$_REQUEST["apellidos2"];
     $apellidos=ucwords($apellidos) ;
               $sq="UPDATE votante SET apellidos='".$apellidos."' WHERE nif='".$_SESSION['user']."'";
$comprobar=$conexion->query($sq);


if ($conexion->affected_rows>0 ){ 
    
    $_SESSION['datosVotante']['apellidos'] = $apellidos ;
    $cont=0;
    
}
 }
 
 if(isset($_REQUEST['fechaN2'])&& ( $_REQUEST['fechaN2'] !='' )){
     $fechaN=$_REQUEST["fechaN2"];
     
               $sq="UPDATE votante SET fechaNac='".$fechaN."' WHERE nif='".$_SESSION['user']."'";
$comprobar=$conexion->query($sq);


if ($conexion->affected_rows>0 ){ 
    
    $cont=0;
    
}
 }
 
 
 if(isset($_REQUEST['domicilio2'])&& ( $_REQUEST['domicilio2'] !='' )){
     $domicilio=$_REQUEST["domicilio2"];
      $domicilio=ucwords( $domicilio) ;
     
               $sq="UPDATE votante SET domicilio='".$domicilio."' WHERE nif='".$_SESSION['user']."'";
$comprobar=$conexion->query($sq);


if ($conexion->affected_rows>0 ){ 
    
    $cont=0;
    
}
 }
 
 if(isset($_REQUEST['rol2'])&& ( $_REQUEST['rol2'] !='' )){
     $rol=$_REQUEST["rol2"];
     
               $sq="UPDATE votante SET rol='".$rol."' WHERE nif='".$_SESSION['user']."'";
$comprobar=$conexion->query($sq);


if ($conexion->affected_rows>0 ){ 
    
    $cont=0;
    
}
 }
 
 if(isset($_REQUEST['votado2'])&& ( $_REQUEST['votado2'] !='' )){
     $votado=$_REQUEST["votado2"];
     
               $sq="UPDATE votante SET votante='".$votado."' WHERE nif='".$_SESSION['user']."'";
$comprobar=$conexion->query($sq);


if ($conexion->affected_rows>0 ){ 
    
    $cont=0;
    
}
 }
    
    //_----------- Request de los datos
 
 
     //_----------- Si no se modifico un dato o si
     
  if ($cont == 0){
      
      unset ($_SESSION['CHECK']) ;  
      
      
      
      $sql1="SELECT * FROM votante WHERE nif='".$_SESSION['user']."'"; 

$memi1=$conexion->query($sql1) ;

if ( $memi1&&$memi1->num_rows>0 ) {
    $info1= $memi1->fetch_array() ;
      
}
      
     $_SESSION['visionVot']= $info1 ; 
     $_SESSION['VAL']=1 ;
      header("Location:vistaModificarVotantes.php"); 
      
       exit;
  }
  elseif ($cont == 1) {
     
    unset ($_SESSION['CHECK']) ;  
    
    $_SESSION['mensajeBD']= "No se ha modificado ningun dato, cerrando..." ;
    header("Location:MensajeErrores.php"); 
    
    exit;
      
  };
    //_----------- Si no se modifico un dato o si
 

 ?>

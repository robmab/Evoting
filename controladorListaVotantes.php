
            <?php
    
    include 'conexionBD.php';
    
    
    
    

  $sql2="SELECT count(*) FROM votante" ;
  $memi2=$conexion->query($sql2) ;
  
      if( $memi2->num_rows > 0 ){
          
           $info2=$memi2->fetch_array() ;
           $num=$info2[0] ;
           $num=(int)$num ;
      }
    
     
 $cont=0 ;
 $listaVot=array() ;
 
for ( $cont2=0  ; $cont < $num ; $cont2++  ) {
 
$sql1="SELECT nif,domicilio,apellidos,fechaNac,rol,votante,nombre FROM votante WHERE ID='". $cont2 ."'"; 

$memi1=$conexion->query($sql1) ;

if ( $memi1&&$memi1->num_rows>0 ) {
    $info1= $memi1->fetch_array() ;
   
         
  
       $listaVot[$cont]['nombre']=  $info1['nombre']  ;
       $listaVot[$cont]['apellidos']=  $info1['apellidos']  ;
        $listaVot[$cont]['fechaNac']=  $info1['fechaNac']  ;
       $listaVot[$cont]['domicilio']=  $info1['domicilio']  ;
       $listaVot[$cont]['nif']=  $info1['nif']  ;
       $listaVot[$cont]['votante']=  $info1['votante']  ;
    
       
              


   
 $cont++ ;
} 

}

        //_______________________________________________________   
        //Ordenado por apellido.
        //_______________________________________________________   

function array_sort($array, $on, $order=SORT_ASC){

    $new_array = array();
    $sortable_array = array();

    if (count($array) > 0) {
        foreach ($array as $k => $v) {
            if (is_array($v)) {
                foreach ($v as $k2 => $v2) {
                    if ($k2 == $on) {
                        $sortable_array[$k] = $v2;
                    }
                }
            } else {
                $sortable_array[$k] = $v;
            }
        }

        switch ($order) {
            case SORT_ASC:
                asort($sortable_array);
                break;
            case SORT_DESC:
                arsort($sortable_array);
                break;
        }

        foreach ($sortable_array as $k => $v) {
            $new_array[$k] = $array[$k];
        }
    }

    return $new_array;
}

$listaVot = array_sort($listaVot, 'apellidos', SORT_ASC);


//_______________________________________________________   
// Nombre Convocatoria
//_______________________________________________________   




 $sql2="SELECT count(*) FROM convocatoria" ;
  $memi2=$conexion->query($sql2) ;
  
      if( $memi2->num_rows > 0 ){
          
           $info2=$memi2->fetch_array() ;
           $num=$info2[0] ;
           $num=(int)$num ;
      }
    
     
 $cont=0 ;
 $listaCon=array() ;
 
for ( $cont2=0  ; $cont < $num ; $cont2++  ) {
 
$sql1="SELECT id,fecha FROM convocatoria WHERE id=". $cont2 .""; 

$memi1=$conexion->query($sql1) ;

if ( $memi1&&$memi1->num_rows>0 ) {
    $info1= $memi1->fetch_array() ;
   
         $sql1="SELECT * FROM resultado WHERE convocatoria=". $info1['id'] .""; 

         $memi1=$conexion->query($sql1) ;
         if ( $memi1&&$memi1->num_rows>0 ) {
   
   
  }
  else{
      
      $listaCon[$cont]['id']=  $info1['id']  ;
      $listaCon[$cont]['fecha']=  $info1['fecha']  ;
  };
   
 $cont++ ;
} 

}




$listaCon = array_sort($listaCon, 'fecha', SORT_ASC);

$listaC = array_slice($listaCon, 0, 1); 


foreach($listaC as $value){
    
    foreach($value as $key => $value){
        
        
            if (  $key == 'id'){
            $solucion= $value  ;
            
      
            };
    };
};


$sql50="SELECT denominacion,circunscripcion,fecha FROM convocatoria where id='".$solucion."' "; 

$memi50=$conexion->query($sql50) ;

if ( $memi50&&$memi50->num_rows>0 ) {
    $info3= $memi50->fetch_array() ;
   $info3['fecha'] = date("d-m-Y", strtotime($info3['fecha']));






$sql3="SELECT denominacion,circunscripcion,fecha FROM convocatoria where escrutinio='Abierto' "; 

$memi3=$conexion->query($sql3) ;

if ( $memi3&&$memi3->num_rows>0 ) {
    $info3= $memi3->fetch_array() ;
   $info3['fecha'] = date("d-m-Y", strtotime($info3['fecha']));

}


}

session_start();
$_SESSION['ARRAYVOTANTES']=$listaVot ;
$_SESSION['Convocatoria']=$info3 ;
 
//print_r($listaC);
//echo $solucion ;
header("Location:vistaListaVotantes.php");
   
   





?>





<?php
@ $conexion = new mysqli('localhost', 'root', '');
$conexion->set_charset("utf8");

if(!$conexion->connect_errno){
    
    //echo "<h2>Conexion establecida con la base de datos</h2>";
    
     $conexion->select_db("bd_votaciones_2019_Examen_rmb") or die ("Base de Datos no encontrada");
    
    //echo "<h2> Conexión establecida con la base de datos de bd_votaciones_2019</h2><br>";
    
}

        ?>
        
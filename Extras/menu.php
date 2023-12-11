<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">



		<div class="content">
                    <a href='menuEntrada.php'><h1 class="title">Proyecto e-Votantes</h1></a>
                    

			<ul id="sdt_menu" class="sdt_menu">
				<li>
					<a href="index.php">
						<img src="images/3.jpg" alt=""/>
						<span class="sdt_active"></span>
						<span class="sdt_wrap">
							<span class="sdt_link">Login</span>
							<span class="sdt_descr"></span>
						</span>
					</a>
				</li>
				<li>
					<a href="#">
						<img src="images/2.jpg" alt=""/>
						<span class="sdt_active"></span>
						<span class="sdt_wrap">
							<span class="sdt_link">Votantes</span>
							<span class="sdt_descr"></span>
						</span>
					</a>
					<div class="sdt_box">
                                            <a href="vistaAltaVotante.php">Alta</a>
							<a href="index.php?modo=borrar">Baja</a>
							<a href="index.php?modo=modificar">Modificación</a>
                                                        
                                                         <?php
                                     if ( isset($_SESSION['rol'])){
                                         
                                         if ( $_SESSION['rol'] == 'Administrador' ){
                            ?>
                                                        
                                                        
                                                        <a href="controladorListaVotantes.php">Listado</a>
                                                        
                                                           <?php    
                                     
                                         };
                                         };      
                                      ?> 
					</div>
				</li>
				<li>
					<a href="controladorPartidosVotantes.php">
						<img src="images/4.jpg" alt=""/>
						<span class="sdt_active"></span>
						<span class="sdt_wrap">
							<span class="sdt_link">Partidos</span>
							<span class="sdt_descr"></span>
						</span>
					</a>
				</li>
				<li>
					<a href="index.php?modo=votar">
						<img src="images/1.jpg" alt=""/>
						<span class="sdt_active"></span>
						<span class="sdt_wrap">
							<span class="sdt_link">Votar</span>
							<span class="sdt_descr"></span>
						</span>
					</a>
				</li>
                            
                            <?php
                                     if ( isset($_SESSION['rol'])){
                                         
                                         if ( $_SESSION['rol'] == 'Administrador' ){
                            ?>
				<li>
					<a href="#">
						<img src="images/6.jpg" alt=""/>
						<span class="sdt_active"></span>
						<span class="sdt_wrap">
							<span class="sdt_link">Escrutinio</span>
							<span class="sdt_descr"></span>
						</span>
					</a>
					<div class="sdt_box">
							<a href="controladorOnEscrutinio.php">Abrir</a>
							<a href="controladorOffEscrutinio.php">Cerrar</a>

					</div>
				</li>
                                        
                               <?php    
                                     
                                         };
                                         };      
                                      ?>  
                            <li>
					<a href="controladorResultados.php">
						<img src="images/5.jpg" alt=""/>
						<span class="sdt_active"></span>
						<span class="sdt_wrap">
							<span class="sdt_link">Resultados</span>
							<span class="sdt_descr"></span>
						</span>
					</a>
				</li>
                            
                                                        <li>
					<a href="controladorAritmetica.php">
						<img src="images/5.jpg" alt=""/>
						<span class="sdt_active"></span>
						<span class="sdt_wrap">
							<span class="sdt_link">+Vot</span>
							<span class="sdt_descr"></span>
						</span>
					</a>
				</li>
                            
                              
			</ul>
		</div>
<div>
    
                         <?php 
    
       
      if (  isset($_SESSION['user']) ){
       ?>
                 
      

          
    <center>
                                 <p style="color: #3888B5;"><b><?php
         
            echo $_SESSION['nombre']." ".$_SESSION['apellidos'];
            ?> </b></p ><p style="color: #EDE6E1;">esta conectado </p></center>
    	      
            
<?php
 include 'conexionBD.php';
 
 $sql50="SELECT * FROM convocatoria where escrutinio='Abierto' "; 

$memi50=$conexion->query($sql50) ;

if ( $memi50&&$memi50->num_rows>0 ) {
    
     $info1= $memi50->fetch_array() ;
    
     ?>      <center> <p style="color: #E20813;"><b>¡La convocatoria <?php
         
            echo $info1['denominacion'];
            ?> ya esta abierta!</b></p ></center>
    
    <?php
    
}


 
 

                            
      }
                            ?>
</div>
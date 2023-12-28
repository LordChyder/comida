<?php
session_start();
if(!isset($_SESSION['datos_login'])){
    header('Location: ../../login.php');
}

 require '../../conexion.php'; 
 $query=$conexion->prepare("SELECT * FROM testimonios  ORDER BY idtestimonio");
 $query->execute();
 $testimonios=$query->fetchAll(PDO::FETCH_ASSOC);

?>


<?php  include ("../templante/cabecera.php"); ?>
    
    
     <div class="main-content">
  <main class="main">
        <section id="tab3">
            <header>
                <div class="search-wrapper">
                    <span><i class="fas fa-search"></i></span>
                    <input type="search" placeholder="Buscar">
                </div>
                
                <div class="social-icons">
                    <a href="../../login/cerrar.php">
                    <i class="fas fa-sign-out-alt"></i>
                    Cerrar sesion</a>
                </div>
            </header>       
            <div class="activity-card ab">                                
                <h3>Testimonios</h3>
                    <div class="table-responsive">
                        <table>
                            <thead>
                                <tr>
                                    <th>Autor</th>
                                    
                                    <th>Descripcción</th>
                                    <th>fecha</th>
                                    <th>estado</th>
                                    <th colspan="2">Operaciones</th>
                                </tr>
                            </thead>
                             <?php foreach ($testimonios as $testimonio) {?>

                            <tbody>
                                <td><?php echo $testimonio['autor']?></td>
                                
                                <td><?php echo $testimonio['descripcion']?></td>
                                <td><?php echo $testimonio['fecha']?></td>
                                
                                <?php  if($testimonio['estado']=="activo"){?>

                                <td><span class="badge success"><?php echo $testimonio['estado']?></span></td>

                                <?php }else {?>
                                <td><span class="badge warning"><?php echo $testimonio['estado']?></span></td>

                                <?php }?>

                                
                              
                                <td class="td-team">
                                <a href="eliminar.php?id=<?php echo $testimonio['idtestimonio'] ?>" ><div class="img-1"></div></a> 
                                <a href="editar.php?id=<?php echo $testimonio['idtestimonio'] ?>"><div class="img-3"></div></a>   
                                </td>
                            </tbody>
                            
                        <?php }?>  

                        </table>
                    </div>
               </div>
        </section>
    </main>
        
    </div>


<?php  include ("../templante/pie.php"); ?>
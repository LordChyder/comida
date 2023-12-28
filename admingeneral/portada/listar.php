<?php
session_start();
if(!isset($_SESSION['datos_login'])){
    header('Location: ../../login.php');
}

 require '../../conexion.php'; 
 $query=$conexion->prepare("SELECT * FROM portada ORDER BY id ");
 $query->execute();
 $portadas=$query->fetchAll(PDO::FETCH_ASSOC);
 

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


                <h3>Productos</h3>
                    <div class="table-responsive">
                        <table>
                            <thead> 
                                <tr>
                                    
                                    <th>Nombre</th>
                                    <th>Descripcion</th>
                                    <th>Imagen</th>
                                    <th>Estado</th>
                                    <th colspan="2">Operaciones</th>
                                </tr>
                            </thead>
                             <?php foreach ($portadas as  $portada) {?>

                            <tbody>
                                
                                <td><?php echo $portada['nombre']?></td>
                                <td><?php echo $portada['descripcion']?></td>
                                <td class="td-team img"><img src="../../platospng/<?php echo $portada['imagen']?>"></td>
                                
                                <?php  if($portada['estado']=="activo"){?>

                                <td><span class="badge success"><?php echo $portada['estado']?></span></td>

                                <?php }else {?>
                                <td><span class="badge warning"><?php echo $portada['estado']?></span></td>

                                <?php }?>
                                
                                <td><a href="eliminar.php?id=<?php echo 
                                $portada['id'] ?>" ><div class="img-1"></div></a> </td>
                                </td>
                                
                                <td><a href="editar.php?id=<?php echo $portada['id'] ?>"><div class="img-3"></div></a>  </td> 
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
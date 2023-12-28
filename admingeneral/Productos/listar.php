<?php
session_start();
if(!isset($_SESSION['datos_login'])){
    header('Location: ../../login.php');
}

 require '../../conexion.php'; 
 $query=$conexion->prepare("SELECT producto.*, restaurant.nombrer FROM producto,restaurant WHERE      producto.idrestaurant=restaurant.idrestaurant ORDER BY producto.idproducto");
 $query->execute();
 $productos=$query->fetchAll(PDO::FETCH_ASSOC); 
 

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
                    Cerrar sesion
                    
                   </a>
                </div>
            </header>       
            <div class="activity-card ab">  


                <h3>Productos</h3>
                    <div class="table-responsive">
                        <table>
                            <thead>
                                <tr>
                                    <th>Restaurante</th>
                                     <th>Nombre</th>
                                    <th>Descripcion</th>
                                    <th>Precio</th>
                                    <th>Stock</th>
                                    <th>Imagen</th>
                                    <th>Estado</th>
                                    <th>Calificación</th>
                                    <th colspan="2">Operaciones</th>
                                </tr>
                            </thead>
                             <?php foreach ($productos as  $producto) {?>

                            <tbody>
                                <td><?php echo $producto['nombrer']?></td>
                                <td><?php echo $producto['nombre']?></td>
                                <td><?php echo $producto['descripcion']?></td>
                                <td><?php echo $producto['precio']?></td>
                                <td><?php echo $producto['stock']?></td> 
                                <td class="td-team img"><img src="../../platos/<?php echo $producto['imagen']?>"></td>

                                <?php  if($producto['estado']=="activo"){?>

                                <td><span class="badge success"><?php echo $producto['estado']?></span></td>

                                <?php }else {?>
                                 <td><span class="badge warning"><?php echo $producto['estado']?></span></td>

                               <?php }?>
                                <td><i class="fas fa-star" style="color:#efb810"></i><?php echo $producto['calificacion']?></td>
                                <td class="td-team">
                                <a href="eliminar.php?id=<?php echo $producto['idproducto'] ?>" ><div class="img-1"></div></a> 
                                <a href="editar.php?id=<?php echo $producto['idproducto'] ?>"><div class="img-3"></div></a>
                                      
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
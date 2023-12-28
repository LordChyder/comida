<?php
session_start();
if(!isset($_SESSION['datos_login'])){
    header('Location: ../../login.php');
}

 require '../../conexion.php'; 
 $query=$conexion->prepare("SELECT restaurant.*, roles.nombrerol FROM restaurant,roles WHERE restaurant.idrol=roles.idrol ORDER BY restaurant.idrestaurant");
 $query->execute();
 $restaurantes=$query->fetchAll(PDO::FETCH_ASSOC);


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
                <h3>Restaurante</h3>
                    <div class="table-responsive">
                        <table>
                            <thead>
                                <tr>
                                    <th>Nombre</th>
                                    <th>Descripcion</th>
                                    <th>Logo</th>
                                    <th>estatus</th>
                                    <th>estado</th>
                                    <th>Rol</th>
                                    <th>Calificación</th>
                                    <th colspan="2">Operaciones</th>
                                </tr>
                            </thead>
                             <?php foreach ($restaurantes as $restaurant) {?>

                            <tbody>
                                <td><?php echo $restaurant['nombrer']?></td>
                                <td><?php echo $restaurant['descripcionr']?></td>
                                <td class="td-team img"><img src="../../restaurantes/<?php echo $restaurant['imagenr']?>"></td>
                                
                                <td><?php echo $restaurant['estatus']?></td>

                                <?php  if($restaurant['estado']=="activo"){?>

                                <td><span class="badge success"><?php echo $restaurant['estado']?></span></td>

                                <?php }else {?>
                                 <td><span class="badge warning"><?php echo $restaurant['estado']?></span></td>

                               <?php }?>

                                <td><?php echo $restaurant['nombrerol']?></td>
                                <td><i class="fas fa-star" style="color:#efb810"></i><?php echo $restaurant['calificacion']?></td>

                                <td class="td-team">
                                <a href="eliminar.php?id=<?php echo $restaurant['idrestaurant'] ?>" ><div class="img-1"></div></a> 
                                <a href="editar.php?id=<?php echo $restaurant['idrestaurant'] ?>"><div class="img-3"></div></a>
                                      
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
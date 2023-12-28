<?php
session_start();
if(!isset($_SESSION['datos_login'])){
    header('Location: ../../login.php');
}

 require '../../conexion.php'; 

 $idpersona=$_SESSION['datos_login'];
 

 $query=$conexion->prepare("SELECT idrestaurant  FROM restaurant 
                          WHERE idpersona = ?");
 $query->execute(array($idpersona));
 $restaurantes=$query->fetchAll(PDO::FETCH_ASSOC); 

 //$idrestaurante=  $restaurantes['idrestaurant'];

 foreach ($restaurantes as  $restaurante) {
    $idrestaurante1=  $restaurante['idrestaurant'];
   
 }

 $query=$conexion->prepare("SELECT * FROM producto WHERE idrestaurant= ?");
 $query->execute(array($idrestaurante1));
 $productos=$query->fetchAll(PDO::FETCH_ASSOC);

?>


<?php  include ("../templante/cabecera.php"); ?>
    
    
     <div class="main-content">
  <main class="main">
    <a href="registrar.php" class="boton boton-verde">registrar</a>
        <section id="tab3">
            <header>
                <div class="search-wrapper">
                    <span ><i class="fas fa-search"></i></span>
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
                                    <th>Precio</th>
                                    <th>Stock</th>
                                    <th>Imagen</th>
                                    <th>Estado</th>
                                    <th colspan="2">Operaciones</th>
                                </tr>
                            </thead>
                             <?php foreach ($productos as  $producto) {?>

                             <tbody>
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
                                

                                
                                <td><a href="eliminar.php?id=<?php echo 
                                $producto['idproducto'] ?>" ><div class="img-1"></div></a> </td>
                                </td>
                                
                                <td><a href="editar.php?id=<?php echo $producto['idproducto'] ?>"><div class="img-3"></div></a>  </td> 
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
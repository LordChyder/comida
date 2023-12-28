<?php
session_start();
if(!isset($_SESSION['datos_login'])){
    header('Location: ../../login.php');
}

 require '../../conexion.php'; 
 $query=$conexion->prepare("SELECT persona.*, persona.idpersona, roles.nombrerol FROM persona,roles 
              WHERE persona.rol=roles.idrol ORDER BY persona.idpersona");
 $query->execute();
 $personas=$query->fetchAll(PDO::FETCH_ASSOC);
  

 $idpersona=$_SESSION['datos_login'];



 $query=$conexion->prepare("SELECT restaurant.nombrer, restaurant.idrestaurant FROM restaurant  WHERE  idpersona = ?");
 $query->execute(array($idpersona));
 $restaurantes=$query->fetch(PDO::FETCH_ASSOC);

 $idrestaurante1=  $restaurantes['nombrer'];
 $idrestaurantel= $restaurantes['idrestaurant']; 
 
 $query=$conexion->prepare("SELECT * FROM producto WHERE idrestaurant= ?");
 $query->execute(array($idrestaurantel));
 $productos=$query->fetchAll(PDO::FETCH_ASSOC);


 $query=$conexion->prepare("SELECT  producto.nombre as platos,  detallepedido.cantidad, SUM(detallepedido.cantidad) AS cant    FROM pedido, persona, tipopago, detallepedido, producto, restaurant WHERE pedido.idpersona = persona.idpersona AND pedido.tipopago = tipopago.idtipo AND detallepedido.idpedido = pedido.idpedido AND detallepedido.productoid = producto.idproducto AND producto.idrestaurant = restaurant.idrestaurant AND detallepedido.Estado = 'Entregado' AND
restaurant.nombrer = ? GROUP BY producto.nombre ");
$query->execute(array($idrestaurante1));
 $resultados=$query->fetchAll(PDO::FETCH_ASSOC);

 $total=0;
 

?>


<?php  include ("../templante/cabecera.php"); ?>
    
    
     <div class="main-content">
  <main class="main">
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
                <h3>Datos del restaurante</h3>
                    <div class="table-responsive">
                        <table>
                            <thead>
                                <tr>
                                    <th>COMIDA</th>
                                    <th>CANTIDAD</th>
                                    
                                </tr>
                            </thead>
                             <?php foreach ($resultados as $resultado) {?>
                                      
                                <tbody> 
                                    <td><?php echo $resultado['platos']?></td>
                                     
                                    <td><?php echo $resultado['cant'] ?></td> 
                                      
                                </tbody>
                                    
                             <?php }?> 
                             
                        
                            
                        </table>
                    </div>
               </div>
        </section>
    </main>
        
    </div>


<?php  include ("../templante/pie.php"); ?>
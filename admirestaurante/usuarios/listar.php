<?php
session_start();
if(!isset($_SESSION['datos_login'])){
    header('Location: ../../login.php');
}

 require '../../conexion.php'; 
 $query=$conexion->prepare("SELECT persona.*, roles.nombrerol FROM persona,roles 
              WHERE persona.rol=roles.idrol ORDER BY persona.idpersona");
 $query->execute();
 $personas=$query->fetchAll(PDO::FETCH_ASSOC);

 $idpersona=$_SESSION['datos_login'];



 $query=$conexion->prepare("SELECT restaurant.nombrer FROM restaurant  WHERE  idpersona = ?");
 $query->execute(array($idpersona));
 $restaurantes=$query->fetch(PDO::FETCH_ASSOC);

 $idrestaurante1=  $restaurantes['nombrer'];

 $query=$conexion->prepare("SELECT DISTINCT  persona.idpersona,persona.nombre, persona.apellido, persona.celular,persona.gmail,
 persona.usuario,persona.calificacion  FROM pedido, persona, tipopago, detallepedido, producto, restaurant
 WHERE pedido.idpersona = persona.idpersona AND pedido.tipopago = tipopago.idtipo AND detallepedido.idpedido = pedido.idpedido AND
 detallepedido.productoid = producto.idproducto AND detallepedido.Estado = 'Entregado' AND producto.idrestaurant = restaurant.idrestaurant  AND
 restaurant.nombrer = ? ");
 $query->execute(array($idrestaurante1));
 $usuarios=$query->fetchAll(PDO::FETCH_ASSOC);



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
                <h3>Usuarios</h3>
                    <div class="table-responsive">
                        <table>
                            <thead>
                                <tr>
                                    <th>Nombre</th>
                                    <th>Apellido</th>
                                    <th>Usuario</th>
                                    <th>Promedio</th>
                                    <th>Calificar</th>
                                    
                                </tr>
                            </thead>
                             <?php foreach ($usuarios as $usuario) {?>

                            <tbody>
                                <td><?php echo $usuario['nombre']?></td>
                                <td><?php echo $usuario['apellido']?></td>
                                <td><?php echo $usuario['usuario']?></td>
                                <td><i class="fas fa-star" style="color:#efb810"></i><?php echo $usuario['calificacion']?></td>   
                                <td><a href="calificar.php?id=<?php echo 
                                $usuario['idpersona'] ?>" ><div class="img-3"></div></a> </td>
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
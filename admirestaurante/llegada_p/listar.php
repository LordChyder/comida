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



 $query=$conexion->prepare("SELECT restaurant.nombrer FROM restaurant  WHERE  idpersona = ?");
 $query->execute(array($idpersona));
 $restaurantes=$query->fetch(PDO::FETCH_ASSOC);

 $idrestaurante1=  $restaurantes['nombrer'];
   

 $query=$conexion->prepare("SELECT DISTINCT pedido.idpedido, persona.nombre, pedido.monto, tipopago.tipopago, pedido.direccionenvio, pedido.fecha_p
FROM pedido, persona, tipopago, detallepedido, producto, restaurant
WHERE pedido.idpersona = persona.idpersona AND pedido.tipopago = tipopago.idtipo AND detallepedido.idpedido = pedido.idpedido AND
detallepedido.productoid = producto.idproducto AND detallepedido.Estado = 'Entregado' AND producto.idrestaurant = restaurant.idrestaurant  AND
restaurant.nombrer = ? ");
$query->execute(array($idrestaurante1));
 $resultados=$query->fetchAll(PDO::FETCH_ASSOC);


$query=$conexion->prepare("SELECT detallepedido.iddetalle, pedido.fecha_p, detallepedido.fe_entregado, persona.nombre, producto.nombre as Platos, detallepedido.precio, detallepedido.cantidad, pedido.monto, tipopago.tipopago, detallepedido.Estado FROM pedido, persona, tipopago, detallepedido, producto, restaurant WHERE pedido.idpersona = persona.idpersona AND pedido.tipopago = tipopago.idtipo AND detallepedido.idpedido = pedido.idpedido AND detallepedido.productoid = producto.idproducto AND producto.idrestaurant = restaurant.idrestaurant AND detallepedido.Estado = 'Entregado' AND restaurant.nombrer = ?" );
$query->execute(array($idrestaurante1));
 $detalles=$query->fetchAll(PDO::FETCH_ASSOC);


$query=$conexion->prepare("SELECT nombre FROM persona WHERE rol = 3");
$query->execute();
$nombres=$query->fetchAll(PDO::FETCH_ASSOC);

$total=0;
?>

<?php  include ("../templante/cabecera.php"); ?>
    
    
     <div class="main-content">
  <main class="main">
            
        <section id="tab3">
            <header>
                <section>
                <div class="search-wrapper">
                    <span class="ti-search"></span>
                    <input type="search" placeholder="Buscar" name="busqueda" id="busqueda">
                </div>
                </section>
                <div class="social-icons">
                    <a href="../../login/cerrar.php">
                    <i class="fas fa-sign-out-alt"></i>
                    Cerrar sesion</a>
                </div>
            </header>       
            <div class="activity-card ab"> 
                <section class="tabla">                              
                <h3>REPORTE DE TIEMPO DE DEMORA DE LOS PEDIDOS</h3>
                    <div class="table-responsive" id="tabla_resultado">
                       <!--Aqui nuestra tabla consulta -->



<div class="accordion" id="accordionExample">
  <?php foreach ($resultados as $resultado ) {?>
  <div class="accordion-item">
    <h2 class="accordion-header" id="headingOne">
      <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
        <?php echo "NOMBRE: ". $resultado['nombre'] ."  ‎      ‎   ‏‏‎‎"."FECHA DE PEDIDO: ". $resultado['fecha_p']?>

      </button>
    </h2>
    <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
     
        
        
        <table>
                           <tr>
                               <td>CLIENTE</td>
                               <td>COMIDA</td>
                               <td>Fecha entregado</td>  
                         </tr>
    <div class="accordion-body">
                             
                             <?php foreach ($detalles as $detalle ) {?>
                                
                                 <?php if ($detalle['fecha_p']==$resultado['fecha_p']) {?>
              
                             <tr>
                               <td><?php echo $detalle    ['nombre']?></td>
                               <td><?php echo $detalle    ['Platos']?></td>
                               <td><?php echo $detalle    ['fe_entregado']?></td>
                             </tr>
                             
                           
                          <?php }?>
                         <?php }?>  
                            
                       </table>

                       
                    
      </div>
    </div>
    <?php } ?>
  </div>
  
</div>
















                </section>




                    </div>
               </div>
        </section>
    </main>
        
    </div>


<?php  include ("../templante/pie.php"); ?>
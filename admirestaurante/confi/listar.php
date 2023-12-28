<?php
session_start();
if(!isset($_SESSION['datos_login'])){
    header('Location: ../../login.php');
}

 require '../../conexion.php';

 $idpersona=$_SESSION['datos_login'];
 

 $query=$conexion->prepare("SELECT * FROM restaurant WHERE  idpersona = ?");
 $query->execute(array($idpersona));
 $restaurantes=$query->fetchAll(PDO::FETCH_ASSOC);



 if ( count($restaurantes)===0) {
    header('Location:registrar.php');
     
 }

 
 

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
                                    <th>Nombre</th>
                                    <th>Descripccion</th>
                                    <th>Ruc</th>
                                    <th>Logo</th>
                                    <th>Estatus</th>
                                    <th colspan="1">Operaciones</th>
                                </tr>
                            </thead>
                             <?php foreach ($restaurantes as $restaurante) {?>

                            <tbody>
                                <td><?php echo $restaurante['nombrer']?></td>
                                <td><?php echo $restaurante['descripcionr']?></td>
                                <td><?php echo $restaurante['ruc']?></td>

                                <td class="td-team img"><img src="../../restaurantes/<?php echo $restaurante['imagenr']?>"></td>

                                <td><?php echo $restaurante['estatus']?></td>

                                

                                <td><a href="editar.php?id=<?php echo 
                                $restaurante['idrestaurant'] ?>" class="td-team img-3"></td>

                            </tbody>
                            
                        <?php }?>  

                        </table>
                    </div>
               </div>
        </section>
    </main>
        
    </div>


<?php  include ("../templante/pie.php"); ?>
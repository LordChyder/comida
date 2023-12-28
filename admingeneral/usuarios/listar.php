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
                <h3>Usuarios</h3>
                    <div class="table-responsive">
                        <table>
                            <thead>
                                <tr>
                                    <th>Nombre</th>
                                    <th>Apellido</th>
                                    <th>Celular</th>
                                    <th>Gmail</th>
                                    <th>Usuario</th>
                                    <th>Rol</th>
                                    <th>Calificación</th>
                                    <th>Estado</th>
                                    <th colspan="2">Operaciones</th>
                                </tr>
                            </thead>
                             <?php foreach ($personas as $persona) {?>

                            <tbody>
                                <td><?php echo $persona['nombre']?></td>
                                <td><?php echo $persona['apellido']?></td>
                                <td><?php echo $persona['celular']?></td>
                                <td><?php echo $persona['gmail']?></td>
                                <td><?php echo $persona['usuario']?></td>
                                <td><?php echo $persona['nombrerol']?></td>
                                <td><i class="fas fa-star" style="color:#efb810"></i><?php echo $persona['calificacion']?></td>
                                
                                <?php  if($persona['estado']=="activo"){?>

                                <td><span class="badge success"><?php echo $persona['estado']?></span></td>

                                <?php }else {?>
                                <td><span class="badge warning"><?php echo $persona['estado']?></span></td>

                                <?php }?>
                                <td class="td-team">
                                <a href="eliminar.php?id=<?php echo $persona['idpersona'] ?>" ><div class="img-1"></div></a> 
                                <a href="editar.php?id=<?php echo $persona['idpersona'] ?>"><div class="img-3"></div></a>
                                      
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
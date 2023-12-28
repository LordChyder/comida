<?php
session_start();
if(!isset($_SESSION['datos_login'])){
    header('Location: ../../login.php');
}

 require '../../conexion.php'; 


 $idpersona=$_SESSION['datos_login'];
 $idcliente=$_GET['id'];



 $query=$conexion->prepare("SELECT restaurant.nombrer FROM restaurant  WHERE  idpersona = ?");
 $query->execute(array($idpersona));
 $restaurantes=$query->fetch(PDO::FETCH_ASSOC);

 $idrestaurante1=  $restaurantes['nombrer'];

 $query=$conexion->prepare("SELECT * FROM persona WHERE idpersona=?");
 $query->execute(array($idcliente));
 $usuario=$query->fetch(PDO::FETCH_ASSOC);
 
 if(isset($_POST['save'])){
    //require 'conexion.php';
    //echo "Se recibió el mensaje";
    $idcliente=intval($_GET['id']);
    
    $query=$conexion->prepare("SELECT restaurant.idrestaurant FROM restaurant  WHERE  idpersona = ?");
    $query->execute(array($idpersona));
    $restaurantes=$query->fetch(PDO::FETCH_ASSOC);
    $idrestaurante1=  $restaurantes['idrestaurant'];
    
    $rangoIndex=$_POST['rangoIndex'];
    $query = $conexion->prepare("INSERT INTO ratingpersona(idrestaurant,idusuario,calificacion)  
     VALUES(?, ?, ?)" );
    $resultado = $query->execute(array($idrestaurante1, $idcliente,$rangoIndex ));
    //$rangoIndex=$_POST['rangoIndex'];
    }
    $query = $conexion->prepare("SELECT COUNT(id) AS cantidad FROM ratingpersona WHERE idusuario=".$idcliente."");
    $query->execute();
    $cantidades=$query->fetch(PDO::FETCH_ASSOC); 
    $cantidad =$cantidades['cantidad'];
    

    $query = $conexion->prepare("SELECT SUM(calificacion) AS total FROM ratingpersona WHERE idusuario=".$idcliente."");
    $query->execute();
    $totales = $query->fetch(PDO::FETCH_ASSOC); 
    $total = $totales['total']; 
    
    if($cantidad!=0){
        $avg = ($total / $cantidad)+1;
    }else{
        $avg = 0;
    }

    $query = $conexion->prepare("UPDATE persona SET calificacion = ? WHERE idpersona = ?" );
            $resultado = $query->execute(array($avg, $idcliente));
?>


<?php  include ("../templante/cabecera.php"); ?>
    
    
 <div class="main-content">
  <main class="main">
            
        <section id="tab3">
            <header>
            <?php //var_dump($usuario['idpersona']);die; ?>
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
                <h3>Calificación de Usuarios</h3>
                    <div class="table-responsive">
                        <table>
                            <thead>
                                <tr>
                                    <th>Nombre</th>
                                    <th>Apellido</th>
                                    <th>Celular</th>
                                    <th>Gmail</th>
                                    <th>Usuario</th>
                                    
                                    
                                    <th>Calificar</th>
                                </tr>
                            </thead>
                             

                            <tbody>
                                <td><?php echo $usuario['nombre']?></td>
                                <td><?php echo $usuario['apellido']?></td>
                                <td><?php echo $usuario['celular']?></td>
                                <td><?php echo $usuario['gmail']?></td>
                                <td><?php echo $usuario['usuario']?></td>
                                  
                                <td>
                                <div class="calificacion">
                                    
                                <i class="fas fa-star" data-index="0"></i>
                                <i class="fas fa-star" data-index="1"></i>
                                <i class="fas fa-star" data-index="2"></i>
                                <i class="fas fa-star" data-index="3"></i>
                                <i class="fas fa-star" data-index="4"></i>
                                
                                </div>
                                </td>                     
                            </tbody>
                            
                         

                        </table>
                        
                    </div>
                   
               </div>
               <a href="listar.php" class="boton boton-verde">Volver</a>
        </section>
    </main>
        
</div>
    <script>
       var rangoIndex=0, uID = 0;
        var vtemp=0
        $(document).ready(function() {
    
        resetcolor();
    
        $('.fa-star').on('click',function(){
            if(vtemp == 0){
            rangoIndex = parseInt($(this).data('index'))
            alert(rangoIndex)
            grabaenBD();
            vtemp++;
            }
            
            
        })
        $('.fa-star').mouseover(function(){
            resetcolor();
        var totalindex = parseInt($(this).data('index'))
        
        for(var i = 0; i<= totalindex; i++){
            $('.fa-star:eq('+i+')').css('color','yellow')
            
        }
        })
        $('.fa-star').mouseleave(function(){
            resetcolor();
            if(rangoIndex !=-1){
                for(var i = 0; i<= rangoIndex; i++){
                    $('.fa-star:eq('+i+')').css('color','yellow')
                }
            }
            
            
        })
    

       
    });
    function grabaenBD(){
        $.ajax({
            url:"calificar.php?id=<?php echo $usuario['idpersona'];?>",//IMPORTANTE¡¡¡
            method:"POST",
            //dataType:'json',
            data:{
                save:1,
                rangoIndex:rangoIndex
                //idpelicula:idpelicula
            },success:function(r){
                alert("Se envio la calificacion de "+rangoIndex)
                }
        })
    }
    function resetcolor(){
        $('.fa-star').css('color','grey');
    }

    </script>
<?php  include ("../templante/pie.php"); ?>
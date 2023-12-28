<?php 

session_start();
    require 'conexion.php';

    if(isset($_GET['id'])){
    $query = $conexion->prepare("SELECT * FROM restaurant WHERE idrestaurant=? AND 
       estado='activo'" );
    
   $query->execute(array($_GET['id']));
    $restaurante = $query->fetch(PDO::FETCH_ASSOC); 
    }else{
        haeder("Location:index.php");
    }

    if(isset($_POST['save'])){
      //require 'conexion.php';
      //echo "Se recibió el mensaje";

        $idrestaurant=intval($_GET['id']);

        if (isset($_SESSION['datos_login'])) {
               $idpersona=intval($_SESSION['datos_login']);
            }else if(isset($_SESSION['persona'])){
                $idpersona=intval($_SESSION['id']);
               
            }else{

            }
      
      
     
      
      $rangoIndex=$_POST['rangoIndex'];
      $query = $conexion->prepare("INSERT INTO ratingrestaurant(idrestaurant,idusuario,calificacion)  
       VALUES(?, ?, ?)" );
      $resultado = $query->execute(array($idrestaurant, $idpersona,$rangoIndex ));
      //$rangoIndex=$_POST['rangoIndex'];
      }
      $idrestaurant=intval($_GET['id']);
      //var_dump($_GET['id']);
      //var_dump($_SESSION['datos_login']);die;
    $query = $conexion->prepare("SELECT COUNT(id) AS cantidad FROM ratingrestaurant WHERE idrestaurant=".$idrestaurant."");
    $query->execute();
    $cantidades=$query->fetch(PDO::FETCH_ASSOC); 
    $cantidad =$cantidades['cantidad'];
    

    $query = $conexion->prepare("SELECT SUM(calificacion) AS total FROM ratingrestaurant WHERE idrestaurant=".$idrestaurant."");
    $query->execute();
    $totales = $query->fetch(PDO::FETCH_ASSOC); 
    $total = $totales['total']; 
    
    if($cantidad!=0){
        $avg = ($total / $cantidad)+1;
    }else{
        $avg = 0;
    }

    $query = $conexion->prepare("UPDATE restaurant SET calificacion = ? WHERE idrestaurant = ?" );
            $resultado = $query->execute(array($avg, $idrestaurant));
?>





<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Descripción del restaurante</title>
	<link rel="stylesheet" type="text/css" href="css/estilos.css">
    <link  href="iconos/restaurante.png" rel="shortcut icon"/>
	<script type="text/javascript" src="js/jquery-3.6.0.min.js"></script>
    <script type="text/javascript" src="js/script.js"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous">
</head>
<body>
	<?php include 'reducido/header.php' ?>
  <section class="platos" id="platos">
        <h3 class="platos-cabecera"><?php echo $restaurante['nombrer']?></h3>
        <?php if(isset($_SESSION['persona']) ||isset($_SESSION['datos_login'])){ ?>
        <div class="calificacion">
            <h4>Puede calificar nuestro restaurante: </h4>
        <i class="fas fa-star" data-index="0"></i>
        <i class="fas fa-star" data-index="1"></i>
        <i class="fas fa-star" data-index="2"></i>
        <i class="fas fa-star" data-index="3"></i>
        <i class="fas fa-star" data-index="4"></i>
        <h4>Este Restaurante tiene un promedio de:<?php echo round($avg,precision : 2) ?><i class="fas fa-star"></i></h4>
        </div>
        <?php } ?>
       
      <div class="caja-master">
          <h3>Descripción</h3>   
            <div class="caja-contenedora">

                    <div class="caja">

                      <h6><?php echo $restaurante['descripcionr']?></h6>             
                                            
                    </div>
                 
            </div>
            
            
        </div>  

        <div class="caja-master">
          <h3 >Metas de la empresa</h3>   
            <div class="caja-contenedora">
            	      <div class="caja1">
                      <h3>Vision</h3>
                      <div class="caja">
                      
                      <h6> <?php echo $restaurante['vision']?><h6>             
                                              
                      </div>
                    </div>
                    <div class="caja2">
                      <h3>Mision</h3>
                      <div class="caja">

                        <h6><?php echo $restaurante['mision']?><h6>           
                                              
                      </div>
                    </div>
                 
                   
                 
            </div>
            
            
            
        </div>
           


            

      
    </section>
    

 <?php include 'reducido/footer.php' ?>
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
            url:"detallerestaurate.php?id=<?php echo $restaurante['idrestaurant'];?>",//IMPORTANTE¡¡¡
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
    
</body>
</html>
<?php 
    session_start();
    require 'conexion.php';
    if(isset($_GET['id'])){
    $query = $conexion->prepare("SELECT * FROM producto WHERE idproducto=".$_GET['id']);
    
    $query->execute();
    $platos = $query->fetch(PDO::FETCH_ASSOC); 
    }else{
        haeder("Location:index.php");
    }
  
    if(isset($_POST['save'])){
        //require 'conexion.php';
        //echo "Se recibió el mensaje";
        $idproducto=intval($_GET['id']);
       if (isset($_SESSION['datos_login'])) {
               $idpersona=intval($_SESSION['datos_login']);
            }else if(isset($_SESSION['persona'])){
                $idpersona=intval($_SESSION['id']);
               
            }else{

            }

        $rangoIndex=$_POST['rangoIndex'];
        $query = $conexion->prepare("INSERT INTO rating(idplato,calificacion,idpersona)  
         VALUES(?, ?, ?)" );
        $resultado = $query->execute(array($idproducto, $rangoIndex,$idpersona ));
        //$rangoIndex=$_POST['rangoIndex'];
        }
    
        /*var_dump(intval($_SESSION['datos_login']));
        var_dump($_GET['id']);die;*/


    require 'conexion.php';
    if(isset($_GET['id'])){
    $query = $conexion->prepare("SELECT restaurant.* FROM producto, restaurant WHERE producto.idrestaurant = restaurant.idrestaurant AND producto.idproducto=".$_GET['id']);
    
    $query->execute();
    $f = $query->fetch(PDO::FETCH_ASSOC); 
    }else{
        haeder("Location:index.php");
    }
    $idplato=intval($_GET['id']);
    $query = $conexion->prepare("SELECT COUNT(id) AS cantidad FROM rating WHERE idplato=".$idplato."");
    $query->execute();
    $cantidades=$query->fetch(PDO::FETCH_ASSOC); 
    $cantidad =$cantidades['cantidad'];
    

    $query = $conexion->prepare("SELECT SUM(calificacion) AS total FROM rating WHERE idplato=".$idplato."");
    $query->execute();
    $totales = $query->fetch(PDO::FETCH_ASSOC); 
    $total = $totales['total']; 
    
    if($cantidad!=0){
        $avg = ($total / $cantidad)+1;
    }else{
        $avg = 0;
    }

    $query = $conexion->prepare("UPDATE producto SET calificacion = ? WHERE idproducto = ?" );
            $resultado = $query->execute(array($avg, $idplato));
    ?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Satisfy&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/c8e4d183c2.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" type="text/css" href="css/estilos.css">
    <script type="text/javascript" src="js/jquery-3.6.0.min.js"></script>
    <script type="text/javascript" src="js/script.js"></script>
    <title>Detalle de Producto</title>
</head>
<body class="detalle_plato">

<h1 class="detalle_letra2"><?php echo $f['nombrer']?></h1>
    
    <?php include 'reducido/header.php' ?>

     <section class="detalle_section">
        <div class="carta_plato">

            <div class="imagen_plato">

                <h2 class="detalle_letra">Detalle del Plato</h2>
                <h3><?php echo $platos['nombre']?></h3>
                <img src="platos/<?php echo $platos['imagen']?>" alt="">
            </div>
            <div class="detalle_plato">
                <h2><?php echo $platos['nombre']?></h2>
                <p><?php echo $platos['descripcion']?></p>
                
            </div>
    
        </div> 
     </section>
     <aside class="detalle_aside">

      
        
        
        <h1>Descripcion del Restaurant: </h1> 
        <h3 class="justificar"><?php echo $f['descripcionr']?> </h3>
         


        <div class="">
        <h3 >Precio: <span ><?php echo $platos['precio'];?></span><br></h3>
        
        <h3>Quedan: <span><?php echo $platos['stock'];?></span><br></h3>
        <?php if(isset($_SESSION['persona']) ||isset($_SESSION['datos_login'])){ ?>
        <div class="calificacion">
            <h4>Puede calificar nuestro plato: </h4>
        <i class="fas fa-star" data-index="0"></i>
        <i class="fas fa-star" data-index="1"></i>
        <i class="fas fa-star" data-index="2"></i>
        <i class="fas fa-star" data-index="3"></i>
        <i class="fas fa-star" data-index="4"></i>
        <h4>Este plato tiene un promedio de:<?php echo round($avg,precision : 2) ?><i class="fas fa-star"></i></h4>
        </div>
        <?php } ?>
        <a href="carritocompras.php?id=<?php echo $platos['idproducto'] ?>" class="abrirM">COMPRAR AHORA</a>
        <h1> ㅤ</h1>


        <a href="index.php" class="abrirM">VOLVER</a>

        
        </div>
         
      </aside>
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
            url:"detalles.php?id=<?php echo $platos['idproducto'];?>",//IMPORTANTE¡¡¡
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
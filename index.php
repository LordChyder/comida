<?php 
session_start();
header("Set-Cookie: cross-site-cookie=whatever; SameSite=Strict; Secure");
    require 'conexion.php';
    $query = $conexion->prepare("SELECT * FROM portada  WHERE estado='activo' ORDER BY id ASC LIMIT 3");
    $query->execute();
    $portadas = $query->fetchAll(PDO::FETCH_ASSOC); 

    $query = $conexion->prepare("SELECT * FROM producto WHERE estado='activo'");

    $query->execute();
    $platos = $query->fetchAll(PDO::FETCH_ASSOC); 

    $query = $conexion->prepare("SELECT * FROM restaurant WHERE estado='activo'");

    $query->execute();
    $rest = $query->fetchAll(PDO::FETCH_ASSOC); 

    $query = $conexion->prepare("SELECT * FROM testimonios WHERE estado='activo' ORDER BY idtestimonio DESC LIMIT 3");

    $query->execute();
    $testimonios = $query->fetchAll(PDO::FETCH_ASSOC); 
    
    
?>
<!DOCTYPE html>
<html>
<head>
    <meta name="vierport" content="width=divice-width,initial-sacale=1, user-scalable=no">
	<meta charset="utf-8">
	<title>Carrito de Compras</title>
	<link rel="stylesheet" type="text/css" href="css/estilos.css">
    <link  href="iconos/restaurante.png" rel="shortcut icon"/>
    
    <script type="text/javascript" src="js/jquery-3.6.0.min.js"></script>
    <script type="text/javascript" src="js/script.js"></script>
	
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous">


	
	

</head>
<body>
    <?php include 'reducido/header.php' ?>
    
    <section class="portada">
       <div class="contenedorSLD">
                <div class="sliders activo" id="sld">
                        <div class="contenidoSLD">
                            <span>Tallarines con Queso</span>
                            <P>Los tallarines es uno de los alimentos más versátiles, pues podemos disfrutarlo con cualquier salsa y acompañarla tanto de carne como de pescado.</P>
                            <a href="#" class="abrirM">COMPRAR AHORA</a>
                        </div>
                        <div class="imagenPortada">
                            <img src="img_slider/slider1.png" alt="">
                        </div>
                        
                </div>
                <?php foreach($portadas as $portada) { ?>
                <div class="sliders">
                    <div class="contenidoSLD">
                        <span><?php echo $portada['nombre']?></span>
                        <p><?php echo $portada['descripcion']?></p>
                        <a href="#" class="abrirM">COMPRAR AHORA</a>
                    </div>
                        <div class="imagenPortada">
                            <img src="platospng/<?php echo $portada['imagen']?>" alt="">
                        </div>
                        
                </div>
                <?php } ?>
                <span id="adelante"><img src="/img/iradelante1.png" alt=""></span>
                <span id="atras"><</span>
        </div>
    </section>
   


    <?php //include 'reducido/formLogin.php' ?>
    <div class="contenedor">
        <h3 class="texto1">!Pide todo en el mismo lugar¡</h3>
        <h2 class="texto2">Los mejores platos reginales que podrás encontrar, solo en <span class="texto3">MISHKY MIKUNA</span></h2>
        <a class="abrirM btnM" href="#">Ver Más</a>
        <video class="videobg" src="./videos/v1.mp4" autoplay loop muted></video>
        
        <?php include 'modal/modal.php'; ?>
    </div>
    <section class="platos" id="platos">
        <h3 class="platos-cabecera">Nuestros platos</h3>
       
        <?php foreach($rest as $restaurante){ ?>
        <div class="caja-master">
        
        
          <a href="detallerestaurate.php?id=<?php echo $restaurante['idrestaurant'] ?>"><h1 class="cabecera"><?php echo $restaurante['nombrer']?></h1></a>   
            <div class="stars"><?php if($restaurante['calificacion']!=0){?>
                <h3>Calificación de Restaurante:<?php echo $restaurante['calificacion'] ?><i class="fas fa-star" style="color:yellow"></i></h3>
                <?php }else{?>
                <h3>No tiene calificación <i class="fas fa-star" style="color:yellow"></i></h3>
                <?php } ?>
            </div>
        
        
            <div class="caja-contenedora">
        
            <?php  foreach($platos as $plato){ ?>
                <?php if($restaurante['idrestaurant']==$plato['idrestaurant']){?>
                    <div class="caja">
                    
                                    
                        <a href="#" class="fas fa-heart"></a>
                        <a href="#" class="fas fa-eye"></a>
                        <img src="./platos/<?php echo $plato['imagen'] ?>" alt="">
                        <h3><?php echo $plato['nombre'] ?></h3>
                        <div class="stars"><?php if($plato['calificacion']!=0){?>
                            <h3>Calificación:<?php echo $plato['calificacion'] ?><i class="fas fa-star" style="color:yellow"></i></h3>
                            <?php }else{?>
                            <h3>No tiene calificación <i class="fas fa-star" style="color:yellow"></i></h3>
                            <?php } ?>
                        </div>
                        <span>S/<?php echo $plato['precio'] ?></span>
                        <a href="detalles.php?id=<?php echo $plato['idproducto'] ?>" class="abrirM">Ver Más</a>
                    
                    </div>
                    <?php }?>
            <?php }?>
            </div>
            
            
        </div>
        <?php }?>
            

      
    </section>
    <div class="testimonios">
    <?php  foreach($testimonios as $test){ ?>
        <div class="caja-test">
            <span></span>
            <div class="escri-test">
            <h2>Autor:<?php echo $test['autor'] ?> </h2>
                <p><?php echo $test['descripcion'] ?> 
                </p>
                    <h3>Fecha: <?php echo $test['fecha'] ?></h3>
            </div>
        </div>
    <?php }?>
    
    </div>

    <section>
    <?php include 'testimonios/registrar.php' ?>
    </section>
    <div>
    <?php include 'reducido/footer.php' ?>
    </div>
    <?php /*include 'reducido/formLogin.php'*/ ?>
    <!--<div class="contenedor">
        <a href="#" class="abrirM">Abrir Modal</a>
        <?php /*include 'modal/modal.php'*/ ?>
    </div>-->
    <!-- jquery link  -->

</body>
</html>
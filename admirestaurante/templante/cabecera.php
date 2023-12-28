<?php


 $idpersona=$_SESSION['datos_login'];

 $query=$conexion->prepare("SELECT  nombrer FROM restaurant 
                          WHERE idpersona = ?");
 $query->execute(array($idpersona));
 $resl=$query->fetchAll(PDO::FETCH_ASSOC);

 //$idrestaurante=  $restaurantes['idrestaurant'];
 
 foreach ($resl as  $res) {
    
    $nombreresl= $res['nombrer']; 
   
 }

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1">
    <title>Admistrador de Restaurante</title>
    
     <link  href="../../iconos/restaurante.png" rel="shortcut icon"/>



    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    
    <link rel="stylesheet" href="../../css/style.css">
    <script type="text/javascript" src="../../js/jquery-3.6.0.min.js"></script>
    
    
   
   
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous">


    <!-- https://themify.me/themify-icons -->
</head>
<body>
   
    <input type="checkbox" id="sidebar-toggle">
    <div class="sidebar">
        <div class="sidebar-header">
            <h3 class="brand"> <br><br>
                <span class="span1"><i class="fas fa-shipping-fast"></i></span> 
                <span ><?php echo $nombreresl ?></span>
            </h3> 
            <label for="sidebar-toggle" ><i class="fas fa-bars"></i></label>
        </div> <br><br>

        
       </style>
        <div class="sidebar-menu">
            <ul class="tabs">
                <li>
                    <a href="../confi/listar.php">
                        <span><i class="fas fa-cog"></i></span>
                        <span >configuracion</span>
                    </a>
                </li>
            
                <li>
                    <a href="../Productos/listar.php">
                        <span ><i class="fas fa-drumstick-bite"></i></span>
                        <span>Productos</span>
                    </a>
                </li>
                <li>
                    <a href="../pedidos/listar.php">
                        <span ><i class="fas fa-shopping-cart"></i></span>
                        <span>Pedidos</span>
                    </a>
                </li>
                <li>
                    <a href="../historial/listar.php">
                        <span ><i class="fas fa-history"></i></span>
                        <span>Historial</span>
                    </a>
                </li>
                <li>
                    <a href="../llegada_p/listar.php">
                        <span ><i class="fas fa-luggage-cart"></i></span>
                        <span>Tiempo de llegada de productos</span>
                    </a>
                </li>
                 <li>
                    <a href="../reporte_fav/listar.php">
                        <span ><i class="fas fa-thumbs-up"></i></span>
                        <span>Reporte de favoritos</span>
                    </a>
                </li>
                <li>
                    <a href="../usuarios/listar.php">
                        <span ><i class="fas fa-users"></i></span>
                        <span>Usuarios que compraron</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
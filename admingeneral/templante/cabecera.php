<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1">
    <title>Admistrador de General</title>
    
    <link rel="stylesheet" href="../../css/style.css">
    
    <link  href="../../iconos/restaurante.png" rel="shortcut icon"/>
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous">
    <!-- https://themify.me/themify-icons -->
</head>
<body>
   
    <input type="checkbox" id="sidebar-toggle">
    <div class="sidebar">
        <div class="sidebar-header">
            <h3 class="brand">
                <span class="span1"><i class="fab fa-drupal"></i></span> 
                <span style="font-size: 22px;">Mishki Mikuna</span>
            </h3> 
            <label for="sidebar-toggle" ><i class="fas fa-bars"></i></label>
        </div> 
        
        <div class="sidebar-menu">
            <ul class="tabs">
                <li>
                    <a href="../usuarios/listar.php">
                        <span><i class="fas fa-user-tie"></i></span>
                        <span>Usuarios</span>
                    </a>
                </li>
                <li>
                    <a href="../restaurantes/listar.php">
                        <span><i class="fas fa-utensils"></i></span>
                        <span>Restaurantes</span>
                    </a>
                </li>
                <li>
                    <a href="../Productos/listar.php">
                        <span><i class="fas fa-drumstick-bite"></i></span>
                        <span>Productos</span>
                    </a>
                </li>
                <li>
                    <a href="../Testimonios/listar.php">
                        <span><i class="fas fa-file-alt"></i></span>
                        <span>Testimonios</span>
                    </a>
                </li>
                <li>
                    <a href="../portada/listar.php">
                        <span><i class="fas fa-portrait"></i></span>
                        <span>Portada</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
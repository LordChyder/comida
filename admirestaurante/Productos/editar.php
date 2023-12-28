<?php 
    session_start();
	if(!isset($_SESSION['datos_login'])){
	    header('Location: ../../login.php'); 
	}
    require '../../conexion.php';

     if($_SERVER["REQUEST_METHOD"] == "POST"){

         
         $nombre = $_POST['nombre'];
         $descripcion = $_POST['descripcion']; 
         $precio = $_POST['precio'];
         $stock = $_POST['stock'];
        // $imagen = $_FILES['imagen']['name'];
         
         
         $idproducto=$_POST['id'];
         //var_dump($imagen  );die;

        
        if ($_FILES['imagen']['name'] == "") {
        	
        
       $query = $conexion->prepare("UPDATE producto SET  nombre = ?, descripcion = ?, precio = ?, stock = ?  WHERE idproducto  = ?"
        );
        $resultado = $query->execute(array($nombre, $descripcion, $precio, $stock, $idproducto));

        }else {
        	$imagen = $_FILES['imagen']['name'];
            move_uploaded_file($_FILES['imagen']['tmp_name'], "../../restaurantes/".$_FILES["imagen"]["name"]);

            $query = $conexion->prepare("UPDATE producto SET  nombre = ?, descripcion = ?, precio = ?, imagen = ?, stock = ? WHERE idproducto  = ?"
        );
        $resultado = $query->execute(array($nombre, $descripcion, $precio, $imagen, $stock,$idproducto));


       }


        if($resultado){
            header('Location:listar.php');
        }

       
    }
    else{


    	 $id = $_GET['id'];
        $query = $conexion->prepare("SELECT * FROM producto WHERE idproducto = ?");
        $query->execute(array($id));
        $producto= $query->fetch(PDO::FETCH_ASSOC);


        $query = $conexion->prepare("SELECT idrestaurant,nombrer FROM restaurant");
        $query->execute();
        $restaurantes = $query->fetchAll(PDO::FETCH_ASSOC);
 

    }
    
?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Editar Productos</title>
		<link rel="stylesheet" type="text/css" href="../../css/estilos2.css">
		<link rel="stylesheet" type="text/css" href="../../css/styleregistroadmin.css">
		<script type="text/javascript" src="../../js/jquery-3.6.0.min.js"></script>
		<script type="text/javascript" src="../../js/script.js"></script>							
	</head>
	<body>
		<div>
		<nav>
			<div class="logo">
				<img src="../../iconos/log.png" >
			</div>
			<ul>
				<li><a href="index.php" >Menú</a></li>
				
				<li><a href="#" class="active">Carrito
					
				</a></li>
			</ul>
		</nav>
		</div><br><br><br><br>
	<div class="registro">
		<img class="logo-registro" src="../../iconos/utencilios.png" alt="Logo registro">
		<h1>Editar Productos</h1>
		<form method="post" enctype="multipart/form-data">
			
		 <input type="hidden"  name="id" value="<?php echo $producto['idproducto']?>">
			

		
			<!---Nombre del palto--->
			<div class="contenedor">
				<label> Nombre <span class="text-danger">*</span> </label>
				<input type="text" name="nombre" value="<?php echo $producto['nombre']?>">
			</div>
			<!---Descripcion--->
			<div class="contenedor">
				<label>Descripcion <span class="text-danger">*</span> </label>
				<textarea rows="10" cols="48" name="descripcion"><?php echo $producto['descripcion']?></textarea>
			</div>
			<!---Precio--->
			<div class="contenedor">
				<label> Precio <span class="text-danger">*</span> </label>
				<input type="number" name="precio" value="<?php echo $producto['precio']?>">
			</div>
			<!---Stock--->
			<div class="contenedor">
				<label> Stock <span class="text-danger">*</span> </label>
				<input type="number" name="stock" value="<?php echo $producto['stock']?>">
			</div>

             <img  class="imagen1" src="../../platos/<?php echo $producto['imagen']?>">
			<!---imagen--->
			<div class="contenedor">
				<label> Imagen<span class="text-danger">*</span> </label>
				<input type="file"  placeholder="Ingresa tu imagen" name="imagen">
			</div>
			
				<input type="submit" value="GUARDAR">
			</div>
			<p><a class="link" href="listar.php">Cancelar</a></p>
		</form>
		
	</div>
	

</body>
</html>
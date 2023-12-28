<?php 
    session_start();
	if(!isset($_SESSION['datos_login'])){
	    header('Location: ../../login.php');
	}
    require '../../conexion.php';

     if($_SERVER["REQUEST_METHOD"] == "POST"){

         $idrestaurant= $_POST['idrestaurant'];
         $nombre = $_POST['nombre'];
         $descripcion = $_POST['descripcion']; 
         $precio = $_POST['precio'];
         $stock = $_POST['stock'];
         $estado = $_POST['estado'];
         
         $idproducto=$_POST['id'];
		 $imagen =$_FILES['imagen']['name'];
        
        if ($_FILES['imagen']['name'] == "") {
        	
        
       $query = $conexion->prepare("UPDATE producto SET idrestaurant = ?, nombre = ?, descripcion = ?, precio = ?, stock = ?, 	estado = ? WHERE idproducto  = ?"  );
        $resultado = $query->execute(array($idrestaurant,$nombre, $descripcion, $precio, $stock, $estado, $idproducto));

        }else {
        	$imagen =$_FILES['imagen']['name'];
            move_uploaded_file($_FILES['imagen']['tmp_name'], '../../platos/'.$_FILES['imagen']['name']);

            $query = $conexion->prepare("UPDATE producto SET idrestaurant = ?, nombre = ?, descripcion = ?, precio = ?, imagen = ? ,stock = ?, estado = ? WHERE idproducto  = ?");
        $resultado = $query->execute(array($idrestaurant,$nombre, $descripcion, $precio, $imagen, $stock, $estado, $idproducto));


       }


        if($resultado){
            header('Location:listar.php');
        }

       
    }
    


    	 $id = $_GET['id'];
        $query = $conexion->prepare("SELECT * FROM producto WHERE idproducto = ?");
        $query->execute(array($id));
        $producto= $query->fetch(PDO::FETCH_ASSOC);


        $query = $conexion->prepare("SELECT idrestaurant,nombrer FROM restaurant");
        $query->execute();
        $restaurantes = $query->fetchAll(PDO::FETCH_ASSOC);
 

    
    
?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Registrar usuario</title>
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
				<li><a href="#">Más información</a></li>
				<li><a href="#">Contacto</a></li>
				<li><a href="#" class="active">Carrito
					
				</a></li>
			</ul>
		</nav>
		</div>
	<div class="registro">
		<img class="logo-registro" src="../../iconos/restaurant.png" alt="Logo registro">
		<h1>Editar</h1>
		<form method="post" enctype="multipart/form-data">
			
		 <input type="hidden"  name="id" value="<?php echo $producto['idproducto']?>">
			

			<!---Restaurante--->
			<select class="user-input" name="idrestaurant">
				<?php foreach($restaurantes as $restaurante) {
                        if($restaurante['idrestaurant'] == $producto['idrestaurant']){
                    ?>
                        <option selected value="<?php echo $restaurante['idrestaurant']?>"><?php echo $restaurante['nombrer']?></option>
                    <?php 
                        }
                        else{ 
                    ?>
                        <option value="<?php echo $restaurante['idrestaurant']?>"><?php echo $restaurante['nombrer']?></option>   
                    <?php 
                        } 
                    } ?>

             </select>
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

             <img class="imagen1" src="../../platos/<?php echo $producto['imagen']?>">
			<!---imagen--->
			<div class="contenedor">
				<label> Imagen<span class="text-danger">*</span> </label>
				<input type="file"  placeholder="Ingresa tu imagen" name="imagen">
			</div>
			<!---estado--->
           <div class="contenedor">
           	<label> Estado <span class="text-danger">*</span> </label><br>
	           <select name="estado">

	           	<?php if ($producto['estado']== "activo") {?>
	           		     <option selected value="activo">activo</option>	
	           	          <option value="inactivo">inactivo</option>
                 
	            <?php  	}else if ($producto['estado']== "inactivo") {?>
	         	
                           <option value="activo">activo</option>	
	           	          <option selected value="inactivo">inactivo</option>

	        <?php }else{ } ?>
	           </select>
           </div>
			
			         
			<div>
				<input type="submit" value="GUARDAR">
			</div>
			<p><a class="link" href="listar.php">Cancelar</a></p>
		</form>
		
	</div>
	

</body>
</html>
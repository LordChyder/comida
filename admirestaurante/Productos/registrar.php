
<?php 
    session_start();
	if(!isset($_SESSION['datos_login'])){
	    header('Location: ../../login.php'); 
	}

    require '../../conexion.php';

    if($_SERVER["REQUEST_METHOD"] == "POST"){
   $idpersona=$_SESSION['datos_login'];
 

 $query=$conexion->prepare("SELECT idrestaurant  FROM restaurant 
                          WHERE idpersona = ?");
 $query->execute(array($idpersona));
 $restaurantes=$query->fetchAll(PDO::FETCH_ASSOC);


 foreach ($restaurantes as  $restaurante) {
    $idrestaurante1=  $restaurante['idrestaurant'];  
 }


         $nombre = $_POST['nombre'];
         $descripcion = $_POST['descripcion'];
         $precio = $_POST['precio'];
         $estock= $_POST['estock'];
         $imagen = $_POST['imagen'];        


        
         $imagen = $_FILES['imagen']['name'];
            move_uploaded_file($_FILES['imagen']['tmp_name'], "../../platos/".$_FILES["imagen"]["name"]);

      $query = $conexion->prepare("INSERT INTO producto(idrestaurant, nombre,descripcion,precio,stock,imagen)        VALUES(?, ?, ?, ?, ?, ?)"
        );
        $resultado = $query->execute(array($idrestaurante1, $nombre, $descripcion, 
        	$precio, $estock,$imagen));

        if($resultado){
            header('Location:listar.php');
        }


    }


    
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
				<li><a href="#" class="active">Carrito
					
				</a></li>
			</ul>
		</nav>
		</div>
	<div class="registro">
		<img class="logo-registro" src="../../iconos/utencilios.png" alt="Logo registro">
		<h1>Productos</h1>
		<form method="post" enctype="multipart/form-data">

			<!---Nombre--->
			<div class="contenedor">
				<label> Nombre <span class="text-danger">*</span> </label>
				<input type="text" required placeholder="Tu nombre" name="nombre">
			</div>
			<!---Descripcion--->
			<div class="contenedor">
				<label>Descripcion <span class="text-danger">*</span> </label>
				<textarea rows="10" cols="48"equired placeholder="Descripcion" 
				name="descripcion"></textarea>
			</div>

			<!---Precio--->
			<div class="contenedor">
				<label> Precio <span class="text-danger">*</span> </label>
				<input type="number" required placeholder="Ingresa el precio" 
				name="precio">
			</div>
			<!---estock--->
			<div class="contenedor">
				<label> Estock <span class="text-danger">*</span> </label>
				<input type="number" required placeholder="Ingresa estock" 
				name="estock">
			</div>
           
			<!---Imagen--->
			<div class="contenedor">
				<label> Imagen<span class="text-danger">*</span> </label>
				<input type="file" required placeholder="Ingresa la imagen" 
				name="imagen">
			</div>

			<div>
				<input type="submit" value="REGISTRARSE">
			</div>
			<p><a class="link" href="listar.php">Cancelar</a></p>
		</form>
		
	</div>
	

</body>
</html>
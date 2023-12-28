
<?php 
    session_start();
	if(!isset($_SESSION['datos_login'])){
	    header('Location: ../../login.php');
	}

    require '../../conexion.php';

    if($_SERVER["REQUEST_METHOD"] == "POST"){

         $nombre = $_POST['restaurante'];
         $descripcion = $_POST['descripcion'];
         $ruc = $_POST['ruc'];
         //$logo = $_POST['logo'];        
         $estatus= $_POST['estatus'];
         $idrol=2;
         $idpersona=$_SESSION['datos_login'];
         $logo = $_FILES['logo']['name'];
        
            //move_uploaded_file($_FILES['logo']['tmp_name'], $logo);
            move_uploaded_file($_FILES['logo']['tmp_name'], "../../restaurantes/".$_FILES["logo"]["name"]);
   
      


      $query = $conexion->prepare("INSERT INTO restaurant
      	(nombrer,descripcionr,ruc,imagenr,estatus,idrol,idpersona)        
      	 VALUES(?, ?, ?, ?, ?, ?, ?)" );
        $resultado = $query->execute(array($nombre, $descripcion,$ruc, $logo,$estatus,
        	$idrol,$idpersona));

        if($resultado){
            header('Location:listar.php');
        }


    }
    
?>


<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Registrar Restaurante</title>
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
		<img class="logo-registro" src="../../iconos/registrousuario.jpg" alt="Logo registro">
		<h1>Registrate</h1>
		<form method="post" enctype="multipart/form-data">

			<!---Nombre restaurante--->
			<div class="contenedor">
				<label> Restaurante <span class="text-danger">*</span> </label>
				<input type="text" placeholder="Tu nombre" name="restaurante" required>
			</div>
			<!---Descripcion--->
			<div class="contenedor">
				<label>Descripcion <span class="text-danger">*</span> </label>
				<textarea rows="10" cols="48"equired placeholder="Descripcion" 
				name="descripcion"></textarea>
			</div>
			<!---ruc--->
			<div class="contenedor">
				<label> Ruc <span class="text-danger">*</span> </label>
				<input type="text" maxlength="11" minlength="11" pattern="[0-9]+" 
				placeholder="Ingresa tu ruc" name="ruc" required>
			</div>
			<!---Logo--->
			<div class="contenedor">
				<label> Logo<span class="text-danger">*</span> </label>
				<input type="file" required placeholder="Ingresa tu logo" name="logo">
			</div>
			<!---estatus--->
			<div class="contenedor">
				<label> estatus <span class="text-danger">*</span> </label>
				<input type="number" required placeholder="Ingresa tu estatus" 
				name="estatus">
			</div>

			
			<div>
				<input type="submit" value="REGISTRARSE">
			</div>
			<p>¿Ya tienes una cuenta? <a class="link" href="login.php"> Inicia sesión</a></p>
		</form>
		
	</div>
	

</body>
</html>
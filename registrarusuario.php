<?php 

    require 'conexion.php';

    if($_SERVER["REQUEST_METHOD"] == "POST"){

         $nombre = $_POST['nombre'];
         $apellido = $_POST['apellido'];
         $dni = $_POST['dni']; 
         $direccion = $_POST['direccion'];        
         $celular= $_POST['celular'];
         $gmail= $_POST['gmail'];
         $usuario = $_POST['usuario'];
         $password= $_POST['password'];
         $rol=3;
      $query = $conexion->prepare("INSERT INTO persona(nombre,apellido,dni,direccion,celular,gmail,usuario,password,rol) 
      	                         VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?)"
        );
        $resultado = $query->execute(array($nombre, $apellido, $dni, $direccion,$celular, $gmail, $usuario, $password, $rol));

        if($resultado){
            header('Location: login.php');
        }


    }


?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Registrar usuario</title>
		<link rel="stylesheet" type="text/css" href="css/estilos2.css">
		<link rel="stylesheet" type="text/css" href="css/styleregistroadmin.css">
		<link  href="iconos/restaurante.png" rel="shortcut icon"/>
		<script type="text/javascript" src="js/jquery-3.6.0.min.js"></script>
		<script type="text/javascript" src="js/script.js"></script>
	
	</head>
	<body>
		<div>
		<nav>
			<div class="logo">
			<a href="index.php" ><img src="iconos/log.png" ></a>
			</div>
			<ul>
				<li><a href="index.php" >Menú</a></li>
				<li><a href="carritocompras.php" class="active">Carrito
					
				</a></li>
			</ul>
		</nav>
		</div>

	<div class="registro">
		
		<img class="logo-registro" src="iconos/registrousuario.jpg" alt="Logo registro">
		<h1>Registre de Usuario</h1>

		<form method="post">
			<!---Nombre--->
			<div class="contenedor">
				<label> Nombre <span class="text-danger">*</span> </label>
				<input type="text" placeholder="Tu nombre" name="nombre" required>
			</div>
			<!---Apellidos--->
			<div class="contenedor">
				<label> Apellido <span class="text-danger">*</span> </label>
				<input type="text"  placeholder="Tu apellido" name="apellido" required>
			</div>
			<!---DNI--->
			<div class="contenedor">
				<label> Dni <span class="text-danger">*</span> </label>
				<input type="text" maxlength="8" minlength="8" pattern="[0-9]+" 
				placeholder="Ingresa tu Dni" name="dni" required>
			</div>
			<!---Dirección--->
			<div class="contenedor">
				<label> Dirección <span class="text-danger">*</span> </label>
				<input type="text" placeholder="Ingresa tu dirección" name="direccion" required>
			</div>
			<!---Celular--->
			<div class="contenedor">
				<label> Celular <span class="text-danger">*</span> </label>
				<input type="tel" placeholder="Ingresa tu celular" maxlength="9" minlength="9" 
				 name="celular" required>
			</div>

			<!---Correo--->
			<div class="contenedor">
				<label> Correo <span class="text-danger">*</span> </label>
				<input type="email" placeholder="Ingresa tu correo" name="gmail" required>
			</div>

			<!---Usuario--->
			<div class="contenedor">
				<label> Usuario <span class="text-danger">*</span> </label>
				<input type="text" placeholder="Ingresa tu usuario" name="usuario" required>
			</div>

			<!---Contraseña--->
			<div class="contenedor">
				<label> Contraseña <span class="text-danger">*</span> </label>
				<input type="password" placeholder="Ingresa una contraseña"
				 name="password" required>
			</div>
			<div>
				<input type="submit" value="REGISTRARSE">
			</div>
			<p>¿Ya tienes una cuenta? <a class="link" href="login.php"> Inicia sesión</a></p>
			<p><a class="link" href="tipos_de_registro.php">Atras</a></p>
           <br><br><br><br><br>
		</form>
		<br><br><br><br><br>
	</div>

</body>
</html>
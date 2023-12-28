
<?php 
    session_start();
	if(!isset($_SESSION['datos_login'])){
	    header('Location: ../../login.php');
	}

    require '../../conexion.php';

    if($_SERVER["REQUEST_METHOD"] == "POST"){

         $nombre = $_POST['nombre'];
         $apellido = $_POST['apellido'];
         $celular = $_POST['celular'];        
         $gmail = $_POST['gmail'];
         $usuario = $_POST['usuario'];
         $password= $_POST['password'];
         $idrol= $_POST['idrol'];
      $query = $conexion->prepare("INSERT INTO persona(nombre,apellido,celular,gmail,usuario,password,rol) 
      	                         VALUES(?, ?, ?, ?, ?, ?, ?)"
        );
        $resultado = $query->execute(array($nombre, $apellido, $celular, $gmail, $usuario, $password,$idrol));

        if($resultado){
            header('Location:listar.php');
        }


    }
     $query = $conexion->prepare("SELECT *FROM roles");
    $query->execute();
    $roles = $query->fetchAll(PDO::FETCH_ASSOC);

    
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
				<img src="../../img/log.png" >
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
		<img class="logo-registro" src="../../img/registrousuario.jpg" alt="Logo registro">
		<h1>Registrate</h1>
		<form method="post">

			<!---Nombre--->
			<div class="contenedor">
				<label> Nombre <span class="text-danger">*</span> </label>
				<input type="text" required placeholder="Tu nombre" name="nombre">
			</div>
			<!---Apellidos--->
			<div class="contenedor">
				<label> Apellido <span class="text-danger">*</span> </label>
				<input type="text" required placeholder="Tu apellido" name="apellido">
			</div>
			<!---Celular--->
			<div class="contenedor">
				<label> Celular <span class="text-danger">*</span> </label>
				<input type="text" required placeholder="Ingresa tu celular" name="celular">
			</div>
			<!---Gmail--->
			<div class="contenedor">
				<label> Gmail <span class="text-danger">*</span> </label>
				<input type="email" required placeholder="Ingresa tu correo" name="gmail">
			</div>
			<!---Usuario--->
			<div class="contenedor">
				<label> Usuario <span class="text-danger">*</span> </label>
				<input type="text" required placeholder="Usuario" name="usuario">
			</div>
			
			<!---Contraseña--->
			<div class="contenedor">
				<label> Contraseña <span class="text-danger">*</span> </label>
				<input type="password" required placeholder="Ingresa una contraseña" name="password">
			</div>
           
			<select  name="idrol">
				    <?php foreach($roles as $rol) {?>
                        <option value="<?php echo $rol['idrol']?>"><?php echo $rol['nombrerol']?></option>
                    <?php } ?>
            </select>
         
			<div>
				<input type="submit" value="REGISTRARSE">
			</div>
			<p><a class="link" href="listar.php">Cancelar</a></p>
		</form>
		
	</div>
	

</body>
</html>
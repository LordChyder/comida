
<?php 
    session_start();
	if(!isset($_SESSION['datos_login'])){
	    header('Location: ../../login.php');
	}

    require '../../conexion.php';

    if($_SERVER["REQUEST_METHOD"] == "POST"){

         $nombre = $_POST['nombre'];
         $descripcion = $_POST['descripcion'];
         $logo = $_POST['logo'];        
         $estatus= $_POST['estatus'];
         $estado = $_POST['estado'];
         $idrol= $_POST['idrol'];

         $logo = '../../img1/'.$_FILES['logo']['name'];
         move_uploaded_file($_FILES['logo']['tmp_name'], $logo);

      $query = $conexion->prepare("INSERT INTO restaurant (nombrer,descripcionr,imagenr,estatus,	idrol,estado)        VALUES(?, ?, ?, ?, ?, ?)"
        );
        $resultado = $query->execute(array($nombre, $descripcion, $logo, $estatus,$idrol,$estado));

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
		<form method="post" enctype="multipart/form-data">

			<!---Nombre--->
			<div class="contenedor">
				<label> Nombre <span class="text-danger">*</span> </label>
				<input type="text" required placeholder="Tu nombre" name="nombre">
			</div>
			<!---Descripcion--->
			<div class="contenedor">
				<label>Descripcion <span class="text-danger">*</span> </label>
				<textarea rows="10" cols="48"equired placeholder="Descripcion" name="descripcion"></textarea>
			</div>
			<!---Logo--->
			<div class="contenedor">
				<label> Logo<span class="text-danger">*</span> </label>
				<input type="file" required placeholder="Ingresa tu logo" name="logo">
			</div>
			<!---estatus--->
			<div class="contenedor">
				<label> estatus <span class="text-danger">*</span> </label>
				<input type="number" required placeholder="Ingresa tu estatus" name="estatus">
			</div>

		    <!---estado--->
           <div class="contenedor">
           	<label> Estado <span class="text-danger">*</span> </label><br>
	           <select name="estado">
	           	  <option value="activo">activo</option>	
	           	  <option value="inactivo">inactivo</option>
	           </select>
           </div>
           <!---rol--->
           <div class="contenedor">
           	<label> Rol<span class="text-danger">*</span> </label><br>
			<select  name="idrol">
				    <?php foreach($roles as $rol) {?>
                        <option value="<?php echo $rol['idrol']?>"><?php echo $rol['nombrerol']?></option>
                    <?php } ?>
            </select>
           </div>

			<div>
				<input type="submit" value="REGISTRARSE">
			</div>
			<p><a class="link" href="listar.php">Cancelar</a></p>
		</form>
		
	</div>
	

</body>
</html>
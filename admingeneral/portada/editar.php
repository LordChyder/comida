<?php  
    session_start();
	if(!isset($_SESSION['datos_login'])){
	    header('Location: ../../login.php');
	}
    require '../../conexion.php';

     if($_SERVER["REQUEST_METHOD"] == "POST"){

         $nombre = $_POST['nombre'];
         $descripcion = $_POST['descripcion'];  
         $estado = $_POST['estado'];
         $id=$_POST['id'];

        
        if ($_FILES['imagen']['name'] == "") {
        	
        
       $query = $conexion->prepare("UPDATE portada SET nombre = ?, descripcion = ?, estado =? WHERE id  = ?"
        );
        $resultado = $query->execute(array($nombre, $descripcion, $estado, $id));

        }else {
        	$imagen =$_FILES['imagen']['name'];
            move_uploaded_file($_FILES['imagen']['tmp_name'], '../../platospng/'.$_FILES['imagen']['name']);

            $query = $conexion->prepare("UPDATE portada SET  nombre = ?, descripcion = ?, imagen = ?, estado = ? WHERE id  = ?"
        );
        $resultado = $query->execute(array($nombre, $descripcion, $imagen, $estado, $id));


       }


        if($resultado){
            header('Location:listar.php');
        }

       
    }
    else{

        $id = $_GET['id'];
        $query=$conexion->prepare("SELECT * FROM portada WHERE id = ?");
        $query->execute(array($id));
        $portada =$query->fetch(PDO::FETCH_ASSOC);
 

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
				<li><a href="#">Más información</a></li>
				<li><a href="#">Contacto</a></li>
				<li><a href="#" class="active">Carrito
					
				</a></li>
			</ul>
		</nav>
		</div>
	<div class="registro">
		<img class="logo-registro" src="../../img/registrousuario.jpg" alt="Logo registro">
		<h1>Editar</h1>
		<form method="post" enctype="multipart/form-data">
			
		 <input type="hidden"  name="id" value="<?php echo $portada['id']?>">
			

		
			<!---Nombre del palto--->
			<div class="contenedor">
				<label> Nombre <span class="text-danger">*</span> </label>
				<input type="text" name="nombre" value="<?php echo $portada['nombre']?>">
			</div>
			<!---Descripcion--->
			<div class="contenedor">
				<label>Descripcion <span class="text-danger">*</span> </label>
				<textarea rows="10" cols="48" name="descripcion"> <?php echo $portada['descripcion']?></textarea>
			</div>
		

             <img  class="imagen1" src="../../platospng/<?php echo $portada['imagen']?>">
			<!---imagen--->
			<div class="contenedor">
				<label> Imagen<span class="text-danger">*</span> </label>
				<input type="file"  placeholder="Ingresa tu imagen" name="imagen">
			</div>

			<div class="contenedor">
           	<label> Estado <span class="text-danger">*</span> </label><br>
	           <select name="estado">

	           	<?php if ($portada['estado']== "activo") {?>
	           		     <option selected value="activo">activo</option>	
	           	          <option value="inactivo">inactivo</option>
                 
	            <?php  	}else if ($portada['estado']== "inactivo") {?>
	         	
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
<?php 
    session_start();
	if(!isset($_SESSION['datos_login'])){
	    header('Location: ../../login.php');
	}
    require '../../conexion.php';

     if($_SERVER["REQUEST_METHOD"] == "POST"){

         $nombre = $_POST['nombre'];
         $descripcion = $_POST['descripcion']; 
         $estatus = $_POST['estatus'];
         $estado = $_POST['estado'];
         $idrol= $_POST['idrol'];
         $idrestaurant=$_POST['id'];

        
        if ($_FILES['logo']['name'] == "") {
        	
        
       $query = $conexion->prepare("UPDATE restaurant SET nombrer = ?, descripcionr = ?, estatus = ?, 	idrol = ?, 	estado = ? WHERE idrestaurant  = ?"
        );
        $resultado = $query->execute(array($nombre, $descripcion, $estatus, $idrol, $estado, $idrestaurant));

        }else {
        	$logo = $_FILES['logo']['name'];
            move_uploaded_file($_FILES['logo']['tmp_name'],'../../restaurantes/'.$_FILES['logo']['name']);
            $query = $conexion->prepare("UPDATE  restaurant SET nombrer = ?, descripcionr = ?, imagenr= ?, estatus = ?, idrol = ?, 	estado = ? WHERE idrestaurant  = ?" );
        	$resultado = $query->execute(array($nombre, $descripcion, $logo, $estatus, $idrol, $estado, $idrestaurant));


       }


        if($resultado){
            header('Location:listar.php');
        }

       
    }
    else{


    	 $id = $_GET['id'];
        $query = $conexion->prepare("SELECT * FROM restaurant WHERE idrestaurant = ?");
        $query->execute(array($id));
        $restaurante = $query->fetch(PDO::FETCH_ASSOC);


        $query = $conexion->prepare("SELECT idrol,nombrerol FROM roles");
        $query->execute();
        $roles = $query->fetchAll(PDO::FETCH_ASSOC);
 

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
		<img class="logo-registro" src="../../iconos/utencilios.png" alt="Logo registro">
		<h1>Editar Restaurant</h1>
		<form method="post" enctype="multipart/form-data">
			
		 <input type="hidden"  name="id" value="<?php echo $restaurante['idrestaurant']?>">
			
			<!---Nombre--->
			<div class="contenedor">
				<label> Nombre <span class="text-danger">*</span> </label>
				<input type="text" name="nombre" value="<?php echo $restaurante['nombrer']?>">
			</div>
			<!---Descripcion--->
			<div class="contenedor">
				<label>Descripcion <span class="text-danger">*</span> </label>
				<textarea rows="10" cols="48" name="descripcion"><?php echo $restaurante['descripcionr']?></textarea>
			</div>

            <img class="imagen1" src="../../restaurantes/<?php echo $restaurante['imagenr']?>">

			<!---Logo--->
			<div class="contenedor">
				<label> Logo<span class="text-danger">*</span> </label>
				<input type="file"  placeholder="Ingresa tu logo" name="logo">
			</div>

			<!---estatus--->
			<div class="contenedor">
				<label> estatus <span class="text-danger">*</span> </label>
				<input type="number" name="estatus" value="<?php echo $restaurante['estatus']?>">
			</div>

			<!---estado--->
           <div class="contenedor">
           	<label> Estado <span class="text-danger">*</span> </label><br>
	           <select name="estado">

	           	<?php if ($restaurante['estado']== "activo") {?>
	           		     <option selected value="activo">activo</option>	
	           	          <option value="inactivo">inactivo</option>
                 
	            <?php  	}else if ($restaurante['estado']== "inactivo") {?>
	         	
                           <option value="activo">activo</option>	
	           	          <option selected value="inactivo">inactivo</option>

	        <?php }else{ } ?>
	           </select>
           </div>
			
			
           <!---rol--->
			<select class="user-input" name="idrol">
				<?php foreach($roles as $rol) {
                        if($rol['idrol'] == $restaurante['rol']){
                    ?>
                        <option selected value="<?php echo $rol['idrol']?>"><?php echo $rol['nombrerol']?></option>
                    <?php 
                        }
                        else{ 
                    ?>
                        <option value="<?php echo $rol['idrol']?>"><?php echo $rol['nombrerol']?></option>   
                    <?php 
                        } 
                    } ?>

             </select>
         
			<div>
				<input type="submit" value="GUARDAR">
			</div>
			<p><a class="link" href="listar.php">Cancelar</a></p>
		</form>
		
	</div>
	

</body>
</html>
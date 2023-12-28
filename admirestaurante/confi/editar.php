<?php 
    session_start();
	if(!isset($_SESSION['datos_login'])){
	    header('Location: ../../login.php');
	}
    require '../../conexion.php';

     if($_SERVER["REQUEST_METHOD"] == "POST"){

         $nombrer = $_POST['nombrer'];
         $descripcionr = $_POST['descripcionr'];
         $ruc = $_POST['ruc'];        
         $estatus = $_POST['estatus'];
    	 $idrestaurant = $_POST['id'];
    	
		 if ($_FILES['logo']['name'] == "") {
         
        
       $query = $conexion->prepare("UPDATE restaurant SET nombrer = ?, descripcionr = ?, ruc = ?
       	,estatus = ? WHERE idrestaurant = ?"
        );
        $resultado = $query->execute(array($nombrer,$descripcionr,$ruc,$estatus,$idrestaurant));

        
		} else {
			
        	$logo = $_FILES['logo']['name'];
        
            //move_uploaded_file($_FILES['logo']['tmp_name'], $logo);
            move_uploaded_file($_FILES['logo']['tmp_name'], "../../restaurantes/".$_FILES["logo"]["name"]);
            $query = $conexion->prepare("UPDATE  restaurant SET nombrer = ?, descripcionr = ?, ruc = ?,imagenr= ?, estatus = ? WHERE idrestaurant  = ?"
        );
        $resultado = $query->execute(array($nombrer, $descripcionr,$ruc, $logo, $estatus, $idrestaurant));


       }

		if($resultado){
            header('Location:listar.php');
        }

       
    }
    else{


    	$id = $_GET['id'];
        $query = $conexion->prepare("SELECT * FROM restaurant WHERE idrestaurant  = ?");
        $query->execute(array($id));
        $restaurant = $query->fetch(PDO::FETCH_ASSOC);


        

  

 

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
	<div class="registro" >
		<img class="logo-registro" src="../../iconos/restaurant.png" alt="Logo registro">
		<h1>Editar Restaurante</h1>
		<form method="post" enctype="multipart/form-data">
			
		 <input type="hidden"  name="id" value="<?php echo $restaurant['idrestaurant']?>">
			
		 	<div class="contenedor">
				<label> Nombre <span class="text-danger">*</span> </label>
				<input type="text" name="nombrer" value="<?php echo $restaurant['nombrer']?>">
			</div>
			<!---Descripcion--->
			<div class="contenedor">
				<label>Descripcion <span class="text-danger">*</span> </label>
				<textarea rows="10" cols="48" name="descripcionr"><?php echo $restaurant['descripcionr']?></textarea>
			</div>

			<div class="contenedor">
				<label> Ruc <span class="text-danger">*</span> </label>
				<input type="text" name="ruc" value="<?php echo $restaurant['ruc']?>">
			</div>

            <img class="imagen1" src="../../restaurantes/<?php echo $restaurant['imagenr']?>">

			<!---Logo--->
			<div class="contenedor">
				<label> Logo<span class="text-danger">*</span> </label>
				<input type="file"  placeholder="Ingresa tu logo" name="logo">
			</div>

			<!---estatus--->
			<div class="contenedor">
				<label> estatus <span class="text-danger">*</span> </label>
				<input type="number" name="estatus" value="<?php echo $restaurant['estatus']?>">
			</div>

           
		
         
			<div>
				<input type="submit" value="GUARDAR">
			</div>
			<p><a class="link" href="listar.php">Cancelar</a></p>
		</form>
		
	</div>
	

</body>
</html>
<?php 
    session_start();
	if(!isset($_SESSION['datos_login'])){
	    header('Location: ../../login.php');
	}
    require '../../conexion.php';

     if($_SERVER["REQUEST_METHOD"] == "POST"){

         $autor = $_POST['autor'];
         
         $descripcion = $_POST['descripcion'];        
         $fecha = $_POST['fecha'];
		 $estado = $_POST['estado'];
         
         $idtestimonio=$_POST['id'];
        
       $query = $conexion->prepare("UPDATE testimonios SET  descripcion = ?, autor = ?, fecha = ?,estado=? WHERE idtestimonio = ?"
        );
        $resultado = $query->execute(array($descripcion,$autor,$fecha,$estado ,$idtestimonio));

        if($resultado){
            header('Location:listar.php');
        }

       
    }
    else{


    	$id = $_GET['id'];
        $query = $conexion->prepare("SELECT * FROM testimonios WHERE idtestimonio  = ?");
        $query->execute(array($id));
        $testimonio = $query->fetch(PDO::FETCH_ASSOC); 

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
		<img class="logo-registro" src="../../iconos/restaurant.png" alt="Logo registro">
		<h1>Editar Testimonio</h1>
		<form method="post">
			
		 <input type="hidden"  name="id" value="<?php echo $testimonio['idtestimonio']?>">
			
			<!---Autor--->
			<div class="contenedor">
				<label> Autor <span class="text-danger">*</span> </label>
				<input type="text" name="autor" value="<?php echo $testimonio['autor']?>">
			</div>

			<!---Titulo--->
			<div class="contenedor">
				<label>Fecha<span class="text-danger">*</span> </label>
				<input type="date" name="fecha" value="<?php echo $testimonio['fecha']?>">
			</div>
		
			<!---Descripcion--->
			<div class="contenedor">
				<label>Descripccion <span class="text-danger">*</span> </label>
				<textarea rows="8" cols="48" name="descripcion"><?php echo $testimonio['descripcion']?></textarea>
			</div>

			<div class="contenedor">
           	<label> Estado <span class="text-danger">*</span> </label><br>
	           <select name="estado">

	           	<?php if ($testimonio['estado']== "activo") {?>
	           		     <option selected value="activo">activo</option>	
	           	          <option value="inactivo">inactivo</option>
                 
	            <?php  	}else if ($testimonio['estado']== "inactivo") {?>
	         	
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
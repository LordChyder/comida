<?php 
    session_start();
	if(!isset($_SESSION['datos_login'])){
	    header('Location: ../../login.php');
	}
    require '../../conexion.php';

     if($_SERVER["REQUEST_METHOD"] == "POST"){

       
         $id= $_POST['id'];
         $estado=$_POST['estado'];
         date_default_timezone_set("America/Lima");
                           $tiempo=date("Y-m-N G-i-s");
 
       $query = $conexion->prepare("UPDATE detallepedido SET   Estado= ?,fe_entregado=? WHERE iddetalle=?"
        );
        $resultado = $query->execute(array($estado, $tiempo, $id));

        if($resultado){
            header('Location:listar.php');
        }
 
       
    }
    else{


       
    	$id = $_GET['id'];

        $query = $conexion->prepare("SELECT * FROM detallepedido WHERE iddetalle  = ?");
        $query->execute(array($id));
        $Detalle = $query->fetch(PDO::FETCH_ASSOC);
        

        

  

 

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
		<h1>Registrate</h1>
		<form method="post">
			
		 <input type="hidden"  name="id" value="<?php echo $Detalle['iddetalle']?>">
			
			
		
			<select  name="estado" title="Estado">

		           	<?php if ($Detalle['Estado']== "Solicitado") {?>
		           		     <option selected value="Solicitado">Solicitado</option>	
		           	          <option value="Entregado">Entregado</option>
		             
		            <?php  	}else if ($Detalle['Estado']== "Entregado") {?>
		         	
		                       <option value="Solicitado">Solicitado</option>	
		           	          <option selected value="Entregado">Entregado</option>

		        <?php }else{ } ?>
	           </select>
         
			<div>
				<input type="submit" value="REGISTRARSE">
			</div>
			<p><a class="link" href="listar.php">Cancelar</a></p>
		</form>
		
	</div>
	

</body>
</html>
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
         $idpersona=$_POST['id'];
		 $estado=$_POST['estado'];
        // var_dump($nombre." ".$apellido." ".$celular." ".$gmail." ".$usuario." ". $password." ".$idrol." ".$idpersona); die;
       $query = $conexion->prepare("UPDATE persona SET nombre = ?, apellido = ?, celular = ?, gmail = ?, usuario = ?, password = ?, rol = ?,estado=? WHERE idpersona = ?"
        );
        $resultado = $query->execute(array($nombre,$apellido,$celular,$gmail,$usuario,$password,$idrol,$estado,$idpersona));

        if($resultado){
            header('Location:listar.php');
        }

       
    }
    else{


    	 $id = $_GET['id'];
        $query = $conexion->prepare("SELECT * FROM persona WHERE idpersona  = ?");
        $query->execute(array($id));
        $usuario = $query->fetch(PDO::FETCH_ASSOC);


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
		<img class="logo-registro" src="../../iconos/usuario.png" alt="Logo registro">
		<h1>Editar Usuario</h1>
		<form method="post">
			
		 <input type="hidden"  name="id" value="<?php echo $usuario['idpersona']?>">
			
			<!---Nombre--->
			<div class="contenedor">
				<label> Nombre <span class="text-danger">*</span> </label>
				<input type="text" name="nombre" value="<?php echo $usuario['nombre']?>">
			</div>
			<!---Apellidos--->
			<div class="contenedor">
				<label> Apellido <span class="text-danger">*</span> </label>
				<input type="text" name="apellido" value="<?php echo $usuario['apellido']?>">
			</div>
			<!---Celular--->
			<div class="contenedor">
				<label> Celular <span class="text-danger">*</span> </label>
				<input type="text"  name="celular" value="<?php echo $usuario['celular']?>">
			</div>
			<!---Gmail--->
			<div class="contenedor">
				<label> Gmail <span class="text-danger">*</span> </label>
				<input type="email" name="gmail" value="<?php echo $usuario['gmail']?>">
			</div>
			<!---Usuario--->
			<div class="contenedor">
				<label> Usuario <span class="text-danger">*</span> </label>
				<input type="text" name="usuario" value="<?php echo $usuario['usuario']?>">
			</div>
			
			<!---Contraseña--->
			<div class="contenedor">
				<label> Contraseña <span class="text-danger">*</span> </label>
				<input type="password" name="password" value="<?php echo $usuario['password']?>">
			</div>
           
			<select class="user-input" name="idrol">
				<?php foreach($roles as $rol) {
                        if($rol['idrol'] == $usuario['rol']){
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

			 <div class="contenedor">
           	<label> Estado <span class="text-danger">*</span> </label><br>
	           <select name="estado">

	           	<?php if ($usuario['estado']== "activo") {?>
	           		     <option selected value="activo">activo</option>	
	           	          <option value="inactivo">inactivo</option>
                 
	            <?php  	}else if ($usuario['estado']== "inactivo") {?>
	         	
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
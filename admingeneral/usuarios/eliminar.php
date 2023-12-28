<?php 
	session_start();
	if(!isset($_SESSION['datos_login'])){
	    header('Location: ../../login.php');
	}
    
	
	require '../../conexion.php';
	$id = $_GET['id'];
     
    $query = $conexion->prepare("UPDATE persona SET estado = 'inactivo' WHERE idpersona= ?");
	$resultado = $query->execute(array($id));

	
	
	if($resultado){
		header('Location: listar.php');
	}
	
?>


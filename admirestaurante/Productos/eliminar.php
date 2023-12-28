<?php 
	session_start();
	if(!isset($_SESSION['datos_login'])){
	    header('Location: ../../login.php');
	}
    
	$id = $_GET['id'];
	require '../../conexion.php';
	
     
     $query = $conexion->prepare("UPDATE producto SET estado='inactivo'  WHERE idproducto= ?");
	$resultado = $query->execute(array($id));

	//var_dump($resultado); die;
	if($resultado){
		header('Location: listar.php');
	}
	
?>


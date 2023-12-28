<?php 
	session_start();
	if(!isset($_SESSION['datos_login'])){
	    header('Location: ../../login.php');
	}
    
	$id = $_GET['id'];
	require '../../conexion.php';
	
     
     $query = $conexion->prepare("DELETE FROM persona WHERE idpersona= ?");
	$resultado = $query->execute(array($id));

	//var_dump($resultado); die;
	if($resultado){
		header('Location: listar.php');
	}
	
?>


<?php 
	session_start();
	if(!isset($_SESSION['datos_login'])){
	    header('Location: ../../login.php');
	}
    
	$id = $_GET['id'];
	require '../../conexion.php';
	
     
    $query = $conexion->prepare("UPDATE testimonios SET estado = 'inactivo' WHERE idtestimonio = ?");
	$resultado = $query->execute(array($id));

	//var_dump($resultado); die;
	if($resultado){
		header('Location: listar.php');
	}
	
?>


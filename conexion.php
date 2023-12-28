<?php 
	try { // PDO = PHP Data Object 
		// PDO = gestor base de datos (driver), usuario, contraseña
		$conexion = new PDO(
			"mysql:host=localhost;dbname=bdsistemarestaurant", "root", "Chyder"
		);
		// echo "Base de datos conectada";
	} catch (Exception $e) {
		echo $e->getMessage();
	}
?>
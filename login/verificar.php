<?php
session_start();

    if(isset($_SESSION['datos_login'])){
        header('Location: ../login.php');
    }

if ($_SERVER["REQUEST_METHOD"]=="POST") {
include '../conexion.php';

$usuario=trim($_POST['usuario']);
$password=trim($_POST['password']);

/*$query=$conexion->prepare("SELECT * FROM persona WHERE  usuario = ? AND password = ? limit 1");
    $query->execute(array($usuario,$password));
    $result=$query->fetch(PDO::FETCH_ASSOC);*/

    $query=$conexion->prepare("SELECT * FROM persona WHERE usuario = ? AND password = ? AND estado='activo' limit 1");
    $query->execute(array($usuario,$password));
    $result=$query->fetch();

  if ($result) {
  $_SESSION['datos_login']=$result['idpersona'];

    if ($result['rol'] == 1) {//super-adm
    //echo "<script> alert('Bienvenido: ');window.location='../admingeneral/usuarios/listar.php'</script>";
    header("Location: ../admingeneral/usuarios/listar.php"); 

    }else if ($result['rol']== 2){ //adm-restaurant  

        header("Location: ../admirestaurante/confi/listar.php"); 

    } else if($result['rol'] == 3){//usuario-cliente
        
        header("Location: ../carritocompras.php");
    }else{

    }
        
    }else{
        
        header("Location: ../login.php?error=datos no validos");
    }



}

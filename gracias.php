<?php
session_start();
   if(!(isset($_SESSION['persona']) ||isset($_SESSION['datos_login']))){
    header('Location: login.php');
}
include "conexion.php";
if(isset($_SESSION['datos_login']) || isset($_SESSION['persona'])){
    require 'conexion.php';
    

     if (isset($_SESSION['datos_login'])) {
                $arreglo2=$_SESSION['datos_login'];
            }else if(isset($_SESSION['persona'])){
               $arreglo2=$_SESSION['id'];
            }else{

            }
    //var_dump($arreglo2);
    
    $query = $conexion->prepare("SELECT * FROM persona WHERE idpersona = ".$arreglo2."");
    $query->execute();
    $persona = $query->fetch(PDO::FETCH_ASSOC); 
    //var_dump($persona);
    $query = $conexion->prepare("SELECT MAX(idpedido) AS id FROM pedido");
    $query->execute();
    $pedidos = $query->fetch(PDO::FETCH_ASSOC); 
    //$persona es con el id de ingreso
    $pedido=intval($pedidos['id']);
    //var_dump($pedido);die;
    $_SESSION['pedidos1']=$pedido;
}


if(isset($_SESSION['carrito'])){

            $arreglo=$_SESSION['carrito'];
            //var_dump($arreglo);die;
            for($i=0;$i<count($arreglo);$i++){
                $query = $conexion->prepare("INSERT INTO detallepedido(idpedido, productoid,precio,cantidad) VALUES(?, ?, ?, ?)");
                $resultado = $query->execute(
                array($pedido,
                $arreglo[$i]['Id'],
                $arreglo[$i]['Precio'],
                $arreglo[$i]['Cantidad']))or die(conexion->error);
                
            }
        
    }
unset($_SESSION['carrito']);
unset($_SESSION['se-total']);
unset($_SESSION['datos-login']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="css/estilos.css">
    <title>compra terminada</title>
</head>
<body>

<?php include './reducido/header.php' ?>
<div class="platos gracias">
<img src="./iconos/check.png" alt="">
<h1>GRACIAS POR SU COMPRA</h1>
<h3>Su compra fue tranferida exitosamente</h3>
<a target="_blank" href="reporteprueba.php" class="boton boton-rojo" ><i class="fas fa-file-invoice"></i>Generar reporte</a>
<a href="index.php" class="boton boton-verde">Retornar al Menú</a>

</div>
</body>
</html>
<?php

 session_start();
require "conexion.php";
require "plantilla.php";
$idpersona=1;
$query=$conexion->prepare("SELECT restaurant.nombrer, producto.nombre as Platos, detallepedido.precio, detallepedido.cantidad, tipopago.tipopago FROM pedido, persona, tipopago, detallepedido, producto, restaurant WHERE pedido.idpersona = persona.idpersona AND pedido.tipopago = tipopago.idtipo AND detallepedido.idpedido = pedido.idpedido AND detallepedido.productoid = producto.idproducto AND producto.idrestaurant = restaurant.idrestaurant AND detallepedido.idpedido = ? ");
 $query->execute(array($_SESSION['pedidos1']));
 $resultados=$query->fetchAll(PDO::FETCH_ASSOC);

 if (isset($_SESSION['datos_login'])) {
                $arreglo2=$_SESSION['datos_login'];
            }else if(isset($_SESSION['persona'])){
               $arreglo2=$_SESSION['id'];
            }else{

            }

 $query = $conexion->prepare("SELECT * FROM persona WHERE idpersona = ".$arreglo2."");
 $query->execute();
 $persona = $query->fetch(PDO::FETCH_ASSOC); 


    $pdf = new PDF("P", "mm", "letter");
    $pdf->AliasNbPages();
    $pdf->SetMargins(10, 10, 10);
    $pdf->AddPage();


    $pdf->SetFont("Arial", "B", 9);
     $pdf->setFillColor(31, 156, 180);
    $pdf->Cell(50, 5, "Restaurante", 1, 0, "C",1);
    $pdf->Cell(50, 5, "Plato", 1, 0, "C",1);
    $pdf->Cell(20, 5, "Precio", 1, 0, "C",1);
    $pdf->Cell(20, 5, "Cantidad", 1, 0, "C",1);
    $pdf->Cell(20, 5, "subtotal", 1, 1, "C",1);
    
$total=0;
$calculo=0;
    $pdf->SetFont("Arial", "", 9);

     foreach ($resultados as $fila) {
        $pdf->Cell(50, 5, $fila['nombrer'], 1, 0, "C");
        $pdf->Cell(50, 5, ($fila['Platos']), 1, 0, "C");
        $pdf->Cell(20, 5, $fila['precio'], 1, 0, "C");
        $pdf->Cell(20, 5, $fila['cantidad'], 1, 0, "C");
        $pdf->Cell(20, 5,$fila['precio']* $fila['cantidad'], 1, 1, "C");
       $total=$fila['precio']* $fila['cantidad'];
       $calculo+=$total;
    }
$pdf->Ln(2);

$pdf->setY(count($resultados)*15.6);
    $pdf->setX(130);
    $pdf->Cell(20, 5, "Total:", 0, 0, "C",1);

$pdf->Cell(20, 5, $calculo, 0, 0, "C");

$nombre=$persona['nombre']." ".$persona['apellido'];

$pdf->setY(count($resultados)*18);
    $pdf->setX(10);
    $pdf->Cell(20, 5, "Cliente:", 0, 0, "C");

$pdf->Cell(40, 5, $nombre, 0, 0, "C");

    $pdf->Output();

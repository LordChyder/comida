<?php 
session_start();
    
    unset($_SESSION['carrito']);
    unset($_SESSION['datos_login']);
     unset($_SESSION['se-total']);
    unset($_SESSION['foto']);
     unset($_SESSION['persona']);
    unset($_SESSION['id']);
    session_destroy();
    header("Location:../index.php");



?>
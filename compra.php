<?php 
    session_start();
    
    if(!(isset($_SESSION['persona']) ||isset($_SESSION['datos_login']))){
    header('Location: login.php');
}
    require './conexion.php';

    


    if (isset($_SESSION['datos_login'])) {
                $arreglo[]=$_SESSION['datos_login'];
            }else if(isset($_SESSION['persona'])){
               $arreglo[]=$_SESSION['id'];
            }else{

            }
          

    $arreglo2[]=$_SESSION['se-total'];
    
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $idpersona = ['nombre'];
        $monto = $_POST['monto']; $tipo = $_POST['tipo'];
        $direccion = $_POST['direccion']; 
       

        $query = $conexion->prepare("INSERT INTO pedido(idpersona, monto, tipopago, direccionenvio) VALUES( ?,?, ?, ?)"
        );
        $resultado = $query->execute(array($arreglo[0],$monto, $tipo, $direccion));
        if($resultado){
            header('Location:./gracias.php');
        }
    }
    $query = $conexion->prepare("SELECT idpersona,nombre, celular,direccion FROM persona WHERE idpersona =".$arreglo[0]."");
    $query->execute();
    $persona = $query->fetch(PDO::FETCH_ASSOC); 

    $query = $conexion->prepare("SELECT idtipo, tipopago FROM tipopago");
    $query->execute();
    $tipopago = $query->fetchAll(PDO::FETCH_ASSOC); 
    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/estilos.css">
    <title>Registro de compra</title>
</head>
<body>
<div class="platos">
     <h1>Confirmacción de pedido</h1>
<form action="" method="post" enctype="multipart/form-data">
    <label for="">Nombre de la persona</label>
    <input type="text" name="nombre" readonly=»readonly» value="<?php echo $persona['idpersona']?>">
    <label for="">Monto de Pago</label>
    <input type="int" readonly=»readonly» name="monto" value="<?php echo $arreglo2[0]?>">
    <label for="">Tipo de Pago</label>
    <select name="tipo">
                    <?php foreach($tipopago as $pago) {?>
                        <option value="<?php echo $pago['idtipo']?>"><?php echo $pago['tipopago']?></option>
                    <?php } ?>
    </select>
    <label for="">Dirección de entrega</label>
    <input type="text"  name="direccion" value="<?php echo $persona['direccion']?>">
    <button type="submit" class="boton boton-verde">Guardar</button>
    <a href="index.php" class="boton boton-rojo">Cancelar</a>
</form>
</div>
    
</body>
</html>
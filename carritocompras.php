<?php
	
    session_start();
    if(!(isset($_SESSION['persona']) ||isset($_SESSION['datos_login']))){
    header('Location: login.php');
}
    
    $_SESSION['se-total']=0;
        include "conexion.php";
        if(isset($_SESSION['datos_login'])||isset($_SESSION['persona']) ){
            require 'conexion.php';
            
            if (isset($_SESSION['datos_login'])) {
            	$arreglo2=$_SESSION['datos_login'];
            }else if(isset($_SESSION['id'])){
               $arreglo2=$_SESSION['id'];
            }else{

            }
            
            
            
            $query = $conexion->prepare("SELECT * FROM persona WHERE idpersona = ".$arreglo2."");
            $query->execute();
            $persona = $query->fetch(PDO::FETCH_ASSOC); 
            //var_dump($persona);

            //$persona es con el id de ingreso
        }
    
	include 'conexion.php';
	if(isset($_SESSION['carrito'])){
		if(isset($_GET['id'])){
					$arreglo=$_SESSION['carrito'];
					$encontro=false;
					$numero=0;
					for($i=0;$i<count($arreglo);$i++){
						if($arreglo[$i]['Id']==$_GET['id']){
							$encontro=true;
							$numero=$i;
						}
					}
					if($encontro==true){
						$arreglo[$numero]['Cantidad']=$arreglo[$numero]['Cantidad']+1;
						$_SESSION['carrito']=$arreglo;
					}else{
						$nombre="";
						$precio=0;
						$imagen="";
						$re=$conexion->query("SELECT * FROM producto WHERE idproducto=".$_GET['id']);
						while($f=$re->fetch(PDO::FETCH_ASSOC)){
							$nombre=$f['nombre'];
							$precio=$f['precio'];
							$imagen=$f['imagen'];
						}
						$datosNuevos=array('Id'=>$_GET['id'],
										'Nombre'=>$nombre,
										'Precio'=>$precio,
										'Imagen'=>$imagen,
										'Cantidad'=>1);

						array_push($arreglo, $datosNuevos);
						$_SESSION['carrito']=$arreglo;

					}
		}
	}else{
		if(isset($_GET['id'])){
			$nombre="";
			$precio=0;
			$imagen="";
			$re=$conexion->query("select * from producto where idproducto=".$_GET['id']);
			while($f=$re->fetch(PDO::FETCH_ASSOC)){
				$nombre=$f['nombre'];
				$precio=$f['precio'];
				$imagen=$f['imagen'];
			}
			$arreglo[]=array('Id'=>$_GET['id'],
							'Nombre'=>$nombre,
							'Precio'=>$precio,
							'Imagen'=>$imagen,
							'Cantidad'=>1);
			$_SESSION['carrito']=$arreglo;
			
			
		}
	}
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Carrito de Compras</title>
	<link rel="stylesheet" type="text/css" href="css/estilos.css">
	<link  href="iconos/restaurante.png" rel="shortcut icon"/>
	<script type="text/javascript" src="js/jquery-3.6.0.min.js"></script>
    <script type="text/javascript" src="js/script.js"></script>
	
	
	

</head>
<body>
	<div>
	<nav>
		<div class="logo">
			<img src="iconos/log.png" >
		</div>
		<ul>
			<li><a href="#" class="active">Carrito de compras</a></li>
			
				
			<li><a href="login/cerrar.php" class="active">Cerrar Sesión</a></li>
		</ul>
	</nav>
	</div>
   <?php 
            if (isset($_SESSION['foto'] )) {?> 
            	<p>Bienvenido 
               <?php 
                 echo $_SESSION['persona'];
            	?> 
            	
            	<img src="<?php echo $_SESSION['foto'] ?>"><?php } ?></p>
    <div class="activity-card ab">  
        

	    <div class="table-responsive">
            <table class="tabla">
                <thead>
                    <tr>
                        <th>Nombre del Producto</th>
                        <th>Imagen</th>
                        <th>Precio</th>
                        <th>Cantidad</th>
                        <th>SubTotal</th>
                        <th>Eliminar</th>
                    </tr>
                </thead>
                <?php
                        $total=0;
                        if(isset($_SESSION['carrito'])){
                        $datos=$_SESSION['carrito'];
                        
                        $total=0;
                        for($i=0;$i<count($datos);$i++){
                        
                            
                ?>   
                <tbody>
                    
                    <td>
                    <?php echo $datos[$i]['Nombre'];?>
                    </td>
                    <td class="td-team img">
                        <div class="img_tabla" >
                    <img src="./platos/<?php echo $datos[$i]['Imagen'];?>">
                    </div>
                    </td>
                    <td>
                        
                    <?php echo $datos[$i]['Precio'];?>
                    </td>
                    <td>
                    <div >
                    <input  type="text" class="txtcantidad"
                    value="<?php echo $datos[$i]['Cantidad'];?>" 
                    style="width:70%"
                    data-precio="<?php echo $datos[$i]['Precio'];?>"
                    data-id="<?php echo $datos[$i]['Id'];?>">
                    </div>
                    </td>
                    <td class="cantid<?php echo $datos[$i]['Id'];?>">
                    <span class="Subtotal"
                    data-subtotal="<?php echo $datos[$i]['Cantidad']*$datos[$i]['Precio'];?>">Subtotal:<?php echo $datos[$i]['Cantidad']*$datos[$i]['Precio'];?></span>
                    </td>
                    <td >
                        
                        <a class="boton boton-rojo btneliminar" data-id="<?php echo $datos[$i]['Id'];?>" href="#">Eliminar</a>
                        
                    </td>
                    
                </tbody>
                <?php
                            $total=($datos[$i]['Cantidad']*$datos[$i]['Precio'])+$total;
                        }
                            
                        }
                        
                    ?>
                </table>
        </div>
    </div>
   
	<div  class="platos">
    <?php
    if($total!=0){
        echo '<a  class="boton boton-verde" href="./compra.php">Comprar</a>';
        
        
    }
        ?>
        <div><strong id="total" class="texttotal" data-total="<?php echo $total;?>">El total a Pagar es: S/. <?php echo $total;?></strong></div>
       
    
    <!--
				<div>
					<div class="caja">
						<div class="imgBx">
						<img src="./platos/<?php //echo $datos[$i]['Imagen'];?>"><br>
						</div>
						<div class="contentBx">
						<span><?php //echo $datos[$i]['Nombre'];?></span><br>
						<span>Precio: <?php //echo $datos[$i]['Precio'];?></span><br>
						<span>Cantidad: 
							<input type="text" value="<?php //echo $datos[$i]['Cantidad'];?>"
							data-precio="<?php //echo $datos[$i]['Precio'];?>"
							data-id="<?php //echo $datos[$i]['Id'];?>"
							class="cantidad"></span><br>
						<span class="Subtotal">Subtotal:<?php// echo $datos[$i]['Cantidad']*$datos[$i]['Precio'];?></span><br>
						<a href="#" class="eliminar" data-id="<?php //echo $datos[$i]['Id'];?>">Eliminar</a>
						</div>
					</div>
				</div>-->
			
		<a class="boton boton-verde" href="./">Ver catalogo</a>
		

    </div>
    <?php 
        $arreg=array($total);
         array($_SESSION['se-total'], $arreg[0]);
         $_SESSION['se-total']= $arreg[0];?>
	<script>
        $(document).ready(function(){
            $(".btneliminar").click(function(event){
                event.preventDefault();
                var id = $(this).data('id')
                var boton=$(this)
                $.ajax({
                    method:'POST',
                    url:'./eliminarCarrito.php',
                    data:{
                        id:id
                    }
                }).done(function(respuesta){
                   boton.parent('td').parent('tr').remove();
                })
            })
            $(".txtcantidad").keyup(function(){
                var cantidad = $(this).val();
                var precio=$(this).data('precio');
                var id = $(this).data('id');
                var mult = parseFloat(cantidad)*parseFloat(precio);
                $(".cantid"+id).text("Subtotal:"+mult);
                var total = $(".texttotal").data('total')
                console.log(total);
            })

            $(".txtcantidad").keyup(function(e){
            if($(this).val()!=''){
                if(e.keyCode==13){
                    var id=$(this).attr('data-id');
                    var precio=$(this).attr('data-precio');
                    var cantidad=$(this).val();
                    $(this).parentsUntil('.producto').find('.subtotal').text('Subtotal: '+(precio*cantidad));
                    $.post('./js/modificarDatos.php',{
                        Id:id,
                        Precio:precio,
                        Cantidad:cantidad
                    },function(e){
                            $("#total").text('Total: '+e);
                    });
                }
            }
        });

            
                
                
            
            
        })
    </script>
	
</body>
</html>
<?php 
    session_start();
    if(isset($_SESSION['datos_login'])){
        header("Location: ./carritocompras.php");
    }

    require 'conexion.php';

    require 'glogin/vendor/autoload.php';

    $cliente = new Google_Client();
    $cliente->setClientId('347071960641-m3ebscgcjjh56ec79ifs0hq9vubitnb3.apps.googleusercontent.com');
    $cliente->setClientSecret('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');
    $cliente->setRedirectUri('http://localhost/sistemaRT/login.php');
    $cliente->addScope('email');
    $cliente->addScope('profile');

    if (isset($_GET['code'])) {
        $token = $cliente->fetchAccessTokenWithAuthCode($_GET['code']);

        if (!isset($token['error'])) {
            $cliente->setAccessToken($token['access_token']);
            $google_auth = new Google_Service_Oauth2($cliente);
            $google_auth_info=$google_auth->userinfo->get();
            /*var_dump($google_auth_info); die;*/

            $nombres = $google_auth_info->givenName;
            $apellidos = $google_auth_info->family_name;
            $id = $google_auth_info->id;
            $idpersona = $google_auth_info->id;
            $idrol = $google_auth_info->id;
            $correo = $google_auth_info->email;
            $rol = 3;
            $foto = $google_auth_info->picture;

            $query=$conexion->prepare("SELECT google_id,idpersona FROM persona WHERE  google_id=?");
            $query->execute(array($id));
            $resultado = $query->fetch(PDO:: FETCH_ASSOC);
            $_SESSION['id'] = $resultado['idpersona'];

              
            if($resultado){
                $_SESSION['persona'] = $nombres.''.$apellidos;
                $_SESSION['foto'] = $foto;

               

                header("Location: ./carritocompras.php");
            }
            else {
                $query = $conexion->prepare("INSERT INTO persona(usuario,password,nombre,apellido,rol,google_id) VALUES(?,?,?,?,?,?)");
                $resultado = $query->execute(array($correo,$idpersona,$nombres,$apellidos,$rol,$idrol));
                if($resultado){
                    $_SESSION['persona'] = $nombres.''.$apellidos;
                    $_SESSION['foto'] = $foto;
                    $_SESSION['id'] = $resultado['idpersona'];
                    header("Location: ./carritocompras.php");
                }
                else {
                    echo "Login con Google ha fallado";
                }
            }
        }
    }
    else {
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Carrito de Compras</title>
	<link rel="stylesheet" type="text/css" href="css/estilos2.css">
	<link rel="stylesheet" type="text/css" href="css/stylelogin.css">
    <link  href="iconos/restaurante.png" rel="shortcut icon"/>
	<script type="text/javascript" src="js/jquery-3.6.0.min.js"></script>
    <script type="text/javascript" src="js/script.js"></script>
	<script type="text/javascript" src="js/script2.js"></script>		
</head>
<body>
	<div>
	<nav>
		<div class="logo">
			<a href="index.php"><img src="iconos/log.png" ></a>
		</div>
		<ul>
			<li><a href="index.php" >Menú</a></li>
					
			<li><a href="carritocompras.php" class="active">Carrito
				
			</a></li>
		</ul>
	</nav>
	</div>
	
	<section class="sec1">
		<div class="login">
		<div class="social-login-element"> 
                    <img style="width: 1rem; height: 1rem" src="img/google.svg" alt="google-image">
                    <a title="Ingrese como Cliente" style="color:#fff; " src="img/google.svg" alt="google-image" href="<?php echo $cliente->createAuthUrl(); ?>">OOGLE</a>    
                </div>	
        <form id="formulario" method="post" action="./login/verificar.php">
        <?php
            if(isset($_GET['error'])){
                echo '<center>Datos no Validos</center>';
            }
        ?>
            <label for="usuario">Usuario</label><br>
            <input type="text" id="usuario" name="usuario" placeholder="Usuario" required><br>
            <label for="password">Password</label>
            <input type="password" name="password" id="password" placeholder="Password" required><br>
            <input type="submit" name="aceptar" value="Aceptar" class="aceptar">
			<p>¿No puede iniciar sesión?<a class="link" href="tipos_de_registro.php"> Olvidé mi contraseña</a></p>
			<p>¿Aún no tienes cuenta?<a class="link" href="tipos_de_registro.php"> Registrate</a></p>

			 <?php } ?>

        </form>
		</div>
	</section>
	
	
</body>
</html>
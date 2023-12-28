<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <title>Document</title>
    <link rel="stylesheet" type="text/css" href="css/estilos.css">
</head>
<body>
    <div class="contenedorDS">
        <div class="navegadorDS">
            <ul>
                <li>
                   <a href="#">
                       <span class="icono"><ion-icon name="logo-apple"></ion-icon></span>
                       <span class="titulo">Nombre de la marca</span>
                   </a> 
                </li>
                <li>
                   <a href="#">
                       <span class="icono"><ion-icon name="home-outline"></ion-icon></span>
                       <span class="titulo">Dashboard</span>
                   </a> 
                </li>
                <li>
                   <a href="#">
                       <span class="icono"><ion-icon name="people-outline"></ion-icon></span>
                       <span class="titulo">Customer</span>
                   </a> 
                </li>
                <li>
                   <a href="#">
                       <span class="icono"><ion-icon name="chatbox-outline"></ion-icon></span>
                       <span class="titulo">Mensajes</span>
                   </a> 
                </li>
                <li>
                   <a href="#">
                       <span class="icono"><ion-icon name="chatbox-outline"></ion-icon></span>
                       <span class="titulo">Ayuda</span>
                   </a> 
                </li>
                <li>
                   <a href="#">
                       <span class="icono"><ion-icon name="settings-outline"></ion-icon></span>
                       <span class="titulo">Settings</span>
                   </a> 
                </li>
                <li>
                   <a href="#">
                       <span class="icono"><ion-icon name="lock-closed-outline"></ion-icon></span>
                       <span class="titulo">Password</span>
                   </a> 
                </li>
                <li>
                   <a href="#">
                       <span class="icono"><ion-icon name="log-out-outline"></ion-icon></span>
                       <span class="titulo">Cerrar cesion</span>
                   </a> 
                </li>
            </ul>
        </div>
        <div class="mainDS">
            <div class="barraDS">
                <div class="toggleDS">
                <ion-icon name="menu-outline"></ion-icon>
                </div>
                <div class="buscadorDS">
                    <label>
                        <input type="text" placeholder="Buscar">
                        <ion-icon name="search-outline"></ion-icon>
                    </label>
                </div>
                <div class="userDS"><img src="./img/user.jpg"alt=""></div>
            </div>
        </div>
    </div>
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
<script>
    //control del menu
    let toggle=document.querySelector('.toggleDS')
    let navegacion=document.querySelector('.navegadorDS')
    let main=document.querySelector('.mainDS')

    toggle.onclick=function(){
        navegacion.classList.toggle('activo')
        main.classList.toggle('active')
    }



    //control del hover el menu
    let lista=document.querySelectorAll('.navegadorDS li');
    function activarLink(){
        lista.forEach((item)=>
        item.classList.remove('hovered'));
        this.classList.add('hovered');
        
    }
    lista.forEach((item)=>
    item.addEventListener('mouseover',activarLink))
</script>
</body>
</html>
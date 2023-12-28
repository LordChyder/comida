<?php 
   
    require 'conexion.php';
    
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $descripcion = $_POST['descripcion']; $autor = $_POST['autor'];
        $fecha = $_POST['fecha']; 
        
        $query = $conexion->prepare("INSERT INTO testimonios(descripcion, autor, fecha) VALUES(?, ?, ?)"
        );
        $resultado = $query->execute(array($descripcion, $autor, $fecha));
        if($resultado){
            header('Location:index.php');
        }
    }
    
?>

    <main class="contenedorformulario">
        <h1 class="fw-300 centrar-texto">Registrar Testimonios</h1>
        <div class="contenido-nosotros login">
            <form class="formulariotest" method="post">
                <textarea type="text" name="descripcion" placeholder="Descripcion" required></textarea>
                <input type="text" name="autor" placeholder="Autor" required>
                <input type="date" name="fecha" placeholder="Fecha" required>
                <button type="submit" class="boton boton-verde">Guardar</button>
                <a href="index.php" class="boton boton-rojo">Cancelar</a>
            </form>
        </div>
    </main>

    

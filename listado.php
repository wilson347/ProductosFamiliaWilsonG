<?php
//Auto carga de clases
spl_autoload_register(function ($clase) {
  require_once "$clase.php";
});
session_start();

if (isset($_SESSION["usuario"])){//hay session con los datos del uusario y no se ha pulsado volver O desconectar
   
     //Obtenemos las familias
    
    db::obtener_familias();
   
     //cerramos la conexión 
    db::cerrar();
}elseif (isset($_POST["editar"])) {//Se ha pulsado el botón editar  
    exit(header("location:editar.php")); 
}elseif (isset($_POST["mostrar"])) {//Se ha pulsado el botón volver
    $campos=unserialize($_POST["campos"]);
    $mensaje=db::borrar($tabla,$campos);
    $tablas=db::obtenerDatos_tabla($tabla);
    db::cerrar();
   
}
    
?>
<!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport"
              content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Examen 2EV - Listado</title>
        <link rel="stylesheet" href="css/estilo.css">
    </head>
    <body>
        <div id="container">
            <div id="encabezado">
                <h1 >Tarea: Listado de productos de una familia </h1>
                <form  class="contenido_encabezado" action="listado.php" method="post">
                    <label for="">Familia </label>
                    <!--Coloca la lista desplegable-->
                    <input type="submit" value="Mostrar producto" name="submit">
                </form>
                <br/>
            </div>

            <div id="contenido">
                <!--Productos de la familia-->
            </div>
            
            <div id="pie"></div>
        </div>
    </body>
</html>

<?php
//Auto carga de clases
spl_autoload_register(function ($clase) { 
    require_once "$clase.php";
});
session_start();

if (isset($_POST["conectar"])) {
    $_SESSION["usuario"]["host"] = $_POST["host"];
    ;
    $_SESSION["usuario"]["usuario"] = $_POST["usuario"];
    $_SESSION["usuario"]["clave"] = $_POST["password"];


    //Conectamos
    $mensaje = db::conectar();
    if ($mensaje == "Conectado correctamente") {
        
        db::cerrar();
        exit(header("location:listado.php"));
    }
} elseif (isset($_SESSION["usuario"])) {
    unset($_SESSION["usuario"]);
} else {
    $mensaje = "";
}
?>
<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport"
              content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Examen 2EV - Listado</title>
        <link rel="stylesheet" href="css/estilo.css">
    </head>
    <body id="container">
        <div id="encabezado">
            <h1>Conexión </h1>
             <!--Colocar aquí el formulario.-->
            <form action="index.php" method="POST">
                <label> Host:
                    <input type="text" name ="host"/>
                </label><br/><br/>
                <label> Usuario
                    <input type="text" name ="usuario"/>
                </label><br/><br/>
                <label> Contraseña
                    <input type="password" name ="password"/>
                </label><br/><br/>

                <input type="submit" name="conectar" value="conectar"/>
            </form>

<?php echo isset($mensaje) ? $mensaje : ""; ?>
        </div>      
    </body>
</html>

<?php

?>

<!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Examen DWES - Editar</title>
        <link rel="stylesheet" type="text/css" href="css/estilo.css">
    </head>
    <divbody>
        <div id="container">
            <div id="encabezado">
                <h1>Ingrese los nuevos datos para actualizar el producto</h1>
            </div>
            <div id="contenido">
                <fieldset>
                    <legend>Modificar Producto</legend>
                    <form action="editar.php" method="POST">
                        <!-- Introducir los campos del producto a modificar -->
                        
                        <input type="submit" id="success" value="Actualizar" name="submit">
                        <input type="submit" id="cancel" value="Cancelar" name="submit">
                    </form>
                </fieldset>
                
            </div>
            <div id="pie"></div>
        </div>
    </body>
</html>

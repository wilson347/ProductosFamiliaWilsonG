<?php

class db {

    static private $con; //Contiene la conexión
    static private $error; //Contiene el número de error
    static private $info; //Información
    static private $estado; //la descripcion del error

    static public function conectar() {
        $host = $_SESSION["usuario"]["host"];
        $usuario = $_SESSION["usuario"]["usuario"];
        $password = $_SESSION["usuario"]["clave"];
        $bbdd = isset($_SESSION["usuario"]["bbdd"]) ? $_SESSION["usuario"]["bbdd"] : null;
        //mysqli_report(MYSQLI_REPORT_ALL);
        $con = new mysqli($host, $usuario, $password, $bbdd);
        if ($con->connect_errno !== 0) {
            self::$estado .= $con->connect_error;
            self::$error = $con->connect_errno;
        } else {
            self::$estado = "Conectado correctamente";

            $con->set_charset("UTF8"); //Importante para ver bien los caracteres
            self::$con = $con;
          
        }
        return self::$estado;
    }

    /**
     * @devuelve array asociativo con todas las familias cuyo índice es el código de la familia 
     * y su valor el nombre de la familias
     */
    static public function obtener_familias() {
        $sentencia = "SELECT * FROM familia";
        if (!self::$con)
            self::conectar();
        $consulta = self::ejecuta_consulta($sentencia);
        $consulta->bind_result($cod, $nombre);
        $opciones = "<p>Seleccione la base de datos para ver sus tablas</p>";
        while ($consulta->fetch()) {
            
        }
        $consulta->close();
        return $opciones;
    }

    /**
     * Actualiza un producto
     * Parámetro de entrada $producto que será un vector con todos los datos del producto.
     * devuelve true si se ha actualizado correctamente y false en otro caso.
     */
    static public function actualiza_producto($producto) {
        
    }

    /**
     * Parámetro de entrada $familia con el código de la familia
     * Devuelve array asociativo cuyo índice es el código del producto y su valor 
     * un array con dos componentes el nombre del producto y el pvp
     * 
     */
    static public function obtener_productos($familia) {
        
    }

    /**
     * Devuelve un vector con todos los valores de un producto cuyo código es $cod
     */
    static public function obtener_producto($cod) {
          $sentencia = "SELECT * FROM producto WHERE cod='$cod'";
          if (!self::$con)
          self::conectar();
          $consulta = self::ejecuta_consulta($sentencia);
          $columnas = array();
          $consulta->bind_result($columna); 
    }

    /**
     * @param $sentencia sentencia a ejecutar parametrizada
     * @param null $parametros array con tipos y variables que contienen los parámetros de la sentencia
     * @return mixed un mysqli_stmt con la sentencia ejecutada
     */
    static public function ejecuta_consulta($sentencia, $parametros = null) {

        $consulta = self::$con->stmt_init();
        $consulta->prepare($sentencia);

        $consulta->execute();
        return $consulta;
    }

    /**
     * analiza los tipos de los valores de $parametros
     * Si el tipo es entero retorna una i para ese parámetro
     * Si el tipo es decimal retorna una d para ese parámetro
     * Si no se considera string y que retorne una s
     * Al final retornará una cadena string formada por i' 'd' y s', una por parámetro
     */
    static private function get_tipos($parametros) {
        /* Implementa según especificación */
        $resultado = "";
        $numReal = "/^[0-9]+(\.[0-9]*)?/";
        $numEntero = "/^[0-9]+/";
        foreach ($parametros as $parametro) {
            if (preg_match($numEntero, $parametro)) {
                $resultado .= "i";
            } elseif (preg_match($numReal, $parametro)) {
                $resultado .= "d";
            } else {
                $resultado .= "s";
            }
        }
        return $resultado;
    }

    /*
     * Cierra la conexión.
     */

    static public function cerrar() {
        if (self::$con)
            self::$con->close();
    }

}

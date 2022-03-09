<?php
/*Señala errores */
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
?>

<?php

require "configuracion.php";

class DB
{
    private $conexion;
    private $error;

    public function __construct()
    {

        try {
            $this->conexion = new mysqli(HOST, USER, PASS, BD);
        } catch (Exception $ex) {
            $this->error = "Error conectando " . $ex->getMessage();
        }
    }

    public function getError()
    {
        return "Error en la conexion <span style='color:red'>: $this->error</span>";
    }

    /**
     * @return un array indexado de cada familia (cod, nombre)
     * cada elemento del array será un array asociativoa [cod, nombre]
     */
    public function obtener_familias(): array {
        $consulta = "select * from familia";
        $familias =[]; //La vaiable de retorno
        $resultado = $this->conexion->query($consulta);
        $fila = $resultado->fetch_assoc();
        while ($fila){
            $familias[]=$fila;
            $fila = $resultado->fetch_assoc();
        }
        return $familias;
    }
    
    public function obtener_productos (String $familia){
        $consulta = "select * from producto where familia = '$familia'";
        $productos =[]; //La vaiable de retorno
        $resultado = $this->conexion->query($consulta);
        $fila = $resultado->fetch_assoc();
        while ($fila){
            $productos[]=$fila;
            $fila = $resultado->fetch_assoc();
        }
        return $productos;

        }
        /* función que recibe como parametro $producto. Con el valor de esta variable hace una consulta en la base de datos. Introduce cada resultado dentro de la variable $fila  y crea un array con 
            que está compuesto de estás variables. Como resultado devuelve este array.*/
    public function obtener_producto (String $producto){
        $consulta = "select * from producto where cod = '$producto'";
        
        $resultado = $this->conexion->query($consulta);

        $fila = $resultado->fetch_assoc();
                
        $productos[]=$fila;

        return $productos[0];
    }
        /* función que recibe como parametros las variables del input del formulario  que guardan los datos de un producto. Este método usa una consulta update para modificar el valor de esas 
        variables que se quieran, siempre que esa variable se encuentre entre los parametros que recibe y que esté vinculada a un campo del submit en el if que recoge los datos del formulario. 
        Devuelve $resultado que es una variable que hace una conexión con la base de datos donde pasa los nuevos datos introducidos. */
    public function modificar_datos (String $nombre, String $nombre_corto, String $descripcion, float $pvp, String $cod) {
        echo('aaa'  . $pvp);
        $consulta = "update producto set nombre = '$nombre', nombre_corto = '$nombre_corto', descripcion = '$descripcion', pvp = $pvp where cod = '$cod' ";

        $resultado = $this->conexion->query($consulta);

        return $resultado;
    }

}
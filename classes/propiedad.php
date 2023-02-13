<?php

namespace App;

class Propiedad{
    protected static $db;
    protected static $ColumnasDB = ['id','titulo','precio','imagen','descripcion',
    'habitaciones','wc','estacionamiento','creado','vendedor'];
    //Arreglo con mensaje de errores
    protected static $errores = [];

    public $id;
    public $titulo;
    public $precio;
    public $imagen;
    public $descripcion;
    public $habitaciones;
    public $wc;
    public $estacionamiento;
    public $creado;
    public $vendedor;

    public static function setDB($database){
        self::$db = $database;
    }
    function __construct($args = [])
    {
        $this->id = $args["id"] ?? '';
        $this->titulo = $args ["titulo"] ?? '';
        $this->precio = $args["precio"] ?? '';
        $this->imagen = $args["imagen"] ?? '';
        $this->descripcion = $args["descripcion"] ?? '';
        $this->habitaciones = $args["habitaciones"] ?? '';
        $this->wc = $args["wc"] ?? '';
        $this->estacionamiento = $args["estacionamiento"] ?? '';
        $this->creado = date("Y/m/d");       
        $this->vendedor = $args["vendedor"] ?? '';

    }



    public function Guardar(){
        //sanitizar datos
        $atributos = $this->SanitizarDatos();
        //insertar datos
        $insertarKey = join(', ',array_keys($atributos));
        
        $insertarValue = join("', '",array_values($atributos));
        $query = "INSERT INTO propiedades($insertarKey) 
                  VALUES('$insertarValue')";

        $resultado = self::$db->query($query);

        return $resultado;
    }

    public function SanitizarDatos(){
        $atributos = $this->atributos();
        $sanitizado = [];
        foreach($atributos as $key => $value){
            $sanitizado[$key] = self::$db->escape_string($value);
        }
        return $sanitizado;
    }

    public function atributos(){
        $atributos = [];
        foreach(self::$ColumnasDB as $columnas){
            if($columnas === 'id') continue;
            $atributos[$columnas] = $this->$columnas;
        }
        return $atributos;
    }

    //Subida de archivos
    public function setImagen($imagen){
        //Asignar al Atributo de la imagen el nombre de la imagen
        if($imagen){
            $this->imagen = $imagen;
        }
    }

    //Validacion
    public static function getErrores(){
        return self::$errores;
    }
    public function validar(){
        
        if(!$this->titulo)
            self::$errores[] = "debes añadir un titulo";
        if(!$this->precio)
            self::$errores[] = "El precio es Obligatorio";
        if(strlen($this->descripcion) <10 )
            self::$errores[] = "La descripcion es obligatoria y debe tener al menos 10 caracteres";
        if(!$this->habitaciones)
            self::$errores[] = "El numero de habitaciones es obligatorio";
        if(!$this->wc)
            self::$errores[] = "El numero de baños es obligatorio";
        if(!$this->estacionamiento)
            self::$errores[] = "El numero de estacionamiento es obligatorio";
        if(!$this->vendedor)
            self::$errores[] = "Seleccione un vendedor";
        if(!$this->imagen)
            self::$errores[] = "La imagen es Obligatoria";
       return self::$errores;
    }

    //Listar Todas Las Propiedades

    public static function all(){
        $query = "SELECT * from propiedades";
        $resultado = self::ConsultarSQL($query);
        return $resultado;

    }
    public static function ConsultarSQL($query){
        //Consultar la base de datos
        $resultado = self::$db->query($query);
        
        //Iterar el resultado
        $array = [];

        while($registro = $resultado->fetch_assoc()){
            $array[] = self::crearObjeto($registro);
        }
        //Liberar la memoria
        $resultado->free();

        //retornar los resultados
        return $array;
    }

    protected static function crearObjeto($registro){
        $objeto = new self;

        foreach($registro as $key => $value){
            if( property_exists( $objeto, $key )){
                $objeto->$key = $value;
            }
        }

        return $objeto;
    }
}
<?php

	class ConexionMySQL {
		
	    //declaración de variables
	    public $host = '127.0.0.1'; // para conectarnos a localhost o el ip del servidor de postgres
	    public $db = 'EDIN_DB'; // seleccionar la base de datos que vamos a utilizar
	    public $user = 'root'; // seleccionar el usuario con el que nos vamos a conectar
	    public $pass = ''; // la clave del usuario
	    public $url; //dirección de la conexión que se usara para destruirla mas adelante
	    public $resultado;
        //creación del constructor
        function __construct(){
        }

	    //función que se utilizara al momento de hacer la instancia de la clase
	    function conectar(){
	        $this->url=mysqli_connect('127.0.0.1', 'root', '', "EDIN_DB");
	        return true;
	    }
	    function usarConexion(){
	    	return $this->url;
	    }
	    //función para destruir la conexión.
	    function destruir(){
	        mysqli_close($this->url);
	    }
        function numero_registros(){
            $numero_filas = mysqli_num_rows($this->resultado);
            return $numero_filas;
        }
        function consultaunica($consulta, $variableconexion){
            $this->resultado = mysqli_query($variableconexion, $consulta);
            $row = $this->resultado->fetch_array();
            return $row;
        }
        function consulta_varios($consulta, $variableconexion){
            $this->resultado = mysqli_query($variableconexion, $consulta);
            $res = [];
            while($row = $this->resultado->fetch_array()){
               $res[] = $row;
            }
            return $res;   
            
        }
	}
?>
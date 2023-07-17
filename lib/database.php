<?php

//se define la clase Database con cuatro propiedades
class Database{
    public $db; //variable publica que representa la conexión a la base de datos.

    //se utilizan para almacenar resultados de consultas y preparar consultas
    //son "protected" para no usarlas nuevamente
    protected $resultado;
    protected $prep;
    protected $consulta;

    public function __construct($dbhost, $dbuser, $dbpass, $dbname)
    {
        $this->db = new mysqli($dbhost, $dbuser, $dbpass, $dbname);
        if($this->db->connect_errno){
            trigger_error("Fallo la conexion con MySQL, tipo de error -> ({$this->db->connect_error})", E_USER_ERROR);
        }
        $this->db->set_charset('utf8');
    }
    public function getUsuarios(){
        $this->resultado = $this->db->query("SELECT * FROM usuarios");
        return $this->resultado->fetch_all(); //Se cambia a all para obtener los resultados de la consulta
    }


    //Llamamos a consulta
    public function preparar($consulta){
        $this->consulta = $consulta;
        $this->prep = $this->db->prepare($this->consulta);
        if(!$this->prep){
            trigger_error("Error al preparar la consulta",
            E_USER_ERROR);
        }else{
            return true;
        }
    }

    public function ejecutar(){
        $this->prep->execute();
    }
    public function prep(){
        return $this->prep;
    }
    public function resultado(){
        return $this->prep->fetch();
    }
    public function cambiarDatabase($db){
        $this->db->select_db($db);
    }

    //Validando
    public function validarDatos($columna, $tabla, $condicion){
        $this->resultado = $this->db->query("SELECT $columna FROM $tabla WHERE $columna = '$condicion'");
        $chequear = $this -> resultado->num_rows;
        return $chequear;

    }

    public function cerrar(){
        $this->prep->close();
        $this->db->close();
    }
}
?>
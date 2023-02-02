<?php

class empleado {

    private $nombre = ""; 
    private $apellido = "";
    private $edad = 0;
    private $genero = "";
    private $estadoCivil = "";
    private $sueldo = 0;

    public function getNombre(){

        return $this->nombre;
    }

    public function setNombre($nombre){
        
        $this->nombre = $nombre;
    }

    public function getApellido(){

        return $this->apellido;
    }

    public function setApellido($apellido){

        $this->apellido = $apellido;

        return $this;
    }

    public function getEdad(){

        return $this->edad;
    }

    public function setEdad($edad){

        $this->edad = $edad;

    }

    public function getGenero(){

        return $this->genero;
    }

    public function setGenero($genero){

        $this->genero = $genero;

    }

    public function getEstadoCivil(){

        return $this->estadoCivil;
    }

    public function setEstadoCivil($estadoCivil){

        $this->estadoCivil = $estadoCivil;
    }

    public function getSueldo(){

        return $this->sueldo;
    }

    public function setSueldo($sueldo){

        $this->sueldo = $sueldo;
    }

}

?>
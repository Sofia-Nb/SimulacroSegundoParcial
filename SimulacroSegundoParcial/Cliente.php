<?php
 class Cliente{
    private $nombre; // STRING.
    private $apellido; // STRING.
    private $estaDadoDeBaja; // BOOLEAN.
    private $tipoDocumento; // STRING DNI, LIBRETA CIVICA, LIBRETA DE ENROLAMIENTO...
    private $numeroDocumento; // ENTERO.
    
    // MÉTODO CONSTRUCTOR.
    public function __construct($nom, $ap, $estado, $tipDoc, $numDoc){
        $this->nombre = $nom;
        $this->apellido = $ap;
        $this->estaDadoDeBaja = $estado;
        $this->tipoDocumento = $tipDoc;
        $this->numeroDocumento = $numDoc;
    }
    
    // MÉTODOS DE ACCESO (GETTERS).
    public function getNombre(){
        return $this->nombre;
    }
    public function getApellido(){
        return $this->apellido;
    }
    public function getEstadoDadoDeBaja(){
        return $this->estaDadoDeBaja;
    }
    public function getTipoDocumento(){
        return $this->tipoDocumento;
    }
    public function getNumeroDocumento(){
        return $this->numeroDocumento;
    }

    // MÉTODOS DE ACCESO (SETTERS).
    public function setNombre($nombre){
        $this->nombre = $nombre;
    }
    public function setApellido($apellido){
        $this->apellido = $apellido;
    }
    public function setEstadoDadoDeBaja($estado){
        $this->estaDadoDeBaja = $estado;
    }
    public function setTipoDocumento($tipoDocumento){
        $this->tipoDocumento = $tipoDocumento;
    }
    public function setNumeroDocumento($numeroDocumento){
        $this->numeroDocumento = $numeroDocumento;
    }

    // MÉTODO __toSTRING.
    public function __toString(){
        $cartelClientes = "CLIENTE: \n";
        $cartelClientes .= "Nombre del cliente: ".$this->getNombre()."\n";
        $cartelClientes .= "Apellido del cliente: ".$this->getApellido()."\n";
        if ($this->getEstadoDadoDeBaja()){
            $cartelClientes .= "Estado: Cliente activo\n";
        }else{
            $cartelClientes .= "Estado: Cliente bloqueado\n";
        }
        $cartelClientes .= "Documento: ".$this->getTipoDocumento()." - N° ".$this->getNumeroDocumento()."\n";
        $cartelClientes .= "-----------------------------------------------------------\n";
        
        return $cartelClientes;
    }
}
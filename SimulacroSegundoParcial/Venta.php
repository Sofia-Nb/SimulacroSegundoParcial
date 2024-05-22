<?php
include_once 'Moto.php';
 class Venta{
    private $numero;
    private $fecha;
    private Cliente $objCliente;
    private $ColeccionMotos;
    private $precioFinal;

    // MÉTODO CONSTRUCTOR.
    public function __construct($num, $fech, Cliente $objCliente, $preFinal, $colMotos){
        $this->numero = $num;
        $this->fecha = $fech;
        $this->objCliente = $objCliente;
        $this->ColeccionMotos = $colMotos;
        $this->precioFinal = $preFinal;
    }
    
    // MÉTODOS DE ACCESO (GETTERS).
    public function getNumero(){
        return $this->numero;
    }
    public function getFecha(){
        return $this->fecha;
    }
    public function getObjCliente(){
        return $this->objCliente;
    }
    public function getColeccionMotos(){
        return $this->ColeccionMotos;
    }
    public function getPrecioFinal(){
        return $this->precioFinal;
    }

    // MÉTODOS DE ACCESO (SETTERS).
    public function setNumero($numero){
        $this->numero = $numero;
    }
    public function setFecha($fecha){
        $this->fecha = $fecha;
    }
    public function setObjCliente($referenciaCliente){
        $this->objCliente = $referenciaCliente;
    }
    public function setColeccionMotos($coleccionMotos){
        $this->ColeccionMotos = $coleccionMotos;
    }
    public function setPrecioFinal($precioFinal){
        $this->precioFinal = $precioFinal;
    }

    public function retornarTotalVentaNacional(){
        $colMotos = $this->getColeccionMotos();
        $costo = 0;
        foreach ($colMotos as $objMoto){
            if ($objMoto instanceof MotosNacional){
                $precio = $objMoto->darPrecioVenta();
                $costo = $costo + $precio;
            }
        }
        return $costo;
    }

    public function retornarMotosImportadas(){
        $colecMotos = $this->getColeccionMotos();
        $colecImportadas = [];
        foreach ($colecMotos as $objMotos){
            if($objMotos instanceof MotosExterior){
                array_push($colecImportadas, $objMotos);
                }else{
                    array_push($colecImportadas, null);
            }
            }
        return $colecImportadas;
    }

    /**
     * recibe por parámetro un objeto moto y lo
     * incorpora a la colección de motos de la venta, siempre y cuando sea posible la venta. El método cada
     * vez que incorpora una moto a la venta, debe actualizar la variable instancia precio final de la venta.
     * Utilizar el método que calcula el precio de venta de la moto donde crea necesario.
     */
    public function incorporarMoto($objMoto){
        $estadoMoto = $objMoto->getActiva();
        if ($estadoMoto){
            $colMotos = $this->getColeccionMotos();
            array_push($colMotos, $objMoto);
            $this->setColeccionMotos($colMotos);
            $precioMoto = $objMoto->darPrecioVenta();
            $precioFinal = $this->getPrecioFinal();
            $precioFinal = $precioFinal + $precioMoto;
            $this->setPrecioFinal($precioFinal);
        }
    }


    // LEER COLECCION DE MOTOS.
    public function leerColMotos($colMotos){
        $cartel = "";
        foreach ($colMotos as $objMoto){
            $cartel .= $objMoto."\n";
        }
        return $cartel;
    }

    // MÉTODO __toSTRING.
    public function __toString(){
        $colMotos = $this->getColeccionMotos();
        $cartelVentas = "VENTA NÚMERO ".$this->getNumero().": \n";
        $cartelVentas .= "Fecha de venta: ".$this->getFecha()."\n";
        $cartelVentas .= $this->getObjCliente()."\n";
        $cartelVentas .= "Precio final: ".$this->getPrecioFinal()."\n";
        $cartelVentas .= "MOTOS: \n";
        $cartelVentas .= $this->leerColMotos($colMotos)."\n";
        $cartelVentas .= "------------------------------------------------\n";

        return $cartelVentas;
    }
 }
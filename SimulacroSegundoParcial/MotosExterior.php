<?php
include_once 'Moto.php';
class MotosExterior extends Moto{
    private $pais;
    private $impuestoImporte;

    public function __construct($pa, $impImporte, $cod, $cost, $anioFabric, $desc, $incrementoAnual, $act){
        parent::__construct($cod, $cost, $anioFabric, $desc, $incrementoAnual, $act);

        $this->pais = $pa;
        $this->impuestoImporte = $impImporte;
    }

    public function getPais(){
        return $this->pais;
    }

    public function getImpuestoImporte(){
        return $this->impuestoImporte;
    }

    public function setPais($pais){
        $this->pais = $pais;
    }

    public function setImpuestoImporte($impImpuesto){
        $this->impuestoImporte = $impImpuesto;
    }

    public function darPrecioVenta(){
        $precioTotal = parent::darPrecioVenta();
        $impuesto = $this->getImpuestoImporte();
        $precio = $precioTotal + $impuesto;
        return $precio;
    }

    public function __toString(){
        $cartelE = parent:: __toString();
        $cartelE .= "Importada de: ".$this->getPais()."\n";
        $cartelE .= "Costo: ".$this->darPrecioVenta()."\n";
        return $cartelE;
    }
}

<?php
include_once 'Moto.php';
class MotosNacional extends Moto{
    private $porcentajeDescuento;

    public function __construct($porcentaje , $cod, $cost, $anioFabric, $desc, $incrementoAnual, $act){
        parent::__construct($cod, $cost, $anioFabric, $desc, $incrementoAnual, $act);

        $this->porcentajeDescuento = $porcentaje;
    }

    public function getPorcentaje(){
        return $this->porcentajeDescuento;
    }

    public function setPorcentaje($porcentaje){
        $this->porcentajeDescuento = $porcentaje;
    }

    public function darPrecioVenta(){
        $precioTotal = parent::darPrecioVenta();
        $porcentaje = $this->getPorcentaje();
        $descuento = ($precioTotal * $porcentaje) / 100;
        $precio = $precioTotal - $descuento;
        return $precio;
    }

    public function __toString(){
        $cartelN = parent:: __toString();
        $cartelN .= "Costo: ".$this->darPrecioVenta()."\n";
        return $cartelN;
    }

}
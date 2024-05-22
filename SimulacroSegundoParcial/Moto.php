<?php
 class Moto{
    private $codigo; // ENTERO
    private $costo; // FLOAT
    private $anioFabricacion; // ENTERO
    private $descripcion; // STRING
    private $porcentajeIncrementoAnual; // ENTERO
    private $activa; // BOOLEAN: DISPONIBLE (TRUE) NO DISPONIBLE (FALSE)

    // MÉTODO CONSTRUCTOR.
    public function __construct($cod, $cost, $anioFabric, $desc, $incrementoAnual, $act){
        $this->codigo = $cod;
        $this->costo = $cost;
        $this->anioFabricacion = $anioFabric;
        $this->descripcion = $desc;
        $this->porcentajeIncrementoAnual = $incrementoAnual;
        $this->activa = $act;
    }
    
    // MÉTODOS DE ACCESO (GETTERS).
    public function getCodigo(){
        return $this->codigo;
    }
    public function getCosto(){
        return $this->costo;
    }
    public function getAnioFabricacion(){
        return $this->anioFabricacion;
    }
    public function getDescripcion(){
        return $this->descripcion;
    }
    public function getPorcentajeIncrementoAnual(){
        return $this->porcentajeIncrementoAnual;
    }
    public function getActiva(){
        return $this->activa;
    }
    
    // MÉTODOS DE ACCESO (SETTERS).
    public function setCodigo($codigo){
        $this->codigo = $codigo;
    }
    public function setCosto($costo){
        $this->costo = $costo;
    }
    public function setAnioFabricacion($anioFabricacion){
        $this->anioFabricacion = $anioFabricacion;
    }
    public function setDescripcion($descripcion){
        $this->descripcion = $descripcion;
    }
    public function setPorcentajeIncrementoAnual($porcentajeIncrementoAnual){
        $this->porcentajeIncrementoAnual = $porcentajeIncrementoAnual;
    }
    public function setActiva($activa){
        $this->activa = $activa;
    }

    /**
     * Redefinir el método darPrecioVenta para que en el caso de las motos 
     * nacionales aplique el porcentaje de descuento sobre el valor 
     * calculado inicialmente. Para el caso de las motos importadas, 
     * al valor calculado se debe sumar el impuesto que pagó la empresa 
     * por su importación.  A continuación se describe el método  
     * darPrecioVenta  con el objetivo de tener presente su implementación y 
     * realizar las modificaciones que crea necesarias para dar soporte 
     * al nuevo requerimiento. 
     */
    public function darPrecioVenta(){
        $validacion = $this->getActiva();
        $compra = $this->getCosto();
        $anioFabricacion = $this->getAnioFabricacion();
        $anio = date("Y") - $anioFabricacion;
        $porIncanual = $this->getPorcentajeIncrementoAnual();
        if ($validacion){
            $venta = $compra + $compra * ($anio * $porIncanual);
        }else{
            $venta = 0;
        }
        return $venta;
    }

        // MÉTODO estadoCliente: Este método valida si el cliente está o no dado de baja.
        public function estadoActivo(){
            $res = "";
            $validacion = $this->getActiva(); // valor TRUE o FALSE.
            if ($validacion){
                $res = "Disponible.\n";
            }else{
                $res = "No disponible\n";
            }
            return $res;
        }

    // MÉTODO __toSTRING.
    public function __toString(){
        $cartelMotos =  "MOTO: \n";
        $cartelMotos .= "Código de la moto: ".$this->getCodigo()."\n";
        $cartelMotos .= "Año de fabricacion: ".$this->getAnioFabricacion()."\n";
        $cartelMotos .= "Descripcion: ".$this->getDescripcion()."\n";
        $cartelMotos .= "Estado: ".$this->estadoActivo()."\n";
        return $cartelMotos;
    }
 }
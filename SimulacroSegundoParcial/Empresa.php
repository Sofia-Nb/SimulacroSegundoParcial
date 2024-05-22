<?php
 class Empresa {
    private $denominacion;
    private $direccion;
    private $coleccionClientes;
    private $coleccionMotos;
    private $coleccionVentas;

    public function __construct($denom, $direc, $colClient, $colMotos, $colVentas){
        $this->denominacion = $denom;
        $this->direccion = $direc;
        $this->coleccionClientes = $colClient;
        $this->coleccionMotos = $colMotos;
        $this->coleccionVentas = $colVentas;
    }

    public function getDenominacion(){
        return $this->denominacion;
    }
    public function getDireccion(){
        return $this->direccion;
    }
    public function getColeccionClientes(){
        return $this->coleccionClientes;
    }
    public function getColeccionMotos(){
        return $this->coleccionMotos;
    }
    public function getColeccionVentas(){
        return $this->coleccionVentas;
    }

    public function setDenominacion($denominacion){
        $this->denominacion = $denominacion;
    }
    public function setDireccion($direccion){
        $this->direccion = $direccion;
    }
    public function setColeccionClientes($coleccionClientes){
        $this->coleccionClientes = $coleccionClientes;
    }
    public function setColeccionMotos($coleccionMotos){
        $this->coleccionMotos = $coleccionMotos;
    }
    public function setColeccionVentas($coleccionVentas){
        $this->coleccionVentas = $coleccionVentas;
    }

    /**
     * recorre la colección de motos de la Empresa y
     * retorna la referencia al objeto moto cuyo código coincide con el recibido por parámetro.
     */
    public function retornarMoto($codigoMoto){
        $arrayMotos = $this->getColeccionMotos();
        $objMoto= null;
        $i=0;
        while($i<count($arrayMotos) && $objMoto == null){
            if($arrayMotos[$i]->getCodigo() == $codigoMoto){
                $objMoto = $arrayMotos[$i];
            }
            $i++;
        }return $objMoto;
        }      

     /**
      * recibe por parámetro una colección de códigos de motos, la cual es recorrida, y por cada elemento de la colección
      * se busca el objeto moto correspondiente al código y se incorpora a la colección de motos de la instancia
      * Venta que debe ser creada. Recordar que no todos los clientes ni todas las motos, están disponibles
      * para registrar una venta en un momento determinado.
      * El método debe setear los variables instancias de venta que corresponda y retornar el importe final de la
     * venta.
     */

     public function registrarVenta($colCodigosMoto, $objCliente){
        $importeFinal = 0;
        if ($objCliente->getEstadoDadoDeBaja()){
            $copiaColVentas = $this->getColeccionVentas();
            $idVenta = count($copiaColVentas)+1;
            $nuevaVenta = new Venta ($idVenta, date("m/d/y"), $objCliente, 0, []);
            $colMotos = $this->getColeccionMotos();

            foreach ($colCodigosMoto as $unCodigoMoto){
                $unObjMoto = $this->retornarMoto($unCodigoMoto);
                if($unObjMoto != null){
                    $nuevaVenta->incorporarMoto($unObjMoto);
                }
            }
            if (count($nuevaVenta->getColeccionMotos()) > 0){
                array_push($copiaColVentas, $nuevaVenta);
                $this->setColeccionVentas($copiaColVentas);
                $importeFinal = $importeFinal + $nuevaVenta->getPrecioFinal();
            }
        }else{
            $importeFinal = -1;
        }
        return $importeFinal;
     }

        
    /**
     * recibe por parámetro el tipo y
     * número de documento de un Cliente y retorna una colección con las ventas realizadas al cliente.
     */
    public function retornarVentasXCliente($tipo, $numDoc){
            $coleccionVentas = $this->getColeccionVentas();
            $colVentasClientes = [];
            foreach ($coleccionVentas as $objVentas){
                $objCliente = $objVentas->getObjCliente();
                $tipoDocumento = $objCliente->getTipoDocumento();
                $numeroDocumento = $objCliente->getNumeroDocumento();
                if (($tipo == $tipoDocumento) && ($numDoc == $numeroDocumento)){
                    array_push($colVentasClientes, $objVentas);
                }
            }
            return $colVentasClientes;
         }

    public function informarSumaVentasNacionales(){
        $colVentas = $this->getColeccionVentas();
        $totalVentaNacional = 0;
        foreach ($colVentas as $objVenta){
            $totalVentaNacional += $objVenta->retornarTotalVentaNacional();
        }
        return $totalVentaNacional;
    }

    
    public function informarVentasImportadas(){
        $colecVentas = $this->getColeccionMotos();
        $colecVentasImpor = [];
        foreach ($colecVentas as $objVenta){
            $coleccionIm = $objVenta->retornarMotosImportadas();
            if (count($coleccionIm) > 0){
                foreach ($coleccionIm as $objMoto){
                array_push($colecVentasImpor, $objMoto);
                }
            }
        }
        return $colecVentasImpor;
    }

    public function leerColeccion($coleccion){
        $cartel = "";
        foreach ($coleccion as $objeto){
            $cartel .= $objeto."\n";
        }
        return $cartel;
    }

    public function __toString(){
            $colMotos = $this->getColeccionMotos();
            $colClientes = $this->getColeccionClientes();
            $cartelEmpresa = "EMPRESA: \n";
            $cartelEmpresa .= "Denominación: ".$this->getDenominacion()."\n";
            $cartelEmpresa .= "Dirección: ".$this->getDireccion()."\n";
            $cartelEmpresa .= "CLIENTES: ".$this->leerColeccion($colClientes);
            $cartelEmpresa .= "MOTOS: ".$this->leerColeccion($colMotos);
            $cartelEmpresa .= "VENTAS: ".$this->leerColeccion($this->getColeccionVentas());
            $cartelEmpresa .= "------------------------------------------------\n";
            return $cartelEmpresa;
         }
 }
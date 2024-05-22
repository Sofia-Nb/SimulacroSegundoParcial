<?php
include_once 'Cliente.php';
include_once 'MotosExterior.php';
include_once 'MotosNacional.php';
include_once 'Venta.php';
include_once 'Empresa.php';

// OBJETOS CLIENTE
$objCliente1 = new Cliente("Maria", "Luna", true, "DNI", 56342675);
$objCliente2 = new Cliente("Juan", "Flores", false, "DNI", 47356876);

// OBJETOS MOTOS
$objMoto1 = new MotosNacional(10, 11, 2230000, 2022, "Benelli Imperiale 400", 85, true);
$objMoto2 = new MotosNacional(10, 12, 584000, 2021, "Zanella Zr 150 Ohc", 70, true);
$objMoto3 = new MotosNacional(null, 13, 999900, 2023, "Zanella Patagonian Eagle 250", 55, false);

$objMoto4 = new MotosExterior("Francia", 6244400, 14, 12499900, 2020, "Pitbike Enduro Motocross Apollo Aiii 190cc Plr", 100, true);

// OBJETO EMPRESA
$objEmpresa = new Empresa("Alta Gama", "Av Argenetina 123", [$objCliente1, $objCliente2], [$objMoto1, $objMoto2, $objMoto3, $objMoto4], []);

// (4) MÉTODO registrarVenta.

$primerPunto = $objEmpresa->registrarVenta([11, 12, 13, 14], $objCliente2);
echo $primerPunto;

// (5) MÉTODO registrarVenta.

$segundoPunto = $objEmpresa->registrarVenta([13, 14], $objCliente2);
echo $segundoPunto;

// (6) MÉTODO registrarVenta.

$tercerPunto = $objEmpresa->registrarVenta([14, 2], $objCliente2);
echo $tercerPunto;

// (7) MÉTODO InformarVentasImportadas.

//$colMotosImportadas = $objEmpresa->informarVentasImportadas();
//foreach ($colMotosImportadas as $objMoto){
//echo $objMoto;
//}

// (8) MÉTODO informarSumaVentasNacionales

$totalMotosNacionales = $objEmpresa->informarSumaVentasNacionales();
echo $totalMotosNacionales;

// (9) ECHO empresa.

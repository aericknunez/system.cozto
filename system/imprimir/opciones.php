<?php 



if ($_GET["op"] == 10) { /// imprimir listado de cuotas pendientes
    include_once 'Imprime.php';
    $print = new Imprime(); 
    $print->TodosProductos(); 
}

if ($_GET["op"] == 11) { /// imprimir listado de cuotas pendientes
    include_once 'Imprime.php';
    $print = new Imprime(); 
    $print->BajasExistencias(); 
}

if ($_GET["op"] == 12) { /// imprimir listado de cuotas pendientes
    include_once 'Imprime.php';
    $print = new Imprime(); 
    $print->ProductosResumen(); 
}



?>
<?php 
  if($_SERVER['HTTP_REFERER'] == NULL) $dir = "http://". $_SERVER['HTTP_HOST'] . "/cozto"; else $dir = $_SERVER['HTTP_REFERER'];


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




?>
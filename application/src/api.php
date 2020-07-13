<?php
include_once '../common/Helpers.php'; // [Para todo]
include_once '../includes/variables_db.php';
include_once '../common/Mysqli.php';
$db = new dbConn();

// ESTE ARCHIVO ES EXCLUSIVO SOLO PARA ECOMMERCE, AQUI SE EJECUTAN LAS SOLICITUDES DEL SERVER

include_once '../common/Alerts.php';
include_once '../common/Fechas.php';
include_once '../common/Encrypt.php';
include_once '../common/Dinero.php';

// print_r(array_sort($people, 'age', SORT_DESC)); // Sort by oldest first
// print_r(array_sort($people, 'surname', SORT_ASC)); // Sort by surname


//FALTA:
//agregar productos al carrito
//agregar ususarios
//pasarela de pagos
// carrito // productos que ha agregado



if($_REQUEST["cantidad"] != NULL){
	$limit = "limit " . $_REQUEST["cantidad"];
} else {
	$limit = NULL;
}

switch ($_REQUEST["op"]) {


case "11":
	include_once '../../system/ecommerce/Ecommerce.php';
	$data = new EcommerceData();
	$data->Destacados($limit, $_REQUEST["td"], "RAND()"); // para destacados (Limit cantidad, td, orderby[id DESC, id ASC, RAND()]
break;



case "12":
	include_once '../../system/ecommerce/Ecommerce.php';
	$data = new EcommerceData();
	$data->Categorias($limit, $_REQUEST["td"], "RAND()", $_REQUEST["categoria"]); // para destacados (limit cantidad, td, orderby[id DESC, id ASC, RAND()], categoria
break;



case "13":
	include_once '../../system/ecommerce/Ecommerce.php';
	$data = new EcommerceData();
	$data->Promociones($limit, $_REQUEST["td"], "RAND()"); // para promociones (Limit cantidad, td, orderby[id DESC, id ASC, RAND()]
break;



case "14":
	include_once '../../system/ecommerce/Ecommerce.php';
	$data = new EcommerceData();
	$data->Producto($_REQUEST["cod"], $_REQUEST["td"]); // para detalles de un producto (codigo, td]
break;








} // termina switch














/////////
$db->close();
?>
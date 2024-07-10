<?php
header("Content-type: application/json; charset=utf-8");
include_once 'includes/Helpers.php';
include_once 'includes/variables_db.php';
include_once 'includes/Mysqli.php';
$db = new dbConn();


// if($_SESSION["user"] == NULL and $_SESSION["td"] == NULL){
// echo '<script>
// 	window.location.href="application/includes/logout.php"
// </script>';
// exit();
// }


switch ($_REQUEST["op"]) {


case "10": /// guardar datos de orden
	include_once 'api/Api.php';
	$api = new Api;
	$api->ObtenerOrdenes($_REQUEST["iden"]); /// se busca por el destino (solo para destino)
break;



case "11": // obtener orden
	$data = file_get_contents('php://input');
	include_once 'api/Api.php';
	$api = new Api;
	$api->AddOrden($data);
break;


case "12": // aceptar toda la orden
	include_once 'api/Api.php';
	$api = new Api;
	$api->AceptarOrden($_REQUEST["hash"]);  // pasar orden y productos a edo 2
break;


case "13": // aceptar producto de la orden
	include_once 'api/Api.php';
	$api = new Api;
	$api->AceptarProducto($_REQUEST); // orden{hash} y identificador{id} a edo 2
break;


case "14": // rechazar producto de la orden
	include_once 'api/Api.php';
	$api = new Api;
	$api->RechazarProducto($_REQUEST); // orden{hash} y identificador{id} a edo 3
break;


case "15": // rechazar toda la orden
	include_once 'api/Api.php';
	$api = new Api;
	$api->RechazarOrden($_REQUEST["hash"]); // pasar orden y productos a edo 3
break;


case "16": // Eliminar toda la orden
	include_once 'api/Api.php';
	$api = new Api;
	$api->EliminarOrden($_REQUEST["hash"]); /// pasar orden y productos a edo 0 y solo puede hacerlo quien creo la orden y no ha sid0 aceptada
break;



case "17": // emparejar sistemas
	$data = file_get_contents('php://input');
	include_once 'api/Api.php';
	$api = new Api;
	$api->EmparejarSistemas($data); /// obtiene s1 y s2 via post
break;



case "18": /// guardar datos de orden
	include_once 'api/Api.php';
	$api = new Api;
	$api->ObtieneProductos($_REQUEST["hash"]); /// se busca por el destino (solo para destino)
break;



case "19": /// obtener Cuentass
	include_once 'api/Api.php';
	$api = new Api;
	$api->CuentasVinculadas($_REQUEST["origen"]); /// obtiene las cuentas que estan vinculadas a este destino
break;



case "20": /// guardar datos de orden
	include_once 'api/Api.php';
	$api = new Api;
	$api->ObtenerOrdenesEnviadas($_REQUEST["iden"]); /// se busca por el destino (solo para destino)
break;



case "21": // obtener orden
	$data = file_get_contents('php://input');
	include_once 'api/Api.php';
	$api = new Api;
	$api->AddCliente($data);
break;



case "22": // devolver productos de la orden rechazada
	include_once 'api/Api.php';
	$api = new Api;
	$api->DevolverProductos($_REQUEST["hash"]); // devuelve los prodcutos de las ordenes rechazadas y productos a edo 3
break;



case "23": // obtiene el listado de clientes registrados
	include_once 'api/Api.php';
	$api = new Api;
	$api->ClientesRegistrados();
break;





// case "12": // destacados del index pequenos
// include_once '../../system/index/ProductosDestacadosP.php';
// 	$ind = new Index(); //&order=DESC
// 	$cantidad = $_POST["cantidad"];
// 	$ind->ProductosDestacados(URL_SERVER . "application/src/api.php?op=11&cantidad=".$cantidad."&td=" . TD_SERVER);
// break;



// case "13": // destacados del index // grandes en multiplos de 4
// include_once '../../system/index/ProductosDestacados.php';
// 	$ind = new Index(); 
// 	$ind->ProductosDestacados(URL_SERVER . "application/src/api.php?op=11&cantidad=12&td=" . TD_SERVER);
// break;


} // termina switch


/////////
$db->close();
?>
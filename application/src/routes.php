<?php
include_once '../common/Helpers.php'; // [Para todo]
include_once '../includes/variables_db.php';
include_once '../common/Mysqli.php';
$db = new dbConn();
include_once '../includes/DataLogin.php';
$seslog = new Login();
$seslog->sec_session_start();


include_once '../common/Alerts.php';
include_once '../common/Fechas.php';
include_once '../common/Encrypt.php';
include_once '../common/Dinero.php';




// filtros para cuando no hay session abierta
if ($seslog->login_check() != TRUE) {
echo '<script>
	window.location.href="application/includes/logout.php"
</script>';
} 

if($_SESSION["user"] == NULL and $_SESSION["td"] == NULL){
echo '<script>
	window.location.href="application/includes/logout.php"
</script>';
exit();
}


switch ($_REQUEST["op"]) {


case "10":
	include_once '../../system/config_configuraciones/Config.php';
	$configuracion = new Config;
	$configuracion->Configuraciones($_POST);
break;



case "11":
include_once '../../system/config_configuraciones/Config.php';
	$configuracion = new Config;
	$configuracion->Root($_POST);
break;



case "12":
include("../common/Imagenes.php");
	$imagen = new upload($_FILES['archivo']);
include("../../system/config_configuraciones/ImagenesSuccess.php");
$imgs = new Success();

	if($imagen->uploaded) {
		if($imagen->image_src_y > 800 or $imagen->image_src_x > 800){ // si ancho o alto es mayir a 800
			$imagen->image_resize         		= true; // default is true
			$imagen->image_ratio        		= true; // para que se ajuste dependiendo del ancho definido
			$imagen->image_x              		= 700; // para el ancho a cortar
			$imagen->image_y              		= 700; // para el alto a cortar
		}
		$imagen->file_new_name_body   		= Helpers::TimeId(); // agregamos un nuevo nombre
		// $imagen->image_watermark      		= 'watermark.png'; // marcado de agua
		// $imagen->image_watermark_position 	= 'BR'; // donde se ub icara el marcado de agua. Bottom Right		
		$imagen->process('../../assets/img/logo/');	

		$imgs->SaveImagen($imagen->file_dst_name, $imagen->image_dst_x, $imagen->image_dst_y);
		$_SESSION['config_imagen'] = $imagen->file_dst_name; // cambio el logo de la variable
	} // [file_dst_name] nombre de la imagen
	else {
	  Alerts::Alerta("error","Error!","Error: " . $imagen->error);
	  $imgs->VerImgNegocio("assets/img/logo/");
	}

break;



case "13":
	include_once '../../system/config_configuraciones/Config.php';
	$configuracion = new Config;
	$configuracion->ModTabla($_POST);
break;


case "14":  /// para el div de regarga automatico
echo Helpers::SelectData($_REQUEST["select"], $_REQUEST["tabla"], $_REQUEST["iden"], $_REQUEST["nombre"]);
break;



case "15": /// cambia de rapido a lento

	if($_SESSION["tipo_inicio"] == 1){
		$_SESSION["tipo_inicio"] = 2;
	} else {
		$_SESSION["tipo_inicio"] = 1;
	}
break;



case "16":
include("../common/Imagenes.php");
	$imagen = new upload($_FILES['archivo']);
include("../../system/producto/ImagenesSuccess.php");
$imgs = new Success();

	if($imagen->uploaded) {
		if($imagen->image_src_y > 800 or $imagen->image_src_x > 800){ // si ancho o alto es mayir a 800
			$imagen->image_resize         		= true; // default is true
			$imagen->image_ratio        		= true; // para que se ajuste dependiendo del ancho definido
			$imagen->image_x              		= 800; // para el ancho a cortar
			$imagen->image_y              		= 800; // para el alto a cortar
		}
		$name = Helpers::TimeId();
		$imagen->file_new_name_body   			= $name; // agregamos un nuevo nombre
		// $imagen->image_watermark      		= 'watermark.png'; // marcado de agua
		// $imagen->image_watermark_position 	= 'BR'; // donde se ub icara el marcado de agua. Bottom Right		
		$imagen->process('../../assets/img/productos/' . $_SESSION["td"] . '/');	

		$imgs->SaveProducto($_POST['producto'], $imagen->file_dst_name, $_POST['descripcion'], $imagen->image_dst_x, $imagen->image_dst_y);


		$imagen->image_resize          = true;
		$imagen->image_ratio_crop      = true;
		$imagen->image_y               = 400;
		$imagen->image_x               = 400;
		$imagen->file_new_name_body   			= "tmb_" .$name;
		$imagen->process('../../assets/img/productos/' . $_SESSION["td"] . '/tmb/');
	} // [file_dst_name] nombre de la imagen
	else {
	  echo 'error : ' . $imagen->error;
	  $imgs->VerProducto($_POST['producto'], "assets/img/productos/" . $_SESSION["td"] . "/");
	}	
break;



case "17":
include("../../system/producto/ImagenesSuccess.php");
	$imgs = new Success();
	$imgs->BorrarImagen($_REQUEST['hash'], "../../assets/img/productos/" . $_SESSION["td"] . "/", $_REQUEST['producto']);
break;



case "18": 
include_once '../../system/producto/ImagenesSuccess.php';
$imgs = new Success();
$imgs->VerImg($_REQUEST["key"], "assets/img/productos/" . $_SESSION["td"] . "/");
break;


case "19": // formulario add sub categoria
include_once '../../system/producto/Productos.php';
	$productos = new Productos;
	$productos->AddSubCategoria($_POST);
break;



case "20": // agrega primeros datos del producto
include_once '../../system/producto/Productos.php';
	$productos = new Productos;
// si es autoparts
	if($_SESSION["root_autoparts"] == "on"){
		include_once '../../system/autoparts/Autoparts.php';
	}	
	if($_SESSION["root_taller"] == "on"){ // solo si es taller
		include_once '../../system/taller/Productos.php';
	}
	$productos->AddProducto($_POST);
break;



case "21": // agrega mas productos al inventario
include_once '../../system/producto/Productos.php';
	$productos = new Productos;
	$productos->IngresarProducto($_POST);
break;



case "22": // formulario add categoria
include_once '../../system/producto/Productos.php';
	$productos = new Productos;
	$productos->AddCategoria($_POST);
break;



case "23": // borrar categoria y sub categoria
include_once '../../system/producto/Productos.php';
	$productos = new Productos;
	$productos->DelCategoria($_REQUEST["hash"], $_REQUEST["tipo"]);
break;



case "23z": // borrar categoria y sub categoria
include_once '../../system/producto/Productos.php';
	$productos = new Productos;
	$productos->NombreCat($_POST["hash"]);
break;



case "23x": // borrar categoria y sub categoria
include_once '../../system/producto/Productos.php';
	$productos = new Productos;
	$productos->RenameCat($_POST);
break;



case "24": // formulario Unidad de medida
include_once '../../system/producto/Productos.php';
	$productos = new Productos;
	$productos->AddUnidad($_POST);
break;



case "25": // borrar unidad de medida
include_once '../../system/producto/Productos.php';
	$productos = new Productos;
	$productos->DelUnidad($_REQUEST["hash"]);
break;



case "26": // formulario caracteristicas
include_once '../../system/producto/Productos.php';
	$productos = new Productos;
	$productos->AddCaracteristica($_POST);

break;



case "27": // borrar caracteristicas
include_once '../../system/producto/Productos.php';
	$productos = new Productos;
	$productos->DelCaracteristica($_REQUEST["hash"]);
break;



case "28": // formulario ubicacion
include_once '../../system/producto/Productos.php';
	$productos = new Productos;
	$productos->AddUbicacion($_POST);

break;



case "28z": // borrar categoria y sub categoria
include_once '../../system/producto/Productos.php';
	$productos = new Productos;
	$productos->NombreUbi($_POST["hash"]);
break;



case "28x": // borrar categoria y sub categoria
include_once '../../system/producto/Productos.php';
	$productos = new Productos;
	$productos->RenameUbi($_POST);
break;



case "29": // borrar ubicacion
include_once '../../system/producto/Productos.php';
	$productos = new Productos;
	$productos->DelUbicacion($_REQUEST["hash"]);
break;



case "30": // agrega los precios de cada producto
include_once '../../system/producto/Productos.php';
	$productos = new Productos;
	$productos->AddPrecios($_POST);
break;



case "31": // elimina los precios de cada producto
include_once '../../system/producto/Productos.php';
	$productos = new Productos;
	$productos->DelPrecios($_REQUEST["hash"], $_REQUEST["producto"]);
break;


case "30x": // agrega los precios de mayorista
include_once '../../system/producto/Productos.php';
	$productos = new Productos;
	$productos->AddPreciosMayorista($_POST);
break;



case "31x": // elimina los precios de mayorista
include_once '../../system/producto/Productos.php';
	$productos = new Productos;
	$productos->DelPrecioMayorista($_REQUEST["hash"], $_REQUEST["producto"]);
break;



case "30y": // agrega los precios de promo
include_once '../../system/producto/Productos.php';
	$productos = new Productos;
	$productos->AddPrecioPromo($_POST);
break;



case "31y": // elimina los precios de promo
include_once '../../system/producto/Productos.php';
	$productos = new Productos;
	$productos->DelPrecioPromo($_REQUEST["hash"], $_REQUEST["producto"]);
break;


case "32": // busqueda de productos para compuestos
include_once '../../system/producto/Productos.php';
	$productos = new Productos;
	$productos->CompuestoBusqueda($_POST);
break;



case "33": // agrega los compuesto
include_once '../../system/producto/Productos.php';
	$productos = new Productos;
	$productos->AddCompuesto($_POST);
break;



case "34": // elimina compuesto del producto
include_once '../../system/producto/Productos.php';
	$productos = new Productos;
	$productos->DelCompuesto($_REQUEST["hash"], $_REQUEST["producto"]);
break;



case "35": // agrega los dependiente
include_once '../../system/producto/Productos.php';
	$productos = new Productos;
	$productos->AddDependiente($_POST);
break;



case "36": // elimina dependiente del producto
include_once '../../system/producto/Productos.php';
	$productos = new Productos;
	$productos->DelDependiente($_REQUEST["hash"], $_REQUEST["producto"]);
break;



case "37": // busqueda de productos para compuestos
include_once '../../system/producto/Productos.php';
	$productos = new Productos;
	$productos->TagsBusqueda($_POST["keyword"]);
break;



case "38": // agrega nueva tag
include_once '../../system/producto/Productos.php';
	$productos = new Productos;
	$productos->AddTag($_POST);
break;



case "39": // elimina tag
include_once '../../system/producto/Productos.php';
	$productos = new Productos;
	$productos->DelTag($_REQUEST["hash"], $_REQUEST["producto"]);
break;



case "40": // asigna ubicacion
include_once '../../system/producto/Productos.php';
	$productos = new Productos;
	$productos->AddUbicacionAsig($_POST);
break;



case "41": // elimina ubicacion
include_once '../../system/producto/Productos.php';
	$productos = new Productos;
	$productos->DelUbicacionAsig($_REQUEST["hash"], $_REQUEST["producto"]);
break;



case "42": // Para select de ubicacion
include_once '../../system/producto/Productos.php';
	$productos = new Productos;
	$productos->SelectUbicacion();
break;



case "43": // asigna caracteristica
include_once '../../system/producto/Productos.php';
	$productos = new Productos;
	$productos->AddCaracteristicaAsig($_POST);
break;



case "44": // elimina caracteristica
include_once '../../system/producto/Productos.php';
	$productos = new Productos;
	$productos->DelCaracteristicaAsig($_REQUEST["hash"], $_REQUEST["producto"]);
break;



case "45": // Para select de caracteristica
include_once '../../system/producto/Productos.php';
	$productos = new Productos;
	$productos->SelectCaracteristica();
break;



case "46": // actualiza el producto
include_once '../../system/producto/ProUpdate.php';
	$productos = new ProUpdate;
	if($_SESSION["root_taller"] == "on"){ // solo si es taller
		include_once '../../system/taller/Productos.php';
	}
	$productos->UpProducto($_POST);
break;



case "47": 
include_once '../../system/producto/ProUpdate.php';
	$productos = new ProUpdate;
	$productos->UrlNext($_REQUEST["key"], $_REQUEST["step"],$_REQUEST["cad"],$_REQUEST["com"],$_REQUEST["dep"]);
break;



case "48": 
include_once '../../system/producto/ProUpdate.php';
	$productos = new ProUpdate;
	$productos->ProAgrega($_POST);

	// print_r($_POST);
break;



case "49": // elimina producto
include_once '../../system/producto/ProUpdate.php';
	$productos = new ProUpdate;
	$productos->DelProAgrega($_REQUEST["hash"], $_REQUEST["producto"]);
break;



case "50": // busqueda de productos para compuestos
include_once '../../system/producto/ProUpdate.php';
	$productos = new ProUpdate;
	$productos->AgregaBusqueda($_POST);
break;



case "51": 
include_once '../../system/producto/ProUpdate.php';
	$productos = new ProUpdate;
	$productos->AddAveria($_POST);
break;



case "52": // elimina averias
include_once '../../system/producto/ProUpdate.php';
	$productos = new ProUpdate;
	$productos->DelAveria($_REQUEST["hash"], $_REQUEST["producto"]);
break;



case "53": // busqueda de productos para compuestos
include_once '../../system/producto/ProUpdate.php';
	$productos = new ProUpdate;
	$productos->AveriaBusqueda($_POST);
break;



case "54": // ver todos los producto
include_once '../../system/producto/Productos.php';
	$productos = new Productos;
	$productos->VerTodosProductos($_POST["iden"], $_POST["orden"], $_POST["dir"]);
break;



case "54x": // ver todos los producto de la busqueda
	$_SESSION["psearch"] = $_POST["keyword"];

	include_once '../../system/producto/Productos.php';
		$productos = new Productos;

	if($_SESSION["psearch"] == NULL){
		$productos->VerTodosProductos(1, "producto.id", "asc");
	} else {
		$productos->VerProductosSearch(1, "producto.id", "asc", $_SESSION["psearch"]);
	}
	
break;



case "55": // detalles del producto
include_once '../../system/producto/Productos.php';
	$productos = new Productos;
	$productos->DetallesProducto($_POST);
break;



case "56": // Bajas Existancias
include_once '../../system/producto/Productos.php';
	$productos = new Productos;
	$productos->BajasExistencias($_POST["iden"], $_POST["orden"], $_POST["dir"]);
break;



case "57": // Bajas caducidades
include_once '../../system/producto/ProductoOtros.php';
	$productos = new ProductoOtros;
	$productos->Caducidades();
break;



case "58": // ver detalles del producto desde modal
include_once '../../system/ventas/ProductoBusqueda.php';
	$proBusqueda = new ProductoBusqueda;
	$proBusqueda->DetallesProducto($_POST);
break;



case "59": // ver detalles del proveedor modal
include_once '../../system/proveedor/Proveedor.php';
	$proveedor = new Proveedores;
	$proveedor->VistaProveedor($_POST);
break;



case "60": // agregar proveedor
include_once '../../system/proveedor/Proveedor.php';
	$proveedor = new Proveedores;
	$proveedor->AddProveedor($_POST);
break;



case "61": // elimina proveedor
include_once '../../system/proveedor/Proveedor.php';
	$proveedor = new Proveedores;
	$proveedor->DelProveedor($_REQUEST["hash"]);
break;



case "62": // elimina proveedor desde liasta completa
include_once '../../system/proveedor/Proveedor.php';
	$proveedor = new Proveedores;
	$proveedor->DelProveedorx($_REQUEST["hash"]);
break;



case "63": // actualizar proveedor
include_once '../../system/proveedor/Proveedor.php';
	$proveedor = new Proveedores;
	$proveedor->UpProveedor($_POST);
break;



case "64": // agregar cliente
include_once '../../system/cliente/Cliente.php';
	$cliente = new Clientes;
	$_POST["nacimiento"] = $_POST["nacimiento_submit"];
	unset($_POST["nacimiento_submit"]);
	$cliente->AddCliente($_POST);
break;



case "65": // elimina cliente
include_once '../../system/cliente/Cliente.php';
	$cliente = new Clientes;
	$cliente->DelCliente($_REQUEST["hash"]);
break;



case "66": // elimina cliente desde liasta completa
include_once '../../system/cliente/Cliente.php';
	$cliente = new Clientes;
	$cliente->DelClientex($_REQUEST["hash"]);
break;



case "67": // actualizar cliente
include_once '../../system/cliente/Cliente.php';
	$cliente = new Clientes;
	$_POST["nacimiento"] = $_POST["nacimiento_submit"];
	unset($_POST["nacimiento_submit"]);
	$cliente->UpCliente($_POST);
break;



case "68": // ver cliente
include_once '../../system/cliente/Cliente.php';
	$cliente = new Clientes;
	$cliente->VistaCliente($_POST);
break;




case "68-1": // ver cliente factura
include_once '../../system/cliente/Cliente.php';
	$cliente = new Clientes;
	$cliente->VerFacturaCliente($_POST["factura"], $_POST["tx"]);
break;



case "69": // productos agrupados y pro,ociones
include_once '../../system/producto/ProductoOtros.php';
	$productos = new ProductoOtros();
	$productos->ProductosCompuestos($_POST["iden"], $_POST["orden"], $_POST["dir"]);
break;




case "70": // busca producto
include_once '../../system/ventas/Laterales.php';
	$lateral = new Laterales;
	$lateral->VerLateral($_SESSION["orden"]);
break;



case "71": // eliminar la promocion o compuesto
include_once '../../system/producto/ProductoOtros.php';
	$productos = new ProductoOtros();
	$productos->EliminarCompuestos($_POST["cod"], $_POST["hash"]);
break;



case "74": // agregar caja solo agregar
	$_SESSION["caja_soloagregar"] = TRUE;
break;


case "75": // busca producto
include_once '../../system/ventas/Productos.php';
	$productos = new Productos;
	$productos->Busqueda($_POST);
break;



case "76": // temp prodcutos (el producto encontrado despues de la busqueda)
include_once '../../system/ventas/Productos.php';
	$productos = new Productos;
	$productos->TempProducto($_REQUEST);
break;



case "79": // otras Ventas
include_once '../../system/ventas/VentasL.php';
	$venta = new Ventas();
	$venta->AgregarProductoEspecial($_POST);
break;



case "80": // recibe el formulario para agregar los productos (va a ventas)
include_once '../../system/ventas/VentasL.php';
	$venta = new Ventas();
	$venta->AddVenta($_POST);
break;



case "81": // borrar venta  de la venta lenta
include_once '../../system/ventas/VentasL.php';
include_once '../../system/ventas/Opciones.php';
	$venta = new Ventas();
	$venta->DelVenta($_REQUEST["hash"], NULL);
break;



case "82": // guardar la venta
include_once '../../system/ventas/VentasL.php';
include_once '../../system/ventas/Opciones.php';
	$venta = new Ventas();
	$venta->GuardarOrden();
break;



case "83": // select orden
include_once '../../system/ventas/VentasL.php';
include_once '../../system/ventas/Opciones.php';
	$venta = new Ventas();
	$venta->SelectOrden($_POST["orden"]);
break;



case "84": // ver producto
include_once '../../system/ventas/VentasL.php';
	$venta = new Ventas();
	$venta->VerProducto();
break;



case "85": // facturar determinar si es rapido o lento
	if($_SESSION["tipo_inicio"] == 1){
	include_once '../../system/ventas/VentasR.php';
	} else {
	include_once '../../system/ventas/VentasL.php';
	}
	   	if(isset($_SESSION["cliente_c"]) or isset($_SESSION["cliente_cli"])){ // agregar el credito
	   		include_once '../../system/ventas/Opciones.php';	
	   	}

	$venta = new Ventas();
	$venta->Facturar($_POST);

break;



case "86": // cancelar toda la orden
	if($_SESSION["tipo_inicio"] == 1){
	include_once '../../system/ventas/VentasR.php';
	} else {
	include_once '../../system/ventas/VentasL.php';
	}
include_once '../../system/ventas/Opciones.php';
	$venta = new Ventas();
	$venta->Cancelar();

	unset($_SESSION["orden"]);
break;



case "90": // recibe el formulario para agregar los productos (va a ventas)
include_once '../../system/ventas/VentasR.php';
	$venta = new Ventas();
	$venta->SumaVenta($_POST);
break;



case "91": // recibe el formulario para agregar los productos (va a ventas)
include_once '../../system/ventas/VentasR.php';
	$venta = new Ventas();
	$venta->RestaVenta($_POST);
break;



case "92": // borrar venta  de la venta rapida
include_once '../../system/ventas/VentasR.php';
include_once '../../system/ventas/Opciones.php';
	$venta = new Ventas();
	$venta->DelVenta($_REQUEST["hash"], NULL);
break;



case "93": // ver producto
include_once '../../system/ventas/VentasR.php';
	$venta = new Ventas();
	$venta->VerProducto();
break;



case "94": // aplicar descuento
include_once '../../system/ventas/Laterales.php';
include_once '../../system/ventas/VentasR.php';
	$venta = new Ventas();

if($_POST["descuento"] != NULL and is_numeric($_POST["descuento"])){

		if($_SESSION["descuento"] != NULL){// se ya se ha aplicado descuento a toda la factura
			$_SESSION["descuentox"] = $_SESSION["descuento"];
			unset($_SESSION["descuento"]);
		}

	
	
if($_SESSION["tipo_descuento"] != NULL){ /// si es cantidad establecidad
// obterner el total del producto 
  if($r = $db->select("pv, descuento", "ticket", "WHERE cod = '".$_POST["dcodigo"]."' and orden = '".$_SESSION["orden"]."' and tx = ".$_SESSION["tx"]." and td = ".$_SESSION["td"]."")) { 
    $pv = $r["pv"]; 
    $d = $r["descuento"]; 
  } unset($r); 

$total = ($pv * $_POST["dcantidad"]) + $d;


  	$_SESSION["descuento"] = Helpers::PorcentajeDescuento($total, $_POST["descuento"]);
} else { // si es porcentaje
	$_SESSION["descuento"] = $_POST["descuento"];
}

	$data["cantidad"] = $_POST["dcantidad"];
	$data["cod"] = $_POST["dcodigo"];
	$venta->Actualiza($data, 1);

	unset($_SESSION["descuento"]);

		if($_SESSION["descuentox"] != NULL){// se ya se ha aplicado descuento a toda la factura
			$_SESSION["descuento"] = $_SESSION["descuentox"];
			unset($_SESSION["descuentox"]);
		}

	} else {
		Alerts::Alerta("error","Error!","Revise sus datos!");
	}	
break;



case "95": // aplicar descuento a factura
if($_POST["descuento"] != NULL and is_numeric($_POST["descuento"])){
	$_SESSION["descuento"] = $_POST["descuento"];
include_once '../../system/ventas/Laterales.php';
include_once '../../system/ventas/VentasR.php';
	$venta = new Ventas();
	$venta->AplicarDescuento();	
	} else {
		Alerts::Alerta("error","Error!","Revise sus datos!");
	}	
break;



case "96": // quitar descuento
	unset($_SESSION["descuento"]);
include_once '../../system/ventas/Laterales.php';
include_once '../../system/ventas/VentasR.php';
	$venta = new Ventas();
	$venta->AplicarDescuento();
break;



case "97": 
include_once '../../system/ventas/VentasR.php';
	$venta = new Ventas();
	$venta->ClienteBusqueda($_POST);
break;



case "98": // add
include_once '../../system/ventas/VentasR.php';
include_once '../../system/ventas/Opciones.php';
	$venta = new Ventas();
	$venta->AgregaCliente($_POST);
break;



case "99":  // del
include_once '../../system/ventas/Opciones.php';
$opciones = new Opciones();
$opciones->DelCredito();
break;



case "87": 
include_once '../../system/ventas/VentasR.php';
	$venta = new Ventas();
	$venta->ClienteBusquedaA($_POST);
break;



case "88": // add
include_once '../../system/ventas/VentasR.php';
include_once '../../system/ventas/Opciones.php';
	$venta = new Ventas();
    $venta->AgregaClienteA($_POST);
break;



case "89": // del
include_once '../../system/ventas/Opciones.php';
$opciones = new Opciones();
$opciones->DelCliente();
break;



case "100": 
include_once '../../system/ventas/VentasR.php';
	$venta = new Ventas();
	$venta->DocumentoBusqueda($_POST);
break;



case "101": // add
include_once '../../system/ventas/VentasR.php';
	$venta = new Ventas();
	$venta->AgregaDocumento($_POST);
break;



case "102":  // quitar documneto
unset($_SESSION["factura_cliente"]);
unset($_SESSION["factura_documento"]);
break;



case "103": // nuevo registro de documento
include_once '../../system/cliente/Cliente.php';
	$cliente = new Clientes;
	$cliente->NuevoDocumento($_POST);
break;



case "104": 
include_once '../../system/credito/Creditos.php';
	$credito = new Creditos;
	$credito->CreditosPendientes($_POST["iden"], $_POST["orden"], $_POST["dir"]);
break;



case "114": 
include_once '../../system/credito/Creditos.php';
	$credito = new Creditos;
	$credito->VerCredito($_POST["iden"], $_POST["orden"], $_POST["dir"]);
break;


case "136": // Borrar credito
	include_once '../../system/credito/Creditos.php';
		$credito = new Creditos;
		$credito->BorrarFactura($_POST['factura'], $_POST['orden'], $_POST['tx'], $_POST['credito'], $_POST['tipo']);
break;


case "105": // agrega abono
include_once '../../system/credito/Creditos.php';
	$credito = new Creditos;
	$credito->AddAbono($_POST);
break;



case "106": 
include_once '../../system/credito/Creditos.php';
	$credito = new Creditos;
	echo Helpers::Dinero($credito->TotalAbono($_REQUEST["credito"]));
break;



case "107": 
include_once '../../system/credito/Creditos.php';
	$credito = new Creditos;
	$abonos = $credito->TotalAbono($_REQUEST["credito"]);
	$totales = $credito->ObtenerTotal($_REQUEST["factura"], $_REQUEST["tx"], $_REQUEST["orden"]);

	echo Helpers::Dinero($totales - $abonos);
break;



case "108": 
include_once '../../system/credito/Creditos.php';
	$credito = new Creditos;
	$credito->DelAbono($_REQUEST["hash"], $_REQUEST["credito"]);
break;



case "109": 
include_once '../../system/credito/Creditos.php';
	$credito = new Creditos;
	$credito->LlamarVista($_REQUEST["credito"], $_REQUEST["factura"], $_REQUEST["tx"], $_REQUEST["orden"]);
break;



case "110": 
include_once '../../system/credito/Creditos.php';
	$credito = new Creditos;
	$credito->BusquedaCreditos($_REQUEST);
break;



case "111": // muestra byusqueda
include_once '../../system/credito/Creditos.php';
	$credito = new Creditos;
	$credito->MuestraBusquedaCreditos($_REQUEST);
break;


case "112": // historial mes corte
	include_once '../../system/historial/Historial.php';
	$historial = new Historial;
		$fecha=$_POST["mes"];
		@$ano=$_POST["ano"];
		$fechax="-$fecha-$ano";

	$historial->HistorialCortesZ($fechax);
break;


case "113": // imprime corte
    include_once '../../system/facturar/facturas/'.$_SESSION["td"].'/Impresiones.php';
    require_once ('../ticket/autoload.php'); 
    $imprimir = new Impresiones(); 
	Alerts::Alerta("success","Imprimiendo","Imprimiendo reporte");

	$imprimir->CorteX($_POST["hash"]); //

break; 




case "113z": // imprime corte
    include_once '../../system/facturar/facturas/'.$_SESSION["td"].'/Impresiones.php';
    require_once ('../ticket/autoload.php'); 
    $imprimir = new Impresiones(); 
	Alerts::Alerta("success","Imprimiendo","Imprimiendo reporte");

	$imprimir->CorteZ($_POST["fecha"]); //
break; 


case "115": // corte preguntar
	if($_POST["efectivo"] ==  NULL){
		Alerts::Alerta("error","Error!","El Formulario esta vacio");
	} else {
		Alerts::RealizarCorte("ejecuta-corte","117",$_POST["efectivo"]);
	}
break;



case "116": //APERTURA DE CAJA
include_once '../../system/corte/CorteMultiple.php';
include_once '../../system/producto/ProductoOtros.php';
$cortes = new Corte();
$cortes->Apertura($_POST["efectivo"]);
unset($_SESSION["caja_soloagregar"]);
break;



case "117": // cierre de corte
/// imprimir corte x
    include_once '../../system/facturar/facturas/'.$_SESSION["td"].'/Impresiones.php';
    require_once ('../ticket/autoload.php'); 

// realiza el corte
include_once '../../system/corte/CorteMultiple.php';
include_once '../../system/producto/ProductoOtros.php';
$cortes = new Corte();

$cortes->Cierre($_POST["efectivo"]);
break;



case "118": // cancelar corte
	include_once '../../system/corte/CorteMultiple.php';
	$cortes = new Corte();
	$cortes->CancelarCorte($_POST["random"]);
break;



case "119": // mosatrar detalles del corte
	include_once '../../system/corte/CorteMultiple.php';
	$cortes = new Corte();
	$cortes->Contenido();
break;



case "120": // mostar los botones imprimir factura
	include_once '../../system/facturar/Facturar.php'; // obtiene el estado de la factura tx, local o web
	include_once '../../system/facturar/facturas/'.$_SESSION["td"].'/Impresiones.php'; // tiene las 
	require_once ('../ticket/autoload.php'); 

	$fac = new Facturar();
	$fac->ObtenerEstadoFactura($_SESSION["cambio_actual_print"], $_SESSION["factura_actual_print"]);

// elimino las dos variables
unset($_SESSION["factura_actual_print"], $_SESSION["cambio_actual_print"]);
break;


case "121": // historial de  utilidades
	include_once '../../system/historial/Historial.php';
	include_once '../../system/herramientas/Herramientas.php';
	$historial = new Historial;
	if($_POST["fecha1_submit"]){
		$inicio = $_POST["fecha1_submit"]; $fin=$_POST["fecha2_submit"];
	} else {
		$inicio = date("01-m-Y"); $fin=date("31-m-Y");
	}
	
	$historial->HistorialUtilidades($inicio, $fin);
break;



case "122": // imprimir barcode de producto
	include_once '../../system/facturar/facturas/'.$_SESSION["td"].'/Impresiones.php'; // tiene las 
	require_once ('../ticket/autoload.php'); 

	$fac = new Impresiones();
	$fac->Barcode($_POST["iden"]);
	Alerts::Alerta("success","Imprimiendo!","Imprimiendo código de barras");
break;




case "123": // historial descuentos
	include_once '../../system/historial/Historial.php';
	$historial = new Historial;
	
	if($_POST["fecha_submit"] == NULL){ $fecha = date("d-m-Y"); 
	} else { $fecha = $_POST["fecha_submit"]; }
	
	$historial->Descuentos($fecha);
break;



case "124": // consolidad diario
	include_once '../../system/historial/Historial.php';
	$historial = new Historial;
	
	if($_POST["fecha_submit"] == NULL){ $fecha = date("d-m-Y"); 
	} else { $fecha = $_POST["fecha_submit"]; }
	
	$historial->ConsolidadoDiario($fecha);
break;



case "125": // historial diario
	include_once '../../system/historial/Historial.php';
	$historial = new Historial;
	
	if($_POST["fecha_submit"] == NULL){ $fecha = date("d-m-Y"); 
	} else { $fecha = $_POST["fecha_submit"]; }
	
	$historial->HistorialDiario($fecha);
break;



case "126": // ventas mensual
	include_once '../../system/historial/Historial.php';
	$historial = new Historial;
		$fecha=$_POST["mes"];
		@$ano=$_POST["ano"];
		$fechax="-$fecha-$ano";

	$historial->HistorialMensual($fechax);
break;



case "127": // historial cortes
	include_once '../../system/historial/Historial.php';
	$historial = new Historial;
	if($_POST["fecha1_submit"]){
		$inicio = $_POST["fecha1_submit"]; $fin=$_POST["fecha2_submit"];
	} else {
		$inicio = date("01-m-Y"); $fin=date("31-m-Y");
	}
	
	$historial->HistorialCortes($inicio, $fin);
break;



case "128": // gasto diario
	include_once '../../system/historial/Historial.php';
	$historial = new Historial;
	if($_POST["fecha_submit"] == NULL){ $fecha = date("d-m-Y"); } 
	else { 		$fecha = $_POST["fecha_submit"]; }
	
	$historial->HistorialGDiario($fecha);
break;



case "129": // gastos mensual
	include_once '../../system/historial/Historial.php';
	$historial = new Historial;
		$fecha=$_POST["mes"];
		@$ano=$_POST["ano"];
		$fechax="-$fecha-$ano";

	$historial->HistorialGMensual($fechax);
break;



case "130": // validar el sistema
$_SESSION["caduca"] = 0;
echo '<script>
	window.location.href="?"
</script>';
break;



case "131": // validar codigo de sistema
include_once '../../system/index/Inicio.php';
$inicio = new Inicio;
$inicio->Validar($_POST["fecha_submit"], $_POST["codigo"]);
	
break;



case "132": // venta diario listado
	include_once '../../system/historial/Historial.php';
	$historial = new Historial;
	
	if($_POST["fecha_submit"] == NULL){ $fecha = date("d-m-Y"); 
	} else { $fecha = $_POST["fecha_submit"]; }
	
	$historial->ListaVenta($fecha);
break;



case "133": // mivimientos de productos
	include_once '../../system/historial/Historial.php';
	$historial = new Historial();
	if($_POST["fecha1_submit"]){
		$inicio = $_POST["fecha1_submit"]; $fin=$_POST["fecha2_submit"];
	} else {
		$inicio = date("01-m-Y"); $fin=date("31-m-Y");
	}
	
	$historial->MovimientosProducto($inicio, $fin);
break;



case "134": // ventas mensual
	include_once '../../system/historial/Historial.php';
	$historial = new Historial;
	if($_POST["fecha1_submit"]){
		$inicio = $_POST["fecha1_submit"]; $fin=$_POST["fecha2_submit"];
	} else {
		$inicio = date("01-m-Y"); $fin=date("31-m-Y");
	}

	$historial->ReporteMensual($inicio, $fin);
break;



case "135": // imprime cuotas de credito
    include_once '../../system/facturar/facturas/'.$_SESSION["td"].'/Impresiones.php';
    require_once ('../ticket/autoload.php'); 
    $imprimir = new Impresiones(); 
	Alerts::Alerta("success","Imprimiendo","Imprimiendo reporte");
	$imprimir->CuotaCredito($_POST["hash"]); //
break; 



case "146": // lateral
include_once '../../system/cotizar/Laterales.php';
	$lateral = new Laterales;
	$lateral->VerLateral($_SESSION["cotizacion"]);
break;



case "147": 
include_once '../../system/cotizar/CotizarR.php';
	$cot = new Cotizar();
	$cot->ClienteBusqueda($_POST);
break;



case "148": 
include_once '../../system/cotizar/CotizarR.php';
	$cot = new Cotizar();
	$cot->AgregaCliente($_POST);
break;



case "149": 
unset($_SESSION["cliente_nombre"]);
unset($_SESSION["cliente_cot"]);
break;



case "150": // recibe el formulario para agregar los productos (va a ventas)
include_once '../../system/cotizar/CotizarR.php';
	$cot = new Cotizar();
	$cot->SumaVenta($_POST);
break;



case "151": // recibe el formulario para agregar los productos (va a ventas)
include_once '../../system/cotizar/CotizarR.php';
	$cot = new Cotizar();
	$cot->RestaVenta($_POST);
break;



case "152": // borrar venta  de la venta rapida
include_once '../../system/cotizar/CotizarR.php';
	$cot = new Cotizar();
	$cot->DelVenta($_REQUEST["hash"], NULL);
break;



case "153": // ver producto
include_once '../../system/cotizar/CotizarR.php';
	$cot = new Cotizar();
	$cot->VerProducto();
break;



case  "154": // tipo de descuento
	if($_SESSION['tipo_descuento'] != NULL){
		unset($_SESSION['tipo_descuento']);
	} else {
		$_SESSION['tipo_descuento'] = TRUE;		
	}
break; 



case "155": // aplicar descuento
	$_SESSION["descuento_cot"] = $_POST["descuento"];
include_once '../../system/cotizar/Laterales.php';
include_once '../../system/cotizar/CotizarR.php';
	$cot = new Cotizar();
	$cot->AplicarDescuento();
break;



case "156": // quitar descuento
	unset($_SESSION["descuento_cot"]);
include_once '../../system/cotizar/Laterales.php';
include_once '../../system/cotizar/CotizarR.php';
	$cot = new Cotizar();
	$cot->AplicarDescuento();
break;



case "157": // guardar la cotizacion
include_once '../../system/cotizar/CotizarR.php';
	$cot = new Cotizar();
	$cot->GuardarCotizacion();
break;



case "158": // canncelar la cotizacion
include_once '../../system/cotizar/CotizarR.php';
	$cot = new Cotizar();
	$cot->Cancelar();
break;



case "159": 
include_once '../../system/cotizar/CotizarR.php';
	$cot = new Cotizar();
	$cot->TodasCotizaciones($_POST["iden"], $_POST["orden"], $_POST["dir"]);
break;



case "160": 
include_once '../../system/cotizar/CotizarR.php';
	$cot = new Cotizar();
	$cot->VerCotizacion($_POST["key"]);
break;



case "161": // Activar cotizacion

	$_SESSION["cotizacion"] = $_POST["cotizacion"];
break;



case "162": /// para pasar afacturar una cotizacion
	include_once '../../system/ventas/Opciones.php';
// //// guardar la orden activa si hay
	if($_SESSION["orden"] != NULL){
	include_once '../../system/ventas/VentasL.php';
		$ventax = new Ventas();
		$ventax->GuardarOrden();
		unset($ventax);

			if(isset($_SESSION["cliente_cli"])) unset($_SESSION["cliente_cli"]);
			if(isset($_SESSION["cliente_asig"])) unset($_SESSION["cliente_asig"]);
 			if(isset($_SESSION["cliente_c"])) unset($_SESSION["cliente_c"]);
			if(isset($_SESSION["cliente_credito"])) unset($_SESSION["cliente_credito"]);		
	}
/////////// 
	if($_SESSION["tipo_inicio"] == 1){
	include_once '../../system/ventas/VentasR.php';
		$venta = new Ventas();
	} else {
	include_once '../../system/ventas/VentasL.php';
		$venta = new Ventas();
	}
// 

if($_SESSION["orden"] == NULL){ $venta->AddOrden(); }

include_once '../../system/cotizar/CotizarR.php';
	$cot = new Cotizar();
	$cot->Facturar($_POST["cotizacion"]);
break;



case "170": 
include_once '../../system/gastos/Gasto.php';
	$gastos = new Gastos;
	$gastos->AddGasto($_POST);
break;



case "171": 
include_once '../../system/gastos/Gasto.php';
	$gastos = new Gastos;
	$gastos->BorrarGasto($_POST["iden"]);

break;



case "172":  // entrada de efectivo
include_once '../../system/gastos/Gasto.php';
	$gastos = new Gastos;
	$gastos->AddEfectivo($_POST);
break;



case "173": 
include_once '../../system/gastos/Gasto.php';
	$gastos = new Gastos;
	$gastos->BorrarEfectivo($_POST["iden"]);

break;



case "174":
include("../common/Imagenes.php");
	$imagen = new upload($_FILES['archivo']);
include("../../system/gastos/ImagenesSuccess.php");
$imgs = new Success();

	if($imagen->uploaded) {
		if($imagen->image_src_y > 800 or $imagen->image_src_x > 800){ // si ancho o alto es mayir a 800
			$imagen->image_resize         		= true; // default is true
			$imagen->image_ratio        		= true; // para que se ajuste dependiendo del ancho definido
			$imagen->image_x              		= 800; // para el ancho a cortar
			$imagen->image_y              		= 800; // para el alto a cortar
		}
		$imagen->file_new_name_body   		= Helpers::TimeId() . "-" . $_SESSION["td"]; // agregamos un nuevo nombre
		// $imagen->image_watermark      		= 'watermark.png'; // marcado de agua
		// $imagen->image_watermark_position 	= 'BR'; // donde se ub icara el marcado de agua. Bottom Right		
		$imagen->process('../../assets/img/gastosimg/' . $_SESSION["td"] . '/');	

		$imgs->SaveGasto($_POST['codigo'], $imagen->file_dst_name, $_POST['descripcion']);

	} // [file_dst_name] nombre de la imagen
	else {
	  echo 'error : ' . $imagen->error;
	  $imgs->VerImagenGasto($_POST['codigo']);
	}	
break;



case "175": 
include("../../system/gastos/ImagenesSuccess.php");
	$imgs = new Success();
	$imgs->VerImagenGasto($_REQUEST['gasto'], $_REQUEST['iden']);
	$imgs->ImagenesGasto($_REQUEST['gasto']);
break;



case "176": 
include("../../system/gastos/ImagenesSuccess.php");
	$imgs = new Success();
	$imgs->VerImagenGasto($_REQUEST['gasto'], $_REQUEST['iden']);
	$imgs->ImagenesGasto($_REQUEST['gasto']);
break;



case "177":  // entrada de efectivo
include_once '../../system/gastos/Gasto.php';
	$gastos = new Gastos;
	$gastos->MostarBancos($_POST["id"]);
break;



case "178":  // todos los bancos
include_once '../../system/gastos/Gasto.php';
	$gastos = new Gastos;
	$gastos->MostarTodosBancos();
break;


case "179": 
include_once '../../system/gastos/Gasto.php';
	$gastos = new Gastos;
	$gastos->AddBanco($_POST);
break;



case "180": 
include_once '../../system/gastos/Gasto.php';
	$gastos = new Gastos;
	$gastos->MostrarCategorias();
break;



case "181": 
include_once '../../system/gastos/Gasto.php';
	$gastos = new Gastos;
	$gastos->AddCategoria($_POST);
break;


case "182":  // muestra el select de las categorias de gastos
include_once '../../system/gastos/Gasto.php';
	$gastos = new Gastos;
	$gastos->MostarListaCategorias($_POST);
break;


case "183":  // muestra el select de las categorias de gastos
	include_once '../../system/gastos/Cuentas_Banco.php';
		$cuenta = new Cuentas();
		$cuenta->TransaccionesBanco($_POST["hash"]);
break;


case "200": // ventas detallado
	include_once '../../system/reportes/Reportes.php';
	$historial = new Reportes();
	if($_POST["fecha1_submit"]){
		$inicio = $_POST["fecha1_submit"]; $fin=$_POST["fecha2_submit"];
	} else {
		$inicio = date("01-m-Y"); $fin=date("31-m-Y");
	}
	
	$historial->VentasDetallado($inicio, $fin);
break;



case "201": // ventas detallado
	include_once '../../system/reportes/Reportes.php';
	$historial = new Reportes();
	if($_POST["fecha1_submit"]){
		$inicio = $_POST["fecha1_submit"]; $fin=$_POST["fecha2_submit"];
	} else {
		$inicio = date("01-m-Y"); $fin=date("31-m-Y");
	}
	
	$historial->VentasAgrupado($inicio, $fin);
break;


case "202": // ventas detallado
	include_once '../../system/reportes/Reportes.php';
	$historial = new Reportes();
	if($_POST["fecha1_submit"]){
		$inicio = $_POST["fecha1_submit"]; $fin=$_POST["fecha2_submit"];
	} else {
		$inicio = date("01-m-Y"); $fin=date("31-m-Y");
	}
	
	$historial->GastosDetallado($inicio, $fin);
break;



case "203": // ventas detallado
	include_once '../../system/reportes/Reportes.php';
	$historial = new Reportes();
	if($_POST["fecha1_submit"]){
		$inicio = $_POST["fecha1_submit"]; $fin=$_POST["fecha2_submit"];
	} else {
		$inicio = date("01-m-Y"); $fin=date("31-m-Y");
	}
	
	$historial->ProductoIngresado($inicio, $fin);
break;



case "210": // ventas detallado
	include_once '../../system/facturar/ReportesFacturas.php';
	$historial = new ReportesFacturas();
	if($_POST["fecha1_submit"]){
		$inicio = $_POST["fecha1_submit"]; $fin=$_POST["fecha2_submit"];
	} else {
		$inicio = date("01-m-Y"); $fin=date("31-m-Y");
	}
	
	$historial->ReporteF($inicio, $fin, $_POST["tipo"]);
break;




case "300": // agregar empleado
include_once '../../system/planilla/Planilla.php';
	$plan = new planilla;
	$plan->AddEmpleado($_POST);

break;



case "301": // eliminar empleado
include_once '../../system/planilla/Planilla.php';
	$plan = new planilla;
	$plan->DelEmpleado($_REQUEST["hash"], $_REQUEST["dir"]);

break;



case "302": // paginar empleado
include_once '../../system/planilla/Planilla.php';
	$plan = new planilla;
	$plan->VerTodosEmpleados($_POST["iden"], $_POST["orden"], $_POST["dir"]);
break;



case "303": //  carga de modal con detalles empleado
include_once '../../system/planilla/Planilla.php';
	$plan = new planilla;
	$plan->VerDetalles($_POST["key"]);
break;



case "304": //  actualizar empleado
include_once '../../system/planilla/Planilla.php';
	$plan = new planilla;
	$plan->UpEmpleado($_POST);
break;



case "305": // agrega extra
include_once '../../system/planilla/Planilla.php';
	$plan = new planilla;
	$plan->AddExtra($_POST);
break;



case "306": // agrega extra
include_once '../../system/planilla/Planilla.php';
	$plan = new planilla;
	$plan->VerTodasExtras($_POST["key"],NULL,1);
break;



case "307": // eliminar extra
include_once '../../system/planilla/Planilla.php';
	$plan = new planilla;
	$plan->DelExtra($_POST);
break;



case "308": // eliminar extra
include_once '../../system/planilla/Planilla.php';
	$plan = new planilla;
	$plan->AddPlanilla($_POST);
break;



case "309": // descuento
include_once '../../system/planilla/Planilla.php';
	$plan = new planilla;
	$plan->AddDescuento($_POST);
break;



case "310": // descuento globla
include_once '../../system/planilla/Planilla.php';
	$plan = new planilla;
	$plan->DelDescuento($_POST["hash"]);
break;



case "311": // select descuento
include_once '../../system/planilla/Planilla.php';
	$plan = new planilla;
	$plan->SelectDescuento($_POST["hash"]);
break;



case "312": // descuento
include_once '../../system/planilla/Planilla.php';
	$plan = new planilla;
	$plan->AddDescuentoAsig($_POST);
break;



case "313": // descuento global asignado
include_once '../../system/planilla/Planilla.php';
	$plan = new planilla;
	$plan->DelDescuentoAsig($_POST["hash"]);
break;



case "314": // paginar planillas
include_once '../../system/planilla/Planilla.php';
	$plan = new planilla;
	$plan->VerTodosPlanillas($_POST["iden"], $_POST["orden"], $_POST["dir"]);
break;


case "247": // Elimiar data del sistema con usuarios
include_once '../../system/bdbackup/LimpiarData.php';
	$data = new DataClear();
	$data-> Clear(1, 1);
break;



case "248": // Elimiar data del sistema con config
include_once '../../system/bdbackup/LimpiarData.php';
	$data = new DataClear();
	$data-> Clear(1, NULL);
break;


case "249": // Elimiar data del sistema
include_once '../../system/bdbackup/LimpiarData.php';
	$data = new DataClear();
	$data-> Clear(NULL, NULL);
break;


case "350": // crear back up
include_once '../../system/bdbackup/Backup.php';
	$back = new BackUp();
	$back-> AddRegistro($_POST["sistema"]);

break;



case "351": // crear back up
include_once '../../system/bdbackup/Backup.php';
	$back = new BackUp();
	$back->VerRespaldos("../../system/bdbackup/backup/" .$_SESSION["td"] . "/");

break;



case "352": // crear back up
include_once '../../system/bdbackup/Backup.php';
	$back = new BackUp();
	$back->Eliminar("../../system/bdbackup/backup/" .$_SESSION["td"] . "/", $_POST["data"]);
break;



case "353": // verifica solicitus
include_once '../../system/bdbackup/Backup.php';
	$back = new BackUp();
	$back->Search();
break;



case "375": // listado de ordenes Ecommerce
include_once '../../system/ecommerce/Movimientos.php';
	$ecommerce = new Movimientos();
	$ecommerce->VerTodosLosPedidos($_POST["iden"], $_POST["orden"], $_POST["dir"]);
break;



case "376": // detalles productos
include_once '../../system/ecommerce/Movimientos.php';
	$ecommerce = new Movimientos();
	$ecommerce->ProductosOrden($_POST["orden"]);
break;



case "377": // estado de la orden
include_once '../../system/ecommerce/Movimientos.php';
	$ecommerce = new Movimientos();
	$ecommerce->EdoOrden($_POST);
break;


case "378": // estado de la orden
include_once '../../system/ecommerce/Movimientos.php';
include_once '../common/Email.php';
	$ecommerce = new Movimientos();
	$ecommerce->EdoCambia($_POST);
break;


case "379": // estado de la orden
include_once '../../system/ecommerce/Movimientos.php';
	$ecommerce = new Movimientos();
	$ecommerce->MuestraEdo($_GET);
break;


case "380": // estado de la orden
include_once '../../system/ecommerce/Movimientos.php';
	$ecommerce = new Movimientos();
	$ecommerce->MuestraEdoBotones($_GET);
break;



case "381": /// para pasar afacturar una orden de ecommerce
	include_once '../../system/ventas/Opciones.php';
// //// guardar la orden activa si hay
	if($_SESSION["orden"] != NULL){
	include_once '../../system/ventas/VentasL.php';
		$ventax = new Ventas();
		$ventax->GuardarOrden();
		unset($ventax);

			if(isset($_SESSION["cliente_cli"])) unset($_SESSION["cliente_cli"]);
			if(isset($_SESSION["cliente_asig"])) unset($_SESSION["cliente_asig"]);
 			if(isset($_SESSION["cliente_c"])) unset($_SESSION["cliente_c"]);
			if(isset($_SESSION["cliente_credito"])) unset($_SESSION["cliente_credito"]);		
	}
/////////// 
	if($_SESSION["tipo_inicio"] == 1){
	include_once '../../system/ventas/VentasR.php';
		$venta = new Ventas();
	} else {
	include_once '../../system/ventas/VentasL.php';
		$venta = new Ventas();
	}
// 

if($_SESSION["orden"] == NULL){ $venta->AddOrden(); }

include_once '../../system/ecommerce/Movimientos.php';
	$ecommerce = new Movimientos();
	$ecommerce->Facturar($_POST["orden"], $_POST["user"]);
break;



case "382": // estado de la orden
include_once '../../system/ecommerce/Movimientos.php';
	$ecommerce = new Movimientos();
	$ecommerce->MuestraEdoBotones($_GET);
break;


case "383": // estado de la orden
include_once '../../system/ecommerce/Movimientos.php';
	$ecommerce = new Movimientos();
	$ecommerce->DetallesUsuario($_POST["usuario"]);
break;



case "384": // estado de la orden
include_once '../../system/ecommerce/Movimientos.php';
	$ecommerce = new Movimientos();
	$ecommerce->VerProductosEcommerce($_POST["iden"], $_POST["orden"], $_POST["dir"]);
break;



case "385": // estado de la orden
include_once '../../system/ecommerce/Movimientos.php';
	$ecommerce = new Movimientos();
	$ecommerce->UpdateCat($_POST);
break;



case "386": // eliminar la orden
include_once '../../system/ecommerce/Movimientos.php';
	$ecommerce = new Movimientos();
	$ecommerce->DelOrden($_POST["hash"]);
break;



case "387": // verimagen de la categoria
include_once '../../system/ecommerce/Movimientos.php';
	$ecommerce = new Movimientos();
	$ecommerce->VerImagenCategoria($_POST["hash"], 'assets/img/imgcategorias/' . $_SESSION["td"] . '/');
break;



case "388": // verimagen de la categoria
include_once '../../system/ecommerce/Movimientos.php';
	$ecommerce = new Movimientos();

include("../common/Imagenes.php");
	$imagen = new upload($_FILES['archivo']);


	if($imagen->uploaded) {
		if($imagen->image_src_y > 800 or $imagen->image_src_x > 800){ // si ancho o alto es mayir a 800
			$imagen->image_resize         		= true; // default is true
			$imagen->image_ratio        		= true; // para que se ajuste dependiendo del ancho definido
			$imagen->image_x              		= 800; // para el ancho a cortar
			$imagen->image_y              		= 800; // para el alto a cortar
		}
		$name = Helpers::TimeId();
		$imagen->file_new_name_body   			= $name; // agregamos un nuevo nombre
		// $imagen->image_watermark      		= 'watermark.png'; // marcado de agua
		// $imagen->image_watermark_position 	= 'BR'; // donde se ub icara el marcado de agua. Bottom Right		
		$imagen->process('../../assets/img/imgcategorias/' . $_SESSION["td"] . '/');	

		$ecommerce->SaveImg($_POST['hash_cat'], $imagen->file_dst_name, 'assets/img/imgcategorias/' . $_SESSION["td"] . '/');
	} // [file_dst_name] nombre de la imagen
	else {
	  echo 'error : ' . $imagen->error;
	  $ecommerce->VerImagenCategoria($_POST['hash'], '../../assets/img/imgcategorias/' . $_SESSION["td"] . '/');
	}	
break;



case "389": // Eliminar propiedades de categoria
include_once '../../system/ecommerce/Movimientos.php';
	$ecommerce = new Movimientos();
	$ecommerce->BorrarPropiedades($_POST["hash"]);
break;



case "400": // busqueda de proveedores
include_once '../../system/cuentas/Cuentas.php';
	$cuenta = new Cuentas();
	$cuenta->AddCuenta($_POST);
break;



case "401": // ver todass las cuentas
include_once '../../system/cuentas/Cuentas.php';
	$cuenta = new Cuentas();
	$cuenta->VerCuentas($_POST["iden"], $_POST["orden"], $_POST["dir"]);
break;



case "402": // modal ver
include_once '../../system/cuentas/Cuentas.php';
	$cuenta = new Cuentas(); 
	$cuenta->VistaCuenta($_POST["cuenta"]);
break;



case "403": // cargar abonos
include_once '../../system/cuentas/Cuentas.php';
	$cuenta = new Cuentas(); 
	echo Helpers::Dinero($cuenta->TotalAbono($_REQUEST["cuenta"]));
break;



case "404": // cargar total
include_once '../../system/cuentas/Cuentas.php';
	$cuenta = new Cuentas(); 
	echo Helpers::Dinero($cuenta->ObtenerTotal($_REQUEST["cuenta"]) - $cuenta->TotalAbono($_REQUEST["cuenta"]));
break;



case "405": // agragar Abono
include_once '../../system/cuentas/Cuentas.php';
	$cuenta = new Cuentas(); 
	$cuenta->AddAbono($_POST);
break;



case "406": // Borrar Abono
include_once '../../system/cuentas/Cuentas.php';
	$cuenta = new Cuentas(); 
	$cuenta->DelAbono($_POST["hash"], $_POST["cuenta"]);
break;



case "408": // Borrar cuenta
include_once '../../system/cuentas/Cuentas.php';
	$cuenta = new Cuentas(); 
	$cuenta->DelCuenta($_POST["iden"]);
break;



case  "418": // validar cuentas
include_once '../../system/config_configuraciones/Config.php';
	$configuracion = new Config;
	$configuracion->AddSucursal($_POST["user"],$_POST["sistema"]);
break; 



case  "419": // cambiar local
include_once '../../system/config_configuraciones/Config.php';
	$configuracion = new Config; 
  	$_SESSION['td'] = $_POST["iden"];

  $_SESSION['secret_key'] = md5($_SESSION['td']);
  $configuracion->CrearVariables();
  echo '<script>
	window.location.href="?"
	</script>';
break; 




case  "431": // cambiar local predeterminado
include_once '../../system/config_configuraciones/Config.php';
	$configuracion = new Config; 
	$configuracion->DefineSucursal($_SESSION["user"],$_REQUEST["iden"]);
break; 




case "425": // busca para pesaje de productos
include_once '../../system/producto/Pesaje.php';
	$pesaje = new Pesaje(); 
	$pesaje->BusquedaProducto($_POST["key"]);
break;



case "426": // busca para pesaje de productos
include_once '../../system/producto/Pesaje.php';
	$pesaje = new Pesaje(); 
	$pesaje->AddProducto($_POST);
break;



case "427": // paginar productos pesados
include_once '../../system/producto/Pesaje.php';
	$pesaje = new Pesaje(); 
	$pesaje->VerPesos($_POST["iden"], $_POST["orden"], $_POST["dir"]);
break;



case "428": // agrega a la factura el producto en venta rapida
include_once '../../system/producto/Pesaje.php';
	$pesaje = new Pesaje(); 
include_once '../../system/ventas/VentasR.php';
	$venta = new Ventas();

	if($pesaje->facturar($_POST["probal"]) == TRUE){

	$cantidad = $pesaje->ObtenerCantidad($_POST["probal"]);
	$cod = $pesaje->ObtenerCod($_POST["probal"]);

	$data = array();
	$data["cod"] = $cod;
	$data["cantidad"] = $cantidad;

		$venta->SumaVenta($data); // incluir cod y cantidad		
	} else {
		Alerts::Alerta("error","Error!","Codigo Inválido!");
		$venta->VerProducto();
	}
break;



case "429": // agrega a la factura el producto
include_once '../../system/producto/Pesaje.php';
	$pesaje = new Pesaje(); 
	$pesaje->MostrarPesos();
break;



case "430": // agrega la venta lenta
include_once '../../system/producto/Pesaje.php';
	$pesaje = new Pesaje(); 
include_once '../../system/ventas/VentasL.php';
	$venta = new Ventas();

	if($pesaje->facturar($_POST["probal"]) == TRUE){

	$cantidad = $pesaje->ObtenerCantidad($_POST["probal"]);
	$cod = $pesaje->ObtenerCod($_POST["probal"]);

	$data = array();
	$data["cod"] = $cod;
	$data["cantidad"] = $cantidad;

		$venta->AddVenta($data); // incluir cod y cantidad		
	} else {
		Alerts::Alerta("error","Error!","Codigo Inválido!");
		$venta->VerProducto();
	}
break;



case "450": /// comienza lo de las facturas
	include_once '../../system/facturar/Facturar.php';
	$fact = new Facturar();
	$fact->ModFactura($_POST);
break;



case "500": // busqueda por tags
include_once '../../system/ventas/ProductoBusqueda.php';
	$proBusqueda = new ProductoBusqueda();
	$proBusqueda->BusquedaToTags($_POST);
break;



case "501": // igualar ubicacion de productos
include_once '../../system/producto/Productos.php';
	$producto = new Productos();
	$producto->IgualarUbicacion($_POST["producto"]);
break;



case "510": // activa precio de mayoreo
	
	if($_SESSION["precio_mayorista_activo"] == TRUE){
		unset($_SESSION["precio_mayorista_activo"]);
	} else {
		$_SESSION["precio_mayorista_activo"] = TRUE;
	}
	header("location: ../../?");
break;



case "520": // autoparts select
include_once '../../system/autoparts/Autoparts.php';
	$auto = new Autoparts(); 
	$auto->SelectStep();
break;


case "521": // Add Marca
include_once '../../system/autoparts/Autoparts.php';
	$auto = new Autoparts(); 
	$auto->SelectMarca($_POST["marca"]);
break;



case "522": // autoparts select modelo
include_once '../../system/autoparts/Autoparts.php';
	$auto = new Autoparts(); 
	$auto->SelectModelo($_POST["modelo"]);
break;


case "523": // autoparts select modelo
include_once '../../system/autoparts/Autoparts.php';
	$auto = new Autoparts(); 
	$auto->SelectAnio($_POST["anio"]);
break;



case "524": // autoparts select modelo
include_once '../../system/autoparts/Autoparts.php';
	$auto = new Autoparts(); 
	$auto->DetallesSeleccion();
break;


case "525": // eliminar las variables de autoparts
include_once '../../system/autoparts/Autoparts.php';
	$auto = new Autoparts(); 
	$auto->EliminarDatos();
break;



case "526": // autoparts select ano 2
include_once '../../system/autoparts/Autoparts.php';
	$auto = new Autoparts(); 
	$auto->SelectAnio2($_POST["anio2"]);
break;



case "527": // autoparts select motor
include_once '../../system/autoparts/AutopartsOp.php';
	$auto = new Autoparts(); 
	$auto->VerTodosProductos();
break;



case "528": // autoparts select modelo solo para en mostar productos
include_once '../../system/autoparts/AutopartsOp.php';
	$auto = new Autoparts(); 
	$auto->DetallesSeleccion();
break;



case "530": // 
include_once '../../system/autoparts/AutopartsOp.php';
	$auto = new Autoparts(); 
	$auto->AddMarca($_POST);
break;



case "531": // 
include_once '../../system/autoparts/AutopartsOp.php';
	$auto = new Autoparts(); 
	$auto->DelMarca($_POST["hash"]);
break;



case "532": // 
include_once '../../system/autoparts/AutopartsOp.php';
	$auto = new Autoparts(); 
	$auto->AddModelo($_POST);
break;


case "533": // 
include_once '../../system/autoparts/AutopartsOp.php';
	$auto = new Autoparts(); 
	$auto->DelModelo($_POST["hash"]);
break;



case "534": // gregar los items
include_once '../../system/autoparts/AutopartsOp.php';
	$auto = new Autoparts(); 
	$auto->AddItem($_POST);
break;



case "535": // 
include_once '../../system/autoparts/AutopartsOp.php';
	$auto = new Autoparts(); 
	$auto->DelItem($_POST["hash"]);
break;



case "536": // agregar Producstos al sistema
include_once '../../system/autoparts/AutopartsOp.php';
	$auto = new Autoparts(); 
	$auto->AddProductos($_POST);
break;



case "537": // Busqueda de 
include_once '../../system/autoparts/AutopartsOp.php';
	$auto = new Autoparts(); 
	$auto->BusquedaProductos($_POST);
break;



case "538":  /// ver los productos agregados en el modal de agregar mas
include_once '../../system/producto/ProUpdate.php';
	$productos = new ProUpdate;
	$productos->VerAgrega($_POST["key"]);
break;



case "539":  /// ver datos modal
include_once '../../system/autoparts/AutopartsOp.php';
	$auto = new Autoparts(); 
	$auto->VerDatosProducto($_POST["key"]);
break;



case "540":  /// verifica si ya existe el producto para no ingresarlo
include_once '../../system/autoparts/AutopartsOp.php';
	$auto = new Autoparts(); 
	$auto->VerificarExistencia($_POST["cod"]);
break;




case "541":  /// ver datos modal
include_once '../../system/autoparts/AutopartsOp.php';
	$auto = new Autoparts(); 
	$auto->VerDatosProducto($_POST["key"], 1);
break;



case "542":  /// ver cantidad
include_once '../../system/autoparts/AutopartsOp.php';
	$auto = new Autoparts(); 
	echo $auto->VerCantidad($_REQUEST["key"]);
break;



case "543":  /// ver precio
include_once '../../system/autoparts/AutopartsOp.php';
	$auto = new Autoparts(); 
	echo $auto->VerPrecio($_REQUEST["key"]);
break;



case "544":  /// cambiar precio
include_once '../../system/autoparts/AutopartsOp.php';
	$auto = new Autoparts(); 
	echo $auto->CambiarPrecio($_POST);
break;



case "545":  /// cambiar precio
include_once '../../system/autoparts/AutopartsOp.php';
	$auto = new Autoparts(); 
	echo $auto->TodosLosProductos();
break;


case "546":  /// Load data para facturar web
include_once '../../system/facturar/FacturarWeb.php';
	$data = new FacturarWeb(); 
	$data->TicketWeb();

// elimino las dos variables
unset($_SESSION["factura_actual_print"], $_SESSION["cambio_actual_print"]);
break;



case "547": // mostar los botones para seleccionar el tipo de ticket
	include_once '../../system/facturar/Facturar.php'; 
	$fac = new Facturar();
	$fac->TiposTicketActivos();
break;



case "550":  /// borrar producto
include_once '../../system/producto/Productos.php';
	$prod = new Productos(); 
	$prod->DelProducto($_POST["iden"]);
break;



case "551":  /// seleccionar opcion de ticket (ticket, factura, credito fiscal, ninguno)
include_once '../../system/ventas/Laterales.php';
	$lat = new Laterales(); 
	$lat->TipoTicket($_POST["tipo"]);
break;



case "560":  /// agragar producto rapido
include_once '../../system/herramientas/Herramientas.php';
	$fast = new Herramientas(); 
	$fast->AddProducto($_POST);
break;



case "561":  /// borrar producto
include_once '../../system/herramientas/Herramientas.php';
	$prod = new Herramientas(); 
	$prod->DelProducto($_POST["iden"]);
break;



case "562":  /// mostrar todos los productos para opciones
include_once '../../system/herramientas/Herramientas.php';
include_once '../../system/producto/Productos.php';
	$prod = new Herramientas(); 
	$prod->TodosProductosOpciones($_POST["iden"], $_POST["orden"], $_POST["dir"]);
break;



case "563": // formulario marca
include_once '../../system/producto/Productos.php';
	$productos = new Productos;
	$productos->AddMarca($_POST);

break;



case "564": // borrar marca
include_once '../../system/producto/Productos.php';
	$productos = new Productos;
	$productos->DelMarca($_REQUEST["hash"]);
break;



case "565": // bcambiar marca
include_once '../../system/producto/Productos.php';
	$productos = new Productos;
	$productos->CambiarMarca($_POST);
break;



case "566": // ver marca
include_once '../../system/producto/Productos.php';
	$productos = new Productos;
	$productos->VerMarca($_POST["cod"]);
break;


case "567":  /// mostrar todos los productos para ajuste de invantario
include_once '../../system/herramientas/Herramientas.php';
include_once '../../system/producto/Productos.php';
	$prod = new Herramientas(); 
	$prod->AjustedeInventario($_POST["iden"], $_POST["orden"], $_POST["dir"]);
break;



case "568":  /// IniciarAjuste
include_once '../../system/herramientas/Herramientas.php';
include_once '../../system/producto/Productos.php';
	$prod = new Herramientas(); 
	$prod->IniciarAjuste();
break;



case "569":  /// obtener cantidad producto
include_once '../../system/herramientas/Herramientas.php';
include_once '../../system/producto/Productos.php';
	$prod = new Herramientas(); 
	echo $prod->ObtenerCantidad($_POST["key"]);
break;


case "570":  /// cambiar cantidad producto
include_once '../../system/herramientas/Herramientas.php';
include_once '../../system/producto/Productos.php';
	$prod = new Herramientas(); 
	$prod->CambiarCantidad($_POST);
break;



case "571":  /// cambiar cantidad producto
include_once '../../system/herramientas/Herramientas.php';
include_once '../../system/producto/Productos.php';
	$prod = new Herramientas(); 
	$prod->EstablecerCantidad($_POST);
break;




case "572":  /// cambiar cantidad producto desde el actualizar [producto]
include_once '../../system/herramientas/Herramientas.php';
include_once '../../system/producto/Productos.php';
	$prod = new Herramientas(); 
	$prod->CambiarCantidadUpdate($_POST);
break;




case "573":  /// TerminarAjuste
include_once '../../system/herramientas/Herramientas.php';
include_once '../../system/producto/Productos.php';
	$prod = new Herramientas(); 
	$prod->TerminarAjuste();
break;




case "580": // ver factura busqueda
include_once '../../system/facturar/Search.php';
	$busqueda = new Search();
	$busqueda->DestalleFactura($_SESSION["search"]);
break;



case "581": // ver botones de factura
include_once '../../system/facturar/Search.php';
	$busqueda = new Search();
	$busqueda->BotonesFactura($_SESSION["search"]);
break;



case "582": // borrrar factura
include_once '../../system/facturar/Search.php';
	$data = new Search(); 
	$data->BorrarFactura($_SESSION["search"]);
break;



case "583": // imprimir factura
	include_once '../../system/facturar/Facturar.php'; // obtiene el estado de la factura tx, local o web
	include_once '../../system/facturar/facturas/'.$_SESSION["td"].'/Impresiones.php'; // tiene las 
	require_once ('../ticket/autoload.php'); 

if ($r = $db->select("efectivo", "ticket_num", "WHERE num_fac = '".$_SESSION["search"]."' and tipo = '".$_SESSION["tipoticket"]."' and td = ".$_SESSION["td"]."")) { 
   	$_SESSION["cambio_actual_print"] = $r["efectivo"];
} unset($r);  

	$fac = new Facturar();
	$fac->ObtenerEstadoFactura($_SESSION["cambio_actual_print"], $_SESSION["search"]);
	Alerts::Alerta("success","Imprimiendo!","Imprimiendo Factura");

// elimino las dos variables
unset($_SESSION["cambio_actual_print"]);
break;


case "584":  /// imprimir factura Web
include_once '../../system/facturar/FacturarWeb.php';

if ($r = $db->select("orden, efectivo", "ticket_num", "WHERE num_fac = '".$_SESSION["search"]."' and tipo = '".$_SESSION["tipoticket"]."' and td = ".$_SESSION["td"]."")) { 
   $_SESSION["orden_print"] = $r["orden"]; 
   $_SESSION["cambio_actual_print"] = $r["efectivo"];
} unset($r);  

	$data = new FacturarWeb(); 
	$data->TicketWeb();

// elimino las dos variables
unset($_SESSION["orden_print"], $_SESSION["cambio_actual_print"]);
break;



case "586":  /// activar desactivar agrupar
if($_SESSION["venta_agrupado"]){

	unset($_SESSION["venta_agrupado"]);
	Alerts::Alerta("success","Desactivado!","Se desactivo la opcion de productos agrupados");
} else {
	$_SESSION["venta_agrupado"] = TRUE;
	
Alerts::Mensajex("ADVERTENCIA! Se detecto activo la opción de producto agrupado. Todos los productos que agregue en este momento no tendran el precio establecido, sino que serán cobrados de manera especial", "danger", '<a id="agrupado" class="btn btn-danger">Desactivar</a>');

}
break;



case "600": // agrega cliente de taller
include_once '../../system/taller/Taller.php';
	$talleres = new Taller();
	$talleres->AddCliente($_POST);
break;


case "601": // ver todass las cuentas
include_once '../../system/taller/Taller.php';
	$talleres = new Taller();
	$talleres->VerClientes($_POST["iden"], $_POST["orden"], $_POST["dir"]);
break;



case "602": // agrega cliente de taller
include_once '../../system/taller/Taller.php';
	$talleres = new Taller();
	$talleres->AddVehiculo($_POST);
break;


case "603": // ver todass vehiculos
include_once '../../system/taller/Taller.php';
	$talleres = new Taller();
	$talleres->VerVehiculos($_POST["iden"], $_POST["orden"], $_POST["dir"]);
break;


case "604": // muestra los datos del cliente seleccionado
include_once '../../system/taller/Taller.php';
	$talleres = new Taller();
	$talleres->DatosCliente($_POST["hash"]);
break;


case "605": // muestra modelo a cambiar la marca
include_once '../../system/taller/Taller.php';
	$talleres = new Taller();
	$talleres->ModeloVehiculo($_POST["hash"]);
break;



case "606": // muestra los datos del vehiculo seleccionado
include_once '../../system/taller/Taller.php';
	$talleres = new Taller();
	$talleres->DatosVehiculo($_POST["hash"]);
break;


case "607": // ver todass vehiculos
include_once '../../system/taller/Taller.php';
	$talleres = new Taller();
	$talleres->VerMantenimiento($_POST["iden"], $_POST["orden"], $_POST["dir"]);
break;



case "608": // agrega cliente de taller
include_once '../../system/taller/Taller.php';
	$talleres = new Taller();
	$talleres->AddMantenimiento($_POST);
break;



case "609": // VER DETALLES DE MANTENIMIENTO
include_once '../../system/taller/Taller.php';
	$talleres = new Taller();
	$talleres->DetallesMantenimiento($_POST["hash"]);
break;



case "610": // agrrega edit
include_once '../../system/taller/Taller.php';
	$talleres = new Taller();
	$talleres->EditarOp($_POST);
break;


case "611": // obtiene texto para  edit
include_once '../../system/taller/Taller.php';
	$talleres = new Taller();
	$talleres->TextoOp($_POST);
break;



case "612": // obtiene texto para  edit
include_once '../../system/taller/Taller.php';
	$talleres = new Taller();
	$talleres->CambiarEdo($_POST);
break;



case "617": ///////////agregar a factura
include_once '../../system/taller/Taller.php';
	$talleres = new Taller();
	$talleres->ClienteBusqueda($_POST);
break;



case "618": // add
include_once '../../system/taller/Taller.php';
	$talleres = new Taller();
	$talleres->AgregaCliente($_POST);
break;


case "619": // del
include_once '../../system/taller/Taller.php';
	$talleres = new Taller();
	$talleres->DelClienteFactura();
break;



case "620": // ver cliente
include_once '../../system/taller/Taller.php';
	$talleres = new Taller();
	$talleres->VistaCliente($_POST);
break;



case "621": // ver cliente
include_once '../../system/taller/Taller.php';
	$talleres = new Taller();
	$talleres->VistaVehiculo($_POST);
break;


case "622": // modelos para agregarle al producto
include_once '../../system/taller/Productos.php';
	$talleres = new TallerProductos();
	$talleres->GetMarcas();
break;


case "623": // lista los modelos de las marcas
include_once '../../system/taller/Productos.php';
	$talleres = new TallerProductos();
	$talleres->GetModelos($_POST["hash"]);
break;


case "624": // agrega un modelo a la lista
include_once '../../system/taller/Productos.php';
	$talleres = new TallerProductos();
	$talleres->AddModelo($_POST["hash"]);
break;



case "625": // elimina un modelo a la lista
include_once '../../system/taller/Productos.php';
	$talleres = new TallerProductos();
	$talleres->DelModelo($_POST["hash"]);
break;


case "626": // Muestra los modelos Agregados
include_once '../../system/taller/Productos.php';
	$talleres = new TallerProductos();
	$talleres->ModelosAgregados();
break;



case "627": // anos para agregarle al producto
include_once '../../system/taller/Productos.php';
	$talleres = new TallerProductos();
	$talleres->GetAnios();
break;


case "628": // agrega un anio a la lista
include_once '../../system/taller/Productos.php';
	$talleres = new TallerProductos();
	$talleres->AddAnio($_POST["hash"]);
break;



case "629": // elimina un anio a la lista
include_once '../../system/taller/Productos.php';
	$talleres = new TallerProductos();
	$talleres->DelAnio($_POST["hash"]);
break;


case "631": // Muestra los modelos Agregados
include_once '../../system/taller/Productos.php';
	$talleres = new TallerProductos();
	$talleres->AniosAgregados();
break;



case "632": // Muestra los modelos Agregados
include_once '../../system/taller/Productos.php';
	$talleres = new TallerProductos();
	$talleres->AniosAgregados();
	$talleres->ModelosAgregados();
break;



case "633": // model select
	$_SESSION["tallerSearch"]["modelo"] = $_POST["hash"];
include_once '../../system/taller/Productos.php';
	$talleres = new TallerProductos();
	$talleres->Search();
break;



case "634": // anio select
	$_SESSION["tallerSearch"]["anio"] = $_POST["hash"];
include_once '../../system/taller/Productos.php';
	$talleres = new TallerProductos();
	$talleres->Search();
break;


case "635": // anio medida
$_SESSION["tallerSearch"]["medida"] = $_POST["hash"];
include_once '../../system/taller/Productos.php';
	$talleres = new TallerProductos();
	$talleres->Search();
break;


case "636": // key
	$_SESSION["tallerSearch"]["key"] = $_POST["hash"];
include_once '../../system/taller/Productos.php';
	$talleres = new TallerProductos();
	$talleres->Search();
break;


case "637": // key
unset($_SESSION["tallerSearch"]);
include_once '../../system/taller/Productos.php';
	$talleres = new TallerProductos();
	$talleres->Search();
break;



case "640": // Muestra los modelos Agregados en update
	unset($_SESSION["dataTaller"]);
	include_once '../../system/taller/Productos.php';
		$talleres = new TallerProductos();
		$talleres->ModelosAgregadosDB();
		$talleres->AniosAgregadosDB();
break;





case "649": // archivo de excel
include("../common/Imagenes.php");
	$file = new upload($_FILES['archivo']);

	if($file->uploaded) {
		$name = Helpers::TimeId();
		$file->file_new_name_body  = $name . "-" . $_SESSION["td"]; // agregamos un nuevo nombre
	
		$file->process('../../assets/file/');	


	include_once '../../system/herramientas/Importar.php';
	$import = new Importar(); 
	$import -> ExtraeExcel($file->file_dst_name);
		// echo 'Realizado : ' . $file->file_dst_name;
	} // [file_dst_name] nombre de la imagen
	else {

	Alerts::Mensajex("Error: " . $file->error . " No se proceso correctamente","danger");
	}	
break;

 

case "650": // aceptar orden
include_once '../../system/transferencias/Transferencias.php';
include_once '../../system/producto/ProUpdate.php';
	$trans = new Transferencias();
	$trans->AceptarOrden(URL_TRANSFERENCIA .'?op=12&hash=' . $_REQUEST["hash"], $_REQUEST["hash"]);
break;



case "651": // mostrar todas las orden
include_once '../../system/transferencias/Transferencias.php';
	$trans = new Transferencias();
	$trans->OrdenesPendientes(URL_TRANSFERENCIA .'?op=10&iden=' . $_SESSION["td"]);
break;



case "652": // aceptar orden
include_once '../../system/transferencias/Transferencias.php';
	$trans = new Transferencias();
	$trans->RechazarOrden(URL_TRANSFERENCIA .'?op=15&hash=' . $_REQUEST["hash"], $_REQUEST["hash"]);
break;



case "653": // Obtiene Cuentas vienculadas
include_once '../../system/transferencias/Transferencias.php';
	$trans = new Transferencias();
	$trans->CuentasVinculadas(URL_TRANSFERENCIA .'?op=19&origen=' . $_SESSION["td"]);
break;



case "654": // destruye  variables de sesion de nueva orden
include_once '../../system/transferencias/Transferencias.php';
	$trans = new Transferencias();
	$trans->DestruyeVariables();
break;



case "655": // crear variables de sesion de nueva orden
include_once '../../system/transferencias/Transferencias.php';
	$trans = new Transferencias();
	$trans->CreaVariables($_REQUEST["destino"]);
break;



case "656": // seleccion de productos
include_once '../../system/transferencias/Transferencias.php';
	$trans = new Transferencias();
	$trans->SelectProduct($_REQUEST["key"]);
break;



case "657": // seleccion de productos
include_once '../../system/transferencias/Transferencias.php';
	$trans = new Transferencias();
	$trans->AgregaProducto($_POST);
break;




case "658": // enviar orden de productos a la nube
include_once '../../system/transferencias/Transferencias.php';
include_once '../../system/producto/ProUpdate.php';
	$trans = new Transferencias();
	$trans->EnviarOrden(URL_TRANSFERENCIA .'?op=11');
break;



case "659": // mostrar todas las orden enviadas
include_once '../../system/transferencias/Transferencias.php';
	$trans = new Transferencias();
	$trans->OrdenesEnviadas(URL_TRANSFERENCIA .'?op=20&iden=' . $_SESSION["td"]);
break;



case "660": // devolver Productos de orden cancelada
include_once '../../system/transferencias/Transferencias.php';
include_once '../../system/producto/ProUpdate.php';
	$trans = new Transferencias();
	$trans->DevolverProductos(URL_TRANSFERENCIA .'?op=22&hash=' . $_REQUEST["hash"], $_REQUEST["hash"]);
break;



case "661": // Obtiene Cuentas vienculadas
include_once '../../system/transferencias/Transferencias.php';
	$trans = new Transferencias();
	$trans->MisCuentas(URL_TRANSFERENCIA .'?op=19&origen=' . $_SESSION["td"]);
break;



case "662": // enviar orden de productos a la nube
include_once '../../system/transferencias/Transferencias.php';
	$trans = new Transferencias();
	$trans->AsociarSucursales(URL_TRANSFERENCIA .'?op=17'); // envia s1 s2 via post
break;


case "670": // busqueda productos para restablecer precios
	include_once '../../system/herramientas/RestablecerPrecio.php';
		$restart = new RestablecerPrecio();
		$restart->DetallesProducto($_POST);
break;

case "671": // Cambiar precio
	include_once '../../system/herramientas/RestablecerPrecio.php';
		$restart = new RestablecerPrecio();
		$restart->CambiarPrecio($_POST);
break;


} // termina switch














/////////
$db->close();
?>
<?php 
class Ventas{

	public function __construct() { 
 	} 




   public function AddVenta($datos){ // lento
   	if($this->FiltroAgotado() == TRUE or $_POST["servicio"] == "on"){		
		if($_SESSION["orden"] == NULL){ $this->AddOrden(); }
  		$this->Agregar($datos);
   	} else {
	 Alerts::Alerta("error","Error!","La cantidad establecida es mayor a la cantidad de productos!");
	}

  	$this->VerProducto();
   }



public function FiltroAgotado(){
	if ($_POST["cantidad"] > 0) {
		if ($_SESSION["config_agotado"] == "on") {
			if ($_POST["unidades"] >= $_POST["cantidad"]) {
				return TRUE;
			} else {
				return FALSE;
			}
		} else {
			return TRUE;
		}
	} else {
		return FALSE;
	}
}




   public function SumaVenta($datos){ //  para agregar productos rapidamente

  		if($this->ObtenerCantidad($datos["cod"]) > 0){
  			if($_SESSION["orden"] == NULL){ $this->AddOrden(); }
  			
  			/// aqui determino si agrego o actualizo
  			$product = $this->ObtenerCantidadTicket($datos["cod"]);
  			if($datos["cantidad"] == NULL) $datos["cantidad"] = 1;
  			if($product > 0){
  				$datos["cantidad"] = $product + $datos["cantidad"];
  				$this->Actualiza($datos, null); // null es resta
  			} else {
  				$this->Agregar($datos);
  			}
  		} else {
  			 Alerts::Alerta("error","Error!","No se encontro el producto!");
  		}
  	$this->VerProducto();
   }



   public function RestaVenta($datos){ // restar productos rapidamente

  		if($this->ObtenerCantidad($datos["cod"]) >= 0){
  			if($_SESSION["orden"] == NULL){ $this->AddOrden(); }
  			
  			/// aqui determino si agrego o actualizo
  			$product = $this->ObtenerCantidadTicket($datos["cod"]);
  			if($datos["cantidad"] == NULL) $datos["cantidad"] = 1;
  			
  			if($product > 1){
  				$datos["cantidad"] = $product - $datos["cantidad"];
  				$this->Actualiza($datos, 1); // uno suma
  			} else {
  				Alerts::Alerta("error","Error!","No se encontro el producto!");
  			}
  		} else {
  			 Alerts::Alerta("error","Error!","No se encontro el producto!");
  		}
  	$this->VerProducto();
   }



	public function Agregar($datos) { // agrega el producto
		$db = new dbConn();

if($_SESSION["venta_agrupado"]){

	$pv = 0;
	$sumas = 0;
    $stot=0;
    $im =0;
	$total = 0;
    $productox = "Producto_Agrupado";
} else {

	$pv = $this->ObtenerPrecio($datos["cod"], $datos["cantidad"]);
	$sumas = $pv * $datos["cantidad"];

    $stot=Helpers::STotal($sumas, $_SESSION['config_imp']);
    $im=Helpers::Impuesto($stot, $_SESSION['config_imp']);
    $productox = $this->ObtenerNombre($datos["cod"]);
	$total = $stot + $im;

}



$datox = array();

if($_SESSION['config_descuento'] != NULL){
	
	if ($r = $db->select("descuento", "producto", "WHERE cod = '".$datos["cod"]."' and td = ".$_SESSION["td"]."")) { 
		$_SESSION['descuento'] = $r["descuento"]; 
	}  unset($r);  

	if ($_SESSION['descuento'] != NULL) {
		$sumas = number_format($pv * $datos["cantidad"], 2,'.',',');
		$sumasx = $sumas;
		$sumas = Helpers::DescuentoTotal($sumas);
		$pv = Helpers::DescuentoTotal($pv);
		$descuento = $sumasx - $sumas;
	
		$total = $pv * $datos['cantidad'];
		$stot=Helpers::STotalDesc($sumas, $_SESSION['config_imp']);
		$im=$total - $stot;
	
		$datox["descuento"] = $descuento;
	}
	unset($_SESSION['descuento']);
}

	    $datox["cod"] = $datos["cod"];
	    $datox["cant"] = $datos["cantidad"];
	    $datox["producto"] = $productox;
	    $datox["pc"] = $this->ObtenerPrecioCosto($datos["cod"]);
	    $datox["pv"] = $pv;  				   
	    $datox["stotal"] = $stot;	    				   
	    $datox["imp"] = $im;
	    $datox["total"] = $total;
	    $datox["num_fac"] = 0;
	    $datox["fecha"] = date("d-m-Y");
	    $datox["hora"] = date("H:i:s");
	    $datox["orden"] = $_SESSION["orden"];
	    $datox["cajero"] = $_SESSION['nombre'];
	    $datox["tipo_pago"] = 1;
	    $datox["user"] = $_SESSION['user'];
	    $datox["tx"] = $_SESSION['tx'];
	    $datox["fechaF"] = Fechas::Format(date("d-m-Y"));
	    $datox["entrega"] = date("d-m-Y");
	    $datox["entregaF"] = Fechas::Format(date("d-m-Y"));
	    $datox["edo"] = 1;
	    $hash = Helpers::HashId();
	    $datox["hash"] = $hash;
		$datox["time"] = Helpers::TimeId();
	    $datox["td"] = $_SESSION["td"];
	    if ($db->insert("ticket", $datox)) {
	       $this->AgregaCaracteristicas($datos, $hash);
	       $this->AgregaUbicacion($datos, $hash);
	       $this->ActualizaProducto($datos["cod"], $datos["cantidad"], NULL);
	    } 

	}


	public function AgregarDesdeCotizacion($datos) { // agrega el producto
		$db = new dbConn();

		$datox = array();
	    $datox["cod"] = $datos["cod"];
	    $datox["cant"] = $datos["cantidad"];
	    $datox["producto"] = $datos["producto"];
	    $datox["pc"] = $this->ObtenerPrecioCosto($datos["cod"]);
	    $datox["pv"] = $datos["pv"]; 				   
	    $datox["stotal"] = $datos["stotal"];    				   
	    $datox["imp"] = $datos["imp"];
	    $datox["total"] = $datos["total"];
	    $datox["descuento"] =$datos["descuento"];
	    $datox["num_fac"] = 0;
	    $datox["fecha"] = date("d-m-Y");
	    $datox["hora"] = date("H:i:s");
	    $datox["orden"] = $_SESSION["orden"];
	    $datox["cajero"] = $_SESSION['nombre'];
	    $datox["tipo_pago"] = 1;
	    $datox["user"] = $_SESSION['user'];
	    $datox["tx"] = $_SESSION['tx'];
	    $datox["fechaF"] = Fechas::Format(date("d-m-Y"));
		$datox["entrega"] = date("d-m-Y");
	    $datox["entregaF"] = Fechas::Format(date("d-m-Y"));
	    $datox["edo"] = 1;
	    $hash = Helpers::HashId();
	    $datox["hash"] = $hash;
		$datox["time"] = Helpers::TimeId();
	    $datox["td"] = $_SESSION["td"];
	    if ($db->insert("ticket", $datox)) {
	       $this->AgregaCaracteristicas($datos, $hash);
	       $this->AgregaUbicacion($datos, $hash);
	       $this->ActualizaProducto($datos["cod"], $datos["cantidad"], NULL);

	    } 

	}




	public function AgregarDesdeEcommerce($datos) { // agrega el producto
		$db = new dbConn();

		$datox = array();
	    $datox["cod"] = $datos["cod"];
	    $datox["cant"] = $datos["cantidad"];
	    $datox["producto"] = $datos["producto"];
	    $datox["pc"] = $this->ObtenerPrecioCosto($datos["cod"]);
	    $datox["pv"] = $datos["pv"]; 				   
	    $datox["stotal"] = $datos["stotal"];    				   
	    $datox["imp"] = $datos["imp"];
	    $datox["total"] = $datos["total"];
	    $datox["descuento"] =$datos["descuento"];
	    $datox["num_fac"] = 0;
	    $datox["fecha"] = date("d-m-Y");
	    $datox["hora"] = date("H:i:s");
	    $datox["orden"] = $_SESSION["orden"];
	    $datox["cajero"] = $_SESSION['nombre'];
	    $datox["tipo_pago"] = 1;
	    $datox["user"] = $_SESSION['user'];
	    $datox["tx"] = $_SESSION['tx'];
	    $datox["fechaF"] = Fechas::Format(date("d-m-Y"));
		$datox["entrega"] = date("d-m-Y");
	    $datox["entregaF"] = Fechas::Format(date("d-m-Y"));
	    $datox["edo"] = 1;
	    $hash = Helpers::HashId();
	    $datox["hash"] = $hash;
		$datox["time"] = Helpers::TimeId();
	    $datox["td"] = $_SESSION["td"];
	    if ($db->insert("ticket", $datox)) {
	       $this->AgregaCaracteristicas($datos, $hash);
	       $this->AgregaUbicacion($datos, $hash);
	       $this->ActualizaProducto($datos["cod"], $datos["cantidad"], NULL);

	    } 

	}





	public function Actualiza($datos,$func) { // agrega el producto suma de uno n uno
		$db = new dbConn();

	$pv = $this->ObtenerPrecio($datos["cod"], $datos["cantidad"]);
	$sumas = $pv * $datos["cantidad"];
	$descuento = NULL;

	if($_SESSION['descuento'] != NULL){
		$sumasx = $sumas;
		$sumas = Helpers::DescuentoTotal($sumas);
		$pv = Helpers::DescuentoTotal($pv);
		$descuento = $sumasx - $sumas;
	}

    $stot=Helpers::STotal($sumas, $_SESSION['config_imp']);
    $im=Helpers::Impuesto($stot, $_SESSION['config_imp']);
	$total = $stot + $im;

	    $cambio = array();


		if($_SESSION['config_descuento'] != NULL){
	
			if ($r = $db->select("descuento", "producto", "WHERE cod = '".$datos["cod"]."' and td = ".$_SESSION["td"]."")) { 
				$_SESSION['descuento'] = $r["descuento"]; 
			}  unset($r);  
		
			if ($_SESSION['descuento'] != NULL) {
				$sumas = number_format($pv * $datos["cantidad"], 2,'.',',');
				$sumasx = $sumas;
				$sumas = Helpers::DescuentoTotal($sumas);
				$pv = Helpers::DescuentoTotal($pv);
				$descuento = $sumasx - $sumas;
			
				$total = $pv * $datos['cantidad'];
				$stot=Helpers::STotalDesc($sumas, $_SESSION['config_imp']);
				$im=$total - $stot;
			
				$datox["descuento"] = $descuento;
			}
			unset($_SESSION['descuento']);
		}
		
	    $cambio["cant"] = $datos["cantidad"];
	    $cambio["pv"] = $pv;
	    $cambio["stotal"] = $stot;
	    $cambio["imp"] = $im;
	    $cambio["total"] = $total;
	    $cambio["descuento"] = $descuento;
	    if (Helpers::UpdateId("ticket", $cambio, "cod='".$datos["cod"]."' and orden = ".$_SESSION["orden"]." and tx = ".$_SESSION["tx"]." and td = ".$_SESSION["td"]."")) {
	       $this->ActualizaProducto($datos["cod"], 1, $func);
	    }

	}



public function AgregarProductoEspecial($datos) { // agrega el producto Especial
		$db = new dbConn();
		
		if($_SESSION["orden"] == NULL){ $this->AddOrden(); }

if($datos["precio"] != NULL and $datos["producto"] != NULL){

    $stot=Helpers::STotal($datos["precio"], $_SESSION['config_imp']);
    $im=Helpers::Impuesto($stot, $_SESSION['config_imp']);

if($datos["agrupado"] == NULL){
	$codigog = 9999999;
} else {
	$codigog = 8888888;
	$_SESSION["venta_agrupado"] = TRUE;
}

		$datox = array();
	    $datox["cod"] = $codigog;
	    $datox["cant"] = 1;
	    $datox["producto"] = strtoupper($datos["producto"]);
	    $datox["pc"] = $this->ObtenerPrecioCosto($datos["cod"]);
	    $datox["pv"] = $datos["precio"];  				   
	    $datox["stotal"] = $stot;	    				   
	    $datox["imp"] = $im;
	    $datox["total"] = $stot + $im;
	    $datox["num_fac"] = 0;
	    $datox["fecha"] = date("d-m-Y");
	    $datox["hora"] = date("H:i:s");
	    $datox["orden"] = $_SESSION["orden"];
	    $datox["cajero"] = $_SESSION['nombre'];
	    $datox["tipo_pago"] = 1;
	    $datox["user"] = $_SESSION['user'];
	    $datox["tx"] = $_SESSION['tx'];
	    $datox["fechaF"] = Fechas::Format(date("d-m-Y"));
		$datox["entrega"] = date("d-m-Y");
	    $datox["entregaF"] = Fechas::Format(date("d-m-Y"));
	    $datox["edo"] = 1;
	    $hash = Helpers::HashId();
	    $datox["hash"] = $hash;
		$datox["time"] = Helpers::TimeId();
	    $datox["td"] = $_SESSION["td"];
	    if($db->insert("ticket", $datox)){
	    	echo '<script>
				window.location.href="?"
			</script>';
	    }
	} else {
		Alerts::Alerta("error","Error!","Los campos no pueden estar vacios!");
	}   	
	
}




	public function ObtenerNombre($cod){
		$db = new dbConn();

	if ($r = $db->select("descripcion", "producto", "WHERE cod = '$cod' and td = ".$_SESSION["td"]."")){ 
        return $r["descripcion"];
    	} unset($r); 
    }



public function ObtenerPrecioCosto($cod) { // obtine cantiad de productos
	$db = new dbConn();

$precio = 0;
// cantidad de productos ingresados y precio costo
$a = $db->query("SELECT existencia, precio_costo FROM producto_ingresado WHERE existencia > 0 and producto = '".$cod."' and td = ". $_SESSION["td"] ."");
foreach ($a as $b) {
    $tot = $b["existencia"] * $b["precio_costo"];
    $precio = $precio + $tot;
    unset($tot);
} $a->close();

 

if ($r = $db->select("sum(existencia)", "producto_ingresado", "WHERE existencia > 0 and producto = '".$cod."' and td = ". $_SESSION["td"] ."")) { 
    $productos = $r["sum(existencia)"];
} unset($r);  

@$pc = $precio / $productos;

    return $pc;
}







public function PrecioLote($cod) { // Establece un precio de venta nuevo si se selecciono
	$db = new dbConn();

	if ($r = $db->select("precio_venta", "producto_ingresado", "WHERE existencia <= cant and existencia > 0 and precio_venta != 0 and producto = '".$cod."' and td = ". $_SESSION["td"] ." order by time desc limit 1")){ 
        $precio = $r["precio_venta"];
    	} unset($r); 
 
	return $precio; 
}




	public function ObtenerPrecio($cod, $cant){ // obtiene el precio independientemente la cantidad
		$db = new dbConn();
		// busco el precio que le corresponde
			
		if($this->ObtenerPrecioPromo($cod, $cant) != NULL){
			return $this->ObtenerPrecioPromo($cod, $cant);
		} elseif($_SESSION["config_mayorista"] == "on" and $this->ObtenerPrecioMayorista($cod, $cant) != NULL and $_SESSION["precio_mayorista_activo"] == TRUE){
			return $this->ObtenerPrecioMayorista($cod, $cant);
		} else {
			if ($this->PrecioLote($cod) != NULL) {
				return $this->PrecioLote($cod);
			} else {
				return $this->ObtenerPrecioNormal($cod, $cant);
			}
		}	
	}




	public function ObtenerPrecioNormal($cod, $cant){ // obtiene el precio independientemente la cantidad
		$db = new dbConn();
		// cuento si hay varias fechas
	$a = $db->query("SELECT * FROM producto_precio WHERE producto = '$cod' and td = ".$_SESSION["td"]."");
		$precios = $a->num_rows; $a->close();

			if($precios > 1){ // si hay mas de un precio
					
					if ($r = $db->select("precio", "producto_precio", "WHERE cant <= '$cant' and producto = '$cod' and td = ".$_SESSION["td"]." order by cant desc limit 1")) { 
				        $precio = $r["precio"];
				    } unset($r);

			} else { // si solo hay un precio
				   
				    if ($r = $db->select("precio", "producto_precio", "WHERE producto = '$cod' and td = ".$_SESSION["td"]."")) { 
				        $precio = $r["precio"];
				    } unset($r); 	
			}
		return $precio;
	}


	public function ObtenerPrecioMayorista($cod, $cant){ // obtiene el precio independientemente la cantidad
		$db = new dbConn();
		// cuento si hay varias fechas
	$a = $db->query("SELECT * FROM producto_precio_mayorista WHERE producto = '$cod' and td = ".$_SESSION["td"]."");
		$precios = $a->num_rows; $a->close();

			if($precios > 1){ // si hay mas de un precio
					
					if ($r = $db->select("precio", "producto_precio_mayorista", "WHERE cant <= '$cant' and producto = '$cod' and td = ".$_SESSION["td"]." order by cant desc limit 1")) { 
				        $precio = $r["precio"];
				    } unset($r);

			} else { // si solo hay un precio
				   
				    if ($r = $db->select("precio", "producto_precio_mayorista", "WHERE producto = '$cod' and td = ".$_SESSION["td"]."")) { 
				        $precio = $r["precio"];
				    } unset($r); 	
			}
		return $precio;
	}



	public function ObtenerPrecioPromo($cod, $cant){ // obtiene el precio independientemente la cantidad
		$db = new dbConn();
		// cuento si hay varias fechas
			if ($r = $db->select("precio", "producto_precio_promo", "WHERE producto = '$cod' and td = ".$_SESSION["td"]."")) { 
			        $precio = $r["precio"];
			    } unset($r);

			return $precio;
	}



	public function ObtenerCantidad($cod) { // obtine cantiad de productos
		$db = new dbConn();

	if ($r = $db->select("cantidad", "producto", "WHERE cod = '$cod' and td = ".$_SESSION["td"]."")){ 
        return $r["cantidad"];
    	} unset($r); 
    }


	public function ObtenerCantidadTicket($cod) { // obtine cantiad de productos
		$db = new dbConn();

	if ($r = $db->select("cant", "ticket", "WHERE cod = '$cod' and orden = ".$_SESSION["orden"]." and tx =  ".$_SESSION["tx"]." and td = ".$_SESSION["td"]."")){ 
        return $r["cant"];
    	} unset($r); 
    }


	public function ActualizaProducto($cod,$cant,$funt) { // descuenta o regresa los productos
		$db = new dbConn();
		// primero verifico si el producto es un compuesto. si es compuesto o dependiente actualizo todos los productos que este conlleva . si es un servicio no se hace nada
		// 
		    if ($r = $db->select("compuesto, dependiente, servicio", "producto", "WHERE cod = '".$cod."' and td = ".$_SESSION["td"]."")) { 
		        $compuesto = $r["compuesto"]; 
		        $dependiente = $r["dependiente"]; 
		        $servicio = $r["servicio"];
		    }  unset($r);  

			if($compuesto == "on"){ // aqui veo que productos lleva el producto comp
				
				$a = $db->query("SELECT agregado, cant FROM producto_compuestos WHERE producto = '$cod' and td = ".$_SESSION["td"]."");
				    foreach ($a as $b) {
				    	// comienza actualizar producto
				    	$cantidades = $cant * $b["cant"];
					if($funt == NULL){ // $func null es resta
						$cantidad = $this->ObtenerCantidad($b["agregado"]) - $cantidades; 
					} else {
						$cantidad = $this->ObtenerCantidad($b["agregado"]) + $cantidades; 
					}
				    $cambio = array();
				    $cambio["cantidad"] = $cantidad;
				    Helpers::UpdateId("producto", $cambio, "cod='".$b["agregado"]."' and td = ".$_SESSION["td"]."");
				    // termina la parte de actualizar producto
				} $a->close();

			} elseif($dependiente == "on"){

				$a = $db->query("SELECT dependiente, cant FROM producto_dependiente WHERE producto = '$cod' and td = ".$_SESSION["td"]."");
				    foreach ($a as $b) {
				    	// comienza actualizar producto
				    	$cantidades = $cant * $b["cant"];
					if($funt == NULL){ // $func null es resta
						$cantidad = $this->ObtenerCantidad($b["dependiente"]) - $cantidades; 
					} else {
						$cantidad = $this->ObtenerCantidad($b["dependiente"]) + $cantidades; 
					}
				    $cambio = array();
				    $cambio["cantidad"] = $cantidad;
				    Helpers::UpdateId("producto", $cambio, "cod='".$b["dependiente"]."' and td = ".$_SESSION["td"]."");
				    // termina la parte de actualizar producto
				} $a->close();

			} elseif($servicio == "on"){
				// si es servicio no se hace nada// solo valido la opcion para hacer el else
			} else {
				// comienza actualizar producto
				if($funt == NULL){ // $func null es resta
					$cantidad = $this->ObtenerCantidad($cod) - $cant; 
				} else {
					$cantidad = $this->ObtenerCantidad($cod) + $cant; 
				}
			    $cambio = array();
			    $cambio["cantidad"] = $cantidad;
			    Helpers::UpdateId("producto", $cambio, "cod='$cod' and td = ".$_SESSION["td"]."");
			    // termina la parte de actualizar producto
			}		    
		    
    }


	public function AgregaCaracteristicas($datos, $hash){
		$db = new dbConn();

 if ($r = $db->select("*", "producto", "WHERE cod = '".$datos["cod"]."' and td = ".$_SESSION["td"]."")) { 
$servicio_p = $r["servicio"];
}  unset($r);  

if($servicio_p != "on"){


		// cuento el producto tiene varias caracteristicas
		    $a = $db->query("SELECT * FROM caracteristicas_asig WHERE producto =  '".$datos["cod"]."' and td = ".$_SESSION["td"]."");

		    if($a->num_rows > 0){
		    	foreach ($a as $b) { // aqui agregare las caracteristicas que lo requieran
		        	$car = $b["caracteristica"];
		        		if($datos["caracteristica"][$car] != NULL){ // si no esta vacia se inserta
							    
							    $datox = array();
							    $datox["orden"] = $_SESSION["orden"];
							    $datox["producto"] = $datos["cod"];
							    $datox["producto_hash"] = $hash;
							    $datox["descuenta"] = 1;
							    $datox["codigo"] = $b["caracteristica"];
							    $datox["cant"] = $datos["caracteristica"][$car];
							    $datox["hash"] = Helpers::HashId();
							    $datox["time"] = Helpers::TimeId();
							    $datox["tx"] = $_SESSION["tx"];
							    $datox["td"] = $_SESSION["td"];
							    $db->insert("ticket_descuenta", $datox);

	    //// aqui descuento la cantidad de caracteristica
	     if ($r = $db->select("cant", "caracteristicas_asig", "WHERE caracteristica = '".$b["caracteristica"]."' and producto = '".$datos["cod"]."' and td = ".$_SESSION["td"]."")) { 
	        $ccar = $r["cant"];
	    } unset($r); 
	    // descuento
	   $cambio = array();
	   $cambio["cant"] = $ccar - $datos["caracteristica"][$car];
	   Helpers::UpdateId("caracteristicas_asig", $cambio, "caracteristica = '".$b["caracteristica"]."' and producto = '".$datos["cod"]."' and td = ".$_SESSION["td"]."");

		        		}
		    	}
		    } $a->close();
  } // servicio
}



	public function AgregaUbicacion($datos, $hash){  // agrega las ubicaciones
		$db = new dbConn();
		
		if($datos["ubicacion"] != NULL){ // si no esta vacia se inserta			

 if ($r = $db->select("*", "producto", "WHERE cod = '".$datos["cod"]."' and td = ".$_SESSION["td"]."")) { 
$servicio_p = $r["servicio"];
}  unset($r);  

if($servicio_p != "on"){

	    $datox = array();
	    $datox["orden"] = $_SESSION["orden"];
	    $datox["producto"] = $datos["cod"];
	    $datox["producto_hash"] = $hash;
	    $datox["descuenta"] = 2;
	    $datox["codigo"] = $datos["ubicacion"];
	    $datox["cant"] = $datos["cantidad"];
	    $datox["hash"] = Helpers::HashId();
	    $datox["time"] = Helpers::TimeId();
	    $datox["tx"] = $_SESSION["tx"];
	    $datox["td"] = $_SESSION["td"];
	    $db->insert("ticket_descuenta", $datox);

	//// aqui descuento la cantidad de caracteristica
 if ($r = $db->select("cant", "ubicacion_asig", "WHERE ubicacion = '".$datos["ubicacion"]."' and producto = '".$datos["cod"]."' and td = ".$_SESSION["td"]."")) { 
    $cubic = $r["cant"];
} unset($r); 
// descuento
$cambio = array();
$cambio["cant"] = $cubic - $datos["cantidad"];
Helpers::UpdateId("ubicacion_asig", $cambio, "ubicacion = '".$datos["ubicacion"]."' and producto = '".$datos["cod"]."' and td = ".$_SESSION["td"]."");

		}

}// servicio


	}






	public function AddOrden() { //leva el control del autoincremento de los clientes
		$db = new dbConn();

	    if ($r = $db->select("correlativo", "ticket_orden", "WHERE td = ".$_SESSION["td"]." and tx = ".$_SESSION["tx"]." order by correlativo desc limit 1")) { 
	        $ultimoorden = $r["correlativo"];
	    } unset($r);  

	    	if($ultimoorden == NULL){ $ultimoorden = 0; }
			$datos = array();
		    $datos["nombre"] = NULL;
		    $datos["correlativo"] = $ultimoorden + 1;
		    $datos["empleado"] = $_SESSION["nombre"];
		    $datos["user"] = $_SESSION["user"];
		    $datos["fecha"] = date("d-m-Y");
		    $datos["hora"] = date("H:i:s");
		    $datos["estado"] = 1;
		    $datos["tx"] = $_SESSION["tx"];
		    $datos["hash"] = Helpers::HashId();
		    $datos["time"] = Helpers::TimeId();
		    $datos["td"] = $_SESSION["td"];
		    $db->insert("ticket_orden", $datos); 
		
		$_SESSION["orden"] = $ultimoorden + 1;    
	}




/////////// mostrar los productos agregados



	public function VerProducto() { //leva el control del autoincremento de los clientes
		$db = new dbConn();
		    
		if($_SESSION["orden"] != NULL){
		    
		    $a = $db->query("SELECT * FROM ticket WHERE orden = ".$_SESSION["orden"]." and tx = ".$_SESSION["tx"]." and td = ".$_SESSION["td"]."");

		    if($a->num_rows > 0){

		    		echo '<div class="table-responsive">
		    		<table class="table table-striped table-sm">
					  <thead>
					    <tr>
					      <th scope="col">Cant</th>
					      <th scope="col">Producto</th>
					      <th scope="col">Precio</th>
					      <th scope="col" class="d-none d-md-block">Subtotal</th>
					      <th scope="col">Impuesto</th>
					      <th scope="col">Total</th>
					      <th scope="col">Borrar</th>
					    </tr>
					  </thead>
					  <tbody>';
		    		foreach ($a as $b) {
		    			@$porcentaje = (($b["descuento"] * 100) / ($b["total"] + $b["descuento"]));


		    		if($b["producto"] == "Producto_Agrupado"){
		    			$productox = $this->ObtenerNombre($b["cod"]);
		    			$color = 'class="purple lighten-5"';
		    		} else {
		    			$productox = $b["producto"];
		    			$color = NULL;
		    		}


		    		   echo '<tr '.$color.'>
						      <th scope="row">';

						    if($b["cod"] == 8888888 or $this->IsSercicio($b["cod"]) == TRUE){
			    				echo '<a id="agrupado""><i class="fas fa-times-circle blue-text fa-lg"></i></a>'.$b["cant"];
			    			} else {
			    				echo $b["cant"];
			    			}

						      echo '</th>';

						if ($_SESSION["root_comment_ticket"] == "on") {
							echo '<td><a id="selectComment" iden="'.$b["hash"].'">'.$productox.'</a></td>';
						} else {
							echo '<td>'.$productox.'</td>';
						}

						echo '<td>'.$b["pv"].'</td>
						      <td>'.$b["stotal"].'</td>
						      <td>'.$b["imp"].'</td>
						      <td>
						      <a id="xdescuento" dcodigo="'.$b["cod"].'" dcantidad="'.$b["cant"].'" ddescuento="'.$b["descuento"].'" dporcentaje="'.$porcentaje.'">'.$b["total"].'</a>
						      </td>
						      <td><a id="borrar-ticket" op="81" hash="'.$b["hash"].'"><i class="fas fa-times-circle red-text fa-lg"></i></a></td>
					</tr>';
				    }
				    	echo '</tbody>
							</table>
							</div>';
		    } $a->close();

		} else {
			
			if($_SESSION['config_otras_ventas'] == 1){ 
				echo '<div class="text-center">';
				echo '<div class="text-center">Ingrese un producto</div>';
				echo '<a href="?modal=oventas" class="btn-floating btn-success" title="Venta Especial"><i class="fas fa-donate"></i></a></div>';
				}
				
		}  
	}





	public function IsSercicio($cod){
		$db = new dbConn();

	if ($r = $db->select("servicio", "producto", "WHERE cod = '$cod' and td = ".$_SESSION["td"]."")){ 
        $servicio = $r["servicio"];
    	} unset($r); 

    	if($servicio == "on"){
    		return TRUE;
    	} else {
    		return FALSE;
    	}
    }


//// borrar
	
	public function CuentaProductos($orden){ // productde  de la tabla ticket
		$db = new dbConn();

		$a = $db->query("SELECT * FROM ticket WHERE orden = '$orden' and tx = ".$_SESSION["tx"]." and td = ".$_SESSION["td"]."");
		    
		    return $a->num_rows;
		    $a->close();
    }


	public function DelOrden($orden){ // elimina el registro de la orden
		$db = new dbConn();

		Helpers::DeleteId("ticket_orden", "correlativo = '$orden' and tx = ".$_SESSION["tx"]." and td = ".$_SESSION["td"]."");

	   if(isset($_SESSION["cliente_c"])){ // agregar el credito
	   		$opciones = new Opciones();
	   		$opciones->DelCredito();
	   	}
	   	if(isset($_SESSION["cliente_cli"])){ // guardar el registro del cliente
	   		$opciones = new Opciones();
	   		$opciones->DelCliente();
	   	}

	   	$_SESSION["orden"] = NULL;
		
		if(isset($_SESSION["orden"])) unset($_SESSION["orden"]);
		if(isset($_SESSION["descuento"])) unset($_SESSION["descuento"]);
		if(isset($_SESSION["tcredito"])) unset($_SESSION["tcredito"]);


    }


   public function DelVenta($hash, $ver){
	$db = new dbConn();
   	    
   	    if ($r = $db->select("*", "ticket", "WHERE hash = '$hash' and tx = ".$_SESSION["tx"]." and td = ".$_SESSION["td"]."")) { 
	        $cant_t = $r["cant"];
	        $cod = $r["cod"];
	    }  unset($r); 

   	    if ($r = $db->select("*", "producto", "WHERE cod = '$cod' and td = ".$_SESSION["td"]."")) { 
		$cant_p = $r["cantidad"];
		$servicio_p = $r["servicio"];
		}  unset($r);  
   	// regreso los valores a los productos

	// borro el registro de ticket
  	Helpers::DeleteId("ticket", "hash = '$hash' and tx = ".$_SESSION["tx"]." and td = ".$_SESSION["td"]."");
  	
if($servicio_p != "on"){
    $cambio = array();
   	$cambio["cantidad"] = $cant_p + $cant_t;
   	Helpers::UpdateId("producto", $cambio, "cod = '$cod' and td = ".$_SESSION["td"]."");  		
   	

  // regreso los valores de caracteristica y ubicacion
  	$a = $db->query("SELECT * FROM ticket_descuenta WHERE producto_hash = '$hash' and tx = ".$_SESSION["tx"]." and td = ".$_SESSION["td"]."");
  	if($a->num_rows > 0){
  			foreach ($a as $b) {
		        if($b["descuenta"] == 1){ // si es caracteristica
        	   	    if ($r = $db->select("*", "caracteristicas_asig", "WHERE producto = '$cod' and caracteristica = '".$b["codigo"]."' and td = ".$_SESSION["td"]."")) { 
					$cant_car = $r["cant"];
					}  unset($r); 

				   $cambio = array();
				   $cambio["cant"] = $cant_car + $b["cant"];
				   Helpers::UpdateId("caracteristicas_asig", $cambio, "producto = '$cod' and caracteristica = '".$b["codigo"]."' and td = ".$_SESSION["td"]."");  
		        }
		        if($b["descuenta"] == 2){
        	   	    if ($r = $db->select("*", "ubicacion_asig", "WHERE producto = '$cod' and ubicacion = '".$b["codigo"]."' and td = ".$_SESSION["td"]."")) { 
					$cant_u = $r["cant"];
					}  unset($r); 

				   $cambio = array();
				   $cambio["cant"] = $cant_u + $b["cant"];
				   Helpers::UpdateId("ubicacion_asig", $cambio, "producto = '$cod' and ubicacion = '".$b["codigo"]."' and td = ".$_SESSION["td"]."");  		        	
		        }
		    }
  	}  $a->close();
  	// borro caracteristica y ubicacion 
  	Helpers::DeleteId("ticket_descuenta", "producto_hash = '$hash' and tx = ".$_SESSION["tx"]." and td = ".$_SESSION["td"]."");
  	// compruebo si hay mas productos sino elimino orden

} // si no es servicio

	  	if($this->CuentaProductos($_SESSION["orden"]) == 0){
	  		$this->DelOrden($_SESSION["orden"]);
	  	}

	  	if($ver == NULL){
	  		$this->VerProducto();
	  	}
	  	if($ver == 1 and $this->CuentaProductos($_SESSION["orden"]) == 0){
	  		$this->VerProducto();
	  	}
  	
   }
/////// guardar la venta


   	public function Cancelar() { //cancela toda la orden
		$db = new dbConn();

	   	if(isset($_SESSION["cliente_c"])){ // agregar el credito
	   		$opciones = new Opciones();
	   		$opciones->DelCredito();
	   	}
	   	if(isset($_SESSION["cliente_cli"])){ // guardar el registro del cliente
	   		$opciones = new Opciones();
	   		$opciones->DelCliente();
	   	}
		if(isset($_SESSION["repartidor_cli"])){ // guardar el registro del cliente
			$repartidor = new Repartidor();
			$repartidor->UnsetRepartidor();
		}
		if(isset($_SESSION["factura_cliente"])){ // eliminar variables de cliente credito fiscal
			$opciones = new Opciones();
			$opciones->DelCliente();
		}

			$can = $db->query("SELECT * FROM ticket WHERE orden = ".$_SESSION["orden"]." and tx = ".$_SESSION["tx"]." and td = ".$_SESSION["td"]."");
		    
		    foreach ($can as $cancel) {
		    	$hash = $cancel["hash"];	    
		    	$this->DelVenta($hash, 1);
		    } $can->close();
	}


///////////////////////////////// ordenes ///////////////
///
	public function GuardarOrden() { //guarda la orden para poder facturar
		$db = new dbConn();

	   if(isset($_SESSION["cliente_c"])){ // agregar el credito
	   		$opciones = new Opciones();
	   		$opciones->UnsetCredito();
	   	}
	   	if(isset($_SESSION["cliente_cli"])){ // guardar el registro del cliente
	   		$opciones = new Opciones();
	   		$opciones->UnsetCliente();
	   	}	
		if(isset($_SESSION["repartidor_cli"])){ // guardar el registro del cliente
			$repartidor = new Repartidor();
			$repartidor->UnsetRepartidor();
		}
		if(isset($_SESSION["factura_cliente"])){ // borra las variables del cliente asignado al guardar la orden
			$opciones = new Opciones();
			$opciones->UnsetCliente();
		}	

		$cambios = array();
	   	$cambios["estado"] = 3;
	   	Helpers::UpdateId("ticket_orden", $cambios, "correlativo = ".$_SESSION["orden"]." and tx = ".$_SESSION["tx"]." and td = ".$_SESSION["td"].""); 

		unset($_SESSION["orden"]);
	}






	public function SelectOrden($orden) { //Seleccioa Orden
		$db = new dbConn();

		// reviso que aun este activa sino mando mensaje
$a = $db->query("SELECT * FROM ticket_orden WHERE correlativo = '$orden' and tx = ".$_SESSION["tx"]." and td = ".$_SESSION["td"]." and estado = 3");
$num = $a->num_rows;
$a->close();

// para ordenes activas pero del usuario activo
$a = $db->query("SELECT * FROM ticket_orden WHERE correlativo = '$orden' and tx = ".$_SESSION["tx"]." and td = ".$_SESSION["td"]." and estado = 1 and user = '".$_SESSION["user"]."'");
$numu = $a->num_rows;
$a->close();


	if($num > 0 or $numu > 0){

		$cambios = array();
	   	$cambios["estado"] = 1;
	   	Helpers::UpdateId("ticket_orden", $cambios, "correlativo = '$orden' and tx = ".$_SESSION["tx"]." and td = ".$_SESSION["td"].""); 

		$_SESSION["orden"] = $orden;
   		$opciones = new Opciones();
   		$opciones->VarCredito();
		$repartidor = new Repartidor();
		$repartidor->VarRepartidor();
	} else {
		Alerts::Alerta("error","Error!","El estado de la orden cambió!");
	}



	}
////////////////////////////////////////////




	public function AddTicketNum($efectivo) { //leva el control del autoincremento de los clientes
		$db = new dbConn();

		if($_SESSION['aplicar_credito_sin_factura'] == 1 and $_SESSION['cliente_credito']) {
			$tipoticket = 99;
		} else {
			$tipoticket = $_SESSION["tipoticket"];
		}

	    if ($r = $db->select("num_fac", "ticket_num", "WHERE tipo = '".$tipoticket."' and edo = 1 and td = ".$_SESSION["td"]." and tx = ".$_SESSION["tx"]." order by time desc limit 1")) { 
			if($_SESSION['newCorrelativo']){
				$ultimoorden = $_SESSION['newCorrelativo'];
				unset($_SESSION['newCorrelativo']);
			} else {
				$ultimoorden = $r["num_fac"];
			}
	    } unset($r);  

			$datos = array();
			
		    $datos["fecha"] = date("d-m-Y");
		    $datos["hora"] = date("H:i:s");
		    $datos["num_fac"] = $ultimoorden + 1;
		    $datos["orden"] = $_SESSION["orden"];
		    $datos["efectivo"] = $efectivo;
		    $datos["edo"] = 1;
		    $datos["tx"] = $_SESSION["tx"];
		    $datos["tipo"] = $tipoticket;
		    $datos["hash"] = Helpers::HashId();
		    $datos["time"] = Helpers::TimeId();
		    $datos["td"] = $_SESSION["td"];
		    $db->insert("ticket_num", $datos); 
		
 		return $ultimoorden + 1;
	}




   public function Facturar($datos){
  		$db = new dbConn();

  		$factura = $this->AddTicketNum($datos["efectivo"]);
 		
 		// configuro el tipo de pago
 		if(isset($_SESSION["cliente_c"])) $tpago = 3;
 		elseif(isset($_SESSION["tcredito"])) $tpago = 2;
		elseif($_SESSION["tipoticket"] == 8) $tpago = 8;
 		else $tpago = 1;

	    $cambio = array();
	   	$cambio["num_fac"] = $factura;
	   	$cambio["tipo"] = ($_SESSION['aplicar_credito_sin_factura'] == 1 and $_SESSION['cliente_credito']) ? 99 :$_SESSION["tipoticket"];
	   	$cambio["tipo_pago"] = $tpago;
	   	$cambio["cajero"] = $_SESSION["user"];
	   	Helpers::UpdateId("ticket", $cambio, "orden = ".$_SESSION["orden"]." and tx = ".$_SESSION["tx"]." and td = ".$_SESSION["td"]."");  

	   	$cambios = array();
	   	$cambios["estado"] = 2;
	   	$cambios["cajero"] = $_SESSION["user"];
		$cambios['tipo_pago'] = $tpago;
	   	Helpers::UpdateId("ticket_orden", $cambios, "correlativo = ".$_SESSION["orden"]." and tx = ".$_SESSION["tx"]." and td = ".$_SESSION["td"]."");  

		if($_SESSION["gran_contribuyente"] == 1){
			$this->AplicarRetencion();
		}
	   	$this->FacturaResult($factura, $datos["efectivo"]);
	   	$this->RegistroDocumento($factura);


	   	$this->Empareja($factura);

	   	if(isset($_SESSION["cliente_c"])){ // agregar el credito
	   		$opciones = new Opciones();
	   		$opciones->ConfirmCredito($factura, $_SESSION["cliente_c"]);
	   		$opciones->UnsetCredito();
	   	}
	   	if(isset($_SESSION["cliente_cli"])){ // guardar el registro del cliente
	   		$opciones = new Opciones();
	   		$opciones->ConfirmCliente($factura, $_SESSION["cliente_cli"]);
	   		$opciones->UnsetCliente();
	   	}
		if(isset($_SESSION["repartidor_cli"])){
			$repartidor = new Repartidor();
			$repartidor->UnsetRepartidor();
		}
			$kardex = new Kardex();
			$kardex->InsertVenta($factura, $_SESSION["tipoticket"], $_SESSION["orden"]);
			if(isset($_SESSION["orden"])) unset($_SESSION["orden"]);
			if(isset($_SESSION["descuento"])) unset($_SESSION["descuento"]);
			if(isset($_SESSION["tcredito"])) unset($_SESSION["tcredito"]);
			if(isset($_SESSION["gran_contribuyente"])) unset($_SESSION["gran_contribuyente"]);

			
   }





   public function FacturaResult($factura, $efectivo){
  		$db = new dbConn();

    $a = $db->query("SELECT sum(stotal), sum(imp), sum(total) FROM ticket WHERE num_fac = '$factura' and orden = ".$_SESSION["orden"]." and tx = ".$_SESSION["tx"]." and td = ".$_SESSION["td"]."");
		    foreach ($a as $b) {
		     $stotal=$b["sum(stotal)"]; 
			 $imp=$b["sum(imp)"];
			 $total = $b["sum(total)"];
		    } $a->close();

if($efectivo == NULL){
	$efectivo = $total;
}

$cambio = $efectivo - $total;
echo '<p class="text-center">Sub Total: '. Helpers::Dinero($stotal) .' ||  Impuestos: '. Helpers::Dinero($imp) . '</p>';

echo '<p class="text-center font-weight-bold">TOTAL:</p>';
echo '<div class="display-4 text-center font-weight-bold">'. Helpers::Dinero($total) .'</div> <hr>';

echo '<p class="text-center font-weight-bold">EFECTIVO:</p>';
echo '<div class="display-4 text-center font-weight-bold">'. Helpers::Dinero($efectivo) .'</div> <hr>';

echo '<p class="text-center font-weight-bold">CAMBIO:</p>'; 
echo '<div class="display-4 text-center font-weight-bold">'. Helpers::Dinero($cambio) . '</div>'; 


$_SESSION["factura_actual_print"] = $factura; // solo para imprimir la factura correcta
$_SESSION["cambio_actual_print"] = $efectivo; // solo para imprimir la factura correcta


// echo '<hr>
// <div class="clearfix">
// <div class="float-left">
// <a href="system/facturar/ticket_web.php?factura='.$factura.'" class="btn-floating btn-sm btn-success"><i class="fas fa-print"></i></a>
// </div>
// <div class="float-right">
// <a href="system/facturar/ticket_web.php?factura='.$factura.'" class="btn-floating btn-sm btn-info"><i class="fas fa-print"></i></a>
// </div>
// </div>';


   }


  public function RegistroDocumento($factura){ // registra el documento al facturar
    $db = new dbConn();


//// solo si esta activo lo de taller
	if($_SESSION["root_taller"] == "on" and $_SESSION["vehiculo_factura"] != NULL){
		$data = array();
		$data["cliente"] = $_SESSION["cliente_cli"];
	    $data["vehiculo"] = $_SESSION["vehiculo_factura"];
		$data["factura"] = $factura;
	    $data["tx"] = $_SESSION["tx"];
	    $data["tipo"] = $_SESSION["tipoticket"];
	    $data["fecha"] = date("d-m-Y");
	    $data["fechaF"] = Fechas::Format(date("d-m-Y"));
	    $data["hora"] = date("H:i:s");
	    $data["hash"] = Helpers::HashId();
	    $data["time"] = Helpers::TimeId();
	    $data["td"] = $_SESSION["td"];
	    if($db->insert("taller_facturas", $data)){
	    	unset($_SESSION["vehiculo_factura"]);
	    } 	
	}



	if($_SESSION["factura_cliente"] != NULL and $_SESSION["factura_documento"] != NULL){
		$datos = array();
		$datos["factura"] = $factura;
	    $datos["tx"] = $_SESSION["tx"];
	    $datos["tipo"] = $_SESSION["tipoticket"];
	    $datos["cliente"] = $_SESSION["factura_cliente"];
	    $datos["documento"] = $_SESSION["factura_documento"];
	    $datos["hash"] = Helpers::HashId();
	    $datos["time"] = Helpers::TimeId();
	    $datos["td"] = $_SESSION["td"];
	    if($db->insert("facturar_documento_factura", $datos)){
	    	unset($_SESSION["factura_cliente"]);
	    	unset($_SESSION["factura_documento"]);
	    } 	
	}

}








  public function Empareja($factura){
      $db = new dbConn();

	$x = $db->query("SELECT cod FROM ticket WHERE num_fac = '$factura' and orden = ".$_SESSION["orden"]." and tx = ".$_SESSION["tx"]." and td = ".$_SESSION["td"]."");
	foreach ($x as $y) {
		$this->EmparejaExistencias($y["cod"]);
	} $x->close();
}



  public function EmparejaExistencias($cod){
      $db = new dbConn();

$x = $db->query("SELECT producto, hash, existencia FROM producto_ingresado WHERE producto = '$cod' and existencia != 0  and td = ".$_SESSION["td"]."");
foreach ($x as $y) {

// cantidad total de los productos que hay
    if ($r = $db->select("sum(cantidad)", "producto", "WHERE cod = '".$y["producto"]."' and td = ".$_SESSION["td"]."")) { $cantidad = $r["sum(cantidad)"]; } unset($r); 

// cantidad total de las existencia
    if ($r = $db->select("sum(existencia)", "producto_ingresado", "WHERE producto = '".$y["producto"]."' and td = ".$_SESSION["td"]."")) { $canti = $r["sum(existencia)"]; } unset($r); 

// existencia actual del registro
$existencia = $y["existencia"];

      if($cantidad < $canti){

        $xcant = $canti - $cantidad;
        // evito los numeros negativos
        if($xcant > $existencia){
          $xcant = 0;
        } else {
          $xcant = $existencia - $xcant;
        }

          $cambio = array();
          $cambio["existencia"] = $xcant;
          Helpers::UpdateId("producto_ingresado", $cambio, "hash = '".$y["hash"]."' and td = ".$_SESSION["td"]."");
      }

  } $x->close();
    


}

public function AplicarRetencion() { //Aplica la retencion del 1% a los productos con ventas a grandes contribuyentes
	$db = new dbConn();
		// Obtener productos y subtotal		
		$productos = $db->query("SELECT * FROM ticket WHERE orden = ".$_SESSION["orden"]." and tx = ".$_SESSION["tx"]." and td = ".$_SESSION["td"]."");
		$subTotal = $db->select("sum(stotal)", "ticket", "WHERE orden = ".$_SESSION["orden"]." and tx = ".$_SESSION["tx"]." and td = ".$_SESSION["td"]."");
		
		  // Aplicar retención a cada producto
		if($productos->num_rows > 0 && $subTotal["sum(stotal)"] >= 100){
			foreach ($productos as $producto) {
				$sTotal = $producto["stotal"];
				$cambio = array();
   				$cambio["retencion"] = $sTotal * 0.01;
				Helpers::UpdateId("ticket", $cambio,  "hash = '".$producto["hash"]."' and td = ".$_SESSION["td"]."");
			}
		} $productos->close();

	$this->restarRetencion();
}

public function restarRetencion() { //Resta la retencion del 1% a los productos con ventas a grandes contribuyentes
	$db = new dbConn();
		// Obtener productos	
		$productos = $db->query("SELECT * FROM ticket WHERE orden = ".$_SESSION["orden"]." and tx = ".$_SESSION["tx"]." and td = ".$_SESSION["td"]."");
		
		// Restar la retencion al total del producto
		if($productos->num_rows > 0 ){
			foreach ($productos as $producto) {
				$total = $producto["total"];
				$retencion = $producto["retencion"];
				$cambio = array();
   				$cambio["total"] = $total-$retencion;
				Helpers::UpdateId("ticket", $cambio,  "hash = '".$producto["hash"]."' and td = ".$_SESSION["td"]."");
			}
		} $productos->close();
}








} // Termina la lcase
?>
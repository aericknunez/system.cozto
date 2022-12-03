<?php 
class Laterales{

	public function __construct() { 
 	} 



 	public function VerLateral($orden){
 		$db = new dbConn();

 		if($orden != NULL){
 			if($this->VerificaOrden($orden) == 0){
					if(isset($_SESSION["orden"])) unset($_SESSION["orden"]);
					if(isset($_SESSION["descuento"])) unset($_SESSION["descuento"]);
					$this->MostrarOrdenes();
 			} else {
 				$this->MostrarTotal($orden);
 				$this->MostrarBotones($orden);
 			}
 			
 		} else {
 			$this->MostrarOrdenes();
 		}

 	}


	public function VerificaOrden($orden){ // verifica si existe la orden para asegurar que se borro
		$db = new dbConn();
		$a = $db->query("SELECT * FROM ticket_orden WHERE correlativo = '$orden' and tx = ".$_SESSION["tx"]." and td = ".$_SESSION["td"]."");
		    
		    return $a->num_rows;
		    $a->close();
    }



 	public function MostrarTotal($orden){ // totales de la orden
 		$db = new dbConn();


 		echo '<div class="card-deck text-center">
			    <!--Panel-->
			    <div class="card">
			        <div class="card-body">
			            <h4 class="card-title">TOTAL '. $_SESSION['config_moneda_simbolo'] .'</h4>
			            <p class="black-text display-3"> '. $this->ObtenerTotal($orden) .'</p>
			            <div id="vticket">'. $this->NombreTicket() .'</div>
			        </div>
			    </div>
			</div>';
			echo '<hr>';
 	}


 	public function TipoTicket($tipo = null){ // selecciona el tipo de documento a emitir
 		$db = new dbConn();
		
		if($tipo == NULL){
 		    if ($r = $db->select("predeterminado", "facturar_opciones", "WHERE td = ".$_SESSION["td"]."")) { 
		        $preder = $r["predeterminado"];
		    }  unset($r);  
		    $_SESSION["tipoticket"] = $preder;

		    return  $this->NombreTicket();
		} else {
			$_SESSION["tipoticket"] = $tipo;

	if($_SESSION["tipoticket"] == 1){ echo '<a id="mticket">TICKET</a>'; }
	elseif($_SESSION["tipoticket"] == 2){ echo '<a id="mticket">FACTURA</a>'; }
	elseif($_SESSION["tipoticket"] == 3){ echo '<a id="mticket">CREDITO FISCAL</a>'; }
	elseif($_SESSION["tipoticket"] == 4){ echo '<a id="mticket">NOTA DE CREDITO</a>'; }
	elseif($_SESSION["tipoticket"] == 0){ echo '<a id="mticket">N/A</a>'; }

		}

}


public function NombreTicket(){ // selecciona el tipo de documento a emitir	
// 0 ninguno, 1 ticket, 2 factura, 3 credito fiscal
if($_SESSION["tipoticket"] == 1){ return '<a id="mticket">TICKET</a>'; }
elseif($_SESSION["tipoticket"] == 2){ return '<a id="mticket">FACTURA</a>'; }
elseif($_SESSION["tipoticket"] == 3){ return '<a id="mticket">CREDITO FISCAL</a>'; }
elseif($_SESSION["tipoticket"] == 4){ return '<a id="mticket">NOTA DE CREDITO</a>'; }
elseif($_SESSION["tipoticket"] == 0){ return '<a id="mticket">N/A</a>'; }
}




 	public function MostrarOrdenes(){ // listado de ordenes pendientes
 		$db = new dbConn();


 			/// ordenes activas pero del mismo usuario
			if ($x = $db->select("count(correlativo)", "ticket_orden", "WHERE estado = 1 and user = '".$_SESSION["user"]."' and td = ".$_SESSION["td"]."")) { 
				$usercount = $x["count(correlativo)"];
	 		} unset($x); 

			// ordenes guardadas
			if ($r = $db->select("count(correlativo)", "ticket_orden", "WHERE estado = 3 and td = ".$_SESSION["td"]."")) { 
				$usercountx = $r["count(correlativo)"];
	 		} unset($r); 

	 		if($usercountx > 0 or $usercount > 0){
	 			$this->ObtenerOrdenes();
	 		} else {
	 		    	echo '<div class="text-center"><img src="assets/img/logo/'.$_SESSION['config_imagen'].'" class="img-fluid responsive" alt="Responsive image"></div>';
	 		} 
 		
 	}



 	public function MostrarBotones($orden){ // botones de funcion para la venta
 		echo '<div align="center" class="justify-content-center">';
 		echo '<button id="guardar" orden="'.$orden.'" op="82" class="btn btn-outline-primary btn-rounded waves-effect"><i class="fas fa-save mr-1"></i> Guardar</button>';
 		if($_SESSION['tipo_cuenta'] != 4 and $_SESSION["caja_apertura"] != NULL){
 			echo '<a href="?modal=facturar" class="btn btn-outline-secondary btn-rounded waves-effect"><i class="fas fa-money-bill-alt mr-1"></i> Cobrar</a>';
 		}
 		//echo '<button class="btn btn-outline-danger btn-rounded waves-effect"><i class="fas fa-ban mr-1"></i> Cancelar</button>';
 		echo '<a id="cancelar" op="86" class="btn btn-outline-red btn-rounded waves-effect"><i class="fas fa-ban mr-1"></i> Cancelar</a>';

 		echo '</div>';

 		if($_SESSION["tipo_inicio"] == 1){ // para buscar producto
 			$btnaux = '<a data-toggle="modal" data-target="#ModalBusqueda" class="btn-floating btn-info" title="Buscar Producto"><i class="fas fa-search"></i></a>';
 		} else {
 			$btnaux = NUll;
 		}
 		echo '<div class="text-center">';
 		
 		echo $btnaux; // boton de buscar

 		if($_SESSION["config_pesaje"] == "on"){ // para buscar productos pesados
 			echo '<a id="xbalanza" class="btn-floating btn-danger" title="Buscar Producto"><i class="fas fa-balance-scale"></i></a>';
 		}

		

		if($_SESSION["root_tipo_sistema"] != 1) { 
		echo '<a href="?modal=descuento" class="btn-floating btn-default" title="Descuento"><i class="fas fa-money-bill"></i></a>';
		
		echo '<a href="?modal=credito" class="btn-floating btn-primary" title="Asignar Credito"><i class="fab fa-cc-visa"></i></a>';
		}


		if($_SESSION['cliente_credito'] == NULL and $_SESSION['cliente_asig'] == NULL and $_SESSION["root_taller"] != "on"){
		echo '<a href="?modal=dfactura" class="btn-floating btn-secondary" title="Datos Factura"><i class="fas fa-file-invoice-dollar"></i></a>';
		}
		
		echo '<a href="?modal=oventas" class="btn-floating btn-success" title="Venta Especial"><i class="fas fa-donate"></i></a>';


		// echo '<a href="?modal=agrupado" class="btn-floating btn-info" title="Venta Agrupada"><i class="fas fa-donate"></i></a>';

		if($_SESSION['cliente_credito'] == NULL and $_SESSION['factura_cliente'] == NULL and $_SESSION["root_taller"] != "on"){
			echo '<a href="?modal=cliente" class="btn-floating btn-warning" title="Asignar Cliente"><i class="fas fa-user"></i></a>';
		}


		if($_SESSION["root_taller"] == "on"){
			echo '<a href="?modal=cliente_taller" class="btn-floating btn-danger" title="Asignar Cliente"><i class="fas fa-user"></i></a>';
		}

		if($_SESSION["root_repartidor"] == "on"){
			echo '<a href="?modal=add_repartidor" class="btn-floating btn-danger" title="Asignar Repartidor"><i class="fas fa-user"></i></a>';
		}
		echo '</div>';



/// Mensajes de de usuarios agregados
/// 
		if($_SESSION["descuento"] != NULL){
			$texto = 'Esta venta posee un descuento del: ' . $_SESSION["descuento"] . " %";
			Alerts::Mensajex($texto,"danger",NULL,NULL);
		}
		if($_SESSION['cliente_credito']){
			 $textos = 'Cliente asignado para credito: ' . $_SESSION['cliente_credito']. ".";
			Alerts::Mensajex($textos,"success",NULL,NULL);
		}
		if($_SESSION['cliente_asig']){
			 $textos = 'Cliente asignado para la Factura: ' . $_SESSION['cliente_asig']. ".";
			Alerts::Mensajex($textos,"info",NULL,NULL);
		}

		if($_SESSION['factura_cliente']){
			 $textos = 'Cliente asignado para la Factura: ' . $_SESSION['factura_cliente']. ". Con el Documento: " . $_SESSION['factura_documento'];
			Alerts::Mensajex($textos,"info",NULL,NULL);
		}

		if($_SESSION['repartidor_asig']){
			$textos = 'Repartidor asignado a la Orden: ' . $_SESSION['repartidor_asig'];
		   Alerts::Mensajex($textos, "warning", NULL,NULL);
	   }



 	}



 	public function ObtenerTotal($orden){ // listado de ordenes pendientes
 		$db = new dbConn();

 		    if ($r = $db->select("sum(total)", "ticket", "WHERE orden = '$orden' and tx = ".$_SESSION["tx"]." and td = ".$_SESSION["td"]."")) { 
		        return $r["sum(total)"];
		    }  unset($r);  
 		
 	}


 	public function ObtenerOrdenes(){ // listado de ordenes
 		$db = new dbConn();

		if ($_SESSION['root_restringir_ordenes'] == "on" and $_SESSION["tipo_cuenta"] == 4) {
			$userQuery = 'and user = "' . $_SESSION['user'] . '"';
		} else {
			$userQuery = '';
		}

 		    $a = $db->query("SELECT * FROM ticket_orden WHERE estado = 3 $userQuery and td = ".$_SESSION["td"]."");

	 		    if($a->num_rows > 0){
	 		    	echo '<ul class="list-group">
					  <li class="list-group-item d-flex justify-content-between active">
					    ORDENES GUARDADAS
					    <span class="badge badge-danger badge-pill">'.$a->num_rows.'</span>
					  </li>';
	 		    	foreach ($a as $b) {
	 		    	echo '<li class="list-group-item list-group-item-action d-flex justify-content-between">

	 		    	<a id="select-orden" orden="'. $b["correlativo"].'" op="83"> <span class="badge badge-danger badge-pill"><i class="fas fa-reply"></i></span> ';
	 		    		if($b["nombre"] != NULL){
	 		    			echo 'Cliente: <strong>' . $b["nombre"] . '</strong>';
	 		    		} else {
	 		    			echo 'Usuario: ' . $b["empleado"];
	 		    		}

	 		    	echo ' | '. $b["fecha"].' '. $b["hora"].'</a>

	 		    	<a href="system/facturar/facturas/'.$_SESSION["td"].'/ticket_comanda.php?orden='.$b["correlativo"].'" target="_blank"> <span class="badge badge-success badge-pill"><i class="fas fa-print fa-lg pt-1 pb-1"></i></span></a>
	 		    	</li>';
			    }
			    	echo '</ul>';
 		    } $a->close();


 
  		    $a = $db->query("SELECT * FROM ticket_orden WHERE estado = 1 $userQuery and td = ".$_SESSION["td"]."");

	 		    if($a->num_rows > 0){
	 		    	echo '<ul class="list-group">
					  <li class="list-group-item d-flex justify-content-between align-items-center active">
					    ORDENES ACTIVAS
					    <span class="badge badge-success badge-pill">'.$a->num_rows.'</span>
					  </li>';
	 		    	foreach ($a as $b) {
	 		    	echo '<a id="select-orden" orden="'. $b["correlativo"].'" op="83" class="list-group-item list-group-item-action"> <span class="badge badge-success badge-pill"><i class="fas fa-reply"></i></span> ';
	 		    		if($b["nombre"] != NULL){
	 		    			echo 'Cliente: <strong>' . $b["nombre"] . '</strong>';
	 		    		} else {
	 		    			echo 'Usuario: ' . $b["empleado"];
	 		    		}

	 		    	echo ' | '. $b["fecha"].' '. $b["hora"].'</a>';
			    }
			    	echo '</ul>';
 		    } $a->close();


 	}



 	public function ContarProducto($orden){ // listado de ordenes pendientes
 		$db = new dbConn();

 			$a = $db->query("SELECT producto FROM ticket WHERE num_fac = 0 and orden = '$orden' and tx = ".$_SESSION["tx"]." and td = ".$_SESSION["td"]."");
			return $a->num_rows;
			$a->close();
 		
 	}







} // Termina la lcase
?>
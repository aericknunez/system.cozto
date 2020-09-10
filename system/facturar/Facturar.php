<?php 
class Facturar{



	public function ModFactura($data){ /// cambiar estado de factura
		$db = new dbConn();

		$cambio = array();	

		switch ($data["iden"]) {
			case "ax0":
				$cambio["ax0"] = $data["edo"];
				break;
			case "ax1":
				$cambio["ax1"] = $data["edo"];
				break;
			case "bx0":
				$cambio["bx0"] = $data["edo"];
				break;
			case "bx1":
				$cambio["bx1"] = $data["edo"];
				break;
			case "cx0":
				$cambio["cx0"] = $data["edo"];
				break;
			case "cx1":
				$cambio["cx1"] = $data["edo"];
				break;
			case "dx0":
				$cambio["dx0"] = $data["edo"];
				break;
			case "dx1":
				$cambio["dx1"] = $data["edo"];
				break;

		}


		$a = $db->query("SELECT * FROM facturar_opciones WHERE td = ".$_SESSION["td"]."");
		if($a->num_rows > 0){    
		    if (Helpers::UpdateId("facturar_opciones", $cambio, "td = ".$_SESSION["td"]."")) {
		        Alerts::Alerta("success","Echo!","Registros actualizados correctamente");
		    }		
		} else {
		    $cambio["td"] = $_SESSION["td"];
			$cambio["hash"] = Helpers::HashId();
			$cambio["time"] = Helpers::TimeId();
		    if ($db->insert("facturar_opciones", $cambio)) {
		    	Alerts::Alerta("success","Echo!","Registros actualizados correctamente");
		    } 			
		}

		$a->close();     
	}




public function ObtenerEstadoFactura($efectivo, $factura){ // esta funcion obtiene el estado de la factura, el tx o si es local o web para decidir cual factura mostrar
		$db = new dbConn();
		$imprimir = new Impresiones(); 
		
if($_SESSION["tx"] == 0){

    if ($r = $db->select("ax0, bx0", "facturar_opciones", "WHERE td = ".$_SESSION["td"]."")) { 
        $ax0 = $r["ax0"]; $bx0 = $r["bx0"];
    } unset($r);  

	if($ax0 == 1 or $bx0 == 1){

	      if($ax0 == 1){  // tx0 ticket

	      		if($_SESSION["root_plataforma"] == 0){ // si es local
	      			// $imprimir->Ticket($efectivo, $factura);
	      			// echo "Ticket tx0 y local";
	         //(tipo,numero,cambio,impresor,mesa,factura_o_tiket)
	      		} else {
	      			// aqui va el vinculo a web
	      			echo '<a href="system/facturar/facturas/'.$_SESSION["td"].'/ticket_web.php?factura='.$factura.'" class="btn-floating btn-sm btn-info" target="_blank"><i class="fas fa-print"></i></a>xx';
	      			// echo "Ticket tx0 y Web";
	      		}        
	      }
	      if($bx0 == 1){ // tx0 factura
	      		if($_SESSION["root_plataforma"] == 0){ // si es local
	      			// $imprimir->Factura($efectivo, $factura);
	      			// echo "Factura tx0 y local";
	         //(tipo,numero,cambio,impresor,mesa,factura_o_tiket)
	      		} else {
	      			// aqui va el vinculo a web
	      			echo '<a href="system/facturar/facturas/'.$_SESSION["td"].'/ticket_web.php?factura='.$factura.'" class="btn-floating btn-sm btn-info" target="_blank"><i class="fas fa-print"></i></a>xx';
	      			// echo "Factura tx0 y Web";
	      		}
	      }


	}

} else {
    
    if ($r = $db->select("ax1, bx1", "facturar_opciones", "WHERE td = ".$_SESSION["td"]."")) { 
        $ax1 = $r["ax1"]; $bx1 = $r["bx1"];
    } unset($r);  
 
     if($bx1 == 1 or $bx1 == 1){ 

        if($ax1 == 1){ // tx1 ticket
        		if($_SESSION["root_plataforma"] == 0){ // si es local
	      			// $imprimir->Ticket($efectivo, $factura);
	      			// echo '<a href="system/facturar/ticket_web.php?factura='.$factura.'" class="btn-floating btn-sm btn-success"><i class="fas fa-print"></i></a>';
	      			// echo "Ticket tx1 y local";
	         //(tipo,numero,cambio,impresor,mesa,factura_o_tiket)
	      		} else {
	      			// aqui va el vinculo a web
	      			echo '<a href="system/facturar/facturas/'.$_SESSION["td"].'/ticket_web.php?factura='.$factura.'" class="btn-floating btn-sm btn-info" target="_blank"><i class="fas fa-print"></i></a>xx';
	      			// echo "Ticekt tx1 y Web";
	      		}
           
        }
        if($bx1 == 1){ // tx1 Factura
        		if($_SESSION["root_plataforma"] == 0){ // si es local
	      			// $imprimir->Factura($efectivo, $factura);
	      			// echo '<a href="system/facturar/ticket_web.php?factura='.$factura.'" class="btn-floating btn-sm btn-info"><i class="fas fa-print"></i></a>';
	      			// echo "Factura tx1 y local";
	         //(tipo,numero,cambio,impresor,mesa,factura_o_tiket)
	      		} else {
	      			// aqui va el vinculo a web
	      			echo '<a href="system/facturar/facturas/'.$_SESSION["td"].'/ticket_web.php?factura='.$factura.'" class="btn-floating btn-sm btn-info" target="_blank"><i class="fas fa-print"></i></a>xx';
	      			// echo "Factura tx1 y Web";
	      		}        	
           
        }

    } 


}

}// termina le funcion








} // fin de la clase

 ?>